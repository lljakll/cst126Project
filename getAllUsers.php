<?php

    // CST-126 Blog Project 1.0
    // List users Module version 1.0
    // Jackie Adair
    // 30 June 19
    // List all users in database.

    require_once('myfuncs.php');

    $db = dbConnect();

    $query = "SELECT id, FIRST_NAME, LAST_NAME FROM users";
    $stmt = $db->prepare($query);
    $stmt->bind_result($id, $first, $last);
    $stmt->execute();

    $stmt->store_result();

    echo "There were " . $stmt->num_rows . " rows returned. \n\n";

    echo "<table><tr><td><strong>ID</strong></td><td><strong>First</strong></td><td><strong>Last</strong></td></tr>";

    while($stmt->fetch()){
        echo "<tr><td>" . $id . "</td><td>" . $first . "</td><td>" . $last . "</td></tr>";
    }

    echo "</table>";

    $result->free();

    $db->close();

?>