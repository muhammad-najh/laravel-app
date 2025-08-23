<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Service;
use App\Models\PDFService;

use App\Models\ServiceFaq;
use App\Models\MyServicesCat;
use App\Models\MySubServicesCat;
use App\Models\FlatIcon;
use Illuminate\Validation\Rule;


class MyAdminServiceCategoryController extends Controller
{
    public function index()
    {
        $myServicesCat = MyServicesCat::orderBy('id','desc')->get();
        return view('admin.service_cat.index',compact('myServicesCat'));
    }

    public function edit($id){
        $category = MyServicesCat::where('id',$id)->first();
        return view('admin.service_cat.edit',compact('category'));

    }

    public function edit_sub($id){
        $subcategory = MySubServicesCat::where('id',$id)->first();
        return view('admin.sub_service_cat.edit',compact('subcategory'));

    }

    public function update(Request $request,$id){
        $category = MyServicesCat::where('id',$id)->first();


        $category->name_krd = $request->name_krd;
        $category->name_en = $request->name_en;
        $category->name_ar = $request->name_ar;
        $category->url = $request->url;


        $category->save();

        return redirect()->back()->with('success', __('Data is updated successfully'));


    }

    public function upate_sub(Request $request,$id){
        $subcategory = MySubServicesCat::where('id',$id)->first();


        $subcategory->name_krd = $request->name_krd;
        $subcategory->name_en = $request->name_en;
        $subcategory->name_ar = $request->name_ar;
        $subcategory->url = $request->url;

        $subcategory->save();

        return redirect()->back()->with('success', __('Data is updated successfully'));


    }


    public function index_sub()
    {
        $mySubServicesCat = MySubServicesCat::orderBy('id','desc')->get();
        return view('admin.sub_service_cat.index',compact('mySubServicesCat'));
    }

    public function create()
    {
        return view('admin.service_cat.create');
    }
    public function create_sub()
    {
        $serviceCategories=MyServicesCat::orderBy('id','desc')->get();

        return view('admin.sub_service_cat.create',compact('serviceCategories'));
    }
    public function store(Request $request)
    {
      
        $request->validate([
            'name_en' => ['required', 'unique:my_services_cat'],
        ],[
            'name_en.required' => __('Name is required'),
            'name_en.unique' => __('Name already exists'),
    
        ]);

        $service = new MyServicesCat();

        $service->name_en = $request->name_en;
        if ($request->filled('url')) {
            $service->url = $request->url;
        }
        $service->slug = strtolower($request->slug);
        $service->save();

        return redirect()->route('admin_service_cat_index')->with('success', __('Data is added successfully'));
    }

    public function store_sub(Request $request)
    {
        
        
        $request->validate([
            'name_en' => ['required', 'unique:my_sub_services_cat'],
        ],[
            'name_en.required' => __('Name is required'),
            'name_en.unique' => __('Name already exists'),

           
        ]);

        $service = new MySubServicesCat();
        if ($request->filled('url')) {
            $service->url = $request->url;
        }
        $service->name_en = $request->name_en;
        $service->service_id = $request->service_id;

        $service->slug = strtolower($request->slug);
        $service->save();

        return redirect()->route('admin_service_cat_index_sub')->with('success', __('Data is added successfully'));
    }


    public function destroy($id)
    {

       

        $service = MyServicesCat::find($id);
        $allRecords = MySubServicesCat::where('service_id',$id)->get();
        foreach ($allRecords as $record) {
            $allRecordsService = Service::where('category',$record->id)->get();
            foreach ($allRecordsService as $recordService) {

                $allRecordsServicePDF = PDFService::where('service_id',$recordService->id)->get();
                foreach ($allRecordsServicePDF as $recordServicePDF) {
                    $recordServicePDF->delete();
                }

                $recordService->delete();
            }
            $record->delete();
        }
     
     


        $service->delete();
       

        return redirect()->back()->with('success', __('Data is deleted successfully'));
    }


    public function destroy_sub($id)
    {
       

        $sub_service = MySubServicesCat::find($id);
        $services = Service::where('category',$sub_service->id)->get();

        foreach ($services as $service) {
            $service->delete();

        }
       
        $sub_service->delete();


        return redirect()->route('admin_service_cat_index_sub')->with('success', __('Data is deleted successfully'));
    }

   

  


}
