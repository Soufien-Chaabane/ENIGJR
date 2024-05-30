<?php

// Connection to database
$host = "localhost";
$dbname = "database1";
$username = "root";
$password = "";

$conn = mysqli_connect($host, $username, $password, $dbname);
if (!$conn) {
    die("Connection error: " . mysqli_connect_error());
}

if ($result->num_rows > 0) {
    // Output data of each row
    while($row = $result->fetch_assoc()) {
        echo "<div >";
        echo "<img src='" . $row["picture"] . "' alt='" . $row["caption"] . "'>";
        echo "<p>" . $row["caption"] . "</p>";
        echo "</div>";
    }
} else {
    echo "0 results";
}

// Close connection
mysqli_close($conn);
?>
