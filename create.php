<?php
     require_once 'dbConnection.php';
     require_once 'crudOperation.php';

     if($_SERVER["REQUEST_METHOD"] == "POST"){

        $database = new Database();
        $db = $database->getConnect();

        $user = new User($db);

        //passing the value of input fields to the properties of user class
        $user->name = htmlspecialchars(trim($_POST['name']));
        $user->email = htmlspecialchars(trim($_POST['email']));
        $user->phoneNum = htmlspecialchars(trim($_POST['phone']));
        $user->password = htmlspecialchars(trim($_POST['password']));
     }
     

     if ($user->create()){
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
            icon: 'error',
            title: 'Oops...',
            text: 'Something went wrong!',
            footer: '<a href='#'>Why do I have this issue?</a>'
            });
        </script>
        </body>
        </html> ";
     }


?>