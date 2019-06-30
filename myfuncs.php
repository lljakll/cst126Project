<?php
    // CST-126 Blog Project 1.0
    // Function Module version 1.0
    // Jackie Adair
    // 20 April 2019
    // Various universal functions

    function dbConnect(){
        $dbservername = "localhost";
        $dbusername = "cst126_blog";
        $dbpassword = "cst126_blog";
        $dbname = "cst126_blog";
        $dbport = "3306";

        $db = new mysqli($dbservername, $dbusername, $dbpassword, $dbname, $dbport);

        if ($db->connect_error)
        {
            die("Connection Failed: " . $db->connect_error);
        }

        return $db;
    }

    function saveUserId($id){
        session_start();
        $_SESSION["USER_ID"] = $id;
    }

    function clearUserId(){
        session_start();
        $_SESSION["USER_ID"] = NULL;
    }

    function getUserId(){
        session_start();
        return $_SESSION["USER_ID"];
    }
?>