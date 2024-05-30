<?php include("./php/config.php");

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
    <link rel="shortcut icon" href="/icon/logo.ico" type="image/x-icon">
    <!-- fonts style -->
    <link href="https://fonts.googleapis.com/css?family=Poppins:400,600,700&display=swap" rel="stylesheet">
    <!-- Custom styles for this template -->
    <link href="css/style.css" rel="stylesheet" />
    <!-- responsive style -->
    <link href="css/responsive.css" rel="stylesheet" />
  
  <style>
   
    form {border: 3px solid #000000;
    }
    .slider_section{align-items: center;
    justify-content: center;
    margin-bottom: 20px;;}
    input[type=text], input[type=password] {
      width: 100%;
      padding: 12px 20px;
      margin: 8px 0;
      display: inline-block;
      border: 1px solid #ccc;
      box-sizing: border-box;
    }
    
    button {
      display: block; /* Ensure the button fills the entire width of its container */
      width: 100%; /* Make the button fill its container */
      padding: 10px 20px;
      font-size: 16px;
      cursor: pointer;
      text-decoration: none;
      color: #fff;
      background-color: #581010;
      border: none;
      border-radius: 5px;
      margin: 10% 1%;
    }
    
    button:hover {
      opacity: 0.8;
    }
    
    .cancelbtn {
      width: auto;
      padding: 5px 18px;
      background-color: #581010;;
    }
    
    .container1 {
      display: inline-block;
      padding: 10px;
      width: 100%;
      position: relative;
    }
    
    
    .container {
      display: inline-block;
      padding: 10px;
    }
    
   
    
    /* Change styles for span and cancel button on extra small screens */
    @media screen and (max-width: 300px) {
      span.psw {
         display: block;
         float: none;
      }
      .cancelbtn {
         width: 100%;
      }
    }
    </style>
</head>

<body>
  
  <div class="hero_area">
    <!-- header section strats -->
    <header class="header_section">
      <div class="container">
        <nav class="navbar navbar-expand-lg custom_nav-container ">
          <a class="navbar-brand" href="control.php">
            <img src="../images/logo.png" alt="">
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
    <!-- login section -->
    <section class=" slider_section " >
        </div>

  </section>
 

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
  <footer class="container-fluid footer_section" >
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