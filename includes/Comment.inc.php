<?php
if (isset($_POST["submit-kontakt"])) {

  // First we get the form data from the URL
  $email = $_POST["email"];
  $username = $_POST["jmeno"];
  $comment = $_POST["komentar"];

  // Then we run a bunch of error handlers to catch any user mistakes we can (you can add more than I did)
  // These functions can be found in functions.inc.php

  require_once 'dbh.inc.php';
  require_once 'functions.inc.php';

  // Left inputs empty
  // We set the functions "!== false" since "=== true" has a risk of giving us the wrong outcome
  if (emptyInputComment($email, $username, $comment) !== false) {
    header("location: ../index.php?error=emptyinput&name=$username&email=$email&com=$comment");
		exit();
  }

	// Proper username chosen
  if (invalidUid($username) !== false) {
    header("location: ../index.php?error=invaliduid&name=$username&email=$email&com=$comment");
		exit();
  }

  // Proper email chosen
  if (invalidEmail($email) !== false) {
    header("location: ../index.php?error=invalidemail&name=$username&email=$email&com=$comment");
		exit();
  }
  if (invalidComWot($comment) !== false) {
    header("location: ../index.php?error=invalidcommnt&name=$username&email=$email&com=$comment");
		exit();
  }

  $sql = "INSERT INTO Comments (Jmeno, Email, Koment) VALUES (?,?,?);";
  $stmt = mysqli_stmt_init($conn);
  if (!mysqli_stmt_prepare($stmt, $sql)) {
    header("location: ../index.php?error=stmtfailed&name=$username&email=$email&com=$comment");
    exit();
  }

  mysqli_stmt_bind_param($stmt, "sss", $username, $email, $comment);
  mysqli_stmt_execute($stmt);
  mysqli_stmt_close($stmt);
  mysqli_close($conn);
  header("Location: ../index.php?sucesful");
  exit;
}
else {
  header("Location: ../index.php");
  exit;
}

 ?>
