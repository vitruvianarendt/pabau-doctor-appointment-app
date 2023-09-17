<?php
include("../includes/db_connection.php");

$sql = "SELECT doctor_id FROM doctor LIMIT 1"; // This query works under the assumption that we have only one doctor
$result = $conn->query($sql);

if ($result->num_rows === 1) {
    $row = $result->fetch_assoc();
    $doctor_id = $row['doctor_id'];
    header('Content-Type: application/json');
    echo json_encode(["doctor_id" => $doctor_id]);
} else {
    // Handle the case where no doctor ID is found
    header('HTTP/1.1 500 Internal Server Error');
    echo "No doctor ID found in the database.";
}

$conn->close();
?>
