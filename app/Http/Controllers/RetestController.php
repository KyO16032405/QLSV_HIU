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

class RetestController extends Controller
{
    public function index()
    {
        return view('retest.index');
    }
    public function datajson(Request $request)
    {
        // Lấy dữ liệu từ database mà không cần @rownum
        $diem = DB::table('diems')
            ->join('sinhviens', 'diems.sinhvien_id', '=', 'sinhviens.id')
            ->join('monhocs', 'diems.monhoc_id', '=', 'monhocs.id')
            ->join('lops', 'sinhviens.lop_id', '=', 'lops.id')
            ->select([
                'sinhviens.id',
                'masv',
                'hosv',
                'tensv',
                'malop',
                'mamon',
                'diemcc',
                'diemtx',
                'diemgk',
                'diemck',
                'tenmon',
                DB::raw('ROUND((10*diemcc + 10*diemtx + 30*diemgk + 60*diemck) / 100, 0) AS diemtb'),
            ])
            ->whereRaw('(10*diemcc+10*diemtx+30*diemgk+60*diemck)/100 < 5')
            ->get();

        // Tạo số thứ tự thủ công
        $diem = $diem->map(function ($item, $key) {
            $item->rownum = $key + 1;
            return $item;
        });

        $datatables = DataTables::of($diem)
            ->addColumn('hotensv', function ($data) {
                return $data->hosv . " " . $data->tensv;
            })
            ->rawColumns(['hotensv', 'diemtb']);

        if ($keyword = $request->get('search')['value']) {
            $datatables->filter(function ($query) use ($keyword) {
                return $query->filter(function ($item) use ($keyword) {
                    return stripos($item->rownum, $keyword) !== false ||
                        stripos($item->hotensv, $keyword) !== false;
                });
            });
        }

        return $datatables->make(true);
    }
}
