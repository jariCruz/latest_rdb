<?php

  // Connect database 

  require_once('server.php');

  $limit = 5;

  if (isset($_POST['page_no'])) {
      $page_no = $_POST['page_no'];
  }else{
      $page_no = 1;
  }
  if (isset($_POST['query'])) {
    $search = $_POST['query'];
  }

  $offset = ($page_no-1) * $limit;

  $query = "SELECT * 
  FROM researchstudy_table 
  WHERE Title LIKE '%$search%' OR Keywords LIKE '%$search%' OR Abstract LIKE '%$search%'
  ORDER BY Title ASC 
  LIMIT $offset, $limit";

  // this sql is for getting counts
  $sql_count = " SELECT * 
  FROM researchstudy_table 
  WHERE Title LIKE '%$search%' OR Keywords LIKE '%$search%' OR Abstract LIKE '%$search%'";
  $count_result = mysqli_query($conn, $sql_count);

  $result = mysqli_query($conn, $query);

  $output = "";

  $output.='<div class="row">

                    <!-- first column -->
                    <div class="col-sm-3 pl-4 pt-4 sm-hide">

                        <p>';
                        if (mysqli_num_rows($count_result) > 0) {
                                $output.= mysqli_num_rows($count_result);
                            } else {
                                $output.= '0';
                            }
                            $output.=' Results</p><!-- results count -->
                        <hr>';

                        if (mysqli_num_rows($count_result) === 0) {
                            $output.= '';
                        } else {
                            $output.='<!-- Filter Department -->
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
                                </div>';
                         }

                        $output.='<!-- first column -->
                    </div>


                    <!-- Content -->
                    <div class="col">

                        <div class="d-flex align-items-center justify-content-center pt-2 sm-hide">


                            <!-- Use the "active class" to change the btn color -->';
                            if (mysqli_num_rows($count_result) > 0) {
                                $output.='<div class="btn-group text-dark">

                                    <button class="btn btn-outline-dark sm-research-fs active">Most relevant</button>

                                    <button class="btn btn-outline-dark sm-research-fs">Most reads</button>

                                    <button class="btn btn-outline-dark sm-research-fs">Most downloads</button>
                                </div>';
                            } else {
                                $output.= '';
                            }

                        $output.='</div>';

  if (mysqli_num_rows($result) > 0) {
    $output.= '<hr class="mb-0">';
  while ($row = mysqli_fetch_assoc($result)) {

  $output.='<div class="cards hBg border border-left-0 border-right-0 border-top-0 border-semilightblue">

              <div class="card-body">


                <!-- Research studies information -->
                <div class="row">
                  <div class="col">
                    <h4 class="sm-body-font-size">'.$row["Title"].'</h4><!-- Research title -->

                    <!-- Author name -->
                    <a href="#" class="cLink">'.$row["Author"].'</a>

                    <!-- Abstract contraction -->
                  <p>
                  '.substr($row["Abstract"], 0, 250).'
                    <span id="dots_'.$row["RS_ID"].'">...</span>
                    <span id="readMore_'.$row["RS_ID"].'" style="display: none;">
                    '.substr($row["Abstract"], 250).'</span>
                    <a type="button" onclick="readAbstract('.$row["RS_ID"].')" id="readBtn_'.$row["RS_ID"].'" class="cLink">Read more...</a>
                  </p>
                  <!-- end of abstract -->

                    <!-- Statistics for small media -->
                    <p id="miniStats_'.$row["RS_ID"].'"><small class="sm-show-stat">';
                    if ($row["Views"] === 0) {
                       $output.="0";
                    } else {  
                      $row["Views"];
                    };
                    $output.=' Views |'; 
                    if ($row["Downloads"] === 0) {  
                           $output.="0"; 
                        } else {  
                          $row["Downloads"]; 
                          };
                          $output.=' Downloads
                      </small></p>

                    <!-- show this when a user is logged in -->';
                    if (isset($_SESSION["user_id"])) {

                      $output.='<a id="view_href_'.$row["RS_ID"].'" type="button" 
                                              onclick="addDownload('.$row["RS_ID"].',"download.php?file='.$row["File"].'")" 
                                              class="fa fa-download btn btn-outline-primary sm-btn-font-size cLink"> Download</a><!-- Download button -->
                      
                                            <a id="download_href_'.$row["RS_ID"].'" type="button" 
                                              onclick="addView('.$row["RS_ID"].',"../Research_Studies/'.$row["File"].'")" 
                                              class="fa fa-file btn btn-outline-primary sm-btn-font-size cLink"> View PDF</a><!-- View button -->';

                    } else {

                      $output.='<!-- show this when user isnt logged in -->
                      
                                            <a id="view_href_'.$row["RS_ID"].'" type="button" 
                                              onclick="needToLoginDownload()" class="fa fa-download btn btn-outline-primary sm-btn-font-size cLink"> Download</a><!-- Download button -->
                      
                                            <a id="download_href_'.$row["RS_ID"].'" type="button" 
                                              onclick="needToLoginView()" class="fa fa-file btn btn-outline-primary sm-btn-font-size cLink"> View PDF</a><!-- View button -->';

                    };



                    $output.='<!-- Modal -->
                                        <div class="modal fade" id="cModalContent_'.$row["RS_ID"].'" role="dialog">
                                          <div class="modal-dialog modal-dialog-scrollable">
                    
                                            <!-- Modal header -->
                                            <div class="modal-content">
                                              <div class="modal-title">
                    
                                                <div class="modal-header">
                                                  <div class="btn-group">
                                                    <!-- Download PDF (logged in)-->';
                                if (isset($_SESSION["user_id"])) {

                                  $output.='<button type="button" onclick="addDownload('.$row["RS_ID"].',"download.php?file='.$row["File"].'")" class="btn btn-outline-dark fa fa-download sm-btn-font-size"> Download</button><!-- Download button -->
                                  
                                                                    <!-- View PDF (logged in)-->
                                                                    <button type="submit" onclick="addView('.$row["RS_ID"].',"../Research_Studies/'.$row["File"].'")" class="btn btn-outline-dark fa fa-file sm-btn-font-size"> View PDF</button><!-- View button -->';
                                } else {

                                  $output.='<!-- Download PDF -->
                                                                    <button type="button" onclick="needToLoginDownload()" class="btn btn-outline-dark fa fa-download sm-btn-font-size"> Download</button><!-- Download button -->
                                  
                                                                    <!-- View PDF -->
                                                                    <button type="submit" onclick="needToLoginView()" class="btn btn-outline-dark fa fa-file sm-btn-font-size"> View PDF</button><!-- View button -->';
                                };

                              $output.='</div>
                                                            <button type="button" class="close" data-dismiss="modal">&times;</button>
                                                          </div>
                              
                                                        </div>
                              
                                                        <!-- Modal details -->
                              
                                                        <div class="modal-body">
                                                          <!-- Make the title color black -->
                                                          <!-- Make the hover color blue -->
                              
                                                          <div class="cfont cs-2">'.$row["Title"].'</div><!-- research title -->
                                                          <div><a href="#">'.$row["Author"].'</a></div><!-- author name -->
                              
                                                          <hr class="bg-muted">
                              
                                                          <p class="text-uppercase">Abstract</p>
                              
                                                          <p>'.$row["Abstract"].'</p><!-- research abstract -->
                              
                                                        </div>
                              
                                                        <div class="modal-footer">
                                                          <button type="button" class="btn btn-outline-danger sm-btn-font-size" data-dismiss="modal">Close</button>
                              
                                                        </div>
                              
                              
                              
                              
                                                      </div>
                                                    </div>
                                                  </div>
                              
                                                  <!-- Mini tab for short details
                                                      This <a> tag represent the button for the whole research study -->
                              
                                                  <a href="#cModalContent_'.$row["RS_ID"].'" class="stretched-link" data-toggle="modal" data-backdrop="static"></a>
                                                </div>
                              
                                                <!-- Statistics for large media -->
                              
                                                <div class="col-2 sm-hide-stat">
                                                  <div class=" pt-2 text-ash">
                                                    <p id="viewCounts_'.$row["RS_ID"].'" class="text-center small"><small>';
                        if ($row["Views"] === 0) { 
                          $output.="0"; 
                        } else {  
                          $output.=$row["Views"];
                          };

                        $output.='<br>Readers</small></p><!-- count of views -->
                        
                                            </div>
                        
                                            <div class="pt-2 text-ash">
                                              <p id="downloadCounts_'.$row["RS_ID"].'" class="text-center small"><small>';
                        if ($row["Downloads"] === 0) { 
                          $output.="0"; 
                        } else { 
                          $output.=$row["Downloads"];
                          }

                        $output.='<br>Downloads</small></p><!-- count of downloads -->
                    </div>


                  </div>

                </div> <!-- End of research studies information -->


              </div>
            </div>';
  }
  $output.='</div>
    </div>';

  $sql = "SELECT * FROM researchstudy_table";

  $records = mysqli_query($conn, $sql);

  $totalRecords = mysqli_num_rows($records);

  $totalPage = ceil($totalRecords/$limit);

  $output.='<div class="container mt-3">';
  $output.="<ul class='pagination justify-content-center' style='margin:20px 0'>";

  for ($i=1; $i <= $totalPage ; $i++) { 
     if ($i == $page_no) {
    $active = "active";
     }else{
    $active = "";
     }

      $output.="<li class='page-item $active'><a class='page-link' id='$i' href=''>$i</a></li>";
  }

  $output.= "</ul>";
  $output.='</div>';

  }
  $output.="No Result Found";

  //echo response
  echo $output;