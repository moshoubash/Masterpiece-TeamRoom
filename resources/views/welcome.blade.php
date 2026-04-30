@extends('layouts.home.layout')
@section('styles')
    <style>
        @import url('https://fonts.googleapis.com/css2?family=Sora:wght@400;500;600;700;800&family=DM+Sans:ital,wght@0,400;0,500;1,400&display=swap');

        :root {
            --blue-50: #EFF6FF;
            --blue-100: #DBEAFE;
            --blue-200: #BFDBFE;
            --blue-500: #3B82F6;
            --blue-600: #2563EB;
            --blue-700: #1D4ED8;
            --blue-800: #1E40AF;
            --blue-900: #1E3A8A;
            --gray-50: #F9FAFB;
            --gray-100: #F3F4F6;
            --gray-200: #E5E7EB;
            --gray-400: #9CA3AF;
            --gray-600: #4B5563;
            --gray-700: #374151;
            --gray-800: #1F2937;
            --gray-900: #111827;
        }

        * {
            box-sizing: border-box;
        }

        body {
            font-family: 'DM Sans', sans-serif;
        }

        h1,
        h2,
        h3,
        h4 {
            font-family: 'Sora', sans-serif;
        }

        /*  HERO  */
        #hero {
            position: relative;
            min-height: 520px;
            display: flex;
            align-items: center;
            justify-content: center;
            overflow: hidden;
            padding: 80px 1rem 60px;
        }

        #hero::before {
            content: '';
            position: absolute;
            inset: 0;
            background-image: url("{{ asset('https://www.renderhub.com/archcorners/modern-meeting-room/modern-meeting-room-01.jpg') }}");
            background-size: cover;
            background-position: center;
            background-repeat: no-repeat;
            z-index: 0;
        }

        #hero::after {
            content: '';
            position: absolute;
            inset: 0;
            background: linear-gradient(135deg, rgba(15, 23, 66, 0.88) 0%, rgba(29, 78, 216, 0.82) 100%);
            z-index: 1;
        }

        #hero .hero-content {
            position: relative;
            z-index: 2;
            width: 100%;
            max-width: 900px;
            margin: 0 auto;
            text-align: center;
        }

        .hero-badge {
            display: inline-flex;
            align-items: center;
            gap: 6px;
            background: rgba(255, 255, 255, 0.12);
            backdrop-filter: blur(8px);
            border: 1px solid rgba(255, 255, 255, 0.2);
            color: #BFDBFE;
            font-size: 13px;
            font-weight: 500;
            padding: 6px 14px;
            border-radius: 100px;
            margin-bottom: 20px;
            letter-spacing: 0.02em;
        }

        .hero-badge::before {
            content: '';
            width: 7px;
            height: 7px;
            background: #60A5FA;
            border-radius: 50%;
            animation: pulse-dot 2s infinite;
        }

        @keyframes pulse-dot {

            0%,
            100% {
                opacity: 1;
                transform: scale(1);
            }

            50% {
                opacity: 0.5;
                transform: scale(1.3);
            }
        }

        #hero h1 {
            font-size: clamp(2rem, 5vw, 3.5rem);
            font-weight: 800;
            color: #fff;
            line-height: 1.15;
            margin-bottom: 16px;
            letter-spacing: -0.02em;
        }

        #hero h1 .accent {
            color: #60A5FA;
            position: relative;
        }

        #hero h1 .accent::after {
            content: '';
            position: absolute;
            bottom: 2px;
            left: 0;
            width: 100%;
            height: 3px;
            background: linear-gradient(90deg, #60A5FA, #93C5FD);
            border-radius: 2px;
            opacity: 0.6;
        }

        #hero p {
            font-size: clamp(1rem, 2vw, 1.2rem);
            color: rgba(219, 234, 254, 0.9);
            max-width: 560px;
            margin: 0 auto 36px;
            line-height: 1.7;
        }

        /*  SEARCH FORM  */
        .search-form {
            background: #fff;
            border-radius: 16px;
            box-shadow: 0 20px 60px rgba(0, 0, 0, 0.25);
            padding: 8px;
            display: flex;
            flex-direction: column;
            gap: 2px;
        }

        @media (min-width: 768px) {
            .search-form {
                flex-direction: row;
                align-items: stretch;
                gap: 0;
            }
        }

        .search-field {
            flex: 1;
            padding: 12px 16px;
            display: flex;
            flex-direction: column;
            gap: 3px;
            border-radius: 10px;
            transition: background 0.2s;
            cursor: pointer;
        }

        .search-field:hover {
            background: var(--blue-50);
        }

        @media (min-width: 768px) {
            .search-field {
                border-right: 1px solid var(--gray-200);
                border-radius: 0;
            }

            .search-field:first-child {
                border-radius: 10px 0 0 10px;
            }

            .search-field:last-of-type {
                border-right: none;
            }
        }

        .search-field label {
            font-size: 10px;
            font-weight: 600;
            text-transform: uppercase;
            letter-spacing: 0.08em;
            color: var(--blue-600);
        }

        .search-field select,
        .search-field input {
            border: none;
            outline: none;
            background: transparent;
            font-family: 'DM Sans', sans-serif;
            font-size: 15px;
            font-weight: 500;
            color: var(--gray-800);
            cursor: pointer;
            width: 100%;
            padding: 0;
        }

        .search-btn {
            background: var(--blue-600);
            color: #fff;
            border: none;
            border-radius: 10px;
            padding: 14px 24px;
            font-family: 'Sora', sans-serif;
            font-size: 15px;
            font-weight: 600;
            cursor: pointer;
            display: flex;
            align-items: center;
            justify-content: center;
            gap: 8px;
            transition: background 0.2s, transform 0.15s, box-shadow 0.2s;
            white-space: nowrap;
        }

        .search-btn:hover {
            background: var(--blue-700);
            transform: translateY(-1px);
            box-shadow: 0 8px 20px rgba(37, 99, 235, 0.35);
        }

        .search-btn:active {
            transform: translateY(0);
        }

        /*  STATS BAR  */
        .stats-bar {
            display: flex;
            flex-wrap: wrap;
            justify-content: center;
            gap: 24px 40px;
            margin-top: 36px;
        }

        .stat-item {
            display: flex;
            align-items: center;
            gap: 8px;
            color: rgba(219, 234, 254, 0.8);
            font-size: 14px;
        }

        .stat-item svg {
            color: #60A5FA;
        }

        .stat-num {
            font-family: 'Sora', sans-serif;
            font-weight: 700;
            color: #fff;
        }

        /*  HOW IT WORKS  */
        #how-it-works {
            padding: 90px 1rem;
            background: var(--gray-50);
        }

        .section-eyebrow {
            display: inline-block;
            background: var(--blue-50);
            color: var(--blue-700);
            font-size: 12px;
            font-weight: 700;
            text-transform: uppercase;
            letter-spacing: 0.1em;
            padding: 6px 14px;
            border-radius: 100px;
            margin-bottom: 14px;
            border: 1px solid var(--blue-100);
        }

        .section-title {
            font-size: clamp(1.75rem, 3.5vw, 2.5rem);
            font-weight: 800;
            color: var(--gray-900);
            margin-bottom: 12px;
            letter-spacing: -0.02em;
            line-height: 1.2;
        }

        .section-subtitle {
            font-size: 1.05rem;
            color: var(--gray-600);
            max-width: 560px;
            margin: 0 auto;
            line-height: 1.7;
        }

        .steps-grid {
            display: grid;
            grid-template-columns: 1fr;
            gap: 32px;
            max-width: 1000px;
            margin: 60px auto 0;
        }

        @media (min-width: 768px) {
            .steps-grid {
                grid-template-columns: repeat(3, 1fr);
                gap: 0;
            }
        }

        .step-card {
            position: relative;
            text-align: center;
            padding: 0 24px;
        }

        @media (min-width: 768px) {
            .step-card:not(:last-child)::after {
                content: '';
                position: absolute;
                top: 36px;
                right: -10%;
                width: 20%;
                height: 2px;
                background: linear-gradient(90deg, var(--blue-200), var(--blue-100));
            }
        }

        .step-icon-wrap {
            width: 72px;
            height: 72px;
            border-radius: 20px;
            background: linear-gradient(135deg, var(--blue-600), var(--blue-800));
            display: flex;
            align-items: center;
            justify-content: center;
            margin: 0 auto 24px;
            box-shadow: 0 8px 24px rgba(37, 99, 235, 0.3);
            transition: transform 0.3s, box-shadow 0.3s;
        }

        .step-card:hover .step-icon-wrap {
            transform: translateY(-4px);
            box-shadow: 0 14px 32px rgba(37, 99, 235, 0.4);
        }

        .step-number {
            font-family: 'Sora', sans-serif;
            font-size: 26px;
            font-weight: 800;
            color: #fff;
        }

        .step-card h3 {
            font-size: 1.1rem;
            font-weight: 700;
            color: var(--gray-900);
            margin-bottom: 10px;
        }

        .step-card p {
            font-size: 0.95rem;
            color: var(--gray-600);
            line-height: 1.65;
        }

        .step-cta {
            display: inline-block;
            margin-top: 16px;
            padding: 8px 20px;
            background: var(--blue-600);
            color: #fff;
            border-radius: 8px;
            font-size: 14px;
            font-weight: 600;
            text-decoration: none;
            transition: background 0.2s, transform 0.15s;
        }

        .step-cta:hover {
            background: var(--blue-700);
            transform: translateY(-1px);
        }

        /*  ROOMS CAROUSEL  */
        #features {
            padding: 80px 1rem;
            background: #fff;
        }

        .rooms-header {
            display: flex;
            flex-direction: column;
            gap: 20px;
            margin-bottom: 40px;
        }

        @media (min-width: 768px) {
            .rooms-header {
                flex-direction: row;
                justify-content: space-between;
                align-items: flex-end;
                gap: 0;
            }
        }

        .carousel-controls {
            display: none;
            gap: 10px;
        }

        @media (min-width: 768px) {
            .carousel-controls {
                display: flex;
            }
        }

        .ctrl-btn {
            width: 44px;
            height: 44px;
            border-radius: 50%;
            border: 1.5px solid var(--gray-200);
            background: #fff;
            color: var(--gray-600);
            display: flex;
            align-items: center;
            justify-content: center;
            cursor: pointer;
            transition: all 0.2s;
        }

        .ctrl-btn:hover {
            border-color: var(--blue-500);
            color: var(--blue-600);
            background: var(--blue-50);
        }

        /* Carousel */
        .carousel-outer {
            overflow: hidden;
            border-radius: 12px;
        }

        #spaces-carousel {
            display: flex;
            transition: transform 0.4s cubic-bezier(0.25, 0.46, 0.45, 0.94);
            will-change: transform;
            scrollbar-width: none;
            -ms-overflow-style: none;
        }

        #spaces-carousel::-webkit-scrollbar {
            display: none;
        }

        .carousel-card {
            flex-shrink: 0;
            width: 100%;
            padding: 0 8px;
        }

        @media (min-width: 768px) {
            .carousel-card {
                width: 50%;
            }
        }

        @media (min-width: 1024px) {
            .carousel-card {
                width: 33.3333%;
            }
        }

        /* Room Card */
        .room-card {
            background: #fff;
            border-radius: 16px;
            overflow: hidden;
            border: 1px solid var(--gray-100);
            box-shadow: 0 2px 12px rgba(0, 0, 0, 0.06);
            height: 100%;
            display: flex;
            flex-direction: column;
            transition: box-shadow 0.3s, transform 0.3s;
        }

        .room-card:hover {
            box-shadow: 0 12px 40px rgba(37, 99, 235, 0.14);
            transform: translateY(-4px);
        }

        .room-img-wrap {
            position: relative;
            height: 220px;
            overflow: hidden;
        }

        .room-img-wrap img {
            width: 100%;
            height: 100%;
            object-fit: cover;
            transition: transform 0.5s;
        }

        .room-card:hover .room-img-wrap img {
            transform: scale(1.06);
        }

        .room-badge-new {
            position: absolute;
            top: 14px;
            right: 14px;
            background: var(--blue-600);
            color: #fff;
            font-size: 11px;
            font-weight: 700;
            text-transform: uppercase;
            letter-spacing: 0.05em;
            padding: 4px 10px;
            border-radius: 100px;
            z-index: 2;
        }

        .room-overlay {
            position: absolute;
            inset: 0;
            background: linear-gradient(to top, rgba(0, 0, 0, 0.65), transparent);
            opacity: 0;
            transition: opacity 0.3s;
            display: flex;
            align-items: flex-end;
            padding: 16px;
        }

        .room-card:hover .room-overlay {
            opacity: 1;
        }

        .room-overlay a {
            background: rgba(255, 255, 255, 0.95);
            color: var(--blue-600);
            padding: 8px 16px;
            border-radius: 8px;
            font-size: 13px;
            font-weight: 600;
            text-decoration: none;
            transition: background 0.2s;
        }

        .room-overlay a:hover {
            background: #fff;
        }

        .room-info {
            padding: 18px;
            display: flex;
            flex-direction: column;
            flex: 1;
        }

        .room-title-row {
            display: flex;
            justify-content: space-between;
            align-items: flex-start;
            gap: 8px;
            margin-bottom: 10px;
        }

        .room-title {
            font-size: 1rem;
            font-weight: 700;
            color: var(--gray-900);
            line-height: 1.35;
            transition: color 0.2s;
        }

        .room-card:hover .room-title {
            color: var(--blue-600);
        }

        .room-rating {
            display: flex;
            align-items: center;
            gap: 4px;
            background: #FEF9C3;
            padding: 4px 9px;
            border-radius: 8px;
            flex-shrink: 0;
        }

        .room-rating svg {
            color: #EAB308;
        }

        .room-rating span {
            font-size: 13px;
            font-weight: 600;
            color: #713F12;
        }

        .room-meta {
            display: flex;
            align-items: center;
            gap: 6px;
            font-size: 13px;
            color: var(--gray-600);
            margin-bottom: 12px;
            flex-wrap: wrap;
        }

        .room-meta svg {
            color: var(--gray-400);
            flex-shrink: 0;
        }

        .room-meta .dot {
            color: var(--gray-300);
        }

        .amenity-tags {
            display: flex;
            flex-wrap: wrap;
            gap: 6px;
            margin-bottom: 16px;
        }

        .amenity-tag {
            background: var(--gray-100);
            color: var(--gray-700);
            font-size: 12px;
            padding: 3px 10px;
            border-radius: 100px;
            font-weight: 500;
        }

        .room-footer {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-top: auto;
            padding-top: 14px;
            border-top: 1px solid var(--gray-100);
        }

        .room-price {
            font-family: 'Sora', sans-serif;
            font-size: 1.35rem;
            font-weight: 800;
            color: var(--gray-900);
        }

        .room-price span {
            font-size: 14px;
            font-weight: 400;
            color: var(--gray-500);
        }

        .room-avail-link {
            font-size: 13px;
            font-weight: 600;
            color: var(--blue-600);
            text-decoration: none;
            padding: 6px 12px;
            border-radius: 8px;
            border: 1.5px solid var(--blue-200);
            transition: all 0.2s;
        }

        .room-avail-link:hover {
            background: var(--blue-50);
            border-color: var(--blue-400);
        }

        /* Mobile carousel dots */
        .carousel-dots {
            display: flex;
            justify-content: center;
            gap: 8px;
            margin-top: 24px;
        }

        .carousel-dot {
            width: 8px;
            height: 8px;
            border-radius: 50%;
            background: var(--gray-200);
            border: none;
            cursor: pointer;
            padding: 0;
            transition: all 0.2s;
        }

        .carousel-dot.active {
            background: var(--blue-600);
            width: 24px;
            border-radius: 4px;
        }

        /* Mobile carousel nav */
        .mobile-carousel-nav {
            display: flex;
            justify-content: center;
            gap: 12px;
            margin-top: 20px;
        }

        @media (min-width: 768px) {
            .mobile-carousel-nav {
                display: none;
            }
        }

        /*  TESTIMONIALS  */
        #testimonials {
            padding: 90px 1rem;
            background: var(--gray-50);
        }

        .testimonials-grid {
            display: grid;
            grid-template-columns: 1fr;
            gap: 20px;
            max-width: 1000px;
            margin: 50px auto 0;
        }

        @media (min-width: 768px) {
            .testimonials-grid {
                grid-template-columns: repeat(2, 1fr);
            }
        }

        .testimonial-card {
            background: #fff;
            border: 1px solid var(--gray-100);
            border-radius: 16px;
            padding: 28px;
            box-shadow: 0 2px 12px rgba(0, 0, 0, 0.05);
            transition: box-shadow 0.3s, transform 0.3s;
        }

        .testimonial-card:hover {
            box-shadow: 0 10px 32px rgba(0, 0, 0, 0.1);
            transform: translateY(-3px);
        }

        .quote-icon {
            width: 36px;
            height: 36px;
            background: var(--blue-50);
            border-radius: 8px;
            display: flex;
            align-items: center;
            justify-content: center;
            margin-bottom: 18px;
        }

        .testimonial-text {
            font-size: 0.97rem;
            color: var(--gray-700);
            line-height: 1.75;
            margin-bottom: 22px;
        }

        .testimonial-footer {
            display: flex;
            align-items: center;
            justify-content: space-between;
            flex-wrap: wrap;
            gap: 12px;
        }

        .testimonial-author {
            display: flex;
            align-items: center;
            gap: 12px;
        }

        .testimonial-avatar {
            width: 46px;
            height: 46px;
            border-radius: 50%;
            object-fit: cover;
            border: 2px solid var(--blue-100);
        }

        .testimonial-name {
            font-weight: 700;
            font-size: 15px;
            color: var(--gray-900);
        }

        .testimonial-role {
            font-size: 13px;
            color: var(--blue-600);
            font-weight: 500;
        }

        .star-row {
            display: flex;
            gap: 2px;
        }

        .star-row svg {
            color: #EAB308;
        }

        /*  CTA  */
        #cta-section {
            padding: 90px 1rem;
            background: linear-gradient(135deg, var(--blue-800) 0%, var(--blue-900) 60%, #0F172A 100%);
            position: relative;
            overflow: hidden;
        }

        #cta-section::before {
            content: '';
            position: absolute;
            top: -80px;
            right: -80px;
            width: 320px;
            height: 320px;
            border-radius: 50%;
            background: rgba(59, 130, 246, 0.15);
        }

        #cta-section::after {
            content: '';
            position: absolute;
            bottom: -60px;
            left: -60px;
            width: 240px;
            height: 240px;
            border-radius: 50%;
            background: rgba(29, 78, 216, 0.2);
        }

        #cta-section .container {
            position: relative;
            z-index: 2;
        }

        #cta-section h2 {
            font-size: clamp(1.75rem, 4vw, 2.75rem);
            font-weight: 800;
            color: #fff;
            margin-bottom: 14px;
            letter-spacing: -0.02em;
        }

        #cta-section p {
            font-size: 1.1rem;
            color: rgba(191, 219, 254, 0.85);
            max-width: 500px;
            margin: 0 auto 40px;
            line-height: 1.7;
        }

        .cta-btns {
            display: flex;
            flex-direction: column;
            gap: 14px;
            align-items: center;
        }

        @media (min-width: 480px) {
            .cta-btns {
                flex-direction: row;
                justify-content: center;
            }
        }

        .cta-btn-primary {
            background: #fff;
            color: var(--blue-700);
            padding: 14px 32px;
            border-radius: 12px;
            font-family: 'Sora', sans-serif;
            font-size: 15px;
            font-weight: 700;
            text-decoration: none;
            transition: all 0.2s;
            box-shadow: 0 4px 20px rgba(0, 0, 0, 0.25);
        }

        .cta-btn-primary:hover {
            background: var(--blue-50);
            transform: translateY(-2px);
            box-shadow: 0 8px 28px rgba(0, 0, 0, 0.3);
        }

        .cta-btn-secondary {
            background: transparent;
            color: #fff;
            padding: 13px 32px;
            border-radius: 12px;
            font-family: 'Sora', sans-serif;
            font-size: 15px;
            font-weight: 700;
            text-decoration: none;
            border: 2px solid rgba(255, 255, 255, 0.4);
            transition: all 0.2s;
        }

        .cta-btn-secondary:hover {
            background: rgba(255, 255, 255, 0.12);
            border-color: rgba(255, 255, 255, 0.7);
            transform: translateY(-2px);
        }

        /*  FLASH MESSAGE  */
        .flash-message {
            position: fixed;
            top: 80px;
            left: 50%;
            transform: translateX(-50%);
            background: #FEF3C7;
            color: #92400E;
            border: 1px solid #FDE68A;
            padding: 12px 24px;
            border-radius: 10px;
            font-size: 14px;
            font-weight: 500;
            z-index: 9999;
            box-shadow: 0 4px 16px rgba(0, 0, 0, 0.1);
            white-space: nowrap;
            max-width: calc(100vw - 32px);
            text-align: center;
        }

        /*  CONTAINER  */
        .container {
            width: 100%;
            max-width: 1200px;
            margin: 0 auto;
        }

        /*  VIEW ALL  */
        .view-all-wrap {
            text-align: center;
            margin-top: 40px;
        }

        .view-all-btn {
            display: inline-flex;
            align-items: center;
            gap: 8px;
            padding: 13px 32px;
            background: var(--blue-600);
            color: #fff;
            border-radius: 12px;
            font-family: 'Sora', sans-serif;
            font-size: 15px;
            font-weight: 700;
            text-decoration: none;
            transition: all 0.2s;
            box-shadow: 0 4px 16px rgba(37, 99, 235, 0.3);
        }

        .view-all-btn:hover {
            background: var(--blue-700);
            transform: translateY(-2px);
            box-shadow: 0 8px 24px rgba(37, 99, 235, 0.4);
        }
    </style>
