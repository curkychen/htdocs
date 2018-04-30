<?php
/**
 * Created by PhpStorm.
 * User: chenran
 * Date: 4/28/18
 * Time: 7:34 PM
 */
session_start();
include "../header.php";
echo "enter the add tag";
require('../script/db/db_connect.php');
$postUser = $_SESSION['login_user'];
$postId = "";
if(!isset($postUser)) {
    echo "do not find user";
    exit();
}
if($_SERVER["REQUEST_METHOD"] == "GET") {
    if(isset($_GET['postId'])) {
        $postId = $_GET["postId"];
        $sql = "select * from posts where postId = '$postId'";
        $result = @mysqli_query($dbc, $sql);
        if(!$result) {
            echo "error in postId";
            echo '<h1>' . mysqli_error($dbc) . '</h1>';
            exit();
        }
        echo "<form action='addTag.php' method='post'>
      Please enter the tag you want to mark:<br>
      <input type=\"text\" name=\"tag\"><br>
      Please enter the folder name you want to save:<br>
      <input type=\"text\" name=\"folderName\">
      <input type=\"text\" name=\"postId\" value=\"".$postId."\" readonly hidden='hidden'>
      <input type=\"submit\" value=\"Submit\">
    </form>";
    }
}
if($_SERVER["REQUEST_METHOD"] == "POST") {
    $tag = "";
    $folderName = "";
    if(isset($_POST["tag"])) {
        $tag = $_POST["tag"];
    }
    if(isset($_POST["folderName"])) {
        $folderName = $_POST["folderName"];
    }
    $postId = $_POST["postId"];
    echo "<h>".$postId."       </h>";
    echo "<h>".$tag."      </h>";
    echo "<h>".$postUser."     </h>";
    echo "<h>".$folderName."     </h>";
    $postId = str_replace(' ', '', $postId);
//    $sql1 = "select * from tags WHERE postId = \"".$postId ."\"and tag=\"".$tag."\"";
//    $result1 = @mysqli_query($dbc, $sql1);
//    if(!$result1) {
//        echo "select tags error";
//        echo '<h1>' . mysqli_error($dbc) . '</h1>';
//        exit();
//    }
//    $sql_insert_folder = "insert into favorite (userId, postId, folderName) VALUES (".$postUser.",'$postId','$folderName')";
    $sql_insert_folder = "insert into favorite(userId,postId,folderName) VALUES ($postUser,'$postId','$folderName')";
    $result_insert_folder = @mysqli_query($dbc, $sql_insert_folder);
    if(!$result_insert_folder) {
        echo "error in insert folder";
        echo '<h1>' . mysqli_error($dbc) . '</h1>';
        exit();
    }
//    if (mysqli_num_rows($result1) == 0) {
        $sql_insert_tag = "insert into tags(postId,tag) VALUES ('$postId','$tag')";
//        $sql_insert_folder = "insert into favorite (userId, postId, folderName) VALUES (".$postUser.",".$postId.",".$folderName.")";
        $result_insert_tag = @mysqli_query($dbc, $sql_insert_tag);
        if(!$result_insert_tag) {
            echo "error in insert tags";
            echo '<h1>' . mysqli_error($dbc) . '</h1>';
            exit();
        }
//        $result_insert_folder = @mysqli_query($dbc, $sql_insert_folder);
//        if(!$result_insert_folder) {
//            echo '<h1>' . mysqli_error($dbc) . '</h1>';
//            exit();
//        }
        redirect();
//    }

}

function redirect(){
    $page = 'recommendation.php';
    $url = 'http://' . $_SERVER['HTTP_HOST'] . dirname($_SERVER['PHP_SELF']);
    $url = rtrim($url, '/\\');
    $url .= '/' . $page;
    header("Location: $url");
    exit();
}
mysqli_close($dbc);