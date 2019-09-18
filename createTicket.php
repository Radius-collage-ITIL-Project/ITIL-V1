<?php
// ophalen van data uit de database
$id = htmlentities($_GET['customerId']);
$id = 1;
require 'menus/header.php';
//selecteren van de data
$sql = 'SELECT id, first, middel, last FROM customers WHERE id = :id';
$prepare = $db->prepare($sql);
$prepare->execute([
    'id' => $id
]);
$customer = $prepare->fetch(2);
//dumpen van de opgehaalde data

$sql = 'SELECT * FROM categories';
$prepare = $db->prepare($sql);
$prepare->execute([ ]);
$categories = $prepare->fetchAll(2);
//dumpen van de opgehaalde data

$sql = 'SELECT * FROM threats';
$prepare = $db->prepare($sql);
$prepare->execute();
$threats = $prepare->fetchAll(2);
//dumpen van de opgehaalde data

$sql = 'SELECT * FROM roles';
$prepare = $db->prepare($sql);
$prepare->execute();
$callerlvl = $prepare->fetchAll(2);
//dumpen van de opgehaalde data

$sql = 'SELECT * FROM tickets';
$prepare = $db->prepare($sql);
$prepare->execute();
$status = $prepare->fetchAll(2);
//dumpen van de opgehaalde data


/*
$a = new DateTime('08:00');
$b = new DateTime('16:00');
$interval = $a->diff($b);

echo $interval->format("%H");


$now = new DateTime();
echo $now->format('Y-m-d H:i:s');    // MySQL datetime format
echo $now->getTimestamp();



*/
//Solved at ---
$sql = 'SELECT created_at FROM tickets WHERE id = 1';
$prepare = $db->prepare($sql);
$prepare->execute();
$ticket = $prepare->fetch(2);
//$solved = $date->diff($date);
//echo $solved->Y;
$createdAt = new DateTime($ticket['created_at']);
$today = new DateTime(date("y-m-d H:i:s"));
$solved = $today->diff($createdAt);
echo ('Solution duration: '),$solved->d . "-" . $solved->m . "-" . $solved->y . " " . $solved->h . ":" . $solved->i . ":" . $solved->s ;

?>
    <main>
        <div class="title py-2">
            <h2>Ticket.</h2>
        </div>
        <div class="ticketform">
            <form class="was-validated" action="includes/controllers/createTicketController.php" method="post">
                <input type="hidden" name="type" value="ticketdetails">
                <input type="hidden" name="customerId" value="<?=$id?>">
                <h3 class="lead">Deel 2 | Ticket gegevens</h3>
                <div class="form-row border p-2 rounded my-2">
                    <div class="form-group col-12">
                        <label for="title">Titel</label>
                        <input class="form-control" type="text" name="title" required>
                    </div>
                    <div class="form-group col-md-6">
                        <label for="category">Categorie</label>
                        <select class="custom-select" name="category" required>
                            <option value="">Selecteer een categorie</option>
                            <?php
                                foreach($categories as $category){
                                    echo "<option value=\"{$category['id']}\">{$category['name']}</option>";
                                }
                            ?>
                        </select>
                    </div>
                    <div class="form-group col-md-6">
                        <label for="threatlevel">Threat Level</label>
                            <select class="custom-select" name="threat" required>
                                <option value="">Kies een threat level</option>
                                <?php
                                foreach($threats as $threat){
                                    echo "<option value=\"{$threat['id']}\">{$threat['threat']} - {$threat['max-duration']}u</option>";
                                }
                                ?>
                            </select>
                            <div class="invalid-feedback">Example invalid custom select feedback</div>
                        </div>

                        <div class="form-group col-md-12">
                            <label for="caller">Caller-level</label>
                            <select class="custom-select" name="caller-level" required>
                                <option value="1">Selecteer caller-level</option>
                                <?php
                                foreach ($callerlvl as $callerlvl){
                                    echo "<option value=\"{$callerlvl['id']}\">{$callerlvl['name']}</option>";
                                }
                                ?>
                            </select>
                        </div>
                        <div class="form-group col-md-12">
                            <label for="solved">status</label>
                            <select class="custom-select" name="solved" required>
                                <option value="">Ticket Status</option>
                                <option value="1">unsolved</option>
                                <option value="2">solved</option>
                            </select>
                        </div>
                    </div>
                </div>
                <button type="submit" class="btn btn-success">Volgende</button>
            </form>
        </div>
    </main>
<?php
require 'menus/footer.php';