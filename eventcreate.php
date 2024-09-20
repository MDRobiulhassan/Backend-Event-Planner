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

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Create Event</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css"
        integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
    <link rel="stylesheet" href="eventcreate.css">
    <link rel="stylesheet" href="dashboard.css">
</head>

<body>
    <nav class="navbar navbar-expand-lg">
        <a class="navbar-brand" href="index.php">ARSW INC.</a>
        <button class="navbar-toggler d-lg-none" type="button" data-toggle="collapse" data-target="#collapsibleNavId"
            aria-controls="collapsibleNavId" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse justify-content-center text-align-center" id="collapsibleNavId">
            <ul class="navbar-nav mx-auto font-weight-bold">
                <li class="nav-item mr-2">
                    <a class="nav-link text-white" href="eventcreate.php">Create Event</a>
                </li>
                <li class="nav-item mr-2">
                    <a class="nav-link  text-white" href="schedule.php">Event Schedule</a>
                </li>
                <li class="nav-item mr-2">
                    <a class="nav-link  text-white" href="pricing.php">Pricing</a>
                </li>
                <li class="nav-item mr-2">
                    <a class="nav-link  text-white" href="information.php">About Us</a>
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
    <div class="container-fluid">
        <hr class="divider">
        <div class="row justify-content-center mt-4">
            <div class="col-md-6 m-3">
                <div class="card">
                    <div class="card-header bg-primary text-center text-white font-weight-bold">
                        Create Event
                    </div>
                    <div class="card-body">
                        <form id="eventForm" action="submit_event.php" method="post">
                            <div class="form-group">
                                <label for="eventName">Event Name:</label>
                                <input type="text" class="form-control" id="eventName" name="eventName" required>
                            </div>
                            <div class="form-group">
                                <label for="eventType">Event Type:</label>
                                <select class="form-control" id="eventType" name="eventType" required>
                                    <option value="">Select Event Type</option>
                                    <option value="wedding">Wedding</option>
                                    <option value="concert">Concert</option>
                                    <option value="workshop">Workshop</option>
                                    <option value="conference">Conference</option>
                                </select>
                            </div>
                            <div class="form-group">
                                <label for="date">Date:</label>
                                <input type="date" class="form-control" id="eventDate" name="eventDate"
                                required>
                            </div>
                            <div class="form-group">
                                <label for="time">Time:</label>
                                <input type="time" class="form-control" id="eventtime" name="eventtime"
                                required>
                            </div>
                            <div class="form-group">
                                <label for="venue">Venue:</label>
                                <select class="form-control" id="venue" name="venue" required>
                                    <option value="">Select Venue</option>
                                    <option value="Dhaka">Dhaka</option>
                                    <option value="Chittagong">Chittagong</option>
                                    <option value="New York">New York</option>
                                    <option value="London">London</option>
                                </select>
                            </div>
                            <!-- <div class="form-group">
                                <label for="package">Package:</label>
                                <select class="form-control" id="package" name="package" required>
                                    <option value="">Select Package</option>
                                    <option value="premium">Premium</option>
                                    <option value="standard">Standard</option>
                                    <option value="essential">Essential</option>
                                </select>
                            </div> -->
                            <button type="submit" class="btn btn-primary btn-block">Create Event</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js"
        integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo"
        crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js"
        integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDzwrnQq4sF86dIHNDz0W1"
        crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js"
        integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM"
        crossorigin="anonymous"></script>
</body>

</html>