<?php
	$name = $_POST['Name'];
	$supermarket_id = $_POST['SupermarketID'];
	
	include("connect.php");
	
	if($db){
	
	$sqlgetproductlist = "select product.ProductName, product.ProductID, product.Measurement, product.UnitCost, product.SectionName from product
	where product.SupermarketID = '$supermarket_id'";
	
	$result = mysqli_query($db,$sqlgetproductlist);
	$rows = mysqli_num_rows($result);
		if($rows == 0){
			echo("fail");
		}else{
			while($row = mysqli_fetch_array($result)){
				$arr[] = array("p_name"=>$row[0],"p_id"=>$row[1],"p_measure"=>$row[2],"p_unitcost"=>$row[3],"p_section"=>$row[4]);
			}
			$json = json_encode($arr);
			echo($json);
			}
	}else{
		echo("fail");
	}
	
?>