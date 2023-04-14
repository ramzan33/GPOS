<?php 
// require_once("../include/connection.php");

$content = trim(file_get_contents("php://input"));
$decoded = json_decode($content, true);

error_reporting(E_ALL ^ E_NOTICE);

$servername = "localhost";
$username = "username";
$password = "password";
$dbname = "ezguard_ezc_att";

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);
// Check connection
if ($conn->connect_error) {
  die("Connection failed: " . $conn->connect_error);
}


      


$idNumber=$decoded['idNumber'];
$personType=$decoded['type'];
$name=$decoded['name'];
$gemdar=$decoded['gendar'];
$dateOfBirth=$decoded['dateOfBirth'];
$telephoneNumber=$decoded['telephoneNumber'];
$address=$decoded['address'];
$image=$decoded['image'];

$sql = "INSERT INTO `employee_info`(`employee_name`,`prsnt_address`, `phone_no`,`emp_dob`, `emp_sex`) VALUES ('$name','$address','$telephoneNumber','$dateOfBirth')";
if ($conn->query($sql) === TRUE) {
  echo "New record created successfully";
} else {
  echo "Error: " . $sql . "<br>" . $conn->error;
}

$conn->close();

      

//For Gendar Type
if($decoded['gendar']=="male"){
  $decoded['gendar']=0;
}else if($decoded['gendar']=="female"){
  $decoded['gendar']=1;
}else{
  $decoded['gendar']=2;
}
//For Person Type
if($decoded['type']=="whitelist"){
  $decoded['type']=0;
}else{
  $decoded['type']=1;
}




$curl = curl_init();
$operator="AddPerson";
$deviceId=1794943;
curl_setopt_array($curl, array(
  CURLOPT_URL => 'http://192.168.100.98/action/AddPerson',
  CURLOPT_RETURNTRANSFER => true,
  CURLOPT_ENCODING => '',
  CURLOPT_MAXREDIRS => 10,
  CURLOPT_TIMEOUT => 0,
  CURLOPT_FOLLOWLOCATION => true,
  CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
  CURLOPT_CUSTOMREQUEST => 'POST',
  CURLOPT_POSTFIELDS =>'{
    "operator": "'.$operator.'",
    "info": {
        "DeviceID": '.$deviceId.',
        "PersonType": '.$decoded['type'].',
        "Name": "'. $decoded['name'].'",
        "Gender": '.$decoded['gendar'].',
        "IdCard": "'. $decoded['idNumber'].'",
        "Birthday": "'. $decoded['dateOfBirth'].'",
        "Telnum": "'. $decoded['telephoneNumber'].'",
        "Address": "'.$decoded['address'].'",
        "isCheckSimilarity": 1
    },
    "picinfo": "'.$decoded['image'].'"
}',
  CURLOPT_HTTPHEADER => array(
    'Content-Type: application/json',
    'X-Shopify-Access-Token: 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',
    'Authorization: Basic YWRtaW46YWRtaW4='
  ),
));

$response = curl_exec($curl);

curl_close($curl);
$res= json_decode($response,true);

if($res['code']==200){

$arr['mesage'] = " ".$decoded['name']." enroll into machine";
echo json_encode($arr);
}else{
  $arr['mesage'] = " ".$res['info']['Detail']." ";
  echo json_encode($arr);
}
	

?>
