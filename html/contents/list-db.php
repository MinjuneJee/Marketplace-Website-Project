<?php
error_reporting (E_ALL ^ E_NOTICE); // remove error "Notice: Undefined variable or undefined index"

session_start();

if(!($_SESSION['oauth_uid'] == 110579307426066)){
  header("Location:/index.php");}


 ?>

<?php include '../php/before-main.php';

$conn = mysqli_connect('localhost','root','');

mysqli_select_db($conn, 'mjworld');


// error_reporting();
// $db = new mysqli('localhost', 'root', '');
// if($db->connect_errno){
//   die('Sorry Database not connected !!!');}
//
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

$sql = "SELECT *   FROM upload";


$result = $conn->query($sql);

//https://www.11zon.com/zon/php/onclick-delete-from-database-php.php

if($result->num_rows > 0){
  echo "<table>"; // start a table tag in the HTML
            while($row = $result->fetch_assoc()){
                 echo
                  "<tr>
                   <td>" . $row['postnumber'] ."&nbsp"."&nbsp"."&nbsp"."</td>".
                  "<td>". $row['title'] ."&nbsp"."&nbsp"."&nbsp". "</td>"
                 ."<td>". $row['type'] ."&nbsp"."&nbsp"."&nbsp". "</td>"
                 ."<td>" . $row['brand'] ."&nbsp"."&nbsp"."&nbsp". "</td>"
                 ."<td>" . $row['model'] ."&nbsp"."&nbsp"."&nbsp". "</td>"
                 ."<td>" . $row['price'] ."&nbsp"."&nbsp"."&nbsp". "</td>"
                 ."<td>" . $row['province'] ."&nbsp"."&nbsp"."&nbsp". "</td>"
                 ."<td>" . $row['city'] . "&nbsp"."&nbsp"."&nbsp"."</td>"
                 ."<td>" . $row['year'] . "&nbsp"."&nbsp"."&nbsp"."</td>"
                 ."<td>" . $row['description'] . "&nbsp"."&nbsp"."&nbsp"."</td>"
                 ."<td>" . $row['status'] . "&nbsp"."&nbsp"."&nbsp"."</td>"
                 ."<td>" . $row['display'] . "&nbsp"."&nbsp"."&nbsp"."</td>"
                 ."<td>" . $row['phone'] . "&nbsp"."&nbsp"."&nbsp"."</td>"
                 ."<td>" . $row['youtube'] . "</td>"
                 .'<td><a href= "delete.php?title='.$row['title'].'">X</a></td>'

                 ."</tr>";
                   //$row['index'] the index here is a field name
            }

            echo "</table>"; //Close the table in HTML
            echo "<a href='delete-all.php'> DELETE ALL</a>";
}else{
  echo "There is no post.";
}

include '../php/after-main.php' ?>
