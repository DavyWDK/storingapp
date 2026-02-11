<?php

//Variabelen vullen
$attractie = $_POST['attractie'];
$type = $_POST['type'];
$capaciteit = $_POST['capaciteit'];
$prioriteit = isset($_POST['prioriteit']) ? true : false;
$melder = $_POST['melder'];

//1. Verbinding
require_once '../../../config/conn.php';

//2. Query
$query = "INSERT INTO meldingen (attractie, type, capaciteit, melder) VALUES (:attractie, :type, :capaciteit, :melder)";

//3. Prepare
$statement = $conn->prepare($query);   

//4. Execute
$statement->execute([
    ':attractie' => $attractie,
    ':type' => $type,
    ':capaciteit' => $capaciteit,
    ':melder' => $melder
]);

//5. Redirect
header("Location: ../../../resources/views/meldingen/index.php?msg=Melding opgeslagen");