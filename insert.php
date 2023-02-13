<?php
include "db.php";
if(isset($_POST['tittle']))
{
$title=mysqli_escape_string($db,$_POST['tittle']);
$message=mysqli_escape_string($db,$_POST['message']);
$query="INSERT INTO messages(message_tittle,message_desc,message_status) VALUES('$title','$message',0)"; 
$result=mysqli_query($db,$query);
if(!$result){
die("Query Failed".mysqli_error($db));
}
}
