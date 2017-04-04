<?php session_start(); ?>
<!DOCTYPE html>
<html>
    <head>
        <link href="style.css" rel="stylesheet" type="text/css">
        <meta charset="UTF-8">
        <title class="title">Preferences CSS</title>
        <?php
            require_once "class.preferences.php";
            if (!isset($_SESSION["preferences"]))
            {
                $_SESSION["preferences"]["database"]["type"] = "mysql";
                $_SESSION["preferences"]["database"]["server"] = "localhost";
                $_SESSION["preferences"]["database"]["dbname"] = "kwa";
                $_SESSION["preferences"]["database"]["user"]   = "root";
                $_SESSION["preferences"]["database"]["password"] =  "";
                $_SESSION["preferences"]["database"]["port"] = '' ;
                $_SESSION['preferences']['dateformat'] = 'Y-M-d';
            }
            $pref = new preferences;
            $pref->basicincludes();
            $pref->loadpreferences();
            $messages = new messages;
            if (!isset($_POST['save']))
                $_POST['save'] = ' ';
            if ($_POST['save'] == 'Save') 
            {
		if ($_POST['delmenubg'])
		{
			$pref->deletepreferences('menubg');
		}else{
			if (!$_POST['menubg'] == $_SESSION['preferences']['general']['menubg'])
			{
				$pref->updatepreferences('menubg',$_POST['menubg']);
			}
		}
		if ($_POST['delbodybg'])
		{
			$pref->deletepreferences('bodybg');
		}else{
			if (!$_POST['bodybg'] == $_SESSION['preferences']['general']['bodybg'])
			{
				$pref->updatepreferences('bodybg',$_POST['bodybg']);
			}
		}
	}
?>
</head>
    <body>
<?PHP
    $pref->header('Preferences CSS');
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
        <form id="prefmaster" name="preferences"  action="prefCSS.php" method="post" enctype="multipart/form-data" >
            <table border="0" cellpadding="0" cellspacing="0" width="100%">
                <tr>
                    <td class="subtitle">Menu Background</td>
                    <td><input name="menubg" type="file" class="body" accept="image" /></td>
                    <td class="subtitle">Delete</td>
                    <td><input type="checkbox" name="delmenubg" value="No" /></td>
                </tr>	
                <tr>
                        <td class="subtitle">Body Background</td>
                        <td><input name="bodybg" type="file" class="body" accept="image/" /></td>
                        <td class="subtitle">Delete</td>
                        <td><input type="checkbox" name="delbodybg" value="No" /></td>
                </tr>	
		<tr>
			<td colspan="2"><input name="save" type='submit' value="Save" /></td>
		</tr>
            </table>
       </form>   
    </body>
</html>
