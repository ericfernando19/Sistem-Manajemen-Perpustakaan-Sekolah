<?php

namespace App\Http\Controllers;

use App\Models\Borrow;
use App\Models\Book;
use Illuminate\Http\Request;
use Carbon\Carbon;

class BorrowController extends Controller
{
    public function index()
    {
        $borrows = Borrow::with('book')->get();

        // Hitung jumlah buku yang mendekati jatuh tempo (3 hari ke depan dan belum dikembalikan)
        $dueSoonCount = Borrow::where('status', 'dipinjam')
            ->whereDate('due_date', '<=', Carbon::today()->addDays(3))
            ->count();

        // Kirim juga data peminjaman yang jatuh tempo untuk ditampilkan di modal
        $dueSoonBorrows = Borrow::with('book')
            ->where('status', 'dipinjam')
            ->whereDate('due_date', '<=', Carbon::today()->addDays(3))
            ->get();

        return view('borrows.index', compact('borrows', 'dueSoonCount', 'dueSoonBorrows'));
    }

    public function create()
    {
        $books = Book::where('stock', '>', 0)->get();
        return view('borrows.create', compact('books'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'book_id' => 'required|exists:books,id',
            'borrower' => 'required',
            'borrow_date' => 'required|date',
            'due_date' => 'required|date|after_or_equal:borrow_date',
        ]);

        $book = Book::find($request->book_id);
        if ($book->stock < 1) {
            return back()->with('error', 'Stok buku tidak mencukupi.');
        }

        Borrow::create([
            'book_id' => $request->book_id,
            'borrower' => $request->borrower,
            'borrow_date' => $request->borrow_date,
            'due_date' => $request->due_date,
            'status' => 'dipinjam',
        ]);

        $book->decrement('stock');

        return redirect()->route('borrows.index')->with('success', 'Peminjaman berhasil.');
    }
    public function notifications()
    {
        $today = Carbon::today();

        $notifications = Borrow::with('book')
            ->where('status', 'dipinjam')
            ->whereDate('due_date', '>=', $today)
            ->get()
            ->filter(function ($borrow) use ($today) {
                $daysLeft = $today->diffInDays(Carbon::parse($borrow->due_date), false);
                return $daysLeft <= 3 && $daysLeft >= 0;
            });

        return view('borrows.notifications', compact('notifications'));
    }
    public function show($id)
    {
        $borrow = Borrow::with('book', 'user')->findOrFail($id);
        return view('borrows.show', compact('borrow'));
    }

}
