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
$query='SELECT * FROM songtable';
if($queryresult=mysqli_query($connection,$query)){
    print "<table>";
    print "<tr><th>-=Title=-</th><th>Artist</th><th>Key</th><th>Chord 1</th><th>URL</th><th>Notes</th></tr>";
    while($row=mysqli_fetch_array($queryresult)){
 //dont think below line is necessary?
        $song_title=$row['title'];
        $fileName=("songs/".preg_replace('!\s+!', '-',trim($song_title)).'.txt');
        if($row['url']){
            $song_url=$row['url'];
            $display_url='user stored URL';
        }
        else{
            if(file_exists($fileName)){
                $song_url=$fileName;
                $display_url='<img height="10px" src="images/star.png">Text File';
            }
            else{
                $song_url='https://www.google.com/search?q=chords'.'+'.$song_title.'+'.$row['artist'];
                $display_url='search google for chords';
            }
        }
        print "<tr><td>{$row['title']}</td><td> {$row['artist']}</td><td>{$row['songKey']}</td><td>{$row['firstChord']}</td><td><a href='{$song_url}'>{$display_url}</a></td><td>{$row['notes']}</td></tr>";
    }//while
    print "</table>";
}
else{echo "could not connect to database table";}
?>
</div>
</body>
</html>