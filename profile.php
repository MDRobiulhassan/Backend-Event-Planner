<?php
session_start();

require_once "config.php";

if (!isset($_SESSION['user_id'])) {
    header("Location: login.php");
    exit;
}

$user_id = $_SESSION['user_id'];

$sql_details = "SELECT name, email, phone, date_of_birth, image, address FROM UserDetails WHERE user_id = ?";
$stmt_details = $conn->prepare($sql_details);
$stmt_details->bind_param("i", $user_id);
$stmt_details->execute();
$result_details = $stmt_details->get_result();

if ($result_details->num_rows === 1) {
    $row_details = $result_details->fetch_assoc();
    $name = $row_details['name'];
    $email = $row_details['email'];
    $phone = $row_details['phone'];
    $date_of_birth = $row_details['date_of_birth'];
    $image = $row_details['image'];
    $address = $row_details['address'];
} else {
    echo "User details not found.";
    exit;
}

$stmt_details->close();

$sql_user = "SELECT name FROM User WHERE user_id = ?";
$stmt_user = $conn->prepare($sql_user);
$stmt_user->bind_param("i", $user_id);
$stmt_user->execute();
$result_user = $stmt_user->get_result();

if ($result_user->num_rows === 1) {
    $row_user = $result_user->fetch_assoc();
    $user_name = $row_user['name'];
} else {
    echo "User not found.";
    exit;
}

$stmt_user->close();

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $name = $_POST['name'];
    $phone = $_POST['phone'];
    $date_of_birth = $_POST['date_of_birth'];
    $address = $_POST['address'];

    $email = $_POST['email'];
    if (isset($_FILES['image']) && $_FILES['image']['error'] === UPLOAD_ERR_OK) {
        $image = file_get_contents($_FILES['image']['tmp_name']);
    }

    if (!empty($_POST['new_password'])) {
        $new_password = $_POST['new_password'];

        if (strlen($new_password) < 8) {
            echo "New password must be at least 8 characters long.";
            exit;
        }

        $hashed_password = password_hash($new_password, PASSWORD_DEFAULT);

        $sql_change_password = "UPDATE User SET password = ? WHERE user_id = ?";
        $stmt_change_password = $conn->prepare($sql_change_password);
        $stmt_change_password->bind_param("si", $hashed_password, $user_id);

        if ($stmt_change_password->execute()) {
            header("Location: profile.php");
            exit;
        } else {
            echo "Error changing password: " . $stmt_change_password->error;
        }

        $stmt_change_password->close();
    }

    if ($user_name !== $name) {
        $sql_update_user = "UPDATE User SET name = ? WHERE user_id = ?";
        $stmt_update_user = $conn->prepare($sql_update_user);
        $stmt_update_user->bind_param("si", $name, $user_id);

        if ($stmt_update_user->execute()) {
            $sql_update_details = "UPDATE UserDetails SET name = ?, phone = ?, date_of_birth = ?, address = ?, image = ? WHERE user_id = ?";
            $stmt_update_details = $conn->prepare($sql_update_details);
            $stmt_update_details->bind_param("sssssi", $name, $phone, $date_of_birth, $address, $image, $user_id);

            if ($stmt_update_details->execute()) {
                header("Location: profile.php");
                exit;
            } else {
                echo "Error updating profile details: " . $stmt_update_details->error;
            }

            $stmt_update_details->close();
        } else {
            echo "Error updating profile name: " . $stmt_update_user->error;
        }

        $stmt_update_user->close();
    } else {
        $sql_update_details = "UPDATE UserDetails SET phone = ?, date_of_birth = ?, address = ?, image = ? WHERE user_id = ?";
        $stmt_update_details = $conn->prepare($sql_update_details);
        $stmt_update_details->bind_param("ssssi", $phone, $date_of_birth, $address, $image, $user_id);

        if ($stmt_update_details->execute()) {
            header("Location: profile.php");
            exit;
        } else {
            echo "Error updating profile details: " . $stmt_update_details->error;
        }

        $stmt_update_details->close();
    }
}

