<?php

// Get parameters from URL
$guest = "";
if (array_key_exists("guest", $_GET)) {
    $guest = $_GET["guest"];
}

$hotel = "";
if (array_key_exists("hotel", $_GET)) {
    $hotel = $_GET["hotel"];
}

// Set status based on parameters
$status = "Invalid";
$message = "Please scan a valid QR code.";
$icon = "fa-circle-xmark";
$color = "text-danger";

if ($guest != "" && $hotel != "") {
    $status = "Verified";
    $message = "Guest is confirmed.";
    $icon = "fa-circle-check";
    $color = "text-success";
}
?>
<!DOCTYPE html>
<html>

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Verify Booking</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        body {
            background-color: #f8f9fa;
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
        }

        .card {
            max-width: 450px;
            margin: 50px auto;
            border: none;
            border-radius: 15px;
            box-shadow: 0 10px 30px rgba(0, 0, 0, 0.1);
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

    <div class="card p-5 text-center">
        <div class="mb-4">
            <svg xmlns="http://www.w3.org/2000/svg" width="80" height="80" fill="#008080" class="bi bi-patch-check-fill" viewBox="0 0 16 16">
                <path d="M10.067.87a2.89 2.89 0 0 0-4.134 0l-.622.638-.896.011a2.89 2.89 0 0 0-2.924 2.924l.01.896-.636.622a2.89 2.89 0 0 0 0 4.134l.638.622-.011.896a2.89 2.89 0 0 0 2.924 2.924l.896-.01.622.636a2.89 2.89 0 0 0 4.134 0l.622-.638.896-.011a2.89 2.89 0 0 0 2.924-2.924l-.01-.896.636-.622a2.89 2.89 0 0 0 0-4.134l-.638-.622.011-.896a2.89 2.89 0 0 0-2.924-2.924l-.896.01-.622-.636zm.287 5.984-3 3a.5.5 0 0 1-.708 0l-1.5-1.5a.5.5 0 1 1 .708-.708L7 8.793l2.646-2.647a.5.5 0 0 1 .708.708z" />
            </svg>
        </div>

        <h2 class="fw-bold text-teal mb-2">Verified!</h2>
        <p class="text-muted mb-4">Guest confirmed for reception check-in.</p>

        <div class="bg-light p-3 rounded mb-4 text-start border">
            <div class="mb-3">
                <small class="text-secondary text-uppercase fw-bold" style="font-size: 0.75rem;">Guest Name</small>
                <h4 class="mb-0 text-dark"><?php echo htmlspecialchars($guest); ?></h4>
            </div>
            <div>
                <small class="text-secondary text-uppercase fw-bold" style="font-size: 0.75rem;">Destination</small>
                <h5 class="mb-0 text-dark"><?php echo htmlspecialchars($hotel); ?></h5>
            </div>
        </div>

        <button class="btn btn-teal w-100 py-3 fw-bold rounded-pill" onclick="window.close()">Close Verification</button>
    </div>

</body>

</html>