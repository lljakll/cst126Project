<?php
    // variables
    $username = "";
    $email = "";
    $firstname = "";
    $lastname = "";

    $errors = array();

    // REGISTER USER
    if (isset($_POST['reg_user'])){
        $username = $_POST['username'];
        $firstname = $_POST['firstname'];
        $lastname = $_POST['lastname'];
        $email = $_POST['email'];
        $password1 = $_POST['password1'];
        $password2 = $_POST['password2'];
        
        if (empty($username)){ array_push($errors, "no username"); }
        if (empty($firstname)){ array_push($errors, "no first name"); }
        if (empty($lastname)){ array_push($errors, "no last name"); }
        if (empty($email)) { array_push($errors, "no email"); }
        if (empty($password1)) { array_push($errors, "no password"); }
        if ($password1 != $password2) { array_push($errors, "passwords do not match"); }

        $user_check_query = "SELECT * FROM users WHERE username='$username' OR email='$email' LIMIT 1";

        $result = mysqli_query($conn, $user_check_query);
        $user = mysqli_fetch_assoc($result);

        if ($user) {
            if ($user['username'] === $username) {
                array_push($errors, "username exists");
            }
            if ($user['email'] === $email) {
                array_push($errors, "email exists");
            }
        }

        if (count($errors) == 0) {
            $password = md5($password1);
            $query = "INSERT INTO users(username, firstname, lastname, email, password) 
                VALUES('$username', '$firstname', '$lastname', '$email', '$password')";
            if (!mysqli_query($conn, $query)) {
                echo ("Error: " . mysqli_error($conn));
            }

        }
    }
?>