@endsection

@section('content')
    @if (session('message'))
        <div class="flash-message" role="alert">{{ session('message') }}</div>
    @endif

    {{-- HERO --}}
    <div id="hero">
        <div class="hero-content">
            <div class="hero-badge">Professional Spaces Available Now</div>

            <h1>
                Find the Perfect<br>
                <span class="accent">Meeting Room</span>
            </h1>

            <p>Book professional meeting rooms from local businesses and individuals at competitive rates.</p>

            {{-- Search Form --}}
            <form class="search-form" action="{{ route('explore') }}" method="get">

                <div class="search-field">
                    <label for="location">Location</label>
                    <select id="location" name="location">
                        <option value="amman" {{ request('location') == 'amman' ? 'selected' : '' }}>Amman</option>
                        <option value="irbid" {{ request('location') == 'irbid' ? 'selected' : '' }}>Irbid</option>
                    </select>
                </div>

                <div class="search-field">
                    <label for="date">Date</label>
                    <input type="date" id="date" name="date" value="{{ request('date', now()->format('Y-m-d')) }}">
                </div>

                <div class="search-field">
                    <label for="start_time">Check-in</label>
                    <input id="start_time" type="time" name="start_time" value="{{ request('start_time', '09:00') }}">
                </div>

                <div class="search-field">
                    <label for="capacity">Capacity</label>
                    <select id="capacity" name="capacity">
                        <option value="">Any size</option>
                        @foreach ([4, 8, 12, 20, 50] as $size)
                            <option value="{{ $size }}" {{ request('capacity') == $size ? 'selected' : '' }}>{{ $size }}+ people
                            </option>
                        @endforeach
                    </select>
                </div>

                <button type="submit" class="search-btn">
                    <svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" fill="none" viewBox="0 0 24 24"
                        stroke="currentColor" stroke-width="2.5">
                        <path stroke-linecap="round" stroke-linejoin="round"
                            d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z" />
                    </svg>
                    <span>Search</span>
                </button>
            </form>
        </div>
    </div>

    {{-- HOW IT WORKS --}}
    <section id="how-it-works">
        <div class="container">
            <div style="text-align: center;">
                <span class="section-eyebrow">Simple Process</span>
                <h2 class="section-title">How it <span style="color: var(--blue-600);">works</span></h2>
                <p class="section-subtitle">Get started in minutes — no complicated setup required.</p>
            </div>

            @php
                $steps = [
                    ['number' => 1, 'title' => 'Create your account', 'description' => 'Sign up in seconds and configure your workspace details to get personalized results.'],
                    ['number' => 2, 'title' => 'Choose your room', 'description' => 'Browse and filter rooms by location, capacity, amenities, and availability.'],
                    ['number' => 3, 'title' => 'Start booking', 'description' => 'Pick a date and time, confirm in one click, and get instant access details.'],
                ];
            @endphp

            <div class="steps-grid">
                @foreach ($steps as $step)
                    <div class="step-card">
                        <div class="step-icon-wrap">
                            <span class="step-number">{{ $step['number'] }}</span>
                        </div>
                        <h3>{{ $step['title'] }}</h3>
                        <p>{{ $step['description'] }}</p>
                        @if ($step['number'] === 1)
                            <a href="{{ route('register') }}" class="step-cta">Get Started &rarr;</a>
                        @endif
                    </div>
                @endforeach
            </div>
        </div>
    </section>

    {{-- LATEST ROOMS --}}
    <section id="features">
        <div class="container">
            <div class="rooms-header">
                <div>
                    <span class="section-eyebrow">Curated Spaces</span>
                    <h2 class="section-title" style="margin-bottom: 6px;">Latest Meeting Spaces</h2>
                    <p style="color: var(--gray-600); font-size: 1rem;">Discover rooms from our newest hosts</p>
                </div>
                <div class="carousel-controls">
                    <button id="prev-spaces" class="ctrl-btn" aria-label="Previous">
                        <svg width="18" height="18" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M15 19l-7-7 7-7" />
                        </svg>
                    </button>
                    <button id="next-spaces" class="ctrl-btn" aria-label="Next">
                        <svg width="18" height="18" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M9 5l7 7-7 7" />
                        </svg>
                    </button>
                </div>
            </div>

            <div class="carousel-outer">
                <div id="spaces-carousel">
                    @foreach ($meetingRooms as $index => $room)
                        <div class="carousel-card">
                            <div class="room-card">
                                <div class="room-img-wrap">
                                    @if ($room->created_at->diffInDays() <= 7)
                                        <span class="room-badge-new">New</span>
                                    @endif
                                    @if (!$room->images->isEmpty())
                                        <img src="{{ asset('storage/' . $room->images->first()->image_url) }}"
                                            alt="{{ $room->title }}" loading="lazy">
                                    @else
                                        <img src="https://www.svgrepo.com/show/508699/landscape-placeholder.svg"
                                            alt="{{ $room->title }}" loading="lazy">
                                    @endif
                                    <div class="room-overlay">
                                        <a href="{{ route('rooms.details', $room->slug) }}">View Details</a>
                                    </div>
                                </div>
                                <div class="room-info">
                                    <div class="room-title-row">
                                        <div class="room-title">{{ $room->title }}</div>
                                        <div class="room-rating">
                                            <svg width="13" height="13" viewBox="0 0 20 20" fill="currentColor">
                                                <path
                                                    d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z" />
                                            </svg>
                                            <span>0.0</span>
                                        </div>
                                    </div>
                                    <div class="room-meta">
                                        <svg width="14" height="14" viewBox="0 0 20 20" fill="currentColor">
                                            <path fill-rule="evenodd"
                                                d="M5.05 4.05a7 7 0 119.9 9.9L10 18.9l-4.95-4.95a7 7 0 010-9.9zM10 11a2 2 0 100-4 2 2 0 000 4z"
                                                clip-rule="evenodd" />
                                        </svg>
                                        {{ $room->city }}
                                        <span class="dot">•</span>
                                        <svg width="14" height="14" viewBox="0 0 20 20" fill="currentColor">
                                            <path fill-rule="evenodd" d="M10 9a3 3 0 100-6 3 3 0 000 6zm-7 9a7 7 0 1114 0H3z"
                                                clip-rule="evenodd" />
                                        </svg>
                                        Up to {{ $room->capacity }} people
                                    </div>
                                    @if (!$room->amenities->isEmpty())
                                        <div class="amenity-tags">
                                            @foreach ($room->amenities->take(4) as $amenity)
                                                <span class="amenity-tag">{{ $amenity->name }}</span>
                                            @endforeach
                                            @if ($room->amenities->count() > 4)
                                                <span class="amenity-tag">+{{ $room->amenities->count() - 4 }} more</span>
                                            @endif
                                        </div>
                                    @endif
                                    <div class="room-footer">
                                        <div class="room-price">${{ $room->hourly_rate }}<span>/hr</span></div>
                                        <a href="/rooms/details/{{ $room->slug }}#availability" class="room-avail-link">Check
                                            Availability</a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>

            {{-- Mobile dots --}}
            <div class="carousel-dots" id="carousel-dots">
                @foreach ($meetingRooms as $index => $room)
                    <button class="carousel-dot {{ $index === 0 ? 'active' : '' }}" data-index="{{ $index }}"></button>
                @endforeach
            </div>

            {{-- Mobile nav --}}
            <div class="mobile-carousel-nav">
                <button id="prev-spaces-mobile" class="ctrl-btn" aria-label="Previous">
                    <svg width="18" height="18" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M15 19l-7-7 7-7" />
                    </svg>
                </button>
                <button id="next-spaces-mobile" class="ctrl-btn" aria-label="Next">
                    <svg width="18" height="18" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M9 5l7 7-7 7" />
                    </svg>
                </button>
            </div>

            <div class="view-all-wrap">
                <a href="{{ route('explore') }}" class="view-all-btn">
                    View All Meeting Spaces
                    <svg width="16" height="16" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2.5">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M17 8l4 4m0 0l-4 4m4-4H3" />
                    </svg>
                </a>
            </div>
        </div>
    </section>

    {{-- TESTIMONIALS --}}
    <section id="testimonials">
        <div class="container">
            <div style="text-align: center;">
                <span class="section-eyebrow">Trusted by Many</span>
                <h2 class="section-title">What our users say</h2>
                <div
                    style="width: 48px; height: 4px; background: var(--blue-600); border-radius: 4px; margin: 14px auto 16px;">
                </div>
                <p class="section-subtitle">See what our growing community says about their experience with SpaceMeet.</p>
            </div>

            @php
                $testimonials = [
                    ['name' => 'Hanif Kazemi', 'position' => 'Office Manager', 'image' => 'images/profile-pictures/1.jpg', 'quote' => "We've been renting out our extra conference room through SpaceMeet, and it's generated over \$2,000 in additional revenue each month. The process is hassle-free and the support team is fantastic!", 'rating' => 5],
                    ['name' => 'Abdullahi Hatem', 'position' => 'Marketing Director', 'image' => 'images/profile-pictures/2.jpg', 'quote' => 'SpaceMeet saved us when we needed a last-minute meeting space for an important client presentation — we got the perfect space with the perfect host.', 'rating' => 5],
                    ['name' => 'Mashal Hosein', 'position' => 'Freelance Consultant', 'image' => 'images/profile-pictures/3.jpg', 'quote' => 'I needed a quiet, well-equipped meeting room for a client presentation, and I found the perfect one in just a few clicks.', 'rating' => 5],
                    ['name' => 'Rahim Emami', 'position' => 'Startup Founder', 'image' => 'images/profile-pictures/4.jpg', 'quote' => "As a small business, we can't afford permanent office space yet. SpaceMeet lets us book professional meeting rooms only when we need them — saving us thousands in overhead.", 'rating' => 5],
                ];
            @endphp

            <div class="testimonials-grid">
                @foreach ($testimonials as $t)
                    <div class="testimonial-card">
                        <div class="quote-icon">
                            <svg width="18" height="18" viewBox="0 0 24 24" fill="var(--blue-600)">
                                <path
                                    d="M14.017 21v-7.391c0-5.704 3.731-9.57 8.983-10.609l.995 2.151c-2.432.917-3.995 3.638-3.995 5.849h4v10h-9.983zm-14.017 0v-7.391c0-5.704 3.748-9.57 9-10.609l.996 2.151c-2.433.917-3.996 3.638-3.996 5.849h3.983v10h-9.983z" />
                            </svg>
                        </div>
                        <p class="testimonial-text">"{{ $t['quote'] }}"</p>
                        <div class="testimonial-footer">
                            <div class="testimonial-author">
                                <img src="{{ asset($t['image']) }}" alt="{{ $t['name'] }}" class="testimonial-avatar">
                                <div>
                                    <div class="testimonial-name">{{ $t['name'] }}</div>
                                    <div class="testimonial-role">{{ $t['position'] }}</div>
                                </div>
                            </div>
                            <div class="star-row">
                                @for ($i = 1; $i <= 5; $i++)
                                    <svg width="15" height="15" viewBox="0 0 20 20"
                                        fill="{{ $i <= $t['rating'] ? 'currentColor' : '#E5E7EB' }}">
                                        <path
                                            d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z" />
                                    </svg>
                                @endfor
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    </section>

    {{-- CTA --}}
    <section id="cta-section">
        <div class="container" style="text-align: center;">
            <h2>Ready to find your space?</h2>
            <p>Discover the perfect meeting room for your next event, presentation, or team gathering.</p>
            <div class="cta-btns">
                <a href="/explore" class="cta-btn-primary">Find a Space</a>
                <a href="{{ route('room.create') }}" class="cta-btn-secondary">List Your Space</a>
            </div>
        </div>
    </section>
