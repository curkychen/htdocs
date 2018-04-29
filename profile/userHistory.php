<?php
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
    <?
    require_once('../script/db/db_connect.php');
    $postuser = $_SESSION['login_user'];
    $tag=$_GET["tag"];
    $sql = "select * from posts right join (select * from userPosts where userId = ".$postuser.") on posts.userId = userPosts.postId";
    $result = @mysqli_query($dbc, $sql);
    if (mysqli_num_rows($result) >= 1) {
        while($row = mysqli_fetch_assoc($result)) {
//            echo "<p><a class=\"btn btn-secondary\" href=\"tagContent.php?tag=".$row["tag"]."\" role=\"button\">".$row["tag"]."</a></p>";
            echo "<li class=\"list-group-item\">Cras justo odio
                       <h3>".$row["title"]."</h3>
                       <p>".$row["postDate"]."</p>
                       <p>".$row["Content"]."</p>
                </li>";
        }
    } else {
        echo "<p>Nothing inside</p>";
    }
    mysqli_close($dbc);
    ?>
</ul>