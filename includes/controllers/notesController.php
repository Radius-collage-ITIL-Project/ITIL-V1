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
        $err = "De description is niet ingevuld!";
        header("location: http://localhost/ITIL-V1/ticket.php?ticketId=$ticketId&err=$err");
        exit;
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

    $succ = "Notitie aangemaakt!";
    header("location: http://localhost/ITIL-V1/ticket.php?ticketId=$ticketId&succ=$succ");
    exit;
}

if ($_POST['type'] === "editnote") {
    //do this
}

header("location: ../../ticket.php");
exit;