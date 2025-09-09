@extends('layouts.app')

@section('content')
    <h1 style="font-size: 28px; margin-bottom: 20px; color: #1e293b;">📊 Dashboard</h1>

    <div style="display: flex; gap: 20px; flex-wrap: wrap;">
        <!-- Total Buku -->
        <div style="
            flex: 1;
            min-width: 200px;
            background-color: #e0f2fe;
            padding: 20px;
            border-radius: 12px;
            box-shadow: 0 4px 10px rgba(0,0,0,0.05);
            transition: background 0.3s;">
            <h3 style="margin-bottom: 8px; color: #0c4a6e;">📚 Total Buku</h3>
            <p style="font-size: 26px; font-weight: bold; color: #075985;">{{ $total_books }}</p>
        </div>

        <!-- Sedang Dipinjam -->
        <div style="
            flex: 1;
            min-width: 200px;
            background-color: #fef3c7;
            padding: 20px;
            border-radius: 12px;
            box-shadow: 0 4px 10px rgba(0,0,0,0.05);
            transition: background 0.3s;">
            <h3 style="margin-bottom: 8px; color: #92400e;">📦 Sedang Dipinjam</h3>
            <p style="font-size: 26px; font-weight: bold; color: #b45309;">{{ $total_borrows }}</p>
        </div>

        <!-- Dikembalikan -->
        <div style="
            flex: 1;
            min-width: 200px;
            background-color: #dcfce7;
            padding: 20px;
            border-radius: 12px;
            box-shadow: 0 4px 10px rgba(0,0,0,0.05);
            transition: background 0.3s;">
            <h3 style="margin-bottom: 8px; color: #166534;">✅ Dikembalikan</h3>
            <p style="font-size: 26px; font-weight: bold; color: #15803d;">{{ $total_returns }}</p>
        </div>
    </div>
@endsection
