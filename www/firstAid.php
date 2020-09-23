<?php 
require_once "../helpers/common.php";
require_once "../lang/$language.php";
require_once "../libraries/connection.php";
require_once "../libraries/Paginator.php";

$rows_per_page = 9;
define('ROWS_PER_PAGE', 9);
$total = mysqli_fetch_row(mysqli_query($GLOBALS['DB'], "SELECT count(id) AS total FROM firstaid_$language"))[0];
$current_page = (isset($_GET['page']) && $_GET['page'] > 0) ? (int) $_GET['page'] : 1;
$urlPattern = '?page=(:num)';
$offset = ($current_page - 1) * ROWS_PER_PAGE;
$paginator = new Paginator($total, ROWS_PER_PAGE, $current_page, $urlPattern);
$paginator->setNextText("");
$paginator->setPreviousText("");

$sql = "SELECT * FROM firstaid_$language LIMIT $offset, $rows_per_page";
$result = mysqli_query($GLOBALS['DB'], $sql) or die(mysqli_error($GLOBALS['DB']));

$medicines = "";
while ($row = mysqli_fetch_assoc($result)) {
    $name = clean_data($row['name']);
    $id = clean_data($row['id']);
    $image = clean_data($row['image']);

    if (!file_exists("images/firstAid/$image.webp")) {
        $image = "default";
    }

    $medicines .= "<div class='col-sm-6 col-lg-4 text-center item mb-4'>
      <a href='firstAidDetails.php?id=$id'> <img src='images/firstAid/$image.webp' alt='$name' title='$name' width='350' height ='250'></a>
      <h4 class='text-dark'><a href='firstAidDetails.php?id=$id'>$name</a></h4>
    </div>";
}

$title = "Medicine"; 
require_once("./includes/header.php")
?>
<body>

  <div class="site-wrap">
  <?php require_once("./includes/navbar.php")?>

    <div class="bg-light py-3">
      <div class="container">
        <div class="row">
          <div class="col-md-12 mb-0"><a href="index.php"><?= $homePage?></a> <span class="mx-2 mb-0">/</span> <strong class="text-black"><?= $firstaidPage?></strong></div>
        </div>
      </div>
    </div>
    <div class="site-section">
      <div class="container">
        <div class="row">
        
        <div class="col-md-12 col-lg-12 mb-4 mb-lg-0">
            <div class="banner-wrap bg-primary h-100">
              <a href="#" class="h-100">
                <h5><?= $firstaidPage?></h5>
                <!-- <p>
                  <strong><?php 
                  $text = ($language == "en") ? "About First Aid" : "درباره کمک های اولیه";
                  $sql = "SELECT * FROM firstaid_$language WHERE `name` = '$text' LIMIT 1";
                  $result = mysqli_query($GLOBALS['DB'], $sql) or die(mysqli_error($GLOBALS['DB']));
                  $row = mysqli_fetch_assoc($result);
                  echo $row['details']; ?></strong>
                </p> -->
              </a>
            </div>
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
                echo $firstaidPage;
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
              <ul>
                <?php echo $paginator; ?>
              </ul>
            </div>
          </div>
        </div>
        
      </div>
    </div>
    <?php require_once("./includes/footer.php")?>
