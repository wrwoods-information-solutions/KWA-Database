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
  selector: 'textarea',
  height: 50,
  plugins: [
    'advlist autolink lists link image charmap print preview anchor',
    'searchreplace visualblocks code ',
    'insertdatetime media table contextmenu paste code'
  ],
  toolbar: 'insertfile undo redo | styleselect | bold italic | alignleft aligncenter alignright alignjustify | bullist numlist outdent indent | link image',
  content_css: [
    '//fast.fonts.net/cssapi/e6dc9b99-64fe-4292-ad98-6974f93cd2a2.css',
    '//www.tinymce.com/css/codepen.min.css'
  ]
});
        </script>
        <TITLE>KWA Input Program</TITLE>
        <?PHP
        require_once "displaygrid.php";
        require_once "class.preferences.php";
        require_once "displaygrid.php";
        require_once "displaynotes.php";
        require_once "class.program.php";
        if (isset($_GET["page"])) {
            $_SESSION['displaydata'][$_SESSION ["displaydata"] ["name"]]["page"] = (int) $_GET["page"];
        }
        $pref = new preferences;
        $pref->basicincludes();
        $pref->loadpreferences();
        $login = new login();
        $login->checklogin();
        $login->checklogout();
        $db = new DBMS($_SESSION["preferences"]["database"]["type"], $_SESSION["preferences"]["database"]['server'], $_SESSION["preferences"]["database"]["dbname"], $_SESSION["preferences"]["database"]["user"], $_SESSION["preferences"]["database"]["password"], $_SESSION["preferences"]["database"]["port"]);
        if (!isset($_POST['programsave']))
            $_POST['programsave'] = '';
        if (!isset($_POST['programdelete']))
            $_POST['programdelete'] = '';
        if (!isset($_POST['refreshprogram']))
            $_POST['refreshprogram'] = '';
        if (!isset($_POST['refreshname']))
            $_POST['refreshname'] = '';
        if (!isset($_SESSION['program']['programid'])) {
            $_SESSION['program']['programid'] = 0;
        }
        if (!isset($_SESSION['displaydata']["program"]["displayprogramnamedept"])) {
            $_SESSION['displaydata']["program"]["displayprogramnamedept"] = false;
        }
        if (!isset($_SESSION['displaydata']["program"]["displayprogramrecurrence"])) {
            $_SESSION['displaydata']["program"]["displayprogramrecurrence"] = false;
        }
        if (!isset($_SESSION['displaydata']["program"]["displayprogramnote"])) {
            $_SESSION['displaydata']["program"]["displayprogramnote"] = false;
        }
        if (!isset($_SESSION['displaydata']["programlocation"]["displaygrid"])) {
            $_SESSION['displaydata']["programlocation"]["displaygrid"] = false;
        }
        if (!isset($_SESSION['displaydata']["programobjective"]["displayprogramobjective"])) {
            $_SESSION['displaydata']["programobjective"]["displayprogramobjective"] = false;
        }
        if (!isset($_SESSION['displaydata']["setup"]["displaysetup"]))
            $_SESSION['displaydata']["setup"]["displaysetup"] = false;
        if (!isset($_SESSION['displaydata']["programresponsible"]["displaygrid"])) {
            $_SESSION['displaydata']["programresponsible"]["displaygrid"] = false;
        }
        if (!isset($_SESSION['displaydata']["programresponsible"]["click"])) {
            $_SESSION['displaydata']["programresponsible"]["click"] = false;
        }
        if (!isset($_SESSION['displaydata']["setup"]["click"])) {
            $_SESSION['displaydata']["setup"]["click"] = false;
        }
        if (!isset($_SESSION['displaydata']["programlocation"]["click"])) {
            $_SESSION['displaydata']["programlocation"]["click"] = false;
        }
        if (!isset($_SESSION['displaydata']["equipsupply"]["displaygrid"])) {
            $_SESSION['displaydata']["equipsupply"]["displaygrid"] = false;
        }
        if (!isset($_SESSION['displaydata']["equipsupply"]["click"])) {
            $_SESSION['displaydata']["equipsupply"]["click"] = false;
        }
        if (!isset($_SESSION['displaydata']["servicecode"]["displayservicecode"])) {
            $_SESSION['displaydata']["servicecode"]["displayservicecode"] = false;
        }
        if (!isset($_SESSION['displaydata']["servicecode"]["click"])) {
            $_SESSION['displaydata']["servicecode"]["click"] = false;
        }
        if (!isset($_SESSION['displaydata']["budget"]["displaygrid"])) {
            $_SESSION['displaydata']["budget"]["displaygrid"] = false;
        }
        if (!isset($_SESSION['displaydata']["budget"]["click"])) {
            $_SESSION['displaydata']["budget"]["click"] = false;
        }
        if (!isset($_SESSION['displaydata']["program"]["note"])) {
            $_SESSION['displaydata']["program"]["note"] = false;
        }
        if (!isset($_SESSION['displaydata']["refreshments"]["click"])) {
            $_SESSION['displaydata']["refreshments"]["click"] = false;
        }
        if (!isset($_SESSION["displaydata"]['program']["newprogram"])) {
            $_SESSION["displaydata"]['program']["newprogram"] = false;
        }
        if (!isset($_SESSION["displaydata"]['program']["programnew"])) {
            $_SESSION["displaydata"]['program']["programnew"] = false;
        }
        $validate = new validate;
        $msg = new messages;
        $program = new program;
        $checknotes = new DisplayData($db);
        $checknotes->checknotes();
        if ($_POST['programsave'] === (string) 'Save') 
        {
            $program->updaterecord($_SESSION["program"]['programid'], $_SESSION["program"]["name"],$_SESSION["program"]["status"],$_SESSION["program"]["department"],   $_SESSION["program"]["description"]);
            $_SESSION['displaydata'][$_SESSION ["displaydata"] ["name"]]["default"] = 0;
        }
        if ($_POST['programdelete'] == 'Delete')
        {
            $program->deleterecord($_SESSION["program"]['programid']);
            $_SESSION['displaydata'][$_SESSION ["displaydata"] ["name"]]["default"] = 0;
        }    
        if ($_POST['refreshprogram'] == 'Refresh')
        {
            if ($_POST['selectedprogram'] == '0') {
                $msg->DisplayMessage('selectprogram');
                $_SESSION['displaydata']["program"]["displayprogramnamedept"] = false;
                $_SESSION['displaydata']["programobjective"]["displayprogramobjective"] = false;
                $_SESSION['displaydata']["programobjective"]["displayprogrammeasure"] = false;
                $_SESSION['displaydata']["programlocation"]["displaygrid"] = false;
                $_SESSION['displaydata']["programresponsible"]["displaygrid"] = false;
                $_SESSION['displaydata']["programequipsupply"]["displaygrid"] = false;
                $_SESSION['displaydata']["setup"]["displaysetup"] = false;
                $_SESSION['displaydata']["refreshments"]["displaygrid"] = false;
                $_SESSION['displaydata']["servicecode"]["displayservicecode"] = false;
                $_SESSION['displaydata']["budget"]["displaygrid"] = false;
                $_SESSION["displaydata"]['program']["newprogram"] = false;
                $_SESSION['displaydata']["program"]["note"] = false;            }
            if ($_POST['selectedprogram'] == -99) 
            {
                $_SESSION['displaydata']["program"]["displayprogramnamedept"] = true;
                $_SESSION['displaydata']["program"]["displayprogramrecurrence"] = true;
             $_SESSION['displaydata']["program"]["displayprogramnote"] = true;
               $_SESSION['displaydata'][$_SESSION ["displaydata"] ["name"]]["pleaseselect"] = true;
                $_SESSION['displaydata'][$_SESSION ["displaydata"]["name"]]["newprogram"] = true;
                $_SESSION['displaydata']["programlocation"]["displaygrid"] = true;
                $_SESSION['displaydata']["programobjective"]["displayprogramobjective"] = true;
                $_SESSION['displaydata']["programresponsible"]["displaygrid"] = true;
                $_SESSION['displaydata']["setup"]["displaysetup"] = true;
                $_SESSION['displaydata']["equipsupply"]["displaygrid"] = true;
                $_SESSION['displaydata']["servicecode"]["displayservicecode"] = true;
                $_SESSION['displaydata']["budget"]["displaygrid"] = true;
                $_SESSION['displaydata']["refreshnents"]["displaygrid"] = true;
                $_SESSION["displaydata"]['program']["newprogram"] = true;
                $_SESSION['displaydata']["program"]["note"]= true;
            }
            if ($_POST['selectedprogram'] > 0) {
                $_SESSION["program"]['programid'] = $_POST['selectedprogram'];
                if (isset($_SESSION ["displaydata"] ["name"])) {
                    $_SESSION['displaydata'][$_SESSION ["displaydata"] ["name"]]["default"] = $_POST['selectedprogram'];
                   }
                $tblprogram = $program->getrecord($_SESSION["program"]['programid']);
                $_SESSION['program']['name'] = $tblprogram['name'];
                $_SESSION['program']['department'] = $tblprogram['department'];
                $_SESSION['program']['description'] = $tblprogram['description'];
                $_SESSION['program']['status'] = $tblprogram['status'];
                $_SESSION['displaydata']["program"]["displayprogramnamedept"] = true;
                $_SESSION['displaydata']["program"]["displayprogramrecurrence"] = true;
                $_SESSION['displaydata']["program"]["displayprogramnote"] = true;
                $_SESSION['displaydata']["programlocation"]["displaygrid"] = true;
                $_SESSION['displaydata']["programobjective"]["displayprogramobjective"] = true;
                $_SESSION['displaydata']["programresponsible"]["displaygrid"] = true;
                $_SESSION['displaydata']["setup"]["displaysetup"] = true;
                $_SESSION['displaydata']["equipsupply"]["displaygrid"] = true;
                $_SESSION['displaydata']["servicecode"]["displayservicecode"] = true;
                $_SESSION['displaydata']["budget"]["displaygrid"] = true;
                $_SESSION['displaydata']["refreshments"]["displaygrid"] = true;
                $_SESSION['displaydata']["program"]["note"] = true;
                $_SESSION['displaydata'][$_SESSION ["displaydata"]["name"]]["default"] = $_POST['selectedprogram'];
            }
        }
        if ($_SESSION["displaydata"]['program']["newprogram"]) 
        {
            $_SESSION["displaydata"]['program']["newprogram"] = false;
            $_SESSION["program"]['programid'] = $program->insertrecord();
            $_POST[$_SESSION['displaydata']["name"] . 'editline'] = 'E1';
        }
        if ($_SESSION["displaydata"]['program']["programnew"]) 
        {
            $_SESSION["displaydata"]['program']["newprogram"] = true;
        }
        if ($_SESSION["displaydata"]["programlocation"]["click"]) 
        {
            $_SESSION["displaydata"]["programlocation"]["DisplayData"] = true;
        }
        if ($_SESSION["displaydata"]["programresponsible"]["click"]) {
            $_SESSION["displaydata"]["programresponsible"]["DisplayData"] = true;
        }
        if ($_SESSION["displaydata"]["setup"]["click"]) {
            $_SESSION["displaydata"]["setup"]["DisplayData"] = true;
        }
        if ($_SESSION["displaydata"]["equipsupply"]["click"]) {
            $_SESSION["displaydata"]["equipsupply"]["DisplayData"] = true;
        }
