<?php session_start(); ?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<link href="style.css" rel="stylesheet" type="text/css"></link>
<script type="text/javascript" src="popup-window.js"></script>
<title>KWA Conversion</title>
<?php
        require_once "class.pdodatabase.php";
        require_once "class.preferences.php";
        
        //connevt to databases
        $pref = new preferences;
        $pref->basicincludes();
        $pref->loadpreferences();
        $user = ''; //username
        $password = ''; //password
//path to database file
        $database =$_SERVER["DOCUMENT_ROOT"].'/KWA Database/KWAA_CMDB_be.accdb';
//check file exist before we proceed
        if (!file_exists($database)) {
            die("Access database file not found !");
        }    
        $accessin = new DBMS('odbc','localhost',$database,$user,$password,'');
	$mysqlout = new DBMS($_SESSION["preferences"]["database"]["type"],$_SESSION["preferences"]['database']['server'],$_SESSION["preferences"]["database"]["dbname"] ,$_SESSION["preferences"]['database']["user"],$_SESSION["preferences"]['database']["password"],$_SESSION["preferences"]['database']["port"]);
        //query into ASSOC arrays
 	$sqlc = "SELECT * FROM consumers";
        $consunersrst = $accessin->query($sqlc);
        while ($row = $result->fetch()) 
        {
            echo $row["firstname"];
        }
	$sqls = "SELECT * FROM staff";
        $staffrst = $accessin->query($sqls);
        while ($row = $result->fetch()) 
        {
            echo $row["firstname"];
        }
	$sqlv = "SELECT * FROM volunteers";
        $volunteersrst = $accessin->query($sqlv);
        while ($row = $result->fetch()) 
        {
            echo $row["firstname"];
        }

        ?>
</head>
