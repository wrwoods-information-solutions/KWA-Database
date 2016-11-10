 <?php session_start(); ?>
<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN">
<HTML>
<HEAD>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1">
<link href="style.css" rel="stylesheet" type="text/css">
<script type="text/javascript" src="popup-window.js"></script>
<TITLE>Output Notes</TITLE>
<?php
require_once "class.preferences.php";
require_once "class.displaydata.php";
require_once "displaynotes.php";
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
$db = new DBMS($_SESSION["preferences"]["database"]["type"],$_SESSION["preferences"]["database"]['server'],$_SESSION["preferences"]["database"]["dbname"] ,$_SESSION["preferences"]["database"]["user"],$_SESSION["preferences"]["database"]["password"],$_SESSION["preferences"]["database"]["port"]);
if(isset($_GET["notestype"]))
{
    $_SESSION["tblnote"]['notes']["notestype"] = $_GET["notestype"];
}
 if(isset($_GET["notenum"]))
{
    $_SESSION["tblnote"]['notes']["notenum"] = $_GET["notenum"];
}
if(isset($_GET["noteattachid"]))
{
    $_SESSION["tblnote"]['notes']["noteattachid"] = $_GET["noteattachid"];
}    
  if(isset($_GET["noteauthourid"]))
{
    $_SESSION["tblnote"]['notes']["noteauthourid"] = $_GET["noteauthourid"];
}    
   if(isset($_GET["notedate"]))
{
     $_SESSION["tblnote"]['notes']["notedate"] = $_GET["notedate"];
}
if(isset($_GET["notereturnurl"]))
{
    $_SESSION["tblnote"]['notes']["notereturnurl"] = $_GET["notereturnurl"];
}
  if (!isset($_POST['refresh']))
    $_POST['refresh'] ='';
 if (!isset($_POST['save']))
    $_POST['save'] ='';
if (!isset($_POST['delete']))
    $_POST['delete'] ='';
if (!isset($_POST['clear']))
    $_POST['clear'] ='';
if (!isset($_POST['breturnurl']))
    $_POST['breturnurl'] ='';
if (!isset($_SESSION['displaydata']["notes"]["displaynotes"]))
{
       $_SESSION['displaydata']["notes"]["displaynotes"] = false;
}
if (!isset($_SESSION['displaydata']["notes"]["click"]))
{
       $_SESSION['displaydata']["notes"]["click"] = false;
}
if ($_POST['breturnurl'] == 'Return')
{
    $validate = new validate();
    $validate->do_redirect($_SESSION["tblnote"]['notes']["notereturnurl"]);
}
 if ($_POST['refresh'] == 'Refresh')
{
       $_SESSION['displaydata']["notes"]["click"] = true;
}
$notes = new DisplayData($db);
$notes->setdisplaydata('notes');
$notes->SetTemplate('displaynotes',$db);
// Set the query, select all rows from the people table
$notes->setQuery("notes", "notes","","");
$notes->setinsertvalue(array("notes"=>"New Notes"));
$notes->setPrimaryID('notesid') ;
$notes->setConstantFields(array("organizationid"=>"'".$_SESSION["organization"]['organizationid']."'"));
$notes->setURLConstant("outputnotes.php");
$notes->setOrder('notesid');

// Hide ID field
 $notes->hidefield('personid');
// Show reset grid control
$notes->showReset();

// setting inline edit
$notes->SetInLineEdit(false);
// Add standard control
 $notes->addStandardControl(displaydata::STDCTRL_INLINEEDIT,"outputnotes.php",displaydata::TYPE_PHPFUNCTION);
// Add create control
 $notes->showCreateButton("outputnotes.php",displaydata::TYPE_INLINEADDRECORD, 'New');

// Show checkboxes

// Show row numbers
$notes->showRowNumber(true);
// Change the amount of results per page
$notes->setResultsPerPage(1);

// Change headers text
$notes->SetFieldHeader('notes', 'Notes:');
//  set field type
$notes->SetFieldType('notes', displaydata::TYPE_NOTE,array('name'=>'personnotes','class' => 'subtitle','text'=>'Display Person Note','size'=>15,'outbaseurl'=>'outputnotes.php','inbaseurl'=>'inputnotes.php','returnurl'=>'inputperson','notestype'=>'pers'));
//  set inlineedit field type
$notes->SetInlineFieldType('notes', displaydata::INLINE_NOTE,array('name'=>'personnotes','class' => 'subtitle','text'=>'Add Person Note','size'=>15,'outbaseurl'=>'outputnotes.php','inbaseurl'=>'inputnotes.php','returnurl'=>'inputperson','notestype'=>'pers'));

// Stop ordering
$notes->hideOrder(false);
?>
</HEAD>
<BODY>
<?PHP
$pref->header('Output Notes');
$validate = new validate;
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
    <form id="outputnotes" name="selectnote"  action="outputnotes.php" method="post" enctype="multipart/form-data" >
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
                            echo       '</td>';
                       }
                   ?>        
	</tr>
	<tr>
            <td>
        	<input type="submit" name="breturnurl" value="Return" />
            </td>
        </tr>
</table>
    </form>        
</BODY>