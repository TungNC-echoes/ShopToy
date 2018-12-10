@extends('admin.layouts.base')
@section('title')
    <title>ShopToy - Edit user</title>
@endsection
@section('css')
    {{--<link rel="stylesheet" href="{{ asset('web/css/home.css') }}">--}}
@endsection
@section('content')
    <h2>Sửa Thông Tin Khách Hàng: {{ $user->full_name }}</h2>
    <hr>
    <div class="col-md-8 col-lg-8 col-md-offset-3 col-lg-offset-2">
        <div class="panel panel-primary ">
            <div class="panel-heading">Sửa Thông Tin Khách Hàng<a  class="pull-right btn btn-primary btn-xs" href="#">Thêm Mới Khách Hàng</a></div>
            <div class="panel-body">
                <form action="{{route('user.edit',['id' => $user->id])}}" method="POST" enctype="multipart/form-data">
                    {{csrf_field()}}
                    <div class="form-group">
                        <lable for="name">Full name<span class="text-danger">*</span></lable>
                        <input placeholder="Enter name"
                               required
                               name="full_name"
                               spellcheck="false"
                               class="form-control"
                               value="{{ $user->full_name }}"
                        >
                    </div>
                    <div class="form-group">
                        <lable for="price">Email<span class="text-danger">*</span></lable>
                        <input placeholder="Enter email"
                               required
                               name="email"
                               spellcheck="false"
                               class="form-control"
                               value="{{ $user->email}}"
                        >
                    </div>
                    <div class="form-group">
                        <lable for="price">Phone number<span class="text-danger">*</span></lable>
                        <input placeholder="Enter phone number"
                               required
                               name="phone"
                               spellcheck="false"
                               class="form-control"
                               value="{{ $user->phone}}"
                        >
                    </div>
                    <div class="form-group">
                        <lable for="price">Address<span class="text-danger">*</span></lable>
                        <input placeholder="Enter address"
                               required
                               name="address"
                               spellcheck="false"
                               class="form-control"
                               value="{{ $user->address}}"
                        >
                    </div>
                    <div class="form-group">
                        <input type="submit" class="btn btn-primary" value="Sửa">
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection