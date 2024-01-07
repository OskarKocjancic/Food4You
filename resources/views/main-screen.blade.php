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
    <div class="login-badge p-3 mb-2 bg-secondary text-white">
        @if (Auth::check())
            <div class="login-badge-item">Logged in as {{ Auth::user()->username }}</div>
            <div class="login-badge-item"><a href="{{ route('logout') }}">Logout</a></div>
        @else
            <div class="login-badge-item"><a href="{{ route('login') }}">Login</a></div>
            {{-- <div class="login-badge-item"><a href="{{ route('registration') }}">Register</a></div> --}}
        @endif

    </div>
    <div class="container-fluid h-100 d-flex flex-column">
        <div class="row flex-grow-0 d-flex flex-row">
            <section class="p-3 col-12 collapse show" id="top-rated">
                <div class="card">
                    {{-- <div class="card-body d-flex justify-content-between align-items-center">
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
                    </div> --}}
                </div>

            </section>
        </div>
        <div class="row flex-grow-1 d-flex flex-row justify-content-start">
            <section class="col-2 collapse card p-3" id="filters">
                <div class="filter mb-3">
                    <div class="filter-title">Price</div>
                    <div class="row filter-content ">
                        <div class="filter-content-item">
                            <input type="checkbox" id="price-1" name="price-1" value="1" checked>
                            <label for="price-1">$</label>
                        </div>
                        <div class="filter-content-item">
                            <input type="checkbox" id="price-2" name="price-2" value="2" checked>
                            <label for="price-2">$$</label>
                        </div>
                        <div class="filter-content-item">
                            <input type="checkbox" id="price-3" name="price-3" value="3" checked>
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
                                    step="0.5" list="rating-ticks" id="vegetarian" name="vegetarian" value="vegetarian"
                                    oninput="updateValue('vegetarian', 'vegetarian-value')">
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
                                    <label id="rating-value" for="rating">&GreaterEqual;0.0</label>
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
                            aria-describedby="button-addon2">
                    </div>
                </div>

                <div class="loader" style="display: none">
                    <div class="loader-wheel"></div>
                    <div class="loader-text"></div>
                </div>

                <div class="col-12 p-1 justify-content-center" id="restaurants">
                </div>

                <div class="col-12 h-10 d-flex justify-content-start align-items-center gap-1 " id="pagination"></div>
            </section>

            <section id="map" tabindex="2"
                class="col-7 h-100 leaflet-container leaflet-touch leaflet-fade-anim leaflet-grab leaflet-touch-drag leaflet-touch-zoom d-none">
            </section>
        </div>



    </div>

    <div class="review-overlay p-4">
        <div class="row w-100">
            @if (Auth::check())
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
                    <label for="exampleFormControlInput1" class="form-label">Price</label>
                    <select class="form-control" name="price" placeholder="Price">
                        <option value="1">$</option>
                        <option value="2">$$</option>
                        <option value="3">$$$</option>
                    </select>
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
            @endif



            <div class="col-6" id="review-card-container">

            </div>
        </div>
        <button id="close-button" class="btn btn-primary" onclick="this.parentNode.style.display = 'none'">Exit</button>

    </div>
    <script src="https://unpkg.com/leaflet/dist/leaflet.js"></script>
    {{-- <script src="main.js"></script> --}}
    <script>
        const RESTAURANTS_PER_PAGE = 5;
        const RESTAURANTS_PER_LOAD = 25;
        let restaurantsDiv = document.querySelector("#restaurants");
        let paginationDiv = document.querySelector("#pagination");
        let restaurantFinderDiv = document.querySelector("#restaurant-finder");
        let searchBar = document.querySelector("#search-bar-input");
        let filters = document.querySelector("#filters");
        let filterButton = document.querySelector("#filter-apply-button");
        let topRated = document.querySelector("#top-rated");
        let loaderDiv = document.querySelector(".loader");
        let timeoutId;
        let mapWidget = undefined;
        let map = document.querySelector("#map");
        filterButton.addEventListener("click", accessDatabase);

        document.onload = getTopRatedRestaurants();
        searchBar.addEventListener("input", (e) => {
            //TODO: fix this animation
            if (mapWidget === undefined) {
                mapWidget = generateMap(map);
                moveMapTo({
                    lon: 14.505751,
                    lat: 46.051082,
                });
            }
            if (searchBar.value == "") {
                $("#filters").animate({
                        height: "hide",
                    },
                    150
                );
                $("#top-rated").animate({
                        height: "show",
                    },
                    150
                );
                $("#map").fadeOut(50, () => {
                    restaurantFinderDiv.classList.add("col-12");
                });

                paginationDiv.innerHTML = "";
                restaurantsDiv.innerHTML = "";
            } else {
                $("#filters").animate({
                        height: "show",
                    },
                    150
                );
                $("#top-rated").animate({
                        height: "hide",
                    },
                    150
                );
                $("#map").fadeIn(50, () => {
                    restaurantFinderDiv.classList.remove("col-12");
                });

                // Delay before calling accessDatabase function
                clearTimeout(timeoutId);
                timeoutId = setTimeout(() => {
                    restaurantsDiv.innerHTML = "";

                    if (!searchBar.value.replace(/\s/g, "").length) {
                        return;
                    }
                    accessDatabase();
                }, 250);
            }
        });

        async function accessOpenStreetMapsAPI(query) {
            query = query.replace(/\s/g, "+");
            //use photon api
            let uri = `https://photon.komoot.io/api/?q=${query}&osm_tag=amenity:restaurant&limit=50`;



            uri = encodeURI(uri);
            return fetch(uri)
                .then((response) => response.json())
                .then((data) => {
                    data = data.features;
                    console.log(data);
                    Promise.all(
                        data.map((restaurant) => {
                            return fetch("/add-restaurant", {
                                method: "POST",
                                headers: {
                                    "Content-Type": "application/json",
                                    "X-CSRF-TOKEN": document.querySelector(
                                        'meta[name="csrf-token"]'
                                    ).content,
                                },
                                body: JSON.stringify({
                                    api_id: restaurant.properties.osm_id,
                                    name: restaurant.properties.name,
                                    address: restaurant.properties.city + ", " + restaurant
                                        .properties.country,
                                    lon: restaurant.geometry.coordinates[0],
                                    lat: restaurant.geometry.coordinates[1],
                                }),
                            }).then((response) => response.json());
                        })
                    );
                });
        }
        async function getRestaurants(query, from = 0, to = RESTAURANTS_PER_PAGE) {
            return await fetch("/get-restaurants", {
                    method: "POST",
                    headers: {
                        "Content-Type": "application/json",
                        "X-CSRF-TOKEN": document.querySelector('meta[name="csrf-token"]')
                            .content,
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
                    }),
                })
                .then((response) => response.json())
                .then((data) => {
                    // let restaurantsDiv = document.querySelector("#restaurants");

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

        function createRestaurantDiv(restaurant, mouseover = true) {
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
                `<div class="restaurant-scores mb-2 d-flex flex-row justify-content-between align-content-center 1">` +
                `<div class="restaurant-price ${restaurant.price === 0 ? "greyed-out" : ""}">${"<i class='fa-solid fa-dollar-sign'></i>".repeat(restaurant.price)}</div>` +
                `<div class="restaurant-rating ${restaurant.rating === 0 ? "greyed-out" : ""}"><i class="fas fa-star"></i> ${restaurant.rating.toFixed(1)}</div>` +
                `<div class="restaurant-score-vegan ${restaurant.vegan === 0 ? "greyed-out" : ""}"><i class="fas fa-leaf"></i> ${restaurant.vegan.toFixed(1)}</div>` +
                `<div class="restaurant-score-vegetarian ${restaurant.vegetarian === 0 ? "greyed-out" : ""}"><i class="fas fa-carrot"></i> ${restaurant.vegetarian.toFixed(1)}</div>` +
                `<div class="restaurant-score-halal ${restaurant.halal === 0 ? "greyed-out" : ""}"><i class="fas fa-mosque"></i> ${restaurant.halal.toFixed(1)}</div>` +
                `<div class="restaurant-score-kosher ${restaurant.kosher === 0 ? "greyed-out" : ""}"><i class="fas fa-star-of-david"></i> ${restaurant.kosher.toFixed(1)}</div>` +
                `<div class="restaurant-score-gluten-free ${restaurant.glutenFree === 0 ? "greyed-out" : ""}"><i class="fas fa-bread-slice"></i> ${restaurant.glutenFree.toFixed(1)}</div>` +
                `<div class="restaurant-score-student-discount ${restaurant.studentDiscount === 0 ? "greyed-out" : ""}"><i class="fas fa-graduation-cap"></i> ${restaurant.studentDiscount.toFixed(1)}</div>` +
                `</div>`;

            restaurantBodyDiv.innerHTML += `<input type="hidden" class="restaurant-api-id" value=${restaurant.api_id}>`;
            if (mouseover)
                restaurantDiv.addEventListener("mouseover", () => {
                    moveMapTo(restaurant);
                });
            restaurantDiv.addEventListener("click", () => {
                fetch("/get-reviews", {
                        method: "POST",
                        headers: {
                            "Content-Type": "application/json",
                            "X-CSRF-TOKEN": document.querySelector(
                                'meta[name="csrf-token"]'
                            ).content,
                        },
                        body: JSON.stringify({
                            id: restaurant.id,
                        }),
                    })
                    .then((response) => response.json())
                    .then((data) => {
                        let reviewOverlay = document.querySelector(".review-overlay");
                        reviewOverlay.style.display = "flex";
                        let reviewsDiv = document.querySelector(
                            "#review-card-container"
                        );

                        reviewsDiv.innerHTML = "";
                        if (document.querySelector("input[name='id']") !== null)
                            document.querySelector("input[name='id']").value = restaurant.id;

                        data.forEach((review) => {
                            let reviewDiv = document.createElement("div");
                            reviewDiv.classList.add("review-card");

                            let userDiv = document.createElement("div");

                            userDiv.classList.add("review-card-user");
                            userDiv.innerHTML = review.username;
                            reviewDiv.appendChild(userDiv);

                            // Add review title
                            let titleDiv = document.createElement("div");
                            titleDiv.classList.add("review-card-title");
                            titleDiv.innerHTML = review.title;
                            reviewDiv.appendChild(titleDiv);

                            // Add review text
                            let textDiv = document.createElement("div");
                            textDiv.innerHTML = review.text;
                            textDiv.classList.add("review-card-text");
                            reviewDiv.appendChild(textDiv);
                            let priceDiv = document.createElement("div");
                            priceDiv.innerHTML =
                                "<i class='fa-solid fa-dollar-sign'></i>".repeat(
                                    restaurant.price
                                );

                            priceDiv.classList.add("review-card-text");
                            reviewDiv.appendChild(priceDiv);

                            // Add review score
                            let scoreDiv = document.createElement("div");
                            scoreDiv.innerHTML = review.rating;
                            scoreDiv.classList.add("review-card-score");
                            reviewDiv.appendChild(scoreDiv);

                            reviewsDiv.appendChild(reviewDiv);
                        });
                    });
            });

            return restaurantDiv;
        }

        function generateMap(map) {
            map.classList.remove("d-none");
            let out = new OpenLayers.Map({
                div: "map",
                layers: [
                    new OpenLayers.Layer.OSM("OSM (without buffer)"),
                    new OpenLayers.Layer.OSM("OSM (with buffer)", null, {
                        buffer: 2,
                    }),
                ],

                controls: [
                    new OpenLayers.Control.Navigation({
                        dragPanOptions: {
                            enableKinetic: true,
                        },
                    }),
                    new OpenLayers.Control.PanZoom(),
                    new OpenLayers.Control.Attribution(),
                ],
                center: [1613827.574223, 5787449.0801955],
                zoom: 19,
            });


            return out;
        }

        function moveMapTo(restaurant) {
            let lonLat = new OpenLayers.LonLat(
                restaurant.lon,
                restaurant.lat
            ).transform(
                new OpenLayers.Projection("EPSG:4326"),
                mapWidget.getProjectionObject()
            );

            mapWidget.setCenter(lonLat, 18);
            let markers = new OpenLayers.Layer.Markers("Markers");
            mapWidget.addLayer(markers);
            markers.addMarker(new OpenLayers.Marker(lonLat));
        }

        function accessDatabase() {
            $(loaderDiv).fadeIn(50);
            accessOpenStreetMapsAPI(searchBar.value).then(() => {
                $(loaderDiv).fadeOut(50);
                getRestaurants(searchBar.value, 0, RESTAURANTS_PER_LOAD).then((data) => {
                    console.log(data);
                    generatePagination(data.length);
                    restaurantsDiv.innerHTML = "";
                    if (data.length == 0) {
                        restaurantsDiv.innerHTML = "No restaurants found";
                    }
                    let count = 0;
                    data.forEach((restaurant) => {
                        if (count < RESTAURANTS_PER_PAGE)
                            document.querySelector("#restaurants").appendChild(createRestaurantDiv(
                                restaurant))
                        count++;
                    });
                });
            });

            // Promise.all([
            //     accessOpenStreetMapsAPI(searchBar.value),
            //     getRestaurants(searchBar.value),
            // ]).then(([openStreetMapsRestaurants, databaseRestaurants]) => {
            //     loadedRestaurants = new Set();

            //     if (openStreetMapsRestaurants === undefined)
            //         openStreetMapsRestaurants = [];

            //     openStreetMapsRestaurants.forEach((restaurant) =>
            //         loadedRestaurants.add(restaurant)
            //     );
            //     console.log(openStreetMapsRestaurants);
            //     databaseRestaurants.forEach((restaurant) => {
            //         if (
            //             !openStreetMapsRestaurants.some(
            //                 (restaurant2) => restaurant2.id == restaurant.id
            //             )
            //         ) {
            //             loadedRestaurants.add(restaurant);
            //         }
            //     });
            //     restaurantsDiv.innerHTML = "";
            //     loadedRestaurants.forEach(async (restaurant) =>
            //         document
            //             .querySelector("#restaurants")
            //             .appendChild(createRestaurantDiv(restaurant))
            //     );
            // });
        }

        function getTopRatedRestaurants(num = 3) {
            fetch("/get-best", {
                    method: "POST",
                    headers: {
                        "Content-Type": "application/json",
                        "X-CSRF-TOKEN": document.querySelector(
                            'meta[name="csrf-token"]'
                        ).content,
                    },
                    body: JSON.stringify({}),
                })
                .then((response) => response.json())
                .then((data) => {
                    console.log(data);
                    let topRatedDiv = document.querySelector("#top-rated");
                    topRatedDiv.innerHTML = "";
                    // get top 3 restaurants
                    data.slice(0, num).forEach((restaurant) => {
                        topRatedDiv.appendChild(createRestaurantDiv(restaurant, mouseover = false));
                    });
                });
        }

        function generatePagination(
            numberOfRestaurants,
            restaurantsPerPage = RESTAURANTS_PER_PAGE
        ) {
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
                    getRestaurants(
                        document.querySelector("#search-bar-input").value,
                        i,
                        restaurantsPerPage
                    ).then((data) => {
                        restaurantsDiv.innerHTML = "";
                        data.forEach((restaurant) => {
                            document
                                .querySelector("#restaurants")
                                .appendChild(createRestaurantDiv(restaurant));
                        });

                    })

                });
                paginationDiv.appendChild(pageButton);
            }
        }
    </script>
@endsection
