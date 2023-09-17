
# Pabau - Medical Appointment Application

A simple PHP application for medical appointments for the Pabau PHP Developer position.



## Run Locally

### Install XAMPP

* Install and setup `XAMPP` package
  * Download `XAMPP` from here https://www.apachefriends.org/download.html
  * Create `XAMPP` folder manually in drive C like this `C:\xampp`
  * Start Installation of the downloaded `XAMPP' package 
  * Verify that Apache and MySQL packages are selected
  * Verify that `c:\xampp` directory is selected
  * & Complete the installation until finish.

Start XAMPP services (Apache and MySQL)

### Clone the project 

Go to the `C:\xampp\htdocs` directory, and create another folder `appointment-app`
```bash
  cd appointment-app
```
```bash
  git clone https://github.com/vitruvianarendt/pabau-doctor-appointment-app.git
``` 
Go to the project directory and open the project in the desired IDE (e.g. Visual Studio Code) to browse the code

```bash
  code .
```
### Open the project on a browser

Go to `http://localhost/phpmyadmin/` to access the admin panel and `http://localhost:8012/public/templates/register.php` to open the register form and start the simple flow of the website.
The database export and schema are located in the `database_files` folder, and don't forget to update the database credentials in the `includes` folder if needed.