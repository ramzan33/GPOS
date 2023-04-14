<?php

 $val=$_GET['selectValue'];
include('../GPOS/assets/include/connect.php');
echo $val;




$result = mysqli_query($cn, "SELECT sub_location.sub_location_name
FROM sub_location
INNER JOIN main_location
ON sub_location.main_id=main_location.main_id WHERE main_location.main_location_name='$val'");
	
    foreach($result as $row){
        $sub_name=$row["sub_location_name"];
        echo "<option>$sub_name</option/>";
    }

      
?>