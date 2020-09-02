<?php
require_once "../helpers/common.php";
require_once "../libraries/connection.php";
require_once "../libraries/Paginator.php";

$rows_per_page = 2;
define('ROWS_PER_PAGE', 10);
$total = mysqli_fetch_row(mysqli_query($GLOBALS['DB'], "SELECT count(_id) AS total FROM englishmedicineinfo"))[0];
$current_page = (isset($_GET['page']) && $_GET['page'] > 0) ? (int) $_GET['page'] : 1;
$urlPattern = '?page=(:num)';
$offset = ($current_page - 1) * ROWS_PER_PAGE;
$paginator = new Paginator($total, ROWS_PER_PAGE, $current_page, $urlPattern);
$paginator->setNextText("");
$paginator->setPreviousText("");

$sql = "SELECT * FROM englishmedicineinfo LIMIT $offset, " . ROWS_PER_PAGE;
$result = mysqli_query($GLOBALS['DB'], $sql) or die(mysqli_error($GLOBALS['DB']));

$medicines = "";
while ($row = mysqli_fetch_assoc($result)) {
    $name = clean_data($row['name']);
    $id = clean_data($row['_id']);
    $usage = clean_data($row['usage']);
    $image = clean_data($row['image']);

    if (!file_exists("images/medicine/$image.webp")) {
        $image = "default";
    }

    $medicines .= "<div class='col-sm-6 col-lg-4 text-center item mb-4'>
      <a href='medicineDetails.php?id=$id'> <img src='images/medicine/$image.webp' alt='$name' title='$name' width='300' height ='250'></a>
      <h4 class='text-dark'><a href='medicineDetails.php?id=$id'>$name</a></h4>
      <p class='price'>$usage</p>
    </div>";
}

$title = "Medicine";
require_once "./includes/header.php"
?>

<body>

  <div class="site-wrap">
  <?php require_once "./includes/navbar.php"?>

    <div class="bg-light py-3">
      <div class="container">
        <div class="row">
          <div class="col-md-12 mb-0"><a href="index.php">Home</a> <span class="mx-2 mb-0">/</span> <strong class="text-black">Medicine</strong></div>
        </div>
      </div>
    </div>

    <div class="site-section">
      <div class="container">

        <div class="row">
          <div class="col-lg-6">
            <h3 class="mb-3 h6 text-uppercase text-black d-block">Filter by Price</h3>
            <div id="slider-range" class="border-primary"></div>
            <input type="text" name="text" id="amount" class="form-control border-0 pl-0 bg-white" disabled="" />
          </div>
          <div class="col-lg-6">
            <h3 class="mb-3 h6 text-uppercase text-black d-block">Filter by Reference</h3>
            <button type="button" class="btn btn-secondary btn-md dropdown-toggle px-4" id="dropdownMenuReference"
              data-toggle="dropdown">Reference</button>
            <div class="dropdown-menu" aria-labelledby="dropdownMenuReference">
              <a class="dropdown-item" href="#">Relevance</a>
              <a class="dropdown-item" href="#">Name, A to Z</a>
              <a class="dropdown-item" href="#">Name, Z to A</a>
              <div class="dropdown-divider"></div>
              <a class="dropdown-item" href="#">Price, low to high</a>
              <a class="dropdown-item" href="#">Price, high to low</a>
            </div>
          </div>
        </div>

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
    <?php require_once "./includes/footer.php"?>

  </div>

  <script src="js/jquery-3.3.1.min.js"></script>
  <script src="js/jquery-ui.js"></script>
  <script src="js/popper.min.js"></script>
  <script src="js/bootstrap.min.js"></script>
  <script src="js/owl.carousel.min.js"></script>
  <script src="js/jquery.magnific-popup.min.js"></script>
  <script src="js/aos.js"></script>

  <script src="js/main.js"></script>

</body>

</html>