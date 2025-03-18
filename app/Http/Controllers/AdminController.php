<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Product;


class AdminController extends Controller
{
    
    public function showProducts()
    {
        $products = Product::all(); // Lấy tất cả sản phẩm
        $sumSold = $this->calculateSumSold(); // Tính tổng số sản phẩm đã bán

        return view('pageadmin.admin', compact('products', 'sumSold'));
    }
    private function calculateSumSold()
    {
        
        return 8; // Giả sử bạn đã tính toán và có giá trị này
    }

    public function getEdit($id)
    {
        $products = Product::find($id);
        return view('pageadmin.formEdit', compact('products'));
    }

    public function postEdit(Request $request)
    {
        $id = $request->editId;
        $product = Product::find($id);

        if ($request->hasFile('editImage')) {
            $file = $request->file('editImage');
            $fileName = $file->getClientOriginalName('editImage');
            $file->move('source/image/product/', $fileName);
            $product->image = $fileName;
        }

        $product->name = $request->editName;
        $product->description = $request->editDescription;
        $product->unit_price = $request->editPrice;
        $product->promotion_price = $request->editPromotionPrice;
        $product->unit = $request->editUnit;
        $product->new = $request->editNew;
        $product->id_type = $request->editType;

        $product->save();

        return $this->showProducts();
    }

    public function adminDelete($id)
    {
        $product = Product::find($id);
        $product->delete();
        return $this->showProducts();
    }

    public function create()
    {
        return view('pageadmin.formAdd'); // Đảm bảo bạn có view này
    }

    public function postAdd(Request $request)
    {
        $product = new Product();
        if ($request->hasFile('inputImage')) {
            $file = $request->file('inputImage');
            $fileName = $file->getClientOriginalName('inputImage');
            $file->move('source/image/product', $fileName);
        }
        $file_name = null;
        if ($request->file('inputImage') != null) {
            $file_name = $request->file('inputImage')->getClientOriginalName();
        }

        $product->name = $request->inputName;
        $product->image = $file_name;
        $product->description = $request->inputDescription;
        $product->unit_price = $request->inputPrice;
        $product->promotion_price = $request->inputPromotionPrice;
        $product->unit = $request->inputUnit;
        $product->new = $request->inputNew;
        $product->id_type = $request->inputType;
        $product->save();
        return $this->showProducts();
    }
}
