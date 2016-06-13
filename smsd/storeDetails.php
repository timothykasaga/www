<?php
$products = $_POST['Productlist'];
$str = preg_replace('/\\\\\"/',"\"", $products);

$str = json_decode($str);

$prodt_no = $_POST['Product_num'];
$sname = $_POST['Name'];
$slocation = $_POST['Location'];
$swebsite = $_POST['Website'];
$semail = $_POST['Email'];
$stel = $_POST['Tel'];
$sdesc = $_POST['Desc'];
$slat = $_POST['Lat'];
$slog = $_POST['Log'];
$sadmin = $_POST['Admin']; 
$track_id = 1;
	include("connect.php");
	
	if($db){
	
	//Obtaining a unique id for supermarket
	$query = "select count(SupermarketName) from supermarket_details";
	$result = mysqli_query($db,$query);
	while($arr = mysqli_fetch_array($result)){
	$track_id = $track_id+$arr[0];
	}
		
		//Store super_mkt_details
	$sqlDetails = "insert into supermarket_details(SupermarketID,SupermarketName,Website,Email,
	TelephoneNo,Slogan,AdminUsername) values('$sname$track_id','$sname','$swebsite','$semail','$stel','$sdesc','$sadmin')";
	mysqli_query($db,$sqlDetails);
	
	//Store lats and logs of supermarkets
	$sql = "insert into supermarket_location(SupermarketID,Latitude,Longitude,LocationName) values('$sname$track_id',$slat,$slog,'$slocation')";
	mysqli_query($db,$sql);
	
	
	$count = 0;
       

	//Store prodts
	
      for($count = 0;$count<$prodt_no;$count++){

		
       $current_prodt = $str->$count;

       $pname = $current_prodt->name;
       $pid = $current_prodt->id;
       $punitcost = $current_prodt->cost;
       $punits = $current_prodt->units;
       $psection = $current_prodt->sec;
         
              

		$sqlgetSec = "select section.section_id from section where section.section_id = '$psection'";
				$myres = mysqli_query($db,$sqlgetSec);
		$rows = mysqli_affected_rows($db);
		if($rows == 0)
		{
		$sqlSection = "insert into section(SectionName,section_id,SupermarketID,floor_no) values('$psection','$psection','$sname$track_id',0)";
		mysqli_query($db,$sqlSection);
		}
		
		
		$sql1 ="insert into product(ProductName,SupermarketID,ProductID,Measurement,UnitCost,SectionName) values ('$pname','$sname$track_id','$pid','$punits',$punitcost,'$psection')";
		mysqli_query($db,$sql1);
		
		}
      
		$sqlLogin = "update admin set logintimes = 1 where admin.AdminUsername = '$sadmin'";
		mysqli_query($db,$sqlLogin);
       
        echo("success");
	
	mysqli_close($db);
	}
	else{
	echo("fail");
	}

?>