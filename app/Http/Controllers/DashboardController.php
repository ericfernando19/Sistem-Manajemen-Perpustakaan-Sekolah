<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function index()
    {
        return view('dashboard', [
            'total_books' => \App\Models\Book::count(),
            'total_borrows' => \App\Models\Borrow::where('status', 'dipinjam')->count(),
            'total_returns' => \App\Models\Borrow::where('status', 'dikembalikan')->count(),
        ]);
    }

}
