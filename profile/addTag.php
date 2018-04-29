<?php
/**
 * Created by PhpStorm.
 * User: chenran
 * Date: 4/28/18
 * Time: 7:34 PM
 */
session_start();
require_once('../script/db/db_connect.php');
$postUser = $_SESSION['login_user'];
$postId = "";
if(isset($_GET['postId'])) {
    $postId = $_GET["postId"];
    $sql = "select * from posts where postId = ".$postId;
    $result = @mysqli_query($dbc, $sql);
    echo "<form action='addTag.php'>
      Please enter the tag you want to mark:<br>
      <input type=\"text\" name=\"tag\"><br>
      Please enter the folder name you want to save:<br>
      <input type=\"text\" name=\"folderName\">
      <input type=\"submit\" value=\"Submit\">
    </form>";
}
if($_SERVER["REQUEST_METHOD"] == "POST") {
    $tag = "";
    if(isset($_POST["tag"])) {
        $tag = $_POST["tag"];
    }
    if(isset($_POST["folderName"])) {
        $folderName = $_POST["folderName"];
    }
    $sql1 = "select * from tags WHERE postId = ".$postId ."and tag=".$tag;
    $result1 = @mysqli_query($dbc, $sql1);
    if (mysqli_num_rows($result1) == 0) {
        $sql_insert_tag = "insert into tags (postId, tag) VALUES (".$postId.",".$tag.")";
        $sql_insert_folder = "insert into favorite (userId, postId, folderName) VALUES (".$postUser.",".$postId.",".$folderName.")";
        $result_insert_tag = @mysqli_query($dbc, $sql_insert_tag);
        if(!$result_insert_tag) {
            echo '<h1>' . mysqli_error($dbc) . '</h1>';
        }
        $result_insert_folder = @mysqli_query($dbc, $sql_insert_folder);
        if(!$result_insert_folder) {
            echo '<h1>' . mysqli_error($dbc) . '</h1>';
        }
        $page = 'recommendation.php';
        $url = 'http://' . $_SERVER['HTTP_HOST'] . dirname($_SERVER['PHP_SELF']);
        $url = rtrim($url, '/\\');
        $url .= '/' . $page;
        header("Location: $url");
        exit();
    }

}
mysqli_close($dbc);