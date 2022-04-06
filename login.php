
<?php
    session_start();
?>
<!DOCTYPE html>
<html lang="en" dir="ltr">
    <head>
        <meta charset="utf-8">
        <title>َLogin to database</title>
        <link rel="stylesheet" href="css2.css">
    </head>
    <body>

        <form class="box" action="loginCheck.php" method="post">
            <h1>Login</h1>

            <?php 
                if (isset($_GET['error'])) { ?>
                <p class="error"><?php echo $_GET['error']; ?></p><?php 
                }
            ?>

            <input type="text" name="username" placeholder="Username">
            <input type="password" name="password" placeholder="password">
            <input type="submit" name="submit" value="Login">
        </form>


    </body>
</html>
