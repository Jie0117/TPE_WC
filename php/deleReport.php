<?php
require "DataBase.php";
$db = new DataBase();
if ( isset($_POST['id']) ) {
    if ($db->dbConnect()) {
        if ($db->deleReport($_POST['id'])) {
            echo "Delete Success";
        } else echo "Delete failure.";
    } else echo "Error: Database connection";
} else echo "All fields are required";
?>
