var users = [];
var trips = [];
var idCounter = 1;



$("#register-form").validate({
  rules: {
    first_name: {
      required: true,
      minlength: 5,
    },
    username: {
        required: true,
        minlength: 5,
      },
    password: {
      required: true,
      minlength: 5,
    },
    email: {
        required: true,
        email: true,
    },
    confirm_password: {
      equalTo: "#password",
    },
  },
  messages: {
    first_name: {
      required: "You have to fill it in!",
      minlength: "Too short buddy.!",
    },
    confirm_password: {
       equalTo: "The password and confirm password fields should be the same",
    },
  },
  submitHandler: function (form, event) {
    event.preventDefault();
    blockUi("#register-form"); 
    let data = serializeForm(form);
    users.push(data);
    $("#register-form")[0].reset();
    console.log(users); 
    unblockUi("#register-form"); 
    window.location.href = "#login";

  },
});

$("#login-form").validate({
    rules: {
      username: {
        required: true,
        minlength: 5,
      },
      password: {
        required: true,
        minlength: 5,
      },
    },
    messages: {
      username: {
        required: "You have to fill it in!",
        minlength: "Too short buddy!",
      },
    },
    submitHandler: function (form, event) {
      event.preventDefault();
      blockUi("#login-form");
      let data = serializeForm(form);
      console.log("Login data:", data);
      unblockUi("#login-form");
      window.location.href = "#home";
    },
  });

  $("#contact-form").validate({
    rules: {
        name: {
            required: true,
            minlength: 5,
        },
        email: {
            required: true,
            email: true,
        },
        message: {
            required: true,
            maxlength: 500,
        },
    },
    messages: {
        name: {
            required: "Please enter your name.",
            minlength: "Name must be at least 5 characters.",
        },
        email: {
            required: "Please enter your email address.",
            email: "Please enter a valid email address.",
        },
        message: {
            required: "Please enter your message.",
            maxlength: "Message cannot exceed 500 characters.",
        },
    },
    submitHandler: function (form, event) {
        event.preventDefault();
        blockUi("#contact-form");
        let formData = $(form).serialize();

        console.log("Contact form data:", formData);
        unblockUi("#contact-form");

        // Assuming 'users' is defined elsewhere
        users.push(formData);
        $(form)[0].reset();
        console.log(users);

        alert("Your response was submitted successfully.");
    },
});



  $("#edit-profile-form").validate({
    rules: {
      name: {
        required: true,
        minlength: 5,
      },
      bio: {
        required: true,
        maxlength: 500,
      },
    },
    messages: {
      name: {
        required: "You have to fill it in!",
        minlength: "Too short buddy!",
      },
      bio: { 
        required: "Bio is required!",
        maxlength: "Bio cannot exceed 500 characters!",
      },
    },
    submitHandler: function (form, event) {
      event.preventDefault();
      blockUi("#edit-profile-form");
      let data = serializeForm(form);

  
      console.log("Updated profile data:", data);
      unblockUi("#edit-profile-form");

      users.push(data);
      $("#edit-profile-form")[0].reset();
      console.log(users);
  
      alert("Profile has been successfully updated");
    },
  });
  

  $(document).ready(function () {
    $("#change-password-form").validate({
        rules: {
            current_password: {
                required: true,
                minlength: 5,
            },
            new_password: {
                required: true,
                minlength: 5,
            },
            confirm_password: {
                equalTo: "#new_password", // Ensure it matches the new password field
            },
        },
        messages: {
            current_password: {
                required: "You have to fill it in!",
                minlength: "Too short buddy!",
            },
            new_password: {
                required: "You have to fill it in!",
                minlength: "Too short buddy!",
            },
            confirm_password: {
                equalTo: "The new password and confirm password fields should be the same",
            },
        },
        invalidHandler: function (form, validator) {
            var errors = validator.numberOfInvalids();
            if (errors) {
                alert("Please fill in all the required fields.");
            }
        },
        submitHandler: function (form, event) {
            event.preventDefault();
            var newPassword = $("#new_password").val();
            var confirmPassword = $("#confirm_password").val();
            if (newPassword.trim() === '' || confirmPassword.trim() === '') {
                alert("Please fill in all the required fields.");
                return;
            }
            if (newPassword === confirmPassword) {
                blockUi("#change-password-form");
                let data = serializeForm(form);

                console.log("Changed password:", data);
                unblockUi("#change-password-form");
                alert("Password has been successfully changed");
            } else {
                alert("The new password and confirm password should be the same");
            }
        },
    });
});

