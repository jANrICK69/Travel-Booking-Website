<?php
if (array_key_exists("username", $_SESSION) == 0) {
    $_SESSION["username"] = "";
}
if (array_key_exists("userID", $_SESSION) == 0) {
    $_SESSION["userID"] = "";
}

$logged = 0;
$displayName = "";

if ($_SESSION["username"] != "") {
    $logged = 1;
    $displayName = $_SESSION["username"];
}

$page = basename($_SERVER["PHP_SELF"]);
?>
<nav class="navbar navbar-expand-lg navbar-dark" style="backdrop-filter: blur(6px); z-index: 999;">
    <div class="container-fluid">
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navContent">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse justify-content-center" id="navContent">
            <ul class="navbar-nav mb-2 mb-lg-0 fw-bold gap-3">
                <li class="nav-item"><a class="nav-link text-white" href="hp.php">Home</a></li>
                <li class="nav-item"><a class="nav-link text-white" href="d.php">Destination</a></li>
                <li class="nav-item"><a class="nav-link text-white" href="#">Testimonials</a></li>
                <li class="nav-item"><a class="nav-link text-white" href="#">Gallery</a></li>
                <li class="nav-item"><a class="nav-link text-white" href="#">Contact</a></li>
            </ul>
        </div>

        <div class="d-flex align-items-center position-absolute end-0 pe-4">
            <?php if ($logged == 0) { ?>
                <?php if ($page != "l.php") { ?>
                    <a href="l.php" class="btn btn-outline-light btn-sm me-2">Login</a>
                <?php } ?>
                <?php if ($page != "r.php") { ?>
                    <a href="r.php" class="btn btn-outline-light btn-sm">Register</a>
                <?php } ?>
            <?php } else { ?>
                <span class="text-white me-2">Welcome,</span>
                <div class="dropdown">
                    <button class="btn btn-outline-light btn-sm dropdown-toggle" type="button" data-bs-toggle="dropdown">
                        <?php echo $displayName; ?>
                    </button>
                    <ul class="dropdown-menu dropdown-menu-end">
                        <li><a class="dropdown-item" href="mb.php">My Bookings</a></li>
                        <li>
                            <form method="POST" action="logout_placeholder.php" class="m-0">
                                <button type="submit" class="dropdown-item text-danger">Logout</button>
                            </form>
                        </li>
                    </ul>
                </div>
            <?php } ?>
        </div>
    </div>
</nav>