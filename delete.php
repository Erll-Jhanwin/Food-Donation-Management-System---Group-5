<?php
require_once 'dbConnection.php';
require_once 'crudOperation.php';

$database = new Database();
$db = $database->getConnect();
$user = new User($db);

// Check if we are deleting a user
if (isset($_GET['id'])) {
    $userId = $_GET['id'];

    // Call the deleteUser function to delete a user by their ID
    if ($user->deleteUser($userId)) {
        echo "User deleted successfully.";
        header('Location: userslist.php');
    } else {
        echo "Failed to delete user.";
    }
}

// Check if we are deleting a donation
// if (isset($_GET['donation_id'])) {
//     $donationId = $_GET['donation_id'];

//     // Call the deleteDonation function to delete a donation by its ID
//     if ($user->deleteDonation($donationId)) {
//         echo "Donation deleted successfully.";
//         header('Location: donationsList.php');
//     } else {
//         echo "Failed to delete donation.";
//     }
// }


if (isset($_GET['donation_id'])) {
    $donationId = $_GET['donation_id'];

    $database = new Database();
    $db = $database->getConnect();

    $user = new User($db);
    if ($user->deleteDonation($donationId)) {
        echo 'Success';  // Return success message
    } else {
        echo 'Error';  // Return error message
    }
}

// Redirect back to the list after deletion
  // or the relevant page you want to redirect to
exit;

?>
