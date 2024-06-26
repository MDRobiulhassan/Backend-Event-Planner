<?php
session_start();
require_once "config.php";

if (!isset($_SESSION['user_id'])) {
    header("Location: login.php");
    exit;
}

$user_id = $_SESSION['user_id'];
$user_name = $_SESSION['user_name'];

$upcoming_events = [];
$past_events = [];

$sql = "SELECT title,description, venue, date, time FROM Event WHERE user_id = ? ORDER BY date, time";
$stmt = $conn->prepare($sql);
$stmt->bind_param("i", $user_id);
$stmt->execute();
$result = $stmt->get_result();

$current_date = date("Y-m-d");

while ($row = $result->fetch_assoc()) {
    if ($row['date'] >= $current_date) {
        $upcoming_events[] = $row;
    } else {
        $past_events[] = $row;
    }
}

$stmt->close();
$conn->close();
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>User Dashboard - ARSW INC</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css"
        integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
    <link rel="stylesheet" href="dashboard.css">
</head>

<body>
    <div class="container-fluid">
        <header class="text-black pt-3">
            <div class="d-flex justify-content-between align-items-center">
                <a class="navbar-brand" href="index.html">ARSW INC</a>
                <div class="d-flex align-items-center user" data-toggle="dropdown">
                    <a href="#" class="user-icon-link">
                        <i class="fa fa-user-circle mr-2"></i>
                    </a>
                    <span><?php echo htmlspecialchars($user_name); ?></span>
                    <i class="fa fa-angle-down ml-2" aria-haspopup="true" aria-expanded="false"></i>
                    <div class="dropdown-menu mt-2">
                        <a href="eventcreate.html" class="dropdown-item" data-target="eventcreate.html">Create
                            Event</a>
                        <a class="dropdown-item" href="schedule.html" data-target="schedule.html">Event
                            Schedule</a>
                        <a class="dropdown-item" href="#" data-target="#">Profile</a>
                        <hr class="dropdown-divider">
                        <a class="dropdown-item text-danger" href="logout.php">Logout</a>
                    </div>
                </div>
            </div>
        </header>
        <hr class="divider">

        <main>
            <div class="row">
                <div class="col-12 text-center">
                    <h4 class="text-white">My Events</h4>
                </div>
            </div>
            <div class="row m-4">
                <div class="col-12">
                    <h5 class="text-white mb-3">Upcoming Events</h5>
                </div>
                <?php foreach ($upcoming_events as $event): ?>
                    <div class="card ml-3 mb-3" style="width: 18rem;">
                        <img src="images/wedding.jpg" class="card-img-top" alt="Event Image">
                        <div class="card-body">
                            <h5 class="card-title"><?php echo htmlspecialchars($event['title']); ?></h5>
                            <h6 class="card-text"><?php echo htmlspecialchars($event['description']); ?></h6>
                            <h6 class="card-text">Venue: <?php echo htmlspecialchars($event['venue']); ?></h6>
                            <p class="card-text">Date: <?php echo htmlspecialchars($event['date']); ?><br>Time: <?php echo htmlspecialchars($event['time']); ?></p>
                            <a href="#" class="btn btn-primary">Details</a>
                        </div>
                    </div>
                <?php endforeach; ?>
            </div>
            <hr class="inset">
            <div class="row m-4">
                <div class="col-12">
                    <h5 class="text-white mb-3">Past Events</h5>
                </div>
                <?php foreach ($past_events as $event): ?>
                    <div class="card ml-3 mb-3" style="width: 18rem;">
                        <img src="images/wedding.jpg" class="card-img-top" alt="Event Image">
                        <div class="card-body">
                            <h5 class="card-title"><?php echo htmlspecialchars($event['title']); ?></h5>
                            <h6 class="card-text"><?php echo htmlspecialchars($event['description']); ?></h6>
                            <h6 class="card-text">Venue: <?php echo htmlspecialchars($event['venue']); ?></h6>
                            <p class="card-text">Date: <?php echo htmlspecialchars($event['date']); ?><br>Time: <?php echo htmlspecialchars($event['time']); ?></p>
                            <a href="#" class="btn btn-primary">Details</a>
                        </div>
                    </div>
                <?php endforeach; ?>
            </div>
        </main>

        <footer class="footer my-auto text-center text-white text-bold">
            <h5>2024 &copy;Robiul Hassan</h5>
        </footer>
    </div>

    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js"
        integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo"
        crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js"
        integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1"
        crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js"
        integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM"
        crossorigin="anonymous"></script>
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
</body>

</html>
