<?php
session_start();

if (array_key_exists("username", $_SESSION) == 0) {
    $_SESSION["username"] = "";
}
if (array_key_exists("userID", $_SESSION) == 0) {
    $_SESSION["userID"] = "";
}
if (array_key_exists("bookings", $_SESSION) == 0) {
    $_SESSION["bookings"] = array();
}

if ($_SESSION["username"] == "") {
    header("Location: l.php");
    exit();
}

include("arrayimage.php");

$index = 0;
if (array_key_exists("index", $_GET)) {
    if ($_GET["index"] != "") {
        $index = (int) $_GET["index"];
    }
}

if ($index < 0 || $index >= count($hotel)) {
    echo "<script>alert('Invalid selection.'); window.location='d.php';</script>";
    exit();
}

$placeTitle = $hotel[$index][0];
$placeFolder = $hotel[$index][1];
$placePrice = $hotel[$index][2];
$weatherCity = $hotel[$index][4];

$weatherKey = "5e4fb336abdd12d34698f810a87c3ecd";
$encodedCity = urlencode($weatherCity);
$weatherUrl = "https://api.openweathermap.org/data/2.5/weather?q=" . $encodedCity . "&appid=" . $weatherKey . "&units=metric";

$weatherJson = @file_get_contents($weatherUrl);
$weatherData = json_decode($weatherJson, true);

$temperature = "";
$condition = "";
$icon = "";

if ($weatherData != null) {
    if (array_key_exists("main", $weatherData)) {
        $temperature = $weatherData["main"]["temp"];
    }
    if (array_key_exists("weather", $weatherData)) {
        if (count($weatherData["weather"]) > 0) {
            $condition = $weatherData["weather"][0]["description"];
            $icon = $weatherData["weather"][0]["icon"];
        }
    }
}

$apiKey = "CF117863AC60432ABABC13AFD193329E";

$searchUrl = "https://api.content.tripadvisor.com/api/v1/location/search?key=" . $apiKey . "&language=en&searchQuery=" . urlencode($placeTitle);
$ch = curl_init();
curl_setopt($ch, CURLOPT_URL, $searchUrl);
curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
curl_setopt($ch, CURLOPT_HTTPHEADER, array("Referer: https://abcdxd.com", "Accept: application/json"));
$searchRaw = curl_exec($ch);
curl_close($ch);

$search = json_decode($searchRaw, true);

$taId = "";
if ($search != null) {
    if (array_key_exists("data", $search)) {
        if (count($search["data"]) > 0) {
            $taId = $search["data"][0]["location_id"];
        }
    }
}

$desc = "";
$phone = "";
$rankStr = "";
$rating = "";
$reviews = "";

if ($taId != "") {
    $detailsUrl = "https://api.content.tripadvisor.com/api/v1/location/" . $taId . "/details?key=" . $apiKey . "&language=en";

    $ch = curl_init();
    curl_setopt($ch, CURLOPT_URL, $detailsUrl);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
    curl_setopt($ch, CURLOPT_HTTPHEADER, array("Referer: https://abcdxd.com", "Accept: application/json"));
    $detailsRaw = curl_exec($ch);
    curl_close($ch);

    $d = json_decode($detailsRaw, true);

    if ($d != null) {
        if (array_key_exists("description", $d)) {
            $desc = $d["description"];
        }
        if (array_key_exists("phone", $d)) {
            $phone = $d["phone"];
        }
        if (array_key_exists("ranking_data", $d)) {
            if (array_key_exists("ranking_string", $d["ranking_data"])) {
                $rankStr = $d["ranking_data"]["ranking_string"];
            }
        }
        if (array_key_exists("rating", $d)) {
            $rating = $d["rating"];
        }
        if (array_key_exists("num_reviews", $d)) {
            $reviews = $d["num_reviews"];
        }
    }
}
?>
<!DOCTYPE html>
<html>

