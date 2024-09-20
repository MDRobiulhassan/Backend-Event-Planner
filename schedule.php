<?php
session_start();

include('config.php');

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
?>

<!doctype html>
<html lang="en">

<head>
  <title>Event Schedule</title>
  <!-- Required meta tags -->
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

  <!-- Bootstrap CSS -->
  <link rel="stylesheet" href="schedule.css">
  <link rel="stylesheet" href="dashboard.css">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
  <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css"
    integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
</head>

<body style="    background-image: linear-gradient(rgba(0, 0, 0, 0.75), rgba(0, 0, 0, 0.75)), url('images/calender1.jpg');">
  <nav class="navbar navbar-expand-sm navbar-dark">
    <a class="navbar-brand" href="index.php">ARSW INC.</a>
    <button class="navbar-toggler d-lg-none" type="button" data-toggle="collapse" data-target="#collapsibleNavId"
      aria-controls="collapsibleNavId" aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse justify-content-center text-align-center" id="collapsibleNavId">
      <ul class="navbar-nav mt-2 mt-lg-0 mx-auto">
        <li class="nav-item mr-2">
          <a class="nav-link" href="eventcreate.php">Create Event <span class="sr-only">(current)</span></a>
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
  </nav>

  <div class="container">
    <div class="form-group d-flex justify-content-end">
      <form method="GET" action="schedule.php" class="form-inline">
        <input type="text" name="search" class="form-control mr-2" placeholder="Enter event name">
        <button type="submit" class="btn btn-primary">Search</button>
      </form>
    </div>

    <table class="table text-white text-center">
      <thead>
        <tr>
          <th scope="col">Event Name</th>
          <th scope="col">Venue</th>
          <th scope="col">Date</th>
          <th scope="col">Time</th>
          <th scope="col">Registration</th>
        </tr>
      </thead>
      <tbody class="table-group-divider">
        <?php
        include 'config.php';

        $search = isset($_GET['search']) ? $_GET['search'] : '';

        $sql = "SELECT event_id, title, venue, date, time FROM Event";
        if ($search) {
          $sql .= " WHERE title LIKE '%" . $conn->real_escape_string($search) . "%'";
        }
        $sql .= " LIMIT 10";

        $result = $conn->query($sql);

        if ($result->num_rows > 0) {
          while ($row = $result->fetch_assoc()) {
            echo "<tr>
                    <td>" . htmlspecialchars($row['title']) . "</td>
                    <td>" . htmlspecialchars($row['venue']) . "</td>
                    <td>" . htmlspecialchars($row['date']) . "</td>
                    <td>" . htmlspecialchars($row['time']) . "</td>
                    <td><a href='register.php?event_id=" . $row['event_id'] . "' class='btn btn-primary'>Register</a></td>
                  </tr>";
          }
        } else {
          echo "<tr><td colspan='5'>No events found</td></tr>";
        }
        $conn->close();
        ?>
      </tbody>
    </table>
  </div>

  <footer class="text-white">
    <p>&copy; 2024 Samin Osman. All rights reserved.</p>
    <div class="social-icons">
      <a href="https://www.facebook.com/samin.mohammad05" class="text-white mr-3 fb"><i class="fa fa-facebook"></i></a>
      <a href="https://www.instagram.com/samin0sm/" class="text-white mr-3 ins"><i class="fa fa-instagram"></i></a>
      <a href="#" class="text-white ld mr-3"><i class="fa fa-linkedin"></i></a>
    </div>
  </footer>
  <script>
    document.querySelectorAll('.dropdown-item').forEach(item => {
      item.addEventListener('click', function () {
        const target = this.getAttribute('data-target');
        if (target) {
          window.location.href = target;
        }
      });
    });
  </script>
  <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js"
    integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo"
    crossorigin="anonymous"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js"
    integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1"
    crossorigin="anonymous"></script>
  <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js"
    integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM"
    crossorigin="anonymous"></script>
</body>

</html>