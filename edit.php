<?php
//set location for configuration file sing.cfg (ideally stored outside of public html)

session_start();
if(  (!isset($_SESSION['loggedin'])) || ($_SESSION['isadmin']!='1') ){
    header('Location: index.html');
    exit();
}
function whitelist($str){
    return preg_replace("/[^A-Za-z0-9 ]/", '', trim($str));
}

include('connection.php');?>

<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title>Exhibit Selection</title>
    <link href="main.css" rel="stylesheet" type="text/css">
    <script>
        function checkChange(){
            if(document.getElementById('isNew').checked){
                document.getElementById('originalExhibitDiv').hidden=true;
            }
            else{document.getElementById('originalExhibitDiv').hidden=false;}
        }
        function hideShowDeleter() {
            document.getElementById('deleteDiv').hidden=!document.getElementById('deleteDiv').hidden;
        }
    </script>
</head>
<body>

<?php include('navbar.php');?>

<div>
    <h2>Edit Page</h2>
    <p>Welcome to the edit page, <?=$_SESSION['name']?>.</p>
</div>

<div>

    <?php

    $exhibitName='';
    $areaName='';
    $areaID=0;
    $exhibitIsOpen=0;
    $pictureName='';
    $query="SELECT * FROM exhibits WHERE exhibitName='".$_POST['exhibitName']."'";
    if($_POST['isNewRecord']==1){echo("request was to add new record.  uncheck box to do otherwise.");}
    if($queryresult=mysqli_query($connection,$query)){
        print "<table>";
        print "<tr><th>-=Area=-</th><th>Exhibit</th><th>Open?</th><th>Picture</th></tr>";
        while($row=mysqli_fetch_array($queryresult)){
            $areaID=$row["areaID"];
            $areaquery='SELECT areaName FROM areas WHERE areaID='.$row["areaID"];
            $areaqueryresult=mysqli_query($connection,$areaquery);
            $arearow=mysqli_fetch_array($areaqueryresult);
            $areaName=$arearow['areaName'];
            $exhibit=$row['exhibitName'];
            $pictureName=$row['pictureurl'];
            $picture_url=("images/".$row['pictureurl']);
            $display_url='<img height="75px" width="75px" src='.$picture_url.'>';

            print "<tr ";
            if($row['isopen']==0) {$isopenstring="<em>CLOSED</em>";print("style='background:#ffffff'");$exhibitIsOpen=0;}
            else{$isopenstring="OPEN";$exhibitIsOpen=1;}
            print("><td>{$areaName}</td><td onClick='updateExhibit(\"{$row['exhibitName']}\")'>  {$row['exhibitName']}</td><td>{$isopenstring}</td><td>{$display_url}</td></tr>");
        }//while
        print "</table>";
    }
    else{echo "could not connect to database table";}
    ?>
</div>
<div>
    <h2>-=only alphanumeric characters. all others will be stripped=-</h2>
    <form class="forTheForm" action="reallyedit.php" method="post">
        <p>
            <label for="isNew">add as new entry</label>

            <input type="checkbox" onChange="checkChange();" name="isNew" id="isNew" <?php if($_POST['isNewRecord']==1) echo "checked='true'"; ?>>
        <div id="originalExhibitDiv" <?php if($_POST['isNewRecord']==1) echo "hidden='true'";?>>
            <label for="originalExhibit">Exhibit being edited:</label>
            <input type="text" name="originalExhibit" pattern="[a-zA-Z0-9 ]{0,60}" id="originalExhibit" value="<?php echo whitelist($_POST['exhibitName'])?>">

        </div>
        <hr>
        <label for="exhibitName">Exhibit:</label>
        <input type="text" name="exhibitName" id="exhibitName" pattern="[a-zA-Z0-9 ]{1,60}" value="<?php echo $_POST['exhibitName']; ?>">
        </p>
        <p>

            <?php
            $africaSelected="unchecked";
            $asiaSelected="unchecked";
            $europeSelected="unchecked";
            $northAmericaSelected="unchecked";
            $southAmericaSelected="unchecked";
            $australiaSelected="unchecked";
            switch($areaID) {
                case 1:
                    $africaSelected = "checked";
                    break;
                case 2:
                    $asiaSelected = "checked";
                    break;
                case 3:
                    $europeSelected = "checked";
                    break;
                case 4:
                    $northAmericaSelected = "checked";
                    break;
                case 5:
                    $southAmericaSelected = "checked";
                    break;
                case 6:
                    $australiaSelected = "checked";
                    break;

            }
            ?>
            <label for="areaName"><h2>Area Name:</h2></label>
            <label for="areaID">Africa:</label>
            <input type="radio" name="areaID" id="areaID" value="1" <?php print($africaSelected);?>>&nbsp&nbsp
            <label for="areaID">Asia:</label>
            <input type="radio" name="areaID" id="areaID" value="2" <?php print($asiaSelected);?>>&nbsp&nbsp
            <label for="areaID">Europe:</label>
            <input type="radio" name="areaID" id="areaID" value="3" <?php print($europeSelected);?>>&nbsp&nbsp
            <br>
            <label for="areaID">North America:</label>
            <input type="radio" name="areaID" id="areaID" value="4" <?php print($northAmericaSelected);?>>&nbsp&nbsp
            <label for="areaID">South America:</label>
            <input type="radio" name="areaID" id="areaID" value="5" <?php print($southAmericaSelected);?>>&nbsp&nbsp
            <label for="areaID">Australia:</label>
            <input type="radio" name="areaID" id="areaID" value="6" <?php print($australiaSelected);?>>&nbsp&nbsp

            <br>
            <label for="exhibitIsOpen"><h2>Status:</h2></label>
            <label for="exhibitIsOpen">Open:</label>
            <?php $openSelected=$exhibitIsOpen? "checked":"unchecked";$closedSelected=$exhibitIsOpen?"unchecked":"checked";?>
            <input type="radio" name="exhibitIsOpen" id="exhibitIsOpen" value="1" <?php print($openSelected);?>>
            <label for="exhibitIsOpen">Closed:</label>
            <input type="radio" name="exhibitIsOpen" id="exhibitIsOpen" value="0" <?php print($closedSelected);?>>
            <br>
            <label for="pictureName"><h2>Picture:</h2></label>
            <label for="pictureName">picture name on server:</label>
            <input type="text" name="pictureName" id="pictureName" pattern="[a-zA-Z0-9. ]{0,60}" value="<?php echo $pictureName ?>">
        </p>
        <p>
            <input type="submit" value="update record">
        </p>
    </form>
    <hr>
    <input type="button" onClick="hideShowDeleter();" value="show deleter">
    <div hidden id="deleteDiv">
        <form class="forTheForm" id="deleteForm" action="deleter.php" method="post">
            <label for="delExhibit">Exhibit being deleted:</label>
            <input type="text" name="delExhibit" id="delExhibit" value="<?php echo $_POST['exhibitName']?>">
            <input type="submit" value="DELETE (no prompt)">
        </form>
    </div>

</div>
</body>
</html>