<?php

session_start();

$username = $_POST['username'];
$password = $_POST['password'];

//Hier komt een query
require_once '../../../config/conn.php';

$query = "SELECT * FROM users WHERE username = :username";

$statement = $conn->prepare($query);

$statement->execute([
    ':username' => $username
]);

if($statement->rowCount() < 1)
{
    die("Error: account bestaat niet");
}

$user = $statement->fetch(PDO::FETCH_ASSOC);

if(!password_verify($password, $user['password']))
{
    die("Error: wachtwoord niet juist!");
}

$_SESSION['user_id'] = $user['id'];
$_SESSION['username'] = $user['username'];

header("Location: ../../../index.php?msg=Je bent ingelogd");
