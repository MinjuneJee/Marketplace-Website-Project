<?php

session_start();

$conn = mysqli_connect('localhost','root','QM2565qm');

mysqli_select_db($conn, 'mjworld');

if ($conn->connect_error){
  die("Connection Failed:".$conn->connect_error);
}

if(isset($_POST['submit'])){

  $title = $_POST['title'];
  $type = $_POST['type'];
  $brand = $_POST['brand'];
  $model = $_POST['model'];
  $price = $_POST['price'];
  // $country = $_POST['country'];
  //$province = $_POST['province'];
  $city = $_POST['city'];

  if($city == "Toronto"){
    $city_id = 1;
  }elseif ($city == "North York") {
    $city_id = 2;
  }elseif ($city == "Markham") {
    $city_id = 3;
  }elseif ($city == "Scarborough") {
    $city_id = 4;
  }elseif ($city == "Vaughan") {
    $city_id = 5;
  }elseif ($city == "Mississauga") {
    $city_id = 6;
  }elseif ($city == "Richmond Hill") {
    $city_id = 7;
  }elseif ($city == "Barrie") {
    $city_id = 8;
  }elseif ($city == "Guelph") {
    $city_id = 9;
  }elseif ($city == "London") {
    $city_id = 10;
  }elseif ($city == "Muskoka") {
    $city_id = 11;
  }elseif ($city == "Chatham-Kent") {
    $city_id = 12;
  }elseif ($city == "Hamilton") {
    $city_id = 13;
  }elseif ($city == "Brantford") {
    $city_id = 14;
  }elseif ($city == "Kingston") {
    $city_id = 15;
  }elseif ($city == "Others") {
    $city_id = 16;
  }

  // $city_list = ['Toronto','North York', 'Markham', 'Scarborough', 'Vaughan', 'Mississauga', 'Richmond Hill', 'Barrie', 'Guelph', 'London', 'Muskoka', 'Chatham-Kent', 'Hamilton', 'Brantford', 'Kingston', 'Others'];
  //
  // for($i=1; $i <= len($city_list); $x++){
  //   $j = $i - 1
  //     if($city == $city_list[$j]){
  //       $city_id = $i;
  //     }
  // }


  $year = $_POST['year'];
  $description = $_POST['description'];
  // $delivery = $_POST['delivery'];
  // $date = $_POST['upload_date'];
  $status =$_POST['status'];
  $display = basename($_FILES['fileToUpload']['name']);
  $phone = $_POST['phone'];
  $youtube = $_POST['youtube'];
  $accountEmail = $_SESSION['email'];
  $accountOauth_uid= $_SESSION['oauth_uid'];
  $time = date("Y_m_d");

  // $_SESSION[$price] = $payment;

  $check_duplication_title = "SELECT title FROM upload WHERE title = '$title'";


  $result = mysqli_query($conn, $check_duplication_title);

  $count = mysqli_num_rows($result);

  $countfiles = count($_FILES['file']['name']);
//                         mkdir('uploads/'.$name_dir);
// $name_dir = $_POST["title"];
// Looping all files
  $title = str_replace(" ","_",$_POST['title']);
      mysqli_query($conn,"INSERT INTO upload VALUES(NULL, '$title','$type', '$brand', '$model', '$price','$city_id', '$city', '$year', '$description', '$status','$display','$phone','$youtube', '$accountEmail', '$accountOauth_uid')");
//      mysqli_query($conn,"INSERT INTO upload VALUES(NULL, '$title','$type', '$brand', '$model', '$price', '$province', '$city', '$year', '$description', '$status','$display','$phone','$youtube', '$accountEmail', '$accountOauth_uid')");
    // mysqli_query($conn,"INSERT INTO upload VALUES(NULL, '$title','$type', '$brand', '$model', '$price', '$province', '$city', '$year', '$description', '$status','$display','$phone','$youtube', '$accountEmail', '$accountOauth_uid', '$time')");
for($i=0;$i<$countfiles;$i++){
$filename = $_FILES['file']['name'][$i];
// echo $filename;

// Upload file
// move_uploaded_file($_FILES['file']['tmp_name'][$i],'uploads/'.$name_dir.'/'.$filename);



if($count > 0){

echo "<script type='text/javascript'>
alert('Sorry we already have same title. Please try again.');
window.location.href='index.php';
</script>";

exit();
}else{
        $name_dir = $title;
        // echo $name_dir;
        mkdir('/var/www/html/contents/uploads/'.$name_dir);
        move_uploaded_file($_FILES["fileToUpload"]["tmp_name"],'uploads/'.$name_dir.'/'.$_FILES['fileToUpload']['name']);
        move_uploaded_file($_FILES['file']['tmp_name'][$i],'uploads/'.$name_dir.'/'.$filename);



        // mysqli_query($conn,"INSERT INTO upload(number,title, titl) VALUES(NULL, '$title','$type', '$brand', '$model', '$price', '$country','$state', '$city', '$year', '$description', '$delivery', '$date','$display', '$status')");
        // mysqli_query($conn,"INSERT INTO upload VALUES(NULL, '$title','$type', '$brand', '$model', '$price', '$country','$state', '$city', '$year', '$description', '$status','$display','$phone')");

              // $location_file = 'uploads/'.$title.'/'.$title.'.php';
              $scan = scandir('/var/www/html/contents/uploads/'.$title);
              $num_ele = count($scan);
              $location_file = 'uploads/'.$title.'/'.$title.'.php';

              $file = fopen($location_file,'a');
              copy("../php/before-main.php", $location_file);
              // fwrite($file, '<div class="content-hold" style="width: 1300px; border: 3px red solid;">');
              fwrite($file,'<div class="container-fluid">');
                                      fwrite($file, '<div class="item-list container-box picture-slide">');
                                      // fwrite($file, '<div class="item-list container picture-fslide" style="float:left; width:600px; height:500px; display:inline-block; border: 3px black solid;">');



                                      $pic_num_dot = 0;
                                      $pic_total_num = $num_ele - 2;

                                      for($x=0; $x< $num_ele; $x++){
                                            if($scan[$x] == '.' || $scan[$x] == '..' || $scan[$x] == $title.'.php' ){
                                              continue;

                                            }else{
                                              fwrite($file,'<div class="mySlides">
                                              <div class="numbertext">'.$pic_num_dot.' / '.$pic_total_num.'</div><img src="'.$scan[$x].'"'.' style="width:100%; height:300px; display: block;
                                                    margin-left: auto;
                                                    margin-right: auto;"'.'>'.
                                              '</div>');
                                              fwrite($file,"\n");

                                              $pic_num_dot++;


                                            }
                                      }

                                      fwrite($file,'<a class="prev" onclick="plusSlides(-1)"><i class="fontello-icon icon-right-open">&#xe802;</i></a>');
                                      fwrite($file,'<a class="next" onclick="plusSlides(1)"><i class="fontello-icon icon-left-open">&#xe801;</i></a>');

                                      // fwrite($file, '<div class="caption-container">
                                      //               <p id="caption"></p>
                                      //               </div>');


                                      fwrite($file, '<div class="row">');


                                      $pic_num_img = 1;
                                      for($x=0; $x< $num_ele; $x++){
                                        if($scan[$x] == '.' || $scan[$x] == '..' || $scan[$x] == $title.'.php'){
                                          continue;
                                        }else{
                                          fwrite($file,'    <div class="column">
                                                            <img class="demo cursor picture-small" src="'.$scan[$x].'" onclick="currentSlide('.$pic_num_img.')">
                                                            </div>');

                                          $pic_num_img++;
                                        }

                                      }

                                      fwrite($file,'</div>');
              fwrite($file,'</div>');
              $title_display = str_replace("_"," ",$_POST['title']);

              fwrite($file, '<div class="other-information">
                                            <div class="detail">
                                                      <iframe class="youtube" src="'.$youtube.'">  </iframe>
                                                      <div class="information">
                                                                  <div style="display:block; width:100%; height:35%; margin-top: 8px;"><a href="https://www.facebook.com/'.$_SESSION['link'].'">
                                                                      <img class="profile-picture" style="float:left; margin: 0 10px;" src="'.$_SESSION['picture'].'"/>
                                                                      <p class="profile-name nav-link">'.$_SESSION['first_name']." ".$_SESSION['last_name'].'<br>'
                                                                      .'</p></a>'
                                                                .'</div>'
                                                                .'<div style="display:block;">
                                                                    <p><span class="item-name">'.$title_display.'</span>
                                                                    <span class="place-price"><span class="used">USED</span>
                                                                    <span style="display:block;">'.'$'.$price.'</span></span> </p>

                                                                    <p>'.$brand." ".$model.'</p>
                                                                    <p> Year: '.$year.'</p>
                                                                    <p> Description      '.'<span style="float:right;">'.$time.'</span>'.' </p>
                                                                    <p> '.$description.'</p>

                                                                </div>

                                                      </div>

                                            </div>');
              fwrite($file, '</div>');

              // fwrite($file, '</div>');

              fwrite($file,'<script>
                            var slideIndex = 1;
                            showSlides(slideIndex);

                            function plusSlides(n) {
                              showSlides(slideIndex += n);
                            }

                            function currentSlide(n) {
                              showSlides(slideIndex = n);
                            }

                            function showSlides(n) {
                              var i;
                              var slides = document.getElementsByClassName("mySlides");
                              var dots = document.getElementsByClassName("demo");
                              var captionText = document.getElementById("caption");
                              if (n > slides.length) {slideIndex = 1}
                              if (n < 1) {slideIndex = slides.length}
                              for (i = 0; i < slides.length; i++) {
                                  slides[i].style.display = "none";
                              }
                              for (i = 0; i < dots.length; i++) {
                                  dots[i].className = dots[i].className.replace(" active", "");
                              }
                              slides[slideIndex-1].style.display = "block";
                              dots[slideIndex-1].className += " active";
                              captionText.innerHTML = dots[slideIndex-1].alt;
                            }
                            </script>');

              // fwrite($file,'<div style="display: inline-block;"> <p class="item-name">'.$title.' </p><p> Brand '.$brand.'</p>'."\n". '<p> Model'.$model.'<p>'."\n".'<p> Year'.$year.'</p>'."\n".'<p> Description </p>'.$description.'</div>');
//
// <div class="item-name" style="float:right; left:150px;">'.$title.'</div>'



              fwrite($file, '</div>

                  <script src="/vendor/jquery/jquery.min.js"></script>
                    <script src="/vendor/bootstrap/js/bootstrap.bundle.min.js"></script>

                    <!-- Menu Toggle Script -->
                    <script>
                      $("#menu-toggle").click(function(e) {
                        e.preventDefault();
                        $("#wrapper").toggleClass("toggled");
                      });
                    </script>

                  </body>

                  </html>');

        // copy("../php/after-main.php", $location_file);


                fclose($file);

        echo "<script type='text/javascript'>
        alert('Successful".$title."');
        window.location.href='index.php';
        </script>";
        // exit();



        header("Location: ../index.php");
        }
        //manages multi pictures



}

}

// header("Location: /mjworld-music/admin/admin.php");


?>
