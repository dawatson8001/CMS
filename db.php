<?php

global $connection;

$query = "CREATE TABLE users(
user_id int(3) PRIMARY KEY AUTO_INCREMENT,
username varchar(255),
user_password varchar(255),
user_firstname varchar(255),
user_lastname varchar(255),
user_email varchar(255),
user_content text,
user_role varchar(255),
user_randSalt varchar(255),
)";

mysqli_query($connection, $query);
echo "User database complete";

?>