<?php

$conn = mysqli_connect("127.0.0.1","root","QM2565qm");

mysqli_select_db($conn, 'mjworld');

if($conn->connect_error){
    die("Connection failed: ". $conn->connect_error);
}

$del = mysqli_query($conn, "delete from upload");

// $folder = 'uploads';
//
// $files = glob($folder. '/*');
//
// foreach($files as $file){
//   if(is_file($file)){
//     unlink($file);
//   }
// }

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

function deleteAll($delall){
  foreach (scandir($delall) as $item) {
      if ($item == '.' || $item == '..') {
          continue;
      }else{
        deleteDirectory('uploads/'.$item);

      }
    }
}

if($del){
  // print_r( scandir('uploads/'.$title));
  // print_r(scandir('uploads/'.$title)[3]);
  deleteAll('uploads');

  //
  // rmdir('uploads/'.$title);
  mysqli_close($conn);
  // header("location:list-db.php");
  exit;
}else{
  echo "error deleting record";
}

 ?>
