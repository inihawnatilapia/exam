<?php
session_start();
include 'connect_database.php'; // Assuming this file contains the database connection details

// Initialize variables
$firstname = $lastname = $contact = $address = $city = $state = $country = $zipcode = $user = '';

if (isset($_POST['submit'])) {
    // Sanitize and retrieve form data
    $firstname = isset($_POST['first_name']) ? $_POST['first_name'] : '';
    $lastname = isset($_POST['last_name']) ? $_POST['last_name'] : '';
    $contact = isset($_POST['contact_number']) ? $_POST['contact_number'] : '';
    $address = isset($_POST['address']) ? $_POST['address'] : '';
    $city = isset($_POST['city']) ? $_POST['city'] : '';
    $state = isset($_POST['state']) ? $_POST['state'] : '';
    $country = isset($_POST['country']) ? $_POST['country'] : '';
    $zipcode = isset($_POST['zip-code']) ? $_POST['zip-code'] : '';
    $user = isset($_SESSION['customer']) ? $_SESSION['customer'] : '';

    // Check if user_id already exists
    $search = "SELECT user_id FROM user_data WHERE user_id='$user'";
    $result = $database->query($search);

    if ($result->num_rows > 0) {
        // Delete existing user data if it exists
        $delete = "DELETE FROM `user_data` WHERE user_id='$user'";
        if (!$database->query($delete)) {
            echo "Error deleting record: " . $database->error;
            exit;
        }
    }

    // Insert new user data
    $insert = "INSERT INTO `user_data`(`user_id`, `firstname`, `lastname`, `address`, `city`, `state`, `country`, `zip_code`, `mobile_number`) 
               VALUES ('$user', '$firstname', '$lastname', '$address', '$city', '$state', '$country', '$zipcode', '$contact')";

    if ($database->query($insert)) {
        echo "New record created successfully";
        $_SESSION['update'] = 'Details updated successfully';
        echo '<script>window.location.href = "myaccount.php";</script>';
        exit;
    } else {
        echo "Error: " . $insert . "<br>" . $database->error;
    }
}
?>
