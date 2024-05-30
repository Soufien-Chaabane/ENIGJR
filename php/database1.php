<?php
// Function to check if any value is empty
function isEmpty($value) {
    return empty(trim($value));
}
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $name = htmlspecialchars($_POST["name"]);
    $email = htmlspecialchars($_POST["email"]);
    $tel = htmlspecialchars($_POST["tel"]);
    $msg = htmlspecialchars($_POST["msg"]);

         // Check if any value is empty
         if (isEmpty($name) || isEmpty($email) || isEmpty($tel) || isEmpty($msg)) {
            echo "<script>alert('Empty field!');</script>";
            echo "<script>window.location.href='../contact.php';</script>";
            exit; // Stop further execution
        }
    // Connection to database
    $host = "localhost";
    $dbname = "database1";
    $username = "root";
    $password = "";

    $conn = mysqli_connect($host, $username, $password, $dbname);
    if (!$conn) {
        die("Connection error: " . mysqli_connect_error());
    }
//insert data ito the table 
    $sql = "INSERT INTO les_contactes (fullname, email, tel, msg) VALUES (?, ?, ?, ?)";
    $stmt = mysqli_stmt_init($conn);

    if (!mysqli_stmt_prepare($stmt, $sql)) {
        die("SQL error: " . mysqli_error($conn));
    }

    mysqli_stmt_bind_param($stmt, "ssss", $name, $email, $tel, $msg);

    if (mysqli_stmt_execute($stmt)) {
        header("Location:..\index.php"); //  submit successful
        
exit();
    } else {
        $statusMessage = "Error: " . mysqli_error($conn);
    }

    mysqli_stmt_close($stmt);
    mysqli_close($conn);
}
?>