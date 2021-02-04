function uploadVal() {
    var title = document.getElementById("form_title").value;
    var author = document.getElementById("form_author").value;
    var adviser = document.getElementById("form_adviser").value;
    var year = document.getElementById("form_year").value;
    var course = document.getElementById("form_course").value;
    var keywords = document.getElementById("form_keywords").value;
    var abstract = document.getElementById("form_abstract").value;
    var file = document.getElementById("form_file").value;
    var fd = new FormData();
    var actualFile = $('#form_file')[0].files;

    
    if (title.length != 0 && author.length != 0 && adviser.length != 0 && year.length != 0 
        && course.length != 0 && keywords.length != 0 && abstract.length != 0 && file.length != 0) {

        if (title.length < 10) {
          document.getElementById("form_title").className+=" was-validated";
        }else {
            if (author.length < 5) {
              document.getElementById("form_author").className+=" was-validated";
            }else {
                if (adviser.length < 5) {
                  document.getElementById("form_adviser").className+=" was-validated";
                }else {
                    if (keywords.length < 8) {
                      document.getElementById("form_keywords").className+=" was-validated";
                    }else {
                        if (abstract.length < 10) {
                          document.getElementById("form_abstract").className+=" was-validated";
                        }else {
                          document.getElementById("form_title").className+=" was-validated";
                          document.getElementById("form_author").className+=" was-validated";
                          document.getElementById("form_adviser").className+=" was-validated";
                          document.getElementById("form_keywords").className+=" was-validated";
                          document.getElementById("form_keywords").className+=" was-validated";
                          document.getElementById("form_abstract").className+=" was-validated";
                                swal({
                                    title: "Upload Research?",
                                    text: "Check details before proceeding.",
                                    icon: "warning",
                                    buttons: {
                                      cancel: "Cancel",
                                      ok:{
                                        text: "Ok",
                                        value: "ok",
                                      }
                                    },
                                  })
                                  .then((ok)=>{
                                      if (ok) {
                                        //hide modal for uploading research
                                        $("#researchUpload_mc").modal('hide');
                                        swal({
                                          title: "Uploading Research...",
                                          text: "This may take for a while.",
                                          icon: "../img/upload_loading_icon.gif",
                                          button: false,
                                          closeOnClickOutside: false,
                                          closeOnEsc: false
                                        });
                                        fd.append('file',actualFile[0]);
                                        fd.append('title',title);
                                        fd.append('author',author);
                                        fd.append('adviser',adviser);
                                        fd.append('year',year);
                                        fd.append('course',course);
                                        fd.append('keywords',keywords);
                                        fd.append('abstract',abstract);
                                        $.ajax({
                                          url: 'rs_upload_page_function.php',
                                          type: 'post',
                                          data: fd,
                                          contentType: false,
                                          processData: false,
                                          success: function(response){
                                            //update research studies
                                            updateResearch();
                                            //reset field to '' after uploading success
                                            swal({
                                              title: "Upload success",
                                              text: response,
                                              icon: "success",
                                              button: true,
                                            });
                                            document.getElementById("form_title").value = '';
                                            document.getElementById("form_author").value = '';
                                            document.getElementById("form_adviser").value = '';
                                            document.getElementById("form_course").value = '';
                                            document.getElementById("form_keywords").value = '';
                                            document.getElementById("form_year").value = '';
                                            document.getElementById("form_abstract").value = '';
                                            document.getElementById("form_file").value = '';

                                            $('#form_file').next('.custom-file-label').html('Choose file...');
                                          }
                                        });
                                            // var xmlhttp = new XMLHttpRequest();
                                            // xmlhttp.onreadystatechange = function() {
                                            //   if (this.readyState == 4 && this.status == 200) {
                                            //     document.getElementById("research-livesearch").innerHTML = this.responseText;
                                            //   }
                                            // };
                                            // xmlhttp.open("GET", "admin_append_function.php", true);
                                            // xmlhttp.send();
                                      }else {
                                        swal.stopLoading();
                                        swal.close();
                                      }
                                  });
                            }

                    }

                }

            }

        }
    
    }else {
      document.getElementById("form_title").className+=" was-validated";
      var author = document.getElementById("form_author").className+=" was-validated";
      var adviser = document.getElementById("form_adviser").className+=" was-validated";
      var year = document.getElementById("form_year").className+=" was-validated";
      var course = document.getElementById("form_course").className+=" was-validated";
      var keywords = document.getElementById("form_keywords").className+=" was-validated";
      var abstract = document.getElementById("form_abstract").className+=" was-validated";
      var file = document.getElementById("form_file").className+=" was-validated";
    }
}

//update research function
function updateResearch() {
  $(document).ready(function() {
      function loadData(page) {
        $.ajax({
          url: "research_pagination.php",
          type: "POST",
          cache: false,
          data: {
            page_no: page
          },
          success: function(response) {
            $("#research-content").html(response);
          }
        });
      }
      loadData();

      // Pagination code
      // $(document).on("click", ".pagination li a", function(e) {
      //   e.preventDefault();
      //   var pageId = $(this).attr("id");
      //   loadData(pageId);
      // });
    });
}