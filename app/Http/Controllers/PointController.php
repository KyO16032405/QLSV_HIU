<?php

namespace App\Http\Controllers;

use App\Models\Diem;
use App\Models\Lop;
use App\Models\Monhoc;
use App\Models\Sinhvien;
use Illuminate\Http\Request;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;
use Yajra\DataTables\Facades\DataTables;
use Illuminate\Support\Facades\Response;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;
use Illuminate\Database\QueryException;

class PointController extends Controller
{
    public function index()
    {
        // Lấy danh sách sinh viên và điểm
        $students = DB::table('sinhviens')
            ->join('diems', 'sinhviens.id', '=', 'diems.sinhvien_id')
            ->join('monhocs', 'diems.monhoc_id', '=', 'monhocs.id')
            ->join('lops', 'sinhviens.lop_id', '=', 'lops.id')
            ->select([
                'masv',
                'hosv',
                'tensv',
                'malop',
                'diemcc',
                'diemtx',
                'diemgk',
                'diemck',
                'diemthilai',
                'mamon',
                'sinhviens.id AS sv_id',
                'diems.id AS diem_id',
                'monhocs.id AS monhoc_id'
            ])
            ->get();

        // Thêm số thứ tự (rownum) thủ công
        $students = $students->map(function ($item, $key) {
            $item->rownum = $key + 1;
            return $item;
        });

        return view('points.index', ['students' => $students]);
    }

    public function datajson(Request $request)
    {
        // Lấy danh sách sinh viên và điểm
        $students = DB::table('sinhviens')
            ->leftJoin('diems', 'sinhviens.id', '=', 'diems.sinhvien_id')
            ->leftJoin('monhocs', 'diems.monhoc_id', '=', 'monhocs.id')
            ->leftJoin('lops', 'sinhviens.lop_id', '=', 'lops.id')
            ->select([
                'hosv',
                'tensv',
                'tenlop',
                'diemcc',
                'diemtx',
                'diemgk',
                'diemck',
                'sinhviens.id AS sv_id',
                'diems.id AS diem_id',
                'monhocs.id AS monhoc_id'
            ])
            ->get();

        // Thêm số thứ tự (rownum) thủ công
        $students = $students->map(function ($item, $key) {
            $item->rownum = $key + 1;
            return $item;
        });

        // Xử lý DataTables
        $datatables = DataTables::of($students)
            ->addColumn('hotensv', function ($data) {
                return $data->hosv . " " . $data->tensv;
            })
            ->rawColumns(['hotensv']);

        // Tìm kiếm theo số thứ tự (rownum) và các cột khác
        if ($keyword = $request->get('search')['value']) {
            $datatables->filter(function ($query) use ($keyword) {
                return $query->filter(function ($item) use ($keyword) {
                    return stripos($item->rownum, $keyword) !== false ||
                        stripos($item->hosv, $keyword) !== false ||
                        stripos($item->tensv, $keyword) !== false ||
                        stripos($item->tenlop, $keyword) !== false;
                });
            });
        }

        return $datatables->make(true);
    }


    public function savediem(Request $request)
    {
        $diemso = $_POST['diem'];
        $sv_id = $_POST['sv_id'];
        $monhoc_id = $_POST['monhoc_id'];
        $diem_id = $_POST['diem_id'];
        $column = $_POST['column'];
        if ($diemso == "") {
            $diemso = null;
        }
        if ($column == 'diemcc') {
            $diem = Diem::find($diem_id);
            $diem->diemcc = $diemso;
            $diem->sinhvien_id = $sv_id;
            $diem->monhoc_id = $monhoc_id;
            $diem->save();
            return Response::json([
                'error' => 1,
                'message' => 'Lưu thành công'
            ]);
        }
        if ($column == 'diemtx') {
            $diem = Diem::find($diem_id);
            $diem->diemtx = $diemso;
            $diem->sinhvien_id = $sv_id;
            $diem->monhoc_id = $monhoc_id;
            $diem->save();
            return Response::json([
                'error' => 1,
                'message' => 'Lưu thành công'
            ]);
        }
        if ($column == 'diemgk') {
            $diem = Diem::find($diem_id);
            $diem->diemgk = $diemso;
            $diem->sinhvien_id = $sv_id;
            $diem->monhoc_id = $monhoc_id;
            $diem->save();
            return Response::json([
                'error' => 1,
                'message' => 'Lưu thành công'
            ]);
        }
        if ($column == 'diemck') {
            $diem = Diem::find($diem_id);
            $diem->diemck = $diemso;
            $diem->sinhvien_id = $sv_id;
            $diem->monhoc_id = $monhoc_id;
            $diem->save();
            return Response::json([
                'error' => 1,
                'message' => 'Lưu thành công'
            ]);
        }
        if ($column == 'diemthilai') {
            $diem = Diem::find($diem_id);
            $diem->diemthilai = $diemso;
            $diem->sinhvien_id = $sv_id;
            $diem->monhoc_id = $monhoc_id;
            $diem->save();
            return Response::json([
                'error' => 1,
                'message' => 'Lưu thành công'
            ]);
        }
    }
    public function userindex()
    {
        DB::statement(DB::raw('set @rownum=0'));
        $student = DB::table('sinhviens')
            ->join('diems', 'sinhviens.id', '=', 'diems.sinhvien_id')
            ->join('monhocs', 'diems.monhoc_id', '=', 'monhocs.id')
            ->join('lops', 'sinhviens.lop_id', '=', 'lops.id')
            ->select([
                DB::raw('@rownum  := @rownum  + 1 AS rownum'),
                'masv',
                'hosv',
                'tensv',
                'malop',
                'diemcc',
                'diemtx',
                'diemgk',
                'diemck',
                'diemthilai',
                'mamon',
                'sinhviens.id AS sv_id',
                'diems.id AS diem_id',
                'monhocs.id AS monhoc_id'
            ])->get();
        return view('points.userindex', ['student' => $student]);
    }
}
