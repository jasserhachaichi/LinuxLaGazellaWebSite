<?php
$conn = mysqli_connect("localhost", "root", "", "gazella");
// Check the connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Check if the 'accountId' parameter is present in the request
if (isset($_POST['accountId'])) {
    // Get the account ID from the request
    $accountId = $_POST['accountId'];

    // Prepare the SQL statement to delete the account
    $sql = "DELETE FROM comptes WHERE id = '$accountId'";

    // Execute the SQL statement
    if ($conn->query($sql) === TRUE) {
        // Account deleted successfully
        echo "Account deleted successfully";
    } else {
        // Error occurred while deleting the account
        echo "Error deleting account: " . $conn->error;
    }
}

// Close the database connection
$conn->close();
?>
