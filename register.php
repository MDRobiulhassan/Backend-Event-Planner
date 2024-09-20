<?php
session_start();
require_once "config.php";

// Check if the user is logged in
$isLoggedIn = isset($_SESSION['user_id']);
$user_id = $isLoggedIn ? $_SESSION['user_id'] : null;
$user_name = ""; // Initialize the user name variable

if ($isLoggedIn) {
  // Fetch the logged-in user's name from the database
  $sql = "SELECT name FROM user WHERE user_id = ?";
  $stmt = $conn->prepare($sql);
  $stmt->bind_param("i", $user_id);
  $stmt->execute();
  $result = $stmt->get_result();

  if ($result->num_rows > 0) {
    $row = $result->fetch_assoc();
    $user_name = $row['name']; // Assign the name to the variable
  }
}
// Get the event_id from the URL
$event_id = isset($_GET['event_id']) ? intval($_GET['event_id']) : 0;

if ($event_id == 0) {
  die("Invalid event ID.");
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
  $name = $_POST['name'];
  $email = $_POST['email'];
  $phone = $_POST['phone'];
  $date_of_birth = $_POST['date_of_birth'];
  $address = $_POST['address'];
  $image = $_FILES['image']['tmp_name'];

  // Read the image data
  $imageData = addslashes(file_get_contents($image));

  // Insert the data into the database
  $stmt = $conn->prepare("INSERT INTO attendee (name, email, phone, date_of_birth, address, image, event_id) VALUES (?, ?, ?, ?, ?, ?, ?)");
  $stmt->bind_param("ssssssi", $name, $email, $phone, $date_of_birth, $address, $imageData, $event_id);

  if ($stmt->execute()) {
    $success_message = "Registration successful!";
  } else {
    $error_message = "Error: " . $stmt->error;
  }
  $stmt->close();
}
?>
<!doctype html>
<html lang="en">

<head>
  <title>Event Registration</title>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css">
  <link rel="stylesheet" href="dashboard.css">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
 
</head>

<body>
  <nav class="navbar navbar-expand-sm navbar-dark">
    <a class="navbar-brand" href="index.php">ARSW INC.</a>
    <button class="navbar-toggler d-lg-none" type="button" data-toggle="collapse" data-target="#collapsibleNavId"
      aria-controls="collapsibleNavId" aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse justify-content-center" id="collapsibleNavId">
      <ul class="navbar-nav mt-2 mt-lg-0 mx-auto">
        <li class="nav-item mr-2">
          <a class="nav-link" href="eventcreate.php">Create Event</a>
        </li>
        <li class="nav-item mr-2">
          <a class="nav-link active" href="schedule.php">Event Schedule</a>
        </li>
        <li class="nav-item mr-2">
          <a class="nav-link" href="pricing.php">Pricing</a>
        </li>
        <li class="nav-item mr-2">
          <a class="nav-link mx-auto" href="information.php">About Us</a>
        </li>
      </ul>
      <div class="d-flex justify-content-center">
        <?php if ($isLoggedIn): ?>
          <div class="d-flex align-items-center user dropdown" data-toggle="dropdown">
            <a href="#" class="user-icon-link">
              <i class="fa fa-user-circle mr-2"></i>
            </a>
            <span><?php echo htmlspecialchars($user_name); ?></span> <!-- Display the user's name -->
            <i class="fa fa-angle-down ml-2" aria-haspopup="true" aria-expanded="false"></i>
          </div>
          <div class="dropdown-menu dropdown-menu-right mr-2">
            <a class="dropdown-item" href="dashboard.php" data-target="dashboard.php">Dashboard</a>
            <a class="dropdown-item" href="profile.php" data-target="profile.php">Profile</a>
            <a class="dropdown-item text-danger" href="logout.php" data-target="logout.php">Logout</a>
          </div>

        <?php else: ?>
          <a href="login.php" class="btn btn-outline-light mr-3">Log In</a>
          <a href="signup.php" class="btn btn-outline-light">Sign Up</a>
        <?php endif; ?>
      </div>
    </div>
    </div>
  </nav>

  <div class="container">
    <h2 class="mt-5 text-white text-center">Event Registration</h2>
    <?php
    if (!empty($error_message)) {
      echo '<div class="alert alert-danger alert-dismissible fade show" role="alert">
                    <strong>Error!</strong> ' . $error_message . '
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                  </div>';
    } elseif (!empty($success_message)) {
      echo '<div class="alert alert-success alert-dismissible fade show" role="alert">
                    <strong>Success!</strong> ' . $success_message . '
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                  </div>';
    }
    ?>
    <form method="post" class="text-white font-weight-bold"
      action="register.php?event_id=<?php echo htmlspecialchars($event_id); ?>" enctype="multipart/form-data">
      <input type="hidden" name="event_id" value="<?php echo htmlspecialchars($event_id); ?>">
      <div class="form-group">
        <label for="name">Name</label>
        <input type="text" class="form-control" id="name" name="name" required>
      </div>
      <div class="form-group">
        <label for="email">Email</label>
        <input type="email" class="form-control" id="email" name="email" required>
      </div>
      <div class="form-group">
        <label for="phone">Phone</label>
        <input type="text" class="form-control" id="phone" name="phone">
      </div>
      <div class="form-group">
        <label for="date_of_birth">Date of Birth</label>
        <input type="date" class="form-control" id="date_of_birth" name="date_of_birth">
      </div>
      <div class="form-group">
        <label for="address">Address</label>
        <input type="text" class="form-control" id="address" name="address">
      </div>
      <div class="form-group">
        <label for="image">Upload Image</label>
        <input type="file" class="form-control-file" id="image" name="image" accept="image/*" required>
      </div>
      <button type="submit" class="btn btn-primary">Register</button>
    </form>
  </div>

  <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js"></script>
  <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js"></script>
</body>

</html>

<?php
$conn->close();
?>