<?php

  require_once 'header.php';
  require 'includes/dbh.inc.php';

 ?>

 <main class="">
   <div class="nahore">
     <div class="uvod">
       <h1>Vítejte na</h1>
     </div>
     <img class="imgnonecraft" src="CSS/Images/NoneGamingBanner.png" alt="Nonegaming Logo">
     <div class="poduvod">
       <span>
         Lorem ipsum dolor sit amet, consectetuer adipiscing elit.
         Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat.
         Etiam quis quam. Fusce wisi. Praesent vitae arcu tempor neque lacinia pretium.
       </span>
     </div>
   </div>

   <div class="dole">
     <div class="novinky">
       <span class="Nadpis"><a href="news.php">Novinky</a></span>
       <div class="Novinkydiv">
         <?php

$sql = "SELECT * FROM news ORDER BY ID DESC limit 3";
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
}

// Close connection
mysqli_close($conn);



          ?>

       </div>
     </div>
     <br>

<?php

if ($_SESSION['Permission'] == "6854635") {

  ?>

  <div class="Kontaktform">
    <div class="Nadpis">
      <span>Vlož Novinku</span>
    </div>
    <?php
    if (isset($_GET['error'])) {
      if ($_GET["error"] == "none") {
        $nadpis = '';
        $uvodka = '';
        $tzext = '';
      }
      else {
        $nadpis = $_GET['nadpis'];
        $uvodka = $_GET['uvodka'];
        $tzext = $_GET['tzext'];
      }


      if ($_GET["error"] == "emptyinput") {
        echo "<p>Vyplňte všechna pole!</p>";
      }
      else if ($_GET["error"] == "invalidnadpis") {
        echo "<p>Neplatný nadpis!</p>";
      }
      else if ($_GET["error"] == "invaliduvodka") {
        echo "<p>Nepatná uvodka (nahled)!</p>";
      }
      else if ($_GET["error"] == "invalidtzext") {
        echo "<p>Neplatné znaky v novince!</p>";
      }
      elseif ($_GET["error"] == "toobigimg") {
        echo "<p>Moc VELKÝ obrázek!</p>";
      }
      elseif ($_GET["error"] == "uploaderror") {
        echo "<p>Chyba v obrázku!</p>";
      }
      elseif ($_GET["error"] == "endoffileerror") {
        echo "<p>Nepodporována přípona souboru!</p>";
      }
      else if ($_GET["error"] == "stmtfailed") {
        echo "<p>Někde se stala chyba, nezoufejte, neni u vás.</p>";
      }
      else {
        echo "<p>Prostě se to posralo. Pošli mi chybu -> " . $_GET['error'] . "</p>";
      }
    }
    else {
      $nadpis = '';
      $uvodka = '';
      $tzext = '';
    }
    ?>
    <div class="formular">
      <form class="" action="includes/upload.inc.php" method="post" enctype="multipart/form-data">
        <div class="labelkontakt">
          <input class="fileinput" type="file" name="file">
        </div>
        <select name="type" id="cars">
          <option value=""></option>
          <option value="MC">Minecraft</option>
          <option value="UN">Unturned</option>
          <option value="FM">FiveM</option>
        </select>
        <div class="labelkontakt">
          <label>Nadpis</label>
          <input type="text" name="nadpis" id="jmeno" required='' value="<?php echo $nadpis; ?>">
        </div>
        <div class="labelkontakt">
          <label>Nahled</label>
          <input type="text" class="nahledka" id="email" name="uvodka" required='' value="<?php echo $uvodka; ?>">
        </div>
        <div class="labelkontakt textarea">
          <label>Text</label>
          <textarea name="tzext" id="komentar" rows="3" required=''><?php echo $tzext; ?></textarea>
        </div>
        <div class="kontaktbutton">
          <button class="tlacitkokontakt" type="submit" name="novinkavole_submit">Odeslat</button>
        </div>
      </form>
    </div>
  </div>

  <?php

}
else {
  ?>

     <div class="Kontaktform">
       <div class="Nadpis">
         <span>Kontaktujte nás</span>
       </div>
       <?php
       if (isset($_GET['error'])) {
         if ($_GET["error"] == "none") {
           $username = '';
           $email = '';
           $coment = '';
         }
         else {
           $username = $_GET['name'];
           $email = $_GET['email'];
           $coment = $_GET['com'];
         }


         if ($_GET["error"] == "emptyinput") {
           echo "<p>Vyplňte všechna pole!</p>";
         }
         else if ($_GET["error"] == "invaliduid") {
           echo "<p>Neplatné Jméno!</p>";
         }
         else if ($_GET["error"] == "invalidemail") {
           echo "<p>Nepatný E-mail!</p>";
         }
         else if ($_GET["error"] == "invalidcommnt") {
           echo "<p>Neplatné znaky ve zprávě!</p>";
         }
         else if ($_GET["error"] == "stmtfailed") {
           echo "<p>Někde se stala chyba, nezoufejte, neni u vás.</p>";
         }
         else {
           echo "<p>Někde chyba, asi?</p>";
         }
       }
       else {
         $username = '';
         $email = '';
         $coment = '';
       }
       ?>
       <div class="formular">
         <form class="" action="includes/Comment.inc.php" method="post">
           <div class="labelkontakt">
             <label>Jméno</label>
             <input type="text" name="jmeno" id="jmeno" required='' value="<?php echo $username; ?>">
           </div>
           <div class="labelkontakt">
             <label>Email</label>
             <input type="text" id="email" name="email" required='' value="<?php echo $email; ?>">
           </div>
           <div class="labelkontakt textarea">
             <label>Zpráva</label>
             <textarea name="komentar" id="komentar" rows="3" required=''><?php echo $coment; ?></textarea>
           </div>
           <div class="kontaktbutton">
             <button class="tlacitkokontakt" type="submit" name="submit-kontakt">Odeslat</button>
           </div>
         </form>
       </div>
     </div>

     <?php
   }

    ?>
    <br>
    <br>
    <center>
      <iframe src="https://discord.com/widget?id=826891296190496818&theme=dark" width="550" height="500" allowtransparency="" frameborder="0" sandbox="allow-popups allow-popups-to-escape-sandbox allow-same-origin allow-scripts"></iframe>
    </center>
   </div>
 </main>


<?php

  require_once "footer.php";

 ?>
