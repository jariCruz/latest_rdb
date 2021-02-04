<?php require "header.php"; ?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Contact Us | BSU-SC Research DB</title>

    <!-- Latest compiled and minified CSS -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">

    <!-- jQuery library -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>

    <!-- Popper JS -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>

    <!-- Latest compiled JavaScript -->
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>

    <!-- Font Awesome Icon -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">

    <!-- Font link -->
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Abril+Fatface|Poppins">

    <!-- Other resources -->
    <link rel="stylesheet" href="../css/contact_style.css">
    <link rel="stylesheet" href="../css/responsive_style.css">
    <link rel="stylesheet" href="../css/jumbotron_style.css">


</head>
<body>
  <!-- Header -->
  <div class="sticky-top">

  <nav class="navbar navbar-expand-md navbar-light bg-light">

        <div class="container-fluid">

          <div>
            <div class="header-font">
              <a class="navbar-brand" href="../index.php">Research DB</a>
            </div>

            <div class="mt-n3">
              <span class="navbar-text sm-hide">Bulacan State University - Sarmiento Campus</span>
            </div>
          </div>

          <button class="navbar-toggler" type="button"
                  data-toggle="collapse" data-target="#collapseNavbar">
            <span class="navbar-toggler-icon"></span>
          </button>

          <div class="collapse navbar-collapse" id="collapseNavbar">
            <ul class="navbar-nav ml-auto">

              <li class="nav-item">
                <a class="nav-link" href="../index.php">Home</a>

              </li>


              <li class="nav-item">
                <a class="nav-link" href="about_page.php">About</a>

              </li>

              <li class="nav-item">
                <a class="nav-link active" href="contact_page.php">Contact</a>

              </li>

              <!-- Dropdown for Logged-in -->
              <!--
              <li class="nav-item dropdown">
                <a class="nav-link dropdown-toggle" href="#" id="navbardrop"
                    data-toggle="dropdown">Webster~</a>

                <div class="dropdown-menu dropdown-menu-right">
                  <a href="#" class="dropdown-item">Settings & privacy</a>
                  <a href="#" class="dropdown-item">Help Guides</a>
                  <a href="#" class="dropdown-item">Support Centre</a>
                  <div class="dropdown-divider"></div>
                  <a href="#" class="dropdown-item">Sign out</a>
                </div>
              </li>
              -->

              <!-- buttons for Log in and sign up -->
              <?php if (!isset($_SESSION['user_id'])) {?>
              <li class="nav-item">
                <a class="nav-link" href="#" data-toggle="modal"
                    data-target="#signIn_mc">Sign in</a>
              </li>

              <li class="nav-item">
                <a class="nav-link" href="#" data-toggle="modal"
                    data-target="#create_mc">Create account</a>
              </li>
              <?php }else { ?>
                <li class="nav-item">
                  <form id="logout" action="logout.php" method="post">
                  <a class="nav-link" href="javascript:;" onclick="document.getElementById('logout').submit();">Logout</a>
                  <input type="hidden" name="redirect" value="<?php echo htmlspecialchars($_SERVER["REQUEST_URI"]) ?>" />
                  </form>
                </li>
              <?php } ?>
              
              
            </ul>
          </div>


        </div>
      </nav>
    </div>

  

    <!-- Modal for creating an account -->
    <div class="modal fade" id="create_mc">
      <div class="modal-dialog">
        <div class="modal-content">
          
          <!-- modal header -->
          <div class="modal-header">
            <h5 class="modal-title header-font">Create an account for...</h5>
            <button class="close" data-dismiss="modal">&times;</button>
          </div>

          <!-- modal body -->
          <div class="modal-body">
            <div class="row">

            <!-- Student -->            
            <div class="col mt-n3 mb-n3 modal-hover modal-height
                          d-flex align-items-center justify-content-center">

                    <a href="registration_page_student.php"
                        class="stretched-link">Student</a>
              </div>

            <!-- Professor -->
              <div class="col mt-n3 mb-n3 modal-hover modal-height
                          d-flex align-items-center justify-content-center">
                
                  <a href="registration_page_professor.php"
                      class="stretched-link">Professor</a>
              </div>

            </div>
          </div>

          <!-- modal footer -->
          <div class="modal-footer">
            <button class="btn btn-outline-danger" data-dismiss="modal">Close</button>
          </div>

        </div>
      </div>

    <!-- modal -->
    </div>


    <!-- Modal for creating an account -->
    <div class="modal fade" id="signIn_mc">
      <div class="modal-dialog">
          <div class="modal-content">
                  
              <!-- modal header -->
              <div class="modal-header">
                  <h5 class="modal-title header-font">Someone is logging in...</h5>
                  <button class="close" data-dismiss="modal">&times;</button>
              </div>

              <!-- modal body -->
              <div class="modal-body">

                  <form action="login_function.php" method="post"
                          class="needs-validation
                                  mx-auto mb-3">
                      
                      
                      <!-- Forename field -->

                      <div class="form-group">
                          <label for="form_fname">Username:</label>
                          
                          <input type="text"
                                  class="form-control"
                                  id="form_uname"
                                  placeholder="Username"
                                  name="form_uname"
                                  minlength="2"
                                  maxlength="30"
                                  required>                

                      </div>

                      <!-- Password field -->


                      <div class="form-group mt-2">
                          <label for="form_pass">Passsword:</label>
                          <input type="password"
                                  name="form_pass"
                                  id="form_pass"
                                  placeholder="Password"
                                  class="form-control"
                                  maxlength="30"
                                  minlength="8"
                                  required>

                      </div>
                      <input type="hidden" name="redirect" value="<?php echo htmlspecialchars($_SERVER['REQUEST_URI']) ?>" />

                      
                      <!-- Checkbox -->
                      
                      
                      <div class="row">
                          <div class="form-group col">
                              <input type="checkbox">
                              <span>Remember me</span>
                          </div>

                          <!-- Register btn -->
                          <div class="col d-flex justify-content-end">
                              <button name="login-submit" id="login-submit" type="submit" class="btn btn-primary" onclick="login()">Login</button>
                          </div>
                      
                      </div>
                      
                      <span class="d-flex justify-content-center mt-3">Don't have an account yet?&MediumSpace;
                          <a data-dismiss="modal" href="#" data-toggle="modal" data-target="#create_mc">Register here.</a>
                      </span>

                      <!-- just a freakin horizontal line -->            
                      <hr class="bg-dark mt-4">

                      <span class="d-flex justify-content-center">
                          <a href="#">Forgot password?</a>
                      </span>

                  </form>
              </div>

              <!-- Form validation -->
              <script>

                  (function() {
                  'use strict';
                  window.addEventListener('load', function() {
                  // Get the forms we want to add validation styles to
                  var forms = document.getElementsByClassName('needs-validation');
                  // Loop over them and prevent submission
                  var validation = Array.prototype.filter.call(forms, function(form) {

                  form.addEventListener('submit', function(event) {
                      if (form.checkValidity() === false) {
                      
                      event.preventDefault();
                      event.stopPropagation();
                      }   
                      form.classList.add('was-validated');
                  }, false);
                  });
                  }, false);
                  })();
              </script>

      
              </div>

          </div>
    </div>

  </div>


  <!-- About Us Header -->
  <div style="height: 80px;"
      class="container-fluid
              greetings-bg
              pl-4 pt-4 mb-5   
              border border-primary
                  border-left-0
                  border-right-0">

      
      <h4 id="greetings-size" class="header-font text-right">Contact Us</h4>
      

  </div>

  <!-- Content -->
  <div class="container-fluid row">
    <!-- First column -->
    <div class="col-lg-4 ml-md-5 mr-md-5 mb-5 p-5">

        <h5 class="header-font subtitle-size-1">How to Find Us</h5>
        <p>If you have any questions, just fill out the contact form
            and we will answer you shortly. You can also visit us in
            our office.
        </p>

        <h6 id="subtitle-size-2" class="header-font mt-5 pt-5">Headquarter</h6>
        <p><strong>Address: </strong>University Heights, Brgy. Kaypian, City of San Jose del Monte, Bulacan, Philippines</p>
        <p><strong>Telephone: </strong>+63-8122-4545</p>
        <p><strong>Email: </strong>bsuscresearchdb@gmail.com</p>
    </div>

    <!-- Second column -->
    <div class="col-lg-5 ml-md-5 p-5">
        <h5 class="header-font subtitle-size-1">Get in Touch</h5>
        <form action="#">
            <label class="mt-3" for="contact_us_name">Name:</label>
            <input type="text" class="form-control" id="contact_us_name"
                    placeholder="Name">

            <label class="mt-3" for="contact_us_email">Email:</label>
            <input type="email" class="form-control" id="contact_us_email"
                    placeholder="Email">

            <label class="mt-3" for="contact_us_message">Message:</label>
            <textarea name="contact_us_message"
                        class="form-control message-xy-limit"
                        id="contact_us_message"
                        cols="10" rows="10"                        
                        placeholder="Message..."></textarea>

            <button class="btn btn-outline-primary mt-3 float-right">Send request</button>
        </form>

    </div>
  </div>

  <!-- Jumbotron -->
  <div class="jumbotron jumbotron-fluid
              bg-night text-white
              mt-3 mb-n2">
    <div class="container">

      <!-- Information modified -->
      <!-- Note: Change all jumbotron -->
      <h2 class="header-font">Bond With Us!</h2>
      <p> Explore, investigate, analyze, experiment, and test now.<br>
          Join the aspiring professional researchers at Bulacan State University - Sarmiento Campus.</p>
    </div>
  </div>

  <!-- Footer -->

  <footer class="border-top-2 pb-4 mt-5">

    <div class="container">
      <div class="row">
        <div class="col-md-8 ft">
          <p style="margin-top: -1%">Copyright © 2020 Research DB. All rights reserved.<br>
            We use cookies to help provide and enhance our service and tailor content.<br>
            By continuing you, agree to our <a href="#">Cookies Settings</a>.</p><br>

          <div style="margin-top: -4%;">
            <a href="#">Copyright</a>
            <span class="px-3">|</span>

            <a href="#">Terms of Use</a>
            <span class="px-3">|</span>

            <a href="#">Privacy Policy</a>

          </div>
        </div>

        <div class="col-md-4 l-mt sm-mt">
          <span>Follow us on:</span><br>

          <span class="fa fa-facebook-official sl"></span>
          <span class="fa fa-instagram sl px-3"></span>
          <span class="fa fa-twitter-square sl"></span>
        </div>

      </div>
    </div>

  </footer>


<script src="../js/login.js"></script>    
</body>
</html>