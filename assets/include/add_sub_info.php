<?php

include('./connect.php');
$mainLocation_List = $_REQUEST['mainLocation_List'];
$subLocation = $_REQUEST['subLocation'];

$arr['mainLocation'] = $mainLocation_List;
$arr['subLocation'] = $subLocation;

// var_dump($mainLocation_List);
// var_dump($subLocation);
$arr['infonameok'] = "no";
//Chech SubLocation is null
if($subLocation=="")
{
	$str ="Sub location is require";
	print_r($str);
}

 else 
 {
   //verify enterd subLocation already exist against selected mainLocation
	$rs = mysqli_query($cn, "SELECT main_location.*,sub_location.*
	FROM sub_location
	INNER JOIN main_location
	ON sub_location.main_id=main_location.main_id WHERE sub_location.sub_location_name='$subLocation'");
	$row = mysqli_fetch_array($rs);
	if ($row)
	{
		$str=$subLocation." already exist against ".$mainLocation_List;
	    print_r($str);
	}
	else{
		//Finally add subLocation
		$result =mysqli_query($cn,"SELECT main_id FROM main_location WHERE main_location_name='$mainLocation_List'");
		$row =mysqli_fetch_array($result);
		$id=$row['main_id'];
		mysqli_query($cn, "INSERT INTO `sub_location` (`main_id`,`sub_location_name`) VALUES ('$id','$subLocation')");
		$str=$subLocation." added  against ".$mainLocation_List;
		print_r($str);
	}
		
 }
 mysqli_close($cn);
 ?>
