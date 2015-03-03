<?php
	$hostname="localhost";
	$username="root";
	$password="";
	$database="williams";

	$in_id="2417892315";
	$in_wager="10";
	$in_won="100";
	$in_hash="18903058cccea0c3fa4f568afe2d46805d2d7c43";

	// Connect to a database
	mysql_connect ($hostname, $username, $password) or die ("Database connection failed");
	
	mysql_select_db ($database) or die ("Database selection failed");
	
	$query = "SELECT * FROM player WHERE Player_ID = '$in_id'";
	
	$result = mysql_query ($query) or die ("Database query failed");

	if ($result) {
		$row = mysql_fetch_array($result);

		$hash = sha1($row['Player_ID']+$row['Player_Name']+$row['Player_Salt_Value']);
			
		if ($in_hash = $hash) {

			// Update player database with new values
			$new_credits = $row['Player_Credits'] - $in_wager + $in_won;
			$new_spins = ++$row['Player_Lifetime_Spins'];

			// echo "$new_credits\n";
			// echo "$new_spins\n";
			
			$query2 = "UPDATE Player SET Player_Credits='$new_credits', Player_Lifetime_Spins='$new_spins' WHERE Player_ID = '$in_id'";

			$result2 = mysql_query ($query2);
			
			if ($result2) {
				echo "<p>Database updated successfully</p>";

				class Player {
					public $ret_id = "";
					public $ret_name = "";
					public $ret_credits = "";
					public $ret_spins = "";
					public $ret_avg = "";
				}
			
				$ret = new Player();
				$ret->ret_id = $row['Player_ID'];
				$ret->ret_name = $row['Player_Name'];
				$ret->ret_credits = $new_credits;
				$ret->ret_spins = $new_spins;
				$ret->ret_avg = number_format($row['Player_Lifetime_Spins'] / $row['Player_Credits'], 2);

				echo json_encode($ret);
			}
			else
				echo "<p>Database update failed</p>";
		} else {
			die ("No match!");
		}
	}
	
	mysql_close();
?>
