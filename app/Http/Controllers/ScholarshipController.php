<?php

namespace App\Http\Controllers;

use App\Models\Monhoc;
use App\Models\Sinhvien;
use App\Models\Giangvien;
use App\Models\Diem;
use Illuminate\Http\Request;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;
use Yajra\DataTables\Facades\DataTables;
use Illuminate\Support\Facades\Response;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;
use Illuminate\Database\QueryException;
use Maatwebsite\Excel\Facades\Excel;
use Illuminate\Database\Eloquent\Builder;

class ScholarshipController extends Controller
{
    public function index($namhoc, $hocky, $hocbong)
    {
        view()->share('namhoc', $namhoc);
        view()->share('hocky', $hocky);
        view()->share('hocbong', $hocbong);

        // Lấy ID học kỳ từ bảng hockys dựa trên namhoc và hocky
        $hockyId = DB::table('hockys')
            ->where('namhoc', $namhoc)
            ->where('hocky', $hocky)
            ->value('id');

        if (!$hockyId) {
            // Xử lý nếu không tìm thấy học kỳ
            return response()->json(['error' => 'Học kỳ không tồn tại'], 404);
        }

        // Lấy danh sách môn học trong học kỳ và năm học
        $monhoc = Monhoc::join('phancong', 'monhocs.id', '=', 'phancong.monhoc_id')
            ->join('hockys', 'monhocs.hocky_id', '=', 'hockys.id')
            ->where([
                ['hockys.hocky', '=', $hocky],
                ['hockys.namhoc', '=', $namhoc],
            ])
            ->get();

        // Lấy điểm của tất cả sinh viên trong học kỳ
        $diem = Diem::join('sinhviens', 'diems.sinhvien_id', '=', 'sinhviens.id')
            ->join('monhocs', 'diems.monhoc_id', '=', 'monhocs.id')
            ->join('hockys', 'monhocs.hocky_id', '=', 'hockys.id')
            ->join('phancong', 'monhocs.id', '=', 'phancong.monhoc_id')
            ->join('lops', 'sinhviens.lop_id', '=', 'lops.id')
            ->select('sinhviens.id as idsv', 'tenmon', 'diemcc', 'diemtx', 'diemgk', 'diemck', 'diemthilai', 'sotinchi')
            ->where('hockys.id', $hockyId)
            ->get();

        // Lấy danh sách sinh viên và tính điểm trung bình
        $student = Sinhvien::join('lops', 'sinhviens.lop_id', '=', 'lops.id')
            ->leftJoin('thongkes', function ($join) use ($hockyId) {
                $join->on('sinhviens.id', '=', 'thongkes.sinhvien_id')
                    ->where('thongkes.thongke_hocky_id', '=', $hockyId);
            })
            ->select([
                'sinhviens.id as idsv',
                'sinhviens.masv',
                'sinhviens.tensv',
                'sinhviens.hosv',
                'lops.tenlop',
                DB::raw('IFNULL(thongkes.diemrl, 0) as diemrl'),
                DB::raw('IFNULL(thongkes.hocbong, null) as hocbong'),
                DB::raw('? as namhoc'),
                DB::raw('? as hocky')
            ])
            ->setBindings([$namhoc, $hocky])
            ->get();

        // Tính điểm trung bình và xét học bổng
        $studentWithScholarship = $student->map(function ($st) use ($diem, $hockyId) {
            $diemtb = 0;
            $tongstc = 0;

            foreach ($diem as $d) {
                if ($d->idsv == $st->idsv) {
                    $score = 0;
                    if ($d->diemcc < 5 || ($d->diemtx < 3 && $d->diemgk < 3) || $d->diemtx == 0 || $d->diemgk == 0 || $d->diemck == 0) {
                        $score = 0;
                    } elseif (
                        (($d->diemcc > 5 && $d->diemtx >= 3) || $d->diemgk >= 3) &&
                        (10 * $d->diemcc + 10 * $d->diemtx + 30 * $d->diemgk + 50 * $d->diemck) / 100 > 5
                    ) {
                        $score = (10 * $d->diemcc + 10 * $d->diemtx + 30 * $d->diemgk + 50 * $d->diemck) / 100;
                    } elseif (
                        (($d->diemcc > 5 && $d->diemtx >= 3) || $d->diemgk >= 3) &&
                        (10 * $d->diemcc + 10 * $d->diemtx + 30 * $d->diemgk + 50 * $d->diemck) / 100 < 5 &&
                        (10 * $d->diemcc + 10 * $d->diemtx + 30 * $d->diemgk + 50 * $d->diemthilai) / 100 > 5
                    ) {
                        $score = (10 * $d->diemcc + 10 * $d->diemtx + 30 * $d->diemgk + 50 * $d->diemthilai) / 100;
                    } else {
                        $score = 0;
                    }
                    $diemtb += $score * $d->sotinchi;
                    $tongstc += $d->sotinchi;
                }
            }

            $dhl = $tongstc > 0 ? $diemtb / $tongstc : 0;
            $st->diemtb = number_format($dhl, 2);
            $st->xetHB = $dhl > 8 ? 1 : null;

            // Cập nhật học bổng vào bảng thongkes
            $check = DB::table('thongkes')->where([
                ['sinhvien_id', '=', $st->idsv],
                ['thongke_hocky_id', '=', $hockyId],
            ])->first();

            if ($check) {
                DB::table('thongkes')->where('id', $check->id)->update(['hocbong' => $st->xetHB]);
            } else {
                DB::table('thongkes')->insert([
                    'sinhvien_id' => $st->idsv,
                    'hocbong' => $st->xetHB,
                    'thongke_hocky_id' => $hockyId,
                    'diemrl' => $st->diemrl ?: 0
                ]);
            }

            return $st;
        })->filter(function ($st) {
            return $st->xetHB == 1; // Chỉ hiển thị sinh viên đạt học bổng
        });

        view()->share('student', $studentWithScholarship);
        return view('scholarship.index');
    }

    public function savehocbong()
    {
        $svid = $_POST['svid'];
        $hocbong = $_POST['hocbong'] === "" ? null : $_POST['hocbong'];
        $hocky = $_POST['hocky'];

        // Lấy ID học kỳ từ bảng hockys
        $hockyId = DB::table('hockys')
            ->where('hocky', $hocky)
            ->value('id');

        if (!$hockyId) {
            return Response::json([
                'error' => 1,
                'message' => 'Học kỳ không tồn tại'
            ]);
        }

        if ($hocbong === null || $hocbong == 1) {
            $check = DB::table('thongkes')->where([
                ['sinhvien_id', '=', $svid],
                ['thongke_hocky_id', '=', $hockyId],
            ])->first();

            if ($check) {
                DB::table('thongkes')->where('id', $check->id)->update([
                    'sinhvien_id' => $svid,
                    'hocbong' => $hocbong,
                    'thongke_hocky_id' => $hockyId
                ]);
            } else {
                DB::table('thongkes')->insert([
                    'sinhvien_id' => $svid,
                    'hocbong' => $hocbong,
                    'thongke_hocky_id' => $hockyId,
                    'diemrl' => 0
                ]);
            }

            return Response::json([
                'error' => 0,
                'message' => $hocbong === null ? 'Xóa thành công học bổng' : 'Thêm thành công học bổng'
            ]);
        } else {
            return Response::json([
                'error' => 1,
                'message' => 'Giá trị học bổng không hợp lệ'
            ]);
        }
    }
}
