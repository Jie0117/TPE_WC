
<?php
require "DataBase.php";
$db = new DataBase();

    if ($db->dbConnect()) {

        $db->newID();
         
    }else echo "connect wrong";

?>