<?php
    /*
    CST-126 Blog Project 1.0
    Module - Registration Page v1.0
    Jackie Adair
    7 April 2019
    PHP for the registration page for this blog.
    */
    $servername = "localhost";
    $username = "cst126_blog";
    $password = "cst126_blog";
    $database = "cst126_blog";
    $port = "3306";

    $conn = new mysqli($servername, $username, $password, $database, $port);

    // check the connection
    if ($conn->connect_error)
    {
        die("Connection Failed: " . $conn->connect_error);
    }

    $firstName = $_POST["fName"];
    $lastName = $_POST["lName"];
    $password = $_POST["passwd"];

    $sqlQuery = "INSERT INTO users (f_name, l_name, passwd) VALUES ('$firstName', '$lastName', '$password')";

    if ($conn->query($sqlQuery) === TRUE)
    {
        echo $firstName . " " . $lastName . " was registered at " . date('H:i') . " on " . date('jS F Y') . ".";
    }else {
        echo "Error: " . $sql . "<br />" . $con->error;
    }
    
    $con->close();
?>