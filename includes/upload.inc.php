<?php

if (isset($_POST['novinkavole_submit'])) {

  require_once "dbh.inc.php";
  require_once "functions.inc.php";

  // We grab the core file
  $file = $_FILES['file'];

  $fileName = $_FILES['file']['name'];
  $fileTmpName = $_FILES['file']['tmp_name'];
  $fileSize = $_FILES['file']['size'];
  $fileError = $_FILES['file']['error'];
  $fileType = $_FILES['file']['type'];

  // We could also have shortened this by writing:
  // $fileName = $file['name'];
  // Since we grabbed the core file at the start..


  $nadpis = $_POST['nadpis'];
  $uvodka = $_POST['uvodka'];
  $tzext = $_POST['tzext'];
  $type = $_POST['type'];


  // Here we get the file extension of the uploaded file
  $fileExt = explode('.', $fileName);
  $fileActualExt = strtolower(end($fileExt));

  // Here WE decide which file types we will allow
  $allowed = array('jpg', 'jpeg', 'png', 'pdf');

  // Now we check if the file is an allowed file type
  if (in_array($fileActualExt, $allowed)) {
    // Here we check for upload errors
    if ($fileError === 0) {
      // Here we check for file size
      if ($fileSize < 10000000) {

        // Left inputs empty
        // We set the functions "!== false" since "=== true" has a risk of giving us the wrong outcome
        if (emptyInputComment($nadpis, $uvodka, $tzext, $type) !== false) {
          header("location: ../index.php?error=emptyinput&nadpis=$nadpis&uvodka=$uvodka&tzext=$tzext");
          exit();
        }

        else if (invalidComWot($nadpis) !== false) {
          header("location: ../index.php?error=invalidnadpis&nadpis=$nadpis&uvodka=$uvodka&tzext=$tzext");
          exit();
        }

        else if (invalidComWot($uvodka) !== false) {
          header("location: ../index.php?error=invaliduvodka&nadpis=$nadpis&uvodka=$uvodka&tzext=$tzext");
          exit();
        }

        else if (invalidCom($tzext) !== false) {
          header("location: ../index.php?error=invalidtzext&nadpis=$nadpis&uvodka=$uvodka&tzext=$tzext");
          exit();
        }

        else {


          // Here we create a new unique name for the file
          $fileNameNew = uniqid('', true) . "." . $fileActualExt;
          // Here we create the path the file should get uploaded to
          $fileDestination = '../CSS/Images/Uploads/' . $fileNameNew;
          // Now we upload the file!
          move_uploaded_file($fileTmpName, $fileDestination);
          // And send the user back to the front page

          $sql = "INSERT INTO news (Img, Nadpis, Nahled, Text) VALUES (?,?,?,?);";
          $stmt = mysqli_stmt_init($conn);
          if (!mysqli_stmt_prepare($stmt, $sql)) {
            header("location: ../index.php?error=stmtfailed&nadpis=$username&uvodka=$email&ctzext$comment");
            exit();
          }

          mysqli_stmt_bind_param($stmt, "ssss", $fileDestination, $nadpis, $uvodka, $tzext);
          mysqli_stmt_execute($stmt);
          mysqli_stmt_close($stmt);
          mysqli_close($conn);
          header("Location: ../index.php?sucesful");
          exit;

        }
      }
      else {
        header("location: ../index.php?error=toobigimg&nadpis=$nadpis&uvodka=$uvodka&tzext=$tzext");
    		exit();
      }
    }
    else {
      header("location: ../index.php?error=uploaderror&nadpis=$nadpis&uvodka=$uvodka&tzext=$tzext");
  		exit();
    }
  }
  else {
    header("location: ../index.php?error=endoffileerror&nadpis=$nadpis&uvodka=$uvodka&tzext=$tzext");
		exit();
  }

}
