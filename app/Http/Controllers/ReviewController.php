<?php

namespace App\Http\Controllers;

use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Routing\Controller as BaseController;
use App\Models\Review;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Restaurant; // Import the Restaurant model

class ReviewController extends BaseController
{
    use AuthorizesRequests, ValidatesRequests;

    public function getRestaurants(Request $request)
    {
        $restaurantName = $request->input('restaurantName');
        $restaurants = Restaurant::where('name', 'LIKE', '%' . $restaurantName . '%')->get();
        return response()->json($restaurants);
    }
    public function getReviews(Request $request)
    {
        $restaurantId = $request->input('id');

        $reviews = Review::where('restaurant_id', $restaurantId)->get();

        foreach ($reviews as $review) {
            $review->username = $review->user->username;
        }

        return response()->json($reviews);
    }
    public function addReview(Request $request)
    {
        $review = new Review();
        $review->user_id = Auth::user()->id;
        $review->restaurant_id = $request->input('id');
        $review->text = $request->input('text');
        $review->title = $request->input('title');
        $review->rating = $request->input('rating');
        $review->save();
        $this->calculateRating($request);

        return back();
        // return response()->json($review);
    }
    public function calculateRating(Request $request)
    {
        $restaurantId = $request->input('id');
        $reviews = Review::where('restaurant_id', $restaurantId)->get();
        $rating = 0;
        foreach ($reviews as $review) {
            $rating += $review->rating;
        }
        $rating = $rating / count($reviews);
        $restaurant = Restaurant::find($restaurantId);
        $restaurant->rating = $rating;
        $restaurant->save();

    }
}



