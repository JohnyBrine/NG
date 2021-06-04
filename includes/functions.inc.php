<?php
session_start();
// Check for empty input signup
function emptyInputSignup($firstname, $lastname, $email, $username, $pwd, $pwdRepeat) {
	$result;
	if (empty($firstname)  || empty($lastname) || empty($email) || empty($username) || empty($pwd) || empty($pwdRepeat)) {
		$result = true;
	}
	else {
		$result = false;
	}
	return $result;
}

function emptyInputComment($email, $username, $comment) {
	$result;
	if (empty($email) || empty($username) || empty($comment)) {
		$result = true;
	}
	else {
		$result = false;
	}
	return $result;
}

function invalidCom($comment) {
	$result;
	if (!preg_match('/^[a-zA-Z0-9\sěščřžýáíéĚŠČŘŽÝÁÍÉ?!,.<>]+$/', $comment)) {
		$result = true;
	}
	else {
		$result = false;
	}
	return $result;
}

function invalidComWot($comment) {
	$result;
	if (!preg_match('/^[a-zA-Z0-9\sěščřžýáíéĚŠČŘŽÝÁÍÉ?!,.]+$/', $comment)) {
		$result = true;
	}
	else {
		$result = false;
	}
	return $result;
}

// Check invalid username
function invalidUid($username) {
	$result;
	if (!preg_match("/^[a-zA-Z0-9]*$/", $username)) {
		$result = true;
	}
	else {
		$result = false;
	}
	return $result;
}

// Check invalid email
function invalidEmail($email) {
	$result;
	if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
		$result = true;
	}
	else {
		$result = false;
	}
	return $result;
}

// Check if passwords matches
function pwdMatch($pwd, $pwdrepeat) {
	$result;
	if ($pwd !== $pwdrepeat) {
		$result = true;
	}
	else {
		$result = false;
	}
	return $result;
}

Function newsExists($conn, $id) {
	$sql = "SELECT * FROM news WHERE ID = ?;";
	$stmt = mysqli_stmt_init($conn);
	if (!mysqli_stmt_prepare($stmt, $sql)) {
		header("location: ../news.php?error=stmtfailed");
		exit();
	}

	mysqli_stmt_bind_param($stmt, "s", $id);
	mysqli_stmt_execute($stmt);

	// "Get result" returns the results from a prepared statement
	$resultData = mysqli_stmt_get_result($stmt);

	if ($row = mysqli_fetch_assoc($resultData)) {
		return $row;
	}
	else {
		$result = false;
		return $result;
	}
}

// Check if username is in database, if so then return data
function uidExists($conn, $username, $page) {
  $sql = "SELECT * FROM users WHERE usersUid = ? OR usersEmail = ?;";
	$stmt = mysqli_stmt_init($conn);
	if (!mysqli_stmt_prepare($stmt, $sql)) {
	 	header("location: ../".$page.".php?error=stmtfailed1");
		exit();
	}

	mysqli_stmt_bind_param($stmt, "ss", $username, $username);
	mysqli_stmt_execute($stmt);

	// "Get result" returns the results from a prepared statement
	$resultData = mysqli_stmt_get_result($stmt);

	if ($row = mysqli_fetch_assoc($resultData)) {
		return $row;
	}
	else {
		$result = false;
		return $result;
	}

	mysqli_stmt_close($stmt);
}


// Check if username is in database, if so then return data
function uidExistsMinec($conn2, $username, $page) {
  $sql2 = "SELECT * FROM AuthMe WHERE Nick = ? OR UIDNick = ? OR ID = ?;";
	$stmt2 = mysqli_stmt_init($conn2);
	if (!mysqli_stmt_prepare($stmt2, $sql2)) {
	 	header("location: ../".$page.".php?error=stmtfailed2");
		exit();
	}

	mysqli_stmt_bind_param($stmt2, "sss", $username, $username, $username);
	mysqli_stmt_execute($stmt2);

	// "Get result" returns the results from a prepared statement
	$resultData2 = mysqli_stmt_get_result($stmt2);

	if ($row2 = mysqli_fetch_assoc($resultData2)) {
		return $row2;
	}
	else {
		$result2 = false;
		return $result2;
	}

	mysqli_stmt_close($stmt2);
}

