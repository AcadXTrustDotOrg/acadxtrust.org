<?php
    require_once("database.php");
    //header("Access-Control-Allow-Origin: http://127.0.0.1:36133");
    header($_SERVER["SERVER_PROTOCOL"]." 403 FORBIDDEN");
    if(mysqli_connect_error() !== NULL){
        header($_SERVER["SERVER_PROTOCOL"]." 401 UNAUTHORIZED");
    }
    else{
        if(!empty($_POST)){
            $query = "INSERT INTO comments (fullName, email, phone, comment) VALUES ('".$_POST['user-name']."', '".$_POST['email']."', '".$_POST['phone']."', '".$_POST['comments']."')";
            $result = mysqli_query($con, $query);        
            if($result > 0){
                header($_SERVER["SERVER_PROTOCOL"]." 200 OK");
            }
            else{
                header($_SERVER["SERVER_PROTOCOL"]." 430 CANNOT RESOLVE");
            }
        }
        else{
            header($_SERVER["SERVER_PROTOCOL"]." 401 UNAUTHORIZED");
        }
    }
?>