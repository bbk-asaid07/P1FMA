<?php
    include 'includes/header.php';
    require_once 'includes/functions.php';

    // Displaying error messages for empty fields.
    $message = $errorUser = $errorPass = '<span></span>';
    if (isset($_GET['error'])) {
        if ($_GET['error'] == 'usernameinvalid') {
            $errorUser = '<span>Username is invalid - Use Alpha Numerics only.</span>';
        }

        if ($_GET['error'] == 'passwordinvalid') {
            $errorPass = '<span>Password is invalid - Use Alpha Numerics only.</span>';
        }
    }
?>

<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title>Login</title>
    <link rel="stylesheet" href="css/style.css">
</head>
<body>
    <div style="padding: 1em 2em;">
        <?php
            if (isset($_GET['error']) && $_GET['error'] == 'notadmin') {
                echo '<span>Login as Administrator to access Admin area.</span><br/><br/>';
                die();
            }
            if (isset($_GET['error']) && $_GET['error'] == 'notloggedin') {
                echo '<span>Login as Administrator to access Admin area.</span><br/><br/>';
            }
        ?>

        <form action="" method="post">
            <label for="user-login">Username</label>
            <input type="text" name="uname" placeholder="Username" autocomplete="username">

            <br/>
            <br/>

            <label for="pwd-login">Password</label>
            <input type="password" name="pass" placeholder="Password" autocomplete="current-password">

            <br/>
            <br/>

            <button type="submit" name="login-submit" class="btn">Login</button>

            <?php
                if (isset($_GET['error']) && $_GET['error'] == 'nouser') {
                    echo '<br/><br/><span>No user found with this record.</span>';
                }
            ?>
        </form>
        <br/>
        <?php echo $message; ?>
    </div>
</body>
</html>
