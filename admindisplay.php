<?php 
include("config.php");
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">

  <title>display-admin</title>
  <style>
    .hed{
      align-items: center;
      text-align: center;
      color: black;
      font-weight: bold;
      margin: 20px;
    }
  </style>
</head>
<body>
 
  <h1 class="hed">Admin Table</h1>
 

 <table class="table container">
  <thead>
    
    <tr>
      <th scope="col">admin_id</th>

      <th scope="col">User_id</th>
      <th scope="col">name</th>
      <th scope="col">email</th>
      <th scope="col">Password</th>
      
      <!-- <th scope="col">password</th> -->
      <th scope="col">operation</th>
    </tr>
  </thead>
  <tbody>
    <?php 
    $sql = "select * from `admin`";
    $result = mysqli_query($conn,$sql);
    if($result){
      while( $row = mysqli_fetch_assoc($result)){
        $admin_id = $row['admin_id'];
        $user_id = $row['user_id'];
        $name = $row['name'];
        $email = $row['email'];
        $password = $row['password'];
        
        
        echo '<tr>
      <th scope="row">'.$admin_id.'</th>
      <td>'.$user_id.'</td>
      <td>'.$name.'</td>
      <td>'.$email.'</td>
      <td>'.$password.'</td>
      
      
      
      <td>
    <button class="btn btn-danger"><a class="text-light" href="admindelete6.php?deleteID='.$admin_id.'">Delete_Admin</a></button>
   </td>
    
      <tr>';
      }
      

    }


    ?>

   
   
    
  </tbody>
</table>
  
</body>
</html>