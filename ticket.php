<?php

if (empty($_GET['ticketid']) || empty($_GET['customerid'])) {
    //header("location: index.php");
    exit;
}

$ticketId = $_GET['ticketid'];
$customerId = $_GET['customerid'];

require __DIR__ . '/menus/header.php';
?>
    <main>
        <?php

        echo $customerId . " " . $ticketId;

        if(isset($_GET['succ'])) {
            echo "<p>{$_GET['succ']}</p>";
        }
        ?>
    </main>
<?php
require 'menus/footer.php';