// Load the database adapter -programobjective
// Load the displaydata class
        $programobjective = new DisplayData($db);
        $programobjective->setdisplaydata('programobjective');
        $programobjective->SetTemplate('displayprogramobjective', $db);
// Set the query, select all rows from the people table
        $programobjective->setQuery("programobjectiveid,programid,programobjective", "programobjective", "", "programid = " . $_SESSION['program']["programid"]);
        $programobjective->setPrimaryID('programobjectiveid');
        $programobjective->setConstantFields(array("programid" => $_SESSION["program"]['programid']));
        $programobjective->setURLConstant("inputprogram.php");
        $programobjective->setOrder('programid');

// Hide ID field
        $programobjective->hidefield('programobjectiveid');
        $programobjective->hidefield('programid');
// Show reset grid control
        $programobjective->showReset();

// setting inline edit
        $programobjective->SetInLineEdit(true);
// Add standard control
        $programobjective->addStandardControl(displaydata::STDCTRL_INLINEEDIT, "inputprogram.php", displaydata::TYPE_PHPFUNCTION);
// Add create control
        $programobjective->showCreateButton("inputprogram.php", displaydata::TYPE_INLINEADDRECORD, 'New');

// Show checkboxes
// Show row numbers
        $programobjective->showRowNumber(true);
