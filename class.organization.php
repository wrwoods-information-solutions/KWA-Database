<?php

/**
 * @author W RICHARD WOODS
 * @copyright 2011
 */
require_once "class.pdodatabase.php";
require_once "class.validate.php";
require_once "class.messages.php";
class organization {
// setting up organization table		  
	function insertrecord($name='new',$description='New Description') 
	{
		$sql = 'INSERT INTO organization (name,description) VALUES (\''. $name.'\', \''. $description.'\')';
        	$db = new DBMS($_SESSION["preferences"]["database"]["type"],$_SESSION["preferences"]["database"]['server'],$_SESSION["preferences"]["database"]["dbname"] ,$_SESSION["preferences"]["database"]["user"],$_SESSION["preferences"]["database"]["password"],$_SESSION["preferences"]["database"]["port"]);
		$results = $db->query($sql);
		if ($results) 
 		{
                    $row = $results->fetchAll(PDO::FETCH_ASSOC);
                    $validate = new validate;
                    $validate->DateStamp('organization','organizationid',$row[0]['organizationid'],$_SESSION['login']['username'],$_SESSION["preferences"]["database"]["dbname"]);
                    $msg = new messages;
                    $msg->DisplayMessage('recadd');
                    return $row[0];
                }     
	}
	 function updaterecord($organizationid,$name,$description) 
	 {
		$sql = 'UPDATE organization SET name= \''.$name.'\',description= \''.$description.' WHERE organizationid = \''.$organizationid;
                $results = $db = new DBMS($_SESSION["preferences"]["database"]["type"],$_SESSION["preferences"]["database"]['server'],$_SESSION["preferences"]["database"]["dbname"] ,$_SESSION["preferences"]["database"]["user"],$_SESSION["preferences"]["database"]["password"],$_SESSION["preferences"]["database"]["port"]);
		$db->query($sql);
                if ($results)
                {    
                    $validate = new validate;
                    $validate->DateStamp('organization','organizationid',$organizationid,$_SESSION['login']['username'],$_SESSION["preferences"]["database"]["dbname"]);
                    $msg = new messages;
                    $msg->DisplayMessage('recedit');
                }    
	}
	 function saverecord($organizationid,$name,$description) 
	 {
            if($organizationid == 0)
            {
   		$sql = 'INSERT INTO organization (name,description) VALUES (\''. $name.'\', \''. $description.'\')';
        	$db = new DBMS($_SESSION["preferences"]["database"]["type"],$_SESSION["preferences"]["database"]['server'],$_SESSION["preferences"]["database"]["dbname"] ,$_SESSION["preferences"]["database"]["user"],$_SESSION["preferences"]["database"]["password"],$_SESSION["preferences"]["database"]["port"]);
		$results = $db->query($sql);
		if ($results) 
 		{
                    $row = $results->fetch(PDO::FETCH_ASSOC);
                    $validate = new validate;
                    $validate->DateStamp('organization','organizationid',$row[0]['organizationid'],$_SESSION['login']['username'],$_SESSION["preferences"]["database"]["dbname"]);
                    $msg = new messages;
                    $msg->DisplayMessage('recadd');
                    return $row[0];
                }                  
            }else{
		$sql = 'UPDATE organization SET name= \''.$name.'\',description= \''.$description.'\' WHERE organizationid = '.$organizationid;
                $results = $db = new DBMS($_SESSION["preferences"]["database"]["type"],$_SESSION["preferences"]["database"]['server'],$_SESSION["preferences"]["database"]["dbname"] ,$_SESSION["preferences"]["database"]["user"],$_SESSION["preferences"]["database"]["password"],$_SESSION["preferences"]["database"]["port"]);
		$db->query($sql);
                if ($results)
                {    
                    $validate = new validate;
                    $validate->DateStamp('organization','organizationid',$organizationid,$_SESSION['login']['username'],$_SESSION["preferences"]["database"]["dbname"]);
                    $msg = new messages;
                    $msg->DisplayMessage('recedit');
                }
            }    
	}
	function deleterecord($deleteid) 
	{
		$sql = 'DELETE FROM organization WHERE (organizationid = \''.$deleteid.'\')';
                $db = new DBMS($_SESSION["preferences"]["database"]["type"],$_SESSION["preferences"]["database"]['server'],$_SESSION["preferences"]["database"]["dbname"] ,$_SESSION["preferences"]["database"]["user"],$_SESSION["preferences"]["database"]["password"],$_SESSION["preferences"]["database"]["port"]);
		$db->query($sql);
		$msg->DisplayMessage('recdelete');
	}	
	function getrecord($organizationid) 
	{
		$sql = 'SELECT * FROM organization WHERE (organizationid = \''.$organizationid.'\')';
                $db = new DBMS($_SESSION["preferences"]["database"]["type"],$_SESSION["preferences"]["database"]['server'],$_SESSION["preferences"]["database"]["dbname"] ,$_SESSION["preferences"]["database"]["user"],$_SESSION["preferences"]["database"]["password"],$_SESSION["preferences"]["database"]["port"]);
		$results = $db->query($sql);
                if ($results)
                {    
                    $row = $results->fetchAll(PDO::FETCH_ASSOC);
                    return $row[0];
                }   
	}	
}
?>
