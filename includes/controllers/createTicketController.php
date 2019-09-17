<?php
require __DIR__ . '/../config.php';

if ($_SERVER['REQUEST_METHOD'] !== 'POST' ) {
    header("location: ../../createCustomer.php");
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
        header("location: ../../createCustomer.php?err=$err");
        exit;
    }

    if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $err = "Het opgegeven email is onjuist";
        header("location: ../../createCustomer.php?err=$err");
        exit;
    }

    if (!ctype_digit($phoneNumber) || strlen($phoneNumber) != 10) {
        $err = "Telefoon nummer is niet correct.";
        header("location: ../../createCustomer.php?err=$err");
        exit;
    }

    $sql = "INSERT INTO `customers`(`id`, `first`, `middel`, `last`, `email`, `phone`, `business`) 
            VALUES (:id, :first, :middel, :last, :email, :phone, :business)";
    $prepare = $db->prepare($sql);
    $prepare->execute([
       'id'        => null,
       'first'     => $firstName,
       'middel'    => $middelName,
       'last'      => $lastName,
       'email'     => $email,
       'phone'     => $phoneNumber,
       'business'  => $businessName
    ]);

    $customerId = $db->lastInsertId();

    $succ = "Klant gegevens opgeslagen";
    header("location: ../../createTicket.php?customerId=$customerId");
    exit;
}

if ($_POST['type'] === 'ticketdetails') {
    $customerId = trim(htmlentities($_POST['customerId']));
    $title = trim(htmlentities($_POST['title']));
    $category = trim(htmlentities($_POST['category']));
    $threat = trim(htmlentities($_POST['threat']));
    $caller = trim(htmlentities($_POST['caller-level']));
    $status = trim(htmlentities($_POST['solved']));


    //checks of someting is empty
    if (empty($title) || empty($threat) || empty($category) || empty($caller) || empty($customerId) || empty($status)) {
        $err = "Er zijn 1 of meer velden niet ingevuld.";
        header("location: ../../createTicket.php?customerId=$customerId&err=$err");
        exit;
    }
//    if ($status === 0) {
//        $status = NULL;
//    }

    if ($_POST['solved'] = '1') {
        $date = date('y-m-d H:i:s', time());


        $sql = "INSERT INTO tickets (customerid, title, threat, `caller-level`, category, solved, solved_at) 
            VALUES (:customerid, :title, :threat, :callerlevel, :category, :solved, :solvedat)";
        $prepare = $db->prepare($sql);
        $prepare->execute([
            'customerid' => $customerId,
            'title' => $title,
            'threat' => $threat,
            'callerlevel' => $caller,
            'category' => $category,
            'solved' => $status,
            'solvedat' => $date
        ]);
        $succ = "ticket voltooid";
        header("location: ../../index.php?succ=$succ");
        exit;
    }
    else {
        $date = date('y-m-d H:i:s', time());


        $sql = "INSERT INTO tickets (customerid, title, threat, `caller-level`, category, solved) 
            VALUES (:customerid, :title, :threat, :callerlevel, :category, :solved)";
        $prepare = $db->prepare($sql);
        $prepare->execute([
            'customerid' => $customerId,
            'title' => $title,
            'threat' => $threat,
            'callerlevel' => $caller,
            'category' => $category,
            'solved' => $status,
        ]);
        $succ = "ticket NIET voltooid";
//        header("location: ../../index.php?succ=$succ");
        echo 'niet gelukt';
        exit;
    }


}
header("location: ../../index.php");
exit;