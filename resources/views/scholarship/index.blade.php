@extends('adminlte::page')
@section('title', 'Xét học bổng')
@section('content_header')
    <div class="row">
        <div class="col-md-8">
            <div class="btn btn-flat fix-box" style="margin: 0;padding: 0 0 0 12px;">
                <select name="search_namhoc" id="search_namhoc" class="form-control">
                    @foreach (\Illuminate\Support\Facades\DB::table('hockys')->pluck('namhoc', 'namhoc')->all() as $key => $val)
                        <option value="{{ $key }}" @if ($key == $namhoc) selected @endif>
                            {{ $val }}</option>
                    @endforeach
                </select>
                <select name="search_hocky" id="search_hocky" class="form-control">
                    @foreach (\Illuminate\Support\Facades\DB::table('hockys')->get() as $hk)
                        <option value="{{ $hk->hocky }}" data-id="{{ $hk->id }}"
                            @if ($hk->hocky == $hocky) selected @endif>
                            {{ $hk->hocky }}
                        </option>
                    @endforeach
                </select>
                <button name="btnscholarship" onclick="btnscholarship()" class="btn bg-teal btn-flat">Duyệt</button>
            </div>
        </div>
        <div class="col-md-4">
            <ol class="breadcrumb"
                style="padding: 16px 0px 0px 150px;margin: 0;background-color: transparent;border-radius: 0;">
                <li><a href="#"><i class="fa fa-user"></i> Người sử dụng</a></li>
                <li class="active">Danh Sách Học Bổng</li>
            </ol>
        </div>
    </div>
@stop

@section('content')
    <table class="table table-bordered table-striped" id="custom-table">
        <thead>
            <tr>
                <th>STT</th>
                <th>Mã Sinh Viên</th>
                <th>Tên Sinh Viên</th>
                <th>Lớp</th>
                <th>Điểm TB</th>
                <th>Học Bổng</th>
                <th>Năm Học</th>
                <th>Học Kỳ</th>
            </tr>
        </thead>
        <tbody>
            @php
                $rownum = 0;
            @endphp
            @foreach ($student as $st)
                <tr>
                    <td>{!! ++$rownum !!}</td>
                    <td>{{ $st->masv }}</td>
                    <td>{{ $st->hosv . ' ' . $st->tensv }}</td>
                    <td>{{ $st->tenlop }}</td>
                    <td>{{ $st->diemtb }}</td>
                    <td>
                        @if ($st->xetHB == 1)
                            Có
                        @else
                            Không
                        @endif
                    </td>
                    <td>{{ $st->namhoc }}</td>
                    <td>{{ $st->hocky }}</td>
                </tr>
            @endforeach
        </tbody>
    </table>
@stop

@section('js')
    <script src="{{ asset('js/studyresult.js') }}"></script>
    <script>
        function btnscholarship() {
            var hocky = $("#search_hocky").val();
            var namhoc = $("#search_namhoc").val();
            document.location.href = '/scholarship/' + namhoc + '/' + hocky + '/1'; // 1 đại diện cho "Có học bổng"
        }

        $(document).ready(function() {
            var table = $("#custom-table").DataTable({
                processing: true,
                autoWidth: true,
                searching: true,
                lengthMenu: [
                    [5, 10, 25, 50, -1],
                    [5, 10, 25, 50, 'Tất cả']
                ],
                language: {
                    "lengthMenu": "Hiển thị _MENU_ bản ghi",
                    "zeroRecords": "Không có bản ghi nào được tìm thấy",
                    "emptyTable": "Không có bản ghi nào được hiển thị",
                    "processing": "Đang xử lý",
                    "search": "Tìm kiếm",
                    "infoFiltered": "(được lọc từ tổng số _MAX_ mục nhập)",
                    "paginate": {
                        "first": "Đầu tiên",
                        "last": "Cuối cùng",
                        "next": "<i class='fa fa-chevron-right' aria-hidden='true'></i>",
                        "previous": "<i class='fa fa-chevron-left' aria-hidden='true'></i>"
                    },
                    "info": "Trình bày _START_ - _END_ trong số _TOTAL_ mục",
                    "infoEmpty": "Trình bày 0 - 0 trong 0 mục"
                }
            });
        });
    </script>
@stop
