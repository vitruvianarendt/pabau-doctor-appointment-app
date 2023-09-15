<?php
// Include the database connection file
include("../includes/db_connection.php");

if ($_SERVER["REQUEST_METHOD"] === "POST") {
    // Check if this script is accessed via a POST request (form submission)

    // Get username and password from the POST request
    $username = $_POST["username"]; // Replace with the user's provided username
    $userInputPassword = $_POST["password"]; // Replace with the user's provided password

    // Retrieve the hashed password from the database based on the provided username
    $sql = "SELECT patient_id, password FROM patient WHERE username = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("s", $username);

    if ($stmt->execute()) {
        $result = $stmt->get_result();

        if ($result->num_rows === 1) {
            $row = $result->fetch_assoc();
            $hashedPassword = $row["password"];

            // Compare the provided password with the hashed password from the database
            if (password_verify($userInputPassword, $hashedPassword)) {
                // Passwords match; user is authenticated
                // Retrieve and use the user_id as needed
                $userId = $row["patient_id"];

                // Respond with a JSON object indicating success and the user ID
                echo json_encode(["userId" => $userId]);
                exit(); // Exit the script to prevent further execution
            } else {
                // Passwords do not match; login failed
                // Respond with a JSON object indicating login failure
                echo json_encode(["error" => "Login failed. Please check your username and passworbbbbbbd."]);
                exit();
            }
        } else {
            // No user found with the provided username; login failed
            // Respond with a JSON object indicating login failure
            echo json_encode(["error" => "Login failed. Please check your username and passwordaaaaaaa."]);
            exit();
        }
    } else {
        // Query execution failed; handle the error
        // Respond with a JSON object indicating an error
        echo json_encode(["error" => "An error occurred while processing your request."]);
        exit();
    }

    // Close the prepared statement and the database connection
    $stmt->close();
    $conn->close();
} else {
    // If this script is not accessed via a POST request, handle it accordingly
    // For example, you can display an error message or redirect to a login page
    echo json_encode(["error" => "Invalid request method."]);
    exit();
}
?>
