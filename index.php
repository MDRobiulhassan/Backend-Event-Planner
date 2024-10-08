<?php
session_start();
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <title>ARSW INC</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css"
        integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
    <link rel="stylesheet" href="style.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">

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
                <?php if (isset($_SESSION['user_id'])): ?>
                    <div class="d-flex align-items-center user" data-toggle="dropdown"
                        style="background-color: #f2f2f2; padding: 5px; border-radius: 25px; cursor:pointer; ">
                        <a href="#" class="user-icon-link" style="font-size: 24px; color: black;">
                            <i class="fa fa-user-circle mr-2"></i>
                        </a>
                        <span><?php echo htmlspecialchars($_SESSION['user_name']); ?></span>
                        <i class="fa fa-angle-down ml-2" aria-haspopup="true" aria-expanded="false"></i>
                        <div class="dropdown-menu dropdown-menu-right mr-2">
                            <a class="dropdown-item" href="dashboard.php" data-target="dashboard.php">Dashboard</a>
                            <a class="dropdown-item" href="profile.php" data-target="profile.php">Profile</a>
                            <hr class="dropdown-divider">
                            <a class="dropdown-item text-danger" href="logout.php" data-target="logout.php">Logout</a>
                        </div>
                    </div>
                <?php else: ?>
                    <a href="login.php" class="btn btn-outline-light mr-3">Log In</a>
                    <a href="signup.php" class="btn btn-outline-light">Sign Up</a>
                <?php endif; ?>
            </div>
        </div>
    </nav>


    <main class="text-center">
        <h1>World Class Event Management</h1>
        <p>We are one of the leading full-service event production companies in the World. We handle all of your
            production needs including lighting, sound, video and staging for events of all sizes in all types of
            spaces. Our team combines the latest in technology with over 20 years of experience to achieve
            stress-free, chic, modern and creative environments.
        </p>
        <!-- <a href="#" class="btn btn-outline-light mt-2">Our Services</a> -->

        <div class="our-services text-center">
            <!-- <h2>Our Services</h2> -->
            <div class="row">
                <div class="col-md-6 col-lg-3 mb-4">
                    <div class="event-photo">
                        <h4>Wedding</h4>
                        <img src="images/wedding.jpg" alt="Wedding Event" class="img-fluid">
                    </div>
                </div>
                <div class="col-md-6 col-lg-3 mb-4">
                    <div class="event-photo">
                        <h4>Concert</h4>
                        <img src="images/concert.jpg" alt="Concert Event" class="img-fluid">
                    </div>
                </div>
                <div class="col-md-6 col-lg-3 mb-4">
                    <div class="event-photo">
                        <h4>Conference</h4>
                        <img src="images/conference.jpg" alt="Conference Event" class="img-fluid">
                    </div>
                </div>
                <div class="col-md-6 col-lg-3 mb-4">
                    <div class="event-photo">
                        <h4>Workshop</h4>
                        <img src="images/workshop.jpg" alt="Workshop Event" class="img-fluid">
                    </div>
                </div>
            </div>
        </div>
    </main>

    <footer class="text-center">
        <h5 class="font-weight-bold">2024 &copy;Robiul Hassan </h5>
        <div class="social-icons">
            <a href="https://www.facebook.com/mdrobiul.hassan.92102?mibextid=ZbWKwL" class="text-white mr-3 fb"><i
                    class="fa fa-facebook"></i></a>
            <a href="https://github.com/MDRobiulhassan" class="text-white mr-3 gb"><i class="fa fa-github"></i></a>
            <a href="https://mail.google.com/mail/u/2/#search/from:robiulpuc@gmail.com" class="text-white mr-3 gm"><i
                    class="fa fa-google" aria-hidden="true"></i> </a>
            <a href="https://www.linkedin.com/in/md-robiul-hassan-542a90200?trk=feed-detail_main-feed-card_feed-actor-name"
                class="text-white ld mr-3"><i class="fa fa-linkedin"></i></a>
        </div>
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