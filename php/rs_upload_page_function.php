<?php
require "header.php";
include "server.php";

  // message after insert
  $output = '';
  $title = $conn -> real_escape_string($_POST['title']);
  $abstract = $conn -> real_escape_string($_POST['abstract']);
  $author = $conn -> real_escape_string($_POST['author']);
  $year = $conn -> real_escape_string($_POST['year']);
  $course = $conn -> real_escape_string($_POST['course']);
  $keywords = $conn -> real_escape_string($_POST['keywords']);
  $adviser = $conn -> real_escape_string($_POST['adviser']);
  $date = date("M d, Y h:i:s A");


  $target_dir = "../Research_Studies/";//eto directory na ginawa mo sa folder
  $file_ext = strtolower(pathinfo($_FILES['file']['name'], PATHINFO_EXTENSION));//eto naman  ext example .pdf
  $file = $title.'.'.$file_ext;
  $file = str_replace(' ', '_', $file);//replace spaces " " to _
  $uploadOk = 1;
  
  // Validations
  //   Check if file already exists
    if (file_exists($file)) {
      echo "Sorry, file already exists.";
      $uploadOk = 0;
    }
  
    // Check file size
    if ($_FILES["file"]["size"] > 50000000) {
      echo "Sorry, your file is too large.";
      $uploadOk = 0;
    }

    $sql = "INSERT INTO researchstudy_table (Title, Abstract, Author, File, Year, Course, Keywords, Adviser, Upload_Date)
    VALUES ('$title', '$abstract', '$author', '$file', '$year', '$course', '$keywords', '$adviser', '$date')";

    if ($conn->query($sql) === TRUE && $uploadOk === 1) {
      move_uploaded_file($_FILES["file"]["tmp_name"], $target_dir.$file);
      $output = "Research had been sucessfully uploaded.";
    } else {
      $output = "There was an error occured while uploading.";
    }
    echo $output;
?>