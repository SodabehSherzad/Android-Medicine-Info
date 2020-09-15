<?php
require_once "../helpers/common.php";
require_once "../libraries/connection.php";

$id = (int) $_GET['id'];
$sql = "SELECT * FROM medicines_$language WHERE id = $id LIMIT 1";
$result = mysqli_query($GLOBALS['DB'], $sql) or die(mysqli_error($GLOBALS['DB']));

$medicineDetails = "";
if ($row = mysqli_fetch_row($result)) {
    $id = clean_data($row[0]);
    $name = clean_data($row[1]);
    $usage = clean_data($row[2]);
    $details = clean_data($row[3]);
    $details2 = str_replace(array("\r\n", "\n", "'"), array('', '', ''), $details);
    $image = clean_data($row[4]);

    if (!file_exists("images/medicine/$image.webp")) {
        $image = "default";
    }

    $medicineDetails .= "<div class='row'>
            <div class='col-md-5 mr-auto'>
              <div class='border text-center'>
                <img src='images/medicine/$image.webp' alt='Image'  class='img-fluid p-5'>
              </div>
            </div>
            <div class='col-md-6'>
              <h2 class='text-black'>$name</h2>
              <h4>$usage</h4>
              <p>$details</p>
              <p><a href='bookMarks.php' class='buy-now btn btn-sm height-auto px-4 py-3 btn-primary' onclick='medicinesFavorite($id)'>$add</a></p>
              <p style='display: inline-block'><a href='#' onclick=\"textToSpeech('$details2')\" class='btn btn-sm btn-primary'>Play Voice</a></p>
              <p style='display: inline-block'><a href='#' onclick=\"stopSpeech()\" class='btn btn-sm btn-primary'>Stop Voice</a></p>

            </div>
          </div>";
} else {
    $medicineDetails .= "<h1>Medicine with ID = $id Not Found!</h1>";
    $name = "Not Found!";
}

$title = "Medicine Details";
require_once "./includes/header.php";
?>
<body>

  <div class="site-wrap">
  <?php require_once "./includes/navbar.php"?>

    <div class="bg-light py-3">
      <div class="container">
        <div class="row">
          <div class="col-md-12 mb-0"><a href="index.php"><?= $homePage?></a> <span class="mx-2 mb-0">/</span> <a
              href="medicine.php"> Medicine</a> <span class="mx-2 mb-0">/</span> <strong class="text-black"><?= $name ?></strong></div>
        </div>
      </div>
    </div>

    <div class="site-section">
      <div class="container">
        <?php echo $medicineDetails; ?>
      </div>
    </div>

    <?php require_once "./includes/footer.php"?>
