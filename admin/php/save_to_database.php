<?php
// Check if form is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Check if action is to delete
    if ($_POST["action"] == "delete") {
        $pictureSrc = $_POST["pictureSrc"];
        
        // Database connection parameters
        $servername = "localhost";
        $username = "root";
        $password = "";
        $dbname = "database1";

        // Create connection
        $conn = new mysqli($servername, $username, $password, $dbname);

        // Check connection
        if ($conn->connect_error) {
            die("Connection failed: " . $conn->connect_error);
        }

        // Delete picture from database
        $sql = "DELETE FROM pictures WHERE picture = ?";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("s", $pictureSrc);
        $stmt->execute();

        $stmt->close();
        $conn->close();

        exit(); // Exit after deletion
    }
    
    // Check if image file is uploaded
    if (isset($_FILES["imageFile"]) && $_FILES["imageFile"]["error"] == 0) {
        $heading1 = $_POST["heading1"];
        $heading2 = $_POST["heading2"];
        $imageFile = $_FILES["imageFile"]["tmp_name"];
        $imageData = file_get_contents($imageFile);
        $imageType = $_FILES["imageFile"]["type"];

        // Database connection parameters
        $servername = "localhost";
        $username = "root";
        $password = "";
        $dbname = "database1";

        // Create connection
        $conn = new mysqli($servername, $username, $password, $dbname);

        // Check connection
        if ($conn->connect_error) {
            die("Connection failed: " . $conn->connect_error);
        }

        // Insert data into database
        $sql = "INSERT INTO pictures (heading, picture, caption) VALUES (?, ?, ?)";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("sss", $heading1, $imageData, $heading2);
        $stmt->execute();

        $stmt->close();
        $conn->close();
    }
}

// Redirect back to the page after adding row
header("Location: " . $_SERVER["HTTP_REFERER"]);
?>
