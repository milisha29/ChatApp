<?php

//Connect to database
include "db_connect.php";

$room =$_POST['room'];
$msg =$_POST['text'];
$ip =$_POST['ip'];
 $sql ="INSERT INTO `msgs` (`msg`, `room`, `ip`,`stime`) VALUES ('$msg', '$room', '$ip',current_timestamp())";
$result =mysqli_query($conn,$sql);
if($result){
    // echo "msg inserted un database";
}
else{
    die("Error: ".mysqli_error($conn));
}



?>