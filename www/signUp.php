<?php 
require_once "../libraries/connection.php";
$title = "Checkout"; 
require_once("./includes/header.php");
$passwordErr = "";
$errors = array("fname" => "", "lname"=>"", "fnamecharacter" => "", "lnamecharacter"=>"", "username"=>"", "password"=>"", "usernamecharacter"=>"", "passwordcharacter"=>"","confirm_password"=>"", "email"=>"", "phone"=>"", "address"=>"", "country"=>"", "phonecharacter"=>"", "addresscharacter"=>"", "countrycharacter"=>"");
$fname = $lname = $username = $password = $confirm_password = $email = $address = $country = $note = $phone = "";
if(isset($_POST['btnSignUp'])){
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

  if(empty($fname)){
    $errors["fname"] = "First Name can not be empty!"; 
  }else if(strlen(trim($fname)) < 3 || strlen(trim($fname)) > 55){
    $errors["fnamecharacter"] = "First Name must be between 3 and 55 characters!"; 
  }else{
    $errors["fname"] = $errors["fnamecharacter"] = "";
  }

  if(empty($lname)){
    $errors["lname"] = "Last Name can not be empty!"; 
  }else if(strlen(trim($lname)) < 3 || strlen(trim($lname)) > 55){
    $errors["lnamecharacter"] = "Last Name must be between 3 and 55 characters!"; 
  }else{
    $errors["lname"] = $errors["lnamecharacter"] = "";
  }
  
  if(empty($password)){
    $errors["password"] = "Password can not be empty!"; 
  }else if(strlen(trim($password)) < 3 || strlen(trim($password)) > 55){
    $errors["passwordcharacter"] = "Password must be between 3 and 55 characters!"; 
  }else{
    $errors["password"] = $errors["passwordcharacter"] = "";
  }

  if(empty($confirm_password)){
    $errors["confirm_password"] = "Confirm Password can not be empty!"; 
  }else{
    $errors["confirm_password"] = "";
  }

  if(empty($email)){
    $errors["email"] = "email can not be empty!"; 
  }else{
    $errors["email"] = "";
  }
  
  if(empty($phone)){
    $errors["phone"] = "Phone can not be empty!"; 
  }else if(strlen(trim($phone)) < 10 || strlen(trim($phone)) > 20){
    $errors["phonecharacter"] = "Phone must be between 10 and 20 numbers!"; 
  }else{
    $errors["phone"] =  $errors["phonecharacter"] = "";
  }


  if(empty($address)){
    $errors["address"] = "Address can not be empty!"; 
  }else if(strlen(trim($address)) < 10 || strlen(trim($address)) > 55){
    $errors["addresscharacter"] = "Address must be between 10 and 55 characters!"; 
  }else{
    $errors["address"] = $errors["addresscharacter"] = "";
  }

  if(empty($country)){
    $errors["country"] = "Country can not be empty!"; 
  }else if(strlen(trim($country)) < 5 || strlen(trim($country)) > 55){
    $errors["countrycharacter"] = "country must be between 5 and 55 characters!"; 
  }else{
    $errors["country"]= $errors["countrycharacter"] = "";
  }

  if(empty($username)){
    $errors["username"] = "Username can not be empty!"; 
  }else if(strlen(trim($username)) < 6 || strlen(trim($username)) > 55){
    $errors["usernamecharacter"] = "Username must be between 6 and 55 characters!"; 
  }else{ 
    $errors["username"] = $errors["usernamecharacter"] = "";
  }

  if(strcmp($password, $confirm_password) !== 0){
    $passwordErr = "Password does not match";
  }else{
    $passwordErr = "";
  }

  if(empty($errors["fname"]) && empty($errors["lname"]) && empty($errors["username"]) 
        && empty($errors["email"]) && empty($errors["country"]) && empty($errors["address"]) &&
        empty($errors["phone"]) && empty($errors["password"]) && empty($errors["confirm_password"]) && empty($passwordErr)
        && empty($errors["usernamecharacter"]) && empty($errors["countrycharacter"]) && empty($errors["addresscharacter"]) && empty($errors['phonecharacter'])
        && empty($errors['passwordcharacter']) && empty($errors['lnamecharacter'])&& empty($errors['fnamecharacter'])){
    
        //before insert we will check that exist user or email similar if exit we show err else insert

        $sql = "INSERT INTO users VALUES(NULL, '$fname', '$lname', '$username', '$address', '$email', '$country', '$phone', '$note', '$password')";
        $result = mysqli_query($GLOBALS['DB'], $sql) or die(mysqli_error($GLOBALS['DB']));
          
  }
  // else {
  //   echo "Emptyyyyy";
  // }

  //  "<pre>".print_r($errors)."</pre>";

  //  "<pre>".print_r($_POST)."</pre>";

}

