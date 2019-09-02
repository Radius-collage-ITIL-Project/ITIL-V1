<?php
// ophalen van data uit de database
$id = htmlentities($_GET['id']);
require 'menus/header.php';
//selecteren van de data
$sql = 'SELECT id, first, middel, last FROM customer WHERE id = :id';
$prepare = $db->prepare($sql);
$prepare->execute([
    'id' => $id
]);
$customer = $prepare->fetch(2);
//dumpen van de opgehaalde data
var_dump($customer);


?>
    <main>
        <div class="title py-2">
            <h2>Ticket.</h2>
        </div>
        <div class="ticketform">
            <form>
                <h3 class="lead">Deel 2 | Ticket gegevens</h3>
                <div class="form-row border p-2 rounded my-2">
                    <p>Categorie | </p>
                    <div class="dropdown">
                        <button class="btn btn-secondary dropdown-toggle" type="button" id="dropdownMenu2" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                            Dropdown
                        </button>
                        <div class="dropdown-menu" aria-labelledby="dropdownMenu2">
                            <button class="dropdown-item" type="button">Action</button>
                            <button class="dropdown-item" type="button">Another action</button>
                            <button class="dropdown-item" type="button">Something else here</button>
                        </div>
                    </div>
                    <p>Employee | </p>
                    <div class="dropdown">
                        <button class="btn btn-secondary dropdown-toggle" type="button" id="dropdownMenu2" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                            Dropdown
                        </button>
                        <div class="dropdown-menu" aria-labelledby="dropdownMenu2">
                            <button class="dropdown-item" type="button">Action</button>
                            <button class="dropdown-item" type="button">Another action</button>
                            <button class="dropdown-item" type="button">Something else here</button>
                        </div>
                    </div>
                    </div>
                </div>
                <button type="submit" class="btn btn-success">Volgende</button>
            </form>
        </div>
    </main>
<?php
require 'menus/footer.php';