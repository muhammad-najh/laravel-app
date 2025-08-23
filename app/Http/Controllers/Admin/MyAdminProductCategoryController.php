<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\MyProductsCat;
use App\Models\Product;
use App\Models\MySubProductsCat;

use Illuminate\Validation\Rule;

class MyAdminProductCategoryController extends Controller
{
    public function index()
    {
        $myProductsCat = MyProductsCat::orderBy('id', 'desc')->get();
        return view('admin.product_cat.index', compact('myProductsCat'));
    }

    public function index_sub()
    {
        $mySubProductsCat = MySubProductsCat::orderBy('id', 'desc')->get();
        return view('admin.sub_product_cat.index', compact('mySubProductsCat'));
    }

    public function edit($id){
        $category = MyProductsCat::where('id',$id)->first();
        return view('admin.product_cat.edit',compact('category'));

    }

    public function edit_sub($id){
        $subcategory  = MySubProductsCat::where('id',$id)->first();
        return view('admin.sub_product_cat.edit',compact('subcategory'));

    }


    public function update_sub(Request $request,$id){

        $category = MySubProductsCat::where('id',$id)->first();
        $category->name_krd = $request->name_krd;
        $category->name_en = $request->name_en;
        $category->name_ar = $request->name_ar;
        $category->url = $request->url;
        $category->save();

        return redirect()->back()->with('success', __('Data is updated successfully'));
    }

    public function update(Request $request,$id){

        $category = MyProductsCat::where('id',$id)->first();
        $category->name_krd = $request->name_krd;
        $category->name_en = $request->name_en;
        $category->name_ar = $request->name_ar;
        $category->url = $request->url;
        $category->save();

        return redirect()->back()->with('success', __('Data is updated successfully'));
    }


    public function create()
    {
        return view('admin.product_cat.create');
    }

    public function create_sub()
    {
        $productCategories = MyProductsCat::orderBy('id', 'desc')->get();
        return view('admin.sub_product_cat.create', compact('productCategories'));
    }

    public function store(Request $request)
    {
       
     

        $request->validate([
            'name_en' => ['required', Rule::unique('my_products_cat')],
        ], [
            'name_en.required' => __('Name is required'),
            'name_en.unique' => __('Name already exists'),
        ]);

        $product = new MyProductsCat();
        $product->name_en = $request->name_en;
        if ($request->filled('url')) {
            $product->url = $request->url;
        }
        $product->save();

        return redirect()->route('admin_product_cat_index')->with('success', __('Data is added successfully'));
    }

    public function store_sub(Request $request)
    {
   

        $request->validate([
            'name_en' => ['required', Rule::unique('my_sub_products_cat')],
        ], [
            'name_en.required' => __('Name is required'),
            'name_en.unique' => __('Name already exists'),
        ]);

        $subProduct = new MySubProductsCat();
        $subProduct->name_en = $request->name_en;
        if ($request->filled('url')) {
            $subProduct->url = $request->url;
        }
        $subProduct->product_id = $request->product_id; // Assuming 'product_id' is the foreign key
        $subProduct->save();

        return redirect()->route('admin_product_cat_index_sub')->with('success', __('Data is added successfully'));
    }

    public function destroy($id)
    {


        $category = MyProductsCat::find($id);
        $subcategories = MySubProductsCat::where('product_id',$id)->get();
        foreach ($subcategories as $subcategory) {
            $allRecordsProduct = Product::where('category',$subcategory->id)->get();
            foreach ($allRecordsProduct as $product) {
                $product->delete();
            }
            $subcategory->delete();
        }
        $category->delete();

        return redirect()->route('admin_product_cat_index')->with('success', __('Data is deleted successfully'));
    }

    public function destroy_sub($id)
    {
       
        $sub_product = MySubProductsCat::find($id);
        $products = Product::where('category',$sub_product->id)->get();

        foreach ($products as $product) {
            $product->delete();

        }
       
        $sub_product->delete();

        return redirect()->route('admin_product_cat_index_sub')->with('success', __('Data is deleted successfully'));
    }
}
