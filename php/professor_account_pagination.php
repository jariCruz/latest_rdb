<?php

	// Connect database 
  require "header.php";

	require_once('server.php');

	$limit = 5;

	if (isset($_POST['page_no'])) {
	    $page_no = $_POST['page_no'];
	}else{
	    $page_no = 1;
	}
  //update status of professor
  if (isset($_POST['verify_id_professor'])){
  $verify_id =  $_POST['verify_id_professor'];

  $sql = "UPDATE professor_table 
  SET professor_account_status='verified' 
  WHERE professor_id=$verify_id";
  $conn->query($sql);
  }

  //deny status
  if (isset($_POST['deny_id_professor'])){
    $deny_id =  $_POST['deny_id_professor'];

  $sql = "UPDATE professor_table 
  SET professor_account_status='denied' 
  WHERE professor_id=$deny_id";
  $conn->query($sql);
  }

	$offset = ($page_no-1) * $limit;

	$query = "SELECT * FROM researchstudy_table 
	ORDER BY Title ASC 
	LIMIT $offset, $limit";

	// this sql is for getting counts
	$sql_count = " SELECT * from researchstudy_table ";
	$count_result = mysqli_query($conn, $sql_count);

	$result = mysqli_query($conn, $query);

	$output = "";

  ?>
