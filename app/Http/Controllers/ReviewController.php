<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\Review;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ReviewController extends Controller
{
    public function store(Request $request, Product $product)
    {
        $request->validate([
            'rating' => 'required|integer|min:1|max:5',
            'comment' => 'nullable|string|max:1000',
        ]);

        $product->reviews()->create([
            'user_id' => Auth::id(),
            'rating' => $request->rating,
            'comment' => $request->comment,
        ]);

        // Update product statistics
        $this->updateProductStats($product);

        return back()->with('success', '¡Gracias por tu comentario!');
    }

    public function destroy(Review $review)
    {
        $product = $review->product;
        $review->delete();

        // Update product statistics after deletion
        $this->updateProductStats($product);

        return back()->with('success', 'Reseña eliminada correctamente.');
    }

    protected function updateProductStats(Product $product)
    {
        $reviews = $product->reviews();
        $count = $reviews->count();
        $avg = $reviews->avg('rating');

        $product->update([
            'rating' => $avg,
            'reviews_count' => $count,
        ]);
    }
}
