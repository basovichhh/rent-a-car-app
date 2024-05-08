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

  $('#add-car').click(function () {
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
      $('#add-car').modal('hide');
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

  $('#deleteCarModal').on('click', '.btn-danger', function () {
      var carId = $('#carIdToDelete').val();
      deleteCar(carId);
      $('#deleteCarModal').modal('hide');
  });

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

  $('#updateCarModal').on('click', '.btn-primary', function () {
      var carId = $('#updateCarId').val();
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
      updateCar(carId, data);
      $('#updateCarModal').modal('hide');
  });

  function addLocation(data) {
      $.ajax({
          url: "http://localhost/rent-a-car-app/backend/api/locations",
          type: "POST",
          contentType: "application/json",
          data: JSON.stringify(data),
          success: function (response) {
              console.log(response);
              alert("Location added successfully!");
          },
          error: function (error) {
              console.error('Failed to add location:', error.statusText);
              alert("Failed to add location. Please try again later.");
          }
      });
  }

  $('#addLocationModal').on('click', '#add-location', function () {
      console.log("Add Location button clicked!");
      var name_point = $('#name_point').val();
      var address = $('#address').val();
      var town = $('#town').val();
      var email = $('#email').val();
      var phone = $('#phone').val();
      var date_available = $('#date_available').val();

      var locationData = {
          name_point: name_point,
          address: address,
          town: town,
          email: email,
          phone: phone,
          date_available: date_available
      };

      addLocation(locationData);
      $('#addLocationModal').modal('hide');
  });

  function deleteLocation(locationId) {
    $.ajax({
        url: "http://localhost/rent-a-car-app/backend/api/locations/" + locationId,
        type: "DELETE",
        success: function (response) {
            console.log(response);
            alert("Location deleted successfully!");
        },
        error: function (error) {
            console.error('Failed to delete location:', error.statusText);
            alert("Failed to delete location. Please try again later.");
        }
    });
}

    $('#deleteLocationModal').on('click', '.btn-danger', function () {
    var locationId = $('#locationIdToDelete').val();
    deleteLocation(locationId);
    $('#deleteLocationModal').modal('hide');
    });

    function updateLocation(locationId, updatedLocationData) {
        $.ajax({
            url: "http://localhost/rent-a-car-app/backend/api/locations/" + locationId,
            type: "PUT",
            contentType: "application/json",
            data: JSON.stringify(updatedLocationData),
            success: function (response) {
                console.log(response);
                alert("Location updated successfully!");
            },
            error: function (error) {
                console.error('Failed to update location:', error.statusText);
                alert("Failed to update location. Please try again later.");
            }
        });
    }

    $('#updateLocationModal').on('click', '.btn-primary', function () {
        var locationId = $('#updateLocationId').val();
        var data = {
            name_point: $('#name_point').val(),
            address: $('#address').val(),
            town: $('#town').val(),
            email: $('#email').val(),
            phone: $('#phone').val(),
            date_available: $('#date_available').val()
        };
        updateLocation(locationId, data);
        $('#updateLocationModal').modal('hide');
    });



});
