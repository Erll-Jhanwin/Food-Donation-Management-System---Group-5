<?php

// Include database connection and User class
require_once 'dbConnection.php';
require_once 'crudOperation.php';

$database = new Database();
$db = $database->getConnect();

$user = new User($db);

if (isset($_GET['id'])) {
    $userId = $_GET['id'];
    $user->updateDonation($userId);
}
header("Location:dashboard.php");
?>