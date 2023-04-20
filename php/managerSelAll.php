<?php
require "DataBase.php";
$db = new DataBase();
if ( isset($_POST['name']) && isset($_POST['section'])  && isset($_POST['village']) ) {
    if ($db->dbConnect()) {

        $db->managerSelAll($_POST['name'],$_POST['section'],$_POST['village']);
           
    } else echo "Error: Database connection";
} else echo "All fields are required";
?>
