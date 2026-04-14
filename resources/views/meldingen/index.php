<?php 
session_start();
if(!isset($_SESSION['user_id'])){
    header("Location: ../../../login.php");
    exit;
}
require_once __DIR__.'/../../../config/config.php'; ?>
<!doctype html>
<html lang="nl">

<head>
    <title>StoringApp / Meldingen</title>
    <?php require_once __DIR__.'/../components/head.php'; ?>
</head>

<body>

    <?php require_once __DIR__.'/../components/header.php'; ?>

    <div class="container">
        <h1>Meldingen</h1>
        <a href="create.php">Nieuwe melding &gt;</a>

        <?php if(isset($_GET['msg']))
        {
            echo "<div class='msg'>" . $_GET['msg'] . "</div>";
        } ?>

        <?php
        //Query uitvoeren
        require_once __DIR__.'/../../../config/conn.php';
        $query = "SELECT * FROM meldingen";
        $statement = $conn->prepare($query);
        $statement->execute();
        $meldingen = $statement->fetchAll(PDO::FETCH_ASSOC);
        ?>

        <table name="meldingenTable" id="meldingenTable">
            <thead>
                <tr>
                    <th>Attractie</th>
                    <th>Type</th>
                    <th>Capaciteit p/uur</th>
                    <th>Prioriteit</th>
                    <th>Melder</th>
                    <th>Overige info</th>
                    <th>Gemeld op</th>
                    <th>Aanpassen</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach($meldingen as $melding): ?>
                <tr>
                    <td><?php echo $melding['attractie']; ?></td>
                    <td><?php echo $melding['type']; ?></td>
                    <td><?php echo $melding['capaciteit']; ?></td>
                    <td><?php echo $melding['prioriteit'] ? 'Ja' : 'Nee'; ?></td>
                    <td><?php echo $melding['melder']; ?></td>
                    <td><?php echo $melding['overige_info']; ?></td>
                    <td><?php echo $melding['gemeld_op']; ?></td>
                    <td><a href="edit.php?id=<?php echo $melding['id']; ?>">aanpassen</a></td>
                </tr>
                <?php endforeach; ?>
            </tbody>

        
    </div>

</body>

</html>
