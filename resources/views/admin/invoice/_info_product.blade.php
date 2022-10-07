<div class="wp-classify">
    <div class="mb-3">
          {{$product->name}} -- Loại: {{$classify->name}}
    </div>
    <div class="d-flex justify-content-between align-items-center item-order">

        <div class="item-add d-none">
            <div class="form-group">
                <label for=""></label>
                <input type="text" name="classify[{{$product->id}}]" class="form-control" value="{{$classify->id}}">
            </div>
        </div>
        <div class="item-add">
            <div class="form-group">
                <label for="">Số lượng</label>
                <input type="number" name="amount[{{$product->id}}]" placeholder="Số lượng" class="form-control amount-product" value="1" onchange="configPrice(this, 'amount')">
            </div>
        </div>
        <div class="item-add">
            <div class="form-group">
                <label for="">Giá</label>
                <input type="text" name="price[{{$product->id}}]" placeholder="Giá" class="form-control price-product disabled" value="{{$classify->price}}" >
            </div>
        </div>
        <div class="item-add">
            <div class="form-group">
                <label for="">Giá khuyến mại</label>
                <input type="text" name="sale_price[{{$product->id}}]" placeholder="Nhập giá khuyến mại" class="form-control sale-price" value="{{$classify->sale_price}}" onchange="configPrice(this, 'sale')">
            </div>
        </div>

        <div class="item-add text-center">
            <div class="form-group">
                <label for="">Thành tiền</label>
                <div style="padding: 5px 0" id="total-price">
                    {{ number_format($classify->sale_price ?  $classify->sale_price : $classify->price) }} đ
                </div>
            </div>
        </div>
        <div class="delete-item mt-1" onclick="deleteItem(this)">
            <i class="mdi mdi-delete"></i>
        </div>

    </div>

</div>
