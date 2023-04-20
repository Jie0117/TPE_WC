
<?php
header('Access-Control-Allow-Origin: *');
$hostname="localhost";
$username="root";
$password="12345678";
$database="database";

$link=mysqli_connect( $hostname,$username , $password);
mysqli_query($link,"SET NAMES 'UTF8'");
mysqli_select_db($link,$database) or die ("無法選擇資料庫");


$sql="SELECT * FROM `users` ";
$result =mysqli_query($link,$sql) or die ("無法送出" . mysqli_error());
$arr = array();
// 输出每行数据
while($row = $result->fetch_assoc()) {
    $count=count($row);//不能在循环语句中，由于每次删除row数组长度都减小
    for($i=0;$i<$count;$i++){
        unset($row[$i]);//删除冗余数据
    }
    array_push($arr,$row);
 
}



echo json_encode($arr,JSON_UNESCAPED_UNICODE);//json编码



 

mysqli_close($link);
mysqli_free_result($result);
?>


