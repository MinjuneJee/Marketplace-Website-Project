<?php
      error_reporting (E_ALL ^ E_NOTICE); // remove error "Notice: Undefined variable or undefined index"
if(!session_start()){
session_start();
}
 ?>
<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <meta name="description" content="Music Instrument Trading Website">
  <meta name="author" content="Minjune Jee">
  <meta name="keywords" content="MJworld-Music, MJworld, MJworld Music, mjworld-music, guitar, used guitar, bass, used bass, drum, used drum,">

  <title>MJworld-Music</title>
  <script data-ad-client="ca-pub-6939671700813024" async src="https://pagead2.googlesyndication.com/pagead/js/adsbygoogle.js"></script>
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
<!-- <script src='js/jquery.min.js'></script> -->
<script type="text/javascript">
$(document).ready(function(){
  $('#province').on('change', function(){
      var provinceID = $(this).val();
      if(provinceID){
        $.ajax({
          type:'POST',
          url: 'ajaxData.php',
          data: 'province_id='+provinceID,
          success:function(html){
              $('#city').html(html);
          }
        });
      }else{
            $('#city').html('<option value="">Select province first</option>')
      }
  });
});

</script>

  <!-- <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script> -->
  <!-- <script>
        $(document).ready(function(){
          $(".other-picture-nextpage").mouseon(function(){
            $(".first-picture-nextpage").css("width", "100px").css("height","100px").css("display", "inline");
            }, function(){
            $(this).css("width", "500px").css("height","600px").css("display", "block");
          });
        });


        $(document).ready(function(){
          $(".other-picture-nextpage").hover(function(){
            $(".first-picture-nextpage").css("width", "100px").css("height","100px").css("display", "inline");
            }, function(){
            $(this).css("width", "500px").css("height","600px").css("display", "block");
          });
        });
  </script> -->

  <!-- Bootstrap core CSS -->
  <link href="/vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">

  <!-- Custom styles for this template -->
  <link rel="stylesheet" href="/css/simple-sidebar.css" >
  <link rel="stylesheet" href="/css/reset.css">

  <link rel="stylesheet" href="/css/header.css">
  <link rel="stylesheet" href="/css/list.css">
  <link rel="stylesheet" href="/css/cursor.css">
  <link rel="stylesheet" href="/css/nextpage.css">
  <link rel="stylesheet" href="/css/upload.css">
  <link rel="stylesheet" href="/css/admin.css">
  <link rel="stylesheet" href="/css/status.css">
  <link rel="stylesheet" href="/css/content-seperate.css">
  <link rel="stylesheet" href="/css/profile.css">
  <link rel="stylesheet" href="/css/messages.css">
  <link rel="stylesheet" href="/css/fontello.css">




</head>

<body>

  <div class="d-flex" id="wrapper">

    <!-- Sidebar -->
    <div class="bg-light border-right" id="sidebar-wrapper">
      <div class="sidebar-heading"><a href="/index.php"><img src="/php/logo.PNG" style="width:220px;height:60px;"></a></div>
      <div class="list-group list-group-flush">
        <a href="/guitar/guitar.php" class="list-group-item list-group-item-action bg-light">Guitar</a>
        <a href="/bass/bass.php" class="list-group-item list-group-item-action bg-light">Bass</a>
        <a href="/keyboard/keyboard.php" class="list-group-item list-group-item-action bg-light">Keyboard/Piano</a>
        <a href="/drum/drum.php" class="list-group-item list-group-item-action bg-light">Drum</a>
        <a href="/accesories/accesories.php" class="list-group-item list-group-item-action bg-light">Accesories</a>
        <a href="/equipments/equipments.php" class="list-group-item list-group-item-action bg-light">Equipments</a>
      </div>

    <!-- LOCATION -->
        <div  style="margin: 40px 20px;">
        <?php
                $my_url = $_SERVER['PHP_SELF'];
                // echo substr($my_url, strrpos($my_url, '/' )+1)."\n";
                $next_url = substr($my_url, strrpos($my_url, '/' )+1)."\n";
                // echo $_POST['city-search'];
                echo '
                <form class="" action='.$next_url.'method="post">
                  <label for="City">City</label>
                    <select  name="city-search" required>
                        <option value="">Choose Your City</option>
                        <option value="1">Toronto</option>
                        <option value="2">North York</option>
                        <option value="3">Markham</option>
                        <option value="4">Scarborough</option>
                        <option value="5">Vaughan</option>
                        <option value="6">Mississauga</option>
                        <option value="7">Richmond Hill</option>
                        <option value="8">Barrie</option>
                        <option value="9">Guelph</option>
                        <option value="10">London</option>
                        <option value="11">Muskoka</option>
                        <option value="12">Chatham-Kent</option>
                        <option value="13">Hamilton</option>
                        <option value="14">Brantford</option>
                        <option value="15">Kingston</option>
                        <option value="16">Others</option>
                    </select>


                    <input type="submit" name="submit" value="Search in Ontario">
                </form>
                ';

        ?>
        </div>
        <!-- /LOCATION -->
    </div>


    <!-- /#sidebar-wrapper -->

    <!-- Page Content -->
    <div id="page-content-wrapper">

      <nav class="navbar navbar-expand-lg navbar-light bg-light border-bottom">
        <button class="btn btn-primary" id="menu-toggle">Menu</button>

        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
          <span class="navbar-toggler-icon"></span>
        </button>

        <div class="collapse navbar-collapse" id="navbarSupportedContent">

              <?php

              if(isset($_SESSION['oauth_uid'])){
                echo '<ul class="navbar-nav ml-auto mt-2 mt-lg-0">';
                echo '<li class="nav-item active">';
                echo '<img class = "profile-picture" src="'.$_SESSION['picture'].'"/>';
                echo '</li>';
                echo '<li class="nav-item active">';
                // echo '<div class="profile-information">';
                echo '<p class="profile-name nav-link">'.$_SESSION['first_name'].' '.$_SESSION['last_name']."\n".'<span class="profile-email">'.$_SESSION['email'].'</span>'.'</p>';
                // echo '</div>';

                echo '<li class="nav-item dropdown">
                            <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">

                            </a>
                            <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdown">
                              <a class="dropdown-item" href="/contents/admin.php">Upload</a>
                              <a class="dropdown-item" href="/contents/myposts.php">My Posts</a>
                              <a class="dropdown-item" href="/contents/messages.php">Page URL</a>
                              <div class="dropdown-divider"></div>
                              <a class="dropdown-item" href="'.$_SESSION['logoutURL'].'">Log Out</a>
                            </div>
                      </li>';
                echo '</ul>';

              }else{
                echo '<ul class="navbar-nav ml-auto mt-2 mt-lg-0">';
                echo '<li>';
                echo '<a class="nav-link" href="/facebook_login_with_php/index.php">Log in <span class="sr-only">(current)</span></a>';
                echo '</li>';
                echo '</ul>';
              }?>

            <!-- <li class="nav-item dropdown">
              <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                Dropdown
              </a>
              <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdown">
                <a class="dropdown-item" href="#">My Post</a>
                <a class="dropdown-item" href="#">Messages</a>
                <div class="dropdown-divider"></div>
                <a class="dropdown-item" href="#">Something else here</a>
              </div>
            </li> -->

        </div>
      </nav>
