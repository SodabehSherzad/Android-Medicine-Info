<?php 

require_once "../helpers/common.php";
require_once "../lang/$language.php";
require_once "../libraries/connection.php";

function read_data($result){
         
  $medicines = "";
  while ($row = mysqli_fetch_assoc($result)) {
    $id = clean_data($row['id']);
    $name = clean_data($row['name']);
    $usage = clean_data($row['usage']);
    $image = clean_data($row['image']);
  
    if (!file_exists("images/medicine/$image.webp")) {
        $image = "image";
    }
  
    $medicines .= " <div class='text-center item mb-4'>
                    <a href='medicine.php'> <img src='images/medicine/$image.webp' alt='Image' width='70' height='200'></a>
                    <h3 class='text-dark'><a href='medicine.php'>$name</a></h3>
                    <p class='price'>$usage</p>
                  </div>";
  }

  return $medicines;
}

$title = "Home"; 
require_once("./includes/header.php")
?>
<body>
  <div class="site-wrap">
  <?php require_once("./includes/navbar.php")?>
    <div class="site-blocks-cover" style="background-image: url('images/hero_1.jpg');">
      <div class="container">
        <div class="row">
          <div class="col-lg-7 mx-auto order-lg-2 align-self-center">
            <div class="site-block-cover-content text-center">
              <h2 class="sub-title">Effective Medicine, New Medicine Everyday</h2>
              <h1>Welcome To Pharma</h1>
              <p>
                <a href="#" class="btn btn-primary px-5 py-3">Shop Now</a>
              </p>
            </div>
          </div>
        </div>
      </div>
    </div>

    <div class="site-section">
      <div class="container">
        <div class="row align-items-stretch section-overlap">
          <div class="col-md-6 col-lg-4 mb-4 mb-lg-0">
            <div class="banner-wrap bg-primary h-100">
              <a href="#" class="h-100">
                <h5>Free <br> Shipping</h5>
                <p>
                  Amet sit amet dolor
                  <strong>Lorem, ipsum dolor sit amet consectetur adipisicing.</strong>
                </p>
              </a>
            </div>
          </div>
          <div class="col-md-6 col-lg-4 mb-4 mb-lg-0">
            <div class="banner-wrap h-100">
              <a href="#" class="h-100">
                <h5>Season <br> Sale 50% Off</h5>
                <p>
                  Amet sit amet dolor
                  <strong>Lorem, ipsum dolor sit amet consectetur adipisicing.</strong>
                </p>
              </a>
            </div>
          </div>
          <div class="col-md-6 col-lg-4 mb-4 mb-lg-0">
            <div class="banner-wrap bg-warning h-100">
              <a href="#" class="h-100">
                <h5>Buy <br> A Gift Card</h5>
                <p>
                  Amet sit amet dolor
                  <strong>Lorem, ipsum dolor sit amet consectetur adipisicing.</strong>
                </p>
              </a>
            </div>
          </div>

        </div>
      </div>
    </div>
    
    <div class="site-section bg-light">
      <div class="container">
        <div class="row">
          <div class="title-section text-center col-12">
            <h2 class="text-uppercase">
            <?php $tit = ($language == "en")?"Common ".$medicinePage: $medicinePage."ی رایج";
              echo $tit;
            ?></h2>
          </div>
        </div>
        <div class="row">
          <div class="col-md-12 block-3 products-wrap">
            <div class="nonloop-block-3 owl-carousel">
            <?php
              $sql = "SELECT * FROM medicines_$language WHERE category_id = 1 LIMIT 4";
              $result = mysqli_query($GLOBALS['DB'], $sql) or die(mysqli_error($GLOBALS['DB']));
              echo read_data($result);
            ?>
            </div>
          </div>
        </div>
        <div class="row mt-5">
          <div class="col-12 text-center">
            <a href="medicine.php" class="btn btn-primary px-4 py-3"><?php echo $btn;?></a>
          </div>
        </div>
      </div>
    </div>

    <div class="site-section bg-light">
      <div class="container">
        <div class="row">
          <div class="title-section text-center col-12">
            <h2 class="text-uppercase"><?php $tit = ($language == "en")?"Herbal ".$medicinePage: $medicinePage."ی گیاهی";
              echo $tit;?></h2>
          </div>
        </div>
        <div class="row">
          <div class="col-md-12 block-3 products-wrap">
            <div class="nonloop-block-3 owl-carousel">
            <?php
              $sql = "SELECT * FROM medicines_$language WHERE category_id = 2 LIMIT 4";
              $result = mysqli_query($GLOBALS['DB'], $sql) or die(mysqli_error($GLOBALS['DB']));
              echo read_data($result);
            ?>
            </div>
          </div>
        </div>
        <div class="row mt-5">
          <div class="col-12 text-center">
            <a href="herbalMedicine.php" class="btn btn-primary px-4 py-3"><?php echo $btn;?></a>
          </div>
        </div>
      </div>
    </div>

    <div class="site-section bg-light">
      <div class="container">
        <div class="row">
          <div class="title-section text-center col-12">
            <h2 class="text-uppercase"><?php echo $firstaidPage?></h2>
          </div>
        </div>
        <div class="row">
          <div class="col-md-12 block-3 products-wrap">
            <div class="nonloop-block-3 owl-carousel">

            <?php
              $sql = "SELECT * FROM firstaid_$language LIMIT 4";
              $result = mysqli_query($GLOBALS['DB'], $sql) or die(mysqli_error($GLOBALS['DB']));
              
              $medicines = "";
              while ($row = mysqli_fetch_assoc($result)) {
                  $name = clean_data($row['name']);
                  $id = clean_data($row['id']);
                  $image = clean_data($row['image']);
              
                  if (!file_exists("images/firstAid/$image.webp")) {
                      $image = "default";
                  }
              
                  $medicines .= " <div class='text-center item mb-4'>
                    <a href='firstAid.php'> <img src='images/firstAid/$image.webp' alt='Image' width='100' height='200'></a>
                    <h3 class='text-dark'><a href='firstAid.php'>$name</a></h3>
                  </div>";
              }

              echo $medicines;

            ?>

            </div>
          </div>
        </div>
        <div class="row mt-5">
          <div class="col-12 text-center">
            <a href="firstAid.php" class="btn btn-primary px-4 py-3"><?php echo $btn;?></a>
          </div>
        </div>
      </div>
    </div>
    <?php require_once("./includes/footer.php")?>
