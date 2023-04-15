@extends('layouts.site')
@section('title','Trang Chủ')
@section('content')


<section>
    <div class="container">
        <div class="row">
            <div class="col-sm-2">
                <div class="left-sidebar">
                    <h2>Category</h2>
                    <div class="panel-group category-products" id="accordian">
                        <div class="panel panel-default">
                            <div class="panel-heading">
                                <h4 class="panel-title">
                                    <a data-toggle="collapse" data-parent="#accordian" href="#ao">
                                        <span class="badge pull-right"><i class="fa fa-plus"></i></span>
                                        Áo thể thao
                                    </a>
                                </h4>
                            </div>
                            <div id="ao" class="panel-collapse collapse">
                                <div class="panel-body">
                                    <ul>
                                        <li><a href="#">Nike </a></li>
                                        <li><a href="#">Adidas </a></li>
                                        <li><a href="#">Puma</a></li>
                                    </ul>
                                </div>
                            </div>
                        </div>
                        <div class="panel panel-default">
                            <div class="panel-heading">
                                <h4 class="panel-title">
                                    <a data-toggle="collapse" data-parent="#accordian" href="#giay">
                                        <span class="badge pull-right"><i class="fa fa-plus"></i></span>
                                        Giày Đá Bóng
                                    </a>
                                </h4>
                            </div>
                            <div id="giay" class="panel-collapse collapse">
                                <div class="panel-body">
                                    
                                    <h4 class="shoes-title">
                                        <a>
                                            Nike
                                        </a>
                                        <ul>
                                        <li><a href="#">Mizuno</a></li>
                                        <li><a href="#">Mecurius</a></li>
                                        </ul>
                                    </h4>
                                    <h4 class="shoes-title">
                                        <a>
                                            Adidas
                                        </a>
                                        <ul>
                                        <li><a href="#">Mizuno</a></li>
                                        <li><a href="#">Mecurius</a></li>
                                        </ul>
                                    </h4>
                                    <h4 class="shoes-title">
                                        <a>
                                            Puma
                                        </a>
                                        <ul>
                                        <li><a href="#">Mizuno</a></li>
                                        <li><a href="#">Mecurius</a></li>
                                        </ul>
                                    </h4>
                                </div>
                            </div>
                        </div>							
                    </div><!--/category-products-->
                </div>
            </div>
            
            <div class="col-sm-10 padding-right">
                <div class="features_items">
                    <h2 class="title text-center">Sản Phẩm</h2>
                    <div class="col-sm-4">
                        <div class="product-image-wrapper">
                            <div class="single-products">
                                    <div class="productinfo text-center">
                                        <img src="images/home/aothun2.jpg" alt="" />
                                        <h2>240000</h2>
                                        <p>Áo thun thể thao nike</p>
                                        <a href="#" class="btn btn-default add-to-cart"><i class="fa fa-shopping-cart"></i>Add to cart</a>
                                    </div>
                                    <div class="product-overlay">
                                        <div class="overlay-content">
                                            <h2>240000</h2>
                                            <p>Áo thun thể thao nike</p>
                                            <a href="#" class="btn btn-default add-to-cart"><i class="fa fa-shopping-cart"></i>Add to cart</a>
                                        </div>
                                    </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-sm-4">
                        <div class="product-image-wrapper">
                            <div class="single-products">
                                <div class="productinfo text-center">
                                    <img src="images/home/aothun3.jpg" alt="" />
                                    <h2>400000</h2>
                                    <p>Áo thun thể thao nike</p>
                                    <a href="#" class="btn btn-default add-to-cart"><i class="fa fa-shopping-cart"></i>Add to cart</a>
                                </div>
                                <div class="product-overlay">
                                    <div class="overlay-content">
                                        <h2>400000</h2>
                                        <p>Áo thun thể thao nike</p>
                                        <a href="#" class="btn btn-default add-to-cart"><i class="fa fa-shopping-cart"></i>Add to cart</a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-sm-4">
                        <div class="product-image-wrapper">
                            <div class="single-products">
                                <div class="productinfo text-center">
                                    <img src="images/home/aothunadidas1.png" alt="" />
                                    <h2>340000</h2>
                                    <p>Easy Polo Black Edition</p>
                                    <a href="#" class="btn btn-default add-to-cart"><i class="fa fa-shopping-cart"></i>Add to cart</a>
                                </div>
                                <div class="product-overlay">
                                    <div class="overlay-content">
                                        <h2>340000</h2>
                                        <p>Easy Polo Black Edition</p>
                                        <a href="#" class="btn btn-default add-to-cart"><i class="fa fa-shopping-cart"></i>Add to cart</a>
                                    </div>
                                </div>
                                <img src="images/home/new.png" class="new" alt="" />
                            </div>
                        </div>
                    </div>
                    <div class="col-sm-4">
                        <div class="product-image-wrapper">
                            <div class="single-products">
                                <div class="productinfo text-center">
                                    <img src="images/home/balo.png" style="max-width:230px;" alt="" />
                                    <h2>340000</h2>
                                    <p>Easy Polo Black Edition</p>
                                    <a href="#" class="btn btn-default add-to-cart"><i class="fa fa-shopping-cart"></i>Add to cart</a>
                                </div>
                                <div class="product-overlay">
                                    <div class="overlay-content">
                                        <h2>340000</h2>
                                        <p>Easy Polo Black Edition</p>
                                        <a href="#" class="btn btn-default add-to-cart"><i class="fa fa-shopping-cart"></i>Add to cart</a>
                                    </div>
                                </div>
                                <img src="images/home/new.png" class="new" alt="" />
                            </div>
                        </div>
                    </div>

                    <div class="col-sm-4">
                        <div class="product-image-wrapper">
                            <div class="single-products">
                                <div class="productinfo text-center">
                                    <img src="images/home/giaymizuno.png" alt="" />
                                    <h2>210000</h2>
                                    <p>Easy Polo Black Edition</p>
                                    <a href="#" class="btn btn-default add-to-cart"><i class="fa fa-shopping-cart"></i>Add to cart</a>
                                </div>
                                <div class="product-overlay">
                                    <div class="overlay-content">
                                        <h2>210000</h2>
                                        <p>Easy Polo Black Edition</p>
                                        <a href="#" class="btn btn-default add-to-cart"><i class="fa fa-shopping-cart"></i>Add to cart</a>
                                    </div>
                                </div>
                                <img src="images/home/sale.png" class="new" alt="" />
                            </div>
                        </div>
                    </div>
            
                    
                </div><!--features_items-->
                
                <div class="category-tab"><!--category-tab-->
                    <div class="col-sm-12">
                        <ul class="nav nav-tabs">
                            <li class="active"><a data-toggle="tab">Sale</a></li>
                        </ul>
                    </div>
                    <div class="tab-content">
                        <div class="tab-pane fade active in" id="sale" >
                            <div class="col-sm-3">
                                <div class="product-image-wrapper">
                                    <div class="single-products">
                                        <div class="productinfo text-center">
                                            <img src="images/home/aokhoacnike.jpg" alt="" />
                                            <h2>200000</h2>
                                            <p>Easy Polo Black Edition</p>
                                            <a href="#" class="btn btn-default add-to-cart"><i class="fa fa-shopping-cart"></i>Add to cart</a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-sm-3">
                                <div class="product-image-wrapper">
                                    <div class="single-products">
                                        <div class="productinfo text-center">
                                            <img src="images/home/giaymizuno.png" alt="" />
                                            <h2>210000</h2>
                                            <p>Mizuno </p>
                                            <a href="#" class="btn btn-default add-to-cart"><i class="fa fa-shopping-cart"></i>Add to cart</a>
                                        </div>
                                        
                                    </div>
                                </div>
                            </div>
                            <div class="col-sm-3">
                                <div class="product-image-wrapper">
                                    <div class="single-products">
                                        <div class="productinfo text-center">
                                            <img src="images/home/gangtay.png" alt="" />
                                            <h2>450000</h2>
                                            <p>Găng tay  </p>
                                            <a href="#" class="btn btn-default add-to-cart"><i class="fa fa-shopping-cart"></i>Add to cart</a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
@endsection
