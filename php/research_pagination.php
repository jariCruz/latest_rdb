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

	$query = "SELECT * FROM researchstudy_table 
	ORDER BY Title ASC 
	LIMIT $offset, $limit";

	// this sql is for getting counts
	$sql_count = " SELECT * from researchstudy_table ";
	$count_result = mysqli_query($conn, $sql_count);

	$result = mysqli_query($conn, $query);

	$output = "";

  ?>
  <div class="row">

      <!-- first column -->
      <!-- sm-hide remove -->
      <div class="col-sm-3 pl-4 pt-4">

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
          <!-- Filter changed -->
                <div class="row">
                    <!-- br for see list -->
                    <br>


                  <!-- Checkboxes for Adviser added -->
                  <div class="col">

                    <div class="mt-4">
                      <label>ADVISER</label>
                    </div>


                    <br>
                      <input type="checkbox" name="filter_checkbox_adviser1" id="filter_checkbox_adviser1">
                      <label for="filter_checkbox_adviser1" id="filter_label_adviser1">Von, Webster&nbsp;(10)</label>


                    <br>
                      <input type="checkbox" name="filter_checkbox_adviser2" id="filter_checkbox_adviser2">
                      <label for="filter_checkbox_adviser2" id="filter_label_adviser2">Santos, Noel&nbsp;(9)</label>

                    <br>
                      <input type="checkbox" name="filter_checkbox_adviser3" id="filter_checkbox_adviser3">
                      <label for="filter_checkbox_adviser3" id="filter_label_adviser3">Cruz, Jari&nbsp;(3)</label>
                    <br>

                    
                    <div id="more_adviser" class="more_filter">
                      <input type="checkbox" name="filter_checkbox_adviser4" id="filter_checkbox_adviser4" class="mb-3">
                      <label for="filter_checkbox_adviser4" id="filter_label_adviser4" class="mb-3">Ferrer, Deng deng&nbsp;(2)</label>
                      <br>

                      <input type="checkbox" name="filter_checkbox_adviser5" id="filter_checkbox_adviser5">
                      <label for="filter_checkbox_adviser4" id="filter_label_adviser5">Gomera, Lylyn&nbsp;(1)</label>
                      <br>
                    </div>
                    

                    <br>
                    <button type="button" class="btn btn-outline-primary" id="adviser_btn" onclick="seeFilter('adviser_btn', 'more_adviser')">See more</button>
                  </div>

                  <!-- Checkboxes for year added -->
                  <div class="col-7 ">
                    <hr class="sm-hide">

                    <label class="mt-4">YEAR</label>
                    <br>


                    <br>
                      <input type="checkbox" name="filter_checkbox_year1" id="filter_checkbox_year1">
                      <label for="filter_checkbox_year1" id="filter_label_year1">2014&nbsp;(1)</label>


                    <br>
                      <input type="checkbox" name="filter_checkbox_year2" id="filter_checkbox_year2">
                      <label for="filter_checkbox_year2" id="filter_label_year2">2015&nbsp;(5)</label>
                    

                    <br>
                      <input type="checkbox" name="filter_checkbox_year3" id="filter_checkbox_year3">
                      <label for="filter_checkbox_year3" id="filter_label_year3">2016&nbsp;(9)</label>


                    <div id="more_year" class="more_filter">
                      <input type="checkbox" name="filter_checkbox_year4" id="filter_checkbox_year4" class="mb-3">
                      <label for="filter_checkbox_year4" id="filter_label_year4" class="mb-3">2017&nbsp;(9)</label>
                      <br>

                      <input type="checkbox" name="filter_checkbox_year5" id="filter_checkbox_year5">
                      <label for="filter_checkbox_year4" id="filter_label_year5">2018&nbsp;(9)</label>
                      <br>
                    </div>
                                    

                    <br>
                    <button type="button" class="btn btn-outline-primary" id="year_btn" onclick="seeFilter('year_btn', 'more_year')">See more</button>
                  </div>


                <!-- row -->
                </div>

                <!-- Checkboxes for Course added -->
                <div>
                  <hr class="sm-hide">

                  <div class="mt-4">
                    <label>COURSE</label>
                  </div>


                  <br>
                    <input type="checkbox" name="filter_checkbox_author1" id="filter_checkbox_author1">
                    <label for="filter_checkbox_author1" id="filter_label_author1">BSIT&nbsp;(10)</label>
                  <br>
                  
                  <div id="more_course" class="more_filter">
                    <input type="checkbox" name="filter_checkbox_course2" id="filter_checkbox_course2" class="mb-3">
                    <label for="filter_checkbox_course2" id="filter_label_course2" class="mb-3">EDUC&nbsp;(2)</label>
                    <br>

                    <input type="checkbox" name="filter_checkbox_course3" id="filter_checkbox_course3">
                    <label for="filter_checkbox_course3" id="filter_label_course3">BM&nbsp;(1)</label>
                    <br>
                  </div>
                  

                  <br>
                  <button type="button" class="btn btn-outline-primary" id="course_btn" onclick="seeFilter('course_btn', 'more_course')">See more</button>
                </div>
                

                <script src="../js/moreFilter_function.js"></script>
                

        <?php } ?>

        <!-- hr added -->
        <hr class="sm-show">

        <!-- first column -->
      </div>
      
      <!-- Content -->
      <div class="col">

        <!-- sm-hide remove and change padding top to 3 -->

        <div class="d-flex align-items-center justify-content-center pt-3">


          <!-- Use the 'active class' to change the btn color -->
          <?php if (mysqli_num_rows($count_result) > 0) { ?>
            <!-- btn-group change to nav -->
            <!-- nav-justied added and icon added -->
            <ul class="nav nav-pills nav-justified" role="tablist">
              <li class="nav-item">
                <a class="nav-link fa fa-star active" data-toggle="pill" href="#mostRelevant">Relevant</a>
              </li>
              <li class="nav-item">
                <a class="nav-link fa fa-star" data-toggle="pill" href="#mostReads">Read</a>
              </li>
              <li class="nav-item">
                <a class="nav-link fa fa-star" data-toggle="pill" href="#mostDownloads">Download</a>
              </li>
            
            </ul>
          <?php } else {
            echo '';
          } ?>

        </div>

        <!-- tab content for most relevant, most reads, and most downloads -->
        <div class="tab-content">
          <!-- Most relevant -->
          <div id="mostRelevant" class="tab-pane fade active show">
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
                } ?>
                <?php

                $sql = "SELECT * FROM researchstudy_table";

                $records = mysqli_query($conn, $sql);

                $totalRecords = mysqli_num_rows($records);

                $totalPage = ceil($totalRecords/$limit);

                // Remove divs
                echo "<ul class='pagination justify-content-center mt-5'>";

                for ($i=1; $i <= $totalPage; $i++) { 
                  if ($i == $page_no) {
                  $active = "active";
                  }else{
                  $active = "";
                  }


                  }
                   
                // Pagination modified

                // Last page
                echo "<li class='page-item'><a class='fa fa-angle-double-left page-link' data-toggle='tooltip' title='Last page' id='$i' href=''></a></li>";

                // Prev
                echo "<li class='page-item'><a class='fa fa-angle-left page-link' data-toggle='tooltip' title='Next' id='$i' href=''></a></li>";

                // Input
                echo "<li class='page-item'><p class='px-3'>Page: <input type='number' min='1' max='7' data-toggle='tooltip' title='Press Enter to go to page' value='1'></input> of 7</p></li>";

                // Next
                echo "<li class='page-item'><a class='fa fa-angle-right page-link' data-toggle='tooltip' title='Next' id='$i' href=''></a></li>";
                // Last page
                echo "<li class='page-item'><a class='fa fa-angle-double-right page-link' data-toggle='tooltip' title='Last page' id='$i' href=''></a></li>";




                echo "</ul>";


                

              ?>

              <?php } else {
                echo "No Results Found";
              } ?>

              <!-- The whole research study details ends here -->

          
          </div>

          <!-- Most reads tab -->
          <div id="mostReads" class="tab-pane fade">
           <!-- remove p tag -->
           <p>Most reads</p>
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
                } ?>
                <?php

                $sql = "SELECT * FROM researchstudy_table";

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

              <?php } else {
                echo "No Results Found";
              } ?>

              <!-- The whole research study details ends here -->

          
          </div>

          <!-- Most downloads tabs -->
          <div id="mostDownloads" class="tab-pane fade">
            
            <!-- Remove p tag -->
            <p>Most Downloads</p>
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
                } ?>
                <?php

                $sql = "SELECT * FROM researchstudy_table";

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

              <?php } else {
                echo "No Results Found";
              } ?>

              <!-- The whole research study details ends here -->

          
          
          </div>
        </div>

      <!-- div for Content -->
      </div>
  <!-- div for row -->
  </div>