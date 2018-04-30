<?php
session_start();
?>

<?php
//    include('searchPage.php');
include ('header.php');
?>
<br>

<main role="main" class="container">
    <div class="jumbotron">
        <h1>Welcome to everyday cooking</h1>
        <p class="lead">The cookbook for your favorite food, you can select the category to view the popular food.</p>
        <p class="lead">Register to follow your favorite author and share your recipe.</p>
        <a class="btn btn-lg btn-primary" href="/SignInUpOut/signUp.html" role="button">Register here &raquo;</a>
        <a class="btn btn-lg btn-primary" href="/search/searchPage.php" role="button">Search here &raquo;</a>
    </div>
</main>

<div class="centerdiv col-sm-4">

    <h3>The most popular post:</h3>
    <?php
    require_once('script/db/db_connect.php');
    $sql = "select * from posts order by votes";
    $result = @mysqli_query($dbc, $sql);
    if(isset($_SESSION['login_user'])) {
        $postUser = $_SESSION['login_user'];
        if (mysqli_num_rows($result) >= 1) {
            while($row = mysqli_fetch_assoc($result)) {
                //            echo "<p><a class=\"btn btn-secondary\" href=\"tagContent.php?tag=".$row["tag"]."\" role=\"button\">".$row["tag"]."</a></p>";
                echo "<li class=\"list-group-item\">
        <h3>".$row["title"]."</h3>
        <p>".$row["postDate"]."</p>
        <p>".$row["content"]."</p>";
                $vote = $row["votes"];
                echo "<button id=\"btnfun\" name=\"btnfun\" onClick='location.href=\"?button".$row["postId"]."=1\"'>Vote</button>";
                if($_GET['button'.$row["postId"]]) {
                    $vote = $vote + 1;
                    $sql2 = "update posts set votes = .".$vote . " where postId = " . $row["postId"];
                    $result2 = @mysqli_query($dbc, $sql2);
                }
                $sql3 = "select * from follow where userId1 = ".$postUser." and userId2 = ".$row["userId"];
                $result3 =  @mysqli_query($dbc, $sql3);
                if(mysqli_num_rows($result3) == 0) {
                    echo "<button id=\"btnfun2\" name=\"btnfun2\" onClick='location.href=\"?button_follow".$row["userId"]."=1\"'>Follow the Author</button>";
                    if($_GET['button_follow'.$row["userId"]]) {
                        $sql4 = "insert into follow (userId1, userId2) values (".$postUser.",".$row["userId"].")";
                        $result2 = @mysqli_query($dbc, $sql);
                    }
                }
                echo "<a href=\"/profile/otherUserProfile.php?userId=".$row["postId"]."\">View the author profile</a>";
                echo "<p><a href=\"/profile/addTag.php?\postId=".$row["postId"]."\">Add to favorite</a></p>";
                echo "</li>";
            }
        } else {
            echo "<li class=\"list-group-item\">
                    <p>Nothing inside</p>
                    </li>";
        }
    } else {
        if (mysqli_num_rows($result) >= 1) {
            while($row = mysqli_fetch_assoc($result)) {
                echo "<li class=\"list-group-item\">
                        <h3>".$row["title"]."</h3>
                        <p>".$row["postDate"]."</p>
                        <p>".$row["content"]."</p>";
                echo "</li>";
            }
        } else {
            echo "<div align='center'><ul><li class=\"list-group-item\">
                    <p>Nothing inside</p>
                    </li></ul></div>";
        }
    }

    mysqli_close($dbc);
    ?>
</div>



</body>
</html>