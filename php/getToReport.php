<?php
require "DataBase.php";
$db = new DataBase();
if ( isset($_POST['id']) ) {
    if ($db->dbConnect()) {

        $db->getToReport($_POST['id']);
         
    }else echo "connect wrong";
} 


?>