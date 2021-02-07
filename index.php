<?php
require "php/header.php";
include "php/server.php";

?>

<!DOCTYPE html>
<html lang="en">

<head>

  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>BSU-SC Research DB</title>

  <!-- Latest compiled and minified CSS -->
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">

  <!-- jQuery library -->
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>

  <!-- jQuery UI library -->
  <link rel="stylesheet" href="https://ajax.googleapis.com/ajax/libs/jqueryui/1.12.1/themes/smoothness/jquery-ui.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jqueryui/1.12.1/jquery-ui.min.js"></script>

  <!-- Popper JS -->
  <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>

  <!-- Latest compiled JavaScript -->
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>

  <!-- Font Awesome Icon -->
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">

  <!-- Font link -->
  <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Abril+Fatface|Poppins">

  <!-- Other resources -->
  <link rel="stylesheet" href="css/index_style.css">
  <link rel="stylesheet" href="css/responsive_style.css">

  <!-- Font size not working without these >_< -->
  <link rel="stylesheet" href="css/contact_style.css">  


</head>

<body>


  <!-- navigator, modal, body -->
  <div class="bg" style="padding-bottom: 25%;">
    <div class="sticky-top">


      <nav class="navbar navbar-expand-md navbar-light bg-light">

        <div class="container-fluid">

          <div>
            <div class="header-font">
              <a class="navbar-brand" href="index.php">Research DB</a>
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

              <li class="nav-item active">
                <a class="nav-link" href="index.php">Home</a>

              </li>


              <li class="nav-item">
                <a class="nav-link" href="php/about_page.php">About</a>

              </li>

              <li class="nav-item">
                <a class="nav-link" href="php/contact_page.php">Contact</a>

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

              <?php if (!isset($_SESSION['user_id'])) { ?>
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
                  <form id="logout" action="php/logout.php" method="post">
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

                    <a class="stretched-link" data-dismiss="modal" href="#" data-toggle="modal" data-target="#create-student_mc">Student</a>
              </div>

            <!-- Professor -->
              <div class="col mt-n3 mb-n3 modal-hover modal-height
                          d-flex align-items-center justify-content-center">
                
                  <a class="stretched-link" data-dismiss="modal" href="#" data-toggle="modal" data-target="#create-professor_mc">Professor</a>
              </div>
              
            </div>
          </div>

          <!-- modal footer -->
          <div class="modal-footer">
            <button class="btn btn-outline-danger sm-btn-font-size" data-dismiss="modal">Close</button>
          </div>

        </div>
      </div>

    <!-- modal -->
    </div>

        <!-- Modal for creating student account -->
    <div class="modal fade" id="create-student_mc">
      <div class="modal-dialog modal-dialog-scrollable">
          <div class="modal-content">

              <!-- modal header -->
              <div class="modal-header">

                  <h5 class="header-font">A student is registering...</h5>
                  <button class="close" data-dismiss="modal">&times;</button>
              </div>

              <!-- modal body -->
              <div class="modal-body">


                <form id="register_form_student" onsubmit="return false;" 
                        class="p-3" novalidate>


                <!-- Name -->    
                <div class="form-row">

                    <!-- Forename field -->

                    <div class="form-group col-sm-5 needs-validation">
                        <label for="form_fname_student">Forename:</label>

                        <input type="text"
                                class="form-control"
                                id="form_fname_student"
                                placeholder="Forename"
                                name="form_fname_student"
                                minlength="2"
                                maxlength="30"
                                required
                                oninput="studentFname(2)">
                                <div id="student-fname-invalid" class="invalid-feedback">Please fill out this field.</div>

                    </div>

                    <!-- Middle initial field -->

                    <div class="form-group col-sm-2 needs-validation">
                        <label for="form_mi_student">M.I.:</label>
                        <input type="text"
                                name="form_mi_student"
                                id="form_mi_student"
                                placeholder="M.I."
                                class="form-control"
                                maxlength="5">

                    </div>

                    <!-- Surname field -->

                    <div class="form-group col-sm-5 needs-validation">

                        <label for="form_sname_student">Surname:</label>
                        <input type="text"
                                name="form_sname_student"
                                id="form_sname_student"
                                placeholder="Surname"
                                class="form-control"
                                maxlength="30"
                                minlength="1"
                                required
                                oninput="studentSname(1)">
                                <div id="student-sname-invalid" class="invalid-feedback">Please fill out this field.</div>
                    </div>

                </div>

                <!-- Identification card -->

                <div class="custom-file form-group needs-validation">
                <label for="form_file1_student">Identification card:</label>

                    <!-- Front -->
                    <input type="file"
                            name="form_file1_student"
                            id="form_file1_student"
                            class="custom-file-input"
                            accept="image/*"
                            required
                            onchange="studentFile1()">
                    <label for="form_file1_student" id="form_file1_student_case" class="custom-file-label front mt-4">Front</label>

                    <!-- Script for adding the name of file to the label -->

                    <script>
                        $('#form_file1_student').on('change', function(e){
                            // Get file name
                            var fileName = e.target.files[0].name;

                            // Replace the "Choose file..." label
                            $(this).next('.front').html(fileName);
                        })


                    </script>                    
                </div>
                <div id="student-file1-invalid" class="invalid-feedback">Please fill out this field.</div>

                <!-- Back -->
                <div class="custom-file form-group needs-validation">

                    <input type="file"
                            name="form_file2_student"
                            id="form_file2_student"
                            class="custom-file-input"
                            accept="image/*"
                            required
                            onchange="studentFile2()">
                    <label for="form_file2_student" id="form_file2_student_case" class="custom-file-label back mt-2">Back</label>

                    <!-- Script for adding the name of file to the label -->

                    <script>
                        $('#form_file2_student').on('change', function(e){
                            // Get file name
                            var fileName = e.target.files[0].name;

                            // Replace the "Choose file..." label
                            $(this).next('.back').html(fileName);
                        })


                    </script>

                </div>
                <div id="student-file2-invalid" class="invalid-feedback">Please fill out this field.</div>

                <!-- Hide Year dropdown for alumnus -->
                <!-- Checkbox for alumnus -->
                <div class="form-group mt-4">

                    <input id="form_alumnus_student" name="form_alumnus_student" type="checkbox"
                            onclick="lessAlumnus()"> I am an Alumnus.</input>


                </div>
                <script src="js/moreAlumnus_script.js"></script>

                <!-- Year level field -->

                <div class="row ml-1">
                    <span id="dotss"></span>
                    <div class="form-group mr-1 needs-validation" id="more">
                            <label for="form_year_student">Year level:</label>


                            <select name="form_year_student"
                                    id="form_year_student"
                                    class="form-control
                                            select-picker
                                            border-muted"
                                            oninput="studentYear()">

                                <option value="">Choose year level</option>
                                <option value="1st year">1st year</option>
                                <option value="2nd year">2nd year</option>
                                <option value="3rd year">3rd year</option>
                                <option value="4th year">4th year</option>
                            </select>
                            <div id="student-year-invalid" class="invalid-feedback">Please fill out this field.</div>

                    </div>


                    <!-- Course field -->


                    <div class="form-group needs-validation">
                            <label for="form_course_student">Course:</label>

                            <select name="form_course_student"
                                    id="form_course_student"
                                    class="form-control
                                            select-picker
                                            border-muted"
                                    required
                                    oninput="studentCourse()">

                                <option value="">Choose course</option>
                                <option value="bsit">BSIT</option>
                                <option value="educ">EDUC</option>
                                <option value="educ">BM</option>
                            </select>
                            <div id="student-course-invalid" class="invalid-feedback">Please fill out this field.</div>

                    </div>

                </div>


                <!-- Address field -->

                <div class="form-group needs-validation">
                    <label for="form_address_student">Address:</label>
                    <input type="text"
                            name="form_address_student"
                            id="form_address_student"
                            placeholder="Address"
                            class="form-control"
                            maxlength="200"
                            minlength="8"
                            required
                            oninput="studentAddress()">
                            <div id="student-address-invalid" class="invalid-feedback">Please fill out this field.</div>

                </div>


                <!-- Username -->

                <div class="form-group needs-validation">
                    <label for="form_uname_student">Username:</label>
                    <input type="text"
                            name="form_uname_student"
                            id="form_uname_student"
                            placeholder="Username"
                            class="form-control"
                            maxlength="200"
                            minlength="4"
                            required
                            oninput="studentUname(4)">
                                <div id="student-uname-invalid" class="invalid-feedback">Please fill out this field.</div>

                </div>


                <!-- Password field -->

                <div class="form-group needs-validation">
                    <label for="form_pass_student">Passsword:</label>
                    <input type="password"
                            name="form_pass_student"
                            id="form_pass_student"
                            placeholder="Password"
                            class="form-control"
                            maxlength="30"
                            minlength="8"
                            required
                            oninput="studentPass(8)">
                                <div id="student-pass-invalid" class="invalid-feedback">Please fill out this field.</div>

                </div>

                <!-- Retype password field -->

                <div class="form-group needs-validation">
                    <label for="form_repass_student">Retype password:</label>
                    <input type="password"
                            name="form_repass_student"
                            id="form_repass_student"
                            placeholder="Retype password"
                            class="form-control"
                            maxlength="30"
                            minlength="8"
                            required
                            oninput="studentRepass()">
                                <div id="student-repass-invalid" class="invalid-feedback">Please fill out this field.</div>

                </div>



                <!-- Checkbox for terms of service and privacy policy -->
                <div class="form-group">
                    <input id="form_checkbox_student" name="form_checkbox_student" type="checkbox" value="1" required oninput="studentCheckbox()">
                    <span>I accept the <a href="#">Terms of Service</a> & <a href="#">Privacy Policy</a>.</span>
                                <div id="student-checkbox-invalid" class="invalid-feedback">Check this checkbox to continue.</div>


                </div>

                <!-- Register btn -->
                <div>
                    <button type="submit" class="btn btn-primary" name="registerBtn" 
                    onclick="submitValStudent();">Register</button>

                </div>

                <span class="d-flex justify-content-center mt-3">Already have an account?
                <a data-dismiss="modal" href="#" data-toggle="modal" data-target="#signIn_mc">&MediumSpace;Login here</a>.</span>                

                <hr>
                <p class="d-flex justify-content-center my-n3 pt-1">Register as a&MediumSpace;
                <a data-dismiss="modal" href="#" data-toggle="modal" data-target="#create-professor_mc">professor
                </a>&MediumSpace;instead.</p>




                </form>
              </div>


              </div>

          </div>

      <!-- Form validation -->
      <script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
      <script src="js/registration_student_script.js"></script>
      <!-- Modal for creating student account -->
    </div>

    <!-- Modal for creating professor account -->
    <div class="modal fade" id="create-professor_mc">
      <div class="modal-dialog modal-dialog-scrollable">
          <div class="modal-content">

              <!-- modal header -->
              <div class="modal-header">

                  <h5 class="header-font">A professor is registering...</h5>
                  <button class="close" data-dismiss="modal">&times;</button>
              </div>

              <!-- modal body -->
              <div class="modal-body">


                <form id="register_form_professor" onsubmit="return false;" class="p-3">

                        <div class="form-row">

                  <!-- Forename field -->

                  <div class="form-group col-sm-5 needs-validation">
                      <label for="form_fname_professor">Forename:</label>

                      <input type="text"
                              class="form-control"
                              id="form_fname_professor"
                              placeholder="Forename"
                              name="form_fname_professor"
                              minlength="2"
                              maxlength="30"
                              required>
                  </div>

                  <!-- Middle initial field -->

                  <div class="form-group col-sm-2  needs-validation">
                      <label for="form_mi_professor">M.I.:</label>
                      <input type="text"
                              name="form_mi_professor"
                              id="form_mi_professor"
                              placeholder="M.I."
                              class="form-control"
                              maxlength="5">                
                  </div>

                  <!-- Surname field -->


                  <div class="form-group col-sm-5 needs-validation">

                      <label for="form_sname_professor">Surname:</label>
                      <input type="text"
                              name="form_sname_professor"
                              id="form_sname_professor"
                              placeholder="Surname"
                              class="form-control"
                              maxlength="30"
                              minlength="1"
                              required>
                  </div>

              </div>

              <!-- Department field -->


              <div class="form-group needs-validation">
                      <label for="form_department">Department:</label>

                      <select name="form_department"
                              id="form_department"
                              class="form-control
                                      select-picker
                                      border-muted"
                              required>

                          <option value="" required>Choose department</option>
                          <option value="BIT Department" required>BIT Department</option>
                          <option value="EDUC Department" required>EDUC Department</option>
                      </select>

              </div>

              <!-- Identification card -->

              <div class="custom-file form-group needs-validation">
              <label for="form_file1_professor">Identification card:</label>

                  <!-- Front -->
                  <input type="file"
                          name="form_file1_professor"
                          id="form_file1_professor"
                          class="custom-file-input"
                          accept="image/*"
                          required>
                  <label for="form_file1_professor" class="custom-file-label front mt-4">Front</label>

                  <!-- Script for adding the name of file to the label -->

                  <script>
                      $('#form_file1_professor').on('change', function(e){
                        console.log(this);
                          // Get file name
                          var fileName = e.target.files[0].name;

                          // Replace the "Choose file..." label
                          $(this).next('.front').html(fileName);
                      })


                  </script>                    
              </div>

                  <!-- Back -->
                  <div class="custom-file form-group needs-validation">

                      <input type="file"
                              name="form_file2_professor"
                              id="form_file2_professor"
                              class="custom-file-input"
                              accept="image/*"
                              required>
                      <label for="form_file2_professor" class="custom-file-label back mt-2">Back</label>

                      <!-- Script for adding the name of file to the label -->

                      <script>
                          $('#form_file2_professor').on('change', function(e){
                              // Get file name
                              var fileName = e.target.files[0].name;

                              // Replace the "Choose file..." label
                              $(this).next('.back').html(fileName);
                          })


                      </script>

                  </div>



              <!-- Address field -->

              <div class="form-group mt-3 needs-validation">
                  <label for="form_address_professor">Address:</label>
                  <input type="text"
                          name="form_address_professor"
                          id="form_address_professor"
                          placeholder="Address"
                          class="form-control"
                          maxlength="200"
                          minlength="8"
                          required>

              </div>


              <!-- Username -->

              <div class="form-group needs-validation">
                  <label for="form_uname_professor">Username:</label>
                  <input type="text"
                          name="form_uname_professor"
                          id="form_uname_professor"
                          placeholder="Username"
                          class="form-control"
                          maxlength="200"
                          minlength="4"
                          required>

              </div>


              <!-- Password field -->


              <div class="form-group needs-validation">
                  <label for="form_pass_professor">Passsword:</label>
                  <input type="password"
                          name="form_pass_professor"
                          id="form_pass_professor"
                          placeholder="Password"
                          class="form-control"
                          maxlength="30"
                          minlength="8"
                          required>

              </div>

              <!-- Retype password field -->

              <div class="form-group needs-validation">
                  <label for="form_repass_professor">Retype password:</label>
                  <input type="password"
                          name="form_repass_professor"
                          id="form_repass_professor"
                          placeholder="Retype password"
                          class="form-control"
                          maxlength="30"
                          minlength="8"
                          required>

              </div>

              <!-- Checkbox -->
              <div class="form-group needs-validation">
                  <input id="form_checkbox_professor" name="form_checkbox_professor" type="checkbox" value="1" required>
                  <span>I accept the <a href="#">Terms of Service</a> & <a href="#">Privacy Policy</a>.</span>

              </div>

              <!-- Register btn -->
              <div>
                  <button type="submit" class="btn btn-primary"  name="registerBtn"
                  onclick="submitValProfessor();">Register</button>

              </div>

              <span class="d-flex justify-content-center mt-3">Already have an account?
              <a data-dismiss="modal" href="#" data-toggle="modal" data-target="#signIn_mc">&MediumSpace;Login here</a>.</span>                

              <hr>
              <p class="d-flex justify-content-center my-n3 pt-1">Register as a&MediumSpace;
              <a data-dismiss="modal" href="#" data-toggle="modal" data-target="#create-student_mc">student
              </a>&MediumSpace;instead.</p>


          </form>
              </div>


              </div>

          </div>

      <!-- Form validation -->
      <script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
      <script src="js/registration_professor_script.js"></script>
      <!-- Modal for creating professor account -->
    </div>

    <!-- Modal for sign in -->
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

                  <form id="login-form" onsubmit="return false;"
                          class="needs-validation
                                  mx-auto mb-3">
                      
                      
                      <!-- username field -->

                      <div class="form-group">
                          <label for="form_uname_login">Username:</label>
                          
                          <input type="text"
                                  class="form-control"
                                  id="form_uname_login"
                                  placeholder="Username"
                                  name="form_uname"
                                  minlength="4"
                                  maxlength="30"
                                  required>                

                      </div>

                      <!-- Password field -->


                      <div class="form-group mt-2">
                          <label for="form_pass_login">Passsword:</label>
                          <input type="password"
                                  name="form_pass_login"
                                  id="form_pass_login"
                                  placeholder="Password"
                                  class="form-control"
                                  maxlength="30"
                                  minlength="8"
                                  required>

                      </div>
                      <input type="hidden" id="redirect" name="redirect" value="<?php echo htmlspecialchars($_SERVER['REQUEST_URI']) ?>" />

                      
                      <!-- Checkbox -->
                      
                      
                      <div class="row">
                          <div class="form-group col">
                              <input type="checkbox">
                              <span>Remember me</span>
                          </div>

                          <!-- Register btn -->
                          <div class="col d-flex justify-content-end">
                              <button name="login-submit" id="login-submit" onclick="login()" 
                              type="submit" class="btn btn-primary">Login</button>
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

    

    <!-- body -->

    <div class="container-fluid">
      <div class="display-5 lg-margin sm-margin">
        <h1 class="header-font sm-font-size">Welcome to RSDB</h1>
        <p style="font-size:larger">Search the knowledge hidden within</p>

        <!-- Search form -->
        <form action="php/search_page.php" method="get">
          <div class="input-group mb-3 mt-4 sm-width l-width">
          <!-- Search button -->
            <div class="input-group-prepend">
              <button class="btn btn-outline-primary sm-btn-font-size"
                        type="submit">Search</button>
            </div>
              <!-- Search input -->
              <input type="hidden" name="page" value="1">
              <input type="text" class="form-control bg-transparent sm-width" id="search-input" name="query" autocomplete="off"
                      placeholder="Search for articles..." required>
          </div>
        </form>
        <div id="results"><!-- Search results --></div>


        <!-- Most search keywords -->

       <!--  <div class="container-fluid">
          <div class="row"> -->

            <?php  
            // $sql = "SELECT Title FROM researchstudy_table ORDER BY Views DESC";
            // $result = $conn->query($sql);
            // $mostViewed = array();
            // $x = 0;

            // if ($result->num_rows > 0) {
            //   // output data of each row
            //   while ($row = $result->fetch_assoc()) {
            //   $x++;
            //   $mostViewed[$x] = $row['Title'];
            //   }
            // } else {
            //   echo "0 results";
            // }
            ?>
            <!-- <h6 class="mr-2">Most Viewed:</h6>

            
            <div>
              <a href="#"><?php //echo '<u>'.$mostViewed[1].'</u>'; ?></a>
            </div>

            Margin changed to space -->
            <!-- <span>&ThickSpace;&ThickSpace;</span> -->

            <!-- <div> -->
              <!-- <a href="#"><?php //x`echo '<u>'.$mostViewed[2].'</u>'; ?></a> -->
            <!-- </div> -->

            <!-- Margin changed to space -->
            <!-- <span>&ThickSpace;&ThickSpace;</span> -->

            <!-- <div> -->
            <!-- Add '/' on line 919 col 33 -->
              <!-- <a href="#"></?php// echo '<u>'.$mostViewed[3].'</u>'; ?></a> -->
            <!-- </div> -->
            <!-- </ul> -->



          </div>
        </div>
      </div>
    </div>
  </div>


  <!-- Jumbotron -->
  <div class="jumbotron jumbotron-fluid
                jumbotron-bg-black text-white">
    <div class="container">

      <!-- Information modified -->
      <!-- Note: Change all jumbotron -->
      <h2 class="header-font">Bond With Us!</h2>
      <p> Explore, investigate, analyze, experiment, and test now.<br>
          Join the aspiring professional researchers at Bulacan State University - Sarmiento Campus.</p>
    </div>
  </div>


  <!-- Footer -->

  <footer class="border-top-2 pb-4">

    <div class="container">
      <div class="row">
        <div class="col-md-8 ft">
          <!-- data tooltip added -->
          <p style="margin-top: -1%">Copyright © 2020 Research DB. All rights reserved.<br>
            We use cookies to help provide and enhance our service and tailor content.<br>
            By continuing you, agree to our <a href="#" data-toggle="Please bare with us, this link is still on-progress..">Cookies Settings</a>.</p><br>

          <div style="margin-top: -4%;">
            <a href="#" data-toggle="tooltip" title="Please bare with us, this link is still on-progress..">Copyright</a>
            <span class="px-3">|</span>

            <a href="#" data-toggle="tooltip" title="Please bare with us, this link is still on-progress..">Terms of Use</a>
            <span class="px-3">|</span>

            <a href="#" data-toggle="tooltip" title="Please bare with us, this link is still on-progress..">Privacy Policy</a>

          </div>
        </div>

        <div class="col-md-4 l-mt sm-mt">
          <span>Follow us on:</span><br>
          
          <!-- Follow us link fixed -->
          <a href="https://www.facebook.com/bulsuofficial" class="fa fa-facebook-official sl" data-toggle="tooltip" title="Go to our official facebook page"></a>
          <a href="#" class="fa fa-instagram sl px-3" data-toggle="tooltip" title="Instragam link is coming soon..."></a>
          <a href="#" class="fa fa-twitter-square sl" data-toggle="tooltip" title="Twitter link is coming soon..."></a>
        </div>

      </div>
    </div>

  </footer>


  <script>
    $(function() {
      $('.ui-autocomplete-input').css('width','12px');
        $("#search-input").autocomplete({
            source: "php/action.php",
            select: function(event, ui) {   
                console.log(ui.item.value);
                    location.href="php/search_page.php?page=1&query="+ui.item.value;
            }
        });
    });
    </script>
    <!-- sweet alert -->
    <script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
    <script src="/js/login.js"></script>
    <script src="/js/registration_professor_script.js"></script>
    <script src="/js/registration_student_script.js"></script>
</body>

</html>