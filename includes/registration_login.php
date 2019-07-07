<?php 
	// variable declaration
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

		// Ensure that no user is registered twice. 
		// the email and usernames should be unique
		$user_check_query = "SELECT * FROM users WHERE username='$username' 
								OR email='$email' LIMIT 1";

		$result = mysqli_query($conn, $user_check_query);
		$user = mysqli_fetch_assoc($result);

		if ($user) { // if user exists
			if ($user['username'] === $username) {
			  array_push($errors, "Username already exists");
			}
			if ($user['email'] === $email) {
			  array_push($errors, "Email already exists");
			}
		}
		// register user if there are no errors in the form
		if (count($errors) == 0) {
			$password = md5($password_1);//encrypt the password before saving in the database
            $query = "INSERT INTO users(username, firstname, lastname, email, password, role, created, modified) 
                VALUES('$username', '$firstname', '$lastname', '$email', '$password', 6, now(), now())";
			mysqli_query($conn, $query);

			// get id of created user
			$reg_user_id = mysqli_insert_id($conn); 

			// put logged in user into session array
			$_SESSION['user'] = getUserById($reg_user_id);

            // check session array for user and redirect
            if (($_SESSION['user'])){
                $_SESSION['message'] = "You are now logged in";
                header('location: index.php');
                exit(0);
            }
		}
	}

	// LOG USER IN
	if (isset($_POST['login_btn'])) {
		$username = esc($_POST['username']);
		$password = esc($_POST['password']);

		if (empty($username)) { array_push($errors, "Username required"); }
		if (empty($password)) { array_push($errors, "Password required"); }
		if (empty($errors)) {
			$password = md5($password); // encrypt password
			$sql = "SELECT * FROM users WHERE username='$username' and password='$password' LIMIT 1";

			$result = mysqli_query($conn, $sql);
			if (mysqli_num_rows($result) > 0) {
				// get id of created user
				$reg_user_id = mysqli_fetch_assoc($result)['id']; 

				// put logged in user into session array
				$_SESSION['user'] = getUserById($reg_user_id); 

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
	// escape value from form
	function esc(String $value)
	{	
		// bring the global db connect object into function
		global $conn;

		$val = trim($value); // remove empty space sorrounding string
		$val = mysqli_real_escape_string($conn, $value);

		return $val;
	}
	// Get user info from user id
	function getUserById($id)
	{
		global $conn;
		$sql = "SELECT * FROM users WHERE id=$id LIMIT 1";

		$result = mysqli_query($conn, $sql);
		$user = mysqli_fetch_assoc($result);

		// returns user in an array format: 
		// ['id'=>1 'username' => 'Awa', 'email'=>'a@a.com', 'password'=> 'mypass']
		return $user; 
	}
?>