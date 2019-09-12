<?php
/**
 * Created by PhpStorm.
 * User: Gebruiker
 * Date: 5-9-2019
 * Time: 11:20
 */

require __DIR__ . '/menus/header.php';

if (isset($_GET['category'])) {
    $sql = "SELECT t.id as id, 
               t.title as title, 
               c.name as category, 
               t.threat as threat, 
               t.created_at,
               th.`threat` as threatlvl
FROM tickets as t 
INNER JOIN categories as c ON t.category = c.id
INNER JOIN threats as th ON t.threat = th.id
WHERE category = :id";
    $prepare = $db->prepare($sql);
    $prepare->execute([
            'id' => $_GET['category']
    ]);
}
else {
$sql = "SELECT t.id as id, 
               t.title as title, 
               c.name as category, 
               t.threat as threat, 
               t.created_at,
               th.`threat` as threatlvl
FROM tickets as t 
INNER JOIN categories as c ON t.category = c.id
INNER JOIN threats as th ON t.threat = th.id";
    $prepare = $db->prepare($sql);
    $prepare->execute();
}
$tickets = $prepare->fetchAll(2);

/* cat toevoegen */
$sql = "SELECT DISTINCT
              c.id,
              c.name as category
FROM tickets as t 
INNER JOIN categories as c ON t.category = c.id
INNER JOIN threats as th ON t.threat = th.id";

$prepare = $db->prepare($sql);
$prepare->execute();

$categories = $prepare->fetchAll(2);

?>
<main>
    <div class="unreaded-tickets">
        <table class="table">
            <thead class="thead-light">
            <tr>
                <th scope="col">Ticket-Id</th>
                <th scope="col">Title</th>

                    <th  <div class="dropdown">
                        <button class="btn btn-secondary dropdown-toggle" type="button" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                            Dropdown button
                        </button>

                        <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
                            <?php
                            foreach ($categories as $category){
                                echo "<a href=unreadedTickets.php?category= {$category['id']}> {$category['category']}</a>";

                            }
                            ?>

                        </div>
                    </div>
                </th>

                <th scope="col">Threat level</th>
                <th scope="col">Created_at</th>


            </tr>
            </thead>
            <tbody>
            <?php
            foreach ($tickets AS $ticket) {
                $count = 1;

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

            </body>

            </tbody>
        </table>
</main>

<?php
require 'menus/footer.php';