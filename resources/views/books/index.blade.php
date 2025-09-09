@extends('layouts.app')

@section('content')
    <h2 style="font-size: 24px; font-weight: 600; margin-bottom: 24px; color: #1e293b;">📚 Daftar Buku</h2>

    <a href="{{ route('books.create') }}"
       style="display: inline-block; background-color: #3b82f6; color: white; padding: 10px 18px; text-decoration: none;
              border-radius: 8px; margin-bottom: 24px; font-weight: 500; transition: background 0.3s;"
       onmouseover="this.style.backgroundColor='#2563eb'"
       onmouseout="this.style.backgroundColor='#3b82f6'">
        ➕ Tambah Buku
    </a>

    <div style="overflow-x: auto;">
        <table style="width: 100%; border-collapse: collapse; background: white; border-radius: 8px; overflow: hidden;
                      box-shadow: 0 2px 8px rgba(0,0,0,0.05);">
            <thead>
                <tr style="background-color: #f1f5f9; text-align: left;">
                    <th style="padding: 14px 16px; font-weight: 600; color: #374151;">Judul</th>
                    <th style="padding: 14px 16px; font-weight: 600; color: #374151;">Penulis</th>
                    <th style="padding: 14px 16px; font-weight: 600; color: #374151;">Stok</th>
                    <th style="padding: 14px 16px; font-weight: 600; color: #374151;">Aksi</th>
                </tr>
            </thead>
            <tbody>
                @forelse ($books as $book)
                    <tr style="border-top: 1px solid #e5e7eb; transition: background 0.2s;"
                        onmouseover="this.style.backgroundColor='#f9fafb'"
                        onmouseout="this.style.backgroundColor='white'">
                        <td style="padding: 14px 16px; color: #1f2937;">{{ $book->title }}</td>
                        <td style="padding: 14px 16px; color: #1f2937;">{{ $book->author }}</td>
                        <td style="padding: 14px 16px; color: #1f2937;">{{ $book->stock }}</td>
                        <td style="padding: 14px 16px;">
                            <a href="{{ route('books.edit', $book->id) }}"
                               style="color: #3b82f6; font-weight: 500; text-decoration: none; margin-right: 12px;">
                               ✏️ Edit
                            </a>

                            <form action="{{ route('books.destroy', $book->id) }}" method="POST" style="display:inline;">
                                @csrf
                                @method('DELETE')
                                <button type="submit"
                                        onclick="return confirm('Hapus buku ini?')"
                                        style="background: none; border: none; color: #ef4444;
                                               font-weight: 500; cursor: pointer;">
                                    🗑️ Hapus
                                </button>
                            </form>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="4" style="text-align: center; padding: 24px; color: #6b7280;">
                            Tidak ada buku tersedia.
                        </td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>
@endsection
