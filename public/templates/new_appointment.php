<!DOCTYPE html>
<html>
<head>
    <title>Appointment Form</title>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="../submit_appointment.js"></script>
</head>
<body>
    <h1>Appointment Form</h1>
    <form id="appointmentForm" action="../appointment.php" method="POST">
        <label for="start_time">Start Time:</label>
        <input type="datetime-local" id="start_time" name="start_time" required><br><br>

        <label for="end_time">End Time:</label>
        <input type="datetime-local" id="end_time" name="end_time" required><br><br>

        <label for="status">Status:</label>
        <input type="text" id="status" name="status" required><br><br>

        <label for="doctor_id">Doctor ID:</label>
        <input type="number" id="doctor_id" name="doctor_id" required><br><br>

        <label for="patient_id">Patient ID:</label>
        <input type="number" id="patient_id" name="patient_id" required><br><br>

        <label for="service_id">Service:</label>
        <select id="service_id" name="service_id" required>
            <option value="">Select a Service</option>
        </select><br><br>

        <label for="special_requirements">Special Requirements:</label>
        <textarea id="special_requirements" name="special_requirements"></textarea><br><br>

        <label for="medical_conditions">Medical Conditions:</label>
        <textarea id="medical_conditions" name="medical_conditions"></textarea><br><br>

        <input type="submit" value="Create Appointment">
    </form>
</body>
</html>