<?php session_start(); ?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<link href="style.css" rel="stylesheet" type="text/css"></link>
<script type="text/javascript" src="popup-window.js"></script>
<title>KWA Home</title>
<?php
    require_once "class.preferences.php";
    require_once "class.digitalclock.php";
    require_once "class.login.php";
    $login = new login;
    $pref = new preferences;
    $pref->basicincludes();
    $pref->cleanSESSION();
    $pref->loadpreferences();
     $login->checklogin();
    $login->checklogout();
?>
</head>
<body>
    <?PHP
        $pref->header('Home');
    ?>
<table width="100%" background="Images/HeavenBackground.jpg">
    <tr>
        <td>
            <?PHP
                $pref->loadmenu();
            ?>
        </td>
    </tr>      
  <tr>
        <td class="title">
            <?PHP
                echo date('F d, Y');
            ?>    
        </td>
      <td class="title" align="left">
           <?PHP
                $clock=new DigitalClock();
                echo $clock->jsDigitalClock(0, 0);
            ?>
        </td>    
   </tr>
	<tr >
		<td align="center">
			<img src="Images/UnderConstruction.gif" alt="picture" name="pic" width="200" height="200" align="middle">
		</td>
	</tr>
</table>
</body>
</html>
