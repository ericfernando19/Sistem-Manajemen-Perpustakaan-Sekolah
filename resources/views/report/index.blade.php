@extends('layouts.app')

@section('content')
<div style="padding: 24px; background-color: #f9fafb; border-radius: 10px;">
    <h2 style="font-size: 26px; font-weight: 600; margin-bottom: 24px; color: #1e293b;">
        📄 Laporan Peminjaman Buku
    </h2>

    <div style="overflow-x: auto;">
        <table style="width: 100%; border-collapse: collapse; background: #ffffff;
                      border-radius: 10px; overflow: hidden; box-shadow: 0 4px 12px rgba(0, 0, 0, 0.05);">
            <thead>
                <tr style="background-color: #f3f4f6; color: #374151; text-align: left;">
                    <th style="padding: 12px 16px; font-weight: 600;">📚 Buku</th>
                    <th style="padding: 12px 16px; font-weight: 600;">🙋 Peminjam</th>
                    <th style="padding: 12px 16px; font-weight: 600;">📌 Status</th>
                    <th style="padding: 12px 16px; font-weight: 600;">📅 Tgl. Pinjam</th>
                    <th style="padding: 12px 16px; font-weight: 600;">⏰ Jatuh Tempo</th>
                </tr>
            </thead>
            <tbody>
                @forelse ($borrows as $borrow)
                    <tr style="border-top: 1px solid #e5e7eb;">
                        <td style="padding: 12px 16px; color: #1f2937;">{{ $borrow->book->title }}</td>
                        <td style="padding: 12px 16px; color: #1f2937;">{{ $borrow->borrower }}</td>
                        <td style="padding: 12px 16px;">
                            @if ($borrow->status === 'dipinjam')
                                <span style="color: #f59e0b; font-weight: 500;">Dipinjam</span>
                            @else
                                <span style="color: #10b981; font-weight: 500;">Dikembalikan</span>
                            @endif
                        </td>
                        <td style="padding: 12px 16px; color: #4b5563;">
                            {{ \Carbon\Carbon::parse($borrow->borrow_date)->format('d M Y') }}
                        </td>
                        <td style="padding: 12px 16px; color: #4b5563;">
                            {{ \Carbon\Carbon::parse($borrow->due_date)->format('d M Y') }}
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="5" style="text-align: center; padding: 20px; color: #6b7280;">
                            Belum ada data peminjaman.
                        </td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>
</div>
@endsection
