<?php
include ("../includes/db_connection.php");
include ("classes/appointment.php");

if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $appointment = new Appointment($conn);

    $appointment_id = $_POST['appointment_id'];
    $user_id = $_POST['user_id'];
    $start_time = $_POST['start_time'];
    $end_time = $_POST['end_time'];

    $response = $appointment->editAppointment($appointment_id, $user_id, $start_time, $end_time);
    
    header("Location: templates/appointments.php");
    echo $response;
} else {
    echo "Invalid request method.";
}
?>
