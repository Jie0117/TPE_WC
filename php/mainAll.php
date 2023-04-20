<?php
require "DataBase.php";
$db = new DataBase();
    if (isset($_POST['MaxLatitude']) && isset($_POST['MinLatitude']) && isset($_POST['MaxLongitude']) && isset($_POST['MinLongitude']) && isset($_POST['typetwo'])) {    
        if ($db->dbConnect()) {

        $db->mainAll($_POST['MaxLatitude'] , $_POST['MinLatitude'],$_POST['MaxLongitude'], $_POST['MinLongitude'], $_POST['typetwo']);

    } else echo "Error: Database connection";
} else echo "All field required";
?>
