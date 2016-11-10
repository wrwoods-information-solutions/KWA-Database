<?php session_start(); ?>
<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN">
<HTML>
<HEAD>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1">
<link href="style.css" rel="stylesheet" type="text/css">
<script type="text/javascript" src="popup-window.js"></script>
<script src='//cdn.tinymce.com/4/tinymce.min.js'></script>
<script>
  tinymce.init({
    selector: 'inputnotes'
  });
</script>

<TITLE>Input Notes</TITLE>
<?php
require_once "class.preferences.php";
require_once "class.notes.php";
require_once "class.validate.php";
$pref = new preferences;
$validate = new validate;
$pref->basicincludes();
$pref->loadpreferences();
$login = new login();
$login->checklogin();
$login->checklogout();
$default = '';
$_SESSION["tblnote"]['notes'] = '';
if (!isset($_SESSION['displaydata']["notes"]["displaynotes"]))
    $_SESSION['displaydata']["notes"]["displaynotes"] = false;
if (!isset($_POST['refresh']))
    $_POST['refresh'] ='';
if (!isset($_POST['save']))
    $_POST['save'] ='';
if (!isset($_POST['delete']))
    $_POST['delete'] ='';
if (!isset($_POST['clear']))
    $_POST['clear'] ='';
if (!isset($_POST['returnurl']))
    $_POST['returnurl'] ='';
if ($_POST['refresh'] == 'Refresh')
{

}
if ($_POST['save'] == 'Save')
{

}
if ($_POST['delete'] == 'Delete')
{

}
if ($_POST['clear'] == 'Clear')
{

}
if ($_POST['returnurl'] == 'Return')
{
    $validate->do_redirect($_SESSION['displaydata'][$_SESSION ["displaydata"] ["name"]]["inlinetype"]['type']['notes']['returnurl']);
}
?>
</HEAD>
<BODY>
<?PHP
$pref->header('Input Notes');
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
        <form id="inputnotes" name="selectnote"  action="outputnotes.php" method="post" enctype="multipart/form-data" >
    <table width="100%" border="0" background="Images/HeavenBackground.jpg">
        <tr>
            <td>
                <?PHP
                    if(isset($_SESSION["tblnote"]['notes']["notestype"]))
                    {
                        echo 'Type of Note:  '.$_SESSION["tblnote"]['notes']["notestype"];
                    }else{
                        echo 'Type of Note:  '.$validate->CodeCombo("notes","notestype","body",'');
                    }
                ?>  
            </td>
            <td>
                <?PHP
                    if(isset($_SESSION["tblnote"]['notes']["notenum"]))
                    {
                        echo 'Number:  '.$_SESSION["tblnote"]['notes']["notenum"];
                    }else{
                        echo 'Number:  <input type="text" name="notenum" value="">';
                    }
                ?>    
            </td>
            <td>
                <?PHP
                    if(isset($_SESSION["tblnote"]['notes']["noteauthourid"]))
                    {
                        echo 'Authour ID:  '.$_SESSION["tblnote"]['notes']["noteauthourid"];
                    }else{
                        echo 'Authour ID:  <input type="text" name="authourid" value="">';
                    }
                ?>       
            </td>
        </tr>
        <tr>
            <td>
                <?PHP
                    $validate = new validate();
                    if(isset($_SESSION["tblnote"]['notes']["noteattachid"]))
                    {
                        echo 'Attach ID:  '.$validate->FieldDisplay('person','fullname' , 'personid', $_SESSION["tblnote"]['notes']["noteattachid"]);
                    }else{
                        echo 'Attach ID: '. $validate->combobox('slectattachid','person','','lastname','ASC','personid','fullname','body',true,array(),'',false,false,'',false,40,$_SESSION["preferences"]["database"]["dbname"]);
                    }
                ?>       
            </td>
            <td>
                <?PHP
                    if(isset($_SESSION["tblnote"]['notes']["notedate"]))
                    {
                         echo 'Date:  '.$_SESSION["tblnote"]['notes']["notedate"];
                    }else{
                        echo $validate->DateCombo("notedate","subtitle","body","Date:  ","");                       
                    }
                ?>    
            </td>
            <td>
                <?PHP
                    if(isset($_SESSION["tblnote"]['notes']["notereturnurl"]))
                    {
                        echo 'Return Url:  '.$_SESSION["tblnote"]['notes']["notereturnurl"];
                    }else{
                        echo 'Return Url:  <input type="text" name="returnurl" value="">';
                    }
                ?>    
            </td>
        </tr>
        <tr>
            <td>
                <input type="submit" name="refresh" value="Refresh" />
            </td>    
        </tr>
        <tr>
            <?PHP 
                          if ($_SESSION['displaydata']["notes"]["displaynotes"])
                          {
                            echo    '<tr>
                                        <td class ="subtitle">Note:</td>
                                    </tr>
                                    <tr>
                                       <td>';
                                            $_SESSION["displaydata"] ["name"] = 'notes';
                                            $notes->printdata();
                            echo       '</td>
                                    </tr>';
                           }
                   ?>        
	</tr>
        <tr>
            <td>
                <input type="submit" name="refresh" value="Refresh" />
            </td>    
        </tr>
        <tr>
            <td colspan="2" >
                <textarea id="inputnotes" name="inputnotes" class="body" cols="115" rows="15" ><?PHP echo $_SESSION["tblnote"]['notes']; ?></textarea>		
            </td>
        </tr>
        <tr>
            <td>
                <input type="submit" name="save" value="Save" />
                <input type="submit" name="delete" value="Delete" />
        	<input type="submit" name="clear" value="Clear" />
        	<input type="submit" name="returnurl" value="Return" />
            </td>
        </tr>
</table>
</form>    
</BODY>