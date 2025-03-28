<?php

namespace App\Http\Controllers;

use App\Models\Monhoc;
use App\Models\Sinhvien;
use App\Models\Giangvien;
use Illuminate\Http\Request;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;
use Yajra\DataTables\Facades\DataTables;
use Illuminate\Support\Facades\Response;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;
use Illuminate\Database\QueryException;
use Maatwebsite\Excel\Facades\Excel;

class LecturerController extends Controller
{
    public function index()
    {
        return view('lecturers.index');
    }
    public function datajson(Request $request)
    {
        // Lấy dữ liệu từ bảng 'giangviens'
        $subject = Giangvien::select([
            'id',
            'magv',
            'hogv',
            'tengv',
            'ngaysinh',
            'gioitinh',
            'hocham',
            'hocvi',
        ])->orderBy('id', 'desc')->get();

        // Tạo số thứ tự thủ công (rownum)
        $subject = $subject->map(function ($item, $key) {
            $item->rownum = $key + 1;
            return $item;
        });

        // Tạo DataTables
        $datatables = DataTables::of($subject)
            ->addColumn('hotengv', function ($data) {
                return $data->hogv . " " . $data->tengv;
            })
            ->addColumn('gioitinhgv', function ($data) {
                return $data->gioitinh == 1 ? 'Nam' : 'Nữ';
            })
            ->addColumn('action', function ($data) {
                return view('modals.btn-action-modal', [
                    'edit' => '#edit_lecturer',
                    'id' => $data->id,
                    'urlEdit' => route('lecturer.postEdit', ['id' => $data->id]),
                    'detail' => route('lecturer.getDetail', ['id' => $data->id]),
                    'destroy' => route('lecturer.getDestroy', ['id' => $data->id])
                ]);
            })
            ->rawColumns(['action']);

        // Tìm kiếm theo số thứ tự (rownum) và các cột khác
        if ($keyword = $request->get('search')['value']) {
            $datatables->filter(function ($query) use ($keyword) {
                return $query->filter(function ($item) use ($keyword) {
                    return stripos($item->rownum, $keyword) !== false ||
                        stripos($item->magv, $keyword) !== false ||
                        stripos($item->hotengv, $keyword) !== false ||
                        stripos($item->hocham, $keyword) !== false ||
                        stripos($item->hocvi, $keyword) !== false;
                });
            });
        }

        return $datatables->make(true);
    }

    public function addlecturer(Request $request)
    {
        $data = $request->only(['add_magv', 'add_hogv', 'add_tengv', 'add_gioitinh', 'add_ngaysinh', 'add_hocham', 'add_hocvi']);
        $lecturer = new Giangvien;
        $lecturer->magv = $data['add_magv'];
        $lecturer->hogv = $data['add_hogv'];
        $lecturer->tengv = $data['add_tengv'];
        $lecturer->gioitinh = $data['add_gioitinh'];
        $lecturer->ngaysinh = $data['add_ngaysinh'];
        $lecturer->hocham = $data['add_hocham'];
        $lecturer->hocvi = $data['add_hocvi'];
        $lecturer->save();
        try {
            return Response::json([
                'error' => 0,
                //cái này nek $monhocs thì =1,2,3
                'message' =>  'Thêm thành công '
            ]);
        } catch (QueryException $e) {
            return Response::json([
                'error' => 1,
                'message' => $e
            ]);
        }
    }
    /**
     * Xóa 1 mục
     */
    public function destroy($id)
    {
        try {
            Giangvien::destroy($id);
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
    public function detail($id)
    {
        $model = Giangvien::find($id);
        return Response::json($model);
    }
    public function postEdit(Request $request, $id)
    {
        $model = Giangvien::find($id);
        $model->magv = $request->edit_magv;
        $model->hogv = $request->edit_hogv;
        $model->tengv = $request->edit_tengv;
        $model->gioitinh =  $request->edit_gioitinh;
        $model->ngaysinh =  $request->edit_ngaysinh;
        $model->hocham =  $request->edit_hocham;
        $model->hocvi =  $request->edit_hocvi;
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
}
