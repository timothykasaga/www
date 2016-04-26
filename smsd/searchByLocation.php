<?php
	$location = $_POST['Location'];
	include("connect.php");
	
	if($db){
	
		$sql = "select supermarket_location.Latitude,supermarket_location.Longitude,supermarket_details.SupermarketName,supermarket_details.SupermarketID,
	supermarket_details.TelephoneNo from supermarket_location,supermarket_details
	where supermarket_location.LocationName = '$location' and supermarket_location.SupermarketID = supermarket_details.SupermarketID";
	$result = mysqli_query($db,$sql);
	$rows = mysqli_num_rows($result);
		if($rows == 0){
			echo("fail");
		}else{
			while($row = mysqli_fetch_array($result)){
				$arr[] = array("lat"=>$row[0],"log"=>$row[1],"sname"=>$row[2],"sid"=>$row[3],"contact"=>$row[4]);
			}
			$json = json_encode($arr);
			echo($json);
			}
	}else{
		echo("fail");
	}
	
?>