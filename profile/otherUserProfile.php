<?php
/**
 * Created by PhpStorm.
 * User: chenran
 * Date: 4/28/18
 * Time: 4:16 PM
 */
session_start();
/**
 * Created by PhpStorm.
 * User: chenran
 * Date: 4/27/18
 * Time: 8:37 PM
 */

include "../header.php";
?>

<ul class="list-group">
    <?php
    require_once('../script/db/db_connect.php');
    $postUser = $_SESSION['login_user'];
    if($_SERVER["REQUEST_METHOD"] == "GET") {
        $userId = $_GET["userId"];
        echo "current user".$postUser;
        echo "view the user".$userId;
        $sql3 = "select * from follow where userId1 = ".$postUser." and userId2 = ".$userId;
        $result3 =  @mysqli_query($dbc, $sql3);
        if(mysqli_num_rows($result3) == 0) {
            echo "<button id=\"btnfun2\" name=\"btnfun2\" onClick='location.href=\"?button_follow".$userId."=1\"'>Follow the Author</button>";
            if($_GET['button_follow'.$userId]) {
                $sql4 = "insert into follow (userId1, userId2) values (".$postUser.",".$row[userId].")";
                $result2 = @mysqli_query($dbc, $sql4);
            }
        } else {
            echo "<button id=\"btnfun2\" name=\"btnfun2\" onClick='location.href=\"?button_unFollow".$userId."=1\"'>UnFollow the Author</button>";
            if($_GET['button_follow'.$userId]) {
                $sql5 = "delete from follow where userId1 = ".$postUser."and userId2 = ".$userId;
                $result5 = @mysqli_query($dbc, $sql5);
            }
        }
        $sql = "select * from posts WHERE userId = ".$userId;
        $result = @mysqli_query($dbc, $sql);
        if (mysqli_num_rows($result) >= 1) {
            while($row = mysqli_fetch_assoc($result)) {
//            echo "<p><a class=\"btn btn-secondary\" href=\"tagContent.php?tag=".$row["tag"]."\" role=\"button\">".$row["tag"]."</a></p>";
                echo "<li class=\"list-group-item\">
                       <h3>".$row["title"]."</h3>
                       <p>".$row["postDate"]."</p>
                       <p>".$row["content"]."</p>
                </li>";
            }
        } else {
            echo "<p>Nothing inside</p>";
        }
    }
    mysqli_close($dbc);
    ?>
</ul>