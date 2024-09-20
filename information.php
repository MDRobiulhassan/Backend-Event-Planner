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

// Fetch reviews from the database
$sql = "SELECT review.*, user.name, user.email FROM review 
        JOIN user ON review.user_id = user.user_id";
$result = $conn->query($sql);

?>

<!doctype html>
<html lang="en">

<head>
    <title>About Us</title>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css"
        integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
    <link rel="stylesheet" href="information.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link rel="stylesheet" href="information.css">
    <link rel="stylesheet" href="dashboard.css">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:ital,wght@1,900&display=swap" rel="stylesheet">
</head>

<body>
    <nav class="navbar navbar-expand-lg navbar-dark">
        <a class="navbar-brand" href="index.php">ARSW INC.</a>
        <button class="navbar-toggler d-lg-none" type="button" data-toggle="collapse" data-target="#collapsibleNavId"
            aria-controls="collapsibleNavId" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse justify-content-center text-align-center" id="collapsibleNavId">
            <ul class="navbar-nav mx-auto">
                <li class="nav-item mr-2">
                    <a class="nav-link" href="eventcreate.php">Create Event</a>
                </li>
                <li class="nav-item mr-2">
                    <a class="nav-link" href="schedule.php">Event Schedule</a>
                </li>
                <li class="nav-item mr-2">
                    <a class="nav-link" href="pricing.php">Pricing</a>
                </li>
                <li class="nav-item mr-2">
                    <a class="nav-link" href="information.php">About Us</a>
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

    <main class="text-center">
        <div class="our-services text-center text-white">
            <h1>World Class Event Management</h1>
            <p>We are one of the leading full-service event production companies in the World. We handle all of your
                production needs including lighting, sound, video and staging for events of all sizes in all types of
                spaces. Our team combines the latest in technology with over 20 years of experience to achieve
                stress-free, chic, modern and creative environments.
            </p>
            <h2 class="pt-2">Meet Our Team</h2>
            <div class="container">
                <!-- Row with 3 items on top -->
                <div class="row justify-content-center mb-4">
                    <div class="col-md-4">
                        <div class="event-photo text-center">
                            <img src="images/Aiaz.png" alt="Wedding Event" class="img-fluid">
                            <h4>MD Aias</h4>
                            <h6>BSC in CSE</h6>
                            <h6>Premier University</h6>
                            <h6>Manging Director, ARSW INC.</h6>
                        </div>
                        <div class="social-icons text-center">
                            <a href="#" class="text-white mr-3 fb"><i class="fa fa-facebook"></i></a>
                            <a href="#" class="text-white mr-3 ins"><i class="fa fa-google"></i></a>
                            <a href="#" class="text-white ld mr-3"><i class="fa fa-linkedin"></i></a>
                            <a href="#" class="text-white ld mr-3"><i class="fa fa-github"></i></a>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="event-photo text-center">
                            <img src="images/Samin.png" alt="Concert Event" class="img-fluid">
                            <h4>MD Samin Osman</h4>
                            <h6>BSC in CSE</h6>
                            <h6>Premier University</h6>
                            <h6>Finance Manger, ARSW INC.</h6>
                        </div>
                        <div class="social-icons text-center">
                            <a href="#" class="text-white mr-3 fb"><i class="fa fa-facebook"></i></a>
                            <a href="#" class="text-white mr-3 ins"><i class="fa fa-google"></i></a>
                            <a href="#" class="text-white ld mr-3"><i class="fa fa-linkedin"></i></a>
                            <a href="#" class="text-white ld mr-3"><i class="fa fa-github"></i></a>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="event-photo text-center">
                            <img src="images/Robiul.png" alt="Conference Event" class="img-fluid">
                            <h4>MD Robiul Hassan</h4>
                            <h6>BSC in CSE</h6>
                            <h6>Premier University</h6>
                            <h6>Software Engineer, ARSW INC.</h6>
                        </div>
                        <div class="social-icons text-center">
                            <a href="https://www.facebook.com/mdrobiul.hassan.92102?mibextid=ZbWKwL"
                                class="text-white mr-3 fb"><i class="fa fa-facebook"></i></a>
                            <a href="robiulpuc@gmail.com" class="text-white mr-3 ins"><i class="fa fa-google"></i></a>
                            <a href="https://www.linkedin.com/in/md-robiul-hassan-542a90200?trk=feed-detail_main-feed-card_feed-actor-name"
                                class="text-white ld mr-3"><i class="fa fa-linkedin"></i></a>
                            <a href="https://github.com/MDRobiulhassan" class="text-white ld mr-3"><i
                                    class="fa fa-github"></i></a>
                        </div>
                    </div>
                </div>

                <!-- Row with 2 items below -->
                <div class="row justify-content-center">
                    <div class="col-md-5">
                        <div class="event-photo text-center">
                            <img src="images/walid.jpg" alt="Workshop Event" class="img-fluid">
                            <h4>Walid Talal</h4>
                            <h6>BSC in CSE</h6>
                            <h6>Premier University</h6>
                            <h6>Event Ordinator, ARSW INC.</h6>
                        </div>
                        <div class="social-icons text-center">
                            <a href="https://www.facebook.com/khaled.binwalid.737" class="text-white mr-3 fb"><i
                                    class="fa fa-facebook"></i></a>
                            <a href="binwalid670@gmail.com" class="text-white mr-3 ins"><i class="fa fa-google"></i></a>
                            <a href="https://www.linkedin.com/in/khaled-bin-walid-83b387281/"
                                class="text-white ld mr-3"><i class="fa fa-linkedin"></i></a>
                            <a href="#" class="text-white ld mr-3"><i class="fa fa-github"></i></a>
                        </div>
                    </div>
                    <div class="col-md-5">
                        <div class="event-photo text-center">
                            <img src="images/tarek.jpg" alt="Workshop Event" class="img-fluid">
                            <h4>Tarek Bin Nur</h4>
                            <h6>BSC in CSE</h6>
                            <h6>Premier University</h6>
                            <h6>Catering Manager, ARSW INC.</h6>
                        </div>
                        <div class="social-icons text-center">
                            <a href="https://www.facebook.com/khaled.binwalid.737" class="text-white mr-3 fb"><i
                                    class="fa fa-facebook"></i></a>
                            <a href="binwalid670@gmail.com" class="text-white mr-3 ins"><i class="fa fa-google"></i></a>
                            <a href="https://www.linkedin.com/in/khaled-bin-walid-83b387281/"
                                class="text-white ld mr-3"><i class="fa fa-linkedin"></i></a>
                            <a href="#" class="text-white ld mr-3"><i class="fa fa-github"></i></a>
                        </div>
                    </div>
                </div>
            </div>
    </main>
    <hr class="divider">

    <section id="sketch" class="container mt-5">
        <div class="sketch-heading text-center mb-4">
            <h1>User Reviews</h1>
        </div>

        <div class="row">
            <?php if ($result->num_rows > 0): ?>
                <?php while ($user_review = $result->fetch_assoc()): ?>
                    <div class="col-12 col-md-6 mb-4">
                        <div class="card">
                            <div class="card-body">
                                <div class="d-flex align-items-center">
                                    <div class="name-user flex-grow-1">
                                        <strong><?php echo htmlspecialchars($user_review['name']); ?></strong>
                                        <span><?php echo htmlspecialchars($user_review['email']); ?></span>
                                    </div>
                                    <div class="review ml-auto">
                                        <?php echo htmlspecialchars($user_review['rating']); ?>/5
                                    </div>
                                </div>
                                <div class="client-comment mt-3 pt-3">
                                    <p class="card-text"><?php echo htmlspecialchars($user_review['comment']); ?></p>
                                </div>
                            </div>
                        </div>
                    </div>
                <?php endwhile; ?>
            <?php else: ?>
                <p class="text-center col-12">No reviews yet.</p>
            <?php endif; ?>
        </div>

    </section>


    <?php if ($isLoggedIn): ?>
        <div class="container pt-4">
            <div class="heading text-center text-white">
                <h1>Tell Us About Your Experience</h1>
            </div>
            <form class="mt-3" id="reviewForm" method="POST" action="">
                <div class="form-group">
                    <label for="exampleInputEmail1">Event Name :</label>
                    <input type="text" class="form-control" id="exampleInputName1" name="event_name" required>
                </div>
                <div class="form-group">
                    <label for="review">Review :</label>
                    <textarea class="form-control" id="review" name="review" rows="5" required></textarea>
                </div>
                <div class="form-group">
                    <label for="rating">Rating :</label>
                    <input type="number" class="form-control" id="rating" name="rating" min="1" max="5" required>
                </div>
                <button type="submit" class="btn btn-primary mt-2 mb-3">Submit</button>
            </form>
        </div>
    <?php else: ?>
        <p class="text-center text-white font-weight-bold">Please <a href="login.php" class="text-white">log in</a> to
            submit a review.</p>
    <?php endif; ?>

    <!-- Optional JavaScript -->
    <!-- jQuery first, then Popper.js, then Bootstrap JS -->
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