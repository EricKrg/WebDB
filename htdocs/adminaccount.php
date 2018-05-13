<?php
include_once 'header.php';
include_once 'D:/geo406/htdocs/php_includes/db_connect.inc.php';
?>

<section class="main-container">
    <div class="main-wrapper">
        <h2>Manage all user data </h2>
        <form action="/php_includes/db_admin_show.inc.php" method="POST">
            <?php
            include_once 'D:/geo406/htdocs/php_includes/db_connect.inc.php';
            // do sql select query
            $sql = "SELECT * FROM person";
            // process the query
            $result = mysqli_query($conn, $sql);
            if (!$result) {
                exit("Query failed: " . mysqli_error($conn));
            }

            // Request tuples from data base and create checkbox for every user 
            if (mysqli_num_rows($result) > 0) {
                while ($row = mysqli_fetch_assoc($result)) {
                    //echo $row["id"] . ": " . $row["lastname"] . ", " . $row["firstname"] . "<br>";
                    /* FUNKTIONIERT:  echo "<input type='checkbox' value='{$row['id']}'>" 
                      . " " . $row['firstname'] . " "
                      . $row['lastname'] . "<br>" ;

                      ALTERNATIV:  echo '<form action="/php_includes/db_admin_show.inc.php" method="POST">
                      <input type="checkbox" name="show[]" value=' . $row['id'] . '>'
                      . " " . $row['firstname'] . " " . $row['lastname'] . '
                      </form>';
                     * 
                     */

                    echo '<div>
            <input type="checkbox" name="cbox[]" value=' . $row['id'] . '>'
                    . " " . $row['firstname'] . " " . $row['lastname'] . '</div>';
                }
            } else {
                echo "0 Ergebnisse";
            }
            ?> 
            <button type="submit" name="show">Show User Details</button>
        </form>



        <form action="/php_includes/db_admin_insert.inc.php" method="POST">
            <button type="submit" name="insert">Insert New User</button>
        </form>
        <form action="/php_includes/db_admin_edit.inc.php" method="POST">
            <button type="submit" name="edit">Edit User</button>
        </form>


        <form action="/php_includes/db_admin_delete.inc.php" id="carform">
            <select name="users[]" form="carform">
            <?php
            include_once 'D:/geo406/htdocs/php_includes/db_connect.inc.php';
            // do sql select query
            $sql = "SELECT * FROM person";
            // process the query
            $result = mysqli_query($conn, $sql);
            if (!$result) {
                exit("Query failed: " . mysqli_error($conn));
            }

            // Request tuples from data base and create checkbox for every user 
            if (mysqli_num_rows($result) > 0) {
                while ($row = mysqli_fetch_assoc($result)) {

                    echo '<div> 
             <option "value=' . $row['id'] . '>'
                . " " . $row['id'] . " " . $row['firstname'] . " " . $row['lastname'] 
                            . '</option>'
                            .'</div>';
                }
            } else {
                echo "0 Ergebnisse";
            }
            ?> 
                </select>
        <button type="submit" name="delete">Delete User</button>
        </form>

    </div>

</section>

<?php
include_once 'footer.php';
