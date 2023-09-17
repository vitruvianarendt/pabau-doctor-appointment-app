<!DOCTYPE html>
<html>
<head>
    <title>User Appointments</title>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="../fetch_appointments.js"></script>
</head>
<body>
    <h1>User Appointments</h1>
    <ul id="appointmentsList">
    </ul>
    <button id="newAppointmentButton">New Appointment</button>

    <script>
        $('#newAppointmentButton').on('click', function() {
            window.location.href = 'new_appointment.php'; 
        });
    </script>
</body>
</html>
