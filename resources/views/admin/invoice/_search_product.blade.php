<div class="border p-3 wp-search-product">
    @if(count($products) > 0)
        <div class="row  mb-3 border-bottom font-weight-bold" >
            <div class="col-md-3">
                <div class="img" >
                    Hình ảnh
                </div>
            </div>
            <div class="col-md-5">
                <div class="name" >
                    Tên sản phẩm
                </div>
            </div>
            <div class="col-md-2">
                <div class="phone" > Mã sản phẩm</div>
            </div>
            <div class="col-md-2 text-right">
                Chọn
            </div>
        </div>
        <div id="remove-select">
            @foreach($products as $product)
                <div class="row mb-2 item-search-product">
                    <div class="col-md-3">
                        <div class="img">
                            <img src="{{$product->thumbnail}}" alt=" {{$product->name}}" style="width: 50px; height: 50px">
                        </div>
                    </div>
                    <div class="col-md-5">
                        <div class="name" >
                            {{$product->name}}
                        </div>
                    </div>
                    <div class="col-md-2">
                        <div class="phone" >{{$product->code}}</div>
                    </div>
                    <div class="col-md-2 text-right">
                        <button class="btn btn-primary " onclick="renderClassify(this, {{$product->id}})">Chọn</button>
                    </div>
                </div>

            @endforeach
        </div>
    @else
        <div class="alert alert-warning m-0" role="alert">
            Không tìm thấy sản phẩm.
        </div>
    @endif
</div>
