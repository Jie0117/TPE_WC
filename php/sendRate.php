<?php
require "DataBase.php";
$db = new DataBase();
if ( isset($_POST['username']) && isset($_POST['toid']) && isset($_POST['rate'])) {
    if ($db->dbConnect()) {
        if ($db->sendRate($_POST['username'], $_POST['toid'], $_POST['rate'])) {
            echo "Send Success";
        } else echo "Send failure.";
    } else echo "Error: Database connection";
} else echo "All fields are required";
?>
