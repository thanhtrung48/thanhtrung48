@extends('layouts.admin')
@section('title', 'Tất cả danh mục sản phẩm')
@section('content')
      <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1>Tất Cả Sản Phẩm</h1>
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="{{route('admin.dashboard')}}">Bảng điều khiển</a></li>
              <li class="breadcrumb-item active">Tất cả sản phẩm</li>
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
              <button class="btn btn-sm btn-danger" type="submit"><i class="fas fa-ban"></i> Xoá</button>
            </div>
            <div class="col-md-6 text-right">
              <a href="{{route('product.index')}}" class="btn btn-sm btn-info">
                <i class="fas fa-sign-out-alt"></i> Quay về danh sách
              </a>
            </div>
          </div>
        </div>
        <div class="card-body">
          @includeIf('backend.message_alert')
          <table class="table table-bordered">
            <thead>
              <tr>
                <th style="width:20px"; class="text-center">#</th>
                <th style="width:90px"; class="text-center">Hình</th>
                <th>Tên danh mục</th>
                <th>Slug</th>
                <th>Ngày đăng</th>
                <th style="width:200px"; class="text-center">Chức năng</th>
                <th style="width:20px"; class="text-center">ID</th>
              </tr>
            </thead>
            <tbody>
              @foreach ($list_product as $product)
              <tr>
                <td class="text-center"><input type="checkbox"></td>
                <td><img class="img-fluid" src="{{asset('images/product/'.$product->image)}}" alt="{{$product->image}}"></td>
                <td>{{$product->name}}</td>
                <td>{{$product->slug}}</td>
                <td>{{$product->created_at}}</td>
                <td class="text-center">
                  <a href="{{route('product.restore', ['product'=>$product->id])}}" class="btn btn-sm btn-success">
                    <i class="far fa-window-restore"></i>
                  </a>
                  <a href="{{route('product.destroy', ['product'=>$product->id])}}" class="btn btn-sm btn-danger">
                    <i class="fas fa-trash-alt"></i>
                  </a>
                </td>
                <td class="text-center">{{$product->id}}</td>
              </tr>
              @endforeach
            </tbody>
          </table>
        </div>
        <!-- /.card-body -->
       
        <!-- /.card-footer-->
      </div>
      <!-- /.card -->

    </section>
    <!-- /.content -->
  </div>
  <!-- /.content-wrapper -->
@endsection