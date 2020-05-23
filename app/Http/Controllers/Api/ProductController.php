<?php
namespace App\Http\Controllers\Api;
use App\Category;
use App\Http\Controllers\Controller;
use App\Product;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    public function index()
    {
         $products = Product::all() ;
//        $products->SpecialtyFields = json_decode($products->SpecialtyFields);
//        $SpecialtyFields = json_encode($request->input('SpecialtyFields'));
        return response([
            'data' => $products,
            'status' => 'success'
        ]);
    }
    public function  CategoryProduct(){
        $categories = Category::all();

        $categories->load('products');

       // return $categories ;

        $CatProduct =[];


//        foreach ($categories as $CatKey => $CatValue){
//            unset($CatValue->created_at,$CatValue->updated_at);
//             $CatValue['products']=$CatValue->products;
//            $CatProduct[]=$CatValue;
//        }
//         return ($CatProduct);
        return response([
//            'data' => $CatProduct,
            'data' => $categories,
            'status' => 'success'
        ]);
    }
}
