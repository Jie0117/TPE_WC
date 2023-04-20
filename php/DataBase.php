<?php
require "DataBaseConfig.php";

class DataBase
{
    public $connect;
    public $data;
    private $sql;
    protected $servername;
    protected $username;
    protected $password;
    protected $databasename;

    public function __construct()
    {
        $this->connect = null;
        $this->data = null;
        $this->sql = null;
        $dbc = new DataBaseConfig();
        $this->servername = $dbc->servername;
        $this->username = $dbc->username;
        $this->password = $dbc->password;
        $this->databasename = $dbc->databasename;
    }

    function dbConnect()
    {
        $this->connect = mysqli_connect($this->servername, $this->username, $this->password, $this->databasename);
        return $this->connect;
    }

    function prepareData($data)
    {
        return mysqli_real_escape_string($this->connect, stripslashes(htmlspecialchars($data)));
    }

    function logIn($table, $username, $password)
    {
        $username = $this->prepareData($username);
        $password = $this->prepareData($password);
        $this->sql = "select * from " . $table . " where username = '" . $username . "'";
        $result = mysqli_query($this->connect, $this->sql);
        $row = mysqli_fetch_assoc($result);
        if (mysqli_num_rows($result) != 0) {
            $dbusername = $row['username'];
            $dbpassword = $row['password'];
            if ($dbusername == $username && password_verify($password, $dbpassword)) {
                $login = true;
            } else $login = false;
        } else $login = false;

        return $login;
    }

    function signUp($table, $username, $password)
    {
        
        $username = $this->prepareData($username);
        $password = $this->prepareData($password);
        
        $password = password_hash($password, PASSWORD_DEFAULT);
        $this->sql =
            "INSERT INTO " . $table . " ( username, password) VALUES ('" . $username . "','" . $password . "')";
        if (mysqli_query($this->connect, $this->sql)) {
            return true;
        } else return false;
    }

    //用名字選廁所
    function selName($name)
    {
        $name = $this->prepareData($name);
        // select *,AVG(Rate) AS AVGRate from `廁所總表` NATURAL JOIN `區里對照表` NATURAL JOIN `區碼對照表` NATURAL JOIN `評分` where To_Name = '民生社區中心體育館11F'
        $this->sql = "select *,AVG(Rate) AS AVGRate from `廁所總表` NATURAL JOIN `區里對照表` NATURAL JOIN `區碼對照表` NATURAL JOIN `評分` where To_Name = '" . $name . "'";
        
        mysqli_query($this->connect,"SET NAMES 'UTF8'");
        
        $result = mysqli_query($this->connect, $this->sql);
        
        $arr = array();
        // 输出每行数据
        while($row = $result->fetch_assoc()) {
            $count=count($row);//不能在循环语句中，由于每次删除row数组长度都减小
            for($i=0;$i<$count;$i++){
                unset($row[$i]);//删除冗余数据
            }
            array_push($arr,$row);
 
        }

        echo json_encode($arr,JSON_UNESCAPED_UNICODE);//json编码

    }
    function getToReport($id)
    {
        $id = $this->prepareData($id);
        // SELECT * FROM `報修`WHERE To_ID=36
        $this->sql = "SELECT * FROM `報修`WHERE To_ID=".$id." ORDER BY `報修`.`Time` ASC";
        // $this->sql = " SELECT * FROM `報修`WHERE To_ID=36";
        mysqli_query($this->connect,"SET NAMES 'UTF8'");
        
        $result = mysqli_query($this->connect, $this->sql);
        
        $arr = array();
        // 输出每行数据
        while($row = $result->fetch_assoc()) {
            $count=count($row);//不能在循环语句中，由于每次删除row数组长度都减小
            for($i=0;$i<$count;$i++){
                unset($row[$i]);//删除冗余数据
            }
            array_push($arr,$row);
 
        }

        echo json_encode($arr,JSON_UNESCAPED_UNICODE);//json编码

    }
    
