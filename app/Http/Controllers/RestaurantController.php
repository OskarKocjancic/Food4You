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
    public function getReviewsApi(Request $request)
    {
        $restaurantApiId = $request->input('api_id');

        $reviews = Review::where('api_id', $restaurantApiId)->get();

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
        $review->vegan = boolval($request->input('vegan'));
        $review->vegetarian = boolval($request->input('vegetarian'));
        $review->halal = boolval($request->input('halal'));
        $review->kosher = boolval($request->input('kosher'));
        $review->glutenFree = boolval($request->input('glutenFree'));
        $review->studentDiscount = boolval($request->input('studentDiscount'));

        $review->save();
        $this->calculateScore($request);

        return back();
        // return response()->json($review);
    }
    public function addRestaurantIfAbsent(Request $request)
    {
        error_log($request->input('api_id'));
        $restaurant = Restaurant::where('api_id', $request->input('api_id'))->first();
        if ($restaurant) {
            return response()->json($restaurant);
        }
        $restaurant = new Restaurant();
        $restaurant->api_id = intval($request->input('api_id'));
        $restaurant->name = strval($request->input('name'));
        $restaurant->address = strval($request->input('address'));
        $restaurant->phone = '';
        $restaurant->rating = 0;
        $restaurant->price = 1;
        $restaurant->vegan = 0;
        $restaurant->vegetarian = 0;
        $restaurant->halal = 0;
        $restaurant->kosher = 0;
        $restaurant->glutenFree = 0;
        $restaurant->studentDiscount = 0;
        $restaurant->save();
        return response()->json($restaurant);
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
    public function calculateScore(Request $request)
    {
        $restaurantId = $request->input('id');
        $reviews = Review::where('restaurant_id', $restaurantId)->get();

        $score = [
            'vegan' => 0,
            'vegetarian' => 0,
            'halal' => 0,
            'kosher' => 0,
            'glutenFree' => 0,
            'studentDiscount' => 0,

        ];

        $sum = [
            'vegan' => 0,
            'vegetarian' => 0,
            'halal' => 0,
            'kosher' => 0,
            'glutenFree' => 0,
            'studentDiscount' => 0,

        ];

        foreach ($reviews as $review) {

            if ($review->vegan) {
                $score['vegan']++;
                $sum['vegan'] += $review->rating;
            }
            if ($review->vegetarian) {
                $score['vegetarian']++;
                $sum['vegan'] += $review->rating;
            }
            if ($review->halal) {
                $score['halal']++;
                $sum['vegan'] += $review->rating;
            }
            if ($review->kosher) {
                $score['kosher']++;
                $sum['vegan'] += $review->rating;
            }
            if ($review->glutenFree) {
                $score['glutenFree']++;
                $sum['vegan'] += $review->rating;
            }
            if ($review->studentDiscount) {
                $score['studentDiscount']++;
                $sum['vegan'] += $review->rating;
            }
        }

        $restaurant = Restaurant::find($restaurantId);
        $restaurant->vegan = $score['vegan'] != 0 ? $sum['vegan'] / $score['vegan'] : 0;
        $restaurant->vegetarian = $score['vegetarian'] != 0 ? $sum['vegetarian'] / $score['vegetarian'] : 0;
        $restaurant->halal = $score['halal'] != 0 ? $sum['halal'] / $score['halal'] : 0;
        $restaurant->kosher = $score['kosher'] != 0 ? $sum['kosher'] / $score['kosher'] : 0;
        $restaurant->glutenFree = $score['glutenFree'] != 0 ? $sum['glutenFree'] / $score['glutenFree'] : 0;
        $restaurant->studentDiscount = $score['studentDiscount'] != 0 ? $sum['studentDiscount'] / $score['studentDiscount'] : 0;
        $restaurant->save();
    }
}



