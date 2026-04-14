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
    <title>StoringApp / Registreren</title>
    <?php require_once __DIR__.'/resources/views/components/head.php'; ?>
</head>

<body>

    <?php require_once __DIR__.'/resources/views/components/header.php'; ?>

    <div class="container">
        <h1>Registreren</h1>
        <?php
        if(isset($_GET['msg']))
        {
            echo "<div class='msg'>" . $_GET['msg'] . "</div>";
        }
        ?>
        <form action="app/Http/Controllers/registerController.php" method="POST">
            <div class="form-group">
                <label for="username">Gebruikersnaam:</label>
                <input type="text" name="username" id="username" class="form-input" required>
            </div>
            <div class="form-group">
                <label for="password">Wachtwoord:</label>
                <input type="password" name="password" id="password" class="form-input" required>
            </div>
            <div class="form-group">
                <label for="password_check">Bevestig wachtwoord:</label>
                <input type="password" name="password_check" id="password_check" class="form-input" required>
            </div>
            <div class="form-group">
                <input type="submit" value="Registreren">
            </div>
        </form>
    </div>

</body>

</html>
