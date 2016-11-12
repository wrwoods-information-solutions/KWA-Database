<?php session_start(); ?>
<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN">
<HEAD>
<link href="style.css" rel="stylesheet" type="text/css">
<TITLE>KWA Setup Master Menu</TITLE>

 <?php
        require_once "class.preferences.php";
        require_once "class.displaydata.php";
        require_once "class.login.php";
        require_once "class.messages.php";
        require_once "class.codes.php";
        $pref = new preferences;
        $pref->loadpreferences();
        $pref->basicincludes();
        $login = new login();
        $login->checklogin();
        $login->checklogout();
        $_SESSION ["displaydata"] ["name"] = 'mastermenu';
        if(isset($_GET["page"]))
            $_SESSION['displaydata'][$_SESSION ["displaydata"] ["name"]]["page"] = (int)$_GET["page"];
        if (!isset($_POST['refreshmastermenu']))
            $_POST['refreshmastermenu'] = '';
        if (!isset ($_SESSION['displaydata'][$_SESSION ["displaydata"]["name"]]["menuname"]))
               $_SESSION['displaydata'][$_SESSION ["displaydata"]["name"]]["menuname"] = 'nomenu';                
        if (!isset ($_SESSION['displaydata'][$_SESSION ["displaydata"]["name"]]["displaydata"]))
               $_SESSION['displaydata'][$_SESSION ["displaydata"]["name"]]["displaydata"] = false;                
	if ($_POST['refreshmastermenu'] === 'Refresh')
        {
            if ($_POST['selectmastermenu'] === 0)
            {
                $_SESSION['displaydata'][$_SESSION ["displaydata"] ["name"]]["displaydata"] = false;
                $_SESSION['displaydata'][$_SESSION ["displaydata"] ["name"]]["click"] = false;
                $_SESSION['displaydata'][$_SESSION ["displaydata"] ["name"]]["pleaseselect"] = true;
            }else if ($_POST['selectmastermenu'] === 'New')
                    {
                        $_SESSION['displaydata'][$_SESSION ["displaydata"] ["name"]]["displaydata"] = false;
                        $_SESSION['displaydata'][$_SESSION ["displaydata"] ["name"]]["mastermenunew"] = true;
                        $_SESSION['displaydata'][$_SESSION ["displaydata"] ["name"]]["click"] = false;
                    }else{
                        $_SESSION['displaydata'][$_SESSION ["displaydata"] ["name"]]["menuname"] = $_POST['selectmastermenu'];
                        if ($_SESSION['displaydata'][$_SESSION ["displaydata"] ["name"]]["mastermenunew"])
                        {
                            $_SESSION['displaydata'][$_SESSION ["displaydata"] ["name"]]["default"][$_SESSION['displaydata'][$_SESSION ["displaydata"] ["name"]]["menuname"]] = $_SESSION['displaydata'][$_SESSION ["displaydata"] ["name"]]["menuname"];
                        } 
                        $_SESSION['displaydata'][$_SESSION ["displaydata"] ["name"]]["mastermenunew"] = false;
                       $_SESSION['displaydata'][$_SESSION ["displaydata"] ["name"]]["displaydata"] = true;
                        $_SESSION['displaydata'][$_SESSION ["displaydata"] ["name"]]["click"] = true;
                        $_SESSION['displaydata'][$_SESSION ["displaydata"] ["name"]]["pleaseselect"] = false;
                    }
        }
	$db = new DBMS($_SESSION["preferences"]["database"]["type"],$_SESSION["preferences"]["database"]['server'],$_SESSION["preferences"]["database"]["dbname"] ,$_SESSION["preferences"]["database"]["user"],$_SESSION["preferences"]["database"]["password"],$_SESSION["preferences"]["database"]["port"]);

// Setup the displaydata class
 	$mastermenu = new DisplayData($db);
	$mastermenu->setdisplaydata('mastermenu');
        $mastermenu->SetTemplate('displaygrid',$db);
// Set the query, select all rows from the people table         
	$mastermenu->setQuery("mastermenuid,orderfield,parentid,text,link", "mastermenu","","menuname = '".$_SESSION['displaydata'][$_SESSION ["displaydata"]["name"]]["menuname"]."'");
	$mastermenu->setConstantFields(array("menuname"=>$_SESSION['displaydata'][$_SESSION ["displaydata"] ["name"]]["menuname"]));
	$mastermenu->SetPrimaryID('mastermenuid') ;
	$mastermenu->setURLConstant("setupmastermenu.php");
	// Hide ID field
        $mastermenu->hidefield('mastermenuid');
        $mastermenu->hidefield('menuname');
        $mastermenu->hidefield('title');
        $mastermenu->hidefield('target');
        $mastermenu->hidefield('icon');
        $mastermenu->hidefield('expanded');
        $mastermenu->hidefield('creationdate');
        $mastermenu->hidefield('updatedate');
	$mastermenu->hidefield('updateby');
