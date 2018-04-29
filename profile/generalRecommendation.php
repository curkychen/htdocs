<?php
/**
 * Created by PhpStorm.
 * User: chenran
 * Date: 4/28/18
 * Time: 8:54 PM
 */
//session_start();
require_once('../script/db/db_connect.php');
$postUser = $_SESSION['login_user'];
//            $tag=$_GET["tag"];
//            $sql = "select * from posts right join (select follow.userId2 from follow where userId1 = ".$postUser .") on posts.userId = follow.userId2 order by posts.votes";
$sql = "select * from posts order by votes";
$result = @mysqli_query($dbc, $sql);
if (mysqli_num_rows($result) >= 1) {
    while($row = mysqli_fetch_assoc($result)) {
//            echo "<p><a class=\"btn btn-secondary\" href=\"tagContent.php?tag=".$row["tag"]."\" role=\"button\">".$row["tag"]."</a></p>";
        echo "<li class=\"list-group-item\">
                       <h3>".$row["title"]."</h3>
                       <p>".$row["postDate"]."</p>
                       <p>".$row["Content"]."</p>";
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
        echo "<a href=\"otherUserProfile.php?userId=".$row["postId"]."\">View the author profile</a>";
        echo "<p><a href=\"addTag.php?\postId=".$row["postId"].">Add to favorite</p>";
        echo "</li>";
    }
} else {
    echo "<p>Nothing inside</p>";
}
mysqli_close($dbc);