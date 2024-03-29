<?php
/**
 * Created by PhpStorm.
 * User: Gebruiker
 * Date: 5-9-2019
 * Time: 11:49
 */
require __DIR__ . '/menus/header.php';
$sql = "SELECT * FROM `tickets`
        WHERE created_at >= CURDATE() 
        AND created_at < DATE_ADD(CURDATE(), 
        INTERVAL 1 DAY 
        )";
$query_today = $db->prepare($sql);
$query_today->execute();
$currentDayTickets = $query_today->fetchAll(2);

?>
<main>
    <div class="ticketsOfToday">
        <table class="table">
            <thead class="thead-light">
            <tr>
                <th scope="col">Ticket-Id</th>
                <th scope="col">Title</th>
                <th scope="col">Created_at</th>


            </tr>
            </thead>
            <tbody>
            <?php
            $count = 1;
            foreach($currentDayTickets AS $ticketOfToday) {


                    echo '<tr>';
                    echo "<td>{$ticketOfToday['id']}</td>";
                    echo "<td>{$ticketOfToday['title']}</td>";
                    echo "<td>{$ticketOfToday['created_at']}</td>";

                    echo '</tr>';
                    $count++;



            }
            ?>

            </tbody>
        </table>
    </div>

</main>