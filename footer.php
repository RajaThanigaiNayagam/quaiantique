    <!--footer-->
    <footer class="footer" id="footer">
      <div class="container"><br>
          <div class="row">
              <div class="col-sm-12 text-center">
                  <div class="social-icon">
                      <a href="index.php"><i class="fa fa-facebook"></i></a>
                      <a href="index.php"><i class="fa fa-twitter"></i></a>
                      <a href="index.php"><i class="fa fa-pinterest"></i></a>
                      <a href="index.php"><i class="fa fa-rss"></i></a>
                  </div>
                  <div class="copyright">
                      <p class="white"> copyright &copy; <b>Le Chef Arnaud Michant</b></p>
                      <p><i class="fa fa-phone"></i> +00 (33) 6 12 34 56 78 &nbsp;<i class="fa fa-envelope-o"></i> info_Quai_Antique@gmail.com</p>
                  </div>
              </div>
          </div>
      </div>
    </footer>
    <!--end of footer-->
    
    
    <!-- Reservatrion add form have red color buttons.  The click event on this button fills a text field with corresponding hour of the button -->
    <script type="text/javascript"> 
        let nboftimeslot = parseInt($("#nbtimeslot").val());
        for (let i = 0; i <= nboftimeslot; i++) {
            $("#timebutton"+i+"").on( "click", function(event) { $('#reservresponse').val( $("#timebutton"+i+"").text() ); console.log("val : " + $("#timebutton"+i+"").text() ); } );
        }
    </script>
    
    <!--<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>-->
  </body>
  <!---end of body-->
</html>