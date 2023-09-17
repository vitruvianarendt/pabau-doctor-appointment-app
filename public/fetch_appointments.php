<?php
include("../includes/db_connection.php");
include("classes/appointment.php");

// Get the user ID from the GET request
$userId = $_GET['userId'];

$appointment = new Appointment($conn);
$userAppointments = $appointment->getUserAppointments($userId);

header('Content-Type: application/json');
echo json_encode($userAppointments);
?>
