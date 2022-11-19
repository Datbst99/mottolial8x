<div class="d-flex justify-content-between wp-classify">
    <div class="item-add">
        <input type="text" name="classifyName[]" placeholder="Nhập tên phân loại" class="form-control">
    </div>
    <div class="item-add">
        <input type="number" name="price[]" placeholder="Nhập giá sản phẩm" class="form-control">
    </div>
    <div class="item-add">
        <input type="number" name="sale_price[]" placeholder="Nhập giá khuyến mại" class="form-control">
    </div>
    <div class="item-add">
        <input type="number" name="amount[]" placeholder="Số lượng" class="form-control">
    </div>
    <div class="item-add">
        <input type="text" name="images[]" placeholder="Hình ảnh sản phẩm" class="form-control" onclick="selectImg(this)">
    </div>
    <div class="delete-item" onclick="deleteItem(this)">
        <i class="mdi mdi-delete"></i>
    </div>
</div>
