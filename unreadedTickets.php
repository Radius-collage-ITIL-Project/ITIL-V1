<?php
/**
 * Created by PhpStorm.
 * User: Gebruiker
 * Date: 5-9-2019
 * Time: 11:20
 */

require __DIR__ . '/menus/header.php';
$sql = "SELECT t.id as id, 
               t.title as title, 
               c.name as category, 
               t.threat as threat, 
               t.created_at,
               th.`threat` as threatlvl
FROM tickets as t 
INNER JOIN categories as c ON t.category = c.id
INNER JOIN threats as th ON t.threat = th.id
ORDER BY `created_at` DESC
";
$query = $db->query($sql);
$tickets = $query->fetchAll(2);
?>
<main>
    <div class="unreaded-tickets">
        <table class="table">
            <thead class="thead-light">
            <tr>
                <th scope="col">Ticket-Id</th>
                <th scope="col">Title</th>
                <th scope="col">Category</th>
                <th scope="col">Threat level</th>
                <th scope="col">Created_at</th>


            </tr>
            </thead>
            <tbody>
            <?php
            $count = 1;
            foreach ($tickets AS $ticket) {

                echo '<tr>';
                echo "<td>{$ticket['id']}</td>";
                echo "<td>{$ticket['title']}</td>";
                echo "<td>{$ticket['category']}</td>";
                echo "<td>{$ticket['threatlvl']}</td>";
                echo "<td>{$ticket['created_at']}</td>";

                echo '</tr>';
                $count++;

            }
            ?>

            </tbody>
        </table>
    </div>

</main>
