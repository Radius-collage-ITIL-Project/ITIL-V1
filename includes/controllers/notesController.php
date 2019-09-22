<?php
require __DIR__ . '/../config.php';

if ($_SERVER['REQUEST_METHOD'] !== 'POST' ) {
    header("location: ../../ticket.php");
    exit;
}

if ($_POST['type'] === "addnote") {
    //do this
}

if ($_POST['type'] === "editnote") {
    //do this
}

header("location: ../../ticket.php");
exit;