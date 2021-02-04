<?php
require "header.php";
include "server.php";
//paginationsht
if (isset($_GET['page'])) {
  $page = $_GET['page'];
} else {
  $page = 1;
}
//limit kung ilan gusto mo i display
$limit = 5;
//saan mag sisimula ung i display mo
$start = ($page - 1) * $limit;


if (isset($_GET['query'])) {
  $search = $_GET['query'];
} else {
  $search = '';
}

?>

<!DOCTYPE html>

<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Search | BSU-SC Research DB</title>

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
  <!--<link rel="stylesheet" href="../css/query_style.css">-->
  <link rel="stylesheet" href="../css/query_style.css">
  <link rel="stylesheet" href="../css/responsive_style.css">

</head>

<body>


  <!-- navigator -->

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

        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#collapseNavbar">
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
              <a class="nav-link" href="contact_page.php">Contact</a>

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
                <a class="nav-link" href="#" data-toggle="modal" data-target="#signIn_mc">Sign in</a>
              </li>

              <li class="nav-item">
                <a class="nav-link" href="#" data-toggle="modal" data-target="#create_mc">Create account</a>
              </li>
            <?php } else { ?>
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

              <a href="registration_page_student.php" class="stretched-link">Student</a>
            </div>

            <!-- Professor -->
            <div class="col mt-n3 mb-n3 modal-hover modal-height
                          d-flex align-items-center justify-content-center">

              <a href="registration_page_professor.php" class="stretched-link">Professor</a>
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


  <!-- Modal for signing an account -->
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

          <form action="login_function.php" method="post" class="needs-validation
                                  mx-auto mb-3">


            <!-- Forename field -->

            <div class="form-group">
              <label for="form_fname">Username:</label>

              <input type="text" class="form-control" id="form_uname" placeholder="Username" name="form_uname" minlength="2" maxlength="30" required>

            </div>

            <!-- Password field -->


            <div class="form-group mt-2">
              <label for="form_pass">Passsword:</label>
              <input type="password" name="form_pass" id="form_pass" placeholder="Password" class="form-control" maxlength="30" minlength="8" required>

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
                <button name="login-submit" id="login-submit" type="button" class="btn btn-primary" onclick="login()">Login</button>
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

  <!-- Search bar -->
  <div class="container-fluid
                bg-muted
                border border-primary
                    border-left-0
                    border-right-0">
    <form action="search_page.php" method="get" autocomplete="off">
      <div class="input-group d-flex justify-content-center">

        <div class="input-group-prepend py-4 w-100 mw-40rem">
          <form action="#">
            <button class="btn btn-outline-primary sm-btn-font-size" type="submit">Search</button>
            <input type="hidden" name="page" value="<?php echo 1 ?>">
            <input required id="search-input" name="query" class="form-control" type="text">
            <button type="reset" class="btn btn-default fa fa-remove">
          </form>
        </div>

      </div>
    </form>
  </div>

  <?php
  //if (isset($_POST['search-button'])) {
  //$files = scandir('../Research_Studies/');
  //this sql naman ay para ipakita ang nilalaman ng nakalimit
  $sql = " SELECT * from researchstudy_table 
  where Title LIKE '%$search%' OR Keywords LIKE '%$search%' OR Abstract LIKE '%$search%' ORDER BY Title ASC
  LIMIT $start, $limit ";
  //this sql is for getting the number of results
  $sql_count = " SELECT * from researchstudy_table 
  where Title LIKE '%$search%' OR Keywords LIKE '%$search%' OR Abstract LIKE '%$search%'";
  $result = mysqli_query($conn, $sql);
  $count_result = mysqli_query($conn, $sql_count);
  $number_pages = ceil(mysqli_num_rows($count_result) / $limit);
  ?>
  <!-- Main content -->
  <div class="container-fluid">
    <div class="row">

      <!-- first column -->
      <div class="col-sm-3 pl-4 pt-4 sm-hide">

        <p><?php if (mysqli_num_rows($count_result) > 0) {
              echo mysqli_num_rows($count_result);
            } else {
              echo '0';
            } ?> Results</p><!-- results count -->
        <hr>

        <?php
        if (mysqli_num_rows($count_result) === 0) {
          echo '';
        } else { ?>
          <!-- Filter Department -->
                <label>Filter Department:</label>
    
                <br>
                <div class="ml-3">
                    <input type="checkbox" id="title">
                    <label for="#title">Title</label>
    
                    <br>
    
                    <input type="checkbox" id="keyword">
                    <label for="#keyword">Keyword</label>
    
                    <br>
    
                    <input type="checkbox" id="abstract">
                    <label for="#abstract">Abstract</label>
    
                    <br>
                    
                    <input type="checkbox" id="content">
                    <label for="#content">Content</label>
                </div>
        <?php } ?>

        <!-- first column -->
      </div>

      <!-- Content -->
      <div class="col">

        <div class="d-flex align-items-center justify-content-center pt-2 sm-hide">


          <!-- Use the 'active class' to change the btn color -->
          <?php if (mysqli_num_rows($count_result) > 0) { ?>
            <div class="btn-group text-dark">

              <button class="btn btn-outline-dark sm-btn-font-size active">Most relevant</button>

              <button class="btn btn-outline-dark sm-btn-font-size">Most reads</button>

              <button class="btn btn-outline-dark sm-btn-font-size">Most downloads</button>
            </div>
          <?php } else {
            echo '';
          } ?>

        </div>

    <!-- Here is the whole research study
                This part includes the research study details
                    (titles, authors, abstract, view pdf, download file,
                    and statistics for reads and downloads)-->

        <?php
        if (mysqli_num_rows($result) > 0) {
        echo '<hr class="mb-0">';
          while ($row = mysqli_fetch_array($result)) {
        ?>
            <div class="cards hBg 
            border border-left-0
                            border-right-0
                            border-top-0
                            border-semilightblue">

              <div class="card-body">


                <!-- Research studies information -->
                <div class="row">
                  <div class="col">
                    <h4 class="sm-body-font-size"><?php echo $row["Title"] ?></h4><!-- Research title -->

                    <!-- Author name -->
                    <a href="#" class="cLink"><?php echo $row["Author"] ?></a>
                  
                  <!-- Abstract contraction -->
                  <p>
                    <?php echo substr($row['Abstract'], 0, 250) ?>
                    <span id="dots_<?php echo $row['RS_ID']; ?>">...</span>
                    <span id="readMore_<?php echo $row['RS_ID']; ?>" style="display: none;">
                    <?php echo substr($row['Abstract'], 250, 500) ?>...</span>
                    <a type="button" onclick="readAbstract(<?php echo $row['RS_ID'] ?>)" 
                      id="readBtn_<?php echo $row['RS_ID']; ?>" class="cLink">Read more</a>
                  </p>
                  <!-- end of abstract -->

                    <!-- Statistics for small media -->
                    <p id="miniStats_<?php echo $row['RS_ID'] ?>"><small class="sm-show-stat">
                      <?php if ($row['Views'] === 0) {
                        echo '0';} else {  echo $row['Views']; } ?> Views | 
                        <?php if ($row['Downloads'] === 0) {  echo '0'; } else {  echo $row['Downloads']; } ?> Downloads
                      </small></p>


                    <!-- show this when a user is logged in -->
                    <?php if (isset($_SESSION['user_id'])) { ?>
                      <!-- Pending status -->
                      <?php if($_SESSION['status'] === "pending") { ?>
                        <a id="view_href_<?php echo $row['RS_ID'] ?>" type="button" onclick="notVerified()" class="fa fa-download btn btn-outline-primary sm-btn-font-size cLink"> Download</a><!-- Download button -->

                        <a id="download_href_<?php echo $row['RS_ID'] ?>" type="button" onclick="notVerified()" class="fa fa-file btn btn-outline-primary sm-btn-font-size cLink"> View PDF</a><!-- View button -->
                      <?php }else { ?>
                      <!-- Verified status -->
                        <a id="view_href_<?php echo $row['RS_ID'] ?>" type="button" onclick="addDownload(<?php echo $row['RS_ID'] ?>,'download.php?file=<?php echo $row['File'] ?>'); addDownloadMini(<?php echo $row['RS_ID'] ?>,'download.php?file=<?php echo $row['File'] ?>')" class="fa fa-download btn btn-outline-primary sm-btn-font-size cLink"> Download</a><!-- Download button -->

                        <a id="download_href_<?php echo $row['RS_ID'] ?>" type="button" onclick="addView(<?php echo $row['RS_ID'] ?>,'../Research_Studies/<?php echo $row['File'] ?>'); addViewMini(<?php echo $row['RS_ID'] ?>,'../Research_Studies/<?php echo $row['File'] ?>')" class="fa fa-file btn btn-outline-primary sm-btn-font-size cLink"> View PDF</a><!-- View button -->
                      <?php } ?>
                    <?php } else { ?>

                      <!-- show this when user isn't logged in -->

                      <a id="view_href_<?php echo $row['RS_ID'] ?>" type="button" onclick="needToLoginDownload()" class="fa fa-download btn btn-outline-primary sm-btn-font-size cLink"> Download</a><!-- Download button -->

                      <a id="download_href_<?php echo $row['RS_ID'] ?>" type="button" onclick="needToLoginView()" class="fa fa-file btn btn-outline-primary sm-btn-font-size cLink"> View PDF</a><!-- View button -->

                    <?php } ?>



                    <!-- Modal -->
                    <div class="modal fade" id="cModalContent_<?php echo $row['RS_ID']; ?>" role="dialog">
                      <div class="modal-dialog modal-dialog-scrollable">

                        <!-- Modal header -->
                        <div class="modal-content">
                          <div class="modal-title">

                            <div class="modal-header">
                              <div class="btn-group">
                                <!-- Download PDF (logged in)-->
                                <?php if (isset($_SESSION['user_id'])) { ?>
                                  <!-- Pending status -->
                                  <?php if($_SESSION['status'] === "pending") { ?>
                                    <a id="view_href_<?php echo $row['RS_ID'] ?>" type="button" onclick="notVerified()" class="fa fa-download btn btn-outline-primary sm-btn-font-size cLink"> Download</a><!-- Download button -->

                                    <a id="download_href_<?php echo $row['RS_ID'] ?>" type="button" onclick="notVerified()" class="fa fa-file btn btn-outline-primary sm-btn-font-size cLink"> View PDF</a><!-- View button -->
                                  <?php }else { ?>
                                  <!-- Verified status -->
                                    <a id="view_href_<?php echo $row['RS_ID'] ?>" type="button" onclick="addDownload(<?php echo $row['RS_ID'] ?>,'download.php?file=<?php echo $row['File'] ?>'); addDownloadMini(<?php echo $row['RS_ID'] ?>,'download.php?file=<?php echo $row['File'] ?>')" class="fa fa-download btn btn-outline-primary sm-btn-font-size cLink"> Download</a><!-- Download button -->

                                    <a id="download_href_<?php echo $row['RS_ID'] ?>" type="button" onclick="addView(<?php echo $row['RS_ID'] ?>,'../Research_Studies/<?php echo $row['File'] ?>'); addViewMini(<?php echo $row['RS_ID'] ?>,'../Research_Studies/<?php echo $row['File'] ?>')" class="fa fa-file btn btn-outline-primary sm-btn-font-size cLink"> View PDF</a><!-- View button -->
                                  <?php } ?>
                                <?php } else { ?>
                                  <!-- Download PDF -->
                                  <button type="button" onclick="needToLoginDownload()" class="btn btn-outline-dark fa fa-download sm-btn-font-size"> Download</button><!-- Download button -->

                                  <!-- View PDF -->
                                  <button type="submit" onclick="needToLoginView()" class="btn btn-outline-dark fa fa-file sm-btn-font-size"> View PDF</button><!-- View button -->
                                <?php } ?>

                              </div>
                              <button type="button" class="close" data-dismiss="modal">&times;</button>
                            </div>

                          </div>

                          <!-- Modal details -->

                          <div class="modal-body">
                            <!-- Make the title color black -->
                            <!-- Make the hover color blue -->

                            <div class="cfont cs-2"><?php echo $row['Title'] ?></div><!-- research title -->
                            <div><a href="#"><?php echo $row['Author'] ?></a></div><!-- author name -->

                            <hr class="bg-muted">

                            <p class="text-uppercase">Abstract</p>

                            <p><?php echo $row['Abstract'] ?></p><!-- research abstract -->

                          </div>

                          <div class="modal-footer">
                            <button type="button" class="btn btn-outline-danger sm-btn-font-size" data-dismiss="modal">Close</button>

                          </div>




                        </div>
                      </div>
                    </div>

                    <!-- Mini tab for short details
                        This <a> tag represent the button for the whole research study -->

                    <a href="#cModalContent_<?php echo $row['RS_ID']; ?>" class="stretched-link" data-toggle="modal" data-backdrop="static"></a>
                  </div>

                  <!-- Statistics for large media -->

                  <div class="col-2 sm-hide-stat">
                    <div class=" pt-2 text-ash">
                      <p id="viewCounts_<?php echo $row['RS_ID'] ?>" class="text-center small"><small>
                        <?php if ($row['Views'] === 0) {  echo '0';} else { echo $row['Views'];} ?>
                        <br>Readers</small></p><!-- count of views -->

                    </div>

                    <div class="pt-2 text-ash">
                      <p id="downloadCounts_<?php echo $row['RS_ID'] ?>" class="text-center small"><small>
                        <?php if ($row['Downloads'] === 0) { echo '0';} else { echo $row['Downloads'];} ?>
                        <br>Downloads</small></p><!-- count of downloads -->
                    </div>


                  </div>

                </div> <!-- End of research studies information -->


              </div>



            </div>
        <?php
          }
        } else {
          echo "No Results Found";
        } ?>

    <!-- The whole research study details ends here -->


        <!-- Pagination -->

        <div class="container mt-3">
          <ul class="pagination justify-content-center">
            <?php if ($page > 1) { ?>
              <li class="page-item"><a class="page-link" href="search_page.php?page=<?php echo ($page - 1) ?>&query=<?php echo $search ?>">Previous</a></li>
            <?php } ?>
            <?php for ($i = 1; $i <= $number_pages; $i++) { ?>
              <li <?php if($page == $i){?>class="page-item active" <?php } ?>>
                <a class="page-link" href="search_page.php?page=<?php echo $i ?>&query=<?php echo $search ?>"><?php echo $i ?></a></li>
            <?php } ?>
            <?php if (($i-1) > $page) { ?>
              <li class="page-item"><a class="page-link" href="search_page.php?page=<?php echo ($page + 1) ?>&query=<?php echo $search ?>">Next</a></li>
            <?php } ?>
          </ul>

        </div>

        <!-- div for Content -->
      </div>

      <!-- div for row -->
    </div>

    <!-- div for container -->
  </div>


  <!-- Footer -->

  <footer class="border-top-2 pb-4 mt-footer">

    <div class="container">
      <div class="row">
        <div class="col-md-8">
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


  <!-- Sweetalert js cdn -->
  <script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
  <!-- Autocomplete -->
  <script>
    $(function() {
      $("#search-input").autocomplete({
        source: "action.php",
        select: function(event, ui) {
          console.log(ui.item.value);
          location.href = "search_page.php?page=1&query=" + ui.item.value;
        }
      });
    });
  </script>
  <script src="../js/addCount.js"></script>
  <script src="../js/needToLogin.js"></script>
  <script src="../js/notVerified.js"></script>
  <script src="../js/login.js"></script>
  <!-- Read more and less link function -->
  <script src="../js/readAbstract_function.js"></script>
</body>

</html>