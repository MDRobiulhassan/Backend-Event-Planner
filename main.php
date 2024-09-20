<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>User Dashboard - ARSW INC</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css"
        integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
    <link rel="stylesheet" href="layout.css">
    <style>
      body {
    background-color: #799296;
}

.navbar-brand {
    font-family: cursive;
    color: white;
}

.navbar-brand:hover {
    color: white;
}

header {
    margin: 0 15px;
}

.divider {
    border: 1px solid white;
}

.user-icon-link i {
    font-size: 24px;
    color: black;
}

.user-image {
    width: 32px;
    height: 32px;
    object-fit: cover;
    border-radius: 50%;
}



.user {
    background-color: #f2f2f2;
    padding: 10px;
    border-radius: 25px;
}

.user:hover {
    /* transition: 2s;
    background-color: #dcdcdc; */
    cursor: pointer;
}

.inset {
    border-top: 2px inset #fff;
}

.btn {
    display: inline;
    /* border-radius: 20px; */
    margin-right: 8px;
}

.btn:hover {
    transition: 1s;
    color: black;
}

footer {
    font-weight: bold;
}

@media (max-width: 768px) {
    .m-4 {
        justify-content: center;
    }

    .m-4 h5 {
        text-align: center;
    }
}
    </style>
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
        <div class="container mt-5 pt-4">
            <div class="d-flex justify-content-center mb-4">
                <h1 class="text-center text-dark">Admin Panel</h1>
            </div>

            <div class="row">
                <div class="col-md-6 mb-4">
                    <div class="card">
                        <div class="card-body">
                            <h5 class="card-title">User Table</h5>
                            <p class="card-text">Update or delete user table records here.</p>
                            <a href="usertable.php" class="btn btn-primary">Click Here</a>
                        </div>
                    </div>
                </div>
                <div class="col-md-6 mb-4">
                    <div class="card">
                        <div class="card-body">
                            <h5 class="card-title">Event</h5>
                            <p class="card-text">Update or delete events here.</p>
                            <a href="eventdisplay.php" class="btn btn-primary">Click Here</a>
                        </div>
                    </div>
                </div>
                <div class="col-md-6 mb-4">
                    <div class="card">
                        <div class="card-body">
                            <h5 class="card-title">Review</h5>
                            <p class="card-text">Update or delete review records here.</p>
                            <a href="reviewdisplay.php" class="btn btn-primary">Click Here</a>
                        </div>
                    </div>
                </div>
                <div class="col-md-6 mb-4">
                    <div class="card">
                        <div class="card-body">
                            <h5 class="card-title">Attendee</h5>
                            <p class="card-text">Update or delete attendee records here.</p>
                            <a href="attendedisplay.php" class="btn btn-primary">Click Here</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <hr class="divider">


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