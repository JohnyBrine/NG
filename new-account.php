<?php
  session_start();
  require_once "includes/dbh-minec.inc.php";
  require_once "includes/dbh.inc.php";
  require_once 'includes/functions.inc.php';

  if (isset($_SESSION['userid'])) {
    $uid = $_SESSION['useruid'];
    $id = $_SESSION['userid'];
    if ($_SESSION['minec'] == true) {
      $collums = uidExistsMinec($conn2, $uid, 'new-account');
      $tokeny = TokensCheck($conn2, $uid);
      $rank = RankCheck($conn2, $uid);
      if ($tokeny == false) {$tokeny["tokens"] = 0;}
    } else {
      $collums = uidExists($conn, $uid, 'new-account');
      if ($collums['joined_MIN'] != "nepripojeno") {
        $minecjoined = true;

        $collumsminec = uidExistsMinec($conn2, $collums['joined_MIN'], 'new-account');
        $tokeny = TokensCheck($conn2, $collumsminec['UIDNick']);
        $rank = RankCheck($conn2, $collumsminec['UIDNick']);

        if ($rank == "") {   $rank = "Hráč";   }
      } else {
        $minecjoined = false;
      }
      if ($collums['joined_FIV'] != "nepripojeno") {
        $fivemjoined = true;
        //funkce...
        //funkce...
        //funkce...

      } else {
        $fivemjoined = false;
      }


    }
  }
 ?>
<!DOCTYPE html>
<html>
  <head>
    <meta charset="utf-8">
    <meta name="descripion" content="Toto je jen Pokus">
    <meta name="vieport" content="width=device-width, initial-scale=1.0">
    <title>NoneGaming.EU - účet</title>
    <link rel="stylesheet" href="CSS/account.css" media="screen">
  </head>
  <script type="text/javascript" src="CSS/js.js">

  </script>
<body class="loginbody">
  <div class="accountmenu" id="mySidenav">
    <a href="javascript:void(0)" class="closebtn" onclick="closeNav()">&times</a>
    <div class="accountmenuinside">
      <?php
        if (isset($_SESSION['userid'])){
          ?>
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
          <br>
          <br>
          <div class="Vitej">
            <label class="vitej">Vítej <?php echo $collums['firstName'];?></label>
          </div>

          <?php
          if($_SESSION['minec'] == true){
            ?>
            <div class="tlacitko tlacitko-craft">
              <button id="Nonecraft">NoneCraft</button>
            </div>
            <?php


          }
          else {
            ?>
            <div class="pod-uvitanim">
              <label for="nonecoiny">NoneCoiny: <?php echo $collums['NoneCoins']; ?></label>
            </div>

            <div class="tlacitko">
              <button class="tablinks" onclick="openCity(event, 'London')" id="defaultOpen">Web</button>
            </div>

            <?php
            if($minecjoined == true){
              ?>
              <div class="tlacitko tlacitko-craft" >
                <button class="tablinks" onclick="openCity(event, 'Paris')">Minecraft</button>
              </div>
              <?php
            }

            if ($fivemjoined == true) {
              ?>
              <div class="tlacitko tlacitko-fiveM">
                <button class="tablinks" onclick="openCity(event, 'Tokyo')">FiveM</button>
              </div>
              <?php
            }

          }

          ?>
          <div class="ucet">
            <form action="includes/logout.inc.php" method="post">
              <button type="submit" name="logout-submit">Odhlásit</button>
            </form>
          </div>

          <?php

        }else{
          header("location: index.php");
          exit;
        }

        ?>
    </div>
  </div>
