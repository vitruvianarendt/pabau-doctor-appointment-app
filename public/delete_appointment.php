<?php
include ("../includes/db_connection.php");
include ("classes/appointment.php");

// Get data from POST request
$appointmentId = $_POST['appointmentId'];
$userId = $_POST['userId'];

$appointment = new Appointment($conn);
$result = $appointment->deleteAppointment($userId, $appointmentId);

header("Location: templates/appointments.php");
echo $response;
?>
