<?php
session_start();
if(!isset($_SESSION['loggedin'])){
    header('Location index.html');
    exit();
}
include('connection.php');?>
<!DOCTYPE html>
<html>
<head>

    <meta charset="utf-8">
    <title>user profile</title>
    <link href="main.css" rel="stylesheet" type="text/css">
</head>
<body>
<?php include('navbar.php');?>
<div>
    <h2>User Profile</h2>
    <table>
        <tr><td>Username:</td><td><?=$_SESSION['name']?></td></tr>

        <tr><td>User Type:</td><td><?php if($_SESSION['isadmin']==1) echo('Administrator'); else echo('Valued Customer');?></td></tr>
        <?php if($_SESSION['isadmin']==0){
           print("<tr><td>Ticket Expiration: </td><td>" . $_SESSION['ticketExpiration'] . "</td></tr>");
           print("<tr><td>Ticket Level:</td><td>". ($_SESSION['allAreas'] ? "Superhero (all areas)":"Cheapo (some areas) <a href='ticket.php'> UPGRADE</a>    ")."</td></tr>");
        }//if
         ?>

    </table>


</div>


</body>
</html>

