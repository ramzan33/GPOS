<?php session_start();
include("../include/connect.php");

$info_name_del = $_REQUEST['del_val'];
$arr['infoid'] = $_REQUEST['del_val'];
$arr['infonameok'] = "no";



$rs1 = mysqli_query($cn, "select * from device_info where machine_id='$info_name_del'");

$row1 = mysqli_fetch_array($rs1);


$info_name = $row1['device_name'];




mysqli_query($cn, "delete from device_info where machine_id='$info_name_del'");
$arr['mesage'] = "information data: $info_name has been deleted";
$arr['infonameok'] = "yes";



echo json_encode($arr);
?>
