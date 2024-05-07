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
                          <a href="../rent-a-car-app/pages/book-car${index}.html" class="btn btn-primary">Book Now</a>
                          <a href="../rent-a-car-app/pages/car${car.id}.html" class="btn btn-secondary">Details</a>
                      </div>
                  </div>
              </div>
          `;

          // append each car
          $(".ftco-section.bg-light .row").append(carHTML);
      });
  }

  // Call getCars function to fetch and display cars
  getCars();
});
