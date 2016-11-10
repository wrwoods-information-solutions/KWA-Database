<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN">
<HTML>
<HEAD>
<link href="style.css" rel="stylesheet" type="text/css">
<TITLE>Display Session</TITLE>
<?php
require_once ("class.menu.php");
require_once "class.log.php";
require_once "class.validate.php";
require_once "class.messages.php";
require_once "class.pdodatabase.php";
//       start or recall any instance of login held by active session
//       the object $login is availiable to your script. 
	?>
</HEAD>
<BODY>
<table width="100%" border="0">
<tr>
    <td align="center" class="headtitle">Display SESSION()</td>
   </tr>
</table>

<table width="100%" border="0">
<?php
		echo '$_SESSION[] = <br>';
		var_dump($_SESSION);
		echo '<br>';
?>
</table>
</BODY>
