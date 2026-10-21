<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Item; // Panggil Model Item

class ItemController extends Controller
{
    public function index()
    {
        // Ambil semua data barang dari database
        $items = Item::all();

        // Kirim data ke tampilan (view) bernama items.index
        return view('items.index', compact('items'));
    }
    public function search(Request $request)
{
    $keyword = $request->input('keyword');

    // Cari barang berdasarkan nama atau kategori
    $items = Item::where('name', 'LIKE', "%{$keyword}%")
                 ->orWhere('category', 'LIKE', "%{$keyword}%")
                 ->get();

    // Kembalikan data dalam bentuk JSON
    return response()->json($items);
}
}