<?php
    require 'includes/header.php';
    require_once 'includes/functions.php';

    $php = 'data/P1results.php';
    $dt = 'data/DTresults.php';
    $pfp = 'data/PfPresults.php';
?>

<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title>Home</title>
    <link rel="stylesheet" href="css/style.css">
</head>
<body>
    <div style="padding: 1em 2em;">
        <h2>Module Results</h2>
        <br/>
        <hr/>
        <br/>
        <div class="links">
            <a href="?php=true">Web Programming using PHP - P1 Results</a>
            <br/>
            <a href="?dt=true">Introduction to Database Technology - DT Results</a>
            <br/>
            <a href="?pfp=true">Problem Solving for Programming - PfP Results</a>
            <br/>
            <br/>
        </div>
    </div>
</body>
</html>

<?php
    // If the staff or admin is logged in, show the secure intranet files,
    // otherwise show the login form
    if (isset($_SESSION['username'])) {
        if (isset($_GET['php'])) {
            displayBody($php);
        } elseif (isset($_GET['dt'])) {
            displayBody($dt);
        } elseif (isset($_GET['pfp'])) {
            displayBody($pfp);
        }
    }
?>
