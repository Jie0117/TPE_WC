<?php
require "DataBase.php";
$db = new DataBase();
if ( isset($_POST['username']) && isset($_POST['password'])) {
    if ($db->dbConnect()) {
        if ($db->signUp("users",  $_POST['username'], $_POST['password'])) {
            echo "Sign Up Success";
        } else echo "The name is wrong.Try another.";
    } else echo "Error: Database connection";
} else echo "All fields are required";
?>
