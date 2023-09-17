<?php
class Appointment {

    private $conn;
    
    public function __construct($conn) {
        $this->conn = $conn;
    }

    public function createAppointment($start_time, $end_time, $status, $patient_id, $doctor_id, $service_id, $special_requirements, $medical_conditions) {
        // Check for overlapping appointments - Not implemented
        if ($this->isAppointmentOverlapping($doctor_id, $start_time, $end_time)) {
            return "Error: The selected time slot is already booked by another patient.";
        } else {
            $sql = "INSERT INTO appointment (start_time, end_time, status, patient_id, doctor_id, service_id, special_requirements, medical_conditions) 
                    VALUES (?, ?, ?, ?, ?, ?, ?, ?)";
            $stmt = $this->conn->prepare($sql);
            $stmt->bind_param("ssssssss", $start_time, $end_time, $status, $patient_id, $doctor_id, $service_id, $special_requirements, $medical_conditions);
            if ($stmt->execute()) {
                return "Appointment created successfully.";
            } else {
                return "Error: " . $stmt->error;
            }
        }
    }

    private function isAppointmentOverlapping($doctor_id, $start_time, $end_time) {
        // $sqlOverlapCheck = "SELECT * FROM appointment WHERE doctor_id = ?
        //     AND ((start_time <= ? AND end_time >= ?) OR (start_time <= ? AND end_time >= ?))";
        // $stmtOverlapCheck = $this->conn->prepare($sqlOverlapCheck);
        // $stmtOverlapCheck->bind_param("issis", $doctor_id, $start_time, $start_time, $end_time, $end_time);
        // $stmtOverlapCheck->execute();
        // $resultOverlapCheck = $stmtOverlapCheck->get_result();
        // return ($resultOverlapCheck->num_rows > 0);
        return FALSE;
    }

    public function getUserAppointments($userId) {
        $sql = "SELECT * FROM appointment WHERE patient_id = ?";
        $stmt = $this->conn->prepare($sql);
        $stmt->bind_param("i", $userId);
        $stmt->execute();
        $result = $stmt->get_result();
        $appointments = [];
        while ($row = $result->fetch_object()) {
            $appointments[] = $row;
        }
        return $appointments;
    }

    public function deleteAppointment($userId, $appointmentId) {
        $sql = "DELETE FROM appointment WHERE appointment_id = ? AND patient_id = ?";
        $stmt = $this->conn->prepare($sql);
        $stmt->bind_param("ii", $appointmentId, $userId);
        if ($stmt->execute()) {
            return "Appointment deleted successfully.";
        } else {
            return "Error deleting appointment: " . $stmt->error;
        }
    }

    public function editAppointment($appointment_id, $user_id, $start_time, $end_time) {
        // Check for overlapping appointments - Not implemented
        if ($this->isAppointmentOverlapping(1, $start_time, $end_time)) {
            return "Error: The selected time slot is already booked by another patient.";
        } else {
            $sql = "UPDATE appointment SET start_time = ?, end_time = ? WHERE appointment_id = ? AND patient_id = ?";
            $stmt = $this->conn->prepare($sql);
            $stmt->bind_param("ssii", $start_time, $end_time, $appointment_id, $user_id);
            if ($stmt->execute()) {
                return "Appointment updated successfully.";
            } else {
                return "Error updating appointment: " . $stmt->error;
            }
        }
    }

}
?>
