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


$('#getAllUsersModal').click(function () {
    $.ajax({
        url: "http://localhost/rent-a-car-app/backend/api/users",
        type: "GET",
        success: function (users) {
            $('#userList').empty();
            users.forEach(function(user) {
                var userHtml = '<div class="user">';
                userHtml += '<p><strong>ID:</strong> ' + user.id + '</p>';
                userHtml += '<p><strong>Email:</strong> ' + user.email + '</p>';
                userHtml += '<p><strong>Name:</strong> ' + user.first_name + '</p>';
                userHtml += '<p><strong>Surname:</strong> ' + user.last_name + '</p>';

                userHtml += '</div>';
                $('#userList').append(userHtml);
            });
            // Show the modal
            $('#getAllUsersModal').modal('show');
        },
        error: function (error) {
            console.error('Failed to fetch users:', error.statusText);
            alert("Failed to fetch users. Please try again later.");
        }
    });
});


    function deleteUser(userId) {
        $.ajax({
            url: "http://localhost/rent-a-car-app/backend/api/users/" + userId,
            type: "DELETE",
            success: function (response) {
                console.log(response);
                alert("User deleted successfully!");
            },
            error: function (error) {
                console.error('Failed to delete user:', error.statusText);
                alert("Failed to delete user. Please try again later.");
            }
        });
    }
    
    $('#deleteUserModal').on('click', '.btn-danger', function () {
        var userId = $('#userIdToDelete').val();
        deleteUser(userId);
        $('#deleteUserModal').modal('hide');
    });


$('#getAllBookingsModal').click(function () {
    $.ajax({
        url: "http://localhost/rent-a-car-app/backend/api/bookings",
        type: "GET",
        success: function (bookings) {
            $('#bookingList').empty();
            if (bookings.length === 0) {
                $('#bookingList').html('<p>No bookings found.</p>');
            } else {
                bookings.forEach(function(booking) {
                    var bookingHtml = '<div class="booking">';
                    bookingHtml += '<p><strong>Booking ID:</strong> ' + booking.id + '</p>';
                    bookingHtml += '<p><strong>User ID:</strong> ' + booking.user_id + '</p>';
                    bookingHtml += '<p><strong>Car ID:</strong> ' + booking.car_id + '</p>';
                    bookingHtml += '<p><strong>Location ID:</strong> ' + booking.location_id + '</p>';
                    bookingHtml += '<p><strong>Date of Booking:</strong> ' + booking.date_of_booking + '</p>';
                    bookingHtml += '<p><strong>Date of Payment:</strong> ' + booking.date_of_payment + '</p>';
                    bookingHtml += '<p><strong>Paid:</strong> ' + booking.paid + '</p>';
                    bookingHtml += '</div>';
                    $('#bookingList').append(bookingHtml);
                });
            }
            $('#getAllBookingsModal').modal('show');
        },
        error: function (error) {
            console.error('Failed to fetch bookings:', error.statusText);
            alert("Failed to fetch bookings. Please try again later.");
        }
    });
});



// payment functionality

// AJAX request to add a booking
$('.payment-button').click(function () {
    var fullName = $('.info-name-container input').val();
    var creditCardNumber = $('.info-card-container input').val();
    var expDate = $('.card-exp-date-container input').val();
    var cvv = $('.card-cvv-container input').val();
    var zipCode = $('.card-zip-code-container input').val();

    // Retrieve other booking details from the HTML table if needed
    var user_id = 1; // Example value, replace with the actual user ID
    var car_id = 1; // Example value, replace with the actual car ID
    var location_id = 1; // Example value, replace with the actual location ID

    var currentDate = new Date().toISOString().slice(0, 19).replace('T', ' '); // Current date and time in MySQL format

    var bookingData = {
        user_id: user_id,
        car_id: car_id,
        location_id: location_id,
        date_of_booking: currentDate, // Use current date for booking
        date_of_payment: null, // Payment date is initially null
        paid: 0 // Payment status is initially false
        // Add more fields if needed
    };

    // Make an AJAX POST request to add the booking
    $.ajax({
        url: "http://localhost/rent-a-car-app/backend/api/bookings",
        type: "POST",
        contentType: "application/json",
        data: JSON.stringify(bookingData),
        success: function (response) {
            console.log(response);
            alert("Booking added successfully!");
            // Redirect or perform any other actions after successful booking
        },
        error: function (error) {
            console.error('Failed to add booking:', error.statusText);
            alert("Failed to add booking. Please try again later.");
        }
    });
});

    


});
