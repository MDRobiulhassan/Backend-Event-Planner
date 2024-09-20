<?php
include("config.php");
if (isset($_GET['deleteID'])) {
  $user_id = $_GET['deleteID'];
  $sql = "delete from `admin` where admin_id = $user_id";
  $result = mysqli_query($conn, $sql);
  if ($result) {

    header('location: alldisplay.php');
  } else {
    die(mysqli_error($conn));
  }

}
?>