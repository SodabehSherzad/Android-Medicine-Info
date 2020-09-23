<?php
require_once "../helpers/common.php";
require_once "../lang/$language.php";
require_once "../libraries/connection.php";
require_once "../libraries/Paginator.php";

$category = (isset($_GET['category']) && $_GET['category'] > 0) ? (int) $_GET['category'] : 1;

$title = "Medicine";

define('ROWS_PER_PAGE', 9);
$total = mysqli_fetch_row(mysqli_query($GLOBALS['DB'], "SELECT count(id) AS total FROM medicines_$language WHERE category_id = $category"))[0];
$current_page = (isset($_GET['page']) && $_GET['page'] > 0) ? (int) $_GET['page'] : 1;
$urlPattern = '?page=(:num)';
$offset = ($current_page - 1) * ROWS_PER_PAGE;
$paginator = new Paginator($total, ROWS_PER_PAGE, $current_page, $urlPattern);
$paginator->setNextText("");
$paginator->setPreviousText("");

$sql = "SELECT * FROM medicines_$language WHERE category_id = $category  LIMIT $offset, " . ROWS_PER_PAGE;
$result = mysqli_query($GLOBALS['DB'], $sql) or die(mysqli_error($GLOBALS['DB']));

$medicines = "";
while ($row = mysqli_fetch_assoc($result)) {
    $id = clean_data($row['id']);
    $name = clean_data($row['name']);
    $usage = clean_data($row['usage']);
    $image = clean_data($row['image']);

    if (!file_exists("images/medicine/$image.webp")) {
        $image = "image";
    }

    $medicines .= "<div class='col-sm-6 col-lg-4 text-center item mb-4'>
      <a href='medicineDetails.php?id=$id'> <img src='images/medicine/$image.webp' alt='$name' title='$name' width='250' height ='250'></a>
      <h4 class='text-dark'><a href='medicineDetails.php?id=$id'>$name</a></h4>
      <p class='price'>$usage</p>
    </div>";
}

require_once "./includes/header.php"
?>

<body>

  <div class="site-wrap">
  <?php require_once "./includes/navbar.php"?>

    <div class="bg-light py-3">
      <div class="container">
        <div class="row">
          <div class="col-md-12 mb-0"><a href="index.php"><?= $homePage?></a> <span class="mx-2 mb-0">/</span> <strong class="text-black">Medicines</strong></div>
        </div>
      </div>
    </div>
    <div class="site-section">
      <div class="container">
        <div class="row">
        
        <div class="col-md-12 col-lg-12 mb-4 mb-lg-0">
            <div class="banner-wrap bg-primary h-100">
              <a href="#" class="h-100">
                <h5><?php 
                  $hm = ($language == "en")?"Herbal ".$medicinePage: $medicinePage."ی گیاهی";
                  $cm = ($language == "en")?"Common ".$medicinePage: $medicinePage."ی رایج";
                  echo ($category == 1)?$cm:$hm;
                  ?></h5>
                <!-- <p>
                  <strong><? 
                    $text = ($language == "en") ? "About Herbal Medicine" : "درباره دارو های گیاهی";
                    $sql = "SELECT * FROM medicines_$language WHERE category_id = 2 AND  `name` = '$text'LIMIT 1";
                    $result = mysqli_query($GLOBALS['DB'], $sql) or die(mysqli_error($GLOBALS['DB']));
                    $row = mysqli_fetch_assoc($result);
                    $content = $row['details'];
                    echo ($_GET["category"] == 1)?$about:$content; ?>
                  </strong>
                </p> -->
              </a>
            </div>
          </div>
      </div>
      
    </div>
    <div class="site-section">
      <div class="container">
        <!-- <div class="row">
          <div class="title-section text-center col-12">
            <h2 class="text-uppercase">
              <?php 
                $titH = ($language == "en")?"Herbal ".$medicinePage: $medicinePage."ی گیاهی";
                $titC = ($language == "en")?"Common ".$medicinePage: $medicinePage."ی رایج";
                echo ($category == 1)?$titC:$titH;
              ?>
            </h2>
          </div>
        </div> -->
        <div class="row">
          <?php echo $medicines; ?>
        </div>
        <div class="row mt-5">
          <div class="col-md-12 text-center">
            <div class="site-block-27">
                <?php echo $paginator; ?>
            </div>
          </div>
        </div>
        
      </div>
    </div>

    <?php require_once "./includes/footer.php"?>