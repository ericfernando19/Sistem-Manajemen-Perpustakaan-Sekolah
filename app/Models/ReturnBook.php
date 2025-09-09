<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ReturnBook extends Model
{
    use HasFactory;
    protected $fillable = [
        'borrow_id',
        'return_date',
    ];

    // Relasi ke model Borrowing
    public function borrowing()
    {
        return $this->belongsTo(Borrow::class, 'borrow_id');
    }
}
