$(document).ready(function () {
    // Function to fetch and display cars
    function getCars() {
        $.get("./data-json/cars.json", function (data) {
            displayCars(data);
        });
    }

    // Function to display car cards
    function displayCars(data) {
        data.forEach(function (car, index) {
            var carHTML = `
                <div class="col-md-4 mb-4">
                    <div class="card">
                        <img src="assets/images/${car.image}" class="card-img-top" alt="${car.name}">
                        <div class="card-body">
                            <h5 class="card-title">${car.name}</h5>
                            <p class="card-text">${car.manufacturer}</p>
                            <p class="card-text">${car.price}</p>
                            <button class="btn btn-primary book-btn" data-index="${index}">Book Now</button>
                            <button class="btn btn-secondary details-btn" data-id="${car.id}">Details</button>
                        </div>
                    </div>
                </div>
            `;
            // append each car
            $(".ftco-section.bg-light .row").append(carHTML);
        });
        
        // Event listener for Details button click
        $(".details-btn").click(function() {
            var carId = $(this).data("id");
            // Load car details via AJAX
            $.get(`./data-json/car${carId}.json`, function(carData) {
                displayCarDetails(carData);
            });
        });
    }

    // Function to display car details
    function displayCarDetails(carData) {
        // Populate car details on a modal or a separate page
        // Example:
        console.log(carData);
        // Render car details dynamically using carData
    }

    // Call getCars function to fetch and display cars
    getCars();
});
