<?php
/**
 * Created by PhpStorm.
 * User: chenran
 * Date: 4/27/18
 * Time: 10:09 PM
 */
interface searchEngine{
    public function searchByQuery($query);
}
class SearchEngineForCook implements  searchEngine{

    public function searchByQuery($query)
    {
        $common_words = array("what", "is", "who", "and", "or", "any", "some", "similar", "to", "at", "a");
        $words = preg_split('/\s+/', $query, -1, PREG_SPLIT_NO_EMPTY);
        $wordslength = count($words);
        $uncommon_words = array();
        for($x = 0; $x < $wordslength; $x++) {
            if (in_array($words[$x], $common_words)) {

            } else {
                array_push($uncommon_words,$words[$x]);
            }
        }
        return $uncommon_words;
    }
}