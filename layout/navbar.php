<nav class="navbar navbar-expand-lg navbar-dark bg-dark">
    <div class="container">
        <a class="navbar-brand" href="#"></a>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent"
            aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>

        <div class="collapse navbar-collapse" id="navbarSupportedContent">
            <ul class="navbar-nav ml-auto ">
                <li class="nav-item active">
                    <a class="nav-link text-white font-weight-bold mr-3" href="index.php">Home</a>
                </li>
                <?php if (isset($_SESSION['info'])) { ?>
                <li class="nav-item active">
                    <a class="nav-link text-white font-weight-bold mr-3" href="profile.php">Profile</a>
                </li>
                <?php } ?>
                <?php if (isset($_SESSION['info'])) { ?>
                <li class="nav-item active">
                    <a class="nav-link text-white font-weight-bold mr-3" href="course.php">Courses</a>
                </li>
                <?php } ?>
                <li class="nav-item">
                    <a class="nav-link text-white font-weight-bold mr-3" href="registration.php">Register</a>
                </li>
                <?php if (isset($_SESSION['info'])) { ?>
                <li class="nav-item active">
                    <a class="nav-link text-white font-weight-bold mr-3" href="update.php">Update</a>
                </li>
                <?php } ?>


                <?php if (isset($_SESSION['info'])) { ?>
                <li class="nav-item active">
                    <a class="nav-link text-white font-weight-bold mr-3" href="logout.php">Logout</a>
                </li>
                <?php } else { ?>
                <li class="nav-item">
                    <a class="nav-link text-white font-weight-bold mr-3" href="login.php">Login</a>
                </li>
                <?php } ?>


            </ul>

        </div>
    </div>
</nav>