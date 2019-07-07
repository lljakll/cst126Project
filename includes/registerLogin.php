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
        
        if (empty($username)){ array_push($errors, "Please enter a username"); }
        if (empty($firstname)){ array_push($errors, "Please enter a First Name"); }
        if (empty($lastname)){ array_push($errors, "Please enter a Last Name"); }
        if (empty($email)) { array_push($errors, "Your Email is Required"); }
        if (empty($password1)) { array_push($errors, "A Password is Required"); } // Password rules validation?
        if ($password1 != $password2) { array_push($errors, "The passwords must match"); }

        $user_check_query = "SELECT * FROM users WHERE username='$username' OR email='$email' LIMIT 1";

        $result = mysqli_query($conn, $user_check_query);
        $user = mysqli_fetch_assoc($result);

        if ($user) {
            if ($user['username'] === $username) {
                array_push($errors, "The username you entered already exists.  Please try another.");
            }
            if ($user['email'] === $email) {
                array_push($errors, "The email you entered is already registered with this system.");
            }
        }

        if (count($errors) == 0) {
            // encrypt password
            $password = md5($password1);
            // build query
            $query = "INSERT INTO users(username, firstname, lastname, email, password, role, created, modified) 
                VALUES('$username', '$firstname', '$lastname', '$email', '$password', 6, now(), now())";
            // write to users unless error
            if (!mysqli_query($conn, $query)) {
                echo ("Error: " . mysqli_error($conn));
            }
            
            // grab userid and assign it to session variable
            $reg_user_id = mysqli_insert_id($conn);
            $_SESSION['user'] = getUserById($reg_user_id);

            // check session array for user and redirect
            if (($_SESSION['user'])){
                $_SESSION['message'] = "You are now logged in";
                header('location: index.php');
                exit(0);
            }
        }
    }

    // LOGIN USER
    if (isset($_POST['btnLogin'])){
            $username = $_POST['username'];
            $password = $_POST['password'];

            // validate form input exists maybe some javascript in the future
            if(empty($username)) {array_push($errors, "Username is a required entry");}
            if(empty($password)) {array_push($errors, "A password is required");}

            // if no errors, check to see if user exists
            if (empty($errors)){
                $password = md5($password);
                $sql = "SELECT * FROM users WHERE username='$username' and password='$password' LIMIT 1";

                $result = mysqli_query($conn, $sql);
                if (mysqli_num_rows($result) > 0) {

                    $reg_user_id = mysqli_fetch_assoc($result)['id'];

                    $_SESSION['user'] = getUserByID($reg_user_id);

                    // Check user roles and redirect
                    // TODO: setup a switch case for user login permissions
                    if (in_array($_SESSION['user']['role'], ["1"])){
                        $_SESSION['message'] = "You are now logged in as an administrator";

                        header('location: ' . BASE_URL . 'admin/dashboard.php');
                        exit(0);
                    } else {

                        $_SESSION['message'] = "you are now logged in.";

                        header('location: index.php');
                        exit(0);
                    }
                } else {
                    array_push($errors, 'Bad username or password');
                }
            }
        }

    function getUserById($id){
        global $conn;
        $sql = "SELECT * FROM users WHERE id=$id LIMIT 1";

        $result = mysqli_query($conn, $sql);
        $user = mysqli_fetch_assoc($result);

        // Array = id, username, firstname, lastname, email, password, role, created, modified
        return $user;
    }
?>