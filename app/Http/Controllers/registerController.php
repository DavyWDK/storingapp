<?php

$username = $_POST['username'];
$password = $_POST['password'];
$password_check = $_POST['password_check'];

//1. Check if username is not empty
if(empty($username))
{
    die("Error: Gebruikersnaam mag niet leeg zijn!");
}

//2. Check if passwords match
if($password !== $password_check)
{
    die("Error: Wachtwoorden komen niet overeen!");
}

//3. Check if password is not empty
if(empty($password))
{
    die("Error: Wachtwoord mag niet leeg zijn!");
}

//4. Connect to database
require_once '../../../config/conn.php';

//5. Check if username doesn't already exist
$query = "SELECT * FROM users WHERE username = :username";
$statement = $conn->prepare($query);
$statement->execute([
    ':username' => $username
]);

if($statement->rowCount() > 0)
{
    die("Error: Gebruikersnaam bestaat al!");
}

//6. Hash the password
$hash = password_hash($password, PASSWORD_DEFAULT);

//7. Insert the new user into database
$query = "INSERT INTO users (username, password) VALUES (:username, :hash)";
$statement = $conn->prepare($query);
$statement->execute([
    ':username' => $username,
    ':hash' => $hash
]);

//8. Redirect to login page
require_once '../../../config/config.php';
header("Location: " . $base_url . "/login.php?msg=Account+aangemaakt!+Je+kunt+nu+inloggen");
