<?php 
	include("connect.php");
	
		$query = "update cell_margins set marge_bottom = 288 where cell_no >= 1 and cell_no <=26";
		mysqli_query($db,$query);
	}
?>