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

class StudyresultController extends Controller
{
    public function index($lopid, $namhoc, $hocky, Request $request)
    {
        view()->share('lopid', $lopid);
        view()->share('namhoc', $namhoc);
        view()->share('hocky', $hocky);

        // Lấy ID học kỳ từ bảng hockys
        $hockyId = DB::table('hockys')
            ->where('namhoc', $namhoc)
            ->where('hocky', $hocky)
            ->value('id');

        if (!$hockyId) {
            return response()->json(['error' => 'Học kỳ không tồn tại'], 404);
        }

        $monhoc = Monhoc::join('phancong', 'monhocs.id', '=', 'phancong.monhoc_id')
            ->join('hockys', 'monhocs.hocky_id', '=', 'hockys.id')
            ->where([
                ['phancong.lop_id', '=', $lopid],
                ['hockys.hocky', '=', $hocky],
                ['hockys.namhoc', '=', $namhoc],
            ])
            ->get();

        view()->share('monhoc', $monhoc);

        if ($request->ajax()) {
            $diem = Diem::join('sinhviens', 'diems.sinhvien_id', '=', 'sinhviens.id')
                ->join('monhocs', 'diems.monhoc_id', '=', 'monhocs.id')
                ->join('hockys', 'monhocs.hocky_id', '=', 'hockys.id')
                ->join('phancong', 'monhocs.id', '=', 'phancong.monhoc_id')
                ->join('lops', 'sinhviens.lop_id', '=', 'lops.id')
                ->select('sinhviens.id as idsv', 'diemtong')
                ->where([
                    ['phancong.lop_id', '=', $lopid],
                    ['hockys.hocky', '=', $hocky],
                    ['hockys.namhoc', '=', $namhoc],
                ])
                ->get();

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
                    DB::raw('IFNULL(thongkes.diemrl, 0) as diemrl')
                ])
                ->where('lops.id', $lopid)
                ->get();

            $data = $student->map(function ($st) use ($diem) {
                $diemRecord = $diem->where('idsv', $st->idsv)->first();
                $diemtong = $diemRecord ? $diemRecord->diemtong : null; // Để null nếu không có điểm
                $lenLop = $diemtong !== null && $diemtong > 5 ? 'Được' : 'Không';
                $xetHB = $diemtong !== null && $diemtong > 8 ? 'Có' : 'Không';
                $hocLuc = $diemtong !== null ? (
                    $diemtong >= 8 ? 'Giỏi' : (
                        $diemtong >= 7 ? 'Khá' : (
                            $diemtong >= 6 ? 'Trung Bình Khá' : (
                                $diemtong >= 5 ? 'Trung bình' : 'Yếu'
                            )
                        )
                    )
                ) : 'Chưa có điểm';

                return [
                    'stt' => '',
                    'masv' => $st->masv,
                    'tensv' => $st->hosv . ' ' . $st->tensv,
                    'diemtong' => $diemtong !== null ? number_format($diemtong, 2) : 'N/A',
                    'diemrl' => $st->diemrl,
                    'hocLuc' => $hocLuc,
                    'lenLop' => $lenLop,
                    'xetHB' => $xetHB
                ];
            });

            return response()->json(['data' => $data]);
        }

        $diem = Diem::join('sinhviens', 'diems.sinhvien_id', '=', 'sinhviens.id')
            ->join('monhocs', 'diems.monhoc_id', '=', 'monhocs.id')
            ->join('hockys', 'monhocs.hocky_id', '=', 'hockys.id')
            ->join('phancong', 'monhocs.id', '=', 'phancong.monhoc_id')
            ->join('lops', 'sinhviens.lop_id', '=', 'lops.id')
            ->select('sinhviens.id as idsv', 'diemtong')
            ->where([
                ['phancong.lop_id', '=', $lopid],
                ['hockys.hocky', '=', $hocky],
                ['hockys.namhoc', '=', $namhoc],
            ])
            ->get();

        view()->share('diem', $diem);

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
                DB::raw('IFNULL(thongkes.diemrl, 0) as diemrl')
            ])
            ->where('lops.id', $lopid)
            ->get();

        view()->share('student', $student);
        return view('study-result.index');
    }

    public function savediemrl()
    {
        $svid = $_POST['svid'];
        $diemrl = $_POST['diemrl'];
        $hocky = $_POST['hocky'];

        $hockyId = DB::table('hockys')
            ->where('hocky', $hocky)
            ->value('id');

        if (!$hockyId) {
            return Response::json([
                'error' => 1,
                'message' => 'Học kỳ không tồn tại'
            ]);
        }

        if (is_numeric($diemrl) && $diemrl >= 0 && $diemrl <= 100) {
            $check = DB::table('thongkes')->where([
                ['sinhvien_id', '=', $svid],
                ['thongke_hocky_id', '=', $hockyId],
            ])->get();

            $countcheck = $check->count();
            if ($countcheck > 0) {
                DB::table('thongkes')->where('id', '=', $check[0]->id)->update([
                    'sinhvien_id' => $svid,
                    'diemrl' => $diemrl,
                    'thongke_hocky_id' => $hockyId
                ]);
            } else {
                DB::table('thongkes')->insert([
                    'sinhvien_id' => $svid,
                    'diemrl' => $diemrl,
                    'hocbong' => null,
                    'thongke_hocky_id' => $hockyId
                ]);
            }

            return Response::json([
                'error' => 0,
                'message' => 'Thêm thành công điểm rèn luyện'
            ]);
        } else {
            return Response::json([
                'error' => 1,
                'message' => 'Vui lòng nhập điểm rèn luyện trong khoảng "0=>100"'
            ]);
        }
    }
}
