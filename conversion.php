<?php session_start(); ?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<link href="style.css" rel="stylesheet" type="text/css"></link>
<script type="text/javascript" src="popup-window.js"></script>
<title>KWA Conversion</title>
<?php
        require_once "class.pdodatabase.php";
        
        //connevt to databases

        $accessin = new DBMS('odbc','localhost',$_SERVER["DOCUMENT_ROOT"].'/KWA Database/KWAA_CMDB_be.accdb','Admin','','');
	$mysqlout = new DBMS('mysql','localhost','kwa','root','','');
        
        //query into ASSOC arrays
 	$sqlc = "SELECT * FROM consumers";
        $consunersrst = $accessin->query($sqlc);
        $tblcomsumers = $consunersrst->fetchAll(PDO::FETCH_ASSOC);
                 foreach ($tblcomsumers as $name) 
                {
                     
                 }
	$sqls = "SELECT * FROM staff";
        $staffrst = $accessin->query($sqls);
        $tblstaff = $staffrst->fetchAll(PDO::FETCH_ASSOC);
                foreach ($tblstaff as $name) 
                {
                    
                }
 	$sqlv = "SELECT * FROM volunteers";
        $volunteersrst = $accessin->query($sqlv);
        $tblvolunteers = $volunteersrst->fetchAll(PDO::FETCH_ASSOC);
                foreach ($_SESSION['displaydata']["notesinline"] as $name) 
                {
        
                }
?>
</head>
