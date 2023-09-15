<?php
// Include the database connection file
include("../includes/db_connection.php");

if ($_SERVER["REQUEST_METHOD"] === "POST") {
    
    // Get username and password from the POST request
    $username = $_POST["username"]; 
    $userInputPassword = $_POST["password"]; 

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
                // Retrieve and use the user_id for authenticated user
                $userId = $row["patient_id"];

                // Respond with a JSON object indicating success and the user ID
                echo json_encode(["userId" => $userId]);
                exit(); // Exit the script to prevent further execution
            } else {
                // Login failed due to passwords not matching
                echo json_encode(["error" => "Login failed. Please check your username and password. The password does not match."]);
                exit();
            }
        } else {
            // Username does not exist
            echo json_encode(["error" => "Login failed. Username does not exist."]);
            exit();
        }
    } else {
        // Query execution failed; handle the error
        echo json_encode(["error" => "An error occurred while processing your request."]);
        exit();
    }

    // Close the prepared statement and the database connection
    $stmt->close();
    $conn->close();
} else {
    echo json_encode(["error" => "Invalid request method."]);
    exit();
}
?>
