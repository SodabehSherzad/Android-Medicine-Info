// Login Validation
$("#frmAddMedicine").validate({
    rules: {
      medicine_name: {
        required: true,
        minlength: 3,
        maxlength: 55
      },
      medicine_usage: {
        required: true,
        minlength: 4,
        maxlength: 55
      },
      medicine_detail: {
        required: true,
        minlength: 30,
        maxlength: 255
      },
      medicine_image: {
        required: true,
        accept: "image/*"
      }
    },
    messages: {
      medicine_name: {
        required: "Medicine Name is requried!",
        minlength: "Medicine Name must be at least 3 characters!",
        maxlength: "Medicine Name must be at most 55 characters!"
      },
      medicine_usage: {
        required: "Medicine Usage is required!",
        minlength: "Medicine Usage must be at least 4 characters!",
        maxlength: "Medicine Usage must be at most 55 characters!"
      },
      medicine_detail: {
        required: "Medicine Detail is required!",
        minlength: "Medicine Detail must be at least 30 characters!",
        maxlength: "Medicine Detail must be at most 255 characters!"
      },
      medicine_image: {
        required: "Medicine Image is required!",
        minlength: "Medicine Image must be an image!"
      }
    }
  });