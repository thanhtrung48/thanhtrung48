<div class="row">
    <div class="col-md-9">
      <div class="mb-3">
        <label for="name">Tên sản phẩm</label>
        <input type="text" name="name" value="{{old('name')}}" id="name" class="form-control" 
        placeholder="Nhập tên sản phẩm">
        @if ($errors->has('name'))
            <div class="text-danger">
              {{$errors->first('name')}}
            </div>
        @endif
      </div>
      <div class="mb-3">
        <label for="detail">Chi tiết</label>
        <textarea name="detail" id="detail" class="form-control" 
        placeholder="chi tiết sản phẩm">{{old('detail')}}</textarea>
        @if ($errors->has('detail'))
            <div class="text-danger">
              {{$errors->first('detail')}}
            </div>
        @endif
      </div>
      <div class="mb-3">
        <label for="metakey">Từ khoá</label>
        <textarea name="metakey" id="metakey" class="form-control" 
        placeholder="Từ khoá tìm kiếm">{{old('metakey')}}</textarea>
        @if ($errors->has('metakey'))
            <div class="text-danger">
              {{$errors->first('metakey')}}
            </div>
        @endif
      </div>
      <div class="mb-3">
        <label for="metadesc">Mô tả</label>
        <textarea name="metadesc" id="metadesc" class="form-control" 
        placeholder="Nhập mô tả">{{old('metadesc')}}</textarea>
        @if ($errors->has('metadesc'))
            <div class="text-danger">
              {{$errors->first('metadesc')}}
            </div>
        @endif
      </div>
    </div>
    <div class="col-md-3">
      <div class="mb-3">
        <label for="category_id">Chọn danh mục</label>
        <select class="form-control" id="category_id" name="category_id">
          <option value="">--Chọn danh mục--</option>
          {!! $html_category_id!!}
        </select>
        @if ($errors->has('category_id'))
        <div class="text-danger">
          {{$errors->first('category_id')}}
        </div>
    @endif
      </div>
      <div class="mb-3">
        <label for="brand_id">Chọn thương hiệu</label>
        <select class="form-control" id="brand_id" name="brand_id">
          <option value="">--Chọn thương hiệu--</option>
          {!! $html_brand_id!!}
        </select>
        @if ($errors->has('brand_id'))
        <div class="text-danger">
          {{$errors->first('brand_id')}}
        </div>
    @endif
      </div>
      <div class="mb-3">
        <label for="price_buy">Giá bán</label>
        <input type="text" name="price_buy" value="{{old('price_buy')}}" id="price_buy" class="form-control" 
        placeholder="Giá bán">
        @if ($errors->has('price_buy'))
            <div class="text-danger">
              {{$errors->first('price_buy')}}
            </div>
        @endif
      </div>
      <div class="mb-3">
        <label for="status">Trạng thái</label>
        <select class="form-control" id="status" name="status">
          <option value="1">Xuất bản</option>
          <option value="2">Chưa xuất bản</option>
        </select>
      </div>
    </div>
  </div>