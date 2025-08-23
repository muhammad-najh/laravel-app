@extends('front.layouts.master')

@section('seo_title', $global_other_page_items->page_services_seo_title)
@section('seo_meta_description', $global_other_page_items->page_services_seo_meta_description)

@section('content')
<section class="page-title" style="background-image: url({{ asset('uploads/'.$global_setting->banner) }});">
    <div class="auto-container">
        <div class="title-outer">
             <h1 class="title">
       {{$subcategory_name}}
            
            </h1>
            <ul class="page-breadcrumb">
                <li><a href="{{ route('home') }}">{{ __('Home') }}</a></li>
                <li>product</li>
                 <li>  @if(session('sess_lang_code') == 'ar')
                        {{ $products_category->name_en }}
                        @elseif(session('sess_lang_code') == 'krd')
                        {{ $category_name }}
                        @else
                       {{ $category_name }}
                      @endif</li>
            </ul>
        </div>
    </div>
</section>

<section class="services-section">
    <div class="auto-container" style="max-width: 1200px;">
        <div class="row justify-content-center">
            @foreach($products as $product)
                <div class="product-block col-lg-3 col-md-6 col-sm-12" style="border: 1px solid #ddd; border-radius: 10px; padding: 10px; margin: 10px; box-shadow: 0 4px 10px rgba(0,0,0,0.1); transition: all 0.3s ease; background-color: #fff; overflow: hidden;">
                    <div class="image-box" style="text-align: center; overflow: hidden; border-bottom: 2px solid #FEC63F; padding-bottom: 10px;">
                        <figure class="image" style="margin: 0; border: 5px solid #FEC63F; border-radius: 8px; padding: 5px; transition: transform 0.4s ease;">
                            <img src="{{ asset('uploads/'.$product->photo) }}" alt="{{ $product->name_en }}" style="max-width: 100%; height: auto; border-radius: 5px; transition: transform 0.4s ease;">
                        </figure>
                    </div>
                    <div class="content-box" style="padding: 15px 0; text-align: center;">
                        <h5 class="title" style="font-size: 1.2rem; color: #333; margin-bottom: 10px;">
                            @if(session('sess_lang_code') == 'ar')
                                {{ $product->name_ar }}
                            @elseif(session('sess_lang_code') == 'krd')
                                {{ $product->name_krd }}
                            @else
                                {{ $product->name_en }}
                            @endif
                        </h5>
                        <div class="description" style="font-size: 0.9rem; color: #666; height: 160px; overflow-y: auto; padding: 5px; text-align: justify;">
                            @if(session('sess_lang_code') == 'ar')
                                {!! str_replace(["<p>", "</p>"], ["", ""], clean(nl2br($product->short_description_ar))) !!}
                            @elseif(session('sess_lang_code') == 'krd')
                                {!! str_replace(["<p>", "</p>"], ["", ""], clean(nl2br($product->short_description_krd))) !!}
                            @else
                                {!! str_replace(["<p>", "</p>"], ["", ""], clean(nl2br($product->short_description_en))) !!}
                            @endif
                        </div>
                    </div>
                    <div class="button-box" style="text-align: center; margin-top: 15px;">
                        <a href="{{ route('productsdetail',[$product->id,$product->category]) }}" style="background-color: #FEC63F; color: #fff; padding: 10px 15px; border-radius: 5px; text-decoration: none; font-size: 1rem; transition: background-color 0.3s ease;">
                            {{ __('See Details') }}
                        </a>
                    </div>
                </div>
            @endforeach
        </div>
    </div>
</section>
@endsection