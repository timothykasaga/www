<?php 
	include("connect.php");
	$section_id = 'ggg';
	$query = "select cell_no from section_location where section_id = '$section_id'";
	$result = mysqli_query($db, $query);
	$arr = array();
	$i = 0;
	while($data = mysqli_fetch_array($result)){
	$arr[$i] = $data[0];
	$i = $i + 1;
	}
	
	echo json_encode($arr);
?>