<?php session_start(); ?>
<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN">
<HTML><!-- InstanceBegin template="/Templates/main.dwt" codeOutsideHTMLIsLocked="false" -->
<HEAD>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1">
<link href="style.css" rel="stylesheet" type="text/css">
<script type="text/javascript" src="popup-window.js"></script>
<TITLE>Under Construction</TITLE>
<?php
require_once "class.preferences.php";
$pref = new preferences;
$pref->basicincludes();
$pref->checklogin();
?>
</HEAD>
<BODY>
<?PHP
$pref->header('Under Construction');
?>
<table width="100%" border="0" background="Images/HeavenBackground.jpg">
	<tr >
		<td width="100%" align="center">
			<img src="Images/UnderConstruction.gif" alt="picture" name="pic" width="200" height="200" align="middle">
		</td>
	</tr>
</table>	
</BODY>