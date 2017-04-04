<?php session_start(); ?>
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<link href="style.css" rel="stylesheet" type="text/css"></link>
<script type="text/javascript" src="popup-window.js"></script>
<title>KWA Index</title>
<?php
error_reporting(E_ALL & E_WARNING);
require_once "class.login.php";
require_once "class.log.php";
require_once 'class.pdodatabase.php';
require_once 'class.validate.php';
require_once "class.preferences.php";
if (!isset($_SESSION['login']['username']))
    $_SESSION['login']['username'] = '';
if (!isset($_SESSION['login']['loginid']))
    $_SESSION['login']['loginid'] = '';
if(!isset($_POST['LC_ACTION']))
    $_POST['LC_ACTION'] = '';
$pref = new preferences;
if (!isset($_SESSION["preferences"]["database"]))
{
    $preferences = new preferences();
    $_SESSION["preferences"]["database"]["type"] = "mysql";
    $_SESSION["preferences"]["database"]["server"] = "localhost";
    $_SESSION["preferences"]["database"]["dbname"] = "kwa";
    $_SESSION["preferences"]["database"]["user"]   = "root";
    $_SESSION["preferences"]["database"]["password"] =  "";
    $_SESSION["preferences"]["database"]["port"] = '' ;
    $_SESSION['preferences']['dateformat'] = 'Y-M-d';
}
$pref->loadpreferences();
if ($_POST['LC_ACTION']== 'Login')
{
	$login = new login;
        $login->checklogout();
        $login->process_action('login');
    
}
?>
</head>
<body>
<table width="100%" bgcolor="#0099FF">
  <tr>
      <td colspan="2" height="96" align="left"><img src="<?php echo 'images/newlogo.gif'?>"></td>
      <td width="25%"align="left">
          <table>
              <tr>
                <td width="90" align="center" class="subtitle">UserName</td>
                <td width="96" align="center" class="subtitle">Password</td>
                <td width="41" align="center"></td>
              </tr>
              <tr>
                    <form id="login" name="login" method="post" action="home.php?LC_ACTION=Login"  enctype="multipart/form-data">
             <td><input type="text" name="username" class="smbody" size="20" value="" />          </td>
                        <td><input type="password" name="password" class="smbody" value="" /></td>
                        <td><input type="submit" name="LC_ACTION" class="smbody" value="Login" /></td>
  </form>                        
                </tr>  
         </table></td>
  </tr>
</table>   
<table width="100%" background="Images/HeavenBackground.jpg">
  <tr>
   <td colspan="3" align="center" class="headtitle">Information Management System</td>
  </tr>
  <tr>
    <td colspan="3" align="center" class="body">For</td>
  </tr>
  <tr>
   <td colspan="3" align="center" class="headtitle">KW AccessAbility</td>
  </tr>
  <tr>
    <td colspan="3" align="center" class="title">659 King Street East, Suite 250 Kitchener, ON N2G 2M4</td> 
  </tr>  
  <tr>
    <td colspan="3" align="center" class="title">TEL: (519) 885-6640    FAX: (519) 885-4526   T.D.D.: (519) 885-4526</td> 
  </tr>  
  <tr>
    <td colspan="3" align="center" class="title">e-mail: kwaa@kwa.on.ca       web: http://www.kwa.on.ca</td> 
  </tr>
  <tr>
      <td>&nbsp;</td>      
  </tr>  
  <tr>
    <td colspan="3" align="center" class="smbody">Created by</td>
  </tr>
  <tr>
    <td colspan="3" align="center"><img src="Images/Light Bulb.JPG" width="100" height="130" /></td></td>
  </tr>
  <tr>
    <td colspan="3" align="center" class="smbody">WR Woods Information Solutions Inc.</td>
  </tr>
  <tr>
    <td colspan="3" align="center" class="smbody">304-446 Kingscourt Drive</td>
  </tr>
  <tr>
    <td height="17" colspan="3" align="center" class="3">Waterloo, Ontario</td>
  </tr>
  <tr>
    <td colspan="3" align="center" class="smbody">N2K 3R9</td>
  </tr>
  <tr>
    <td colspan="3" align="center" class="smbody">519-886-6649</td>
  </tr>
  <tr>
    <td colspan="3" align="center" class="smbody">ric@wrwoods.com</td>
  </tr>
</table>
</body>
</html>
