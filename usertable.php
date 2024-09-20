<?php
include("config.php");
?>

<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css"
    integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">

  <title>display</title>
  <style>
    .hed {
      align-items: center;
      text-align: center;
      color: black;
      font-weight: bold;
      margin: 20px;
    }
  </style>
</head>

<body>

  <h1 class="hed">User Table</h1>


  <table class="table container text-center">
    <thead>

      <tr>

        <th>User ID</th>
        <th>Name</th>
        <th>Email</th>
        <th>Phone</th>
        <th>Date of Birth</th>
        <th>Image</th>
        <th>Address</th>
        <th>Admin Status</th>
        <th>Actions</th>
      </tr>

    </thead>
    <tbody>


      <?php
      $sql = "SELECT DISTINCT user.user_id, user.name, user.email, user.is_admin, userdetails.phone, userdetails.date_of_birth, userdetails.image, userdetails.address
        FROM user
        INNER JOIN userdetails ON user.user_id = userdetails.user_id";
      $result = mysqli_query($conn, $sql);

      if ($result) {
        while ($row = mysqli_fetch_assoc($result)) {
          $user_id = $row['user_id'];
          $name = $row['name'];
          $email = $row['email'];
          $is_admin = $row['is_admin'];
          $phone = $row['phone'];
          $date_of_birth = $row['date_of_birth'];
          $image = $row['image']; // This is the image file path
          $address = $row['address'];

          $message = $is_admin ? "YES" : "NO";

          echo '<tr>
            <th scope="row">' . $user_id . '</th>
            <td>' . $name . '</td>
            <td>' . $email . '</td>
            <td>' . $phone . '</td>
            <td>' . $date_of_birth . '</td>';

          // Display the image using the file path stored in the database
          echo '<td><img src="data:image/jpeg;base64,' . base64_encode($image) . '" alt="User Image" width="50" height="50"></td>';

          echo '<td>' . $address . '</td>
            <td>' . $message . '</td>
            <td>
                <button class="btn btn-primary"><a class="text-light" href="userupdate.php?updateID=' . $user_id . '">Update_User</a></button>
                <button class="btn btn-danger"><a class="text-light" href="userdelete.php?deleteID=' . $user_id . '">Delete_User</a></button>';

          // Show "Admin Access" button only if is_admin is 0
          if ($is_admin == 0) {
            echo '<button class="btn btn-primary"><a class="text-light" href="userasadmin.php?AdminID=' . $user_id . '">Admin Access</a></button>';
          }

          echo '</td>
            </tr>';
        }
      }
      ?>








    </tbody>
  </table>

</body>

</html>