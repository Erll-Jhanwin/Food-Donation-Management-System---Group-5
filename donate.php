<?php
session_start();

if(!isset($_SESSION["email"])){
    header("location:dashboard.php");
    exit();
}


$phone = $_SESSION['phone'];
$email = $_SESSION['email'];
$name = $_SESSION['name'];
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
                <div class="logo"><span>Donate</span> Food</div>
                <nav>
                    <ul>
                        <li><a href="dashboard.php">Home</a></li>
                        <li><a href="donate.php">Donate</a></li>
                    </ul>
                </nav>
            </div>
        </div>
    </header>

    <!-- For food donation -->
     <div class="content">

     <form action="createDonation.php" method="post" class="p-5 formUser m-5">
        <h1>Donate Food</h1>
        
        <div class="form-group">
            <label for="food_name">Food Donator Name</label>
            <input type="text" name="food_donator_name" id="food_donator_name" class="form-control" value="<?php echo $name;?>" readonly/><br>
        </div>

        <div class="form-group">
            <label for="food_name">Food name</label>
            <input type="text" name="food_name" id="food_name" class="form-control" required/><br>
        </div>

        Meal Type:<br>
        <input type="radio" name="meal_type" value="vegetables" id="vegetables" required/>
        <label for="vegetables">vegetables</label><br>
        <input type="radio" name="meal_type" value="non_vegetables" id="non_vegetables" required/>
        <label for="non_vegetables">non-vegetables</label><br>
        <input type="radio" name="meal_type" value="fruits" id="fruits" required/>
        <label for="fruites">fruits</label><br><br>

        Food Category:<br>
        <input type="radio" name="f_category" value="raw_food" id="raw_food" required/>
        <label for="raw_food">raw food</label><br>
        <input type="radio" name="f_category" value="cooked_food" id="cooked_food" required/>
        <label for="cooked_food">cooked food</label><br>
        <input type="radio" name="f_category" value="packed_food" id="packed_food" required/>
        <label for="packed_food">packed food</label><br><br>

        <div class="form-group">
            <label for="f_quant">Food Quantity(Person)</label>
            <input type="number" name="f_quant" class="form-control" required/><br>
        </div>

        <div class="form-group">
            <label for="email">Email</label>
            <input type="email" name="email" class="form-control" value="<?php echo $email;?>" readonly/><br>
        </div>

        <div class="form-group">
            <label for="phone">Phone</label>
            <input type="text" name="phone" class="form-control" value="<?php echo $phone;?>" readonly/><br>
        </div>
        
        <!-- Date Created sample -->
        <div class="form-group">
            <label for="date">Date Created(Sample)</label>
            <input type="date" name="date_create" class="form-control w-75" required/><br>
        </div>
        
        <div class="form-group">
            <label for="date">Date to Pickup</label>
            <input type="date" name="date_pickup" class="form-control w-75" required/><br>
        </div>
        <input type="submit" value="Donate" class="btn btn-primary">
     </form>
     </div>
    
</body>
</html>