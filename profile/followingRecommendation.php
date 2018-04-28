<?php
/**
 * Created by PhpStorm.
 * User: chenran
 * Date: 4/28/18
 * Time: 4:57 PM
 */
session_start();

require_once('../script/db/db_connect.php');
$postUser = $_SESSION['login_user'];
//            $tag=$_GET["tag"];
$sql = "select * from posts right join (select follow.userId2 from follow where userId1 = ".$postUser .") on posts.userId = follow.userId2 order by posts.votes";
$result = @mysqli_query($dbc, $sql);
if (mysqli_num_rows($result) >= 1) {
    while($row = mysqli_fetch_assoc($result)) {
//            echo "<p><a class=\"btn btn-secondary\" href=\"tagContent.php?tag=".$row["tag"]."\" role=\"button\">".$row["tag"]."</a></p>";
        echo "<li class=\"list-group-item\">
                       <h3>".$row["title"]."</h3>
                       <p>".$row["postDate"]."</p>
                       <p>".$row["Content"]."</p>
                </li>";
        $vote = $row["votes"];
        echo "<button id=\"btnfun\" name=\"btnfun\" onClick='location.href=\"?button".$row["postId"]."=1\"'>Vote</button>";
        if($_GET['button'.$row["postId"]]){
            $vote = $vote + 1;
            $sql2 = "update posts set votes = ".$vote." where postId = ".$row[postId];
            $result2 = @mysqli_query($dbc, $sql);
        }
        echo "<div class=\"overlay\"></div>
<div class=\"wrapper\">
    <button type=\"button\" class=\"show-form\">Login</button>
    
    <form class=\"form-login\">
        <div class=\"header\">
            <h3>Enter Your Username And Password</h3>
        </div>
        <div class=\"content\">
            <div class=\"group\">
                <label>Username</label>
                <input type=\"text\" class=\"username\" placeholder=\"Username\">
            </div>
            <span class=\"error error-username\">Please Type Username!</span>
            <div class=\"group\">
                <label>Password</label>
                <input type=\"password\" class=\"password\" placeholder=\"Password\">
            </div>
            <span class=\"error error-password\">Please Type Password!</span>
            <div class=\"group-show-password\">
                <input type=\"checkbox\" class=\"toggle-password\" id=\"toggle-password\">
                <label for=\"toggle-password\">Show Password</label>
            </div>
        </div>
        <div class=\"welcome\"></div>
        <div class=\"footer\">
            <div class=\"buttons\">
                <button type=\"button\" class=\"btn-login\">Login</button>
                <button type=\"button\" class=\"btn-cancel\">Cancel</button>
            </div>
        </div>
    </form>
</div>";
                    }
} else {
    echo "<p>Nothing inside</p>";
}
mysqli_close($dbc);