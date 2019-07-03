<?php include('config.php') ?>

<?php include( ROOT_PATH . '/includes/registerLogin.php') ?>

<?php include( ROOT_PATH . '/includes/head_section.php') ?>

<title>Register</title>
</head>
<body>
    <div class="container">
        <!-- navbar -->
        <?php include( ROOT_PATH . '/includes/navbar.php'); ?>

        <div style="width: 40%; margin: 20px auto;">
            <form method="post" action="register.php" >
                <h2>REGISTER</h2>
                <?php include( ROOT_PATH . '/includes/errors.php') ?>
                <input type="text" name="username" value="<?php echo $username; ?>" placeholder="Username">
                <input type="text" name="firstname" value="<?php echo $firstname; ?>" placeholder="First Name">
                <input type="text" name="lastname" value="<?php echo $lastname; ?>" placeholder="Last Name">
                <input type="email" name="email" value="<?php echo $email ?>" placeholder="Email">
                <input type="password" name="password1" placeholder="Password">
                <input type="password" name="password2" placeholder="Confirmation">
                <button type="submit" class="btn" name="reg_user">Register</button>
            </form>
        </div>
    </div>

    <?php include( ROOT_PATH . '/includes/footer.php') ?>
