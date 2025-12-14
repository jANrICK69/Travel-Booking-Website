<?php
session_start();

if (array_key_exists("username", $_SESSION) == 0) {
    $_SESSION["username"] = "";
}
if (array_key_exists("userID", $_SESSION) == 0) {
    $_SESSION["userID"] = "";
}

$logged = 0;
$displayName = "";

if ($_SESSION["username"] != "") {
    $logged = 1;
    $displayName = $_SESSION["username"];
}

include("arrayimage.php");

$names = array();
$images = array();
$locations = array();

for ($i = 0; $i < count($hotel); $i = $i + 1) {
    $names[$i] = $hotel[$i][0];
    $folder = $hotel[$i][1];
    $images[$i] = "images/" . $folder . "/1.jpg";
    $locations[$i] = $hotel[$i][4];
}

$mapboxKey = "pk.eyJ1Ijoia3lsZWxpeCIsImEiOiJjbWl3ejMzdmIwMWU5M2VxczJyOHBxbXZ2In0.2GzAyBPJlO_X24QBTy-MYQ";
?>
<!DOCTYPE html>
<html>

<head>
    <title>HP - Home</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://api.mapbox.com/mapbox-gl-js/v2.15.0/mapbox-gl.css" rel="stylesheet">
    <script src="https://api.mapbox.com/mapbox-gl-js/v2.15.0/mapbox-gl.js"></script>
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

        .hero-section {
            padding: 100px 0;
        }

        .hero-right {
            width: 100%;
            height: 300px;
            background: rgba(0, 0, 0, 0.25);
            border-radius: 20px;
            display: flex;
            align-items: center;
            justify-content: center;
        }

        #map {
            width: 100%;
            height: 350px;
            border-radius: 14px;
        }

        .feat-img {
            width: 100%;
            height: 260px;
            border-radius: 14px;
            background-size: cover;
            background-position: center;
            transition: background-image 0.5s ease-in-out;
        }

        .feat-title {
            font-size: 28px;
            margin-top: 16px;
            font-weight: bold;
        }

        .bg-glass {
            background: rgba(255, 255, 255, 0.12);
            backdrop-filter: blur(10px);
        }

        .btn-custom {
            background: rgba(0, 0, 0, 0.45);
            color: white;
            border: none;
        }

        .btn-custom:hover {
            background: rgba(0, 0, 0, 0.65);
            color: white;
        }
    </style>
</head>

<body>

    <?php include("navbar.php"); ?>

    <div class="hero-section">
        <div class="container">
            <div class="row align-items-center">
                <div class="col-md-6 mb-4 mb-md-0">
                    <h1 class="display-3 fw-bold">Travel<br>Around<br>The World</h1>
                    <p class="lead">Explore the best beautiful tourist spots across the world and enjoy an unforgettable adventure.</p>
                    <button class="btn btn-light btn-lg mt-3" onclick="window.location='d.php'">Explore The World &rarr;</button>
                </div>
                <div class="col-md-6">
                    <div class="hero-right text-white h2">
                        <!-- Placeholder or Featured Image -->
                        Travel & Relax
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="container my-5">
        <div class="row g-4 d-flex align-items-stretch">
            <div class="col-md-6">
                <div class="bg-white text-dark p-3 rounded-4 shadow h-100">
                    <h4 class="mb-3">Location Preview</h4>
                    <div id="map"></div>
                </div>
            </div>

            <div class="col-md-6">
                <div class="bg-glass p-4 rounded-4 h-100 text-center text-white d-flex flex-column justify-content-between">
                    <div>
                        <div id="featImg" class="feat-img shadow-sm" style="background-image:url('<?php echo $images[0]; ?>');"></div>
                        <div id="featTitle" class="feat-title"><?php echo $names[0]; ?></div>
                    </div>

                    <div class="mt-4">
                        <button class="btn btn-custom px-4 py-2 fw-bold" onclick="goDetails()">View Details</button>
                        <div class="d-flex justify-content-center gap-3 mt-3">
                            <button class="btn btn-custom btn-sm" onclick="prevPlace()">&larr; Previous</button>
                            <button class="btn btn-custom btn-sm" onclick="nextPlace()">Next &rarr;</button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script>
        mapboxgl.accessToken = "<?php echo $mapboxKey; ?>";

        var map = new mapboxgl.Map({
            container: "map",
            style: "mapbox://styles/mapbox/streets-v11",
            center: [120.9842, 14.5995],
            zoom: 5
        });

        var marker = null;
        var names = <?php echo json_encode($names); ?>;
        var images = <?php echo json_encode($images); ?>;
        var locations = <?php echo json_encode($locations); ?>;
        var index = 0;

        function showPlace() {
            var imgUrl = images[index];
            document.getElementById("featImg").style.backgroundImage = "url('" + imgUrl + "')";
            document.getElementById("featTitle").innerHTML = names[index];

            var url = "https://api.mapbox.com/geocoding/v5/mapbox.places/" +
                encodeURIComponent(locations[index]) +
                ".json?access_token=" + mapboxgl.accessToken;

            var xhr = new XMLHttpRequest();
            xhr.open("GET", url, true);
            xhr.onreadystatechange = function() {
                if (xhr.readyState == 4 && xhr.status == 200) {
                    var data = JSON.parse(xhr.responseText);
                    if (data.features && data.features.length > 0) {
                        var lon = data.features[0].center[0];
                        var lat = data.features[0].center[1];

                        if (marker != null) marker.remove();
                        marker = new mapboxgl.Marker({
                            color: "#ff7f2a"
                        }).setLngLat([lon, lat]).addTo(map);
                        map.flyTo({
                            center: [lon, lat],
                            zoom: 10
                        });
                    }
                }
            };
            xhr.send();
        }

        function nextPlace() {
            index = index + 1;
            if (index >= names.length) index = 0;
            showPlace();
        }

        function prevPlace() {
            index = index - 1;
            if (index < 0) index = names.length - 1;
            showPlace();
        }

        function goDetails() {
            window.location = "b.php?index=" + index;
        }

        showPlace();
    </script>

</body>

</html>