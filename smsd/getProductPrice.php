<?php
	$productname = $_POST['Product'];
	//$productname = 'maize';
	include("connect.php");
	
	if($db){
	
		$sql = "select supermarket_details.SupermarketName,supermarket_details.SupermarketID,
	product.ProductName,product.UnitCost,product.Measurement,product.ProductID,product.SectionName,supermarket_location.LocationName
	from product,supermarket_details,supermarket_location
	where product.ProductName = '$productname' and product.SupermarketID = supermarket_details.SupermarketID 
	and supermarket_location.SupermarketID = supermarket_details.SupermarketID";
	$result = mysqli_query($db,$sql);
	$rows = mysqli_num_rows($result);
		if($rows == 0){
			echo("fail");
		}else{
			while($row = mysqli_fetch_array($result)){
				$arr[] = array("smname"=>$row[0],"smid"=>$row[1],"pname"=>$row[2],"unitcost"=>$row[3],"measurement"=>$row[4],
				"pid"=>$row[5],"section"=>$row[6],"location"=>$row[7]);
			}
			$json = json_encode($arr);
			echo($json);
			}
	}else{
		echo("fail");
	}
	
?>