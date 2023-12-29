<?php

namespace App\Http\Controllers;

use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Routing\Controller as BaseController;
use App\Models\Review;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Restaurant; // Import the Restaurant model

class RestaurantController extends BaseController
{
    use AuthorizesRequests, ValidatesRequests;


    public function getNumberOfRestaurants(Request $request)
    {
        $count = count(Restaurant::get());
        return response()->json($count);
    }
    public function getRestaurants(Request $request)
    {
        $restaurantName = $request->input('restaurantName');
        $from = $request->input('from');
        $to = $request->input('to');
        $price1 = $request->input('price1');
        $price2 = $request->input('price2');
        $price3 = $request->input('price3');
        $rating = $request->input('rating');
        $vegan = $request->input('vegan');
        $vegetarian = $request->input('vegetarian');
        $halal = $request->input('halal');
        $kosher = $request->input('kosher');
        $glutenFree = $request->input('glutenFree');
        $studentDiscount = $request->input('studentDiscount');

        $restaurants = Restaurant::where('name', 'LIKE', '%' . $restaurantName . '%');

        $tmp = Restaurant::where('name', 'LIKE', '%skdfdfgmlsmlkdg%');
        $i = 1;
        foreach (array($price1, $price2, $price3) as $price) {

            if ($price)
                $tmp = $tmp->union($restaurants->where('price', '=', $i));
            $i++;
        }
        if ($tmp->count() > 0)
            $restaurants = $tmp;



        $restaurants = $restaurants->where('rating', '>=', $rating)
            ->where('vegan', '>=', $vegan)
            ->where('vegetarian', '>=', $vegetarian)
            ->where('halal', '>=', $halal)
            ->where('kosher', '>=', $kosher)
            ->where('glutenFree', '>=', $glutenFree)
            ->where('studentDiscount', '>=', $studentDiscount);

        if ($to !== -1) {
            $restaurants = $restaurants->skip($from)->take($to);
        }

        return response()->json($restaurants->get());
    }


    //     if ($to !== -1)
    //         $restaurants = Restaurant::where('name', 'LIKE', '%' . $restaurantName . '%')->skip($from)->take($to)->get();
    //     else
    //         $restaurants = Restaurant::where('name', 'LIKE', '%' . $restaurantName . '%')->get();



    //     return response()->json($restaurants);
    // }


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



