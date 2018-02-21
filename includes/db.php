<?php ob_start();

/*$db['db_host'] = "localhost";
$db['db_user'] = "root";
$db['db_pass'] = "root";
$db['db_name'] = "cms";
$db['db_port'] = "8889";*/


//online settings
$url = parse_url(getenv("mysql://b2e6fde5c104d3:2ccf37cb@us-cdbr-iron-east-05.cleardb.net/heroku_881f91971a99a01?"));

$server = $url["host"];
$username = $url["user"];
$password = $url["pass"];
$db = substr($url["path"], 1);

$conn = new mysqli($server, $username, $password, $db);

foreach($db as $key => $value){
    define(strtoupper($key), $value);
}

    $connection = mysqli_connect(DB_HOST, DB_USER, DB_PASS, DB_NAME, DB_PORT);

    /* if($connection){
        echo "We are connected";
    }*/
?>