<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Portfolio;
use Illuminate\Validation\Rule;

class AdminPortfolioController extends Controller
{
    public function index()
    {
        $portfolios = Portfolio::orderBy('id','desc')->get();
        return view('admin.portfolio.index',compact('portfolios'));
    }

    public function create()
    {
        return view('admin.portfolio.create');
    }

    public function store(Request $request)
    {
      
        
        $request->validate([
            'name' => ['required', 'unique:portfolios'],
            'description' => ['required'],
            'photo' => ['required','mimes:jpeg,png,gif'],
            'banner' => ['required','mimes:jpeg,png,gif'],
        ],[
            'name.required' => __('Name is required'),
            'name.unique' => __('Name already exists'),
     
            'description.required' => __('Description is required'),            
            'photo.required' => __('Photo is required'),
            'photo.mimes' => __('Photo must be jpeg, png, jpg or gif'),
            'banner.required' => __('Banner is required'),
            'banner.mimes' => __('Banner must be jpeg, png, jpg or gif'),
        ]);

        $portfolio = new Portfolio();

        $final_name = 'portfolio_'.time().'.'.$request->photo->extension();
        $request->photo->move(('uploads'), $final_name);
        $portfolio->photo = $final_name;

        $final_name1 = 'portfolio_banner_'.time().'.'.$request->banner->extension();
        $request->banner->move(('uploads'), $final_name1);
        $portfolio->banner = $final_name1;

        $portfolio->name = $request->name;

        $portfolio->slug = "example".$request->id;
        $portfolio->description = $request->description;


        $portfolio->date = $request->date;
        $portfolio->client = $request->client;
        $portfolio->website = $request->website;
        $portfolio->location = $request->location;
        // $portfolio->seo_title = $request->seo_title;
        // $portfolio->seo_meta_description = $request->seo_meta_description;
        $portfolio->save();

        return redirect()->route('admin_portfolio_index')->with('success', __('Data is added successfully'));
    }

    public function edit($id)
    {
        $portfolio = Portfolio::find($id);
        return view('admin.portfolio.edit', compact('portfolio'));
    }

    public function update(Request $request, $id)
    {
    

        $portfolio = Portfolio::find($id);
        $request->validate([
            'name' => ['required', Rule::unique('portfolios')->ignore($id)],
            'description' => ['required'],
        ],[
            'name.required' => __('Name is required'),
            'name.unique' => __('Name already exists'),
            'description.required' => __('Description is required'),
        ]);
        if($request->photo != null) {
            $request->validate([
                'photo' => ['mimes:jpeg,png,gif'],
            ],[
                'photo.mimes' => __('Photo must be jpeg, png, jpg or gif'),
            ]);
            if($portfolio->photo) {
                unlink(('uploads/'.$portfolio->photo));
            }
            $final_name = 'portfolio_'.time().'.'.$request->photo->extension();
            $request->photo->move(('uploads'), $final_name);
            $portfolio->photo = $final_name;
        }

        if($request->banner != null) {
            $request->validate([
                'banner' => ['mimes:jpeg,png,gif'],
            ],[
                'banner.mimes' => __('Banner must be jpeg, png, jpg or gif'),
            ]);
            if($portfolio->banner) {
                unlink(('uploads/'.$portfolio->banner));
            }
            $final_name1 = 'portfolio_banner_'.time().'.'.$request->banner->extension();
            $request->banner->move(('uploads'), $final_name1);
            $portfolio->banner = $final_name1;
        }

        $portfolio->name = $request->name;
        $portfolio->name_krd = $request->name_krd;
        $portfolio->name_ar = $request->name_ar;
        $portfolio->slug = "example".$request->id;

        $portfolio->description = $request->description;
        $portfolio->description_ar = $request->description_ar;
        $portfolio->date = $request->date;
        $portfolio->client = $request->client;
        $portfolio->website = $request->website;
        $portfolio->location = $request->location;
        // $portfolio->seo_title = $request->seo_title;
        // $portfolio->seo_meta_description = $request->seo_meta_description;
        $portfolio->update();

        return redirect()->route('admin_portfolio_index')->with('success', __('Data is updated successfully'));
    }

    public function destroy($id)
    {

        $portfolio = Portfolio::find($id);
        if($portfolio->photo) {
            unlink(('uploads/'.$portfolio->photo));
        }
        if($portfolio->banner) {
            unlink(('uploads/'.$portfolio->banner));
        }
        $portfolio->delete();

        return redirect()->route('admin_portfolio_index')->with('success', __('Data is deleted successfully'));
    }
}
