<?php
session_start();
if(isset($_SESSION["email"])){
    header("location:dashboard.php");
    exit();
}
?>

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
            $('#userTable').DataTable();
        });

        $(document).ready(function() {
            $('#userTable2').DataTable();
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
                <div class="logo"><span>Food</span> Donation</div>
                <nav>
                    <ul>
                        <li><a href="login.php">Login</a></li>
                        <li><a href="index.php">Register</a></li>
                        <li><a href="reports.php">Admin</a></li>
                    </ul>
                </nav>
            </div>
        </div>
    </header>

    <!-- For User Registration -->
    <div class="content">
        <form action="create.php" method="post" class="p-5 formUser m-5">
            <h1>User Registration</h1><br>
            <div class="form-group">
                <label for="name">Name</label>
                <input type="text" name="name" id="name" class="form-control" required/>
            </div>
            <div class="form-group">
                <label for="email">Email</label>
                <input type="email" name="email" id="email" class="form-control" required/>
                <small id="emailHelp" class="form-text text-muted">We'll never share your email with anyone else.</small><br><br>
            </div>

            <div class="form-group">
                <label for="Phone">Phone</label>
                <input type="number" name="phone" id="phone" class="form-control" required/>
            </div>

            <div class="form-group">
                <label for="password">Password</label>
                <input type="password" name="password" class="form-control" required/><br>
            </div>

            <div class="form-group">
                <label for="Uaddress">Your Address</label>
                <input type="text" name="Uaddress" class="form-control" required/><br>
            </div>
            <input type="submit" value="Register" class="btn btn-primary">
        </form>
    </div>
</body>
</html>