<head>
    <title>Book Place</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" rel="stylesheet">
    <style>
        body {
            margin: 0;
            padding: 0;
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            background: #f8f9fa;
            color: #212529;
            min-height: 100vh;
        }

        .bg-custom {
            background: #ffffff;
            border-radius: 20px;
            box-shadow: 0 10px 30px rgba(0, 0, 0, 0.08);
            border: 1px solid #f0f0f0;
        }

        .img-preview {
            height: 260px;
            background: #eee;
            border-radius: 10px;
            background-size: cover;
            background-position: center;
        }

        .img-preview {
            height: 260px;
            background: #222;
            border-radius: 10px;
            background-size: cover;
            background-position: center;
        }

        .small-img {
            width: 100px;
            height: 70px;
            border-radius: 8px;
            background-size: cover;
            background-position: center;
            display: inline-block;
            margin-right: 8px;
            cursor: pointer;
            opacity: 0.8;
            transition: 0.3s;
        }

        .small-img:hover {
            opacity: 1;
        }

        .weather-badge {
            background: #ffffff;
            border-radius: 8px;
            display: inline-flex;
            align-items: center;
            padding: 5px 15px;
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.05);
            border: 1px solid #eee;
        }

        .form-control {
            background: #f8f9fa;
            border: 1px solid #dee2e6;
        }

        .form-control:focus {
            background: #fff;
            box-shadow: none;
            border-color: #212529;
        }

        .btn-main {
            padding: 10px 14px;
            border-radius: 8px;
            background: #008080;
            border: none;
            color: white;
            width: 100%;
            font-weight: bold;
        }

        .btn-main:hover {
            background: rgba(0, 0, 0, 0.7);
            color: white;
        }
    </style>
</head>

<body>

    <?php include("navbar.php"); ?>

    <div class="container my-5">
        <div class="bg-custom p-4 row g-4">

            <div class="col-lg-6">
                <?php if ($temperature != "") { ?>
                    <div class="mb-3 weather-badge text-dark">
                        <img src="https://openweathermap.org/img/wn/<?php echo $icon; ?>@2x.png" width="50">
                        <span class="fs-5 fw-bold ms-2"><?php echo $temperature; ?>°C — <?php echo ucfirst($condition); ?></span>
                    </div>
                <?php } ?>

                <div class="img-preview shadow-sm mb-3" style="background-image:url(&quot;images/<?php echo $placeFolder; ?>/1.jpg&quot;);"></div>

                <div class="mb-3">
                    <div class="small-img shadow-sm" style="background-image:url(&quot;images/<?php echo $placeFolder; ?>/2.jpg&quot;);"></div>
                    <div class="small-img shadow-sm" style="background-image:url(&quot;images/<?php echo $placeFolder; ?>/3.jpg&quot;);"></div>
                </div>

                <h2 class="fw-bold text-dark"><?php echo $placeTitle; ?></h2>
                <h4 class="text-teal fw-bold">₱<?php echo $placePrice; ?> <span class="fs-6 text-muted fw-normal">/ night</span></h4>

                <?php if ($rating != "") { ?>
                    <div class="mt-2 text-warning fw-bold">
                        <span class="fs-5"><i class="fa-solid fa-star"></i> <?php echo $rating; ?></span>
                        <span class="text-muted fw-normal ms-2">(<?php echo $reviews; ?> reviews)</span>
                    </div>
                <?php } ?>

                <?php if ($desc != "") { ?>
                    <div class="mt-3 p-3 bg-light rounded border">
                        <p class="mb-0 small text-secondary"><?php echo $desc; ?></p>
                    </div>
                <?php } ?>

                <?php if ($rankStr != "") { ?>
                    <p class="mt-2 text-info small"><?php echo $rankStr; ?></p>
                <?php } ?>
            </div>

            <div class="col-lg-6">
                <div class="bg-light text-dark p-4 rounded-4 h-100 border">
                    <h3 class="mb-4 fw-bold">Book Your Stay</h3>
                    <form method="POST" action="b.i.php">
                        <div class="mb-3">
                            <label class="form-label fw-bold">Email Address</label>
                            <input type="email" name="email_box" class="form-control" required placeholder="name@example.com">
                        </div>

                        <div class="mb-3">
                            <label class="form-label fw-bold">Number of Guests</label>
                            <input type="number" name="head_box" class="form-control" required min="1" value="1">
                        </div>

                        <div class="row g-2 mb-3">
                            <div class="col-6">
                                <label class="form-label fw-bold">Check-in</label>
                                <input type="date" name="start_box" class="form-control" required>
                            </div>
                            <div class="col-6">
                                <label class="form-label fw-bold">Check-out</label>
                                <input type="date" name="end_box" class="form-control" required>
                            </div>
                        </div>

                        <div class="mb-3">
                            <label class="form-label fw-bold">Special Requests</label>
                            <textarea name="inq_box" class="form-control" rows="4" placeholder="Any specific needs?"></textarea>
                        </div>

                        <input type="hidden" name="hotel_name" value="<?php echo $placeTitle; ?>">
                        <input type="hidden" name="img_folder" value="<?php echo $placeFolder; ?>">
                        <input type="hidden" name="price" value="<?php echo $placePrice; ?>">

                        <button class="btn btn-teal w-100 py-2 fw-bold" type="submit">Confirm Booking</button>
                        <small class="d-block text-center text-muted mt-2">Payment via PayMongo</small>
                    </form>
                </div>
            </div>

        </div>
    </div>

    <?php include("f.php"); ?>

</body>

</html>