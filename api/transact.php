<?php
    require_once("database.php");
    date_default_timezone_set("Asia/Kolkata");
    header("Access-Control-Allow-Origin: *");
    header($_SERVER["SERVER_PROTOCOL"]." 403 FORBIDDEN");
    header("Content-Type: application/json");
    if(mysqli_connect_error() !== NULL){
        header($_SERVER["SERVER_PROTOCOL"]." 401 UNAUTHORIZED");
    }

    else{
        
        if(!empty($_POST)){
            $time = time();
            $date = date('Y/m/d H:i:s', $time);
            $rand = ($time%10000).rand(100, 1000);
            /*if(isset($_POST['sub-d-on'])) {
                $query = "INSERT INTO transactions (`refNo`, `name`, `email`, `phone`, `amount`, `address`, `state`, `country`, `payModeID`, `transactionID`, `payTime`)
                        VALUES('". $rand . "','" .$_POST["user_name"]. "','" .$_POST["email_add"]. "','" .$_POST["phone"]. "','" .$_POST["amount"]. "','" .$_POST["add"]. "','" .$_POST["add_state"]. "','" .$_POST["add_country"]. "','" .$_POST["pay_mode"]. "', NULL, '".$date."')";
                
                $result = mysqli_query($con, $query) or die(mysqli_error($con));        
                
                if($result > 0){   /*IF data inserted successfully
                    header($_SERVER["SERVER_PROTOCOL"]." 200 OK");
                }
                
                else{
                    header($_SERVER["SERVER_PROTOCOL"]." 430 ERROR");
                }                
            }*/
            
            if(isset($_POST["sub-d-neft"]))
            {
                $query = "INSERT INTO transactions (`refNo`, `name`, `email`, `phone`, `amount`, `address`, `state`, `country`, `payModeID`, `transactionID`, `payTime`)
                        VALUES('". $rand . "','" .$_POST["user_name"]. "','" .$_POST["email_add"]. "','" .$_POST["phone"]. "','" .$_POST["amount"]. "','" .$_POST["add"]. "','" .$_POST["add_state"]. "','" .$_POST["add_country"]. "', 5 , NULL, '".$date."')";
                
                $result = mysqli_query($con, $query) or die(mysqli_error($con));        
                $resp = array();
                if($result > 0) 
                {   /*IF data inserted successfully*/
                    header($_SERVER["SERVER_PROTOCOL"]." 200 OK");
                    $resp["status"] = array("code" => "200", "text" => "OK");
                    $resp["data"] = array("refNo" => $rand, 
                                          "accName" => "AcadX Trust",
                                          "accNo" => "XXXXXXXXXXXX",
                                          "ifsc" => "XXXXX",
                                          "bankName" => "XXXXXXXX");
                    echo json_encode($resp);
                }                
                else
                {
                    header($_SERVER["SERVER_PROTOCOL"]." 430 ERROR");
                    $resp["status"] = array("code" => "430", "text" => "ERROR");
                    $resp["data"] = array("refNo" => NULL);
                    echo json_encode($resp);
                }                 
            }
        }
        else{
            header($_SERVER["SERVER_PROTOCOL"]." 401 BAD INPUT");
        }
    }
?>