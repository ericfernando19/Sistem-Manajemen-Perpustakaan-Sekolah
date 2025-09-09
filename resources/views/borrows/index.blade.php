@extends('layouts.app')

@section('content')
<div style="max-width: 1100px; margin: 40px auto;">

    <h2 style="font-size: 24px; font-weight: 600; margin-bottom: 24px; color: #1e293b;">
        📦 Data Peminjaman Buku
    </h2>

    {{-- ✅ Tampilkan Notifikasi Flash --}}
    @if (session('success'))
        <div style="background-color: #d1fae5; color: #065f46; padding: 12px 16px;
                    margin-bottom: 20px; border-radius: 8px;">
            ✅ {{ session('success') }}
        </div>
    @endif

    @if (session('warning'))
        <div style="background-color: #fef3c7; color: #92400e; padding: 12px 16px;
                    margin-bottom: 20px; border-radius: 8px;">
            ⚠️ {{ session('warning') }}
        </div>
    @endif

    @if (session('error'))
        <div style="background-color: #fee2e2; color: #991b1b; padding: 12px 16px;
                    margin-bottom: 20px; border-radius: 8px;">
            ❌ {{ session('error') }}
        </div>
    @endif

    <a href="{{ route('borrows.create') }}"
       style="display: inline-block; background-color: #4caf50; color: white; padding: 10px 16px;
              text-decoration: none; border-radius: 8px; font-weight: 500; margin-bottom: 20px;
              transition: background 0.3s;"
       onmouseover="this.style.backgroundColor='#43a047'"
       onmouseout="this.style.backgroundColor='#4caf50'">
        ➕ Tambah Peminjaman
    </a>

    <a href="#"
   data-bs-toggle="modal" data-bs-target="#notifModal"
   style="display: inline-block; background-color: #f59e0b; color: white; padding: 10px 16px;
          text-decoration: none; border-radius: 8px; font-weight: 500; margin-left: 10px;
          position: relative; transition: background 0.3s;"
   onmouseover="this.style.backgroundColor='#d97706'"
   onmouseout="this.style.backgroundColor='#f59e0b'">
    🔔 Lihat Notifikasi Jatuh Tempo
    @if ($dueSoonCount > 0)
        <span style="position: absolute; top: -8px; right: -8px; background-color: #ef4444;
                     color: white; border-radius: 9999px; padding: 2px 8px; font-size: 12px;">
            {{ $dueSoonCount }}
        </span>
    @endif
</a>


    <div style="overflow-x: auto;">
        <table style="width: 100%; border-collapse: collapse; background: #ffffff;
                      box-shadow: 0 2px 8px rgba(0,0,0,0.04); border-radius: 10px; overflow: hidden;">
            <thead>
                <tr style="background-color: #f9fafb; text-align: left;">
                    <th style="padding: 14px 16px; border-bottom: 1px solid #e5e7eb;">Buku</th>
                    <th style="padding: 14px 16px; border-bottom: 1px solid #e5e7eb;">Peminjam</th>
                    <th style="padding: 14px 16px; border-bottom: 1px solid #e5e7eb;">Status</th>
                    <th style="padding: 14px 16px; border-bottom: 1px solid #e5e7eb;">Aksi</th>
                </tr>
            </thead>
            <tbody>
                @forelse ($borrows as $borrow)
                    <tr style="border-top: 1px solid #f3f4f6;">
                        <td style="padding: 14px 16px;">{{ $borrow->book->title }}</td>
                        <td style="padding: 14px 16px;">{{ $borrow->borrower }}</td>
                        <td style="padding: 14px 16px;">
                            @if ($borrow->status === 'dipinjam')
                                <span style="background-color: #ffedd5; color: #d97706;
                                             padding: 4px 12px; font-size: 13px;
                                             border-radius: 9999px; font-weight: 500;">
                                    Dipinjam
                                </span>
                            @else
                                <span style="background-color: #dcfce7; color: #16a34a;
                                             padding: 4px 12px; font-size: 13px;
                                             border-radius: 9999px; font-weight: 500;">
                                    Dikembalikan
                                </span>
                            @endif
                        </td>
                        <td style="padding: 14px 16px;">
                            @if ($borrow->status === 'dipinjam')
                                <form method="POST" action="{{ route('returns.store', $borrow->id) }}"
                                      style="display: flex; align-items: center; gap: 10px;">
                                    @csrf
                                    <input type="date" name="return_date" required
                                           style="padding: 8px 10px; border: 1px solid #d1d5db;
                                                  border-radius: 6px; font-size: 14px;" />
                                    <button type="submit"
                                            style="background-color: #2563eb; color: white;
                                                   padding: 8px 14px; border: none; border-radius: 6px;
                                                   font-size: 14px; font-weight: 500; cursor: pointer;
                                                   transition: background 0.3s;"
                                            onmouseover="this.style.backgroundColor='#1d4ed8'"
                                            onmouseout="this.style.backgroundColor='#2563eb'">
                                        ✅ Kembalikan
                                    </button>
                                </form>
                            @else
                                <em style="color: #6b7280;">-</em>
                            @endif
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="4" style="text-align: center; padding: 24px; color: #6b7280;">
                            Belum ada data peminjaman.
                        </td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>
</div>
@endsection

<!-- Modal Notifikasi -->
<div class="modal fade" id="notifModal" tabindex="-1" aria-labelledby="notifModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content" style="border-radius: 12px;">
      <div class="modal-header" style="background-color: #f59e0b; color: white; border-top-left-radius: 12px; border-top-right-radius: 12px;">
        <h5 class="modal-title" id="notifModalLabel">📢 Notifikasi Jatuh Tempo</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Tutup"></button>
      </div>
      <div class="modal-body">
        @if ($dueSoonBorrows->count() > 0)
            <ul style="list-style: none; padding-left: 0;">
                @foreach ($dueSoonBorrows as $item)
                    <li style="background-color: #fef3c7; margin-bottom: 10px; padding: 12px 14px;
                               border-radius: 8px; color: #92400e;">
                        📖 <strong>{{ $item->book->title }}</strong><br>
                        Peminjam: {{ $item->borrower }}<br>
                        Jatuh tempo: {{ \Carbon\Carbon::parse($item->due_date)->format('d M Y') }}
                    </li>
                @endforeach
            </ul>
        @else
            <div style="background-color: #d1fae5; color: #065f46; padding: 12px 16px; border-radius: 8px;">
                ✅ Tidak ada buku yang mendekati jatuh tempo.
            </div>
        @endif
      </div>
    </div>
  </div>
</div>

