<?php
  session_start();

  if (isset($_SESSION['userid'])) {
  }
  else {
    $_SESSION['Permission'] = 0;
  }

  error_reporting(E_ALL);
  ini_set("display_errors", 1);

  $IP = $_SERVER['REMOTE_ADDR'];
  if($IP == "93.153.90.232"){}        //já
  elseif ($IP == "78.80.229.4") {}    //Makin
  elseif ($IP == "37.48.1.157") {}   //Cobra
  elseif ($IP == "109.81.208.236") {} //deatplay #1
  elseif ($IP == "109.81.208.93") {}  //deatplay #2
  elseif ($IP == "185.52.173.25") {}  //Maťko
  elseif ($IP == "178.41.213.38") {}  //Pali
  else {
    header("Location: ../pristupzamitnut.php");
    exit;
  }

 ?>


<!doctype html>
<html lang="cz" dir="ltr">

  <head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8">
    <meta name="descripion" content="Toto je jen Pokus">
    <meta name="vieport" content="width=device-width, initial-scale=1.0">
    <title>NoneGaming.EU</title>
    <link rel="stylesheet" href="CSS/index2.css" media="screen">
    <link rel="shortcut icon" type="image/png" href="CSS/Images/NON_LOGO.jpg">
    <script type="text/javascript" src="CSS/js.js"></script>
    <svg style="position: absolute; width: 0; height: 0; overflow: hidden; fill: white;" version="1.1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink">
     <defs>
       <symbol id="icon-facebook" viewBox="0 0 32 32">
       <path d="M19 6h5v-6h-5c-3.86 0-7 3.14-7 7v3h-4v6h4v16h6v-16h5l1-6h-6v-3c0-0.542 0.458-1 1-1z"></path>
       </symbol>

       <symbol id="icon-linkedin2" viewBox="0 0 32 32">
       <path d="M12 12h5.535v2.837h0.079c0.77-1.381 2.655-2.837 5.464-2.837 5.842 0 6.922 3.637 6.922 8.367v9.633h-5.769v-8.54c0-2.037-0.042-4.657-3.001-4.657-3.005 0-3.463 2.218-3.463 4.509v8.688h-5.767v-18z"></path>
       <path d="M2 12h6v18h-6v-18z"></path>
       <path d="M8 7c0 1.657-1.343 3-3 3s-3-1.343-3-3c0-1.657 1.343-3 3-3s3 1.343 3 3z"></path>
       </symbol>

       <symbol id="icon-twitter" viewBox="0 0 32 32">
       <path d="M32 7.075c-1.175 0.525-2.444 0.875-3.769 1.031 1.356-0.813 2.394-2.1 2.887-3.631-1.269 0.75-2.675 1.3-4.169 1.594-1.2-1.275-2.906-2.069-4.794-2.069-3.625 0-6.563 2.938-6.563 6.563 0 0.512 0.056 1.012 0.169 1.494-5.456-0.275-10.294-2.888-13.531-6.862-0.563 0.969-0.887 2.1-0.887 3.3 0 2.275 1.156 4.287 2.919 5.463-1.075-0.031-2.087-0.331-2.975-0.819 0 0.025 0 0.056 0 0.081 0 3.181 2.263 5.838 5.269 6.437-0.55 0.15-1.131 0.231-1.731 0.231-0.425 0-0.831-0.044-1.237-0.119 0.838 2.606 3.263 4.506 6.131 4.563-2.25 1.762-5.075 2.813-8.156 2.813-0.531 0-1.050-0.031-1.569-0.094 2.913 1.869 6.362 2.95 10.069 2.95 12.075 0 18.681-10.006 18.681-18.681 0-0.287-0.006-0.569-0.019-0.85 1.281-0.919 2.394-2.075 3.275-3.394z"></path>
       </symbol>

       <symbol id="icon-rss" viewBox="0 0 32 32">
       <path d="M4.259 23.467c-2.35 0-4.259 1.917-4.259 4.252 0 2.349 1.909 4.244 4.259 4.244 2.358 0 4.265-1.895 4.265-4.244-0-2.336-1.907-4.252-4.265-4.252zM0.005 10.873v6.133c3.993 0 7.749 1.562 10.577 4.391 2.825 2.822 4.384 6.595 4.384 10.603h6.16c-0-11.651-9.478-21.127-21.121-21.127zM0.012 0v6.136c14.243 0 25.836 11.604 25.836 25.864h6.152c0-17.64-14.352-32-31.988-32z"></path>
       </symbol>

       <symbol id="icon-youtube" viewBox="0 0 32 32">
       <path d="M31.681 9.6c0 0-0.313-2.206-1.275-3.175-1.219-1.275-2.581-1.281-3.206-1.356-4.475-0.325-11.194-0.325-11.194-0.325h-0.012c0 0-6.719 0-11.194 0.325-0.625 0.075-1.987 0.081-3.206 1.356-0.963 0.969-1.269 3.175-1.269 3.175s-0.319 2.588-0.319 5.181v2.425c0 2.587 0.319 5.181 0.319 5.181s0.313 2.206 1.269 3.175c1.219 1.275 2.819 1.231 3.531 1.369 2.563 0.244 10.881 0.319 10.881 0.319s6.725-0.012 11.2-0.331c0.625-0.075 1.988-0.081 3.206-1.356 0.962-0.969 1.275-3.175 1.275-3.175s0.319-2.587 0.319-5.181v-2.425c-0.006-2.588-0.325-5.181-0.325-5.181zM12.694 20.15v-8.994l8.644 4.513-8.644 4.481z"></path>
       </symbol>

       <symbol id="icon-linkedin2" viewBox="0 0 32 32">
       <path d="M12 12h5.535v2.837h0.079c0.77-1.381 2.655-2.837 5.464-2.837 5.842 0 6.922 3.637 6.922 8.367v9.633h-5.769v-8.54c0-2.037-0.042-4.657-3.001-4.657-3.005 0-3.463 2.218-3.463 4.509v8.688h-5.767v-18z"></path>
       <path d="M2 12h6v18h-6v-18z"></path>
       <path d="M8 7c0 1.657-1.343 3-3 3s-3-1.343-3-3c0-1.657 1.343-3 3-3s3 1.343 3 3z"></path>
       </symbol>

     </defs>
    </svg>
  </head>
<body>
  <header id="navnav">
    <nav class="navnav">

      <nav class="nav">

        <div class="divlogo">
          <a href="index.php"> <img class="logo" src="CSS/Images/NON_LOGO.png" alt=""></a>
        </div>

        <div class="navbar">

          <div class="subnav">
            <a href="Nas_Tym.php">O nás</a>
          </div>
          <div class="subnav">
            <a href="Servery.php">Servery</a>
          </div>
        </div>
      </nav>
      <div class="Functions">
        <?php
          if (isset($_SESSION['userid'])) {
            $uid = $_SESSION['useruid'];
            echo '
            <div class="navbar">
              <div class="subnav">
                <a href="new-account.php">Vítej ' . $uid . '</a>
              </div>
              <div class="subnav">
                <form class="" action="includes/logout.inc.php" method="post">
                  <button class="subnavbtn" name="logout-submit">Odhlásit se</button>
                </form>
              </div>
            </div>';

          }
          else {
            ?>
            <div class="navbar">
              <div class="subnav">
                <a href="login.php">Přihlásit se</a>
              </div>
              <div class="subnav">
                <a href="signup.php">Zaregistrovat</a>
              </div>
            </div>

            <?php
          }
        ?>

      </div>
    </nav>
  </header>
