<?php 
include("config.php");
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">

  <title>Display_attendee</title>
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
 
  <h1 class="hed">Attendee</details></h1>
 

 <table class="table container text-center">
  <thead>
    
    <tr>
      <th scope="col">Attendee_id</th>
      <th scope="col">name</th>
      <th scope="col">email</th>
      <th scope="col">phone</th>
      <th scope="col">date_of_birth</th>
      <th scope="col">Event ID</th>
      <th scope="col">operation</th>
    </tr>
  </thead>
  <tbody>
    <?php 
    $sql = "select * from `attendee`";
    $result = mysqli_query($conn,$sql);
    if($result){
      while( $row = mysqli_fetch_assoc($result)){
        $attendee_id = $row['attendee_id'];
        $name = $row['name'];
        $email = $row['email'];
        $phone = $row['phone'];
        $date_of_birth = $row['date_of_birth'];
        $address = $row['address'];
        $eventid = $row['event_id'];
        
        
        echo '<tr>
      <th scope="row">'.$attendee_id.'</th>
      <td>'.$name.'</td>
      <td>'.$email.'</td>
      <td>'.$phone.'</td>
      <td>'.$address.'</td>
      <td>'.$eventid.'</td>
      
      <td>
    <button class="btn btn-primary "><a class="text-light" href="attendeupdate.php?updateID='.$attendee_id.'">Update_Attendee</a></button>
    <button class="btn btn-danger"><a class="text-light" href="attendedelete.php?deleteID='.$attendee_id.'">Delete_Attendee</a></button>
   </td>
    
      <tr>';
      }
      

    }


    ?>

   
   
    
  </tbody>
</table>
  
</body>
</html>