@endsection

@section('scripts')
    <script>
        // Date default
        const dateInput = document.querySelector('input[type="date"]');
        if (dateInput && !dateInput.value) {
            const d = new Date();
            dateInput.value = `${d.getFullYear()}-${String(d.getMonth() + 1).padStart(2, '0')}-${String(d.getDate()).padStart(2, '0')}`;
        }

        // Flash auto-dismiss
        const flash = document.querySelector('.flash-message');
        if (flash) setTimeout(() => flash.remove(), 4000);

        // Carousel
        document.addEventListener('DOMContentLoaded', function () {
            const carousel = document.getElementById('spaces-carousel');
            const cards = Array.from(carousel.querySelectorAll('.carousel-card'));
            const dotsWrap = document.getElementById('carousel-dots');
            const dots = dotsWrap ? Array.from(dotsWrap.querySelectorAll('.carousel-dot')) : [];

            let currentIndex = 0;
            const total = cards.length;

            function visibleCount() {
                if (window.innerWidth >= 1024) return 3;
                if (window.innerWidth >= 768) return 2;
                return 1;
            }

            function maxIndex() {
                return Math.max(0, total - visibleCount());
            }

            function updateCarousel() {
                const vis = visibleCount();
                currentIndex = Math.max(0, Math.min(currentIndex, maxIndex()));
                const cardWidth = cards[0] ? cards[0].offsetWidth : 0;
                carousel.style.transform = `translateX(-${currentIndex * cardWidth}px)`;
                // Update dots (mobile only shows 1 card)
                dots.forEach((dot, i) => {
                    dot.classList.toggle('active', i === currentIndex);
                });
            }

            function goNext() {
                if (currentIndex < maxIndex()) { currentIndex++; updateCarousel(); }
            }

            function goPrev() {
                if (currentIndex > 0) { currentIndex--; updateCarousel(); }
            }

            ['prev-spaces', 'prev-spaces-mobile'].forEach(id => {
                const el = document.getElementById(id);
                if (el) el.addEventListener('click', goPrev);
            });

            ['next-spaces', 'next-spaces-mobile'].forEach(id => {
                const el = document.getElementById(id);
                if (el) el.addEventListener('click', goNext);
            });

            dots.forEach(dot => {
                dot.addEventListener('click', () => {
                    currentIndex = parseInt(dot.dataset.index);
                    updateCarousel();
                });
            });

            // Touch swipe support
            let touchStartX = 0;
            carousel.addEventListener('touchstart', e => { touchStartX = e.touches[0].clientX; }, { passive: true });
            carousel.addEventListener('touchend', e => {
                const diff = touchStartX - e.changedTouches[0].clientX;
                if (Math.abs(diff) > 50) diff > 0 ? goNext() : goPrev();
            }, { passive: true });

            window.addEventListener('resize', updateCarousel);
            updateCarousel();
        });
    </script>
@endsection