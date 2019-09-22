<?php
require __DIR__ . '/../config.php';

if ($_SERVER['REQUEST_METHOD'] !== 'POST' ) {
    header("location: ../../ticket.php");
    exit;
}

if ($_POST['type'] === "addNote") {
    $ticketId = trim(htmlentities($_POST['ticketId']));
    $description = trim(htmlentities($_POST['ticketDescription']));

    if (empty($description) || empty($ticketId)) {
        //header
        //exit
    }

    $sql = "INSERT INTO notes (description) VALUES (:description)";
    $prepare = $db->prepare($sql);
    $prepare->execute([
        'description' => $description
    ]);

    $noteId = $db->lastInsertId();

    $sql = "INSERT INTO `ticket-note` (ticket, note) VALUES (:ticket, :note)";
    $prepare = $db->prepare($sql);
    $prepare->execute([
        'ticket' => $ticketId,
        'note' => $noteId
    ]);
}

if ($_POST['type'] === "editnote") {
    //do this
}

header("location: ../../ticket.php");
exit;