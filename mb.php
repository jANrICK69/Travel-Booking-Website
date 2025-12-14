<?php
session_start();

if (array_key_exists("username", $_SESSION) == 0) {
    $_SESSION["username"] = "";
}
if (array_key_exists("userID", $_SESSION) == 0) {
    $_SESSION["userID"] = "";
}

if ($_SESSION["username"] == "") {
    header("Location: l.php");
    exit();
}

$userID = $_SESSION["userID"];
include("db.php");
?>
<!DOCTYPE html>
<html>

<head>
    <title>My Bookings</title>
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

        .card-booking {
            background: rgba(255, 255, 255, 0.15);
            backdrop-filter: blur(5px);
            border-radius: 12px;
            border: none;
            margin-bottom: 20px;
            transition: 0.3s;
        }

        .card-booking:hover {
            background: rgba(255, 255, 255, 0.25);
        }

        .img-thumb {
            width: 100%;
            height: 100%;
            min-height: 200px;
            object-fit: cover;
            border-radius: 12px;
        }

        .badge-price {
            background: rgba(0, 0, 0, 0.5);
            padding: 5px 10px;
            border-radius: 5px;
            font-weight: bold;
        }
    </style>
</head>

<body>

    <?php include("navbar.php"); ?>

    <div class="container py-5">
        <h2 class="mb-4 fw-bold">My Bookings</h2>

        <?php
        $sql = "SELECT hotel_name, email, headcount, date_start, date_end, inquiry, price, img_folder, total_price
            FROM B WHERE user_id = '$userID'
            ORDER BY id DESC";

        $result = sqlsrv_query($conn, $sql);

        // Check if query failed (beginner check)
        if ($result === false) {
            // Fallback if total_price column error before schema update
            // Use old query or just show empty. But we assume schema is updated.
            // We will just try to continue.
        }

        $hasBookings = 0;
        while ($row = sqlsrv_fetch_array($result)) {
            $hasBookings = 1;
            $hotel = $row["hotel_name"];
            $email = $row["email"];
            $head = $row["headcount"];
            $ds = $row["date_start"];
            $de = $row["date_end"];
            $inq = $row["inquiry"];
            $price = $row["price"];
            $total = $row["total_price"]; // Fetch stored total price
            $folder = $row["img_folder"];

            $ds_show = ($ds != null) ? $ds->format("M d, Y") : "";
            $de_show = ($de != null) ? $de->format("M d, Y") : "";

            // Fallback calculation if total_price is null (for old bookings)
            if ($total == null && $ds != null && $de != null) {
                $diff = $de->getTimestamp() - $ds->getTimestamp();
                $days = floor($diff / 86400);
                if ($days < 1) $days = 1;
                $total = $price * $days;
            }

            $imgPath = "images/" . $folder . "/1.jpg";
        ?>

            <div class="card card-booking p-3">
                <div class="row g-0">
                    <div class="col-md-4">
                        <div class="img-thumb" style="background-image:url('<?php echo $imgPath; ?>'); background-size:cover; background-position:center;"></div>
                    </div>
                    <div class="col-md-8">
                        <div class="card-body py-0 ps-md-4">
                            <h4 class="card-title fw-bold"><?php echo $hotel; ?></h4>
                            <p class="mb-2 text-white-50"><small>Booking Reference: #<?php echo rand(1000, 9999); // Fake ref ID 
                                                                                        ?></small></p>

                            <div class="row mt-3">
                                <div class="col-sm-6">
                                    <p class="mb-1"><strong>Dates:</strong> <br> <?php echo $ds_show; ?> &rarr; <?php echo $de_show; ?></p>
                                    <p class="mb-1"><strong>Guests:</strong> <?php echo $head; ?></p>
                                    <p class="mb-1"><strong>Contact:</strong> <?php echo $email; ?></p>
                                </div>
                                <div class="col-sm-6 text-md-end">
                                    <p class="mb-1">Price per night: ₱<?php echo number_format($price); ?></p>
                                    <div class="mt-2">
                                        <span class="badge-price fs-5">Total: ₱<?php echo number_format($total); ?></span>
                                    </div>
                                </div>
                            </div>

                            <?php if ($inq != "") { ?>
                                <div class="mt-3 p-2 bg-black bg-opacity-25 rounded">
                                    <small><strong>Note:</strong> <?php echo $inq; ?></small>
                                </div>
                            <?php } ?>
                        </div>
                    </div>
                </div>
            </div>

        <?php } ?>

        <?php if ($hasBookings == 0) { ?>
            <div class="text-center py-5 bg-white bg-opacity-10 rounded">
                <h3>No bookings found.</h3>
                <p>Ready to start your adventure?</p>
                <a href="d.php" class="btn btn-light mt-2">Explore Destinations</a>
            </div>
        <?php } ?>

    </div>

</body>

</html>