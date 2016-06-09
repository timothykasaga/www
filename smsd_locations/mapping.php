<?php
 session_start();
 
	if(isset($_POST['sname']) && isset($_POST['sid']) && isset($_POST['floorno']) && isset($_POST['secname']) && isset($_POST['secid']) && isset($_POST['cells'])){
		$sm_name = $_POST['sname'];
		$sm_id = $_POST['sid'];
		$floor_no = $_POST['floorno'];
		$sec_name = $_POST['secname'];
		$sec_id = $_POST['secid'];
		$sec_cells = $_POST['cells'];
		$sec_route = $_POST['route'];
		$a = '';
		if($sm_name == "" || $sm_id == "" || $floor_no == "" || $sec_name == "" || $sec_id == ""){
			header("Location: home.php");
		}else{
			include("connect.php");
			if($db){
			
			/*
			echo "Connection to db made <br>";
			echo "Supermarket name: ".$sm_name . "<br>Supermarket id: ".$sm_id .  "<br>Floor no.: ".$floor_no . "<br>
			Section name: ".$sec_name . "<br>Section id: ".$sec_id;
			echo "<br>Grid cells<br>";
			foreach($sec_cells as $a){
			echo($a . "<br>");
			}
			
			*/
			
			
			
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
				foreach($sec_route as $a1){
				$sec_route = "insert into section_route(section_id,SupermarketID,cell_no) values('$sec_id','$sm_id','$a1')";
				mysqli_query($db,$sec_route);
				}
				}
			//header("Location:home.php");
			
			}
		}
	?>
		<html>
		<head>
		<title>Mapping sections</title>
		<link rel="stylesheet" href="home.css" />
		</head>
		<body>
		<section class="main_article_map">
		<h4>More Section mapping <h4>
		<div class="myimages">
				
                <div id ="floor_image">
				<center>
				 
					<img src="<?php echo $_SESSION["image"]?>" alt="Image not uploaded" id="myImg"/>
				
				
				</center>
                </div>

        </div>
				
				<hr>
				<h4>Mappings</h4>
                 <form action="mapping.php" method="POST" style="height: 300px" >
                     <div>
                     <label for="sname" >Supermarket name</label><input type="text" name="sname"required="required" />
                     <label for="s_id">Supermarket id</label><input type="text" name="sid" required="required"/>
                     <label for="floor_no">Floor number</label><input  type="number" name="floorno" required="required"/>
                     </div>
                     <br>
                     <div>
                     <label for="sname">Section name&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp</label><input type="text" name="secname" required="required"/>
                     <label for="sid">Section id&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp</label><input type="text" name="secid" required="required"/>
                     </div>

                     <h4>Grid cells for section </h4>
                     <div>
					 <label>Section location<label>
                     <select name="cells[]"  multiple="multiple" size="5" style="width: 200px";"float:left" required="required"> 
					 <?php 
						for($i =1; $i<495 ;$i++){
						echo "<option >$i</option>";
						}
						?>
                     </select>
					
					 <label>Route from entrance</label>
                     <select name="route[]"  multiple="multiple" size="5" style="width: 200px";"float:right" required="required">
					 
					 <?php 
						for($i =1; $i<495 ;$i++){
						echo "<option >$i</option>";
						}
						?>
					 
                     </select>
                    
					 
					 </div>
					 <hr>
                    <input type="submit" name="save" value="Save section details" />
                 
                </form>
				
		</section>
		</body>
		</html>
		
	<?php	
		
	}else{
		echo "Please reload form and enter all details";
	}

?>