<footer class="site-footer">
      <div class="container">
        <div class="row">
          <div class="col-md-6 col-lg-3 mb-4 mb-lg-0">

            <div class="block-7">
              <h3 class="footer-heading mb-4"><?php echo $aboutPage; ?></h3>
              <a href="about.php" style="color:#000; text-align:justify"><p>
                <?php
$content = substr($about, 0, strrpos(substr($about, 0, floor(strlen($about) / 4)), ' ') - 16);
echo $content . "...";
?>
              </p></a>
            </div>

          </div>
          <div class="col-lg-3 mx-auto mb-5 mb-lg-0">
            <h3 class="footer-heading mb-4"><?php echo $siteTitle; ?></h3>
            <ul class="list-unstyled">
              <li><a href="#"><?php echo ($language == "en") ? "Common " . $medicinePage : $medicinePage . "ی رایج"; ?></a></li>
              <li><a href="#"><?php echo ($language == "en") ? "Herbal " . $medicinePage : $medicinePage . "ی گیاهی"; ?></a></li>
              <li><a href="#"><?php echo $firstaidPage; ?></a></li>
            </ul>
          </div>

          <div class="col-md-6 col-lg-3">
            <div class="block-5 mb-5">
              <h3 class="footer-heading mb-4"><?php echo $contact; ?></h3>
              <ul class="list-unstyled">
                <li class="address">Herat Afghanistan</li>
                <li class="phone"><a href="">+93 999 777 888</a></li>
                <li class="email">emailaddress@gmail.com</li>
              </ul>
            </div>


          </div>
        </div>
      </div>
    </footer>

    </div>

<script src="js/jquery-3.3.1.min.js"></script>
<script src="js/jquery-ui.js"></script>
<script src="js/popper.min.js"></script>
<script src="js/bootstrap.min.js"></script>
<script src="js/owl.carousel.min.js"></script>
<script src="js/jquery.magnific-popup.min.js"></script>
<script src="js/aos.js"></script>

<?php
if (isset($scripts)) {
    echo $scripts;
}
?>

<script src="js/main.js"></script>

<!--  SET preferred language  -->
<script type="text/javascript">

    function medicinesFavorite(origin, id) {
      //console.log("id = " + id);
      const bookmarkLink = document.querySelector('.buy-now');
      //console.log(bookmarkLink.textContent.indexOf("Add"));
      // console.log(bookmarkLink.textContent);
      if( bookmarkLink.textContent.indexOf("Add") !== -1 || bookmarkLink.textContent.indexOf("اضافه") !== -1) {
        Store.addFavorite(origin, id);
        bookmarkLink.innerText = "Remove Bookmark";
      } else {
        Store.removeFavorite(origin, id);
        bookmarkLink.innerText = "Add Bookmark";
      }
    }

		function changeLanguage(lang){
			// Set cookie "lang"
			let expiresDate = new Date();
			expiresDate.setDate(expiresDate.getDate() + 360);
			document.cookie="lang=" + lang + ";expires="+ expiresDate.toGMTString();
    }


    function textToSpeech(input) {
      if ('speechSynthesis' in window) {
      // Speech Synthesis supported 🎉
      let msg = new SpeechSynthesisUtterance();
      msg.lang = 'en';
      msg.volume = 1; // From 0 to 1
      msg.rate = 0.5; // From 0.1 to 10
      msg.pitch = 1; // From 0 to 2
      msg.text = input;
      window.speechSynthesis.speak(msg);

      } else {
        // Speech Synthesis Not Supported 😣
        alert("Sorry, your browser doesn't support text to speech!");
      }
    }

    function stopSpeech() {
      window.speechSynthesis.cancel();
    }



</script>

</body>

</html>
