<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title></title>
     <!-- DataTables CSS -->
     <link rel="stylesheet" href="https://cdn.datatables.net/1.11.3/css/jquery.dataTables.min.css">
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
        $(document).ready(function() {
            $('#userTable3').DataTable();
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
        .pickup{
            box-shadow: rgba(100, 100, 111, 0.2) 0px 7px 29px 0px;
            border-radius: 10px;
        }
       
    </style>
</head>
<body>

    <header>
        <div class="container">
            <div class="header-content">
                <div class="logo"><span>Food</span> Reports</div>
                <nav>
                    <ul>
                        <!-- <li><a href="reviewPickuped.php">Review All Pickuped</a></li> -->
                        <li><a href="reports.php">Back</a></li>
                    </ul>
                </nav>
            </div>
        </div>
    </header>

    <?php
    require_once 'dbConnection.php';
    require_once 'crudOperation.php';

    $database = new Database();
    $db = $database->getConnect();

    $user = new User($db);
    $stmt = $user->readPickup();
    $num = $stmt->rowCount();

    if ($num > 0) {
        while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
            echo "<div class='pickup p-4 m-5'>
                    <p>FoodName: " . (isset($row['FoodName']) ? htmlspecialchars($row['FoodName']) : '') . "</p>
                    <p>FoodQuantity: " . (isset($row['FoodQuantity']) ? htmlspecialchars($row['FoodQuantity']) : '') . "</p>
                    <p>DateToPickup: " . (isset($row['DateToPickup']) ? htmlspecialchars($row['DateToPickup']) : '') . "</p>
                    <p>Status: " . (isset($row['Status']) ? htmlspecialchars($row['Status']) : '') . "</p>
                    <p>Deliver To: " . (isset($row['DeliverTo']) ? htmlspecialchars($row['DeliverTo']) : '') . "</p>
                    <p class='btn btn-primary'>Already picked up</a>
                </div>";
        }
    }else{
        echo "No Donations have pickup yet";
    }
    ?>
    
</body>
</html>