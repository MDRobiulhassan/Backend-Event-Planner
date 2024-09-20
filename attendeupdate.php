<?php 
include("config.php");
$attendee_id = $_GET['updateID'];
//for showing data with respect to id
$sql = "select * from `attendee` where attendee_id = $attendee_id";
$result = mysqli_query($conn,$sql);
$row = mysqli_fetch_assoc($result);
$name = $row['name'];
$email = $row['email'];
$phone = $row['phone'];
$date_of_birth = $row['date_of_birth'];
$image = $row['image'];
$address = $row['address'];


if(isset($_POST['submit'])){
  $name = $_POST['name'];
  $email = $_POST['email'];
  
  $phone = $_POST['phone'];
  $date_of_birth= $_POST['date_of_birth'];
  $image = $_POST['image'];
  $address = $_POST['address'];

  $sql = "update `attendee` set attendee_id=$attendee_id, name = '$name',email= '$email',  phone='$phone', date_of_birth='$date_of_birth',image='$image',address='$address' where attendee_id= $attendee_id";
  $result = mysqli_query($conn,$sql);

  if($result){
    header('location:display6.php');
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
     <label for="exampleInputEmail1">Name</label>
     <input type="text" class="form-control"  placeholder="Enter Name"
     name="name" value=<?php echo $name; ?>>
    </div>

    <div class="form-group mt-3">
     <label for="exampleInputEmail1">Email</label>
     <input type="email" class="form-control"  placeholder="Enter Email"
     name="email" value=<?php echo $email; ?>>
    </div>

    

    <div class="form-group mt-3">
     <label for="exampleInputEmail1">Password</label>
     <input type="text" class="form-control"  placeholder="Enter password"
     name="password" value=<?php echo $password; ?>>
    </div>
    <div class="form-group mt-3">
     <label for="exampleInputEmail1">phone</label>
     <input type="number" class="form-control"  placeholder="Enter phone"
     name="phone" value=<?php echo $phone; ?>>
    </div>

    <div class="form-group mt-3">
     <label for="exampleInputEmail1">date_of_birth</label>
     <input type="date" class="form-control"  placeholder="Enter date of birth"
     name="date_of_birth" value=<?php echo $date_of_birth; ?>>
    </div>
    <div class="form-group mt-3">
     <label for="exampleInputEmail1">image</label>
     <input type="image" class="form-control"  placeholder="Enter image"
     name="phone" value=<?php echo $image; ?>>
    </div>

    <div class="form-group mt-3">
     <label for="exampleInputEmail1">address</label>
     <input type="text" class="form-control"  placeholder="Enter address"
     name="address" value=<?php echo $address; ?>>
    </div>


    <button type="submit" name="submit" class="btn btn-primary mt-3">Update</button>
   
  </form>
  
</body>
</html>