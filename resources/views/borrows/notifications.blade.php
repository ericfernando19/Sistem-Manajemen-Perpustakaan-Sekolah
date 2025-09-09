@extends('layouts.app')

@section('content')
<div class="container-fluid py-5 px-4" style="background-color: #f8f9fa;">
    <div class="mb-4">
        <h3 class="fw-bold text-primary">
            📢 Notifikasi Jatuh Tempo Buku
        </h3>
        <p class="text-muted">
            Daftar buku yang akan jatuh tempo dalam waktu dekat. Harap segera dikembalikan.
        </p>
    </div>

    <div class="card border-0 shadow-sm">
        <div class="card-body p-0">
            @if ($notifications->count() > 0)
                <div class="table-responsive">
                    <table class="table table-striped mb-0 table-hover align-middle">
                        <thead class="table-light text-center">
                            <tr>
                                <th scope="col">#</th>
                                <th scope="col">Judul Buku</th>
                                <th scope="col">Peminjam</th>
                                <th scope="col">Tanggal Pinjam</th>
                                <th scope="col" class="text-danger">Tanggal Jatuh Tempo</th>
                                <th scope="col">Status</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($notifications as $index => $borrow)
                            <tr class="text-center">
                                <td>{{ $index + 1 }}</td>
                                <td class="text-start"><strong>{{ $borrow->book->title }}</strong></td>
                                <td>{{ $borrow->borrower }}</td>
                                <td>{{ \Carbon\Carbon::parse($borrow->borrow_date)->format('d M Y') }}</td>
                                <td class="text-danger fw-semibold">{{ \Carbon\Carbon::parse($borrow->due_date)->format('d M Y') }}</td>
                                <td>
                                    <span class="badge bg-warning text-dark">Segera Kembali</span>
                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            @else
                <div class="p-5 text-center">
                    <h5 class="mb-3 text-success">✅ Tidak Ada Notifikasi</h5>
                    <p class="mb-0 text-muted">Saat ini tidak ada buku yang mendekati tanggal jatuh tempo.</p>
                </div>
            @endif
        </div>
    </div>

    <div class="mt-4 text-start">
        <a href="{{ route('borrows.index') }}" class="btn btn-outline-primary">
            ← Kembali ke Daftar Peminjaman
        </a>
    </div>
</div>
@endsection
