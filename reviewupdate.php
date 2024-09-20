<?php 
include("config.php");
$user_id = $_GET['updateID'];
//for showing data with respect to id
$sql = "select * from `review` where user_id = $user_id";
$result = mysqli_query($conn,$sql);
$row = mysqli_fetch_assoc($result);
$review_id = $row['review_id'];
$user_id = $row['user_id'];
$event_id = $row['event_id'];
$rating = $row['rating'];
$comment = $row['comment'];


if(isset($_POST['submit'])){
  $review_id = $_POST['review_id'];
  $user_id = $_POST['user_id'];
  $event_id = $_POST['event_id'];
  $rating = $_POST['rating'];
  $comment = $_POST['comment'];

  $sql = "update `review` set review_id=$review_id, user_id = '$user_id',event_id= '$event_id',  rating='$rating', comment='$comment' where user_id= $user_id";
  $result = mysqli_query($conn,$sql);

  if($result){
    header('location:reviewdisplay.php');
    // echo "update";
  }else die(mysqli_errno($conn));


}


?>




<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
  <title>update</title>
</head>
<body>
  <div class="container mt-4">
  <form method="post">
    <div class="form-group mt-3">
     <label for="exampleInputEmail1">Review_id</label>
     <input type="number" class="form-control"  placeholder="Enter Name"
     name="review_id" value=<?php echo $review_id; ?>>
    </div>

    <div class="form-group mt-3">
     <label for="exampleInputEmail1">User_id</label>
     <input type="number" class="form-control"  placeholder="Enter Email"
     name="user_id" value=<?php echo $user_id; ?>>
    </div>

    

    <div class="form-group mt-3">
     <label for="exampleInputEmail1">Event_id</label>
     <input type="number" class="form-control"  placeholder="Enter password"
     name="event_id" value=<?php echo $event_id; ?>>
    </div>
    <div class="form-group mt-3">
     <label for="exampleInputEmail1">Rating</label>
     <input type="text" class="form-control"  placeholder="Enter phone"
     name="rating" value=<?php echo $rating; ?>>
    </div>

    <div class="form-group mt-3">
     <label for="exampleInputEmail1">Comment</label>
     <input type="text" class="form-control"  placeholder="Enter date of birth"
     name="comment" value=<?php echo $comment; ?>>
    </div>
    


    <button type="submit" name="submit" class="btn btn-primary mt-3">Update</button>
   
  </form>
  
</body>
</html>