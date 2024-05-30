<?php
include("admin/php/config.php");
// Initialize variables
$uploadOk = 1;
$targetDirectory = "admin";
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
            $checkStmt = $conn->prepare("SELECT * FROM pictures WHERE heading = ?");
            $checkStmt->bind_param("s", $heading1);
            $checkStmt->execute();
            $checkResult = $checkStmt->get_result();
            if ($checkResult && $checkResult->num_rows > 0) {
                echo "A record with the same heading already exists. Please choose a different heading.";
            } else {
                // Prepare and bind the SQL statement
                $stmt = $conn->prepare("INSERT INTO pictures (picture, heading, caption) VALUES (?, ?, ?)");
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
        .cards {
  display: grid;
  grid-template-columns: repeat(auto-fill, minmax(230px, 1fr));
  grid-gap: 20px;
}

.card {
  background-color: transparent;
  display: grid;
  grid-template-rows: max-content 200px 1fr;
  margin:10px
}

.card img {
  object-fit: cover;
  width: 100%;
  height: 100%;
padding-left:20PX ;
margin-left:10px;
}
  .card {
  display: grid;
  grid-template-rows: max-content 200px 1fr;
}
.row {
    display: flex;
    flex-wrap: wrap;
    margin-right: -0px; /* Adjust for negative margin in Bootstrap grid system */
    margin-left: 15px; /* Adjust for negative margin in Bootstrap grid system */
}

.col {
    flex: 0 0 33%;
    max-width: 30%;
    padding: 0 10px; /* Adjust for Bootstrap grid padding */
}


    </style>
</head>

<body class="sub_page">

    <div class="hero_area">
        <!-- header section starts -->
        <header class="header_section">
            <div class="container">
                <nav class="navbar navbar-expand-lg custom_nav-container ">
                    <a class="navbar-brand" href="index.php">
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
                <a class="nav-link" href="index.php">Acceuil <span class="sr-only">(current)</span></a>
                </li>
                <li class="nav-item">
                  <a class="nav-link" href="about.php"> A Propos</a>
                </li>
                <li class="nav-item">
                  <a class="nav-link" href="service.php"> Services </a>
                </li>
                <li class="nav-item">
                  <a class="nav-link" href="blog.php"> Blogs </a>
                </li>
                <li class="nav-item">
                  <a class="nav-link" href="contact.php">Contacte </a>
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
        <?php
// Output data of each row
if ($result && $result->num_rows > 0) {
    $counter = 0;
    while ($row = $result->fetch_assoc()) {
        if ($counter % 3 == 0) {
            // Start a new row
            echo "<div class='row'>";
        }
        echo "<div class='col'>";
        echo "<div class='cards'>";
        echo "<article class='card'>";
        echo "<header>";
        echo "<h2>" . $row["heading"] .  "</h2>";
        echo "</header>";
        echo "<div class='image'>";
        echo "<img src='admin/" . $row["picture"] . "' style='width:200px; height:auto; />";
        echo "</div>";
        echo "<div class='content'>";
        echo "<p>" . $row["caption"] . "</p>";
        echo "</div>";
        echo "</article>";
        echo "</div>";
        echo "</div>";

        $counter++;
        if ($counter % 3 == 0) {
            // End the row after every 3 articles
            echo "</div>";
        }
    }
    // Close the row if the number of articles is not a multiple of 3
    if ($counter % 3 != 0) {
        echo "</div>";
    }
} else {
    echo "<div class='row'>";
    echo "<div class='col'>";
    echo "<div class='cards'>";
    echo "<article class='card'>";
    echo "<p>No records found.</p>";
    echo "</article>";
    echo "</div>";
    echo "</div>";
    echo "</div>";
}
?>

        </div>
    </section>
    <!-- end about section -->

    <!-- info section -->
    <section class="info_section layout_padding">
        <div class="container">
            <div class="info_contact">
                <div class="row">
                    <div class="col-md-4">
                        <a href="">
                            <img src="images/location-white.png" alt="">
                            <span>Ecole Nationale d'Ingénieurs de Gabès</span>
                        </a>
                    </div>
                    <div class="col-md-4">
                        <a href="">
                            <img src="images/telephone-white.png" alt="">
                            <span>Tel : +216 ********</span>
                        </a>
                    </div>
                    <div class="col-md-4">
                        <a href="">
                            <img src="images/envelope-white.png" alt="">
                            <span>enigjeentreprise@gmail.com</span>
                        </a>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-md-8 col-lg-9">
                    <div class="info_form">
                        <form action="admin/php/database2.php" method="post">
                            <input type="text" placeholder="Entrez votre email" name="signin">
                            <button>s'inscrire</button>
                        </form>
                    </div>
                </div>
                <div class="col-md-4 col-lg-3">
                    <div class="info_social">
                        <div>
                            <a href=""><img src="images/fb.png" alt=""></a>
                        </div>
                        <div>
                            <a href=""><img src="images/twitter.png" alt=""></a>
                        </div>
                        <div>
                            <a href=""><img src="images/linkedin.png" alt=""></a>
                        </div>
                        <div>
                            <a href=""><img src="images/instagram.png" alt=""></a>
                        </div>
                    </div>
                </div>
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
