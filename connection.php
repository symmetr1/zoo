<?php
$connection=mysqli_connect('localhost','root','','zoo');
if(mysqli_connect_errno()){
    die('Failed to connect to database: '.mysqli_connect_error());
}
$stmt=$connection->prepare('SELECT password,isadmin,ticketExpiration,allAreas FROM users WHERE username=?');
$stmt->bind_param('i',$_SESSION['name']);
$stmt->execute();
$stmt->bind_result($password,$isadmin,$ticketExpiration,$allAreas);
$stmt->fetch();
$stmt->close();
?>