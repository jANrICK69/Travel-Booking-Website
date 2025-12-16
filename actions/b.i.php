<?php
session_start();
include("../includes/db.php");

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
// Calculate total
$totalPrice = $priceVal * $days;

$_SESSION['booking_details'] = array(
    'user_id' => $userID,
    'hotel_name' => $hotelName,
    'email' => $email,
    'headcount' => $head,
    'date_start' => $start,
    'date_end' => $end,
    'inquiry' => $inq,
    'price' => $priceVal,
    'img_folder' => $folderName,
    'total_price' => $totalPrice
);

header("Location: ../actions/p.php");
exit();
