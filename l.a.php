<?php
session_start();
include("db.php");

$e = "";
$p = "";

if ($_POST["email_login"] != "") {
    $e = $_POST["email_login"];
}
if ($_POST["pass_login"] != "") {
    $p = $_POST["pass_login"];
}

$sql = "SELECT id, uname, mail, pass FROM U WHERE mail = '$e' AND pass = '$p'";
$result = sqlsrv_query($conn, $sql);

$found = 0;
$uid = 0;
$uname = "";

if ($result !== false) {
    $row = sqlsrv_fetch_array($result);
    if ($row != null) {
        $found = 1;
        $uid = $row["id"];
        $uname = $row["uname"];
    }
}

if ($found == 1) {
    $_SESSION["userID"] = $uid;
    $_SESSION["username"] = $uname;
    echo "<script>alert('Login successful!'); window.location='hp.php';</script>";
    exit();
} else {
    echo "<script>alert('Incorrect email or password.'); window.location='l.php';</script>";
    exit();
}
