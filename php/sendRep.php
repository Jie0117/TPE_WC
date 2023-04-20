<?php
require "DataBase.php";
$db = new DataBase();
if ( isset($_POST['username']) && isset($_POST['toid']) && isset($_POST['commond'])) {
    if ($db->dbConnect()) {
        if ($db->sendRep($_POST['username'], $_POST['toid'], $_POST['commond'])) {
            echo "Send Success";
        } else echo "Send failure.";
    } else echo "Error: Database connection";
} else echo "All fields are required";
?>
