<?php ob_start();

/*$db['db_host'] = "localhost";
$db['db_user'] = "root";
$db['db_pass'] = "root";
$db['db_name'] = "cms";
$db['db_port'] = "8889";*/


$db['db_host'] = "us-cdbr-iron-east-05.cleardb.net";
$db['db_user'] = "b2e6fde5c104d3";
$db['db_pass'] = "2ccf37cb";
$db['db_name'] = "heroku_881f91971a99a01";

//online settings
//$url = parse_url(getenv("mysql://b2e6fde5c104d3:2ccf37cb@us-cdbr-iron-east-05.cleardb.net/heroku_881f91971a99a01?reconnect=true"));
//
//$server = $url["host"];
//$username = $url["user"];
//$password = $url["pass"];
//$db = substr($url["path"], 1);
//
//$conn = new mysqli($server, $username, $password, $db);
//
foreach($db as $key => $value){
   define(strtoupper($key), $value);
}

   $connection = mysqli_connect(DB_HOST, DB_USER, DB_PASS, DB_NAME);
                                
                                //, DB_PORT);

     //if($connection){
      //  echo "We are connected";
    //}
?>