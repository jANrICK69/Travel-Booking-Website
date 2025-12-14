<?php
session_start();

if (array_key_exists("username", $_SESSION) == 0) {
    $_SESSION["username"] = "";
}
if (array_key_exists("userID", $_SESSION) == 0) {
    $_SESSION["userID"] = "";
}
$logged = 0;
if ($_SESSION["username"] != "") {
    $logged = 1;
}

include("arrayimage.php");
?>
<!DOCTYPE html>
<html>

<head>
    <title>Destinations</title>
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

        .card-custom {
            background: rgba(255, 255, 255, 0.1);
            backdrop-filter: blur(5px);
            border: none;
            border-radius: 12px;
            overflow: hidden;
            transition: transform 0.2s;
        }

        .card-custom:hover {
            transform: translateY(-5px);
            box-shadow: 0 10px 20px rgba(0, 0, 0, 0.1);
        }

        .card-img-top {
            height: 200px;
            object-fit: cover;
        }

        .book-btn {
            background: rgba(0, 0, 0, 0.6);
            color: white;
            border: none;
            width: 100%;
            padding: 10px;
            font-weight: bold;
        }

        .book-btn:hover {
            background: rgba(0, 0, 0, 0.8);
            color: white;
        }
    </style>
</head>

<body>

    <?php include("navbar.php"); ?>

    <div class="container py-5">
        <h2 class="mb-4 fw-bold">All Hotels & Resorts</h2>

        <div class="row g-4">
            <?php
            for ($i = 0; $i < count($hotel); $i++) {
                $title = $hotel[$i][0];
                $folder = $hotel[$i][1];
                $price = $hotel[$i][2];
                $rating = $hotel[$i][3];
                $location = $hotel[$i][4];
                $img1 = "images/" . $folder . "/1.jpg";
            ?>

                <div class="col-md-6 col-lg-4 col-xl-3">
                    <div class="card card-custom h-100 text-white">
                        <div class="card-img-top" style="background-image:url('<?php echo $img1; ?>'); background-size:cover; background-position:center;"></div>
                        <div class="card-body">
                            <h5 class="card-title fw-bold text-truncate" title="<?php echo $title; ?>"><?php echo $title; ?></h5>
                            <p class="card-text small mb-2"><i class="bi bi-geo-alt"></i> <?php echo $location; ?></p>
                            <div class="d-flex justify-content-between align-items-center mb-3">
                                <span class="fw-bold fs-5">₱<?php echo number_format($price); ?></span>
                                <span class="text-warning">★ <?php echo $rating; ?></span>
                            </div>
                        </div>
                        <div class="card-footer p-0 border-0">
                            <?php if ($logged == 0) { ?>
                                <button class="book-btn" onclick="window.location='l.php'">Login to Book</button>
                            <?php } else { ?>
                                <form method="GET" action="b.php" class="m-0">
                                    <input type="hidden" name="index" value="<?php echo $i; ?>">
                                    <button class="book-btn" type="submit">View & Book</button>
                                </form>
                            <?php } ?>
                        </div>
                    </div>
                </div>

            <?php } ?>
        </div>
    </div>

</body>

</html>