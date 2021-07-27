<?php

$conn = mysqli_connect("localhost","root","QM2565qm");

mysqli_select_db($conn, 'mjworld');

if($conn->connect_error){
    die("Connection failed: ". $conn->connect_error);
}


  $title = $_GET['title'];

function deleteDirectory($dir) {
    if (!file_exists($dir)) {
        return true;
    }

    if (!is_dir($dir)) {
        return unlink($dir);
    }

    foreach (scandir($dir) as $item) {
        if ($item == '.' || $item == '..') {
            continue;
        }

        if (!deleteDirectory($dir . DIRECTORY_SEPARATOR . $item)) {
            return false;
        }

    }

    return rmdir($dir);
}



$del = mysqli_query($conn, "delete from upload where title = '$title'");

if($del){
  // print_r( scandir('uploads/'.$title));
  // print_r(scandir('uploads/'.$title)[3]);
  deleteDirectory('uploads/'.$title);

  //
  // rmdir('uploads/'.$title);
  mysqli_close($conn);
  // header("location:list-db.php");
  exit;
}else{
  echo "error deleting record";
}
?>
