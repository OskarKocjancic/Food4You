@extends('layout')
@section('header-title', 'Food4You')
@section('title', 'Food4You')
@section('content')

    <link rel="stylesheet" href="<?php echo asset('main_page.css'); ?>" type="text/css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css"
        integrity="sha512-DTOQO9RWCH3ppGqcWaEA1BIZOC6xxalwEsw9c2QQeAIftl+Vegovlnee1c9QX4TctnWMn13TZye+giMm8e2LwA=="
        crossorigin="anonymous" referrerpolicy="no-referrer" />
    <div class="container-fluid ">
        <div class="row">
            <section class="d-inline-block p-3 col-12" id="top-rated">
                <div class="card">
                    <div class="card-body d-flex justify-content-between align-items-center">
                        <div class="card-body-title">Top rated restaurants</div>
                    </div>
                    <div class="card-body">
                        <div class="row">
                            <div class="col-3">
                                <div class="card">
                                    <div class="card-body">
                                        <div class="card-body-title">Restaurant name</div>
                                        <div class="card-body-content">
                                            <div class="card-body-content-item">Rating</div>
                                            <div class="card-body-content-item">Price</div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-3">
                                <div class="card">
                                    <div class="card-body">
                                        <div class="card-body-title">Restaurant name</div>
                                        <div class="card-body-content">
                                            <div class="card-body-content-item">Rating</div>
                                            <div class="card-body-content-item">Price</div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-3">
                                <div class="card">
                                    <div class="card-body">
                                        <div class="card-body-title">Restaurant name</div>
                                        <div class="card-body-content">
                                            <div class="card-body-content-item">Rating</div>
                                            <div class="card-body-content-item">Price</div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-3">
                                <div class="card">
                                    <div class="card-body">
                                        <div class="card-body-title">Restaurant name</div>
                                        <div class="card-body-content">
                                            <div class="card-body-content-item">Rating</div>
                                            <div class="card-body-content-item">Price</div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

            </section>
        </div>
        <div class="row ">
            <section class="d-inline-block p-3 col-2 " id="filters">
                <div class="filter mb-3">
                    <div class="filter-title">Price</div>
                    <div class="row filter-content ">
                        <div class="filter-content-item">
                            <input type="checkbox" id="price-1" name="price-1" value="1">
                            <label for="price-1">$</label>
                        </div>
                        <div class="filter-content-item">
                            <input type="checkbox" id="price-2" name="price-2" value="2">
                            <label for="price-2">$$</label>
                        </div>
                        <div class="filter-content-item">
                            <input type="checkbox" id="price-3" name="price-3" value="3">
                            <label for="price-3">$$$</label>
                        </div>

                    </div>
                </div>

                <div class="filter mb-3">
                    <div class="filter-title">Dietary requirements</div>
                    <div class="row filter-content ">
                        <div class="filter-content-item">
                            <i class="fas fa-leaf" title="Vegan" data-toggle="tooltip"></i>
                            <input type="range"
                                oninput="document.querySelector('#vegan-value').innerHTML = '≥'+this.value" min="0"
                                max="5" value="0" step="0.5" list="rating-ticks" id="vegan"
                                name="vegan" value="vegan">
                            <label id="vegan-value" for="vegan"></label>
                        </div>
                        <div class="filter-content-item">
                            <i class="fas fa-carrot" title="Vegetarian" data-toggle="tooltip"></i>
                            <input type="range"
                                oninput="document.querySelector('#vegetarian-value').innerHTML = '≥'+this.value"
                                min="0" max="5" value="0" step="0.5" list="rating-ticks"
                                id="vegetarian" name="vegetarian" value="vegetarian">
                            <label id="vegetarian-value" for="vegetarian"></label>
                        </div>
                        <div class="filter-content-item">
                            <i class="fa-solid fa-star-and-crescent" title="Halal" data-toggle="tooltip"></i>
                            <input type="range"
                                oninput="document.querySelector('#halal-value').innerHTML = '≥'+this.value" min="0"
                                max="5" value="0" step="0.5" list="rating-ticks" id="halal"
                                name="halal" value="halal">
                            <label id="halal-value" for="halal"></label>
                        </div>
                        <div class="filter-content-item">
                            <i class="fas fa-star-of-david" title="Kosher" data-toggle="tooltip"></i>
                            <input type="range"
                                oninput="document.querySelector('#kosher-value').innerHTML = '≥'+this.value"
                                min="0" max="5" value="0" step="0.5" list="rating-ticks"
                                id="kosher" name="kosher" value="kosher">
                            <label id="kosher-value" for="kosher"></label>
                        </div>
                        <div class="filter-content-item">
                            <i class="fas fa-bread-slice" title="Gluten-free" data-toggle="tooltip"></i>
                            <input type="range"
                                oninput="document.querySelector('#gluten-free-value').innerHTML = '≥'+this.value"
                                min="0" max="5" value="0" step="0.5" list="rating-ticks"
                                id="gluten-free" name="gluten-free" value="gluten-free">
                            <label id="gluten-free-value" for="gluten-free"></label>
                        </div>
                        <span class="mb-3"></span>
                        <div class="filter-content-item">
                            <i class="fa-solid fa-graduation-cap" title="Student discount" data-toggle="tooltip"></i>
                            <input type="range"
                                oninput="document.querySelector('#student-discount-value').innerHTML = '≥'+this.value"
                                min="0" max="5" value="0" step="0.5" list="rating-ticks"
                                id="student-discount" name="student-discount" value="student-discount">
                            <label id="student-discount-value" for="student-discount"></label>
                        </div>
                    </div>
                </div>

                <div class="filter mb-3">
                    <div class="filter-title">Rating</div>
                    <div class="row filter-content ">
                        <div class="filter-content-item">
                            <input oninput="document.querySelector('#rating-value').innerHTML = '≥'+this.value"
                                class="col-8"type="range" id="rating" name="rating" min="0" max="5"
                                value="0" step="0.5" list="rating-ticks">
                            <datalist id="rating-ticks">
                                <option value="1">
                                <option value="2">
                                <option value="3">
                                <option value="4">
                                <option value="5">
                            </datalist>
                            <span class="col-2" id="rating-value">&GreaterEqual;5</span>
                        </div>
                    </div>
                </div>
                <div class="filter">
                    <button class="btn btn-primary"
                        onclick="getRestaurants(document.querySelector('#search-bar-input').value)">Apply Filters</button>
                </div>
            </section>


            <section class="d-inline-block p-3 col-8 " id="restaurant-finder">
                <div class="col-12" id="search-bar">
                    <div class="input-group">
                        <input type="text" class="form-control" id="search-bar-input"
                            placeholder="Find a place to eat" aria-label="Find a place to eat"
                            aria-describedby="button-addon2">
                    </div>
                </div>

                <div class="col-12 p-3 " id="restaurants">
                </div>

                <div class="col-12 h-10 d-flex justify-content-start align-items-center gap-1 " id="pagination"></div>
            </section>

        </div>



    </div>

    <div class="review-overlay p-4">
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
            <div class="input-group">

            </div>
            <input class="btn btn-secondary" type="submit" value="Leave review">
        </form>
        <button id="close-button" class="btn btn-primary" onclick="this.parentNode.style.display = 'none'">Exit</button>
        <div class="review-card-container col-6">
        </div>

    </div>

    <script>
        const RESTAURANTS_PER_PAGE = 5;

        function createRestaurantDiv(restaurant) {
            document.createElement("div");
            let restaurantDiv = document.createElement("div");
            restaurantDiv.classList.add("restaurant-card");
            restaurantDiv.innerHTML = `
                            <div class="restaurant-name">${restaurant.name}</div>
                            <div class="restaurant-score">${restaurant.rating}</div>
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
            return restaurantDiv;
        }

        function getRestaurants(query, from = 0, to = RESTAURANTS_PER_PAGE) {
            fetch('/get-restaurants', {
                    method: 'POST',
                    headers: {
                        'Content-Type': 'application/json',
                        'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content
                    },
                    body: JSON.stringify({
                        restaurantName: query,
                        from: from,
                        to: to,
                        price1: document.querySelector("#price-1").checked,
                        price2: document.querySelector("#price-2").checked,
                        price3: document.querySelector("#price-3").checked,
                        rating: document.querySelector("#rating").value,
                        vegan: document.querySelector("#vegan").value,
                        vegetarian: document.querySelector("#vegetarian").value,
                        halal: document.querySelector("#halal").value,
                        kosher: document.querySelector("#kosher").value,
                        glutenFree: document.querySelector("#gluten-free").value,
                        studentDiscount: document.querySelector("#student-discount").value,

                    })
                })
                .then(response => response.json())
                .then(data => {
                    console.log(data);
                    let restaurantsDiv = document.querySelector("#restaurants");
                    restaurantsDiv.innerHTML = "";

                    generatePagination(data.length);
                    console.log(data.length);
                    data.forEach(restaurant => {
                        let restaurantDiv = createRestaurantDiv(restaurant);
                        restaurantsDiv.appendChild(restaurantDiv);
                    });
                });



        }

        function generatePagination(numberOfRestaurants, restaurantsPerPage = RESTAURANTS_PER_PAGE) {
            let paginationDiv = document.querySelector("#pagination");
            paginationDiv.innerHTML = "";
            for (let i = 0; i <= numberOfRestaurants; i += restaurantsPerPage) {
                let pageButton = document.createElement("button");
                pageButton.classList.add("page");
                pageButton.classList.add("btn");
                pageButton.classList.add("btn-secondary");
                console.log(i);
                pageButton.innerHTML = i / restaurantsPerPage + 1;
                pageButton.addEventListener("click", () => {
                    getRestaurants(document.querySelector("#search-bar-input").value, i, i + restaurantsPerPage);
                });
                paginationDiv.appendChild(pageButton);
            }
        }




        let searchBar = document.querySelector("#search-bar-input");
        let filters = document.querySelector("#filters");
        let topRated = document.querySelector("#top-rated");
        searchBar.addEventListener("input", (e) => {
            if (searchBar.value == "") {
                topRated.classList.remove("d-none");
                document.querySelector("#pagination").innerHTML = "";
                document.querySelector("#restaurants").innerHTML = "";
            } else {
                getRestaurants(e.target.value);
                topRated.classList.add("d-none");

            }
        });
    </script>
@endsection
