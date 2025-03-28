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

class StudyagainController extends Controller
{
    public function index()
    {
        return view('study-again.index');
    }
    public function datajson(Request $request)
    {
        // Initialize the WHERE conditions array
        $where = [];

        // Handle search parameters from the request
        if (isset($request->search['custom']['typesearch'])) {
            if (($request->search['custom']['typesearch']) == "0") {
                if ($request->search['custom']['malop']) {
                    $where[] = ['malop', 'like', '%' . trim($request->search['custom']['malop']) . '%'];
                }
                if ($request->search['custom']['mamh']) {
                    $where[] = ['mamon', 'like', '%' . trim($request->search['custom']['mamh']) . '%'];
                }
                if ($request->search['custom']['masv']) {
                    $where[] = ['masv', 'like', '%' . trim($request->search['custom']['masv']) . '%'];
                }
            }
            if (($request->search['custom']['typesearch']) == "1") {
                if ($request->search['custom']['malop']) {
                    $where[] = ['malop', trim($request->search['custom']['malop'])];
                }
                if ($request->search['custom']['mamh']) {
                    $where[] = ['mamon', trim($request->search['custom']['mamh'])];
                }
                if ($request->search['custom']['masv']) {
                    $where[] = ['masv', trim($request->search['custom']['masv'])];
                }
            }
        }

        // Fetch the data from the database
        $diem = DB::table('diems')
            ->join('sinhviens', 'diems.sinhvien_id', '=', 'sinhviens.id')
            ->join('monhocs', 'diems.monhoc_id', '=', 'monhocs.id')
            ->join('lops', 'sinhviens.lop_id', '=', 'lops.id')
            ->select([
                'masv',
                'hosv',
                'tensv',
                'malop',
                'mamon',
                'diemcc',
                'diemtx',
                'diemgk',
                'diemck',
                'diemthilai',
                'tenmon'
            ])
            ->where('diemcc', '<', 5)
            ->orWhere([['diemcc', '<', 3], ['diemtx', '<', 3]])
            ->orWhere([['diemcc', '<', 3], ['diemgk', '<', 3]])
            ->orWhere([['diemtx', '<', 3], ['diemgk', '<', 3]])
            ->orWhere('diemcc', '=', 0)
            ->orWhere('diemtx', '=', 0)
            ->orWhere('diemgk', '=', 0)
            ->orWhere('diemck', '=', 0)
            ->orWhereRaw('(10*diemcc+10*diemtx+30*diemgk+60*diemthilai)/100 < 5')
            ->whereNotNull('diemcc')
            ->whereNotNull('diemtx')
            ->whereNotNull('diemgk')
            ->get();

        // Add rownum manually using map
        $diem = $diem->map(function ($item, $key) {
            $item->rownum = $key + 1;  // Adding row number manually
            return $item;
        });

        // Process data for DataTables
        $datatables = DataTables::of($diem)
            ->addColumn('hotensv', function ($data) {
                return $data->hosv . " " . $data->tensv;  // Full name
            })
            ->addColumn('lydo', function ($data) {
                $lydo = [];
                $dem = 0;

                // Reason for failing marks
                if ($data->diemcc < 5) {
                    $lydo[] = "Điểm Chuyên cần dưới 5";
                }
                if ($data->diemcc < 3) $dem++;
                if ($data->diemtx < 3) $dem++;
                if ($data->diemgk < 3) $dem++;
                if ($data->diemck < 3) $dem++;
                if ($dem >= 2) $lydo[] = "Có 2 cột điểm dưới 3";
                if ($data->diemcc == 0 || $data->diemtx == 0 || $data->diemgk == 0 || $data->diemck == 0) {
                    $lydo[] = "Có 1 cột điểm bằng 0";
                }
                if ((10 * $data->diemcc + 10 * $data->diemtx + 30 * $data->diemgk + 60 * $data->diemthilai) / 100 < 5 && $data->diemthilai != null) {
                    $lydo[] = "Điểm trung bình thi lại nhỏ hơn 5";
                }
                return $lydo;
            })
            ->rawColumns(['rownum', 'hotensv', 'lydo']);

        // Enhance DataTable search with proper filtering
        if ($keyword = $request->get('search')['value']) {
            // Filter based on the rownum if it's part of the search
            $datatables->filterColumn('rownum', 'whereRaw', 'rownum like ?', ["%{$keyword}%"]);
        }

        // Return the DataTable response
        return $datatables->make(true);
    }
}
