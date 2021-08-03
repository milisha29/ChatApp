<?php
// Getting the value of post parameters
$room =$_POST['room'];


//Checking the room length 
if(strlen($room)>20 or strlen($room)<2){
    $msg ="Please choose room name between 2 and 20";

    //now sending javascript to browser via php
    echo '<script language="javascript">';
    echo "alert('.$msg.');";
    echo 'window.location="http://localhost:8080/Projects/chatAppUsingPHP";';
    echo '</script>';
}
else if(!ctype_alnum($room)){
    $msg ="Please enter a room name containing only numbers and alphabets";
     //now sending javascript to browser via php
     echo '<script language="javascript">';
     echo "alert('.$msg.');";
     echo 'window.location="http://localhost:8080/Projects/chatAppUsingPHP"';
     echo '</script>';
}
else{
    //Connecting to the database
    include 'db_connect.php';
}

$sql = "SELECT * FROM rooms WHERE roomname='$room'";
$result =mysqli_query($conn,$sql);
if($result){
    if(mysqli_num_rows($result)>0){
        $msg="Please choose another room name as this name already exists";
        echo '<script language="javascript">';
        echo "alert('.$msg.');";
        echo 'window.location="http://localhost:8080/Projects/chatAppUsingPHP";';
        echo '</script>';
    }
    else{
        $sql="INSERT INTO `rooms`(`roomName`, `Time`) VALUES ('$room',CURRENT_TIMESTAMP)";
        $result = mysqli_query($conn,$sql);
        if($result){
            //room created 
            $msg="Room Created!!Now you can chat and have fun";
            echo '<script language="javascript">';
            echo "alert('.$msg.');";
            echo 'window.location="http://localhost:8080/Projects/chatAppUsingPHP/rooms.php?roomname='.$room.'";';
            echo '</script>';
        }
    }
}
else{
    echo "error:".mysqli_error($conn);
}


?>