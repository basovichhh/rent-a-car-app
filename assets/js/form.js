var users = [];
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
      bio: { // Corrected field name from 'first_name' to 'bio'
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