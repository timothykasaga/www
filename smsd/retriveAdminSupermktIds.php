<?php
	$name = $_POST['Name'];
	//$name = "paula";
	include("connect.php");
	
	if($db){
	
		
	
	 $sqlgetids = "select supermarket_details.SupermarketID from supermarket_details where supermarket_details.AdminUsername = '$name'";
	$result = mysqli_query($db,$sqlgetids);
	$rows = mysqli_num_rows($result);
		if($rows == 0){
			echo("fail");
		}else{
			while($row = mysqli_fetch_array($result)){
				$arr[] = $row[0];
			}
			$json = json_encode($arr);
			echo($json);
			}
	}else{
		echo("fail");
	}
	
?>