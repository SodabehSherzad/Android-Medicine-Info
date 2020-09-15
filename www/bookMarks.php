<?php 

require_once("../libraries/connection.php");
require_once("../helpers/common.php");

// $ids = $_GET['id'];
// $ids = "<script>document.write(localStorage.getItem('medicineID'));</script>";
$title = $bookMarksPage; 
require_once("./includes/header.php")
?>

<body>

  <div class="site-wrap">
  <?php require_once("./includes/navbar.php")?>

    <div class="bg-light py-3">
      <div class="container">
        <div class="row">
          <div class="col-md-12 mb-0">
            <a href="index.php">Home</a> <span class="mx-2 mb-0">/</span> 
            <strong class="text-black">Book Marks</strong>
          </div>
        </div>
      </div>
    </div>

    <div class="site-section">
      <div class="container">
        <div class="row mb-5">
          <form class="col-md-12" method="post">
            <div class="site-blocks-table">
              <table class="table table-bordered">
                <thead>
                  <tr>
                    <th class="product-thumbnail">Image</th>
                    <th class="product-name">Name</th>
                    <th class="product-name">Type</th>
                  </tr>
                </thead>
                <tbody>
                 <?php echo $favorites;?>
                </tbody>
              </table>
            </div>
          </form>
        </div>
      </div>
    </div>
    <?php require_once("./includes/footer.php")?>
