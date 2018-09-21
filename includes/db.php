<?php ob_start();

// $db['db_host'] = "localhost";
// $db['db_user'] = "cmsadmin";
// $db['db_pass'] = "73svco25FlzENyJ5";
// $db['db_name'] = "cms";
// $db['db_port'] = "8889";


$db['db_host'] = "us-cdbr-iron-east-01.cleardb.net";
$db['db_user'] = "b1bb19c33d3b9f";
$db['db_pass'] = "e3290853";
$db['db_name'] = "heroku_db9168b90eb2533";

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