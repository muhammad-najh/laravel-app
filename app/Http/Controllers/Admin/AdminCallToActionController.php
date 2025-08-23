<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\CallToAction;
use App\Models\FlatIcon;

class AdminCallToActionController extends Controller
{
    public function index()
    {
        $call_to_action = CallToAction::where('id',1)->first();
        $icons = FlatIcon::orderBy('icon_code','asc')->get();
        return view('admin.call_to_action.index', compact('call_to_action', 'icons'));
    }

    public function update(Request $request)
    {
       

        $obj = CallToAction::where('id',1)->first();
        $obj->text = $request->text;
        $obj->text_krd = $request->text_krd;
        $obj->text_ar = $request->text_ar;
        $obj->icon = $request->icon;
        $obj->phone = $request->phone;
        $obj->phone1 = $request->phone1;
        $obj->email = $request->email;
        $obj->save();

        return redirect()->back()->with('success', __('Data is updated successfully'));
    }
}
