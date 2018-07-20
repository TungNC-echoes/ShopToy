@extends('master')
@section('content')
<div class="inner-header">
    <div class="container">
        <div class="pull-left" style="margin-bottom: 30px">
            <h6 class="inner-title">Đặt hàng</h6>
        </div>
        <div class="pull-right">
            <div class="beta-breadcrumb">
                <a href="{{route('trang-chu')}}">Trang chủ</a> / <span>Đặt hàng</span>
            </div>
        </div>
        <div class="clearfix"></div>
    </div>
</div>

<div class="container">
    <div id="content">
        <?php
        $cart = Session::get('cart');
        ?>
        <form action="{{route('dathang')}}" method="post" class="beta-form-checkout">
            <input type="hidden" name="_token" value="{{csrf_token()}}">
            <div class="row">
                @if(Session::has('thongbao'))
                    <div class="alert alert-success">{{Session::get('thongbao')}}</div>
                @endif
                <div class="col-sm-6">
                    <h4>Đặt hàng</h4>
                    <div class="space20">&nbsp;</div>

                    <div class="form-block">
                        <label for="name">Họ tên*</label>
                        <input type="text" id="name" placeholder="Họ tên" name="name" required>
                    </div>
                    <div class="form-block">
                        <label>Giới tính </label>
                        <input id="gender" type="radio" class="input-radio" name="gender" value="nam" checked="checked" style="width: 10%"><span style="margin-right: 10%">Nam</span>
                        <input id="gender" type="radio" class="input-radio" name="gender" value="nữ" style="width: 10%"><span>Nữ</span>

                    </div>

                    <div class="form-block">
                        <label for="email">Email*</label>
                        <input type="email" id="email" name="email" required placeholder="expample@gmail.com">
                    </div>

                    <div class="form-block">
                        <label for="address">Địa chỉ*</label>
                        <input type="text" id="address" placeholder="Street Address" name="address" required>
                    </div>


                    <div class="form-block">
                        <label for="phone">Điện thoại*</label>
                        <input type="text" id="phone" name="phone" required>
                    </div>

                    <div class="form-block">
                        <label for="notes">Ghi chú</label>
                        <textarea id="notes" name="note"></textarea>
                    </div>
                </div>
                <div class="col-sm-6">
                    <div class="your-order">
                        <div class="your-order-head"><h5>Đơn hàng của bạn</h5></div>
                        @if(Session::has('cart'))
                            <?php
                            $cart = Session::get('cart');
                            ?>
                        <div class="your-order-body" style="padding: 0px 10px">
                            <div class="your-order-item">
                                <div>
                                    <!--  one item	 -->
                                    @foreach($cart->items as $item)
                                    <div class="media">
                                        <img width="25%" src="{{asset('source/image/product/'.$item['item']['image'])}}" alt="" class="pull-left">
                                        <div class="media-body">
                                            <p class="font-large">{{$item['item']['name']}}</p>
                                            <span class="color-gray your-order-info">Số lượng {{$item['qty']}} </span>
                                            <span class="color-gray your-order-info" style="margin-bottom: 0px;">
                                                Đơn giá:
                                                @if($item['item']['promotion_price'] != 0) {{number_format($item['item']['promotion_price'])}}
                                                @else {{number_format($item['item']['unit_price'])}}
                                                @endif
                                                Đồng
                                            </span>
                                            <span class="color-gray your-order-info" style="margin-top: 30px"><h5>
                                                    Thành tiền
                                                    @if($item['item']['promotion_price'] != 0){{number_format($item['item']['promotion_price']*$item['qty'])}}
                                                    @else {{number_format($item['item']['unit_price']*$item['qty'])}}
                                                    @endif
                                                    Đồng
                                                </h5></span>
                                        </div>
                                    </div>
                                    @endforeach
                                    <!-- end one item -->
                                </div>
                                <div class="clearfix"></div>
                            </div>
                            <div class="your-order-item">
                                <div class="pull-left"><p class="your-order-f18">Tổng tiền:</p></div>
                                <div class="pull-right"><h5 class="color-black">@if(Session::has('cart')) {{number_format($cart->totalPrice)}}@endif VND</h5></div>
                                <div class="clearfix"></div>
                            </div>
                        </div>
                        @else
                            <span>Rỗng</span>
                        @endif
                        <div class="your-order-head"><h5>Hình thức thanh toán</h5></div>

                        <div class="your-order-body">
                            <ul class="payment_methods methods">
                                <li class="payment_method_bacs">
                                    <input id="payment_method_bacs" type="radio" class="input-radio" name="payment" value="COD" checked="checked" data-order_button_text="">
                                    <label for="payment_method_bacs">Thanh toán khi nhận hàng </label>
                                    <div class="payment_box payment_method_bacs" style="display: block;">
                                        Cửa hàng sẽ gửi hàng đến địa chỉ của bạn, bạn xem hàng rồi thanh toán tiền cho nhân viên giao hàng
                                    </div>
                                </li>

                                <li class="payment_method_cheque">
                                    <input id="payment_method_cheque" type="radio" class="input-radio" name="payment" value="ATM" data-order_button_text="">
                                    <label for="payment_method_cheque">Chuyển khoản </label>
                                    <div class="payment_box payment_method_cheque" style="display: block;">
                                        Chuyển tiền đến tài khoản sau:
                                        <br>- Số tài khoản: 123 456 789
                                        <br>- Chủ TK: Nguyễn A
                                        <br>- Ngân hàng ACB, Chi nhánh TPHCM
                                    </div>
                                </li>

                            </ul>
                        </div>

                        <div class="text-center"><button type="submit" class="beta-btn primary" href="#">Đặt hàng <i class="fa fa-chevron-right"></i></button></div>
                    </div> <!-- .your-order -->
                </div>
            </div>
        </form>
    </div> <!-- #content -->
</div> <!-- .container -->
@endsection