// Change the amount of results per page
        $programobjective->setResultsPerPage(2);

// Change headers text
        $programobjective->SetFieldHeader('programobjective', 'Program Objective:');
//  set field type
        $programobjective->SetFieldType('programobjective', displaydata::TYPE_TEXTBOX, array('table' => 'programobjective','class' => 'body','col'=>25,'row'=>3));
//  set inlineedit field type
        $programobjective->SetInlineFieldType('programobjective', displaydata::INLINE_TEXTBOX, array('name' => 'programobjective', 'class' => 'body','col'=>25,'row'=>3)); // programobjective
// Stop ordering
        $programobjective->hideOrder(false);
// Load the displaydata class  - programlocation
        $programlocation = new DisplayData($db);
        $programlocation->setdisplaydata('programlocation');
        $programlocation->SetTemplate('displayprogramlocation', $db);
// Set the query, select all rows from the people table
        $programlocation->setQuery("programlocationid,programlocation", "programlocation", "", "programid = " . $_SESSION['program']['programid']);
        $programlocation->setPrimaryID('programlocationid');
        $programlocation->setConstantFields(array("programid" => $_SESSION["program"]['programid']));
        $programlocation->setURLConstant("inputprogram.php");
        $programlocation->setOrder('programid');

// Hide ID field
        $programlocation->hidefield('programid');
        $programlocation->hidefield('programobjectiveid');
// Show reset grid control
        $programlocation->showReset();

// setting inline edit
        $programlocation->SetInLineEdit(true);
// Add standard control
        $programlocation->addStandardControl(displaydata::STDCTRL_INLINEEDIT, "inputprogram.php", displaydata::TYPE_PHPFUNCTION);
