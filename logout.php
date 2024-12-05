<?php
// Start the session
session_start();  

// Unset all session variables
session_unset();      
session_destroy();

// Redirect to login page
header('Location: login.php');
exit();
?>