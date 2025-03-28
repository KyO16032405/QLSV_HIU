<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Khoa;
use App\Models\Lop;
use App\Models\Monhoc;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;
use Yajra\DataTables\Facades\DataTables;
use Illuminate\Support\Facades\Response;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;
use Illuminate\Database\QueryException;


class ClassController extends Controller
{
    public function index()
    {
        return view('class.index');
    }
    public function datajson(Request $request)
    {
        // Truy vấn dữ liệu từ bảng 'lops' kết hợp với 'khoas'
        $class = DB::table('lops')
            ->join('khoas', 'lops.khoa_id', '=', 'khoas.id')
            ->select([
                'lops.id',
                'malop',
                'tenlop',
                'khoa_id',
                'tenkhoa'
            ])
            ->orderBy('lops.id', 'desc')
            ->get();

        // Tạo số thứ tự thủ công (rownum)
        $class = $class->map(function ($item, $key) {
            $item->rownum = $key + 1;
            return $item;
        });

        // Tạo DataTables
        $datatables = DataTables::of($class)
            ->addColumn('action', function ($data) {
                return view('modals.btn-action-modal', [
                    'edit' => '#edit_class',
                    'id' => $data->id,
                    'urlEdit' => route('class.editclass', ['id' => $data->id]),
                    'detail' => route('class.getDetail', ['id' => $data->id]),
                    'destroy' => route('class.getDestroy', ['id' => $data->id])
                ]);
            })
            ->rawColumns(['action']);

        // Tìm kiếm theo số thứ tự (rownum) và các cột khác
        if ($keyword = $request->get('search')['value']) {
            $datatables->filter(function ($query) use ($keyword) {
                return $query->filter(function ($item) use ($keyword) {
                    return stripos($item->rownum, $keyword) !== false ||
                        stripos($item->malop, $keyword) !== false ||
                        stripos($item->tenlop, $keyword) !== false ||
                        stripos($item->tenkhoa, $keyword) !== false;
                });
            });
        }

        return $datatables->make(true);
    }

    public function addclass(Request $request)
    {
        $data = $request->only(['malop', 'tenlop', 'khoa_id']);
        $table = new Lop();
        $table->malop = $data['malop'];
        $table->tenlop = $data['tenlop'];
        $table->khoa_id = $data['khoa_id'];
        $table->save();
        try {
            return Response::json([
                'error' => 0,
                'message' => 'Thêm thành công.'
            ]);
        } catch (QueryException $e) {
            return Response::json([
                'error' => 1,
                'message' => $e
            ]);
        }
    }
    public function postDuplicate(Request $request)
    {
        $check = DB::table('lops')->where([['malop', $request->malop], ['id', '!=', $request->id]])->count();
        if ($check == 0) {
            echo json_encode(true);
        } else {
            echo json_encode(false);
        }
    }
    /**
     * Xóa 1 mục
     */
    public function destroy($id)
    {
        try {
            Lop::destroy($id);
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
    /**
     * Edit item id
     */
    public function postEdit(Request $request, $id)
    {
        $model = Lop::find($id);
        $model->malop = $request->edit_malop;
        $model->tenlop = $request->edit_tenlop;
        $model->khoa_id = $request->edit_khoa_id;
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
        $model = Lop::find($id);
        return Response::json($model);
    }
}
