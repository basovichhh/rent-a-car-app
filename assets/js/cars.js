$(document).ready(function () {
  // Function to fetch and display cars
  function getCars() {
      $.get("cars.json", function (data) {
          displayCars(data);
      });
  }

  // Function to display car cards
  function displayCars(data) {
      data.forEach(function (car) {
          var carHTML = `
              <div class="col-md-4 mb-4">
                  <div class="card">
                      <img src="theme/images/${car.image}" class="card-img-top" alt="${car.name}">
                      <div class="card-body">
                          <h5 class="card-title">${car.name}</h5>
                          <p class="card-text">${car.manufacturer}</p>
                          <p class="card-text">${car.price}</p>
                          <a href="#" class="btn btn-primary">Book Now</a>
                          <a href="car${car.id}.html" class="btn btn-secondary">Details</a>
                      </div>
                  </div>
              </div>
          `;
          // Append each car to the container with class "row" inside the section with class "ftco-section bg-light"
          $(".ftco-section.bg-light .row").append(carHTML);
      });
  }

  // Call getCars function to fetch and display cars
  getCars();
});
