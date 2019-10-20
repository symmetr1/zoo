<?php

session_start();
if(  (!isset($_SESSION['loggedin'])) || ($_SESSION['isadmin']!=1) ){
    header('Location: index.html');
    exit();
}


include('connection.php');?>

<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title>Updating</title>
    <link href="main.css" rel="stylesheet" type="text/css"

</head>
<body>


<?php
function whitelist($str){
    return preg_replace("/[^A-Za-z0-9.-_ ]/", '', trim($str));
}


//first sanitize the input so only alphanumeric
foreach($_POST as &$toClean){
    $toClean=whitelist($toClean);
}

//assemble the query
if(!isset($_POST['isNew'])) {
    $query =
        "UPDATE exhibits SET exhibitName='" . $_POST['exhibitName'].
        "', areaID='" . $_POST['areaID'] .
        "', isopen='" . $_POST['exhibitIsOpen'] .
        "', pictureurl='" . $_POST['pictureName'] .
        "' WHERE exhibitName='" .
        $_POST['originalExhibit'] . "'";
}
else{
    $query="INSERT INTO exhibits(exhibitName,areaID,isopen,pictureurl)".
        "VALUES('{$_POST['exhibitName']}','{$_POST['areaID']}','{$_POST['exhibitIsOpen']}','{$_POST['pictureName']}')";
    echo "NEW ENTRY";

}
if($queryresult=mysqli_query($connection,$query)){
    if($queryresult==1) {

        $URL = "select.php";
        echo "<script type='text/javascript'>" .
            "alert('attempting update and redirecting to select page');" .
            "document.location.href='{$URL}';</script>" .
            "META HTTP-EQUIV='refresh' content'1';URL='{$URL}'>";
    }

}
else{
    echo "<hr>error processing request.<hr>".(isset($_POST['isNew'])? "cannot add new record" : "cannot modify record");
}
?>
</body>
</html>