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
      var name = $('#name').val();
      var manufacturer = $('#manufacturer').val();
      var price = $('#price').val();
      var description = $('#description').val();
      var mileage = $('#mileage').val();
      var transmission = $('#transmission').val();
      var seats = $('#seats').val();
      var luggage = $('#luggage').val();
      var fuel = $('#fuel').val();
  
      var carData = {
        manufacturer: manufacturer,
        name: name,
        price: price,
        description: description,
        mileage: mileage,
        transmission: transmission,
        seats: seats,
        luggage: luggage,
        fuel: fuel
      };
  
      addCar(carData);
    });

    function deleteCar(carId) {
      $.ajax({
          url: "http://localhost/rent-a-car-app/backend/api/cars/" + carId,
          type: "DELETE",
          success: function (response) {
              console.log(response);
              alert("Car deleted successfully!");
          },
          error: function (error) {
              console.error('Failed to delete car:', error.statusText);
              alert("Failed to delete car. Please try again later.");
          }
      });
  }


  $(document).ready(function () {
    // Bind click event to the "Delete" button inside the modal
    $('#deleteCarModal').on('click', '.btn-danger', function () {
        var carId = $('#carIdToDelete').val(); // Get the car ID from the input field
        deleteCar(carId); // Call deleteCar() function with the entered car ID
        $('#deleteCarModal').modal('hide'); // Hide the modal after deletion
    });
});

$(document).ready(function () {
  // Function to update car by ID
  function updateCar(carId, updatedCarData) {
      $.ajax({
          url: "http://localhost/rent-a-car-app/backend/api/cars/" + carId,
          type: "PUT",
          contentType: "application/json",
          data: JSON.stringify(updatedCarData),
          success: function (response) {
              console.log(response);
              alert("Car updated successfully!");
          },
          error: function (error) {
              console.error('Failed to update car:', error.statusText);
              alert("Failed to update car. Please try again later.");
          }
      });
  }

  // Bind click event to the "Save changes" button in the modal
  $('#updateCarModal').on('click', '.btn-primary', function () {
      var carId = $('#updateCarId').val(); // Get the car ID from the input field
      var data = {
          name: $('#name').val(),
          manufacturer: $('#manufacturer').val(),
          price: $('#price').val(),
          description: $('#description').val(),
          mileage: $('#mileage').val(),
          transmission: $('#transmission').val(),
          seats: $('#seats').val(),
          luggage: $('#luggage').val(),
          fuel: $('#fuel').val()
      };
      updateCar(carId, data); // Call updateCar() function with the entered car ID and updated data
      $('#updateCarModal').modal('hide'); // Hide the modal after updating
  });
});


});
  