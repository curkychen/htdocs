<?php
session_start();

/**
 * Created by PhpStorm.
 * User: chenran
 * Date: 4/27/18
 * Time: 11:45 AM
 */

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    if ($_POST['addpost'] == "true") {

        $post_title = "";
        $post_category = "";
        $postErr = "";
        $post_content = "";
        $post_tag = "";
        $category_error = "";
        $content_error = "";
        $tag_error = "";
        $title_error = "";

        if (empty($_POST['title'])) {
            $title_error = "Title is required";
        } else {
            $post_title = $_POST['title'];
        }

        if (empty($_POST['category'])) {
            $category_error = "category is required, choose one";
        } else {
            $post_category = $_POST['category'];
        }
        if (empty($_POST['content'])) {
            $content_error = "Receipt is required, please enter";
        } else {
            $post_content = $_POST['content'];
        }
        if (empty($_POST['tag'])) {
            $tag_error = "Tag is required, please enter";
        } else {
            $post_tag = $_POST['tag'];
        }
        $post_user = $_SESSION['login_user'];
//        $post_votenum = 0;

        if (empty($title_error) && empty($category_error) && empty($content_error)&& empty($tag_error) && !empty($post_user)) {
            require('../script/db/db_connect.php');
//            $post_user = $_SESSION['login_user'];
            $date = date("Y-m-d h:i:sa");
            //$post_id = $date . $post_user;
            $post_id = uniqid();
            $sql = "INSERT INTO posts (postId, postDate, title, content, tag, category, Votes, userId) 
                VALUES ('$post_id','$date', '$post_title', '$post_content', '$post_tag','$post_category',0, '$post_user')";
            $result = @mysqli_query($dbc, $sql);
            if(!$result) {
                echo "Do not post into posts correctly";
                $postErr =  "<h1>" . mysqli_error($dbc) . "</h1>";
                exit();
            }
            //tag does not really mean favorite
            $sql2 = "INSERT INTO tags (postId, tag) 
                VALUES ('$post_id','$post_tag')";
            $result2 = @mysqli_query($dbc, $sql2);
            if(!$result2) {
                echo "Do not post into tags correctly";
                $postErr =  "<h1>" . mysqli_error($dbc) . "</h1>";
                exit();
            }
            $sql3 = "insert into user_posts (postId, userId) values ('$post_id','$post_user')";
            $result3 = @mysqli_query($dbc, $sql3);
            if(!$result3) {
                echo "Do not post into user_posts correctly";
                $postErr =  "<h1>" . mysqli_error($dbc) . "</h1>";
                exit();
            }
            $page = 'profile.php';
            $url = 'http://' . $_SERVER['HTTP_HOST'] . dirname($_SERVER['PHP_SELF']);
            $url = rtrim($url, '/\\');
            $url .= '/' . $page;
            header("Location: $url");
            exit();
        } else {
            echo "Input error";
        }
    }

}
