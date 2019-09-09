<?php
/**
 * Created by PhpStorm.
 * User: Gebruiker
 * Date: 9-9-2019
 * Time: 09:51
 */
require __DIR__ . '/menus/header.php';
$sql = "SELECT * FROM `tickets` 
	
	WHERE `solved` IS NULL
	
	ORDER BY `created_at` DESC ";
$query = $db->query($sql);
$unsolvedtickets = $query->fetchAll(2);

?>

<main>
    <div class="unsolved-tickets">
        <table class="table">
            <thead class="thead-light">
            <tr>
                <th scope="col">#</th>
                <th scope="col">Title</th>
                <th scope="col">created at</th>
            </tr>
            </thead>
            <tbody>
            <?php
            $count = 1;
            foreach ($unsolvedtickets AS $unsolvedticket) {

                echo '<tr>';
                echo "<th scope=\"row\">$count</th>";
                echo "<td>{$unsolvedticket['title']}</td>";
                echo "<td>{$unsolvedticket['created_at']}</td>";
                echo '</tr>';
                $count++;

            }
            ?>

            </tbody>
        </table>
    </div>

</main>