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

$yearly_income_compare_query = sprintf("SELECT year,total_income from yearlyincome order by year asc");
$result = $mysqli->query($yearly_income_compare_query);

$data= array();
foreach($result as $row){
    $data[]=$row;
}
$result->close();

$mysqli->close();
print json_encode($data);
?>