    function reportCount($name)
    {
        $name = $this->prepareData($name);
        // SELECT COUNT(*) FROM `報修` WHERE To_ID=2
        $this->sql = "SELECT COUNT(*) AS COUNT FROM `報修` WHERE To_ID='" . $name . "'";
        
        mysqli_query($this->connect,"SET NAMES 'UTF8'");
        
        $result = mysqli_query($this->connect, $this->sql);
        
        $arr = array();
        // 输出每行数据
        while($row = $result->fetch_assoc()) {
            $count=count($row);//不能在循环语句中，由于每次删除row数组长度都减小
            for($i=0;$i<$count;$i++){
                unset($row[$i]);//删除冗余数据
            }
            array_push($arr,$row);
 
        }

        echo json_encode($arr,JSON_UNESCAPED_UNICODE);//json编码
    }

    function mainAll($MaxLatitude,$MinLatitude,$MaxLongitude,$MinLongitude,$typetwo)
    {
        $MaxLatitude = $this->prepareData($MaxLatitude);
        $MinLatitude = $this->prepareData($MinLatitude);
        $MaxLongitude = $this->prepareData($MaxLongitude);
        $MinLongitude = $this->prepareData($MinLongitude);
        $typetwo = $this->prepareData($typetwo);

        $this->sql = "select * from `廁所總表` where Latitude BETWEEN '" . $MinLatitude . "' and '" . $MaxLatitude . "' 
        AND Longitude BETWEEN " . $MinLongitude . " and " . $MaxLongitude . "
        and  To_Type2 = " . $typetwo . "";
        
        
        mysqli_query($this->connect,"SET NAMES 'UTF8'");
        
        $result = mysqli_query($this->connect, $this->sql);
        
        $arr = array();
        // 输出每行数据
        while($row = $result->fetch_assoc()) {
            $count=count($row);//不能在循环语句中，由于每次删除row数组长度都减小
            for($i=0;$i<$count;$i++){
                unset($row[$i]);//删除冗余数据
            }
            array_push($arr,$row);
 
        }

        echo json_encode($arr,JSON_UNESCAPED_UNICODE);//json编码

    }

    function mainSel($MaxLatitude,$MinLatitude,$MaxLongitude,$MinLongitude,$typetwo)
    {
        $MaxLatitude = $this->prepareData($MaxLatitude);
        $MinLatitude = $this->prepareData($MinLatitude);
        $MaxLongitude = $this->prepareData($MaxLongitude);
        $MinLongitude = $this->prepareData($MinLongitude);
        $typetwo = $this->prepareData($typetwo);

        $this->sql = "select * from `廁所總表` where Latitude BETWEEN '" . $MinLatitude . "' and '" . $MaxLatitude . "' 
        AND Longitude BETWEEN " . $MinLongitude . " and " . $MaxLongitude . "
        and  To_Type2 = '" . $typetwo . "'";
        
        
        mysqli_query($this->connect,"SET NAMES 'UTF8'");
        
        $result = mysqli_query($this->connect, $this->sql);
        
        $arr = array();
        // 输出每行数据
        while($row = $result->fetch_assoc()) {
            $count=count($row);//不能在循环语句中，由于每次删除row数组长度都减小
            for($i=0;$i<$count;$i++){
                unset($row[$i]);//删除冗余数据
            }
            array_push($arr,$row);
 
        }

        echo json_encode($arr,JSON_UNESCAPED_UNICODE);//json编码

    }

    //發送評分
    function sendRate($username,$toid,$rate)
    {
        $username = $this->prepareData($username);
        $toid = $this->prepareData($toid);
        $rate = $this->prepareData($rate);
        
        $this->sql ="INSERT INTO `評分` (`username`, `To_ID`, `Time`, `Rate`) VALUES ('" .$username."', '" .$toid."', NOW(), '" .$rate."')";
        
        if (mysqli_query($this->connect, $this->sql)) {
            return true;
        } else return false;
    }

    function sendRep($username,$toid,$commond)
    {
        $username = $this->prepareData($username);
        $toid = $this->prepareData($toid);
        $commond = $this->prepareData($commond);
        // INSERT INTO `報修`(`username`, `To_ID`, `Time`, `Comment`) VALUES ("test3",25,NOW(),"測試測試測試測試測試測試測試測試測試測試測試測試測試測試測試測試測試測試測試測試測試")

        $this->sql ="INSERT INTO `報修`(`username`, `To_ID`, `Time`, `Comment`) VALUES ('".$username."',".$toid.",NOW(),'".$commond."')";
        
        if (mysqli_query($this->connect, $this->sql)) {
            return true;
        } else return false;
    }

