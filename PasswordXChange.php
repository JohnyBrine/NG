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


                      <form class="form-signup" action="includes/reset-request.inc.php" method="post">
                          <div class="login">
                            <input type="text" name="email" required="">
                            <label class="Email">E-mail</label>

                          </div>
                          <button type="submit" name="reset-request-submit">Odeslat odkaz na mail</button>
                      </form><br>
                      <?php
                        if (isset($_GET["reset"])) {
                          if ($_GET["reset"] == "success") {
                            echo '<p class="signupsuccess">Check your e-mail!</p>';
                          }
                        }
                      ?>
                    </div></div>
                  </body>
                </html>
