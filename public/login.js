$(document).ready(function() {
    $("#loginForm").submit(function(event) {
        event.preventDefault();

        const username = $("#username").val();
        const password = $("#password").val();

        // Send credentials to login.php script for authentication
        $.post('../login.php', {
            username: username,
            password: password
        }, function(data) {
            try {
                data = JSON.parse(data); // Parse the JSON response
            } catch (error) {
                console.error("Error parsing JSON: " + data);
            }

            // Check if data.userId is defined
            if (data && data.userId !== undefined) {
                // Save the user ID in localStorage 
                localStorage.setItem("userId", data.userId);

                // Redirect to the appointments page
                window.location.href = "../templates/appointments.php";
            } else {
                console.log(data);
                alert("Login failed. Please check your username and password.");
            }
        }).fail(function() {
            alert("An error occurred while processing your request.");
        });
    });
});