    //刪除廁所
    function delewc($id)
    {
        $id = $this->prepareData($id);

        // DELETE FROM `廁所總表` WHERE To_ID=1
        $this->sql =
            "DELETE FROM `廁所總表` WHERE To_ID = " .$id. "";
        if (mysqli_query($this->connect, $this->sql)) {
            return true;
        } else return false;

    }
    
    function deleReport($id)
    {
        $id = $this->prepareData($id);
        
        // DELETE FROM `廁所總表` WHERE To_ID=1
        $this->sql =
            "DELETE FROM `報修` WHERE Time= '" .$id. "'";
        if (mysqli_query($this->connect, $this->sql)) {
            return true;
        } else return false;

    }

    function managerSel($name,$section,$village)
    {
        $name=$this->prepareData($name);
        $section=$this->prepareData($section);
        $village=$this->prepareData($village);
        // SELECT * FROM `廁所總表` NATURAL JOIN `區里對照表` NATURAL JOIN `區碼對照表`  
        // WHERE To_Name LIKE '%北%'
        // AND Section="信義區"
        // AND Village="興雅里"
        $this->sql =
            "SELECT * FROM `廁所總表` NATURAL JOIN `區里對照表` NATURAL JOIN `區碼對照表` WHERE To_Name LIKE '%" .$name. "%' AND Section='".$section."' AND Village='".$village."'";
        // echo $this->sql;
            mysqli_query($this->connect,"SET NAMES 'UTF8'");
        
        $result = mysqli_query($this->connect, $this->sql);
        
        $arr = array();
        // 输出每行数据
        while($row = $result->fetch_assoc()) {
            $count=count($row);//不能在循环语句中，由于每次删除row数组长度都减小
            for($i=0;$i<$count;$i++){
                unset($row[$i]);//删除冗余数据
            }
            array_push($arr,$row);
 
        }

        echo json_encode($arr,JSON_UNESCAPED_UNICODE);//json编码
    }

    function managerSelAll($name,$section,$village)
    {
        $name=$this->prepareData($name);
        $section=$this->prepareData($section);
        $village=$this->prepareData($village);
        // SELECT * FROM `廁所總表` NATURAL JOIN `區里對照表` NATURAL JOIN `區碼對照表`  
        // WHERE To_Name LIKE '%北%'
        // AND Section="信義區"
        // AND Village="興雅里"
        $this->sql =
            "SELECT * FROM `廁所總表` NATURAL JOIN `區里對照表` NATURAL JOIN `區碼對照表` WHERE To_Name LIKE '%" .$name. "%' AND Section=".$section." AND Village=".$village."";
        // echo $this->sql;
            mysqli_query($this->connect,"SET NAMES 'UTF8'");
        
        $result = mysqli_query($this->connect, $this->sql);
        
        $arr = array();
        // 输出每行数据
        while($row = $result->fetch_assoc()) {
            $count=count($row);//不能在循环语句中，由于每次删除row数组长度都减小
            for($i=0;$i<$count;$i++){
                unset($row[$i]);//删除冗余数据
            }
            array_push($arr,$row);
 
        }

        echo json_encode($arr,JSON_UNESCAPED_UNICODE);//json编码
    }

