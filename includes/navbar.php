<div class="navbar">
    <div class="logo_div">
        <a href="index.php"><h1>CST126Project</h1></a>
    </div>
    <ul>
        <li><a href="index.php">Home</a></li>

        <?php 
            if (isset($_SESSION['user'])){
                echo "<li><a href=\"logout.php\">Logout</a></li>";
                echo "<li><a href=\"new_post.php\">Create a Post</a></li>";
            }else{
                echo "<li><a href=\"login.php\">Login</a></li>";
                echo "<li><a href=\"register.php\">Register</a></li>";
            }
        ?>
    </ul>
</div>