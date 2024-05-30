<?php
include("./php/config.php");

// Start the session
session_start();

// Check if user is not logged in, redirect if true
if (!isset($_SESSION["loggedin"]) || $_SESSION["loggedin"] !== true) {
    header("Location: login.php");
    exit;
}

// Initialize variables
$uploadOk = 1;
$targetDirectory = "uploads/";

// Check if form is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // File upload handling
    $targetFile = $targetDirectory . basename($_FILES["imageFile"]["name"]);
    $imageFileType = strtolower(pathinfo($targetFile, PATHINFO_EXTENSION));

    // Check file size
    if ($_FILES["imageFile"]["size"] > 500000) {
        echo "Sorry, your file is too large.";
        $uploadOk = 0;
    }

    // Allow only certain file formats
    $allowedExtensions = array("jpg", "jpeg", "png", "gif");
    if (!in_array($imageFileType, $allowedExtensions)) {
        echo "Sorry, only JPG, JPEG, PNG, and GIF files are allowed.";
        $uploadOk = 0;
    }

    // Check if $uploadOk is set to 0 by an error
    if ($uploadOk == 0) {
        echo "Sorry, your file was not uploaded.";
    } else {
        // Upload the file
        if (move_uploaded_file($_FILES["imageFile"]["tmp_name"], $targetFile)) {
            // File uploaded successfully, now save to database
            $filePath = $targetFile;
            $heading1 = $_POST["heading1"];
            $heading2 = $_POST["heading2"];

            // Check if heading already exists
            $checkStmt = $conn->prepare("SELECT * FROM about WHERE heading = ?");
            $checkStmt->bind_param("s", $heading1);
            $checkStmt->execute();
            $checkResult = $checkStmt->get_result();
            if ($checkResult && $checkResult->num_rows > 0) {
                echo "A record with the same heading already exists. Please choose a different heading.";
            } else {
                // Prepare and bind the SQL statement
                $stmt = $conn->prepare("INSERT INTO about (picture, heading, caption) VALUES (?, ?, ?)");
                $stmt->bind_param("sss", $filePath, $heading1, $heading2);

                // Execute the SQL statement
                if ($stmt->execute()) {
                    echo "The file ". htmlspecialchars( basename( $_FILES["imageFile"]["name"])). " has been uploaded and added to the database.";
                } else {
                    echo "Error: " . $sql . "<br>" . $conn->error;
                }

                $stmt->close();
            }
            $checkStmt->close();
        } else {
            echo "Sorry, there was an error uploading your file.";
        }
    }
}

// SQL query to fetch data
$sql = "SELECT heading, MIN(picture) AS picture, MIN(caption) AS caption FROM about GROUP BY heading";
$result = $conn->query($sql);

$conn->close();
?>

<!DOCTYPE html>
<html>

<head>
    <!-- Basic -->
    <meta charset="utf-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <!-- Mobile Metas -->
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
    <!-- Site Metas -->
    <meta name="keywords" content="" />
    <meta name="description" content="" />
    <meta name="author" content="" />

    <title>Enig Junior Entreprise</title>

    <!-- slider stylesheet -->
    <link rel="stylesheet" type="text/css" href="https://cdnjs.cloudflare.com/ajax/libs/OwlCarousel2/2.1.3/assets/owl.carousel.min.css" />

    <!-- bootstrap core css -->
    <link rel="stylesheet" type="text/css" href="css/bootstrap.css" />

    <!-- fonts style -->
    <link href="https://fonts.googleapis.com/css?family=Poppins:400,600,700&display=swap" rel="stylesheet">
    <!-- Custom styles for this template -->
    <link href="css/style.css" rel="stylesheet" />
    <!-- responsive style -->
    <link href="css/responsive.css" rel="stylesheet" />

    <style>
        table {
            border-collapse: collapse;
            width: 90%;
            margin: 20px auto;
            max-width: 90%;
        }

        th,
        td {
            border: 1px solid black;
            padding: 8px;
            text-align: left;
        }

        .remove-button {
            cursor: pointer;
        }

        td {
            height: 40px;
        }

        .detail-box {
            max-width: 90%;
        }
    </style>
</head>

