<div class="wp-classify">
    <div class="mb-3">
          {{$product->name}} -- Loại: {{$classify->name}}
    </div>
    <div class="d-flex justify-content-between align-items-center">

        <div class="item-add d-none">
            <div class="form-group">
                <label for=""></label>
                <input type="text" name="product[]" class="form-control" value="{{$product->id}}">
            </div>
        </div>
        <div class="item-add">
            <div class="form-group">
                <label for="">Số lượng</label>
                <input type="number" name="amount[]" placeholder="Số lượng" class="form-control" value="1" >
            </div>
        </div>
        <div class="item-add">
            <div class="form-group">
                <label for="">Giá</label>
                <input type="text" name="price[]" placeholder="Giá" class="form-control" value="{{$classify->price}}" disabled>
            </div>
        </div>
        <div class="item-add">
            <div class="form-group">
                <label for="">Giá khuyến mại</label>
                <input type="text" name="sale_price[]" placeholder="Nhập giá khuyến mại" class="form-control" value="{{$classify->sale_price}}">
            </div>
        </div>

        <div class="item-add text-center">
            <div class="form-group">
                <label for="">Thành tiền</label>
                <div style="padding: 5px 0">
                    {{ number_format($classify->sale_price ?  $classify->sale_price : $classify->price) }} đ
                </div>
            </div>
        </div>
        <div class="delete-item mt-1" onclick="deleteItem(this)">
            <i class="mdi mdi-delete"></i>
        </div>

    </div>

</div>
