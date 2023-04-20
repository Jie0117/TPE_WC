<?php
require "DataBase.php";
$db = new DataBase();
if ( isset($_POST['name']) ) {
    if ($db->dbConnect()) {

        $db->reportCount($_POST['name']);
         
    }else echo "connect wrong";
} 
?>