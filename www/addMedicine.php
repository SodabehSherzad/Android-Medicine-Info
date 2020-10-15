<?php
require_once "../libraries/connection.php";
$title = "Checkout";
require_once "./includes/header.php";
require_once '..\vendor\autoload.php';

$validation_msgs = null;
$name = $usage = $detail = $image = "";
if (isset($_POST['btnAddMedicine'])) {
  $name = $_POST['name'];
  $usage = $_POST['usage'];
  $detail = $_POST['detail'];
  $image = $_FILES['image']['name'];
    // Form validation
  $validator = new GUMP();

  // Define the rules
  $rules = [
      'name' => 'required|max_len,55|min_len,3',
      'usage' => 'required|max_len,55|min_len,4',
      'detail' => 'required|max_len,255|min_len,30',
  ];

  // Define the filters
  $filters = [
      'name' => 'trim|sanitize_string',
      'usage' => 'trim|sanitize_string',
      'detail' => 'trim|sanitize_string',
  ];

  $_POST = $validator->filter($_POST, $filters);
  $validated = $validator->is_valid($_POST, $rules);

	$file_path = "images/medicine/";
	$source = $_FILES["image"]["tmp_name"];
	$photoType = $_FILES["image"]["type"];

	$allowed_extension = 					
							array(
								"png",
								"jpg",
								"JPG",
								"PNG",
                "jpeg",
                "webp"
							);
	
	$extension = strtolower(PATHINFO($image, PATHINFO_EXTENSION));
		
  if(!in_array($extension, $allowed_extension)){		
    $fileErr = "Unfortunatly the type file is not allowed!";		
  }
  else{
    
    $fulldate = date("Y_m_d h_i_s");
    $photoName = "pic _ ".$fulldate.".".$extension;
    
    move_uploaded_file($source,$file_path.$image);

  }
    
  if ($validated === true) {
    $name = mysqli_real_escape_string($GLOBALS['DB'], $_POST['name']);
    $usage = mysqli_real_escape_string($GLOBALS['DB'], $_POST['usage']);
    $detail = mysqli_real_escape_string($GLOBALS['DB'], $_POST['detail']);
    //before insert we will check that exist user or email similar if exit we show err else insert
    $sql = "INSERT INTO medicines_en VALUES(NULL, '$name', '$usage', '$detail', '$image', 1)";
    $result = mysqli_query($GLOBALS['DB'], $sql) or die(mysqli_error($GLOBALS['DB']));
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
            <form method="post" action="addMedicine.php" class="p-3 p-lg-5 border" enctype="multipart/form-data">
              <div class="form-group row">
                <div class="col-md-6">
                  <label for="name" class="text-black">Medicine Name <span class="text-danger">*</span></label>
                  <input type="text" class="form-control" id="name" name="name" value="<?=$name?>">
                </div>
                <div class="col-md-6">
                  <label for="usage" class="text-black">Medicine Usage <span class="text-danger">*</span></label>
                  <input type="text" class="form-control" id="usage" name="usage" value="<?=$usage?>">
                </div>
              </div>

              <div class="form-group row">
                <div class="col-md-12">
                  <label for="detail" class="text-black">Medicine Detail <span class="text-danger">*</span></label>
                  <textarea type="text" class="form-control" id="detail" name="detail"><?=$detail?></textarea>
                </div>
              </div>

              <div class="form-group row">
                <div class="col-md-12">
                  <label for="image" class="text-black">Medicine Image <span class="text-danger">*</span></label>
                  <input type="file" class="form-control" id="image" name="image" value="<?=$image?>">
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

    <?php require_once "./includes/footer.php"?>