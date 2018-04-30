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
    <?php
    if($_SERVER["REQUEST_METHOD"] == "GET") {
        require('../script/db/db_connect.php');
        $postUser = $_SESSION['login_user'];
        $folderName = "";
        if(isset($_GET["folderName"])) {
            echo "get folderName";
            $folderName = $_GET["folderName"];
        } else {
            echo "Do not get folderName";
        }
        $sql = "select * from posts right join (select DISTINCT * from favorite where userId ='$postUser' and folderName ='$folderName') as favPosts on posts.postId = favPosts.postId";
        $result = @mysqli_query($dbc, $sql);
        if(!$result) {
            echo "error in retrieve the favriate message";
            $postErr =  "<h1>" . mysqli_error($dbc) . "</h1>";
            echo $postErr;
            exit();
        }
        if (mysqli_num_rows($result) >= 1) {
            while ($row = mysqli_fetch_assoc($result)) {
//            echo "<p><a class=\"btn btn-secondary\" href=\"tagContent.php?tag=".$row["tag"]."\" role=\"button\">".$row["tag"]."</a></p>";
                echo "<li class=\"list-group-item\">
                       <h3>" . $row["title"] . "</h3>
                       <p>" . $row["postDate"] . "</p>
                       <p>" . $row["content"] . "</p>
                </li>";
            }
        } else {
            echo "<p>Nothing inside</p>";
        }
        mysqli_close($dbc);
    }
    ?>
</ul>