<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Slide;
use App\Models\Product;
use App\Models\ProductType;
use App\Models\Comment;


class PageController extends Controller
{
    public function getIndex()
    {
        $slide = Slide::all();
        $new_product = Product::where('new', 1)->paginate(4);
        $promotion_product = Product::where('promotion_price', '<>', 0)->paginate(8);
        return view('page.trangchu', compact('slide', 'new_product', 'promotion_product'));
    }

    public function getLoaiSp($type)
    {
        $sp_theoloai = Product::where('id_type', $type)->get();
        $type_product = ProductType::all();
        $sp_khac = Product::where('id_type', '<>', $type)->paginate(3);
        return view('page.loai_sanpham', compact('sp_theoloai', 'type_product', 'sp_khac'));
    }

    public function productDetail($id)
    {
        // Lấy sản phẩm theo ID
        $sanpham = Product::find($id);

        // Kiểm tra xem sản phẩm có tồn tại không
        if (!$sanpham) {
            return redirect()->route('home')->with('error', 'Sản phẩm không tồn tại.');
        }

        // Lấy các sản phẩm liên quan (giả sử là các sản phẩm mới)
        $splienquan = Product::where('new', 1)->where('id', '<>', $id)->take(4)->get();

        // Lấy các bình luận cho sản phẩm (nếu có)
        $comments = Comment::where('id_product', $id)->get();

        // Trả về view chi tiết sản phẩm
        return view('page.detail', compact('sanpham', 'splienquan', 'comments'));
    }

    public function loai()
    {
        $categories = ProductType::all(); // Lấy danh sách loại sản phẩm
        return view('components.header', compact('categories')); // Truyền biến 
    }


    public function showContact()
    {
        return view('page.lienhe');
    }
    public function showAbout()
    {
        return view('page.about');
    }
    
}
