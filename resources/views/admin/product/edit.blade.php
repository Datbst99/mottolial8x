@extends('layouts.admin')
@section('title', 'Cập nhật sản phẩm')
@section('content')
    <div class="page-header">
        <h3 class="page-title"> Cập nhật sản phẩm </h3>
        {{Breadcrumbs::render('admin.product.edit')}}
    </div>
    <div class="card">
        <form action="{{route('product.update', ['id' => $product->id])}}" method="post">
            @csrf
            <div class="card-body">
                <div class="form-group">
                    <label for="">Tên sản phẩm</label>
                    <input type="text" name="name" class="form-control" placeholder="Nhập tên sản phẩm" value="{{$product->name}}">
                </div>
                <div class="form-group">
                    <label for="">Code</label>
                    <input type="text" name="code" class="form-control" placeholder="Nhập mã sản phẩm" value="{{$product->code}}">
                </div>
                <div class="form-group">
                    <label for="description">Mô tả</label>
                    <textarea name="description" id="description" class="form-control" rows="5" placeholder="Nhập mô tả" > {{$product->description}} </textarea>
                </div>
                <div class="form-group">
                    <label for="">Hình ảnh</label>
                    <div class="input-group">
                        <div class="input-group-prepend">
                            <button class="btn btn-default" id="btn_file_add" type="button">Chọn file</button>
                        </div>
                        <input type="text" class="form-control" id="file_name_add" name="thumbnail" placeholder="Tên file" value="{{$product->thumbnail}}">
                    </div>
                </div>
                <div class="form-group">
                    <label for="">Danh mục</label>
                    {!! Form::select('category', $categories, $product->category_id, ['class' => 'form-control', 'placeholder' => '--Chọn danh mục--']) !!}
                </div>
                <div class="form-group">
                    <label for="">Phân loại sản phẩm</label>
                    <div id="classify">
                        @foreach($product->classify as $classify)
                            <div class="d-flex justify-content-between wp-classify">
                                <div class="item-add">
                                    <input type="text" name="classifyName[]" placeholder="Nhập tên phân loại" class="form-control" value="{{$classify->name}}">
                                </div>
                                <div class="item-add">
                                    <input type="text" name="price[]" placeholder="Nhập giá sản phẩm" class="form-control" value="{{$classify->price}}">
                                </div>
                                <div class="item-add">
                                    <input type="text" name="sale_price[]" placeholder="Nhập giá khuyến mại" class="form-control" value="{{$classify->sale_price}}">
                                </div>
                                <div class="item-add">
                                    <input type="number" name="amount[]" placeholder="Số lượng" class="form-control" value="{{$classify->amount}}">
                                </div>
                                <div class="delete-item" onclick="deleteItem(this)">
                                    <i class="mdi mdi-delete"></i>
                                </div>
                            </div>
                        @endforeach
                    </div>
                    <div class="add-classify" onclick="addClassify()">
                        <i class="mdi mdi-plus-circle-outline mr-2"></i> <span style="font-size: 18px"> Thêm phân loại sản phẩm</span>
                    </div>
                </div>

                <div class="border-top mt-5 pt-3">
                    <a href="{{route('product.index')}}" class="btn btn-secondary">Hủy</a>
                    <button type="submit" class="btn btn-success">Cập nhật</button>
                </div>
            </div>
        </form>

    </div>
@endsection

@section('script')
    {!! Html::script('/assets/vendors/ckfinder/ckfinder.js') !!}
    <script>
        var button1 = document.getElementById('btn_file_add');
        button1.onclick = function() {
            selectFileWithCKFinder('file_name_add');
        };

        function selectFileWithCKFinder( elementId ) {
            CKFinder.modal({
                chooseFiles: true,
                width: 800,
                height: 600,
                onInit: function (finder) {
                    finder.on('files:choose', function (evt) {
                        var url = '';
                        for (i = 0; i < evt.data.files.models.length; i++) {
                            var file = evt.data.files.models[i];
                            var tempurl = file.getUrl();
                            url += tempurl;
                        }
                        var output = document.getElementById(elementId);
                        output.value = url;
                    });
                    finder.on('file:choose:resizedImage', function (evt) {
                        var url = '';
                        for (i = 0; i < evt.data.files.models.length; i++) {
                            var file = evt.data.files.models[i];
                            var tempurl = file.getUrl();
                            url += tempurl;
                        }
                        var output = document.getElementById(elementId);
                        output.value = url;
                    });
                }
            })
        }

        function addClassify() {
            $.ajax({
                url: '/admin/product/classify',
                method: 'post',
                data: {
                    _token: $('meta[name="csrf-token"]').attr('content')
                }
            }).done(function (res) {
                $('#classify').append(res.data)
            }).fail(function (xhr) {
                console.log(xhr)
            })
        }

        function deleteItem(obj){
            var count = $('.delete-item').parent('.wp-classify').length
            if(count > 1) {
                $(obj).parent().remove()
            }
        }

    </script>
@stop
