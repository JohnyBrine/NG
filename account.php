<?php

require_once "header.php";


if (isset($_GET['error'])) {
  if ($_GET["error"] == "stmtfailed") {
    echo "<p>Došlo k neočekávané chybě!!</p>";
  }
  if ($_GET["error"] == "stmtfailed1") {
    echo "<p>Došlo k neočekávané chybě!!</p>";
  }
  if ($_GET["error"] == "stmtfailed2") {
    echo "<p>Došlo k neočekávané chybě!!</p>";
  }
}


else if (isset($_SESSION['userid'])) {
  $uid = $_SESSION['useruid'];
  $id = $_SESSION['userid'];
  if ($_SESSION['minec'] == true) {
    $collums = uidExistsMinec($conn2, $uid, 'account');
    $tokeny = TokensCheck($conn2, $uid);
    $rank = RankCheck($conn2, $uid);
    if ($tokeny == false) {$tokeny["tokens"] = 0;}

      ?>
      <div class="profile">
        <div class="col-md-3">
          <ul class="list-unstyled profile-nav">
            <li>
              <img src="https://minotar.net/body/<?php echo $uid; ?>/270.png" style="margin-left: 48px;" class="img-responsive pic-bordered" alt="">
            </li>
          </ul>
        </div>
        <div class="col-md-9">
          <div class="row">
            <div class="profile-info">
              <h1 class="sbold uppercase font-blue-hoki" style="margin-left: 72px;"># <?php echo $uid; ?></h1>
                <div class="note note-info" style="margin-left: 84px; margin-right: 84px;">
                  <p> Vítej ve svém Account Manageru, <?php echo $uid; ?>! Zde máš základní přehled o svém účtě a akcí s ním spojených. Nikomu nevyzrazuj své ingame heslo, což může vést k odcizení tvého účtu se všemi jeho věcmi a výtvory... </p>
                </div>
              <div class="alert alert-info" style="margin-left: 84px; margin-right: 84px;">
                <strong>TIP!</strong> Přidej si své kamarády na Lobíčkách do přátel pomocí /pratele a budeš vidět jejich info a přehled i v Account Manageru!
              </div>
              <br>
              <div class="note note-danger" style="margin-left: 84px; margin-right: 84px;">
                <ul class="list-inline" style="margin-left: 10px;">
                  <li> ID Hráče <?php echo $id; ?> </li>
                </ul>
                <ul class="list-inline" style="margin-left: 10px;">
                  <li> Na <strong>NoneCraftu</strong> od <?php $mil = $collums["RegDatum"]; $seconds = $mil / 1000; echo date("d.m.Y H:i", $seconds);?></li>
                </ul>
                <ul class="list-inline" style="margin-left: 10px;">
                  <li> Poslední nalogování ve hře <?php $mil = $collums["Lastlogin"]; $seconds = $mil / 1000; echo date("d.m.Y H:i", $seconds);?> <small>(Czech Republic, <?php echo $collums["IP"]; ?>)</small></li>
                </ul>
                <ul class="list-inline" style="margin-left: 10px;">
                  <li> Nyní přihlášen z Czech Republic, <?php echo $_SERVER['REMOTE_ADDR']; ?> </li>
                </ul>
                <ul class="list-inline" style="margin-left: 10px;">
                  <li> Počet Gemu na serveru: <?php echo $tokeny['tokens']; ?> </li>
                </ul>
                <ul class="list-inline" style="margin-left: 10px;">
                  <li> Rank na serveru: <?php echo $rank; ?> </li>
                </ul>

      <?php

    if($collums['account']=='false'){

      ?>

                <ul class="list-inline" style="margin-left: 10px;">
                  <li> Tento MC účet nemá přidružený Web ůčet.
                    <div>
                      <form action="signup.php" method="post">
                        <button type="submit" name="Account-create-submit">
                          Přidružit...
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
      <ul class="list-inline" style="margin-left: 10px;">
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
          </div>
        </div>
        <!--end row-->
      </div>
    </div>

      <?php
  }
  else {
    $collums = uidExists($conn, $uid, 'account');
    $minec = uidExistsMinec($conn2, $collums['joined_MIN']);
    $tokeny = TokensCheck($conn2, $collums['joined_MIN']);
    $rank = RankCheck($conn2, $collums['joined_MIN']);
    echo " co je ty píčo!!";
    ?>



    <?php

  }
}
else {
  header("Location: login.php");
  exit;
}


require_once "footer.php";

?>
