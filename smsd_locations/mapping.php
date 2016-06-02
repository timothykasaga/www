<?php
 
	if(isset($_POST['sname']) && isset($_POST['sid']) && isset($_POST['floorno']) && isset($_POST['secname']) && isset($_POST['secid']) && isset($_POST['cells'])){
		$sm_name = $_POST['sname'];
		$sm_id = $_POST['sid'];
		$floor_no = $_POST['floorno'];
		$sec_name = $_POST['secname'];
		$sec_id = $_POST['secid'];
		$sec_cells = $_POST['cells'];
		if($sm_name == "" || $sm_id == "" || $floor_no == "" || $sec_name == "" || $sec_id == ""){
			header("Location: home.php");
		}else{
			include("connect.php");
			if($db){
			echo "Connection to db made <br>";
			echo "Supermarket name: ".$sm_name . "<br>Supermarket id: ".$sm_id .  "<br>Floor no.: ".$floor_no . "<br>
			Section name: ".$sec_name . "<br>Section id: ".$sec_id;
			echo "<br>Grid cells<br>";
			foreach($sec_cells as $a){
			echo($a . "<br>");
			}
			
			//try to save details in db.
			$query_sec_details = "insert into section(SectionName,section_id,SupermarketID,floor_no)
			values('$sec_name','$sec_id','$sm_id',$floor_no)";
			$query_sec_location = "insert into section_location(section_id,SupermarketID,cell_no) 
			values('$sec_id',$sm_id,'$a')";
			mysqli_query($db,$query_sec_details);
				$rows = mysqli_affected_rows($db);
				if($rows > 0){
				foreach($sec_cells as $a){
				$query_sec_location = "insert into section_location(section_id,SupermarketID,cell_no) 
				values('$sec_id','$sm_id','$a')";
				mysqli_query($db,$query_sec_location);
				}
				}
			
			
			}
		}
	
		
	}else{
		echo "Please reload form and enter all details";
	}

?>