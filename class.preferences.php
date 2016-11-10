<?php  
/**
 * *****************************************************
 * @file class.preferences.php
 * @brief The preferences class handles all preferences  functions
 * @author W.R.(Ric)Woods
 * @version  1.0
 * @copyright 2016
 * @date 15 September 2016
 */
require_once "class.pdodatabase.php";
require_once "class.validate.php";
require_once "class.messages.php";
class preferences
{
	function updatepreferences($setting,$category,$value) 
	{
		$sql = 'SELECT * FROM preferences WHERE setting = \''.$setting.'\'';
                $db = new DBMS($_SESSION["preferences"]["database"]["type"],$_SESSION["preferences"]["database"]['server'],$_SESSION["preferences"]["database"]["dbname"] ,$_SESSION["preferences"]["database"]["user"],$_SESSION["preferences"]["database"]["password"],$_SESSION["preferences"]["database"]["port"]);
        	$results = $db->query($sql);
                $rtnanswer = '';
		if ($results) 
		{
  			$sql = 'INSERT INTO preferences (setting,category,prefervalue) VALUES (\''. $setting.'\',\''. $category.'\', \''. $value.'\')';
			$result = $db->query($sql);
			if ($result) 
			{
                            $validate = new validate;
                            $validate->DateStamp('preferences','preferencesid',$db->getLatestId('preferences','preferencesid'),$_SESSION['login']['username'],$_SESSION["preferences"]["database"]["dbname"]);
                            $msg = new messages;
                            $msg->DisplayMessage('recadd');
                        }
		}else{
			$sql = 'UPDATE preferences SET setting = \''.$setting.'\',category = \''.$category.'\',prefervalue= \''.$value.'\' WHERE (setting = \''.$setting.'\')';
			$result = $db->query($sql);
			if ($result) 
			{
                            foreach ($result as $row)
                            {
                                $perferenceid = $row(0);
                            }
                            $validate = new validate;
                            $validate->DateStamp('preferences','preferencesid',$db->getLatestId('preferences','preferencesid'),$_SESSION['login']['username'],$_SESSION["preferences"]["database"]["dbname"]);
                            $msg = new messages;
                            $msg->DisplayMessage('recsave');
                            return true;
                        }else{
                            $msg = new messages;
                            $msg->popupMsg ('invalidrecord',150,200,200,"Invalid Login Record","Login Record for loginid  ".$value." not found.");
                            return false;
                            
                        }
		}
	}
	function loadpreferences() 
	{
		$sql = 'SELECT setting,category,prefervalue from preferences';
         	$db = new DBMS($_SESSION["preferences"]["database"]["type"],$_SESSION["preferences"]['database']['server'],$_SESSION["preferences"]["database"]["dbname"] ,$_SESSION["preferences"]['database']["user"],$_SESSION["preferences"]['database']["password"],$_SESSION["preferences"]['database']["port"]);
		$result = $db->query($sql);
                if ($result)
                {   
                    foreach ($result as $row)
                    {
  			$_SESSION["preferences"][$row[1]][$row[0]] = $row[2];
                    }
                }
	}	
	function deletepreferences($setting)
	{
		$sql = 'DELETE FROM preferences WHERE (setting = \''.$setting.'\')';
            	$db = new DBMS($_SESSION["preferences"]["database"]["type"],$_SESSION["preferences"]["database"]['server'],$_SESSION["preferences"]["database"]["dbname"] ,$_SESSION["preferences"]["database"]["user"],$_SESSION["preferences"]["database"]["password"],$_SESSION["preferences"]["database"]["port"]);
		$result = $db->query($sql);
                if ($result)
                {    
                    $msg = new messages;
                    $msg->DisplayMessage('recdelete');
                }
	} 
	function cleanSESSION()
 	{
		foreach ($_SESSION as $key => $value)
		{
			if ($key == 'login')
			{
				continue;
			}
			if ($key == 'preferences')
			{
				continue;
			}
			$_SESSION[$key] = array();
		}
	}
	function cleantext ($string) 
	{
   		$magic_quotes_active = get_magic_quotes_gpc();
   	  	$new_enough_php = function_exists("mysql_real_escape_string");
    	// i.e PHP >= v4.3.0
    	if ($new_enough_php) 
	{
        //undo any magic quote effects so mysql_real_escape_string can do the work
        	if ($magic_quotes_active) 
                {
                    $string = stripslashes($string); 
                    $new_string = $db->escapeString($string);
                    if (empty($new_string) && !empty($string))
                    {
                            die("escapeString failed."); //insert your error handling here
                    }
                     $string = strip_tags($new_string);
                } else { // before PHP v4.3.0
                        // if magic quotes aren't already on this add slashes manually
                        if (!$magic_quotes_active) 
			{
                            $string = addslashes($string);
                        } //if magic quotes are active, then the slashes already exist
                }
		$string = strtr($string, "+", " ");
                return $string;
        }
        }
	function header($header)
	{
		$hdr1 = '<table width="100%" bgcolor="#0099FF" border="0">
					<tr>
                                               <td height="96" align="left"><img src= "images/newlogo.gif"></td>
                                               <td class="subtitle" align="cemtre">User Name: <scan class="body"> '.$_SESSION["login"]["username"].'</scan></td>
 						<td align="right">
							<form id="logout" name="logout" action= "index.php?LC_ACTION=logout"  method="post">
								<p class="button" align="center"><input class="button" type="submit" name="LC_ACTION" value="Logout" /></p>
							</form>	</td>
                                       </tr>
                                        <tr>
						<td align="center" class="headtitle" colspan="3">'.$header.'</td>
                                        </tr>
				</table>';
		echo $hdr1;
        }
	function prtheader($header)
	{
		$hdr1 = '<table width="100%"  border="0">
					<tr>
                                               <td height="96" align="left"><img src= "images/newlogo.gif"></td>
 						<td align="right">
						
                                                </td>
                                       </tr>
                                        <tr>
						<td align="center" class="headtitle" colspan="3">'.$header.'</td>
                                        </tr>
				</table>';
		echo $hdr1;
        }
	function loadmenu()
	{
		$menu = new menu();
		$menu->setMasterTableName('mastermenu');
		$menu->setuserTableName('usermenu');
                $menu->scanTableForMenu($_SESSION["login"]['usermenuname'],'',$_SESSION["login"]["username"]);
		$menu->newHorizontalBlockMenu($_SESSION["login"]['usermenuname'],"title");
		$menu->printHorizontalBlockMenu($_SESSION["login"]['usermenuname']);
	}
	function basicincludes()
	{
		require_once "class.menu.php";
		require_once "class.login.php";
		require_once "class.log.php";
                require_once "class.codes.php";
		require_once "class.validate.php";
		require_once "class.messages.php";
		require_once "class.pdodatabase.php";
	}
}
?>
