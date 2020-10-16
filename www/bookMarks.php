<?php

require_once "../libraries/connection.php";
require_once "../helpers/common.php";

$title = $bookMarksPage;
require_once "./includes/header.php";

$origin = $_GET['origin'];
//echo $origin;

echo "<script>
  Store.getFavorites(\"$origin\");
</script>";
$ids = $_COOKIE[$origin];
//echo $ids . "<br>";
$favorites = "";
if (strlen(trim($ids)) == 0) {
    $favorites = "You did not bookmark anything ...";
} else {
    $sql = "SELECT * FROM {$origin}_{$language} WHERE id IN ($ids)";
    //echo $sql;
    $result = mysqli_query($GLOBALS['DB'], $sql) or die(mysqli_error($GLOBALS['DB']));
    while ($row = mysqli_fetch_assoc($result)) {
        $id = clean_data($row['id']);
        $name = clean_data($row['name']);
        $image = clean_data($row['image']);
        
        $link_page = ($origin == "medicines") ? "medicine" : "firstAid";
        if (!file_exists("images/$link_page/$image")) {
            $image = "default.webp";
        }
 
        $favorites .= "<div class='col-sm-6 col-lg-4 text-center item mb-4'>
      <a href='{$link_page}Details.php?id=$id'> <img src='images/$link_page/$image' alt='$name' title='$name' width='250' height ='250'></a>
      <h4 class='text-dark'><a href='{$link_page}Details.php?id=$id'>$name</a></h4>
    </div>";
    }
}

?>

<body onload="Store.getFavorites(\"medicines\"); Store.getFavorites(\"firstaid\");">

  <div class="site-wrap">
  <?php require_once "./includes/navbar.php"?>

    <div class="bg-light py-3">
      <div class="container">
        <div class="row">
          <div class="col-md-12 mb-0">
            <a href="index.php">Home</a> <span class="mx-2 mb-0">/</span>
            <strong class="text-black">Bookmarks / Favorites</strong>
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
$titH = ($language == "en") ? "Herbal " . $medicinePage : $medicinePage . "ی گیاهی";
$titC = ($language == "en") ? "Common " . $medicinePage : $medicinePage . "ی رایج";
echo ($category == 1) ? $titC : $titH;
?>
            </h2>
          </div>
        </div> -->
        <div class="row">
          <?php echo $favorites; ?>
        </div>

      </div>
    </div>
    <?php require_once "./includes/footer.php"?>