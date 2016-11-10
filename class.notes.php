<?php

/**
 * @author W RICHARD WOODS
 * @copyright 2011
 */
require_once "class.pdodatabase.php";
require_once "class.validate.php";
require_once "class.messages.php";
class notes {
// setting up notes table		  
	function insertrecord($code='new',$title='new') 
	{
		$sql = 'INSERT INTO notes (code,title) VALUES (\''. $code.'\', \''. $title.'\')';
        	$db = new DBMS($_SESSION["preferences"]["database"]["type"],$_SESSION["preferences"]["database"]['server'],$_SESSION["preferences"]["database"]["dbname"] ,$_SESSION["preferences"]["database"]["user"],$_SESSION["preferences"]["database"]["password"],$_SESSION["preferences"]["database"]["port"]);
		$results = $db->query($sql);
		if ($results) 
 		{
                    $row = $result->fetch(PDO::FETCH_ASSOC);
                    $validate = new validate;
                    $validate->DateStamp('notes','notesid',$row[0]['notesid'],$_SESSION['logim']['username'],$_SESSION["preferences"]["database"]["dbname"]);
                    $msg = new messages;
                    $msg->DisplayMessage('recadd');
                    return $rtnanswer;
                }     
	}
	 function updaterecord($notesid,$firstname,$lastname,$gender,$birthdate) 
	 {
		$sql = 'UPDATE notes SET firstname= \''.$firstname.'\',lastname= \''.$lastname.'\',fullname= \''.strip($fistname).' '.strip($lastname).'\',gemder= \''.$gender.'\',birthdate= \''.$birthdate.' WHERE (notesid = \''.$notesid.'\')';
                $results = $db = new DBMS($_SESSION["preferences"]["database"]["type"],$_SESSION["preferences"]["database"]['server'],$_SESSION["preferences"]["database"]["dbname"] ,$_SESSION["preferences"]["database"]["user"],$_SESSION["preferences"]["database"]["password"],$_SESSION["preferences"]["database"]["port"]);
		$db->query($sql);
                if ($results)
                    $validate = new validate;
                    $validate->DateStamp('notes','notesid',$notesid,$_SESSION[username]);
                    $msg = new messages;
                    $msg->DisplayMessage('recupdate');
	}
	function deleterecord($deleteid) 
	{
		$sql = 'DELETE FROM notes WHERE (notesid = \''.$deleteid.'\')';
                $db = new DBMS($_SESSION["preferences"]["database"]["type"],$_SESSION["preferences"]["database"]['server'],$_SESSION["preferences"]["database"]["dbname"] ,$_SESSION["preferences"]["database"]["user"],$_SESSION["preferences"]["database"]["password"],$_SESSION["preferences"]["database"]["port"]);
		$db->query($sql);
		$msg->DisplayMessage('recdelete');
	}	
	function getrecord($notesid) 
	{
		$sql = 'SELECT * FROM notes WHERE (notesid = \''.$notesid.'\')';
                $db = new DBMS($_SESSION["preferences"]["database"]["type"],$_SESSION["preferences"]["database"]['server'],$_SESSION["preferences"]["database"]["dbname"] ,$_SESSION["preferences"]["database"]["user"],$_SESSION["preferences"]["database"]["password"],$_SESSION["preferences"]["database"]["port"]);
		$results = $db->query($sql);
                $row = $results->fetchAll(PDO::FETCH_ASSOC);
 		return $row[0];
	}	
    function verifyrecord($notesid)
    {
        $sql = 'SELECT * FROM notes WHERE (notesid = \''.$notesid.'\')';
         $db = new DBMS($_SESSION["preferences"]["database"]["type"],$_SESSION["preferences"]["database"]['server'],$_SESSION["preferences"]["database"]["dbname"] ,$_SESSION["preferences"]["database"]["user"],$_SESSION["preferences"]["database"]["password"],$_SESSION["preferences"]["database"]["port"]);
        $results = $db->query($sql);
        if ($results)
        {
            return true;
        }else{
            return false;
        }  
    }
  }  
?>
