<?php
// Database credentials
include('./connect.php');

$mainLocation = $_REQUEST['mainLocation'];

$arr['mainLocation'] = $mainLocation;

$arr['infonameok'] = "no";

if ($mainLocation == "") {
	$str = "Main location is require";
	print_r($str);
} else {

	$rs = mysqli_query($cn, "SELECT * FROM main_location WHERE main_location_name='$mainLocation' ");
	$row = mysqli_fetch_array($rs);
	if ($row) {
		$str = $mainLocation . " already exists";
		print_r($str);
	} else {
		mysqli_query($cn, "INSERT INTO `main_location` (`main_location_name`) VALUES ('$mainLocation')");

		$str = "information data : " . $mainLocation . "data added";
		print_r($str);
	}

}
mysqli_close($cn);
 ?>
