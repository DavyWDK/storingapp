<?php 
session_start();
if(isset($_SESSION['user_id']))
{
    require_once __DIR__.'/config/config.php';
    header("Location: " . $base_url . "/index.php?msg=Je bent al ingelogd");
    exit;
}
require_once __DIR__.'/config/config.php'; ?>
<!doctype html>
<html lang="nl">

<head>
    <title>StoringApp / Login</title>
    <?php require_once __DIR__.'/resources/views/components/head.php'; ?>
</head>

<body>

    <?php require_once __DIR__.'/resources/views/components/header.php'; ?>

    <div class="container">
        <h1>Login</h1>
        <?php
        if(isset($_GET['msg']))
        {
            echo "<div class='msg'>" . $_GET['msg'] . "</div>";
        }
        ?>
        <form action="app/Http/Controllers/loginController.php" method="POST">
            <div class="form-group">
                <label for="username">Gebruikersnaam:</label>
                <input type="text" name="username" id="username" class="form-input">
            </div>
            <div class="form-group">
                <label for="password">Wachtwoord:</label>
                <input type="password" name="password" id="password" class="form-input">
            </div>
            <input type="submit" value="Login">
        </form>
    </div>

</body>

</html>
