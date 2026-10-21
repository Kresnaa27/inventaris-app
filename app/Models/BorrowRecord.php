<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class BorrowRecord extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'item_id',
        'borrow_date',
        'return_date',
        'status',
        'notes',
    ];
    // Tambahkan relasi ke Item ini:
    public function item()
    {
        return $this->belongsTo(Item::class);
    }

    // Tambahkan relasi ke User ini:
    public function user()
    {
        return $this->belongsTo(User::class);
    }
}