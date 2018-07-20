@extends('master')
@section('content')

    <div class="container">
        <div id="content" class="space-top-none">
            <div class="main-content">
                <div class="space60">&nbsp;</div>
                <div class="row">
                    <div class="col-sm-12">
                        <div class="beta-products-list">
                            <h4>Tìm kiếm</h4>
                            <div class="beta-products-details">
                                <p class="pull-left">Tìm được {{count($products)}} sản phẩm</p>
                                <div class="clearfix"></div>
                            </div>

                            <div class="row">
                                @foreach($products as $new_product)
                                    <div class="col-sm-3" style="width: 280px; height: 450px">
                                        <div class="single-item">
                                            @if(!empty($new_product->promotion_price))
                                                <div class="ribbon-wrapper"><div class="ribbon sale">Sale</div></div>
                                            @endif
                                            <div class="single-item-header">
                                                <a href="{{route('chitietsanpham', $new_product->id)}}"><img style="width: 270px; height: 320px" src="source/image/product/{{$new_product->image}}" alt=""></a>
                                            </div>
                                            <div class="single-item-body">
                                                <p class="single-item-title">{{$new_product->name}}</p>
                                                @if(!empty($new_product->promotion_price))
                                                    <p class="single-item-price">
                                                        <span class="flash-del">{{number_format($new_product->unit_price)}} đồng</span>
                                                        <span class="flash-sale">{{number_format($new_product->promotion_price)}} đồng</span>
                                                    </p>
                                                @else
                                                    <p class="single-item-price">
                                                        <span class="flash-sale">{{number_format($new_product->unit_price)}} đồng</span>
                                                    </p>
                                                @endif
                                            </div>
                                            <div class="single-item-caption">
                                                <a class="add-to-cart pull-left" href="{{route('themgiohang', $new_product->id)}}"><i class="fa fa-shopping-cart"></i></a>
                                                <a class="beta-btn primary" href="{{route('chitietsanpham', $new_product->id)}}">Details <i class="fa fa-chevron-right"></i></a>
                                                <div class="clearfix"></div>
                                            </div>
                                        </div>
                                    </div>
                                @endforeach
                            </div>
                            <div class="row">{{$products->links()}}</div>
                        </div> <!-- .beta-products-list -->

                        <div class="space50">&nbsp;</div>
                    </div>
                </div> <!-- end section with sidebar and main content -->


            </div> <!-- .main-content -->
        </div> <!-- #content -->
    </div> <!-- .container -->

@endsection
