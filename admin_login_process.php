<?php


require_once 'dbConnection.php';
require_once 'crudOperation.php';

$database = new Database();
$db = $database->getConnect();

$user = new User($db);
$stmt = $user->readAdmin();
$num = $stmt->rowCount();


$username = htmlspecialchars(trim($_POST['username']));
$password = htmlspecialchars(trim($_POST['password']));

if($num > 0) {
    while ($row = $stmt->fetch(PDO::FETCH_ASSOC)){
        if($username == htmlspecialchars($row['Username']) && $password == htmlspecialchars($row['Password'])){
            header('Location:reports.php');
        }
    }
}



?>