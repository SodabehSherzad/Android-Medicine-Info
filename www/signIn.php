<?php
require_once "../libraries/connection.php";

$title = "Login";
require_once "./includes/header.php";

$errors = ["username" => "", "password" => "", "errorFind" => "" ];
$username = "";
$password = "";
if (isset($_POST['btnLogin'])) {
    //echo "<pre>";
    // print_r($_POST);
    //echo "</pre>";

    $username = $_POST['username'];
    $password = $_POST['password'];

    if (trim($username) === '') {
        $errors["username"] = "Username is requried!";
    } else if (strlen($username) < 6 || strlen($username) > 55) {
        $errors["username"] = "Username must be between 6 and 55 characters!";
    }

    if (trim($password) === '') {
        $errors["password"] = "Password is requried!";
    } else if (strlen($password) < 3 || strlen($password) > 55) {
        $errors["password"] = "Password must be between 3 and 55 characters!";
    }

    if ( empty($errors["password"]) && empty($errors["username"]) ) {
      $username = mysqli_real_escape_string($GLOBALS['DB'], $username);
      $password = mysqli_real_escape_string($GLOBALS['DB'], $password);
      $sql = "SELECT * FROM users WHERE `user_name` = '$username' AND `password` = sha1('$password') LIMIT 1";
      echo "<h1>$sql</h1>";
      $result = mysqli_query($GLOBALS['DB'], $sql) or die(mysqli_error($GLOBALS['DB']));
      $row = mysqli_fetch_assoc($result);
      if($row){
        echo "<label><span class='text-success'>You successfully Login!!!</span></label>";
        // header("location: index.php");
      }else{
        // header("location: signUp.php");
        $errors["errorFind"] = "The password or Username do not exsit!";
      }
      // $row = mysqli_fetch_assoc($result);
      // echo "<pre>".print_r($row)."</pre>";
    }

}
?>
<body>

  <div class="site-wrap">
  <?php require_once "./includes/navbar.php"?>

    <div class="bg-light py-3">
      <div class="container">
        <div class="row">
          <div class="col-md-12 mb-0">
            <a href="index.php">Home</a> <span class="mx-2 mb-0">/</span>
            <strong class="text-black">Sign in</strong>
          </div>
        </div>
      </div>
    </div>

    <div class="site-section">
      <div class="container">
        <div class="row mb-5">
          <div class="col-md-12">
            <div class="bg-light rounded p-3">
              <p class="mb-0">Create Account <a href="signUp.php" class="d-inline-block">Click here</a> to Sign up</p>
            </div>
          </div>
        </div>
        <div class="row">
        
          <div class="col-md-9">
            <h2 class="h3 mb-5 text-black">Sign in Page</h2>
          </div>
          <div class="col-md-12">
            <form id="frmLogin" action="signIn.php" method="post">

              <div class="p-3 p-lg-5 border">
                <div class="form-group row">
                  <div class="col-md-6">
                    <label for="username" class="text-black">Username <span class="text-danger">*</span></label>
                    <input type="text" class="form-control" id="username" name="username" value="<?= $username; ?>">
                    <label for="username" class="text-black"><span class="text-danger"><?= $errors["username"]?></span></label>
                  </div>
                </div>
                <div class="form-group row">
                  <div class="col-md-6">
                    <label for="password" class="text-black">Password <span class="text-danger">*</span></label>
                    <input type="password" class="form-control" id="password" name="password" value="<?= $password; ?>">
                    <label for="password" class="text-black"><span class="text-danger"><?= $errors["password"]?></span></label>
                  </div>
                </div>
                <div class="form-group row">
                  <div class="col-lg-6">
                    <input type="submit" id="btnLogin" name="btnLogin" class="btn btn-primary btn-lg btn-block" value="Sign In">
                  </div>
                </div>
                <div class="form-group row">
                  <div class="col-lg-6">
                    <label><span class='text-danger'><?= $errors['errorFind']?></span></label>
                  </div>
                </div>
              </div>

            </form>

          </div>

        </div>
      </div>
    </div>



    <div class="site-section bg-primary">
      <div class="container">
        <div class="row">
          <div class="col-12">
            <h2 class="text-white mb-4">Offices</h2>
          </div>
          <div class="col-lg-4">
            <div class="p-4 bg-white mb-3 rounded">
              <span class="d-block text-black h6 text-uppercase">New York</span>
              <p class="mb-0">203 Fake St. Mountain View, San Francisco, California, USA</p>
            </div>
          </div>
          <div class="col-lg-4">
            <div class="p-4 bg-white mb-3 rounded">
              <span class="d-block text-black h6 text-uppercase">London</span>
              <p class="mb-0">203 Fake St. Mountain View, San Francisco, California, USA</p>
            </div>
          </div>
          <div class="col-lg-4">
            <div class="p-4 bg-white mb-3 rounded">
              <span class="d-block text-black h6 text-uppercase">Canada</span>
              <p class="mb-0">203 Fake St. Mountain View, San Francisco, California, USA</p>
            </div>
          </div>
        </div>
      </div>

    </div>
    <?php
$scripts = "<script src='js/validation/jquery.validate.js'></script>";
$scripts .= "<script src='js/validate_login.js'></script>";
require_once "./includes/footer.php";
?>
