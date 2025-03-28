@extends('adminlte::page')
@section('title', 'Danh sách kết quả')
@section('content_header')
    <div class="row">
        <div class="col-md-8">
            <div class="btn btn-flat fix-box" style="margin: 0;padding: 0 0 0 12px;">
                <select name="search_lopid" id="search_lopid" class="form-control">
                    @foreach (App\Models\Lop::pluck('malop', 'id')->all() as $key => $val)
                        <option value="{{ $key }}" @if ($key == $lopid) selected @endif>
                            {{ $val }}</option>
                    @endforeach
                </select>
                <select name="search_namhoc" id="search_namhoc" class="form-control">
                    @foreach (\Illuminate\Support\Facades\DB::table('hockys')->pluck('namhoc', 'namhoc')->all() as $key => $val)
                        <option value="{{ $key }}" @if ($key == $namhoc) selected @endif>
                            {{ $val }}</option>
                    @endforeach
                </select>
                <select name="search_hocky" id="search_hocky" class="form-control">
                    @foreach (\Illuminate\Support\Facades\DB::table('hockys')->pluck('hocky', 'hocky')->all() as $key => $val)
                        <option value="{{ $key }}" @if ($key == $hocky) selected @endif>
                            {{ $val }}</option>
                    @endforeach
                </select>
                <button name="btnstudyresult" onclick="btnstudyresult()" class="btn bg-teal btn-flat">Duyệt</button>
            </div>
        </div>
        <div class="col-md-4">
            <ol class="breadcrumb"
                style="padding: 16px 0px 0px 150px;margin: 0;background-color: transparent;border-radius: 0;">
                <li><a href="#"><i class="fa fa-user"></i> Người sử dụng</a></li>
                <li class="active">Danh Sách</li>
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
                <th>Điểm Tổng</th>
                <th>Điểm Rèn Luyện</th>
                <th>Học lực</th>
                <th>Lên lớp</th>
                <th>Xét HB</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($student as $index => $st)
                @php
                    $diemRecord = $diem->where('idsv', $st->idsv)->first();
                    $diemtong = $diemRecord ? $diemRecord->diemtong : null;
                    $lenLop = $diemtong !== null && $diemtong > 5 ? 'Được' : 'Không';
                    $xetHB = $diemtong !== null && $diemtong > 8 ? 'Có' : 'Không';
                    $hocLuc =
                        $diemtong !== null
                            ? ($diemtong >= 8
                                ? 'Giỏi'
                                : ($diemtong >= 7
                                    ? 'Khá'
                                    : ($diemtong >= 6
                                        ? 'Trung Bình Khá'
                                        : ($diemtong >= 5
                                            ? 'Trung bình'
                                            : 'Yếu'))))
                            : 'Chưa xếp loại';
                @endphp
                <tr data-lopid="{{ $lopid }}" data-namhoc="{{ $namhoc }}" data-hocky="{{ $hocky }}">
                    <td>{{ $index + 1 }}</td>
                    <td>{{ $st->masv }}</td>
                    <td>{{ $st->hosv . ' ' . $st->tensv }}</td>
                    <td>{{ $diemtong !== null ? number_format($diemtong, 2) : 'N/A' }}</td>
                    <td @can('admin') contenteditable="true" onBlur="diemrl('{{ $st->idsv }}', this)" @endcan>
                        {{ $st->diemrl }}
                    </td>
                    <td>{{ $hocLuc }}</td>
                    <td>{{ $lenLop }}</td>
                    <td>{{ $xetHB }}</td>
                </tr>
            @endforeach
        </tbody>
    </table>
@stop

@section('js')
    <script src="{{ asset('js/studyresult.js') }}"></script>
    <script>
        function hocbong(svid, hb) {
            var url = "{{ route('scholarship.hocbong') }}";
            var hocky = $("#search_hocky").val();
            $.ajax({
                url: url,
                type: "POST",
                data: {
                    svid: svid,
                    hocbong: hb,
                    hocky: hocky
                },
                success: function(data) {
                    if (data.error == 0) {
                        toastr.success(data.message, 'Thông Báo!', {
                            closeButton: true
                        });
                    } else {
                        toastr.error(data.message, 'Thông Báo!', {
                            closeButton: true
                        });
                    }
                },
                error: function(data) {}
            });
        }

        @can('admin')
            function diemrl(svid, diemrl) {
                var url = "{{ route('studyresult.diemrl') }}";
                var hocky = $("#search_hocky").val();
                $.ajax({
                    url: url,
                    type: "POST",
                    data: {
                        svid: svid,
                        diemrl: diemrl.innerHTML,
                        hocky: hocky
                    },
                    success: function(data) {
                        if (data.error == 0) {
                            toastr.success(data.message, 'Thông Báo!', {
                                closeButton: true
                            });
                        } else {
                            toastr.error(data.message, 'Thông Báo!', {
                                closeButton: true
                            });
                            $(diemrl).html(" ");
                        }
                    },
                    error: function(data) {}
                });
            }
        @endcan

        function btnstudyresult() {
            var lopid = $("#search_lopid").val();
            var hocky = $("#search_hocky").val();
            var namhoc = $("#search_namhoc").val();
            document.location.href = '/studyresult/' + lopid + '/' + namhoc + '/' + hocky;
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

            $('#search_lopid, #search_namhoc, #search_hocky').on('change', function() {
                var lopid = $("#search_lopid").val();
                var namhoc = $("#search_namhoc").val();
                var hocky = $("#search_hocky").val();
                table.rows().every(function() {
                    var row = this.node();
                    var rowLopid = $(row).data('lopid');
                    var rowNamhoc = $(row).data('namhoc');
                    var rowHocky = $(row).data('hocky');
                    if ((lopid == rowLopid || lopid === '') &&
                        (namhoc == rowNamhoc || namhoc === '') &&
                        (hocky == rowHocky || hocky === '')) {
                        $(row).show();
                    } else {
                        $(row).hide();
                    }
                });
            });
        });
    </script>
@stop
