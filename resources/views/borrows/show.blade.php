@extends('layouts.app')

@section('content')
<div class="container py-5">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card shadow-sm border-0">
                <div class="card-header bg-info text-white">
                    <h4 class="mb-0">📖 Detail Peminjaman</h4>
                </div>
                <div class="card-body">
                    <ul class="list-group list-group-flush">
                        <li class="list-group-item">
                            <strong>📚 Judul Buku:</strong> {{ $borrow->book->title }}
                        </li>
                        <li class="list-group-item">
                            <strong👤 Peminjam:</strong> {{ $borrow->user->name }}
                        </li>
                        <li class="list-group-item">
                            <strong>📅 Tanggal Pinjam:</strong> {{ \Carbon\Carbon::parse($borrow->borrow_date)->format('d M Y') }}
                        </li>
                        <li class="list-group-item">
                            <strong>📅 Tanggal Kembali:</strong>
                            {{ $borrow->return_date ? \Carbon\Carbon::parse($borrow->return_date)->format('d M Y') : '-' }}
                        </li>
                        <li class="list-group-item">
                            <strong>🔖 Status:</strong> {{ $borrow->status }}
                        </li>
                    </ul>
                </div>
            </div>

            <div class="text-center mt-4">
                <a href="{{ route('borrows.index') }}" class="btn btn-outline-primary">
                    ← Kembali ke Daftar Peminjaman
                </a>
            </div>
        </div>
    </div>
</div>
@endsection
