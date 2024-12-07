<?php

session_start();

if(!isset($_SESSION["email"])){
    header("location:login.php");
}

require_once 'dbConnection.php';
require_once 'crudOperation.php';
    
$database = new Database();
$db = $database->getConnect();
$user = new User($db);

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Welcome</title>

    <!-- DataTables CSS -->
    <link rel="stylesheet" href="https://cdn.datatables.net/1.11.3/css/jquery.dataTables.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/fomantic-ui/2.9.2/semantic.min.css">
    <!-- jQuery -->
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <!-- DataTables JS -->
    <script src="https://cdn.datatables.net/1.11.3/js/jquery.dataTables.min.js"></script>
    <!-- SweetAlert2 CSS -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/sweetalert2@11/dist/sweetalert2.min.css">
    <!-- SweetAlert2 JS --> 
     <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
     <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
     <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
     <link rel="stylesheet" href="style.css">
     
     <script>
        new DataTable('#userTable');
        $(document).ready(function() {
            $('#userTable').DataTable();
        });
    </script>

    <style>
        @import url('https://fonts.googleapis.com/css2?family=JetBrains+Mono:ital,wght@0,100..800;1,100..800&display=swap');
        *{
            font-family: "JetBrains Mono", monospace;
            font-optical-sizing: auto;
            font-weight: 500;
            font-style: normal;
        }

        .summary{
            display: flex;
            align-items: center;
            justify-content: center;
            box-shadow: rgba(100, 100, 111, 0.2) 0px 7px 29px 0px;
            border-radius: 10px;
        }
        .head-t{
            background-color:blue;
            width: 100%;
            border-top-left-radius: 10px;
            border-top-right-radius: 10px;
            color: white;
        }

        .content-sum{
            border: solid 2px blue;
            margin: 10px;
            height: 100px;
            width: 75%;
            border-radius: 12px;
        }

        .value{
            padding: 10px;
        }

        .big{
            font-weight: bold;
            font-size: large;
        }


    </style>

</head>
<body>

    <header>
        <div class="container">
            <div class="header-content">
                <div class="logo"><span>Welcome</span> User</div>
                <nav>
                    <ul>
                    <!-- <li><a href="dashboard.php">Home</a></li> -->
                    <li><a href="donate.php">Donate</a></li>
                    </ul>
                </nav>
            </div>
        </div>
    </header>

    <div class="summary m-5">
        <div class="content-sum">
             <div class="head-t p-2">
                <p class="big">Total Donation</p>
             </div>
             <div class="value">
                <p class="big">
                    <?php
                    $totalNum = $user->countDonatedByUser($_SESSION["name"],$_SESSION["email"]);
                    echo $totalNum;
                    ?>
                </p>
            </div>
        </div>
        <div class="content-sum">
            <div class="head-t p-2">
                <p class="big">Donations that already picked up</p>
            </div>
            <div class="value">
                <p class="big">
                    <?php
                    $totalPickup = $user->countPickup($_SESSION["name"],$_SESSION["email"]);
                    echo $totalPickup;
                    ?>
                </p>
            </div>
        </div>
        <div class="content-sum">
            <div class="head-t p-2">
                <p class="big">To pickup</p>
            </div>
            <div class="value">
                <p class="big">
                    <?php
                    $toPickup = $totalNum - $totalPickup;
                    echo $toPickup;
                    ?>
                </p>
            </div>
        </div>
    </div>
    
    <!-- Table for Donation of user-->
    <div class="tables m-5" style="font-size:14px;">

        <div class="head-title p-3">
            <p class="big">Your Donates</p>
        </div>
        <br><br>
        <div class="p-3">
        <p class="big">List of food that you Donate</p>
            <table id="userTable" class="ui celled table" style="width:100%">
                <thead>
                    <tr>
                        <!-- <th>ID</th> -->
                        <th>Food Name</th>
                        <th>Meal Type</th>
                        <th>Food category</th>
                        <th>Food Quantity</th>
                        <th>Date to Pickup</th>
                        <!-- <th>DonateDateCreation</th> -->
                        <th>Status</th>
                        <th colspan="3">Action</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    require_once 'dbConnection.php';
                    require_once 'crudOperation.php';

                    $database = new Database();
                    $db = $database->getConnect();

                    $user = new User($db);
                    $stmt = $user->login($_SESSION["email"]);
                    $num = $stmt->rowCount();

                    if($num > 0) {
                        while ($row = $stmt->fetch(PDO::FETCH_ASSOC)){
                            echo "<tr>";
                            //echo "<td>" .(isset($row['Id']) ? htmlspecialchars($row['Id']) : ''). "</td>";
                            echo "<td>" .(isset($row['FoodName']) ? htmlspecialchars($row['FoodName']) : ''). "</td>";
                            echo "<td>" .(isset($row['MealType']) ? htmlspecialchars($row['MealType']) : ''). "</td>";
                            echo "<td>" .(isset($row['FoodCategory']) ? htmlspecialchars($row['FoodCategory']) : ''). "</td>";
                            echo "<td>" .(isset($row['FoodQuantity']) ? htmlspecialchars($row['FoodQuantity']) : ''). "</td>";
                            echo "<td>" .(isset($row['DateToPickup']) ? htmlspecialchars($row['DateToPickup']) : ''). "</td>";
                            // echo "<td>" .(isset($row['DonateDateCreation']) ? htmlspecialchars($row['DonateDateCreation']) : ''). "</td>";
                            echo "<td>" .(isset($row['Status']) ? htmlspecialchars($row['Status']) : ''). "</td>";
                            echo "<td><a href='delete.php?donation_id=" . $row['Id'] . "' id='". $row['Id'] ."'>Delete</a></td>";
                            // echo "<td><a href='update.php?id=" . $row['Id'] . "' id='link'>Pick it up</a></td>";
                            echo "</tr>";
                        }
                    }
                    ?>
                </tbody>
            </table><br>
        <a href="logout.php" class="btn btn-primary">Logout</a>
        </div>
    </div>

</body>
</html>