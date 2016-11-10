<?php 
include_once 'class.validate.php';
require_once "class.log.php";
require_once "class.pdodatabase.php";

class log 
{
	public function LogEvent($file, $class, $function, $line, $message, $type = 'INFO', $whatdoingsgn = false, $whatdoing = '') 
	{
		$db = new DBMS($_SESSION["preferences"]["database"]["type"],$_SESSION["preferences"]["database"]['server'],$_SESSION["preferences"]["database"]["dbname"] ,$_SESSION["preferences"]["database"]["user"],$_SESSION["preferences"]["database"]["password"],$_SESSION["preferences"]["database"]["port"]);
                $result = $db->query("insert into log (file, class, function, line, message, type) VALUE ('".$file."','". $class."','".$function."','".$line."','".$message."','".$type."')");
                if ($result)
                {
                    if ($whatdoingsgn)
                    {
                    
                    }
                    $validate = new validate;
                    $validate->DateStamp('log','logid',$db->getLatestId('log','logid'),$_SESSION["login"]['username'],$_SESSION["preferences"]["database"]["dbname"]);
                }    
 	}
}
?>
