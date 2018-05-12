<?php
include_once 'header.php';
?>

<section class="main-container">
    <div class="main-wrapper">
        <h2>Home</h2>
        <?php
        if (isset($_SESSION['u_log'])) {
            echo "<p>Hi, " . $_SESSION['u_first'] . " " . $_SESSION['u_last'] . " . You are logged in!</p>";
        } else {
            echo "Please sign up or log in you account";
        }
        ?>
        

    </div>
</section>

<?php
include_once 'footer.php';
?>


