<?php
header("Content-Type: application/json; charset=utf-8");

// ---------------------------------
// GET ACCESS TOKEN
// ---------------------------------
$clientId = "8TRQ84Gz5F0i2wMTq6AtuSJ6rKrr1om7";
$clientSecret = "ryyReEtmxhFwiSWg";

$tokenUrl = "https://test.api.amadeus.com/v1/security/oauth2/token";

$postData = "grant_type=client_credentials"
          . "&client_id=" . $clientId
          . "&client_secret=" . $clientSecret;

$ch = curl_init();
curl_setopt($ch, CURLOPT_URL, $tokenUrl);
curl_setopt($ch, CURLOPT_POST, true);
curl_setopt($ch, CURLOPT_POSTFIELDS, $postData);
curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
curl_setopt($ch, CURLOPT_HTTPHEADER, array(
    "Content-Type: application/x-www-form-urlencoded"
));

$tokenResponse = curl_exec($ch);
curl_close($ch);

$tokenJson = json_decode($tokenResponse, true);

$accessToken = "";
if ($tokenJson != null) {
    if (array_key_exists("access_token", $tokenJson) == 1) {
        $accessToken = $tokenJson["access_token"];
    }
}

if ($accessToken == "") {
    echo json_encode(array("error" => "Could not generate token", "raw" => $tokenResponse));
    exit;
}

// ---------------------------------
// SEARCH FOR MANILA PH (IMPROVED)
// ---------------------------------
$keyword = "Manila";

$url = "https://test.api.amadeus.com/v1/reference-data/locations";
$url = $url . "?subType=CITY,AIRPORT";
$url = $url . "&keyword=" . urlencode($keyword);
$url = $url . "&countryCode=PH"; // try to force Philippines

$ch2 = curl_init();
curl_setopt($ch2, CURLOPT_URL, $url);
curl_setopt($ch2, CURLOPT_RETURNTRANSFER, true);
curl_setopt($ch2, CURLOPT_HTTPHEADER, array(
    "Authorization: Bearer " . $accessToken
));

$searchResponse = curl_exec($ch2);
curl_close($ch2);

$searchJson = json_decode($searchResponse, true);

// ---------------------------------
// OUTPUT EVERYTHING
// ---------------------------------
echo json_encode(array(
    "token_info" => $tokenJson,
    "search_result" => $searchJson
));
exit;

?>
