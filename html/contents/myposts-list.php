<?php

// session_start();

$conn = mysqli_connect('localhost','root','QM2565qm');

mysqli_select_db($conn, 'mjworld');


// error_reporting();
// $db = new mysqli('localhost', 'root', '');
// if($db->connect_errno){
//   die('Sorry Database not connected !!!');}
//
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}
$full_location = debug_backtrace()[0]['file'];
// echo $full_location;

if (strstr($full_location,'\guitar\guitar.php')){
        $sql = "SELECT postnumber, title, brand, model, price, city, year, description, status, display, phone, youtube, accountEmail, oauth_uid
                FROM upload
                WHERE type ='guitar' ORDER BY postnumber DESC";

}elseif (strstr($full_location,'\bass\bass.php')) {
        $sql = "SELECT postnumber, title, brand, model, price, city, year, description, status, display, phone, youtube, accountEmail, oauth_uid
                FROM upload
                WHERE type ='bass'";

 }elseif (strstr($full_location,'\keyboard\keyboard.php')) {
        $sql = "SELECT postnumber, title, brand, model, price, city, year, description, status, display, phone, youtube, accountEmail, oauth_uid
                FROM upload
                WHERE type ='keyboard' ORDER BY postnumber DESC";

 }elseif (strstr($full_location,'\drum\drum.php')) {
        $sql = "SELECT postnumber, title, brand, model, price, city, year, description, status, display, phone, youtube, accountEmail, oauth_uid
                FROM upload
                WHERE type ='drum' ORDER BY postnumber DESC";

  }elseif (strstr($full_location,'\accesories\accesories.php')) {
        $sql = "SELECT postnumber, title, brand, model, price, city, year, description, status, display, phone, youtube, accountEmail, oauth_uid
                FROM upload
                WHERE type ='accesories' ORDER BY postnumber DESC";


  }elseif (strstr($full_location,'\equipments\equipments.php')) {
        $sql = "SELECT postnumber, title, brand, model, price, city, year, description, status, display, phone, youtube, accountEmail, oauth_uid
                FROM upload
                WHERE type ='equipments' ORDER BY postnumber DESC";
  }else{
        $sql = "SELECT postnumber, title, brand, model, price, city, year, description, status, display, phone, youtube, accountEmail, oauth_uid
                FROM upload ORDER BY postnumber DESC";
}



$result = $conn->query($sql);

// $dir = $result;
// // echo "$row[$title].'/'.$a[0]";
//
// $a = scandir($dir);
//
$address_next = "/contents/uploads/";


if ($result->num_rows > 0) {
      // echo "The full path of this file is: " . var_dump(debug_backtrace());
    // output data of each row
    while($row = $result->fetch_assoc()) {
      // echo '<div class="list" style="margin: 10px 20px; height: 200px; display: inline-block;">';

              $title = str_replace("_"," ",$row['title']);
      // echo '<div class="list" onclick="google()" style="margin: 10px 20px; height: 200px; display: inline-block;">';
      //


        // .list => css/list.css       .cursor => css/cursor.css
      if($row['oauth_uid'] == $_SESSION['oauth_uid']){
        echo '<div class="list cursor"'.
        'id='.
        'nextpage'.$row['title']." ".
        'onclick='.
        '"nextpage'.$row['title'].'()" style="margin: 10px 20px; height: 220px; display: inline-block;">';
        if($row['accountEmail'] == $_SESSION['email'] ){
          echo '<a class="/contents/delete-item" href="/contents/delete-users.php?title='.$row['title'].'&accountEmail='.$row['accountEmail'].'"><i class="fontello-icon ">&#xe800;</i></a>';
        }
        echo '<figure class="item">';


        $dir =  '/contents/uploads/'.$row["title"];

        $dis = $row["display"];

        $pic = $dis.'  '. 'alt="">';


        echo '<img id="picsize" style="width: 180px; height: 80px;" src= /contents/uploads/'.$row["title"].'/'.$pic;



        echo '<hr>';
        echo '<figcaption>';
        echo '<div>';

          echo "<div style='padding-bottom: 20px;'>";
          echo "<span class='item-name'>".$title."</span>";
          if($row["status"] == 'USED'){
            echo "<span class='used' style='float:right;'> ".$row["status"]."</span>";
          }elseif($row["status"] == 'NEW'){
            echo "<span class='used'> ".$row["status"]."</span>";
          }
          echo "</div>";

          echo "<div>".$row['brand']." ".$row["model"];
          echo "</div>";

          echo "<div class='price'>"."<span>$</span>". $row["price"].'</div>';



          echo '      </div>';
          echo '</figcaption>';
          echo '</figure>';
          echo '</div>';
      }


        echo '<script>
        function'.' '.'nextpage'.$row['title'].'()'.' {
          location.href = "/contents/uploads/'.$row['title'].'/'.$row['title'].'.php";
        } </script>';

        }


} else {
    echo "0 results";
}

$conn->close();

 ?>
