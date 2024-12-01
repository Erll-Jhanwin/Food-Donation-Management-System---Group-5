<?php

session_start();

if(!isset($_SESSION["email"])){
    header("location:login.php");
}else{
    header("location:dashboard.php");
}

require_once 'dbConnection.php';
require_once 'crudOperation.php';

$database = new Database();
$db = $database->getConnect();

$user = new User($db);
$stmt = $user->read();
$num = $stmt->rowCount();

$email = htmlspecialchars(trim($_POST['email']));
$password = htmlspecialchars(trim($_POST['password']));

if($num > 0) {
    while ($row = $stmt->fetch(PDO::FETCH_ASSOC)){
        if($email == htmlspecialchars($row['Email']) && $password == htmlspecialchars($row['Password'])){
            $_SESSION["email"] = $email;
            $_SESSION["phone"] = htmlspecialchars(trim($row['Phone']));
            $_SESSION["name"] = htmlspecialchars(trim($row['Name']));

            header('Location:dashboard.php');
            exit();
        }
    }
}









?>