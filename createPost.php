<?php

    // CST-126 Blog Project 1.0
    // create Post Module version 1.0
    // Jackie Adair
    // 30 June 19
    // Create a post and validate it

    require_once('myfuncs.php');
    // check login status
    if(!getUserId()){ // if not logged in
        $message = "You must be logged in to post to this Blog.<br /><br />
        <a href=\"login.html\">Login</a>";
        include('loginFailed.php');
    }
    else{
        // receive content from form
        $postSubject = $_POST["postSubject"];
        $postBody = $_POST["postBody"];
        $userID = getUserId();

        if(strlen($postSubject)>49){ // if subject is 50+ char
            $message = "The Subject is too long.  It must be less than 50 characters.<br /><br />
            <a href=\"createPost.html\">createPost</a>";
            include('loginFailed.php');
        }
        else{
            if(strlen($postBody)>3000){ // if body is 3k+ char
                $message = "The Body is too long.  It must be less than 3000 characters.<br /><br />
                <a href=\"createPost.html\">createPost</a>";
                include('loginFailed.php');
            }
            else{
                if(stristr($postSubject, "badword")){ // check the subject for badwords
                    $message = "There are banned words in the subject.<br /><br />
                    <a href=\"createPost.html\">createPost</a>";
                    include('loginFailed.php');
                }
                else{
                    if(stristr($postBody, "badword")){ // check the body for badwords
                        $message = "There are banned words in the Body.<br /><br />
                        <a href=\"createPost.html\">createPost</a>";
                        include('loginFailed.php');
                    }
                    else{
                        $db = dbConnect();
                        $query = "INSERT INTO posts (userID, postSubject, postBody, posted) VALUES ('$userID', '$postSubject', '$postBody', '1')";

                        if ($db->query($query) === TRUE){
                            echo "Successful Post<br /><br />";
                            echo "<a href=\"index.html\">Home</a>";
                        }
                        else{
                            echo "Error: " . $query . "<br />" . $db->error;
                        }
                    }
                }
            }
        }

    }




    // check content for lanugage and size

    // open database, write it to database


?>