<div class="ucty">
  <?php
  if (isset($_SESSION['userid'])) {
    if($_SESSION['minec'] == true){
      ?>
      <span class="menu" style="font-size:30px;cursor:pointer" onclick="openNav()">&#9776; open</span>
      <div class="profile">
        <div class="profile-info">
          <h1 class="napisjmena" style="margin-left: 84px;"># <?php echo $collums['UIDNick']; ?></h1>
          <div class="ctverce ctverce-warning">
            <p> Vítej ve svém Account Manageru, <?php echo $collums['UIDNick']; ?>! Zde máš základní přehled o svém účtě a akcí s ním spojených. Nikomu nevyzrazuj své ingame heslo, což může vést k odcizení tvého účtu se všemi jeho věcmi a výtvory... </p>
          </div>
          <br>
          <div class="ctverce ctverce-tip">
            <strong>TIP!</strong> Přidej si své kamarády na Lobíčkách do přátel pomocí /pratele a budeš vidět jejich info a přehled i v Account Manageru!
          </div>
          <br>
          <div class="ctverce ctverce-info">
            <ul class="text-inline" style="margin-left: 10px;">
              <li> ID Hráče <?php echo $id; ?> </li>
            </ul>
            <ul class="text-inline" style="margin-left: 10px;">
              <li> Na <strong>Minecraftu</strong> od <?php $mil = $collums["RegDatum"]; $seconds = $mil / 1000; echo date("d.m.Y H:i", $seconds);?></li>
            </ul>
            <ul class="text-inline" style="margin-left: 10px;">
              <li> Poslední nalogování ve hře <?php $mil = $collums["Lastlogin"]; $seconds = $mil / 1000; echo date("d.m.Y H:i", $seconds);?> <small>(Czech Republic, <?php echo $collums["IP"]; ?>)</small></li>
            </ul>
            <ul class="text-inline" style="margin-left: 10px;">
              <li> Nyní přihlášen z Czech Republic, <?php echo $_SERVER['REMOTE_ADDR']; ?> </li>
            </ul>
            <ul class="text-inline" style="margin-left: 10px;">
              <li> Počet Gemu na serveru: <?php echo $tokeny['tokens']; ?> </li>
            </ul>
            <ul class="text-inline" style="margin-left: 10px;">
              <li> Rank na serveru: <?php echo $rank; ?> </li>
            </ul>
            <?php

            if($collums['account']=='false'){
              ?>
              <ul class="text-inline" style="margin-left: 10px;">
                <li> Tento MC účet nemá přidružený Web ůčet.
                  <div>
                    <form action="signup.php" method="post">
                      <button type="submit" name="Account-create-submit">
                        Vytvořit...
                      </button>
                    </form>
                    <form action="login.php" method="post">
                      <button type="submit" name="Account-join-submit">
                        Přidružit...
                      </button>
                    </form>
                  </div>
                </li>
              </ul>
              <?php
            }
            else if($collums['account']=='true'){
              ?>
              <ul class="text-inline" style="margin-left: 10px;">
                <li> Tento MC účet již má přidružený Web ůčet. Prosíme <a href="login.php">přihlašte se</a> přes něj...
                </li>
              </ul>
              <?php
            }
            else {

              echo "Nevim asi chyba!?";

            }
            ?>

          </div>

          <!--end row-->
        </div>
        <div class="skin">
              <img src="https://minotar.net/body/<?php echo $uid; ?>/230.png" class="img-responsive pic-bordered" alt="">
        </div>
      </div>


    <?php
    }
    else {
      ?>
      <span class="menu" id="opne" style="font-size:30px;cursor:pointer" onclick="openNav()">&#9776; open</span>
      <div id="London" class="tabcontent">
      <div class="Web">
        <div class="vlevo">
          <div class="proffotka">
            <img src="https://image.flaticon.com/icons/png/512/149/149071.png" alt="">
            <span><?php echo $collums['firstName']; echo " "; echo $collums['lastName']; ?></span>
          </div>
          <div class="texty">
            <span>Email: <?php echo $collums['usersEmail'] ?></span>
            <span>Heslo: *********</span>
            <br><br>
            <div class="vpravo">
              <span class="servers">Minecraft: <?php if($minecjoined == true) {echo $collumsminec['UIDNick'];} else {echo $collums['joined_MIN'];} ?></span>
              <span class="servers">FiveM: <a href="#"><?php echo $collums['joined_FIV']; ?></a></span>
            </div>
          </div>
        </div>

      </div>
    </div>
      <?php if ($minecjoined == true){ ?>
      <div id="Paris" class="tabcontent" style="display:none">
      <div class="profile">
        <div class="profile-info">
          <h1 class="napisjmena" style="margin-left: 84px;"># <?php echo $collumsminec['UIDNick']; ?></h1>
          <div class="ctverce ctverce-warning">
            <p> Vítej ve svém Account Manageru, <?php echo $collumsminec['UIDNick']; ?>! </p>
          </div>
          <br>
          <div class="ctverce ctverce-tip">
            <strong>TIP!</strong> Přidej si své kamarády na Lobíčkách do přátel pomocí /pratele a budeš vidět jejich info a přehled i v Account Manageru!
          </div>
          <br>
          <div class="ctverce ctverce-info">
            <ul class="text-inline" style="margin-left: 10px;">
              <li> ID Hráče <?php echo $collumsminec['ID']; ?> </li>
            </ul>
            <ul class="text-inline" style="margin-left: 10px;">
              <li> Na <strong>Minecraftu</strong> od <?php $mil = $collumsminec["RegDatum"]; $seconds = $mil / 1000; echo date("d.m.Y H:i", $seconds);?></li>
            </ul>
            <ul class="text-inline" style="margin-left: 10px;">
              <li> Poslední nalogování ve hře <?php $mil = $collumsminec["Lastlogin"]; $seconds = $mil / 1000; echo date("d.m.Y H:i", $seconds);?> <small>(Czech Republic, <?php echo $collumsminec["IP"]; ?>)</small></li>
            </ul>
            <ul class="text-inline" style="margin-left: 10px;">
              <li> Nyní přihlášen z Czech Republic, <?php echo $_SERVER['REMOTE_ADDR']; ?> </li>
            </ul>
            <ul class="text-inline" style="margin-left: 10px;">
              <li> Počet Gemu na serveru: <?php echo $tokeny['tokens']; ?> </li>
            </ul>
            <ul class="text-inline" style="margin-left: 10px;">
              <li> Rank na serveru: <?php echo $rank; ?> </li>
            </ul>
          </div>
          <!--end row-->
        </div>
        <div class="skin">
              <img src="https://minotar.net/body/<?php echo $uid; ?>/230.png" class="img-responsive pic-bordered" alt="">
        </div>
      </div>
      </div>
      <?php
      }
      if ($fivemjoined == true){ ?>
        <div id="Tokyo" class="tabcontent" style="display:none">
        <div class="FiveM" >
          <div class="vlevo">
            <div class="proffotka">
              lol
            </div>
            <div class="">

            </div>
          </div>
          <div class="vpravo">

          </div>
        </div>
      </div>
      <?php
      }
    }
  }
  ?>
</div>


</body>
