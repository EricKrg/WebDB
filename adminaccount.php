<?php
include_once 'header_new.php';
include (dirname(__DIR__).'/htdocs/php_includes/db_connect.inc.php');
?>

<section class="w3-container">
    <div class="w3-panel">
        <h2>Manage all user data </h2>
        <p>
        <form action="/php_includes/db_admin_show.inc.php" method="POST">
            <?php
            //include_once 'htdocs/php_includes/db_connect.inc.php';
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
            <input type="checkbox" name="cbox[]" value=' . $row['id'] . '>'
                    . " " . $row['firstname'] . " " . $row['lastname'] . '</div>';
                }
            } else {
                //if no check box is checked, print:
                echo "No results";
            }
            ?> 
            <button class = "w3-black w3-button" type="submit" name="show">Show User Details</button>
        </form>
        </p>



        <p>


            <!-- Admin form for editing a user 
                    <form action="/php_includes/db_admin_edit.inc.php" method="POST">
                <button type="submit" name="TEST edit">TEST Edit User</button>
            </form>
            -->
        <form action="/php_includes/db_admin_edit.inc.php" id="editform">
            <select name="edit_users[]" form="editform">
                <?php
                include_once '/php_includes/db_connect.inc.php';
                // do sql select query
                $sql_edit_form = "SELECT * FROM person";
                // process the query
                $result_edit_form = mysqli_query($conn, $sql_edit_form);
                if (!$result_edit_form) {
                    exit("Query failed: " . mysqli_error($conn));
                }
                // Request tuples from data base and create checkbox for every user 
                if (mysqli_num_rows($result_edit_form) > 0) {
                    while ($row = mysqli_fetch_assoc($result_edit_form)) {
                        echo '<div> 
             <option "value=' . $row['id'] . '>'
                        . " " . $row['id'] . " " . $row['firstname'] . " " . $row['lastname']
                        . '</option>'
                        . '</div>';
                    }

                    mysqli_close($conn);
                } else {
                    echo "No results";
                }
                ?> 
            </select>
            <button class="w3-black w3-button" type="submit" name="edit_button">edit User</button>
        </form>
        </p>



        <p>
            <!-- Admin form for deleting a user -->
        <form action="/php_includes/db_admin_delete.inc.php" id="deleteform">
            <select name="delete_users[]" form="deleteform">
                <?php
                include_once '/php_includes/db_connect.inc.php';
                // do sql select query
                $sql_del_form = "SELECT * FROM person";
                // process the query
                $result_del_form = mysqli_query($conn, $sql_del_form);
                if (!$result_del_form) {
                    exit("Query failed: " . mysqli_error($conn));
                }

                // Request tuples from data base and create checkbox for every user 
                if (mysqli_num_rows($result_del_form) > 0) {
                    while ($row = mysqli_fetch_assoc($result_del_form)) {

                        echo '<div> 
             <option "value=' . $row['id'] . '>'
                        . " " . $row['id'] . " " . $row['firstname'] . " " . $row['lastname']
                        . '</option>'
                        . '</div>';
                    }

                    mysqli_close($conn);
                } else {
                    echo "No results.";
                }
                ?> 
            </select>
            <button class = "w3-red w3-button" type="submit" name="delete_button">Delete User</button>
        </form>
        </p>
        <p>
            <!-- Admin form for inserting a new user into the database.
            The conditions for filling out the form are the same like 
            for signing up as a new user -->
        <form action="/php_includes/db_admin_insert.inc.php" method="POST">
            <button class="w3-black w3-button" type="submit" name="insert">Insert New User</button>
        </form>

        </p>
    </div>

</section>

<?php
include_once 'footer.php';
