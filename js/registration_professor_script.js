function validateProfessor() {
    
}
function submitValProfessor() {
    
    var fname = document.getElementById("form_fname_professor").value;
    var sname = document.getElementById("form_sname_professor").value;
    var mi = document.getElementById("form_mi_professor").value;
    var file1 = document.getElementById("form_file1_professor").value;
    var file2 = document.getElementById("form_file2_professor").value;
    var department = document.getElementById("form_department").value;
    var address = document.getElementById("form_address_professor").value;
    var uname = document.getElementById("form_uname_professor").value;
    var pass = document.getElementById("form_pass_professor").value;
    var repass = document.getElementById("form_repass_professor").value;
    var checkbox = document.getElementById("form_checkbox_professor");
    var actualFile1 = $('#form_file1_professor')[0].files;
    var actualFile2 = $('#form_file2_professor')[0].files;
    
    if (fname.length != 0 && sname.length != 0 && file1.length != 0 && file2.length != 0 
    && department.length != 0 && address.length != 0 && uname.length != 0 && pass.length != 0 
    && repass.length != 0) {
        if (fname.length < 2) {
            document.getElementById("form_fname_professor").parentElement.className+=" was-validated";
        }else {
            if (sname.length < 1) {
              document.getElementById("form_sname_professor").parentElement.className+=" was-validated";
            }else {
                if (uname.length < 4) {
                  document.getElementById("form_uname_professor").parentElement.className+=" was-validated";
                }else {
                    if (pass.length < 8) {
                      document.getElementById("form_pass_professor").parentElement.className+=" was-validated";
                    }else {
                        if (pass != repass) {
                            swal({
                                title: "Registration Failed!",
                                text: "Password and retype password is not the same!",
                                icon: "error",
                                button: true,
                              });
                            document.getElementById("form_repass_professor").parentElement.className+=" was-validated";
                        }else {
                            if (checkbox.checked == false) {
                              document.getElementById("form_checkbox_professor").parentElement.className+=" was-validated";
                            }else {
                                swal({
                                    title: "Register Account?",
                                    text: "Make sure everything is right before proceeding.",
                                    icon: "warning",
                                    buttons: true,
                                    dangerMode: true,
                                  })
                                  .then((ok)=>{
                                      if (ok) {
                                        swal({
                                          title: "Creating Account...",
                                          text: "This may take for a while.",
                                          icon: "/img/upload_loading_icon.gif",
                                          button: false,
                                          closeOnClickOutside: false,
                                          closeOnEsc: false,
                                        });
                                        var data = new FormData();
                                        data.append('form_fname', fname);
                                        data.append('form_sname', sname);
                                        data.append('form_mi', mi);
                                        data.append('form_department', department);
                                        data.append('form_address', address);
                                        data.append('form_uname', uname);
                                        data.append('form_pass', pass);
                                        data.append('form_repass', repass);
                                        data.append('form_file1', actualFile1[0]);
                                        data.append('form_file2', actualFile2[0]);
                                        $.ajax({
                                          url: '/php/registration_page_professor_function.php',
                                          type: 'post',
                                          data: data,
                                          contentType: false,
                                          processData: false,
                                          success: function(response){
                                            console.log(response);
                                            if(response == 'exist!'){
                                                swal({
                                                  title: "Registration Failed",
                                                  text: "File already exists!",
                                                  icon: "error",
                                                  button: true,
                                                });
                                            }else if(response == 'fake!'){
                                                swal({
                                                  title: "Registration Failed",
                                                  text: "Make sure you upload an image file!",
                                                  icon: "error",
                                                  button: true,
                                                });
                                            }else if(response == 'large'){
                                                swal({
                                                  title: "Registration Failed",
                                                  text: "File too large!",
                                                  icon: "error",
                                                  button: true,
                                                });
                                                }else if(response == 'large'){
                                                swal({
                                                  title: "Registration Failed",
                                                  text: "File too large!",
                                                  icon: "error",
                                                  button: true,
                                                });
                                            }else if(response == 'username!'){
                                                swal({
                                                    title: "Registration Failed",
                                                    text: "Username was already taken.",
                                                    icon: "error",
                                                    button: true,
                                                });
                                                document.getElementById("form_uname_professor").parentElement.className+=" was-validated";
                                            }else {
                                                swal({
                                                  title: "Registration Success!",
                                                  text: "Account successfully created,\nclick OK to return?",
                                                  icon: "success",
                                                  buttons: true,
                                                });
                                                document.getElementById("form_fname_professor").value = '';
                                                document.getElementById("form_sname_professor").value = '';
                                                document.getElementById("form_mi_professor").value = '';
                                                document.getElementById("form_file1_professor").value = '';
                                                document.getElementById("form_file2_professor").value = '';
                                                document.getElementById("form_department").value = '';
                                                document.getElementById("form_address_professor").value = '';
                                                document.getElementById("form_uname_professor").value = '';
                                                document.getElementById("form_pass_professor").value = '';
                                                document.getElementById("form_repass_professor").value = '';
                                                document.getElementById("form_checkbox_professor").checked = false;
                                                $('#form_file1_professor').next('.front').html('Choose file...');
                                                $('#form_file2_professor').next('.back').html('Choose file...');
                                                $("#create-professor_mc").modal('hide');
                                            }
                                            
                                          }
                                        });
                                      }else {
                                        false;
                                      }
                                  });
                            }

                        }

                    }

                }

            }

        }
    }else {
      document.getElementById("form_fname_professor").parentElement.className+=" was-validated";
      document.getElementById("form_sname_professor").parentElement.className+=" was-validated";
      document.getElementById("form_file1_professor").parentElement.className+=" was-validated";
      document.getElementById("form_file2_professor").parentElement.className+=" was-validated";
      document.getElementById("form_department").parentElement.className+=" was-validated";
      document.getElementById("form_address_professor").parentElement.className+=" was-validated";
      document.getElementById("form_uname_professor").parentElement.className+=" was-validated";
      document.getElementById("form_pass_professor").parentElement.className+=" was-validated";
      document.getElementById("form_repass_professor").parentElement.className+=" was-validated";
      document.getElementById("form_checkbox_professor").parentElement.className+=" was-validated";
    }
}