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

  ?>
<div class="row mt-3">

                    <?php
                    $sql_admin = "SELECT * 
                    FROM admin_table
                    ORDER BY admin_lname ASC
                    LIMIT $offset, $limit";
                    $result_admin = $conn->query($sql_admin);
                    //this sql is for getting the number of results
                    $sql_count_admin = " SELECT * 
                    from admin_table";
                    $count_result_admin = mysqli_query($conn, $sql_count_admin);
                    $number_pages_admin = ceil(mysqli_num_rows($count_result_admin) / $limit);
                    ?>

                    <!-- first column -->
                    <!-- sm-hide remove -->
                    <div class="col-sm-3">

                        <p id="admin_results"><?php if (mysqli_num_rows($count_result_admin) > 0) {
                            echo mysqli_num_rows($count_result_admin);
                        }else {
                            echo '0';
                        } ?> Results</p>
                        <hr>
                    <?php if(mysqli_num_rows($result_admin) !== 0){ ?>
                        <!-- Sort name -->

                        <!-- row added -->

                        <div class="row">
                            <div class="col">

                                <label class="mb-2">Sort Name:</label>


                                <div class="dropdown dropright">
                                    <button class="btn btn-outline-secondary dropdown-toggle
                                                mw-btn-150p" id="adminSort" data-toggle="dropdown">Select</button>

                                    <div class="dropdown-menu">
                                        <a class="dropdown-item" href="#" onclick="changeBtnTxt('adminSort', 'Ascending')">Ascending</a>

                                        <a class="dropdown-item" href="#" onclick="changeBtnTxt('adminSort', 'Descending')">Descending</a>

                                    </div>

                                </div>

                                <br>
                                <?php } ?>
                            </div>

                            <div class="col-8">
                                <!-- Create account -->
                                <label class="mr-2">Create account:</label>
                                <br>
                                <button data-target="#createAdmin_mc" data-toggle="modal" class="btn btn-outline-primary">+ Append</button>

                                <!-- Modal for creating admin account -->
                                <div class="modal fade" id="createAdmin_mc">
                                    <div class="modal-dialog">
                                        <div class="modal-content">

                                            <!-- modal header -->
                                            <div class="modal-header">
                                                <h5 class="modal-title header-font">Creating admin...</h5>
                                                <button class="close" data-dismiss="modal">&times;</button>
                                            </div>

                                            <!-- modal body -->
                                            <div class="modal-body">

                                                <form id="register_form" onsubmit="return false;" class="p-4 mx-auto mb-3" novalidate>

                                                    <!-- Name -->
                                                    <div class="form-row">

                                                        <!-- Forename field -->

                                                        <div class="form-group col-sm-5 needs-validation">
                                                            <label for="form_fname_admin">Forename:</label>

                                                            <input type="text" class="form-control" id="form_fname_admin" placeholder="Forename" name="form_fname_admin" minlength="2" maxlength="30" required oninput="adminFname(2)">
                                                        <div id="admin-forename-invalid" class="invalid-feedback">Please fill out this field.</div>


                                                        </div>

                                                        <!-- Middle initial field -->

                                                        <div class="form-group col-sm-2 needs-validation">
                                                            <label for="form_mi_admin">M.I.:</label>
                                                            <input type="text" name="form_mi_admin" id="form_mi_admin" placeholder="M.I." class="form-control" maxlength="5">

                                                        </div>

                                                        <!-- Surname field -->

                                                        <div class="form-group col-sm-5 needs-validation">

                                                            <label for="form_sname_admin">Surname:</label>
                                                            <input type="text" name="form_sname_admin" id="form_sname_admin" placeholder="Surname" class="form-control" maxlength="30" minlength="1" required
                                                            oninput="adminSname(1)">
                                                        <div id="admin-surname-invalid" class="invalid-feedback">Please fill out this field.</div>
                                                        </div>

                                                    </div>

                                                    <!-- Username field -->

                                                    <div class="form-group">
                                                        <label for="form_uname_admin">Username:</label>

                                                        <input type="text" class="form-control" id="form_uname_admin" placeholder="Username" name="form_uname_admin" minlength="4" maxlength="30" required
                                                            oninput="adminUname(4)">
                                                        <div id="admin-username-invalid" class="invalid-feedback">Please fill out this field.</div>

                                                    </div>

                                                    <!-- Password field -->


                                                    <div class="form-group mt-2">
                                                        <label for="form_pass_admin">Passsword:</label>
                                                        <input type="password" name="form_pass_admin" id="form_pass_admin" placeholder="Password" class="form-control" maxlength="30" minlength="8" required
                                                            oninput="adminPass(8)">
                                                        <div id="admin-password-invalid" class="invalid-feedback">Please fill out this field.</div>

                                                    </div>

                                                    <!-- Retype Password field -->


                                                    <div class="form-group mt-2">
                                                        <label for="form_repass_admin">Retype Passsword:</label>
                                                        <input type="password" name="form_repass_admin" id="form_repass_admin" placeholder="Retype Password" class="form-control" maxlength="30" minlength="8" required
                                                            oninput="adminRepass()">
                                                    <div id="admin-repassword-invalid" class="invalid-feedback">Please fill out this field.</div>
                                                    <div id="admin-repassword-valid" class="valid-feedback">Passwords matched.</div>

                                                    </div>

                                                    <!-- Register btn -->
                                                    <div class="col d-flex justify-content-end">
                                                        <button onclick="createAdmin();" type="submit" class="btn btn-primary">Create</button>
                                                    </div>



                                                </form>
                                            </div>


                                        </div>

                                    </div>
                                </div>
                            </div>

                        </div>
                        
                        <!-- hr added -->
                        <hr class="sm-show">

                        <!-- first column -->
                    </div>

                    <!-- second column -->
                    <div class="col">

                        
                    <div id="admin_accounts">
                        <!-- admin account starts here -->
                        <?php
                        if (mysqli_num_rows($result_admin) > 0) { ?>

                        <!-- header-font added -->
                        <p class="header-font">Admin account list...</p>
                        <hr>
                             <!-- output data of each row -->
                            <?php while ($row_admin = mysqli_fetch_array($result_admin)) {
                        ?>
                        <div class="row" id="border-bg">
                            <div class="col-sm-8">


                                <p>Name: <?php echo $row_admin['admin_lname']; ?>, <?php echo $row_admin['admin_fname'].' '.$row_admin['admin_mi']; ?></p>
                                <p>Username: <?php echo $row_admin['admin_username']; ?></p>


                            </div>


                            <!-- ********************************* -->
                            <!--  Remove the two <br> tags below   -->
                            <!-- when pending section isn't in use -->
                            <!-- ********************************* -->

                            <br>
                            <br>


                            <!-- admin account ends here -->
                        </div>
                        <?php }
                        } ?>
                    </div>


                        <!-- second column -->
                    </div>



                    <!-- row -->
                </div>