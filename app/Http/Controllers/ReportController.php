<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class ReportController extends Controller
{
    public function index()
    {
        $borrows = \App\Models\Borrow::with('book')->get();
        return view('report.index', compact('borrows'));
    }
}
