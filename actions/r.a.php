<?php
session_start();
include("../includes/db.php");

$u = $_POST["username_reg"];
$e = $_POST["email_reg"];
$p = $_POST["pass_reg"];
$p2 = $_POST["pass_reg2"];

if ($p != $p2) {
    echo "<script>alert('Passwords do not match.'); window.history.back();</script>";
    exit();
}

// Check if email already exists
$sql = "SELECT mail FROM U WHERE mail = '$e'";
$result = sqlsrv_query($conn, $sql);

$exists = 0;
$row = sqlsrv_fetch_array($result);

if ($row != null) {
    $exists = 1;
}

if ($exists == 1) {
    echo "<script>alert('Email already exists.'); window.history.back();</script>";
    exit();
}

$sql2 = "INSERT INTO U (uname, mail, pass) VALUES ('$u', '$e', '$p')";
sqlsrv_query($conn, $sql2);

echo "<script>alert('Account created successfully! Please Login.'); window.location='../hp.php';</script>";