// Show reset grid control
	$mastermenu->showReset();
	
// setting inline edit
	$mastermenu->SetInLineEdit(true);
// Add standard control
	$mastermenu->addStandardControl(DisplayData::STDCTRL_INLINEEDIT,"setupmastermenu.php",DisplayData::TYPE_PHPFUNCTION);
// Add create control
	$mastermenu->showCreateButton("setupmastermenu.php", DisplayData::TYPE_INLINEADDRECORD, 'Add New Line');
	
// Show checkboxes
	 $mastermenu->showCheckboxes(false);
	
// Show row numbers
	$mastermenu->showRowNumber();
	
// Change the amount of results per page
	$mastermenu->setResultsPerPage(10);
	
// Change headers text
	$mastermenu->SetFieldHeader('orderfield', 'Order');
	$mastermenu->SetFieldHeader('parentid', 'Parent Menu');
	$mastermenu->SetFieldHeader('text', 'Text');
	$mastermenu->SetFieldHeader('link', 'Link');
//  set field type
	$mastermenu->SetFieldType('orderfield', DisplayData::TYPE_TEXT,array("name"=> "orderfield","class"=>'body'));
	$mastermenu->SetFieldType('parentid', DisplayData::TYPE_SQLCODEDISPLAY,array("sql"=> "SELECT `text` FROM `mastermenu`","field"=>"mastermenuid","code"=>'parentid'));
	$mastermenu->SetFieldType('text', DisplayData::TYPE_TEXT,array("name"=> "orderfield","class"=>'body'));
	$mastermenu->SetFieldType('link', DisplayData::TYPE_TEXT,array("name"=> "orderfield","class"=>'body'));
	
//  set inlineedit field type
	$mastermenu->SetInlineFieldType('orderfield', DisplayData::INLINE_TEXT, array('name' => 'orderfield', 'class' => 'body', 'size' =>'15', 'displayvalue'=> 'orderfield')); // orderfield
	$mastermenu->SetInlineFieldType('parentid', DisplayData::INLINE_COMBOBOX, array('name' => 'parentid', 'table' =>'mastermenu', 'where' => '','order_by' =>'title', 'asc'=>'ASC','value'=> 'mastermenuid', 'display'=> 'text', 'class' => 'body', 'pleaseselect' =>true, 'commonelements' =>array('Default' => 0),'default' => '','noinput' => '','AllowNew' =>false,'newname' =>'', 'new' =>false, 'size' => 20,$_SESSION["preferences"]["database"]["dbname"])); // MasterMenu id
	$mastermenu->SetInlineFieldType('text', DisplayData::INLINE_TEXT,array('name' => 'text', 'class' => 'body', 'size' =>'20','displayvalue' => 'text')); // Text 
        $mastermenu->setcommoncombochoices(array("default"=>''));
        $mastermenu->setFileExtentions(array('.php'));
	$mastermenu->SetInlineFieldType('link', DisplayData::INLINE_FILE, array('name' => 'link', 'directory' => '','css_class' => 'body','PleaseSelect' => false,'noinput'=>false,'AllowNew'=>false,'newname' =>'','new'=>false)); //link
// Stop ordering
	$mastermenu->hideOrder();
	$mastermenu->setorder('orderfield');
        $menu = new menu();
  ?>
 </HEAD>
<BODY>
<?PHP
    $pref->header('Setup Master Menu');
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
	<form id="mastermenu" name="mastermenu"  action="setupmastermenu.php" method="post" enctype="multipart/form-data" >	
	<table width="100%"  border="0" background="Images/HeavenBackground.jpg">
		<tr>
			<td height="70">
        			<?php
						$validate = new validate;
                                                $_SESSION['displaydata'][$_SESSION ["displaydata"] ["name"]]["default"]['New Menu'] = 'New';
 						echo $validate->ComboBox("selectmastermenu","mastermenu",'',"menuname","ASC","menuname","menuname","body",$_SESSION['displaydata'][$_SESSION ["displaydata"] ["name"]]["pleaseselect"],$_SESSION['displaydata'][$_SESSION ["displaydata"] ["name"]]["default"],$_SESSION['displaydata'][$_SESSION ["displaydata"] ["name"]]["menuname"],false,false,"newmenu",$_SESSION['displaydata'][$_SESSION ["displaydata"] ["name"]]["mastermenunew"],"20",$_SESSION["preferences"]["database"]["dbname"]);
					?>
					<input type="submit" name="refreshmastermenu" value="Refresh">
                       </td>
		</tr>
		<tr>
			<td>
				<?php
					if ($_SESSION['displaydata'][$_SESSION ["displaydata"] ["name"]]["displaydata"])
					{
// Print the table
                                            $mastermenu->printdata();
					}
				?>
			</td>
		</tr>
        </table>
        </form>
</BODY>  