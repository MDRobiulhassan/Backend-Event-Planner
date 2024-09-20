<!-- <?php 
include("config.php");
$user_id = $_GET['updateID'];
//for showing data with respect to id
$sql = "select * from `event` where user_id = $user_id";
$result = mysqli_query($conn,$sql);
$row = mysqli_fetch_assoc($result);
$event_id = $row['event_id'];
$title = $row['title'];
$description = $row['description'];
$date = $row['date'];
$time = $row['time'];
$venue = $row['venue'];
$user_id = $row['user_id'];


if(isset($_POST['submit'])){
  $event_id = $_POST['event_id'];
  $title = $_POST['title'];
  
  $description = $_POST['description'];
  $date = $_POST['date'];
  $time = $_POST['time'];
  $venue = $_POST['venue'];
  $user_id = $_POST['user_id'];

  $sql = "update `event` set event_id=$event_id, title = '$title',description= '$description',  date='$date', time='$time',venue='$venue',user_id='$user_id' where user_id= $user_id";
  $result = mysqli_query($conn,$sql);

  if($result){
    header('location:eventdisplay.php');
    // echo "update";
  }else die(mysqli_errno($conn));


}


?> -->
<?php 
include("config.php");
$user_id = $_GET['updateID'];

// For showing data with respect to id
$sql = "SELECT * FROM `event` WHERE user_id = $user_id";
$result = mysqli_query($conn, $sql);
$row = mysqli_fetch_assoc($result);
$event_id = $row['event_id'];
$title = $row['title'];
$description = $row['description'];
$date = $row['date'];
$time = $row['time'];
$venue = $row['venue'];
$user_id = $row['user_id'];

if (isset($_POST['submit'])) {
    $title = $_POST['title'];
    $description = $_POST['description'];
    $date = $_POST['date'];
    $time = $_POST['time'];
    $venue = $_POST['venue'];
    $user_id = $_POST['user_id'];

    // Update query without changing event_id
    $sql = "UPDATE `event` SET title='$title', description='$description', date='$date', time='$time', venue='$venue', user_id='$user_id' WHERE event_id=$event_id";
    $result = mysqli_query($conn, $sql);

    if ($result) {
        header('location:display3.php');
    } else {
        die(mysqli_error($conn));
    }
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
     <label for="exampleInputEmail1">Event_id</label>
     <input type="number" class="form-control"  placeholder="Enter Name"
     name="event_id" value=<?php echo $event_id; ?>>
    </div>

    <div class="form-group mt-3">
     <label for="exampleInputEmail1">Title</label>
     <input type="text" class="form-control"  placeholder="Enter Email"
     name="title" value=<?php echo $title; ?>>
    </div>

    

    <div class="form-group mt-3">
     <label for="exampleInputEmail1">Description</label>
     <input type="text" class="form-control"  placeholder="Enter password"
     name="description" value=<?php echo $description; ?>>
    </div>
    <div class="form-group mt-3">
     <label for="exampleInputEmail1">Date</label>
     <input type="date" class="form-control"  placeholder="Enter phone"
     name="date" value=<?php echo $date; ?>>
    </div>

    <div class="form-group mt-3">
     <label for="exampleInputEmail1">Time</label>
     <input type="time" class="form-control"  placeholder="Enter date of birth"
     name="time" value=<?php echo $time; ?>>
    </div>
    <div class="form-group mt-3">
     <label for="exampleInputEmail1">Venue</label>
     <input type="text" class="form-control"  placeholder="Enter image"
     name="venue" value=<?php echo $venue; ?>>
    </div>

    <div class="form-group mt-3">
     <label for="exampleInputEmail1">User_id</label>
     <input type="number" class="form-control"  placeholder="Enter address"
     name="user_id" value=<?php echo $user_id; ?>>
    </div>


    <button type="submit" name="submit" class="btn btn-primary mt-3">Update</button>
   
  </form>
  
</body>
</html>