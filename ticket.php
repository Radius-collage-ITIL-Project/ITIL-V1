<?php
require __DIR__ . '/menus/header.php';

if (empty($_GET['ticketId'])) {
    header("location: index.php" );
    exit;
}
$ticketId = $_GET['ticketId'];

$sql = "SELECT t.id as ticketId,
               t.title as title,
               c.name as category,
               r.name as callerLevel,
               th.threat as threat,
               th.`max-duration` as threatDuration,
               t.solved as solved,
               t.duration as duration,
               s.*
        FROM `tickets` as t
        LEFT JOIN customers AS s ON t.customerid = s.id
        LEFT JOIN categories AS c ON t.category = c.id
        LEFT JOIN threats AS th ON t.threat = th.id
        INNER JOIN roles as r ON t.`caller-level` = r.id
        WHERE t.id = :ticketid";
$prepare = $db->prepare($sql);
$prepare->execute([
    'ticketid' => $ticketId
]);
$ticket = $prepare->fetch(2);
if (!$ticket) {
    header("location: index.php" );
    exit;
}

$sql = "SELECT n.* FROM `ticket-note` as tn
        INNER JOIN notes as n ON tn.note = n.id
        WHERE ticket = :ticketId ORDER BY note DESC";
$prepare = $db->prepare($sql);
$prepare->execute([
        'ticketId' => $ticketId
]);
$notes = $prepare->fetchAll(2);
$noteCount = $prepare->rowCount();

$customer = $ticket['first'] . " " . $ticket['middel'] . " " . $ticket['last'];

$solved = "nee";
$solvedText = "text-warning";

if ($ticket['solved'] == null || $ticket['solved'] == 0) {
    $solved = "nee";
    $solvedText = "text-warning";
} else {
    $solved = "Ja, Duration: ...";
    $solvedText = "text-success";
}
?>
<main class="overflow-auto vh-100 pb-4">
    <?php
        if (isset($_GET['err'])) {
            echo "<p class='alert-danger h2 p-3 my-2 rounded border border-danger'>{$_GET['err']}</p>";
        } else if (isset($_GET['succ'])) {
                echo "<p class='alert-success h2 p-3 my-2 rounded border border-success'>{$_GET['succ']}</p>";
            }
    ?>
    <h2>TICKET <?=$ticketId?></h2>
    <div class="shadow-sm border p-2 my-3">
        <h3 class="m-0">Klant Gegevens</h3>
        <p><span class="h5">Naam:</span> <?=$customer?></p>
        <p><span class="h5">Bedrijf:</span> <?=$ticket['business']?></p>
        <p><span class="h5">Email:</span> <?=$ticket['email']?></p>
        <p><span class="h5">Telefoon:</span> <?=$ticket['phone']?></p>
    </div>

    <div class="shadow-sm border p-2 my-3">
        <h3 class="m-0">Ticket Gegevens</h3>
        <p><span class="h5">Titel:</span> <?=$ticket['title']?></p>
        <p><span class="h5">Categorie:</span> <?=$ticket['category']?></p>
        <p><span class="h5">Caller level:</span> <?=$ticket['callerLevel']?></p>
        <p><span class="h5">Prioriteit:</span> <?=$ticket['threat']?> - <?=$ticket['threatDuration']?>u</p>
        <p class="<?=$solvedText?>"><span class="h5 text-dark">Opgelost:</span> <?=$solved?></p>
    </div>

    <div class="shadow-sm border p-2 my-3 overflow-auto">
        <h3 class="m-0">Notities</h3>
        <form class="form" action="./includes/controllers/notesController.php" method="post">
            <input type="hidden" name="type" value="addNote">
            <input type="hidden" name="ticketId" value="<?=$ticketId?>">
            <div class="form-group">
                <label for="ticketDescription">Maak een nieuwe ticket:</label>
                <textarea class="form-control" name="ticketDescription" id="ticketDescription" cols="30" rows="5"></textarea>
            </div>
            <input class="btn btn-info" type="submit" value="Ticket Toevoegen">
        </form>
        <?php
        if ($noteCount <= 0) {
            return;
        } else {
            foreach ($notes as $note) {
                echo "
                    <div class=\"border p-1 m-1 my-3\">
                        <p>{$note['description']}</p>
                    </div>
                ";
            }
        }
        ?>
    </div>
</main>