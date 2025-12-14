<?php
session_start();
if (array_key_exists('booking_details', $_SESSION)) {
    $_SESSION['booking_details'] = "";
}
?>
<!DOCTYPE html>
<html>

<head>
    <title>Payment Cancelled</title>
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

        .btn-outline-dark {
            border-radius: 50px;
        }
    </style>
</head>

<body class="d-flex align-items-center justify-content-center min-vh-100">
    <div class="card shadow p-5 text-center" style="max-width: 500px;">
        <div class="mb-4">
            <svg xmlns="http://www.w3.org/2000/svg" width="80" height="80" fill="#dc3545" class="bi bi-x-circle-fill" viewBox="0 0 16 16">
                <path d="M16 8A8 8 0 1 1 0 8a8 8 0 0 1 16 0zM5.354 4.646a.5.5 0 1 0-.708.708L7.293 8l-2.647 2.646a.5.5 0 0 0 .708.708L8 8.707l2.646 2.647a.5.5 0 0 0 .708-.708L8.707 8l2.647-2.646a.5.5 0 0 0-.708-.708L8 7.293 5.354 4.646z" />
            </svg>
        </div>
        <h2 class="fw-bold text-danger mb-3">Payment Cancelled</h2>
        <p class="text-muted mb-4">You have cancelled the payment process.</p>
        <div class="d-flex gap-2 justify-content-center">
            <a href="hp.php" class="btn btn-outline-dark px-4 py-2">Go Home</a>
            <a href="mb.php" class="btn btn-dark px-4 py-2 rounded-pill">My Bookings</a>
        </div>
    </div>
</body>

</html>