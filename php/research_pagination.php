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

        <!-- div for Content -->
      </div>

      <!-- div for row -->
    </div>