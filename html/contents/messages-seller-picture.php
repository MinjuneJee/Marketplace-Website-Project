<?php
session_start();

$conn = mysqli_connect('localhost','root','QM2565qm');

mysqli_select_db($conn, 'mjworld');

if ($conn->connect_error){
  die("Connection Failed:".$conn->connect_error);
}

mysqli_query($conn,"INSERT INTO  VALUES(NULL, '$title','$type', '$brand', '$model', '$price', '$province', '$city', '$year', '$description', '$status','$display','$phone','$youtube', '$accountEmail', '$accountOauth_uid', '$time')");
 ?>
