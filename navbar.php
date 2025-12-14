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
<style>
    body .text-teal {
        color: #008080;
    }

    body .bg-teal {
        background-color: #008080;
        color: white;
    }

    body .btn-teal {
        background-color: #008080;
        color: white;
        border: 1px solid #008080;
    }

    body .btn-teal:hover {
        background-color: #006666;
        border-color: #006666;
        color: white;
        transform: translateY(-1px);
        box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
    }

    body .btn-teal:active {
        transform: translateY(1px);
        box-shadow: none;
        background-color: #004d4d;
        border-color: #004d4d;
    }

    body .btn-outline-teal {
        color: #008080;
        border-color: #008080;
        background: transparent;
        transition: all 0.2s ease;
    }

    body .btn-outline-teal:hover {
        background-color: #008080;
        color: white;
        transform: translateY(-1px);
        box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
    }

    body .btn-outline-teal:active {
        transform: translateY(1px);
        box-shadow: none;
        background-color: #004d4d;
    }

    body .text-coral {
        color: #FF6F61;
    }

    body .bg-coral {
        background-color: #FF6F61;
        color: white;
    }

    body .btn-coral {
        background-color: #FF6F61;
        color: white;
        border: none;
        transition: all 0.2s ease;
    }

    body .btn-coral:hover {
        background-color: #E65A50;
        color: white;
        transform: translateY(-1px);
        box-shadow: 0 4px 6px rgba(0, 0, 0, 0.15);
    }

    body .btn-coral:active {
        transform: translateY(1px);
        box-shadow: none;
        background-color: #cc4438;
    }

    body .nav-link {
        transition: all 0.2s ease;
        border-radius: 20px;
        padding-left: 15px;
        padding-right: 15px;
    }

    body nav a.nav-link.text-teal:hover {
        color: #FF6F61;
        background-color: rgba(255, 111, 97, 0.1);
        transform: translateY(-1px);
    }

    body nav a.nav-link.text-teal:active {
        transform: translateY(1px);
        color: #cc4438;
    }

    body .bg-sand {
        background-color: #F9F7F2;
    }
</style>
<nav class="navbar navbar-expand-lg navbar-light bg-white shadow-sm sticky-top" style="padding: 12px 0;">
    <div class="container position-relative">
        <a class="navbar-brand me-4" href="hp.php">
            <img src="images/logo.png" height="70" alt="Logo">
        </a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navContent">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navContent">
            <ul class="navbar-nav mb-2 mb-lg-0 fw-bold gap-4 align-items-center">
                <li class="nav-item"><a class="nav-link text-teal" href="d.php">Destinations</a></li>
                <li class="nav-item"><a class="nav-link text-teal" href="mb.php">My Bookings</a></li>
                <li class="nav-item"><a class="nav-link text-teal" href="a.php">About Us</a></li>
            </ul>
        </div>

        <div class="d-flex align-items-center position-absolute end-0 pe-4">
            <?php if ($logged == 0) { ?>
                <?php if ($page != "l.php") { ?>
                    <a href="l.php" class="btn btn-teal text-white btn-sm me-2 rounded-pill px-3">Login</a>
                <?php } ?>
                <?php if ($page != "r.php") { ?>
                    <a href="r.php" class="btn btn-outline-teal btn-sm rounded-pill px-3">Register</a>
                <?php } ?>
            <?php } else { ?>
                <span class="text-dark me-2">Welcome,</span>
                <div class="dropdown">
                    <button class="btn btn-outline-teal btn-sm dropdown-toggle rounded-pill" type="button" data-bs-toggle="dropdown">
                        <?php echo $displayName; ?>
                    </button>
                    <ul class="dropdown-menu dropdown-menu-end">
                        <li><a class="dropdown-item" href="mb.php">My Bookings</a></li>
                        <li>
                        <li><a class="dropdown-item text-danger" href="logout.php">Logout</a></li>
                        </li>
                    </ul>
                </div>
            <?php } ?>
        </div>
    </div>
</nav>