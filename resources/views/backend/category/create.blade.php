@extends('layouts.admin')
@section('title', 'Thêm danh mục sản phẩm')
@section('content')
<form action="{{route('category.store')}}" method="post">
  @csrf
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1>THÊM DANH MỤC</h1>
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="{{route('admin.dashboard')}}">BẢNG ĐIỀU KHIỂN</a></li>
              <li class="breadcrumb-item active">Thêm danh mục</li>
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
            <div class="col-md-6">
            </div>
            <div class="col-md-6 text-right">
              <button type="submit" class="btn btn-sm btn-success">
                <i class = "fas fa-save"></i> Lưu[Thêm]
              </button>
              <a href="{{route('category.index')}}" class="btn btn-sm btn-info">
              <i class = "fas fa-trash"></i> Quay về danh sách
              </a>
            </div>
          </div>
          </div>
        </div>
        <div class="card-body">
          @includeIf('backend.message_alert')
         <div class="row">
          <div class="col-md-9">
            <div class="mb-3">
              <label for="name">Tên danh mục</label>
              <input type="text" name="name" vlaue="{{old('name','')}}" id="name" class="from-control"
              placeholder="Nhập tên danh mục">
            </div>
            <div class="mb-3">
              <label for="name">Tên danh mục</label>
              <input type="text" name="name" vlaue="{{old('name','')}}" id="name" class="from-control"
              placeholder="Nhập tên danh mục">
            </div>
         </div>
        </div>
        
        <!-- /.card-body -->
        <div class="card-footer">
        
        </div>
        <!-- /.card-footer-->
      </div>
      <!-- /.card -->

    </section>
    <!-- /.content -->
  </div>
</form>
@endsection