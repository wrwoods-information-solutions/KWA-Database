<?php session_start(); ?>
<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN">
<HTML>
<HEAD>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1">
<link href="style.css" rel="stylesheet" type="text/css">
<script type="text/javascript" src="popup-window.js"></script>
<TITLE>Under Construction</TITLE>
<?php
require_once "class.preferences.php";
if(isset($_GET["page"]))
{
    $_SESSION['displaydata'][$_SESSION ["displaydata"] ["name"]]["page"] = (int)$_GET["page"];
}
$pref = new preferences;
$pref->basicincludes();
$pref->loadpreferences();
$login = new login();
$login->checklogin();
$login->checklogout();
?>
</HEAD>
<BODY>
<?PHP
$pref->header('Under Construction');
?>
    <table class="tbl" width="100%">
        <tr>
            <td colspan="13">
                <?PHP
                    $pref->loadmenu();
                ?>
            </td>
        </tr>
    </table>    
<table width="100%" border="0" background="Images/HeavenBackground.jpg">
	<tr >
		<td width="100%" align="center">
			<img src="Images/UnderConstruction.gif" alt="picture" name="pic" width="200" height="200" align="middle">
		</td>
	</tr>
</table>	
</BODY>