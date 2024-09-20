<?php
session_start();
require_once "config.php";

if (!isset($_SESSION['user_id'])) {
    header("Location: login.php");
    exit;
}

$user_id = $_SESSION['user_id'];
$user_name = $_SESSION['user_name'];
$event_id = isset($_GET['event_id']) ? $_GET['event_id'] : null;

if ($event_id) {
    $sql = "SELECT * FROM Event WHERE event_id = ? AND user_id = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("ii", $event_id, $user_id);
    $stmt->execute();
    $result = $stmt->get_result();
    $event = $result->fetch_assoc();

    if (!$event) {
        echo "Event not found or you do not have permission to edit this event.";
        exit;
    }
} else {
    echo "Invalid event ID.";
    exit;
}

$event_datetime = new DateTime($event['date']);
$now = new DateTime();
$days_until_event = $event_datetime->diff($now)->days;

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    if ($days_until_event < 15) {
        $message = "You cannot delete or update this event less than 15 days before it starts.";
        exit;
    }

    if (isset($_POST['update'])) {
        $title = $_POST['title'];
        $description = $_POST['description'];

        $update_sql = "UPDATE Event SET title = ?, description = ? WHERE event_id = ? AND user_id = ?";
        $update_stmt = $conn->prepare($update_sql);
        $update_stmt->bind_param("ssii", $title, $description, $event_id, $user_id);

        if ($update_stmt->execute()) {
            $message = "Event updated successfully.";
            header("Location: dashboard.php");
            exit;
        } else {
            $message = "Error updating event: " . $conn->error;
        }
    } elseif (isset($_POST['delete'])) {
        $delete_sql = "DELETE FROM Event WHERE event_id = ? AND user_id = ?";
        $delete_stmt = $conn->prepare($delete_sql);
        $delete_stmt->bind_param("ii", $event_id, $user_id);

        if ($delete_stmt->execute()) {
            $message = "Event deleted successfully.";
            header("Location: dashboard.php");
            exit;
        } else {
            $message = "Error deleting event: " . $conn->error;
        }
    }
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Event - ARSW INC</title>
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
            <p class="text-center font-weight-bold text-white mb-0">Event Can be Edited or Deleted Atleast Before 15 Days.</br>Date Time And Venue Cannot be Changed.</p>
            <div class="row justify-content-center">
                <div class="col-md-8">
                    <div class="card mt-5 form-container">
                        <div class="card-header text-center">
                            <h4>Edit Event</h4>
                        </div>
                        <div class="card-body">
                            <?php if (isset($message)): ?>
                                <div class="alert alert-info"><?php echo htmlspecialchars($message); ?></div>
                            <?php endif; ?>
                            <form method="POST" id="event-form">
                                <div class="form-group">
                                    <label for="title">Event Title</label>
                                    <input type="text" name="title" class="form-control" id="title"
                                        value="<?php echo htmlspecialchars($event['title']); ?>" required>
                                </div>
                                <div class="form-group">
                                    <label for="description">Event Type</label>
                                    <select name="description" class="form-control pl-3 pt-0 pb-0 font-weight-bold"
                                        id="description" required>
                                        <option value="Wedding" <?php if ($event['description'] == 'Wedding')
                                            echo 'selected'; ?>>Wedding</option>
                                        <option value="Conference" <?php if ($event['description'] == 'Conference')
                                            echo 'selected'; ?>>Conference</option>
                                        <option value="Concert" <?php if ($event['description'] == 'Concert')
                                            echo 'selected'; ?>>Concert</option>
                                        <option value="Workshop" <?php if ($event['description'] == 'Workshop')
                                            echo 'selected'; ?>>Workshop</option>
                                    </select>
                                </div>

                                <div class="form-group">
                                    <label for="venue">Venue</label>
                                    <input type="text" name="venue" class="form-control" id="venue"
                                        value="<?php echo htmlspecialchars($event['venue']); ?>" disabled>
                                </div>
                                <div class="form-group">
                                    <label for="date">Date</label>
                                    <input type="date" name="date" class="form-control" id="date"
                                        value="<?php echo htmlspecialchars($event['date']); ?>" disabled>
                                </div>
                                <div class="form-group">
                                    <label for="time">Time </label>
                                    <input type="time" name="time" class="form-control" id="time"
                                        value="<?php echo htmlspecialchars($event['time']); ?>" disabled>
                                </div>
                                <div class="form-group text-center">
                                    <button type="submit" name="update" class="btn btn-success">Update Event</button>
                                    <button type="submit" name="delete" class="btn btn-danger">Delete Event</button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </main>

        <footer class="footer my-auto text-center text-black text-bold mt-5">
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

        const daysUntilEvent = <?php echo $days_until_event; ?>;
        const eventForm = document.getElementById('event-form');

        eventForm.addEventListener('submit', function (e) {
            if (daysUntilEvent < 15) {
                e.preventDefault();
                alert("You cannot delete or update this event less than 15 days before it starts.");
            }
        });
    </script>
</body>

</html>
