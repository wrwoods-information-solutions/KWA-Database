<?php
/**
 * *****************************************************
 * @file class.program.php
 * @brief The program class handles all program functions
 * @author W.R.(Ric)Woods
 * @version  1.0
 * @copyright 2017
 * @date 13 September 2017
 */
require_once "class.pdodatabase.php";
require_once "class.validate.php";
require_once "class.messages.php";
class program 
{
// setting up program table		  
	function insertrecord() 
	{
		$sql = 'INSERT INTO program (name)VALUES ("")';
        	$db = new DBMS($_SESSION["preferences"]["database"]["type"],$_SESSION["preferences"]["database"]['server'],$_SESSION["preferences"]["database"]["dbname"] ,$_SESSION["preferences"]["database"]["user"],$_SESSION["preferences"]["database"]["password"],$_SESSION["preferences"]["database"]["port"]);
		$results = $db->query($sql);
		if ($results) 
 		{
                    $rtnanswer = $db->getLatestId('program','programid');
                    $validate = new validate;
                    $validate->DateStamp('program','programid',$rtnanswer,$_SESSION['login']['username'], $_SESSION["preferences"]["database"]["dbname"]);
                    $msg = new messages;
                    $msg->DisplayMessage('recadd');
                    return $rtnanswer;
                }     
	}
	function updaterecord($programid,$name,$department,$status,$description) 
	{
		$sql = 'UPDATE program SET name= \''.$name.'\',department= \''.$department.'\',status= \''.$status.'\',description= \''.$description.'\' WHERE programid = '.$programid;
                $db = new DBMS($_SESSION["preferences"]["database"]["type"],$_SESSION["preferences"]["database"]['server'],$_SESSION["preferences"]["database"]["dbname"] ,$_SESSION["preferences"]["database"]["user"],$_SESSION["preferences"]["database"]["password"],$_SESSION["preferences"]["database"]["port"]);
		$results = $db->query($sql);
                if ($results)
                {    
                    $validate = new validate;
                    $validate->DateStamp('program','programid',$programid,$_SESSION['login']['username'],$_SESSION["preferences"]["database"]["dbname"]);
                    $msg = new messages;
                    $msg->DisplayMessage('recedit');
                }    
	}
	function deleterecord($deleteid) 
	{
		$sql = 'DELETE FROM program WHERE (programid = \''.$deleteid.'\')';
                $db = new DBMS($_SESSION["preferences"]["database"]["type"],$_SESSION["preferences"]["database"]['server'],$_SESSION["preferences"]["database"]["dbname"] ,$_SESSION["preferences"]["database"]["user"],$_SESSION["preferences"]["database"]["password"],$_SESSION["preferences"]["database"]["port"]);
		$db->query($sql);
                $msg = new messages;
		$msg->DisplayMessage('recdelete');
	}	
	function getrecord($programid) 
	{
		$sql = 'SELECT * FROM program WHERE (programid = \''.$programid.'\')';
                $db = new DBMS($_SESSION["preferences"]["database"]["type"],$_SESSION["preferences"]["database"]['server'],$_SESSION["preferences"]["database"]["dbname"] ,$_SESSION["preferences"]["database"]["user"],$_SESSION["preferences"]["database"]["password"],$_SESSION["preferences"]["database"]["port"]);
		$results = $db->query($sql);
                $row = $results->fetchAll(PDO::FETCH_ASSOC);
 		return $row[0];
	}	
}
?>
