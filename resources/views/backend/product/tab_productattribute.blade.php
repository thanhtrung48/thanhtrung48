<div class="row">
    <div class="col-md-6">
      <div class="mb-3">
        <label for="name">Tên thuộc tính</label>
        <input type="text" name="name" value="{{old('name')}}" id="name" class="form-control" 
        placeholder="Nhập tên sản phẩm">
        @if ($errors->has('name'))
            <div class="text-danger">
              {{$errors->first('name')}}
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
     
    <div class="col-md-6">
      <div class="mb-3">
        <label for="name">Giá trị</label>
        <input type="text" name="name" value="{{old('name')}}" id="name" class="form-control" 
        placeholder="Nhập tên sản phẩm">
        @if ($errors->has('name'))
            <div class="text-danger">
              {{$errors->first('name')}}
            </div>
        @endif
      </div>
      <div class="mb-3">
        <label for="name">Vị trí</label>
        <input type="text" name="name" value="{{old('name')}}" id="name" class="form-control" 
        placeholder="Nhập vị trí">
        @if ($errors->has('name'))
            <div class="text-danger">
              {{$errors->first('name')}}
            </div>
        @endif
      </div>
    </div>
  </div>