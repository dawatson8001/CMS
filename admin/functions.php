<?php
function escape($string){
    global $connection;
    mysqli_real_escape_string($connection, trim($string));

}
function users_online(){
    if(isset($_GET['onlineusers'])){
        global $connection;
        if(!$connection){
            session_start();
            include("../includes/db.php");
        }
        $session = session_id();
        $time = time();
        $time_out_in_seconds = 300;
        $time_out = $time - $time_out_in_seconds;

        //    $stmt = mysqli_prepare($connection, "SELECT id, session, time FROM users_online WHERE session = ?");
        //    mysqli_stmt_bind_param($stmt, "s", $session);
        //    mysqli_stmt_execute($stmt);
        // 
        //    //if(mysqli_stmt_num_rows($stmt)){
        //        $stmt = mysqli_prepare($connection, "INSERT INTO users_online(session, time) VALUES(?,?)");
        //        mysqli_stmt_bind_param($stmt, "si", $session, $time);
        //    //}else{
        //        $stmt = mysqli_prepare($connection, "UPDATE users_online SET time = ? WHERE session = ?");
        //        mysqli_stmt_bind_param($stmt, "si", $time, $session);
        //    //}
        //    mysqli_stmt_execute($stmt);
        //        
        //    $stmt = mysqli_prepare($connection, "SELECT id, session, time FROM users_online WHERE time > ?");
        //    mysqli_stmt_bind_param($stmt, "s", $time_out);
        //    mysqli_stmt_execute($stmt);
        //    echo mysqli_stmt_num_rows($stmt);
        //    mysqli_stmt_execute($stmt);
        //    mysqli_stmt_close($stmt);
        //    }

        $query = "SELECT * FROM users_online WHERE session = '$session'";
        $send_query = mysqli_query($connection, $query);
        $count = mysqli_num_rows($send_query);

        if($count == NULL){
            mysqli_query($connection, "INSERT INTO users_online(session, time) VALUES('$session', '$time')");
        }else {
            mysqli_query($connection, "UPDATE users_online SET time = '$time' WHERE session = '$session'");
        }
        echo $count_user = mysqli_num_rows(mysqli_query($connection, "SELECT * FROM users_online WHERE time > '$time_out'"));
    }

}
users_online();

function confirmQuery($result){
    global $connection;
    if(!$result){
        die("QUERY FAILED" . mysqli_error($connection));
    }
}

function insert_categories(){

    global $connection;
    if(isset($_POST['submit'])){
        $cat_title = $_POST['cat_title'];

        if($cat_title == "" || empty($cat_title)){
            echo "This field should not be empty";
        } else{

            $stmt = mysqli_prepare($connection, "INSERT INTO categories(cat_title) VALUES(?) ");
            mysqli_stmt_bind_param($stmt, 's', $cat_title);
            mysqli_stmt_execute($stmt);

        }mysqli_stmt_close($stmt);
    }
}

function find_all_categories(){

    global $connection;

    $stmt = mysqli_prepare($connection, "SELECT cat_id, cat_title FROM categories");
    mysqli_stmt_execute($stmt);
    mysqli_stmt_bind_result($stmt, $cat_id, $cat_title);

    while(mysqli_stmt_fetch($stmt)):

    echo "<tr>";
    echo "<td>{$cat_id}</td>";
    echo "<td><b>{$cat_title}</b></td>";
    echo "<td><a class='btn btn-info' href='categories.php?edit={$cat_id}'>Edit</a></td>";
    echo "<td><a class='btn btn-danger' href='categories.php?delete={$cat_id}'>Delete</a></td>";
    echo "<tr>";
    endwhile;
    mysqli_stmt_close($stmt);
}
function delete_categories(){
    
    global $connection;
    if(isset($_GET['delete'])){
        $the_cat_id = $_GET['delete'];
        $delete_query = mysqli_query($connection, "DELETE FROM categories WHERE cat_id = {$the_cat_id}");
        header("Location: categories.php");
    }
}

function recordCount($table){

    global $connection;

    return mysqli_num_rows(mysqli_query($connection, "SELECT * FROM $table"));
}

function checkStatus($table, $column, $status){

    global $connection;
    return mysqli_num_rows(mysqli_query($connection, "SELECT * FROM $table WHERE $column = '$status'"));

}

function isAdmin($username = ''){

    global $connection;
    $query = "SELECT user_role FROM users WHERE username = '$username'";
    $result = mysqli_query($connection, $query);

    $row = mysqli_fetch_array($result);

    if($row['user_role'] == 'admin'){
        return true;
    }else{
        return false;
    }
}

function usernameExists($username){

    global $connection;

    $query = "SELECT username FROM users WHERE username = '$username'";
    $result = mysqli_query($connection, $query);

    if(mysqli_num_rows($result) > 0){
        return true;
    }else {
        return false;
    }
}

function emailExists($email){

    global $connection;

    $query = "SELECT user_email FROM users WHERE user_email = '$email'";
    $result = mysqli_query($connection, $query);

    if(mysqli_num_rows($result) > 0){
        return true;
    }else {
        return false;
    }
}

function redirect($location){
    return header("Location: $location");
}

function registerUser($username, $email, $password){

    global $connection;

    $username = mysqli_real_escape_string($connection, $username);
    $email    = mysqli_real_escape_string($connection, $email);
    $password = mysqli_real_escape_string($connection, $password);

    $password = password_hash($password, PASSWORD_BCRYPT, array('cost' => 12));

    $query = "INSERT INTO users (username, user_email, user_password, user_role) ";
    $query .= "VALUES('{$username}', '{$email}', '{$password1}', 'subscriber')";
    $register_user_query = mysqli_query($connection, $query);
}

function loginUser($username, $password){
    global $connection;

    $username = trim($username);
    $password = trim($password);

    $username = mysqli_real_escape_string($connection, $username);
    $password = mysqli_real_escape_string($connection, $password);

    $query = "SELECT * FROM users WHERE username = '{$username}' ";
    $select_user_query = mysqli_query($connection, $query);
    if(!$select_user_query){
        die("Query Failed" . mysqli_error($connection));
    }

    while($row = mysqli_fetch_array($select_user_query)){
        $db_user_id = $row['user_id'];
        $db_username = $row['username'];
        $db_user_firstname = $row['user_firstname'];
        $db_user_lastname = $row['user_lastname'];
        $db_user_role = $row['user_role'];
        $db_user_password = $row['user_password'];
    }

    //$password = crypt($password, $db_user_password);

    if(password_verify($password, $db_user_password)){
        $_SESSION['username'] = $db_username;
        $_SESSION['firstname'] = $db_user_firstname;
        $_SESSION['lastname'] = $db_user_lastname;
        $_SESSION['user_role'] = $db_user_role;

        redirect("/admin/index.php");

    } else {
        redirect("/index.php");
    }
}
?>






