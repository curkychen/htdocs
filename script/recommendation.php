<?php
/**
 * Created by PhpStorm.
 * User: chenran
 * Date: 4/30/18
 * Time: 1:11 AM
 */
require('../script/db/db_connect.php');
$clearTable = "TRUNCATE TABLE Recommendation";
$clearTable_res = @mysqli_query($dbc, $clearTable);
if(!$clearTable_res) {
    echo "<h>error when clearing table</h>";
    $postErr =  "<h1>" . mysqli_error($dbc) . "</h1>";
    echo $postErr;
    exit();
}

$sql_user = "select DISTINCT * from users";
$result = @mysqli_query($dbc, $sql_user);
if(!$result) {
    echo "<h>error when selecting users</h>";
    $postErr =  "<h1>" . mysqli_error($dbc) . "</h1>";
    echo $postErr;
    exit();
}
//for every user, get the content list
if (mysqli_num_rows($result) >= 1) {
    while($row = mysqli_fetch_assoc($result)) {
        $userId = $row["userId"];
        //get the favorite content list
        $sql_user_content = "select DISTINCT * from favorite where userId = ".$row["userId"];
        $result_content = @mysqli_query($dbc, $sql_user_content);
        if(!$result_content) {
            echo "<h>error when getting the content list</h>";
            $postErr =  "<h1>" . mysqli_error($dbc) . "</h1>";
            echo $postErr;
            exit();
        }
        if (mysqli_num_rows($result_content) >= 1) {
            while($content = mysqli_fetch_assoc($result_content)) {
                $postId = $content["postId"];
                $postTag = $content["folderName"];
//                $follow = "select * from (select * from follow where userId1 = $userId) as following left JOIN posts on posts.userId = following.userId2";
                $follow2 = "select DISTINCT * from (select * from follow where userId1 = $userId) as following 
                            left join favorite on following.userId2= favorite.userId and favorite.folderName = '$postTag'
                            left join posts on favorite.userId = posts.userId order by votes";
                $recommend = @mysqli_query($dbc, $follow2);
                if(!$recommend) {
                    echo "<h>error when getting the recommend post</h>";
                    $postErr =  "<h1>" . mysqli_error($dbc) . "</h1>";
                    echo $postErr;
                    exit();
                }
                if (mysqli_num_rows($recommend) >= 1) {
                    while($recommend_post = mysqli_fetch_assoc($recommend)) {
                        if(empty($recommend_post["postId"])) {
                            continue;
                        }
                        $recommend_postId = $recommend_post["postId"];
                        $recommend_post_votes = $recommend_post["votes"];
                        $checker = "select * from Recommendation where userId = $userId and postId = '$recommend_postId'";
                        $result_checker = @mysqli_query($dbc, $checker);
                        if(mysqli_num_rows($result_checker) >= 1) {
                            continue;
                        }
//                        $insert_sql = "insert into Recommendation(userId, postId, votes) values ($userId,'$recommend_postId',$recommend_post_votes)";
                        $insert_sql = "insert into Recommendation(userId, postId, votes) 
                                        values ($userId,'$recommend_postId',$recommend_post_votes)";
                        $result_insert = @mysqli_query($dbc, $insert_sql);
                        if(!$result_insert) {
                            echo "<h>error when generating the recommendation list</h>";
                            $postErr =  "<h1>" . mysqli_error($dbc) . "</h1>";
                            echo $postErr;
                            exit();
                        }
                    }
                }
            }
        }
    }
}