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
    
    
    <script type="text/javascript"> 
        let nboftimeslot = parseInt($("#nbtimeslot").val());
        for (let i = 0; i <= nboftimeslot; i++) {
            $("#timebutton"+i+"").on( "click", function(event) { $('#reservresponse').val( $("#timebutton"+i+"").text() ); console.log("val : " + $("#timebutton"+i+"").text() ); } );
        }
    </script>
    <script>
        $("#addfood").on(
            "change",
            function(event) {
                console.log($("#foodprice").val());
                if( document.querySelector("foodform").checkValidity() ) {
                    console.log($("#foodprice").val());

                    var foodprice_to_2_decimals =
                        parseFloat($("#foodprice").val()).toFixed(2);

                    console.log(foodprice_to_2_decimals);
                    $("#foodprice").val(foodprice_to_2_decimals);
                } 
            } 
        );
    </script>
  </body>
  <!---end of body-->
</html>