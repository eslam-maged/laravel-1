<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Category;
use App\Product;
use Illuminate\Support\Facades\Input;
use Image;
//use DB;

class ProductController extends Controller
{
    public function addProduct(Request $request){
        if($request->isMethod('post')){
            $data = $request->all();
//            echo "<pre>"; print_r($data); die;
            $product = new Product;
            $product->category_id = $data['category_id'];
            $product->name = $data['name'];
            $product->description = $data['description'];
            $product->code = $data['code'];
            $product->color = $data['color'];
            $product->price = $data['price'];
            
//            Upload Image
            if($request->hasFile('image')){
                $image_tmp = Input::file('image');
                if($image_tmp->isValid()){
                    $extension = $image_tmp->getClientOriginalExtension();
                    $filename = rand(111,99999).'.'.$extension;
                    $large_image_path = 'img/backend_img/products/large/'.$filename;           $medium_image_path = 'img/backend_img/products/medium/'.$filename;
                    $small_image_path = 'img/backend_img/products/small/'.$filename;
                    
//                    Resize Images
                    Image::make($image_tmp)->save($large_image_path);
                    Image::make($image_tmp)->resize(600,600)->save($medium_image_path);
                    Image::make($image_tmp)->resize(300,300)->save($small_image_path);
                    
//                    Store image name in products table
                    $product->image = $filename;
                }
            }
            
            $product->save();
            return redirect('/admin/view-products')->with('flash_message_success','Product added Successfully!');
        }
        $categories = Category::where('parent_id', '!=', 0)->get();
        return view('admin.products.add_product')->with(compact('categories'));
    }
    
    public function viewProducts(){
//        $products = DB::table('products')->get();
        $products = Product::get();
        return view('admin.products.view_products')->with(compact('products'));
    }
    
    public function editCategory(Request $request, $id = null){
        if($request->isMethod('post')){
            $data = $request->all();
//            echo "<pre>"; print_r($data); die;
            Category::where(['id'=>$id])->update(['name'=>$data['name'],'parent_id'=>$data['parent_id'],'description'=>$data['description'],'url'=>$data['url']]);
            return redirect('/admin/view-categories')->with('flash_message_success','Category updated Successfully!');
        }
        $categoryDetails = Category::where(['id'=>$id])->first();
        $levels = Category::where(['parent_id'=>0])->get();
        return view('admin.categories.edit_category')->with(compact('categoryDetails','levels'));
    }
    
    public function deleteProduct($id = null){
        if(!empty($id)){
            Product::where(['id'=>$id])->delete();
            return redirect()->back()->with('flash_message_success','Product deleted Successfully!');
        }
    }
}
