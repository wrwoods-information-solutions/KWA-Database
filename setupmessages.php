<?php session_start(); ?>
<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN">
<HTML>
<HEAD>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1">
<link href="style.css" rel="stylesheet" type="text/css">
<TITLE>KWA Setup Messages</TITLE>
<?php
        require_once "class.preferences.php";
        require_once "class.DisplayData.php";
        $pref = new preferences;
        $pref->basicincludes();
        $pref->loadpreferences();
        $login = new login();
        $login->checklogin();
        $login->checklogout();
        $messages = new messages;
        $msg = new messages;
       if (!isset($_POST['refreshcategory']))
            $_POST['refreshcategory'] = '';
        if (!isset($_SESSION["datagrid"]['messages']["click"]))
            $_SESSION["datagrid"]['messages']["click"] = false;
        if (!isset($_SESSION["datagrid"]['messages']["category"]))
            $_SESSION["datagrid"]['messages']["category"] = '';
        if (!isset($_SESSION["datagrid"]['messages']["newcategory"]))
            $_SESSION["datagrid"]['messages']["newcategory"] = false;
        if (!isset($_SESSION["datagrid"]['messages']["categorynew"]))
            $_SESSION["datagrid"]['messages']["categorynew"] = false;
         if (!isset($_SESSION["datagrid"]['messages']["DisplayData"]))
            $_SESSION["datagrid"]['messages']["DisplayData"] = false;
         if ($_POST['refreshcategory'] == 'Refresh')
         {
            if ($_POST['selectcategory'] == '0')
            {
                    $msg->DisplayMessage('selectcategory');   
            }
            if ($_POST['selectcategory'] == -99)
            {
                    $_SESSION["datagrid"]['messages']["DisplayData"] = false;
                     $_SESSION["datagrid"]['messages']["categorynew"] = true;
                    $_SESSION["datagrid"]['messages']["click"] = false;
            }
            else
            {
                    $_SESSION["datagrid"]['messages']["categorynew"] = false;
                    $_SESSION["datagrid"]['messages']["DisplayData"] = true;
                    $_SESSION["datagrid"]['messages']["click"] = true;
                    $_SESSION["datagrid"]['messages']["category"] = $_POST['selectcategory'];
            }
            if ($_SESSION["datagrid"]['messages']["newcategory"] )
            {
                $_SESSION["datagrid"]['messages']["newcategory"] = false;
                $_SESSION["datagrid"]['messages']["category"] = $_POST['selectcategory'];
                $messages = new messages;
                $messages->insertrecord($_SESSION["datagrid"]['messages']["category"]);
                $_POST[$_SESSION['displaydata']["name"].'editline']= 'E1';     
           }        
           if ($_SESSION["datagrid"]['messages']["categorynew"] )
           {
                $_SESSION["datagrid"]['messages']["newcategory"] = true;
           }        
        }
        if ($_SESSION["datagrid"]['messages']["click"])
        {
                $_SESSION["datagrid"]['messages']["DisplayData"] = true;
        }	
// Load the database adapter
	$db = new DBMS($_SESSION["preferences"]["database"]["type"],$_SESSION["preferences"]["database"]['server'],$_SESSION["preferences"]["database"]["dbname"] ,$_SESSION["preferences"]["database"]["user"],$_SESSION["preferences"]["database"]["password"],$_SESSION["preferences"]["database"]["port"]);

// Load the datagrid class
	$messages = new DisplayData($db);
	$messages->setDisplayData('messages');
        $messages->SetTemplate('displaygrid',$db);
// Set the query, select all rows from the people table
	$messages->setQuery("messageid,category,code,title,description", "messages","messageid","category = '".$_SESSION["datagrid"][$_SESSION ["displaydata"] ["name"]]['category'].'\'');
	$messages->setConstantFields(array("category"=>"'".$_SESSION["datagrid"][$_SESSION ["displaydata"] ["name"]]["category"]."'"));
	$messages->SetPrimaryID('messageid') ;
	$messages->setOrder('code');
        $messages->setURLConstant("setupmessages.php");
	
	// Hide ID field
	$messages->hidefield('messageid');
	$messages->hidefield('category');
// Show reset grid control
	$messages->showReset();
	
// setting inline edit
	$messages->SetInLineEdit(true);
// Add standard control
	$messages->addStandardControl(DisplayData::STDCTRL_INLINEEDIT,"setupmessages.php",DisplayData::TYPE_PHPFUNCTION);
// Add create control
	$messages->showCreateButton("setupmessages.php",DisplayData::TYPE_INLINEADDRECORD, 'Add New Message');
	
// Show checkboxes
	 $messages->showCheckboxes();
	
// Show row numbers
	$messages->showRowNumber();
	
// Change the amount of results per page
	$messages->setResultsPerPage(14);
	
// Change headers text
	$messages->SetFieldHeader('code', 'Code');
	$messages->SetFieldHeader('title', 'Title');
	$messages->SetFieldHeader('description', 'Desciption');
//  set field type
        $messages->SetFieldType('code', displaydata::TYPE_TEXT);
        $messages->SetFieldType('title', displaydata::TYPE_TEXT);
        $messages->SetFieldType('description', displaydata::TYPE_TEXTBOX,array('name' => 'description', 'class' => 'body', 'col' =>30,'row'=>3, 'displayvalue'=> 'description'));

//  set inlineedit field type
	$messages->SetInlineFieldType('code', DisplayData::INLINE_TEXT, array('name' => 'code', 'class' => 'body', 'size' =>'20', 'displayvalue'=> 'code')); // code
	$messages->SetInlineFieldType('title', DisplayData::INLINE_TEXT,array('name' => 'title', 'class' => 'body', 'size' =>'20','displayvalue' => 'title')); // Title 
	$messages->SetInlineFieldType('description', DisplayData::INLINE_TEXTBOX, array('name' => 'description', 'class' => 'body', 'col' =>30,'row'=>3, 'displayvalue'=> 'description')); // description
// Stop ordering
	$messages->hideOrder(false);
        if(isset($_GET["page"]))
            $_SESSION['datagrid']["page"] = (int)$_GET["page"];
	?>
</HEAD>
<BODY>
<?PHP
    $pref->header('Setup Messages');
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
<form id="messages" name="messages"  action="setupmessages.php" method="post" enctype="multipart/form-data" >	
<table width="100%" border="0" background="Images/HeavenBackground.jpg">
	<tr> 
       	<td width="11%" class="subtitle">Category:</td>
		<td width="89%">
                        <?php
                            $validate = new validate;
                            echo $validate->ComboBox("selectcategory","messages",'',"category","ASC","category","category","body",true,array('New Category' => '-99'),$_SESSION["datagrid"]['messages']["category"],false,false,"addcategory",$_SESSION["datagrid"]['messages']["categorynew"],"20",$_SESSION["preferences"]["database"]["dbname"]);
                        ?>
			<input type="submit" name="refreshcategory" value="Refresh" />
                </td>            
	</tr>
	<tr>
		<td colspan="2">
			<?php
				if ($_SESSION["datagrid"]["messages"]["DisplayData"])
				{
// Print the table
					$messages->printdata();
				}
			?>		</td>
	</tr>
</table>
</form>
</BODY>
