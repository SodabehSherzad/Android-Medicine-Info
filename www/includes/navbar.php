<?php
require_once "../helpers/common.php";
require_once "../libraries/connection.php";
$sql = "SELECT * FROM categories";
$result = mysqli_query($GLOBALS['DB'], $sql) or die(mysqli_error($GLOBALS['DB']));

$categories = "";
while ($row = mysqli_fetch_assoc($result)) {
    $id = clean_data($row['id']);
    $name = clean_data($row['name_' . $language]);

    $categories .= "<li><a href='medicine.php?category=$id'>$name</a></li>";
}

?>
<div class="site-navbar py-2">

      <div class="search-wrap">
        <div class="container">
          <a href="#" class="search-close js-search-close"><span class="icon-close2"></span></a>
          <form action="#" method="post">
            <input type="text" class="form-control" placeholder="Search keyword and hit enter...">
          </form>
        </div>
      </div>

      <div class="container">
        <div class="d-flex align-items-center justify-content-between">
          <div class="logo">
            <div class="site-logo">
              <a href="index.php" class="js-logo-clone"><?=$siteTitle;?></a>
            </div>
          </div>
          <div class="main-nav d-none d-lg-block">
            <nav class="site-navigation text-right text-md-center" role="navigation">
              <ul class="site-menu js-clone-nav d-none d-lg-block">
                <li class="active"><a href="index.php"><?=$homePage;?></a></li>
                <li class="has-children"><a href="#"><?=$medicinePage;?></a>
                  <ul class="dropdown">
                    <?=$categories;?>
                    <li><a href="bookmarks.php?origin=medicines">Bookmarks</a></li>
                  </ul>
                </li>
                <li class="has-children">
                  <a href="firstaid.php"><?=$firstaidPage?></a>
                  <ul class="dropdown">
                  <li><a href="firstaid.php"><?=$firstaidPage?></a></li>
                  <li><a href="bookmarks.php?origin=firstaid"><?=$bookMarksPage?></a></li>
                  </ul>
                </li>
                <li><a href="about.php"><?=$aboutPage?></a></li>
                <li><a href="contact.php"><?=$contactPage?></a></li>

                <li class="has-children"><a href="#"><?=$lang?></a>
                  <ul class="dropdown">
                    <li><a href="" onclick="changeLanguage('en')">English</a></li>
                    <li><a href="" onclick="changeLanguage('fa')">فارسی</a></li>
                  </ul>
                </li>


                <?php if( isset($_SESSION['login_authority'])  && $_SESSION['login_authority'] == "success" ) { ?>
              
                  <li class="has-children">
                      <a href="#"><?=$setting?></a>
                      <ul class="dropdown">
                        <li><a href="addMedicine.php"><?=$addMedicine?></a></li>
                        <li><a href="addFirstAid.php"><?=$addFirstAid?></a></li>
                        <li><a href="signOut.php"><?=$logoutPage?></a></li>
                      </ul>
                  </li>

                <?php } else { ?>
                  <li class="has-children">

                    <a href="#">Sing In/Up</a>
                      <ul class="dropdown">
                        <li><a href="signUp.php">Sign Up</a></li>
                        <li><a href="signIn.php"><?=$loginPage?></a></li>
                      </ul>
                  </li>
                <?php } ?>


              </ul>
            </nav>
          </div>

        </div>
      </div>
    </div>
