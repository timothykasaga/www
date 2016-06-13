<?php
	$name = $_POST['Name'];
	$supermarket_id = $_POST['SupermarketID'];
	$sm_name = $_POST['SupermarketName'];
	$sm_email = $_POST['Email'];
	$sm_tel = $_POST['Tel'];
	$sm_web = $_POST['Website'];
	$sm_slogan = $_POST['Desc'];
	//$name = "paula";
	//$supermarket_id = "Paula19";
	
	include("connect.php");
	
	if($db){
	
	$sqlmodgenDetails = "update supermarket_details set 
	supermarket_details.SupermarketName = '$sm_name', 
	supermarket_details.TelephoneNo = '$sm_tel', 
	supermarket_details.Website = '$sm_web',
	supermarket_details.Email = '$sm_email',
	supermarket_details.Slogan = '$sm_slogan' 
	where supermarket_details.AdminUsername = '$name' and supermarket_details.SupermarketID = '$supermarket_id'";
	
	$result = mysqli_query($db,$sqlmodgenDetails);
	$rows = mysqli_affected_rows($db);
		if($rows == 0){
			echo("fail");
		}else{
			echo("success");
			}
	}else{
		echo("fail");
	}
	
?>