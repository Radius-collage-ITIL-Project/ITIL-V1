<?php
require __DIR__ . '/menus/header.php';
?>
    <main>
        <?php
            if(isset($_GET['succ'])) {
                echo "<p>{$_GET['succ']}</p>";
            }
        ?>
    </main>
<?php
require 'menus/footer.php';