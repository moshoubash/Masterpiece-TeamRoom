{{-- resources/views/pages/explore.blade.php --}}
@extends('layouts.home.layout')

@section('styles')
    <style>
        @import url('https://fonts.googleapis.com/css2?family=Sora:wght@400;500;600;700;800&family=DM+Sans:ital,opsz,wght@0,9..40,400;0,9..40,500;1,9..40,400&display=swap');

        :root {
            --blue-50:  #EFF6FF;
            --blue-100: #DBEAFE;
            --blue-200: #BFDBFE;
            --blue-500: #3B82F6;
            --blue-600: #2563EB;
            --blue-700: #1D4ED8;
            --blue-800: #1E40AF;
            --gray-50:  #F9FAFB;
            --gray-100: #F3F4F6;
            --gray-200: #E5E7EB;
            --gray-300: #D1D5DB;
            --gray-400: #9CA3AF;
            --gray-500: #6B7280;
            --gray-600: #4B5563;
            --gray-700: #374151;
            --gray-800: #1F2937;
            --gray-900: #111827;
            --green-100:#DCFCE7;
            --green-800:#166534;
            --green-500:#22C55E;
            --red-100:  #FEE2E2;
            --red-800:  #991B1B;
            --red-500:  #EF4444;
            --shadow-sm: 0 1px 3px rgba(0,0,0,0.06), 0 1px 2px rgba(0,0,0,0.04);
            --shadow-md: 0 4px 16px rgba(0,0,0,0.08);
            --shadow-lg: 0 10px 32px rgba(0,0,0,0.1);
        }

        *, *::before, *::after { box-sizing: border-box; }

        body { font-family: 'DM Sans', sans-serif; color: var(--gray-800); }
        h1,h2,h3,h4 { font-family: 'Sora', sans-serif; }

        /* ── Page wrapper ── */
        .explore-page {
            background: var(--gray-50);
            min-height: 100vh;
            padding: 32px 0 64px;
        }

        .container {
            max-width: 1280px;
            margin: 0 auto;
            padding: 0 20px;
        }

        /* ── Page header ── */
        .page-header {
            display: flex;
            flex-direction: column;
            gap: 16px;
            margin-bottom: 28px;
        }

        @media (min-width: 768px) {
            .page-header {
                flex-direction: row;
                justify-content: space-between;
                align-items: center;
                gap: 24px;
            }
        }

        .breadcrumbs {
            display: flex;
            align-items: center;
            gap: 6px;
            font-size: 13px;
            color: var(--gray-500);
            margin-bottom: 6px;
        }

        .breadcrumbs a {
            color: var(--gray-500);
            text-decoration: none;
            transition: color 0.15s;
        }

        .breadcrumbs a:hover { color: var(--blue-600); }

        .breadcrumbs svg { color: var(--gray-300); }

        .page-title {
            font-size: clamp(1.5rem, 3vw, 2rem);
            font-weight: 800;
            color: var(--gray-900);
            letter-spacing: -0.02em;
            line-height: 1.2;
            margin: 0;
        }

        /* ── Search Bar ── */
        .search-wrap {
            width: 100%;
        }

        @media (min-width: 768px) {
            .search-wrap { width: 380px; flex-shrink: 0; }
        }

        .search-inner {
            position: relative;
            display: flex;
            align-items: center;
        }

        .search-icon {
            position: absolute;
            left: 14px;
            color: var(--gray-400);
            pointer-events: none;
            flex-shrink: 0;
        }

        .search-input {
            width: 100%;
            padding: 11px 80px 11px 42px;
            border: 1.5px solid var(--gray-200);
            border-radius: 12px;
            font-family: 'DM Sans', sans-serif;
            font-size: 14px;
            color: var(--gray-800);
            background: #fff;
            box-shadow: var(--shadow-sm);
            transition: border-color 0.2s, box-shadow 0.2s;
            outline: none;
        }

        .search-input:focus {
            border-color: var(--blue-500);
            box-shadow: 0 0 0 3px rgba(59,130,246,0.12);
        }

        .search-submit {
            position: absolute;
            right: 6px;
            background: var(--blue-600);
            color: #fff;
            border: none;
            border-radius: 8px;
            padding: 6px 14px;
            font-family: 'Sora', sans-serif;
            font-size: 13px;
            font-weight: 600;
            cursor: pointer;
            transition: background 0.2s;
        }

        .search-submit:hover { background: var(--blue-700); }

        /* ── Layout ── */
        .explore-body {
            display: flex;
            flex-direction: column;
            gap: 24px;
            align-items: flex-start;
        }

        @media (min-width: 1024px) {
            .explore-body {
                flex-direction: row;
                gap: 28px;
            }
        }

        /* ── Mobile filter toggle ── */
        .mobile-filter-btn {
            display: flex;
            width: 100%;
            align-items: center;
            justify-content: center;
            gap: 8px;
            padding: 12px 20px;
            background: #fff;
            border: 1.5px solid var(--gray-200);
            border-radius: 12px;
            font-family: 'Sora', sans-serif;
            font-size: 14px;
            font-weight: 600;
            color: var(--gray-700);
            cursor: pointer;
            box-shadow: var(--shadow-sm);
            transition: all 0.2s;
        }

        .mobile-filter-btn:hover {
            border-color: var(--blue-400);
            color: var(--blue-600);
            background: var(--blue-50);
        }

        .mobile-filter-btn .badge {
            background: var(--blue-600);
            color: #fff;
            font-size: 11px;
            font-weight: 700;
            padding: 1px 7px;
            border-radius: 100px;
            margin-left: 4px;
        }

        @media (min-width: 1024px) {
            .mobile-filter-btn { display: none; }
        }

        /* ── Sidebar ── */
        .sidebar {
            width: 100%;
            display: none;
        }

        .sidebar.open { display: block; }

        @media (min-width: 1024px) {
            .sidebar {
                display: block !important;
                width: 280px;
                flex-shrink: 0;
                position: sticky;
                top: 24px;
            }
        }

        .filter-card {
            background: #fff;
            border: 1px solid var(--gray-200);
            border-radius: 16px;
            padding: 24px;
            box-shadow: var(--shadow-sm);
        }

        .filter-header {
            display: flex;
            align-items: center;
            justify-content: space-between;
            margin-bottom: 24px;
        }

        .filter-title {
            font-size: 15px;
            font-weight: 700;
            color: var(--gray-900);
            display: flex;
            align-items: center;
            gap: 8px;
        }

        .filter-title svg { color: var(--blue-600); }

        .clear-link {
            font-size: 12px;
            color: var(--gray-400);
            text-decoration: none;
            font-weight: 500;
            transition: color 0.15s;
        }

        .clear-link:hover { color: var(--blue-600); }

        /* Filter section */
        .filter-section {
            margin-bottom: 20px;
            padding-bottom: 20px;
            border-bottom: 1px solid var(--gray-100);
        }

        .filter-section:last-of-type {
            border-bottom: none;
            margin-bottom: 0;
            padding-bottom: 0;
        }

        .filter-label {
            display: block;
            font-size: 11px;
            font-weight: 700;
            text-transform: uppercase;
            letter-spacing: 0.08em;
            color: var(--gray-500);
            margin-bottom: 10px;
        }

        /* Select */
        .filter-select-wrap {
            position: relative;
        }

        .filter-select {
            width: 100%;
            padding: 9px 34px 9px 12px;
            font-family: 'DM Sans', sans-serif;
            font-size: 14px;
            color: var(--gray-700);
            border: 1.5px solid var(--gray-200);
            border-radius: 10px;
            background: #fff;
            appearance: none;
            cursor: pointer;
            outline: none;
            transition: border-color 0.2s;
        }

        .filter-select:focus { border-color: var(--blue-500); }

        .select-arrow {
            position: absolute;
            right: 10px;
            top: 50%;
            transform: translateY(-50%);
            pointer-events: none;
            color: var(--gray-400);
        }

        /* Date / Time inputs */
        .filter-input {
            width: 100%;
            padding: 9px 12px;
            font-family: 'DM Sans', sans-serif;
            font-size: 14px;
            color: var(--gray-700);
            border: 1.5px solid var(--gray-200);
            border-radius: 10px;
            background: #fff;
            outline: none;
            transition: border-color 0.2s;
        }

        .filter-input:focus { border-color: var(--blue-500); }

        /* Time row */
        .time-row {
            display: grid;
            grid-template-columns: 1fr 1fr;
            gap: 8px;
        }

        .time-field label {
            display: block;
            font-size: 11px;
            color: var(--gray-400);
            font-weight: 500;
            margin-bottom: 4px;
        }

        /* Price row */
        .price-row {
            display: grid;
            grid-template-columns: 1fr 1fr;
            gap: 8px;
        }

        /* Amenity checkboxes */
        .amenity-list { display: flex; flex-direction: column; gap: 6px; }

        .amenity-item {
            display: flex;
            align-items: center;
            gap: 10px;
            padding: 8px 10px;
            border: 1.5px solid var(--gray-100);
            border-radius: 8px;
            cursor: pointer;
            transition: all 0.15s;
        }

        .amenity-item:hover {
            border-color: var(--blue-200);
            background: var(--blue-50);
        }

        .amenity-item input[type="checkbox"] {
            width: 16px;
            height: 16px;
            accent-color: var(--blue-600);
            cursor: pointer;
            flex-shrink: 0;
        }

        .amenity-item label {
            font-size: 13px;
            color: var(--gray-700);
            cursor: pointer;
            line-height: 1.3;
        }

        /* Filter actions */
        .filter-actions { margin-top: 20px; display: flex; flex-direction: column; gap: 8px; }

        .btn-apply {
            width: 100%;
            padding: 11px;
            background: var(--blue-600);
            color: #fff;
            border: none;
            border-radius: 10px;
            font-family: 'Sora', sans-serif;
            font-size: 14px;
            font-weight: 700;
            cursor: pointer;
            transition: background 0.2s, transform 0.15s;
        }

        .btn-apply:hover { background: var(--blue-700); transform: translateY(-1px); }

        .btn-clear {
            width: 100%;
            padding: 10px;
            background: transparent;
            color: var(--gray-500);
            border: 1.5px solid var(--gray-200);
            border-radius: 10px;
            font-family: 'DM Sans', sans-serif;
            font-size: 14px;
            font-weight: 500;
            cursor: pointer;
            text-decoration: none;
            text-align: center;
            display: block;
            transition: all 0.2s;
        }

        .btn-clear:hover { border-color: var(--gray-300); color: var(--gray-700); background: var(--gray-50); }

        /* ── Results ── */
        .results-col { flex: 1; min-width: 0; }

        .results-meta {
            display: flex;
            align-items: center;
            justify-content: space-between;
            margin-bottom: 16px;
            flex-wrap: wrap;
            gap: 10px;
        }

        .results-count {
            font-size: 14px;
            color: var(--gray-500);
        }

        .results-count strong { color: var(--gray-800); font-weight: 600; }

        /* ── Room card (horizontal) ── */
        .room-list { display: flex; flex-direction: column; gap: 16px; }

        .room-card {
            background: #fff;
            border: 1px solid var(--gray-200);
            border-radius: 16px;
            overflow: hidden;
            display: flex;
            flex-direction: column;
            box-shadow: var(--shadow-sm);
            transition: box-shadow 0.25s, transform 0.25s;
        }

        .room-card:hover {
            box-shadow: 0 8px 28px rgba(37,99,235,0.12);
            transform: translateY(-2px);
        }

        @media (min-width: 600px) {
            .room-card { flex-direction: row; }
        }

        /* Image */
        .room-img-col {
            position: relative;
            width: 100%;
            height: 200px;
            flex-shrink: 0;
            overflow: hidden;
        }

        @media (min-width: 600px) {
            .room-img-col {
                width: 220px;
                height: auto;
                min-height: 180px;
            }
        }

        @media (min-width: 768px) {
            .room-img-col { width: 260px; }
        }

        .room-img-col img {
            width: 100%;
            height: 100%;
            object-fit: cover;
            transition: transform 0.4s;
        }

        .room-card:hover .room-img-col img { transform: scale(1.04); }

        .status-badge {
            position: absolute;
            top: 12px;
            left: 12px;
            display: inline-flex;
            align-items: center;
            gap: 5px;
            padding: 4px 10px;
            border-radius: 100px;
            font-size: 11px;
            font-weight: 700;
            letter-spacing: 0.03em;
        }

        .status-badge.available {
            background: var(--green-100);
            color: var(--green-800);
        }

        .status-badge.booked {
            background: var(--red-100);
            color: var(--red-800);
        }

        .status-dot {
            width: 6px;
            height: 6px;
            border-radius: 50%;
            flex-shrink: 0;
        }

        .status-badge.available .status-dot { background: var(--green-500); }
        .status-badge.booked .status-dot { background: var(--red-500); }

        /* Details */
        .room-details-col {
            display: flex;
            flex-direction: column;
            flex: 1;
            min-width: 0;
        }

        .room-body {
            padding: 18px 20px;
            flex: 1;
        }

        .room-top-row {
            display: flex;
            justify-content: space-between;
            align-items: flex-start;
            gap: 12px;
            margin-bottom: 10px;
        }

        .room-name {
            font-size: 1.05rem;
            font-weight: 700;
            color: var(--gray-900);
            line-height: 1.35;
            transition: color 0.2s;
            margin: 0;
        }

        .room-card:hover .room-name { color: var(--blue-600); }

        .room-price-badge {
            flex-shrink: 0;
            text-align: right;
        }

        .room-price {
            font-family: 'Sora', sans-serif;
            font-size: 1.2rem;
            font-weight: 800;
            color: var(--gray-900);
            line-height: 1;
        }

        .room-price-unit {
            font-size: 12px;
            color: var(--gray-400);
            font-weight: 400;
        }

        .room-meta-row {
            display: flex;
            flex-wrap: wrap;
            gap: 14px;
            margin-bottom: 12px;
        }

        .meta-item {
            display: flex;
            align-items: center;
            gap: 5px;
            font-size: 13px;
            color: var(--gray-600);
        }

        .meta-item svg { color: var(--gray-400); flex-shrink: 0; }

        .amenity-chips {
            display: flex;
            flex-wrap: wrap;
            gap: 6px;
            margin-top: 6px;
        }

        .amenity-chip {
            display: inline-flex;
            align-items: center;
            gap: 4px;
            background: var(--gray-100);
            color: var(--gray-700);
            font-size: 12px;
            font-weight: 500;
            padding: 3px 10px;
            border-radius: 100px;
        }

        .room-footer {
            padding: 14px 20px;
            border-top: 1px solid var(--gray-100);
            background: var(--gray-50);
            display: flex;
            align-items: center;
            justify-content: flex-end;
        }

        .btn-details {
            display: inline-flex;
            align-items: center;
            gap: 6px;
            padding: 9px 20px;
            background: var(--blue-600);
            color: #fff;
            border-radius: 10px;
            font-family: 'Sora', sans-serif;
            font-size: 13px;
            font-weight: 700;
            text-decoration: none;
            transition: background 0.2s, transform 0.15s;
        }

        .btn-details:hover {
            background: var(--blue-700);
            transform: translateY(-1px);
        }

        /* ── Empty state ── */
        .empty-state {
            background: #fff;
            border: 1px solid var(--gray-200);
            border-radius: 16px;
            padding: 64px 24px;
            text-align: center;
            box-shadow: var(--shadow-sm);
        }

        .empty-icon {
            width: 64px;
            height: 64px;
            background: var(--gray-100);
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            margin: 0 auto 20px;
        }

        .empty-icon svg { color: var(--gray-400); }

        .empty-state h3 {
            font-size: 1.15rem;
            font-weight: 700;
            color: var(--gray-800);
            margin-bottom: 8px;
        }

        .empty-state p {
            font-size: 14px;
            color: var(--gray-500);
            line-height: 1.6;
            max-width: 360px;
            margin: 0 auto;
        }

        /* ── Pagination ── */
        .pagination-wrap {
            margin-top: 28px;
        }

        /* Loading overlay */
        #results-container {
            transition: opacity 0.25s ease;
        }

        #results-container.loading {
            opacity: 0.5;
            pointer-events: none;
        }
    </style>
