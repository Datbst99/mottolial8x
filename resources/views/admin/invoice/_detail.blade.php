<!-- Modal -->
<div class="modal fade" id="detailInvoice" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Chi tiết đơn hàng</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
               <div class="border-bottom">
                   <div class="modal-title font-weight-bold mb-2">
                       Thông tin khách hàng
                   </div>
                   <div class="row">
                       <div class="col-md-6">
                           <div class="information-user">
                               <div class="text-show">
                                   Mã đơn hàng
                               </div>
                               <div class="text-user">
                                   #{{$invoice->code}}
                               </div>
                           </div>
                       </div>
                       <div class="col-md-6">
                           <div class="information-user">
                               <div class="text-show">
                                   Trạng thái:
                               </div>
                               <div class="text-user">
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
                               </div>
                           </div>
                       </div>
                       <div class="col-md-6">
                           <div class="information-user">
                               <div class="text-show">
                                   Điện thoại:
                               </div>
                               <div class="text-user">
                                   {{ $invoice->user->phone}}
                               </div>
                           </div>
                       </div>
                       <div class="col-md-6">
                           <div class="information-user">
                               <div class="text-show">
                                   Tên:
                               </div>
                               <div class="text-user">
                                   {{ $invoice->user->name}}
                               </div>
                           </div>
                       </div>
                       <div class="col-md-6">
                           <div class="information-user">
                               <div class="text-show">
                                   Tỉnh/Quận-Huyện/Phường-Xã:
                               </div>
                               <div class="text-user">
                                   {{ $invoice->user->address}}
                               </div>
                           </div>
                       </div>
                       <div class="col-md-6">
                           <div class="information-user">
                               <div class="text-show">
                                   Địa chỉ:
                               </div>
                               <div class="text-user">
                                   {{ $invoice->user->detail_address}}
                               </div>
                           </div>
                       </div>
                       <div class="col-md-6">
                           <div class="information-user">
                               <div class="text-show">
                                   Điểm tích lũy:
                               </div>
                               <div class="text-user">
                                   {{$invoice->user->reward_point}}
                               </div>
                           </div>
                       </div>
                       <div class="col-md-6">
                           <div class="information-user">
                               <div class="text-show">
                                   Khuyến mại:
                               </div>
                               <div class="text-user">
                                   {!! $invoice->user->promotionUser()!!}
                               </div>
                           </div>
                       </div>
                   </div>
               </div>
                <div >
                    <div class="modal-title font-weight-bold  my-3">
                        Thông tin đơn hàng
                    </div>
                    <div class="table-responsive">
                        <table class="table">
                            <thead>
                            <tr>

                                <th>Hình ảnh</th>
                                <th>Tên sản phẩm</th>
                                <th>Số lượng</th>
                                <th>Giá</th>
                                <th>Thành tiền</th>
                                <th>Điểm tích lũy</th>

                            </tr>
                            </thead>
                            <tbody>
                                @foreach($invoice->classify as $classify)
                                    <tr>
                                        <td class="text-nowrap">
                                            <img src="{{$classify->product->thumbnail}}" alt="" style="width: 50px; height: 50px">
                                        </td>
                                        <td class="text-nowrap">
                                            {{$classify->product->name}}
                                        </td>
                                        <td class="text-nowrap">
                                            {{$classify->amount}}
                                        </td>
                                        <td class="text-nowrap">
                                            {{number_format($classify->price)}}đ
                                        </td>
                                        <td class="text-nowrap">
                                            {{number_format($classify->total)}}đ
                                        </td>
                                        <td class="text-nowrap">
                                            {{$classify->point}}
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
