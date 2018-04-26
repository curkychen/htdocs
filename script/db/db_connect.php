<?php
/**
 * Created by PhpStorm.
 * User: chenran
 * Date: 4/16/18
 * Time: 4:36 PM
 */

DEFINE('DB_USER', 'enterprise_db');
DEFINE('DB_PASSWORD', 'enterprise');
DEFINE('DB_HOST', 'localhost');
DEFINE('DB_NAME', 'enterprise_db');


$dbc = @mysqli_connect(DB_HOST, DB_USER, DB_PASSWORD, DB_NAME);
if (!$dbc) {
    echo "Error: Unable to connect to MySQL." . PHP_EOL;
    echo "Debugging errno: " . mysqli_connect_errno() . PHP_EOL;
    echo "Debugging error: " . mysqli_connect_error() . PHP_EOL;
    exit;
}
echo "Success: A proper connection to MySQL was made! The my_db database is great." . PHP_EOL;
echo "Host information: " . mysqli_get_host_info($dbc) . PHP_EOL;
