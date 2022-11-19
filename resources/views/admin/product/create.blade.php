@extends('layouts.admin')
@section('title', 'Thêm sản phẩm')
@section('content')
    <div class="page-header">
        <h3 class="page-title"> Thêm sản phẩm </h3>
        {{Breadcrumbs::render('admin.product.add')}}
    </div>
    <div class="card">
        <form action="{{route('product.store')}}" method="post">
        @csrf
        <div class="card-body">
                <div class="form-group">
                    <label for="">Tên sản phẩm</label>
                    <input type="text" name="name" class="form-control" placeholder="Nhập tên sản phẩm" value="{{old('name')}}">
                </div>
                <div class="form-group">
                    <label for="">Code</label>
                    <input type="text" name="code" class="form-control" placeholder="Nhập mã sản phẩm" value="{{old('code')}}">
                </div>

                <div class="form-group">
                    <label for="">Hình ảnh</label>

                    <div>
                        <img src="/assets/images/default.png" alt="" style="width: 150px; height: 150px" id="btn_file_add">
                        <input type="text" class="form-control d-none" id="file_name_add" name="thumbnail" placeholder="Tên file" value="{{old('thumbnail')}}">
                    </div>
{{--                    <div class="input-group">--}}
{{--                        <div class="input-group-prepend">--}}
{{--                            <button class="btn btn-default" id="btn_file_add" type="button">Chọn file</button>--}}
{{--                        </div>--}}
{{--                        <input type="text" class="form-control" id="file_name_add" name="thumbnail" placeholder="Tên file" value="{{old('thumbnail')}}">--}}
{{--                    </div>--}}
                </div>
                <div class="form-group">
                    <label for="">Danh mục</label>
                    {!! Form::select('category', $categories, null, ['class' => 'form-control', 'placeholder' => '--Chọn danh mục--']) !!}
                </div>
                <div class="form-group">
                    <label for="description">Mô tả</label>
                    <textarea name="description" id="description" class="form-control" rows="5" placeholder="Nhập mô tả">{!! old('description') !!}</textarea>
                </div>

                <div class="form-group">
                    <div id="classify">
                        <div class="d-flex justify-content-between wp-classify">
                            <div class="item-add">
                                Phân loại sản phẩm
                            </div>
                            <div class="item-add">
                                Giá bán
                            </div>
                            <div class="item-add">
                                Giá khuyến mại
                            </div>
                            <div class="item-add">
                                Kho hàng
                            </div>
                            <div class="item-add">
                                Hình ảnh
                            </div>
                            <div class="delete-item">

                            </div>
                        </div>
                        @include('admin.product._classify')
                    </div>
                    <div class="add-classify" onclick="addClassify()">
                        <i class="mdi mdi-plus-circle-outline mr-2"></i> <span style="font-size: 18px"> Thêm phân loại sản phẩm</span>
                    </div>
                </div>

                <div class="border-top mt-5 pt-3">
                    <a href="{{route('product.index')}}" class="btn btn-secondary">Hủy</a>
                    <button type="submit" class="btn btn-success">Hoàn thành</button>
                </div>
        </div>
        </form>

    </div>
@endsection

@section('script')
    <script src="https://cdn.ckeditor.com/ckeditor5/35.3.1/classic/ckeditor.js"></script>
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
                        $('#btn_file_add').attr('src', url)
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
                        $('#btn_file_add').attr('src', url)
                    });
                }
            })
        }

        function selectImg(obj) {
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
                        $(obj).val(url)
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
                        $('#btn_file_add').attr('src', url)
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
    <script>
        ClassicEditor
            .create( document.querySelector( '#description' ), {
                toolbar: [
                    'heading',
                    '|',
                    'bold',
                    'italic',
                    'underline',
                    'strikethrough',
                    'removeFormat',
                    '|',
                    'fontSize',
                    'fontFamily',
                    'fontBackgroundColor',
                    'fontColor',
                    '|',
                    'link',
                    'numberedList',
                    'bulletedList',
                    '|',
                    'indent',
                    'outdent',
                    'alignment',
                    'fontBackgroundColor',
                    'fontColor',
                    '|',
                    'CKFinder',
                    // 'imageUpload',
                    'blockQuote',
                    'insertTable',
                    'htmlEmbed',
                    'codeBlock',
                    '|',
                    'horizontalLine',
                    'pageBreak',
                    'mediaEmbed',
                    '|',
                    'specialCharacters',
                    '|',
                    'undo',
                    'redo'
                ],

                ckfinder:{
                    uploadUrl: '/ckfinder/connector?command=QuickUpload&type=Images&responseType=json',
                },
            } )
            .catch( error => {
                console.error( error );
            } );
    </script>
@stop
