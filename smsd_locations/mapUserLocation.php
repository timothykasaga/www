<?php
	/* $cell_no = $_POST['cell_no'];
	$floor_no = $_POST['foor_no'];
	$product_name = $_POST['product_name'];
	$supermarket_id = $_POST['supermarket_id']; */
	
	$supermarket_id = "Tuskys9";
	$cell_no = 300;
	$product_name = 'Maize';
	$floor_no = 8;
	$prodt_sec_floor_no = -1;
	$prodt_sec = '';
	
	$path = '';
	
	include("connect.php");
	
	//queries to user location and product section
	
	$query_get_user_loc = "select section.floor_no, section.SectionName from section, section_location
	where section_location.cell_no = $cell_no and section_location.section_id= section.section_id and section_location.SupermarketID = section.SupermarketID
	and section.floor_no = $floor_no";
	$query_get_prodt_loc ="select product.SectionName, section.floor_no, section.SectionName,section.section_id
	from product,section where product.ProductName = '$product_name' and product.SectionName = section.section_id 
	and product.SupermarketID = section.SupermarketID and product.SupermarketID = '$supermarket_id'";
	
	//get_product_location
	$result1 = mysqli_query($db, $query_get_prodt_loc);
	$rows = mysqli_affected_rows($db);
	if($rows == 0){
	echo "Error";
	}else{
	while($data1 = mysqli_fetch_array($result1)){
	$prodt_sec_floor_no = $data1[1];
	$prodt_sec = $data1[3];
	}
	}
	
	//check whether user and product section are on the same floor
	if($floor_no == $prodt_sec_floor_no){
		mapUserOnFloor($floor_no,$cell_no,$supermarket_id);
		mapSectionLocation($prodt_sec,$supermarket_id, $prodt_sec_floor_no);
		//echo "Please find ur product";
	}else{
		mapUserOnFloor($floor_no,$cell_no,$supermarket_id);
		//echo "You are on floor : $floor_no <br>Product is on floor : $prodt_sec_floor_no<br>";
	}
	
	function mapUserOnFloor($user_floor,$cell_no,$supermarket_id){
		// Load the stamp and the photo to apply the watermark to
		$stamp1 = imagecreatefrompng("testlocateuser/marker.png");
		$sx = imagesx($stamp1);
		$sy = imagesy($stamp1);
						
						
		// Set the margins for the stamp and get the height/width of the stamp image
						
		//initialize counter
		$counter = 0;
		
		$marge_right = 0;
		$marge_bottom = 0;
		//get margins basing on the cell_no
		include("connect.php");
		$sql_mag = "select marge_right,marge_bottom from cell_margins where cell_no = $cell_no";
		$result_mag = mysqli_query($db,$sql_mag);
		while($data = mysqli_fetch_array($result_mag)){
			$marge_right = $data[0];
			$marge_bottom = $data[1];
		}
		
		
		
		while($counter < 1)
		{
			$im = null;
			if($counter == 0){
			$sql_get_img = "select image_name, image from images where SupermarketID = '$supermarket_id' and floor_no = $user_floor ";
			$result_img = mysqli_query($db,$sql_get_img);
			$data_img = mysqli_fetch_array($result_img);
			if($data_img == null){
			echo "Did nt work";
			}else{
			file_put_contents('images/photo.jpg',$data_img[1]);
			$im = imagecreatefromjpeg('images/photo.jpg');
			
			}	
			}else{
			$im = imagecreatefromjpeg('testlocateuser/nu_loc.jpeg');
			}
						
		// Merge the stamp onto our photo with an opacity of 50%
		imagecopymerge($im, $stamp1, imagesx($im) - $sx - $marge_right, 
		imagesy($im) - $sy - $marge_bottom, 0, 0, imagesx($stamp1), imagesy($stamp1),50);

		// Save the image to file and free memory
		imagejpeg($im, 'testlocateuser/nu_loc.jpeg');
		
		$path = 'nu_loc.jpeg';
		//echo json_encode($path);
		
		imagedestroy($im); 
		$marge_right = $marge_right+30;
		$counter = $counter+1;
		}
	}
	function mapSectionLocation($sec_id,$supermarket_id,$floor_no){
		include("connect.php");
		global $path;
		//$section_id = $sec_id;
		$query = "select cell_no from section_location where section_id = '$sec_id' and SupermarketID = '$supermarket_id'";
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
					$im = imagecreatefromjpeg('testlocateuser/nu_loc.jpeg');	
					}else{
					$im = imagecreatefromjpeg('testlocateuser/nu_loc.jpeg');
					}
				imagecopymerge($im, $stamp1, imagesx($im) - $sx - $data[1], 
				imagesy($im) - $sy - $data[2], 0, 0, imagesx($stamp1), imagesy($stamp1),50);

				// Save the image to file and free memory
				imagejpeg($im, 'testlocateuser/nu_loc.jpeg');
				
				//try to resize image
					  $source_image = imagecreatefromjpeg('testlocateuser/nu_loc.jpeg');
					  $source_imagex = imagesx($source_image);
					  $source_imagey = imagesy($source_image);
					  $dest_imagex = 375;
					  $dest_imagey = 275;
					  $dest_image = imagecreatetruecolor($dest_imagex, $dest_imagey);
					  imagecopyresampled($dest_image, $source_image, 0, 0, 0, 0, $dest_imagex, $dest_imagey, $source_imagex, $source_imagey);

					  imagejpeg($dest_image, 'testlocateuser/nu_loc1.jpeg');
					  //move_uploaded_file($temploc,"images/".$name.".jpg");
					  //merge_images($name);
					  //finish resize
				
				$path = 'nu_loc1.jpeg';
				imagedestroy($im);
												
			}
			//echo json_encode($path);
			
			$counter = $counter+1;
							
		}
		

	}
	
	echo $path;
	
?>