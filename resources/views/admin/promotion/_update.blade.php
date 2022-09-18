<div class="modal fade update-promotion" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Cập nhật chương trình khuyễn mãi</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form action="{{route('promotion.update', ['id' => $promotion->id])}}" method="post">
                @csrf
                <div class="modal-body">
                    <div class="form-group">
                        <label for="title">Tên chươn trình</label>
                        <input type="text" class="form-control" id="title" placeholder="Nhập tên chương trình" name="title" value="{{$promotion->title}}">
                    </div>
                    <div class="form-group">
                        <label for="index">Điểm tích lũy</label>
                        <input type="text" class="form-control" id="index" placeholder="Nhập điểm tích lũy" name="point" value="{{$promotion->reward_point}}">
                    </div>

                </div>
                <div class="modal-footer">
                    <button type="submit" class="btn btn-primary">Lưu</button>
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Đóng</button>
                </div>
            </form>
        </div>
    </div>
</div>
