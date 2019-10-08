<nav>
        <div>
            <h1>-=Brevard Zoo Information System=-</h1>
            <a href="home.php">display exhibits by area</a>
            <a href="profile.php">profile</a>
            <?php
                if($_SESSION['isadmin']==1){
                    print("<a href='edit.php'>edit areas/exhibits</a>");}
                if($_SESSION['isadmin']==0){
                    print("<a href='tickets.php'>ticket purchase/upgrade</a>");
            }
            ?>

            <a href="logout.php">logout</a>
        </div>
</nav>