// Login Validation
$("#frmSignUp").validate({
    rules: {
      username: {
        required: true,
        minlength: 3,
        maxlength: 55,
        remote: {
          url: "../helpers/check_username.php",
          type: "post",
          data: {
            username: function() {
              return $( "#username" ).val();
            }
          }
        }
      },
      password: {
        required: true,
        minlength: 3,
        maxlength: 55
      }
    },
    messages: {
      username: {
        required: "Username is requried!",
        minlength: "Username must be at least 3 characters!",
        maxlength: "Username must be at most 55 characters!",
        remote: "Username already taken by someone else!"
      },
      password: {
        required: "Password is required!",
        minlength: "Password must be at least 3 characters!",
        maxlength: "Password must be at most 55 characters!"
      }
    }
  });