<?php
require "DataBase.php";
$db = new DataBase();

    if ($db->dbConnect()) {

        $db->selAllreport();
         
    }else echo "connect wrong";

?>
