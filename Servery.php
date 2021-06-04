<?php

  require 'header.php';

  define('__SERVER__', '159.69.42.12:30150');

//functions.inc.php or where ever you want it.
function serverInfo($conn) {
	$players = 0;
	$json = @file_get_contents('http://' . $conn . '/players.json');
	if($json) {
		$data = json_decode($json);
		foreach ($data as $player) {
			$players++;
		}

		sort($data);

		$info = array(
			'playercount' => $players,
			'players' => $data,
		);
	} else {
		$info = array(
			'playercount' => $players,
			'players' => array(),
		);
	}
	return $info;
}

$server = serverInfo(__SERVER__);
 ?>
 <main class="specialmain">
 <div class="box">
   <a href="#">
   <div class="card">
     <div class="imgBx">
        <img src="CSS/Images/FiveM.png" alt="images">
     </div>
     <div class="details">

        <h2>Rose Drift<br><span><?php echo $server['playercount']; ?> hráčů</span></h2>
      </div>
   </div></a>
     <a href="#">
     <div class="card">
       <div class="imgBx">
           <img src="CSS/Images/51368814_651850448566004_6114548401611735040_n.jpg" alt="images">
       </div>
       <div class="details">
           <h2>NoneCraft<br><span>WORK IN PROGRESS</span></h2>
       </div>
     </div></a>
      <a href="#">
      <div class="card">
        <div class="imgBx">
           <img src="CSS/Images/300px-Unturned_Logo.jpg" alt="images">
        </div>
        <div class="details">
           <h2>NoneTurned<br><span>V Plánu</span></h2>
         </div>
      </div></a>
 </div>

 <?php print_r($server['players']); ?>
</main>
