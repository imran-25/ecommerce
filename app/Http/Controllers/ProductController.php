<?php

namespace App\Http\Controllers;

use Exception;
use App\Models\Product;
use App\Models\Category;
use Illuminate\Http\Request;
use App\Http\Requests\ProductRequest;
use Carbon\Carbon;
use Image;
use Illuminate\Support\Str;


class ProductController extends Controller
{
    public function index()
    {
       $serNo = !is_null(\request()->page) ? (\request()->page -1 )* 10 : 0;
       $products = Product::with('category')->orderBy('id', 'DESC')->paginate(10);
       return view('backend.products.index', compact('products', 'serNo'));
    }

    public function create()
    {
        $categories = Category::all();
        return view('backend.products.create', compact('categories'));
    }

    public function store(ProductRequest $request)
    {
        try{
            $data = $request->all();

            if($request->hasFile('image')){
                $image = $this->uploadImage($request->name, $request->image);
                $data['image'] = $image;
             }

            Product::create([
                'name' => $data['name'],
                'price' => $data['price'],
                'description' => $data['description'],
                'category_id' => $data['category_id'],
                'image' => $data['image'],
                'slug' => Str::slug($data['name'])
            ]);

            return redirect()->route('products.index')->withSuccess('products Insert Successfully Done');
        }catch(Exception $e){
           dd($e->getMessage());
            return redirect()->back()->withErrors($e->getMessage());
        }
    }

    public function edit($id)
    {
        $category  = Product::find($id);
        return view('backend.products.edit', compact('product'));
    }

    public function update(Request $request, $id)
    {
        $data = $request->except('_token');
        Product::where('id', $id)->update($data);
        return redirect()->route('category.index')->withSuccess('Product Updated Successfully Done');
    }

    public function uploadImage($name, $image)
    {
        // image name  database save
        // main laravel project storage save
        $timestamp = str_replace([' ', ':'], '-', Carbon::now()->toDateTimeString());
        $file_name = $timestamp .'-'.$name. '.' . $image->getClientOriginalExtension();
        $pathToUpload = storage_path().'/app/public/products/';  // image  upload application save korbo

        if(!is_dir($pathToUpload)) {
            mkdir($pathToUpload, 0755, true);
        }
        Image::make($image)->resize(634,792)->save($pathToUpload.$file_name);

        return $file_name;
    }
}
