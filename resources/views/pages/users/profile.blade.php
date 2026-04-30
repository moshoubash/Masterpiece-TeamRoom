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
        --green-50:  #F0FDF4;
        --green-100: #DCFCE7;
        --green-500: #22C55E;
        --green-700: #15803D;
        --green-800: #166534;
        --yellow-400:#FACC15;
        --yellow-100:#FEF9C3;
        --yellow-800:#713F12;
        --red-50:   #FEF2F2;
        --red-100:  #FEE2E2;
        --red-500:  #EF4444;
        --red-600:  #DC2626;
        --red-800:  #991B1B;
        --amber-100:#FEF3C7;
        --amber-800:#92400E;
        --shadow-sm: 0 1px 3px rgba(0,0,0,0.06);
        --shadow-md: 0 4px 16px rgba(0,0,0,0.08);
        --shadow-lg: 0 10px 32px rgba(0,0,0,0.1);
    }

    *, *::before, *::after { box-sizing: border-box; }
    body { font-family: 'DM Sans', sans-serif; background: var(--gray-50); color: var(--gray-800); }
    h1,h2,h3,h4 { font-family: 'Sora', sans-serif; }

    .profile-page {
        padding: 32px 0 72px;
        min-height: 100vh;
    }

    .container {
        max-width: 1200px;
        margin: 0 auto;
        padding: 0 20px;
    }

    /*  Breadcrumb  */
    .breadcrumbs {
        display: flex;
        align-items: center;
        gap: 6px;
        font-size: 13px;
        color: var(--gray-500);
        margin-bottom: 24px;
    }
    .breadcrumbs a { color: var(--gray-500); text-decoration: none; transition: color 0.15s; }
    .breadcrumbs a:hover { color: var(--blue-600); }
    .breadcrumbs svg { color: var(--gray-300); }

    /*  Profile hero card  */
    .profile-hero {
        background: #fff;
        border: 1px solid var(--gray-200);
        border-radius: 20px;
        overflow: hidden;
        box-shadow: var(--shadow-sm);
        margin-bottom: 28px;
    }

    .profile-banner {
        height: 20px;
        background: linear-gradient(135deg, var(--blue-700) 0%, var(--blue-500) 60%, #60A5FA 100%);
        position: relative;
    }

    .profile-hero-body {
        padding: 0 28px 28px;
        display: flex;
        flex-direction: column;
        gap: 20px;
    }

    @media (min-width: 640px) {
        .profile-hero-body {
            flex-direction: row;
            align-items: flex-end;
            justify-content: space-between;
        }
    }

    .profile-avatar-wrap {
        margin-top: -44px;
        flex-shrink: 0;
    }

    .profile-avatar {
        width: 88px;
        height: 88px;
        border-radius: 50%;
        object-fit: cover;
        border: 4px solid #fff;
        box-shadow: 0 4px 16px rgba(0,0,0,0.12);
        background: var(--gray-100);
    }

    .profile-info { flex: 1; min-width: 0; padding-top: 12px; }

    @media (min-width: 640px) { .profile-info { padding-top: 0; } }

    .profile-name {
        font-size: clamp(1.25rem, 2.5vw, 1.6rem);
        font-weight: 800;
        color: var(--gray-900);
        letter-spacing: -0.02em;
        margin: 0 0 4px;
    }

    .profile-since {
        font-size: 13px;
        color: var(--gray-500);
        margin-bottom: 14px;
    }

    .profile-badges {
        display: flex;
        flex-wrap: wrap;
        gap: 8px;
    }

    .profile-badge {
        display: inline-flex;
        align-items: center;
        gap: 5px;
        padding: 5px 12px;
        border-radius: 100px;
        font-size: 13px;
        font-weight: 500;
    }

    .badge-verified   { background: var(--green-50);  color: var(--green-700); border: 1px solid var(--green-100); }
    .badge-unverified { background: var(--red-50);    color: var(--red-600);   border: 1px solid var(--red-100); }
    .badge-role       { background: var(--blue-50);   color: var(--blue-700);  border: 1px solid var(--blue-100); }
    .badge-rating     { background: var(--yellow-100);color: var(--yellow-800);border: 1px solid #FDE68A; }

    .profile-actions { flex-shrink: 0; display: flex; align-items: flex-end; padding-bottom: 2px; }

    .btn-edit {
        display: inline-flex;
        align-items: center;
        gap: 6px;
        padding: 9px 20px;
        background: var(--blue-600);
        color: #fff;
        border: none;
        border-radius: 10px;
        font-family: 'Sora', sans-serif;
        font-size: 14px;
        font-weight: 700;
        cursor: pointer;
        text-decoration: none;
        transition: background 0.2s, transform 0.15s, box-shadow 0.2s;
        box-shadow: 0 2px 8px rgba(37,99,235,0.3);
    }

    .btn-edit:hover {
        background: var(--blue-700);
        transform: translateY(-1px);
        box-shadow: 0 4px 14px rgba(37,99,235,0.4);
    }

    /*  Section heading row  */
    .section-header {
        display: flex;
        align-items: center;
        justify-content: space-between;
        margin-bottom: 20px;
        flex-wrap: wrap;
        gap: 12px;
    }

    .section-title {
        font-size: 1.15rem;
        font-weight: 800;
        color: var(--gray-900);
        letter-spacing: -0.01em;
        margin: 0;
    }

    .btn-add {
        display: inline-flex;
        align-items: center;
        gap: 6px;
        padding: 8px 16px;
        background: var(--blue-600);
        color: #fff;
        border-radius: 10px;
        font-family: 'Sora', sans-serif;
        font-size: 13px;
        font-weight: 700;
        text-decoration: none;
        transition: background 0.2s, transform 0.15s;
        box-shadow: 0 2px 8px rgba(37,99,235,0.25);
    }

    .btn-add:hover { background: var(--blue-700); transform: translateY(-1px); }

    /*  Space cards grid  */
    .spaces-grid {
        display: grid;
        grid-template-columns: 1fr;
        gap: 20px;
    }

    @media (min-width: 640px)  { .spaces-grid { grid-template-columns: repeat(2, 1fr); } }
    @media (min-width: 1024px) { .spaces-grid { grid-template-columns: repeat(3, 1fr); } }

    .space-card {
        background: #fff;
        border: 1px solid var(--gray-200);
        border-radius: 16px;
        overflow: hidden;
        box-shadow: var(--shadow-sm);
        display: flex;
        flex-direction: column;
        transition: box-shadow 0.25s, transform 0.25s;
    }

    .space-card:hover {
        box-shadow: 0 8px 28px rgba(37,99,235,0.12);
        transform: translateY(-3px);
    }

    .space-img-wrap {
        position: relative;
        height: 180px;
        overflow: hidden;
    }

    .space-img-wrap img {
        width: 100%;
        height: 100%;
        object-fit: cover;
        transition: transform 0.4s;
    }

    .space-card:hover .space-img-wrap img { transform: scale(1.05); }

    .space-img-overlay {
        position: absolute;
        inset: 0;
        background: linear-gradient(to top, rgba(0,0,0,0.55), transparent);
        opacity: 0;
        transition: opacity 0.3s;
        display: flex;
        align-items: flex-end;
        padding: 14px;
    }

    .space-card:hover .space-img-overlay { opacity: 1; }

    .space-img-overlay a {
        background: rgba(255,255,255,0.92);
        color: var(--blue-600);
        padding: 6px 14px;
        border-radius: 8px;
        font-size: 13px;
        font-weight: 600;
        text-decoration: none;
    }

    .space-deleted-badge {
        position: absolute;
        top: 12px;
        left: 12px;
        background: var(--red-600);
        color: #fff;
        font-size: 11px;
        font-weight: 700;
        text-transform: uppercase;
        letter-spacing: 0.05em;
        padding: 3px 10px;
        border-radius: 100px;
    }

    .space-edit-btn {
        position: absolute;
        top: 12px;
        right: 12px;
        width: 32px;
        height: 32px;
        background: rgba(255,255,255,0.95);
        border-radius: 8px;
        display: flex;
        align-items: center;
        justify-content: center;
        text-decoration: none;
        color: var(--gray-600);
        box-shadow: 0 2px 8px rgba(0,0,0,0.12);
        transition: background 0.15s, color 0.15s;
    }

    .space-edit-btn:hover { background: #fff; color: var(--blue-600); }

    .space-body { padding: 16px; flex: 1; display: flex; flex-direction: column; }

    .space-title-row {
        display: flex;
        justify-content: space-between;
        align-items: flex-start;
        gap: 8px;
        margin-bottom: 8px;
    }

    .space-name {
        font-size: 1rem;
        font-weight: 700;
        color: var(--gray-900);
        line-height: 1.3;
        margin: 0;
        transition: color 0.2s;
    }

    .space-card:hover .space-name { color: var(--blue-600); }

    .space-rating {
        display: flex;
        align-items: center;
        gap: 3px;
        background: var(--yellow-100);
        padding: 3px 8px;
        border-radius: 8px;
        flex-shrink: 0;
    }

    .space-rating svg { color: var(--yellow-400); }
    .space-rating span { font-size: 12px; font-weight: 600; color: var(--yellow-800); }

    .space-meta {
        font-size: 13px;
        color: var(--gray-500);
        line-height: 1.6;
        margin-bottom: 12px;
    }

    .space-footer {
        display: flex;
        justify-content: space-between;
        align-items: center;
        margin-top: auto;
        padding-top: 12px;
        border-top: 1px solid var(--gray-100);
    }

    .space-price {
        font-family: 'Sora', sans-serif;
        font-size: 1.1rem;
        font-weight: 800;
        color: var(--gray-900);
    }

    .space-price span { font-size: 13px; font-weight: 400; color: var(--gray-400); }

    .space-status {
        font-size: 11px;
        font-weight: 700;
        text-transform: uppercase;
        letter-spacing: 0.05em;
        padding: 4px 10px;
        border-radius: 100px;
    }

    .status-active   { background: var(--green-100); color: var(--green-800); }
    .status-deleted  { background: var(--red-100);   color: var(--red-800); }

    /*  Reviews section  */
    .reviews-grid {
        display: flex;
        flex-direction: column;
        gap: 16px;
    }

    .review-card {
        background: #fff;
        border: 1px solid var(--gray-200);
        border-radius: 14px;
        padding: 20px 22px;
        box-shadow: var(--shadow-sm);
        transition: box-shadow 0.2s;
    }

    .review-card:hover { box-shadow: var(--shadow-md); }

    .review-quote-icon {
        width: 32px;
        height: 32px;
        background: var(--blue-50);
        border-radius: 8px;
        display: flex;
        align-items: center;
        justify-content: center;
        color: var(--blue-500);
        margin-bottom: 12px;
    }

    .review-text {
        font-size: 15px;
        color: var(--gray-700);
        line-height: 1.7;
        font-style: italic;
        margin-bottom: 14px;
    }

    .review-stars {
        display: flex;
        align-items: center;
        gap: 3px;
        margin-bottom: 12px;
    }

    .review-footer {
        display: flex;
        align-items: center;
        justify-content: space-between;
        flex-wrap: wrap;
        gap: 10px;
        padding-top: 12px;
        border-top: 1px solid var(--gray-100);
    }

    .review-space {
        font-size: 13px;
        color: var(--gray-500);
    }

    .review-space strong { color: var(--gray-800); font-weight: 600; }

    .review-price {
        font-family: 'Sora', sans-serif;
        font-size: 14px;
        font-weight: 700;
        color: var(--gray-900);
    }

    .review-price span { font-size: 12px; font-weight: 400; color: var(--gray-400); }

    /*  Bookings section  */
    .bookings-grid {
        display: grid;
        grid-template-columns: 1fr;
        gap: 16px;
    }

    @media (min-width: 640px)  { .bookings-grid { grid-template-columns: repeat(2, 1fr); } }
    @media (min-width: 1024px) { .bookings-grid { grid-template-columns: repeat(3, 1fr); } }

    .booking-card {
        background: #fff;
        border: 1px solid var(--gray-200);
        border-radius: 14px;
        overflow: hidden;
        box-shadow: var(--shadow-sm);
        display: flex;
        flex-direction: column;
        transition: box-shadow 0.2s, transform 0.2s;
    }

    .booking-card:hover {
        box-shadow: var(--shadow-md);
        transform: translateY(-2px);
    }

    .booking-card-body { padding: 18px; flex: 1; }

    .booking-id {
        font-size: 11px;
        font-weight: 700;
        text-transform: uppercase;
        letter-spacing: 0.08em;
        color: var(--gray-400);
        margin-bottom: 6px;
    }

    .booking-space-name {
        font-family: 'Sora', sans-serif;
        font-size: 15px;
        font-weight: 700;
        color: var(--gray-900);
        margin-bottom: 12px;
        line-height: 1.3;
    }

    .booking-meta {
        display: flex;
        flex-direction: column;
        gap: 7px;
        margin-bottom: 14px;
    }

    .booking-meta-item {
        display: flex;
        align-items: center;
        gap: 7px;
        font-size: 13px;
        color: var(--gray-600);
    }

    .booking-meta-item svg { color: var(--gray-400); flex-shrink: 0; }

    .booking-status {
        display: inline-flex;
        align-items: center;
        gap: 5px;
        font-size: 11px;
        font-weight: 700;
        text-transform: uppercase;
        letter-spacing: 0.05em;
        padding: 4px 10px;
        border-radius: 100px;
    }

    .booking-status::before {
        content: '';
        width: 6px;
        height: 6px;
        border-radius: 50%;
    }

    .status-pending   { background: var(--amber-100); color: var(--amber-800); }
    .status-confirmed { background: var(--green-100); color: var(--green-800); }
    .status-cancelled { background: var(--red-100);   color: var(--red-800); }
    .status-completed { background: var(--gray-100);  color: var(--gray-600); }

    .booking-status.status-pending::before   { background: #F59E0B; }
    .booking-status.status-confirmed::before { background: var(--green-500); }
    .booking-status.status-cancelled::before { background: var(--red-500); }
    .booking-status.status-completed::before { background: var(--gray-400); }

    .booking-card-footer {
        padding: 12px 18px;
        border-top: 1px solid var(--gray-100);
        background: var(--gray-50);
        display: flex;
        align-items: center;
        justify-content: space-between;
    }

    .booking-price {
        font-family: 'Sora', sans-serif;
        font-size: 15px;
        font-weight: 800;
        color: var(--gray-900);
    }

    .booking-price span { font-size: 12px; font-weight: 400; color: var(--gray-400); }

    .btn-view {
        display: inline-flex;
        align-items: center;
        gap: 5px;
        font-size: 13px;
        font-weight: 600;
        color: var(--blue-600);
        text-decoration: none;
        padding: 6px 12px;
        border-radius: 8px;
        border: 1.5px solid var(--blue-200);
        transition: all 0.2s;
    }

    .btn-view:hover { background: var(--blue-50); border-color: var(--blue-400); }

    /*  Empty state  */
    .empty-state {
        background: #fff;
        border: 1px solid var(--gray-200);
        border-radius: 16px;
        padding: 56px 24px;
        text-align: center;
    }

    .empty-icon {
        width: 60px;
        height: 60px;
        border-radius: 50%;
        background: var(--gray-100);
        display: flex;
        align-items: center;
        justify-content: center;
        margin: 0 auto 16px;
    }

    .empty-icon svg { color: var(--gray-400); }
    .empty-state h3 { font-size: 1rem; font-weight: 700; color: var(--gray-800); margin-bottom: 6px; }
    .empty-state p  { font-size: 14px; color: var(--gray-500); }
</style>
@endsection

@section('content')
<div class="profile-page">
    <div class="container">

        {{-- Breadcrumb --}}
        <div class="breadcrumbs">
            <a href="/">Home</a>
            <svg width="14" height="14" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2"><path stroke-linecap="round" stroke-linejoin="round" d="M9 5l7 7-7 7"/></svg>
            <span>Profile</span>
        </div>

        {{--  Profile hero  --}}
        <div class="profile-hero">
            <div class="profile-banner"></div>

            <div class="profile-hero-body">
                <div class="d-flex" style="display:flex; align-items:flex-end; gap:20px; flex-wrap:wrap; flex:1; min-width:0; padding-top:20px;">
                    <div class="profile-avatar-wrap">
                        <img class="profile-avatar"
                             src="{{ $profile_image ? asset($profile_image) : asset('images/profile-pictures/default-avatar.svg') }}"
                             alt="{{ $name }}">
                    </div>

                    <div class="profile-info">
                        <h1 class="profile-name">{{ $name }}</h1>
                        <p class="profile-since">Member since {{ $created_at }}</p>

                        <div class="profile-badges">
                            {{-- Verified --}}
                            @if($is_verified)
                                <span class="profile-badge badge-verified">
                                    <svg width="14" height="14" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2.5"><path stroke-linecap="round" stroke-linejoin="round" d="M5 13l4 4L19 7"/></svg>
                                    Verified
                                </span>
                            @else
                                <span class="profile-badge badge-unverified">
                                    <svg width="14" height="14" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2.5"><path stroke-linecap="round" stroke-linejoin="round" d="M6 18L18 6M6 6l12 12"/></svg>
                                    Not Verified
                                </span>
                            @endif

                            {{-- Role --}}
                            <span class="profile-badge badge-role">
                                <svg width="13" height="13" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2"><path stroke-linecap="round" stroke-linejoin="round" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"/></svg>
                                {{ ucfirst(strtolower($role)) }}
                            </span>

                            {{-- Rating (HOST only) --}}
                            @if($role == 'HOST')
                                <span class="profile-badge badge-rating">
                                    <svg width="13" height="13" viewBox="0 0 20 20" fill="currentColor"><path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z"/></svg>
                                    {{ number_format($average_rating, 1) }} · {{ $total_reviews }} reviews
                                </span>
                            @endif
                        </div>
                    </div>
                </div>

                @auth
                    @if($user->id == Auth::user()->id)
                        <div class="profile-actions">
                            <a href="{{ route('user.edit', $user->slug) }}" class="btn-edit">
                                <svg width="15" height="15" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2"><path stroke-linecap="round" stroke-linejoin="round" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"/></svg>
                                Edit Profile
                            </a>
                        </div>
                    @endif
                @endauth
            </div>
        </div>

        {{--  HOST: Listed Spaces  --}}
        @if($role == 'HOST')
            <div>
                <div class="section-header">
                    <h2 class="section-title">Listed Spaces</h2>
                    @auth
                        @if($user->id == Auth::user()->id)
                            <a href="{{ route('room.create') }}" class="btn-add">
                                <svg width="14" height="14" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2.5"><path stroke-linecap="round" stroke-linejoin="round" d="M12 4v16m8-8H4"/></svg>
                                List New Space
                            </a>
                        @endif
                    @endauth
                </div>

                @if($spaces && $spaces->count())
                    <div class="spaces-grid">
                        @foreach($spaces as $space)
                            <div class="space-card">
                                <div class="space-img-wrap">
                                    @if($space->images->isEmpty())
                                        <img src="https://www.svgrepo.com/show/508699/landscape-placeholder.svg" alt="{{ $space->title }}">
                                    @else
                                        <img src="{{ asset('storage/' . $space->images->first()->image_url) }}" alt="{{ $space->title }}" loading="lazy">
                                    @endif

                                    @if($space->trashed())
                                        <span class="space-deleted-badge">Deleted</span>
                                    @endif

                                    @auth
                                        @if($user->id == Auth::user()->id)
                                            <a href="{{ route('space.edit', $space->slug) }}" class="space-edit-btn" title="Edit space">
                                                <svg width="15" height="15" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2"><path stroke-linecap="round" stroke-linejoin="round" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"/></svg>
                                            </a>
                                        @endif
                                    @endauth

                                    <div class="space-img-overlay">
                                        <a href="{{ route('rooms.details', $space->slug) }}">View Details</a>
                                    </div>
                                </div>

                                <div class="space-body">
                                    <div class="space-title-row">
                                        <h3 class="space-name">{{ $space->title }}</h3>
                                        <div class="space-rating">
                                            <svg width="12" height="12" viewBox="0 0 20 20" fill="currentColor"><path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z"/></svg>
                                            <span>{{ number_format($space->reviews->avg('rating') ?? 0, 1) }}</span>
                                        </div>
                                    </div>

                                    <div class="space-meta">
                                        Jordan, {{ $space->city }}<br>
                                        Up to {{ $space->capacity }} people
                                    </div>

                                    <div class="space-footer">
                                        <div class="space-price">${{ $space->hourly_rate }}<span>/hr</span></div>
                                        <span class="space-status {{ $space->trashed() ? 'status-deleted' : 'status-active' }}">
                                            {{ $space->trashed() ? 'Deleted' : 'Active' }}
                                        </span>
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    </div>
                @else
                    <div class="empty-state">
                        <div class="empty-icon">
                            <svg width="28" height="28" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="1.5"><path stroke-linecap="round" stroke-linejoin="round" d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4"/></svg>
                        </div>
                        <h3>No spaces listed yet</h3>
                        <p>List your first meeting space to start earning.</p>
                    </div>
                @endif
            </div>

        {{--  RENTER: Reviews or Bookings  --}}
        @else
            @if($renterId != Auth::id())
                {{-- Public view: show reviews --}}
                <div>
                    <div class="section-header">
                        <h2 class="section-title">Reviews</h2>
                    </div>

                    @if($userReviews && count($userReviews))
                        <div class="reviews-grid">
                            @foreach($userReviews as $review)
                                <div class="review-card">
                                    <div class="review-quote-icon">
                                        <svg width="16" height="16" viewBox="0 0 24 24" fill="currentColor"><path d="M14.017 21v-7.391c0-5.704 3.731-9.57 8.983-10.609l.995 2.151c-2.432.917-3.995 3.638-3.995 5.849h4v10h-9.983zm-14.017 0v-7.391c0-5.704 3.748-9.57 9-10.609l.996 2.151c-2.433.917-3.996 3.638-3.996 5.849h3.983v10h-9.983z"/></svg>
                                    </div>

                                    <p class="review-text">"{{ $review->review_text }}"</p>

                                    <div class="review-stars">
                                        @for($i = 1; $i <= 5; $i++)
                                            <svg width="16" height="16" viewBox="0 0 20 20" fill="{{ $i <= $review->rating ? '#FACC15' : '#E5E7EB' }}">
                                                <path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z"/>
                                            </svg>
                                        @endfor
                                        <span style="font-size:13px; color: var(--gray-500); margin-left:6px;">{{ $review->rating }}/5</span>
                                    </div>

                                    <div class="review-footer">
                                        <div class="review-space">
                                            Space: <strong>{{ $review->space->title }}</strong>
                                        </div>
                                        <div class="review-price">${{ $review->space->hourly_rate }}<span>/hr</span></div>
                                    </div>
                                </div>
                            @endforeach
                        </div>
                    @else
                        <div class="empty-state">
                            <div class="empty-icon">
                                <svg width="28" height="28" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="1.5"><path stroke-linecap="round" stroke-linejoin="round" d="M11.049 2.927c.3-.921 1.603-.921 1.902 0l1.519 4.674a1 1 0 00.95.69h4.915c.969 0 1.371 1.24.588 1.81l-3.976 2.888a1 1 0 00-.363 1.118l1.518 4.674c.3.922-.755 1.688-1.538 1.118l-3.976-2.888a1 1 0 00-1.176 0l-3.976 2.888c-.783.57-1.838-.197-1.538-1.118l1.518-4.674a1 1 0 00-.363-1.118l-3.976-2.888c-.784-.57-.38-1.81.588-1.81h4.914a1 1 0 00.951-.69l1.519-4.674z"/></svg>
                            </div>
                            <h3>No reviews yet</h3>
                            <p>This user hasn't written any reviews.</p>
                        </div>
                    @endif
                </div>

            @else
                {{-- Own view: show bookings --}}
                <div>
                    <div class="section-header">
                        <h2 class="section-title">My Bookings</h2>
                    </div>

                    @if($bookings && count($bookings))
                        <div class="bookings-grid">
                            @foreach($bookings as $booking)
                                <div class="booking-card">
                                    <div class="booking-card-body">
                                        <div class="booking-id">#{{ $booking->id }}</div>
                                        <div class="booking-space-name">{{ $booking->space->name ?? $booking->space->title }}</div>

                                        <div class="booking-meta">
                                            <div class="booking-meta-item">
                                                <svg width="14" height="14" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2"><path stroke-linecap="round" stroke-linejoin="round" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z"/><path stroke-linecap="round" stroke-linejoin="round" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z"/></svg>
                                                {{ $booking->space->city ?? '—' }}
                                            </div>
                                            <div class="booking-meta-item">
                                                <svg width="14" height="14" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2"><path stroke-linecap="round" stroke-linejoin="round" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"/></svg>
                                                {{ $booking->start_datetime }}
                                            </div>
                                            <div class="booking-meta-item">
                                                <svg width="14" height="14" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2"><path stroke-linecap="round" stroke-linejoin="round" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"/></svg>
                                                Until {{ $booking->end_datetime }}
                                            </div>
                                        </div>

                                        @php
                                            $statusMap = [
                                                'pending'   => 'status-pending',
                                                'confirmed' => 'status-confirmed',
                                                'cancelled' => 'status-cancelled',
                                                'completed' => 'status-completed',
                                            ];
                                            $statusClass = $statusMap[$booking->status] ?? 'status-completed';
                                        @endphp
                                        <span class="booking-status {{ $statusClass }}">
                                            {{ ucfirst($booking->status) }}
                                        </span>
                                    </div>

                                    <div class="booking-card-footer">
                                        <div class="booking-price">${{ $booking->space->hourly_rate }}<span>/hr</span></div>
                                        <a href="{{ route('bookings.details', $booking->id) }}" class="btn-view">
                                            Details
                                            <svg width="12" height="12" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2.5"><path stroke-linecap="round" stroke-linejoin="round" d="M17 8l4 4m0 0l-4 4m4-4H3"/></svg>
                                        </a>
                                    </div>
                                </div>
                            @endforeach
                        </div>
                    @else
                        <div class="empty-state">
                            <div class="empty-icon">
                                <svg width="28" height="28" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="1.5"><path stroke-linecap="round" stroke-linejoin="round" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"/></svg>
                            </div>
                            <h3>No bookings yet</h3>
                            <p>You haven't made any bookings. <a href="/explore" style="color: var(--blue-600); font-weight: 600;">Explore spaces</a> to get started.</p>
                        </div>
                    @endif
                </div>
            @endif
        @endif

    </div>
</div>
@endsection