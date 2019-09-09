<?php
/**
 * Created by PhpStorm.
 * User: Gebruiker
 * Date: 3-9-2019
 * Time: 13:31
 */
require __DIR__ . '/menus/header.php';
$sql = "SELECT * 
	FROM `tickets` 
	
	WHERE `solved` = true
	
	ORDER BY `created_at` DESC ";
$solvedtickets = $db->query($sql)->fetchAll(2);
?>
    <main>
        <div class="solved-tickets">
            <table class="table">
                <thead class="thead-light">
                <tr>
                    <th scope="col">#</th>
                    <th scope="col">Title</th>
                    <th scope="col">created at</th>
                    <th scope="col">solved at</th>
                    <th scope="col">Duration</th>
                </tr>
                </thead>
                <tbody>
                <?php
                $count = 1;
                foreach ($solvedtickets AS $solvedticket) {

                    echo '<tr>';
                    echo "<th scope=\"row\">$count</th>";
                    echo "<td>{$solvedticket['title']}</td>";
                    echo "<td>{$solvedticket['created_at']}</td>";
                    echo "<td>{$solvedticket['solved_at']}</td>";
                    echo "<td>{$solvedticket['duration']}</td>";
                    echo '</tr>';
                    $count++;

                }
                ?>

                </tbody>
            </table>
        </div>

</main>