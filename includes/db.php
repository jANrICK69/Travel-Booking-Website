<?php

$serverName = "DESKTOP-AATTHKH\\SQLEXPRESS01";

$connectionOptions = array(
    "Database" => "WebsiteProject",
    "Uid" => "",
    "PWD" => ""
);

$conn = sqlsrv_connect($serverName, $connectionOptions);

if ($conn == false) {
    echo "Could not connect to the database.";
    die(print_r(sqlsrv_errors(), true));
}
