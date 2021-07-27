<?php
    session_start();

    if($_SESSION['link'] == ""){
      header("Location:/contents/messages.php");
    }
    ?>

<?php include '../php/before-main.php' ?>

<script type="text/javascript">

         function checkSpcialChar(event){
            if(!((event.keyCode >= 65) && (event.keyCode <= 90) || (event.keyCode >= 97) && (event.keyCode <= 122) || (event.keyCode >= 48) && (event.keyCode <= 57)|| (event.keyCode = 32))){
              if(event.keyCode = 32){
                event.keypress = 51;
              }else{
                event.returnValue = false;
                return;
              }

            }
            event.returnValue = true;
         }
      </script>
<!-- Main written -->
    <div class="upload item-list" >
                    <p class="item-list-title" style="margin-left: 40px;"> Upload</p>
                          <form id="form" action="upload.php" method="post" enctype="multipart/form-data" style="margin-left: 40px;">
                            <label for="title">Title</label>
                            <input type="text" name="title" value="" onkeypress="return checkSpcialChar(event)" required>

                            <label for="status" style="">Status</label>
                            <select  name="status">
                              <option value="USED">USED</option>
                              <option value="NEW">NEW</option>

                            </select>
                            <label for="type">Choose the type:</label>
                            <select class="type" name="type" required>
                              <option value="guitar">Guitar</option>
                              <option value="bass">Bass</option>
                              <option value="keyboard">Keyboard</option>
                              <option value="drum">Drum</option>
                              <option value="equipments">Equipments</option>
                              <option value="Accesories">Accesories</option>
                            </select>

                            <label for="brand">Brand</label>
                            <input type="text" name="brand" value="Unknown" required>

                            <label for="model">Model</label>
                            <input type="text" name="model" value="Unknown">


                            <label for="price">Price</label>
                            <input type="number" name="price" value="price" required>

                            <!-- city Dropdown -->

                            <label for="city">City</label>
                            <select id="city" name="city" required>
                                   <option value="Toronto">Toronto</option>
                                   <option value="North York">North York</option>
                                   <option value="Markham">Markham</option>
                                   <option value="Scarborough">Scarborough</option>
                                   <option value="Vaughan">Vaughan</option>
                                   <option value="Mississauga">Mississauga</option>
                                   <option value="Richmond Hill">Richmond Hill</option>
                                   <option value="Barrie">Barrie</option>
                                   <option value="Guelph">Guelph</option>
                                   <option value="London">London</option>
                                   <option value="Muskoka">Muskoka</option>
                                   <option value="Chatham-Kent">Chatham-Kent</option>
                                   <option value="Hamilton">Hamilton</option>
                                   <option value="Brantford">Brantford</option>
                                   <option value="Kingston">Kingston</option>
                                   <option value="Others">Others</option>

                            </select>
                            <!-- <input type="submit" name="submit" value=""> -->
                            <!-- /LOCATION -->


                            <label for="year">Year</label>
                            <input type="year" name="year" value="Unknown">

                            <label for="phone">Phone</label>
                            <input type="text" name="phone" value="Unknown">

                            <label for="youtube">Youtube</label>
                            <input type="text" name="youtube" value="https://www.youtube.com/embed/kiyi-C7NQrQ">

                            <label for="description">Description</label>
                            <textarea name="description" rows="8" cols="80" required>
                            </textarea>

                            <!-- <input type="file" name="fileToUpload" id="fileToUpload" multiple> -->
                            <!-- <input type="file" name="fileToUpload" id="fileToUpload"> -->
                            <label for=display_picture>Display Picture</label>
                            <input type="file" name="fileToUpload" id="fileToUpload" value="" required>


                            <label for="file[]">More pictures</label>
                            <input type="file" name="file[]" id="file" value="" multiple>


                            <input type="submit" value="Upload Image" name="submit">
                          </form>
                          <script src="script/jquery-3.5.1.min.js"></script>
                          <script src="script/script.js"></script>

    </div>
<!-- /Main -->

  </div>

  <script src="../vendor/jquery/jquery.min.js"></script>
    <script src="../vendor/bootstrap/js/bootstrap.bundle.min.js"></script>

    <!-- Menu Toggle Script -->
    <script>
      $("#menu-toggle").click(function(e) {
        e.preventDefault();
        $("#wrapper").toggleClass("toggled");
      });
    </script>

  </body>

  </html>
  <script>
