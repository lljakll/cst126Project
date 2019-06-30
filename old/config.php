<?php
    session_start();
    // connect to database
    $conn = mysqli_connect("localhost", "cst126project", "cst126project", "cst126project");

    if (!$conn) {
        die("Error connecting to database: " . mysqli_connect_error());
    }

    // globals

?>