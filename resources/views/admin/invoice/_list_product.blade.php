<div class="modal fade list-product" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Chọn sản phẩm</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body" style="min-height: 200px">
                <div class="form-group">
                    <label for="title">Tìm kiếm sản phẩm</label>
                    <input type="text" class="form-control" name="classifyProduct" placeholder="Nhập tên sản phẩm hoặc mã sản phẩm..." onchange="searchProduct(this)">

                </div>
                <div id="show-search-product" class="mb-3">

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
