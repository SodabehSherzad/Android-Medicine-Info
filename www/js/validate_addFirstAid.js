// Login Validation
$("#frmAddFirstAid").validate({
    rules: {
      firstaid_name: {
        required: true,
        minlength: 3,
        maxlength: 55
      },
      firstaid_detail: {
        required: true,
        minlength: 30,
        maxlength: 255
      },
      firstaid_image: {
        required: true,
        accept: "image/*"
      }
    },
    messages: {
      firstaid_name: {
        required: "First Aid Name is requried!",
        minlength: "First Aid Name must be at least 3 characters!",
        maxlength: "First Aid Name must be at most 55 characters!"
      },
      firstaid_detail: {
        required: "First Aid Detail is required!",
        minlength: "First Aid Detail must be at least 30 characters!",
        maxlength: "First Aid Detail must be at most 255 characters!"
      },
      firstaid_image: {
        required: "First Aid Image is required!",
        minlength: "First Aid Image must be an image!"
      }
    }
  });