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

include("includes/arrayimage.php");
?>
<!DOCTYPE html>
<html>

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Stays</title>
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

        .card-custom {
            background: #ffffff;
            border: 1px solid #eee;
            border-radius: 12px;
            overflow: hidden;
            transition: transform 0.2s;
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.05);
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
            background: #FF6F61;
            color: white;
            border: none;
            width: 100%;
            padding: 10px;
            font-weight: bold;
            transition: 0.2s;
        }

        .book-btn:hover {
            background: #E65A50;
            color: white;
        }
    </style>
</head>

<body>

    <?php include("includes/navbar.php"); ?>

    <div class="container py-5">
        <h2 class="mb-4 fw-bold">All Hotels & Resorts</h2>

        <div class="d-flex justify-content-end mb-4">
            <form method="GET" class="d-flex gap-2 align-items-center">
                <label class="fw-bold text-secondary">Sort by:</label>
                <select name="sort" class="form-select w-auto border-secondary" onchange="this.form.submit()">
                    <option value="default" <?php if ((array_key_exists('sort', $_GET) == 0) || $_GET['sort'] == 'default') echo 'selected'; ?>>Default</option>
                    <option value="price_asc" <?php if (array_key_exists('sort', $_GET) && $_GET['sort'] == 'price_asc') echo 'selected'; ?>>Price: Low to High</option>
                    <option value="price_desc" <?php if (array_key_exists('sort', $_GET) && $_GET['sort'] == 'price_desc') echo 'selected'; ?>>Price: High to Low</option>
                    <option value="rating_desc" <?php if (array_key_exists('sort', $_GET) && $_GET['sort'] == 'rating_desc') echo 'selected'; ?>>Rating: High to Low</option>
                    <option value="rating_asc" <?php if (array_key_exists('sort', $_GET) && $_GET['sort'] == 'rating_asc') echo 'selected'; ?>>Rating: Low to High</option>
                    <option value="name_asc" <?php if (array_key_exists('sort', $_GET) && $_GET['sort'] == 'name_asc') echo 'selected'; ?>>Name: A-Z</option>
                    <option value="name_desc" <?php if (array_key_exists('sort', $_GET) && $_GET['sort'] == 'name_desc') echo 'selected'; ?>>Name: Z-A</option>
                </select>
            </form>
        </div>

        <div class="row g-4">
            <?php
            $displayHotels = array();
            for ($i = 0; $i < count($hotel); $i++) {
                $temp = $hotel[$i];
                $temp['original_index'] = $i;
                $displayHotels[] = $temp;
            }

            $sort = "default";
            if (array_key_exists('sort', $_GET)) {
                $sort = $_GET['sort'];
            }

            // Custom Bubble Sort Implementation
            if ($sort != "default") {
                $n = count($displayHotels);
                for ($j = 0; $j < $n - 1; $j++) {
                    for ($k = 0; $k < $n - $j - 1; $k++) {
                        $swap = false;

                        $itemA = $displayHotels[$k];
                        $itemB = $displayHotels[$k + 1];

                        // Numeric comparison (no str_replace needed)
                        $priceA = $itemA[2];
                        $priceB = $itemB[2];
                        $ratingA = $itemA[3];
                        $ratingB = $itemB[3];
                        $nameA = $itemA[0];
                        $nameB = $itemB[0];
                        $displayPrice = $itemA[5]; // Use string for display

                        if ($sort == 'price_asc') {
                            if ($priceA > $priceB) $swap = true;
                        } elseif ($sort == 'price_desc') {
                            if ($priceA < $priceB) $swap = true;
                        } elseif ($sort == 'rating_asc') {
                            if ($ratingA > $ratingB) $swap = true;
                        } elseif ($sort == 'rating_desc') {
                            if ($ratingA < $ratingB) $swap = true;
                        } elseif ($sort == 'name_asc') {
                            if (strcmp($nameA, $nameB) > 0) $swap = true;
                        } elseif ($sort == 'name_desc') {
                            if (strcmp($nameA, $nameB) < 0) $swap = true;
                        }

                        if ($swap == true) {
                            $temp = $displayHotels[$k];
                            $displayHotels[$k] = $displayHotels[$k + 1];
                            $displayHotels[$k + 1] = $temp;
                        }
                    }
                }
            }

            for ($i = 0; $i < count($displayHotels); $i = $i + 1) {
                $h = $displayHotels[$i];
                $title = $h[0];
                $folder = $h[1];
                $price = $h[5]; // Display Price (String)
                $rating = $h[3];
                $location = $h[4];
                $origIndex = $h['original_index'];
                $img1 = "images/" . $folder . "/1.jpg";
            ?>

                <div class="col-md-6 col-lg-4 col-xl-3">
                    <div class="card card-custom h-100 text-dark">
                        <div class="card-img-top" style="background-image:url(&quot;<?php echo $img1; ?>&quot;); background-size:cover; background-position:center;"></div>
                        <div class="card-body">
                            <h5 class="card-title fw-bold text-truncate" title="<?php echo $title; ?>"><?php echo $title; ?></h5>
                            <p class="card-text small mb-2 text-truncate" title="<?php echo $location; ?>"><i class="fa-solid fa-location-dot"></i> <?php echo $location; ?></p>
                            <div class="d-flex justify-content-between align-items-center mb-3">
                                <span class="fw-bold fs-5">₱<?php echo $price; ?></span>
                                <span class="text-warning"><i class="fa-solid fa-star"></i> <?php echo $rating; ?></span>
                            </div>
                        </div>
                        <div class="card-footer p-0 border-0">
                            <?php if ($logged == 0) { ?>
                                <button class="book-btn" data-bs-toggle="modal" data-bs-target="#loginModal">Login to Book</button>
                            <?php } else { ?>
                                <form method="GET" action="b.php" class="m-0">
                                    <input type="hidden" name="index" value="<?php echo $origIndex; ?>">
                                    <button class="book-btn" type="submit">View & Book</button>
                                </form>
                            <?php } ?>
                        </div>
                    </div>
                </div>

            <?php } ?>
        </div>
    </div>

    <?php include("includes/f.php"); ?>

</body>

</html>