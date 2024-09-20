<?php
session_start();
require_once "config.php";

if (!isset($_SESSION['user_id'])) {
    header("Location: login.php");
    exit;
}

$user_id = $_SESSION['user_id'];
$user_name = $_SESSION['user_name'];

if (!isset($_GET['event_id'])) {
    echo "Event ID is required.";
    exit;
}

$event_id = $_GET['event_id'];

$sql_event = "SELECT title, description, date, time, venue FROM Event WHERE event_id = ? AND user_id = ?";
$stmt_event = $conn->prepare($sql_event);
$stmt_event->bind_param("ii", $event_id, $user_id);
$stmt_event->execute();
$result_event = $stmt_event->get_result();

if ($result_event->num_rows == 0) {
    echo "No such event found.";
    exit;
}

$event = $result_event->fetch_assoc();
$stmt_event->close();

$sql_attendees = "SELECT attendee_id, name, email, phone, date_of_birth, image, address FROM Attendee WHERE event_id = ?";
$stmt_attendees = $conn->prepare($sql_attendees);
$stmt_attendees->bind_param("i", $event_id);
$stmt_attendees->execute();
$result_attendees = $stmt_attendees->get_result();

$attendees = [];
while ($row = $result_attendees->fetch_assoc()) {
    $attendees[] = $row;
}

$stmt_attendees->close();
$conn->close();
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Event Details - ARSW INC</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css"
        integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
    <link rel="stylesheet" href="profile.css">
    <link rel="stylesheet" href="dashboard.css">
</head>

<body>
    <div class="container-fluid">
        <header class="text-black pt-3">
            <div class="d-flex justify-content-between align-items-center">
                <a class="navbar-brand" href="index.php">ARSW INC</a>
                <div class="d-flex align-items-center user" data-toggle="dropdown">
                    <a href="#" class="user-icon-link">
                        <i class="fa fa-user-circle mr-2"></i>
                    </a>
                    <span><?php echo htmlspecialchars($user_name); ?></span>
                    <i class="fa fa-angle-down ml-2" aria-haspopup="true" aria-expanded="false"></i>
                    <div class="dropdown-menu mt-2">
                        <a href="eventcreate.php" class="dropdown-item" data-target="eventcreate.php">Create Event</a>
                        <a class="dropdown-item" href="schedule.php" data-target="schedule.php">Event Schedule</a>
                        <a class="dropdown-item" href="profile.php" data-target="profile.php">Profile</a>
                        <a class="dropdown-item" href="dashboard.php" data-target="dashboard.php">Dashboard</a>
                        <hr class="dropdown-divider">
                        <a class="dropdown-item text-danger" href="logout.php" data-target="logout.php">Logout</a>
                    </div>
                </div>
            </div>
        </header>
        <hr class="divider">

        <main>
            <div class="row">
                <div class="col-12 text-center">
                    <h4 class="text-white"><?php echo htmlspecialchars($event['title']); ?></h4>
                </div>
            </div>
            <div class="row m-4">
                <div class="col-12">
                    <h5 class="text-white mb-3 text-center">Attendees</h5>
                    <?php if (count($attendees) > 0): ?>
                        <table class="table table-striped table-dark text-center">
                            <thead>
                                <tr>
                                    <th>Name</th>
                                    <th>Email</th>
                                    <th>Phone</th>
                                    <th>Date of Birth</th>
                                    <th>Address</th>
                                    <th>Image</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php foreach ($attendees as $attendee): ?>
                                    <tr>
                                        <td><?php echo htmlspecialchars($attendee['name']); ?></td>
                                        <td><?php echo htmlspecialchars($attendee['email']); ?></td>
                                        <td><?php echo htmlspecialchars($attendee['phone']); ?></td>
                                        <td><?php echo htmlspecialchars($attendee['date_of_birth']); ?></td>
                                        <td><?php echo htmlspecialchars($attendee['address']); ?></td>
                                        <td>
                                            <?php if (!empty($attendee['image'])): ?>
                                                <?php $image_data = base64_encode($attendee['image']); ?>
                                                <?php $image_src = 'data:image/jpg;base64,' . $image_data; ?>
                                                <img src="<?php echo $image_src; ?>" alt="Attendee Image"
                                                    style="max-width: 50px; max-height: 50px;">
                                            <?php else: ?>
                                                No Image
                                            <?php endif; ?>
                                        </td>
                                        <td>
                                            <a href="deleteattendee.php?attendee_id=<?php echo $attendee['attendee_id']; ?>&event_id=<?php echo $event_id; ?>"
                                                class="btn btn-danger"
                                                onclick="return confirm('Are you sure you want to delete this attendee?');">Delete</a>
                                        </td>
                                    </tr>
                                <?php endforeach; ?>
                            </tbody>
                        </table>
                    <?php else: ?>
                        <p class="text-white">No attendees found for this event.</p>
                    <?php endif; ?>
                </div>
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