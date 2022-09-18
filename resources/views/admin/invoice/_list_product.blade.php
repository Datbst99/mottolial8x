<div class="modal fade list-product" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Chọn sản phẩm</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <div class="form-group">
                    <label for="title">Chọn sản phẩm</label>
                    <select name="selectProduct" id="" class="select-product" style="width: 100%" onchange="renderClassify()">
                        <option value="" selected disabled>--Chọn sản phẩm--</option>
                        @foreach($products as $product)
                            <option value="{{$product->id}}">{{$product->name}}</option>
                        @endforeach
                    </select>

                </div>
                <div id="selectClassify">

                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-primary" onclick="loadProduct()">Lưu</button>
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Đóng</button>
            </div>

        </div>
    </div>
</div>
