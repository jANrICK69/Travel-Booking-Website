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
    <title>Login</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
    <style>
        body {
            margin: 0;
            padding: 0;
            font-family: Arial, sans-serif;
            background: linear-gradient(to bottom right, #8ec6df, #e4d2b8);
            color: white;
            min-height: 100vh;
        }

        .box {
            max-width: 420px;
            margin: 80px auto;
            background: rgba(255, 255, 255, 0.1);
            backdrop-filter: blur(10px);
            padding: 30px;
            border-radius: 12px;
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
        }

        .form-control {
            background: rgba(255, 255, 255, 0.9);
            border: none;
            margin-bottom: 15px;
        }

        .btn-main {
            padding: 10px 16px;
            border-radius: 8px;
            background: rgba(255, 255, 255, 0.2);
            border: 1px solid rgba(255, 255, 255, 0.5);
            color: white;
            width: 100%;
            font-weight: bold;
            transition: 0.3s;
        }

        .btn-main:hover {
            background: rgba(255, 255, 255, 0.4);
            color: white;
        }

        .link-text {
            color: white;
            text-decoration: underline;
        }

        .link-text:hover {
            color: #e0e0e0;
        }
    </style>
</head>

<body>

    <?php include("navbar.php"); ?>

    <div class="container">
        <div class="box">
            <h3 class="text-center mb-4 fw-bold">Login</h3>
            <form method="POST" action="l.a.php">
                <label class="form-label fw-bold">Email</label>
                <input type="text" name="email_login" class="form-control" required>

                <label class="form-label fw-bold">Password</label>
                <input type="password" name="pass_login" class="form-control" required>

                <button class="btn-main mt-2" type="submit">Login</button>
            </form>

            <div class="mt-4 text-center">
                <span>Don't have an account?</span>
                <a href="r.php" class="link-text ms-2">Create Account</a>
            </div>
        </div>
    </div>

</body>

</html>