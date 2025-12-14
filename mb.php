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
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            background: #f8f9fa;
            color: #212529;
            min-height: 100vh;
        }

        .card-booking {
            background: #ffffff;
            border-radius: 12px;
            border: 1px solid #eee;
            margin-bottom: 20px;
            transition: 0.3s;
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.05);
        }

        .card-booking:hover {
            box-shadow: 0 8px 15px rgba(0, 0, 0, 0.1);
        }

        .img-thumb {
            width: 100%;
            height: 100%;
            min-height: 200px;
            object-fit: cover;
            border-radius: 12px;
        }

        .badge-price {
            background: #008080;
            color: white;
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
        $sql = "SELECT id, hotel_name, email, headcount, date_start, date_end, inquiry, price, img_folder, total_price
            FROM B WHERE user_id = '$userID'
            ORDER BY id DESC";

        $result = sqlsrv_query($conn, $sql);

        if ($result === false) {
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
            $total = $row["total_price"];
            $folder = $row["img_folder"];

            $ds_show = ($ds != null) ? $ds->format("M d, Y") : "";
            $de_show = ($de != null) ? $de->format("M d, Y") : "";

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
                            <h4 class="card-title fw-bold text-dark"><?php echo $hotel; ?></h4>

                            <div class="row mt-3">
                                <div class="col-sm-6 text-secondary">
                                    <p class="mb-1"><strong>Dates:</strong> <br> <?php echo $ds_show; ?> &rarr; <?php echo $de_show; ?></p>
                                    <p class="mb-1"><strong>Guests:</strong> <?php echo $head; ?></p>
                                    <p class="mb-1"><strong>Contact:</strong> <?php echo $email; ?></p>
                                </div>
                                <div class="col-sm-6 text-md-end">
                                    <p class="mb-1 text-muted">Price per night: ₱<?php echo $price; ?></p>
                                    <div class="mt-2">
                                        <span class="badge-price fs-5">Total: ₱<?php echo $total; ?></span>
                                    </div>

                                    <div class="mt-3 text-center border p-2 rounded bg-light d-inline-block">
                                        <?php
                                        $verifyLink = "http://localhost/WebsiteProject/verify.php?guest=" . urlencode($_SESSION['username']) . "&hotel=" . urlencode($hotel);

                                        $qrUrl = "https://api.qrserver.com/v1/create-qr-code/?size=120x120&data=" . urlencode($verifyLink);
                                        ?>
                                        <p class="small mb-1 text-muted">Scan at Reception</p>
                                        <a href="<?php echo $verifyLink; ?>" target="_blank" title="Click to Simulate Scan">
                                            <img src="<?php echo $qrUrl; ?>" alt="QR" width="120" height="120" class="border">
                                        </a>
                                        <p class="small mb-0 mt-1 text-muted">Click QR to Demo</p>
                                    </div>
                                </div>
                            </div>

                            <?php if ($inq != "") { ?>
                                <div class="mt-3 p-2 bg-light border rounded text-secondary">
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
                <a href="d.php" class="btn btn-teal mt-2">Explore Destinations</a>
            </div>
        <?php } ?>

    </div>

    <?php include("f.php"); ?>

</body>

</html>