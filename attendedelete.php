<?php 
include("config.php");
if(isset($_GET['deleteID'])){
  $user_id = $_GET['deleteID'];
  $sql ="delete from `attendee` where attendee_id = $attendee_id";
  $result = mysqli_query($conn,$sql);
  if($result){
   
    header('location: attendedisplay.php');
  }else{
    die(mysqli_error($conn));
  }

}
?>