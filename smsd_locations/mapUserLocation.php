<?php
	/* $cell_no = $_POST['cell_no'];
	$floor_no = $_POST['foor_no'];
	$product_name = $_POST['product_name'];
	$supermarket_id = $_POST['supermarket_id']; */
	
	$cell_no = 2;
	$product_name = 'Maize';
	$floor_no = 6;
	
	include("connect.php");
	$query_get_user_loc = "select section.floor_no, section.SectionName from section, section_location
	where section_location.cell_no = $cell_no and section_location.section_id= section.section_id and section_location.SupermarketID = section.SupermarketID
	and section.floor_no = $floor_no";
	$query_get_prodt_loc ="select product.SectionName, section.floor_no, section.SectionName,section.section_id
	from product,section where product.ProductName = '$product_name' and product.SectionName = section.section_id 
	and product.SupermarketID = section.SupermarketID";
	//get get_user_location
	$result = mysqli_query($db,$query_get_user_loc);
	$rows = mysqli_affected_rows($db);
	if($rows == 0){
	echo "Error";
	}else{
	while($data = mysqli_fetch_array($result)){
	echo "You are on floor : $data[0] <br>In section : $data[1]<br>";
	}
	}
	
	//get_product_location
	$result1 = mysqli_query($db, $query_get_prodt_loc);
	$rows = mysqli_affected_rows($db);
	if($rows == 0){
	echo "Error";
	}else{
	while($data1 = mysqli_fetch_array($result1)){
	echo "<br>Product is on floor : $data1[1] <br>In section : $data1[2]";
	}
	}
	
?>