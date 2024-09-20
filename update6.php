<?php 
include("config.php");
$admin_id = $_GET['updateID'];
//for showing data with respect to id
$sql = "select * from `admin` where admin_id = $admin_id";
$result = mysqli_query($conn,$sql);
$row = mysqli_fetch_assoc($result);
$name = $row['name'];
$email = $row['email'];
$password = $row['password'];

$password  = $row['password'];
if(isset($_POST['submit'])){
  $name = $_POST['name'];
  $email = $_POST['email'];
  
  $password = $_POST['password'];

  $sql = "update `admin` set admin_id=$admin_id, name = '$name',email= '$email',  password = '$password' where admin_id= $admin_id";
  $result = mysqli_query($conn,$sql);

  if($result){
    header('location:display7.php');
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
  <title>update-admin</title>
</head>
<body>
  <div class="container mt-4">
  <form method="post">
    <div class="form-group mt-3">
     <label for="exampleInputEmail1">Name</label>
     <input type="text" class="form-control"  placeholder="Enter Name"
     name="name" value=<?php echo $name ?>>
    </div>

    <div class="form-group mt-3">
     <label for="exampleInputEmail1">Email</label>
     <input type="email" class="form-control"  placeholder="Enter Email"
     name="email" value=<?php echo $email ?>>
    </div>

    

    <div class="form-group mt-3">
     <label for="exampleInputEmail1">Password</label>
     <input type="text" class="form-control"  placeholder="Enter password"
     name="password" value=<?php echo $password ?>>
    </div>

    <button type="submit" name="submit" class="btn btn-primary mt-3">Update</button>
   
  </form>
  
</body>
</html>