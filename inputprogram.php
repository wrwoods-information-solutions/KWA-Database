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
        if (!isset($_POST['programlocationnotes']))
            $_POST['programlocationnotes'] = '';
        if (!isset($_POST['setupnotes']))
            $_POST['setupnotes'] = '';
        if (!isset($_POST['equipsupplynotes']))
            $_POST['equipsupplynotes'] = '';
        if (!isset($_POST['programnotes']))
            $_POST['programnotes'] = '';
        if (!isset($_SESSION['program']['programid'])) {
            $_SESSION['program']['programid'] = 0;
        }
        if (!isset($_SESSION['program']['firstname'])) {
            $_SESSION['program']['firstname'] = ' ';
        }
        if (!isset($_SESSION['program']['lastname'])) {
            $_SESSION['program']['lastname'] = ' ';
        }
        if (!isset($_SESSION['program']['fullname'])) {
            $_SESSION['program']['fullname'] = ' ';
        }
        if (!isset($_SESSION['program']['gender'])) {
            $_SESSION['program']['gender'] = ' ';
        }
        if (!isset($_SESSION['program']['birthdate'])) {
            $_SESSION['program']['birthdate'] = ' ';
        }
        if (!isset($_SESSION['program']['mobilityplusid'])) {
            $_SESSION['program']['mobilityplusid'] = ' ';
        }
        if (!isset($_SESSION['organization']['name']))
        {
            $_SESSION['organization']['name'] = ' ';
        }
        if (!isset($_SESSION['displaydata']["programlocation"]["displayprogramlocation"])) {
            $_SESSION['displaydata']["programlocation"]["displayprogramlocation"] = false;
        }
        if (!isset($_SESSION['displaydata']["programobjective"]["displayprogramobjective"])) {
            $_SESSION['displaydata']["programobjective"]["displayprogramobjective"] = false;
        }
        if (!isset($_SESSION['displaydata']["setup"]["displaysetup"]))
            $_SESSION['displaydata']["setup"]["displaysetup"] = false;
        if (!isset($_SESSION['displaydata']["programresponsible"]["displayprogramresponsible"])) {
            $_SESSION['displaydata']["programresponsible"]["displayprogramresponsible"] = false;
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
        if (!isset($_SESSION['displaydata']["equipsupply"]["displayequipsupply"])) {
            $_SESSION['displaydata']["equipsupply"]["displayequipsupply"] = false;
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
        if (!isset($_SESSION['displaydata']["budget"]["displaybudget"])) {
            $_SESSION['displaydata']["budget"]["displaybudget"] = false;
        }
        if (!isset($_SESSION['displaydata']["budget"]["click"])) {
            $_SESSION['displaydata']["budget"]["click"] = false;
        }
        if (!isset($_SESSION['displaydata']["notes"]["displaynotes"])) {
            $_SESSION['displaydata']["notes"]["displaynotes"] = false;
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
            $program->updaterecord($_SESSION["program"]['programid'], $_POST['firstname'], $_POST['lastname'], $_POST['gender'], $_POST['birthdate'], $_POST['mobilityplusid']);
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
                $_SESSION['displaydata']["programlocation"]["displayprogramlocation"] = false;
                $_SESSION['displaydata']["programobjective"]["displayprogramobjective"] = false;
                $_SESSION['displaydata']["programresponsible"]["displayprogramresponsible"] = false;
                $_SESSION['displaydata']["setup"]["displaysetup"] = false;
                $_SESSION['displaydata']["equipsupply"]["displayequipsupply"] = false;
                $_SESSION['displaydata']["servicecode"]["displayservicecode"] = false;
                $_SESSION['displaydata']["budget"]["displaybudget"] = false;
                $_SESSION['displaydata']["refreshments"]["displayrefreshments"] = false;
                $_SESSION["displaydata"]['program']["newprogram"] = false;
            }
            if ($_POST['selectedprogram'] == -99) 
            {
                $_SESSION['displaydata'][$_SESSION ["displaydata"] ["name"]]["pleaseselect"] = true;
                $_SESSION['displaydata'][$_SESSION ["displaydata"] ["name"]]["newprogram"] = true;
                $_SESSION['displaydata']["programlocation"]["displayprogramlocation"] = true;
                $_SESSION['displaydata']["programobjective"]["displayprogramobjective"] = true;
                $_SESSION['displaydata']["programresponsible"]["displayprogramresponsible"] = true;
                $_SESSION['displaydata']["setup"]["displaysetup"] = true;
                $_SESSION['displaydata']["equipsupply"]["displayequipsupply"] = true;
                $_SESSION['displaydata']["servicecode"]["displayservicecode"] = true;
                $_SESSION['displaydata']["budget"]["displaybudget"] = true;
                $_SESSION['displaydata']["refreshments"]["displayrefreshments"] = true;
                $_SESSION["displaydata"]['program']["newprogram"] = true;
            }
            if ($_POST['selectedprogram'] > 0) {
                $_SESSION["program"]['programid'] = $_POST['selectedprogram'];
                if (isset($_SESSION ["displaydata"] ["name"])) {
                    $_SESSION['displaydata'][$_SESSION ["displaydata"] ["name"]]["default"] = $_POST['selectedprogram'];
                   }
                $tblprogram = $program->getrecord($_SESSION["program"]['programid']);
                $_SESSION['program']['firstname'] = $tblprogram['firstname'];
                $_SESSION['program']['lastname'] = $tblprogram['lastname'];
                $_SESSION['program']['fullname'] = $tblprogram['fullname'];
                $_SESSION['program']['gender'] = $tblprogram['gender'];
                $_SESSION['program']['birthdate'] = $tblprogram['birthdate'];
                $_SESSION['program']['mobilityplusid'] = $tblprogram['mobilityplusid'];
                $_SESSION['displaydata']["programlocation"]["displayprogramlocation"] = true;
                $_SESSION['displaydata']["programobjective"]["displayprogramobjective"] = true;
                $_SESSION['displaydata']["programresponsible"]["displayprogramresponsible"] = true;
                $_SESSION['displaydata']["setup"]["displaysetup"] = true;
                $_SESSION['displaydata']["equipsupply"]["displayequipsupply"] = true;
                $_SESSION['displaydata']["servicecode"]["displayservicecode"] = true;
                $_SESSION['displaydata']["budget"]["displaybudget"] = true;
                $_SESSION['displaydata']["refreshments"]["displayrefreshments"] = true;
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
// Load the displaydata class  - programlocation
        $programlocation = new DisplayData($db);
        $programlocation->setdisplaydata('programlocation');
        $programlocation->SetTemplate('displaygrid', $db);
// Set the query, select all rows from the people table
        $programlocation->setQuery("programid,organizationid,location", "location", "", "programid = " . $_SESSION['program']['programid']);
        $programlocation->setPrimaryID('programlocationid');
        $programlocation->setConstantFields(array("programid" => $_SESSION["program"]['programid']));
        $programlocation->setURLConstant("inputprogram.php");
        $programlocation->setOrder('programid');

// Hide ID field
        $programlocation->hidefield('programid');
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
        $programlocation->SetFieldHeader('programid', '' . 'Person Id:');
        $programlocation->SetFieldHeader('organizationid', '' . 'Organization Id:');
        $programlocation->SetFieldHeader('programlocation', '' . 'Location:');
//  set field type
        $programlocation->SetFieldType('programid', displaydata::TYPE_FIELD, array('table' => 'program', 'displayfield' => 'fullname', 'inputfield' => 'programid'));
        $programlocation->SetFieldType('organizationid', displaydata::TYPE_FIELD, array('table' => 'organization', 'displayfield' => 'name', 'inputfield' => 'organizationid'));
        $programlocation->SetFieldType('programlocation', displaydata::TYPE_CODEDISPLAY, array('table' => 'programlocation', 'field' => 'programlocation', 'class' => 'body'));
        $programlocation->SetFieldType('notes', displaydata::TYPE_NOTE, array('name' => 'programlocationnotes', 'class' => 'subtitle', 'text' => 'Display Relationship Notes', 'size' => 15, 'outbaseurl' => 'outputnotes.php', 'inbaseurl' => 'inputnotes', 'returnurl' => "inputprogram.php", 'notestype' => 'persrel'));
//  set inlineedit field type
        $programlocation->SetInlineFieldType('programid', displaydata::INLINE_COMBOBOX, array('name' => "programid", "table" => "program", "where" => "" . $_SESSION["program"]["programid"], 'order_by' => 'fullname', 'asc' => 'ASC', 'value' => 'programid', 'display' => 'fullname', 'class' => 'body', 'pleaseselect' => false, 'commonelements' => array(), 'default' => "", 'noinput' => false, 'AllowNew' => false, 'newname' => '', 'new' => false, 'size' => '30')); // program
        $programlocation->SetInlineFieldType('organizationid', displaydata::INLINE_COMBOBOX, array('name' => "organizationid", "table" => "organization", "where" => "", 'order_by' => 'name', 'asc' => 'ASC', 'value' => 'organizationid', 'display' => 'name', 'class' => 'body', 'pleaseselect' => false, 'commonelements' => array(), 'default' => "", 'noinput' => false, 'AllowNew' => false, 'newname' => '', 'new' => false, 'size' => '30')); // organization
        $programlocation->SetInlineFieldType('programlocation', displaydata::INLINE_CODECOMBO, array('name' => 'programlocation', 'table' => 'programlocation', 'field' => 'programlocation', 'class' => 'body')); // programlocation
        $programlocation->SetInlineFieldType('notes', displaydata::INLINE_NOTE, array('name' => 'programlocationnotes', 'class' => 'subtitle', 'text' => 'Add Relationship Note', 'size' => 15, 'outbaseurl' => 'outputnotes.php', 'inbaseurl' => 'inputnote.php', 'rerurnurl' => "inputprogram.php", 'notestype' => 'persrel'));

// Stop ordering
        $programlocation->hideOrder(false);

// Load the database adapter -programobjective
// Load the displaydata class
        $programobjective = new DisplayData($db);
        $programobjective->setdisplaydata('programobjective');
        $programobjective->SetTemplate('displayprogramobjective', $db);
// Set the query, select all rows from the people table
        $programobjective->setQuery("programobjective", "programobjective", "", "programid = " . $_SESSION['program']["programid"]);
        $programobjective->setPrimaryID('programobjectiveid');
        $programobjective->setConstantFields(array("programid" => $_SESSION["program"]['programid']));
        $programobjective->setURLConstant("inputprogram.php");
        $programobjective->setOrder('programid');

// Hide ID field
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
        $programobjective->SetFieldType('programobjective', displaydata::TYPE_CODEDISPLAY, array('table' => 'programobjective', 'field' => 'programobjective', 'class' => 'body'));
//  set inlineedit field type
        $programobjective->SetInlineFieldType('programobjective', displaydata::INLINE_CODECOMBO, array('name' => 'programobjective', 'table' => 'programobjective', 'where' => 'programid = "' . $_SESSION['program']['programid'], 'field' => 'programobjective', 'class' => 'body')); // programobjective
// Stop ordering
        $programobjective->hideOrder(false);
// Load the displaydata class  - programresponsible
        $programresponsible = new DisplayData($db);
        $programresponsible->setdisplaydata('programresponsible');
        $programresponsible->SetTemplate('displayprogramresponsible', $db);
// Set the query, select all rows from the people table
        $programresponsible->setQuery("personid", "programresponsible", "", "programid = " . $_SESSION['program']['programid']);
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
        $programresponsible->SetFieldType('programresponsible', displaydata::TYPE_CODEDISPLAY, array('table' => 'programresponsible', 'field' => "personid", 'class' => 'body'));
        $programresponsible->SetFieldType('expirydate', displaydata::TYPE_DATE, array('format' => $_SESSION['preferences']['dateformat'], 'value' => 'expirydate', 'class' => 'body'));
//  set inlineedit field type
        $programresponsible->SetInlineFieldType('programresponsible', displaydata::INLINE_CODECOMBO, array('name' => 'programresponsible', 'table' => 'programresponsible', 'field' => 'programresponsible', 'class' => 'body')); // programresponsible
        $programresponsible->SetInlineFieldType('expirydate', displaydata::INLINE_DATECOMBO, array('name' => 'expirydate', 'classtext' => 'body', 'classctl' => 'subtitle', 'text' => '', 'defaultdate' => 'expirydate')); // expirydate
// Stop ordering
        $programresponsible->hideOrder(false);
// Load the displaydata class  - setup
        $setup = new DisplayData($db);
        $setup->setdisplaydata('setup');
        $setup->SetTemplate('displaysetup', $db);
// Set the query, select all rows from the people table
        $setup->setQuery("setup", "setup", "", "programid = " . $_SESSION['program']["programid"]);
        $setup->setPrimaryID('setupid');
        $setup->setConstantFields(array("programid" => $_SESSION["program"]['programid']));
        $setup->setURLConstant("inputprogram.php");
        $setup->setOrder('programid');

// Hide ID field
        $setup->hidefield('programid');
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
        $setup->SetFieldHeader('setup', 'Setup.Special Adaptations:');
//  set field type
        $setup->SetFieldType('setup', displaydata::TYPE_CODEDISPLAY, array('table' => 'setup', 'field' => 'setup', 'class' => 'body'));
        $setup->SetFieldType('notes', displaydata::TYPE_NOTE, array('name' => 'setupnotes', 'class' => 'subtitle', 'text' => 'Display Mobility Aid Note', 'size' => 15, 'outbaseurl' => 'outputnotes.php', 'inbaseurl' => 'inputnotes.php', 'notestype' => 'persmob'));
//  set inlineedit field type
        $setup->SetInlineFieldType('setup', displaydata::INLINE_CODECOMBO, array('name' => 'setup', 'table' => 'setup', 'field' => 'setup', 'class' => 'body')); // setup
        $setup->SetInlineFieldType('notes', displaydata::INLINE_NOTE, array('name' => 'setupnotes', 'class' => 'subtitle', 'text' => 'Add Mobility Aid Note', 'size' => 15, 'outbaseurl' => 'outputnotes.php', 'inbaseurl' => 'inputnotes.php', 'notestype' => 'persmob'));

// Stop ordering
        $setup->hideOrder(false);
// Load the displaydata class  - equipsupply
        $equipsupply = new DisplayData($db);
        $equipsupply->setdisplaydata('equipsupply');
        $equipsupply->SetTemplate('displayegrid', $db);
// Set the query, select all rows from the people table
        $equipsupply->setQuery("type,equipsupply1,equipsupply2,city,prov,postalcode", "equipsupply", "", "programid =" . $_SESSION['program']["programid"]);
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
        $equipsupply->SetFieldHeader('type', '' . 'Type:');
        $equipsupply->SetFieldHeader('equipsupply1', '' . 'Address 1:');
        $equipsupply->SetFieldHeader('equipsupply2', '' . 'Address 2:');
        $equipsupply->SetFieldHeader('city', '' . 'City:');
        $equipsupply->SetFieldHeader('prov', '' . 'Province:');
        $equipsupply->SetFieldHeader('postalcode', '' . 'Postal Code:');
//  set field type
        $equipsupply->SetFieldType('type', displaydata::TYPE_CODEDISPLAY, array('table' => 'equipsupply', 'field' => 'type', 'class' => 'body'));
        $equipsupply->SetFieldType('equipsupply1', displaydata::TYPE_TEXT);
        $equipsupply->SetFieldType('equipsupply2', displaydata::TYPE_TEXT);
        $equipsupply->SetFieldType('city', displaydata::TYPE_TEXT);
        $equipsupply->SetFieldType('prov', displaydata::TYPE_TEXT);
        $equipsupply->SetFieldType('postalcode', displaydata::TYPE_TEXT);
        $equipsupply->SetFieldType('notes', displaydata::TYPE_NOTE, array('name' => 'equipsupplynotes', 'class' => 'subtitle', 'text' => 'Display Address Note', 'size' => 15, 'outbaseurl' => 'outputnotes.php', 'inbaseurl' => 'inputnotes.php', 'notestype' => 'persaddr'));
//  set inlineedit field type
        $equipsupply->SetInlineFieldType('type', displaydata::INLINE_CODECOMBO, array('name' => 'type', 'table' => 'equipsupply', 'field' => 'type', 'class' => 'body')); // equipsupply type
        $equipsupply->SetInlineFieldType('equipsupply1', displaydata::INLINE_TEXT, array('name' => 'equipsupply1', 'size' => 30, 'class' => 'body')); // equipsupply1
        $equipsupply->SetInlineFieldType('equipsupply2', displaydata::INLINE_TEXT, array('name' => 'equipsupply2', 'size' => 30, 'class' => 'body')); // equipsupply2
        $equipsupply->SetInlineFieldType('city', displaydata::INLINE_TEXT, array('name' => 'city', 'size' => 15, 'class' => 'body')); // city
        $equipsupply->SetInlineFieldType('prov', displaydata::INLINE_TEXT, array('name' => 'prov', 'size' => 8, 'class' => 'body')); // provence
        $equipsupply->SetInlineFieldType('postalcode', displaydata::INLINE_POSTALCODE, array('name' => 'postalcode', 'size' => 7, 'class' => 'body')); // postalcode
        $equipsupply->SetInlineFieldType('notes', displaydata::INLINE_NOTE, array('name' => 'equipsupplynotes', 'class' => 'subtitle', 'text' => 'Add Address Note', 'size' => 15, 'outbaseurl' => 'outputnotes.php', 'inbaseurl' => 'inputnotes.php', 'returnurl' => 'inputprogram.php', 'notestype' => 'persaddr'));

// Stop ordering
        $equipsupply->hideOrder(false);
// Load the displaydata class  - servicecode
        $servicecode = new DisplayData($db);
        $servicecode->setdisplaydata('servicecode');
        $servicecode->SetTemplate('displayservicecode', $db);
// Set the query, select all rows from the people table
        $servicecode->setQuery("servicecodetype,servicecodenumber", "servicecode", "", "programid = " . $_SESSION['program']["programid"]);
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
        $servicecode->SetFieldHeader('servicecodetype', 'Telephone Type:');
        $servicecode->SetFieldHeader('servicecodenumber', 'Telephone Number:');
//  set field type
        $servicecode->SetFieldType('servicecodetype', displaydata::TYPE_CODEDISPLAY, array('table' => 'servicecode', 'field' => 'servicecodetype', 'class' => 'body'));
        $servicecode->SetFieldType('servicecodenumber', displaydata::TYPE_TELEPHONE, array('table' => 'servicecode', 'field' => 'servicecodenumber', 'size' => 10, 'class' => 'body'));
        $servicecode->SetFieldType('notes', displaydata::TYPE_NOTE, array('name' => 'servicecodenotes', 'class' => 'subtitle', 'text' => 'Display Telephone Note', 'size' => 15, 'outbaseurl' => 'outputnotes.php', 'inbaseurl' => 'inputnotes.php', 'returnurl' => 'inputprogram', 'notestype' => 'perstel'));
//  set inlineedit field type
        $servicecode->SetInlineFieldType('servicecodetype', displaydata::INLINE_CODECOMBO, array('name' => 'servicecodetype', 'table' => 'servicecode', 'field' => 'servicecodetype', 'class' => 'body')); // servicecodetype
        $servicecode->SetInlineFieldType('servicecodenumber', displaydata::INLINE_TELEPHONE, array('name' => 'servicecodenumber', 'table' => 'servicecode', 'field' => 'servicecodenumber', 'class' => 'body', 'size' => 10)); // servicecodenumber
        $servicecode->SetInlineFieldType('notes', displaydata::INLINE_NOTE, array('name' => 'servicecodenotes', 'class' => 'subtitle', 'text' => 'Add Telephone Note', 'size' => 15, 'outbaseurl' => 'outputnotes.php', 'inbaseurl' => 'inputnotes.php', 'returnurl' => 'inputprogram.php', 'notestype' => 'perstel'));

// Stop ordering
        $servicecode->hideOrder(false);
// Load the displaydata class  - budget
        $budget = new DisplayData($db);
        $budget->setdisplaydata('budget');
        $budget->SetTemplate('displaybudget', $db);
// Set the query, select all rows from the people table
        $budget->setQuery("emailtype,email", "email", "", "programid = " . $_SESSION['program']["programid"]);
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
        $budget->SetFieldHeader('emailtype', 'Email Type:');
//  set field type
        $budget->SetFieldType('emailtype', displaydata::TYPE_CODEDISPLAY, array('table' => 'budget', 'field' => 'emailtype', 'class' => 'body'));
        $budget->SetFieldType('email', displaydata::TYPE_EMAIL, array('table' => 'budget', 'field' => 'email', 'class' => 'body', 'size' => 20));
        $budget->SetFieldType('notes', displaydata::TYPE_NOTE, array('name' => 'budgetnotes', 'class' => 'subtitle', 'text' => 'Display Email Note', 'size' => 15, 'outbaseurl' => 'outputnotes.php', 'inbaseurl' => 'inputnotes.php', 'returnurl' => 'inputprogram.php', 'notestype' => 'persemail'));
//  set inlineedit field type
        $budget->SetInlineFieldType('emailtype', displaydata::INLINE_CODECOMBO, array('name' => 'budgettype', 'table' => 'budget', 'field' => 'budgettype', 'class' => 'body')); // budget type
        $budget->SetInlineFieldType('email', displaydata::INLINE_EMAIL, array('name' => 'budget', 'table' => 'budget', 'field' => 'email', 'class' => 'body', 'size' => 20)); // budget 
        $budget->SetInlineFieldType('notes', displaydata::INLINE_NOTE, array('name' => 'emailnotes', 'class' => 'subtitle', 'text' => 'Add Email Note', 'size' => 15, 'outbaseurl' => 'outputnotes.php', 'inbaseurl' => 'inputnotes.php', 'returnurl' => 'inputprogram.php', 'notedtype' => 'persemail'));

// Stop ordering
        $budget->hideOrder(false);
// Load the displaydata class  - refreshments
        $refreshments = new DisplayData($db);
        $refreshments->setdisplaydata('refreshments');
        $refreshments->SetTemplate('Displaygrid', $db);
// Set the query, select all rows from the people table
        $refreshments->setQuery("refreshments", "refreshments", "", "");
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
        $refreshments->SetFieldHeader('refreshments', 'Notes:');
//  set field type
        $refreshments->SetFieldType('refreshments', displaydata::TYPE_NOTE, array('name' => 'programrefreshments', 'class' => 'subtitle', 'text' => 'Display Person Note', 'size' => 15, 'outbaseurl' => 'outputrefreshments.php', 'inbaseurl' => 'inputrefreshments.php', 'returnurl' => 'inputprogram.php', 'refreshmentstype' => 'per'));
        $refreshments->SetInlineFieldType('refreshments', displaydata::INLINE_NOTE, array('name' => 'programrefreshments', 'class' => 'subtitle', 'text' => 'Add Person Note', 'size' => 15, 'outbaseurl' => 'outputrefreshments.php', 'inbaseurl' => 'inputrefreshments.php', 'returnurl' => 'inputprogram.php', 'refreshmentstype' => 'per'));
        $refreshments->hideOrder(false);
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
        $pref->header('Input Person');
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
        <form id="enterprogram" name="enterprogram"  action="inputprogram.php" method="post" enctype="multipart/form-data" >
            <table class="tbl" width="100%">
                <tr>
                    <td class ='subtitle'>Program Name&nbsp:
                    <?PHP
                    echo'<input name="name" class="body" type="text" size=40 value="' . $_SESSION["program"]["name"] . '">';
                    ?>        
                    </td>
                    <td class="subtitle">Department&nbsp:
                        <?PHP
                            echo $validate->CodeCombo("department", "program", "department", "body", $_SESSION["program"]["department"]);
                        ?>
                    </td>
                </tr>
                <tr>
                    <td class ='subtitle'>Program Description&nbsp;:</td>
                </tr>
                <tr>
                    <td>
                        <textarea id='description' name="description" class ='body' rows="5" cols="45"><?php echo $_SESSION['organization']['description']; ?></textarea>
                    </td>
                 </tr>
            </table>
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
                        if ($_SESSION['displaydata']["programlocation"]["displayprogramlocation"]) {
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
                            if ($_SESSION['displaydata']["programresponsible"]["displayprogramresponsible"]) {
                                echo '<tr>
                                        <td class ="subtitle">Person Responsible:</td>
                                    </tr>
                                    <tr>
                                        <td>';
                                $_SESSION ["displaydata"] ["name"] = 'programresponsible';
                                $programresponsible->printdata();
                            }
                            if ($_SESSION['displaydata']["setup"]["displaysetup"]) {
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
            </table>
            <table class="tbl" width="100%">
               <tr>            
                    <td>
                        <?PHP
                            if ($_SESSION['displaydata']["budget"]["displaybudget"]) {
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
            <tr>
                <td class="title"  align="left">Recurrence Pattern</td>
		<td width="100%" align="center">
			<img src="Images/UnderConstruction.gif" alt="picture" name="pic" width="200" height="200" align="middle">
		</td>
	</tr>
        </table>
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