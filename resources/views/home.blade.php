@extends('layouts.app')

@section('content')
<style>
  .home-center-wrapper {
    height: calc(100vh - 80px); /* agar tidak penuh total jika header ada */
    display: flex;
    justify-content: center;
    align-items: center;
  }

  .home-content {
    text-align: center;
    max-width: 600px;
    margin: auto;
  }

  @media (max-width: 768px) {
    .home-center-wrapper {
      padding: 0 16px;
    }
  }
</style>

<div class="container-fluid">
  <div class="home-center-wrapper">
    <div class="home-content">
      <h1 style="font-size: 32px; color: #1f2937; margin-bottom: 12px;">
        📚 Selamat Datang di Aplikasi Perpustakaan
      </h1>
      <p style="font-size: 18px; color: #6b7280;">
        Silakan login untuk mulai menggunakan aplikasi.
      </p>

      <a href="{{ route('login') }}"
         style="display: inline-block; margin-top: 24px; padding: 12px 24px;
                background-color: #3b82f6; color: white; text-decoration: none;
                border-radius: 8px; font-weight: 600; transition: background-color 0.3s;">
        🔐 Login Sekarang
      </a>
    </div>
  </div>
</div>
@endsection
