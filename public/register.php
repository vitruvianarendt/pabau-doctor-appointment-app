<?php
// Include the database connection
include("../includes/db_connection.php");
// Include the User class
include("classes/patient.php");

// Check form submission
if ($_SERVER["REQUEST_METHOD"] == "POST") {

    $patient = new Patient($conn);
    // Get user input
    $email = $_POST["email"];
    $username = $_POST["username"];
    $password = $_POST["password"];
    $confirm_password = $_POST["confirmpassword"];
    $name = $_POST["name"];
    $surname = $_POST["surname"];
    $personal_id = $_POST["personal_id"];
    $phone_number = $_POST["phone_number"];

    // Call the register method
    $result = $patient->register($email, $username, $password, $confirm_password, $name, $surname, $personal_id, $phone_number);

    if ($result === "Registration successful") {
        // Display a JavaScript alert message and then redirect to login page if registration is successful
        echo '<script>alert("Registration successful");</script>';
        echo '<script>window.location.href = "templates/login.html";</script>';
        exit();
    } else {
        // Display a JavaScript alert message and then redirect to register page if registration is not successful
        echo '<script>alert("' . urlencode($result) . '");</script>';
        echo '<script>window.location.href = "templates/register.html";</script>';
        exit();
    } 
}
?>
