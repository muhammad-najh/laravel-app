@extends('front.layouts.master')

@section('seo_title', $global_other_page_items->page_about_seo_title)
@section('seo_meta_description', $global_other_page_items->page_about_seo_meta_description)

@section('content')
<!-- Start main-content -->
<section class="page-title" style="background-image: url({{ asset('uploads/'.$global_setting->banner) }});">
    <div class="auto-container">
        <div class="title-outer">
            <h1 class="title">{{ __('About Us') }}</h1>
            <ul class="page-breadcrumb">
                <li><a href="{{ route('home') }}">{{ __('Home') }}</a></li>
                <li>{{ __('About Us') }}</li>
            </ul>
        </div>
    </div>
</section>
<!-- end main-content -->

@if($global_other_page_items->page_about_welcome_status == 'Show')
<section class="about-section">
    <div class="auto-container">
        <div class="row">
            <div class="content-column col-lg-6 col-md-12 col-sm-12 order-2 wow fadeInRight">
                <div class="inner-column">
                    <div class="sec-title">
                        <span class="sub-title">
                          
                          
                            @if(session('sess_lang_code') == 'ar')
                           {{   $welcome_one_items->subheading_ar  }}
                              @elseif(session('sess_lang_code') == 'krd')
                             {{  $welcome_one_items->subheading_krd  }}
                             @else
                             {{   $welcome_one_items->subheading  }}
                             @endif
                            
                 </span>
                  
                        <h2>
                       
                            @if(session('sess_lang_code') == 'ar')
                           {{   $welcome_one_items->heading_ar  }}
                              @elseif(session('sess_lang_code') == 'krd')
                             {{  $welcome_one_items->heading_krd  }}
                             @else
                             {{   $welcome_one_items->heading  }}
                             @endif
                        
                        </h2>
@if($otherPageItem->com_hir == 'Show' && !empty($otherPageItem->com_hir_url))
    <img src="{{ asset('uploads/'.$otherPageItem->com_hir_url) }}" alt="Company Hierarchy Image" style="width: 100%; height: auto;">
@endif                        <div class="text">
                       
                            @if(session('sess_lang_code') == 'ar')
                            {!! str_replace(["<p>", "</p>"], ["", ""], clean(nl2br($welcome_one_items->text_ar))) !!}

                              @elseif(session('sess_lang_code') == 'krd')
                              {!! str_replace(["<p>", "</p>"], ["", ""], clean(nl2br($welcome_one_items->text_krd))) !!}

                             @else
                             {!! str_replace(["<p>", "</p>"], ["", ""], clean(nl2br($welcome_one_items->text))) !!}

                             @endif
                        </div>
                    </div>
                    @foreach($welcome_one_item_elements as $item)
                    <div class="info-box">
                        <div class="inner">
                            <i class="icon {{ $item->icon }}"></i>
                            <h5 class="title">
                                @if(session('sess_lang_code') == 'ar')
                                    {{   $item->heading_ar  }}
                              @elseif(session('sess_lang_code') == 'krd')
                                   {{  $item->heading_krd  }}
                              @else
                                    {{   $item->heading  }}
                               @endif
                            
                            
                            </h5>
                            <div class="text">

                            @if(session('sess_lang_code') == 'ar')
                            {!! str_replace(["<p>", "</p>"], ["", ""], clean(nl2br($item->text_ar))) !!}
                            @elseif(session('sess_lang_code') == 'krd')
                            {!! str_replace(["<p>", "</p>"], ["", ""], clean(nl2br($item->text_krd))) !!}
                            @else
                            {!! str_replace(["<p>", "</p>"], ["", ""], clean(nl2br($item->text))) !!}
                            @endif
                            </div>
                        </div>
                    </div>
                    @endforeach
                    
                </div>
            </div>

            <div class="image-column col-lg-6 col-md-12 col-sm-12 wow fadeInLeft">
                <div class="image-box">
                    <span class="icon-dots bounce-y"></span>
                    <span class="icon-circle zoom-one"></span>
                    <figure class="image-1 wow fadeIn"><img src="{{ asset('uploads/'.$welcome_one_items->photo1) }}" alt=""></figure>
                    <figure class="image-2 wow fadeIn" data-wow-delay="600ms"><img src="{{ asset('uploads/'.$welcome_one_items->photo2) }}" alt=""></figure>
                    <div class="exp-box">
                        <div class="inner">
                            <i class="icon flaticon-promotion"></i>
                            <span class="count">{{ $welcome_one_items->experience_year }}</span>
                            <div class="text">{{ __('Work Experience') }}</div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
@endif


