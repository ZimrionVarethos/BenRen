<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Rental Mobil - Sewa Mobil Mudah dan Terpercaya</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <style>
        /* Navbar scroll effect */
        .navbar-scrolled {
            background: rgba(17, 24, 39, 0.95);
            backdrop-filter: blur(10px);
            box-shadow: 0 4px 20px rgba(0, 0, 0, 0.3);
            border-radius: 50px;
            margin: 1rem 2rem;
            padding: 0 2rem;
            max-width: calc(100% - 4rem);
        }

        #navbar {
            transition: all 0.3s ease;
        }

        /* Animated Road Background */
        .road-container {
            position: absolute;
            bottom: 0;
            left: 0;
            width: 100%;
            height: 200px;
            overflow: hidden;
        }

        .road {
            position: absolute;
            bottom: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background: linear-gradient(to bottom, 
                transparent 0%, 
                transparent 40%,
                #374151 40%, 
                #374151 45%,
                #4b5563 45%, 
                #4b5563 100%
            );
        }

        .road-lines {
            position: absolute;
            bottom: 0;
            left: 0;
            width: 200%;
            height: 100%;
            background-image: 
                repeating-linear-gradient(
                    90deg,
                    transparent,
                    transparent 40px,
                    #fbbf24 40px,
                    #fbbf24 80px,
                    transparent 80px,
                    transparent 120px
                );
            background-position: 0 50%;
            background-size: 120px 8px;
            background-repeat: repeat-x;
            animation: roadMove 3s linear infinite;
        }

        @keyframes roadMove {
            0% { transform: translateX(0); }
            100% { transform: translateX(-120px); }
        }

        /* Animated Car */
        .car-container {
            position: absolute;
            bottom: 80px;
            left: 50%;
            transform: translateX(-50%);
            animation: carBounce 2s ease-in-out infinite;
        }

        @keyframes carBounce {
            0%, 100% { transform: translateX(-50%) translateY(0px); }
            50% { transform: translateX(-50%) translateY(-10px); }
        }

        .car {
            width: 180px;
            height: 80px;
            position: relative;
        }

        .car-body {
            width: 100%;
            height: 50px;
            background: linear-gradient(to bottom, #3b82f6 0%, #2563eb 100%);
            border-radius: 50px 50px 20px 20px;
            position: relative;
            box-shadow: 0 10px 30px rgba(59, 130, 246, 0.4);
        }

        .car-top {
            width: 80px;
            height: 35px;
            background: linear-gradient(to bottom, #60a5fa 0%, #3b82f6 100%);
            border-radius: 20px 20px 0 0;
            position: absolute;
            top: -25px;
            left: 50px;
        }

        .car-window {
            width: 30px;
            height: 20px;
            background: rgba(255, 255, 255, 0.3);
            border-radius: 10px 10px 0 0;
            position: absolute;
            top: 5px;
        }

        .car-window.left {
            left: 10px;
        }

        .car-window.right {
            right: 10px;
        }

        .car-wheel {
            width: 25px;
            height: 25px;
            background: #1f2937;
            border-radius: 50%;
            position: absolute;
            bottom: -12px;
            border: 3px solid #374151;
            animation: wheelRotate 1s linear infinite;
        }

        .car-wheel.left {
            left: 20px;
        }

        .car-wheel.right {
            right: 20px;
        }

        @keyframes wheelRotate {
            0% { transform: rotate(0deg); }
            100% { transform: rotate(360deg); }
        }

        .car-light {
            width: 12px;
            height: 8px;
            background: #fbbf24;
            position: absolute;
            top: 20px;
            border-radius: 4px;
            box-shadow: 0 0 15px #fbbf24;
        }

        .car-light.left {
            left: -5px;
        }

        .car-light.right {
            right: -5px;
        }

        /* Animated Clouds */
        .clouds {
            position: absolute;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            overflow: hidden;
        }

        .cloud {
            position: absolute;
            background: rgba(255, 255, 255, 0.1);
            border-radius: 100px;
            animation: cloudFloat 30s linear infinite;
        }

        .cloud::before,
        .cloud::after {
            content: '';
            position: absolute;
            background: rgba(255, 255, 255, 0.1);
            border-radius: 100px;
        }

        .cloud-1 {
            width: 100px;
            height: 40px;
            top: 20%;
            left: -100px;
            animation-duration: 25s;
        }

        .cloud-1::before {
            width: 50px;
            height: 50px;
            top: -25px;
            left: 10px;
        }

        .cloud-1::after {
            width: 60px;
            height: 40px;
            top: -20px;
            right: 10px;
        }

        .cloud-2 {
            width: 120px;
            height: 50px;
            top: 40%;
            left: -120px;
            animation-duration: 35s;
            animation-delay: 5s;
        }

        .cloud-2::before {
            width: 60px;
            height: 60px;
            top: -30px;
            left: 15px;
        }

        .cloud-2::after {
            width: 70px;
            height: 50px;
            top: -25px;
            right: 15px;
        }

        .cloud-3 {
            width: 90px;
            height: 35px;
            top: 60%;
            left: -90px;
            animation-duration: 30s;
            animation-delay: 10s;
        }

        .cloud-3::before {
            width: 45px;
            height: 45px;
            top: -20px;
            left: 10px;
        }

        .cloud-3::after {
            width: 55px;
            height: 35px;
            top: -18px;
            right: 10px;
        }

        @keyframes cloudFloat {
            0% { transform: translateX(0); }
            100% { transform: translateX(calc(100vw + 200px)); }
        }

        /* Gradient background */
        .gradient-bg {
            background: linear-gradient(135deg, #0f172a 0%, #1e293b 25%, #334155 50%, #1e40af 100%);
        }

        /* Glass effect */
        .glass-effect {
            background: rgba(255, 255, 255, 0.05);
            backdrop-filter: blur(10px);
            border: 1px solid rgba(255, 255, 255, 0.1);
        }

        /* Card hover effect */
        .card-hover {
            transition: all 0.3s ease;
        }

        .card-hover:hover {
            transform: translateY(-8px);
            box-shadow: 0 20px 40px rgba(59, 130, 246, 0.3);
        }

        /* Pulse animation */
        @keyframes pulse {
            0%, 100% {
                opacity: 1;
            }
            50% {
                opacity: 0.5;
            }
        }

        .animate-pulse-slow {
            animation: pulse 3s cubic-bezier(0.4, 0, 0.6, 1) infinite;
        }

        /* Floating animation */
        @keyframes float {
            0%, 100% {
                transform: translateY(0px);
            }
            50% {
                transform: translateY(-20px);
            }
        }

        .animate-float {
            animation: float 6s ease-in-out infinite;
        }

        /* Shine effect */
        .shine {
            position: relative;
            overflow: hidden;
        }

        .shine::before {
            content: '';
            position: absolute;
            top: 0;
            left: -100%;
            width: 100%;
            height: 100%;
            background: linear-gradient(90deg, transparent, rgba(255, 255, 255, 0.2), transparent);
            transition: left 0.5s;
        }

        .shine:hover::before {
            left: 100%;
        }

        /* Counter animation */
        @keyframes countUp {
            from {
                opacity: 0;
                transform: translateY(20px);
            }
            to {
                opacity: 1;
                transform: translateY(0);
            }
        }

        .stat-number {
            animation: countUp 1s ease-out forwards;
        }

        /* Testimonial card */
        .testimonial-card {
            transition: all 0.3s ease;
        }

        .testimonial-card:hover {
            transform: scale(1.05);
        }

        /* Price card */
        .price-card {
            position: relative;
            overflow: hidden;
        }

        .price-card::after {
            content: '';
            position: absolute;
            top: -50%;
            left: -50%;
            width: 200%;
            height: 200%;
            background: radial-gradient(circle, rgba(59, 130, 246, 0.1) 0%, transparent 70%);
            opacity: 0;
            transition: opacity 0.3s;
        }

        .price-card:hover::after {
            opacity: 1;
        }

        /* Scroll progress bar */
        .scroll-progress {
            position: fixed;
            top: 0;
            left: 0;
            height: 4px;
            background: linear-gradient(90deg, #3b82f6, #8b5cf6);
            z-index: 9999;
            transform-origin: left;
            transform: scaleX(0);
            transition: transform 0.1s;
        }

        /* Building animation for city */
        .building {
            position: absolute;
            bottom: 200px;
            background: rgba(30, 41, 59, 0.8);
            border-radius: 4px 4px 0 0;
        }

        .building-window {
            background: rgba(251, 191, 36, 0.6);
            animation: windowBlink 3s infinite;
        }

        @keyframes windowBlink {
            0%, 100% { opacity: 0.3; }
            50% { opacity: 1; }
        }

        .building-1 {
            width: 60px;
            height: 120px;
            left: 10%;
        }

        .building-2 {
            width: 80px;
            height: 160px;
            left: 20%;
        }

        .building-3 {
            width: 50px;
            height: 100px;
            right: 25%;
        }

        .building-4 {
            width: 70px;
            height: 140px;
            right: 15%;
        }

        /* Car showcase animation */
        @keyframes showcase-slide {
            0% { transform: translateX(100%); }
            100% { transform: translateX(-100%); }
        }

        .car-showcase {
            display: flex;
            animation: showcase-slide 30s linear infinite;
        }

        /* Fade in animation */
        @keyframes fadeInUp {
            from {
                opacity: 0;
                transform: translateY(30px);
            }
            to {
                opacity: 1;
                transform: translateY(0);
            }
        }

        .fade-in-up {
            animation: fadeInUp 0.8s ease-out forwards;
        }

        /* Stagger animation delays */
        .delay-100 { animation-delay: 0.1s; }
        .delay-200 { animation-delay: 0.2s; }
        .delay-300 { animation-delay: 0.3s; }
        .delay-400 { animation-delay: 0.4s; }
        .delay-500 { animation-delay: 0.5s; }
        .delay-600 { animation-delay: 0.6s; }

        /* Mobile responsive animations */
        @media (max-width: 768px) {
            .car {
                width: 120px;
                height: 60px;
            }

            .car-body {
                height: 35px;
            }

            .car-top {
                width: 60px;
                height: 25px;
                left: 30px;
            }

            .car-wheel {
                width: 18px;
                height: 18px;
            }

            .building {
                display: none;
            }
        }
    </style>
</head>
<body class="bg-gray-900 text-white overflow-x-hidden">
    <!-- Scroll Progress Bar -->
    <div class="scroll-progress w-full"></div>

    <!-- Navigation -->
    <nav id="navbar" class="fixed w-full z-50 top-0">
        <div class="bg-gray-900 transition-all duration-300" id="navbar-container">
            <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
                <div class="flex justify-between items-center h-20">
                    <div class="flex items-center space-x-3">
                        <div class="w-12 h-12 bg-gradient-to-br from-blue-600 to-blue-500 rounded-lg flex items-center justify-center shine">
                            <span class="text-2xl">🚗</span>
                        </div>
                        <a href="/" class="text-2xl font-bold text-white">
                            Rental Mobil
                        </a>
                    </div>
                    <div class="hidden md:flex items-center space-x-8">
                        <a href="#features" class="text-gray-300 hover:text-white font-medium transition-colors">Fitur</a>
                        <a href="#cars" class="text-gray-300 hover:text-white font-medium transition-colors">Mobil</a>
                        <a href="#pricing" class="text-gray-300 hover:text-white font-medium transition-colors">Harga</a>
                        <a href="#testimonials" class="text-gray-300 hover:text-white font-medium transition-colors">Testimoni</a>
                    </div>
                    <div class="flex items-center space-x-4">
                        <a href="{{ route('login') }}" class="text-gray-300 hover:text-white font-medium transition-colors">
                            Login
                        </a>
                        <a href="{{ route('register') }}" class="bg-blue-600 text-white px-6 py-2.5 rounded-lg font-semibold hover:bg-blue-700 transition-all shine">
                            Daftar Sekarang
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </nav>

    <!-- Animated Hero Section -->
    <section class="relative h-screen flex items-center justify-center overflow-hidden gradient-bg">
        <!-- Animated Clouds -->
        <div class="clouds">
            <div class="cloud cloud-1"></div>
            <div class="cloud cloud-2"></div>
            <div class="cloud cloud-3"></div>
        </div>

        <!-- City Buildings -->
        <div class="building building-1">
            <div class="grid grid-cols-3 gap-2 p-2">
                <div class="building-window w-full h-4"></div>
                <div class="building-window w-full h-4"></div>
                <div class="building-window w-full h-4"></div>
                <div class="building-window w-full h-4"></div>
                <div class="building-window w-full h-4"></div>
                <div class="building-window w-full h-4"></div>
            </div>
        </div>
        <div class="building building-2">
            <div class="grid grid-cols-4 gap-2 p-2">
                <div class="building-window w-full h-4"></div>
                <div class="building-window w-full h-4"></div>
                <div class="building-window w-full h-4"></div>
                <div class="building-window w-full h-4"></div>
                <div class="building-window w-full h-4"></div>
                <div class="building-window w-full h-4"></div>
                <div class="building-window w-full h-4"></div>
                <div class="building-window w-full h-4"></div>
            </div>
        </div>
        <div class="building building-3">
            <div class="grid grid-cols-3 gap-2 p-2">
                <div class="building-window w-full h-4"></div>
                <div class="building-window w-full h-4"></div>
                <div class="building-window w-full h-4"></div>
                <div class="building-window w-full h-4"></div>
                <div class="building-window w-full h-4"></div>
                <div class="building-window w-full h-4"></div>
            </div>
        </div>
        <div class="building building-4">
            <div class="grid grid-cols-3 gap-2 p-2">
                <div class="building-window w-full h-4"></div>
                <div class="building-window w-full h-4"></div>
                <div class="building-window w-full h-4"></div>
                <div class="building-window w-full h-4"></div>
                <div class="building-window w-full h-4"></div>
                <div class="building-window w-full h-4"></div>
            </div>
        </div>

        <!-- Animated Car -->
        <div class="car-container">
            <div class="car">
                <div class="car-top">
                    <div class="car-window left"></div>
                    <div class="car-window right"></div>
                </div>
                <div class="car-body">
                    <div class="car-light left"></div>
                    <div class="car-light right"></div>
                </div>
                <div class="car-wheel left"></div>
                <div class="car-wheel right"></div>
            </div>
        </div>

        <!-- Animated Road -->
        <div class="road-container">
            <div class="road"></div>
            <div class="road-lines"></div>
        </div>

        <!-- Hero Content -->
        <div class="relative z-20 max-w-5xl mx-auto px-4 sm:px-6 lg:px-8 text-center">
            <div class="mb-6 inline-block fade-in-up">
                <span class="px-4 py-2 bg-blue-600/20 border border-blue-500/50 rounded-lg text-sm font-semibold text-blue-300 backdrop-blur-sm">
                    🚀 Platform Rental Mobil #1 di Indonesia
                </span>
            </div>
            <h1 class="text-6xl md:text-7xl font-extrabold mb-6 text-white leading-tight fade-in-up delay-100">
                Sewa Mobil Mudah
                <span class="block text-blue-400">
                    & Terpercaya
                </span>
            </h1>
            <p class="text-xl md:text-2xl text-gray-300 mb-10 max-w-3xl mx-auto leading-relaxed fade-in-up delay-200">
                Pengalaman rental mobil yang nyaman dengan harga terjangkau. 
                Armada lengkap, driver profesional, dan proses booking yang mudah.
            </p>
            <div class="flex flex-col sm:flex-row justify-center gap-4 fade-in-up delay-300">
                <a href="{{ route('register') }}" class="group bg-blue-600 text-white px-10 py-5 rounded-lg text-lg font-bold hover:bg-blue-700 transition-all hover:shadow-xl hover:shadow-blue-500/30 shine">
                    <span class="flex items-center justify-center gap-2">
                        Mulai Sekarang
                        <svg class="w-5 h-5 group-hover:translate-x-1 transition-transform" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 7l5 5m0 0l-5 5m5-5H6"></path>
                        </svg>
                    </span>
                </a>
                <a href="{{ route('login') }}" class="glass-effect text-white px-10 py-5 rounded-lg text-lg font-bold hover:bg-white/10 transition-all border border-white/20">
                    Login
                </a>
            </div>

            <!-- Stats -->
            <div class="grid grid-cols-3 gap-8 mt-16 max-w-3xl mx-auto">
                <div class="glass-effect rounded-xl p-6 fade-in-up delay-400">
                    <div class="text-4xl font-bold text-blue-400 stat-number">50K+</div>
                    <div class="text-gray-400 mt-2">Happy Customers</div>
                </div>
                <div class="glass-effect rounded-xl p-6 fade-in-up delay-500">
                    <div class="text-4xl font-bold text-blue-400 stat-number">500+</div>
                    <div class="text-gray-400 mt-2">Premium Cars</div>
                </div>
                <div class="glass-effect rounded-xl p-6 fade-in-up delay-600">
                    <div class="text-4xl font-bold text-blue-400 stat-number">24/7</div>
                    <div class="text-gray-400 mt-2">Support</div>
                </div>
            </div>
        </div>

        <!-- Scroll indicator -->
        <div class="absolute bottom-10 left-1/2 transform -translate-x-1/2 z-20 animate-bounce">
            <svg class="w-6 h-6 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 14l-7 7m0 0l-7-7m7 7V3"></path>
            </svg>
        </div>
    </section>

    <!-- Features Section -->
    <section id="features" class="py-24 bg-gray-800">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="text-center mb-16">
                <h2 class="text-5xl font-bold mb-4 text-white">
                    Kenapa Pilih Kami?
                </h2>
                <p class="text-gray-400 text-lg">Layanan terbaik untuk pengalaman rental yang sempurna</p>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-3 gap-8">
                <!-- Feature 1 -->
                <div class="glass-effect rounded-xl p-8 card-hover border border-white/10">
                    <div class="w-16 h-16 bg-blue-600 rounded-xl flex items-center justify-center mb-6">
                        <svg class="w-8 h-8 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8c-1.657 0-3 .895-3 2s1.343 2 3 2 3 .895 3 2-1.343 2-3 2m0-8c1.11 0 2.08.402 2.599 1M12 8V7m0 1v8m0 0v1m0-1c-1.11 0-2.08-.402-2.599-1M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                        </svg>
                    </div>
                    <h3 class="text-2xl font-bold mb-3 text-white">Harga Terjangkau</h3>
                    <p class="text-gray-400 leading-relaxed">Berbagai pilihan mobil dengan harga yang kompetitif dan transparan tanpa biaya tersembunyi</p>
                </div>

                <!-- Feature 2 -->
                <div class="glass-effect rounded-xl p-8 card-hover border border-white/10">
                    <div class="w-16 h-16 bg-blue-600 rounded-xl flex items-center justify-center mb-6">
                        <svg class="w-8 h-8 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                        </svg>
                    </div>
                    <h3 class="text-2xl font-bold mb-3 text-white">Armada Terawat</h3>
                    <p class="text-gray-400 leading-relaxed">Semua mobil dalam kondisi prima dan terawat dengan baik untuk kenyamanan Anda</p>
                </div>

                <!-- Feature 3 -->
                <div class="glass-effect rounded-xl p-8 card-hover border border-white/10">
                    <div class="w-16 h-16 bg-blue-600 rounded-xl flex items-center justify-center mb-6">
                        <svg class="w-8 h-8 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 10V3L4 14h7v7l9-11h-7z"></path>
                        </svg>
                    </div>
                    <h3 class="text-2xl font-bold mb-3 text-white">Proses Cepat</h3>
                    <p class="text-gray-400 leading-relaxed">Booking online yang mudah dengan konfirmasi instan dan proses yang efisien</p>
                </div>

                <!-- Feature 4 -->
                <div class="glass-effect rounded-xl p-8 card-hover border border-white/10">
                    <div class="w-16 h-16 bg-blue-600 rounded-xl flex items-center justify-center mb-6">
                        <svg class="w-8 h-8 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0 014 0zM7 10a2 2 0 11-4 0 2 2 0 014 0z"></path>
                        </svg>
                    </div>
                    <h3 class="text-2xl font-bold mb-3 text-white">Driver Profesional</h3>
                    <p class="text-gray-400 leading-relaxed">Tim driver berpengalaman dan tersertifikasi untuk perjalanan yang aman dan nyaman</p>
                </div>

                <!-- Feature 5 -->
                <div class="glass-effect rounded-xl p-8 card-hover border border-white/10">
                    <div class="w-16 h-16 bg-blue-600 rounded-xl flex items-center justify-center mb-6">
                        <svg class="w-8 h-8 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 15v2m-6 4h12a2 2 0 002-2v-6a2 2 0 00-2-2H6a2 2 0 00-2 2v6a2 2 0 002 2zm10-10V7a4 4 0 00-8 0v4h8z"></path>
                        </svg>
                    </div>
                    <h3 class="text-2xl font-bold mb-3 text-white">Asuransi Lengkap</h3>
                    <p class="text-gray-400 leading-relaxed">Perlindungan asuransi menyeluruh untuk ketenangan pikiran selama perjalanan</p>
                </div>

                <!-- Feature 6 -->
                <div class="glass-effect rounded-xl p-8 card-hover border border-white/10">
                    <div class="w-16 h-16 bg-blue-600 rounded-xl flex items-center justify-center mb-6">
                        <svg class="w-8 h-8 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 5a2 2 0 012-2h3.28a1 1 0 01.948.684l1.498 4.493a1 1 0 01-.502 1.21l-2.257 1.13a11.042 11.042 0 005.516 5.516l1.13-2.257a1 1 0 011.21-.502l4.493 1.498a1 1 0 01.684.949V19a2 2 0 01-2 2h-1C9.716 21 3 14.284 3 6V5z"></path>
                        </svg>
                    </div>
                    <h3 class="text-2xl font-bold mb-3 text-white">Support 24/7</h3>
                    <p class="text-gray-400 leading-relaxed">Tim customer service kami siap membantu Anda kapan saja, siang atau malam</p>
                </div>
            </div>
        </div>
    </section>

    <!-- Car Showcase Section -->
    <section id="cars" class="py-24 bg-gray-900 overflow-hidden">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="text-center mb-16">
                <h2 class="text-5xl font-bold mb-4 text-white">
                    Koleksi Mobil Kami
                </h2>
                <p class="text-gray-400 text-lg">Pilih dari berbagai jenis mobil sesuai kebutuhan Anda</p>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-3 gap-8 mb-12">
                <!-- Car 1 -->
                <div class="glass-effect rounded-2xl overflow-hidden card-hover group">
                    <div class="relative h-64 bg-gradient-to-br from-blue-900 to-blue-700 flex items-center justify-center overflow-hidden">
                        <div class="text-8xl group-hover:scale-110 transition-transform duration-300">🚙</div>
                        <div class="absolute top-4 right-4 bg-green-500 text-white px-3 py-1 rounded-full text-sm font-semibold">
                            Tersedia
                        </div>
                    </div>
                    <div class="p-6">
                        <h3 class="text-2xl font-bold text-white mb-2">City Car</h3>
                        <p class="text-gray-400 mb-4">Perfect untuk perjalanan dalam kota</p>
                        <div class="flex items-center justify-between">
                            <div>
                                <span class="text-gray-500 text-sm">Mulai dari</span>
                                <div class="text-2xl font-bold text-blue-400">Rp 250K<span class="text-sm text-gray-500">/hari</span></div>
                            </div>
                            <a href="{{ route('register') }}" class="bg-blue-600 text-white px-4 py-2 rounded-lg hover:bg-blue-700 transition-all shine">
                                Sewa
                            </a>
                        </div>
                        <div class="mt-4 grid grid-cols-3 gap-2 text-sm text-gray-400">
                            <div class="flex items-center gap-1">
                                <svg class="w-4 h-4" fill="currentColor" viewBox="0 0 20 20">
                                    <path d="M8 9a3 3 0 100-6 3 3 0 000 6zM8 11a6 6 0 016 6H2a6 6 0 016-6z"></path>
                                </svg>
                                4 Seats
                            </div>
                            <div class="flex items-center gap-1">
                                <svg class="w-4 h-4" fill="currentColor" viewBox="0 0 20 20">
                                    <path d="M10 2a5 5 0 00-5 5v2a2 2 0 00-2 2v5a2 2 0 002 2h10a2 2 0 002-2v-5a2 2 0 00-2-2H7V7a3 3 0 015.905-.75 1 1 0 001.937-.5A5.002 5.002 0 0010 2z"></path>
                                </svg>
                                Manual
                            </div>
                            <div class="flex items-center gap-1">
                                <svg class="w-4 h-4" fill="currentColor" viewBox="0 0 20 20">
                                    <path fill-rule="evenodd" d="M12.395 2.553a1 1 0 00-1.45-.385c-.345.23-.614.558-.822.88-.214.33-.403.713-.57 1.116-.334.804-.614 1.768-.84 2.734a31.365 31.365 0 00-.613 3.58 2.64 2.64 0 01-.945-1.067c-.328-.68-.398-1.534-.398-2.654A1 1 0 005.05 6.05 6.981 6.981 0 003 11a7 7 0 1011.95-4.95c-.592-.591-.98-.985-1.348-1.467-.363-.476-.724-1.063-1.207-2.03zM12.12 15.12A3 3 0 017 13s.879.5 2.5.5c0-1 .5-4 1.25-4.5.5 1 .786 1.293 1.371 1.879A2.99 2.99 0 0113 13a2.99 2.99 0 01-.879 2.121z" clip-rule="evenodd"></path>
                                </svg>
                                AC
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Car 2 -->
                <div class="glass-effect rounded-2xl overflow-hidden card-hover group">
                    <div class="relative h-64 bg-gradient-to-br from-purple-900 to-purple-700 flex items-center justify-center overflow-hidden">
                        <div class="text-8xl group-hover:scale-110 transition-transform duration-300">🚗</div>
                        <div class="absolute top-4 right-4 bg-green-500 text-white px-3 py-1 rounded-full text-sm font-semibold">
                            Tersedia
                        </div>
                    </div>
                    <div class="p-6">
                        <h3 class="text-2xl font-bold text-white mb-2">SUV Premium</h3>
                        <p class="text-gray-400 mb-4">Kenyamanan maksimal untuk keluarga</p>
                        <div class="flex items-center justify-between">
                            <div>
                                <span class="text-gray-500 text-sm">Mulai dari</span>
                                <div class="text-2xl font-bold text-purple-400">Rp 500K<span class="text-sm text-gray-500">/hari</span></div>
                            </div>
                            <a href="{{ route('register') }}" class="bg-purple-600 text-white px-4 py-2 rounded-lg hover:bg-purple-700 transition-all shine">
                                Sewa
                            </a>
                        </div>
                        <div class="mt-4 grid grid-cols-3 gap-2 text-sm text-gray-400">
                            <div class="flex items-center gap-1">
                                <svg class="w-4 h-4" fill="currentColor" viewBox="0 0 20 20">
                                    <path d="M8 9a3 3 0 100-6 3 3 0 000 6zM8 11a6 6 0 016 6H2a6 6 0 016-6z"></path>
                                </svg>
                                7 Seats
                            </div>
                            <div class="flex items-center gap-1">
                                <svg class="w-4 h-4" fill="currentColor" viewBox="0 0 20 20">
                                    <path d="M10 2a5 5 0 00-5 5v2a2 2 0 00-2 2v5a2 2 0 002 2h10a2 2 0 002-2v-5a2 2 0 00-2-2H7V7a3 3 0 015.905-.75 1 1 0 001.937-.5A5.002 5.002 0 0010 2z"></path>
                                </svg>
                                Auto
                            </div>
                            <div class="flex items-center gap-1">
                                <svg class="w-4 h-4" fill="currentColor" viewBox="0 0 20 20">
                                    <path fill-rule="evenodd" d="M12.395 2.553a1 1 0 00-1.45-.385c-.345.23-.614.558-.822.88-.214.33-.403.713-.57 1.116-.334.804-.614 1.768-.84 2.734a31.365 31.365 0 00-.613 3.58 2.64 2.64 0 01-.945-1.067c-.328-.68-.398-1.534-.398-2.654A1 1 0 005.05 6.05 6.981 6.981 0 003 11a7 7 0 1011.95-4.95c-.592-.591-.98-.985-1.348-1.467-.363-.476-.724-1.063-1.207-2.03zM12.12 15.12A3 3 0 017 13s.879.5 2.5.5c0-1 .5-4 1.25-4.5.5 1 .786 1.293 1.371 1.879A2.99 2.99 0 0113 13a2.99 2.99 0 01-.879 2.121z" clip-rule="evenodd"></path>
                                </svg>
                                AC
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Car 3 -->
                <div class="glass-effect rounded-2xl overflow-hidden card-hover group">
                    <div class="relative h-64 bg-gradient-to-br from-red-900 to-red-700 flex items-center justify-center overflow-hidden">
                        <div class="text-8xl group-hover:scale-110 transition-transform duration-300">🏎️</div>
                        <div class="absolute top-4 right-4 bg-yellow-500 text-white px-3 py-1 rounded-full text-sm font-semibold">
                            Popular
                        </div>
                    </div>
                    <div class="p-6">
                        <h3 class="text-2xl font-bold text-white mb-2">Luxury Sedan</h3>
                        <p class="text-gray-400 mb-4">Elegance untuk acara special</p>
                        <div class="flex items-center justify-between">
                            <div>
                                <span class="text-gray-500 text-sm">Mulai dari</span>
                                <div class="text-2xl font-bold text-red-400">Rp 800K<span class="text-sm text-gray-500">/hari</span></div>
                            </div>
                            <a href="{{ route('register') }}" class="bg-red-600 text-white px-4 py-2 rounded-lg hover:bg-red-700 transition-all shine">
                                Sewa
                            </a>
                        </div>
                        <div class="mt-4 grid grid-cols-3 gap-2 text-sm text-gray-400">
                            <div class="flex items-center gap-1">
                                <svg class="w-4 h-4" fill="currentColor" viewBox="0 0 20 20">
                                    <path d="M8 9a3 3 0 100-6 3 3 0 000 6zM8 11a6 6 0 016 6H2a6 6 0 016-6z"></path>
                                </svg>
                                5 Seats
                            </div>
                            <div class="flex items-center gap-1">
                                <svg class="w-4 h-4" fill="currentColor" viewBox="0 0 20 20">
                                    <path d="M10 2a5 5 0 00-5 5v2a2 2 0 00-2 2v5a2 2 0 002 2h10a2 2 0 002-2v-5a2 2 0 00-2-2H7V7a3 3 0 015.905-.75 1 1 0 001.937-.5A5.002 5.002 0 0010 2z"></path>
                                </svg>
                                Auto
                            </div>
                            <div class="flex items-center gap-1">
                                <svg class="w-4 h-4" fill="currentColor" viewBox="0 0 20 20">
                                    <path fill-rule="evenodd" d="M12.395 2.553a1 1 0 00-1.45-.385c-.345.23-.614.558-.822.88-.214.33-.403.713-.57 1.116-.334.804-.614 1.768-.84 2.734a31.365 31.365 0 00-.613 3.58 2.64 2.64 0 01-.945-1.067c-.328-.68-.398-1.534-.398-2.654A1 1 0 005.05 6.05 6.981 6.981 0 003 11a7 7 0 1011.95-4.95c-.592-.591-.98-.985-1.348-1.467-.363-.476-.724-1.063-1.207-2.03zM12.12 15.12A3 3 0 017 13s.879.5 2.5.5c0-1 .5-4 1.25-4.5.5 1 .786 1.293 1.371 1.879A2.99 2.99 0 0113 13a2.99 2.99 0 01-.879 2.121z" clip-rule="evenodd"></path>
                                </svg>
                                AC
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Pricing Section -->
    <section id="pricing" class="py-24 bg-gray-800">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="text-center mb-16">
                <h2 class="text-5xl font-bold mb-4 text-white">
                    Paket Rental Terbaik
                </h2>
                <p class="text-gray-400 text-lg">Pilih paket yang sesuai dengan kebutuhan Anda</p>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-3 gap-8">
                <!-- Basic Plan -->
                <div class="glass-effect rounded-2xl p-8 border border-white/10 price-card">
                    <div class="text-center">
                        <div class="inline-block px-4 py-2 bg-gray-700 rounded-full text-sm font-semibold mb-4">
                            BASIC
                        </div>
                        <div class="text-5xl font-bold text-white mb-2">
                            Rp 250K
                        </div>
                        <div class="text-gray-400 mb-8">per hari</div>
                        <a href="{{ route('register') }}" class="block w-full bg-gray-700 text-white py-3 rounded-lg font-semibold hover:bg-gray-600 transition-all mb-8">
                            Pilih Paket
                        </a>
                    </div>
                    <ul class="space-y-4">
                        <li class="flex items-start">
                            <svg class="w-6 h-6 text-green-500 mr-3 flex-shrink-0" fill="currentColor" viewBox="0 0 20 20">
                                <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd"></path>
                            </svg>
                            <span class="text-gray-300">City Car Standard</span>
                        </li>
                        <li class="flex items-start">
                            <svg class="w-6 h-6 text-green-500 mr-3 flex-shrink-0" fill="currentColor" viewBox="0 0 20 20">
                                <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd"></path>
                            </svg>
                            <span class="text-gray-300">Asuransi Dasar</span>
                        </li>
                        <li class="flex items-start">
                            <svg class="w-6 h-6 text-green-500 mr-3 flex-shrink-0" fill="currentColor" viewBox="0 0 20 20">
                                <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd"></path>
                            </svg>
                            <span class="text-gray-300">BBM 50km/hari</span>
                        </li>
                        <li class="flex items-start">
                            <svg class="w-6 h-6 text-green-500 mr-3 flex-shrink-0" fill="currentColor" viewBox="0 0 20 20">
                                <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd"></path>
                            </svg>
                            <span class="text-gray-300">Customer Support</span>
                        </li>
                    </ul>
                </div>

                <!-- Pro Plan -->
                <div class="glass-effect rounded-2xl p-8 border-2 border-blue-500 price-card relative">
                    <div class="absolute -top-4 left-1/2 transform -translate-x-1/2">
                        <span class="bg-gradient-to-r from-blue-500 to-purple-500 text-white px-4 py-1 rounded-full text-sm font-semibold">
                            PALING POPULER
                        </span>
                    </div>
                    <div class="text-center">
                        <div class="inline-block px-4 py-2 bg-blue-600 rounded-full text-sm font-semibold mb-4">
                            PRO
                        </div>
                        <div class="text-5xl font-bold text-white mb-2">
                            Rp 500K
                        </div>
                        <div class="text-gray-400 mb-8">per hari</div>
                        <a href="{{ route('register') }}" class="block w-full bg-blue-600 text-white py-3 rounded-lg font-semibold hover:bg-blue-700 transition-all mb-8 shine">
                            Pilih Paket
                        </a>
                    </div>
                    <ul class="space-y-4">
                        <li class="flex items-start">
                            <svg class="w-6 h-6 text-green-500 mr-3 flex-shrink-0" fill="currentColor" viewBox="0 0 20 20">
                                <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd"></path>
                            </svg>
                            <span class="text-gray-300">SUV Premium</span>
                        </li>
                        <li class="flex items-start">
                            <svg class="w-6 h-6 text-green-500 mr-3 flex-shrink-0" fill="currentColor" viewBox="0 0 20 20">
                                <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd"></path>
                            </svg>
                            <span class="text-gray-300">Asuransi All-Risk</span>
                        </li>
                        <li class="flex items-start">
                            <svg class="w-6 h-6 text-green-500 mr-3 flex-shrink-0" fill="currentColor" viewBox="0 0 20 20">
                                <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd"></path>
                            </svg>
                            <span class="text-gray-300">BBM Unlimited</span>
                        </li>
                        <li class="flex items-start">
                            <svg class="w-6 h-6 text-green-500 mr-3 flex-shrink-0" fill="currentColor" viewBox="0 0 20 20">
                                <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd"></path>
                            </svg>
                            <span class="text-gray-300">Driver Profesional</span>
                        </li>
                        <li class="flex items-start">
                            <svg class="w-6 h-6 text-green-500 mr-3 flex-shrink-0" fill="currentColor" viewBox="0 0 20 20">
                                <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd"></path>
                            </svg>
                            <span class="text-gray-300">Priority Support 24/7</span>
                        </li>
                    </ul>
                </div>

                <!-- Enterprise Plan -->
                <div class="glass-effect rounded-2xl p-8 border border-white/10 price-card">
                    <div class="text-center">
                        <div class="inline-block px-4 py-2 bg-gradient-to-r from-purple-600 to-pink-600 rounded-full text-sm font-semibold mb-4">
                            ENTERPRISE
                        </div>
                        <div class="text-5xl font-bold text-white mb-2">
                            Rp 1.2JT
                        </div>
                        <div class="text-gray-400 mb-8">per hari</div>
                        <a href="{{ route('register') }}" class="block w-full bg-gradient-to-r from-purple-600 to-pink-600 text-white py-3 rounded-lg font-semibold hover:from-purple-700 hover:to-pink-700 transition-all mb-8 shine">
                            Pilih Paket
                        </a>
                    </div>
                    <ul class="space-y-4">
                        <li class="flex items-start">
                            <svg class="w-6 h-6 text-green-500 mr-3 flex-shrink-0" fill="currentColor" viewBox="0 0 20 20">
                                <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd"></path>
                            </svg>
                            <span class="text-gray-300">Luxury Sedan</span>
                        </li>
                        <li class="flex items-start">
                            <svg class="w-6 h-6 text-green-500 mr-3 flex-shrink-0" fill="currentColor" viewBox="0 0 20 20">
                                <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd"></path>
                            </svg>
                            <span class="text-gray-300">Full Coverage Insurance</span>
                        </li>
                        <li class="flex items-start">
                            <svg class="w-6 h-6 text-green-500 mr-3 flex-shrink-0" fill="currentColor" viewBox="0 0 20 20">
                                <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd"></path>
                            </svg>
                            <span class="text-gray-300">BBM & Tol Unlimited</span>
                        </li>
                        <li class="flex items-start">
                            <svg class="w-6 h-6 text-green-500 mr-3 flex-shrink-0" fill="currentColor" viewBox="0 0 20 20">
                                <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd"></path>
                            </svg>
                            <span class="text-gray-300">VIP Driver Certified</span>
                        </li>
                        <li class="flex items-start">
                            <svg class="w-6 h-6 text-green-500 mr-3 flex-shrink-0" fill="currentColor" viewBox="0 0 20 20">
                                <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd"></path>
                            </svg>
                            <span class="text-gray-300">Dedicated Account Manager</span>
                        </li>
                        <li class="flex items-start">
                            <svg class="w-6 h-6 text-green-500 mr-3 flex-shrink-0" fill="currentColor" viewBox="0 0 20 20">
                                <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd"></path>
                            </svg>
                            <span class="text-gray-300">VIP Concierge Service</span>
                        </li>
                    </ul>
                </div>
            </div>
        </div>
    </section>

    <!-- How It Works -->
    <section class="py-24 bg-gray-900">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="text-center mb-16">
                <h2 class="text-5xl font-bold mb-4 text-white">
                    Cara Kerjanya
                </h2>
                <p class="text-gray-400 text-lg">4 langkah mudah untuk rental mobil impian Anda</p>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-4 gap-8">
                <!-- Step 1 -->
                <div class="text-center">
                    <div class="w-20 h-20 bg-blue-600 text-white rounded-full flex items-center justify-center mx-auto mb-6 text-3xl font-bold shadow-lg hover:scale-110 transition-transform">
                        1
                    </div>
                    <h3 class="text-xl font-bold mb-3 text-white">Daftar/Login</h3>
                    <p class="text-gray-400">Buat akun atau login ke dashboard Anda</p>
                </div>

                <!-- Step 2 -->
                <div class="text-center">
                    <div class="w-20 h-20 bg-blue-600 text-white rounded-full flex items-center justify-center mx-auto mb-6 text-3xl font-bold shadow-lg hover:scale-110 transition-transform">
                        2
                    </div>
                    <h3 class="text-xl font-bold mb-3 text-white">Pilih Mobil</h3>
                    <p class="text-gray-400">Browse dan pilih mobil sesuai kebutuhan</p>
                </div>

                <!-- Step 3 -->
                <div class="text-center">
                    <div class="w-20 h-20 bg-blue-600 text-white rounded-full flex items-center justify-center mx-auto mb-6 text-3xl font-bold shadow-lg hover:scale-110 transition-transform">
                        3
                    </div>
                    <h3 class="text-xl font-bold mb-3 text-white">Booking & Bayar</h3>
                    <p class="text-gray-400">Tentukan tanggal dan lakukan pembayaran</p>
                </div>

                <!-- Step 4 -->
                <div class="text-center">
                    <div class="w-20 h-20 bg-blue-600 text-white rounded-full flex items-center justify-center mx-auto mb-6 text-3xl font-bold shadow-lg hover:scale-110 transition-transform">
                        4
                    </div>
                    <h3 class="text-xl font-bold mb-3 text-white">Nikmati Perjalanan</h3>
                    <p class="text-gray-400">Mobil diantar dan siap digunakan</p>
                </div>
            </div>
        </div>
    </section>

    <!-- Testimonials Section -->
    <section id="testimonials" class="py-24 bg-gray-800">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="text-center mb-16">
                <h2 class="text-5xl font-bold mb-4 text-white">
                    Apa Kata Mereka?
                </h2>
                <p class="text-gray-400 text-lg">Testimoni dari pelanggan yang puas</p>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-3 gap-8">
                <!-- Testimonial 1 -->
                <div class="glass-effect rounded-2xl p-8 border border-white/10 testimonial-card">
                    <div class="flex items-center mb-4">
                        <div class="w-12 h-12 bg-gradient-to-br from-blue-500 to-purple-500 rounded-full flex items-center justify-center text-2xl mr-4">
                            👨
                        </div>
                        <div>
                            <h4 class="font-bold text-white">Budi Santoso</h4>
                            <div class="flex text-yellow-400">
                                ★★★★★
                            </div>
                        </div>
                    </div>
                    <p class="text-gray-300 italic">"Pelayanan sangat memuaskan! Mobilnya bersih dan terawat. Driver juga sangat ramah dan profesional. Pasti akan sewa lagi!"</p>
                </div>

                <!-- Testimonial 2 -->
                <div class="glass-effect rounded-2xl p-8 border border-white/10 testimonial-card">
                    <div class="flex items-center mb-4">
                        <div class="w-12 h-12 bg-gradient-to-br from-pink-500 to-red-500 rounded-full flex items-center justify-center text-2xl mr-4">
                            👩
                        </div>
                        <div>
                            <h4 class="font-bold text-white">Sarah Wijaya</h4>
                            <div class="flex text-yellow-400">
                                ★★★★★
                            </div>
                        </div>
                    </div>
                    <p class="text-gray-300 italic">"Booking mudah, harga transparan, dan mobil sesuai ekspektasi. Recommended banget untuk yang butuh rental mobil!"</p>
                </div>

                <!-- Testimonial 3 -->
                <div class="glass-effect rounded-2xl p-8 border border-white/10 testimonial-card">
                    <div class="flex items-center mb-4">
                        <div class="w-12 h-12 bg-gradient-to-br from-green-500 to-teal-500 rounded-full flex items-center justify-center text-2xl mr-4">
                            👨
                        </div>
                        <div>
                            <h4 class="font-bold text-white">Andi Pratama</h4>
                            <div class="flex text-yellow-400">
                                ★★★★★
                            </div>
                        </div>
                    </div>
                    <p class="text-gray-300 italic">"Pertama kali rental mobil online dan ternyata prosesnya gampang banget. Customer service responsif dan helpful. Top!"</p>
                </div>
            </div>
        </div>
    </section>

    <!-- FAQ Section -->
    <section class="py-24 bg-gray-900">
        <div class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="text-center mb-16">
                <h2 class="text-5xl font-bold mb-4 text-white">
                    Pertanyaan Umum
                </h2>
                <p class="text-gray-400 text-lg">Jawaban untuk pertanyaan yang sering diajukan</p>
            </div>

            <div class="space-y-4">
                <!-- FAQ 1 -->
                <div class="glass-effect rounded-xl p-6 border border-white/10">
                    <h3 class="text-xl font-bold text-white mb-3">Apa saja syarat untuk rental mobil?</h3>
                    <p class="text-gray-400">Anda hanya perlu memiliki KTP, SIM A yang masih berlaku, dan deposit sesuai jenis mobil yang disewa.</p>
                </div>

                <!-- FAQ 2 -->
                <div class="glass-effect rounded-xl p-6 border border-white/10">
                    <h3 class="text-xl font-bold text-white mb-3">Apakah bisa rental dengan driver?</h3>
                    <p class="text-gray-400">Ya, kami menyediakan layanan rental dengan driver profesional yang berpengalaman dan tersertifikasi.</p>
                </div>

                <!-- FAQ 3 -->
                <div class="glass-effect rounded-xl p-6 border border-white/10">
                    <h3 class="text-xl font-bold text-white mb-3">Bagaimana cara pembayaran?</h3>
                    <p class="text-gray-400">Kami menerima pembayaran melalui transfer bank, e-wallet, dan kartu kredit/debit.</p>
                </div>

                <!-- FAQ 4 -->
                <div class="glass-effect rounded-xl p-6 border border-white/10">
                    <h3 class="text-xl font-bold text-white mb-3">Apakah ada biaya tambahan?</h3>
                    <p class="text-gray-400">Tidak ada biaya tersembunyi. Semua biaya sudah tertera jelas di awal, termasuk asuransi dan BBM sesuai paket.</p>
                </div>

                <!-- FAQ 5 -->
                <div class="glass-effect rounded-xl p-6 border border-white/10">
                    <h3 class="text-xl font-bold text-white mb-3">Bagaimana jika terjadi kecelakaan?</h3>
                    <p class="text-gray-400">Semua mobil kami dilengkapi asuransi. Tim support kami siap membantu 24/7 untuk penanganan emergency.</p>
                </div>
            </div>
        </div>
    </section>

    <!-- CTA Section -->
    <section class="py-24 bg-gradient-to-r from-blue-600 to-blue-700">
        <div class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8 text-center">
            <h2 class="text-5xl md:text-6xl font-bold mb-6 text-white">
                Siap Memulai Perjalanan Anda?
            </h2>
            <p class="text-xl text-blue-100 mb-10 leading-relaxed">
                Daftar sekarang dan dapatkan penawaran terbaik untuk rental mobil Anda
            </p>
            <div class="flex flex-col sm:flex-row justify-center gap-4">
                <a href="{{ route('register') }}" class="group bg-white text-blue-600 px-12 py-5 rounded-lg text-lg font-bold hover:shadow-xl transition-all hover:scale-105 shine">
                    <span class="flex items-center justify-center gap-2">
                        Daftar Gratis Sekarang
                        <svg class="w-5 h-5 group-hover:translate-x-1 transition-transform" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 7l5 5m0 0l-5 5m5-5H6"></path>
                        </svg>
                    </span>
                </a>
            </div>

            <!-- Trust badges -->
            <div class="mt-12 flex flex-wrap justify-center gap-8 items-center">
                <div class="flex items-center gap-2">
                    <svg class="w-6 h-6 text-yellow-400" fill="currentColor" viewBox="0 0 20 20">
                        <path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z"></path>
                    </svg>
                    <span class="text-white font-semibold">4.9/5 Rating</span>
                </div>
                <div class="flex items-center gap-2">
                    <svg class="w-6 h-6 text-green-400" fill="currentColor" viewBox="0 0 20 20">
                        <path fill-rule="evenodd" d="M2.166 4.999A11.954 11.954 0 0010 1.944 11.954 11.954 0 0017.834 5c.11.65.166 1.32.166 2.001 0 5.225-3.34 9.67-8 11.317C5.34 16.67 2 12.225 2 7c0-.682.057-1.35.166-2.001zm11.541 3.708a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd"></path>
                    </svg>
                    <span class="text-white font-semibold">Verified Safe</span>
                </div>
                <div class="flex items-center gap-2">
                    <svg class="w-6 h-6 text-blue-300" fill="currentColor" viewBox="0 0 20 20">
                        <path fill-rule="evenodd" d="M6.267 3.455a3.066 3.066 0 001.745-.723 3.066 3.066 0 013.976 0 3.066 3.066 0 001.745.723 3.066 3.066 0 012.812 2.812c.051.643.304 1.254.723 1.745a3.066 3.066 0 010 3.976 3.066 3.066 0 00-.723 1.745 3.066 3.066 0 01-2.812 2.812 3.066 3.066 0 00-1.745.723 3.066 3.066 0 01-3.976 0 3.066 3.066 0 00-1.745-.723 3.066 3.066 0 01-2.812-2.812 3.066 3.066 0 00-.723-1.745 3.066 3.066 0 010-3.976 3.066 3.066 0 00.723-1.745 3.066 3.066 0 012.812-2.812zm7.44 5.252a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd"></path>
                    </svg>
                    <span class="text-white font-semibold">ISO Certified</span>
                </div>
            </div>
        </div>
    </section>

    <!-- Footer -->
    <footer class="bg-gray-950 border-t border-gray-800">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-16">
            <div class="grid grid-cols-1 md:grid-cols-4 gap-12 mb-12">
                <div>
                    <div class="flex items-center space-x-3 mb-6">
                        <div class="w-10 h-10 bg-gradient-to-br from-blue-500 to-purple-600 rounded-lg flex items-center justify-center">
                            <span class="text-xl">🚗</span>
                        </div>
                        <h3 class="text-xl font-bold bg-gradient-to-r from-blue-400 to-purple-500 bg-clip-text text-transparent">
                            Rental Mobil
                        </h3>
                    </div>
                    <p class="text-gray-400 leading-relaxed">Solusi rental mobil terpercaya dengan teknologi terdepan untuk perjalanan Anda</p>
                </div>
                
                <div>
                    <h4 class="font-bold mb-6 text-lg">Quick Links</h4>
                    <ul class="space-y-3">
                        <li><a href="{{ route('login') }}" class="text-gray-400 hover:text-blue-400 transition-colors flex items-center gap-2">
                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"></path>
                            </svg>
                            Login
                        </a></li>
                        <li><a href="{{ route('register') }}" class="text-gray-400 hover:text-blue-400 transition-colors flex items-center gap-2">
                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"></path>
                            </svg>
                            Daftar
                        </a></li>
                    </ul>
                </div>
                
                <div>
                    <h4 class="font-bold mb-6 text-lg">Kontak</h4>
                    <ul class="space-y-3 text-gray-400">
                        <li class="flex items-center gap-3">
                            <svg class="w-5 h-5 text-blue-400" fill="currentColor" viewBox="0 0 20 20">
                                <path d="M2.003 5.884L10 9.882l7.997-3.998A2 2 0 0016 4H4a2 2 0 00-1.997 1.884z"></path>
                                <path d="M18 8.118l-8 4-8-4V14a2 2 0 002 2h12a2 2 0 002-2V8.118z"></path>
                            </svg>
                            info@rentalmobil.com
                        </li>
                        <li class="flex items-center gap-3">
                            <svg class="w-5 h-5 text-green-400" fill="currentColor" viewBox="0 0 20 20">
                                <path d="M2 3a1 1 0 011-1h2.153a1 1 0 01.986.836l.74 4.435a1 1 0 01-.54 1.06l-1.548.773a11.037 11.037 0 006.105 6.105l.774-1.548a1 1 0 011.059-.54l4.435.74a1 1 0 01.836.986V17a1 1 0 01-1 1h-2C7.82 18 2 12.18 2 5V3z"></path>
                            </svg>
                            +62 812-3456-7890
                        </li>
                        <li class="flex items-center gap-3">
                            <svg class="w-5 h-5 text-red-400" fill="currentColor" viewBox="0 0 20 20">
                                <path fill-rule="evenodd" d="M5.05 4.05a7 7 0 119.9 9.9L10 18.9l-4.95-4.95a7 7 0 010-9.9zM10 11a2 2 0 100-4 2 2 0 000 4z" clip-rule="evenodd"></path>
                            </svg>
                            Jakarta, Indonesia
                        </li>
                    </ul>
                </div>

                <div>
                    <h4 class="font-bold mb-6 text-lg">Follow Us</h4>
                    <div class="flex gap-4">
                        <a href="#" class="w-10 h-10 bg-gray-800 hover:bg-blue-600 rounded-lg flex items-center justify-center transition-all hover:scale-110">
                            <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 24 24"><path d="M24 12.073c0-6.627-5.373-12-12-12s-12 5.373-12 12c0 5.99 4.388 10.954 10.125 11.854v-8.385H7.078v-3.47h3.047V9.43c0-3.007 1.792-4.669 4.533-4.669 1.312 0 2.686.235 2.686.235v2.953H15.83c-1.491 0-1.956.925-1.956 1.874v2.25h3.328l-.532 3.47h-2.796v8.385C19.612 23.027 24 18.062 24 12.073z"/></svg>
                        </a>
                        <a href="#" class="w-10 h-10 bg-gray-800 hover:bg-blue-400 rounded-lg flex items-center justify-center transition-all hover:scale-110">
                            <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 24 24"><path d="M23.953 4.57a10 10 0 01-2.825.775 4.958 4.958 0 002.163-2.723c-.951.555-2.005.959-3.127 1.184a4.92 4.92 0 00-8.384 4.482C7.69 8.095 4.067 6.13 1.64 3.162a4.822 4.822 0 00-.666 2.475c0 1.71.87 3.213 2.188 4.096a4.904 4.904 0 01-2.228-.616v.06a4.923 4.923 0 003.946 4.827 4.996 4.996 0 01-2.212.085 4.936 4.936 0 004.604 3.417 9.867 9.867 0 01-6.102 2.105c-.39 0-.779-.023-1.17-.067a13.995 13.995 0 007.557 2.209c9.053 0 13.998-7.496 13.998-13.985 0-.21 0-.42-.015-.63A9.935 9.935 0 0024 4.59z"/></svg>
                        </a>
                        <a href="#" class="w-10 h-10 bg-gray-800 hover:bg-pink-600 rounded-lg flex items-center justify-center transition-all hover:scale-110">
                            <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 24 24"><path d="M12 0C8.74 0 8.333.015 7.053.072 5.775.132 4.905.333 4.14.63c-.789.306-1.459.717-2.126 1.384S.935 3.35.63 4.14C.333 4.905.131 5.775.072 7.053.012 8.333 0 8.74 0 12s.015 3.667.072 4.947c.06 1.277.261 2.148.558 2.913.306.788.717 1.459 1.384 2.126.667.666 1.336 1.079 2.126 1.384.766.296 1.636.499 2.913.558C8.333 23.988 8.74 24 12 24s3.667-.015 4.947-.072c1.277-.06 2.148-.262 2.913-.558.788-.306 1.459-.718 2.126-1.384.666-.667 1.079-1.335 1.384-2.126.296-.765.499-1.636.558-2.913.06-1.28.072-1.687.072-4.947s-.015-3.667-.072-4.947c-.06-1.277-.262-2.149-.558-2.913-.306-.789-.718-1.459-1.384-2.126C21.319 1.347 20.651.935 19.86.63c-.765-.297-1.636-.499-2.913-.558C15.667.012 15.26 0 12 0zm0 2.16c3.203 0 3.585.016 4.85.071 1.17.055 1.805.249 2.227.415.562.217.96.477 1.382.896.419.42.679.819.896 1.381.164.422.36 1.057.413 2.227.057 1.266.07 1.646.07 4.85s-.015 3.585-.074 4.85c-.061 1.17-.256 1.805-.421 2.227-.224.562-.479.96-.899 1.382-.419.419-.824.679-1.38.896-.42.164-1.065.36-2.235.413-1.274.057-1.649.07-4.859.07-3.211 0-3.586-.015-4.859-.074-1.171-.061-1.816-.256-2.236-.421-.569-.224-.96-.479-1.379-.899-.421-.419-.69-.824-.9-1.38-.165-.42-.359-1.065-.42-2.235-.045-1.26-.061-1.649-.061-4.844 0-3.196.016-3.586.061-4.861.061-1.17.255-1.814.42-2.234.21-.57.479-.96.9-1.381.419-.419.81-.689 1.379-.898.42-.166 1.051-.361 2.221-.421 1.275-.045 1.65-.06 4.859-.06l.045.03zm0 3.678c-3.405 0-6.162 2.76-6.162 6.162 0 3.405 2.76 6.162 6.162 6.162 3.405 0 6.162-2.76 6.162-6.162 0-3.405-2.76-6.162-6.162-6.162zM12 16c-2.21 0-4-1.79-4-4s1.79-4 4-4 4 1.79 4 4-1.79 4-4 4zm7.846-10.405c0 .795-.646 1.44-1.44 1.44-.795 0-1.44-.646-1.44-1.44 0-.794.646-1.439 1.44-1.439.793-.001 1.44.645 1.44 1.439z"/></svg>
                        </a>
                    </div>
                </div>
            </div>
            
            <div class="border-t border-gray-800 pt-8 text-center">
                <p class="text-gray-500">
                    &copy; 2024 Rental Mobil. All rights reserved. Made with 
                    <span class="text-red-500">❤️</span> in Indonesia
                </p>
            </div>
        </div>
    </footer>

    <script>
        // Scroll progress bar
        window.addEventListener('scroll', () => {
            const scrollProgress = document.querySelector('.scroll-progress');
            const scrollHeight = document.documentElement.scrollHeight - window.innerHeight;
            const scrolled = (window.pageYOffset / scrollHeight);
            scrollProgress.style.transform = `scaleX(${scrolled})`;
        });

        // Navbar scroll effect
        const navbar = document.getElementById('navbar');
        const navbarContainer = document.getElementById('navbar-container');
        let lastScroll = 0;

        window.addEventListener('scroll', () => {
            const currentScroll = window.pageYOffset;
            
            if (currentScroll > 50) {
                navbarContainer.classList.add('navbar-scrolled');
            } else {
                navbarContainer.classList.remove('navbar-scrolled');
            }
            
            if (currentScroll > lastScroll && currentScroll > 100) {
                navbar.style.transform = 'translateY(-100%)';
            } else {
                navbar.style.transform = 'translateY(0)';
            }
            
            lastScroll = currentScroll;
        });

        // Smooth scroll
        document.querySelectorAll('a[href^="#"]').forEach(anchor => {
            anchor.addEventListener('click', function (e) {
                e.preventDefault();
                const target = document.querySelector(this.getAttribute('href'));
                if (target) {
                    target.scrollIntoView({ behavior: 'smooth', block: 'start' });
                }
            });
        });
    </script>
</body>
</html>