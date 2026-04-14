<?php

session_start();
if(!isset($_SESSION['user_id'])){
    header("Location: ../../../login.php");
    exit;
}

$action = $_POST['action'];

if($action == "create"){

	//Variabelen vullen
	$attractie = $_POST['attractie'];
	$type = $_POST['type'];
	$capaciteit = $_POST['capaciteit'];
	$prioriteit = isset($_POST['prioriteit']) ? 1 : 0;
	$melder = $_POST['melder'];
	$overige_info = $_POST['overige_info'];

	//Error handling
	$attractie = $_POST['attractie'];
	if(empty($attractie))
	{
	 $errors[] = "Vul de attractie-naam in.";
	}
	if(empty($type))
	{
	 $errors[] = "Vul het type attractie in.";
	}
	$capaciteit = $_POST['capaciteit'];
	if(!is_numeric($capaciteit))
	{
	 $errors[] = "Vul voor capaciteit een geldig getal in.";
	}
	if(empty($melder))
	{
	 $errors[] = "Vul de naam van de melder in.";
	}
	if(isset($errors))
	{
	 var_dump($errors);
	 die();
	}

	$prioriteit = isset($_POST['prioriteit']) ? 1 : 0;


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

}

if($action == "update"){

	//Variabelen vullen
	$id = $_POST['id'];
	$capaciteit = $_POST['capaciteit'];
	$prioriteit = isset($_POST['prioriteit']) ? 1 : 0;
	$melder = $_POST['melder'];
	$overige_info = $_POST['overig'];

	//1. Verbinding
	require_once '../../../config/conn.php';

	//2. Query
	$query = "UPDATE meldingen SET capaciteit = :capaciteit, prioriteit = :prioriteit, melder = :melder, overige_info = :overige_info WHERE id = :id";

	//3. Prepare
	$statement = $conn->prepare($query);

	//4. Execute
	$statement->execute([
	    ':id' => $id,
	    ':capaciteit' => $capaciteit,
	    ':prioriteit' => $prioriteit,
	    ':melder' => $melder,
	    ':overige_info' => $overige_info
	]);

	//5. Redirect
	header("Location: ../../../resources/views/meldingen/index.php?msg=Melding bijgewerkt");

}

if($action == "delete"){

	//Variabelen vullen
	$id = $_POST['id'];

	//1. Verbinding
	require_once '../../../config/conn.php';

	//2. Query
	$query = "DELETE FROM meldingen WHERE id = :id";

	//3. Prepare
	$statement = $conn->prepare($query);

	//4. Execute
	$statement->execute([
	    ':id' => $id
	]);

	//5. Redirect
	header("Location: ../../../resources/views/meldingen/index.php?msg=Melding verwijderd");

}