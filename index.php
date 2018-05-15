
<html>
<?php
include_once 'header_new.php';
?>

<section class="w3-container">
    <div class="w3-container">
        <h2>Home</h2>
        <?php
        if (isset($_SESSION['u_log'])) {
            echo "<p>Hi, " . $_SESSION['u_first'] . " " . $_SESSION['u_last'] . " . You are logged in!</p>";
            ?>  <a href="fileupload.php" class="w3-bar-item w3-button w3-padding-large w3-black">Upload Data</a>
            <a href="meta_explorer.php" class="w3-bar-item w3-button w3-padding-large w3-black">edit Meta</a>
            <a href="delete.php" class="w3-bar-item w3-button w3-padding-large w3-black">Delete Data</a>
            <a href="visual.php" class="w3-bar-item w3-button w3-padding-large w3-black">Analyze Data</a>
            <a href="download.php" class="w3-bar-item w3-button w3-padding-large w3-black">Data download</a>
                    <?php
        } else {
            echo "Please sign up or log in you account";
        }
        ?>
        

    </div>
</section>

<?php
include_once 'footer.php';
?>
</html>