// Add create control
        $programlocation->showCreateButton("inputprogram.php", displaydata::TYPE_INLINEADDRECORD, 'New');

// Show checkboxes
// Show row numbers
        $programlocation->showRowNumber(true);

// Change the amount of results per page
        $programlocation->setResultsPerPage(2);

// Change headers text
        $programlocation->SetFieldHeader('type', '' . 'Type:');
        $programlocation->SetFieldHeader('address1', '' . 'Address 1:');
        $programlocation->SetFieldHeader('address2', '' . 'Address 2:');
        $programlocation->SetFieldHeader('city', '' . 'City:');
        $programlocation->SetFieldHeader('prov', '' . 'Province:');
        $programlocation->SetFieldHeader('postalcode', '' . 'Postal Code:');
//  set field type
        $programlocation->SetFieldType('type', displaydata::TYPE_CODEDISPLAY, array('table' => 'address', 'field' => 'type', 'class' => 'body'));
        $programlocation->SetFieldType('address1', displaydata::TYPE_TEXT);
        $programlocation->SetFieldType('address2', displaydata::TYPE_TEXT);
        $programlocation->SetFieldType('city', displaydata::TYPE_TEXT);
        $programlocation->SetFieldType('prov', displaydata::TYPE_TEXT);
        $programlocation->SetFieldType('postalcode', displaydata::TYPE_TEXT);
        $programlocation->SetFieldType('organizationid', displaydata::TYPE_FIELD, array('table' => 'organization', 'displayfield' => 'name', 'inputfield' => 'organizationid'));
        $programlocation->SetFieldType('programlocation', displaydata::TYPE_CODEDISPLAY, array('table' => 'programlocation', 'field' => 'programlocation', 'class' => 'body'));
//  set inlineedit field type
        $programlocation->SetInlineFieldType('organizationid', displaydata::INLINE_COMBOBOX, array('name' => "organizationid", "table" => "organization", "where" => "", 'order_by' => 'name', 'asc' => 'ASC', 'value' => 'organizationid', 'display' => 'name', 'class' => 'body', 'pleaseselect' => false, 'commonelements' => array(), 'default' => "", 'noinput' => false, 'AllowNew' => false, 'newname' => '', 'new' => false, 'size' => '30')); // organization

// Stop ordering
        $programlocation->hideOrder(false);

// Load the displaydata class  - programresponsible
        $programresponsible = new DisplayData($db);
        $programresponsible->setdisplaydata('programresponsible');
        $programresponsible->SetTemplate('displaygrid', $db);
// Set the query, select all rows from the people table
        $programresponsible->setQuery("programid,personid", "programresponsible", "", "programid = " . $_SESSION['program']['programid']);
        $programresponsible->setPrimaryID('programresponsibleid');
        $programresponsible->setConstantFields(array("programid" => $_SESSION["program"]['programid']));
        $programresponsible->setURLConstant("inputprogram.php");
        $programresponsible->setOrder('programid');

// Hide ID field
        $programresponsible->hidefield('programid');
// Show reset grid control
        $programresponsible->showReset();

// setting inline edit
        $programresponsible->SetInLineEdit(true);
// Add standard control
        $programresponsible->addStandardControl(displaydata::STDCTRL_INLINEEDIT, "inputprogram.php", displaydata::TYPE_PHPFUNCTION);
// Add create control
        $programresponsible->showCreateButton("inputprogram.php", displaydata::TYPE_INLINEADDRECORD, 'New');

// Show checkboxes
// Show row numbers
        $programresponsible->showRowNumber(true);

// Change the amount of results per page
        $programresponsible->setResultsPerPage(2);

// Change headers text
        $programresponsible->SetFieldHeader('programresponsible', '' . 'Person Responsible:');
//  set field type
        $programresponsible->SetFieldType('programresponsible', displaydata::TYPE_TEXTBOX, array('name' => 'programresponsible', 'field' => "personid", 'class' => 'body','col'=>25,'row'=>3));
//  set inlineedit field type
        $programresponsible->SetInlineFieldType('programresponsible', displaydata::INLINE_TEXTBOX, array('name' => 'programresponsible', 'class' => 'body','col'=>25,'row'=>3)); // programresponsible
// Stop ordering
        $programresponsible->hideOrder(false);
// Load the displaydata class  - setup
        $setup = new DisplayData($db);
        $setup->setdisplaydata('setup');
        $setup->SetTemplate('displaygrid', $db);
// Set the query, select all rows from the people table
        $setup->setQuery("programsetupid,programid,setup", "programsetup", "", "programid = " . $_SESSION['program']["programid"]);
        $setup->setPrimaryID('programsetupid');
        $setup->setConstantFields(array("programid" => $_SESSION["program"]['programid']));
        $setup->setURLConstant("inputprogram.php");
        $setup->setOrder('programsetupid');

// Hide ID field
        $setup->hidefield('programsetupid','programid');
