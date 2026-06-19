<?php

namespace App\Http\Controllers;

use App\Models\Review;
use App\Models\Reservasi;
use Illuminate\Http\Request;

class ReviewController extends Controller
{
    /**
     * Display a listing of reviews.
     */
    public function index()
    {
        $reviews = Review::with([
            'reservasi.pelanggan.user',
            'reservasi.kamar'
        ])
        ->latest('id_review')
        ->paginate(10);

        return view('pages.review.index', compact('reviews'));
    }

    /**
     * Show form create review.
     */
    public function create()
    {
        $reservasi = Reservasi::with([
            'pelanggan.user',
            'kamar'
        ])
        ->where('status_reservasi', 'checkout')
        ->whereDoesntHave('review')
        ->orderByDesc('id_reservasi')
        ->get();

        return view('pages.review.create', compact('reservasi'));
    }

    /**
     * Store review.
     */
    public function store(Request $request)
    {
        $data = $request->validate([
            'id_reservasi' => 'required|exists:reservasi,id_reservasi',
            'rating'       => 'required|integer|min:1|max:5',
            'komentar'     => 'nullable|string|max:1000',
        ]);

        Review::create($data);

        return redirect()
            ->route('review.index')
            ->with('success', 'Review berhasil ditambahkan.');
    }

    /**
     * Display review detail.
     */
    public function show($id)
    {
        $review = Review::with([
            'reservasi.pelanggan.user',
            'reservasi.kamar'
        ])->findOrFail($id);

        return view('pages.review.show', compact('review'));
    }

    /**
     * Show form edit review.
     */
    public function edit($id)
{
    $review = Review::findOrFail($id);

    $reservasi = Reservasi::with('pelanggan')->get();

    return view('pages.review.edit', compact('review', 'reservasi'));
}

    /**
     * Update review.
     */
    public function update(Request $request, $id)
    {
        $review = Review::findOrFail($id);

        $data = $request->validate([
            'rating'   => 'required|integer|min:1|max:5',
            'komentar' => 'nullable|string|max:1000',
        ]);

        $review->update($data);

        return redirect()
            ->route('review.index')
            ->with('success', 'Review berhasil diperbarui.');
    }

    /**
     * Delete review.
     */
    public function destroy($id)
    {
        $review = Review::findOrFail($id);

        $review->delete();

        return redirect()
            ->route('review.index')
            ->with('success', 'Review berhasil dihapus.');
    }
}
