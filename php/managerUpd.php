<?php
require "DataBase.php";
$db = new DataBase();
if ( isset($_POST['Totype']) && isset($_POST['Tovillage']) && isset($_POST['Toid']) && isset($_POST['Toname']) && isset($_POST['Toaddress']) && isset($_POST['Administration']) && isset($_POST['Latitude']) && isset($_POST['Longitude']) && isset($_POST['Grade']) && isset($_POST['Totypetwo']) ) {
    if ($db->dbConnect()) {

        // $db->managerSel($_POST['name']);
        // $db->managerUpd($Totype,$Tovillage,$Toid,$Toname,$Toaddress,$Administration,$Latitude,$Longitude,$Grade,$Totypetwo)
        if($db->managerUpd($_POST['Totype'],$_POST['Tovillage'],$_POST['Toid'],$_POST['Toname'],$_POST['Toaddress'],$_POST['Administration'],$_POST['Latitude'],$_POST['Longitude'],$_POST['Grade'],$_POST['Totypetwo']))
        echo "Change Success.";
        else echo "Change failure.";
    
    
    } else echo "Error: Database connection";
} else echo "All fields are required";
?>
