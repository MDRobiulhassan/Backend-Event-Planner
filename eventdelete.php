<?php 
include("config.php");
if(isset($_GET['deleteID'])){
  $user_id = $_GET['deleteID'];
  $sql ="delete from `event` where user_id = $user_id";
  $result = mysqli_query($conn,$sql);
  if($result){
   
    header('location: eventdisplay.php');
  }else{
    die(mysqli_error($conn));
  }

}
?>