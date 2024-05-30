<?php


if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $email = htmlspecialchars($_POST["signin"]);
    

  
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
    $sql = "INSERT INTO inscription ( email) VALUES (?)";
    $stmt = mysqli_stmt_init($conn);

    if (!mysqli_stmt_prepare($stmt, $sql)) {
        die("SQL error: " . mysqli_error($conn));
    }

    mysqli_stmt_bind_param($stmt, "s",  $email);

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