<?php 
header('Content-Type: application/json');

require('connection.inc.php');

$present_time_date=time();
$this_month=date("m",$present_time_date);
$this_year=date("Y",$present_time_date);
$mysqli= new mysqli(DB_HOST,DB_USER,DB_PASSWORD,DB_NAME);

if(!$mysqli){
    die("Connection failed:" . $mysqli->error);
}

$web_user_analytics_query = sprintf("SELECT * from web_user_analytics");
$result = $mysqli->query($web_user_analytics_query);

$data= array();
foreach($result as $row){
    $data[]=$row;
}
$result->close();

$mysqli->close();
print json_encode($data);
?>