<?php

if (session_status() == PHP_SESSION_NONE) {
  session_start();
}

if (! isset($_SESSION['login_authority'])  || $_SESSION['login_authority'] != "success") {
  header("Location: index.php");
  die;
}

require_once "../libraries/connection.php";
$title = "Add Medicine";
require_once "./includes/header.php";
require_once '..\vendor\autoload.php';

$validation_msgs = null;
$firstaid_name = $firstaid_detail = $firstaid_image = "";
if (isset($_POST['btnAddFirstAid'])) {
  $medicine_name = $_POST['firstaid_name'];
  $firstaid_detail = $_POST['firstaid_detail'];
  $firstaid_image = $_FILES['firstaid_image']['name'];
    // Form validation
  $validator = new GUMP();

  // Define the rules
  $rules = [
      'firstaid_name' => 'required|max_len,55|min_len,3',
      'firstaid_detail' => 'required|max_len,255|min_len,30',
      'firstaid_image'  => 'required_file|extension,png;jpg,bmp,gif,jpeg',
  ];

  // Define the filters
  $filters = [
      'firstaid_name' => 'trim|sanitize_string',
      'firstaid_detail' => 'trim|sanitize_string',
  ];

  $_POST = $validator->filter($_POST, $filters);
  $validated = $validator->is_valid(array_merge($_POST, $_FILES), $rules);    
  if ($validated === true) {
    $firstaid_name = mysqli_real_escape_string($GLOBALS['DB'], $_POST['firstaid_name']);
    $firstaid_detail = mysqli_real_escape_string($GLOBALS['DB'], $_POST['firstaid_detail']);
    $firstaid_language = mysqli_real_escape_string($GLOBALS['DB'], $_POST['firstaid_language']);

    // image
    $image_path = "images/firstAid/";
    $image_source = $_FILES["firstaid_image"]["tmp_name"];
    $extension = strtolower(PATHINFO($_FILES["firstaid_image"]["name"], PATHINFO_EXTENSION));
    $date_time = date("Ymd_his");
    $final_image_image = "image_" . $date_time . "." . $extension;

    //before insert we will check that exist user or email similar if exit we show err else insert
    $sql = "INSERT INTO firstaid_$firstaid_language VALUES(NULL, '$firstaid_name', '$firstaid_detail', '$final_image_image')";
    $result = mysqli_query($GLOBALS['DB'], $sql) or die(mysqli_error($GLOBALS['DB']));
    move_uploaded_file($image_source,$image_path.$final_image_image);
    echo "inserted";

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
            <strong class="text-black">Add First Aid</strong>
          </div>
        </div>
      </div>
    </div>

    <div class="site-section">
      <div class="container">
        <div class="row">
          <div class="col-md-9 mb-5 mb-md-0">
            <form method="post" action="addFirstAid.php" id="frmAddFirstAid" class="p-3 p-lg-5 border" enctype="multipart/form-data">

            <div class="form-group row">
                <div class="col-md-6">
                  <label for="firstaid_language" class="text-black">firstaid Language <span class="text-danger">*</span></label>
                  <input type="text" class="form-control" id="firstaid_language" name="firstaid_language" readonly value="<?=$language?>">
                </div>
              </div>

              <div class="form-group row">
                <div class="col-md-6">
                  <label for="firstaid_name" class="text-black">First Aid Name <span class="text-danger">*</span></label>
                  <input type="text" class="form-control" id="firstaid_name" name="firstaid_name" value="<?=$firstaid_name?>">
                </div>
              </div>

              <div class="form-group row">
                <div class="col-md-12">
                  <label for="firstaid_detail" class="text-black">First Aid Detail <span class="text-danger">*</span></label>
                  <textarea type="text" class="form-control" id="firstaid_detail" name="firstaid_detail"><?=$firstaid_detail?></textarea>
                </div>
              </div>

              <div class="form-group row">
                <div class="col-md-12">
                  <label for="firstaid_image" class="text-black">First Aid Image <span class="text-danger">*</span></label>
                  <input type="file" class="form-control" id="firstaid_image" name="firstaid_image" value="<?=$firstaid_image?>">
                </div>
              </div>
              <div class="form-group row">
                  <div class="col-lg-6">
                    <input type="submit" name="btnAddFirstAid" class="btn btn-primary btn-lg btn-block" value="Add FirstAid">
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
    $scripts .= "<script src='js/validate_addMedicine.js'></script>";
    
    require_once "./includes/footer.php";
    
    ?>