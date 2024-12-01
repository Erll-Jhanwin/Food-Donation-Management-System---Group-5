<?php
     require_once 'dbConnection.php';
     require_once 'crudOperation.php';

     if($_SERVER["REQUEST_METHOD"] == "POST"){

        $database = new Database();
        $db = $database->getConnect();

        $user = new User($db);
        $user->f_name = htmlspecialchars(trim($_POST['food_name']));
        $user->Meal_type = htmlspecialchars(trim($_POST['meal_type']));
        $user->f_category = htmlspecialchars(trim($_POST['f_category']));
        $user->f_quantity = htmlspecialchars(trim($_POST['f_quant']));
        $user->u_email = htmlspecialchars(trim($_POST['email']));
        $user->phone = htmlspecialchars(trim($_POST['phone']));
        $user->date_pickup = htmlspecialchars(trim($_POST['date_pickup']));
        $user->food_donator_name = htmlspecialchars(trim($_POST['food_donator_name']));
        // $user->donate_date_creation = date("Y-m-d");
        $user->donate_date_creation = htmlspecialchars(trim($_POST['date_create']));
        $user->status = "To pickup";
    
     }

     if ($user->createDonation()){
        echo "
        <!DOCTYPE html>
        <html lang='en'>
        <head>
            <meta charset='UTF-8'>
            <meta name='viewport' content='width=device-width, initial-scale=1.0'>
            <title>SweetAlert</title>
            <script src='https://cdn.jsdelivr.net/npm/sweetalert2@11'></script>
        </head>
        <body>
        <script>
        Swal.fire({
            title: 'Success!',
            text: 'Data was Succesfully inserted!',
            icon: 'success'
        }).then((result) => {
            if(result.isConfirmed) {
                window.location.href = 'index.php';
            }
        });
        </script>
        </body>
        </html> ";
     }

     else {
        echo "error";
     }


?>