$("#pick-up-date, #drop-off-date").datepicker({
  dateFormat: 'yy-mm-dd' // Adjust the date format as needed
});

$("#pick-up-time").timepicker({
  timeFormat: 'HH:mm', // Adjust the time format as needed
  interval: 15, // Interval of 15 minutes
  minTime: '00:00', // Minimum time
  maxTime: '23:45', // Maximum time
  defaultTime: '12:00', // Default time
  startTime: '00:00', // Start time
  dynamic: false,
  dropdown: true,
  scrollbar: true
});

$("#rent-form").validate({
  rules: {
      "pick-up-location": {
          required: true,
      },
      "drop-off-location": {
          required: true,
      },
      "pick-up-date": {
          required: true,
      },
      "drop-off-date": {
          required: true,
      },
      "pick-up-time": {
          required: true,
      },
  },
  messages: {
      "pick-up-location": {
          required: "Please enter pick-up location.",
      },
      "drop-off-location": {
          required: "Please enter drop-off location.",
      },
      "pick-up-date": {
          required: "Please select pick-up date.",
      },
      "drop-off-date": {
          required: "Please select drop-off date.",
      },
      "pick-up-time": {
          required: "Please enter pick-up time.",
      },
  },
  submitHandler: function (form, event) {
      event.preventDefault();
      blockUi("#rent-form");
      let formData = $(form).serialize();

      console.log("Rent form data:", formData);
      unblockUi("#rent-form");

      trips.push(formData);
      $(form)[0].reset();
      console.log(trips);

      alert("Your trip has been booked successfully.");
  },
});


$(document).ready(function () {
  $("#payment-form").validate({
      rules: {
          full_name: {
              required: true,
              minlength: 5,
          },
          credit_card_number: {
              required: true,
              minlength: 16,
          },
          card_exp_date: {
              required: true,
              minlength: 5,
          },
          card_cvv: {
              required: true,
              minlength: 3,
          },
          card_zip_code: {
              required: true,
              minlength: 5,
          },
      },
      messages: {
          full_name: {
              required: "Please enter your full name.",
              minlength: "Full name must be at least 5 characters long.",
          },
          credit_card_number: {
              required: "Please enter your credit card number.",
              minlength: "Credit card number must be 16 digits long.",
          },
          card_exp_date: {
              required: "Please enter the expiration date.",
              minlength: "Please enter in the format MM/YY.",
          },
          card_cvv: {
              required: "Please enter your CVV.",
              minlength: "CVV must be 3 digits long.",
          },
          card_zip_code: {
              required: "Please enter your zip code.",
              minlength: "Zip code must be 5 digits long.",
          },
      },
      submitHandler: function (form, event) {
          event.preventDefault();
          // Your form submission logic here
          console.log("Form submitted successfully!");
      },
  });
});

  
  

  blockUi = (element) => {
    $(element).block({
      message: '<div class="spinner-border text-primary" role="status"></div>',
      css: {
        backgroundColor: "transparent",
        border: "0",
      },
      overlayCSS: {
        backgroundColor: "#000",
        opacity: 0.25,
      },
    });
  };
  
  unblockUi = (element) => {
    $(element).unblock({});
  };
  
  serializeForm = (form) => {
    let jsonResult = {};
    $.each($(form).serializeArray(), function () {
      jsonResult[this.name] = this.value;
    });
    return jsonResult;
  };