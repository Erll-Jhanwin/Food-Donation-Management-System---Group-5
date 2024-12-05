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

    <script>
        // $(document).ready(function() {
        //     $('#userTable2').DataTable();
        // });

    $(document).ready(function() {
    $('#userTable2').DataTable();

    // Handle delete link click
    $('.delete-link').click(function(e) {
        e.preventDefault();  // Prevent the default action (which is navigating to the URL)

        var donationId = $(this).data('id');  // Get the donation ID from the data-id attribute

        // Show a confirmation dialog using SweetAlert2
        Swal.fire({
            title: 'Are you sure?',
            text: "You won't be able to revert this!",
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Yes, delete it!'
        }).then((result) => {
            if (result.isConfirmed) {
                // Send AJAX request to delete the donation
                $.ajax({
                    url: 'delete.php',  // URL for the delete PHP file
                    type: 'GET',
                    data: { donation_id: donationId },  // Send the donation ID to the server
                    success: function(response) {
                        if (response === 'Success') {
                            // If successful, remove the table row
                            $('#donation_row_' + donationId).fadeOut(500, function() {
                                $(this).remove();
                            });
                            Swal.fire('Deleted!', 'The donation has been deleted.', 'success');
                        } else {
                            Swal.fire('Error!', 'There was an issue deleting the donation.', 'error');
                        }
                    },
                    error: function() {
                        Swal.fire('Error!', 'There was an error with the request.', 'error');
                    }
                });
            }
        });
    });
});

    </script>


</head>
<body>

<header>
        <div class="container">
            <div class="header-content">
                <div class="logo"><span>Food</span> Reports</div>
                <nav>
                    <ul>
                        
                        <li><a href="reports.php">Back</a></li>
                    </ul>
                </nav>
            </div>
        </div>
    </header>

    <!-- Table for Donation-->
    <div class="tables m-5 p-2" style="font-size:12px;">
        <h2>List of food Donated</h2>
        <table id="userTable2" class="display">
            <thead>
                <tr>
                    <th>Food Name</th>
                    <th>Meal Type</th>
                    <th>Food category</th>
                    <th>Food Quantity</th>
                    <th>Date to Pickup</th>
                    <th>FoodDonatorName</th>
                    <th>Deliver To</th>
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
                        echo "<tr id='donation_row_" . $row['Id'] . "'>";  // Added the id attribute here
                        echo "<td>" .(isset($row['FoodName']) ? htmlspecialchars($row['FoodName']) : ''). "</td>";
                        echo "<td>" .(isset($row['MealType']) ? htmlspecialchars($row['MealType']) : ''). "</td>";
                        echo "<td>" .(isset($row['FoodCategory']) ? htmlspecialchars($row['FoodCategory']) : ''). "</td>";
                        echo "<td>" .(isset($row['FoodQuantity']) ? htmlspecialchars($row['FoodQuantity']) : ''). "</td>";
                        echo "<td>" .(isset($row['DateToPickup']) ? htmlspecialchars($row['DateToPickup']) : ''). "</td>";
                        echo "<td>" .(isset($row['FoodDonatorName']) ? htmlspecialchars($row['FoodDonatorName']) : ''). "</td>";
                        echo "<td>" .(isset($row['DeliverTo']) ? htmlspecialchars($row['DeliverTo']) : ''). "</td>";
                        echo "<td>" .(isset($row['Status']) ? htmlspecialchars($row['Status']) : ''). "</td>";
                        echo "<td><a href='#' class='delete-link' data-id='" . $row['Id'] . "'>Delete</a></td>";  // Use data-id to store the donation ID
                        echo "</tr>";
                    }
                }

                ?>
    
            </tbody>
        </table>
    </div>
    
</body>
</html>