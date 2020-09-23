<?php
require_once "../libraries/connection.php";
$title = "Checkout";
require_once "./includes/header.php";
require_once '..\vendor\autoload.php';

$passwordErr = "";
$validation_msgs = null;
$fname = $lname = $username = $password = $confirm_password = $email = $address = $country = $note = $phone = "";
if (isset($_POST['btnSignUp'])) {
  $fname = $_POST['fname'];
  $lname = $_POST['lname'];
  $password = $_POST['password'];
  $confirm_password = $_POST['confirm_password'];
  $email = $_POST['email'];
  $country = $_POST['country'];
  $phone = $_POST['phone'];
  $address = $_POST['address'];
  $username = $_POST['username'];
  $note = $_POST['note'];
    // Form validation
    $validator = new GUMP();

    // Define the rules
    $rules = [
        'fname' => 'required|max_len,55|min_len,3',
        'lname' => 'required|max_len,55|min_len,3',
        'password' => 'required|max_len,55|min_len,6',
        'confirm_password' => 'required',
        'email' => 'required|valid_email',
        'phone' => 'required|numeric|max_len,20|min_len,10',
        'address' => 'required',
        'username' => 'required|max_len,55|min_len,6',
        'note' => 'required',
    ];

    // Define the filters
    $filters = [
        'fname' => 'trim|sanitize_string',
        'lname' => 'trim|sanitize_string',
        'password' => 'trim|sanitize_string',
        'confirm_password' => 'trim|sanitize_string',
        'email' => 'trim|sanitize_string',
        'phone' => 'trim|sanitize_string',
        'address' => 'trim|sanitize_string',
        'username' => 'trim|sanitize_string',
        'note' => 'trim|sanitize_string',
    ];

    $_POST = $validator->filter($_POST, $filters);
    $validated = $validator->is_valid($_POST, $rules);

    if ($validated === true) {
        $fname = mysqli_real_escape_string($GLOBALS['DB'], $_POST['fname']);
        $lname = mysqli_real_escape_string($GLOBALS['DB'], $_POST['lname']);
        $password = mysqli_real_escape_string($GLOBALS['DB'], $_POST['password']);
        $confirm_password = mysqli_real_escape_string($GLOBALS['DB'], $_POST['confirm_password']);
        $email = mysqli_real_escape_string($GLOBALS['DB'], $_POST['email']);
        $country = mysqli_real_escape_string($GLOBALS['DB'], $_POST['country']);
        $phone = mysqli_real_escape_string($GLOBALS['DB'], $_POST['phone']);
        $address = mysqli_real_escape_string($GLOBALS['DB'], $_POST['address']);
        $username = mysqli_real_escape_string($GLOBALS['DB'], $_POST['username']);
        $note = mysqli_real_escape_string($GLOBALS['DB'], $_POST['note']);

        //before insert we will check that exist user or email similar if exit we show err else insert
        $sql = "INSERT INTO users VALUES(NULL, '$fname', '$lname', '$username', '$address', '$email', '$country', '$phone', '$note', '$password')";
        $result = mysqli_query($GLOBALS['DB'], $sql) or die(mysqli_error($GLOBALS['DB']));
    } else {
        $validation_msgs = $validated;
        //echo "<pre>";
        //print_r($validated);
        //echo "</pre>";
        //die();
    }

}

