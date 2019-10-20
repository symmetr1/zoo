<?php
//set location for configuration file sing.cfg (ideally stored outside of public html)

session_start();
if((!isset($_SESSION['loggedin']))||($_SESSION['isadmin']!=1)){
    header('Location index.html');
    exit();
}


include('connection.php');?>




<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title>Select an Exhibit to Edit</title>
    <link href="main.css" rel="stylesheet" type="text/css">
    <script>
        function updateExhibit(exhibitName){
            document.getElementById('exhibitName').value=exhibitName;
            document.getElementById("isNewRecord").value=0;
            <?php if($_SESSION['isadmin']==1){
            echo "document.getElementById('exhibitNameForm').submit()";}?>
        }
    </script>


</head>
<body>

<?php include('navbar.php');?>

<form>



</form>



<div>
    <h2>Exhibits Editing Page</h2>

    <p>Welcome back, <?=$_SESSION['name']?></p>
    <h3>click on an exhibit name in table to edit, or enter new exhibit name and press CREATE</h3>
    <form id = "exhibitNameForm" name = "exhibitNameForm" action = "edit.php" method = "post">
        <label for="exhibitName" > New Exhibit: (only alphanumeric and spaces):</label>
        <input type = "text" name = "exhibitName" id = "exhibitName" placeholder = "new exhibit name" pattern="[a-zA-Z0-9 ]{0,60}" >
        <input type= "hidden" id="isNewRecord" name="isNewRecord" value="1"/>
        <input type = "submit" value="CREATE">
        </form >


</div>

<div>
    <?php
    $query='SELECT * FROM exhibits ORDER BY areaID';
    if($queryresult=mysqli_query($connection,$query)){
        print "<table>";
        print "<tr><th>-=Area=-</th><th>Exhibit</th><th>Open?</th><th>Picture</th></tr>";
        while($row=mysqli_fetch_array($queryresult)){
            $areaquery='SELECT areaName FROM areas WHERE areaID='.$row["areaID"];
            $areaqueryresult=mysqli_query($connection,$areaquery);
            $arearow=mysqli_fetch_array($areaqueryresult);
            $areaName=$arearow['areaName'];


            $exhibit=$row['exhibitName'];
            $picture_url=("images/".$row['pictureurl']);
            $display_url='<img height="75px" width="75px" src='.$picture_url.'>';


            print "<tr ";
            if($row['isopen']==0) {$isopenstring="<em>CLOSED</em>";print("style='background:#ffffff'");}
            else{$isopenstring="OPEN";}
            print("><td>{$areaName}</td><td onClick='updateExhibit(\"{$row['exhibitName']}\")'>  {$row['exhibitName']}</td><td>{$isopenstring}</td><td>{$display_url}</td></tr>");
        }//while
        print "</table>";
    }
    else{echo "could not connect to database table";}
    ?>
</div>
</body>
</