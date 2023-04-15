@extends('layouts.admin')
@section('title', 'Chi tiết danh mục sản phẩm')
@section('content')
    <div class="content-wrapper">
      <!-- Content Header (Page header) -->
      <section class="content-header">
        <div class="container-fluid">
          <div class="row mb-2">
            <div class="col-sm-6">
              <h1>Chi Tiết Thương Hiệu</h1>
            </div>
            <div class="col-sm-6">
              <ol class="breadcrumb float-sm-right">
                <li class="breadcrumb-item"><a href="{{route('admin.dashboard')}}">Bảng điều khiển</a></li>
                <li class="breadcrumb-item active">Chi tiết thương hiệu</li>
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
                <a href="{{route('brand.edit', ['brand'=>$brand->id])}}" class="btn btn-sm btn-primary">
                  <i class="fas fa-edit"></i> Sửa 
                </a>
                <a href="{{route('brand.delete', ['brand'=>$brand->id])}}" class="btn btn-sm btn-danger">
                  <i class="fas fa-trash"></i> Xoá
                </a>
                <a href="{{route('brand.index')}}" class="btn btn-sm btn-info">
                  <i class="fas fa-sign-out-alt"></i> Quay về danh sách
                </a>
              </div>
            </div>
          </div>
          <div class="card-body">
            <table class="table">
              <tr>
                <th>Tên trường</th>
                <th>Giá trị</th>
              </tr>
              <tr>
                <td>Id</td>
                <td>{{$brand->id}}</td>
              </tr>
              <tr>
                <td>Name</td>
                <td>{{$brand->name}}</td>
              </tr>
              <tr>
                <td>Slug</td>
                <td>{{$brand->slug}}</td>
              </tr>
              <tr>
                <td>Image</td>
                <td>{{$brand->image}}</td>
              </tr>
            </table>
          </div>
          <!-- /.card-body -->
          
          <!-- /.card-footer-->
        </div>
        <!-- /.card -->
  
      </section>
      <!-- /.content -->
    </div>
@endsection