<!DOCTYPE html>
<html>
<head>
    <title>Edit Appointment</title>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="../edit_appointment.js"></script>
</head>
<body>
    <h1>Edit Appointment</h1>
    <form id="editAppointmentForm" action="../edit_appointment.php" method="POST">
        <input type="hidden" id="user_id" name="user_id" value="15">
        
        <input type="hidden" id="appointment_id" name="appointment_id" value="3">
    
        <label for="start_time">Start Time:</label>
        <input type="datetime-local" id="start_time" name="start_time" required><br><br>

        <label for="end_time">End Time:</label>
        <input type="datetime-local" id="end_time" name="end_time" required><br><br>

        <input type="submit" value="Save Changes">
    </form>
</body>
</html>
