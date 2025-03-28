<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Khoa;
use App\Models\Lop;
use App\Models\Monhoc;
use App\Models\Sinhvien;
use App\Models\User;
//Carbon
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Response;
use Illuminate\Database\QueryException;
use Yajra\DataTables\Facades\DataTables;

class SubjectController extends Controller
{
    public function index()
    {
        return view('subjects.index');
    }
    public function datajson(Request $request)
    {
        // Lấy danh sách môn học từ CSDL
        $subjects = Monhoc::select([
            'id',
            'mamon',
            'tenmon',
            'sotinchi',
            'sotiet',
        ])
            ->orderBy('id', 'desc')
            ->get();

        // Tạo số thứ tự (rownum) thủ công
        $subjects = $subjects->map(function ($item, $key) {
            $item->rownum = $key + 1;
            return $item;
        });

        // Xử lý DataTables
        $datatables = DataTables::of($subjects)
            ->addColumn('action', function ($data) {
                return view('modals.btn-action-modal', [
                    'edit' => '#edit_subject',
                    'id' => $data->id,
                    'urlEdit' => route('subject.editsubject', ['id' => $data->id]),
                    'detail' => route('subject.getDetail', ['id' => $data->id]),
                    'destroy' => route('subject.getDestroy', ['id' => $data->id])
                ]);
            })
            ->rawColumns(['action']);

        // Thêm chức năng tìm kiếm DataTables
        if ($keyword = $request->get('search')['value']) {
            $datatables->filter(function ($query) use ($keyword) {
                return $query->filter(function ($item) use ($keyword) {
                    return stripos($item->rownum, $keyword) !== false ||
                        stripos($item->mamon, $keyword) !== false ||
                        stripos($item->tenmon, $keyword) !== false ||
                        stripos($item->sotinchi, $keyword) !== false ||
                        stripos($item->sotiet, $keyword) !== false;
                });
            });
        }

        return $datatables->make(true);
    }

    /**
     * Xóa 1 mục
     */
    public function destroy($id)
    {
        try {
            Monhoc::destroy($id);
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

    public function addsubject(Request $request)
    {
        $data = $request->only(['mamon', 'tenmon', 'sotinchi', 'sotiet', 'hocky', 'namhoc', 'giangvien_id', 'lop_id']);
        $hocky = DB::table('hockys')->where([
            ['hocky', '=', $data['hocky']],
            ['namhoc', '=', $data['namhoc']],
        ])->get();
        if ($hocky->count() == 0) {
            $idhk = DB::table('hockys')->insertGetId([
                'hocky' => $data['hocky'],
                'namhoc' => $data['namhoc'],
            ]);
        } else {
            $idhk = $hocky[0]->id;
        }
        $idmh = DB::table('monhocs')->insertGetId(
            [
                'mamon' => $data['mamon'],
                'tenmon' => $data['tenmon'],
                'sotinchi' => $data['sotinchi'],
                'sotiet' => $data['sotiet'],
                'hocky_id' => $idhk,
            ]
        );
        if ($idhk && $idmh) {
            foreach ($data['lop_id'] as $l) {
                DB::table('phancong')->insert([
                    'monhoc_id' => $idmh,
                    'lop_id' => $l,
                    'giangvien_id' => $data['giangvien_id']
                ]);
                $sivi = DB::table('sinhviens')->where('lop_id', '=', $l)->get();
                foreach ($sivi as $sv) {
                    DB::table('diems')->insert(
                        ['monhoc_id' => $idmh, 'sinhvien_id' => $sv->id]
                    );
                }
            }
        }
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
        $check = Monhoc::where([['mamon', $request->mamon], ['id', '!=', $request->id]])->count();
        if ($check == 0) {
            echo json_encode(true);
        } else {
            echo json_encode(false);
        }
    }

    public function postEdit(Request $request, $id)
    {
        $where = [];
        $hocky = DB::table('hockys')->where([
            ['hocky', '=', $request->edit_hocky],
            ['namhoc', '=', $request->edit_namhoc],
        ])->get();
        if ($hocky->count() == 0) {
            $idhk = DB::table('hockys')->insertGetId([
                'hocky' => $request->edit_hocky,
                'namhoc' => $request->edit_namhoc,
            ]);
        } else {
            $idhk = $hocky[0]->id;
        }
        $model = Monhoc::find($id);
        $model->mamon = $request->edit_mamon;
        $model->tenmon = $request->edit_tenmon;
        $model->sotinchi = $request->edit_sotinchi;
        $model->sotiet = $request->edit_sotiet;
        $model->hocky_id = $idhk;
        $model->save();
        DB::table('phancong')->where('monhoc_id', '=', $id)->delete();
        foreach ($request->edit_lop_id as $l) {
            DB::table('phancong')->insert([
                'monhoc_id' => $id,
                'lop_id' => $l,
                'giangvien_id' => $request->edit_giangvien_id
            ]);
        }
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
        $model = Monhoc::join('phancong', 'monhocs.id', '=', 'phancong.monhoc_id')
            ->join('hockys', 'monhocs.hocky_id', '=', 'hockys.id')
            ->where('monhocs.id', '=', $id)->get();
        return Response::json($model);
    }
}
