        <?php

        //error_reporting (E_ALL ^ E_NOTICE); // remove error "Notice: Undefined variable or undefined index"

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

        //echo $_POST['city-search'];

        if(isset($_POST['city-search'])){
              $location = '&& city_id = '.$_POST['city-search'];
              $location_index = ' WHERE city_id = '. $_POST['city-search'];
        }else{
          $location_search = '';
          $location_search_index = '';
        }

        //echo $_POST['city-search'];

        if (strstr($full_location,'/guitar/guitar.php')){
                $sql = "SELECT *
                        FROM upload
                        -- WHERE type ='guitar' $location
                          WHERE type ='guitar' $location ORDER BY postnumber DESC";

        }elseif (strstr($full_location,'/bass/bass.php')) {
                $sql = "SELECT *
                        FROM upload
                        WHERE type ='bass' $location ORDER BY postnumber DESC";

         }elseif (strstr($full_location,'/keyboard/keyboard.php')) {
                $sql = "SELECT *
                        FROM upload
                        WHERE type ='keyboard' $location ORDER BY postnumber DESC";

         }elseif (strstr($full_location,'/drum/drum.php')) {
                $sql = "SELECT *
                        FROM upload
                        WHERE type ='drum' $location ORDER BY postnumber DESC";

          }elseif (strstr($full_location,'/accesories/accesories.php')) {
                $sql = "SELECT *
                        FROM upload
                        WHERE type ='accesories' $location ORDER BY postnumber DESC";


          }elseif (strstr($full_location,'/equipments/equipments.php')) {
                $sql = "SELECT *
                        FROM upload
                        WHERE type ='equipments' $location ORDER BY postnumber DESC";
          }else{
                $sql = "SELECT *
                        FROM upload $location_index ORDER BY postnumber DESC";
      }


        $result = $conn->query($sql);

        // $dir = $result;
        // // echo "$row[$title].'/'.$a[0]";
        //
        // $a = scandir($dir);
        //
        $address_next = "/contents/uploads/";

        // $title = str_replace("_"," ",$_POST['title']);
        if ($result->num_rows > 0) {
              // echo "The full path of this file is: " . var_dump(debug_backtrace());
            // output data of each row
            while($row = $result->fetch_assoc()) {
              // echo '<div class="list" style="margin: 10px 20px; height: 200px; display: inline-block;">';

              $title = str_replace("_"," ",$row['title']);
              // echo '<div class="list" onclick="google()" style="margin: 10px 20px; height: 200px; display: inline-block;">';
              //


                // .list => css/list.css       .cursor => css/cursor.css
              echo '<div class="list cursor"'.
              'id='.
              'nextpage'.$row['title']." ".
              'onclick='.
              '"nextpage'.$row['title'].'()" style="margin: 10px 20px; height: 220px; display: inline-block;">';
              if($row['oauth_uid'] == $_SESSION['oauth_uid'] ){
                echo '<a class="delete-item" href="/contents/delete-users.php?title='.$row['title'].'&accountEmail='.$row['accountEmail'].'"><i class="fontello-icon ">&#xe800;</i></a>';
              }
              echo '<figure class="item">';
              // // echo '<img src='.$row[$title].'/'. alt="">';
              // echo '<img src='.$row[$title].'/'.$a[0].'alt="">';

              $dir =  '../contents/uploads/'.$row["title"];
              // echo $dir;
              // $a = scandir($dir);
              $dis = $row["display"];
              // print_r($a);
              // print_r($a[2]);
              // echo $a[2];
              // echo 'admin/uploads/'.$row["title"].'/'.$a[2];
              $pic = $dis.'  '. 'alt="">';


              echo '<img id="picsize" style="width: 180px; height: 80px;" src= ../contents/uploads/'.$row["title"].'/'.$pic;

              echo '<hr>';
              echo '<figcaption>';
              echo '<div>';

                echo "<div style='padding-bottom: 10px;
                                  white-space: nowrap;
                                  width 50px;
                                  overflow: hidden;
                                  text-overflow: ellipsis;
                                  '>";
                echo "<span class='item-name'>".$title."</span>";

                echo "</div>";
                if($row["status"] == 'USED'){
                  echo "<span class='used' style='float:right;'> ".$row["status"]."</span>";
                }elseif($row["status"] == 'NEW'){
                  echo "<span class='used'> ".$row["status"]."</span>";
                }

                echo "<div>".$row['brand']." ".$row["model"];
                echo "</div>";


                echo "<div class='price'>"."<span>$</span>". $row["price"]."<span style='float:right;'>".$row["city"].'</div>';


                // echo "<div class='model'>". $row["model"];
                // echo "</div>";

                // if($row["status"] == 'USED'){
                //   echo "<div class='price'>"."<span>$</span>". $row["price"]."<span class='used'> ".$row["status"]."</span>";
                //   echo "</div>";
                // }elseif ($row["status"] == 'NEW') {
                //   // code...
                //   echo "<div class='price'>"."<span>$</span>". $row["price"]."<span class='new'> ".$row["status"]."</span>";
                //   echo "</div>";
                // }



                // echo "<div class='year'>". $row["year"];
                // echo "</div>";

                // echo "<div class='region'>". $row["region"];
                // echo "</div>";

                // echo "<div class='description'>". $row["description"];
                // echo "</div>";

                echo '      </div>';
                echo '</figcaption>';
                echo '</figure>';
                echo '</div>';

                // echo '<script>
                // function'." ".'nextpage'.$row['title'].'()'.'{
                //   document.getElementById('.'"'.'nextpage'.$row['title'].'"'.')'.'.location.href='.'"/mjworld-music/admin/upload/'.$row['title'].'/'.$row['title'].'.php";} </script>';


                echo '<script>
                function'.' '.'nextpage'.$row['title'].'()'.' {
                  location.href = "/contents/uploads/'.$row['title'].'/'.$row['title'].'.php";
                } </script>';

                }




        } else {
            echo '<div style="margin: 10px 20px;"><p>Sorry We do not have anything that you were looking for</p></div>';
        }

        $conn->close();

         ?>
