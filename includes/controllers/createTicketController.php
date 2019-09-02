<?php

require __DIR__ . '/../config.php';

if ($_SERVER['REQUEST_METHOD'] !== 'POST' ) {
    header("location: ../../createTicket.php");
    exit;
}

if ($_POST['type'] === 'ticketcustomerdetails') {
    //invullen van de tabel customer
    $firstName = trim(htmlentities($_POST['firstname']));
    $middelName = trim(htmlentities($_POST['middelname']));
    $lastName = trim(htmlentities($_POST['lastname']));
    $email = trim(htmlentities($_POST['email']));
    $phoneNumber = trim(htmlentities($_POST['phonenumber']));
    $businessName = trim(htmlentities($_POST['businessname']));

    //checks of someting is empty
    if (empty($firstName) || empty($lastName) || empty($email) || empty($phoneNumber) || empty($businessName)) {
        $err = "Er zijn 1 of meer velden niet ingevuld.";
        header("location: ../../createTicket.php?err=$err");
        exit;
    }

    if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $err = "Het opgegeven email is onjuist";
        header("location: ../../createTicket.php?err=$err");
        exit;
    }
}