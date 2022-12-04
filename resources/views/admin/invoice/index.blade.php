@extends('layouts.admin')
@section('title', 'Quản lý đặt hàng')
@section('content')
    <div class="page-header">
        <h3 class="page-title"> Quản lý đơn hàng </h3>
        {{Breadcrumbs::render('admin.invoice')}}
    </div>
    <div class="card">
        <div class="card-body">
            <div>
                {!! Form::open(['method' => 'get']) !!}
                <div class="row">
                    <div class="col-md-5">
                        <div class="form-group">
                            <input type="text" class="form-control" placeholder="Nhập tên khách hàng, số điện thoại hoặc mã đơn hàng..." value="{{request()->get('search')}}" name="search">
                        </div>
                    </div>
                    <div class="col-md-5">
                        <select name="status" id="" class="form-control">
                            <option value="">--Trạng thái đơn hàng--</option>
                            @foreach(config('core.statusInvoice') as $key => $status)
                            <option value="{{$key}}">{{$status}}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="col-md-2">
                        <button type="submit" class="btn btn-primary btn-fw d-flex align-items-center justify-content-center"> <i class="mdi mdi-magnify" style="font-size: 18px"></i> Tìm kiếm</button>
                    </div>
                </div>
                {!! Form::close() !!}
            </div>
        </div>
    </div>
    <div class="card mt-4">
        <div class="card-body">
            <div class="d-flex justify-content-end mb-3">
                <div class="d-flex justify-content-end mb-3">
                    <div>
                        <div class="dropdown">
                            <button class="btn btn-primary dropdown-toggle" type="button" id="dropdownMenuButton1" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"> Hành động </button>
                            <div class="dropdown-menu" aria-labelledby="dropdownMenuButton1" style="">
                                <a  class="dropdown-item px-3 d-flex align-items-center" href="{{route('invoice.create')}}"> <i class="mdi mdi-plus mr-2"></i> Tạo đơn mới</a>
                                <button type="button" class="dropdown-item px-3 d-flex align-items-center" onclick="deleteInvoice()"><i class="mdi mdi-delete mr-2"></i> Xóa đơn hàng</button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="table-responsive">
                <table class="table">
                    <thead>
                    <tr>
                        <th>
                            <input type="checkbox" class="" id="checkAll">
                        </th>
                        <th>Mã đơn hàng</th>
{{--                        <th>Hình ảnh</th>--}}
                        <th>Tên khách hàng</th>
                        <th>Tổng đơn hàng</th>
                        <th>Trạng thái</th>
                        <th>Ngày đặt</th>
                        <th style="width: 10px">Action</th>
                    </tr>
                    </thead>
                    <tbody>
                        @foreach($invoices as $invoice)
                           <tr>
                               <td>
                                   @if($invoice->status == \App\Models\Invoice::STATUS_PAID || $invoice->status == \App\Models\Invoice::STATUS_TRANSPORT)
                                       <input type="checkbox" class="" value="{{$invoice->id}}" disabled>
                                   @else
                                       <input type="checkbox" class="item-invoice" value="{{$invoice->id}}">
                                   @endif
                               </td>
                               <td class="text-nowrap">
                                   #{{$invoice->code}}
                               </td>
{{--                               <td class="text-nowrap">--}}
{{--                                   <img src="{{$invoice->thumbnail()}}" alt="" style="width: 60px; height: 60px">--}}
{{--                               </td>--}}
                               <td class="text-nowrap">
                                   {{$invoice->user->name}}
                               </td>
                               <td class="text-nowrap">{{number_format($invoice->total)}} đ</td>
                               <td class="text-nowrap">
                                   <div class="btn-group">
                                       <button type="button" class="btn btn-sm dropdown-toggle {{$invoice->statusColor()}}" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                           {!! $invoice->statusText() !!}
                                       </button>
                                        @if($invoice->status == \App\Models\Invoice::STATUS_PENDING || $invoice->status == \App\Models\Invoice::STATUS_TRANSPORT)
                                           <div class="dropdown-menu p-2">
                                               @if($invoice->status == \App\Models\Invoice::STATUS_PENDING || $invoice->status != \App\Models\Invoice::STATUS_TRANSPORT)
                                                   <a class="btn btn-primary btn-sm d-block mb-2" href="{{route('invoice.change', ['id' => $invoice->id, 'status' => 'transport'])}}">Đang giao hàng</a>
                                               @endif
                                               <a class="btn btn-success btn-sm d-block" href="{{route('invoice.change', ['id' => $invoice->id, 'status' => 'paid'])}}">Hoàn thành</a>
                                           </div>
                                       @endif
                                   </div>
                               </td>
                               <td class="text-nowrap">{{$invoice->created_at}}</td>
                               <td class="text-center cursor-pointer" onclick="detail({{$invoice->id}})"><i class="mdi mdi-eye"></i></td>
                           </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
            <div class="custom-paginate d-flex justify-content-end mt-3">
                {{$invoices->links()}}
            </div>
        </div>
    </div>
    <div id="show-detail-invoice">

    </div>
@endsection

@section('script')
    {!! Html::script(mix('js/notification.js')) !!}
    <script>
        $(document).ready(function () {
            $("#checkAll").click(function() {
                $(".item-invoice").prop("checked", this.checked);
            });

            $('.item-invoice').click(function() {
                if ($('.item-invoice:checked').length == $('.item-invoice').length) {
                    $('#checkAll').prop('checked', true);
                } else {
                    $('#checkAll').prop('checked', false);
                }
            });
        })


        function deleteInvoice() {
            var listInvoice = $('.item-invoice:checked').map(function () {
                return $(this).val()
            }).get()

            $.ajax({
                url: '/admin/invoice/delete',
                method: 'post',
                data: {
                    listInvoice: listInvoice,
                    _token: $('meta[name="csrf-token"]').attr('content')
                }
            }).done(function (res) {
                if(res.success) {
                    notification(res.message, 'success')
                    setTimeout(function () {
                        location.reload()
                    }, 1000)
                }else {
                    notification(res.message, 'error')
                }
            }).fail(function (xhr) {

            })
        }

        function detail(id) {
            $.ajax({
                url: `/admin/invoice/${id}/detail`,
                method: 'get',
            }).done(function (res) {
                $('#show-detail-invoice').html(res.data)
                $('#detailInvoice').modal('show')
            })
        }
    </script>
@stop

