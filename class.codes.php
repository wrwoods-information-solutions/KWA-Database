<?php
/**
******************************************************
* @file class.codes.php
* @brief This class manages the codes in the project.
* @author W.R.(Ric)Woods
* @version 1.0
* @copyright 2016
* @date 8 September 2016
*******************************************************/

require_once "class.pdodatabase.php";
require_once "class.validate.php";
require_once "class.messages.php";
class codes {
// setting up codes table		  
	function insertrecord($code='new',$title='new') 
	{
		$sql = 'INSERT INTO codes (code,title) VALUES (\''. $code.'\', \''. $title.'\')';
		echo __LINE__.'Codes insertrecord sql = '.$sql.'<br>';
    	$db = new DBMS($_SESSION["preferences"]["database"]["type"],$_SESSION["preferences"]["database"]['server'],$_SESSION["preferences"]["database"]["dbname"] ,$_SESSION["preferences"]["database"]["user"],$_SESSION["preferences"]["database"]["password"],$_SESSION["preferences"]["database"]["port"]);
		$results = $db->query($sql);
		echo __LINE__.' $db->affectedRows($results) = '.$db->affectedRows($results).'<br>';
		if ($db->affectedRows($results) == 1) 
		{
				WHILE ($row = $db->fetchAssoc($results)) 
				{
					$rtnanswer= $row[0]['messageid'];
			    } 
		}
		$validate = new validate;
		$validate->DateStamp('codes','codeid',$rtnanswer,$_SESSION[username]);
		$msg = new messages;
		$msg->DisplayMessage('recadd');
		return $rtnanswer;
	}
	 function updaterecord($codeid,$code,$title,$description) 
	 {
			$sql = 'UPDATE codes SET code= \''.$code.'\',title= \''.$title.'\',description= \''.$description.'\' WHERE (codeid = \''.$codeid.'\')';
    	$db = new DBMS($_SESSION["preferences"]["database"]["type"],$_SESSION["preferences"]["database"]['server'],$_SESSION["preferences"]["database"]["dbname"] ,$_SESSION["preferences"]["database"]["user"],$_SESSION["preferences"]["database"]["password"],$_SESSION["preferences"]["database"]["port"]);
		$db->query($sql);
		$validate = new validate;
		$validate->DateStamp('codes','codeid',$codeid,$_SESSION[username]);
		$msg = new messages;
		$msg->DisplayMessage('recupdate');
	}
	function deleterecord($table,$field) 
	{
		$sql = 'DELETE FROM codes WHERE (table = \''.$table.'\',field = \''.$field.'\')';
		echo __LINR__.' '.__FUNCTION__.' $SQL = '.$sql.'<br>';
    	$db = new DBMS($_SESSION["preferences"]["database"]["type"],$_SESSION["preferences"]["database"]['server'],$_SESSION["preferences"]["database"]["dbname"] ,$_SESSION["preferences"]["database"]["user"],$_SESSION["preferences"]["database"]["password"],$_SESSION["preferences"]["database"]["port"]);
		$db->query($sql);
		$msg->DisplayMessage('recdelete');
	}	
	function getrecord($codeid) 
	{
		$sql = 'SELECT * FROM codes WHERE (codeid = \''.$codeid.'\')';
    	$db = new DBMS($_SESSION["preferences"]["database"]["type"],$_SESSION["preferences"]["database"]['server'],$_SESSION["preferences"]["database"]["dbname"] ,$_SESSION["preferences"]["database"]["user"],$_SESSION["preferences"]["database"]["password"],$_SESSION["preferences"]["database"]["port"]);
		$results = $db->query($sql);
		$row = $db->fetchAssoc($results);
		return $row;
	}	
}
?>