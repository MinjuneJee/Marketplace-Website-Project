<?php

session_start();

$conn = mysqli_connect('localhost','root','QM2565qm');

mysqli_select_db($conn, 'mjworld');

$link = $_POST['link'];
$oauth_uid = $_SESSION['oauth_uid'];
#mysqli_query($conn,"INSERT INTO users (link) VALUES('abc') WHERE oauth_uid = ''$oauth_uid'");
mysqli_query($conn,"UPDATE users SET link = '$link' WHERE oauth_uid = '$oauth_uid'");
#$sql = "UPDATE users SET link='$link' WHERE oauth_uid = '$oauth_uid'";

$_SESSION['link'] = $link;


header("Location: ../index.php");


?>
