<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Product;
use App\Models\productFaq;
use App\Models\FlatIcon;
use Illuminate\Validation\Rule;
use App\Models\MyProductsCat;
use App\Models\PDFProduct;


class AdminProductController extends Controller
{
    public function index()
    {
        $products = Product::orderBy('id','desc')->get();
        return view('admin.product.index',compact('products'));
    }

    public function create()
    {
        $products_category = MyProductsCat::with('subcategories')->get();
        $icons = FlatIcon::orderBy('icon_code','asc')->get();
        return view('admin.product.create', compact('icons','products_category'));
    }

    public function store(Request $request)
    {
        

        $request->validate([
            'category' => ['required'],
            'icon' => ['required'],
            'photo' => ['required','mimes:jpeg,png,gif'],
        ],[
            'category.required' => __('category is required'),
            'short_description.required' => __('Short Description is required'),
            'description.required' => __('Description is required'),
            'icon.required' => __('Icon is required'),
            'photo.required' => __('Photo is required'),
            'photo.mimes' => __('Photo must be jpeg, png, jpg or gif'),
        ]);

        $product = new product();

     

  

        if($request->icon != null) {
            $request->validate([
                'icon' => ['mimes:jpeg,jpg,png,gif,webp'],
            ],[
                'icon.mimes' => __('Icon must be jpeg, png, jpg or gif'),
            ]);
            $final_name10 = 'service_icon_'.time().'.'.$request->icon->extension();
            $request->icon->move(('uploads'), $final_name10);
            $product->icon = $final_name10;
        }

      
        $final_name = 'product_photo_'.time().'.'.$request->photo->extension();
        $request->photo->move(('uploads'), $final_name);
        $product->photo = $final_name;



        $product->category = $request->category;
         
        $product->name_en = $request->name_en;
        $product->name_krd = $request->name_krd;
        $product->name_ar = $request->name_ar;

        $product->short_description_en = $request->short_description_en;
        $product->short_description_krd = $request->short_description_krd;
        $product->short_description_ar = $request->short_description_ar;

        $product->description_en = $request->description_en;
        $product->description_ar = $request->description_ar;
        $product->description_krd = $request->description_krd;

        $product->phone = $request->phone;
        $product->save();

        return redirect()->route('admin_product_index')->with('success', __('Data is added successfully'));
    }


    public function edit($id)
    {
        $product = product::find($id);
        $products_category = MyProductsCat::with('subcategories')->get();
       $selcted=null;
    foreach($products_category as $category){
       $items= $category['subcategories'];
       foreach($items as $item){
            if($item["id"]==$product['category']){
                $selcted=$item['name_en'];
            }
       }
    }

        return view('admin.product.edit', compact('selcted','product', 'products_category'));
    }

    public function update(Request $request, $id)
    {

        $product = product::find($id);
        $request->validate([
             'short_description_en' => ['required'],
            'description_en' => ['required'],
        ],[
    
            'short_description_en.required' => __('Short Description is required'),
            'description_en.required' => __('Description is required'),
        ]);
        if($request->photo != null) {
            $request->validate([
                'photo' => ['mimes:jpeg,png,gif'],
            ],[
                'photo.mimes' => __('Photo must be jpeg, png, jpg or gif')
            ]);
            if($product->photo) {
                unlink(('uploads/'.$product->photo));
            }
            $final_name = 'product_'.time().'.'.$request->photo->extension();
            $request->photo->move(('uploads'), $final_name);
            $product->photo = $final_name;
        }

   


        if($request->icon != null) {
            $request->validate([
                'icon' => ['mimes:jpeg,jpg,png,gif'],
            ],[
                'icon.mimes' => __('Banner must be jpeg, png, jpg or gif'),
            ]);
            if($product->icon) {
                unlink(('uploads/'.$product->icon));
            }
            $final_name10 = 'product_banner_'.time().'.'.$request->icon->extension();
            $request->icon->move(('uploads'), $final_name10);
            $product->icon = $final_name10;
        }

        $product->name_en = $request->name_en;
        $product->name_ar = $request->name_ar;
        $product->name_krd = $request->name_krd;
        $product->category = $request->category;

        $product->short_description_en = $request->short_description_en;
        $product->description_en = $request->description_en;
        $product->short_description_krd = $request->short_description_krd;
        $product->description_krd = $request->description_krd;
        $product->short_description_ar = $request->short_description_ar;
        $product->description_ar = $request->description_ar;
        $product->phone = $request->phone;
        $product->update();

        return redirect()->route('admin_product_index')->with('success', __('Data is updated successfully'));
    }

    public function destroy($id)
    {
       

        $product = product::find($id);
        if($product->photo) {
            unlink(('uploads/'.$product->photo));
        }
    
        $product->delete();

        // productFaq::where('product_id',$id)->delete();

        return redirect()->route('admin_product_index')->with('success', __('Data is deleted successfully'));
    }

 

    public function product_pdf($id)
    {
        $product = Product::find($id);
        $pdfs = PDFProduct::where('product_id',$id)->orderBy('id','asc')->get();
        return view('admin.product.pdf',compact('product','pdfs'));
    }

    public function product_pdf_store(Request $request,$id)
    {
  
       // Validate the request
       $request->validate([
           
        'pdf' => ['nullable', 'mimes:pdf'], // PDF validation rules
    ], [
        'pdf.mimes' => __('The file must be a PDF'),
    ]);

    // Create a new FAQ entry
    $pdfProduct = new PDFProduct();
    $pdfProduct->product_id = $id;


    if ($request->hasFile('pdf')) {
        $pdfFile = $request->file('pdf');
        $pdfFilename = time() . '-' . $pdfFile->getClientOriginalName();
        // Debug: Print file details
        $request->pdf->move(('uploads/pdf'), $pdfFilename);
        $pdfProduct->pdf = $pdfFilename; // Store the filename in the database
    }
    // Save the PDF name (if provided)
    if ($request->filled('name')) {
        $pdfProduct->name = $request->name;
    }

    $pdfProduct->save();

    return redirect()->back()->with('success', __('Data is added successfully'));

    }

    public function product_pdf_update(Request $request,$id)
    {
     
        $faq = productFaq::find($id);
        $request->validate([
            'question' => ['required'],
            'answer' => ['required'],
        ],[
            'question.required' => __('Question is required'),
            'answer.required' => __('Answer is required'),
        ]);
        $faq->question = $request->question;
        $faq->answer = $request->answer;
        $faq->update();

        return redirect()->back()->with('success', __('Data is updated successfully'));
    }

    public function product_pdf_destroy($id)
    {
        $pdf = PDFProduct::find($id);
        $pdf->delete();
        if ($pdf->pdf) {
            $filePath = ('uploads/pdf/' . $pdf->pdf); // Ensure there is a trailing slash
            if (file_exists($filePath)) {
                unlink($filePath);
            } else {
                // Log or handle the case where the file does not exist
                \Log::warning("File not found: " . $filePath);
            }
        }
        return redirect()->back()->with('success', __('Data is deleted successfully'));

    }
}
