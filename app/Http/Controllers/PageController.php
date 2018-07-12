<?php

namespace App\Http\Controllers;

use App\Product;
use Illuminate\Http\Request;
use App\Slide;

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
        return view('page.loai_sanpham', compact('sp_theoloai', 'sp_khac'));
    }

    public function getChitiet()
    {
        return view('page.chitiet_sanpham');
    }

    public function getLienHe()
    {
        return view('page.lienhe');
    }

    public function getGioithieu()
    {
        return view('page.gioithieu');
    }
    public function testgit()
    {
        return view('page.gioithieu');
    }
}
