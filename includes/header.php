<?php
    session_start();
?>

<div class="main-wrapper">
    <header class="header-bar">
        <a href="index.php"><img class="logo" src="img/logo.png" alt="DCS Logo"></a>
    </header>
    <nav class="main-nav">
        <ul>

            <li><a href="index.php">Home</a></li>

            <?php if (isset($_SESSION['username'])) { ?>
                <li><a href="intranet.php">Intranet</a></li>

                <?php if ($_SESSION['username'] == 'admin') { ?>
                    <li><a href="signup.php">Admin</a></li>
                <?php } ?>

                <li><a href="logout.php">Logout</a></li>

            <?php } else { ?>
                <li><a href="login.php">Login</a></li>
            <?php } ?>

        </ul>
    </nav>
    <?php if(isset($_SESSION['username'])) { ?>
        <h4 style="padding: 1em 2em;">Welcome to DCS portal <?php echo $_SESSION['firstname']. " " . $_SESSION['lastname'] ?> </h4>
    <?php } ?>
</div>
