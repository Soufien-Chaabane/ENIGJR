<?php
// Database connection
$servername = "localhost";
$dbname = "database1";
$username = "root";
$password = "";

$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Retrieve images from database
$sql = "SELECT * FROM pictures";
$result = $conn->query($sql);

if ($result->num_rows > 0) {
    // Output data of each row
    while($row = $result->fetch_assoc()) {
        echo '<div>';
        echo '<img src="' . $row["picture"] . '" alt="' . $row["caption"] . '" width="200">';
        echo '<p>' . $row["caption"] . '</p>';
        echo '</div>';
    }
} else {
    echo "0 results";
}
$conn->close();
?>
