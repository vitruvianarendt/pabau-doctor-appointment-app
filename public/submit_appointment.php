<?php
// Include the database connection file
include("../includes/db_connection.php");
// Include the User class
include("classes/appointment.php");

if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $appointment = new Appointment($conn);

    $start_time = $_POST["start_time"];
    $end_time = $_POST["end_time"];
    $status = $_POST["status"];
    $patient_id = $_POST["patient_id"];
    $doctor_id = $_POST["doctor_id"];
    $service_id = $_POST["service_id"];
    $special_requirements = $_POST["special_requirements"];
    $medical_conditions = $_POST["medical_conditions"];

    $response = $appointment->createAppointment($start_time, $end_time, $status, $patient_id, $doctor_id, $service_id, $special_requirements, $medical_conditions);

    echo $response;
} else {
    echo "Invalid request method.";
}
?>
