<?php
require_once "../helpers/common.php";
require_once "../libraries/connection.php";
$text1 = ($language == "en") ? "About Herbal Medicine" : "درباره دارو های گیاهی";

$text2 = ($language == "en") ? "About First Aid" : "درباره کمک های اولیه";

$sql = "SELECT * FROM medicines_$language WHERE name = '$text1'";
$sql1 = "SELECT * FROM firstaid_$language WHERE name = '$text2'";
$result = mysqli_query($GLOBALS['DB'], $sql) or die(mysqli_error($GLOBALS['DB']));
$result1 = mysqli_query($GLOBALS['DB'], $sql1) or die(mysqli_error($GLOBALS['DB']));
$row = mysqli_fetch_assoc($result);
$herbalMedicineDetail = str_replace(array("\r\n", "\n", "'"), array('', '', ''), $row['details']);

$row1 = mysqli_fetch_assoc($result1);
$firstaidDetail = str_replace(array("\r\n", "\n", "'"), array('', '', ''), $row1['details']);
$title = $aboutPage;
require_once("./includes/header.php");
// require($_SERVER['DOCUMENT_ROOT']."/university/medicineInfo/includes/header.php");
?>
</head>

<body>

  <div class="site-wrap">
  <?php require_once("./includes/navbar.php")?>
    <div class="site-blocks-cover inner-page" style="background-image: url('images/hero_1.jpg');">
      <div class="container">
        <div class="row">
          <div class="col-lg-7 mx-auto align-self-center">
            <div class=" text-center">
              <h1>About Us</h1>
              <p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Rerum obcaecati natus iure voluptatum eveniet harum recusandae ducimus saepe.</p>ˀ
            </div>
          </div>
        </div>
      </div>
    </div>

    <div class="site-section site-section-sm site-blocks-1 border-0" data-aos="fade">
      <div class="container">
        <div class="row">
          <div class="col-md-6 col-lg-12 d-lg-flex mb-4 mb-lg-0 pl-4" data-aos="fade-up" data-aos-delay="">
            <div class="text">
              <h2 style="text-align:center"><?php echo $aboutPage; ?></h2>
              <p style="color:#000; text-align:justify"><?php echo $about; ?></p>
            </div>
          </div>
        </div>
      </div>
    </div>

    <div class="site-section bg-light custom-border-bottom" data-aos="fade">
      <div class="container">
        <div class="row mb-5">
          <div class="col-md-6">
            <div class="block-16">
              <figure>
                <img src="images/bg_1.jpg" alt="Image placeholder" class="img-fluid rounded">
                <a href="https://vimeo.com/channels/staffpicks/93951774" class="play-button popup-vimeo"><span
                    class="icon-play"></span></a>

              </figure>
            </div>
          </div>
          <div class="col-md-1"></div>
          <div class="col-md-5">


            <div class="site-section-heading pt-3 mb-4">
              <h2 class="text-black"><?php echo $medicinePage;?></h2>
            </div>
            <p><?php echo $herbalMedicineDetail;?></p>

          </div>
        </div>
      </div>
    </div>

    <div class="site-section bg-light custom-border-bottom" data-aos="fade">
      <div class="container">
        <div class="row mb-5">
          <div class="col-md-6 order-md-2">
            <div class="block-16">
              <figure>
                <img src="images/hero_1.jpg" alt="Image placeholder" class="img-fluid rounded">
                <a href="https://vimeo.com/channels/staffpicks/93951774" class="play-button popup-vimeo"><span
                    class="icon-play"></span></a>

              </figure>
            </div>
          </div>
          <div class="col-md-5 mr-auto">


            <div class="site-section-heading pt-3 mb-4">
              <h2 class="text-black"><?php echo $firstaidPage;?></h2>
            </div>
            <p><?php echo $firstaidDetail;?></p>

          </div>
        </div>
      </div>
    </div>

    <?php require_once("./includes/footer.php")?>