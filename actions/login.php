<?php

require_once( $_SERVER["DOCUMENT_ROOT"] . "/conn.php");

$errors = [];



// if the button VALUE was login 
if( isset( $_POST["action"]) && $_POST["action"] == "login" ) :
    // get the users email and password
    // connecto to users table 
    // check if user exists and password matches
    // if not send error
    // if true, login and go to index

    if( 
        ( isset($_POST["email"]) && $_POST["email"] != "" ) &&
        ( isset($_POST["password"]) && $_POST["password"] != "" )
      ) {

        $email = $_POST["email"];
        $password = md5($_POST["password"]);


        $query_users = "SELECT *
                        FROM users
                        WHERE email = '" . $email . "' AND password = '" . $password . "' 
                        LIMIT 1";

        $user_result = mysqli_query($conn, $query_users);

        // Check if user is in database

        print_r( $query_users ); // to check if im getting a result from the limit =  1

        if( mysqli_num_rows($user_result) > 0 ) {
            // User Found!!!
            while( $user = mysqli_fetch_array($user_result)) {
                // print_r($user);
                session_destroy(); // Destroy current session
                session_start(); //Start a new session

                $_SESSION["email"] = $user["email"];
                $_SESSION["role"] = $user["role"];
                $_SESSION["user_id"] = $user["id"];
                $_SESSION["first_name"] = $user["first_name"];
                $_SESSION["last_name"] = $user["last_name"];

                header("Location: http://" . $_SERVER["SERVER_NAME"] );
            }
        } else {
            $errors[] = "Email or Password Incorrect.";
        }

        // echo $password; to check that the php is getting my password on login from the VALUE of the button

    } else {
        $errors[] = "Please Fill Out Username & Password";
    }


    // if the button VALUE was signup

elseif( isset( $_POST["action"]) && $_POST["action"] == "signup" ) :

        $first_name = $_POST["first_name"];
        $last_name = $_POST["last_name"];
        $email = $_POST["email"];
        $password = md5($_POST["password"]);
        $password2 = md5($_POST["password2"]);
        $address = $_POST["address"];
        $address2 = $_POST["address2"];
        $city = $_POST["city"];
        $province_id = ( isset($_POST["province"]) ) ? $_POST["province"] : 0;
        $postal_code = $_POST["postal_code"];
        $agree_terms = $_POST["agree_terms"];
        $newsletter = $_POST["newsletter"];
        $date_created = date("Y-m-d H:i:s");

        // echo "<pre>";
        // print_r($_SERVER);
        // echo "</pre>";

        if($password == $password2 && strlen($password) > 7){
            // Continue
            if( isset($_POST["agree_terms"]) ){
                // Continue 
                if($email != "" && $first_name != "" && $last_name != ""){
                    //  Successfull Submition

                    $new_user_query = " INSERT 
                                        INTO users 
                                        (email, 
                                        password, 
                                        role, 
                                        address, 
                                        address2, 
                                        city, 
                                        province_id, 
                                        postal_code, 
                                        newsletter,
                                        date_created, 
                                        first_name, 
                                        last_name) 
                                        VALUES 
                                        ('$email', 
                                        '$password', 
                                        2, 
                                        '$address', 
                                        '$address2', 
                                        '$city', 
                                        $province_id, 
                                        '$postal_code', 
                                        $newsletter, 
                                        '$date_created',
                                        '$first_name', 
                                        '$last_name') ";

                    if ( !mysqli_query($conn, $new_user_query) ){
                        echo mysqli_error($conn);
                    } else {
                        // Log user in and go to home page 
                        $user_id = mysqli_insert_id($conn);

                        session_destroy();
                        session_start();

                        $_SESSION["user_id"] = $user_id;
                        $_SESSION["role"] = 2;
                        $_SESSION["email"] = $email;

                        header("Location: http://" . $_SERVER["SERVER_NAME"]);
                    }

                    //  Successfull Submition End
                } else {
                    $errors[] = "Please fill-out required feilds";
                }
            } else {
                $errors[] = "You must agree to our terms";
            }
        } else {
            $errors[] = "Passwords do not match";
        }


    // If the Logout button is clicked 

elseif( isset( $_REQUEST["action"]) && $_REQUEST["action"] == "logout" ) :

    session_destroy();
    header("Location: http://" . $_SERVER["SERVER_NAME"]);
    
endif;




if( !empty($errors) ) {

    $query = http_build_query( array("errors" => $errors) );

    header("Location: " . strtok($_SERVER["HTTP_REFERER"], "?") . "?" . $query);
    
}

?>