<div class="row mt-3">
                    <?php
                    $sql_professor = "SELECT * 
                    FROM professor_table
                    WHERE professor_account_status = 'pending'
                    ORDER BY professor_lname ASC
                    LIMIT $offset, $limit";
                    $result_professor = $conn->query($sql_professor);
                    //this sql is for getting the number of results
                    $sql_count_professor = " SELECT * 
                    from professor_table 
                    where professor_account_status = 'pending'";
                    $count_result_professor = mysqli_query($conn, $sql_count_professor);
                    $number_pages_professor = ceil(mysqli_num_rows($count_result_professor) / $limit);
                    ?>

                    <!-- first column -->
                        <div class="col-sm-3 sm-hide">

                            <p><?php if (mysqli_num_rows($result_professor) > 0) {
                                    echo mysqli_num_rows($result_professor);
                                } else { 
                                    echo '0';
                                } ?> Results</p>
                            <hr>

                            <!-- Account Status -->

                            <label>Account Status:</label>
                            <div class="dropdown dropright">
                                <button class="btn btn-outline-secondary dropdown-toggle 
                                        mw-btn-150p" id="professorAccountStatus" data-toggle="dropdown">Select</button>

                                <div class="dropdown-menu">
                                    <a class="dropdown-item" href="#" onclick="changeBtnTxt('professorAccountStatus', 'Pending')">Pending</a>

                                    <a class="dropdown-item" href="#" onclick="changeBtnTxt('professorAccountStatus', 'Verified')">Verified</a>

                                    <a class="dropdown-item" href="#" onclick="changeBtnTxt('professorAccountStatus', 'Denied')">Denied</a>

                                </div>


                            </div>


                            <br>

                            <!-- Sort name -->
                        <?php if(mysqli_num_rows($result_professor) !== 0){ ?>
                            <label class="mt-2 mb-2">Sort Name:</label>


                            <div class="dropdown dropright">
                                <button class="btn btn-outline-secondary dropdown-toggle
                                        mw-btn-150p" id="professorSort" data-toggle="dropdown">Select</button>

                                <div class="dropdown-menu">
                                    <a class="dropdown-item" href="#" onclick="changeBtnTxt('professorSort', 'Ascending')">Ascending</a>

                                    <a class="dropdown-item" href="#" onclick="changeBtnTxt('professorSort', 'Descending')">Descending</a>

                                </div>

                            </div>

                            <br>

                            <!-- Filter Department -->
                            <label>Filter Department:</label>

                            <br>
                            <input type="checkbox" id="bsit">
                            <label for="#bsit">BSIT</label>

                            <br>
                            <input type="checkbox" id="educ">
                            <label for="#educ">EDUC</label>
                        <?php } ?>



                            <!-- first column -->
                        </div>

                    <!-- second column -->
                    <div class="col">

                        

                        <!-- professor account starts here -->
                        <?php
                        if (mysqli_num_rows($result_professor) > 0) { ?>
                            <!-- output data of each row -->

                        <p>Professor Pending...</p>
                        <hr>
                         <?php   while ($row_professor = mysqli_fetch_array($result_professor)) {
                        ?>
                                <!-- Margin top added and col set to 5 -->
                                <div class="row mt-3" id="border-bg">
                                    <div class="col-sm-5">


                                        <p>Name: <?php echo $row_professor['professor_lname']; ?>, <?php echo $row_professor['professor_fname'] . ' ' . $row_professor['professor_mi']; ?></p>
                                        <p>Department: <?php echo $row_professor['professor_department']; ?></p>
                                        <p>Address: <?php echo $row_professor['professor_address'] ?>.</p>


                                    </div>

                                    <div class="col-sm-4">
                                        <!-- Display this for pending section -->

                                        <button onclick="denyProfessor(<?php echo $row_professor['professor_id'] ?>)" class="btn btn-danger w-btn-acc sm-btn-font-size">Deny</button>
                                        <button onclick="verifyProfessor(<?php echo $row_professor['professor_id'] ?>)" class="btn btn-primary w-btn-acc sm-btn-font-size">Verify</button>


                                        <!-- display this for verified section -->
                                        <!--
                                <div class="alert alert-info">
                                    <strong>Verified!</strong>
                                </div>
                            -->
                                        <!-- Display this for denied section -->
                                        <!--

                                <div class="alert alert-danger">
                                    <strong>Denied!</strong>
                                </div>

                            -->
                                        <!-- ********************************* -->
                                        <!--  Remove the two <br> tags below   -->
                                        <!-- when pending section isn't in use -->
                                        <!-- ********************************* -->

                                        <br>
                                        <br>

                                        <a href="#" data-target="#identification_card_<?php echo $row_professor['professor_id']; ?>" data-toggle="modal">See identification card <span class="fa fa-id-card"></span></a>

                                        <!-- modal -->
                                        <div class="modal fade" id="identification_card_<?php echo $row_professor['professor_id']; ?>">
                                            <div class="modal-dialog">
                                                <div class="modal-content">

                                                    <!-- modal header -->
                                                    <div class="modal-header">
                                                        <button class="close fa fa-close" data-dismiss="modal"></button>
                                                    </div>

                                                    <div id="id_content_<?php echo $row_professor['professor_id']; ?>" class="carousel slide">

                                                        <!-- indicators -->
                                                        <ul class="carousel-indicators">
                                                            <li data-target="id_content_<?php echo $row_professor['professor_id']; ?>" data-slide-to="0" class="active"></li>
                                                            <li data-target="id_content_<?php echo $row_professor['professor_id']; ?>" data-slide-to="1"></li>
                                                        </ul>

                                                        <!-- slideshow -->
                                                        <div class="carousel-inner">

                                                            <div class="carousel-item active">
                                                                <?php
                                                                $sname = $row_professor['professor_lname'];
                                                                $fname =  $row_professor['professor_fname'];
                                                                $mi = $row_professor['professor_mi'];
                                                                $fullname = $sname . ' ' . $fname . ' ' . $mi . ' '; ?>
                                                                <img class="mw-100 mh-100" src="../Professor_ID/<?php echo str_replace(' ', '_', $fullname); ?>/<?php echo $row_professor['professor_id_front']; ?>" alt="identification card front" width="500" height="500">
                                                            </div>

                                                            <div class="carousel-item">
                                                                <img class="mw-100 mh-100" src="../Professor_ID/<?php echo str_replace(' ', '_', $fullname); ?>/<?php echo $row_professor['professor_id_back']; ?>" alt="identification card back" width="500" height="500">
                                                            </div>


                                                        </div>

                                                        <!-- left and right controls -->
                                                        <a class="carousel-control-prev" href="#id_content_<?php echo $row_professor['professor_id']; ?>" data-slide="prev">
                                                            <span class="fa fa-chevron-left" style="color: #000000"></span>
                                                        </a>

                                                        <a class="carousel-control-next" href="#id_content_<?php echo $row_professor['professor_id']; ?>" data-slide="next">
                                                            <span class="fa fa-chevron-right" style="color: #000000"></span>
                                                        </a>

                                                    </div>

                                                    <!-- footer -->
                                                    <div class="modal-footer">
                                                        <button class="btn btn-outline-danger" data-dismiss="modal">Close</button>
                                                    </div>

                                                </div>

                                            </div>

                                        </div>

                                    </div>





                                    <!-- professor account ends here -->
                                </div>
                        <?php } ?>
                        <?php

                        $sql = "SELECT * FROM professor_table";

                        $records = mysqli_query($conn, $sql);

                        $totalRecords = mysqli_num_rows($records);

                        $totalPage = ceil($totalRecords/$limit);

                        echo '<div class="container mt-3">';
                        echo "<ul class='pagination justify-content-center' style='margin:20px 0'>";

                        for ($i=1; $i <= $totalPage ; $i++) { 
                           if ($i == $page_no) {
                          $active = "active";
                           }else{
                          $active = "";
                           }

                            echo "<li class='page-item $active'><a class='page-link' id='$i' href=''>$i</a></li>";
                        }

                        echo "</ul>";
                        echo '</div>';
                      ?>
                        <?php }else {
                            echo "No Results Found";
                        } ?>


                        <!-- second column -->
                    </div>



                    <!-- row -->
                </div>