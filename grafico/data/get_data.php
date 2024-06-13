<?php
// /var/www/html/climate_dashboard/data/get_data.php

$servername = "localhost";
$username = "raphael";
$password = "12345Cx*,";
$dbname = "agrosapiens_clima";

$days = isset($_GET['days']) ? intval($_GET['days']) : 1;

$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

$sql = "SELECT timestamp, temperature, pressure, altitude, humidity, heat_index, dew_point, vapor_pressure, vapor_pressure_deficit FROM leituras_climaticas WHERE timestamp >= NOW() - INTERVAL ? DAY";
$stmt = $conn->prepare($sql);

if (!$stmt) {
    die("Prepare failed: (" . $conn->errno . ") " . $conn->error);
}

$stmt->bind_param("i", $days);
$stmt->execute();

if ($stmt->error) {
    die("Execute failed: (" . $stmt->errno . ") " . $stmt->error);
}

$result = $stmt->get_result();

$labels = [];
$temperature = [];
$pressure = [];
$altitude = [];
$humidity = [];
$heat_index = [];
$dew_point = [];
$vapor_pressure = [];
$vapor_pressure_deficit = [];

while ($row = $result->fetch_assoc()) {
    $labels[] = $row['timestamp'];
    $temperature[] = $row['temperature'];
    $pressure[] = $row['pressure'];
    $altitude[] = $row['altitude'];
    $humidity[] = $row['humidity'];
    $heat_index[] = $row['heat_index'];
    $dew_point[] = $row['dew_point'];
    $vapor_pressure[] = $row['vapor_pressure'];
    $vapor_pressure_deficit[] = $row['vapor_pressure_deficit'];
}

$stmt->close();
$conn->close();

echo json_encode([
    'labels' => $labels,
    'temperature' => $temperature,
    'pressure' => $pressure,
    'altitude' => $altitude,
    'humidity' => $humidity,
    'heat_index' => $heat_index,
    'dew_point' => $dew_point,
    'vapor_pressure' => $vapor_pressure,
    'vapor_pressure_deficit' => $vapor_pressure_deficit
]);
