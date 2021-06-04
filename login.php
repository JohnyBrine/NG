<!DOCTYPE html>
<html lang="cz" dir="ltr">
  <head>
    <meta charset="utf-8">
    <title></title>
    <link rel="stylesheet" href="CSS/master.css">
  </head>
  <body class="loginbody">
    <div class="logindiv">
      <div class="divvloginu">
      <h2>
            <span class="sp1">N</span>
            <span class="sp2">o</span>
            <span class="sp3">n</span>
            <span class="sp4">e</span>
            <span class="sp5">G</span>
            <span class="sp6">a</span>
            <span class="sp7">m</span>
            <span class="sp8">i</span>
            <span class="sp9">n</span>
            <span class="sp10">g</span>
            <span class="sp11">.</span>
            <span class="sp12">e</span>
            <span class="sp13">u</span>
          </h2>
      <form class="loginform" action='includes/login.inc.php' method="post">
        <?php

          if (isset($_GET['error'])) {
            if ($_GET["error"] == "none") {
              echo "<p></p><div class='login'>
                       <input type='username' name='uid' required=''>
                       <label class='usernamelabel'>Email / Jméno / Minecraft Nick</label>";
            }
            elseif ($_GET["error"] == "emptyinput") {
              echo "<p>Vyplňte všechna pole!!</p>";
            }
            else if ($_GET["error"] == "mine-userexist") {
              echo "<p>Uživatel neexistuje!</p>";
            }
            else if ($_GET['error'] == 'wronglogin') {
              echo "<p style='color:red;'>Chybné Jméno nebo Heslo!</p>";
              $uid = $_GET['name'];
              echo "<div class='login'>
                    <input type='username' name='uid' required=''>
                    <label class='usernamelabel' value='.$uid.'>Email / Jméno / Minecraft Nick</label>";

            }
            else {
              echo "chyba neznámá";
            }


          }
          else{
             echo "<p></p><div class='login'>
                      <input type='username' name='uid' required=''>
                      <label class='usernamelabel'>Email / Jméno / Minecraft Nick</label>";
          }
        ?>
        </div>
        <div class="login">
          <input type="password" name="pwd" required="">
          <label class="passwordlabel">Heslo</label>

        </div>
        <button type="submit" name="submit">Let me in!</button>
      </form><br>
      <div class="konec">
        <div><form action="PasswordXChange.php" method="post"> <button type="submit" name="logout-submit">Zapoměli jste heslo??</button> </form></div>
        <div><form action="signup.php" method="post"> <button type="submit" name="logout-submit">Ještě nemáte účet? Zaregistrujte se</button> </form></div>
      </div>
      </div>
    </div>


  </body>
</html>
