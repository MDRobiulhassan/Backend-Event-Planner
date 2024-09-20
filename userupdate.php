<?php
include("config.php");

$user_id = $_GET['updateID'];

// Fetch current user data from the database
$sql = "SELECT user.user_id, user.name, user.email, userdetails.phone, userdetails.date_of_birth, userdetails.image, userdetails.address
        FROM user
        INNER JOIN userdetails ON user.user_id = userdetails.user_id
        WHERE user.user_id = ?";
$stmt = $conn->prepare($sql);
$stmt->bind_param("i", $user_id);
$stmt->execute();
$result = $stmt->get_result();

if ($result->num_rows === 0) {
    die("User not found.");
}

$row = $result->fetch_assoc();
$name = $row['name'];
$email = $row['email'];
$phone = $row['phone'];
$date_of_birth = $row['date_of_birth'];
$image = $row['image'];
$address = $row['address'];

if (isset($_POST['submit'])) {
    $name = $_POST['name'];
    $email = $_POST['email'];
    $phone = $_POST['phone'];
    $date_of_birth = $_POST['date_of_birth'];
    $address = $_POST['address'];
    
    // Prepare the SQL query based on whether an image is uploaded
    if (!empty($_FILES['image']['tmp_name'])) {
        $image_data = file_get_contents($_FILES['image']['tmp_name']);
        $sql = "UPDATE user
                INNER JOIN userdetails ON user.user_id = userdetails.user_id
                SET user.name = ?, user.email = ?, 
                    userdetails.phone = ?, userdetails.date_of_birth = ?, 
                    userdetails.address = ?, userdetails.image = ?
                WHERE user.user_id = ?";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("ssssbsi", $name, $email, $phone, $date_of_birth, $address, $image_data, $user_id);
    } else {
        $sql = "UPDATE user
                INNER JOIN userdetails ON user.user_id = userdetails.user_id
                SET user.name = ?, user.email = ?, 
                    userdetails.phone = ?, userdetails.date_of_birth = ?, 
                    userdetails.address = ?
                WHERE user.user_id = ?";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("sssssi", $name, $email, $phone, $date_of_birth, $address, $user_id);
    }

    // Execute the query
    if ($stmt->execute()) {
        header('Location: usertable.php');
        exit();
    } else {
        die("Error updating record: " . $stmt->error);
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css">
  <title>Update User</title>
</head>
<body>
  <div class="container mt-4">
    <h1>Update User</h1>
    <form method="post" enctype="multipart/form-data">
      <div class="form-group mt-3">
        <label for="name">Name</label>
        <input type="text" class="form-control" id="name" name="name" placeholder="Enter Name" value="<?php echo htmlspecialchars($name); ?>" required>
      </div>

      <div class="form-group mt-3">
        <label for="email">Email</label>
        <input type="email" class="form-control" id="email" name="email" placeholder="Enter Email" value="<?php echo htmlspecialchars($email); ?>" required>
      </div>

      <div class="form-group mt-3">
        <label for="phone">Phone</label>
        <input type="text" class="form-control" id="phone" name="phone" placeholder="Enter Phone" value="<?php echo htmlspecialchars($phone); ?>" required>
      </div>

      <div class="form-group mt-3">
        <label for="date_of_birth">Date of Birth</label>
        <input type="date" class="form-control" id="date_of_birth" name="date_of_birth" value="<?php echo htmlspecialchars($date_of_birth); ?>" required>
      </div>

      <div class="form-group mt-3">
        <label for="address">Address</label>
        <textarea class="form-control" id="address" name="address" placeholder="Enter Address" required><?php echo htmlspecialchars($address); ?></textarea>
      </div>

      <div class="form-group mt-3">
        <label for="image">Image (leave blank to keep existing)</label>
        <input type="file" class="form-control" id="image" name="image">
        <?php if ($image): ?>
          <img src="data:image/jpeg;base64,<?php echo base64_encode($image); ?>" alt="User Image" width="100" height="100" class="mt-2">
        <?php endif; ?>
      </div>

      <button type="submit" name="submit" class="btn btn-primary mt-3">Update</button>
      <a href="display.php" class="btn btn-secondary mt-3">Cancel</a>
    </form>
  </div>
</body>
</html>