// Show reset grid control
        $setup->showReset();

// setting inline edit
        $setup->SetInLineEdit(true);
// Add standard control
        $setup->addStandardControl(displaydata::STDCTRL_INLINEEDIT, "inputprogram.php", displaydata::TYPE_PHPFUNCTION);
// Add create control
        $setup->showCreateButton("inputprogram.php", displaydata::TYPE_INLINEADDRECORD, 'New');

// Show checkboxes
// Show row numbers
        $setup->showRowNumber(true);
// Change the amount of results per page
        $setup->setResultsPerPage(2);

// Change headers text
        $setup->SetFieldHeader('setup', 'Setup/Special Adaptations:');
//  set field type
        $setup->SetFieldType('setup', displaydata::TYPE_TEXTBOX, array('name' => 'setup','class' => 'body','col'=>25,'row'=>3));
//  set inlineedit field type
        $setup->SetInlineFieldType('setup', displaydata::INLINE_TEXTBOX, array('name' => 'setup','class' => 'body','col'=>25,'row'=>3)); // setup

// Stop ordering
        $setup->hideOrder(false);
// Load the displaydata class  - equipsupply
        $equipsupply = new DisplayData($db);
        $equipsupply->setdisplaydata('equipsupply');
        $equipsupply->SetTemplate('displaygrid', $db);
// Set the query, select all rows from the people table
        $equipsupply->setQuery("programid,equipsupply", "equipsupply", "", "programid =" . $_SESSION['program']["programid"]);
        $equipsupply->setPrimaryID('equipsupplyid');
        $equipsupply->setConstantFields(array("programid" => $_SESSION["program"]['programid']));
        $equipsupply->setURLConstant("inputprogram.php");
        $equipsupply->setOrder('programid');

// Hide ID field
        $equipsupply->hidefield('programid');
// Show reset grid control
        $equipsupply->showReset();

// setting inline edit
        $equipsupply->SetInLineEdit(true);
// Add standard control
        $equipsupply->addStandardControl(displaydata::STDCTRL_INLINEEDIT, "inputprogram.php", displaydata::TYPE_PHPFUNCTION);
// Add create control
        $equipsupply->showCreateButton("inputprogram.php", displaydata::TYPE_INLINEADDRECORD, 'New');

// Show checkboxes
// Show row numbers
        $equipsupply->showRowNumber(true);

// Change the amount of results per page
        $equipsupply->setResultsPerPage(2);

// Change headers text
        $equipsupply->SetFieldHeader('equipsupply', '' . 'Equipment Supplies');
        $equipsupply->SetFieldType('equipsupply2', displaydata::TYPE_TEXTBOX, array('name' => 'equipsupply','class' => 'body','col'=>25,'row'=>3));
        $equipsupply->SetInlineFieldType('equipsupply1', displaydata::INLINE_TEXTBOX, array('name' => 'equipsupply','class' => 'body','col'=>25,'row'=>3)); // equipsupply

// Stop ordering
        $equipsupply->hideOrder(false);
// Load the displaydata class  - servicecode
        $servicecode = new DisplayData($db);
        $servicecode->setdisplaydata('servicecode');
        $servicecode->SetTemplate('displayservicecode', $db);
// Set the query, select all rows from the people table
        $servicecode->setQuery("programid,servicecode", "servicecode", "", "programid = " . $_SESSION['program']["programid"]);
        $servicecode->setPrimaryID('servicecodeid');
        $servicecode->setConstantFields(array("programid" => $_SESSION["program"]['programid']));
        $servicecode->setURLConstant("inputprogram.php");
        $servicecode->setOrder('programid');

// Hide ID field
        $servicecode->hidefield('programid');
// Show reset grid control
        $servicecode->showReset();

// setting inline edit
        $servicecode->SetInLineEdit(true);
// Add standard control
        $servicecode->addStandardControl(displaydata::STDCTRL_INLINEEDIT, "inputprogram.php", displaydata::TYPE_PHPFUNCTION);
// Add create control
        $servicecode->showCreateButton("inputprogram.php", displaydata::TYPE_INLINEADDRECORD, 'New');

// Show checkboxes
// Show row numbers
        $servicecode->showRowNumber(true);
// Change the amount of results per page
        $servicecode->setResultsPerPage(2);

// Change headers text
        $servicecode->SetFieldHeader('servicecode', 'Servicecode:');
//  set field type
        $servicecode->SetFieldType('servicecodetype', displaydata::TYPE_TEXT, array('table' => 'servicecode', 'field' => 'servicecodetype', 'class' => 'body'));
//  set inlineedit field type
        $servicecode->SetInlineFieldType('servicecodetype', displaydata::INLINE_CODECOMBO, array('name' => 'servicecodetype', 'table' => 'servicecode', 'field' => 'servicecodetype', 'class' => 'body')); // servicecodetype

