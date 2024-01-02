@extends('layout')
@section('header-title', 'Food4You')
@section('title', 'Food4You')
@section('content')

    <link rel="stylesheet" href="<?php echo asset('main_page.css'); ?>" type="text/css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css"
        integrity="sha512-DTOQO9RWCH3ppGqcWaEA1BIZOC6xxalwEsw9c2QQeAIftl+Vegovlnee1c9QX4TctnWMn13TZye+giMm8e2LwA=="
        crossorigin="anonymous" referrerpolicy="no-referrer" />
    <script src="https://code.jquery.com/jquery-3.7.1.min.js"
        integrity="sha256-/JqT3SQfawRcv/BIHPThkBvs0OEvtFFmqPF/lYI/Cxo=" crossorigin="anonymous"></script>
    <script src="{{ asset('OpenLayers.js') }}"></script>

    <div class="container-fluid h-100 d-flex flex-column">
        <div class="row flex-grow-0 d-flex flex-row">
            <section class="p-3 col-12 collapse show" id="top-rated">
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
        <div class="row flex-grow-1 d-flex flex-row justify-content-start">
            <section class="col-2 collapse card p-3" id="filters">
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
                            <div class="input-group gap-3 justify-content-between">
                                <i class="fas fa-leaf" title="Vegan" data-toggle="tooltip"></i>
                                <input class="flex-grow-1" type="range" min="0" max="5" value="0"
                                    step="0.5" list="rating-ticks" id="vegan" name="vegan" value="vegan"
                                    oninput="updateValue('vegan', 'vegan-value')">
                                <label id="vegan-value" for="vegan">&GreaterEqual;0.0</label>
                            </div>
                        </div>
                        <div class="filter-content-item">
                            <div class="input-group gap-3 justify-content-between">
                                <i class="fas fa-carrot" title="Vegetarian" data-toggle="tooltip"></i>
                                <input class="flex-grow-1" type="range" min="0" max="5" value="0"
                                    step="0.5" list="rating-ticks" id="vegetarian" name="vegetarian"
                                    value="vegetarian" oninput="updateValue('vegetarian', 'vegetarian-value')">
                                <label id="vegetarian-value" for="vegetarian">&GreaterEqual;0.0</label>
                            </div>
                        </div>
                        <div class="filter-content-item">
                            <div class="input-group gap-3 justify-content-between">
                                <i class="fa-solid fa-star-and-crescent" title="Halal" data-toggle="tooltip"></i>
                                <input class="flex-grow-1" type="range" min="0" max="5" value="0"
                                    step="0.5" list="rating-ticks" id="halal" name="halal" value="halal"
                                    oninput="updateValue('halal', 'halal-value')">
                                <label id="halal-value" for="halal">&GreaterEqual;0.0</label>
                            </div>
                        </div>
                        <div class="filter-content-item">
                            <div class="input-group gap-3 justify-content-between">
                                <i class="fas fa-star-of-david" title="Kosher" data-toggle="tooltip"></i>
                                <input class="flex-grow-1" type="range" min="0" max="5" value="0"
                                    step="0.5" list="rating-ticks" id="kosher" name="kosher" value="kosher"
                                    oninput="updateValue('kosher', 'kosher-value')">
                                <label id="kosher-value" for="kosher">&GreaterEqual;0.0</label>
                            </div>
                        </div>
                        <div class="filter-content-item">
                            <div class="input-group gap-3 justify-content-between">
                                <i class="fas fa-bread-slice" title="Gluten-free" data-toggle="tooltip"></i>
                                <input class="flex-grow-1" type="range" min="0" max="5" value="0"
                                    step="0.5" list="rating-ticks" id="gluten-free" name="gluten-free"
                                    value="gluten-free" oninput="updateValue('gluten-free', 'gluten-free-value')">
                                <label id="gluten-free-value" for="gluten-free">&GreaterEqual;0.0</label>
                            </div>
                        </div>
                        <span class="mb-3"></span>
                        <div class="filter-content-item">
                            <div class="input-group gap-3 justify-content-between">
                                <i class="fa-solid fa-graduation-cap" title="Student discount" data-toggle="tooltip"></i>
                                <input class="flex-grow-1" type="range" min="0" max="5" value="0"
                                    step="0.5" list="rating-ticks" id="student-discount" name="student-discount"
                                    value="student-discount"
                                    oninput="updateValue('student-discount', 'student-discount-value')">
                                <label id="student-discount-value" for="student-discount">&GreaterEqual;0.0</label>
                            </div>
                        </div>
                    </div>

                    <div class="filter mb-3">
                        <div class="filter-title">Rating</div>
                        <div class="row filter-content">
                            <div class="filter-content-item">
                                <div class="input-group gap-3 justify-content-between">
                                    <i class="fa-solid fa-star"></i>
                                    <input class="flex-grow-1" oninput="updateValue('rating', 'rating-value')"
                                        class="col-8"type="range" id="rating" name="rating" min="0"
                                        max="5" value="0" step="0.5" list="rating-ticks">
                                    <span class="col-2" id="rating-value">&GreaterEqual;0.0</span>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="filter">
                    <button id="filter-apply-button" class="btn btn-primary">Apply Filters</button>
                </div>
                <datalist id="rating-ticks">
                    <option value="1">
                    <option value="2">
                    <option value="3">
                    <option value="4">
                    <option value="5">
                </datalist>
            </section>

            <section class="p-3 col-12 col-3 p-3 d-flex flex-column" id="restaurant-finder">
                <div class="col-12 mb-3" id="search-bar">
                    <div class="input-group">
                        <input type="text" class="form-control" id="search-bar-input"
                            placeholder="Find a place to eat" aria-label="Find a place to eat"
                            aria-describedby="button-addon2" value="belvedur">
                    </div>
                </div>

                <div class="col-12 p-1 " id="restaurants"></div>

                <div class="col-12 h-10 d-flex justify-content-start align-items-center gap-1 " id="pagination"></div>
            </section>

            <section id="map" tabindex="2"
                class="col-7 h-100 leaflet-container leaflet-touch leaflet-fade-anim leaflet-grab leaflet-touch-drag leaflet-touch-zoom"                >
            </section>
        </div>



    </div>

    <div class="review-overlay p-4">

        <div class="row w-100">
            <form class="col-6 d-flex flex-column justify-content-center align-content-center" id="review-form"
                action="/add-review" method="GET">
                <div class="mb-3">
                    <label for="exampleFormControlInput1" class="form-label">Title</label>
                    <input type="text" class="form-control" name="title" placeholder="Title">
                </div>
                <div class="mb-3">
                    <label for="exampleFormControlTextarea1" class="form-label">Review</label>
                    <textarea class="form-control" name="text" rows="3"></textarea>
                </div>

                <div class="mb-3">
                    <div for="exampleFormControlInput1" class="form-label">Avaiable options</div>
                    <div class="input-group justify-content-start gap-3">


                        <input type="checkbox" id="vegan" name="vegan" value="vegan">
                        <i class="fas fa-leaf"></i>


                        <input type="checkbox" id="vegetarian" name="vegetarian" value="vegetarian">
                        <i class="fas fa-carrot"></i>


                        <input type="checkbox" id="halal" name="halal" value="halal">
                        <i class="fas fa-mosque"></i>


                        <input type="checkbox" id="kosher" name="kosher" value="kosher">
                        <i class="fas fa-star-of-david"></i>


                        <input type="checkbox" id="gluten-free" name="gluten-free" value="gluten-free">
                        <i class="fas fa-bread-slice"></i>


                        <input type="checkbox" id="student-discount" name="student-discount" value="student-discount">
                        <i class="fas fa-graduation-cap"></i>

                    </div>

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
            <div class="col-6" id="review-card-container">

            </div>
        </div>
        <button id="close-button" class="btn btn-primary" onclick="this.parentNode.style.display = 'none'">Exit</button>

    </div>
    <script src="https://unpkg.com/leaflet/dist/leaflet.js"></script>
    <script>
        async function accessOpenStreetMapsAPI(query) {
            return fetch(`https://nominatim.openstreetmap.org/search?q=${query}&format=json&limit=` +
                    RESTAURANTS_PER_PAGE)
                .then(response => response.json())
                .then(data => Promise.all(data.map(restaurant => {
                    console.log(restaurant);
                    let address = restaurant.display_name.split(",");
                    let name = address[0];
                    let street = address[2] + " " + address[1];
                    let city = address[5];
                    let country = address[7];
                    restaurant.name = name;
                    restaurant.street = street;
                    restaurant.city = city;
                    restaurant.country = country;
                    restaurant.full_address = name + "," + street + "," + city + "," + country;
                    console.log(restaurant.full_address);
                    return fetch('/add-restaurant', {
                        method: 'POST',
                        headers: {
                            'Content-Type': 'application/json',
                            'X-CSRF-TOKEN': document.querySelector(
                                'meta[name="csrf-token"]').content
                        },
                        body: JSON.stringify({
                            api_id: restaurant.osm_id,
                            name: restaurant.name,
                            address: restaurant.full_address,
                        })
                    }).then(response => response.json())
                })))
        }
        async function getRestaurants(query, from = 0, to = RESTAURANTS_PER_PAGE) {
            return await fetch('/get-restaurants', {
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

                    let restaurantsDiv = document.querySelector("#restaurants");
                    restaurantsDiv.innerHTML = "";
                    let i = 0;

                    return data;
                });



        }

        function updateValue(inputId, labelId) {
            const input = document.querySelector(`#${inputId}`);
            const label = document.querySelector(`#${labelId}`);
            label.innerHTML = `&GreaterEqual;${Number(input.value).toFixed(1)}`;

            if (Number(input.value) === 0) {
                label.parentNode.style.opacity = 0.5;
            } else {
                label.parentNode.style.opacity = 1;
            }
        }

        function createRestaurantDiv(restaurant) {

            let restaurantsDiv = document.querySelector("#restaurants");
            let restaurantDiv = document.createElement("div");
            restaurantDiv.classList.add("card");
            let restaurantBodyDiv = document.createElement("div");
            restaurantBodyDiv.classList.add("card-body");
            restaurantDiv.appendChild(restaurantBodyDiv);
            // let address = restaurant.street + "," + restaurant.city + "," + restaurant.country;
            restaurantBodyDiv.innerHTML = `
                            <div class="restaurant-name">${restaurant.name}</div>
                            <div class="restaurant-address">${restaurant.address}</div>
                            `;

            restaurantBodyDiv.innerHTML +=
                `<div class="restaurant-scores d-flex flex-row justify-content-between align-content-center col-6">` +
                `<div class="restaurant-rating"><i class="fas fa-star"></i> ${restaurant.rating}</div>` +
                `<div class="restaurant-score-vegan"><i class="fas fa-leaf"></i> ${restaurant.vegan}</div>` +
                `<div class="restaurant-score-vegetarian"><i class="fas fa-carrot"></i> ${restaurant.vegetarian}</div>` +
                `<div class="restaurant-score-halal"><i class="fas fa-mosque"></i> ${restaurant.halal}</div>` +
                `<div class="restaurant-score-kosher"><i class="fas fa-star-of-david"></i> ${restaurant.kosher}</div>` +
                `<div class="restaurant-score-gluten-free"><i class="fas fa-bread-slice"></i> ${restaurant.glutenFree}</div>` +
                `<div class="restaurant-score-student-discount"><i class="fas fa-graduation-cap"></i> ${restaurant.studentDiscount}</div>` +
                `</div>`;


            restaurantBodyDiv.innerHTML +=
                `<input type="hidden" class="restaurant-api-id" value=${restaurant.api_id}>`;
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
                            id: restaurant.id
                        })
                    }).then(response => response.json())
                    .then(data => {

                        let reviewOverlay = document.querySelector(
                            ".review-overlay");
                        reviewOverlay.style.display = "flex";
                        let reviewsDiv = document.querySelector(
                            "#review-card-container");

                        reviewsDiv.innerHTML = "";
                        document.querySelector("input[name='id']").value = restaurant.id;

                        data.forEach(review => {

                            let reviewDiv = document.createElement("div");
                            reviewDiv.classList.add("review-card");

                            let userDiv = document.createElement("div");

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

        function generateMap() {
            let out = new OpenLayers.Map({
                div: "map",
                layers: [
                    new OpenLayers.Layer.OSM("OSM (without buffer)"),
                    new OpenLayers.Layer.OSM("OSM (with buffer)", null, {
                        buffer: 2
                    })
                ],

                // controls: [
                //     new OpenLayers.Control.Navigation({
                //         dragPanOptions: {
                //             enableKinetic: true
                //         }
                //     }),
                //     new OpenLayers.Control.PanZoom(),
                //     new OpenLayers.Control.Attribution()
                // ],
                center: [
                    1613827.574223, 5787449.0801955
                ],
                zoom: 14
            });

            document.querySelector("#map").style.display = "none";
            return out;
        }



        function generatePagination(numberOfRestaurants, restaurantsPerPage = RESTAURANTS_PER_PAGE) {
            let paginationDiv = document.querySelector("#pagination");
            paginationDiv.innerHTML = "";
            for (let i = 0; i < numberOfRestaurants; i += restaurantsPerPage) {
                let pageButton = document.createElement("button");
                pageButton.classList.add("page");
                pageButton.classList.add("btn");
                pageButton.classList.add("btn-secondary");
                console.log(i);
                pageButton.innerHTML = i / restaurantsPerPage + 1;
                pageButton.addEventListener("click", () => {
                    getRestaurants(document.querySelector("#search-bar-input").value, i, restaurantsPerPage);
                });
                paginationDiv.appendChild(pageButton);
            }
        }
        const RESTAURANTS_PER_PAGE = 6;
        var openstreetmap = generateMap();
        var loadedRestaurants = new Set();

        let restaurantsDiv = document.querySelector("#restaurants");
        let paginationDiv = document.querySelector("#pagination");
        let restaurantFinderDiv = document.querySelector("#restaurant-finder");
        let searchBar = document.querySelector("#search-bar-input");
        let filters = document.querySelector("#filters");
        let filterButton = document.querySelector("#filter-apply-button");
        let topRated = document.querySelector("#top-rated");
        filterButton.addEventListener("click",
            () => {
                Promise.all([
                    accessOpenStreetMapsAPI("Slovenia restaurant " + searchBar.value),
                    getRestaurants(searchBar.value)
                ]).then(([openStreetMapsRestaurants, otherRestaurants]) => {

                    loadedRestaurants = new Set();
                    openStreetMapsRestaurants.forEach(restaurant => loadedRestaurants.add(restaurant));
                    otherRestaurants.forEach(restaurant => {
                        if (!openStreetMapsRestaurants.some(restaurant2 => restaurant2.id ==
                                restaurant.id)) {
                            loadedRestaurants.add(restaurant);
                        }
                    });

                    restaurantsDiv.innerHTML = "";
                    loadedRestaurants.forEach(async restaurant => document.querySelector("#restaurants")
                        .appendChild(createRestaurantDiv(restaurant)));
                    console.log(loadedRestaurants);
                });
            });



        searchBar.addEventListener("input", (e) => {
            //TODO: fix this animation
            if (searchBar.value == "") {
                $("#filters").animate({
                    height: 'hide'
                }, 150);
                $("#top-rated").animate({
                    height: 'show'
                }, 150);
                $("#map").fadeOut(50, () => {
                    restaurantFinderDiv.classList.add("col-12");
                });

                paginationDiv.innerHTML = "";
                restaurantsDiv.innerHTML = "";
            } else {
                $("#filters").animate({
                    height: 'show'
                }, 150);
                $("#top-rated").animate({
                    height: 'hide'
                }, 150);
                $("#map").fadeIn(50, () => {
                    restaurantFinderDiv.classList.remove("col-12");
                });
            }
        });
    </script>
@endsection