@endsection

@section('content')
    <div class="explore-page">
        <div class="container">

            {{-- Page header --}}
            <div class="page-header">
                <div>
                    <div class="breadcrumbs">
                        <a href="/">Home</a>
                        <svg width="14" height="14" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2"><path stroke-linecap="round" stroke-linejoin="round" d="M9 5l7 7-7 7"/></svg>
                        <span>Explore</span>
                    </div>
                    <h1 class="page-title">Discover Spaces</h1>
                </div>

                {{-- Search --}}
                <div class="search-wrap">
                    <form action="{{ route('explore') }}" method="GET" id="search-form">
                        <div class="search-inner">
                            <svg class="search-icon" width="17" height="17" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"/>
                            </svg>
                            <input type="text" id="search-input" name="search" value="{{ request('search') }}"
                                placeholder="Search rooms..." class="search-input">
                            <button type="submit" class="search-submit">Search</button>
                        </div>
                    </form>
                </div>
            </div>

            <div class="explore-body">

                {{-- Mobile filter toggle --}}
                <button class="mobile-filter-btn" id="filter-toggle">
                    <svg width="17" height="17" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M3 4a1 1 0 011-1h16a1 1 0 011 1v2.586a1 1 0 01-.293.707l-6.414 6.414a1 1 0 00-.293.707V17l-4 4v-6.586a1 1 0 00-.293-.707L3.293 7.293A1 1 0 013 6.586V4z"/>
                    </svg>
                    <span id="filter-btn-text">Filters</span>
                    @php $activeFilters = collect(['capacity', 'date', 'start_time', 'end_time', 'location', 'min_price', 'max_price', 'amenities'])->filter(fn($k) => request($k))->count(); @endphp
                    @if($activeFilters > 0)
                        <span class="badge">{{ $activeFilters }}</span>
                    @endif
                </button>

                {{-- Sidebar --}}
                <aside class="sidebar" id="filters-container">
                    <div class="filter-card">
                        <div class="filter-header">
                            <div class="filter-title">
                                <svg width="16" height="16" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M3 4a1 1 0 011-1h16a1 1 0 011 1v2.586a1 1 0 01-.293.707l-6.414 6.414a1 1 0 00-.293.707V17l-4 4v-6.586a1 1 0 00-.293-.707L3.293 7.293A1 1 0 013 6.586V4z"/>
                                </svg>
                                Filters
                            </div>
                            <a href="{{ route('explore') }}" class="clear-link">Clear all</a>
                        </div>

                        <form action="{{ route('explore') }}" method="GET" id="filter-form">
                            @if(request('search'))
                                <input type="hidden" name="search" value="{{ request('search') }}">
                            @endif

                            {{-- Sort --}}
                            <div class="filter-section">
                                <span class="filter-label">Sort By</span>
                                <div class="filter-select-wrap">
                                    <select id="sort" name="sort" class="filter-select">
                                        <option value="">Default</option>
                                        <option value="price_asc"  {{ request('sort') == 'price_asc' ? 'selected' : '' }}>Price: Low → High</option>
                                        <option value="price_desc" {{ request('sort') == 'price_desc' ? 'selected' : '' }}>Price: High → Low</option>
                                    </select>
                                    <svg class="select-arrow" width="14" height="14" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2"><path stroke-linecap="round" stroke-linejoin="round" d="M19 9l-7 7-7-7"/></svg>
                                </div>
                            </div>

                            {{-- Location --}}
                            <div class="filter-section">
                                <span class="filter-label">Location</span>
                                <div class="filter-select-wrap">
                                    <select id="location" name="location" class="filter-select">
                                        <option value="">All Locations</option>
                                        @foreach($cities as $city)
                                            <option value="{{ $city }}" {{ request('location') == $city ? 'selected' : '' }}>{{ $city }}</option>
                                        @endforeach
                                    </select>
                                    <svg class="select-arrow" width="14" height="14" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2"><path stroke-linecap="round" stroke-linejoin="round" d="M19 9l-7 7-7-7"/></svg>
                                </div>
                            </div>

                            {{-- Capacity --}}
                            <div class="filter-section">
                                <span class="filter-label">Capacity</span>
                                <div class="filter-select-wrap">
                                    <select id="capacity" name="capacity" class="filter-select">
                                        <option value="">Any size</option>
                                        @foreach([4, 8, 12, 20, 50] as $size)
                                            <option value="{{ $size }}" {{ request('capacity') == $size ? 'selected' : '' }}>{{ $size }}+ people</option>
                                        @endforeach
                                    </select>
                                    <svg class="select-arrow" width="14" height="14" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2"><path stroke-linecap="round" stroke-linejoin="round" d="M19 9l-7 7-7-7"/></svg>
                                </div>
                            </div>

                            {{-- Date --}}
                            <div class="filter-section">
                                <span class="filter-label">Date</span>
                                <input type="date" id="date" name="date"
                                    min="{{ date('Y-m-d') }}"
                                    value="{{ request('date', date('Y-m-d')) }}"
                                    class="filter-input">
                            </div>

                            {{-- Time range --}}
                            <div class="filter-section">
                                <span class="filter-label">Time Range</span>
                                <div class="time-row">
                                    <div class="time-field">
                                        <label for="start_time">From</label>
                                        <input type="time" id="start_time" name="start_time" value="{{ request('start_time') }}" class="filter-input">
                                    </div>
                                    <div class="time-field">
                                        <label for="end_time">To</label>
                                        <input type="time" id="end_time" name="end_time" value="{{ request('end_time') }}" class="filter-input">
                                    </div>
                                </div>
                            </div>

                            {{-- Price --}}
                            <div class="filter-section">
                                <span class="filter-label">Price ($/hr)</span>
                                <div class="price-row">
                                    <input type="number" name="min_price" placeholder="Min" value="{{ request('min_price') }}" class="filter-input">
                                    <input type="number" name="max_price" placeholder="Max" value="{{ request('max_price') }}" class="filter-input">
                                </div>
                            </div>

                            {{-- Amenities --}}
                            <div class="filter-section">
                                <span class="filter-label">Amenities</span>
                                <div class="amenity-list">
                                    @foreach($amenities as $amenity)
                                        <div class="amenity-item">
                                            <input type="checkbox"
                                                id="amenity_{{ $amenity->id }}"
                                                name="amenities[]"
                                                value="{{ $amenity->id }}"
                                                {{ in_array($amenity->id, request('amenities', [])) ? 'checked' : '' }}>
                                            <label for="amenity_{{ $amenity->id }}">
                                                <i class="{{ $amenity->icon }}"></i> {{ $amenity->name }}
                                            </label>
                                        </div>
                                    @endforeach
                                </div>
                            </div>

                            <div class="filter-actions">
                                <button type="submit" class="btn-apply">Apply Filters</button>
                                <a href="{{ route('explore') }}" class="btn-clear">Clear All</a>
                            </div>
                        </form>
                    </div>
                </aside>

                {{-- Results --}}
                <div class="results-col" id="results-container">
                    @if($rooms->isEmpty())
                        <div class="empty-state">
                            <div class="empty-icon">
                                <svg width="32" height="32" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="1.5">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M9.172 16.172a4 4 0 015.656 0M9 10h.01M15 10h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/>
                                </svg>
                            </div>
                            <h3>No spaces found</h3>
                            <p>We couldn't find any meeting spaces matching your criteria. Try adjusting your filters to see more results.</p>
                        </div>
                    @else
                        <div class="results-meta">
                            <p class="results-count">
                                Showing <strong>{{ $rooms->firstItem() }}–{{ $rooms->lastItem() }}</strong> of <strong>{{ $rooms->total() }}</strong> spaces
                            </p>
                        </div>

                        <div class="room-list">
                            @foreach($rooms as $room)
                                <article class="room-card">

                                    {{-- Image --}}
                                    <div class="room-img-col">
                                        @if($room->images->isEmpty())
                                            <img src="https://www.svgrepo.com/show/508699/landscape-placeholder.svg" alt="{{ $room->title }}">
                                        @else
                                            <img src="{{ asset('storage/' . $room->images->first()->image_url) }}" alt="{{ $room->title }}" loading="lazy">
                                        @endif

                                        @if($room->is_active)
                                            <span class="status-badge available">
                                                <span class="status-dot"></span> Available
                                            </span>
                                        @else
                                            <span class="status-badge booked">
                                                <span class="status-dot"></span> Booked
                                            </span>
                                        @endif
                                    </div>

                                    {{-- Details --}}
                                    <div class="room-details-col">
                                        <div class="room-body">
                                            <div class="room-top-row">
                                                <h3 class="room-name">{{ $room->title }}</h3>
                                                <div class="room-price-badge">
                                                    <div class="room-price">${{ number_format($room->hourly_rate, 2) }}</div>
                                                    <div class="room-price-unit">/hour</div>
                                                </div>
                                            </div>

                                            <div class="room-meta-row">
                                                <div class="meta-item">
                                                    <svg width="14" height="14" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2"><path stroke-linecap="round" stroke-linejoin="round" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z"/><path stroke-linecap="round" stroke-linejoin="round" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z"/></svg>
                                                    {{ $room->city ?? 'Main Building' }}
                                                </div>
                                                <div class="meta-item">
                                                    <svg width="14" height="14" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2"><path stroke-linecap="round" stroke-linejoin="round" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"/></svg>
                                                    {{ $room->host->first_name }} {{ $room->host->last_name }}
                                                </div>
                                                <div class="meta-item">
                                                    <svg width="14" height="14" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2"><path stroke-linecap="round" stroke-linejoin="round" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0z"/></svg>
                                                    {{ $room->capacity }} people
                                                </div>
                                            </div>

                                            @if($room->amenities->isNotEmpty())
                                                <div class="amenity-chips">
                                                    @foreach($room->amenities->take(5) as $amenity)
                                                        <span class="amenity-chip">
                                                            <i class="{{ $amenity->icon }}" style="font-size:11px;"></i>
                                                            {{ $amenity->name }}
                                                        </span>
                                                    @endforeach
                                                    @if($room->amenities->count() > 5)
                                                        <span class="amenity-chip">+{{ $room->amenities->count() - 5 }}</span>
                                                    @endif
                                                </div>
                                            @endif
                                        </div>

                                        <div class="room-footer">
                                            <a href="{{ route('rooms.details', $room->slug) }}" class="btn-details">
                                                View Details
                                                <svg width="13" height="13" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2.5"><path stroke-linecap="round" stroke-linejoin="round" d="M17 8l4 4m0 0l-4 4m4-4H3"/></svg>
                                            </a>
                                        </div>
                                    </div>
                                </article>
                            @endforeach
                        </div>

                        <div class="pagination-wrap">
                            {{ $rooms->links('pagination::tailwind') }}
                        </div>
                    @endif
                </div>
            </div>
        </div>
    </div>
