<div class="modal fade update-category" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Thêm danh mục</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            {!! Form::open(['url' => route('category.update', ['id' => $category->id]), 'method' => 'post']) !!}
            <div class="modal-body">
                <div class="form-group">
                    <label for="title">Tên danh mục</label>
                    <input type="text" class="form-control" id="title" placeholder="Nhập tên danh mục" name="title" value="{{$category->title}}">
                </div>
                <div class="form-group">
                    <label for="index">Số thứ tự</label>
                    <input type="text" class="form-control" id="index" placeholder="Nhập số thứ tự" name="index"  value="{{$category->index}}">
                </div>

            </div>
            <div class="modal-footer">
                <button type="submit" class="btn btn-primary">Lưu</button>
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Đóng</button>
            </div>
            {!! Form::close() !!}

        </div>
    </div>
</div>
