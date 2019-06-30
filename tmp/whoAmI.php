<?php
    // CST-126 Blog Project 1.0
    // WhoAmI Module version 1.0
    // Jackie Adair
    // 20 April 2019
    // Displays current user id

    require_once 'myfuncs.php';
?>

<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <title>Who Am I</title>
    </head>
    <body>
        <h2>Hello, My User ID is: <?php echo " " . getUserId(); ?></h2><br /><br />
        <a href="index.html">Main Menu</a>
    </body>
</html>