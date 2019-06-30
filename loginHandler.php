<?php

    /*
    CST-126 Blog Project 1.0
    Module - Login Page v3.0
    Jackie Adair
    30 June 19
    PHP for the login page for this blog.
    */

    require_once('myfuncs.php');

    $userName = $_POST["userName"];
    $userPass = $_POST["userPass"];

    if($userName == "" || $userName == NULL){
        $message = "Username is required.<br /><br />
            <a href=\"login.html\">Back</a>";
        include('loginFailed.php');
    }
    else if($userPass == "" || $userPass == NULL){
        $message = "User Password is required.<br /><br />
            <a href=\"login.html\">Back</a>";
        include('loginFailed.php');
    }
    else{
        $db = dbConnect();

        $query = "SELECT ID FROM users WHERE USERNAME = ? AND PASSWORD = ?";
        $stmt = $db->prepare($query);
        $stmt->bind_param('ss', $userName, $userPass);

        $stmt->execute();

        $stmt->store_result();
        $stmt->bind_result($ID);

        if($stmt->num_rows < 1){
            $message = "Login Failed, no user found or password incorrect.<br /><br />
                <a href=\"login.html\">Back</a>";
            include('loginFailed.php');
        }
        else if ($stmt->num_rows > 1){
            $message =  "Login Failed, Multiple usernames found. Contact the site admin.<br /><br />
                <a href=\"login.html\">Back</a>";
            include('loginFailed.php');
            
        }
        else{
            $stmt->fetch();
            saveUserId($ID);

            include('loginResponse.php');
            echo "<a href=\"index.html\">Home</a>";
        }

        $db->close();

    }


?>