    function managerUpd($Totype,$Tovillage,$Toid,$Toname,$Toaddress,$Administration,$Latitude,$Longitude,$Grade,$Totypetwo)
    {

        $Totype=$this->prepareData($Totype);
        $Tovillage=$this->prepareData($Tovillage);
        $Toname=$this->prepareData($Toname);
        $Toid=$this->prepareData($Toid);
        $Toaddress=$this->prepareData($Toaddress);
        $Administration=$this->prepareData($Administration);
        $Latitude=$this->prepareData($Latitude);
        $Longitude=$this->prepareData($Longitude);
        $Grade=$this->prepareData($Grade);
        $Totypetwo=$this->prepareData($Totypetwo);

        //UPDATE `廁所總表` SET `To_Type`='" .$name. "',`To_Village`='" .$name. "',`To_ID`='" .$name. "',`To_Name`='" .$name. "',`To_Address`='" .$name. "',`Administration`='" .$name. "',`Latitude`='" .$name. "',`Longitude`='" .$name. "',`Grade`='" .$name. "',`To_Type2`='" .$name. "'WHERE To_ID='" .$name. "';
        $this->sql =
            "UPDATE `廁所總表` SET `To_Type`='" .$Totype. "',`To_Village`='" .$Tovillage. "',`To_ID`='" .$Toid. "',`To_Name`='" .$Toname. "',`To_Address`='" .$Toaddress. "',`Administration`='" .$Administration. "',`Latitude`='" .$Latitude. "',`Longitude`='" .$Longitude. "',`Grade`='" .$Grade. "',`To_Type2`='" .$Totypetwo. "'WHERE To_ID='" .$Toid. "'";
        if (mysqli_query($this->connect, $this->sql)) {
            return true;
        } else return false;

    }
    function sendNewTo($Totype,$Tovillage,$Toid,$Toname,$Toaddress,$Administration,$Latitude,$Longitude,$Grade,$Totypetwo)
    {

        $Totype=$this->prepareData($Totype);
        $Tovillage=$this->prepareData($Tovillage);
        $Toname=$this->prepareData($Toname);
        $Toid=$this->prepareData($Toid);
        $Toaddress=$this->prepareData($Toaddress);
        $Administration=$this->prepareData($Administration);
        $Latitude=$this->prepareData($Latitude);
        $Longitude=$this->prepareData($Longitude);
        $Grade=$this->prepareData($Grade);
        $Totypetwo=$this->prepareData($Totypetwo);

        //INSERT INTO `廁所總表`(`To_Type`, `To_Village`, `To_ID`, `To_Name`, `To_Address`, `Administration`, `Latitude`, `Longitude`, `Grade`, `To_Type2`) VALUES ([value-1],[value-2],[value-3],[value-4],[value-5],[value-6],[value-7],[value-8],[value-9],[value-10])
        $this->sql =
            "INSERT INTO `廁所總表`(`To_Type`, `To_Village`, `To_ID`, `To_Name`, `To_Address`, `Administration`, `Latitude`, `Longitude`, `Grade`, `To_Type2`) 
            VALUES ('".$Totype."','".$Tovillage."','".$Toid."','".$Toname."','".$Toaddress."','".$Administration."','".$Latitude."','".$Longitude."','".$Grade."','".$Totypetwo."')";
        // echo $this->sql;
        if (mysqli_query($this->connect, $this->sql)) {
            $this->sql =
            "INSERT INTO `評分`(`username`, `To_ID`, `Time`, `Rate`) VALUES ('root','".$Toid."',NOW(),3)";
            mysqli_query($this->connect, $this->sql);
            return true;
        } else return false;

    }
    function selAllreport()
    {
        // SELECT * FROM `報修`

        $this->sql = "SELECT * FROM `報修` NATURAL JOIN `廁所總表` ORDER BY `報修`.`To_ID` ASC";
        
        
        mysqli_query($this->connect,"SET NAMES 'UTF8'");
        
        $result = mysqli_query($this->connect, $this->sql);
        
        $arr = array();
        // 输出每行数据
        while($row = $result->fetch_assoc()) {
            $count=count($row);//不能在循环语句中，由于每次删除row数组长度都减小
            for($i=0;$i<$count;$i++){
                unset($row[$i]);//删除冗余数据
            }
            array_push($arr,$row);
 
        }

        echo json_encode($arr,JSON_UNESCAPED_UNICODE);//json编码

    }
    function newID()
    {
        // SELECT * FROM `報修`

        $this->sql = "SELECT MAX(To_ID)+1 AS NewID FROM `廁所總表`";
        
        
        mysqli_query($this->connect,"SET NAMES 'UTF8'");
        
        $result = mysqli_query($this->connect, $this->sql);
        
        $arr = array();
        // 输出每行数据
        while($row = $result->fetch_assoc()) {
            $count=count($row);//不能在循环语句中，由于每次删除row数组长度都减小
            for($i=0;$i<$count;$i++){
                unset($row[$i]);//删除冗余数据
            }
            array_push($arr,$row);
 
        }

        echo json_encode($arr,JSON_UNESCAPED_UNICODE);//json编码

    }
    
    
    
}
?>
