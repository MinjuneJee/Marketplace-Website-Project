<?php include '../php/before-main.php' ?>

<!-- Main -->
<!-- $_SESSION['oauth_uid'];  -->

                    <div class="item-list" >
                      <h4 class="item-list-title" style="margin-left: 20px;" >Facebook URL</h4>
                      <p style="margin-left: 20px;"> <?php

                      if($_SESSION['link'] == ""){
                        echo "Your Facebook URL is not recorded";
                      }else{
                      echo "Your current Facebook URL is".$_SESSION['link'];
                      }

                      ?></p>
                      <p style="margin-left: 20px;">Please enter your Facebook URL</p>

                      <form  action="messages-link.php" method="post" style="margin-left: 20px;">
                        <label for="link" style="">https://www.facebook.com/</label>
                        <input type="text" name="link"><br>
                      <input type="submit">
                      </form>



                    </div>
<!-- /Main  -->

<?php include '../php/after-main.php' ?>
