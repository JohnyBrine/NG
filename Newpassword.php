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
          <?php
          // First we grab the tokens from the URL.
          $selector = $_GET['selector'];
          $validator = $_GET['validator'];
          ?><input type="" name="selector" value="<?php echo $selector ?>">
          <input type="" name="validator" value="<?php echo $validator ?>"><?php
          // Then we check if the tokens are here.
          if (empty($selector) || empty($validator)) {
            echo "Could not validate your request!";
          } else {
            // Here we check if all characters in our tokens are hexadecimal 'digits'. This is a boolean. Again another error check to make sure the URL wasn't changed by the user.
            // If this check returns "true", we show the form that the user uses to reset their password.
            if (ctype_xdigit( $selector ) !== false && ctype_xdigit( $validator ) !== false) {
              ?>

              <form class="form-resetpwd" action="includes/reset-password.inc.php" method="post">
                <input type="hidden" name="selector" value="<?php echo $selector ?>">
                <input type="hidden" name="validator" value="<?php echo $validator ?>">

                <div class="login">
                  <input type="password" name="pwd" required="" autocomplete="off">
                  <label class="passwordlabel">Nové Heslo...</label>

                </div>
                <div class="login">
                  <input type="password" name="pwdrepeat" required="" autocomplete="off">
                  <label class="passwordlabel">Nové Heslo znovu...</label>

                </div>
                <button type="submit" name="reset-password-submit">Změnit heslo</button>
              </form>

              <?php
            }
          }
          ?>
        </div></div>
        </body>
      </html>
