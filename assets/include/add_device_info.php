<?php

include('./connect.php');
$main_list = $_REQUEST['main_list'];
$sub_location = $_REQUEST['sub_location'];
$device_name = $_REQUEST['device_name'];
$device_ip = $_REQUEST['device_ip'];


$arr['mainList'] = $main_list;
$arr['subLocation'] = $sub_location;
$arr['devicename'] = $device_name;
$arr['deviceip'] = $device_ip;

// var_dump($mainLocation_List);
// var_dump($subLocation);
$arr['infonameok'] = "no";
//Chech SubLocation is null
if( $device_ip=="" || $device_name=="")
{
	$str ="Device Name and Device IP is require";
	print_r($str);
}

 else 
 {
   //verify enterd machine Device_name already exist against selected subLocation_name
	$rs = mysqli_query($cn, "SELECT sub_location.*, device_info.*
	FROM device_info
	INNER JOIN sub_location ON sub_location.sub_id = device_info.sub_id && sub_location.sub_location_name='$sub_location'
	WHERE device_info.device_name='$device_name'");
	$row = mysqli_fetch_array($rs);
	if ($row)
	{
		$str=$device_name." already exist against ".$sub_location;
	    print_r($str);
	}
	else{
		//Finally add Machine
		$result =mysqli_query($cn,"SELECT * FROM sub_location WHERE sub_location_name='$sub_location'");
		$row =mysqli_fetch_array($result);
		$id=$row['sub_id'];
		mysqli_query($cn, "INSERT INTO`device_info`(`sub_id`, `device_name`, `device_ip`) VALUES ('$id','$device_name','$device_ip')");
		$str=$device_name." added  against ".$sub_location;
		print_r($str);
	}
		
 }
 mysqli_close($cn);
 ?>
