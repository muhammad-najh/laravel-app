@extends('front.layouts.master')

@section('seo_title', $global_other_page_items->page_services_seo_title)
@section('seo_meta_description', $global_other_page_items->page_services_seo_meta_description)

@push('styles')
<style>
    /* Beautiful Product Cards Styles */
    .page-title {
        background-attachment: fixed;
        background-size: cover;
        background-position: center;
        position: relative;
    }

    .page-title::before {
        content: '';
        position: absolute;
        top: 0;
        left: 0;
        right: 0;
        bottom: 0;
        background: linear-gradient(135deg, rgba(102, 126, 234, 0.8), rgba(118, 75, 162, 0.8));
    }

    .services-section {
        background: linear-gradient(135deg, #f5f7fa 0%, #c3cfe2 100%);
        padding: 80px 0;
        min-height: 100vh;
    }

    .products-grid {
        display: grid;
        grid-template-columns: repeat(auto-fit, minmax(320px, 1fr));
        gap: 35px;
        padding: 40px 0;
    }

    .product-card {
        background: rgba(255, 255, 255, 0.95);
        border-radius: 24px;
        position: relative;
        overflow: hidden;
        box-shadow: 0 20px 40px rgba(0, 0, 0, 0.1);
        transform: translateY(0);
        transition: all 0.4s cubic-bezier(0.175, 0.885, 0.32, 1.275);
        backdrop-filter: blur(10px);
        border: 1px solid rgba(254, 198, 63, 0.2);
        animation: fadeInUp 0.6s ease forwards;
        opacity: 0;
        transform: translateY(50px);
    }

    .product-card:nth-child(1) { animation-delay: 0.1s; }
    .product-card:nth-child(2) { animation-delay: 0.2s; }
    .product-card:nth-child(3) { animation-delay: 0.3s; }
    .product-card:nth-child(4) { animation-delay: 0.4s; }
    .product-card:nth-child(5) { animation-delay: 0.5s; }
    .product-card:nth-child(6) { animation-delay: 0.6s; }

    @keyframes fadeInUp {
        to {
            opacity: 1;
            transform: translateY(0);
        }
    }

    .product-card::before {
        content: '';
        position: absolute;
        top: 0;
        left: 0;
        right: 0;
        height: 4px;
        background: linear-gradient(90deg, #FEC63F, #ff6b6b, #4ecdc4, #45b7d1);
        background-size: 300% 100%;
        animation: gradientShift 3s ease-in-out infinite;
        z-index: 1;
    }

    @keyframes gradientShift {
        0%, 100% { background-position: 0% 50%; }
        50% { background-position: 100% 50%; }
    }

    .product-card:hover {
        transform: translateY(-15px) scale(1.02);
        box-shadow: 0 30px 60px rgba(0, 0, 0, 0.2);
    }

    .product-card:hover::before {
        height: 6px;
    }

    .image-container {
        position: relative;
        overflow: hidden;
        border-radius: 20px 20px 0 0;
        height: 280px;
        background: linear-gradient(135deg, #f5f7fa 0%, #c3cfe2 100%);
    }

    .product-image {
        width: 100%;
        height: 100%;
        object-fit: cover;
        transition: all 0.6s cubic-bezier(0.175, 0.885, 0.32, 1.275);
        filter: brightness(1.1) contrast(1.05);
    }

    .product-card:hover .product-image {
        transform: scale(1.1) rotate(2deg);
        filter: brightness(1.2) contrast(1.1);
    }

    .image-overlay {
        position: absolute;
        top: 0;
        left: 0;
        right: 0;
        bottom: 0;
        background: linear-gradient(135deg, rgba(254, 198, 63, 0.8), rgba(255, 107, 107, 0.6));
        opacity: 0;
        transition: all 0.4s ease;
        display: flex;
        align-items: center;
        justify-content: center;
    }

    .product-card:hover .image-overlay {
        opacity: 1;
    }

    .overlay-icon {
        color: white;
        font-size: 48px;
        transform: scale(0);
        transition: all 0.3s cubic-bezier(0.68, -0.55, 0.265, 1.55);
    }

    .product-card:hover .overlay-icon {
        transform: scale(1);
    }

    .content-section {
        padding: 25px;
        position: relative;
    }

    .product-title {
        font-size: 1.4rem;
        font-weight: 700;
        color: #2c3e50;
        margin-bottom: 15px;
        line-height: 1.3;
        background: linear-gradient(135deg, #2c3e50, #3498db);
        -webkit-background-clip: text;
        -webkit-text-fill-color: transparent;
        background-clip: text;
        transition: all 0.3s ease;
    }

    .product-card:hover .product-title {
        transform: translateY(-5px);
    }

    .description-container {
        height: 140px;
        overflow: hidden;
        position: relative;
        margin-bottom: 20px;
    }

    .product-description {
        font-size: 0.95rem;
        line-height: 1.6;
        color: #555;
        text-align: justify;
        transition: all 0.3s ease;
    }

    .description-fade {
        position: absolute;
        bottom: 0;
        left: 0;
        right: 0;
        height: 30px;
        background: linear-gradient(transparent, rgba(255, 255, 255, 0.95));
        pointer-events: none;
    }

    .button-container {
        display: flex;
        gap: 10px;
        align-items: center;
    }

    .see-details-btn {
        flex: 1;
        background: linear-gradient(135deg, #FEC63F, #ff6b6b);
        color: white !important;
        text-decoration: none;
        padding: 14px 20px;
        border-radius: 50px;
        font-weight: 600;
        text-align: center;
        transition: all 0.4s cubic-bezier(0.175, 0.885, 0.32, 1.275);
        position: relative;
        overflow: hidden;
        box-shadow: 0 8px 25px rgba(254, 198, 63, 0.3);
        display: inline-block;
    }

    .see-details-btn::before {
        content: '';
        position: absolute;
        top: 0;
        left: -100%;
        width: 100%;
        height: 100%;
        background: linear-gradient(90deg, transparent, rgba(255, 255, 255, 0.3), transparent);
        transition: all 0.6s ease;
    }

    .see-details-btn:hover::before {
        left: 100%;
    }

    .see-details-btn:hover {
        transform: translateY(-3px);
        box-shadow: 0 15px 35px rgba(254, 198, 63, 0.4);
        background: linear-gradient(135deg, #ff6b6b, #FEC63F);
        color: white !important;
    }

    .favorite-btn {
        width: 50px;
        height: 50px;
        border-radius: 50%;
        background: rgba(255, 255, 255, 0.9);
        border: 2px solid #FEC63F;
        display: flex;
        align-items: center;
        justify-content: center;
        cursor: pointer;
        transition: all 0.3s ease;
        backdrop-filter: blur(10px);
        font-size: 20px;
    }

    .favorite-btn:hover {
        background: #FEC63F;
        color: white;
        transform: scale(1.1);
    }

    .product-badge {
        position: absolute;
        top: 15px;
        right: 15px;
        background: linear-gradient(135deg, #ff6b6b, #ee5a52);
        color: white;
        padding: 8px 15px;
        border-radius: 20px;
        font-size: 0.8rem;
        font-weight: 600;
        z-index: 2;
        animation: bounceIn 0.6s ease;
    }

    @keyframes bounceIn {
        0% { transform: scale(0); }
        50% { transform: scale(1.2); }
        100% { transform: scale(1); }
    }

    /* Floating animation */
    .product-card:nth-child(odd) {
        animation: fadeInUp 0.6s ease forwards, float 6s ease-in-out infinite 1s;
    }

    .product-card:nth-child(even) {
        animation: fadeInUp 0.6s ease forwards, float 6s ease-in-out infinite reverse 1s;
    }

    @keyframes float {
        0%, 100% { transform: translateY(0px); }
        50% { transform: translateY(-10px); }
    }

    /* Language-specific styles */
    .rtl .product-description {
        text-align: right;
    }

    /* Responsive design */
    @media (max-width: 768px) {
        .products-grid {
            grid-template-columns: 1fr;
            gap: 25px;
            padding: 20px 10px;
        }
        
        .product-card {
            margin: 0 5px;
        }

        .image-container {
            height: 220px;
        }

        .product-title {
            font-size: 1.2rem;
        }

        .description-container {
            height: 120px;
        }
    }

    /* Loading shimmer effect */
    .loading .product-card {
        background: linear-gradient(90deg, #f0f0f0 25%, #e0e0e0 50%, #f0f0f0 75%);
        background-size: 200% 100%;
        animation: shimmer 2s infinite;
    }

    @keyframes shimmer {
        0% { background-position: -200% 0; }
        100% { background-position: 200% 0; }
    }
</style>
@endpush

@section('content')
<section class="page-title" style="background-image: url({{ asset('uploads/'.$global_setting->banner) }});">
    <div class="auto-container">
        <div class="title-outer">
            <h1 class="title">{{ $subcategory_name }}</h1>
            <ul class="page-breadcrumb">
                <li><a href="{{ route('home') }}">{{ __('Home') }}</a></li>
                <li>{{ __('Products') }}</li>
                <li>
                    @if(session('sess_lang_code') == 'ar')
                        {{ $products_category->name_ar ?? $category_name }}
                    @elseif(session('sess_lang_code') == 'krd')
                        {{ $products_category->name_krd ?? $category_name }}
                    @else
                        {{ $products_category->name_en ?? $category_name }}
                    @endif
                </li>
            </ul>
        </div>
    </div>
</section>

<section class="services-section">
    <div class="auto-container" style="max-width: 1200px;">
        <div class="products-grid">
            @foreach($products as $index => $product)
                <div class="product-card" style="animation-delay: {{ ($index * 0.1) }}s;">
                    <div class="image-container">
                        <img src="{{ asset('uploads/'.$product->photo) }}" 
                             alt="@if(session('sess_lang_code') == 'ar'){{ $product->name_ar }}@elseif(session('sess_lang_code') == 'krd'){{ $product->name_krd }}@else{{ $product->name_en }}@endif" 
                             class="product-image">
                        <div class="image-overlay">
                            <div class="overlay-icon">👁️</div>
                        </div>
                        <div class="product-badge">{{ __('Premium') }}</div>
                    </div>
                    
                    <div class="content-section">
                        <h3 class="product-title">
                            @if(session('sess_lang_code') == 'ar')
                                {{ $product->name_ar }}
                            @elseif(session('sess_lang_code') == 'krd')
                                {{ $product->name_krd }}
                            @else
                                {{ $product->name_en }}
                            @endif
                        </h3>
                        
                        <div class="description-container">
                            <p class="product-description">
                                @if(session('sess_lang_code') == 'ar')
                                    {!! str_replace(["<p>", "</p>"], ["", ""], clean(nl2br($product->short_description_ar))) !!}
                                @elseif(session('sess_lang_code') == 'krd')
                                    {!! str_replace(["<p>", "</p>"], ["", ""], clean(nl2br($product->short_description_krd))) !!}
                                @else
                                    {!! str_replace(["<p>", "</p>"], ["", ""], clean(nl2br($product->short_description_en))) !!}
                                @endif
                            </p>
                            <div class="description-fade"></div>
                        </div>
                        
                        <div class="button-container">
                            <a href="{{ route('productsdetail',[$product->id,$product->category]) }}" class="see-details-btn">
                                {{ __('See Details') }}
                            </a>
                            <button class="favorite-btn" onclick="toggleFavorite(this)">♡</button>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
    </div>
</section>
@endsection

@push('scripts')
<script>
    // Enhanced JavaScript animations and interactions
    document.addEventListener('DOMContentLoaded', function() {
        // Add hover effects with enhanced animations
        document.querySelectorAll('.product-card').forEach((card, index) => {
            // Staggered animation on load
            card.style.animationDelay = (index * 0.1) + 's';
            
            card.addEventListener('mouseenter', function() {
                this.style.transform = 'translateY(-15px) scale(1.02)';
                this.style.zIndex = '10';
            });
            
            card.addEventListener('mouseleave', function() {
                this.style.transform = 'translateY(0) scale(1)';
                this.style.zIndex = '1';
            });
        });

        // Smooth scroll reveal animation with Intersection Observer
        const observerOptions = {
            threshold: 0.1,
            rootMargin: '0px 0px -50px 0px'
        };

        const observer = new IntersectionObserver(function(entries) {
            entries.forEach(entry => {
                if (entry.isIntersecting) {
                    entry.target.classList.add('animate-in');
                    // Add a slight delay for each card
                    const cards = Array.from(document.querySelectorAll('.product-card'));
                    const index = cards.indexOf(entry.target);
                    entry.target.style.animationDelay = (index * 0.1) + 's';
                }
            });
        }, observerOptions);

        document.querySelectorAll('.product-card').forEach(card => {
            observer.observe(card);
        });

        // Add loading animation for images
        document.querySelectorAll('.product-image').forEach(img => {
            img.addEventListener('load', function() {
                this.style.opacity = '1';
                this.style.transform = 'scale(1)';
            });
            
            // Set initial state
            img.style.opacity = '0';
            img.style.transform = 'scale(1.1)';
            img.style.transition = 'all 0.6s ease';
        });

        // Add ripple effect to buttons
        document.querySelectorAll('.see-details-btn').forEach(btn => {
            btn.addEventListener('click', function(e) {
                let ripple = document.createElement('span');
                ripple.classList.add('ripple');
                this.appendChild(ripple);
                
                let x = e.clientX - e.target.offsetLeft;
                let y = e.clientY - e.target.offsetTop;
                
                ripple.style.left = x + 'px';
                ripple.style.top = y + 'px';
                
                setTimeout(() => {
                    ripple.remove();
                }, 600);
            });
        });

        // Add parallax effect on scroll
        window.addEventListener('scroll', function() {
            const scrolled = window.pageYOffset;
            const parallax = document.querySelector('.page-title');
            if (parallax) {
                const speed = scrolled * 0.5;
                parallax.style.transform = 'translateY(' + speed + 'px)';
            }
        });

        // Add tilt effect on mouse move
        document.querySelectorAll('.product-card').forEach(card => {
            card.addEventListener('mousemove', function(e) {
                const rect = this.getBoundingClientRect();
                const x = e.clientX - rect.left;
                const y = e.clientY - rect.top;
                
                const centerX = rect.width / 2;
                const centerY = rect.height / 2;
                
                const rotateX = (y - centerY) / 10;
                const rotateY = (centerX - x) / 10;
                
                this.style.transform = `translateY(-15px) scale(1.02) rotateX(${rotateX}deg) rotateY(${rotateY}deg)`;
            });
            
            card.addEventListener('mouseleave', function() {
                this.style.transform = 'translateY(0) scale(1) rotateX(0deg) rotateY(0deg)';
            });
        });
    });

    // Favorite button functionality with animation
    function toggleFavorite(btn) {
        if (btn.innerHTML === '♡') {
            btn.innerHTML = '♥';
            btn.style.color = '#ff6b6b';
            btn.style.background = '#fff';
            btn.style.transform = 'scale(1.3)';
            
            // Create heart particles effect
            createHeartParticles(btn);
            
            setTimeout(() => {
                btn.style.transform = 'scale(1)';
            }, 200);
        } else {
            btn.innerHTML = '♡';
            btn.style.color = 'inherit';
            btn.style.transform = 'scale(0.9)';
            
            setTimeout(() => {
                btn.style.transform = 'scale(1)';
            }, 200);
        }
    }

    // Create heart particles animation
    function createHeartParticles(button) {
        for (let i = 0; i < 6; i++) {
            let heart = document.createElement('div');
            heart.innerHTML = '♥';
            heart.style.position = 'absolute';
            heart.style.color = '#ff6b6b';
            heart.style.fontSize = '12px';
            heart.style.pointerEvents = 'none';
            heart.style.zIndex = '1000';
            
            const rect = button.getBoundingClientRect();
            heart.style.left = (rect.left + rect.width/2) + 'px';
            heart.style.top = (rect.top + rect.height/2) + 'px';
            
            document.body.appendChild(heart);
            
            // Animate the heart
            let angle = (Math.PI * 2 * i) / 6;
            let velocity = 2;
            let x = Math.cos(angle) * velocity;
            let y = Math.sin(angle) * velocity;
            
            heart.animate([
                { transform: 'translate(0, 0) scale(1)', opacity: 1 },
                { transform: `translate(${x * 50}px, ${y * 50}px) scale(0)`, opacity: 0 }
            ], {
                duration: 1000,
                easing: 'ease-out'
            }).onfinish = () => heart.remove();
        }
    }

    // Add CSS for ripple effect
    const style = document.createElement('style');
    style.textContent = `
        .see-details-btn {
            position: relative;
            overflow: hidden;
        }
        
        .ripple {
            position: absolute;
            border-radius: 50%;
            transform: scale(0);
            animation: ripple-animation 0.6s linear;
            background-color: rgba(255, 255, 255, 0.3);
        }
        
        @keyframes ripple-animation {
            to {
                transform: scale(4);
                opacity: 0;
            }
        }
        
        .animate-in {
            animation: slideInUp 0.8s cubic-bezier(0.175, 0.885, 0.32, 1.275) forwards;
        }
        
        @keyframes slideInUp {
            from {
                opacity: 0;
                transform: translateY(50px);
            }
            to {
                opacity: 1;
                transform: translateY(0);
            }
        }
    `;
    document.head.appendChild(style);
</script>
@endpush