<?php
/**
* Minecraft ScoreBoardStats Class
* @author BerkPW <berk@berk.pw> https://github.com/BerkPW
* @license Free to use but dont remove the author, license and copyright
* @copyright © 2016 BerkPW
*/
class sbst {
	/* Mysql Connect Settings */
	public $host = "localhost";
	public $port = "3306";
	public $user = "root";
	public $pass;
	public $db;
	public $table;

	function mysql() {
		## Mysql Connect ##
		$con = mysql_connect($this->host.":".$this->port, $this->user, $this->pass) or die("Mysql Error: ".mysql_Error());

		## Database Select ##
		$db = mysql_select_db($this->db, $con) or die("Mysql Error: ".mysql_Error());
	}

	/* ScoreBoardStats Settings */
	public $limit = 10; //Max. table row
	public $head = 1; //Player Head (on -> 1 , off -> 0)
	public $m_kill = 1; //Mob Kill (on -> 1 , off -> 0)


	function table() { ?>
		<link href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css" rel="stylesheet">
	    <table class="table table-striped table-hover">
	      <thead>
	        <tr>
	          <th>#</th>
	          <th>Player</th>
	          <th>Kill</th>
	          <?php if ($this->m_kill == 1) {?>
				<th>Mob Kill</th>
	          <?php } ?>
	          <th>Death</th>
	        </tr>
	      </thead>
	      <tbody>
	  	<?php 
  		$sbstc = mysql_query("SELECT * FROM player_stats ORDER BY ((kills+deaths)/2) DESC LIMIT 0,$this->limit");
  		$id = 0;
		while($row = mysql_fetch_array($sbstc)){
    	
    	$playername 		= $row['playername'];
    	$kills 				= $row['kills'];
    	$deaths 			= $row['deaths'];
    	$mobkills 			= $row['mobkills'];
    	$id++;
		?>
	        <tr>
	          <td><?php echo "$id"; ?></td>
	          <td>
			<?php if ($this->head == 1) {?>
	          <img src="https://minotar.net/avatar/<?php echo "$playername"; ?>/17" class="img-circle">
			<?php } ?>
	          <?php echo "$playername"; ?></td>
	          <td><?php echo "$kills"; ?></td>
	          <?php if ($this->m_kill == 1) {?>
	          <td><?php echo "$mobkills"; ?></td>
	          <?php } ?>
	          <td><?php echo "$deaths"; ?></td>

	        </tr>
		<?php } ?>
	      </tbody>
	    </table>

	<?php 	}

}

?>
