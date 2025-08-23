@extends('front.layouts.master')

@section('seo_title', $global_other_page_items->page_faq_seo_title)
@section('seo_meta_description', $global_other_page_items->page_faq_seo_meta_description)

@section('content')
<section class="page-title" style="background-image: url({{ asset('uploads/'.$global_setting->banner) }});">
    <div class="auto-container">
        <div class="title-outer">
            <h1 class="title">
                

                @if(session('sess_lang_code') == 'ar')
                {{ $global_other_page_items->page_faq_title_ar }}                       
                 @elseif(session('sess_lang_code') == 'krd')
                 {{ $global_other_page_items->page_faq_title_krd }}
                @else
                {{ $global_other_page_items->page_faq_title }}
             @endif
            
            </h1>
            <ul class="page-breadcrumb">
                <li><a href="{{ route('home') }}">{{ __('Home') }}</a></li>
                <li>
                    
                
                @if(session('sess_lang_code') == 'ar')
                {{ $global_other_page_items->page_faq_title_ar }}                       
                 @elseif(session('sess_lang_code') == 'krd')
                 {{ $global_other_page_items->page_faq_title_krd }}
                @else
                {{ $global_other_page_items->page_faq_title }}
             @endif
            


                </li>
            </ul>
        </div>
    </div>
</section>

<section class="faq-section">
    <div class="container">
        <div class="row">
            <div class="col">
                <ul class="accordion-box">
                    @foreach($faqs as $faq)
                    <li class="accordion block">
                        <div class="acc-btn">
                        @if(session('sess_lang_code') == 'ar')
                        {{ $faq->question_ar }}
                        @elseif(session('sess_lang_code') == 'krd')
                        {{ $faq->question_krd }}
                        @else
                        {{ $faq->question }}
                        @endif
            
                            <div class="icon fa fa-plus"></div>
                        </div>
                        <div class="acc-content">
                            <div class="content">
                                <div class="text">
                                @if(session('sess_lang_code') == 'ar')
                                {!! clean($faq->answer_ar) !!}
                                @elseif(session('sess_lang_code') == 'krd')
                                {!! clean($faq->answer_krd) !!}
                                @else
                                 {{ $faq->question }}
                                 @endif
                                </div>
                            </div>
                        </div>
                    </li>
                    @endforeach
                </ul>
            </div>
        </div>
    </div>
</section>

@endsection

@push('scripts')
<script>
    document.addEventListener('DOMContentLoaded', function () {
        const accordionItems = document.querySelectorAll('.accordion-box .accordion');
        
        accordionItems.forEach(item => {
            const btn = item.querySelector('.acc-btn');
            const content = item.querySelector('.acc-content');

            btn.addEventListener('click', function () {
                // Toggle active class on button
                btn.classList.toggle('active');

                // Toggle current class on content
                content.classList.toggle('current');
            });
        });
    });
</script>
@endpush
