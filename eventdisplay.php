<?php 
include("config.php");
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">

  <title>display</title>
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
 
  <h1 class="hed">Event</details></h1>
 

 <table class="table container">
  <thead>
    
    <tr>
      <th scope="col">event_id</th>
      <th scope="col">title</th>
      <th scope="col">description</th>
      <th scope="col">date</th>
      <th scope="col">time</th>
      <th scope="col">venue</th>
      <th scope="col">user_id</th>
      
      <!-- <th scope="col">password</th> -->
      <th scope="col">operation</th>
    </tr>
  </thead>
  <tbody>
    <?php 
    $sql = "select * from `event`";
    $result = mysqli_query($conn,$sql);
    if($result){
      while( $row = mysqli_fetch_assoc($result)){
        $event_id = $row['event_id'];
        $title = $row['title'];
        $description = $row['description'];
        $date = $row['date'];
        $time = $row['time'];
        $venue = $row['venue'];
        $user_id = $row['user_id'];
        
        
        
        echo '<tr>
      <th scope="row">'.$event_id.'</th>
      <td>'.$title.'</td>
      <td>'.$description.'</td>
      <td>'.$date.'</td>
      <td>'.$time.'</td>
      <td>'.$venue.'</td>
      <td>'.$user_id.'</td>
      
      
      
      <td>
    <button class="btn btn-primary "><a class="text-light" href="eventupdate.php?updateID='.$user_id.'">Update_Event</a></button>
    <button class="btn btn-danger"><a class="text-light" href="eventdelete.php?deleteID='.$user_id.'">Delete_Event</a></button>
   </td>
    
      <tr>';
      }
      

    }


    ?>

   
   
    
  </tbody>
</table>
  
</body>
</html>