<?php include("./php/config.php");


// Start the session
session_start();

// Check if user is not logged in, redirect if true
if (!isset($_SESSION["loggedin"]) || $_SESSION["loggedin"] !== true) {
    header("Location: login.php");
    exit;
}

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
  <link rel="icon" href="/icon/iconJR.ico" type="image/x-icon">

  <title>              Enig Junior Entreprise  </title>

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
</head>

<body class="sub_page">
  <div class="hero_area">
    <!-- header section strats -->
    <header class="header_section">
      <div class="container">
        <nav class="navbar navbar-expand-lg custom_nav-container ">
          <a class="navbar-brand" href="Mcontact.php">
            <img src="images/logo.png" alt="">
            <span>
              Enig Junior Entreprise

            </span>
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


  <!-- contact section -->

  <section class="contact_section layout_padding">
    <div class="container ">
      <div class="heading_container">
        <h2>
          les contacts
        </h2>
        <img src="images/HAND.png" alt="">
      </div>
    </div>
    <div class="container">
      <div class="row">
        <div class="col-md-6">
           
          <form action="php/database1.php" method="post">
            <div>
              <input type="text" placeholder="Name" name="name" />
            </div>
            <div>
              <input type="email" placeholder="Email" name="email"/>
            </div>
            <div>
              <input type="text" placeholder="Phone Number"  name="tel"/>
            </div>
            <div>
              <input type="text" class="message-box" placeholder="Message" name="msg"/>
            </div>
            <div class="d-flex ">
              <button type="submit" >
                Envoyer
              </button>
            </div>
          </form>
        </div>
        <div class="col-md-6">
          <div class="map_container">
            <div class="map-responsive">
              <iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d1667211.4766395953!2d8.856343793145786!3d35.299212045685415!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x12556e3f864b634f%3A0xdc9df2154f7ac913!2sNational%20Engineering%20School%20of%20Gabes!5e0!3m2!1sen!2stn!4v1713021870967!5m2!1sen!2stn" width="600" height="450" style="border:0;" allowfullscreen="" loading="lazy" referrerpolicy="no-referrer-when-downgrade"></iframe>
            </div>
          </div>
        </div>
      </div>
    </div>
  </section>

  <!-- end contact section -->


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

</body>

</html>