<?php
require_once "config.php";
$error_message = "";

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $name = $_POST['name'];
    $email = $_POST['email'];
    $password = $_POST['password'];
    $confirmPassword = $_POST['confirmPassword'];

    if (strlen($password) < 8) {
        $error_message = "Password must be at least 8 characters long.";
    } elseif ($password !== $confirmPassword) {
        $error_message = "Passwords do not match.";
    } else {
        $hashedPassword = password_hash($password, PASSWORD_DEFAULT);
        $sqlUser = "INSERT INTO User (name, email, password, is_admin) VALUES (?, ?, ?, 0)";
        $stmtUser = $conn->prepare($sqlUser);
        $stmtUser->bind_param("sss", $name, $email, $hashedPassword);

        if ($stmtUser->execute()) {
            $user_id = $stmtUser->insert_id;

            $sqlUserDetails = "INSERT INTO UserDetails (user_id, name, email) VALUES (?, ?, ?)";
            $stmtUserDetails = $conn->prepare($sqlUserDetails);
            $stmtUserDetails->bind_param("iss", $user_id, $name, $email);

            if ($stmtUserDetails->execute()) {
                header("Location: login.php");
                exit;
            } else {
                $error_message = "Error inserting into UserDetails: " . $stmtUserDetails->error;
            }

            $stmtUserDetails->close();
        } else {
            $error_message = "Error inserting into User: " . $stmtUser->error;
        }

        $stmtUser->close();
        $conn->close();
    }
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <title>Sign Up - ARSW INC</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css"
        integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
    <link rel="stylesheet" href="login.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
</head>

<body style="background-image: linear-gradient(rgba(0, 0, 0, 0.75), rgba(0, 0, 0, 0.75)), url('images/login2.jpg');">
    <div class="container mt-1">
        <div class="row justify-content-center">
            <div class="col-md-6">
                <div class="card">
                    <div class="card-header bg-primary text-center text-white">
                        Sign Up for ARSW INC
                    </div>
                    <div class="card-body">
                        <?php
                        if (!empty($error_message)) {
                            echo '<div class="alert alert-danger alert-dismissible fade show">' . $error_message . '
                            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                            </div>';
                        }
                        ?>
                        <form action="signup.php" method="POST">
                            <div class="form-group">
                                <label for="name">Name :</label>
                                <input type="text" class="form-control" id="name" name="name" required>
                            </div>
                            <div class="form-group">
                                <label for="email">Email address :</label>
                                <input type="email" class="form-control" id="email" name="email" required>
                            </div>
                            <div class="form-group">
                                <label for="password">Password :</label>
                                <input type="password" class="form-control" id="password" name="password" minlength="8"
                                    required>
                            </div>
                            <div class="form-group">
                                <label for="confirmPassword">Confirm Password :</label>
                                <input type="password" class="form-control" id="confirmPassword" name="confirmPassword"
                                    required>
                            </div>
                            <button type="submit" class="btn btn-primary btn-block mb-2 mt-4">Sign up</button>
                            <div class="or-text text-center mb-2">or</div>
                            <a href="#" class="btn btn-danger btn-block">
                                <i class="fa fa-google"></i> Sign up with Google
                            </a>
                        </form>
                    </div>
                </div>
            </div>
        </div>
        <footer class="text-center mt-2">
            <h5 class="font-weight-bold">2024 &copy; Robiul Hassan </h5>
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
</body>

</html>
