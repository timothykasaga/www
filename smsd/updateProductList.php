<?php
$products = $_POST['ProductList'];
$str = preg_replace('/\\\\\"/',"\"", $products);

$str = json_decode($str);

$prodt_no = $_POST['Product_num'];
$sm_id = $_POST['SupermarketID'];

	include("connect.php");
	
	if($db){
	
	//Delete old product list
	$query = "delete from product where SupermarketID = '$sm_id'";
	$result = mysqli_query($db,$query);
		
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
		
		
		$sql1 ="insert into product(ProductName,SupermarketID,ProductID,Measurement,UnitCost,SectionName) values ('$pname','$sm_id','$pid','$punits',$punitcost,'$psection')";
		mysqli_query($db,$sql1);
		
		}
       
        echo("success");
	
	mysqli_close($db);
	}
	else{
	echo("fail");
	}

?>