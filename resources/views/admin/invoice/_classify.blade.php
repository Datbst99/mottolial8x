<div class="form-group">
    <label for="title">Chọn loại sản phẩm</label>
    <select name="classifyProduct" id="" class="select-classify form-control" style="width: 100%">
        <option value="" selected disabled>--Chọn loại sản phẩm--</option>
        @foreach($classifies as $classify)
            <option value="{{$classify->id}}">{{$classify->name}}</option>
        @endforeach
    </select>

</div>