function connectMinec($conn2, $ID){
	$sql = "UPDATE AuthMe SET account='true' WHERE ID='$ID';";
	$result = mysqli_query($conn2, $sql);
	return $result;
}

function createUser($conn, $firstname, $lastname, $email, $username, $pwd, $minec) {

  	$sql = "INSERT INTO users (usersUid, firstName, lastName, usersEmail,  usersPwd, RegIP, joined_MIN) VALUES (?, ?, ?, ?, ?, ?, ?);";
		$stmt = mysqli_stmt_init($conn);
		if (!mysqli_stmt_prepare($stmt, $sql)) {
	 		header("location: ../signup.php?error=stmtfailed");
			exit();
		}

		$hashedPwd = password_hash($pwd, PASSWORD_DEFAULT);
		$regIP = $_SERVER['REMOTE_ADDR'];
		if ($minec == false) {
			$ID = "nepřipojeno";
		} else{
			$ID = $minec;
			connectMinec($conn2, $ID);
		}

		mysqli_stmt_bind_param($stmt, "sssssss", $username, $firstname, $lastname, $email, $hashedPwd, $regIP, $ID);
		mysqli_stmt_execute($stmt);
		mysqli_stmt_close($stmt);
		mysqli_close($conn);
		header("location: ../login.php?error=none");
		exit();
}


// Check for empty input login
function emptyInputLogin($username, $pwd) {
	$result;
	if (empty($username) || empty($pwd)) {
		$result = true;
	}
	else {
		$result = false;
	}
	return $result;
}


// Log user into website
function loginUser($conn, $conn2, $username, $pwd) {

  $uidExists = uidExistsMinec($conn2, $username, "login");
  if ($uidExists == false) {
	   $log = false;
	}else{
      //$pwd_hashed = password_hash($pwd, PASSWORD_ARGON2I); //puvodni algoritmus
      $pwdHashed = $uidExists["Heslo"];
			$salt = explode('$', $uidExists["Heslo"])[2];
      $hash1 = hash('sha256', $pwd);
      $pwd_hashed = '$SHA$'.$salt.'$'.hash('sha256', $hash1.$salt);
      if($pwdHashed == $pwd_hashed){
				session_start();
				$_SESSION["userid"] = $uidExists["ID"];
				$_SESSION["useruid"] = $uidExists["UIDNick"];
				$_SESSION["minec"] = true;
				$_SESSION["pocetprihlaseni"] = 0;
				$log = true;
				header("location: ../new-account.php?error=none&MC");
				exit;
			}else{
				$log = false;
			}
	}

	if($log == false){
		$uidExists = uidExists($conn, $username, 'login');
		$pwdHashed = $uidExists["usersPwd"];
		$checkPwd = password_verify($pwd, $pwdHashed);

		if ($checkPwd == false) {
			$log = false;
		}
		elseif ($checkPwd == true) {
			session_start();
			$_SESSION["userid"] = $uidExists["ID"];
			$_SESSION["useruid"] = $uidExists["usersUid"];
			$_SESSION["minec"] = false;
			$_SESSION["pocetprihlaseni"] = 0;
			$_SESSION['Permission'] = $uidExists["Permission"];
			$log = true;
			header("location: ../index.php?success");
			exit();
		}
	}
	if ($log == false){
		$_SESSION["pocetprihlaseni"]++;
		header("location: ../login.php?error=wronglogin");
		exit();
	}
	elseif ($log == true) {
		header("location: ../index.php?success");
		exit();
	}
	else {
		echo "nevim co se stalo... ???";
	}

}


//-----------------------------------------------------------------------------


