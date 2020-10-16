<?php 

require_once "../helpers/common.php";
require_once "../libraries/connection.php";

$id = (int) $_GET['id'];
$sql = "SELECT * FROM firstaid_$language WHERE id = $id LIMIT 1";
$result = mysqli_query($GLOBALS['DB'], $sql) or die(mysqli_error($GLOBALS['DB']));

$name = "";

$firstaidDetails = "";
if ($row = mysqli_fetch_row($result)) {
    $id = clean_data($row[0]);
    $name .= clean_data($row[1]);
    $details = clean_data($row[2]);
    $details2 = str_replace(array("\r\n", "\n", "'"), array('', '', ''), $details);
    $logo = clean_data($row[4]);
    $image = clean_data($row[3]);

    if (!file_exists("images/firstAid/$image")) {
        $image = "default.webp";
    }

    $check = ($language == 'en')? 'inline-block' : 'none';
    $origin = "firstaid";
    $ids =  explode(",", $_COOKIE[$origin]);
    $add_or_remove_text = ( in_array($id, $ids) ) ? $remove :  $add;
    $firstaidDetails .= "<div class='row'>
            <div class='col-md-5 mr-auto'>
              <div class='border text-center'>
                <img src='images/firstAid/$image' alt='Image'  class='img-fluid p-5'>
              </div>
              <div class='border text-center'>
                <img src='images/firstAid/$logo' alt='Image'  class='img-fluid p-5'>
              </div>
            </div>
            <div class='col-md-6'>
              <h2 class='text-black'>$name</h2>
              <p>$details</p>

              <p><a href='#' class='buy-now btn btn-sm height-auto px-4 py-3 btn-primary' onclick='medicinesFavorite(\"$origin\", $id)'>$add_or_remove_text</a></p>
              <p style='display: $check'><a href='#' onclick=\"textToSpeech('$details2')\" class='btn btn-sm btn-primary'>Play Voice</a></p>
              <p style='display: $check'><a href='#' onclick=\"stopSpeech()\" class='btn btn-sm btn-primary'>Stop Voice</a></p>

            </div>
          </div>";
  } else {
      $firstaidDetails .= "<h1>Herbal Medicine with ID = $id Not Found!</h1>";
      $name = "Not Found!";
  }

$title = "First Aid Details"; 
require_once("./includes/header.php")
?>
<body>

  <div class="site-wrap">
  <?php require_once("./includes/navbar.php")?>

    <div class="bg-light py-3">
      <div class="container">
        <div class="row">
          <div class="col-md-12 mb-0"><a href="index.php"><?= $homePage?></a> <span class="mx-2 mb-0">/</span> <a
              href="firstAid.php"><?= $firstaidPage?></a> <span class="mx-2 mb-0">/</span> <strong class="text-black"><?= $name ?></strong></div>
        </div>
      </div>
    </div>

    <div class="site-section">
      <div class="container">
        <?php echo $firstaidDetails; ?>
      </div>
    </div>
    <?php require_once("./includes/footer.php")?>
