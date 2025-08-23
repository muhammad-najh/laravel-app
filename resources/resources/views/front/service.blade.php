@extends('front.layouts.master')

@section('content')
<section class="page-title" style="background-image: url({{ asset('uploads/'.$global_setting->banner) }});">
    <div class="auto-container">
        <div class="title-outer">
            <h1 class="title">
                
   {{ $subcategory_name}}


            </h1>
        <ul class="page-breadcrumb">
                <li><a href="{{ route('home') }}">{{ __('Home') }}</a></li>
                <li>Service</li>
                 <li> {{ $category_name}}</li>
           

            </ul>
        </div>
    </div>
</section>
<section class="services-details">
    <div class="container">
        <div class="row">
            <div class="col-xl-4 col-lg-4">
                <div class="service-sidebar">
                    <div class="sidebar-widget service-sidebar-single">
                     

<div class="service-details-help" style="padding: 15px; font-size: 16px; max-width: 250px;">
    <div class="help-shape-1" style="width: 12px; height: 12px;"></div>
    <div class="help-shape-2" style="width: 12px; height: 12px;"></div>
    <h2 class="help-title" style="font-size: 18px; margin-bottom: 10px;">{{ __('Contact with us for any advice') }}</h2>
    <div class="help-icon" style="font-size: 24px; margin-bottom: 10px;">
        <span class="lnr-icon-phone-handset"></span>
    </div>
    <div class="help-contact">
        <p style="font-size: 14px; margin: 6px 0;">{{ __('Need help? Talk to an expert') }}</p>
        <a href="tel:{{ $service->phone }}" style="font-size: 16px;">{{ $service->phone }}</a>
    </div>
</div>



                        <!-- List of PDFs -->
                        @if($pdfs->isNotEmpty())
                        <div class="sidebar-widget service-sidebar-single mt-4">
                            <div class="service-sidebar-single-btn wow fadeInUp" data-wow-delay="0.5s" data-wow-duration="1200m">
                                <h3>{{ __('Download PDF File') }}</h3>
                                <ul class="list-unstyled">
                                    @foreach($pdfs as $pdf)
                                    <li><a href="{{ asset('uploads/pdf/'.$pdf->pdf) }}" target="_blank"><span class="fas fa-file-pdf"></span> {{ $pdf->name }}</a></li>
                                    @endforeach
                                </ul>
                            </div>
                        </div>
                        @endif
                        <!-- End List of PDFs -->

                    </div>
                </div>
            </div>
            <div class="col-xl-8 col-lg-8">
                <div class="services-details__content">
                    @if($service->photo != null)
                        <img src="{{ asset('uploads/'.$service->photo) }}" alt="">
                    @endif
                    <h3 class="mt-4">{{ __('Service Overview') }}</h3>
                    <div class="content mt-40">
                        <div class="text">
                            <p>
                             
                        @if(session('sess_lang_code') == 'ar')
                        {!! clean($service->description_ar) !!}
                        @elseif(session('sess_lang_code') == 'krd')
                        {!! clean($service->description_krd) !!}
                        @else
                        {!! clean($service->description) !!}
                        @endif
                            </p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
@endsection
