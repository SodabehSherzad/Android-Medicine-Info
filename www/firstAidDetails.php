<?php 

require_once "../helpers/common.php";
require_once "../libraries/connection.php";

$id = (int) $_GET['id'];
$sql = "SELECT * FROM englishFirstAid WHERE _id = $id LIMIT 1";
$result = mysqli_query($GLOBALS['DB'], $sql) or die(mysqli_error($GLOBALS['DB']));

$medicineDetails = "";
if ($row = mysqli_fetch_row($result)) {
    $id = clean_data($row[0]);
    $name = clean_data($row[1]);
    $details = clean_data($row[2]);
    $logo = clean_data($row[4]);
    $image = clean_data($row[3]);

    if (!file_exists("images/firstAid/$image.webp")) {
        $image = "default";
    }

    $medicineDetails .= "<div class='row'>
            <div class='col-md-5 mr-auto'>
              <div class='border text-center'>
                <img src='images/firstAid/$image.webp' alt='Image'  class='img-fluid p-5'>
              </div>
              <div class='border text-center'>
                <img src='images/firstAid/$logo.webp' alt='Image'  class='img-fluid p-5'>
              </div>
            </div>
            <div class='col-md-6'>
              <h2 class='text-black'>$name</h2>
              <p>$details</p>

              <p><a href='bookMarks.php?id=$id' class='buy-now btn btn-sm height-auto px-4 py-3 btn-primary'>Add To Book Marks</a></p>

            </div>
          </div>";
  } else {
      $medicineDetails .= "<h1>Herbal Medicine with ID = $id not found!</h1>";
      $name = "not found!";
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
          <div class="col-md-12 mb-0"><a href="index.php">Home</a> <span class="mx-2 mb-0">/</span> <a
              href="firstAid.php">First Aid</a> <span class="mx-2 mb-0">/</span> <strong class="text-black"><?= $name ?></strong></div>
        </div>
      </div>
    </div>

    <div class="site-section">
      <div class="container">
        <?php echo $medicineDetails; ?>
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