<?php
session_start();

if (array_key_exists("username", $_SESSION) == 0) {
    $_SESSION["username"] = "";
}
if (array_key_exists("userID", $_SESSION) == 0) {
    $_SESSION["userID"] = "";
}
?>
<!DOCTYPE html>
<html>

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Register</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
    <style>
        body {
            margin: 0;
            padding: 0;
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            background: #f8f9fa;
            color: #212529;
            min-height: 100vh;
        }

        .box {
            max-width: 420px;
            margin: 60px auto;
            background: #ffffff;
            padding: 40px;
            border-radius: 20px;
            box-shadow: 0 10px 30px rgba(0, 0, 0, 0.08);
            border: 1px solid #f0f0f0;
        }

        .form-control {
            background: #f8f9fa;
            border: 1px solid #dee2e6;
            margin-bottom: 15px;
            padding: 12px;
            border-radius: 8px;
        }

        .form-control:focus {
            background: #fff;
            box-shadow: none;
            border-color: #212529;
        }

        .btn-main {
            padding: 12px;
            border-radius: 8px;
            background: #008080;
            border: none;
            color: white;
            width: 100%;
            font-weight: bold;
            transition: 0.3s;
        }

        .btn-main:hover {
            background: #006666;
            color: white;
        }

        .link-text {
            color: #212529;
            text-decoration: none;
            font-weight: bold;
        }

        .link-text:hover {
            text-decoration: underline;
        }
    </style>
</head>

<body>

    <?php include("../includes/navbar.php"); ?>

    <div class="container">
        <div class="box">
            <h3 class="text-center mb-4 fw-bold">Create Account</h3>
            <form id="regForm" method="POST" action="../actions/r.a.php">
                <label class="form-label fw-bold">Username</label>
                <input type="text" name="username_reg" class="form-control" required>

                <label class="form-label fw-bold">Email</label>
                <input type="email" name="email_reg" class="form-control" required>

                <label class="form-label fw-bold">Password</label>
                <input type="password" name="pass_reg" class="form-control" required>

                <label class="form-label fw-bold">Confirm Password</label>
                <input type="password" name="pass_reg2" class="form-control" required>

                <button class="btn-main mt-2" type="submit">Register</button>
            </form>

            <div class="mt-4 text-center">
                <span>Already have an account?</span>
                <a href="l.php" class="link-text ms-2">Login</a>
            </div>
        </div>
    </div>

    <?php include("f.php"); ?>

</body>

</html>