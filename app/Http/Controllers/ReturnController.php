<?php

namespace App\Http\Controllers;

use App\Models\Borrow;
use App\Models\ReturnBook;
use Illuminate\Http\Request;

class ReturnController extends Controller
{
    public function store(Request $request, $id)
    {
        $request->validate([
            'return_date' => 'required|date',
        ]);

        $borrow = Borrow::findOrFail($id);

        // Cek jika sudah dikembalikan
        if ($borrow->status == 'dikembalikan') {
            return back()->with('info', 'Buku sudah dikembalikan.');
        }

        ReturnBook::create([
            'borrow_id' => $borrow->id,
            'return_date' => $request->return_date,
        ]);

        $borrow->update(['status' => 'dikembalikan']);

        $borrow->book->increment('stock');

        return redirect()->route('borrows.index')->with('success', 'Pengembalian berhasil.');
    }
}
