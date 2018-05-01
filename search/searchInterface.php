<?php
/**
 * Created by PhpStorm.
 * User: chenran
 * Date: 4/27/18
 * Time: 10:09 PM
 */
interface searchEngine{
    public function searchByQuery($query);
    public function generateSearchResult($query, $dbc, $potentialTag);
    //public function checkTag($postId, $potentialTag, $dbc);
}
class SearchEngineForCook implements  searchEngine{

    public function searchByQuery($query)
    {
        $common_words = array("what", "where","are","is", "who", "and", "or", "any", "some", "similar", "to", "at", "a");
        $words = preg_split('/\s+/', $query, -1, PREG_SPLIT_NO_EMPTY);
        $size = count($words);
        $queryList = array();
        for($x = 0; $x < $size; $x++) {
            if (in_array($words[$x], $common_words)) {

            } else {
                array_push($queryList,$words[$x]);
            }
        }
        return $queryList;
    }

    public function generateSearchResult($query,$dbc,$potentialTag)
    {
        $sql = "select * from posts where ".$query." order by votes desc";
        $result = @mysqli_query($dbc, $sql);
        if(!$result) {
            echo "error in search query";
            $postErr =  "<h1>" . mysqli_error($dbc) . "</h1>";
            echo $postErr;
            exit();
        }
        $res = array();
        if (mysqli_num_rows($result) >= 1) {
            while($row = mysqli_fetch_assoc($result)) {
                $cur = array();
                $cur['title']=$row["title"];
                $cur['postDate'] = $row["postDate"];
                $cur['content'] = $row["content"];
                $cur['postId'] = $row['postId'];
                if($this->checkTag($row['postId'], $potentialTag, $dbc)) {
                    array_unshift($res, $cur);
                } else {
                    $res[]=$cur;
                }
            }
        }
        return $res;
    }

    public function checkTag($postId, $potentialTag, $dbc) {
        $sql = "select * from tags where postId = '$postId'";
        $result = @mysqli_query($dbc, $sql);
        if(!$result) {
            echo "error in search query tags";
            $postErr =  "<h1>" . mysqli_error($dbc) . "</h1>";
            echo $postErr;
            exit();
        }
        if (mysqli_num_rows($result) >= 1) {
            while($row = mysqli_fetch_assoc($result)) {
                $tag = $row["tag"];
                if(in_array($tag, $potentialTag)) {
                    return true;
                }
            }
        }
        return false;
    }
}