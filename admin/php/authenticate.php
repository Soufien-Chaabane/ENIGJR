<?php
session_start();
$_SESSION['flash_message'] = 'Form submitted successfully';

// Connection to database
$host = "localhost";
$dbname = "database1";
$username = "root";
$password = "";

$conn = mysqli_connect($host, $username, $password, $dbname);
if (!$conn) {
    die("Connection error: " . mysqli_connect_error());
}

// Check if the form was submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Retrieve username and password from the POST request
    $password = $_POST["psw"]; // Password entered in the form
    $username = $_POST["uname"]; // Username entered in the form

    // Check if any value is empty
    if (empty($password) || empty($username)) {
        // If any field is empty, show an alert and redirect
        echo "<script>alert('Empty field!');</script>";
        echo "<script>window.location.href='../contact.html';</script>";
        exit; // Stop further execution
    }

    // Prepare SQL statement to check if username and password are correct
    $sql = "SELECT username, password FROM admin_login WHERE username = ?";
    $stmt = mysqli_prepare($conn, $sql); // Prepare the SQL statement

    // Check if prepared statement is successful
    if ($stmt) {
        mysqli_stmt_bind_param($stmt, "s", $username); // Bind parameters to the SQL statement
        mysqli_stmt_execute($stmt); // Execute the prepared statement
        mysqli_stmt_store_result($stmt); // Store the result
        mysqli_stmt_bind_result($stmt, $fetched_username, $fetched_password); // Bind result variables

        // Fetch the result of the query
        if (mysqli_stmt_fetch($stmt)) {
            // If a record is fetched
            if ($password === $fetched_password) {
                // If password matches the fetched password
                // Authentication successful, start a session
                $_SESSION["loggedin"] = true; // Set session variable
                $_SESSION["username"] = $fetched_username; // Set session variable for username
                // Redirect to a secure page
                header("Location:../Mabout.php");
                exit; // Stop further execution
            } else {
                // If password does not match
                // Display JavaScript alert for incorrect password
                echo "<script>alert('Incorrect password!');</script>";
            }
        } else {
            // If no record is fetched
            // Display JavaScript alert for unknown username
            echo "<script>alert('Unknown username!');</script>";
            echo "<script>window.history.back();</script>";
            exit; // Stop further execution
        }

        // Close the prepared statement
        mysqli_stmt_close($stmt);
    } else {
        // Display error message if preparing the statement fails
        echo "<script>alert('Error: " . mysqli_error($conn) . "');</script>";
        echo "<script>window.history.back();</script>";
            exit; // Stop further execution
    }
}

// Close connection
mysqli_close($conn);
?>
