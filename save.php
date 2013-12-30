<?php
$link = mysqli_connect('localhost', 'username', 'password', 'database_name');

if (!$link) {
    die('Could not connect: ' . mysqli_error($link));
}

echo 'Connected successfully';

$device = $_POST["device-details"];
$location = $_POST["location"];
$status = $_POST["did-it-work"];
$accuracy = $_POST["accuracy"];
$indoors_outdoors = $_POST["indoors-outdoors"];

// $result = mysql_real_escape_string(print_r(json_decode($jsonresponse),1));

$query = "INSERT INTO entries (deviceDetails, location, status, accuracy, indoors_outdoors) VALUES ('".$device."', '".$location."', '".$status."', '".$accuracy."', '".$indoors_outdoors."')";

mysqli_query($link, $query);

mysqli_error($link);

mysqli_close($link);

?>