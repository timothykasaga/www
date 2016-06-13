<?php
	$name = $_POST['Name'];
	$supermarket_id = $_POST['SupermarketID'];
	//$name = "paula";
	//$supermarket_id = "Paula19";
	
	include("connect.php");
	
	if($db){
	
	$sqlgetgenDetails = "select supermarket_details.SupermarketName, supermarket_details.TelephoneNo, supermarket_details.Website,
	supermarket_details.Email,supermarket_details.Slogan from supermarket_details where supermarket_details.AdminUsername = '$name'
	and supermarket_details.SupermarketID = '$supermarket_id'";
	
	$result = mysqli_query($db,$sqlgetgenDetails);
	$rows = mysqli_num_rows($result);
		if($rows == 0){
			echo("fail");
		}else{
			while($row = mysqli_fetch_array($result)){
				$arr[] = array("name"=>$row[0],"tel"=>$row[1],"web"=>$row[2],"email"=>$row[3],"slogan"=>$row[4]);
			}
			$json = json_encode($arr);
			echo($json);
			}
	}else{
		echo("fail");
	}
	
?>