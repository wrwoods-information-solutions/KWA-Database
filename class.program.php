<?php

/**
 * @author W RICHARD WOODS
 * @copyright 2011
 */
require_once "class.pdodatabase.php";
require_once "class.validate.php";
require_once "class.messages.php";
class program 
{
// setting up program table		  
	function insertrecord() 
	{
		$sql = 'INSERT INTO program (firstname)VALUES ("")';
        	$db = new DBMS($_SESSION["preferences"]["database"]["type"],$_SESSION["preferences"]["database"]['server'],$_SESSION["preferences"]["database"]["dbname"] ,$_SESSION["preferences"]["database"]["user"],$_SESSION["preferences"]["database"]["password"],$_SESSION["preferences"]["database"]["port"]);
		$results = $db->query($sql);
		if ($results) 
 		{
                    $validate = new validate;
                    $validate->DateStamp('program','programid',$row[0]['programid'],$_SESSION['login']['username'], $_SESSION["preferences"]["database"]["dbname"]);
                    $msg = new messages;
                    $msg->DisplayMessage('recadd');
                    $rtnanswer = $db->getLatestId('program','programid');
                    return $rtnanswer;
                }     
	}
	function updaterecord($programid,$firstname,$lastname,$gender,$birthdate,$mobilityplusid) 
	{
//                $date = date_parse_from_format($_SESSION['preferences']['dateformat'],$birthdate );
//                $birthdate = mktime(0, 0, 0, $date['month'], $date['day'], $date['year']);
		$sql = 'UPDATE program SET firstname= \''.$firstname.'\',lastname= \''.$lastname.'\',fullname= \''.trim($firstname).' '.trim($lastname).'\',gender= \''.$gender.'\',birthdate= \' '. $birthdate. '\', mobilityplusid=\''. $mobilityplusid.'\' WHERE programid = '.$programid;
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
