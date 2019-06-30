<?php

    // CST-126 Blog Project 1.0
    // Logout Module version 1.0
    // Jackie Adair
    // 30 June 19
    // Logout functions

    require_once 'myfuncs.php';

    if(getUserId()){
    ?>
        <!DOCTYPE html>
        <html lang="en">
            <head>
                <meta charset="UTF-8">
                <title>logout</title>
            </head>
            <body>
                <h2>User ID <?php echo " " . getUserId() . " "; ?>has been logged out.</h2><br /><br />
                <a href="index.html">Main Menu</a>
            </body>
        </html>
    <?php
        clearUserId();
    }
    else{
    ?>
        <!DOCTYPE html>
        <html lang="en">
            <head>
                <meta charset="UTF-8">
                <title>logout</title>
            </head>
            <body>
                <h2>There is not a user logged in.</h2><br /><br />
                <a href="index.html">Main Menu</a>
            </body>
        </html>
    <?php
    }
    ?>
