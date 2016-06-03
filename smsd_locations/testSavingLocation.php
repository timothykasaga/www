<?php 
	include("connect.php");
	$section_id = 'ggg123';
	$query = "select cell_no from section_location where section_id = '$section_id'";
	$result = mysqli_query($db, $query);
	$arr = array();
	$i = 0;
	while($data = mysqli_fetch_array($result)){
	$arr[$i] = $data[0];
	$i = $i + 1;
	}
	
	//get margins for all the cells.
	$stamp1 = imagecreatefromjpeg("testlocateuser/marker.jpg");
		$sx = imagesx($stamp1);
		$sy = imagesy($stamp1);
		$counter = 0;
	foreach($arr as $item){
		$query_margins = "select * from cell_margins where cell_no = $item";
		$result1 = mysqli_query($db,$query_margins);

		while($data = mysqli_fetch_array($result1)){
		$my_cell_margins[] = array("marge_right"=>$data[1],"marge_bottom"=>$data[2]);
		if($counter == 0){
			$im = imagecreatefromjpeg('images/photo.jpg');	
			}else{
			$im = imagecreatefromjpeg('testlocateuser/nu_loc.jpeg');
			}
			imagecopymerge($im, $stamp1, imagesx($im) - $sx - $data[1], 
						imagesy($im) - $sy - $data[2], 0, 0, imagesx($stamp1), imagesy($stamp1),50);

						// Save the image to file and free memory
						imagejpeg($im, 'testlocateuser/nu_loc.jpeg');
						imagedestroy($im);
						
		}
		$counter = $counter+1;
	
	}

	
?>