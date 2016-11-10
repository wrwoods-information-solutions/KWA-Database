<?php
/**
 * *****************************************************
 * @file class.person.php
 * @brief The person class handles all person functions
 * @author W.R.(Ric)Woods
 * @version  1.0
 * @copyright 2016
 * @date 15 September 2016
 */
require_once "class.pdodatabase.php";
require_once "class.validate.php";
require_once "class.messages.php";
class person 
{
// setting up person table		  
	function insertrecord() 
	{
		$sql = 'INSERT INTO person (firstname)VALUES ("")';
        	$db = new DBMS($_SESSION["preferences"]["database"]["type"],$_SESSION["preferences"]["database"]['server'],$_SESSION["preferences"]["database"]["dbname"] ,$_SESSION["preferences"]["database"]["user"],$_SESSION["preferences"]["database"]["password"],$_SESSION["preferences"]["database"]["port"]);
		$results = $db->query($sql);
		if ($results) 
 		{
                    $validate = new validate;
                    $validate->DateStamp('person','personid',$row[0]['personid'],$_SESSION['login']['username'], $_SESSION["preferences"]["database"]["dbname"]);
                    $msg = new messages;
                    $msg->DisplayMessage('recadd');
                    $rtnanswer = $db->getLatestId('person','personid');
                    return $rtnanswer;
                }     
	}
	function updaterecord($personid,$firstname,$lastname,$gender,$birthdate,$mobilityplusid) 
	{
//                $date = date_parse_from_format($_SESSION['preferences']['dateformat'],$birthdate );
//                $birthdate = mktime(0, 0, 0, $date['month'], $date['day'], $date['year']);
		$sql = 'UPDATE person SET firstname= \''.$firstname.'\',lastname= \''.$lastname.'\',fullname= \''.trim($firstname).' '.trim($lastname).'\',gender= \''.$gender.'\',birthdate= \' '. $birthdate. '\', mobilityplusid=\''. $mobilityplusid.'\' WHERE personid = '.$personid;
                $db = new DBMS($_SESSION["preferences"]["database"]["type"],$_SESSION["preferences"]["database"]['server'],$_SESSION["preferences"]["database"]["dbname"] ,$_SESSION["preferences"]["database"]["user"],$_SESSION["preferences"]["database"]["password"],$_SESSION["preferences"]["database"]["port"]);
		$results = $db->query($sql);
                if ($results)
                {    
                    $validate = new validate;
                    $validate->DateStamp('person','personid',$personid,$_SESSION['login']['username'],$_SESSION["preferences"]["database"]["dbname"]);
                    $msg = new messages;
                    $msg->DisplayMessage('recedit');
                }    
	}
	function deleterecord($deleteid) 
	{
		$sql = 'DELETE FROM person WHERE (personid = \''.$deleteid.'\')';
                $db = new DBMS($_SESSION["preferences"]["database"]["type"],$_SESSION["preferences"]["database"]['server'],$_SESSION["preferences"]["database"]["dbname"] ,$_SESSION["preferences"]["database"]["user"],$_SESSION["preferences"]["database"]["password"],$_SESSION["preferences"]["database"]["port"]);
		$db->query($sql);
                $msg = new messages;
		$msg->DisplayMessage('recdelete');
	}	
	function getrecord($personid) 
	{
		$sql = 'SELECT * FROM person WHERE (personid = \''.$personid.'\')';
                $db = new DBMS($_SESSION["preferences"]["database"]["type"],$_SESSION["preferences"]["database"]['server'],$_SESSION["preferences"]["database"]["dbname"] ,$_SESSION["preferences"]["database"]["user"],$_SESSION["preferences"]["database"]["password"],$_SESSION["preferences"]["database"]["port"]);
		$result = $db->query($sql);
                if (!$result)
                {
                        $msg = new messages;
                        $msg->popupMsg ('invalidrecord',150,200,200,"Invalid Person Record","Person Record for personid  ".$personid." not found.");
                        return false;
                } else {
                        $this->tblperson = $result->fetchall(PDO::FETCH_ASSOC);
                        return $this->tblperson[0];
                }
	}	
}
?>
