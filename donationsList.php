<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>

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




    <script>
        $(document).ready(function() {
            $('#userTable2').DataTable();
        });
    </script>


</head>
<body>

    <!-- Table for Donation-->
    <div class="tables m-5 p-2" style="font-size:12px;">
        <h2>List of food to Donate</h2>
        <table id="userTable2" class="display">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Food Name</th>
                    <th>Meal Type</th>
                    <th>Food category</th>
                    <th>Food Quantity</th>
                    <th>Email</th>
                    <th>Phone</th>
                    <th>Date to Pickup</th>
                    <th>FoodDonatorName</th>
                    <th>DonateDateCreation</th>
                    <th>Status</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody>
                <?php
                require_once 'dbConnection.php';
                require_once 'crudOperation.php';

                $database = new Database();
                $db = $database->getConnect();

                $user = new User($db);
                $stmt = $user->readForDonation();
                $num = $stmt->rowCount();

                if($num > 0) {
                    while ($row = $stmt->fetch(PDO::FETCH_ASSOC)){
                        echo "<tr>";
                        echo "<td>" .(isset($row['Id']) ? htmlspecialchars($row['Id']) : ''). "</td>";
                        echo "<td>" .(isset($row['FoodName']) ? htmlspecialchars($row['FoodName']) : ''). "</td>";
                        echo "<td>" .(isset($row['MealType']) ? htmlspecialchars($row['MealType']) : ''). "</td>";
                        echo "<td>" .(isset($row['FoodCategory']) ? htmlspecialchars($row['FoodCategory']) : ''). "</td>";
                        echo "<td>" .(isset($row['FoodQuantity']) ? htmlspecialchars($row['FoodQuantity']) : ''). "</td>";
                        echo "<td>" .(isset($row['Email']) ? htmlspecialchars($row['Email']) : ''). "</td>";
                        echo "<td>" .(isset($row['PhoneNumber']) ? htmlspecialchars($row['PhoneNumber']) : ''). "</td>";
                        echo "<td>" .(isset($row['DateToPickup']) ? htmlspecialchars($row['DateToPickup']) : ''). "</td>";
                        echo "<td>" .(isset($row['FoodDonatorName']) ? htmlspecialchars($row['FoodDonatorName']) : ''). "</td>";
                        echo "<td>" .(isset($row['DonateDateCreation']) ? htmlspecialchars($row['DonateDateCreation']) : ''). "</td>";
                        echo "<td>" .(isset($row['Status']) ? htmlspecialchars($row['Status']) : ''). "</td>";
                        echo "<td><a href='delete.php?donation_id=" . $row['Id'] . "' id='link'>Delete</a></td>";
                        echo "</tr>";
                    }
                }

                ?>
    
            </tbody>
        </table>
    </div>
    
</body>
</html>