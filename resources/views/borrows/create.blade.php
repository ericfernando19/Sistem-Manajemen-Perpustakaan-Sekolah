@extends('layouts.app')

@section('content')
<div style="max-width: 600px; margin: 40px auto;">
    <h2 style="font-size: 26px; font-weight: 600; margin-bottom: 28px; color: #1e293b;">📘 Form Peminjaman Buku</h2>

    <form method="POST" action="{{ route('borrows.store') }}"
          style="background: #ffffff; padding: 30px; border-radius: 10px;
                 box-shadow: 0 4px 12px rgba(0, 0, 0, 0.06);">
        @csrf

        <div style="margin-bottom: 18px;">
            <label for="book_id" style="display: block; font-weight: 600; margin-bottom: 6px; color: #374151;">
                📚 Pilih Buku:
            </label>
            <select name="book_id" id="book_id" required
                    style="width: 100%; padding: 10px 12px; border: 1px solid #d1d5db;
                           border-radius: 6px; font-size: 14px;">
                <option disabled selected>-- Pilih Buku --</option>
                @foreach ($books as $book)
                    <option value="{{ $book->id }}">
                        {{ $book->title }} (Stok: {{ $book->stock }})
                    </option>
                @endforeach
            </select>
        </div>

        <div style="margin-bottom: 18px;">
            <label for="borrower" style="display: block; font-weight: 600; margin-bottom: 6px; color: #374151;">
                🙋 Nama Peminjam:
            </label>
            <input name="borrower" id="borrower" required
                   style="width: 100%; padding: 10px 12px; border: 1px solid #d1d5db;
                          border-radius: 6px; font-size: 14px;" />
        </div>

        <div style="margin-bottom: 18px;">
            <label for="borrow_date" style="display: block; font-weight: 600; margin-bottom: 6px; color: #374151;">
                📅 Tanggal Pinjam:
            </label>
            <input type="date" name="borrow_date" id="borrow_date" required
                   style="width: 100%; padding: 10px 12px; border: 1px solid #d1d5db;
                          border-radius: 6px; font-size: 14px;" />
        </div>

        <div style="margin-bottom: 24px;">
            <label for="due_date" style="display: block; font-weight: 600; margin-bottom: 6px; color: #374151;">
                ⏰ Tanggal Jatuh Tempo:
            </label>
            <input type="date" name="due_date" id="due_date" required
                   style="width: 100%; padding: 10px 12px; border: 1px solid #d1d5db;
                          border-radius: 6px; font-size: 14px;" />
        </div>

        <button type="submit"
                style="background-color: #4caf50; color: white; padding: 10px 18px;
                       border: none; border-radius: 6px; cursor: pointer; font-weight: 500;
                       font-size: 15px; transition: background 0.3s;"
                onmouseover="this.style.backgroundColor='#43a047'"
                onmouseout="this.style.backgroundColor='#4caf50'">
            📥 Pinjam Buku
        </button>
    </form>
</div>
@endsection
