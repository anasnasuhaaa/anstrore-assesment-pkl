<?php

namespace App\Http\Controllers;

use Throwable;
use App\Models\Review;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

class ReviewController extends Controller
{
    //
    public function index(string $id)
    {
        // $review = new Review();
        $product = Product::find($id);

        return view('pages.orderlist.review', compact('product'));
    }
    public function store(Request $request, string $id)
    {

        $request->validate([
            'rating' => 'required',
            'review' => 'required',
        ]);

        $review = new Review();
        $review->rating = $request->input('rating');
        $review->review = $request->input('review');
        $review->user_id = auth()->user()->id;
        $review->product_id = $id;

        $review->save();
        return redirect()->route('product.detail', $id)->with('message-success-review', 'Berhasil menambahkan ulasan');
    }

    // public function store(Request $request, string $id)
    // {
    //     try {
    //         $request->validate([
    //             'rating' => 'required',
    //             'review' => 'required',
    //         ]);

    //         $review = new Review();
    //         $review->rating = $request->input('rating');
    //         $review->review = $request->input('review');
    //         $review->user_id = auth()->user()->id;
    //         $review->product_id = $id;

    //         $review->save();

    //         return redirect()->route('product.detail', $id)->with('message-success-review', 'Berhasil menambahkan ulasan');
    //     } catch (Throwable $err) {
    //         Log::error($err); // Log the error for debugging purposes
    //         return back()->withErrors(['error' => 'An error occurred. Please try again.']);
    //     }
    // }
}
