<?php
session_start();

include("../includes/db.php");

if (array_key_exists('booking_details', $_SESSION)) {
    // Retrieve provisional booking data from session
    $details = $_SESSION['booking_details'];

    $userID = $details['user_id'];
    $hotelName = $details['hotel_name'];
    $email = $details['email'];
    $head = $details['headcount'];
    $start = $details['date_start'];
    $end = $details['date_end'];
    $inq = $details['inquiry'];
    $priceVal = $details['price'];
    $folderName = $details['img_folder'];
    $totalPrice = $details['total_price'];

    // Insert Confirmed Booking into Database
    $sql = "
    INSERT INTO B
    (user_id, hotel_name, email, headcount, date_start, date_end, inquiry, price, img_folder, total_price)
    VALUES
    ('$userID', '$hotelName', '$email', '$head', '$start', '$end', '$inq', '$priceVal', '$folderName', '$totalPrice')
    ";

    sqlsrv_query($conn, $sql);

    $_SESSION['booking_details'] = "";
} else {
    echo "<script>window.location='../mb.php';</script>";
    exit();
}
?>
<!DOCTYPE html>
<html>

<head>
    <title>Payment Success</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        body {
            background-color: #f8f9fa;
            font-family: 'Segoe UI', sans-serif;
        }

        .card {
            border: none;
            border-radius: 15px;
        }

        .text-teal {
            color: #008080 !important;
        }

        .btn-teal {
            background-color: #008080 !important;
            color: white !important;
            border: none;
        }

        .btn-teal:hover {
            background-color: #006666 !important;
        }
    </style>
</head>

<body class="d-flex align-items-center justify-content-center min-vh-100">
    <div class="card shadow p-5 text-center" style="max-width: 500px;">
        <div class="mb-4">
            <svg xmlns="http://www.w3.org/2000/svg" width="80" height="80" fill="#008080" class="bi bi-check-circle-fill" viewBox="0 0 16 16">
                <path d="M16 8A8 8 0 1 1 0 8a8 8 0 0 1 16 0zm-3.97-3.03a.75.75 0 0 0-1.08.022L7.477 9.417 5.384 7.323a.75.75 0 0 0-1.06 1.06L6.97 11.03a.75.75 0 0 0 1.079-.02l3.992-4.99a.75.75 0 0 0-.01-1.05z" />
            </svg>
        </div>
        <h2 class="fw-bold text-success mb-3">Payment Successful!</h2>
        <p class="text-muted mb-4">Thank you for your booking. We have received your payment and your adventure awaits!</p>
        <a href="mb.php" class="btn btn-teal w-100 py-3 fw-bold rounded-pill">View My Bookings</a>
    </div>
</body>

</html>