@extends('layouts.admin')
@section('content')
  <form action="{{route('category.store')}}" method="post" enctype="multipart/form-data">
    @csrf
    <div class="content-wrapper">
      <!-- Content Header (Page header) -->
      <section class="content-header">
        <div class="container-fluid">
          <div class="row mb-2">
            <div class="col-sm-6">
              <h1>Thêm Danh Mục</h1>
            </div>
            <div class="col-sm-6">
              <ol class="breadcrumb float-sm-right">
                <li class="breadcrumb-item"><a href="{{route('admin.dashboard')}}">Bảng điều khiển</a></li>
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
              <div class="col-md-6"></div>
              <div class="col-md-6 text-right">
                <button type="submit" class="btn btn-sm btn-success">
                  <i class="fas fa-save"></i> Lưu[Thêm]
                </button>
                <a href="{{route('category.index')}}" class="btn btn-sm btn-info">
                  <i class="fas fa-sign-out-alt"></i> Quay về danh sách
                </a>
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