<?php
session_start();

if (array_key_exists('booking_details', $_SESSION) == 0) {
    echo "<script>alert('No active booking found.'); window.location='../hp.php';</script>";
    exit();
}

$booking = $_SESSION['booking_details'];
$booking_id = $booking['user_id'];
$amount = $booking['total_price'];
$hotel = $booking['hotel_name'];

$public_key = "pk_test_placeholder";
$secret_key = "sk_test_placeholder";

$error_msg = "";
$show_simulation_link = false;

if (array_key_exists('pay_now', $_POST)) {
    $url = "https://api.paymongo.com/v1/checkout_sessions";

    $amount_centavos = intval($amount * 100);

    $data = array(
        'data' => array(
            'attributes' => array(
                'billing' => array(
                    'name' => $_SESSION['username'],
                    'email' => 'test@example.com'
                ),
                'line_items' => array(
                    array(
                        'currency' => 'PHP',
                        'amount' => $amount_centavos,
                        'description' => 'Booking for ' . $hotel,
                        'name' => $hotel,
                        'quantity' => 1
                    )
                ),
                'payment_method_types' => array('card', 'gcash', 'paymaya'),
                'success_url' => 'http://localhost/WebsiteProject/actions/p.s.php?session_id={CHECKOUT_SESSION_ID}',
                'cancel_url' => 'http://localhost/WebsiteProject/actions/p.c.php',
                'description' => 'Booking ID: ' . $booking_id
            )
        )
    );

    $ch = curl_init($url);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
    curl_setopt($ch, CURLOPT_POST, true);
    curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($data));
    curl_setopt($ch, CURLOPT_HTTPHEADER, array(
        'Content-Type: application/json',
        'Authorization: Basic ' . base64_encode($secret_key . ':')
    ));

    $response = curl_exec($ch);
    $http_code = curl_getinfo($ch, CURLINFO_HTTP_CODE);
    curl_close($ch);

    $result = json_decode($response, true);

    $checkout_url = "";
    if ($result != null) {
        if (array_key_exists('data', $result)) {
            if (array_key_exists('attributes', $result['data'])) {
                if (array_key_exists('checkout_url', $result['data']['attributes'])) {
                    $checkout_url = $result['data']['attributes']['checkout_url'];
                }
            }
        }
    }

    if ($checkout_url != "") {
        // The original instruction `header("Location: ../hp.php"); . $checkout_url);` is syntactically incorrect.
        // Assuming the intent was to redirect to the checkout URL, the original line is preserved.
        // If the intent was to redirect to `../hp.php` instead, please clarify.
        header("Location: " . $checkout_url);
        exit();
    } else {
        $error_msg = "PayMongo Error: Unknown error";
        if ($result != null) {
            if (array_key_exists('errors', $result)) {
                if (count($result['errors']) > 0) {
                    if (array_key_exists('detail', $result['errors'][0])) {
                        $error_msg = "PayMongo Error: " . $result['errors'][0]['detail'];
                    }
                }
            }
        }

        if (strpos($secret_key, 'placeholder') !== false) {
            $show_simulation_link = true;
        }
    }
}
?>
<!DOCTYPE html>
<html>

<head>
    <title>Payment - <?php echo $hotel; ?></title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        body {
            background-color: #f8f9fa;
            font-family: 'Segoe UI', sans-serif;
        }

        .payment-card {
            max-width: 500px;
            margin: 50px auto;
            background: white;
            border-radius: 15px;
            box-shadow: 0 10px 30px rgba(0, 0, 0, 0.1);
            padding: 30px;
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

<body>
    <div class="container">
        <div class="payment-card text-center">
            <h2 class="fw-bold mb-4">Complete Your Payment</h2>
            <div class="mb-4">
                <p class="text-muted mb-1">Booking for</p>
                <h4 class="text-dark"><?php echo $hotel; ?></h4>
            </div>
            <div class="mb-4">
                <p class="text-muted mb-1">Total Amount</p>
                <h1 class="text-teal fw-bold">₱<?php echo $amount; ?></h1>
            </div>

            <?php if ($error_msg != "") { ?>
                <div class="alert alert-danger"><?php echo $error_msg; ?></div>

                <?php if ($show_simulation_link == true) { ?>
                    <div class="alert alert-info py-2">
                        <strong>Developer Mode:</strong> Placeholder keys detected.<br>
                        <a href="p.s.php" class="btn btn-outline-teal mt-2 w-100">Simulate Success ></a>
                    </div>
                <?php } ?>

                <p class="small text-muted mt-2">Since this is a demo without real keys, create an account on PayMongo to get keys.</p>
            <?php } ?>

            <form method="POST">
                <button type="submit" name="pay_now" class="btn btn-teal w-100 py-3 fw-bold rounded-pill mb-3">
                    Pay with PayMongo
                </button>
            </form>
            <a href="p.c.php" class="text-muted text-decoration-none">Cancel Payment</a>
        </div>
    </div>
</body>

</html>