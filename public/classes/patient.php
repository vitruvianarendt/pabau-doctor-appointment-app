<?php
class Patient
{
    private $conn;

    public function __construct($db)
    {
        $this->conn = $db;
    }

    public function register(
        $email,
        $username,
        $password,
        $confirmPassword,
        $name,
        $surname,
        $personalId,
        $phoneNumber
    ) {
        // Validate input
        if (
            empty($email) ||
            empty($username) ||
            empty($password) ||
            empty($confirmPassword) ||
            empty($name) ||
            empty($surname) ||
            empty($personalId) ||
            empty($phoneNumber)
        ) {
            return "All fields are required";
        }

        if ($password !== $confirmPassword) {
            return "Password and Confirm Password do not match";
        }

        // Hash the password
        $hashedPassword = password_hash($password, PASSWORD_DEFAULT);

        // Prepare SQL statement and insert into the database
        $sql =
            "INSERT INTO patient (email, username, password, name, surname, personal_id, phone_number) VALUES (?, ?, ?, ?, ?, ?, ?)";
        $stmt = $this->conn->prepare($sql);
        $stmt->bind_param(
            "sssssss",
            $email,
            $username,
            $hashedPassword,
            $name,
            $surname,
            $personalId,
            $phoneNumber
        );

        if ($stmt->execute()) {
            return "Registration successful";
        } else {
            return "Registration failed";
        }
    }

    public function authenticate($username, $password)
    {
        $sql = "SELECT patient_id, password FROM patient WHERE username = ?";
        $stmt = $this->conn->prepare($sql);
        $stmt->bind_param("s", $username);

        if ($stmt->execute()) {
            $result = $stmt->get_result();

            if ($result->num_rows === 1) {
                $row = $result->fetch_assoc();
                $hashedPassword = $row["password"];

                if (password_verify($password, $hashedPassword)) {
                    $userId = $row["patient_id"];
                    return $userId;
                }
            }
        }
        return false;
    }
}
?>
