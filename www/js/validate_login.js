// Login Validation
$("#frmLogin").validate({
    rules: {
      username: {
        required: true,
        minlength: 3,
        maxlength: 55
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
        maxlength: "Username must be at most 55 characters!"
      },
      password: {
        required: "Password is required!",
        minlength: "Password must be at least 3 characters!",
        maxlength: "Password must be at most 55 characters!"
      }
    }
  });