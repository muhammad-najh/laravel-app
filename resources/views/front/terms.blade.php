@extends('front.layouts.master')

@section('seo_title', $global_other_page_items->page_terms_seo_title)
@section('seo_meta_description', $global_other_page_items->page_terms_seo_meta_description)

@section('content')
<!-- Start main-content -->
<section class="page-title" style="background-image: url({{ asset('uploads/'.$global_setting->banner) }});">
    <div class="auto-container">
        <div class="title-outer">
            <h1 class="title">
            @if(session('sess_lang_code') == 'ar')
                        {{ $global_other_page_items->page_terms_title_ar }}
                        @elseif(session('sess_lang_code') == 'krd')
                        {{ $global_other_page_items->page_terms_title_krd }}
                        @else
                        {{ $global_other_page_items->page_terms_title }}
                      @endif
            </h1>
            <ul class="page-breadcrumb">
                <li><a href="{{ route('home') }}">{{ __('Home') }}</a></li>
                <li>

                       @if(session('sess_lang_code') == 'ar')
                        {{ $global_other_page_items->page_terms_title_ar }}
                        @elseif(session('sess_lang_code') == 'krd')
                        {{ $global_other_page_items->page_terms_title_krd }}
                        @else
                        {{ $global_other_page_items->page_terms_title }}
                      @endif
                </li>
            </ul>
        </div>
    </div>
</section>
<!-- end main-content -->

<section class="blog-details">
    <div class="container">
        <div class="row">
            <div class="col-md-12">

                      @if(session('sess_lang_code') == 'ar')
                        {!! clean($global_other_page_items->page_terms_content_ar) !!}
                        @elseif(session('sess_lang_code') == 'krd')
                        {!! clean($global_other_page_items->page_terms_content_krd) !!}
                        @else
                        {!! clean($global_other_page_items->page_terms_content) !!}
                      @endif

            </div>
        </div>
    </div>
</section>
@endsection