<?php
    include 'includes/header.php';
    require_once 'includes/functions.php';

    // Initialize error variables.
    $message = $errorPass = $errorTitle = $errorUser = $errorlname = $errorfname = $errorEmail = '<span></span>';

    if (!isset($_SESSION['username']) || (isset($_SESSION['username']) && $_SESSION['username'] != 'admin')) {
        echo "You need to log in as Admin to view this page";
    }

    // Displaying error messages for empty fields.
    if (isset($_GET['error'])) {
        if ($_GET['error'] == 'passwordnotmatch') {
            $errorPass = '<span>Enter a match Password.</span>';
        }

        if ($_GET['error'] == 'fnameinvalid') {
            $errorfname = '<span>First Name invalid - Only letters allowed.</span>';
        }

        if ($_GET['error'] == 'lnameinvalid') {
            $errorlname = '<span>Surname invalid - Only letters allowed.</span>';
        }
        if ($_GET['error'] == 'userinvalid') {
            $errorUser = '<span>User invalid - Only numbers and letters with no spaces allowed.</span>';
        }
    }

    // Displaying message created successfully.
    if (isset($_GET['signup'])) {
        if ($_GET['signup'] == 'success') {
            $message = '</br><span>New record successfully created.</span>';
        }

        if ($_GET['signup'] == 'error') {
            $message = '</br><span>Some error occured while storing the user record.</span>';
        }
    }
?>

<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title>New User</title>
    <link rel="stylesheet" href="css/style.css">
</head>
<body>
    <?php if ($_SESSION['username'] == 'admin') { ?>
    <div class="loginForm-body" style="padding: 1em 2em;">
        <h1>Sign Up</h1>
        <br/>
        <hr/>
        <br/>
        <form action="" method="post">
            <table>
                <tr>
                    <td><label for="titles">Title</label></td>
                    <td>
                        <select name="title" id="titles">
                            <option value="" disabled selected>Select your title</option>
                            <option value="mr">Mr.</option>
                            <option value="mrs">Mrs.</option>
                            <option value="miss">Miss</option>
                            <option value="ms">Ms</option>
                            <option value="other">Other</option>
                        </select>
                    </td>
                    <td><?php echo $errorTitle; ?></td>
                </tr>
                <tr>
                    <td><label for="name">First name</label></td>
                    <td><input type="text" name="fname" id="name" value="<?php if (isset($_GET['fname'])) {echo htmlentities($_GET['fname']);}?>" placeholder="First name" autocomplete="name"></td>
                    <td><?php echo $errorfname; ?></td>
                </tr>
                <tr>
                    <td><label for="last-name">Surname</label></td>
                    <td><input type="text" name="lname" id="last-name" value="<?php if (isset($_GET['lname'])) {echo htmlentities($_GET['lname']);}?>" placeholder="Surname" autocomplete="family-name"></td>
                    <td><?php echo $errorlname; ?></td>
                </tr>
                <tr>
                    <td><label for="email">Email</label></td>
                    <td><input type="text" name="mail" id="email" value="<?php if (isset($_GET['mail'])) {echo htmlentities($_GET['mail']);}?>" placeholder="Email" autocomplete="email"></td>
                    <td><?php echo $errorEmail; ?></td>
                </tr>
                <tr>
                    <td><label for="user">Username</label></td>
                    <td><input type="text" name="uname" id="user" value="<?php if (isset($_GET['uname'])) {echo htmlentities($_GET['uname']);}?>" placeholder="Username" autocomplete="username"></td>
                    <td><?php echo $errorUser; ?></td>
                </tr>
                <tr>
                    <td><label for="pwd">Password</label></td>
                    <td><input type="password" name="pass" id="pwd" placeholder="Password"></td>
                    <td><?php echo $errorPass; ?></td>
                </tr>
                <tr>
                    <td><label for="pwd-repeat">Password</label></td>
                    <td><input type="password" name="pass-repeat" id="pwd-repeat" placeholder="Repeat Password"></td>
                    <td><?php echo $errorPass; ?></td>
                </tr>
                <tr>
                    <td><button type="submit" name="signup-submit" class="btn">New User</button></td>
                </tr>
            </table>
        </form>
        <br/>
        <?php echo $message; ?>
    </div>
    <?php } ?>
</body>
</html>
