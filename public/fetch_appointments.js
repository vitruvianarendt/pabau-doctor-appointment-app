$(document).ready(function() {
    // Retrieve the user ID from localStorage
    const userId = JSON.parse(localStorage.getItem("userId"));

    // Check if userId exists and is not null
    if (userId) {
        // Make an AJAX GET request to the PHP script with 'userId' as a parameter
        $.ajax({
            url: '../fetch_appointments.php',
            method: 'GET',
            data: {
                userId: userId
            },
            dataType: 'json',
            success: function(response) {

                const appointmentsList = document.getElementById('appointmentsList');
                appointmentsList.innerHTML = '';

                // Iterate over the response (array of appointments) and create list items
                response.forEach(function(appointment) {
                    const listItem = document.createElement('li');

                    const editButton = document.createElement('button');
                    editButton.textContent = 'Edit';
                    editButton.addEventListener('click', function() {
                        const editUrl = `edit_appointment_form.php?user_id=${userId}&appointment_id=${appointment.appointment_id}`;
                        window.location.href = editUrl;
                    });

                    const cancelButton = document.createElement('button');
                    cancelButton.textContent = 'Cancel';
                    cancelButton.addEventListener('click', function() {
                        $.ajax({
                            url: '../delete_appointment.php',
                            method: 'POST',
                            data: {
                                appointmentId: appointment.appointment_id,
                                userId: userId
                            },
                            dataType: 'text',
                            success: function(response) {
                                console.log('Appointment deleted');
                                window.location.reload();
                            },
                            error: function(xhr, status, error) {
                                console.error('Error:', error);
                            }
                        });
                    });
                    

                    // Create a text node with appointment details
                    const appointmentText = document.createTextNode(`Start Time: ${appointment.start_time}, End Time: ${appointment.end_time}`);

                    // Append buttons and text to the list item
                    listItem.appendChild(editButton);
                    listItem.appendChild(cancelButton);
                    listItem.appendChild(appointmentText);

                    // Append the list item to the appointments list
                    appointmentsList.appendChild(listItem);
                });
            },
            error: function(xhr, status, error) {
                console.error('Error:', error);
            }
        });
    }
});