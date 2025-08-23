<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Faq;

class AdminFaqController extends Controller
{
    public function index()
    {
        $faqs = Faq::orderBy('id','asc')->get();
        return view('admin.faq.index',compact('faqs'));
    }

    public function create()
    {
        return view('admin.faq.create');
    }

    public function store(Request $request)
    {
    
        $request->validate([
            'question' => ['required'],
            'answer' => ['required']
        ],[
            'question.required' => __('Question is required'),
            'answer.required' => __('Answer is required'),
        ]);

        $obj = new Faq();
        $obj->question = $request->question;
        $obj->answer = $request->answer;
        $obj->save();

        return redirect()->route('admin_faq_index')->with('success', __('Data is added successfully'));
    }

    public function edit($id)
    {
        $faq = Faq::find($id);
        return view('admin.faq.edit', compact('faq'));
    }

    public function update(Request $request, $id)
    {
   
        $obj = Faq::find($id);
        $request->validate([
            'question' => ['required'],
            'answer' => ['required']
        ],[
            'question.required' => __('Question is required'),
            'answer.required' => __('Answer is required'),
        ]);
        $obj->question = $request->question;
        $obj->question_krd = $request->question_krd;
        $obj->question_ar = $request->question_ar;
        $obj->answer = $request->answer;
        $obj->answer_krd = $request->answer_krd;
        $obj->answer_ar = $request->answer_ar;


        $obj->update();

        return redirect()->route('admin_faq_index')->with('success', __('Data is updated successfully'));
    }

    public function destroy($id)
    {
       

        $obj = Faq::find($id);
        $obj->delete();

        return redirect()->route('admin_faq_index')->with('success', __('Data is deleted successfully'));
    }
}
