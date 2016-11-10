<?php session_start(); ?>
<!DOCTYPE html>
<html>
    <head>
        <link href="style.css" rel="stylesheet" type="text/css">
        <meta charset="UTF-8">
        <title class="title">Setup Preferences</title>
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
            if (!isset($_POST['delserver']))
                $_POST['delserver'] = false;
            if (!isset($_POST['deldbname']))
                $_POST['deldbname'] = false;
            if (!isset($_POST['deluser']))
                $_POST['deluser'] = false;
            if (!isset($_POST['delpassword']))
                $_POST['delpassword'] = false;
            if ($_POST['save'] == 'Save') 
            {
		if ($_POST['delserver'])
		{
			$pref->deletepreferences('server');
		}else{
                        $pref->updatepreferences('server','database',$_POST['server']);
		}
		if ($_POST['deldbname'])
		{
			$pref->deletepreferences('dbname');
		}else{
			$pref->updatepreferences('dbname','database',$_POST['dbname']);
		}
		if ($_POST['deluser'])
		{
			$pref->deletepreferences('user');
		}else{
			$pref->updatepreferences('user','database',$_POST['user']);
		}
		if ($_POST['delpassword'])
		{
			$pref->deletepreferences('password');
		}else{
			$pref->updatepreferences('password','database',$_POST['password']);

		}
                if ($_POST['deldateformat'])
		{
			$pref->deletepreferences('dateformat');
		}else{
			if (!$_POST['dateformat'] == $_SESSION['preferences']['general']['dateformat'])
			{
	
                            $pref->updatepreferences('dateformat',$_POST['dateformat']);
			}
		}
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
    $pref->header('Setup Preferences');
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
        <form id="prefmaster" name="preferences"  action="setuppreferences.php" method="post" enctype="multipart/form-data" >
            <table border="0" cellpadding="0" cellspacing="0" width="100%">
		<tr>
			<td class="subtitle">Server</td>
			<td><input name="server" value="<?php echo $_SESSION['preferences']['database']['server']; ?>" type="text" class="body" size="65" /></td>
 			<td class="subtitle">Delete</td>
			<td><input type="checkbox" name="delserver" value="No" /></td>
		</tr>	
		<tr>
			<td class="subtitle">DBName</td>
			<td><input name="dbname" value="<?php echo $_SESSION['preferences']['database']['dbname'];  ?>" type="text" class="body" size="65" /></td>
 			<td class="subtitle">Delete</td>
			<td><input type="checkbox" name="deldbname" value="No" /></td>
		</tr>	
		<tr>
			<td class="subtitle">User</td>
			<td><input name="user" value="<?php echo $_SESSION['preferences']['database']['user'];?>" type="text" class="body" size="65" /></td>
			<td class="subtitle">Delete</td>
			<td><input type="checkbox" name="deluser" value="No" /></td>
		</tr>	
		<tr>
			<td class="subtitle">Password</td>
			<td><input name="password" value="<?php echo $_SESSION['preferences']['database']['password'];?>" type="text" class="body" size="65" /></td>
 			<td class="subtitle">Delete</td>
			<td><input type="checkbox" name="delpassword" value="No" /></td>
		</tr>
                <tr>
                        <td class="subtitle">Date Format</td>
                        <td><input name="dateformat" value="<?php echo $_SESSION['preferences']['dateformat']; ?>" type="text" class="body" size="65" /></td>
                        <td class="subtitle">Delete</td>
                        <td><input type="checkbox" name="deldateformat" value="No" /></td>
                </tr>	
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
