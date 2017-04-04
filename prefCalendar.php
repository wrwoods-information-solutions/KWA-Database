<?php session_start(); ?>
<!DOCTYPE html>
<html>
    <head>
        <link href="style.css" rel="stylesheet" type="text/css">
        <meta charset="UTF-8">
        <title class="title">Preferences Calendar</title>
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
                if ($_POST['deldateformat'])
		{
			$pref->deletepreferences('dateformat');
		}else{
			if (!$_POST['dateformat'] == $_SESSION['preferences']['general']['dateformat'])
			{
	
                            $pref->updatepreferences('dateformat',$_POST['dateformat']);
			}
		}
            }
?>
</head>
    <body>
<?PHP
    $pref->header('Preferences Calendar');
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
        <form id="prefmaster" name="preferences"  action="prefCalendar.php" method="post" enctype="multipart/form-data" >
            <table border="0" cellpadding="0" cellspacing="0" width="100%">
                <tr>
                        <td class="subtitle">Date Format</td>
                        <td><input name="dateformat" value="<?php echo $_SESSION['preferences']['dateformat']; ?>" type="text" class="body" size="65" /></td>
                        <td class="subtitle">Delete</td>
                        <td><input type="checkbox" name="deldateformat" value="No" /></td>
                </tr>	
 		<tr>
			<td colspan="2"><input name="save" type='submit' value="Save" /></td>
		</tr>
           </table>
       </form>   
    </body>
</html>
