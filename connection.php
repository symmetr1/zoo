<?php
$connection=mysqli_connect('localhost','root','','zoo');
if(mysqli_connect_errno()){
    die('Failed to connect to database: '.mysqli_connect_error());
}
$stmt=$connection->prepare('SELECT password,isadmin,allAreas,ticketExpiration FROM users WHERE username=?');
$stmt->bind_param('s',$_SESSION['name']);
$stmt->execute();
$stmt->store_result();
$stmt->bind_result($password,$isadmin,$allAreas,$ticketExpiration);
$stmt->fetch();
$_SESSION['isadmin']=$isadmin;
$_SESSION['allAreas']=$allAreas;
$_SESSION['ticketExpiration']=$ticketExpiration;

$stmt->close();









?>