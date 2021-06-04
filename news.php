<?php
  require_once "header.php";

  if (isset($_GET['novinka'])) {
    $new = $_GET['novinka'];

    require_once "includes/dbh.inc.php";
    require_once 'includes/functions.inc.php';

    $new = newsExists($conn, $new);

    if ($new == false) {
      header("location: /index.php?");
  		exit();
    }
    else {

      ?>

<main class="mainmain">
  <span><a href="news.php">Zpět na novinky...</a></span><br>
  <div class="Novinka--aa">
    <div class="Obrazok" style="background-image: url('<?php echo $new['Img']; ?>')">
      <span></span>
    </div>
    <div class="texticek">
      <div class="nadpisek">
        <center><?php echo $new['Nadpis']; ?></center>
      </div>
      <div class="textik">
        <?php echo $new['Text']; ?>
      </div>
    </div>
  </div>
</main>

<?php
    }
  }
  else {
 ?>

<main class="mainmain" style="width: 100%;">
  <div class="zoznamnovinek">

    <span><a href="index.php">Zpět na hlavní stránku...</a></span><br>

<?php

    require_once "includes/dbh.inc.php";
    $sql = "SELECT * FROM news ORDER BY ID DESC";
    if($result = mysqli_query($conn, $sql)){
      if(mysqli_num_rows($result) > 0){
          while($row = mysqli_fetch_array($result)){
              ?>

              <form class="" action="news.php" method="get">
                 <button class="btn-novinka" type="submit" name="novinka" value="<?php echo $row['ID']; ?>">
                   <div class="Novinka">
                     <div class="Obr" style="background-image: url(<?php echo $row['Img']; ?>);">
                       <span></span>
                     </div>
                     <div class="novinka-nadpis">
                       <?php echo $row['Nadpis']; ?>
                     </div>
                     <div class="novinka-text">
                       <?php echo $row['Nahled'] . " ..."; ?>
                     </div>
                   </div>
                 </button>
              </form>

              <?php
          }

          // Close result set
          mysqli_free_result($result);
      } else{
          echo "Pro zatím zde nejsopu žádné novinky z jakýhkoli serverů...";
      }
    } else{
      echo "ERROR: Could not able to execute $sql. " . mysqli_error($conn);
    }?>

  </div>



</main>

<?php
  }
  require_once "footer.php";
 ?>
