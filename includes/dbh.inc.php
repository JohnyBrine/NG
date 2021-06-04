<?php

$servername = "localhost";
$dBUsername = "Web";
$dBPassword = "Alfonz388";
$dBName = "Webos";

$conn = mysqli_connect($servername, $dBUsername, $dBPassword, $dBName);
$conn->set_charset('utf8mb4');

if (!$conn) {
	die("Connection failed: ".mysqli_connect_error());
}
