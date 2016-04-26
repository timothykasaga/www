<?php
//receive data from android

$products = $_POST['Productlist'];
$products = json_decode($products);

$sname = $_POST['Name'];
$slocation = $_POST['Location'];
$swebsite = $_POST['Website'];
$semail = $_POST['Email'];
$stel = $_POST['Tel'];
$sdesc = $_POST['Desc'];
$slat = $_POST['Lat'];
$slog = $_POST['Log'];
$sadmin = $_POST['Admin'];
 
$track_id = 1;

	include("connect.php");
	
	if($db){
	
	//Obtaining a unique id for supermarket
	$query = "select count(SupermarketName) from supermarket_details";
	$result = mysqli_query($db,$query);
	while($arr = mysqli_fetch_array($result)){
	$track_id = $track_id+$arr[0];
	}
		
		//Store super_mkt_details
	$sqlDetails = "insert into supermarket_details(SupermarketID,SupermarketName,Website,Email,
	TelephoneNo,Slogan,AdminUsername) values('$sname$track_id','$sname','$swebsite','$semail','$stel','$sdesc','$sadmin')";
	mysqli_query($db,$sqlDetails);
	
	//Store prodts
	foreach($products as $value1){
	
		$pname = $value1[0];
		$pid = $value1[1];
		$punitcost = $value1[2];
		$punits = $value1[3];
		$psection = $value1[4];
		
		$sql1 ="insert into product(ProductName,SupermarketID,ProductID,Measurement
		,UnitCost,SectionName) values ('$pname','$sname$track_id','$pid','$punits',$punitcost,'$psection')";
		mysqli_query($db,$sql1);
		
		}
	
	//Store lats and logs of supermarkets
	$sql = "insert into supermarket_location(SupermarketID,Latitude,Longitude,LocationName) values('$sname$track_id',$slat,$slog,'$slocation')";
	mysqli_query($db,$sql);
	echo("success");
	mysqli_close($db);
	}
	else{
	echo("fail");
	}

