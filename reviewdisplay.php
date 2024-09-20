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
 
  <h1 class="hed">Review</details></h1>
 

 <table class="table container">
  <thead>
    
    <tr>
      <th scope="col">Review_id</th>
      <th scope="col">user_id</th>
      <th scope="col">event_id</th>
      <th scope="col">rating</th>
      <th scope="col">Comment</th>
      
      
      <!-- <th scope="col">password</th> -->
      <th scope="col">operation</th>
    </tr>
  </thead>
  <tbody>
    <?php 
    $sql = "select * from `review`";
    $result = mysqli_query($conn,$sql);
    if($result){
      while( $row = mysqli_fetch_assoc($result)){
        $review_id = $row['review_id'];
        $user_id = $row['user_id'];
        $event_id = $row['event_id'];
        $rating = $row['rating'];
        $comment = $row['comment'];
        
        
        
        
        echo '<tr>
      <th scope="row">'.$review_id.'</th>
      <td>'.$user_id.'</td>
      <td>'.$event_id.'</td>
      <td>'.$rating.'</td>
      <td>'.$comment.'</td>
      
      
      
      
      <td>
    <button class="btn btn-primary "><a class="text-light" href="reviewupdate.php?updateID='.$user_id.'">Update_Event</a></button>
    <button class="btn btn-danger"><a class="text-light" href="reviewdelete.php?deleteID='.$user_id.'">Delete_Event</a></button>
   </td>
    
      <tr>';
      }
      

    }


    ?>

   
   
    
  </tbody>
</table>
  
</body>
</html>