<?php
//set location for configuration file sing.cfg (ideally stored outside of public html)
session_start();

$connection=mysqli_connect('localhost','root','','zoo');

function redirect(){
    $URL = "index.php";
    echo "<script type='text/javascript'>" .
        "alert('incorrect password or username.');" .
        "document.location.href='{$URL}';</script>" .
        "META HTTP-EQUIV='refresh' content'1';URL='{$URL}'>";
}


if(mysqli_connect_errno()){
    die('Failed to connect to MySQL: '. mysqli_connect_error());
}
if(!isset($_POST['username'],$_POST['password'])){
    die('Please fill out the fields before submitting');
}
if($stmt=$connection->prepare('SELECT username,password,isadmin,allAreas,ticketExpiration,userID FROM users WHERE username=?')){
    $stmt->bind_param('s',$_POST['username']);
    $stmt->execute();
    $stmt->store_result();
}

if($stmt->num_rows>0){
    $stmt->bind_result($id,$password,$isadmin,$allAreas,$ticketExpiration,$userID);
    $stmt->fetch();
    if (password_verify($_POST['password'],$password)){
        //success
        session_regenerate_id();
        $_SESSION['loggedin']=TRUE;
        $_SESSION['name']=$_POST['username'];
        $_SESSION['id']=$id;
        $_SESSION['isadmin']=$isadmin;
        $_SESSION['allAreas']=$allAreas;
        $_SESSION['ticketExpiration']=$ticketExpiration;
        $_SESSION['userID']=$userID;
        header('Location: home.php');
    }
    else{
        //code here is executed if the password does not match
        redirect();
    }

} else{
    //code here is executed if no username is found in users table
    print("NAME: ".$_SESSION['name']." PASSWORD: ".$_POST['password']);
 //   redirect();
}
$stmt->close();