// Check what is usernames rank
function RankCheck($conn2, $username) {
  $sql = "SELECT * FROM permissions_inheritance WHERE child = ?;";
	$stmt = mysqli_stmt_init($conn2);
	if (!mysqli_stmt_prepare($stmt, $sql)) {
	 	header("location: ../account.php?error=stmtfailed");
		exit();
	}
	$das_uuid = username_to_dasheduuid($conn2, $username);
	mysqli_stmt_bind_param($stmt, "s", $das_uuid);
	mysqli_stmt_execute($stmt);

	// "Get result" returns the results from a prepared statement
	$resultData = mysqli_stmt_get_result($stmt);

	if ($row = mysqli_fetch_assoc($resultData)) {
		return $row['parent'];
	}
	else {
		$result = false;
		return $result;
	}

	mysqli_stmt_close($stmt);
}

// Check if username has some tokens
function TokensCheck($conn2, $username) {
  $sql = "SELECT * FROM Tokeny WHERE name = ?;";
	$stmt = mysqli_stmt_init($conn2);
	if (!mysqli_stmt_prepare($stmt, $sql)) {
	 	header("location: ../account.php?error=stmtfailed");
		exit();
	}

	mysqli_stmt_bind_param($stmt, "s", $username);
	mysqli_stmt_execute($stmt);

	// "Get result" returns the results from a prepared statement
	$resultData = mysqli_stmt_get_result($stmt);

	if ($row = mysqli_fetch_assoc($resultData)) {
		return $row;
	}
	else {
		$result = false;
		return $result;
	}

	mysqli_stmt_close($stmt);
}

//Get dashet UUID from username
function username_to_dasheduuid($conn2, $username) {
	$sql = "SELECT * FROM permissions WHERE value = ?;";
	$stmt = mysqli_stmt_init($conn2);
	if (!mysqli_stmt_prepare($stmt, $sql)) {
		header("location: ../account.php?error=stmtfailed");
		exit();
	}

	mysqli_stmt_bind_param($stmt, "s", $username);
	mysqli_stmt_execute($stmt);

	// "Get result" returns the results from a prepared statement
	$resultData = mysqli_stmt_get_result($stmt);

	if ($row = mysqli_fetch_assoc($resultData)) {
		return $row['name'];
	}
	else {
		$result = false;
		return $result;
	}

	mysqli_stmt_close($stmt);
}

//Get UUID from Username
function username_to_uuid($username) {
    $profile = username_to_profile($username);
    if (is_array($profile) and isset($profile['id'])) {
        return $profile['id'];
    }
    return false;
}

//Get Profile (Username and UUID) from username
function username_to_profile($username) {
    if (is_valid_username($username)) {
        $json = file_get_contents('https://api.mojang.com/users/profiles/minecraft/' . $username);
        if (!empty($json)) {
            $data = json_decode($json, true);
            if (is_array($data) and !empty($data)) {
                return $data;
            }
        }
    }
    return false;
}

//Get username from UUID
function uuid_to_username($uuid) {
    $uuid = minify_uuid($uuid);
    if (is_string($uuid)) {
        $json = file_get_contents('https://api.mojang.com/user/profiles/' . $uuid . '/names');
        if (!empty($json)) {
            $data = json_decode($json, true);
            if (!empty($data) and is_array($data)) {
                $last = array_pop($data);
                if (is_array($last) and isset($last['name'])) {
                    return $last['name'];
                }
            }
        }
    }
    return false;
}

//Check if string is a valid Minecraft username
function is_valid_username($string) {
    return is_string($string) and strlen($string) >= 2 and strlen($string) <= 16 and ctype_alnum(str_replace('_', '', $string));
}

//Remove dashes from UUID
function minify_uuid($uuid) {
    if (is_string($uuid)) {
        $minified = str_replace('-', '', $uuid);
        if (strlen($minified) === 32) {
            return $minified;
        }
    }
    return false;
}

//Add dashes to an UUID
function format_uuid($uuid) {
    $uuid = minify_uuid($uuid);
    if (is_string($uuid)) {
        return substr($uuid, 0, 8) . '-' . substr($uuid, 8, 4) . '-' . substr($uuid, 12, 4) . '-' . substr($uuid, 16, 4) . '-' . substr($uuid, 20, 12);
    }
    return false;
}

?>
