@extends('layout')
@section('header-title', 'Food4You')
@section('title', 'Food4You')
@section('content')

    <link rel="stylesheet" href="<?php echo asset('main_page.css'); ?>" type="text/css">



    <div class="container mt-3">
        <div class="row align-items-center">
            <div class="col-md-3 d-none d-md-block">
                <!-- Add the logo only on medium screens and above -->
                <img src="{{ asset('images/logo.png') }}" class="img-fluid d-md-block" alt="Logo">
            </div>
            <div class="col-md-9">
                <div id="search-bar">
                    <div class="bold-text" style="font-family: 'Josefin Sans', sans-serif;">Find restaurants with meals for your special diet!</div>
                    <div class="input-group mb-3 mt-3">
                        <input type="text" class="form-control" placeholder="Search for restaurants"
                            aria-label="Search for restaurants" aria-describedby="button-addon2">
                    </div>
                </div>
                <div class="restaurants">
                    {{-- when updating this also update in the  --}}
                    <div class="restaurant-card"></div>
                </div>

                <div class="review-overlay p-4">
                    <div class="review-card-container col-6">
                    </div>
                    <h1>Leave a review:</h1>
                    <form class="review-form col-6" action="/add-review" method="GET">
                        <div class="mb-3">
                            <label for="exampleFormControlInput1" class="form-label">Title</label>
                            <input type="text" class="form-control" name="title" placeholder="Title">
                        </div>
                        <div class="mb-3">
                            <label for="exampleFormControlTextarea1" class="form-label">Review</label>
                            <textarea class="form-control" name="text" rows="3"></textarea>
                        </div>
                        <div class="mb-3">
                            <label for="exampleFormControlInput1" class="form-label">Rating</label>
                            <input type="number" class="form-control" name="rating" placeholder="Rating">
                        </div>
                        <input type="hidden" name="id">
                        <input class="btn btn-secondary" type="submit" value="Leave review">
                    </form>

                    <button id="close-button" class="btn btn-primary"
                        onclick="this.parentNode.style.display = 'none'" style="background-color: #0F4C5F; border-color:#0F4C5F">Exit</button>

                </div>
            </div>
        </div>
    </div>




    <script>
        function getRestaurants(query) {
            fetch('/get-restaurants', {
                    method: 'POST',
                    headers: {
                        'Content-Type': 'application/json',
                        'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content
                    },
                    body: JSON.stringify({
                        restaurantName: query,
                    })
                })
                .then(response => response.json())
                .then(data => {
                    console.log(data);
                    let restaurantsDiv = document.querySelector(".restaurants");
                    restaurantsDiv.innerHTML = "";
                    data.forEach(restaurant => {
                        let restaurantDiv = document.createElement("div");
                        restaurantDiv.classList.add("restaurant-card");
                        restaurantDiv.innerHTML = `
                            <div class="bold-text" >${restaurant.name}</div>
                            <div class="restaurant-score">${restaurant.rating}</div>
                            <hr class="horizontal-line">
                        `;

                        restaurantDiv.addEventListener("click", () => {
                            fetch('/get-reviews', {
                                    method: 'POST',
                                    headers: {
                                        'Content-Type': 'application/json',
                                        'X-CSRF-TOKEN': document.querySelector(
                                                'meta[name="csrf-token"]')
                                            .content
                                    },
                                    body: JSON.stringify({
                                        id: restaurant.id,
                                    })
                                }).then(response => response.json())
                                .then(data => {
                                    console.log(data);


                                    let reviewOverlay = document.querySelector(
                                        ".review-overlay");
                                    reviewOverlay.style.display = "flex";
                                    let reviewsDiv = document.querySelector(
                                        ".review-card-container");

                                    reviewsDiv.innerHTML = "";
                                    document.querySelector("input[name='id']").value =
                                        restaurant.id;

                                    data.forEach(review => {

                                        let reviewDiv = document.createElement(
                                            "div");
                                        reviewDiv.classList.add(
                                            "review-card");


                                        let userDiv = document.createElement(
                                            "div");

                                        userDiv.classList.add("review-card-user");
                                        userDiv.innerHTML = review.username;
                                        reviewDiv.appendChild(userDiv);

                                        // Add review title
                                        let titleDiv = document.createElement(
                                            "div");
                                        titleDiv.classList.add(
                                            "review-card-title");
                                        titleDiv.innerHTML = review.title;
                                        reviewDiv.appendChild(titleDiv);

                                        // Add review text
                                        let textDiv = document.createElement("div");
                                        textDiv.innerHTML = review.text;
                                        textDiv.classList.add(
                                            "review-card-text");
                                        reviewDiv.appendChild(textDiv);

                                        // Add review score
                                        let scoreDiv = document.createElement(
                                            "div");
                                        scoreDiv.innerHTML = review.rating;
                                        scoreDiv.classList.add(
                                            "review-card-score");
                                        reviewDiv.appendChild(scoreDiv);

                                        reviewsDiv.appendChild(reviewDiv);



                                    });
                                })

                        });


                        restaurantsDiv.appendChild(restaurantDiv);
                    });
                });



        }

        let searchBar = document.querySelector("#search-bar");
        searchBar.addEventListener("keyup", (e) => {
            getRestaurants(e.target.value);
        });
        document.onload = getRestaurants("");
    </script>
@endsection
