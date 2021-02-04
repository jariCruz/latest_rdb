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

	$offset = ($page_no-1) * $limit;

  //verify status student
  if (isset($_POST['verify_id'])){
    $verify_id =  $_POST['verify_id'];

  $sql = "UPDATE student_table 
  SET student_account_status='verified' 
  WHERE student_id=$verify_id";
  $conn->query($sql);
  }

  //deny status
  if (isset($_POST['deny_id'])){
    $deny_id =  $_POST['deny_id'];

  $sql = "UPDATE student_table 
  SET student_account_status='denied' 
  WHERE student_id=$deny_id";
  $conn->query($sql);
  }

  ?>
  <div class="row mt-3">
                    <!-- Select sql for student -->
                    <?php
                    $sql_student = "SELECT * 
                    FROM student_table 
                    WHERE student_account_status = 'pending'
                    ORDER BY student_lname ASC
                    LIMIT $offset, $limit";
                    $result_student = $conn->query($sql_student);
                    //this sql is for getting the number of results
                    $sql_count_student = " SELECT * 
                    from student_table 
                    where student_account_status = 'pending'";
                    $count_result_student = mysqli_query($conn, $sql_count_student);
                    $number_pages_student = ceil(mysqli_num_rows($count_result_student) / $limit);

                    ?>
                    <!-- first column -->
                        <div class="col-sm-3 sm-hide">

                            <p><?php if (mysqli_num_rows($result_student) > 0) { 
                            echo mysqli_num_rows($result_student);
                            } else {
                                echo '0';
                            } ?> Results</p>
                            <hr>

                            <!-- Account Status -->
                            <label>Account Status:</label>
                            <div class="dropdown dropright">
                                <button class="btn btn-outline-secondary dropdown-toggle 
                                        mw-btn-150p" id="studentAccountStatus" data-toggle="dropdown">Select</button>

                                <div class="dropdown-menu">
                                    <a class="dropdown-item" href="#" onclick="changeBtnTxt('studentAccountStatus', 'Pending')">Pending</a>

                                    <a class="dropdown-item" href="#" onclick="changeBtnTxt('studentAccountStatus', 'Verified')">Verified</a>

                                    <a class="dropdown-item" href="#" onclick="changeBtnTxt('studentAccountStatus', 'Denied')">Denied</a>

                                </div>


                            </div>


                            <br>

                            <!-- Sort name -->
                        <?php if(mysqli_num_rows($result_student) !== 0){ ?>
                            <label class="mt-2 mb-2">Sort Name:</label>


                            <div class="dropdown dropright">
                                <button class="btn btn-outline-secondary dropdown-toggle
                                        mw-btn-150p" id="studentSort" data-toggle="dropdown">Select</button>

                                <div class="dropdown-menu">
                                    <a class="dropdown-item" href="#" onclick="changeBtnTxt('studentSort', 'Ascending')">Ascending</a>

                                    <a class="dropdown-item" href="#" onclick="changeBtnTxt('studentSort', 'Descending')">Descending</a>

                                </div>

                            </div>

                            <br>

                            <!-- Filter Department -->
                            <label>Filter Course:</label>

                            <br>
                            <input type="checkbox" id="bsit">
                            <label for="#bsit">BSIT</label>

                            <br>
                            <input type="checkbox" id="educ">
                            <label for="#educ">EDUC</label>

                        <?php }else { echo ''; } ?>


                            <!-- first column -->
                        </div>

                    <!-- second column -->
                    <div class="col">
                        <?php
                        if (mysqli_num_rows($result_student) > 0) { ?>
                            <p>Student Pending...</p>
                            <hr>

                        <?php while ($row_student = mysqli_fetch_array($result_student)) { ?>

                        

                        <!-- student account starts here -->
                                <!-- Margin top added and col set to 5 -->
                                <div class="row mt-3" id="border-bg">
                                    <div class="col-sm-5">


                                        <p>Name: <?php echo $row_student['student_lname']; ?>,
                                            <?php echo $row_student['student_fname'];  ?> 
                                            <?php echo $row_student['student_mi'] ?></p>
                                        <p>CYS: <?php echo $row_student['student_course']; ?></p>
                                        <p>Address: <?php echo $row_student['student_address'] ?></p>


                                    </div>

                                    <div class="col-sm-4">
                                        <!-- Display this for pending section -->

                                        <button onclick="denyStudent(<?php echo $row_student['student_id']; ?>)" 
                                        class="btn btn-danger w-btn-acc sm-btn-font-size">Deny</button>
                                        <button onclick="verifyStudent(<?php echo $row_student['student_id']; ?>)" 
                                        class="btn btn-primary w-btn-acc sm-btn-font-size">Verify</button>


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

                                        <a href="#" data-target="#identification_card_<?php echo $row_student['student_id']; ?>" data-toggle="modal">See identification card <span class="fa fa-id-card"></span></a>

                                        <!-- modal -->
                                        <div class="modal fade" id="identification_card_<?php echo $row_student['student_id']; ?>">
                                            <div class="modal-dialog">
                                                <div class="modal-content">

                                                    <!-- modal header -->
                                                    <div class="modal-header">
                                                        <button class="close fa fa-close" data-dismiss="modal"></button>
                                                    </div>

                                                    <div id="id_content_<?php echo $row_student['student_id']; ?>" class="carousel slide">

                                                        <!-- indicators -->
                                                        <ul class="carousel-indicators">
                                                            <li data-target="id_content_<?php echo $row_student['student_id']; ?>" data-slide-to="0" class="active"></li>
                                                            <li data-target="id_content_<?php echo $row_student['student_id']; ?>" data-slide-to="1"></li>
                                                        </ul>

                                                        <!-- slideshow -->
                                                        <div class="carousel-inner">

                                                            <div class="carousel-item active">

                                                                <?php
                                                                $sname = $row_student['student_lname'];
                                                                $fname =  $row_student['student_fname'];
                                                                $mi = $row_student['student_mi'];
                                                                $fullname = $sname . ' ' . $fname . ' ' . $mi . ' '; ?>
                                                                <img class="mw-100 mh-100" src="../Student_ID/<?php echo str_replace(' ', '_', $fullname.'/'); ?><?php echo $row_student['student_id_front']; ?>" alt="identification card front" width="500" height="500">
                                                            </div>

                                                            <div class="carousel-item">
                                                                <img class="mw-100 mh-100" src="../Student_ID/<?php echo str_replace(' ', '_', $fullname.'/'); ?>/<?php echo $row_student['student_id_back']; ?>" alt="identification card back" width="500" height="500">
                                                            </div>


                                                        </div>

                                                        <!-- left and right controls -->
                                                        <a class="carousel-control-prev" href="#id_content_<?php echo $row_student['student_id']; ?>" data-slide="prev">
                                                            <span class="fa fa-chevron-left" style="color: #000000"></span>
                                                        </a>

                                                        <a class="carousel-control-next" href="#id_content_<?php echo $row_student['student_id']; ?>" data-slide="next">
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





                                    <!-- student account ends here -->
                                </div>

                        <?php } ?>
                        <?php

                        $sql = "SELECT * FROM student_table";

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

                        <?php }else{
                            echo "No Results Found";
                        }
                            
                        ?>


                        <!-- second column -->
                    </div>



                    <!-- row -->
                </div>