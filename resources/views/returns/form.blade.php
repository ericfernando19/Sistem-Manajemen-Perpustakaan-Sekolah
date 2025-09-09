@extends('layouts.app')

@section('content')
<h2>Pengembalian Buku</h2>
<form method="POST" action="{{ route('returns.store', $borrow->id) }}">
    @csrf
    <label>Tanggal Kembali: <input type="date" name="return_date" required></label><br>
    <button type="submit">Kembalikan</button>
</form>
@endsection
