<?php
/**
 * *****************************************************
 * @file class.login.php
 * @brief The Login class handles all login functions
 * @author W.R.(Ric)Woods
 * @version  1.0
 * @copyright 2016
 * @date 10 September 2016
 */
  include_once 'class.validate.php';
  include_once "class.log.php";
  include_once 'class.messages.php'; 
  class login 
  {
	var $username="";
	var $loginid="";
	var $msg ="";
	// form field name=action from html pages
	var $action_required="";
	/*email smtp*/
	// eg $smtp ="mail.username.com"
	private $smtp = "mail.host.com";
	private $smtp_port = "80";
	private $from = 'user@host.com';
	private $location = 'dev';
	
	function get_username() {
		if (!empty($this->username) ){
			return $this->username;
		}
		else return false;
	}

	function get_loginid() {
		if (!empty($this->loginid))
			return $this->loginid;
		else return false;

	}

        function process_action($action_required="") 
        {
            $msg = new messages;
            $this->action_required = $action_required;
            if (isset ( $_POST ['LC_ACTION'] )) 
                
            {
                 $this->action_required = $_POST ['LC_ACTION'];
            }else {
                 if (isset ( $_GET ['LC_ACTION'] )) 
                 {
                       $this->action_required = $_GET ['LC_ACTION'];
                 }else {
                       return;
                 }
            }
            switch ($this->action_required) 
            {
		case 'Login' :
                 	$this->check_login_request();
			break;

		case 'Logout' :
			$_SESSION = array ();
			session_destroy ();
                        $validate = new validate();
                        $validate->do_redirect(index.php);
			break;

		case 'cancel' :	
			$_POST = array ();
//			header ( "location: " . $_SERVER ["REQUEST_URI"] );
			break;
		case 'Show UserName' :
			$firstname = $_GET['firstname'];
			$lastname = $_GET['lastname'];
			$password = $_GET['password'];				if ($firstname == '')
			if ($firstname == '')
			{
				$msg = new messages;
				$msg->DisplayMessage ('blankfirstname');
				return false;
			}	
			if ($lastname == '')
			{
				$msg = new messages;
				$msg->DisplayMessage ('blanklastname');
				return false;
			}
			if ($password == '')
			{
				$msg = new messages;
				$msg->DisplayMessage ('blankpassword');
				return false;
			}
			$sql = "SELECT person.firstname,person.lastname,person.email,login.username,login.password FROM person,login WHERE ((person.personid = login.personid) and (person.firstname ='".$firstname."') and (person.lastname ='".$lastname."') and (login.password ='".md5($password)."'))";
                	$db = new DBMS($_SESSION["preferences"]["database"]["type"],$_SESSION["preferences"]['database']['server'],$_SESSION["preferences"]["database"]["dbname"] ,$_SESSION["preferences"]['database']["user"],$_SESSION["preferences"]['database']["password"],$_SESSION["preferences"]['database']["port"]);
                        $sql = $db->query("SELECT person.firstname,person.lastname,person.email,login.username,login.password FROM person,login WHERE ((person.personid = login.personid) and (person.firstname ='".$firstname."') and (person.lastname ='".$lastname."') and (login.password ='".md5($password)."'))");
			$this->tbllogin = $db-fetch(PDO::FETCH_ASSOC);
			if (!$result)
			{
				$msg = new messages;
				$msg->DisplayMessage ('invalidloginrecord');
	 			return false;
			}
			$msg = new messages;
			$msg->popupMsg(150,400,200,100,"UserName","The UserName is ".$this->tbllogin["username"].".");
			return true;
			break;
			
		case 'Email UserName' :
			break;

		case 'Show Password' :
			$firstname = $_GET['firstname'];
			$lastname = $_GET['lastname'];
			$username = $_GET['username'];
			if ($firstname == '')
			{
				$msg = new messages;
				$msg->DisplayMessage ('blankfirstname');
				return false;
			}
			if ($lastname == '')
			{
				$msg = new messages;
				$msg->DisplayMessage ('blanklastname');
				return false;
			}
			if ($username == '')
			{
                       		$msg = new messages;
				$msg->DisplayMessage ('blankusername');
				return false;
			}
                        $db = new DBMS($_SESSION["preferences"]["database"]["type"],$_SESSION["preferences"]['database']['server'],$_SESSION["preferences"]["database"]["dbname"] ,$_SESSION["preferences"]['database']["user"],$_SESSION["preferences"]['database']["password"],$_SESSION["preferences"]['database']["port"]);
                        $result = $db->query("SELECT person.firstname,person.lastname,person.email,login.username,login.password FROM person,login WHERE ((person.personid = login.personid) and (person.firstname ='".$firstname."') and (person.lastname ='".$lastname."') and (login.username ='".$username."'))");
 			if (!$result)
			{
				$msg = new messages;
				$msg->DisplayMessage('invalidloginrecord');
	 			return false;
			};
			$newpassword = $this->new_password();
			$msg = new messages;
			$msg->popupMsg (150,400,200,100,"Password","The Password is ".$newpassword. ". Please change as soon as possible.");
			return true;
			break;
		case 'Email Password':
			break;

		case 'Submit Changed Password' :
			if (! $this->validate_password_form ()) 
			{
//              		$this->show_HTML_Page = TRUE;
//				$this->HTML_Page = 'change_PasswordForm.php';
				break;
			}else{
				//if valid submit to database
				if (! $this->change_password_in__db ()) 
				{
					$msg = new messages;
					$msg->DisplayMessage('passwordinvalid');
					break;
				}
				$msg = new messages;
				$msg->DisplayMessage('passwordchange');
				break;
			}

		case 'Reset Password' :
			if (! $this->validate_password_form ()) 
			{
				//if valid submit to database
				if (! $this->change_password_in__db ()) 
				{
					$msg = new messages;
					$msg->DisplayMessage('passwordinvalid');
					break;
				}
				$msg = new messages;
				$msg->DisplayMessage('passwordreset');
				break;
			}
		case 'Submit Security Question' :
			if (! $this->validate_password_form ()) 
				//if valid submit to database
				if (! $this->change_password_in__db ()) 
				{
					$msg = new messages;
					$msg->DisplayMessage('passwordinvalid');
					break;
				}					
				$msg = new messages;
				$msg->DisplayMessage('passwordchange');
				break;
		case 'process registration' :
        		if (! $this->validate_registration_form ()) 
                        {
			//if valid submit to database (add public forum privs)
                		if (! $this->add_user_to_db ()) 
                                {
					$msg = new messages;
					$msg->DisplayMessage('passwordinvalid');
					break;
				}	
        			$msg->DisplayMessage('regcomplete');
//				$this->HTML_Panel = 'loggedinpanel.php';
//				header ( "location: " . $_SERVER ["REQUEST_URI"] );
				break;
			}
                        break;
		case 'Email My Password' :
			if (!$this->reset_password ()) 
                        {
//				$this->show_HTML_Page = TRUE;
//				$this->HTML_Page = 'forgot_password_form.php';
				break;
			}
//			$this->msg ="<p id='lt_msg'>New password Mailed</p>";
//
//						header ( "location: " . $_SERVER ["REQUEST_URI"] );
			break;
		}
        }
	function checklogin()
	{
		$login = new login;
                $login->process_action();
                if (!isset($_SESSION["login"]["username"])) 
                {
	   		$msg = new messages;
			$msg->DisplayMessage('notlogin');
                }
	}		
	function checklogout()
	{
            if (!isset($_POST['logout']))
             $_POST['logout'] = '';           
            if ($_POST['logout'] == 'Logout')
            {
                $login = new login;   
                $login->process_action('logout');
            }
        }    
	
        function new_password() {
		$newPassword = '';
		$dict = $_SERVER['DOCUMENT_ROOT'].'dict.dic';
		if (is_file($dict))
			$fp = fopen ( $dict, 'r' );
		if ( !$fp  ) {
			$msg->DisplayMessage('nonewpassword');
			return false;
		}
		$size = filesize ( $dict );
		
		srand ( ( double ) microtime () * 1000000 );
		$rand_location = rand ( 0, $size );
		fseek ( $fp, $rand_location );
		
		while ( strlen ( $newPassword ) < 6 || strlen ( $newPassword ) > 12 || strstr ( $newPassword, "'" ) ) {
			if (feof ( $fp ))
				fseek ( $fp, 0 );
			$newPassword = fgets ( $fp, 80 );
//			$newPassword = fgets ( $fp, 80 );
		}
		$newPassword = trim ( $newPassword );
		
		srand ( ( double ) microtime () * 1000000 );
		$rn = rand ( 0, 999 );
		$newPassword .= $rn;
        	$db = new DBMS($_SESSION["preferences"]["database"]["type"],$_SESSION["preferences"]['database']['server'],$_SESSION["preferences"]["database"]["dbname"] ,$_SESSION["preferences"]['database']["user"],$_SESSION["preferences"]['database']["password"],$_SESSION["preferences"]['database']["port"]);		
		$result = $db->query("update login set password ='" . md5($newPassword ));
		if (! $result) 
                {
			$msg->DisplayMessage('nochgpassword');
			return false;
		}	
		return $newPassword;
	}
	function reset_password() {
		$newPassword = '';
		$dict = $_SERVER['DOCUMENT_ROOT'].$this->path_to_dictionary.'dict.dic';
		if (is_file($dict))
			$fp = fopen ( $dict, 'r' );
		if ( ! $fp  ) 
                {
			$msg->DisplayMessage('nonewpassword');
			return false;
		}
		$size = filesize ( $dict );
		
		srand ( ( double ) microtime () * 1000000 );
		$rand_location = rand ( 0, $size );
		fseek ( $fp, $rand_location );
		
		while ( strlen ( $newPassword ) < 6 || strlen ( $newPassword ) > 12 || strstr ( $newPassword, "'" ) ) {
			if (feof ( $fp ))
				fseek ( $fp, 0 );
			$newPassword = fgets ( $fp, 80 );
			$newPassword = fgets ( $fp, 80 );
		}
		;
		$newPassword = trim ( $newPassword );
		
		srand ( ( double ) microtime () * 1000000 );
		$rn = rand ( 0, 999 );
		$newPassword .= $rn;
        	$db = new DBMS($_SESSION["preferences"]["database"]["type"],$_SESSION["preferences"]['database']['server'],$_SESSION["preferences"]["database"]["dbname"] ,$_SESSION["preferences"]['database']["user"],$_SESSION["preferences"]['database']["password"],$_SESSION["preferences"]['database']["port"]);		
		$result = $db->query("update login set password = " . md5($newPassword ));
		if (! $result) {
			$msg->DisplayMessage('nochgpassword');
			return false;
		}
		
//      	  $result = $db->query("select email from login where UserName= ".$username);
//		  if (! $result) {
//			$this->msg = "<p id='lt_msg'>not changed as could not email your new password</p>";
//			return false;
//		} else if ($result->num_rows == 0) {
//			$this->msg = "<p id='lt_msg'>could not find this User</p>";
//			return false;
//		}
//		ini_set ( "SMTP", $this->smtp );
//		ini_set ( "smtp_port", $this->smtp_port );
//		ini_set ( 'sendmail_from', $this->from );
//		$row = $result->fetch_object ();
//		$email = $row->email;

//		$from = "From: ". $this->from ."\r\n";
//		$msg = "<p id='lt_msg'>Your new password is " . $newPassword . ". Please change it at www.davejlhale.com/myforum/\r\n</p>";
//		
//		if (mail ( $email, 'dForum login info', $msg, $from ))
//			return true;
//		else
//			return false;
	}
	function validate_password($password) 
	{
		return true;
	}
			
	function validate_new_password($password,$confpassword) 
	{
		if (strlen ($password) < 4) 
		{
			$msg = new messages;
			$msg->DisplayMessage('shortpassword');
			return false;
		}
		if (strlen ($password) > 10) 
		{
			$msg->DisplayMessage('longpassword');
			return false;
		}
		if ($password != $confpassword) 
		{
			$msg->DisplayMessage('mismatchpassword');
			return false;
		}
		return true;
	}
	
	function change_password_in__db()
        {
        	$db = new DBMS($_SESSION["preferences"]["database"]["type"],$_SESSION["preferences"]['database']['server'],$_SESSION["preferences"]["database"]["dbname"] ,$_SESSION["preferences"]['database']["user"],$_SESSION["preferences"]['database']["password"],$_SESSION["preferences"]['database']["port"]);
		$result = $db->query("update login set password ='" . md5 ( $_POST ['newpassone'] ) . "', updateDate = now(), Updateby = 'admin' where UserName ='" . $this->username . "' and password='" . md5 ( $_POST ['oldpassword'] ) . "'");
		if ($result)
			return true;
		else {
			return false;
		}
	}
	
	function validate_registration_form() {
		
		foreach ( $_POST as $key => $value ) {
			
			if (! isset ( $key ) || ($value == '')) {
                                $msg->DisplayMessage('regincomplete');
				return false;
			}
		}
		
		
        	$db = new DBMS($_SESSION["preferences"]["database"]["type"],$_SESSION["preferences"]['database']['server'],$_SESSION["preferences"]["database"]["dbname"] ,$_SESSION["preferences"]['database']["user"],$_SESSION["preferences"]['database']["password"],$_SESSION["preferences"]['database']["port"]);
		$sql = $db->query("select * from login where Username = ".$username);
                //if user validates
		if ($result) 
                {
			$msg->DisplayMessage('usernameinuse');
			return false;
		}
		if ( strip_tags($_POST ['username']) != $_POST ['username']) {
			$msg->DisplayMessage('illegalchar');
			return false;
		}
			
		
		//valid_email function outside of class for ease of modifying the reg string for pattern match
//		if (! valid_email ( $_POST ['email'] )) {
//			$this->msg = "<p id='lt_msg'>the email you supplied does not appear to be valid</p>";
//			return false;
//		}
//		if (! (trim ( $_POST ['email'] ) == trim ( $_POST ['emailconfirm'] ))) {
//			$this->msg = "<p id='lt_msg'>the emails you supplied are different</p>";
//			return false;
//		}
		if (! (trim ( $_POST ['password'] ) == trim ( $_POST ['passwordconfirm'] ))) {
			$msg->DisplayMessage('mismatchpassword');
			return false;
		}
		if (strlen($_POST['password'])<4) {
			$msg->DisplayMessage('shortpassword');
			return false;
		}
		if (strlen($_POST['password'])>10) {
			$msg->DisplayMessage('longpassword');
			return false;
		}
		return true;
	
	}
	
	function check_login_request() 
        {
             	$msg = new messages;
                $log = new log;
		if ((isset($_POST ['username'])) && (isset($_POST ['password'])))
                {
			$username = $_POST ['username'];
			$password = $_POST ['password'];
                        $passwordmd = md5($password);
                	$db = new DBMS($_SESSION["preferences"]["database"]["type"],$_SESSION["preferences"]['database']['server'],$_SESSION["preferences"]["database"]["dbname"] ,$_SESSION["preferences"]['database']["user"],$_SESSION["preferences"]['database']["password"],$_SESSION["preferences"]['database']["port"]."'");
                        $result = $db->query("select * from login where username = '".$username."' and password= '".  $passwordmd."'");
                        $rsltlogin = $result->fetchAll(PDO::FETCH_ASSOC); 
			if ($result) 
                        {
                                //if user validates
                                foreach ($rsltlogin as $row)
                                {
                                    $this->username = $row['username'];
                                    $this->loginid = $row['loginid'];
                                    $_SESSION["login"]['loginid'] = $row ['loginid'];
                                    $_SESSION["login"]['username'] = $row['username'];
                                    $_SESSION["login"]['usermenuname'] = $row ['usermenuname'];
                                }
                                $log = new log;
                                $log->LogEvent(__FILE__,__CLASS__,__FUNCTION__,__LINE__,'INFO', 'logged in as ' . $_SESSION["login"]["username"] . ' with id ' . $_SESSION["login"]["loginid"]);
				return true;
			} else {
                                $result = $db->query("select username from login where username = ".$_POST['username']);
				if ($result) 
                                {
                                        $msg->DisplayMessage('unknownuser');
					$response = "Unknown User Name";
				} else {
                                        $msg->DisplayMessage('wrongpassword');
					$response = "Wrong password entered";
				}
				$log->LogEvent(__FILE__,__CLASS__,__FUNCTION__,__LINE__,'error',$response);
				return false;
			}
		
		}
 		if (!isset($_SESSION["login"]['username']))
                {
                        $msg->DisplayMessage('blankusername');
			$response = "Blank Username";
		
                }
                if (isset($response))
                {    
                    $log->LogEvent(__FILE__,__CLASS__,__FUNCTION__,__LINE__,'error',  $response);
            	    return false;
                }
                return true; 
	}
	
	function add_user_to_db() 
        {
        	$db = new DBMS($_SESSION["preferences"]["database"]["type"],$_SESSION["preferences"]['database']['server'],$_SESSION["preferences"]["database"]["dbname"] ,$_SESSION["preferences"]['database']["user"],$_SESSION["preferences"]['database']["password"],$_SESSION["preferences"]['database']["port"]);
		$loginid = $db->getLatestId('login','loginid');
                if ($result) 
                {
			$this->username = $username;
			$_SESSION["login"]['loginid'] = $loginid;
			$_SESSION["login"]['username'] = $username;
			return true;
		} else{
                        $log = new log;
                        $log->LogEvent(__FILE__,__CLASS__,__FUNCTION__,__LINE__,'error','user not added');
			return false;
                }
	}


	/* move this code to your script if you want to control when this class / session start */
	//start session
//	session_start();

	/*** start or recall any instance of login held by active session
	the object $login is availiable to your script. */
//	if (! isset ( $_SESSION["login"]['login'] )) {
//		$_SESSION["login"]['login'] = new login ( );
//	} 
//	$login= $_SESSION["login"]['login'];
	//pre process any class actions
//	$login->process_action();
	function getrecord($loginid) 
	{
		$db = new DBMS($_SESSION["preferences"]["database"]["type"],$_SESSION["preferences"]['database']['server'],$_SESSION["preferences"]["database"]["dbname"] ,$_SESSION["preferences"]['database']["user"],$_SESSION["preferences"]['database']["password"],$_SESSION["preferences"]['database']["port"]);
                $sql = "SELECT * FROM login WHERE loginid= ". $loginid;
                $result = $db->query($sql);
                if (!$result)
                {
                        $msg = new messages;
                        $msg->popupMsg ('invalidrecord',150,200,200,"Invalid Login Record","Login Record for loginid  ".$loginid." not found.");
                        return false;
                } else {
                        $this->tbllogin = $result->fetchall(PDO::FETCH_ASSOC);
                        return $this->tbllogin[0];
                }
	}
	function insertrecord() 
	{
		$log->LogEvent(__FILE__,__CLASS__,__FUNCTION__,__LINE__,'error',$query);
        	$db = new DBMS($_SESSION["preferences"]["database"]["type"],$_SESSION["preferences"]['database']['server'],$_SESSION["preferences"]["database"]["dbname"] ,$_SESSION["preferences"]['database']["user"],$_SESSION["preferences"]['database']["password"],$_SESSION["preferences"]['database']["port"]);
		$sql = $db->query("insert into login (username) VALUES ('New')");
                $result = $db->execute($sql);
		if ($result) 
                {
                    $validate = new validate;
                    $validate->DateStamp('login','loginid',$db->getLatestId('login','loginid'),$_SESSION["login"]["username"],$_SESSION['login']['username'],$_SESSION["preferences"]["database"]["dbname"]);
                    $msg = new messages;
                    $msg->DisplayMessage('recadd');
                }
                return $db->getLatestId('login','loginid');
	}
	
	 function updaterecord($loginid,$personid,$username,$password,$usermenuname) 
	 {
		$sql = 'UPDATE login SET personid= \''.$personid.'\',username= \''.$username.'\',password= \''.md5($password).'\',usermenuname= \''.$usermenuname.'\' WHERE (loginid = \''.$loginid.'\')';
        	$db = new DBMS($_SESSION["preferences"]["database"]["type"],$_SESSION["preferences"]['database']['server'],$_SESSION["preferences"]["database"]["dbname"] ,$_SESSION["preferences"]['database']["user"],$_SESSION["preferences"]['database']["password"],$_SESSION["preferences"]['database']["port"]);
		$db->query($sql);
		$validate = new validate;
		$validate->DateStamp('login','loginid',$db->getLatestId('login','loginid'),$_SESSION["login"]["username"]);
		$msg = new messages;
		$msg->DisplayMessage('recupdate');
                return;
         } 
	function deleterecord($loginid)
	{ 
		$sql = 'DELETE FROM login WHERE (loginid = \''.$loginid.'\')';
        	$db = new DBMS($_SESSION["preferences"]["database"]["type"],$_SESSION["preferences"]['database']['server'],$_SESSION["preferences"]["database"]["dbname"] ,$_SESSION["preferences"]['database']["user"],$_SESSION["preferences"]['database']["password"],$_SESSION["preferences"]['database']["port"]);
		$db->query($sql);
		$msg = new messages;
		$msg->DisplayMessage('recdelete');
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
			unset($_SESSION[$key]);
		}
	}
	function usestdmenu($userid=0,$menuname='') 
	{
		$sql = "INSERT INTO usermenu (menuname,orderfield,mastermenuid,text) SELECT menuname,orderfield,mastermenuid,text FROM stdusermenu WHERE menuname = '".$menuname."'";
	       	$db = new DBMS($_SESSION["preferences"]["database"]["type"],$_SESSION["preferences"]['database']['server'],$_SESSION["preferences"]["database"]["dbname"] ,$_SESSION["preferences"]['database']["user"],$_SESSION["preferences"]['database']["password"],$_SESSION["preferences"]['database']["port"]);
		$result = $db->query($sql);
		$sql = "UPDATE usermenu SET userid = '".$userid."' WHERE menuname = '".$menuname."'";
		$result = $db->query($sql);
		$validate = new validate;
		$validate->DateStamp('usermenu','usermenuid',$db->getLatestId('usermenu','usermenuid'),$_SESSION["login"]["username"],$_SESSION['login']['username'],$_SESSION["preferences"]["database"]["dbname"]);
		$msg = new messages;
		$msg->DisplayMessage('copy from stdusermenu');
		$log = new log;
//		$log->LogEvent(__FILE__,__CLASS__,__FUNCTION__,__LINE__,'INFO',  $sql);
		return;
	}
	function savestdmenu($stdname = '',$menuname='') 
	{
		$sql = "INSERT INTO stdusermenu (menuname,orderfield,mastermenuid,text) SELECT menuname,orderfield,mastermenuid,text FROM usermenu WHERE menuname = '".$menuname;
        	$db = new DBMS($_SESSION["preferences"]["database"]["type"],$_SESSION["preferences"]['database']['server'],$_SESSION["preferences"]["database"]["dbname"] ,$_SESSION["preferences"]['database']["user"],$_SESSION["preferences"]['database']["password"],$_SESSION["preferences"]['database']["port"]);
		$result = $db->query($sql);
		$sql = "UPDATE stdusermenu SET stdname = '".$stdname."' WHERE menuname = '".$menuname."'";
		$result = $db->query($sql);
		$validate = new validate;
		$validate->DateStamp('stdusermenu','stdname',$db->getLatestId('stdusermenu','stdusermenu1d'),$_SESSION["login"]["username"],$_SESSION['login']['username'],$_SESSION["preferences"]["database"]["dbname"]);
		$msg = new messages;
		$msg->DisplayMessage('copy to stdusermenu');
		$log = new log;
//		$log->LogEvent(__FILE__,__CLASS__,__FUNCTION__,__LINE__,'INFO',  $sql);
		return;
	}
	function deletestdmenu($menuname='') 
	{
        	$db = new DBMS($_SESSION["preferences"]["database"]["type"],$_SESSION["preferences"]['database']['server'],$_SESSION["preferences"]["database"]["dbname"] ,$_SESSION["preferences"]['database']["user"],$_SESSION["preferences"]['database']["password"],$_SESSION["preferences"]['database']["port"]);
		$db->query($sql);
		$msg = new messages;
		$msg->DisplayMessage('recdelete');
		$log = new log;
//		$log->LogEvent(__FILE__,__CLASS__,__FUNCTION__,__LINE__,'INFO',  $sql);
       }
  }
?>