<?php
  session_start();

  $IP = $_SERVER['REMOTE_ADDR'];
  //if($IP == "93.153.90.232") {header("Location: ../index.php"); exit;}        //já
  if ($IP == "78.80.229.4") {header("Location: ../index.php"); exit;}    //Makin
  elseif ($IP == "37.48.52.125") {header("Location: ../index.php"); exit;}   //Cobra
  elseif ($IP == "109.81.208.236") {header("Location: ../index.php"); exit;} //deatplay #1
  elseif ($IP == "109.81.208.93") {header("Location: ../index.php"); exit;}  //deatplay #2
  elseif ($IP == "185.52.173.25") {header("Location: ../index.php"); exit;}  //Maťko
  elseif ($IP == "178.41.213.38") {header("Location: ../index.php"); exit;}  //Pali
  else {

  }

 ?>

<title>NoneGaming - Již Brzy</title>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1">
<link rel="stylesheet" href="https://www.w3schools.com/w3css/4/w3.css">
<link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Raleway">
<style>
body,h1 {font-family: "Raleway", sans-serif}
body, html {height: 100%}
.bgimg {
  background-image: url('/CSS/Images/NGlogo.jpg');
  min-height: 100%;
  background-position: center;
  background-size: cover;
}
</style>
<body>

<?php

if (isset($_GET['error'])) {}

else if (isset($_GET['vporadku'])) {}

else {
  $servername = "localhost";
  $dBUsername = "Web";
  $dBPassword = "Alfonz388";
  $dBName = "Webos";

  $conn = mysqli_connect($servername, $dBUsername, $dBPassword, $dBName);

  if (!$conn) {
  	die("Connection failed: ".mysqli_connect_error());
  }
  $sql = "INSERT INTO nevimzkouska (IP) VALUES (?);";
  $stmt = mysqli_stmt_init($conn);
  if (!mysqli_stmt_prepare($stmt, $sql)) {
    header("location: ../pristupzamitnut.php?error=stmt");
    exit();
  }

  $regIP = $_SERVER['REMOTE_ADDR'];

  mysqli_stmt_bind_param($stmt, "s", $regIP);
  mysqli_stmt_execute($stmt);
  mysqli_stmt_close($stmt);
  mysqli_close($conn);
  header("Location: ../pristupzamitnut.php?vporadku");
}

 ?>

<div class="bgimg w3-display-container w3-animate-opacity w3-text-white">
  <div class="w3-display-middle">
    <h1 class="w3-jumbo w3-animate-top">JIŽ BRZY</h1>
    <hr class="w3-border-grey" style="margin:auto;width:40%">
    <p class="w3-large w3-center">8 dní</p>
  </div>
</div>

</body>
</html>
