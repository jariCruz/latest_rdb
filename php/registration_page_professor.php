<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Professor Registration | BSU-SC Research DB</title>

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
    <link rel="stylesheet" href="../css/registration_style.css">

</head>
<body>

    <!-- Form -->
    <div class="container">
        <h1 class="d-flex justify-content-center header-font">A professor is registering...</h1>

        <form id="register_form"
         action="registration_page_professor_function.php"
         method="post"
         enctype="multipart/form-data"
                class="border border-dark rounded-lg
                        p-4 mx-auto mb-3 form-width">


            
            <div class="form-row">
               
                <!-- Forename field -->

                <div class="form-group col-sm-5 needs-validation">
                    <label for="form_fname">Forename:</label>
                    
                    <input type="text"
                            class="form-control"
                            id="form_fname"
                            placeholder="Forename"
                            name="form_fname"
                            minlength="2"
                            maxlength="30"
                            required>
                </div>

                <!-- Middle initial field -->

                <div class="form-group col-sm-2  needs-validation">
                    <label for="form_mi">M.I.:</label>
                    <input type="text"
                            name="form_mi"
                            id="form_mi"
                            placeholder="M.I."
                            class="form-control"
                            maxlength="5">                
                </div>

                <!-- Surname field -->


                <div class="form-group col-sm-5 needs-validation">

                    <label for="form_sname">Surname:</label>
                    <input type="text"
                            name="form_sname"
                            id="form_sname"
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
            <label for="form_file1">Identification card:</label>
                    
                <!-- Front -->
                <input type="file"
                        name="form_file1"
                        id="form_file1"
                        class="custom-file-input"
                        accept="image/*"
                        required>
                <label for="form_file1" class="custom-file-label front mt-4">Front</label>

                <!-- Script for adding the name of file to the label -->
                
                <script>
                    $('#form_file1').on('change', function(e){
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
                            name="form_file2"
                            id="form_file2"
                            class="custom-file-input"
                            accept="image/*"
                            required>
                    <label for="form_file2" class="custom-file-label back mt-2">Back</label>

                    <!-- Script for adding the name of file to the label -->
                    
                    <script>
                        $('#form_file2').on('change', function(e){
                            // Get file name
                            var fileName = e.target.files[0].name;

                            // Replace the "Choose file..." label
                            $(this).next('.back').html(fileName);
                        })


                    </script>
                
                </div>



            <!-- Address field -->

            <div class="form-group mt-3 needs-validation">
                <label for="form_address">Address:</label>
                <input type="text"
                        name="form_address"
                        id="form_address"
                        placeholder="Address"
                        class="form-control"
                        maxlength="200"
                        minlength="8"
                        required>

            </div>


            <!-- Username -->

            <div class="form-group needs-validation">
                <label for="form_address">Username:</label>
                <input type="text"
                        name="form_uname"
                        id="form_uname"
                        placeholder="Username"
                        class="form-control"
                        maxlength="200"
                        minlength="4"
                        required>

            </div>


            <!-- Password field -->


            <div class="form-group needs-validation">
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

            <!-- Retype password field -->

            <div class="form-group needs-validation">
                <label for="form_repass">Retype password:</label>
                <input type="password"
                        name="form_repass"
                        id="form_repass"
                        placeholder="Retype password"
                        class="form-control"
                        maxlength="30"
                        minlength="8"
                        required>

            </div>
            
            <!-- Checkbox -->
            <div class="form-group needs-validation">
                <input id="form_checkbox" name="form_checkbox" type="checkbox" value="1" required>
                <span>I accept the <a href="#">Terms of Service</a> & <a href="#">Privacy Policy</a>.</span>

            </div>

            <!-- Register btn -->
            <div>
                <button type="button" class="btn btn-primary"  name="registerBtn" id="registerBtn" 
                onclick="validate(); submitVal();">Register</button>

            </div>
            <span class="d-flex justify-content-center mt-3">Already have an account?<a href="login.php">&MediumSpace;Login here.</a></span>
                
            <hr>
            <p class="d-flex justify-content-center my-n3 pt-1">Register as a&MediumSpace;<a href="registration_page_student.php">student</a>&MediumSpace;instead.</p>

    
        </form>
    </div>

<!-- Form validation -->
<script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
<script src="../js/registration_professor_script.js"></script>


    
</body>
</html>
