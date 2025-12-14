<?php
session_start();
include("db.php");

$userID = $_SESSION["userID"];

$hotelName = $_POST["hotel_name"];
$folderName = $_POST["img_folder"];
$priceVal = $_POST["price"];

$email = $_POST["email_box"];
$head = $_POST["head_box"];
$start = $_POST["start_box"];
$end = $_POST["end_box"];
$inq = $_POST["inq_box"];

$diff = strtotime($end) - strtotime($start);
$days = floor($diff / (60 * 60 * 24));
if ($days < 1) {
    $days = 1;
}
$totalPrice = $priceVal * $days;

$sql = "
INSERT INTO B
(user_id, hotel_name, email, headcount, date_start, date_end, inquiry, price, img_folder, total_price)
VALUES
('$userID', '$hotelName', '$email', '$head', '$start', '$end', '$inq', '$priceVal', '$folderName', '$totalPrice')
";

sqlsrv_query($conn, $sql);

echo "<script>alert('Your booking was submitted successfully!'); window.location='mb.php';</script>";
exit();
