<?php

namespace App\Http\Controllers;

use Exception;
use App\Models\Category;
use Illuminate\Support\Carbon;
use App\Http\Requests\CategoryRequest;
use Illuminate\Support\Facades\Gate;
use Image;
use Illuminate\Support\Str;


class CategoryController extends Controller
{
    public function index()
    {
       Gate::authorize('category-list');

       $serNo = !is_null(\request()->page) ? (\request()->page -1 )* 10 : 0;

       $categories = Category::withCount('products')->orderBy('id', 'DESC')->paginate(10);

       return view('backend.categories.index', compact('categories', 'serNo'));
    }

    public function show(Category $category)
    {
        // $category = Category::findOrFail($id);
        return view('backend.categories.show', compact('category'));
    }

    public function create()
    {
        return view('backend.categories.create');
    }

    public function store(CategoryRequest $request)
    {
        try{
            $data = $request->except('image');

            if($request->hasFile('image')){
               $image = $this->uploadImage($request->name, $request->image);
               $data['image'] = $image;
            }
            $data['slug'] = Str::slug($request->name);

            Category::create($data);
            return redirect()->route('categories.index')->withSuccess('Category Insert Successfully Done');

        }catch(Exception $e){
            dd($e->getMessage());
            return redirect()->back()->withErrors($e->getMessage());
        }
    }

    public function edit(Category $category)
    {
        // $category = Category::findOrFail($id);
        return view('backend.categories.edit', compact('category'));
    }

    public function update(CategoryRequest $request, Category $category)
    {
        $data = $request->except('_token', '_method');
        // $category = Category::findOrFail($id);
        $data['slug'] = Str::slug($data['name']);

        $category->update($data);
        return redirect()->route('categories.index')->withSuccess('Category Updated Successfully Done');
    }

    public function destroy(Category $category)
    {
        // Category::destroy($id);
        $category->delete();
        return redirect()->route('categories.index')->withSuccess('Category Deleted Successfully Done');
    }

    public function trash()
    {
        $serNo = !is_null(\request()->page) ? (\request()->page -1 )* 10 : 0;
        $categories = Category::onlyTrashed()->paginate(10);
        return view('backend.categories.trash', compact('categories', 'serNo'));
    }

    public function restore($id)
    {
        $category = Category::onlyTrashed()->where('id', $id)->firstOrFail();
        $category->restore();
        return redirect()->route('categories.trash')->withSuccess('Category Restored Successfully Done');
    }

    public function delete($id)
    {
        $category = Category::onlyTrashed()->where('id', $id)->firstOrFail();
        $category->forceDelete();
        return redirect()->route('categories.trash')->withSuccess('Category Deleted Successfully Done');
    }

    public function uploadImage($name, $image)
    {
        // image name  database save
        // main laravel project storage save
        $timestamp = str_replace([' ', ':'], '-', Carbon::now()->toDateTimeString());
        $file_name = $timestamp .'-'.$name. '.' . $image->getClientOriginalExtension();
        $pathToUpload = storage_path().'/app/public/categories/';  // image  upload application save korbo

        if(!is_dir($pathToUpload)) {
            mkdir($pathToUpload, 0755, true);
        }
        Image::make($image)->resize(634,792)->save($pathToUpload.$file_name);

        return $file_name;
    }

}
