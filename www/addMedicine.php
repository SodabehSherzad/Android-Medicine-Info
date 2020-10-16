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
$medicine_name = $medicine_usage = $medicine_detail = $medicine_image = $medicine_category ="";
if (isset($_POST['btnAddMedicine'])) {
  $medicine_category = $_POST['medicine_category'];
  $medicine_name = $_POST['medicine_name'];
  $medicine_usage = $_POST['medicine_usage'];
  $medicine_detail = $_POST['medicine_detail'];
  $medicine_image = $_FILES['medicine_image']['name'];
    // Form validation
  $validator = new GUMP();

  // Define the rules
  $rules = [
      'medicine_name' => 'required|max_len,55|min_len,3',
      'medicine_usage' => 'required|max_len,55|min_len,4',
      'medicine_detail' => 'required|max_len,255|min_len,30',
      'medicine_image'  => 'required_file|extension,png;jpg,bmp,gif,jpeg',
  ];

  // Define the filters
  $filters = [
      'medicine_name' => 'trim|sanitize_string',
      'medicine_usage' => 'trim|sanitize_string',
      'medicine_detail' => 'trim|sanitize_string',
  ];

  $_POST = $validator->filter($_POST, $filters);
  $validated = $validator->is_valid(array_merge($_POST, $_FILES), $rules);    
  if ($validated === true) {
    $medicine_category = mysqli_real_escape_string($GLOBALS['DB'], $_POST['medicine_category']);
    $medicine_name = mysqli_real_escape_string($GLOBALS['DB'], $_POST['medicine_name']);
    $medicine_usage = mysqli_real_escape_string($GLOBALS['DB'], $_POST['medicine_usage']);
    $medicine_detail = mysqli_real_escape_string($GLOBALS['DB'], $_POST['medicine_detail']);
    $medicine_language = mysqli_real_escape_string($GLOBALS['DB'], $_POST['medicine_language']);

    // image
    $image_path = "images/medicine/";
    $image_source = $_FILES["medicine_image"]["tmp_name"];
    $extension = strtolower(PATHINFO($_FILES["medicine_image"]["name"], PATHINFO_EXTENSION));
    $date_time = date("Ymd_his");
    $final_image_image = "image_" . $date_time . "." . $extension;

    //before insert we will check that exist user or email similar if exit we show err else insert
    $sql = "INSERT INTO medicines_$medicine_language VALUES(NULL, '$medicine_name', '$medicine_usage', '$medicine_detail', '$final_image_image', $medicine_category)";
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
            <strong class="text-black">Add Medicine</strong>
          </div>
        </div>
      </div>
    </div>

    <div class="site-section">
      <div class="container">
        <div class="row">
          <div class="col-md-9 mb-5 mb-md-0">
            <form method="post" action="addMedicine.php" id="frmAddMedicine" class="p-3 p-lg-5 border" enctype="multipart/form-data">

            <div class="form-group row">
                <div class="col-md-6">
                  <label for="medicine_language" class="text-black">Medicine Language <span class="text-danger">*</span></label>
                  <input type="text" class="form-control" id="medicine_language" name="medicine_language" readonly value="<?=$language?>">
                </div>
                <div class="col-md-6">
                  <label for="medicine_category" class="text-black">Medicine Category <span class="text-danger">*</span></label>
                  <select type="text" class="form-control" id="medicine_category" name="medicine_category">
                    <option value="1" <?php ($medicine_category == 1) ? "selected" : ""; ?> >Common Medicine (دارو های رایج)</option>
                    <option value="2" <?php ($medicine_category == 2) ? "selected" : ""; ?>>Herbal Medicine (دارو های گیاهی)</option>
                  </select>
                </div>
              </div>

              <div class="form-group row">
                <div class="col-md-6">
                  <label for="medicine_name" class="text-black">Medicine Name <span class="text-danger">*</span></label>
                  <input type="text" class="form-control" id="medicine_name" name="medicine_name" value="<?=$medicine_name?>">
                </div>
                <div class="col-md-6">
                  <label for="medicine_usage" class="text-black">Medicine Usage <span class="text-danger">*</span></label>
                  <input type="text" class="form-control" id="medicine_usage" name="medicine_usage" value="<?=$medicine_usage?>">
                </div>
              </div>

              <div class="form-group row">
                <div class="col-md-12">
                  <label for="medicine_detail" class="text-black">Medicine Detail <span class="text-danger">*</span></label>
                  <textarea type="text" class="form-control" id="medicine_detail" name="medicine_detail"><?=$medicine_detail?></textarea>
                </div>
              </div>

              <div class="form-group row">
                <div class="col-md-12">
                  <label for="medicine_image" class="text-black">Medicine Image <span class="text-danger">*</span></label>
                  <input type="file" class="form-control" id="medicine_image" name="medicine_image" value="<?=$medicine_image?>">
                </div>
              </div>
              <div class="form-group row">
                  <div class="col-lg-6">
                    <input type="submit" name="btnAddMedicine" class="btn btn-primary btn-lg btn-block" value="Add Medicine">
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