@if($global_other_page_items->page_about_service_status == 'Show')
<section class="services-section">
    <div class="bg-shape"></div>
    <div class="bg bg-pattern-1"></div>
    <div class="auto-container">
        <div class="sec-title light">
            <div class="row">
                <div class="col-lg-7">
                    <span class="sub-title">
                    @if(session('sess_lang_code') == 'ar')
                    {{ $global_other_page_items->page_about_service_heading_ar }}
                                 @elseif(session('sess_lang_code') == 'krd')
                                 {{ $global_other_page_items->page_about_service_heading_krd }}
                                 @else
                                 {{ $global_other_page_items->page_about_service_heading }}
                                 @endif
                            
                
                
                </span>
                
                    <h2>
                        
                    @if(session('sess_lang_code') == 'ar')
                    {!! str_replace(["<p>", "</p>"], ["", ""], clean(nl2br($global_other_page_items->page_about_service_heading_ar))) !!}
                                 @elseif(session('sess_lang_code') == 'krd')
                                 {!! str_replace(["<p>", "</p>"], ["", ""], clean(nl2br($global_other_page_items->page_about_service_heading_krd))) !!}
                                 @else
                                 {!! str_replace(["<p>", "</p>"], ["", ""], clean(nl2br($global_other_page_items->page_about_service_heading))) !!}
                                 @endif
                </h2>
                </div>
                <div class="col-lg-5">
                    <div class="text">
                        
                    
                    @if(session('sess_lang_code') == 'ar')
                    {!! str_replace(["<p>", "</p>"], ["", ""], clean(nl2br($global_other_page_items->page_about_service_text_ar))) !!}
                                 @elseif(session('sess_lang_code') == 'krd')
                                 {!! str_replace(["<p>", "</p>"], ["", ""], clean(nl2br($global_other_page_items->page_about_service_text_krd))) !!}
                                 @else
                                 {!! str_replace(["<p>", "</p>"], ["", ""], clean(nl2br($global_other_page_items->page_about_service_text))) !!}
                                 @endif
                
                </div>
                </div>
            </div>
        </div>
        <div class="row">
            @foreach($services->take($global_other_page_items->page_about_service_how_many) as $service)
            <div class="service-block col-lg-3 col-md-6 coll-md-12 wow fadeInUp">
                <div class="inner-box">
                    <div class="image-box">
                        <figure class="image"><img src="{{ asset('uploads/'.$service->photo) }}" alt="{{ $service->name }}"></figure>
                    </div>
                    <div class="content-box">
                        <i class="icon {{ $service->icon }}"></i>
                        <h5 class="title">{{ $service->name }}</h5>
                    </div>
                    <div class="hover-content">
                        <i class="icon {{ $service->icon }}"></i>
                        <h5 class="title"><a href="{{ route('service',$service->slug) }}">{{ $service->name }}</a></h5>
                        <div class="text">{{ $service->short_description }}</div>
                    </div>
                </div>
            </div>
            @endforeach
        </div>
    </div>
</section>
@endif


@if($global_other_page_items->page_about_team_members_status == 'Show')
<section class="team-section pt-10">    
    <div class="auto-container">
        <div class="sec-title text-center">
            <span class="sub-title">
           
                
                @if(session('sess_lang_code') == 'ar')
                {{ $global_other_page_items->page_about_team_members_subheading_ar }}
                                 @elseif(session('sess_lang_code') == 'krd')
                                 {{ $global_other_page_items->page_about_team_members_subheading_krd }}
                                 @else
                                 {{ $global_other_page_items->page_about_team_members_subheading }}
                                 @endif
           
            </span>
            <h2>
            @if(session('sess_lang_code') == 'ar')
            {!! str_replace(["<p>", "</p>"], ["", ""], clean(nl2br($global_other_page_items->page_about_team_members_heading_ar))) !!}
                                 @elseif(session('sess_lang_code') == 'krd')
                                 {!! str_replace(["<p>", "</p>"], ["", ""], clean(nl2br($global_other_page_items->page_about_team_members_heading_krd))) !!}
                                 @else
                                 {!! str_replace(["<p>", "</p>"], ["", ""], clean(nl2br($global_other_page_items->page_about_team_members_heading))) !!}
                                 @endif
        
        </h2>
        </div>
        <div class="row">
            @foreach($team_members->take($global_other_page_items->page_about_team_members_how_many) as $item)
            <div class="team-block-two col-lg-4 col-md-6 col-sm-12 wow fadeInUp">
                <div class="inner-box">
                    <div class="info-box">
                        <h4 class="name"><a href="{{ route('team_member',$item->slug) }}">{{ $item->name }}</a></h4>
                        <span class="designation">{{ $item->designation }}</span>
                    </div>
                    <div class="image-box">
                        <figure class="image"><a href="{{ route('team_member',$item->slug) }}"><img src="{{ asset('uploads/'.$item->photo) }}" alt=""></a></figure> 
                        <div class="social-links">
                            @if($item->facebook != '')
                                <a href="{{ $item->facebook }}" target="_blank"><i class="fab fa-facebook-f"></i></a>
                            @endif
                            @if($item->twitter != '')
                                <a href="{{ $item->twitter }}" target="_blank"><i class="fab fa-twitter"></i></a>
                            @endif
                            @if($item->linkedin != '')
                                <a href="{{ $item->linkedin }}" target="_blank"><i class="fab fa-linkedin-in"></i></a>
                            @endif
                            @if($item->instagram != '')
                                <a href="{{ $item->instagram }}" target="_blank"><i class="fab fa-instagram"></i></a>
                            @endif
                            @if($item->youtube != '')
                                <a href="{{ $item->youtube }}" target="_blank"><i class="fab fa-youtube"></i></a>
                            @endif
                            @if($item->pinterest != '')
                                <a href="{{ $item->pinterest }}" target="_blank"><i class="fab fa-pinterest-p"></i></a>
                            @endif
                        </div>
                        <span class="share-icon fas fa-plus"></span>
                    </div>
                </div>
            </div>
            @endforeach
        </div>
    </div>
</section>
@endif

@endsection