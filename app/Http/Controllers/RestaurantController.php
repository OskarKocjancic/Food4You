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
    use ValidatesRequests;


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

        $i = 1;
        foreach (array($price1, $price2, $price3) as $price) {
            if (!$price)
                $restaurants = $restaurants->where('price', '!=', $i);
            $i++;
        }



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
    public function getBestRatedRestaurants(Request $request)
    {

        $restaurants = Restaurant::orderBy('rating', 'desc')->take(10)->get();
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

    public function getReviewsApi(Request $request)
    {
        $restaurantApiId = $request->input('api_id');

        $reviews = Review::where('api_id', $restaurantApiId)->get();

        foreach ($reviews as $review) {
            $review->username = $review->user->username;
        }

        return response()->json($reviews);
    }
    public function getTopRestaurants(Request $request)
    {
        $restaurants = Restaurant::orderBy('rating', 'desc')->take(10)->get();
        return response()->json($restaurants);
    }
    public function addReview(Request $request)
    {
        $review = new Review();
        $review->user_id = Auth::user()->id;
        $review->restaurant_id = $request->input('id');
        $review->price = $request->input('price');
        $review->text = $request->input('text');
        $review->title = $request->input('title');

        $review->rating = $request->input('rating');
        $review->vegan = boolval($request->input('vegan'));
        $review->vegetarian = boolval($request->input('vegetarian'));
        $review->halal = boolval($request->input('halal'));
        $review->kosher = boolval($request->input('kosher'));
        $review->glutenFree = boolval($request->input('gluten-free'));
        $review->studentDiscount = boolval($request->input('student-discount'));

        $review->save();
        $this->calculateRating($request);
        $this->calculateScore($request);
        $this->calculatePrice($request);
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
        $restaurant->price = 0;
        $restaurant->vegan = 0;
        $restaurant->vegetarian = 0;
        $restaurant->halal = 0;
        $restaurant->kosher = 0;
        $restaurant->glutenFree = 0;
        $restaurant->studentDiscount = 0;
        $restaurant->lon = doubleval($request->input('lon'));
        $restaurant->lat = doubleval($request->input('lat'));
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
    public function calculatePrice(Request $request)
    {
        $restaurantId = $request->input('id');
        $reviews = Review::where('restaurant_id', $restaurantId)->get();

        $priceCounts = [
            1 => 0,
            2 => 0,
            3 => 0,
        ];

        foreach ($reviews as $review) {
            $price = $review->price;
            if (in_array($price, [1, 2, 3])) {
                $priceCounts[$price]++;
            }
        }

        $maxCount = max($priceCounts);
        $maxPrice = array_search($maxCount, $priceCounts);

        $restaurant = Restaurant::find($restaurantId);
        $restaurant->price = $maxPrice;
        $restaurant->save();
    }
    public function calculateScore(Request $request)
    {
        $restaurantId = $request->input('id');
        $reviews = Review::where('restaurant_id', $restaurantId)->get();

        $restaurant = Restaurant::find($restaurantId);
        $veganCount = $reviews->where('vegan', true)->count();
        $veganSum = $reviews->where('vegan', true)->sum('rating');
        $restaurant->vegan = $veganSum != 0 ? $veganSum / $veganCount : 0;

        $vegetarianCount = $reviews->where('vegetarian', true)->count();
        $vegetarianSum = $reviews->where('vegetarian', true)->sum('rating');
        $restaurant->vegetarian = $vegetarianSum != 0 ? $vegetarianSum / $vegetarianCount : 0;

        $halalCount = $reviews->where('halal', true)->count();
        $halalSum = $reviews->where('halal', true)->sum('rating');
        $restaurant->halal = $halalSum != 0 ? $halalSum / $halalCount : 0;

        $kosherCount = $reviews->where('kosher', true)->count();
        $kosherSum = $reviews->where('kosher', true)->sum('rating');
        $restaurant->kosher = $kosherSum != 0 ? $kosherSum / $kosherCount : 0;

        $glutenFreeCount = $reviews->where('glutenFree', true)->count();
        $glutenFreeSum = $reviews->where('glutenFree', true)->sum('rating');
        $restaurant->glutenFree = $glutenFreeSum != 0 ? $glutenFreeSum / $glutenFreeCount : 0;

        $studentDiscountCount = $reviews->where('studentDiscount', true)->count();
        $studentDiscountSum = $reviews->where('studentDiscount', true)->sum('rating');
        $restaurant->studentDiscount = $studentDiscountSum != 0 ? $studentDiscountSum / $studentDiscountCount : 0;
        $restaurant->save();
    }
    // public function calculateScore(Request $request)
    // {
    //     $restaurantId = $request->input('id');
    //     $reviews = Review::where('restaurant_id', $restaurantId)->get();

    //     $score = [
    //         'vegan' => 0,
    //         'vegetarian' => 0,
    //         'halal' => 0,
    //         'kosher' => 0,
    //         'glutenFree' => 0,
    //         'studentDiscount' => 0,

    //     ];

    //     $sum = [
    //         'vegan' => 0,
    //         'vegetarian' => 0,
    //         'halal' => 0,
    //         'kosher' => 0,
    //         'glutenFree' => 0,
    //         'studentDiscount' => 0,

    //     ];

    //     foreach ($reviews as $review) {

    //         if ($review->vegan) {
    //             $score['vegan']++;
    //             $sum['vegan'] += $review->rating;
    //         }
    //         if ($review->vegetarian) {
    //             $score['vegetarian']++;
    //             $sum['vegan'] += $review->rating;
    //         }
    //         if ($review->halal) {
    //             $score['halal']++;
    //             $sum['vegan'] += $review->rating;
    //         }
    //         if ($review->kosher) {
    //             $score['kosher']++;
    //             $sum['vegan'] += $review->rating;
    //         }
    //         if ($review->glutenFree) {
    //             $score['glutenFree']++;
    //             $sum['vegan'] += $review->rating;
    //         }
    //         if ($review->studentDiscount) {
    //             $score['studentDiscount']++;
    //             $sum['vegan'] += $review->rating;
    //         }
    //     }

    //     $restaurant = Restaurant::find($restaurantId);
    //     $restaurant->vegan = $score['vegan'] != 0 ? $sum['vegan'] / $score['vegan'] : 0;
    //     $restaurant->vegetarian = $score['vegetarian'] != 0 ? $sum['vegetarian'] / $score['vegetarian'] : 0;
    //     $restaurant->halal = $score['halal'] != 0 ? $sum['halal'] / $score['halal'] : 0;
    //     $restaurant->kosher = $score['kosher'] != 0 ? $sum['kosher'] / $score['kosher'] : 0;
    //     $restaurant->glutenFree = $score['glutenFree'] != 0 ? $sum['glutenFree'] / $score['glutenFree'] : 0;
    //     $restaurant->studentDiscount = $score['studentDiscount'] != 0 ? $sum['studentDiscount'] / $score['studentDiscount'] : 0;
    //     $restaurant->save();
    // }
}



