<?php
/**
 * Created by PhpStorm.
 * User: chenran
 * Date: 4/29/18
 * Time: 1:33 AM
 */
session_start();
include ("../header.php");
require_once('../script/db/db_connect.php');
$postUser = $_SESSION['login_user'];
//            $tag=$_GET["tag"];
//            $sql = "select * from posts right join (select follow.userId2 from follow where userId1 = ".$postUser .") on posts.userId = follow.userId2 order by posts.votes";
$sql = "select * from posts where category = \"breakfast\" order by votes";
$result = @mysqli_query($dbc, $sql);
if (mysqli_num_rows($result) >= 1) {
    while($row = mysqli_fetch_assoc($result)) {
//            echo "<p><a class=\"btn btn-secondary\" href=\"tagContent.php?tag=".$row["tag"]."\" role=\"button\">".$row["tag"]."</a></p>";
        echo "<li class=\"list-group-item\">
                       <h3>".$row["title"]."</h3>
                       <p>".$row["postDate"]."</p>
                       <p>".$row["content"]."</p>";
        $vote = $row["votes"];
        echo "<p><a href=\"/profile/otherUserProfile.php?userId=".$row["userId"]."\">View the author profile</a></p>";
        echo "<p><a href=\"/profile/addTag.php?postId=".$row["postId"]."\">Add to favorite</a></p>";
        echo "</li>";
    }
} else {
    echo "<p>Nothing inside</p>";
}
mysqli_close($dbc);