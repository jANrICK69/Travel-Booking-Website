<?php
session_start();

if (array_key_exists("username", $_SESSION) == 0) {
    $_SESSION["username"] = "";
}
if (array_key_exists("userID", $_SESSION) == 0) {
    $_SESSION["userID"] = "";
}

$displayName = $_SESSION["username"];
?>
<!DOCTYPE html>
<html>

<head>
    <title>Tara - About Us</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" rel="stylesheet">
    <style>
        body {
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            background: #f8f9fa;
        }

        .hero-about {
            position: relative;
            background-color: #008080;
            color: white;
            padding: 150px 0;
            margin-bottom: 50px;
            overflow: hidden;
        }

        .video-background {
            position: absolute;
            top: 50%;
            left: 50%;
            min-width: 100%;
            min-height: 100%;
            width: auto;
            height: auto;
            z-index: 0;
            transform: translateX(-50%) translateY(-50%);
            pointer-events: none;
            opacity: 0.6;
        }

        .hero-content {
            position: relative;
            z-index: 1;
            text-shadow: 2px 2px 4px rgba(0, 0, 0, 0.7);
        }
    </style>
</head>

<body>

    <?php include("navbar.php"); ?>

    <div class="hero-about text-center">
        <div class="video-background">
            <iframe width="100%" height="100%"
                src="https://www.youtube.com/embed/ZedPHED82Y4?autoplay=1&mute=1&loop=1&playlist=ZedPHED82Y4&controls=0&showinfo=0&rel=0&modestbranding=1"
                frameborder="0" allow="autoplay; encrypted-media"
                style="width: 100vw; height: 56.25vw; min-height: 100vh; min-width: 177.77vh;">
            </iframe>
        </div>

        <div class="container hero-content">
            <h1 class="display-4 fw-bold">About Tara</h1>
            <p class="lead fw-bold">Your premium gateway to the wonders of El Nido.</p>
        </div>
    </div>

    <div class="container mb-5">
        <div class="row align-items-center mb-5">
            <div class="col-md-6">
                <img src="images/logo.png" alt="About Tara" class="img-fluid rounded-4 shadow-sm mb-4 mb-md-0" style="max-height: 400px; width: auto; display: block; margin: 0 auto;">
            </div>
            <div class="col-md-6">
                <h2 class="fw-bold mb-3 text-teal">Who We Are</h2>
                <p class="text-secondary fs-5" style="line-height: 1.8;">
                    <strong>Tara</strong> is an accommodation booking platform dedicated to showcasing the breathtaking beauty of El Nido, Palawan.
                    We connect travelers with the finest hotels, resorts, and hidden gems in the region.
                </p>
                <p class="text-secondary fs-5" style="line-height: 1.8;">
                    Our mission is to make your travel experience seamless and unforgettable.
                    Whether you are seeking an island escape or a cozy beachfront stay,
                    Tara provides a curated selection of stays tailored to your dreams.
                </p>
            </div>
        </div>

        <div class="row g-4 mt-4">
            <div class="col-md-4">
                <div class="p-4 bg-white rounded-4 shadow-sm h-100 text-center border">
                    <h3 class="text-teal mb-3"><i class="fa-solid fa-phone"></i> Contact Us</h3>
                    <p class="text-muted">Need assistance? Our support team is here for you 24/7.</p>
                    <p class="fw-bold fs-5 text-dark">+63 912 345 6789</p>
                </div>
            </div>
            <div class="col-md-4">
                <div class="p-4 bg-white rounded-4 shadow-sm h-100 text-center border">
                    <h3 class="text-teal mb-3"><i class="fa-solid fa-envelope"></i> Email</h3>
                    <p class="text-muted">Send us your inquiries and we'll get back to you shortly.</p>
                    <p class="fw-bold fs-5 text-dark">support@tara-elnido.com</p>
                </div>
            </div>
            <div class="col-md-4">
                <div class="p-4 bg-white rounded-4 shadow-sm h-100 text-center border">
                    <h3 class="text-teal mb-3"><i class="fa-solid fa-location-dot"></i> Visit Us</h3>
                    <p class="text-muted">Come see us at our main office in Palawan.</p>
                    <p class="fw-bold fs-5 text-dark">Rizal St, Brgy. Maligaya, El Nido</p>
                </div>
            </div>
        </div>
    </div>

    <?php include("f.php"); ?>

</body>

</html>