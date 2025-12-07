@extends('layouts.app')

@section('styles')
<link href="https://unpkg.com/aos@2.3.1/dist/aos.css" rel="stylesheet">
<link rel="stylesheet" href="https://unpkg.com/swiper/swiper-bundle.min.css">
<style>

    /* Custom Animation Styles */


    @keyframes fadeInUp {
        from {
            opacity: 0;
            transform: translateY(20px);
        }
        to {
            opacity: 1;
            transform: translateY(0);
        }
    }
    
    @keyframes blob {
        0% { transform: translate(0px, 0px) scale(1); }
        33% { transform: translate(30px, -50px) scale(1.1); }
        66% { transform: translate(-20px, 20px) scale(0.9); }
        100% { transform: translate(0px, 0px) scale(1); }
    }
    
    @keyframes float {
        0% { transform: translateY(0px); }
        50% { transform: translateY(-10px); }
        100% { transform: translateY(0px); }
    }
    
    @keyframes pulse-ring {
        0% { transform: scale(0.85); opacity: 0.6; }
        50% { transform: scale(1); opacity: 1; }
        100% { transform: scale(0.85); opacity: 0.6; }
    }
    
    /* Animation Classes */
    .animate-fade-in-up { animation: fadeInUp 1s ease-out forwards; }
    .animate-blob { animation: blob 7s infinite; }
    .animate-float { animation: float 4s ease-in-out infinite; }
    .animate-pulse-ring { animation: pulse-ring 2s cubic-bezier(0.4, 0, 0.6, 1) infinite; }
    
    /* Animation Delays */
    .animation-delay-2000 { animation-delay: 2s; }
    .animation-delay-4000 { animation-delay: 4s; }
    
    /* Parallax Effect */
    .parallax {
        background-attachment: fixed;
        background-position: center;
        background-repeat: no-repeat;
        background-size: cover;
        position: relative;
    }
    
    .scrollbar-hide::-webkit-scrollbar {
    display: none; 
    }
    /* Custom Utility Classes */
    .bg-gradient-primary {
        background: linear-gradient(to right, #c2410c, #a16207);
    }
    
    .text-gradient {
        background: linear-gradient(to right, #ea580c, #ca8a04);
        -webkit-background-clip: text;
        -webkit-text-fill-color: transparent;
    }
    
    .transition-all-300 {
        transition: all 0.3s ease;
    }
    
    .ripple-bg {
        position: relative;
        overflow: hidden;
    }
    
    .ripple-bg::after {
        content: '';
        position: absolute;
        width: 200%;
        height: 200%;
        top: -50%;
        left: -50%;
        background: radial-gradient(circle, rgba(255,255,255,0.2) 0%, rgba(255,255,255,0) 60%);
        animation: ripple 15s linear infinite;
        z-index: 0;
    }
    
    @keyframes ripple {
        0% { transform: rotate(0deg); }
        100% { transform: rotate(360deg); }
    }
    
    .scroll-indicator {
        position: absolute;
        bottom: 30px;
        left: 50%;
        transform: translateX(-50%);
        z-index: 10;
    }
    
    .scroll-indicator::before {
        content: '';
        width: 40px;
        height: 40px;
        position: absolute;
        top: -20px;
        left: -8px;
        border-radius: 50%;
        background: rgba(255,255,255,0.2);
        animation: pulse-ring 2s cubic-bezier(0.4, 0, 0.6, 1) infinite;
    }
    
    /* Product Card Effects */
    .product-card {
        transition: all 0.4s ease;
        will-change: transform;
    }
    
    .product-card:hover {
        transform: translateY(-12px);
    }
    
    .product-card .quick-view {
        opacity: 0;
        transform: translateY(20px);
        transition: all 0.3s ease;
    }
    
    .product-card:hover .quick-view {
        opacity: 1;
        transform: translateY(0);
    }
    
    .product-card .product-img {
        transform: scale(1);
        transition: transform 0.6s cubic-bezier(0.215, 0.61, 0.355, 1);
    }
    
    .product-card:hover .product-img {
        transform: scale(1.08);
    }
    
    .badge-new {
        position: absolute;
        top: 12px;
        right: 12px;
        background: linear-gradient(to right, #c2410c, #a16207);
        color: white;
        font-size: 0.75rem;
        font-weight: 600;
        padding: 0.25rem 0.75rem;
        border-radius: 9999px;
        box-shadow: 0 4px 6px rgba(249, 115, 22, 0.3);
        animation: pulse 2s cubic-bezier(0.4, 0, 0.6, 1) infinite;
    }
    
    /* Category card effects */
    .category-card {
        position: relative;
        overflow: hidden;
    }
    
    .category-card::before {
        content: '';
        position: absolute;
        top: 0;
        left: 0;
        right: 0;
        bottom: 0;
        background: linear-gradient(to top, rgba(0, 0, 0, 0.8) 0%, transparent 60%);
        z-index: 1;
        transition: opacity 0.4s ease;
    }
    
    .category-card:hover::before {
        opacity: 0.9;
    }
    
    /* Hero elements */
    .hero-blob {
        position: absolute;
        border-radius: 50%;
        filter: blur(40px);
        opacity: 0.2;
        mix-blend-mode: multiply;
    }
    
    /* Hide scrollbar for all browsers */
    .scrollbar-hide {
        -ms-overflow-style: none; /* IE and Edge */
        scrollbar-width: none; /* Firefox */
    }

    .scrollbar-hide::-webkit-scrollbar {
        display: none; /* Chrome, Safari, and Opera */
        width: 0;
        height: 0;
    }

    /* Additional styling for Swiper to hide scrollbar */
    .swiper-container {
        overflow: hidden !important;
    }

    #testimonial-swiper {
        overflow: hidden !important;
    }
    
    /* Promo Banner Styles */
    .promo-banner {
        position: relative;
        overflow: hidden;
        border-radius: 0.5rem;
    }
    
    .promo-banner-bg {
        background: linear-gradient(135deg, #c2410c 0%, #a16207 100%);
        position: relative;
    }
    
    .promo-pattern {
        position: absolute;
        top: 0;
        left: 0;
        width: 100%;
        height: 100%;
        background-image: url("data:image/svg+xml,%3Csvg width='100' height='100' viewBox='0 0 100 100' xmlns='http://www.w3.org/2000/svg'%3E%3Cpath d='M11 18c3.866 0 7-3.134 7-7s-3.134-7-7-7-7 3.134-7 7 3.134 7 7 7zm48 25c3.866 0 7-3.134 7-7s-3.134-7-7-7-7 3.134-7 7 3.134 7 7 7zm-43-7c1.657 0 3-1.343 3-3s-1.343-3-3-3-3 1.343-3 3 1.343 3 3 3zm63 31c1.657 0 3-1.343 3-3s-1.343-3-3-3-3 1.343-3 3 1.343 3 3 3zM34 90c1.657 0 3-1.343 3-3s-1.343-3-3-3-3 1.343-3 3 1.343 3 3 3zm56-76c1.657 0 3-1.343 3-3s-1.343-3-3-3-3 1.343-3 3 1.343 3 3 3zM12 86c2.21 0 4-1.79 4-4s-1.79-4-4-4-4 1.79-4 4 1.79 4 4 4zm28-65c2.21 0 4-1.79 4-4s-1.79-4-4-4-4 1.79-4 4 1.79 4 4 4zm23-11c2.76 0 5-2.24 5-5s-2.24-5-5-5-5 2.24-5 5 2.24 5 5 5zm-6 60c2.21 0 4-1.79 4-4s-1.79-4-4-4-4 1.79-4 4 1.79 4 4 4zm29 22c2.76 0 5-2.24 5-5s-2.24-5-5-5-5 2.24-5 5 2.24 5 5 5zM32 63c2.76 0 5-2.24 5-5s-2.24-5-5-5-5 2.24-5 5 2.24 5 5 5zm57-13c2.76 0 5-2.24 5-5s-2.24-5-5-5-5 2.24-5 5 2.24 5 5 5zm-9-21c1.105 0 2-.895 2-2s-.895-2-2-2-2 .895-2 2 .895 2 2 2zM60 91c1.105 0 2-.895 2-2s-.895-2-2-2-2 .895-2 2 .895 2 2 2zM35 41c1.105 0 2-.895 2-2s-.895-2-2-2-2 .895-2 2 .895 2 2 2zM12 60c1.105 0 2-.895 2-2s-.895-2-2-2-2 .895-2 2 .895 2 2 2z' fill='%23ffffff' fill-opacity='0.1' fill-rule='evenodd'/%3E%3C/svg%3E");
        opacity: 0.6;
    }
    
    .promo-code {
        position: relative;
        background: rgba(255, 255, 255, 0.2);
        border: 1px dashed rgba(255, 255, 255, 0.4);
        border-radius: 0.375rem;
        transition: all 0.3s;
    }
    
    .promo-code:hover {
        background: rgba(255, 255, 255, 0.3);
        transform: scale(1.03);
    }
    
    .copy-button {
        position: absolute;
        right: 0.5rem;
        top: 50%;
        transform: translateY(-50%);
        transition: all 0.2s;
    }
    
    .copy-button:hover {
        transform: translateY(-50%) scale(1.1);
    }
    
    .promo-countdown {
        display: flex;
        gap: 0.5rem;
    }
    
    .countdown-item {
        background: rgba(255, 255, 255, 0.15);
        backdrop-filter: blur(5px);
        border-radius: 0.375rem;
        min-width: 3rem;
        text-align: center;
        padding: 0.5rem;
    }
    
    @keyframes pulse-border {
        0% {
            box-shadow: 0 0 0 0 rgba(255, 255, 255, 0.4);
        }
        70% {
            box-shadow: 0 0 0 10px rgba(255, 255, 255, 0);
        }
        100% {
            box-shadow: 0 0 0 0 rgba(255, 255, 255, 0);
        }
    }
    
    .pulse-border {
        animation: pulse-border 2s infinite;
    }

    /* animasi */

    .ocean { 
        height: 150px;
        width: 100%;
        position: absolute;
        bottom: 0;
        left: 0;
        background: #c2410c;
        overflow: hidden;
    }

    .wave {
        background: url('{{ asset('images/wave.svg') }}?v={{ time() }}') repeat-x;
        background-size: 1600px 198px;
        position: absolute;
        top: -48px;
        width: 6400px;
        height: 198px;
        animation: wave 15s linear infinite;
        transform: translate3d(0, 0, 0);
    }

    .wave:nth-of-type(2) {
        top: -30px;
        animation: wave 15s linear -7s infinite;
        opacity: 0.5;
    }

    @keyframes wave {
        0% {
            margin-left: 0;
        }
        100% {
            margin-left: -1600px;
        }
    }

    @keyframes swell {
        0%, 100% {
            transform: translate3d(0,-25px,0);
        }
        50% {
            transform: translate3d(0,5px,0);
        }
    }
</style>
@endsection

@section('content')
    <!-- Hero Section - Split Screen Modern Design -->
    <div class="relative min-h-screen overflow-hidden">
        @if(isset($homeBanner) && $homeBanner->banner_image && !empty($homeBanner->banner_image))
            <!-- Banner Image Background -->
            <div class="absolute inset-0 overflow-hidden">
                <img src="{{ Storage::url($homeBanner->banner_image) }}" alt="{{ $homeBanner->banner_title ?? 'Fixpoint Material Bangunan' }}" 
                     class="w-full h-full object-cover object-center"
                     onerror="this.parentElement.innerHTML='<div class=\'w-full h-full bg-gradient-to-br from-slate-900 via-orange-900 to-amber-800\'></div>'">
                <div class="absolute inset-0 bg-gradient-to-r from-slate-900/90 via-slate-900/70 to-transparent"></div>
            </div>
        @else
            <!-- Modern Split Background -->
            <div class="absolute inset-0">
                <!-- Left Side - Dark -->
                <div class="absolute inset-y-0 left-0 w-full lg:w-3/5 bg-gradient-to-br from-slate-900 via-slate-800 to-slate-900"></div>
                <!-- Right Side - Orange Gradient -->
                <div class="absolute inset-y-0 right-0 w-2/5 hidden lg:block bg-gradient-to-br from-orange-500 via-orange-600 to-amber-600">
                    <!-- Animated gradient overlay -->
                    <div class="absolute inset-0 bg-gradient-to-t from-orange-700/50 to-transparent"></div>
                </div>
                
                <!-- Isometric Grid Pattern -->
                <div class="absolute inset-0 opacity-[0.03]">
                    <svg class="w-full h-full" viewBox="0 0 100 100" preserveAspectRatio="none">
                        <defs>
                            <pattern id="iso-grid" width="20" height="20" patternUnits="userSpaceOnUse" patternTransform="rotate(30)">
                                <line x1="0" y1="0" x2="20" y2="0" stroke="white" stroke-width="0.5"/>
                                <line x1="0" y1="0" x2="0" y2="20" stroke="white" stroke-width="0.5"/>
                            </pattern>
                        </defs>
                        <rect width="100" height="100" fill="url(#iso-grid)"/>
                    </svg>
                </div>
                
                <!-- Gradient Orbs -->
                <div class="absolute top-1/4 left-1/4 w-96 h-96 bg-orange-500/20 rounded-full blur-[100px] animate-pulse"></div>
                <div class="absolute bottom-1/4 right-1/3 w-80 h-80 bg-amber-500/10 rounded-full blur-[80px] animate-pulse" style="animation-delay: 1s;"></div>
            </div>
        @endif

        <!-- Main Content -->
        <div class="relative min-h-screen flex items-center">
            <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 w-full py-20 lg:py-0">
                <div class="grid grid-cols-1 lg:grid-cols-2 gap-12 lg:gap-20 items-center">
                    
                    <!-- Left Content -->
                    <div class="text-center lg:text-left z-10" data-aos="fade-right" data-aos-duration="800">
                        <!-- Badge -->
                        <div class="inline-flex items-center gap-2 px-4 py-2 rounded-full bg-orange-500/10 border border-orange-500/20 backdrop-blur-sm mb-8" data-aos="fade-down" data-aos-delay="200">
                            <span class="relative flex h-2 w-2">
                                <span class="animate-ping absolute inline-flex h-full w-full rounded-full bg-orange-400 opacity-75"></span>
                                <span class="relative inline-flex rounded-full h-2 w-2 bg-orange-500"></span>
                            </span>
                            <span class="text-orange-400 text-sm font-medium">Toko Material #1 di Indonesia</span>
                        </div>
                        
                        <!-- Headline -->
                        <h1 class="text-4xl sm:text-5xl lg:text-6xl xl:text-7xl font-black text-white leading-[1.1] mb-6" data-aos="fade-up" data-aos-delay="300">
                            Bangun Impian
                            <span class="block mt-2">
                                <span class="text-transparent bg-clip-text bg-gradient-to-r from-orange-400 via-amber-400 to-yellow-400">Dengan Material</span>
                            </span>
                            <span class="block mt-2">Terbaik</span>
                        </h1>
                        
                        <!-- Description -->
                        <p class="text-lg lg:text-xl text-slate-300 max-w-xl mx-auto lg:mx-0 mb-10 leading-relaxed" data-aos="fade-up" data-aos-delay="400">
                            Dari fondasi hingga finishing, kami menyediakan semua kebutuhan material bangunan berkualitas tinggi dengan harga terjangkau.
                        </p>
                        
                        <!-- CTA Buttons -->
                        <div class="flex flex-col sm:flex-row gap-4 justify-center lg:justify-start mb-12" data-aos="fade-up" data-aos-delay="500">
                            <a href="{{ route('shop') }}" 
                               class="group relative inline-flex items-center justify-center px-8 py-4 text-base font-semibold rounded-xl text-white bg-gradient-to-r from-orange-500 to-amber-500 hover:from-orange-600 hover:to-amber-600 transition-all duration-300 shadow-lg shadow-orange-500/25 hover:shadow-xl hover:shadow-orange-500/30 hover:-translate-y-0.5">
                                <span>Mulai Belanja</span>
                                <svg class="ml-2 w-5 h-5 transition-transform group-hover:translate-x-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 8l4 4m0 0l-4 4m4-4H3"></path>
                                </svg>
                            </a>
                            
                            <a href="#featured" 
                               class="group inline-flex items-center justify-center px-8 py-4 text-base font-semibold rounded-xl text-white border border-white/20 hover:border-white/40 hover:bg-white/5 backdrop-blur-sm transition-all duration-300">
                                <svg class="mr-2 w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M14.752 11.168l-3.197-2.132A1 1 0 0010 9.87v4.263a1 1 0 001.555.832l3.197-2.132a1 1 0 000-1.664z"></path>
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                                </svg>
                                <span>Lihat Katalog</span>
                            </a>
                        </div>
                        
                        <!-- Trust Indicators -->
                        <div class="flex flex-wrap items-center justify-center lg:justify-start gap-8" data-aos="fade-up" data-aos-delay="600">
                            <div class="flex items-center gap-2">
                                <div class="flex -space-x-2">
                                    <div class="w-8 h-8 rounded-full bg-orange-500 flex items-center justify-center text-white text-xs font-bold border-2 border-slate-900">15K</div>
                                </div>
                                <span class="text-slate-400 text-sm">Pelanggan Puas</span>
                            </div>
                            <div class="flex items-center gap-2">
                                <div class="flex items-center text-amber-400">
                                    @for($i = 0; $i < 5; $i++)
                                    <svg class="w-4 h-4" fill="currentColor" viewBox="0 0 20 20">
                                        <path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z"></path>
                                    </svg>
                                    @endfor
                                </div>
                                <span class="text-slate-400 text-sm">4.9 Rating</span>
                            </div>
                        </div>
                    </div>
                    
                    <!-- Right Content - SVG Illustration with Floating Cards -->
                    <div class="relative hidden lg:block" data-aos="fade-left" data-aos-duration="1000">
                        <!-- Main Illustration -->
                        <div class="relative z-10">
                            <div class="animate-float" style="animation-duration: 6s;">
                                <img src="{{ asset('images/Construction truck-amico.svg') }}" 
                                     alt="Construction Illustration" 
                                     class="w-full max-w-lg mx-auto drop-shadow-2xl">
                            </div>
                        </div>
                        
                        <!-- Floating Feature Cards -->
                        <div class="absolute top-10 -left-10 bg-white rounded-2xl p-4 shadow-2xl animate-float z-20" style="animation-delay: 0.5s; animation-duration: 4s;" data-aos="zoom-in" data-aos-delay="700">
                            <div class="flex items-center gap-3">
                                <div class="w-12 h-12 rounded-xl bg-gradient-to-br from-green-400 to-green-600 flex items-center justify-center">
                                    <svg class="w-6 h-6 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path>
                                    </svg>
                                </div>
                                <div>
                                    <div class="text-sm font-bold text-gray-900">Kualitas Premium</div>
                                    <div class="text-xs text-gray-500">Standar SNI</div>
                                </div>
                            </div>
                        </div>
                        
                        <div class="absolute bottom-20 -left-5 bg-white rounded-2xl p-4 shadow-2xl animate-float z-20" style="animation-delay: 1s; animation-duration: 5s;" data-aos="zoom-in" data-aos-delay="800">
                            <div class="flex items-center gap-3">
                                <div class="w-12 h-12 rounded-xl bg-gradient-to-br from-blue-400 to-blue-600 flex items-center justify-center">
                                    <svg class="w-6 h-6 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 16V6a1 1 0 00-1-1H4a1 1 0 00-1 1v10a1 1 0 001 1h1m8-1a1 1 0 01-1 1H9m4-1V8a1 1 0 011-1h2.586a1 1 0 01.707.293l3.414 3.414a1 1 0 01.293.707V16a1 1 0 01-1 1h-1m-6-1a1 1 0 001 1h1M5 17a2 2 0 104 0m-4 0a2 2 0 114 0m6 0a2 2 0 104 0m-4 0a2 2 0 114 0"></path>
                                    </svg>
                                </div>
                                <div>
                                    <div class="text-sm font-bold text-gray-900">Gratis Ongkir</div>
                                    <div class="text-xs text-gray-500">Area dalam kota</div>
                                </div>
                            </div>
                        </div>
                        
                        <div class="absolute top-1/3 -right-5 bg-gradient-to-br from-orange-500 to-amber-500 rounded-2xl p-4 shadow-2xl animate-float z-20" style="animation-delay: 1.5s; animation-duration: 4.5s;" data-aos="zoom-in" data-aos-delay="900">
                            <div class="text-center text-white">
                                <div class="text-2xl font-black">500+</div>
                                <div class="text-xs opacity-90">Jenis Produk</div>
                            </div>
                        </div>
                        
                        <!-- Background Glow for Illustration -->
                        <div class="absolute top-1/2 left-1/2 -translate-x-1/2 -translate-y-1/2 w-96 h-96 bg-orange-500/30 rounded-full blur-[100px] -z-10"></div>
                    </div>
                </div>
            </div>
        </div>
        
        <!-- Scroll Indicator -->
        <div class="absolute bottom-8 left-1/2 -translate-x-1/2 z-20">
            <a href="#featured" class="flex flex-col items-center gap-2 text-white/60 hover:text-white transition-colors">
                <span class="text-xs font-medium uppercase tracking-wider">Scroll</span>
                <div class="w-6 h-10 border-2 border-current rounded-full flex items-start justify-center p-1">
                    <div class="w-1.5 h-3 bg-current rounded-full animate-bounce"></div>
                </div>
            </a>
        </div>
    </div>

    <!-- Benefits Bar with Floating Animation -->
    <div class="relative bg-gradient-to-b from-white to-gray-50 py-20 -mt-12 z-10 overflow-hidden">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <!-- Section Header -->
            <div class="text-center mb-12" data-aos="fade-up">
                <h2 class="text-2xl md:text-3xl font-bold text-gray-900 mb-2">Mengapa Memilih Fixpoint?</h2>
                <p class="text-gray-600">Solusi material bangunan terpercaya untuk proyek Anda</p>
            </div>
            
            <div class="grid grid-cols-1 lg:grid-cols-5 gap-8 items-center">
                <!-- Benefits Grid -->
                <div class="lg:col-span-3 grid grid-cols-2 gap-6">
                    @foreach([
                        ['icon' => 'check', 'title' => 'Kualitas Premium', 'desc' => 'Material standar SNI', 'color' => 'orange'],
                        ['icon' => 'currency-dollar', 'title' => 'Harga Kompetitif', 'desc' => 'Garansi termurah', 'color' => 'orange'],
                        ['icon' => 'truck', 'title' => 'Gratis Pengiriman', 'desc' => 'Area dalam kota', 'color' => 'orange'],
                        ['icon' => 'shield', 'title' => 'Garansi Produk', 'desc' => 'Hingga 1 tahun', 'color' => 'orange']
                    ] as $index => $benefit)
                    <div class="group bg-white p-6 rounded-2xl shadow-sm hover:shadow-xl border border-gray-100 transition-all duration-300 hover:-translate-y-1" data-aos="fade-up" data-aos-delay="{{ $index * 100 }}">
                        <div class="flex items-start gap-4">
                            <div class="flex-shrink-0 w-12 h-12 bg-gradient-to-br from-orange-500 to-amber-500 rounded-xl flex items-center justify-center shadow-lg group-hover:scale-110 transition-transform duration-300">
                                <svg class="h-6 w-6 text-white" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M{{ $benefit['icon'] === 'check' ? '5 13l4 4L19 7' : 
                                        ($benefit['icon'] === 'currency-dollar' ? '12 8c-1.657 0-3 .895-3 2s1.343 2 3 2 3 .895 3 2-1.343 2-3 2m0-8c1.11 0 2.08.402 2.599 1M12 8V7m0 1v8m0 0v1m0-1c-1.11 0-2.08-.402-2.599-1M21 12a9 9 0 11-18 0 9 9 0 0118 0z' : 
                                        ($benefit['icon'] === 'truck' ? '13 16V6a1 1 0 00-1-1H4a1 1 0 00-1 1v10a1 1 0 001 1h1m8-1a1 1 0 01-1 1H9m4-1V8a1 1 0 011-1h2.586a1 1 0 01.707.293l3.414 3.414a1 1 0 01.293.707V16a1 1 0 01-1 1h-1m-6-1a1 1 0 001 1h1M5 17a2 2 0 104 0m-4 0a2 2 0 114 0m6 0a2 2 0 104 0m-4 0a2 2 0 114 0' : 
                                        '9 12l2 2 4-4m5.618-4.016A11.955 11.955 0 0112 2.944a11.955 11.955 0 01-8.618 3.04A12.02 12.02 0 003 9c0 5.591 3.824 10.29 9 11.622 5.176-1.332 9-6.03 9-11.622 0-1.042-.133-2.052-.382-3.016z')) }}"></path>
                                </svg>
                            </div>
                            <div>
                                <h3 class="text-lg font-bold text-gray-900 mb-1">{{ $benefit['title'] }}</h3>
                                <p class="text-gray-500 text-sm">{{ $benefit['desc'] }}</p>
                            </div>
                        </div>
                    </div>
                    @endforeach
                </div>
                
                <!-- SVG Illustration -->
                <div class="lg:col-span-2 hidden lg:flex items-center justify-center" data-aos="fade-left">
                    <div class="relative animate-float" style="animation-duration: 5s;">
                        <div class="absolute inset-0 bg-gradient-to-br from-orange-200 to-amber-100 rounded-full blur-3xl opacity-50"></div>
                        <img src="{{ asset('images/Bricklayer-pana.svg') }}" alt="Bricklayer Illustration" class="relative w-80 h-80 drop-shadow-xl">
                    </div>
                </div>
            </div>
            </div>
        </div>
    </div>

    <!-- Promo Banner Section -->
    @if(isset($homepagePromo))
    <section class="py-12 px-4 bg-white">
        <div class="max-w-7xl mx-auto">
            <div class="promo-banner shadow-xl" data-aos="zoom-in">
                <div class="promo-banner-bg p-8 md:p-10 relative overflow-hidden rounded-xl">
                    <!-- Pattern overlay -->
                    <div class="promo-pattern"></div>
                    
                    <!-- Content -->
                    <div class="grid grid-cols-1 md:grid-cols-5 gap-8 items-center relative z-10">
                        <!-- Left content -->
                        <div class="md:col-span-3">
                            <span class="inline-block px-4 py-1 bg-white bg-opacity-20 text-white text-sm font-semibold rounded-full mb-3">
                                {{ $homepagePromo->promotion_tag ?? 'PENAWARAN TERBATAS' }}
                            </span>
                            <h3 class="text-3xl md:text-4xl font-bold text-white mb-4">
                                {{ $homepagePromo->promotion_title ?? 'Diskon Spesial!' }}
                            </h3>
                            <p class="text-orange-100 mb-6 md:pr-16">
                                {{ $homepagePromo->description  ?? 'Gunakan kode promo untuk mendapatkan diskon spesial. Tawaran berlaku untuk waktu terbatas.' }}
                            </p>
                            
                            <!-- Countdown timer -->
                            @if($homepagePromo->end_date)
                            <div class="mb-8">
                                <p class="text-white mb-2 font-medium">Berakhir dalam:</p>
                                <div class="promo-countdown">
                                    <div class="countdown-item">
                                        <div class="text-2xl font-bold text-white countdown-days timess">00</div>
                                        <div class="text-xs text-orange-100">Hari</div>
                                    </div>
                                    <div class="countdown-item">
                                        <div class="text-2xl font-bold text-white countdown-hours timess">00</div>
                                        <div class="text-xs text-orange-100">Jam</div>
                                    </div>
                                    <div class="countdown-item">
                                        <div class="text-2xl font-bold text-white countdown-minutes timess">00</div>
                                        <div class="text-xs text-orange-100">Menit</div>
                                    </div>
                                    <div class="countdown-item">
                                        <div class="text-2xl font-bold text-white timess">00</div>
                                        <div class="text-xs text-orange-100">Detik</div>
                                    </div>
                                </div>
                            </div>
                            @endif
                            
                            <a href="{{ route('shop') }}" class="inline-flex items-center px-6 py-3 bg-white text-orange-800 font-medium rounded-md hover:bg-orange-50 transition-all duration-300 transform hover:scale-105 shadow-lg">
                                Belanja Sekarang
                                <svg class="ml-2 w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M14 5l7 7m0 0l-7 7m7-7H3"></path>
                                </svg>
                            </a>
                        </div>
                        
                        <!-- Right content - Promo code -->
                        <div class="md:col-span-2 bg-white bg-opacity-10 backdrop-blur-sm rounded-xl p-6 border border-white border-opacity-20 pulse-border">
                            <h4 class="text-xl font-semibold text-white mb-2">Gunakan Kode Promo:</h4>
                            <p class="text-blue-100 mb-4 text-sm">Salin kode berikut untuk mendapatkan diskon {{ $homepagePromo->formatted_discount }}</p>
                            
                            <div class="relative promo-code py-3 px-4 mb-4">
                                <span class="block text-xl font-mono font-bold text-white select-all" id="promo-code">{{ $homepagePromo->code }}</span>
                                <button type="button" class="copy-button bg-white bg-opacity-20 hover:bg-opacity-30 rounded-md p-2" id="copy-promo-button">
                                    <svg class="w-5 h-5 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 5H6a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2v-1M8 5a2 2 0 002 2h2a2 2 0 002-2M8 5a2 2 0 012-2h2a2 2 0 012 2v3m2 4H10m0 0l3-3m-3 3l3 3"></path>
                                    </svg>
                                </button>
                            </div>
                            
                            <div class="text-center">
                                <span class="text-xs text-orange-100">
                                    {{ $homepagePromo->promotion_note ?? 
                                      ($homepagePromo->minimum_order > 0 ? 
                                      '*Minimum transaksi Rp ' . number_format($homepagePromo->minimum_order, 0, ',', '.') : 
                                      '*Syarat dan ketentuan berlaku') }}
                                </span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    @endif

    <!-- Featured Categories with Staggered Animation -->
    <section id="featured" class="py-24 bg-gray-50">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="text-center mb-16" data-aos="fade-up">
                <span class="inline-block px-3 py-1 bg-orange-200 text-orange-800 rounded-full text-sm font-semibold mb-3">KATEGORI UNGGULAN</span>
                <h2 class="text-3xl md:text-4xl font-extrabold text-gray-900">
                    <span class="block relative">
                        Koleksi Kategori
                        <span class="absolute -bottom-2 left-1/2 transform -translate-x-1/2 w-24 h-1 bg-orange-700 rounded"></span>
                    </span>
                </h2>
                <p class="mt-6 max-w-2xl text-xl text-gray-500 mx-auto">
                    Temukan material bangunan sesuai kebutuhan proyek Anda
                </p>
            </div>
            
            <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-8">
                @foreach ($categories->take(6) as $index => $category)
                <div class="category-card rounded-xl overflow-hidden shadow-xl" data-aos="fade-up" data-aos-delay="{{ $index * 100 }}">
                    <div class="relative aspect-w-16 aspect-h-10">
                        @if($category->image && !empty($category->image))
                        <img src="{{ Storage::url($category->image) }}" alt="{{ $category->name }}"
                             class="w-full h-80 object-cover transition-transform duration-700 transform hover:scale-110"
                             onerror="this.src='data:image/svg+xml,%3Csvg xmlns=\'http://www.w3.org/2000/svg\' width=\'400\' height=\'320\' viewBox=\'0 0 400 320\'%3E%3Crect fill=\'%23f97316\' width=\'400\' height=\'320\'/%3E%3Ctext fill=\'%23fff\' font-family=\'Arial\' font-size=\'20\' x=\'50%25\' y=\'50%25\' text-anchor=\'middle\' dy=\'.3em\'%3E{{ $category->name }}%3C/text%3E%3C/svg%3E'">
                        @else
                        <div class="w-full h-80 bg-gradient-to-br from-orange-600 to-amber-500 flex items-center justify-center">
                            <span class="text-white text-2xl font-bold">{{ $category->name }}</span>
                        </div>
                        @endif
                    </div>
                    <div class="absolute inset-0 flex flex-col justify-end p-8 z-10">
                        <div data-aos="fade-right" data-aos-delay="{{ $index * 100 + 200 }}">
                            <h3 class="text-2xl font-bold text-white mb-2">{{ $category->name }}</h3>
                            <p class="text-gray-200 mb-4 max-w-xs">{{ $category->description ?? 'Koleksi ' . $category->name . ' dengan berbagai pilihan kualitas dan ukuran.' }}</p>
                        </div>
                        <a href="{{ route('shop', ['category' => $category->id]) }}" 
                           class="inline-flex items-center px-4 py-2 bg-white text-orange-800 font-medium rounded-md hover:bg-orange-50 transition-all duration-300 transform translate-y-0 hover:translate-y-0 hover:scale-105 shadow-lg max-w-max">
                            <span>Jelajahi Koleksi</span>
                            <svg class="ml-2 w-4 h-4 transition-all duration-300 transform group-hover:translate-x-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M14 5l7 7m0 0l-7 7m7-7H3"></path>
                            </svg>
                        </a>
                    </div>
                </div>
                @endforeach
            </div>
        </div>
    </section>

    <!-- Trending Collection Banner -->
    <section class="relative py-20 bg-gradient-to-b from-gray-50 to-white overflow-hidden">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="grid grid-cols-1 lg:grid-cols-2 gap-12 items-center">
                <!-- Left Content -->
                <div data-aos="fade-right">
                    <span class="inline-block px-4 py-1.5 bg-orange-100 text-orange-700 rounded-full text-sm font-semibold mb-6">KOLEKSI TERBARU 2025</span>
                    <h2 class="text-4xl md:text-5xl font-bold text-gray-900 mb-6 leading-tight">Material Berkualitas untuk Proyek Impian Anda</h2>
                    <p class="text-gray-600 text-lg mb-8 leading-relaxed">Temukan berbagai pilihan material bangunan premium dengan harga terbaik. Pengiriman cepat dan garansi kualitas terjamin.</p>
                    
                    <!-- Stats Row -->
                    <div class="flex gap-8 mb-8">
                        <div>
                            <div class="text-3xl font-bold text-orange-600">500+</div>
                            <div class="text-gray-500 text-sm">Jenis Produk</div>
                        </div>
                        <div>
                            <div class="text-3xl font-bold text-orange-600">15K+</div>
                            <div class="text-gray-500 text-sm">Pelanggan Puas</div>
                        </div>
                        <div>
                            <div class="text-3xl font-bold text-orange-600">25+</div>
                            <div class="text-gray-500 text-sm">Tahun Pengalaman</div>
                        </div>
                    </div>
                    
                    <a href="{{ route('shop') }}" 
                       class="inline-flex items-center px-8 py-4 bg-gradient-to-r from-orange-600 to-amber-500 text-white font-semibold rounded-xl transition-all duration-300 transform hover:scale-105 shadow-lg hover:shadow-orange-200 hover:shadow-xl group">
                        Jelajahi Produk
                        <svg class="ml-2 w-5 h-5 transition-transform group-hover:translate-x-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 8l4 4m0 0l-4 4m4-4H3"></path>
                        </svg>
                    </a>
                </div>
                
                <!-- Right Content - SVG Illustration -->
                <div class="relative" data-aos="fade-left">
                    <div class="relative z-10">
                        <!-- Main SVG Container -->
                        <div class="relative animate-float" style="animation-duration: 6s;">
                            <img src="{{ asset('images/Construction truck-pana.svg') }}" alt="Construction Truck" class="w-full max-w-lg mx-auto drop-shadow-2xl">
                        </div>
                        
                        <!-- Floating Cards -->
                        @if(isset($bestSellingProduct) && $bestSellingProduct)
                        <div class="absolute -bottom-4 -left-4 bg-white rounded-2xl p-4 shadow-xl border border-gray-100 animate-float" style="animation-delay: 1s; animation-duration: 4s;">
                            <div class="flex items-center gap-3">
                                <div class="w-14 h-14 rounded-xl overflow-hidden bg-orange-100">
                                    @if($bestSellingProduct->image && file_exists(storage_path('app/public/' . $bestSellingProduct->image)))
                                        <img src="{{ asset('storage/' . $bestSellingProduct->image) }}" alt="" class="w-full h-full object-cover">
                                    @else
                                        <div class="w-full h-full flex items-center justify-center">
                                            <svg class="w-6 h-6 text-orange-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M20 7l-8-4-8 4m16 0l-8 4m8-4v10l-8 4m0-10L4 7m8 4v10M4 7v10l8 4"></path>
                                            </svg>
                                        </div>
                                    @endif
                                </div>
                                <div>
                                    <div class="text-xs text-gray-500">Best Seller</div>
                                    <div class="font-bold text-gray-900">{{ Str::limit($bestSellingProduct->name, 15) }}</div>
                                    <div class="text-orange-600 font-semibold">Rp {{ number_format($bestSellingProduct->price, 0, ',', '.') }}</div>
                                </div>
                            </div>
                        </div>
                        @endif
                        
                        <div class="absolute -top-4 -right-4 bg-gradient-to-br from-orange-500 to-amber-500 rounded-2xl p-4 shadow-xl text-white animate-float" style="animation-delay: 2s; animation-duration: 5s;">
                            <div class="flex items-center gap-2">
                                <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 20 20">
                                    <path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z"></path>
                                </svg>
                                <span class="font-bold">4.9</span>
                                <span class="text-white/80 text-sm">Rating</span>
                            </div>
                        </div>
                    </div>
                    
                    <!-- Background Decorations -->
                    <div class="absolute top-1/2 left-1/2 -translate-x-1/2 -translate-y-1/2 w-80 h-80 bg-gradient-to-br from-orange-200 to-amber-100 rounded-full blur-3xl opacity-60 -z-10"></div>
                </div>
            </div>
        </div>
    </section>

    <!-- New Arrivals with Floating Cards -->
    <section class="py-24 bg-gray-50">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="flex flex-col md:flex-row justify-between items-center mb-16">
                <div class="mb-6 md:mb-0" data-aos="fade-right">
                    <span class="inline-block px-3 py-1 bg-orange-200 text-orange-800 rounded-full text-sm font-semibold mb-3">BARU DATANG</span>
                    <h2 class="text-3xl md:text-4xl font-extrabold text-gray-900 relative">
                        Produk Terbaru
                        <span class="absolute -bottom-2 left-0 w-24 h-1 bg-orange-700 rounded"></span>
                    </h2>
                    <p class="mt-4 text-lg text-gray-600 max-w-2xl">
                        Menyediakan material terbaru kami dengan mutu terjamin dan kualitas premium
                    </p>
                </div>
                <a href="{{ route('shop') }}" data-aos="fade-left" 
                   class="px-6 py-3 border border-transparent text-base font-medium rounded-md text-white bg-gradient-to-r from-orange-700 to-amber-600 hover:from-orange-800 hover:to-amber-700 transition-all duration-300 transform hover:scale-105 flex items-center shadow-lg hover:shadow-xl">
                    <span>Lihat Semua Produk</span>
                    <svg class="ml-2 -mr-1 w-5 h-5" fill="currentColor" viewBox="0 0 20 20">
                        <path fill-rule="evenodd" d="M10.293 5.293a1 1 0 011.414 0l4 4a1 1 0 010 1.414l-4 4a1 1 0 01-1.414-1.414L12.586 11H5a1 1 0 110-2h7.586l-2.293-2.293a1 1 0 010-1.414z" clip-rule="evenodd"></path>
                    </svg>
                </a>
            </div>
            
            <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-8">
                @foreach ($latestProducts->take(8) as $index => $product)
                <div class="product-card bg-white rounded-xl shadow-md overflow-hidden" data-aos="fade-up" data-aos-delay="{{ $index * 100 }}">
                    <div class="relative overflow-hidden">
                        @if($product->image && file_exists(storage_path('app/public/' . $product->image)))
                            <img class="product-img h-64 w-full object-cover" 
                                 src="{{ asset('storage/' . $product->image) }}" 
                                 alt="{{ $product->name }}">
                        @else
                            <div class="product-img h-64 w-full bg-gray-200 flex items-center justify-center">
                                <div class="text-center p-4">
                                    <svg class="w-16 h-16 text-gray-400 mx-auto mb-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"></path>
                                    </svg>
                                    <span class="text-gray-500 text-sm">{{ Str::limit($product->name, 30) }}</span>
                                </div>
                            </div>
                        @endif
                        <div class="badge-new">BARU</div>
                        
                        <!-- Quick View Overlay -->
                        <div class="absolute inset-0 bg-black bg-opacity-30 opacity-0 transition-opacity duration-300 flex items-center justify-center quick-view">
                            <a href="{{ route('product', $product->id) }}" class="bg-white rounded-full p-3 transform transition-all duration-300 hover:scale-110 hover:bg-orange-50 shadow-lg">
                                <svg class="w-6 h-6 text-orange-800" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"></path>
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"></path>
                                </svg>
                            </a>
                        </div>
                    </div>
                    
                    <div class="p-6">
                        <div class="flex items-center justify-between mb-2">
                            <a href="{{ route('product', ['id' => $product->id]) }}">
                                <h2 class="text-gray-800 font-medium mb-1 hover:text-orange-800">{{ $product->name }}</h2>
                            </a>
                        </div>

                        {{-- Brand --}}
                        @if(isset($product->brand) && $product->brand)
                            <div class="flex items-center text-sm text-gray-500 mb-2">
                                <span class="font-medium mr-2">Brand:</span>
                                <span>{{ $product->brand->name }}</span>
                            </div>
                         @endif
                        
                        {{-- Rating Produk --}}
                        @php
                            // Get the proper rating from the withAvg relationship
                            $rating = $product->reviews_avg_rating ?? 0;
                            
                            // Get the proper count from the withCount relationship
                            $reviewCount = $product->reviews_count ?? 0;
                        @endphp
                        <div class="flex items-center mb-2">
                            <div class="flex text-yellow-400">
                                @for ($i = 1; $i <= 5; $i++)
                                    @if ($i <= floor($rating))
                                        <i class="fas fa-star"></i>
                                    @elseif ($i - 0.5 <= $rating)
                                        <i class="fas fa-star-half-alt"></i>
                                    @else
                                        <i class="far fa-star"></i>
                                    @endif
                                @endfor
                            </div>
                            <span class="text-gray-500 ml-2">({{ number_format($rating, 1) }}) - {{ $reviewCount }} Terjual</span>
                        </div>

                        <p class="text-sm text-gray-600 mb-3 truncate overflow-hidden whitespace-normal line-clamp-2 h-10">{{ $product->description ?? 'Material bangunan berkualitas tinggi dengan standar mutu terbaik.' }}</p>
                        
                        <div class="flex justify-between items-center">
                            {{-- harga --}}
                            <span class="text-orange-800 font-bold text-lg">{{ 'Rp ' . number_format($product->price, 0, ',', '.') }}</span>
                            <div class="flex space-x-2">
                                {{-- Wishlist --}}
                                @auth
                                @php
                                    $inWishlist = App\Models\Wishlist::where('user_id', Auth::id())->where('product_id', $product->id)->exists();
                                @endphp
                                <form action="{{ route('wishlist.toggle', $product->id) }}" method="POST">
                                    @csrf
                                    <button type="submit" 
                                           class="p-2 bg-gray-100 hover:bg-gray-200 rounded-full {{ $inWishlist ? 'text-red-500' : 'text-gray-600 hover:text-red-500' }} transition-colors duration-300">
                                        <svg class="w-5 h-5" fill="{{ $inWishlist ? 'currentColor' : 'none' }}" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4.318 6.318a4.5 4.5 0 000 6.364L12 20.364l7.682-7.682a4.5 4.5 0 00-6.364-6.364L12 7.636l-1.318-1.318a4.5 4.5 0 00-6.364 0z"></path>
                                        </svg>
                                    </button>
                                </form>

                                {{-- cart --}}
                                <form action="{{ route('cart.add') }}" method="POST" class="add-to-cart-form">
                                    @csrf
                                    <input type="hidden" name="product_id" value="{{ $product->id }}">
                                    <input type="hidden" name="quantity" value="1">
                                    <button type="submit" class="p-2 bg-orange-700 hover:bg-orange-800 rounded-full text-white transition-colors duration-300 add-to-cart-button">
                                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 11V7a4 4 0 00-8 0v4M5 9h14l1 12H4L5 9z"></path>
                                        </svg>
                                    </button>
                                </form>
                                @else
                                <a href="{{ route('login') }}" class="p-2 bg-gray-100 hover:bg-gray-200 rounded-full text-gray-600 hover:text-red-500 transition-colors duration-300">
                                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4.318 6.318a4.5 4.5 0 000 6.364L12 20.364l7.682-7.682a4.5 4.5 0 00-6.364-6.364L12 7.636l-1.318-1.318a4.5 4.5 0 00-6.364 0z"></path>
                                    </svg>
                                </a>
                                @endauth
                            </div>
                        </div>
                    </div>
                </div>
                @endforeach
            </div>
        </div>
    </section>


    <!-- Stats Counter -->
    <section class="py-20 bg-gradient-to-r from-orange-700 to-amber-600 relative overflow-hidden">
        <div class="absolute inset-0 overflow-hidden">
            <div class="absolute top-0 left-0 w-full h-full">
                <div class="absolute top-1/4 left-1/4 w-64 h-64 bg-white rounded-full mix-blend-overlay filter blur-3xl opacity-10 animate-blob animation-delay-2000"></div>
                <div class="absolute top-1/3 right-1/4 w-64 h-64 bg-white rounded-full mix-blend-overlay filter blur-3xl opacity-10 animate-blob animation-delay-4000"></div>
            </div>
        </div>
        
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 relative z-10">
            <div class="grid grid-cols-2 md:grid-cols-4 gap-8 text-white text-center">
                @foreach([
                    ['number' => '15,000+', 'label' => 'Pelanggan Puas', 'icon' => 'users'],
                    ['number' => '500+', 'label' => 'Jenis Produk', 'icon' => 'collection'],
                    ['number' => '25+', 'label' => 'Tahun Pengalaman', 'icon' => 'clock'],
                    ['number' => '5+', 'label' => 'Penghargaan', 'icon' => 'star']
                ] as $index => $stat)
                <div class="flex flex-col items-center" data-aos="zoom-in" data-aos-delay="{{ $index * 100 }}">
                    <div class="bg-white bg-opacity-20 rounded-full p-4 mb-4 backdrop-blur-sm animate-pulse-ring">
                        <svg class="w-8 h-8 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="{{ 
                                $stat['icon'] === 'users' ? 'M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0 014 0zM7 10a2 2 0 11-4 0 2 2 0 014 0zM12 3a9 9 0 11-9 9 9 9 0 019-9z' : 
                                ($stat['icon'] === 'collection' ? 'M19 11H5m14 0a2 2 0 012 2v6a2 2 0 01-2 2H5a2 2 0 01-2-2v-6a2 2 0 012-2m14 0V9a2 2 0 00-2-2H5a2 2 0 00-2 2v2M7 7h10' : 
                                ($stat['icon'] === 'clock' ? 'M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z' : 
                                'M11.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z')) }}">
                            </path>
                        </svg>
                    </div>
                    <div class="text-3xl md:text-4xl font-bold mb-2" data-counter="{{ str_replace('+', '', $stat['number']) }}">{{ $stat['number'] }}</div>
                    <p class="text-orange-100">{{ $stat['label'] }}</p>
                </div>
                @endforeach
            </div>
        </div>
    </section>

    <!-- Bagian Review/Testimonial Customer -->
<section class="py-16 bg-gray-50">
    <div class="container mx-auto px-4">
        <div class="text-center mb-12">
            <h2 class="text-3xl font-bold text-gray-900">Apa Kata Customer Kami</h2>
            <p class="mt-4 text-lg text-gray-600">Testimoni dari pelanggan yang puas dengan produk kami</p>
        </div>

        @if($bestReviews->count() > 0)
        <div id="testimonial-swiper" class="swiper-container">
            <div class="swiper-wrapper">
                @foreach($bestReviews as $index => $review)
                <div class="swiper-slide">
                    <div class="bg-white rounded-lg shadow-md p-6 transition-transform hover:-translate-y-1" data-aos="fade-left" data-aos-delay="{{ $index * 100 }}">
                        <div class="flex items-center mb-4">
                            <div class="flex-shrink-0">
                                @if($review->product->image)
                                    <img src="{{ asset('storage/' . $review->product->image) }}" alt="{{ $review->product->name }}" class="w-16 h-16 object-cover rounded-lg">
                                @else
                                    <div class="w-16 h-16 bg-gray-200 flex items-center justify-center rounded-lg">
                                        <svg class="w-8 h-8 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"></path>
                                        </svg>
                                    </div>
                                @endif
                            </div>
                            <div class="ml-4">
                                <h3 class="text-lg font-semibold text-gray-900 truncate" title="{{ $review->product->name }}">
                                    {{ \Illuminate\Support\Str::limit($review->product->name, 25) }}
                                </h3>
                                <a href="{{ route('product', $review->product->id) }}" class="text-sm text-orange-800 hover:underline">Lihat Produk</a>
                            </div>
                        </div>
    
                        <div class="mb-4">
                            <div class="flex items-center mb-1">
                                @for ($i = 1; $i <= 5; $i++)
                                    <svg class="w-5 h-5 {{ $i <= $review->rating ? 'text-yellow-400' : 'text-gray-300' }}" fill="currentColor" viewBox="0 0 20 20">
                                        <path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z"></path>
                                    </svg>
                                @endfor
                            </div>
                            
                            <blockquote class="italic text-gray-700 mt-2">
                                "{{ \Illuminate\Support\Str::limit($review->review, 150) }}"
                            </blockquote>
                        </div>
    
                        <div class="flex justify-between items-center mt-4 text-sm">
                            <div class="font-semibold text-gray-900">{{ $review->user->name }}</div>
                            <div class="text-gray-500">{{ $review->created_at->format('d M Y') }}</div>
                        </div>
                    </div>
                </div>
                @endforeach
            </div>
            <!-- Navigasi -->
            <div id="testimonial-next" class="swiper-button-next"></div>
            <div id="testimonial-prev" class="swiper-button-prev"></div>
            <!-- Pagination -->
            <div id="testimonial-pagination" class="swiper-pagination"></div>
        </div>
        @else
            <div class="text-center py-12">
                <p class="text-gray-500">Belum ada ulasan produk</p>
            </div>
        @endif
    </div>
</section>

    <!-- CTA Section with Wave Background -->
    <section class="relative overflow-hidden min-h-[500px] py-20 bg-orange-700">
        <!-- Wave Background -->
        <div class="ocean" style="position: absolute; bottom: 0; left: 0; width: 100%; height: 150px; background: #c2410c; overflow: hidden;">
            <div class="wave" style="background: url('{{ asset('images/wave.svg') }}?v={{ time() }}') repeat-x; background-size: 1600px 198px; position: absolute; top: -48px; width: 6400px; height: 198px; animation: wave 15s linear infinite;"></div>
            <div class="wave" style="background: url('{{ asset('images/wave.svg') }}?v={{ time() }}') repeat-x; background-size: 1600px 198px; position: absolute; top: -30px; width: 6400px; height: 198px; animation: wave 15s linear -7s infinite; opacity: 0.5;"></div>
        </div>
        
        <div class="relative max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 z-10">
            <div class="grid grid-cols-1 lg:grid-cols-2 gap-12 items-center">
                <!-- Left: Content -->
                <div class="text-center lg:text-left" data-aos="fade-right">
                    <h2 class="text-3xl sm:text-4xl font-extrabold tracking-tight text-white mb-6">
                        Siap Memulai Proyek Bangunan Anda?
                    </h2>
                    <p class="max-w-xl text-lg text-orange-100 mb-8">
                        Dapatkan diskon 15% untuk pembelian pertama dengan mendaftar newsletter kami
                    </p>
                    <form action="{{ route('newsletter.subscribe') }}" method="POST" id="newsletter-form" class="flex flex-col sm:flex-row gap-3 max-w-lg mx-auto lg:mx-0">
                        @csrf
                        <div class="flex-grow">
                            <label for="email-address" class="sr-only">Alamat Email</label>
                            <input id="email-address" name="email" type="email" autocomplete="email" required 
                                   class="w-full px-5 py-4 border-0 placeholder-gray-400 focus:ring-2 focus:ring-orange-400 rounded-xl shadow-lg"
                                   placeholder="Masukkan email Anda">
                        </div>
                        <button type="submit" id="newsletter-submit"
                               class="px-8 py-4 bg-white text-orange-700 font-semibold rounded-xl hover:bg-orange-50 focus:outline-none shadow-lg transform transition-all duration-300 hover:scale-105 whitespace-nowrap">
                            Daftar Sekarang
                        </button>
                    </form>
                    <div id="confirm-subscription" class="hidden mt-4 bg-white bg-opacity-20 backdrop-blur-sm p-4 rounded-xl">
                        <p class="text-white mb-3" id="confirm-message"></p>
                        <div class="flex justify-center gap-3">
                            <button id="confirm-yes" class="px-4 py-2 bg-green-500 text-white rounded-lg hover:bg-green-600">Ya, Saya Ingin</button>
                            <button id="confirm-no" class="px-4 py-2 bg-gray-500 text-white rounded-lg hover:bg-gray-600">Tidak</button>
                        </div>
                    </div>
                    <div id="newsletter-message" class="mt-3 text-sm text-white hidden"></div>
                </div>
                
                <!-- Right: SVG Illustration -->
                <div class="hidden lg:flex items-center justify-center" data-aos="fade-left">
                    <div class="relative animate-float" style="animation-duration: 5s;">
                        <img src="{{ asset('images/Construction truck-amico.svg') }}" alt="Newsletter" class="w-80 h-80 drop-shadow-2xl">
                    </div>
                </div>
            </div>
        </div>
        
        <!-- Bottom Wave -->
        <div class="absolute bottom-0 left-0 right-0 overflow-hidden">
            <svg data-name="Layer 1" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 1200 120" preserveAspectRatio="none" class="absolute bottom-0 w-full h-20">
                <path d="M321.39,56.44c58-10.79,114.16-30.13,172-41.86,82.39-16.72,168.19-17.73,250.45-.39C823.78,31,906.67,72,985.66,92.83c70.05,18.48,146.53,26.09,214.34,3V0H0V27.35A600.21,600.21,0,0,0,321.39,56.44Z" class="fill-current text-white"></path>
            </svg>
        </div>
    </section>

    <!-- Floating Action Button -->
    <div class="fixed bottom-8 left-6 z-50">
        <a href="https://wa.me/62895337436089" 
           class="float-button bg-green-500 text-white w-14 h-14 rounded-full flex items-center justify-center shadow-xl hover:bg-green-600 transition-all duration-300 transform hover:scale-110">
            <svg class="w-7 h-7" fill="currentColor" viewBox="0 0 24 24">
                <path d="M.057 24l1.687-6.163c-1.041-1.804-1.588-3.849-1.587-5.946.003-6.556 5.338-11.891 11.893-11.891 3.181.001 6.167 1.24 8.413 3.488 2.245 2.248 3.481 5.236 3.48 8.414-.003 6.557-5.338 11.892-11.893 11.892-1.99-.001-3.951-.5-5.688-1.448l-6.305 1.654zm6.597-3.807c1.676.995 3.276 1.591 5.392 1.592 5.448 0 9.886-4.434 9.889-9.885.002-5.462-4.415-9.89-9.881-9.892-5.452 0-9.887 4.434-9.889 9.884-.001 2.225.651 3.891 1.746 5.634l-.999 3.648 3.742-.981zm11.387-5.464c-.074-.124-.272-.198-.57-.347-.297-.149-1.758-.868-2.031-.967-.272-.099-.47-.149-.669.149-.198.297-.768.967-.941 1.165-.173.198-.347.223-.644.074-.297-.149-1.255-.462-2.39-1.475-.883-.788-1.48-1.761-1.653-2.059-.173-.297-.018-.458.13-.606.134-.133.297-.347.446-.521.151-.172.2-.296.3-.495.099-.198.05-.372-.025-.521-.075-.148-.669-1.611-.916-2.206-.242-.579-.487-.501-.669-.51l-.57-.01c-.198 0-.52.074-.792.372s-1.04 1.016-1.04 2.479 1.065 2.876 1.213 3.074c.149.198 2.095 3.2 5.076 4.487.709.306 1.263.489 1.694.626.712.226 1.36.194 1.872.118.571-.085 1.758-.719 2.006-1.413.248-.695.248-1.29.173-1.414z"/>
            </svg>
        </a>
    </div>
    
@endsection

@section('scripts')
<script src="https://unpkg.com/aos@2.3.1/dist/aos.js"></script>
<script src="https://unpkg.com/swiper/swiper-bundle.min.js"></script>
<script>
    document.addEventListener('DOMContentLoaded', function() {
        // Initialize AOS
        AOS.init({
            duration: 1000, // Animation duration
            once: true, // Whether animation should happen only once
            offset: 200, // Offset (in px) from the original trigger point
        });

        // Initialize Swiper for testimonials
        const swiper = new Swiper('#testimonial-swiper', {
            slidesPerView: 1,
            spaceBetween: 30,
            loop: true,
            autoplay: {
                delay: 1000,
                disableOnInteraction: false,
            },
            speed: 1000, // Durasi transisi antar slide
            effect: "coverflow", 
            coverflowEffect: {
                rotate: 0,
                stretch: 0,
                depth: 100,
                modifier: 1,
                slideShadows: false,
            },
            breakpoints: {
                640: {
                    slidesPerView: 1,
                },
                768: {
                    slidesPerView: 2,
                },
                1024: {
                    slidesPerView: 3,
                },
            },
            navigation: {
                nextEl: '#testimonial-next',
                prevEl: '#testimonial-prev',
            },
            grabCursor: true, // Kursor menjadi 'grab' saat hover
            centeredSlides: true, // Membuat slide aktif berada di tengah
            roundLengths: true, // Mencegah blur teks saat transisi
        });
        
        // Handle wishlist toggle with AJAX
        document.querySelectorAll('.wishlist-toggle').forEach(button => {
            button.addEventListener('click', function() {
                const productId = this.dataset.productId;
                const inWishlist = this.dataset.status === 'true';
                
                // Send AJAX request
                fetch(`/wishlist/toggle/${productId}`, {
                    method: 'POST',
                    headers: {
                        'Content-Type': 'application/json',
                        'X-CSRF-TOKEN': '{{ csrf_token() }}',
                        'Accept': 'application/json',
                        'X-Requested-With': 'XMLHttpRequest'
                    },
                    credentials: 'same-origin'
                })
                .then(response => response.json())
                .then(data => {
                    if (data.success) {
                        // Toggle button appearance
                        this.classList.toggle('text-red-500');
                        this.classList.toggle('text-gray-600');
                        
                        const svg = this.querySelector('svg');
                        if (inWishlist) {
                            svg.setAttribute('fill', 'none');
                            this.dataset.status = 'false';
                        } else {
                            svg.setAttribute('fill', 'currentColor');
                            this.dataset.status = 'true';
                        }
                    }
                })
                .catch(error => console.error('Error:', error));
            });
        });
    });
    
    // cart
    document.addEventListener('DOMContentLoaded', function() {
        document.querySelectorAll('.add-to-cart-form').forEach(form => {
            form.addEventListener('submit', function(e) {
                e.preventDefault();
                const formData = new FormData(this);
                
                fetch(this.action, {
                    method: 'POST',
                    body: formData,
                    headers: {
                        'X-CSRF-TOKEN': '{{ csrf_token() }}',
                        'X-Requested-With': 'XMLHttpRequest'
                    }
                })
                .then(response => {
                    if (!response.ok) {
                        return response.json().then(errorData => {
                            throw {status: response.status, data: errorData};
                        });
                    }
                    return response.json();
                })
                .then(data => {
                    Swal.fire({
                        title: 'Berhasil!',
                        text: 'Produk berhasil ditambahkan ke keranjang',
                        icon: 'success',
                        timer: 2000,
                        timerProgressBar: true,
                        showConfirmButton: false
                    });
                })
                .catch(error => {
                    let errorMessage = 'Gagal menambahkan produk ke keranjang';
                    
                    if (error.status === 422) {
                        errorMessage = 'Stok produk tidak tersedia';
                        if (error.data && error.data.message) {
                            errorMessage = error.data.message;
                        }
                    }
                    
                    Swal.fire({
                        title: 'Oops!',
                        text: errorMessage,
                        icon: 'error',
                        timer: 2000,
                        timerProgressBar: true,
                        showConfirmButton: false
                    });
                });
            });
        });
    });

    // Promo copy button - only if element exists
    (function() {
        var copyPromoButton = document.getElementById('copy-promo-button');
        if (copyPromoButton) {
            copyPromoButton.addEventListener('click', function() {
                var promoCode = document.getElementById('promo-code').innerText;
                
                navigator.clipboard.writeText(promoCode).then(function() {
                    Swal.fire({
                        icon: 'success',
                        title: 'Berhasil!',
                        text: 'Kode promo berhasil disalin ke clipboard.',
                        timer: 1500,
                        showConfirmButton: false
                    });
                }).catch(function(error) {
                    Swal.fire({
                        icon: 'error',
                        title: 'Oops...',
                        text: 'Gagal menyalin kode promo. Silakan coba lagi.',
                    });
                    console.error(error);
                });
            });
        }
    })();

    // Newsletter subscription functionality
    document.addEventListener('DOMContentLoaded', function() {
        const newsletterForm = document.getElementById('newsletter-form');
        const newsletterMessage = document.getElementById('newsletter-message');
        const submitButton = document.getElementById('newsletter-submit');

        if (newsletterForm) {
            newsletterForm.addEventListener('submit', function(e) {
                e.preventDefault();
                
                // Disable button and show loading state
                submitButton.disabled = true;
                submitButton.innerHTML = `
                    <svg class="animate-spin -ml-1 mr-2 h-4 w-4 text-blue-700 inline-block" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24">
                        <circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4"></circle>
                        <path class="opacity-75" fill="currentColor" d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4zm2 5.291A7.962 7.962 0 014 12H0c0 3.042 1.135 5.824 3 7.938l3-2.647z"></path>
                    </svg> 
                    Mendaftar...
                `;

                // Submit form using fetch API
                fetch(newsletterForm.action, {
                    method: 'POST',
                    body: new FormData(newsletterForm),
                    headers: {
                        'X-Requested-With': 'XMLHttpRequest',
                    }
                })
                .then(response => response.json())
                .then(data => {
                    // Display success message
                    newsletterMessage.textContent = data.message;
                    newsletterMessage.classList.remove('hidden', 'text-red-300');
                    newsletterMessage.classList.add('text-green-300');
                    
                    // Reset form
                    newsletterForm.reset();
                    
                    // Reset button
                    submitButton.disabled = false;
                    submitButton.textContent = 'Daftar Sekarang';
                    
                    // Hide message after 5 seconds
                    setTimeout(() => {
                        newsletterMessage.classList.add('hidden');
                    }, 5000);
                })
                .catch(error => {
                    // Display error message
                    newsletterMessage.textContent = 'Terjadi kesalahan. Silakan coba lagi.';
                    newsletterMessage.classList.remove('hidden', 'text-green-300');
                    newsletterMessage.classList.add('text-red-300');
                    
                    // Reset button
                    submitButton.disabled = false;
                    submitButton.textContent = 'Daftar Sekarang';
                    
                    console.error('Error:', error);
                });
            });
        }
    });
</script>

@if(isset($homepagePromo))
<script>
    document.addEventListener('DOMContentLoaded', function() {
        // Add event listener to copy button
        const copyButton = document.getElementById('copy-promo-button');
        if (copyButton) {
            copyButton.addEventListener('click', function(e) {
                e.preventDefault();
                copyPromoCode();
            });
        }
        
        function copyPromoCode() {
            const promoCode = document.getElementById('promo-code').innerText;
            
            try {
                // Try the modern clipboard API first
                if (navigator.clipboard) {
                    navigator.clipboard.writeText(promoCode).catch(err => {
                        fallbackCopyMethod(promoCode);
                    });
                } else {
                    // If Clipboard API not available, use the fallback method
                    fallbackCopyMethod(promoCode);
                }
            } catch (error) {
                console.error('Copy failed: ', error);
                fallbackCopyMethod(promoCode);
            }
        }
        
        function fallbackCopyMethod(text) {
            // Create temporary element
           
            const textArea = document.createElement("textarea");
            textArea.value = text;
            textArea.style.position = "fixed";  // Avoid scrolling to bottom
            document.body.appendChild(textArea);
            textArea.focus();
            textArea.select();
            
            try {
                const successful = document.execCommand('copy');
                if (successful) {
                    showCopySuccessMessage(text);
                } else {
                    console.error('Fallback: Unable to copy');
                    showCopyErrorMessage();
                }
            } catch (err) {
                console.error('Fallback: Oops, unable to copy', err);
                showCopyErrorMessage();
            }
            
            document.body.removeChild(textArea);
        }
        
        function showCopySuccessMessage(promoCode) {
            Swal.fire({
                title: 'Berhasil!',
                text: 'Kode promo ' + promoCode + ' telah disalin!',
                icon: 'success',
                timer: 2000,
                position: 'top-end',
                showConfirmButton: false,
                toast: true
            });
        }
        
        function showCopyErrorMessage() {
            Swal.fire({
                title: 'Gagal Menyalin',
                text: 'Silakan salin kode secara manual',
                icon: 'error',
                timer: 2000,
                position: 'top-end',
                showConfirmButton: false,
                toast: true
            });
        }

        // real time promo code 
    
        const tanggal = document.getElementsByClassName("timess")[0]
        const jam = document.getElementsByClassName("timess")[1]
        const menit = document.getElementsByClassName("timess")[2]
        const detik = document.getElementsByClassName("timess")[3]
    
        const endD = '<?= $homepagePromo->end_date;?>';
        const targetDate = new Date(endD).getTime();
    
        function timer() {
            const currentDate = new Date().getTime();
            const distance = targetDate - currentDate
    
            const days = Math.floor(distance / 1000 / 60 / 60 / 24);
            const hours = Math.floor(distance / 1000 / 60 / 60) % 24;
            const minutes = Math.floor(distance / 1000 / 60) % 60;
            const seconds = Math.floor(distance / 1000) % 60;
    
         
            tanggal.innerHTML = days;
            jam.innerHTML = hours;
            menit.innerHTML = minutes;
            detik.innerHTML = seconds;
            
        }
    
        setInterval(timer, 1000);
    });

 
</script>
@endif
@endsection