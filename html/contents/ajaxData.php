<?php
$dbHost     = "localhost";
$dbUsername = "root";
$dbPassword = "QM2565qm";
$dbName     = "mjworld";

// Create database connection
$db = new mysqli($dbHost, $dbUsername, $dbPassword, $dbName);
  if(!empty($_POST["province_id"])){
    // Fetch city data based on the specific province
    $query = "SELECT * FROM city WHERE province_id = ".$_POST['province_id']." AND status = 1 ORDER BY city_name ASC";
    $result = $db->query($query);

    // Generate HTML of city options list
    if($result->num_rows > 0){
      echo '<option value="">Select city</option>';
      while($row = $result->fetch_assoc()){
        echo '<option value="'.$row['city_name'].'">'.$row['city_name'].'</option>';
      }
    }else{
      echo '<option value="">city not available</option>';
    }
  }
 ?>
