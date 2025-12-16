<?php
if (array_key_exists("username", $_SESSION) == 0) {
    $_SESSION["username"] = "";
}
if (array_key_exists("userID", $_SESSION) == 0) {
    $_SESSION["userID"] = "";
}

$logged = 0;
$displayName = "";

// Check if user is logged in
$user = "";
$btn = "";
if (array_key_exists("username", $_SESSION) && $_SESSION["username"] != "") {
    $user = $_SESSION["username"];
    $btn = "Logout";
} else {
    $user = "Guest";
    $btn = "Login";
}

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
                <li class="nav-item"><a class="nav-link text-teal" href="hp.php"><i class="fa-solid fa-house"></i> Home</a></li>
                <li class="nav-item"><a class="nav-link text-teal" href="d.php"><i class="fa-solid fa-hotel"></i> Destinations</a></li>
                <?php if ($logged == 1) { ?>
                    <li class="nav-item"><a class="nav-link text-teal" href="mb.php"><i class="fa-solid fa-calendar-check"></i> My Bookings</a></li>
                <?php } else { ?>
                    <li class="nav-item"><a class="nav-link text-teal" href="#" data-bs-toggle="modal" data-bs-target="#loginModal"><i class="fa-solid fa-calendar-check"></i> My Bookings</a></li>
                <?php } ?>
                <li class="nav-item"><a class="nav-link text-teal" href="a.php"><i class="fa-solid fa-circle-info"></i> About Us</a></li>
            </ul>
        </div>

        <div class="d-flex align-items-center position-absolute end-0 pe-4">
            <?php if ($logged == 0) { ?>
                <?php if ($page != "l.php") { ?>
                    <a href="#" class="btn btn-teal text-white btn-sm me-2 rounded-pill px-3" data-bs-toggle="modal" data-bs-target="#loginModal"><i class="fa-solid fa-right-to-bracket"></i> Login</a>
                <?php } ?>
                <?php if ($page != "r.php") { ?>
                    <a href="#" class="btn btn-outline-teal btn-sm rounded-pill px-3" data-bs-toggle="modal" data-bs-target="#registerModal"><i class="fa-solid fa-clipboard-user"></i> Register</a>
                <?php } ?>
            <?php } else { ?>
                <span class="text-dark me-2">Welcome,</span>
                <div class="dropdown">
                    <button class="btn btn-outline-teal btn-sm dropdown-toggle rounded-pill" type="button" data-bs-toggle="dropdown">
                        <i class="fa-solid fa-user"></i> <?php echo $displayName; ?>
                    </button>
                    <ul class="dropdown-menu dropdown-menu-end">
                        <li><a class="dropdown-item" href="mb.php">My Bookings</a></li>
                        <li>
                        <li><a class="dropdown-item text-danger" href="actions/logout.php"><i class="fa-solid fa-right-from-bracket"></i> Logout</a></li>
                        </li>
                    </ul>
                </div>
            <?php } ?>
        </div>
    </div>
</nav>

<!-- Login Modal -->
<div class="modal fade" id="loginModal" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content rounded-4 border-0 shadow">
            <div class="modal-header border-0 pb-0">
                <h5 class="modal-title fw-bold">Welcome Back</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body p-4">
                <form method="POST" action="actions/l.a.php">
                    <div class="mb-3">
                        <label class="form-label fw-bold">Email</label>
                        <input type="text" name="email_login" class="form-control bg-light" required>
                    </div>
                    <div class="mb-3">
                        <label class="form-label fw-bold">Password</label>
                        <input type="password" name="pass_login" class="form-control bg-light" required>
                    </div>
                    <button class="btn btn-teal w-100 py-2 fw-bold" type="submit">Login</button>
                    <div class="text-center mt-3">
                        <small>Don't have an account? <a href="#" class="text-teal fw-bold" data-bs-toggle="modal" data-bs-target="#registerModal">Create one</a></small>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

<!-- Register Modal -->
<div class="modal fade" id="registerModal" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content rounded-4 border-0 shadow">
            <div class="modal-header border-0 pb-0">
                <h5 class="modal-title fw-bold">Create Account</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body p-4">
                <form method="POST" action="actions/r.a.php">
                    <div class="mb-3">
                        <label class="form-label fw-bold">Username</label>
                        <input type="text" name="username_reg" class="form-control bg-light" required>
                    </div>
                    <div class="mb-3">
                        <label class="form-label fw-bold">Email</label>
                        <input type="email" name="email_reg" class="form-control bg-light" required>
                    </div>
                    <div class="mb-3">
                        <label class="form-label fw-bold">Password</label>
                        <input type="password" name="pass_reg" class="form-control bg-light" required>
                    </div>
                    <div class="mb-3">
                        <label class="form-label fw-bold">Confirm Password</label>
                        <input type="password" name="pass_reg2" class="form-control bg-light" required>
                    </div>
                    <button class="btn btn-outline-teal w-100 py-2 fw-bold" type="submit">Register</button>
                    <div class="text-center mt-3">
                        <small>Already have an account? <a href="#" class="text-teal fw-bold" data-bs-toggle="modal" data-bs-target="#loginModal">Login</a></small>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>