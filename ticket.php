<?php
require __DIR__ . '/menus/header.php';
$ticketId = $_GET['ticketId'];

if (empty($_GET['ticketId'])) {
    header("location: index.php" );
    exit;
}

$sql = "SELECT t.id as ticketId,
               t.title as title,
               c.name as category 
        FROM `tickets` AS t 
        INNER JOIN customers AS s ON t.customerid = s.id
        INNER JOIN categories AS c ON t.category = c.id
        INNER JOIN threats AS th ON t.threat = th.id
        WHERE id = :id";
$prepare = $db->prepare($sql);
$prepare->execute([
    'id' => $ticketId
]);
$ticket = $prepare->fetch(2);
if (!$ticket) {
    header("location: index.php" );
    exit;
}
var_dump($ticket);