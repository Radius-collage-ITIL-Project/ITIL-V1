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
               s.*
        FROM `tickets` as t
        LEFT JOIN customers AS s ON t.customerid = s.id
        LEFT JOIN categories AS c ON t.category = c.id
        LEFT JOIN threats AS th ON t.threat = th.id
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

$customer = $ticket['first'] . " " . $ticket['middel'] . " " . $ticket['last'];
?>
<main>
    <h2>TICKET <?=$ticketId?></h2>
    <div class="shadow-sm border p-2">
        <h3 class="m-0">Klant Gegevens</h3>
        <p>Naam: <?=$customer?></p>
        <p>Bedrijf: <?=$ticket['business']?></p>
        <p>Email: <?=$ticket['email']?></p>
        <p>Telefoon: <?=$ticket['phone']?></p>
    </div>
</main>
