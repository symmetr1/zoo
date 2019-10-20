<nav>
        <div>
            <h1>-=Brevard Zoo Information System=-</h1>
            <a href="home.php">display exhibits by area</a>&nbsp&nbsp
            <a href="profile.php">profile</a>&nbsp&nbsp
            <?php
                if($_SESSION['isadmin']==1){
                    print("<a href='select.php'>edit areas/exhibits</a>&nbsp&nbsp");}
                if($_SESSION['isadmin']==0){
                    print("<a href='ticket.php'>ticket purchase/upgrade</a>&nbsp&nbsp");
            }
            ?>

            <a href="logout.php">logout</a>
        </div>
</nav>