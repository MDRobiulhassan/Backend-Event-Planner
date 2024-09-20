<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>User Dashboard - ARSW INC</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css"
        integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
    <link rel="stylesheet" href="adminpanel.css">
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
                        <a href="eventcreate.html" class="dropdown-item" data-target="eventcreate.html">Create Event</a>
                        <a class="dropdown-item" href="schedule.html" data-target="schedule.html">Event Schedule</a>
                        <a class="dropdown-item" href="profile.php" data-target="profile.php">Profile</a>
                        <hr class="dropdown-divider">
                        <a class="dropdown-item text-danger" href="logout.php" data-target="logout.php">Logout</a>
                    </div>
                </div>
            </div>
        </header>
        <hr class="divider">
        <div class="row">

            <!-- Main content -->
            <main role="main" >
                <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
                    <h1 class="text-center text-white text-center">Admin Panel</h1>
                </div>

                <!-- Dashboard content -->
                <div class="row justify-content-center m-3 ">
                    <div class="col-md-4">
                        <div class="card">
                            <div class="card-body">
                                <h5 class="card-title">User table</h5>
                                <p class="card-text">If you want to update or delete your user table.. Please click here</p>
                                <a href="usertable.php" class="btn btn-primary">Click Here</a>
                            </div>
                        </div>
                    </div>
                    <!-- <div class="col-md-4">
                        <div class="card">
                            <div class="card-body">
                                <h5 class="card-title">User details</h5>
                                <p class="card-text">If you want to update or delete your user details table.. Please click here</p>
                                <a href="display2.php" class="btn btn-primary">Click Here</a>
                            </div>
                        </div>
                    </div> -->
                    <div class="col-md-6">
                        <div class="card">
                            <div class="card-body">
                                <h5 class="card-title">Event</h5>
                                <p class="card-text">If you want to update or delete your Event.. Please click here.</p>
                                <a href="display3.php" class="btn btn-primary">Click Here</a>
                            </div>
                        </div>
                    </div>
                </div>
                <br>
                <div class="row m-5">
                    <div class="col-md-6">
                        <div class="card">
                            <div class="card-body">
                                <h5 class="card-title">Review</h5>
                                <p class="card-text">If you want to update or delete your review table.. Please click here</p>
                                <a href="display5.php" class="btn btn-primary">Click Here</a>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="card">
                            <div class="card-body">
                                <h5 class="card-title">Attendee</h5>
                                <p class="card-text">If you want to update or delete your user Attendee table.. Please click here</p>
                                <a href="display6.php" class="btn btn-primary">Click Here</a>

                            </div>
                        </div>
                    </div>
                    <!-- <div class="col-md-4">
                        <div class="card">
                            <div class="card-body">
                                <h5 class="card-title">Admin</h5>
                                <p class="card-text">If you want to update or delete your Admin table.. Please click here.</p>
                                <a href="display7.php" class="btn btn-primary">Click Here</a>
                            </div>
                        </div>
                    </div> -->
                </div>

            </main>
        </div>

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
            item.addEventListener('click', function() {
                const target = this.getAttribute('data-target');
                if (target) {
                    window.location.href = target;
                }
            });
        });
    </script>
</body>

</html>