<body class="sub_page">

    <div class="hero_area">
        <!-- header section starts -->
        <header class="header_section">
            <div class="container">
                <nav class="navbar navbar-expand-lg custom_nav-container ">
                    <a class="navbar-brand" href="Mabout.php">
                        <img src="images/logo.png" alt="">
                        <span>Enig Junior Entreprise</span>
                    </a>
                    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                        <span class="s-1"> </span>
                        <span class="s-2"> </span>
                        <span class="s-3"> </span>
                    </button>

                    <div class="collapse navbar-collapse" id="navbarSupportedContent">
                        <div class="d-flex ml-auto flex-column flex-lg-row align-items-center">
                            <ul class="navbar-nav  ">
                                <li class="nav-item ">
                                    <a class="nav-link" href="Mabout.php"> About</a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link" href="Mservice.php"> Service </a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link" href="Mblog.php"> Blog </a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link" href="Mcontact.php">Contact </a>
                                </li>
                                <li class="nav-item ">
                                    <!-- Logout Button -->
                                    <form action="./php/logout.php" method="post">
                                        <button class="nav-link" id="dcnx" style="background-color: #5f040b;" type="submit">Deconnecter<span class="sr-only">(current)</span></button>
                                    </form>
                                </li>
                            </ul>
                        </div>
                    </div>
                </nav>
            </div>
        </header>
        <!-- end header section -->
    </div>

    <!-- about section -->
    <section class="about_section layout_padding">
        <div class="container" style="text-align:center">
            <h1>À propos de nous<a><img src="images/HAND.png" alt="" style="width: 70px;"></a></h1>
        </div>
        <!--image for blog-->
        <div>
            <div class="">
                <form id="add-row-form" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post" enctype="multipart/form-data">
                    <label for="heading1">Heading :</label>
                    <input type="text" id="heading1" name="heading1"><br><br>
                    <label for="heading2">Caption:</label>
                    <input type="text" id="heading2" name="heading2"><br><br>
                    <label for="imageFile">Add Photo:</label>
                    <input type="file" id="imageFile" name="imageFile"><br><br>
                    <button type="submit">Upload</button>
                </form>
                <table id="dynamic-table">
                    <tr>
                        <th>Heading&Caption</th>
                        <th>Picture</th>
                        <th>Actions</th>
                    </tr>
                    <?php
                    // Output data of each row
                    if ($result && $result->num_rows > 0) {
                        while ($row = $result->fetch_assoc()) {
                            echo "<tr>";
                            echo "<td>" . $row["heading"] . "<br>" . $row["caption"] . "</td>";
                            echo "<td><img src='" . $row["picture"] . "' style='width:100px; height:auto;' /></td>";
                            echo "<td><span class='remove-button' onclick='deleteTableRow(this)'>Remove</span></td>";
                            echo "</tr>";
                        }
                    } else {
                        echo "<tr><td colspan='3'>No records found.</td></tr>";
                    }
                    ?>
                </table>
            </div>
        </div>
    </section>
    <!-- end about section -->

    <!-- info section -->
    <section class="info_section layout_padding">
    <div class="container">
      <div class="info_contact" >
        <div class="row" >
          
          
            <h1 style="color: #fff; padding-left:16%" >   United we hunt,Devided we are hunted
            </h1>
          
          
        </div>
      </div>
      
  </section>

    <!-- end info section -->

    <!-- footer section -->
    <footer class="container-fluid footer_section">
        <div class="container">
            <div class="row">
                <div class="col-lg-7 col-md-9 mx-auto">
                    <p>
                        &copy; 2024. All rights reserved by
                        <a href="https://html.design/"> Junior Entreprise ENIG</a>
                    </p>
                </div>
            </div>
        </div>
    </footer>
    <!-- footer section -->

    <script src="js/jquery-3.4.1.min.js"></script>
    <script src="js/bootstrap.js"></script>
    <script>
        // Function to delete a row from the table
        function deleteTableRow(button) {
            if (confirm("Are you sure you want to delete this picture?")) {
                var row = button.parentNode.parentNode;
                var pictureSrc = row.querySelector("img").getAttribute("src");
                var formData = new FormData();
                formData.append("pictureSrc", pictureSrc);
                formData.append("action", "delete");

                var xhr = new XMLHttpRequest();
                xhr.open("POST", "/admin/php/save_to_database.php", true);
                xhr.onreadystatechange = function() {
                    if (xhr.readyState === XMLHttpRequest.DONE) {
                        if (xhr.status === 200) {
                            // Remove row from the table
                            row.remove();
                        } else {
                            console.error("Error:", xhr.statusText);
                        }
                    }
                };
                xhr.send(formData);
            }
        }
    </script>
</body>

</html>