?>
<body>

  <div class="site-wrap">
  <?php require_once "./includes/navbar.php"?>

    <div class="bg-light py-3">
      <div class="container">
        <div class="row">
        <?php if (isset($validation_msgs)): ?>
              <div class="alert alert-warning">
                <h4 class="alert-heading h5">خطای اعتبار سنجی اطلاعات</h4>
                <ul>
                <?php foreach ($validation_msgs as $msg): ?>
                  <li><?=$msg?></li>
                <?php endforeach;?>
                </ul>
              </div>
          <?php endif;?>

          <div class="col-md-12 mb-0">
            <a href="index.php">Home</a> <span class="mx-2 mb-0">/</span>
            <strong class="text-black">Create Account</strong>
          </div>
        </div>
      </div>
    </div>

    <div class="site-section">
      <div class="container">
        <div class="row mb-5">
          <div class="col-md-12">
            <div class="bg-light rounded p-3">
              <p class="mb-0">Returning Login Page? <a href="signIn.php" class="d-inline-block">Click here</a> to login</p>
            </div>
          </div>
        </div>
        <div class="row">
          <div class="col-md-9 mb-5 mb-md-0">
            <h2 class="h3 mb-3 text-black">Sign up</h2>
            <form method="post" action="signUp.php" class="p-3 p-lg-5 border">
              <div class="form-group">
                <label for="country" class="text-black">Country <span class="text-danger">*</span></label>
                <select id="country" class="form-control" name="country">
                  <option value="<?=$country?>">Select a country</option>
                  <option value="<?=$country?>">Bangladesh</option>
                  <option value="<?=$country?>">Algeria</option>
                  <option value="<?=$country?>">Afghanistan</option>
                  <option value="<?=$country?>">Ghana</option>
                  <option value="<?=$country?>">Albania</option>
                  <option value="<?=$country?>">Bahrain</option>
                  <option value="<?=$country?>">Colombia</option>
                  <option value="<?=$country?>">Dominican Republic</option>
                </select>
              </div>
              <div class="form-group row">
                <div class="col-md-6">
                  <label for="fname" class="text-black">First Name <span class="text-danger">*</span></label>
                  <input type="text" class="form-control" id="fname" name="fname" value="<?=$fname?>">
                </div>
                <div class="col-md-6">
                  <label for="lname" class="text-black">Last Name <span class="text-danger">*</span></label>
                  <input type="text" class="form-control" id="lname" name="lname" value="<?=$lname?>">
                </div>
              </div>

              <div class="form-group row">
                <div class="col-md-12">
                  <label for="username" class="text-black">User Name <span class="text-danger">*</span></label>
                  <input type="text" class="form-control" id="username" name="username" value="<?=$username?>">
                </div>
              </div>

              <div class="form-group row">
                <div class="col-md-6">
                  <label for="password" class="text-black">Password <span class="text-danger">*</span></label>
                  <input type="password" class="form-control" id="password" name="password" value="<?=$password?>">
                </div>
                <div class="col-md-6">
                  <label for="confirm_password" class="text-black">Confirm Password <span class="text-danger">*</span></label>
                  <input type="password" class="form-control" id="confirm_password" name="confirm_password" value="<?=$confirm_password?>">
                </div>
              </div>

              <div class="form-group row">
                <div class="col-md-12">
                  <label for="address" class="text-black">Address <span class="text-danger">*</span></label>
                  <input type="text" class="form-control" id="address" name="address" placeholder="Street address" value="<?=$address?>">
                </div>
              </div>
              <div class="form-group row mb-5">
                <div class="col-md-6">
                  <label for="email" class="text-black">Email Address <span class="text-danger">*</span></label>
                  <input type="email" class="form-control" id="email" name="email" value="<?=$email?>">
                </div>
                <div class="col-md-6">
                  <label for="phone" class="text-black">Phone <span class="text-danger">*</span></label>
                  <input type="number" class="form-control" id="phone" name="phone" placeholder="Phone Number" value="<?=$phone?>">
                </div>
              </div>
              <div class="form-group">
                <label for="note" class="text-black">Order Notes</label>
                <textarea name="note" id="note" cols="30" rows="5" class="form-control"
                  placeholder="Write your notes here..."><?= $note;?></textarea>
              </div>
              <div class="form-group row">
                  <div class="col-lg-6">
                    <input type="submit" name="btnSignUp" class="btn btn-primary btn-lg btn-block" value="Sign up">
                  </div>
                </div>
            </form>
          </div>

        </div>
        <!-- </form> -->
      </div>
    </div>

    <?php require_once "./includes/footer.php"?>