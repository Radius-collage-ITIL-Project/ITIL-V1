<?php
require 'menus/header.php';
?>
    <main>
        <div class="title py-2">
            <h2>Ticket Aanmaken.</h2>
        </div>
        <div class="ticketform">
            <form>
                <h3 class="lead">Deel 1 | Klanten gegevens</h3>
                <div class="form-row border p-2 rounded my-2">
                    <div class="form-group col-md-5">
                        <label for="firstname">Voornaam</label>
                        <input type="text" class="form-control" id="firstname" placeholder="Bert" required>
                    </div>

                    <div class="form-group col-md-2">
                        <label for="middelname">Tussenvoegsel</label>
                        <input type="text" name="middelname" class="form-control" id="middelname" placeholder="v/d">
                    </div>

                    <div class="form-group col-md-5">
                        <label for="lastname">Achternaam</label>
                        <input type="text" name="lastname" class="form-control" id="lastname" placeholder="weerhout" required>
                    </div>

                    <div class="form-group col-md-6">
                        <label for="email">E-mail</label>
                        <input type="email" name="email" class="form-control" id="email" placeholder="example@hotmail.com" required>
                    </div>

                    <div class="form-group col-md-6">
                        <label for="phonenumber">Telefoon nummer.</label>
                        <input type="text" name="phonenumber" class="form-control" id="phonenumber" placeholder="0637379938" required>
                    </div>

                    <div class="form-group col-md-12">
                        <label for="companyname">Bedrijfs naam</label>
                        <input type="text" name="companyname" class="form-control" id="companyname" placeholder="business of example" required>
                    </div>
                </div>
                <button type="submit" class="btn btn-success">Volgende</button>
            </form>
        </div>
    </main>
<?php
require 'menus/footer.php';