// Stop ordering
        $servicecode->hideOrder(false);
// Load the displaydata class  - budget
        $budget = new DisplayData($db);
        $budget->setdisplaydata('budget');
        $budget->SetTemplate('displaygrid', $db);
// Set the query, select all rows from the people table
        $budget->setQuery("programid,item,amount", "programbudget", "", "programid = " . $_SESSION['program']["programid"]);
        $budget->setPrimaryID('budgetid');
        $budget->setConstantFields(array("programid" => $_SESSION["program"]['programid']));
        $budget->setURLConstant("inputprogram.php");
        $budget->setOrder('programid');

// Hide ID field
        $budget->hidefield('programid');
// Show reset grid control
        $budget->showReset();

// setting inline edit
        $budget->SetInLineEdit(true);
// Add standard control
        $budget->addStandardControl(displaydata::STDCTRL_INLINEEDIT, "inputprogram.php", displaydata::TYPE_PHPFUNCTION);
// Add create control
        $budget->showCreateButton("inputprogram.php", displaydata::TYPE_INLINEADDRECORD, 'New');

// Show checkboxes
// Show row numbers
        $budget->showRowNumber(true);
// Change the amount of results per page
        $budget->setResultsPerPage(2);

// Change headers text
        $budget->SetFieldHeader('item', 'Item');
        $budget->SetFieldHeader('amount', 'Amount');
//  set field type
        $budget->SetFieldType('item', displaydata::TYPE_FIELD, array('table' => 'programbudget', 'displayfield' => 'item', 'inputfield' => 'item'));
        $budget->SetFieldType('amount', displaydata::TYPE_FIELD, array('table' => 'programbudget', 'displayfield' => 'amount', 'inputfield' => 'amount'));
//  set inlineedit field type
        $budget->SetInlineFieldType('item', displaydata::INLINE_COMBOBOX, array('name' => "item", "table" => "organization", "where" => "" . $_SESSION["program"]["programid"], 'order_by' => 'item', 'asc' => 'ASC', 'value' => 'item', 'display' => 'item', 'class' => 'body', 'pleaseselect' => true, 'commonelements' => array(), 'default' => "item", 'noinput' => false, 'AllowNew' => true, 'newname' => 'item', 'new' => 'item', 'size' => '20')); // budget item
        $budget->SetInlineFieldType('amount', displaydata::INLINE_TEXT, array('name' => 'amount', 'class' => 'body', 'size' => 20)); // budget amount

// Stop ordering
        $budget->hideOrder(false);
// Load the displaydata class  - refreshments
        $refreshments = new DisplayData($db);
        $refreshments->setdisplaydata('refreshments');
        $refreshments->SetTemplate('Displaygrid', $db);
// Set the query, select all rows from the people table
        $refreshments->setQuery("programid,refreshments", "refreshments", "", "programid = " . $_SESSION['program']["programid"]);
        $refreshments->setPrimaryID('refreshmentsid');
        $refreshments->setConstantFields(array("programid" => $_SESSION["program"]['programid']));
        $refreshments->setURLConstant("inputprogram.php");
        $refreshments->setOrder('refreshmentsid');

// Hide ID field
        $refreshments->hidefield('programid');
// Show reset grid control
        $refreshments->showReset();

// setting inline edit
        $refreshments->SetInLineEdit(true);
// Add standard control
        $refreshments->addStandardControl(displaydata::STDCTRL_INLINEEDIT, "inputprogram.php", displaydata::TYPE_PHPFUNCTION);
// Add create control
        $refreshments->showCreateButton("inputprogram.php", displaydata::TYPE_INLINEADDRECORD, 'New');

// Show checkboxes
// Show row numbers
        $refreshments->showRowNumber(true);
// Change the amount of results per page
        $refreshments->setResultsPerPage(2);

// Change headers text
        $refreshments->SetFieldHeader('refreshments', 'Refreshments:');
//  set field type
        $refreshments->SetFieldType('refreshments', displaydata::TYPE_TEXTBOX, array('name' => 'programrefreshments', 'class' => 'body','col'=>25,'row'=>3));
        $refreshments->SetInlineFieldType('refreshments', displaydata::INLINE_TEXTBOX, array('name' => 'programrefreshments', 'class' => 'body','col'=>25,'row'=>3));
        $refreshments->hideOrder(false);
// Load the displaydata class  - note
        $notes = new DisplayData($db);
        $notes->setdisplaydata('notes');
        $notes->SetTemplate('Displaynotes', $db);
// Set the query, select all rows from the people table
        $notes->setQuery("notesid,notes", "notes", "", "");
        $notes->setPrimaryID('notesid');
        $notes->setConstantFields(array("programid" => $_SESSION["program"]['programid']));
        $notes->setURLConstant("inputprogram.php");
        $notes->setOrder('notesid');

// Hide ID field
        $notes->hidefield('notesid', 'personid');
