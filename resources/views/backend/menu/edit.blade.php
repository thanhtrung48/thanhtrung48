@extends('layouts.admin')
@section('title', 'Cập nhật menu')
@section('content')
  <form action="{{route('menu.update', ['menu'=>$menu->id]) }}" method="post" >
    @method('PUT')
    @csrf
    <div class="content-wrapper">
      <!-- Content Header (Page header) -->
      <section class="content-header">
        <div class="container-fluid">
          <div class="row mb-2">
            <div class="col-sm-6">
              <h1>Cập Nhật Menu</h1>
            </div>
            <div class="col-sm-6">
              <ol class="breadcrumb float-sm-right">
                <li class="breadcrumb-item"><a href="{{route('admin.dashboard')}}">Bảng điều khiển</a></li>
                <li class="breadcrumb-item active">Cập nhật menu</li>
              </ol>
            </div>
          </div>
        </div><!-- /.container-fluid -->
      </section>
  
      <!-- Main content -->
      <section class="content">
  
        <!-- Default box -->
        <div class="card">
          <div class="card-header">
            <div class="row">
              <div class="col-md-6"></div>
              <div class="col-md-6 text-right">
                <button type="submit" class="btn btn-sm btn-success">
                  <i class="fas fa-save"></i> Lưu[Cập nhật]
                </button>
                <a href="{{route('menu.index')}}" class="btn btn-sm btn-info">
                  <i class="fas fa-sign-out-alt"></i> Quay về danh sách
                </a>
              </div>
            </div>
          </div>
          <div class="card-body">
            @includeIf('backend.message_alert')
            <div class="row">
              <div class="col-md-12">
                @if ($menu->type !='custom')
                <div class="mb-3">
                  <label for="name">Tên menu</label>
                  <input type="text" name="name" readonly value="{{old('name',$menu->name)}}" id="name" class="form-control" 
                  placeholder="Nhập tên menu">
                  @if ($errors->has('name'))
                      <div class="text-danger">
                        {{$errors->first('name')}}
                      </div>
                  @endif
                </div>
                <div class="mb-3">
                  <label for="link">Liên kết</label>
                  <input type="text" name="link" readonly value="{{old('link',$menu->link)}}" id="link" class="form-control" 
                  placeholder="Nhập liên kết">
                  @if ($errors->has('link'))
                      <div class="text-danger">
                        {{$errors->first('link')}}
                      </div>
                  @endif
                </div>
                @else
                <div class="mb-3">
                  <label for="name">Tên menu</label>
                  <input type="text" name="name" value="{{old('name',$menu->name)}}" id="name" class="form-control" 
                  placeholder="Nhập tên menu">
                  @if ($errors->has('name'))
                      <div class="text-danger">
                        {{$errors->first('name')}}
                      </div>
                  @endif
                </div>
                <div class="mb-3">
                  <label for="link">Liên kết</label>
                  <input type="text" name="link" value="{{old('link',$menu->link)}}" id="link" class="form-control" 
                  placeholder="Nhập liên kết">
                  @if ($errors->has('link'))
                      <div class="text-danger">
                        {{$errors->first('link')}}
                      </div>
                  @endif
                </div>
                @endif
                
              </div>
              <div class="col-md-3">
                <div class="mb-3">
                  <label for="parent_id">Menu cấp cha</label>
                  <select class="form-control" id="parent_id" name="parent_id">
                    <option value="0">--Cấp cha--</option>
                    {!! $html_parent_id !!}
                  </select>
                </div>
                <div class="mb-3">
                  <label for="sort_order">Vị trí sắp xếp</label>
                  <select class="form-control" id="sort_order" name="sort_order">
                    <option value="0">--Vị trí sắp xếp--</option>
                    {!! $html_sort_order !!}
                  </select>
                </div>
                <div class="mb-3">
                  <label for="status">Trạng thái</label>
                  <select class="form-control" id="status" name="status">
                    <option value="1"{{($menu->status==1)?'selected':''}}>Xuất bản</option>
                    <option value="2"{{($menu->status==1)?'selected':''}}>Chưa xuất bản</option>
                  </select>
                </div>
              </div>
            </div>
          </div>
          <!-- /.card-body -->
        
          <!-- /.card-footer-->
        </div>
        <!-- /.card -->
  
      </section>
      <!-- /.content -->
    </div>
  </form>
@endsection