$conn->close();
?>



<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>User Profile - ARSW INC</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css"
        integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
    <link rel="stylesheet" href="dashboard.css">
    <link rel="stylesheet" href="profile.css">
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
                    <span><?php echo htmlspecialchars($name); ?></span>
                    <i class="fa fa-angle-down ml-2" aria-haspopup="true" aria-expanded="false"></i>
                    <div class="dropdown-menu mt-2">
                        <a href="eventcreate.php" class="dropdown-item" data-target="eventcreate.php">Create
                            Event</a>
                        <a class="dropdown-item" href="schedule.php" data-target="schedule.php">Event
                            Schedule</a>
                        <a class="dropdown-item" href="dashboard.php" data-target="dashboard.php">Dashboard</a>
                        <hr class="dropdown-divider">
                        <a class="dropdown-item text-danger" href="logout.php" data-target="logout.php">Logout</a>
                    </div>
                </div>
            </div>
        </header>
        <hr class="divider">
        <div class="container">
            <div class="row">
                <div class="col-12 text-center">
                    <h4 class="text-white">User Profile</h4>
                </div>
            </div>
            <div class="row justify-content-center pt-3">
                <div class="col-md-8 col-lg-6">
                    <div class="form-container">
                        <div class="text-center">
                            <h4 class="text-dark">Update Profile</h4>
                        </div>
                        <form method="POST" enctype="multipart/form-data">
                            <div class="form-group">
                                <label for="name">Name:</label>
                                <input type="text" class="form-control" id="name" name="name"
                                    value="<?php echo htmlspecialchars($name); ?>" required>
                            </div>
                            <div class="form-group">
                                <label for="email">Email:</label>
                                <input type="email" class="form-control" id="email" name="email"
                                    value="<?php echo htmlspecialchars($email); ?>" readonly>
                                <!-- Readonly attribute to prevent editing -->
                            </div>
                            <div class="form-group">
                                <label for="phone">Phone:</label>
                                <input type="text" class="form-control" id="phone" name="phone"
                                    value="<?php echo htmlspecialchars($phone); ?>" required>
                            </div>
                            <div class="form-group">
                                <label for="date_of_birth">Date of Birth:</label>
                                <input type="date" class="form-control" id="date_of_birth" name="date_of_birth"
                                    value="<?php echo htmlspecialchars($date_of_birth); ?>" required>
                            </div>
                            <div class="form-group">
                                <label for="address">Address:</label>
                                <textarea class="form-control" id="address" name="address"
                                    required><?php echo htmlspecialchars($address); ?></textarea>
                            </div>
                            <div class="form-group">
                                <label for="image">Profile Picture:</label>
                                <input type="file" class="form-control-file" id="image" name="image">
                                <?php if ($image): ?>
                                    <img src="data:image/jpeg;base64,<?php echo base64_encode($image); ?>"
                                        class="mt-3 profile-picture" alt="Profile Picture">
                                <?php endif; ?>
                            </div>
                            <hr>
                            <div class="form-group">
                                <label for="new_password">New Password (at least 8 characters):</label>
                                <input type="password" class="form-control" id="new_password" name="new_password"
                                    minlength="8">
                            </div>
                            <button type="submit" class="btn btn-primary btn-block">Update</button>
                        </form>
                    </div>
                    <div class="container pt-3">
                        <div class="row">
                            <div class="col-md-6">
                                <h5 class="text-white">Delete Account:</h5>
                            </div>
                            <div class="col-md-6 text-left">
                                <a href="delete_account.php" class="btn btn-danger btn-block">Delete</a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <footer class="footer my-auto text-center text-white text-bold pt-3">
            <h5>2024 &copy; Robiul Hassan</h5>
        </footer>

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