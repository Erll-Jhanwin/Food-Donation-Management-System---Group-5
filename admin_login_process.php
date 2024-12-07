<?php

require_once 'dbConnection.php'; 
require_once 'classAdmin.php'; 

// Create a new Database object and get the connection
$database = new Database();
$db = $database->getConnect(); // This will return the PDO connection

// Create an Admin object with the database connection
$admin = new Admin($db);

// Call the readAdmin method to fetch admin data


// Get username and password from the POST request
$username = htmlspecialchars(trim($_POST['username']));
$password = htmlspecialchars(trim($_POST['password']));

// $stmt = $admin->readAdmin($username, $password);

if ($admin->readAdmin($username, $password)) {
    // Redirect to the dashboard on successful login
    header('Location: reports.php');
    exit();
} else {
    // If login failed, show an error message using SweetAlert
    echo "
    <!DOCTYPE html>
    <html lang='en'>
    <head>
        <meta charset='UTF-8'>
        <meta name='viewport' content='width=device-width, initial-scale=1.0'>
        <title>Login Failed</title>
        <script src='https://cdn.jsdelivr.net/npm/sweetalert2@11'></script>
    </head>
    <body>
        <script>
        Swal.fire({
            title: 'Error!',
            text: 'Invalid email or password!',
            icon: 'error',
            confirmButtonText: 'Try Again'
        }).then((result) => {
            if (result.isConfirmed) {
                window.location.href = 'admin_login.php'; // Redirect back to admin login page
            }
        });
        </script>
    </body>
    </html>";
    exit(); // Stop further script execution
}

// If the username and password do not match, handle the error here
echo "Invalid login credentials.";





?>




