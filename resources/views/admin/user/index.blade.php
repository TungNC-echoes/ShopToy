@extends('admin.layouts.base')
@section('title')
    <title>ShopToy - List users</title>
@endsection
@section('content')
    <h1>Danh Sách Tài Khoản</h1>
    <hr>
    <div class="col-md-10 col-lg-10 col-lg-offset-1">
        <div class="panel panel-primary ">
            <div class="panel-heading">Bảng Danh Tài Khoản <a  class="pull-right btn btn-primary btn-xs" href="#">Thêm Mới Khách Hàng</a></div>
            <div class="panel-body">
                {{--<div><button class="btn pull-right"><a href="{{ route('user.birthday') }}" class="btn btn-block">Tìm Kiếm KH</a></button></div>--}}
                <table class="table table-bordered table-striped table-auto table-condensed full_width">
                    <thead class="panel-title">
                    <th class="text-center">Số Thứ Tự</th>
                    <th class="text-center">User Name</th>
                    <th class="text-center">Email</th>
                    <th class="text-center">Phone Number</th>
                    <th class="text-center">Address</th>
                    <th class="text-center">Sửa</th>
                    <th class="text-center">Xóa</th>
                    </thead>
                    <tbody>

                    @foreach($users as $index=>$user)
                        <tr>
                            <td class="text-center">{{ $index+1 }}</td>
                            <td class="text-center">{{ $user->full_name }}</td>
                            <td class="text-center">{{ $user->email }}</td>
                            <td class="text-center">{{ $user->phone }}</td>
                            <td class="text-center">{{ $user->address }}</td>
                            <td class="text-center">
                                <a href="{{route('user.edit',['id' => $user->id])}}" class="btn btn-xs btn-success">
                                    <i class="fa fa-pencil" aria-hidden="true"></i>
                                </a></td>
                            <td class="text-center">
                                <a href="#" class="btn btn-xs btn-success">
                                    <i class="fa fa-trash-o" aria-hidden="true"></i>
                                </a></td>
                        </tr>

                    @endforeach

                    </tbody>
                </table>
                <div class="text-right">{{ $users->links() }}</div>
            </div>
        </div>
    </div>

@endsection