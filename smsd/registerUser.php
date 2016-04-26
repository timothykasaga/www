<?php
	 $name = $_POST["Name"];
	$email = $_POST["Email"];
	$uname = $_POST["UName"];
	$upass = $_POST["Pass"];
	$tel = $_POST["Tel"];  
	
/* $name = "kasaga";
	$email = "kasaga";
	$uname = "kasaga";
	$upass = "kasaga";
	$tel = "070123"; */
	
	include("connect.php");
	$sql = "insert into admin(AdminName,Email,AdminUsername,Password,TelephoneNo) values('$name','$email','$uname','$upass','$tel')";
	$result = mysqli_query($db,$sql);
	if($result){
	$resp = "success";
	echo($resp);
	}else{
	$resp ="failed";
	echo($resp);
	}
	mysqli_close($db);
?>