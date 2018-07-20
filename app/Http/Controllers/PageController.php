<?php

namespace App\Http\Controllers;

use App\Bill;
use App\BillDetail;
use App\Cart;
use App\Customer;
use App\Product;
use App\ProductType;
use App\User;
use Illuminate\Http\Request;
use App\Slide;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Session;

class PageController extends Controller
{
    public function getIndex()
    {
        $slides = Slide::all();
        $new_products = Product::where('new', 1)->paginate(4);
        $promotion_products = Product::where('promotion_price', '<>', 0)->paginate(8);
        return view('page.trangchu', compact('slides', 'new_products', 'promotion_products'));
    }

    public function getLoaiSp($type)
    {
        $sp_theoloai = Product::where('id_type', $type)->get();
        $sp_khac = Product::where('id_type', '<>', $type)->paginate(3);
        $loai = ProductType::all();
        $loai_sp = ProductType::where('id', $type)->first();
        return view('page.loai_sanpham', compact('sp_theoloai', 'sp_khac', 'loai', 'loai_sp'));
    }

    public function getChitiet(Request $request)
    {
        $sanpham = Product::where('id', $request->id)->first();
        $sp_tuongtu = Product::where('id_type', $sanpham->id_type)->paginate(6);
        return view('page.chitiet_sanpham', compact('sanpham', 'sp_tuongtu'));
    }

    public function getLienHe()
    {
        return view('page.lienhe');
    }

    public function getGioithieu()
    {
        return view('page.gioithieu');
    }

    public function getAddtoCart(Request $req, $id)
    {
        $product = Product::find($id);
        $oldCart = Session('cart')?Session::get('cart'):null;
        $cart = new Cart($oldCart);
        $cart->add($product, $id);
        $req->session()->put('cart', $cart);
        return redirect()->back();
    }

    public function getDelItemCart($id)
    {
        $oldCart = Session::has('cart')? Session::get('cart'):null;
        $cart = new Cart($oldCart);
        $cart->removeItem($id);
        if (count($cart->items)>0) {
            Session::put('cart', $cart);
        } else {
            Session::forget('cart');
        }
        return redirect()->back();
    }

    public function getCheckout()
    {
//        dd(Session::get('cart'));
        return view('page.dat_hang');
    }

    public function postCheckout(Request $req)
    {
        $cart = Session::get('cart');
        $customer = new Customer();
        $customer->name = $req->name;
        $customer->gender = $req->gender;
        $customer->email = $req->email;
        $customer->address = $req->address;
        $customer->phone_number = $req->phone;
        $customer->note = $req->note;
        $customer->save();

        $bill = new Bill();
        $bill->id_customer = $customer->id;
        $bill->date_order = date('Y-m-d');
        $bill->total = $cart->totalPrice;
        $bill->payment = $req->payment;
        $bill->note = $req->note;
        $bill->save();

        foreach ($cart->items as $key => $value) {
            $bill_detail = new BillDetail();
            $bill_detail->id_bill = $bill->id;
            $bill_detail->id_product = $key;
            $bill_detail->quantity = $value['qty'];
            $bill_detail->unit_price = ($value['price']/$value['qty']);
            $bill_detail->save();
        }
        Session::forget('cart');
        return redirect()->back()->with('thongbao', 'Đặt hàng thành công!');
    }

    public function login(Request $req)
    {
        if($req->isMethod('POST')){
            $this->validate($req,
                [
                    'email' => 'required|email',
                    'password' => 'required|min:6|max:20'
                ],
                [
                    'email.required' => 'Vui lòng nhập Email',
                    'email.email' => 'Email không đúng định dạng',
                    'password.required' => 'Vui lòng nhập mật khẩu',
                    'password.min' => 'Mật khẩu có ít nhất 6 kí tự',
                    'password.max' => 'Mật khẩu có nhiều nhất 20 kí tự'
                ]
            );
            $credentials = array(
                'email'=> $req->email,
                'password' => $req->password
            );
            if (Auth::attempt($credentials)) {
                return redirect()->back()->with(['flag' => 'success', 'message' => 'Đăng nhập thành công !!!']);
            } else {
                return redirect()->back()->with(['flag' => 'danger', 'message' => 'Đăng nhập không thành công !!!']);
            }
        }
        return view('page.dangnhap');
    }

    public function getSignin()
    {
        return view('page.dangki');
    }

    public function postSignin(Request $req)
    {
        $this->validate($req,
            [
                'email' => 'required|email|unique:users,email',
                'password' => 'required|min:6|max:20',
                'full_name' => 'required',
                're_password' => 'required|same:password'
            ],
            [
                'email.required' => 'Vui lòng nhập email',
                'email.email' => 'Không đúng định dạng email',
                'email.unique' => 'Email đã có người sử dụng',
                'password,require' => 'Vui lòng nhập mật khẩu',
                're_password.same' => 'Password không giống nhau',
                'password,min' => 'Password phải nhiều hơn 6 kí tự',
                'massword,max' => 'Password phải ít hơn 20 kí tự',
                'fullname.required' => 'Tên khồng được trống'
            ]
        );
        $user = new User();
        $user->full_name = $req->full_name;
        $user->email = $req->email;
        $user->password = Hash::make($req->password);
        $user->phone = $req->phone;
        $user->address = $req->address;
        $user->save();
        return redirect()->back()->with('thanhcong', 'Đã tạo tài khoản thành công');
    }

    public function getLogout()
    {
        Auth::logout();
        return redirect()->route('trang-chu');
    }

    public function getSearch(Request $req)
    {
        $products = Product::where('name', 'like', '%'.$req->key.'%')->orWhere('unit_price', $req->key)->paginate(8);
        return view('page.search', compact('products'));
    }
}
