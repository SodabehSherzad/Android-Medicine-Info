<footer class="site-footer">
      <div class="container">
        <div class="row">
          <div class="col-md-6 col-lg-3 mb-4 mb-lg-0">

            <div class="block-7">
              <h3 class="footer-heading mb-4"><?php echo $aboutPage;?></h3>
              <a href="about.php" style="color:#000; text-align:justify"><p>
                <?php 
                $content = substr($about, 0, strrpos(substr($about, 0, floor(strlen($about) / 4)), ' ') - 16);
                  echo $content."...";
                ?>
              </p></a>
            </div>

          </div>
          <div class="col-lg-3 mx-auto mb-5 mb-lg-0">
            <h3 class="footer-heading mb-4"><?php echo $siteTitle;?></h3>
            <ul class="list-unstyled">
              <li><a href="#"><?php echo ($language == "en")?"Common ".$medicinePage: $medicinePage."ی رایج";?></a></li>
              <li><a href="#"><?php echo ($language == "en")?"Herbal ".$medicinePage: $medicinePage."ی گیاهی";?></a></li>
              <li><a href="#"><?php echo $firstaidPage;?></a></li>
            </ul>
          </div>

          <div class="col-md-6 col-lg-3">
            <div class="block-5 mb-5">
              <h3 class="footer-heading mb-4"><?php echo $contact;?></h3>
              <ul class="list-unstyled">
                <li class="address">203 Fake St. Mountain View, San Francisco, California, USA</li>
                <li class="phone"><a href="tel://23923929210">+2 392 3929 210</a></li>
                <li class="email">emailaddress@domain.com</li>
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

<script src="js/main.js"></script>

<!--  SET preferred language  -->
<script type="text/javascript">
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
    
    // function medicinesFavorite(id){
    //   // let ids = new array();
    //   // ids[] = id;
    //   localStorage.setItem("medicineID", id);
    //   // localStorage.setItem("medicineID", JSON.stringify(ids), '');
    //   let storedNames = JSON.parse(localStorage.getItem("medicines"));
    //   // window.location.href=”index.php?uid=1";
    // }

    

</script>

</body>

</html>
