<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Service;
use App\Models\ServiceFaq;
use App\Models\FlatIcon;
use Illuminate\Validation\Rule;
use App\Models\MyServicesCat;

use App\Models\PDFService;


class AdminServiceController extends Controller
{
    public function index()
    {
        $services = Service::orderBy('id','desc')->get();
        return view('admin.service.index',compact('services'));
    }

    public function create()
    {
        $services_category = MyServicesCat::with('subcategories')->get();
        $icons = FlatIcon::orderBy('icon_code','asc')->get();
        return view('admin.service.create', compact('icons','services_category'));
    }

    public function store(Request $request)
    {
     
        
        $request->validate([
            'name' => ['required', 'unique:services'],
            'category' => ['required'],
            'icon' => ['required'],
            'photo' => ['required','mimes:jpeg,png,gif'],
        ],[
            'name.required' => __('Name is required'),
            'category.required' => __('category is required'),
            'name.unique' => __('Name already exists'),
            'icon.required' => __('Icon is required'),
            'photo.required' => __('Photo is required'),
            'photo.mimes' => __('Photo must be jpeg, png, jpg or gif'),
        ]);

        $service = new Service();

     


        if($request->icon != null) {
            $request->validate([
                'icon' => ['mimes:jpeg,jpg,png,gif,webp'],
            ],[
                'icon.mimes' => __('Icon must be jpeg, png, jpg or gif'),
            ]);
            $final_name10 = 'service_banner_'.time().'.'.$request->icon->extension();
            $request->icon->move(('uploads'), $final_name10);
            $service->icon = $final_name10;
        }

      
        $final_name = 'service_photo_'.time().'.'.$request->photo->extension();
        $request->photo->move(('uploads'), $final_name);
        $service->photo = $final_name;

        $service->name = $request->name;
        $service->name_ar = $request->name_ar;
        $service->name_krd = $request->name_krd;
        $service->category = $request->category;
        $service->slug = strtolower($request->slug);
        $service->short_description = $request->short_description;
        $service->short_description_krd = $request->short_description_krd;
        $service->short_description_ar = $request->short_description_ar;
        $service->description = $request->description;
        $service->description_ar = $request->description_ar;
        $service->description_krd = $request->description_krd;
        $service->phone = $request->phone;
 
        $service->save();

        return redirect()->route('admin_service_index')->with('success', __('Data is added successfully'));
    }


    public function edit($id)
    {
        $service = Service::find($id);

        $services_category = MyServicesCat::with('subcategories')->get();
        $selcted=null;
     foreach($services_category as $category){
        $items= $category['subcategories'];
        foreach($items as $item){
             if($item["id"]==$service['category']){
                 $selcted=$item['name_en'];
             }
        }
     }
    
        return view('admin.service.edit', compact('selcted','services_category','service'));
    }

    public function update(Request $request, $id)
    {

        $service = Service::find($id);


        
        $request->validate([
            'category' => ['required'],
        ],[
   
            'category.required' => __('category is required'),
       
        ]);
        if($request->photo != null) {
            $request->validate([
                'photo' => ['mimes:jpeg,png,gif'],
            ],[
                'photo.mimes' => __('Photo must be jpeg, png, jpg or gif')
            ]);
            if($service->photo) {
                unlink(('uploads/'.$service->photo));
            }
            $final_name = 'service_'.time().'.'.$request->photo->extension();
            $request->photo->move(('uploads'), $final_name);
            $service->photo = $final_name;
        }


        if($request->icon != null) {
            $request->validate([
                'icon' => ['mimes:jpeg,jpg,png,gif'],
            ],[
                'icon.mimes' => __('Banner must be jpeg, png, jpg or gif'),
            ]);
            if($service->icon) {
                unlink(('uploads/'.$service->icon));
            }
            $final_name10 = 'service_banner_'.time().'.'.$request->icon->extension();
            $request->icon->move(('uploads'), $final_name10);
            $service->icon = $final_name10;
        }

        $service->name = $request->name;
        $service->name_ar = $request->name_ar;
        $service->name_krd = $request->name_krd;
        $service->slug = strtolower($request->slug);
        $service->short_description = $request->short_description;
        $service->short_description_krd = $request->short_description_krd;
        $service->short_description_ar = $request->short_description_ar;
        $service->description = $request->description;
        $service->description_krd = $request->description_krd;
        $service->description_ar = $request->description_ar;
        $service->phone = $request->phone;
        $service->category = $request->category;
        $service->update();

        return redirect()->route('admin_service_index')->with('success', __('Data is updated successfully'));
    }

    public function destroy($id)
    {

        $service = Service::find($id);
        if($service->photo) {
            unlink(('uploads/'.$service->photo));
        }
        if($service->banner) {
            unlink(('uploads/'.$service->banner));
        }
        if($service->pdf) {
            unlink(('uploads/'.$service->pdf));
        }
        $service->delete();

        ServiceFaq::where('service_id',$id)->delete();

        return redirect()->route('admin_service_index')->with('success', __('Data is deleted successfully'));
    }

    public function destroy_banner($id)
    {

        $service = Service::find($id);
        unlink(('uploads/'.$service->banner));
        $service->banner = null;
        $service->update();

        return redirect()->back()->with('success', __('Data is deleted successfully'));
    }

    public function destroy_pdf($id)
    {

        $service = Service::find($id);
        unlink(('uploads/'.$service->pdf));
        $service->pdf = null;
        $service->update();

        return redirect()->back()->with('success', __('Data is deleted successfully'));
    }

    public function service_pdf($id)
    {
        $service = Service::find($id);
        $pdfs = PDFService::where('service_id',$id)->orderBy('id','asc')->get();
        return view('admin.service.pdf',compact('service','pdfs'));
    }

    public function service_pdf_store(Request $request, $id)
    {
        // Validate the request
        $request->validate([
           
            'pdf' => ['nullable', 'mimes:pdf'], // PDF validation rules
        ], [
            'pdf.mimes' => __('The file must be a PDF'),
        ]);
    
        // Create a new FAQ entry
        $pdfservice = new PDFService();
        $pdfservice->service_id = $id;
    
    
        if ($request->hasFile('pdf')) {
            $pdfFile = $request->file('pdf');
            $pdfFilename = time() . '-' . $pdfFile->getClientOriginalName();
            // Debug: Print file details
            $request->pdf->move(('uploads/pdf'), $pdfFilename);
            $pdfservice->pdf = $pdfFilename; // Store the filename in the database
        }
        // Save the PDF name (if provided)
        if ($request->filled('name')) {
            $pdfservice->name = $request->name;
        }
    
        $pdfservice->save();
    
        return redirect()->back()->with('success', __('Data is added successfully'));
    }
    
    // public function service_faq_update(Request $request,$id)
    // {

    //     $faq = ServiceFaq::find($id);
    //     $request->validate([
    //         'question' => ['required'],
    //         'answer' => ['required'],
    //     ],[
    //         'question.required' => __('Question is required'),
    //         'answer.required' => __('Answer is required'),
    //     ]);
    //     $faq->question = $request->question;
    //     $faq->answer = $request->answer;
    //     $faq->update();

    //     return redirect()->back()->with('success', __('Data is updated successfully'));
    // }

    public function service_pdf_destroy($id)
    {

        $pdf = PDFService::find($id);
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
