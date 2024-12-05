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
    </style>

</head>
<body>

    <header>
        <div class="container">
            <div class="header-content">
                <div class="logo"><span>Food</span> Reports</div>
                <nav>
                    <ul>
                        <li><a href="dashboard.php">Home</a></li>
                        <!-- <li><a href="reports.php">Reports</a></li> -->
                        <!-- <li><a href="donate.php">Donate</a></li> -->
                        <li><a href="userslist.php">See all the Users</a></li>
                        <li><a href="donationsList.php">See all Donation</a></li>
                        <li><a href="pickupDonation.php">Pickup Donation</a></li>
                    </ul>
                </nav>
            </div>
        </div>
    </header>

    
    
    <!-- Food Donation Report -->
    <div class="report  w-100">
    <!-- Month and Year Selection Form -->
        <form action="" method="GET" class="formUser mt-5 mb-5 p-5">

            <h1>Food Donations Report</h1><br>

            <label for="month">Select Month:</label>
            <select name="month" id="month" class="form-control w-50">
                <option value="1">January</option>
                <option value="2">February</option>
                <option value="3">March</option>
                <option value="4">April</option>
                <option value="5">May</option>
                <option value="6">June</option>
                <option value="7">July</option>
                <option value="8">August</option>
                <option value="9">September</option>
                <option value="10">October</option>
                <option value="11">November</option>
                <option value="12">December</option>
            </select><br>

            <label for="year">Select Year:</label>
            <select name="year" id="year" class="form-control w-50">
                <option value="2025">2025</option>
                <option value="2024">2024</option>
                <option value="2023">2023</option>
                <option value="2022">2022</option>
            </select><br>
            <input type="submit" value="Generate Report" class="btn btn-primary">
        </form>

        <div class="table-report mb-5 p-3">
            <?php
            // Check if month and year are selected and display report
            if (isset($_GET['month']) && isset($_GET['year'])) {
                $month = $_GET['month'];
                $year = $_GET['year'];

                // Call the function to fetch donations for the selected month and year
                require_once 'dbConnection.php';
                require_once 'crudOperation.php';

                $database = new Database();
                $db = $database->getConnect();

                $user = new User($db);
                $stmt = $user->readDonationsByMonth($month, $year);
                $num = $stmt->rowCount();

                echo "<h3>Donations for " . date("F", mktime(0, 0, 0, $month, 10)) . " " . $year . ":</h3>";
                $totalNum = $user->countDonated($month, $year);
                $totalPickup = $user->countPickupByMonth($month, $year);

                $result = $user->countMealTypeByMonth($month, $year);


                if ($num > 0) {

                    echo "<table class='table table-bordered'>
                    <thead>
                        <tr>
                            <th colspan='2' style='text-align:center;background-color:#d1d1d1;'>Reports for this Month</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td colspan='2'>The total accumulated donation for the month of ".date("F", mktime(0, 0, 0, $month, 10))." is ". $totalNum. "</td>
                        </tr>
                        <tr>
                            <td colspan='2'>Number of donations that already picked up: ". $totalPickup . "</td>
                        </tr>
                    </tbody>

                    <thead>
                        <tr>
                            <th colspan='2' style='text-align:center;background-color:#d1d1d1;'>Meal Type</th>
                        </tr>
                        <tr>
                            <th>Category</th>
                            <th>Count</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td>Vegetables</td>
                            <td>".$result['vegetables']."</td>
                        </tr>
                        <tr>
                            <td>Non-Vegetables</td>
                            <td>".$result['nonvegetables']."</td>
                        </tr>
                        <tr>
                            <td>Fruits</td>
                            <td>".$result['fruits']."</td>
                        </tr>
                    </tbody>
                </table><br><br>";



                    // echo '<table id="userTable3" class="display">';
                    // echo '<thead>';
                    // echo '<tr>';
                    // // echo '<th>ID</th>';
                    // echo '<th>Food Name</th>';
                    // echo '<th>Meal Type</th>';
                    // echo '<th>Food Category</th>';
                    // echo '<th>Food Quantity</th>';
                    // echo '<th>Date to Pickup</th>';
                    // echo '<th>Status</th>';
                    // echo '</tr>';
                    // echo '</thead>';
                    // echo '<tbody>';

                    // while ($row = $stmt->fetch(PDO::FETCH_ASSOC)){
                    //     echo "<tr>";
                    //     // echo "<td>" . htmlspecialchars($row['Id']) . "</td>";
                    //     echo "<td>" . htmlspecialchars($row['FoodName']) . "</td>";
                    //     echo "<td>" . htmlspecialchars($row['MealType']) . "</td>";
                    //     echo "<td>" . htmlspecialchars($row['FoodCategory']) . "</td>";
                    //     echo "<td>" . htmlspecialchars($row['FoodQuantity']) . "</td>";
                    //     echo "<td>" . htmlspecialchars($row['DateToPickup']) . "</td>";
                    //     echo "<td>" . htmlspecialchars($row['Status']) . "</td>";
                    //     echo "</tr>";
                    // }

                    // echo '</tbody>';
                    // echo '</table>';

                    
                } else {
                echo "<p>No donations found for the selected month and year.</p>";
                }
            }
            ?>
        </div>
    </div>
</body>
</html>