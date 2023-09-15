<?php
// Include the database connection
include("../includes/db_connection.php");

// Check form submission
if ($_SERVER["REQUEST_METHOD"] == "POST") {

    // Get user input
    $email = $_POST["email"];
    $username = $_POST["username"];
    $password = $_POST["password"];
    $confirm_password = $_POST["confirmpassword"];
    $name = $_POST["name"];
    $surname = $_POST["surname"];
    $personal_id = $_POST["personal_id"];
    $phone_number = $_POST["phone_number"];

    // Check if the passwords match
    if ($password !== $confirm_password) {
        
        // Redirect the user back to the registration page with an error message
        header("Location: register.html?error=Password+and+Confirm+Password+do+not+match");
        exit(); 
    } else {

        // Hash the password for basic security
        $hashedPassword = password_hash($password, PASSWORD_DEFAULT);

        // Prepare SQL statement and insert into the database
        $sql = "INSERT INTO patient (email, username, password, name, surname, personal_id, phone_number) VALUES (?, ?, ?, ?, ?, ?, ?)";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("sssssss", $email, $username, $hashedPassword, $name, $surname, $personal_id, $phone_number);

        if ($stmt->execute()) {
            // Registration successful
            header("Location: templates/login.html");
            exit();
        } else {
            // Redirect the user back to the registration page with an error message
            header("Location: register.html?error=Registration+failed");
            exit();
        }

        // Close the prepared statement and the database connection
        $stmt->close();
        $conn->close();
    }
}
?>
