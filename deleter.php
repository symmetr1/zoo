<?php
//set location for configuration file sing.cfg (ideally stored outside of public html)

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
    <title>Home Page</title>
    <link href="main.css" rel="stylesheet" type="text/css"
</head>
<body>

<?php
function whitelist($str){
    return preg_replace("/[^A-Za-z0-9. ]/", '', trim($str));
}


//first sanitize the input so only alphanumeric
foreach($_POST as &$toClean){
    $toClean=whitelist($toClean);
}

//assemble the query
if(!isset($_POST['isNew'])) {
    $query = "DELETE FROM exhibits WHERE exhibitName='{$_POST['delExhibit']}'";
}

if($queryresult=mysqli_query($connection,$query)){
    if($queryresult==1)
        $URL="select.php";
    echo "<script type='text/javascript'>".
        "alert('attempting deletion and redirecting');".
        "document.location.href='{$URL}';</script>".
        '<META HTTP-EQUIV="refresh" content="1";URL=' . $URL . '">';
}

?>
</body>
</html>