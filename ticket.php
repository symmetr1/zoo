<?php
session_start();
if(!isset($_SESSION['loggedin'])){
    header('Location index.html');
    exit();
}
include('connection.php');
?>
<!DOCTYPE html>
<html>
<head>

    <meta charset="utf-8">
    <title>ticket upgrade!</title>
    <link href="main.css" rel="stylesheet" type="text/css">

    <script>


    </script>



</head>
<body>
<?php include('navbar.php');?>
<div>
    <h2>Ticket Upgrade</h2>
</div>
<div>

</div>
<div>
    <?php
    if ($_SERVER['REQUEST_METHOD'] == 'POST'){
        $accountchange=0;
        if($_POST["command"]=="upgrade"){
            $query= "UPDATE users SET allAreas=1 WHERE userID='{$_SESSION["userID"]}'";
            mysqli_query($connection,$query);
            $accountchange=100.00;
        }
        elseif($_POST['command']=='extend'){
            echo("<em>".$_SESSION['ticketExpiration']."</em>");
            $query= "UPDATE users SET ticketExpiration=DATE_ADD(ticketExpiration,INTERVAL 1 YEAR)" .
                " WHERE userID='{$_SESSION["userID"]}'";
            $result=mysqli_query($connection,$query);
            if($_SESSION['allAreas']==1){
                $accountchange=300.00;
            }
            elseif($_SESSION['allAreas']==0){
                $accountchange=200.00;
            }
        }


        if($accountchange!=0){
            echo("<script>alert('your account has been debited ".$accountchange." dollars and transaction has been processed')</script>");

        }
        header("Refresh:0");





    }
//    else{echo("<hr>initial load</hr>");}






    ?>


    <?php
    echo("Your current ticket is a".(($_SESSION['allAreas']==1) ? "n All Areas Pass": " Limited Pass"));
    echo(" which expires on ".$_SESSION['ticketExpiration']);
    ?>
</div>

<form action="ticket.php" method="post">
<?php if(!$_SESSION['allAreas'])
    echo("<input type='radio' name='command' value='upgrade' checked> Upgrade ticket to All Areas");
?>
    <br>
    <input type="radio" name="command" value="extend" checked> Extend ticket by 1 year
    <br>

    <input type="submit" value="Process selected command">
</form>


</body>
</html>