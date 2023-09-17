$(document).ready(function() {

    // Define working hours and days
    const workingHoursStart = 9; // 9 AM
    const workingHoursEnd = 17; // 5 PM
    const workingDays = [1, 2, 3, 4, 5];

    function isWorkingDay(date) {
        const dayOfWeek = date.getDay();
        return workingDays.includes(dayOfWeek);
    }

    // Function to check if it's a working hour (9 AM - 5 PM)
    function isWorkingHour(date) {
        const hour = date.getHours();
        return hour >= workingHoursStart && hour <= workingHoursEnd;
    }

    // Function to display a prompt
    function showPrompt() {
        const startTime = new Date($('#start_time').val());
        const endTime = new Date($('#end_time').val());

        if (!isWorkingDay(startTime) || !isWorkingHour(startTime) ||
            !isWorkingDay(endTime) || !isWorkingHour(endTime)) {
            alert('Please select a valid date and time within working hours (Mon-Fri, 9 AM - 5 PM).');
        }
    }

    // Attach focus and blur event listeners to the fields
    $('#start_time').on('focus', function() {
        startInputFocused = true;
    });

    $('#start_time').on('blur', function() {
        startInputFocused = false;
        showPrompt();
    });

    $('#end_time').on('focus', function() {
        endInputFocused = true;
    });

    $('#end_time').on('blur', function() {
        endInputFocused = false;
        showPrompt();
    });

    // Make an AJAX request to fetch the doctor from the database
    $.ajax({
        url: '../fetch_doctor.php',
        method: 'GET',
        dataType: 'json',
        success: function(data) {
            $('#doctor_id').val(data.doctor_id);
        },
        error: function(xhr, status, error) {
            console.error("Error fetching doctor ID: " + error);
        }
    });

    // Make an AJAX request to fetch services from the database
    $.ajax({
        url: '../fetch_services.php',
        method: 'GET',
        dataType: 'json',
        success: function(data) {
            // Populate services dropdown
            var serviceDropdown = $('#service_id');
            $.each(data, function(index, service) {
                serviceDropdown.append($('<option>', {
                    value: service.service_id,
                    text: service.name
                }));
            });
        },
        error: function(xhr, status, error) {
            console.error("Error fetching services: " + error);
        }
    });

    // Autofill user id from localstorage (as saved during login)
    var userId = localStorage.getItem("userId");
    if (userId !== null) {
        $('#patient_id').val(userId);
    } else {
        $('#result').html("User ID not found in localStorage. Please log in first.");
    }

    function sendAppointmentData() {
        // Gather the form data
        const formData = {
            start_time: $("#start_time").val(),
            end_time: $("#end_time").val(),
            status: $("#status").val(),
            patient_id: $("#patient_id").val(),
            doctor_id: $("#doctor_id").val(),
            service_id: $("#service_id").val(),
            special_requirements: $("#special_requirements").val(),
            medical_conditions: $("#medical_conditions").val(),
        };

        // Send data to the PHP file
        $.ajax({
            url: '../submit_appointment.php',
            method: 'POST',
            data: formData,
            dataType: 'text',
            success: function(response) {
                console.log('Response from PHP file:', response);
                window.location.href = "../templates/appointments.php";
            },
            error: function(xhr, status, error) {
                console.error('Error:', error);
            }
        });
    }
    // Attach a submit event listener to the form
    $("#appointmentForm").submit(function(event) {
        event.preventDefault();

        const startTimeInput = $("#start_time");
        const endTimeInput = $("#end_time");

        const selectedStartTime = new Date(startTimeInput.val());
        const selectedEndTime = new Date(endTimeInput.val());

        if (!isWorkingDay(selectedStartTime) || !isWorkingHour(selectedStartTime) ||
            !isWorkingDay(selectedEndTime) || !isWorkingHour(selectedEndTime)) {
            alert("Please select a valid date and time within working hours (Mon-Fri, 9 AM - 5 PM).");
            return;
        }
        sendAppointmentData();
    });
});