<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Offer;
use App\Models\OfferElement;
use App\Models\FlatIcon;

class AdminOfferController extends Controller
{
    public function index()
    {
        $offers = Offer::where('id',1)->first();
        $offer_elements = OfferElement::get();
        $icons = FlatIcon::orderBy('icon_code','asc')->get();
        return view('admin.offer.index', compact('offers', 'offer_elements', 'icons'));
    }

    public function update(Request $request)
    {
      
        
        $obj = Offer::where('id',1)->first();
        if($request->photo != null) {
            $request->validate([
                'photo' => 'mimes:jpg,jpeg,png,gif',
            ],[
                'photo.mimes' => __('Photo must be jpeg, png, jpg or gif'),
            ]);

            if($obj->photo!=null) {
                unlink(('uploads/'.$obj->photo));
            }
            
            $final_name = 'offer_photo_'.time().'.'.$request->photo->extension();
            $request->photo->move(('uploads'), $final_name);
            $obj->photo = $final_name;
        }

        $obj->subheading = $request->subheading;
        $obj->subheading_krd = $request->subheading_krd;
        $obj->subheading_ar = $request->subheading_ar;
        $obj->heading = $request->heading;
        $obj->heading_krd = $request->heading_krd;
        $obj->heading_ar = $request->heading_ar;

        $obj->text = $request->text;
        $obj->text_ar = $request->text_ar;
        $obj->text_krd = $request->text_krd;
        $obj->icon = $request->icon;
        $obj->tagline = $request->tagline;
        $obj->tagline_krd = $request->tagline_krd;
        $obj->tagline_ar = $request->tagline_ar;
        $obj->youtube_video_id = $request->youtube_video_id;
        $obj->save();

        return redirect()->back()->with('success', __('Data is updated successfully'));
    }

    public function element_submit(Request $request)
    {
      

        $request->validate([
            'item' => 'required',
        ], [
            'item.required' => __('Item is required'),
        ]);

        $obj = new OfferElement();
        $obj->item = $request->item;
        $obj->save();

        return redirect()->back()->with('success', __('Data is added successfully'));
    }

    public function element_update(Request $request,$id)
    {
        

        $request->validate([
            'item' => 'required',
        ], [
            'item.required' => __('Item is required'),
        ]);

        $obj = OfferElement::where('id',$id)->first();
        $obj->item = $request->item;
        $obj->item_krd = $request->item_krd;
        $obj->item_ar = $request->item_ar;
        $obj->save();

        return redirect()->back()->with('success', __('Data is updated successfully'));
    }

    public function element_delete(Request $request,$id) 
    {
     
        $obj = OfferElement::where('id',$id)->first();
        $obj->delete();

        return redirect()->back()->with('success', __('Data is deleted successfully'));
    }
}
