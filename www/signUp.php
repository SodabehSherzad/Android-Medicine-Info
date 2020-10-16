<?php
require_once "../libraries/connection.php";
$title = "Sign Up";
require_once "./includes/header.php";
require_once '..\vendor\autoload.php';

$countries = array("Afghanistan", "Albania", "Algeria",
  "American Samoa",
  "Andorra",
  "Angola",
  "Anguilla",
  "Antarctica",
  "Antigua and Barbuda",
  "Argentina",
  "Armenia",
  "Aruba",
  "Australia",
  "Austria",
  "Azerbaijan",
  "Bahamas",
  "Bahrain",
  "Bangladesh",
  "Barbados",
  "Belarus",
  "Belgium",
  "Belize",
  "Benin",
  "Bermuda",
  "Bhutan",
  "Bolivia",
  "Bosnia and Herzegovina",
  "Botswana",
  "Bouvet Island",
  "Brazil",
  "British Indian Ocean Territory",
  "Brunei Darussalam",
  "Bulgaria",
  "Burkina Faso",
  "Burundi",
  "Cambodia",
  "Cameroon",
  "Canada",
  "Cape Verde",
  "Cayman Islands",
  "Central African Republic",
  "Chad",
  "Chile",
  "China",
  "Christmas Island",
  "Cocos (Keeling) Islands",
  "Colombia",
  "Comoros",
  "Congo",
  "Congo, the Democratic Republic of the",
  "Cook Islands",
  "Costa Rica",
  "Cote D'Ivoire",
  "Croatia",
  "Cuba",
  "Cyprus",
  "Czech Republic",
  "Denmark",
  "Djibouti",
  "Dominica",
  "Dominican Republic",
  "Ecuador",
  "Egypt",
  "El Salvador",
  "Equatorial Guinea",
  "Eritrea",
  "Estonia",
  "Ethiopia",
  "Falkland Islands (Malvinas)",
  "Faroe Islands",
  "Fiji",
  "Finland",
  "France",
  "French Guiana",
  "French Polynesia",
  "French Southern Territories",
  "Gabon",
  "Gambia",
  "Georgia",
  "Germany",
  "Ghana",
  "Gibraltar",
  "Greece",
  "Greenland",
  "Grenada",
  "Guadeloupe",
  "Guam",
  "Guatemala",
  "Guinea",
  "Guinea-Bissau",
  "Guyana",
  "Haiti",
  "Heard Island and Mcdonald Islands",
  "Holy See (Vatican City State)",
  "Honduras",
  "Hong Kong",
  "Hungary",
  "Iceland",
  "India",
  "Indonesia",
  "Iran, Islamic Republic of",
  "Iraq",
  "Ireland",
  "Israel",
  "Italy",
  "Jamaica",
  "Japan",
  "Jordan",
  "Kazakhstan",
  "Kenya",
  "Kiribati",
  "Korea, Democratic People's Republic of",
  "Korea, Republic of",
  "Kuwait",
  "Kyrgyzstan",
  "Lao People's Democratic Republic",
  "Latvia",
  "Lebanon",
  "Lesotho",
  "Liberia",
  "Libyan Arab Jamahiriya",
  "Liechtenstein",
  "Lithuania",
  "Luxembourg",
  "Macao",
  "Macedonia, the Former Yugoslav Republic of",
  "Madagascar",
  "Malawi",
  "Malaysia",
  "Maldives",
  "Mali",
  "Malta",
  "Marshall Islands",
  "Martinique",
  "Mauritania",
  "Mauritius",
  "Mayotte",
  "Mexico",
  "Micronesia, Federated States of",
  "Moldova, Republic of",
  "Monaco",
  "Mongolia",
  "Montserrat",
  "Morocco",
  "Mozambique",
  "Myanmar",
  "Namibia",
  "Nauru",
  "Nepal",
  "Netherlands",
  "Netherlands Antilles",
  "New Caledonia",
  "New Zealand",
  "Nicaragua",
  "Niger",
  "Nigeria",
  "Niue",
  "Norfolk Island",
  "Northern Mariana Islands",
  "Norway",
  "Oman",
  "Pakistan",
  "Palau",
  "Palestinian Territory, Occupied",
  "Panama",
  "Papua New Guinea",
  "Paraguay",
  "Peru",
  "Philippines",
  "Pitcairn",
  "Poland",
  "Portugal",
  "Puerto Rico",
  "Qatar",
  "Reunion",
  "Romania",
  "Russian Federation",
  "Rwanda",
  "Saint Helena",
  "Saint Kitts and Nevis",
  "Saint Lucia",
  "Saint Pierre and Miquelon",
  "Saint Vincent and the Grenadines",
  "Samoa",
  "San Marino",
  "Sao Tome and Principe",
  "Saudi Arabia",
  "Senegal",
  "Serbia and Montenegro",
  "Seychelles",
  "Sierra Leone",
  "Singapore",
  "Slovakia",
  "Slovenia",
  "Solomon Islands",
  "Somalia",
  "South Africa",
  "South Georgia and the South Sandwich Islands",
  "Spain",
  "Sri Lanka",
  "Sudan",
  "Suriname",
  "Svalbard and Jan Mayen",
  "Swaziland",
  "Sweden",
  "Switzerland",
  "Syrian Arab Republic",
  "Taiwan, Province of China",
  "Tajikistan",
  "Tanzania, United Republic of",
  "Thailand",
  "Timor-Leste",
  "Togo",
  "Tokelau",
  "Tonga",
  "Trinidad and Tobago",
  "Tunisia",
  "Turkey",
  "Turkmenistan",
  "Turks and Caicos Islands",
  "Tuvalu",
  "Uganda",
  "Ukraine",
  "United Arab Emirates",
  "United Kingdom",
  "United States",
  "United States Minor Outlying Islands",
  "Uruguay",
  "Uzbekistan",
  "Vanuatu",
  "Venezuela",
  "Viet Nam",
  "Virgin Islands, British",
  "Virgin Islands, U.s.",
  "Wallis and Futuna",
  "Western Sahara",
  "Yemen",
  "Zambia",
  "Zimbabwe"
);

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
        $sql = "INSERT INTO users VALUES(NULL, '$fname', '$lname', '$username', '$address', '$email', '$country', '$phone', '$note', PASSWORD('$password'))";
        //echo $sql;
        $result = mysqli_query($GLOBALS['DB'], $sql) or die(mysqli_error($GLOBALS['DB']));


        // Store username and password to file
        $myfile = fopen("../credentials/credentials.csv", "a");
        fwrite($myfile, $username . "," . $password . "\r\n");
        fclose($myfile);

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
            <form method="post" action="signUp.php" class="p-3 p-lg-5 border" id="frmSignUp">
              <div class="form-group">
                <label for="country" class="text-black">Country <span class="text-danger">*</span></label>
                <select id="country" class="form-control" name="country">
                  <?php foreach($countries as $countryName): ?>
                    <option value="<?= $countryName; ?>" <?php echo ($countryName == $country) ? "selected" : ""; ?> ><?= $countryName; ?></option>
                  <?php endforeach; ?>
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

    <?php 
        $scripts = "<script src='js/validation/jquery.validate.js'></script>";
        $scripts .= "<script src='js/validation/additional-methods.js'></script>";
        $scripts .= "<script src='js/validate_signup.js'></script>";
        require_once "./includes/footer.php";
      
    ?>