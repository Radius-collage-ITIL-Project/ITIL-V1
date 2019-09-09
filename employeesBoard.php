<?php
/**
 * Created by PhpStorm.
 * User: Gebruiker
 * Date: 2-9-2019
 * Time: 11:06
 */
require __DIR__ . '/menus/header.php';
$sql = "SELECT * FROM employees ORDER BY solved_tickets DESC ";
$employees = $db->query($sql)->fetchAll(2);
?>

        <main>
            <div class="employee information">
                <table class="table">
                    <thead class="thead-light">
                    <tr>
                        <th scope="col">#</th>
                        <th scope="col">voornaam</th>
                        <th scope="col">achternaam</th>
                        <th scope="col">Tickets afgehandeld</th>
                    </tr>
                    </thead>
                    <tbody>
                            <?php
                            $count = 1;
                            foreach ($employees AS $employee) {

                                echo '<tr>';
                                echo "<th scope=\"row\">$count</th>";
                                echo "<td>{$employee['first']}</td>";
                                echo "<td>{$employee['middel']} {$employee['last']}</td>";
                                echo "<td>{$employee['solved_tickets']}</td>";
                                echo '</tr>';
                                $count++;

                            }
                            ?>

                    </tbody>
                </table>
            </div>

        </main>