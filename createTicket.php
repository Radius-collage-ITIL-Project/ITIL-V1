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
                            <label for="caller">Lijn Niveau</label>
                            <select class="custom-select" name="caller-level" required>
                                <option value="1">1e lijn</option>
                                <option value="2">2e Lijn</option>
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