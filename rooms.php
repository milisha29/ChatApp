<?php
$roomname = $_GET['roomname'];
//Connecting the database
include "db_connect.php";
$sql ="SELECT * FROM `rooms` WHERE `roomName` ='$roomname';";
$result = mysqli_query($conn,$sql);
if($result){
    if(mysqli_num_rows($result)<0){
        $msg ="Room does not exits.First Create a valid room on the home page";
        //now sending javascript to browser via php
        echo '<script language="javascript">';
        echo "alert('.$msg.');";
        echo 'window.location="http://localhost:8080/Projects/chatAppUsingPHP"';
        echo '</script>';
    }
}
else{
    die('Error: '.mysqli_error($conn));
}
?>
<!DOCTYPE html>
<html>
<head>
<meta name="viewport" content="width=device-width, initial-scale=1">
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">

<style>
body {
  margin: 0 auto;
  max-width: 800px;
  padding: 0 20px;
}

.container {
  border: 2px solid #dedede;
  background-color: #f1f1f1;
  border-radius: 5px;
  padding: 10px;
  margin: 10px 0;
}

.darker {
  border-color: #ccc;
  background-color: #ddd;
}

.container::after {
  content: "";
  clear: both;
  display: table;
}

.container img {
  float: left;
  max-width: 60px;
  width: 100%;
  margin-right: 20px;
  border-radius: 50%;
}
.right{
  text-align: right;
}
.container img.right {
  float: right;
  margin-left: 20px;
  margin-right:0;
}

.time-right {
  float: right;
  color:rgb(63, 30, 94);
}

.time-left {
  float: left;
  color: rgb(63, 30, 94);
}
.msgboxes{
    height:400px;
    overflow-y:scroll;
}
p{
    font-size:18px;

}
</style>
</head>
<body>
    <!-- navbar -->
    <header class="site-header sticky-top bg-light">
<div class="d-flex flex-column flex-md-row align-items-center pb-3 mb-4 border-bottom">
      <a href="/" class="d-flex align-items-center text-dark text-decoration-none">
     
        <span class="fs-4 mx-4">SimplyChat</span>
      </a>

      <nav class="d-inline-flex mt-2 mt-md-0 ms-md-auto">
        <a class="me-3 py-2 text-dark text-decoration-none" href="#">Home</a>
        <a class="me-3 py-2 text-dark text-decoration-none" href="#">About</a>
        <a class="me-3 py-2 text-dark text-decoration-none" href="#">Contacts</a>
      </nav>
    </div>
</header>

<h2>Chat Messages-<?php echo $roomname?></h2>
<div class="msgboxes">
<!-- <div class="container">
  <img src="/w3images/bandmember.jpg" alt="Avatar" style="width:100%;">
  <p>Hello. How are you today?</p>
  <span class="time-right">11:00</span>
</div> -->
</div>

<input type="text" class="form-control my-2" placeholder="Type text" name="msg" id="msg">
<button class="btn btn-primary my-2" id="btnSend">Send</button>

<!-- Jquery cdn  -->
<script src="https://code.jquery.com/jquery-3.6.0.min.js" integrity="sha256-/xUj+3OJU5yExlq6GSYGSHk7tPXikynS7ogEvDej/m4=" crossorigin="anonymous"></script>
<script src="https://code.jquery.com/jquery-3.6.0.js" integrity="sha256-H+K7U5CnXl1h5ywQfKtSj8PCmoN9aaq30gDh27Xc0jk=" crossorigin="anonymous"></script>

<script>
    var element = document.getElementsByClassName("container");
    element.scrollTop = element.scrollHeight ;
//Check for new msgs every new second
setInterval(runFunction,1000);
function runFunction(){
    $.post('htcon.php',{room:'<?php echo $roomname ?>'},function(data,status){
        document.getElementsByClassName('msgboxes')[0].innerHTML = data;
    })
}



 $("#btnSend").click(function(){
    let clientmsg =$('#msg').val();
  $.post("savemsgs.php",{text:clientmsg,room:'<?php echo $roomname;?>',ip:'<?php echo $_SERVER["REMOTE_ADDR"]?>'}, function(data, status){
   document.getElementsByClassName('msgboxes')[0].innerHTML = data;
  });
  $('#msg').val("");
  return false;
});
</script>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>


</body>

</html>
