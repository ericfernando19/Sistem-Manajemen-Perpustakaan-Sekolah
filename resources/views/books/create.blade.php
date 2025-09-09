@extends('layouts.app')

@section('content')
    <div style="max-width: 500px; margin: 40px auto; background: #ffffff; padding: 32px; border-radius: 12px;
                box-shadow: 0 4px 16px rgba(0,0,0,0.06);">
        <h2 style="font-size: 24px; font-weight: 600; margin-bottom: 24px; text-align: center; color: #1e293b;">
            ➕ Tambah Buku Baru
        </h2>

        <form method="POST" action="{{ route('books.store') }}">
            @csrf

            <div style="margin-bottom: 18px;">
                <label for="title" style="display: block; font-weight: 500; margin-bottom: 6px; color: #374151;">Judul</label>
                <input name="title" id="title" required
                       style="width: 100%; padding: 10px 12px; border: 1px solid #d1d5db; border-radius: 8px;
                              font-size: 15px; background: #f9fafb;" />
            </div>

            <div style="margin-bottom: 18px;">
                <label for="author" style="display: block; font-weight: 500; margin-bottom: 6px; color: #374151;">Penulis</label>
                <input name="author" id="author" required
                       style="width: 100%; padding: 10px 12px; border: 1px solid #d1d5db; border-radius: 8px;
                              font-size: 15px; background: #f9fafb;" />
            </div>

            <div style="margin-bottom: 18px;">
                <label for="publisher" style="display: block; font-weight: 500; margin-bottom: 6px; color: #374151;">Penerbit</label>
                <input name="publisher" id="publisher" required
                       style="width: 100%; padding: 10px 12px; border: 1px solid #d1d5db; border-radius: 8px;
                              font-size: 15px; background: #f9fafb;" />
            </div>

            <div style="margin-bottom: 18px;">
                <label for="year" style="display: block; font-weight: 500; margin-bottom: 6px; color: #374151;">Tahun</label>
                <input name="year" id="year" type="number" required
                       style="width: 100%; padding: 10px 12px; border: 1px solid #d1d5db; border-radius: 8px;
                              font-size: 15px; background: #f9fafb;" />
            </div>

            <div style="margin-bottom: 24px;">
                <label for="stock" style="display: block; font-weight: 500; margin-bottom: 6px; color: #374151;">Stok</label>
                <input name="stock" id="stock" type="number" required
                       style="width: 100%; padding: 10px 12px; border: 1px solid #d1d5db; border-radius: 8px;
                              font-size: 15px; background: #f9fafb;" />
            </div>

            <button type="submit"
                    style="width: 100%; background-color: #3b82f6; color: white; padding: 12px;
                           font-size: 16px; font-weight: 600; border: none; border-radius: 8px;
                           cursor: pointer; transition: background 0.3s;"
                    onmouseover="this.style.backgroundColor='#2563eb'"
                    onmouseout="this.style.backgroundColor='#3b82f6'">
                💾 Simpan Buku
            </button>
        </form>
    </div>
@endsection
