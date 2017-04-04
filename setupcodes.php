<?php session_start(); ?>
<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN">
<HTML>
<HEAD>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1">
<link href="style.css" rel="stylesheet" type="text/css">
<script type="text/javascript" src="popup-window.js"></script>

<TITLE>KWA Code Setup</TITLE>
<?php
    require_once "class.preferences.php";
    require_once "class.DisplayData.php";
    require_once "class.login.php";
    require_once "class.messages.php";
    require_once "class.codes.php";
    if(isset($_GET["page"]))
        $_SESSION['displaydata'][$_SESSION ["displaydata"] ["name"]]["page"] = (int)$_GET["page"];
    $pref = new preferences;
    $pref->basicincludes();
    $pref->loadpreferences();
    $login = new login();
    $login->checklogin();
    $login->checklogout();
    $messages = new messages;
    $codes = new codes;
    if (!isset($_POST['refreshtable']))
        $_POST['refreshtable'] = '';
    if (!isset($_POST['refreshfield']))
        $_POST['refreshfield'] = '';
    if (!isset($_SESSION["displaydata"]["tablename"]))
        $_SESSION["displaydata"]["tablename"] = '';
    if (!isset($_SESSION["displaydata"]["fieldname"]))
        $_SESSION["displaydata"]["fieldname"] = '';
    if (!isset($_SESSION["displaydata"]["displayfield"]))
        $_SESSION["displaydata"]["displayfield"] = false;
    if (!isset($_SESSION["displaydata"]["displaygrid"]))
        $_SESSION["displaydata"]["displaygrid"] = false;
    if (!isset($_SESSION["displaydata"]["loadtable"]))
        $_SESSION["displaydata"]["loadtable"] = false;
    $validate = new validate;
    if ($_POST['refreshtable'] == 'Refresh')
    {
            $_SESSION["displaydata"]["tablename"] = $_POST['selecttable'];
            $_SESSION["displaydata"]["loadtable"] = false;
            $_SESSION["displaydata"]["displayfield"] = true; 
            $_SESSION["displaydata"]["displaygrid"] = false;
    }        
    if ($_POST['refreshfield'] == 'Refresh')
    {
            $_SESSION["displaydata"]["fieldname"] = $_POST['selectfield'];
            if ($_SESSION["displaydata"]["fieldname"] == '')
            {
                    $_SESSION["displaydata"]["displaygrid"] = false;
            }else{
                    $_SESSION["displaydata"]["loadtable"] = true;
                    $_SESSION["displaydata"]["displaygrid"] = true;
            }
    }
// Load the database adapter
    if ($_SESSION["displaydata"]["loadtable"])
    {    
	$db = new DBMS($_SESSION["preferences"]["database"]["type"],$_SESSION["preferences"]["database"]['server'],$_SESSION["preferences"]["database"]["dbname"],$_SESSION["preferences"]["database"]["user"],$_SESSION["preferences"]["database"]["password"],$_SESSION["preferences"]["database"]["port"]);

// Load the displaydata class
	$codesgrid = new DisplayData($db);
	$codesgrid->setdisplaydata('codesgrid');
        $codesgrid->SetTemplate('Displaygrid',$db);
        $codesgrid->setURLConstant("setupcodes.php");
// Set the query, select all rows from the people table
	$codesgrid->setQuery("codesid,seqno,code,title,description", "codes","codesid","(tblname = '".$_SESSION["displaydata"]["tablename"] ."') and (fldname = '".$_SESSION["displaydata"]["fieldname"]."')");
        $codesgrid->setOrder("seqno");
	$codesgrid->setConstantFields(array("tblname"=>"'".$_SESSION["displaydata"]["tablename"]."'","fldname"=>"'".$_SESSION["displaydata"]["fieldname"]."'"));
//        $codesgrid->setinsertvalue(array("seqno"=>99,"code"=>"'New Code'","title"=>"'New Title'","description"=>"'New Description'"));
        $codesgrid->SetPrimaryID('codesid') ;
// Hide ID field
	$codesgrid->hidefield('codesid');
// Show reset grid control
	$codesgrid->showReset();

// setting inline edit
	$codesgrid->SetInLineEdit(true);
// Add standard control
	$codesgrid->addStandardControl(DisplayData::STDCTRL_INLINEEDIT,"setupcodes.php",DisplayData::TYPE_PHPFUNCTION);
// Add create control
	$codesgrid->showCreateButton("setupcodes.php", DisplayData::TYPE_INLINEADDRECORD, 'Add New Code');
       $codesgrid->SetFieldType('seqno', DisplayData::TYPE_TEXT);
       $codesgrid->SetFieldType('code', DisplayData::TYPE_TEXT);
       $codesgrid->SetFieldType('title', DisplayData::TYPE_TEXT);
       $codesgrid->SetFieldType('description', DisplayData::TYPE_TEXT);

// Show checkboxes

// Show row numbers
	$codesgrid->showRowNumber();

// Change the amount of results per page
	$codesgrid->setResultsPerPage(5);

// Change headers text
	$codesgrid->SetFieldHeader('seqno', 'Seq #');
	$codesgrid->SetFieldHeader('code', 'Code');
	$codesgrid->SetFieldHeader('title', 'Title');
	$codesgrid->SetFieldHeader('description', 'Description');
//  set field type

//  set inlineedit field type
	$codesgrid->SetInlineFieldType('seqno', DisplayData::INLINE_TEXT, array('name' => 'seqno', 'class' => '', 'size' =>'5', 'displayvalue'=> 'seqno')); // seq. number
	$codesgrid->SetInlineFieldType('code', DisplayData::INLINE_TEXT, array('name' => 'code', 'class' => '', 'size' =>'20', 'displayvalue'=> 'code')); // Code
	$codesgrid->SetInlineFieldType('title', DisplayData::INLINE_TEXT,array('name' => 'title', 'class' => '', 'size' =>'20','displayvalue' => 'title')); // Title
	$codesgrid->SetInlineFieldType('description', DisplayData::INLINE_TEXT, array('name' => 'description', 'class' => '', 'size' =>'20','cols' =>'20', 'rows' => '10','displayvalue'=> 'description'));
//	$codesgrid->SetInlineFieldType('controltxt', DisplayData::INLINE_TEXT, array('name' => 'controltxt', 'class' => '', 'size' =>'10','displayvalue'=> 'controltxt'));
	// Stop ordering
	$codesgrid->hideOrder();
	$codesgrid->setorder('seqno');
   }
?>
</HEAD>
<BODY>
    <?PHP
        $pref->header('Setup Codes')
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
    <form id="codes" name="codes"  action="setupcodes.php" method="post" enctype="multipart/form-data" >	    	
	<table width="100%"  border="0" background="Images/HeavenBackground.jpg">
	<tr> 
            <td class="subtitle">Table Name		
                    <?php
                            echo $validate->tableCombo("selecttable","body",true,$_SESSION["displaydata"]["tablename"])
                    ?>
                <input type="submit" name="refreshtable" value="Refresh" />      
            </td>
	</tr>
	<tr> 
            <td class="subtitle">Field Name
                <?php
                    if($_SESSION["displaydata"]["displayfield"])
			echo $validate->FieldCombo("selectfield",$_SESSION["displaydata"]["tablename"],"body",true,$_SESSION["displaydata"]["fieldname"])
		?>
                <input type="submit" name="refreshfield" value="Refresh" />
            </td>
	</tr>
        </table>    
    </form>    
  <?php
 	if ($_SESSION["displaydata"]["displaygrid"])
        {                            
  // Print the data
             $codesgrid->printdata();
        }
  ?>		
</BODY>
