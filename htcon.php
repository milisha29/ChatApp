<?php

include "db_connect.php";
$room =$_POST['room'];
$sql ="SELECT msg,ip,stime FROM msgs WHERE room ='$room'";
$res ="";
$result =mysqli_query($conn,$sql);
if($result){

    if(mysqli_num_rows($result)>0){
        $count=1;
        while($row = mysqli_fetch_assoc($result)){
            if($count %2 ==0){
            $res =$res .'<div class="container bg-success">';
            $res =$res . $row['ip'];
            $res =$res . 'says <p>'. $row['msg'].'</p>';
            $res =$res . '<span class="time-left">';
            $res =$res.$row['stime'].'<span></div>';
            }
            else{
                $res =$res .'<div class="container bg-primary right">';
                $res =$res . $row['ip'];
                $res =$res . 'says <p class="right">'. $row['msg'].'</p>';
                $res =$res . '<span class="time-right">';
                $res =$res.$row['stime'].'<span></div>';
            }
          $count++;
        }
    }
    echo $res;
}
else{
    die('Error: '.mysqli_error($conn));
}

?>