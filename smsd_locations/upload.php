<?php
      $name = $_FILES['myfile']['name'];
	  $temploc = $_FILES['myfile']['tmp_name'];
	  $error = $_FILES['myfile']['error'];
	  if($error > 0){
		die("Error uploading file $error");
	  }else{
		echo("Upload successful !!!!");
	  }
	  
?>