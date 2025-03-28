<?php

namespace App\Http\Controllers;

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
use Maatwebsite\Excel\Facades\Excel;

class StudentController extends Controller
{
    public function index()
    {
        return view('student.index');
    }
    public function datajson(Request $request) {
        $where = [];

        // Kiểm tra điều kiện tìm kiếm có tồn tại không
        if (isset($request->search['custom']) && is_array($request->search['custom'])) {
            $search = $request->search['custom'];
            $typesearch = $search['typesearch'] ?? null;

            // Nếu typesearch là "0" (LIKE)
            if ($typesearch === "0") {
                if (!empty($search['lop'])) $where[] = ['lops.malop', 'like', '%' . trim($search['lop']) . '%'];
                if (!empty($search['masv'])) $where[] = ['masv', 'like', '%' . trim($search['masv']) . '%'];
                if (!empty($search['hosv'])) $where[] = ['hosv', 'like', '%' . trim($search['hosv']) . '%'];
                if (!empty($search['tensv'])) $where[] = ['tensv', 'like', '%' . trim($search['tensv']) . '%'];
                if (!empty($search['quequan'])) $where[] = ['quequan', 'like', '%' . trim($search['quequan']) . '%'];
            }

            // Nếu typesearch là "1" (Chính xác)
            elseif ($typesearch === "1") {
                if (!empty($search['lop'])) $where[] = ['lops.malop', trim($search['lop'])];
                if (!empty($search['masv'])) $where[] = ['masv', trim($search['masv'])];
                if (!empty($search['hosv'])) $where[] = ['hosv', trim($search['hosv'])];
                if (!empty($search['tensv'])) $where[] = ['tensv', trim($search['tensv'])];
                if (!empty($search['quequan'])) $where[] = ['quequan', trim($search['quequan'])];
            }
        }

        // Truy vấn danh sách sinh viên
        $students = DB::table('sinhviens')
            ->join('lops', 'sinhviens.lop_id', '=', 'lops.id')
            ->select([
                'sinhviens.id',
                'masv',
                'hosv',
                'tensv',
                'gioitinh',
                'ngaysinh',
                'quequan',
                'lops.malop AS malopsv'
            ])
            ->where($where)
            ->orderBy('sinhviens.id', 'desc')
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
            ->addColumn('gioitinhsv', function ($data) {
                return $data->gioitinh == 1 ? 'Nam' : 'Nữ';
            })
            ->addColumn('action', function ($data) {
                return view('modals.btn-action-modal', [
                    'edit' => '#edit_student',
                    'id' => $data->id,
                    'urlEdit' => route('student.postEdit', ['id' => $data->id]),
                    'detail' => route('student.getDetail', ['id' => $data->id]),
                    'destroy' => route('student.getDestroy', ['id' => $data->id])
                ]);
            })
            ->rawColumns(['hotensv', 'gioitinhsv', 'action']);

        // Tìm kiếm trong DataTables
        if ($keyword = $request->get('search')['value']) {
            $datatables->filter(function ($query) use ($keyword) {
                return $query->filter(function ($item) use ($keyword) {
                    return stripos($item->rownum, $keyword) !== false ||
                           stripos($item->masv, $keyword) !== false ||
                           stripos($item->hosv, $keyword) !== false ||
                           stripos($item->tensv, $keyword) !== false ||
                           stripos($item->malopsv, $keyword) !== false ||
                           stripos($item->quequan, $keyword) !== false;
                });
            });
        }

        return $datatables->make(true);
    }

    /**
     * Add student
     */
    public function addstudent(Request $request)
    {
        $idmax = DB::table('sinhviens')->max('id');
        $data = $request->only(['add_khoa', 'add_hosv', 'add_tensv', 'add_gioitinh', 'add_ngaysinh', 'add_quequan', 'add_lop', 'add_monhoc']);
        $masv = (string)date('y');
        if ($data['add_khoa']) {
            $masv = $masv . (string)$data['add_khoa'];
        }
        if ($idmax < 10) {
            $masv = $masv . '00' . ((int)$idmax + 1);
        } elseif ($idmax < 100) {
            $masv = $masv . '0' . ((int)$idmax + 1);
        } else {
            $masv = $masv . ((int)$idmax + 1);
        }
        $phancong = DB::table('phancong')->where('lop_id', '=', $data['add_lop'])->get();
        $id = DB::table('sinhviens')->insertGetId([
            'masv' => $masv,
            'hosv' => $data['add_hosv'],
            'tensv' => $data['add_tensv'],
            'gioitinh' => $data['add_gioitinh'],
            'ngaysinh' => $data['add_ngaysinh'],
            'quequan' => $data['add_quequan'],
            'lop_id' => $data['add_lop'],
        ]);
        foreach ($phancong as $pc) {
            DB::table('diems')->insert(
                ['monhoc_id' => $pc->monhoc_id, 'sinhvien_id' => $id]
            );
        }
        try {
            return Response::json([
                'error' => 0,
                //cái này nek $monhocs thì =1,2,3
                'message' =>  'Thêm thành công sinh viên có mã là' . $masv
            ]);
        } catch (QueryException $e) {
            return Response::json([
                'error' => 1,
                'message' => $e
            ]);
        }
    }
    /**
     * Export
     */
    public function getexport(Request $request)
    {
        $lop = "";
        die($request);
        DB::statement(DB::raw('set @rownum=0'));
        $student = DB::table('sinhviens')->join('lops', 'sinhviens.lop_id', '=', 'lops.id')->select([
            DB::raw('@rownum  := @rownum  + 1 AS rownum'),
            'sinhviens.id',
            'masv',
            'hosv',
            'tensv',
            'gioitinh',
            'ngaysinh',
            'quequan',
            'lops.malop AS malopsv'
        ])->where($lop)->orderBy('sinhviens.id', 'desc')->get();
        Excel::create('Filename', function ($excel) use ($student) {

            $excel->sheet('Sheetname', function ($sheet) use ($student) {
                $sheet->loadView('student.excel.export', ['student' => $student]);
            });
        })->export('xlsx');
    }
    public function postEdit(Request $request, $id)
    {
        $model = Sinhvien::find($id);
        $model->hosv = $request->edit_hosv;
        $model->tensv = $request->edit_tensv;
        $model->gioitinh =  $request->edit_gioitinh;
        $model->ngaysinh =  $request->edit_ngaysinh;
        $model->quequan =  $request->edit_quequan;
        $model->lop_id =  $request->edit_lop;
        $model->save();
        try {
            return Response::json([
                'error' => 0,
                'message' => 'Sửa Thành Công ' . $request->name
            ]);
        } catch (QueryException $e) {
            return Response::json([
                'error' => 1,
                'message' => $e
            ]);
        }
    }
    public function detail($id)
    {
        $model = Sinhvien::find($id);
        return Response::json($model);
    }

    public function destroy($id)
    {
        try {
            Sinhvien::destroy($id);
            return Response::json([
                'error' => 0,
                'message' => 'Xóa thành công '
            ]);
        } catch (QueryException $e) {
            return Response::json([
                'error' => 1,
                'message' => $e
            ]);
        }
    }
}
