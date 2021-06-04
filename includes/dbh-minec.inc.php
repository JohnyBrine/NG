<?php

$servername = "localhost";
$dBUsername = "Web";
$dBPassword = "Alfonz388";
$dBName = "Mc";

$conn2 = mysqli_connect($servername, $dBUsername, $dBPassword, $dBName);
$conn2->set_charset('utf8mb4');

if (!$conn2) {
	die("Connection failed2: ".mysqli_connect_error());
}