@endsection

@section('scripts')
    <script>
    document.addEventListener('DOMContentLoaded', function () {

        // ── Mobile filter toggle ──
        const filterToggle = document.getElementById('filter-toggle');
        const filtersContainer = document.getElementById('filters-container');
        const filterBtnText = document.getElementById('filter-btn-text');

        filterToggle.addEventListener('click', function () {
            const isOpen = filtersContainer.classList.contains('open');
            filtersContainer.classList.toggle('open', !isOpen);
            filterBtnText.textContent = isOpen ? 'Filters' : 'Hide Filters';
        });

        window.addEventListener('resize', function () {
            if (window.innerWidth >= 1024) {
                filtersContainer.classList.remove('open');
            }
        });

        // ── Auto-submit on select/date change ──
        ['capacity', 'location', 'date', 'sort'].forEach(function (id) {
            const el = document.getElementById(id);
            if (el) el.addEventListener('change', function () {
                document.getElementById('filter-form').submit();
            });
        });

        // ── Live search with debounce ──
        const searchInput = document.getElementById('search-input');
        const searchForm  = document.getElementById('search-form');
        const resultsContainer = document.getElementById('results-container');
        const filterForm  = document.getElementById('filter-form');
        let searchTimeout = null;

        if (searchInput && resultsContainer) {
            searchInput.addEventListener('input', function () {
                clearTimeout(searchTimeout);
                searchTimeout = setTimeout(function () {
                    const url = new URL(searchForm.action);
                    url.searchParams.set('search', searchInput.value);

                    if (filterForm) {
                        new FormData(filterForm).forEach(function (value, key) {
                            if (value) url.searchParams.append(key, value);
                        });
                    }

                    resultsContainer.classList.add('loading');

                    fetch(url.toString(), { headers: { 'X-Requested-With': 'XMLHttpRequest' } })
                        .then(function (r) { return r.text(); })
                        .then(function (html) {
                            const doc = new DOMParser().parseFromString(html, 'text/html');
                            const newContainer = doc.getElementById('results-container');
                            if (newContainer) resultsContainer.innerHTML = newContainer.innerHTML;
                            resultsContainer.classList.remove('loading');
                            window.history.pushState({}, '', url.toString());
                        })
                        .catch(function () {
                            resultsContainer.classList.remove('loading');
                        });
                }, 800);
            });
        }
    });
    </script>
@endsection