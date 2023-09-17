<!DOCTYPE html>
<html>
<head>
    <title>Register</title>
    <link rel="stylesheet" type="text/css" href="../css/global.css">
</head>
<body>
    <h2>Register</h2>
    <form action="../register.php" method="POST">
        <label for="email">Email:</label>
        <input type="email" id="email" name="email"><br><br>
        
        <label for="username">Username:</label>
        <input type="text" id="username" name="username" required><br><br>
        
        <label for="password">Password:</label>
        <input type="password" id="password" name="password" required><br><br>
        
        <label for="confirmpassword">Confirm Password:</label>
        <input type="password" id="confirmpassword" name="confirmpassword" required><br><br>
        
        <label for="name">Name:</label>
        <input type="text" id="name" name="name" required><br><br>
        
        <label for="surname">Surname:</label>
        <input type="text" id="surname" name="surname" required><br><br>
        
        <label for="personal_id">Personal ID:</label>
        <input type="text" id="personal_id" name="personal_id" required><br><br>
        
        <label for="phone_number">Phone Number:</label>
        <input type="text" id="phone_number" name="phone_number" required><br><br>
        
        <input type="submit" value="Register">
    </form>
</body>
</html>