?>
<body>

  <div class="site-wrap">
  <?php require_once("./includes/navbar.php")?>

    <div class="bg-light py-3">
      <div class="container">
        <div class="row">
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
                  <option value="<?= $country?>">Select a country</option>
                  <option value="Bangladesh">Bangladesh</option>
                  <option value="Algeria">Algeria</option>
                  <option value="Afghanistan">Afghanistan</option>
                  <option value="Ghana">Ghana</option>
                  <option value="Albania">Albania</option>
                  <option value="Bahrain">Bahrain</option>
                  <option value="Colombia">Colombia</option>
                  <option value="Dominican Republic">Dominican Republic</option>
                </select>
                <label for="country" class="text-black"><span class="text-danger"><?= $errors['country']?></span></label>
                <label for="country" class="text-black"><span class="text-danger"><?= $errors['countrycharacter']?></span></label>
              </div>
              <div class="form-group row">
                <div class="col-md-6">
                  <label for="fname" class="text-black">First Name <span class="text-danger">*</span></label>
                  <input type="text" class="form-control" id="fname" name="fname" value="<?=$fname?>">
                  <label for="fname" class="text-black"><span class="text-danger"><?= $errors['fname'];?> </span></label>
                  <label for="fname" class="text-black"><span class="text-danger"><?= $errors['fnamecharacter'];?> </span></label>
                </div>
                <div class="col-md-6">
                  <label for="lname" class="text-black">Last Name <span class="text-danger">*</span></label>
                  <input type="text" class="form-control" id="lname" name="lname" value="<?= $lname?>">
                  <label for="lname" class="text-black"><span class="text-danger"><?= $errors['lname'];?> </span></label>
                  <label for="lname" class="text-black"><span class="text-danger"><?= $errors['lnamecharacter'];?> </span></label>
                </div>
              </div>
    
              <div class="form-group row">
                <div class="col-md-12">
                  <label for="username" class="text-black">User Name <span class="text-danger">*</span></label>
                  <input type="text" class="form-control" id="username" name="username" value="<?= $username?>">
                  <label for="username" class="text-black"><span class="text-danger"><?= $errors['username'];?></span></label>       
                  <label for="username" class="text-black"><span class="text-danger"><?= $errors['usernamecharacter'];?></span></label>       
                </div>
              </div>

              <div class="form-group row">
                <div class="col-md-6">
                  <label for="password" class="text-black">Password <span class="text-danger">*</span></label>
                  <input type="password" class="form-control" id="password" name="password" value="<?= $password?>">
                  <label for="password" class="text-black"><span class="text-danger"><?= $errors['password']?></span></label>
                  <label for="password" class="text-black"><span class="text-danger"><?= $errors['passwordcharacter']?></span></label>
                </div>
                <div class="col-md-6">
                  <label for="confirm_password" class="text-black">Confirm Password <span class="text-danger">*</span></label>
                  <input type="password" class="form-control" id="confirm_password" name="confirm_password" value="<?= $confirm_password?>">
                  <label for="password" class="text-black"><span class="text-danger"><?= $errors['confirm_password']?></span></label>
                  <label for="password" class="text-black"><span class="text-danger"><?= $passwordErr?></span></label>
                </div>
              </div>
    
              <div class="form-group row">
                <div class="col-md-12">
                  <label for="address" class="text-black">Address <span class="text-danger">*</span></label>
                  <input type="text" class="form-control" id="address" name="address" placeholder="Street address" value="<?= $address?>">
                  <label for="address" class="text-black"><span class="text-danger"><?= $errors['address']?></span></label>
                  <label for="address" class="text-black"><span class="text-danger"><?= $errors['addresscharacter']?></span></label>
                </div>
              </div>
              <div class="form-group row mb-5">
                <div class="col-md-6">
                  <label for="email" class="text-black">Email Address <span class="text-danger">*</span></label>
                  <input type="email" class="form-control" id="email" name="email" value="<?= $email?>">
                  <label for="email" class="text-black"><span class="text-danger"><?= $errors['email']?></span></label>
                </div>
                <div class="col-md-6">
                  <label for="phone" class="text-black">Phone <span class="text-danger">*</span></label>
                  <input type="number" class="form-control" id="phone" name="phone" placeholder="Phone Number" value="<?=$phone?>">
                  <label for="phone" class="text-black"><span class="text-danger"><?= $errors['phone']?></span></label>
                  <label for="phone" class="text-black"><span class="text-danger"><?= $errors['phonecharacter']?></span></label>
                </div>
              </div>
              <div class="form-group">
                <label for="note" class="text-black">Order Notes</label>
                <textarea name="note" id="note" cols="30" rows="5" class="form-control"
                  placeholder="Write your notes here..."></textarea>
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
    

    <div class="site-section bg-secondary bg-image" style="background-image: url('images/bg_2.jpg');">
      <div class="container">
        <div class="row align-items-stretch">
          <div class="col-lg-6 mb-5 mb-lg-0">
            <a href="#" class="banner-1 h-100 d-flex" style="background-image: url('images/bg_1.jpg');">
              <div class="banner-1-inner align-self-center">
                <h2>Pharma Products</h2>
                <p>Lorem, ipsum dolor sit amet consectetur adipisicing elit. Molestiae ex ad minus rem odio voluptatem.
                </p>
              </div>
            </a>
          </div>
          <div class="col-lg-6 mb-5 mb-lg-0">
            <a href="#" class="banner-1 h-100 d-flex" style="background-image: url('images/bg_2.jpg');">
              <div class="banner-1-inner ml-auto  align-self-center">
                <h2>Rated by Experts</h2>
                <p>Lorem, ipsum dolor sit amet consectetur adipisicing elit. Molestiae ex ad minus rem odio voluptatem.
                </p>
              </div>
            </a>
          </div>
        </div>
      </div>
    </div>
    <?php require_once("./includes/footer.php")?>