// Show reset grid control
        $notes->showReset();

// setting inline edit
        $notes->SetInLineEdit(true);
// Add standard control
        $notes->addStandardControl(displaydata::STDCTRL_INLINEEDIT, "inputprogram.php", displaydata::TYPE_PHPFUNCTION);
// Add create control
        $notes->showCreateButton("inputperson.php", displaydata::TYPE_INLINEADDRECORD, 'New');

// Show checkboxes
// Show row numbers
        $notes->showRowNumber(true);
// Change the amount of results per page
        $notes->setResultsPerPage(2);

// Change headers text
        $notes->SetFieldHeader('notes', 'Notes:');
//  set field type
        $notes->SetFieldType('notes', displaydata::TYPE_NOTE, array('name' => 'personnotes', 'class' => 'subtitle', 'text' => 'Display Person Note', 'size' => 15, 'outbaseurl' => 'outputnotes.php', 'inbaseurl' => 'inputnotes.php', 'returnurl' => 'inputperson.php', 'notestype' => 'per'));
        $notes->SetInlineFieldType('notes', displaydata::INLINE_NOTE, array('name' => 'personnotes', 'class' => 'subtitle', 'text' => 'Add Person Note', 'size' => 15, 'outbaseurl' => 'outputnotes.php', 'inbaseurl' => 'inputnotes.php', 'returnurl' => 'inputperson.php', 'notestype' => 'per'));
        $notes->hideOrder(false);
        if (!isset($_SESSION['displaydata'][$_SESSION ["displaydata"] ["name"]]["programnew"]))
            $_SESSION['displaydata'][$_SESSION ["displaydata"] ["name"]]["programnew"] = false;
        if (!isset($_SESSION['displaydata'][$_SESSION ["displaydata"] ["name"]]["pleaseselect"]))
            $_SESSION['displaydata'][$_SESSION ["displaydata"] ["name"]]["pleaseselect"] = true;
        if (!isset($_SESSION['displaydata'][$_SESSION ["displaydata"] ["name"]]["default"]))
            $_SESSION['displaydata'][$_SESSION ["displaydata"] ["name"]]["default"] = 0;
        if (!isset($_SESSION['displaydata'][$_SESSION ["displaydata"] ["name"]]["programnew"]))
            $_SESSION['displaydata'][$_SESSION ["displaydata"] ["name"]]["programnew"] = false;
        if (!isset($_SESSION['displaydata'][$_SESSION ["displaydata"] ["name"]]["pleaseselect"]))
            $_SESSION['displaydata'][$_SESSION ["displaydata"] ["name"]]["pleaseselect"] = true;
        ?>
    </HEAD>
    <BODY>
        <?PHP
        $pref->header('Input Program Profile');
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
        <table class="tbl" width="100%">
            <tr>
                <td class='subtitle'> Select Program
                    <form id="selectprogram" name="selectprogram"  action="inputprogram.php" method="post" enctype="multipart/form-data" >
        <?php
         echo $validate->ComboBox("selectedprogram", "program", '', '', "ASC", "programid", "name", "body", $_SESSION['displaydata'][$_SESSION ["displaydata"] ["name"]]["pleaseselect"], array('New Program' => -99), $_SESSION['displaydata'][$_SESSION ["displaydata"] ["name"]]["default"], false, false, "newprogram", $_SESSION['displaydata'][$_SESSION ["displaydata"] ["name"]]["programnew"], "20", $_SESSION["preferences"]["database"]["dbname"]);
        ?>
                        <input type="submit" class='subtitle' name="refreshprogram" value="Refresh">
                    </form>
                </td>
            </tr>
        </table> 
        <?PHP
            if ($_SESSION['displaydata']["program"]["displayprogramnamedept"]) 
            {
        ?>
        <form id="enterprogram" name="enterprogram"  action="inputprogram.php" method="post" enctype="multipart/form-data" >
                <table class="tbl" width="100%">
                    <tr>
                        <td class="subtitle">Program Name:
                            <input name="name" class="body" type="text" size=40 value="<?PHP echo $_SESSION['program']['name']?>">
                       </td>
                   </tr>
                    <tr> 
                        <td class="subtitle">Department:
                            
                        <?PHP
                            echo $validate->CodeCombo("department", "program", "department", "body",$_SESSION['displaydata'][$_SESSION ["displaydata"] ["name"]]["pleaseselect"], $_SESSION["program"]["department"]);
                       ?>
                        </td>
                   </tr>
                   <tr>
                        <td class="subtitle">Status:
                        <?PHP
                            echo $validate->CodeCombo("status", "program", "status", "body",$_SESSION['displaydata'][$_SESSION ["displaydata"] ["name"]]["pleaseselect"], $_SESSION["program"]["status"]);
                        ?>    
                        </td>
                   </tr>
                   <tr>
                        <td class ="subtitle" colspan="2">Program Description:
                        </td>
                   </tr>
                   <tr>
                        <td>
                             <textarea id="description" name="description" class ="body" rows="5" cols="45"><?PHP echo$_SESSION['program']['description']?>                                   </textarea>
                        </td>
                    </tr>
                </table>
             </form>
          <?PHP
          }
          ?>     
          <table class="tbl" width="100%">
                <tr>
                    <td colspan="2">
                        <?PHP
                        if ($_SESSION['displaydata']["programobjective"]["displayprogramobjective"]) {
                            echo '<tr>
                                        <td class ="subtitle">Program Objective:</td>
                                    </tr>
                                    <tr>';
                            $_SESSION["displaydata"] ["name"] = 'programobjective';
                            $programobjective->printdata();
                        }
                        ?>
                    </td>
                </tr>
                <tr>
                    <td>  
                        <table class="tbl" width="100%">
                        <?PHP
                        if ($_SESSION['displaydata']["programlocation"]["displaygrid"]) {
                            echo '<tr>
                                        <td class ="subtitle">Location:</td>
                                    </tr>
                                    <tr>
                                        <td>';
                            $_SESSION ["displaydata"] ["name"] = 'programlocation';
                            $programlocation->printdata();
                        }
                        if ($_SESSION['displaydata']["equipsupply"]["displaygrid"]) {
                            echo '<tr>
                                        <td class ="subtitle">Equip/Supply:</td>
                                  </tr>
                                   <tr>
                                        <td>';
                            $_SESSION ["displaydata"] ["name"] = 'equipsupply';
                            $equipsupply->printdata();
                        }
                        if ($_SESSION['displaydata']["refreshments"]["displaygrid"]) {
                            echo '<tr>
                                        <td class ="subtitle">Refreshments:</td>
                                    </tr>
                                    <tr>
                                       <td>';
                            $_SESSION["displaydata"] ["name"] = 'refreshments';
                            $refreshments->printdata();
                        }
                        ?>
                        </table>
                    </td>
                    <td valign="top">
                        <table class="tbl" width="100%">
                            <?PHP
                            if ($_SESSION['displaydata']["programresponsible"]["displaygrid"]) {
                                echo '<tr>
                                        <td class ="subtitle">Person Responsible:</td>
                                    </tr>
                                    <tr>
                                        <td>';
                                $_SESSION ["displaydata"] ["name"] = 'programresponsible';
                                $programresponsible->printdata();
                            }
                            if ($_SESSION['displaydata']["setup"]["displaygrid"]) {
                                echo '<tr>
                                        <td class="subtitle">Setup/Special Adaptation:</td>
                                    </tr>
                                    <tr>
                                       <td>';
                                $_SESSION["displaydata"] ["name"] = 'setup';
                                $setup->printdata();
                            }
                            if ($_SESSION['displaydata']["servicecode"]["displayservicecode"]) {
                                echo '<tr>
                                        <td class ="subtitle">Service Code:</td>
                                    </tr>
                                    <tr>
                                       <td>';
                                $_SESSION["displaydata"] ["name"] = 'servicecode';
                                $servicecode->printdata();
                            }
                            ?>
                        </table>
                    </td>
                </tr>    
            </table>
            <table class="tbl" width="100%">
               <tr>            
                    <td>
                        <?PHP
                            if ($_SESSION['displaydata']["budget"]["displaygrid"]) {
                                echo '<tr>
                                        <td class ="subtitle">Budget:</td>
                                    </tr>
                                    <tr>
                                       <td>';
                                $_SESSION["displaydata"] ["name"] = 'budget';
                                $budget->printdata();
                            }
                        ?>    
                </td>
            </tr>
        <?PHP
            if( $_SESSION['displaydata']["program"]["displayprogramrecurrence"])
            {
        
                echo '<tr>'
                      .  '<td class="title"  align="left">Recurrence Pattern
                         </td>
                         </tr>
                         <tr> 
                         <td width="100%" align="center">
                                <img src="Images/UnderConstruction.gif" alt="picture" name="pic" width="200" height="200" align="middle">
                        </td>
                    </tr>';
            }   
            if ($_SESSION['displaydata']["program"]["note"]) 
            {
                    echo '<tr>
                                <td class ="subtitle">Program Notes</td>
                         </tr>
                         <tr>
                                <td>';
                                     $_SESSION["displaydata"] ["name"] = 'notes';
                                     $notes->printdata();
             }
                        ?>    
                </td>
            </tr>
        </table>
         <form id="selectprogram" name="program"  action="inputprogram.php" method="post" enctype="multipart/form-data" >
            <table class="tbl" width="100%">
               <tr>            
                <td>
                    <input type="submit" class ='subtitle' name="programsave" value="Save">
                    <input type="submit" class ='subtitle' name="programdelete" value="Delete">
                </td>
            </tr>
        </table>
    </form>            
</BODY>
</HTML>