<?php
	 $un = "UName";
	$uname = $_POST[$un];
	$upass = $_POST["Pass"]; 
	
	/* $uname = "leontymo";
	$upass = "tim"; */
	include("connect.php");
         if($db){
        $sql = "select * from admin where AdminUsername = '$uname' and Password = '$upass'";
		$result = mysqli_query($db,$sql);
		//check whether result set is empty
		$rows = mysqli_num_rows($result);
		if($rows == 0){
			echo("fail");
		}else{
			$userdetails = array();
			while($arr = mysqli_fetch_array($result)){
				$userdetails['name'] = $arr['AdminName'];
				$userdetails['uname'] = $arr['AdminUsername'];
				$userdetails['email'] = $arr['Email'];
				$userdetails['pass'] = $arr['Password'];
				$userdetails['tel'] = $arr['TelephoneNo'];
				$userdetails['logintimes'] = $arr['logintimes'];
				
			}
			echo json_encode($userdetails);
			mysqli_close($db);
		}
		
     }else{
      echo("Fail");
    }
?>