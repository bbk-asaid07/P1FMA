<?php
// Function that the intranet page file location as a parameter and displays the body page
function displayBody($file) {
    $handle = fopen($file, 'r') or die('Failed to open the file');

    // Scan the file till the end
    while (!feof($handle)) {
        // Read and print the file line by line
        $line = fgets($handle);
        echo $line;
    }
    fclose($handle);
};

function validateAlphaNumInput($input) {
    return ctype_alnum($input);
}

function validateAlphaInput($input) {
    return ctype_alpha($input);
}

function saveUserData($data) {
    $handle = fopen('data/users.txt', 'a');
    if (fwrite($handle, $data)) {
        header("Location: signup.php?signup=success");
        exit();
    } else {
        header("Location: signup.php?signup=error");
        exit();
    }
    fclose($handle);
}

if (isset($_POST['login-submit'])) {
    $userTyped = (trim($_POST['uname']));
    $passTyped = htmlentities(trim($_POST['pass']));

    // Check if userTyped is alphanumerics. (Valid userTyped)
    if (!validateAlphaNumInput($userTyped)) {
        header("Location: login.php?error=usernameinvalid");
        exit();
    }

    // Check if passTyped is alphanumerics. (Valid passTyped)
    if (!validateAlphaNumInput($passTyped)) {
        header("Location: login.php?error=passwordinvalid");
        exit();
    }

    if (is_file('data/users.txt')) {
        $handle = fopen('data/users.txt', 'r') or die('Failed to open the file');
    }

    // Read the users.txt file and store all the users data in the $formData array
    $formData = array();
    while (!feof($handle)) {
        $data = fgetcsv($handle);
        if (!$data === false && array(null) !== $data) {
            $formData[] = array(
                'title' => $data[0],
                'fname' => $data[1],
                'surname' => $data[2],
                'mail' => $data[3],
                'uname' => $data[4],
                'pass' => $data[5]);
        }
    }
    fclose($handle);

    // Search for the user in the $formData, change $userFound to true if found
    $userFound = false;
    foreach ($formData as $database) {
        if ($pwdCheck = password_verify($passTyped, $database['pass']) && $userTyped == $database['uname']) {
            $userSession = array(
                'title' => $database['title'],
                'firstname' => $database['fname'],
                'lastname' => $database['surname'],
                'username' => $database['uname'],
                'email' => $database['mail'],
            );
            $userFound = true;
        }
    }

    if ($userFound) {
        session_start();
        $_SESSION['username'] = $userSession['username'];
        $_SESSION['firstname'] = $userSession['firstname'];
        $_SESSION['lastname'] = $userSession['lastname'];
        header("Location: index.php");
    } else {
        header("Location: login.php?error=nouser&uname=" . $userTyped);
        exit();
    }
}

if (isset($_POST['signup-submit'])) {
    $title = $_POST['title'];
    $fname = htmlentities(trim($_POST['fname']));
    $lname = htmlentities(trim($_POST['lname']));
    $mail = filter_var(htmlentities(trim($_POST['mail'])), FILTER_SANITIZE_EMAIL);
    $username = htmlentities(trim($_POST['uname']));
    $password = htmlentities(trim($_POST['pass']));
    $passwordRepeat = htmlentities(trim($_POST['pass-repeat']));


    // Check if mail id is valid
    if (!filter_var($mail, FILTER_VALIDATE_EMAIL)) {
        header("Location: signup.php?error=emailinvalid");
        exit();
    }

    // Check if password and repeat password are equal
    if ($password !== $passwordRepeat) {
        header("Location: signup.php?error=passwordnotmatch");
        exit();
    }

    // Check if first name is alphabetic characters. (Valid names)
    if (!validateAlphaInput(str_replace(' ', '', $fname))) {
        header("Location: signup.php?error=fnameinvalid");
        exit();
    }

    // Check if last name is alphabetic characters. (Valid names)
    if (!validateAlphaInput(str_replace(' ', '', $lname))) {
        header("Location: signup.php?error=lnameinvalid");
        exit();
    }

    // Check if username is alphanumerics. (Valid username)
    if (!validateAlphaNumInput($username)) {
        header("Location: signup.php?error=userinvalid");
        exit();
    }

    // Hashing password before storing in the database.
    $hashedPwd = password_hash($password, PASSWORD_DEFAULT);

    $data = $title . ',' .
        $fname . ',' .
        $lname . ',' .
        $mail . ',' .
        $username . ',' .
        $hashedPwd . PHP_EOL;

    // Store the user data in the users.txt file
    saveUserData($data);
}

?>
