<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\BorrowRecord;
use App\Models\Item;

class BorrowController extends Controller
{
    // Menyimpan data peminjaman baru
    public function store(Request $request)
    {
        $request->validate([
            'item_id' => 'required|exists:items,id',
            'borrow_date' => 'required|date',
            'return_date' => 'required|date|after_or_equal:borrow_date',
            'notes' => 'nullable|string',
        ]);

        // Simpan ke database (sementara user_id di-set 1 atau sesuai user yang login)
        BorrowRecord::create([
            'user_id' => 1, // Nanti bisa diganti dengan auth()->id() jika sudah pakai login
            'item_id' => $request->item_id,
            'borrow_date' => $request->borrow_date,
            'return_date' => $request->return_date,
            'status' => 'pending',
            'notes' => $request->notes,
        ]);

        return redirect()->route('items.index')->with('success', 'Pengajuan peminjaman berhasil dikirim!');
    }
    public function history()
{
    // Ambil data riwayat peminjaman beserta relasi ke tabel item dan user
    $borrowRecords = BorrowRecord::with(['item', 'user'])->latest()->get();

    return view('borrow.history', compact('borrowRecords'));
}
}