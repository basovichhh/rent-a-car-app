$(document).ready(function () {

    function addCar(data) {
      $.ajax({
        url: "http://localhost/rent-a-car-app/backend/api/cars",
        type: "POST",
        contentType: "application/json",
        data: JSON.stringify(data),
        success: function (response) {
          console.log(response);
          alert("Car added successfully!");
        },
        error: function (error) {
          console.error('Failed to add car:', error.statusText);
          alert("Failed to add car. Please try again later.");
        }
      });
    }
  
    $('#add-car').click(function() {
      var carId = $('#car_id').val();
      var carName = $('#manufacturer').val();
      var carModel = $('#name').val();
  
      var carData = {
        carId: carId,
        carName: carName,
        carModel: carModel
      };
  
      addCar(carData);
    });
  
  });
  