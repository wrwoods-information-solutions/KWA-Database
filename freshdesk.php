 <?php session_start(); ?>
<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN">
<HTML>
    <HEAD>
        <meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1">
        <link href="style.css" rel="stylesheet" type="text/css">
        <script type="text/javascript" src="popup-window.js"></script>

        <TITLE>KWA Freshdesk</TITLE>
        <?php
        require_once "class.preferences.php";
        require_once "class.validate.php";
        require_once "class.login.php";
        require_once "class.log.php";
        require_once "class.menu.php";
        $pref = new preferences;
        $pref->loadpreferences();
        $login = new login();
        $login->checklogin();
        $login->checklogout();
        echo "<script>window.location = 'https://wrwis.freshdesk.com/support/home'</script>";
       ?>  
   </HEAD>
    <BODY>
        <?PHP
        $pref->header('Freshdesk')
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
    </BODY>
