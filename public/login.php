<?php
// Include the database connection file
include("../includes/db_connection.php");
// Include the User class
include("classes/patient.php");

// Check form submission
if ($_SERVER["REQUEST_METHOD"] === "POST") {

    $patient = new Patient($conn);

    // Get username and password from the POST request
    $username = $_POST["username"]; 
    $password = $_POST["password"]; 
    $userId = $patient->authenticate($username, $password);

    if ($userId !== false) {
        echo json_encode(["userId" => $userId]);
        exit();
    } else {
        echo json_encode(["error" => "Login failed. Please check your username and password."]);
        exit();
    }

} else {
    echo json_encode(["error" => "Invalid request method."]);
    exit();
}
?>
