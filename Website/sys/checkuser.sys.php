<?php
$uid = filter_var($_POST['uid'], FILTER_SANITIZE_ENCODED, FILTER_FLAG_STRIP_High);
include_once '../dbc.php';

if(empty($uid)){
  echo false;
  exit();
} else {

  $sql = "SELECT username FROM users WHERE username='$uid'";
  $result = mysqli_query($conn, $sql);
  $resultCheck = mysqli_num_rows($result);

    if($resultCheck > 0){
      echo false;
      exit();
    } else {
     echo true;
      exit();
    }
}
