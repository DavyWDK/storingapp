<?php

//Variabelen vullen
$attractie = $_POST['attractie'];
$type = $_POST['type'];
$capaciteit = $_POST['capaciteit'];
$prioriteit = isset($_POST['prioriteit']) ? true : false;
$melder = $_POST['melder'];
$overige_info = $_POST['overige_info'];

//Error handling
$attractie = $_POST['attractie'];
if(empty($attractie))
{
 $errors[] = "Vul de attractie-naam in.";
}
$capaciteit = $_POST['capaciteit'];
if(!is_numeric($capaciteit))
{
 $errors[] = "Vul voor capaciteit een geldig getal in.";
}
if(isset($errors))
{
 var_dump($errors);
 die();
}


//1. Verbinding
require_once '../../../config/conn.php';

//2. Query
$query = "INSERT INTO meldingen (attractie, type, capaciteit, prioriteit, melder, overige_info) VALUES (:attractie, :type, :capaciteit, :prioriteit, :melder, :overige_info)";

//3. Prepare
$statement = $conn->prepare($query);   

//4. Execute
$statement->execute([
    ':attractie' => $attractie,
    ':type' => $type,
    ':capaciteit' => $capaciteit,
    ':prioriteit' => $prioriteit,
    ':melder' => $melder,
    ':overige_info' => $overige_info
]);

//5. Redirect
header("Location: ../../../resources/views/meldingen/index.php?msg=Melding opgeslagen");