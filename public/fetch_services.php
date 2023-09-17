<?php
include("../includes/db_connection.php");

// Query to retrieve services from the database
$sql = "SELECT service_id, name FROM service";
$result = $conn->query($sql);

$services = array();

if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
        $services[] = $row;
    }
}

header('Content-Type: application/json');
echo json_encode($services);

$conn->close();
?>
