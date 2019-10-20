<?php
//set location for configuration file sing.cfg (ideally stored outside of public html)

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
        <title>Home Page</title>
        <link href="main.css" rel="stylesheet" type="text/css"

    </head>
<body>

<?php include('navbar.php');?>

    <div>
        <h2>Exhibits by Area</h2>
        <p>Welcome back, <?=$_SESSION['name']?></p>
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
            print("><td>{$areaName}</td><td> {$row['exhibitName']}</td><td>{$isopenstring}</td><td>{$display_url}</td></tr>");
    }//while
    print "</table>";
}
else{echo "could not connect to database table";}
?>
</div>
</body>
</html>