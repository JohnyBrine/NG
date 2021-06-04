<!DOCTYPE html>
<?php session_start(); ?>
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
          <?php
          if (isset($_SESSION['userid'])) {
            if ($_SESSION['minec'] == true) {
            // Error messages
            if (isset($_GET["error"])) {
              if ($_GET["error"] == "emptyinput") {
                echo "<p>Vyplňte všechna pole!</p>";
              }
              else if ($_GET["error"] == "invaliduid") {
                echo "<p>Vyberte si !</p>";
              }
              else if ($_GET["error"] == "invalidemail") {
                echo "<p>Napište správný E-mail!</p>";
              }
              else if ($_GET["error"] == "passwordsdontmatch") {
                echo "<p>Hesla nejsou správná!</p>";
              }
              else if ($_GET["error"] == "stmtfailed") {
                echo "<p>Někde se stala chyba, nezoufejte, neni u vás.</p>";
              }
              else if ($_GET["error"] == "usernametaken") {
                echo "<p>Uživatelské jméno používá někdo jiný!</p>";
              }
            }
            $user = $_SESSION['userid'];
            $minec = $_SESSION['minec'];
            echo '
                        <form class="form-signup" action="includes/signup.inc.php" method="post">
                          <div class="login">
                            <input type="text" name="firstname" required="" autocomplete="off">
                            <label class="username">Vaše jméno</label>

                          </div>
                          <div class="login">
                            <input type="text" name="lastname" required="" autocomplete="off">
                            <label class="username">Vaše Přijmení</label>

                          </div>
                          <div class="login">
                            <input type="text" name="uid" required="" autocomplete="off">
                            <label class="username">Přihlašovací jméno</label>

                          </div>
                          <div class="login">
                            <input type="email" name="email" required="">
                            <label class="Email">E-mail</label>

                          </div>
                          <div class="login">
                            <input type="password" name="pwd" required="" autocomplete="off">
                            <label class="passwordlabel">Heslo...</label>

                          </div>
                          <div class="login">
                            <input type="password" name="pwdrepeat" required="" autocomplete="off">
                            <label class="passwordlabel">Heslo znovu...</label>

                          </div>
                          <input type="hidden" value="'.$user.'" name="nahovno">
                          <input type="hidden" value="'.$minec.'" name="knicemu">
                          <button type="submit" name="submit">Zaregistrovat se</button>
                        </form><br>

                    </div></div>
                  </body>
                </html>';
            } else {
              echo "již jste přihlášen!!";
            }}
          else{
            // Error messages
            if (isset($_GET["error"])) {
              if ($_GET["error"] == "emptyinput") {
                echo "<p>Fill in all fields!</p>";
              }
              else if ($_GET["error"] == "invaliduid") {
                echo "<p>Vyberte si !</p>";
              }
              else if ($_GET["error"] == "invalidemail") {
                echo "<p>Choose a proper email!</p>";
              }
              else if ($_GET["error"] == "passwordsdontmatch") {
                echo "<p>Hesla nejsou správná!</p>";
              }
              else if ($_GET["error"] == "stmtfailed") {
                echo "<p>Někde se stala chyba, nezoufejte, neni u vás.</p>";
              }
              else if ($_GET["error"] == "usernametaken") {
                echo "<p>Uživatelské jméno používá někdo jiný!</p>";
              }
            }

?>
                        <form class="form-signup" action="includes/signup.inc.php" method="post">
                          <div class="login">
                            <input type="text" name="firstname" required="" autocomplete="off">
                            <label class="username">Vaše jméno</label>

                          </div>
                          <div class="login">
                            <input type="text" name="lastname" required="" autocomplete="off">
                            <label class="username">Vaše Přijmení</label>

                          </div>
                          <div class="login">
                            <input type="text" name="uid" required="" autocomplete="off">
                            <label class="username">Přihlašovací jméno</label>

                          </div>
                          <div class="login">
                            <input type="email" name="email" required="">
                            <label class="Email">E-mail</label>

                          </div>
                          <div class="login">
                            <input type="password" name="pwd" required="" autocomplete="off">
                            <label class="passwordlabel">Heslo</label>

                          </div>
                          <div class="login">
                            <input type="password" name="pwdrepeat" required="" autocomplete="off">
                            <label class="passwordlabel">Heslo znovu</label>

                          </div>
                          <button type="submit" name="submit">Zaregistrovat se</button>
                        </form><br>
                        <div class="konec">
                          <div><form action="login.php" method="post"> <button type="submit" name="logout-submit">Již máte účet? Přihlaste se...</button> </form></div>
                        </div>
                    </div></div>
                  </body>
                </html>
          <?php    } ?>
