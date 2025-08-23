<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\FeatureTwoItem;
use App\Models\FeatureTwoItemElement;

class AdminFeatureTwoController extends Controller
{
    public function item()
    {
        $feature_two_items = FeatureTwoItem::where('id',1)->first();
        $feature_two_item_elements = FeatureTwoItemElement::get();
        return view('admin.feature.two', compact('feature_two_items', 'feature_two_item_elements'));
    }

    public function item_update(Request $request)
    {
      
        
        $obj = FeatureTwoItem::where('id',1)->first();
        if($request->photo != null) {
            $request->validate([
                'photo' => 'mimes:jpg,jpeg,png,gif',
            ],[
                'photo.mimes' => __('Photo must be jpeg, png, jpg or gif'),
            ]);

            if($obj->photo!=null) {
                unlink(('uploads/'.$obj->photo));
            }
            
            $final_name = 'feature_two_photo_'.time().'.'.$request->photo->extension();
            $request->photo->move(('uploads'), $final_name);
            $obj->photo = $final_name;
        }
        $obj->heading = $request->heading;
        $obj->subheading = $request->subheading;
        $obj->text = $request->text;

        $obj->heading_krd = $request->heading_krd;
        $obj->subheading_krd = $request->subheading_krd;
        $obj->text_krd = $request->text_krd;


        $obj->heading_ar = $request->heading_ar;
        $obj->subheading_ar = $request->subheading_ar;
        $obj->text_ar = $request->text_ar;

        $obj->save();

        return redirect()->back()->with('success', __('Data is updated successfully'));
    }

    public function item_element_submit(Request $request)
    {
      

        $request->validate([
            'name' => 'required',
        ], [
            'name.required' => __('Name is required'),
        ]);

        $obj = new FeatureTwoItemElement();
        $obj->name = $request->name;
        $obj->save();

        return redirect()->back()->with('success', __('Data is added successfully'));
    }

    public function item_element_update(Request $request,$id)
    {

        $request->validate([
            'name' => 'required',
        ], [
            'name.required' => __('Name is required'),
        ]);

        $obj = FeatureTwoItemElement::where('id',$id)->first();
        $obj->name = $request->name;
        $obj->name_krd = $request->name_krd;
        $obj->name_ar = $request->name_ar;
        $obj->save();

        return redirect()->back()->with('success', __('Data is updated successfully'));
    }

    public function item_element_delete(Request $request,$id) 
    {
        

        $obj = FeatureTwoItemElement::where('id',$id)->first();
        $obj->delete();

        return redirect()->back()->with('success', __('Data is deleted successfully'));
    }
}
