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
        <TITLE>KWA Input Organization</TITLE>
        <?PHP
        require_once "displayrelationship.php";
        require_once "class.preferences.php";
        require_once "displaymembership.php";
        require_once "class.organization.php";
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
        if (!isset($_POST['organizationsave']))
            $_POST['organizationsave'] = '';
        if (!isset($_POST['organizationdelete']))
            $_POST['organizationdelete'] = '';
        if (!isset($_POST['selectorganization']))
            $_POST['selectorganization'] = '';
        if (!isset($_POST['refreshname']))
            $_POST['refreshname'] = '';
        if (!isset($_POST['relationshipnotes']))
            $_POST['relationshipnotes'] = '';
        if (!isset($_POST['addressnotes']))
            $_POST['addressnotes'] = '';
        if (!isset($_POST['organizationnotes']))
            $_POST['organizationnotes'] = '';
        if (!isset($_SESSION['organization']['organizationid']))
            $_SESSION['organization']['organizationid'] = 0;
        if (!isset($_SESSION['organization']['name']))
            $_SESSION['organization']['name'] = ' ';
        if (!isset($_SESSION['organization']['descripton']))
            $_SESSION['organization']['description'] = ' ';
        if (!isset($_SESSION['displaydata']["relationship"]["displayrelationship"])) {
            $_SESSION['displaydata']["relationship"]["displayrelationship"] = false;
        }
        if (!isset($_SESSION['displaydata']["status"]["displaystatus"])) {
            $_SESSION['displaydata']["status"]["displaystatus"] = false;
        }
        if (!isset($_SESSION['displaydata']["membership"]["displaymembership"])) {
            $_SESSION['displaydata']["membership"]["displaymembership"] = false;
        }
        if (!isset($_SESSION['displaydata']["membership"]["click"])) {
            $_SESSION['displaydata']["membership"]["click"] = false;
        }
        if (!isset($_SESSION['displaydata']["relationship"]["click"])) {
            $_SESSION['displaydata']["relationship"]["click"] = false;
        }
        if (!isset($_SESSION['displaydata']["address"]["displayaddress"])) {
            $_SESSION['displaydata']["address"]["displayaddress"] = false;
        }
        if (!isset($_SESSION['displaydata']["address"]["click"])) {
            $_SESSION['displaydata']["address"]["click"] = false;
        }
        if (!isset($_SESSION['displaydata']["telephone"]["displaytelephone"])) {
            $_SESSION['displaydata']["telephone"]["displaytelephone"] = false;
        }
        if (!isset($_SESSION['displaydata']["telephone"]["click"])) {
            $_SESSION['displaydata']["telephone"]["click"] = false;
        }
        if (!isset($_SESSION['displaydata']["email"]["displayemail"])) {
            $_SESSION['displaydata']["email"]["displayemail"] = false;
        }
        if (!isset($_SESSION['displaydata']["email"]["click"])) {
            $_SESSION['displaydata']["email"]["click"] = false;
        }
        if (!isset($_SESSION['displaydata']["notes"]["displaynotes"])) {
            $_SESSION['displaydata']["notes"]["displaynotes"] = false;
        }
        if (!isset($_SESSION['displaydata']["notes"]["click"])) {
            $_SESSION['displaydata']["notes"]["click"] = false;
        }
        if (!isset($_SESSION["displaydata"]['organization']["neworganization"])) {
            $_SESSION["displaydata"]['organization']["neworganization"] = false;
        }
        if (!isset($_SESSION["displaydata"]['organization']["organizationnew"])) {
            $_SESSION["displaydata"]['organization']["organizationnew"] = false;
        }
        $validate = new validate;
        $msg = new messages;
        $organization = new organization;
        $checknotes = new DisplayData($db);
        $checknotes->checknotes();
        if ($_POST['organizationsave'] === (string) 'Save') {
            $organization->saverecord($_SESSION["organization"]['organizationid'], $_POST['name'], $_POST['description']);
        }
        if ($_POST['organizationdelete'] == 'Delete') {
            $organization->deleterecord($_SESSION["organization"]['organizationid']);
            $_SESSION['displaydata'][$_SESSION ["displaydata"] ["name"]]["default"] = 0;
        }
        if ($_POST['selectorganization'] == 'Select') {
            if ($_POST['selectedorganization'] == -99) {
                $_SESSION['displaydata'][$_SESSION ["displaydata"] ["name"]]["pleaseselect"] = false;
                $_SESSION['displaydata'][$_SESSION ["displaydata"] ["name"]]["neworganization"] = true;
            }
            if ($_POST['selectedorganization'] > 0) {
                $_SESSION["organization"]['organizationid'] = $_POST['selectedorganization'];
                if (isset($_SESSION ["displaydata"] ["name"])) {
                    $_SESSION['displaydata'][$_SESSION ["displaydata"] ["name"]]["default"] = $_SESSION["organization"]['organizationid'];
                }
                $tblorganization = $organization->getrecord($_SESSION["organization"]['organizationid']);
                $_SESSION['organization']['name'] = $tblorganization['name'];
                $_SESSION['organization']['description'] = $tblorganization['description'];
                $_SESSION['displaydata']["relationship"]["displayrelationship"] = true;
                $_SESSION['displaydata']["status"]["displaystatus"] = true;
                $_SESSION['displaydata']["membership"]["displaymembership"] = true;
                $_SESSION['displaydata']["address"]["displayaddress"] = true;
                $_SESSION['displaydata']["telephone"]["displaytelephone"] = true;
                $_SESSION['displaydata']["email"]["displayemail"] = true;
                $_SESSION['displaydata']["notes"]["displaynotes"] = true;
            }
        }
        if ($_POST['refreshname'] == 'Refresh') {
            if ($_POST['selectedorganization'] == '0') {
                $msg->DisplayMessage('selectorganization');
                $_SESSION['displaydata']["relationship"]["displayrelationship"] = false;
                $_SESSION['displaydata']["status"]["displaystatus"] = false;
                $_SESSION['displaydata']["membership"]["displaymembership"] = false;
                $_SESSION['displaydata']["mobilityaid"]["displaymobilityaid"] = false;
                $_SESSION['displaydata']["address"]["displayaddress"] = false;
                $_SESSION['displaydata']["telephone"]["displaytelephone"] = false;
                $_SESSION['displaydata']["email"]["displayemail"] = false;
                $_SESSION['displaydata']["notes"]["displaynotes"] = false;
                $_SESSION["displaydata"]['organization']["organization"] = false;
            }
            if ($_POST["selectorganization"] == -99) {
                $_SESSION['displaydata'][$_SESSION ["displaydata"] ["name"]]["pleaseselect"] = false;
                $_SESSION['displaydata'][$_SESSION ["displaydata"] ["name"]]["organizationnew"] = true;
                $_SESSION['displaydata']["relationship"]["displayrelationship"] = true;
                $_SESSION['displaydata']["status"]["displaystatus"] = true;
                $_SESSION['displaydata']["membership"]["displaymembership"] = true;
                $_SESSION['displaydata']["address"]["displayaddress"] = true;
                $_SESSION['displaydata']["telephone"]["displaytelephone"] = true;
                $_SESSION['displaydata']["email"]["displayemail"] = true;
                $_SESSION['displaydata']["notes"]["displaynotes"] = true;
                $_SESSION["displaydata"]['organization']["neworganization"] = true;
            }
            if ($_POST['selectedorganization'] > 0) {
                $_SESSION["organization"]['organizationid'] = $_POST['selectedorganization'];
                if (isset($_SESSION ["displaydata"] ["name"])) {
                    $_SESSION['displaydata'][$_SESSION ["displaydata"] ["name"]]["default"] = $_SESSION["organization"]['organizationid'];
                }
                $tblorganization = $organization->getrecord($_SESSION["organization"]['organizationid']);
                $_SESSION['organization']['name'] = $tblorganization['name'];
                $_SESSION['organization']['description'] = $tblorganization['description'];
            }
        }
        if ($_SESSION["displaydata"]['organization']["neworganization"]) {
            $_SESSION["displaydata"]['organization']["neworganization"] = false;
            $_SESSION["organization"]['organizationid'] = $organization->insertrecord();
            $_POST[$_SESSION['displaydata']["name"] . 'editline'] = 'E1';
        }
        if ($_SESSION["displaydata"]['organization']["organizationnew"]) {
            $_SESSION["displaydata"]['organization']["neworganization"] = true;
        }
        if ($_SESSION["displaydata"]["relationship"]["click"]) {
            $_SESSION["displaydata"]["relationship"]["DisplayData"] = true;
        }
        if ($_SESSION["displaydata"]["membership"]["click"]) {
            $_SESSION["displaydata"]["membership"]["DisplayData"] = true;
        }
        if ($_SESSION["displaydata"]["address"]["click"]) {
            $_SESSION["displaydata"]["address"]["DisplayData"] = true;
        }
// Load the displaydata class  - relationship
        $relationship = new DisplayData($db);
        $relationship->setdisplaydata('relationship');
        $relationship->SetTemplate('displayrelationship', $db);
// Set the query, select all rows from the people table
        $relationship->setQuery("organizationid,personid,relationship", "relationship", "", "organizationid = '" . $_SESSION['organization']["organizationid"] . "'");
        $relationship->setinsertvalue(array("relationship" => "New"));
        $relationship->setPrimaryID('relationshipid');
        $relationship->setConstantFields(array("organizationid" => "'" . $_SESSION["organization"]['organizationid'] . "'"));
        $relationship->setURLConstant("inputorganization.php");
        $relationship->setOrder('organizationid');

// Hide ID field
        $relationship->hidefield('organizationid');
// Show reset grid control
        $relationship->showReset();

// setting inline edit
        $relationship->SetInLineEdit(true);
// Add standard control
        $relationship->addStandardControl(displaydata::STDCTRL_INLINEEDIT, "inputorganization.php", displaydata::TYPE_PHPFUNCTION);
// Add create control
        $relationship->showCreateButton("inputorganization.php", displaydata::TYPE_INLINEADDRECORD, 'New');

// Show checkboxes
// Show row numbers
        $relationship->showRowNumber(true);

// Change the amount of results per page
        $relationship->setResultsPerPage(2);

// Change headers text
        $relationship->SetFieldHeader('organizationid', '' . 'Person Id:');
        $relationship->SetFieldHeader('organizationid', '' . 'Organization Id:');
        $relationship->SetFieldHeader('relationship', '' . 'Relationship');
//  set field type
        $relationship->SetFieldType('organizationid', displaydata::TYPE_FIELD, array('table' => 'organization', 'displayfield' => 'name', 'inputfield' => 'organizationid'));
        $relationship->SetFieldType('personid', displaydata::TYPE_FIELD, array('table' => 'person', 'displayfield' => 'fullname', 'inputfield' => 'personid'));
        $relationship->SetFieldType('relationship', displaydata::TYPE_CODEDISPLAY, array('table' => 'relationship', 'field' => 'relationship', 'class' => 'body'));
        $relationship->SetFieldType('notes', displaydata::TYPE_NOTE, array('name' => 'relationshipnotes', 'class' => 'subtitle', 'text' => 'Display Relationship Notes', 'size' => 15, 'outbaseurl' => 'outputnotes.php', 'inbaseurl' => 'inputnotes.php', 'returnurl' => "inputorganization.php", 'notestype' => 'orgrel'));
//  set inlineedit field type
        $relationship->SetInlineFieldType('organizationid', displaydata::INLINE_COMBOBOX, array('name' => "organizationid", "table" => "organization", "where" => "" . $_SESSION["organization"]["organizationid"], 'order_by' => 'name', 'asc' => 'ASC', 'value' => 'organizationid', 'display' => 'name', 'class' => 'body', 'pleaseselect' => false, 'commonelements' => array(), 'default' => "", 'noinput' => false, 'AllowNew' => false, 'newname' => '', 'new' => false, 'size' => '30')); // organization
        $relationship->SetInlineFieldType('personid', displaydata::INLINE_COMBOBOX, array('name' => "personid", "table" => "person", "where" => "" . $_SESSION["organization"]["organizationid"], 'order_by' => 'fullname', 'asc' => 'ASC', 'value' => 'personid', 'display' => 'fullname', 'class' => 'body', 'pleaseselect' => false, 'commonelements' => array(), 'default' => "", 'noinput' => false, 'AllowNew' => false, 'newname' => '', 'new' => false, 'size' => '30')); // person
        $relationship->SetInlineFieldType('relationship', displaydata::INLINE_CODECOMBO, array('name' => 'relationship', 'table' => 'relationship', 'field' => 'relationship', 'class' => 'body')); // relation
        $relationship->SetInlineFieldType('notes', displaydata::INLINE_NOTE, array('name' => 'relationshipnotes', 'class' => 'subtitle', 'text' => 'Add Relationship Note', 'size' => 15, 'outbaseurl' => 'outputnotes.php', 'inbaseurl' => 'inputnote.php', 'returnurl' => "inputorganization.php", 'notestype' => 'orgrel'));

// Stop ordering
        $relationship->hideOrder(false);

// Load the database adapter -status
// Load the displaydata class
        $status = new DisplayData($db);
        $status->setdisplaydata('status');
        $status->SetTemplate('displaystatus', $db);
// Set the query, select all rows from the people table
        $status->setQuery("status", "status", "", "organizationid = '" . $_SESSION['organization']["organizationid"] . "'");
        $status->setinsertvalue(array("status" => "New Status"));
        $status->setPrimaryID('statusid');
        $status->setConstantFields(array("organizationid" => "'" . $_SESSION["organization"]['organizationid'] . "'"));
        $status->setURLConstant("inputorganization.php");
        $status->setOrder('organizationid');

// Hide ID field
        $status->hidefield('organizationid');
// Show reset grid control
        $status->showReset();

// setting inline edit
        $status->SetInLineEdit(true);
// Add standard control
        $status->addStandardControl(displaydata::STDCTRL_INLINEEDIT, "inputorganization.php", displaydata::TYPE_PHPFUNCTION);
// Add create control
        $status->showCreateButton("inputorganization.php", displaydata::TYPE_INLINEADDRECORD, 'New');

// Show checkboxes
// Show row numbers
        $status->showRowNumber(true);
// Change the amount of results per page
        $status->setResultsPerPage(2);

// Change headers text
        $status->SetFieldHeader('status', 'Status:');
//  set field type
        $status->SetFieldType('status', displaydata::TYPE_CODEDISPLAY, array('table' => 'status', 'field' => 'status', 'class' => 'body'));
//  set inlineedit field type
        $status->SetInlineFieldType('status', displaydata::INLINE_CODECOMBO, array('name' => 'status', 'table' => 'status', 'where' => 'organizationid = "' . $_SESSION['organization']['organizationid'] . "'", 'field' => 'status', 'class' => 'body')); // status
// Stop ordering
        $status->hideOrder(false);
// Load the displaydata class  - membership
        $membership = new DisplayData($db);
        $membership->setdisplaydata('membership');
        $membership->SetTemplate('displaymembership', $db);
// Set the query, select all rows from the people table
        $membership->setQuery("membership,expirydate", "membership", "", "organizationid = '" . $_SESSION['organization']["organizationid"] . "'");
        $membership->setinsertvalue(array("membership" => "New Membership", "expirydate" => DATE($_SESSION['preferences']['dateformat'])));
        $membership->setPrimaryID('membershipid');
        $membership->setConstantFields(array("organizationid" => "'" . $_SESSION["organization"]['organizationid'] . "'"));
        $membership->setURLConstant("inputorganization.php");
        $membership->setOrder('organizationid');

// Hide ID field
        $membership->hidefield('organizationid');
// Show reset grid control
        $membership->showReset();

// setting inline edit
        $membership->SetInLineEdit(true);
// Add standard control
        $membership->addStandardControl(displaydata::STDCTRL_INLINEEDIT, "inputorganization.php", displaydata::TYPE_PHPFUNCTION);
// Add create control
        $membership->showCreateButton("inputorganization.php", displaydata::TYPE_INLINEADDRECORD, 'New');

// Show checkboxes
// Show row numbers
        $membership->showRowNumber(true);

// Change the amount of results per page
        $membership->setResultsPerPage(2);

// Change headers text
        $membership->SetFieldHeader('membership', '' . 'Membership Type:');
        $membership->SetFieldHeader('expirydate', '' . 'Expiry Date:');
//  set field type
        $membership->SetFieldType('membership', displaydata::TYPE_CODEDISPLAY, array('table' => 'membership', 'field' => 'membership', 'class' => 'body'));
        $membership->SetFieldType('expirydate', displaydata::TYPE_DATE, array('format' => $_SESSION['preferences']['dateformat'], 'value' => 'expirydate', 'class' => 'body'));
//  set inlineedit field type
        $membership->SetInlineFieldType('membership', displaydata::INLINE_CODECOMBO, array('name' => 'membership', 'table' => 'membership', 'field' => 'membership', 'class' => 'body')); // membership
        $membership->SetInlineFieldType('expirydate', displaydata::INLINE_DATECOMBO, array('name' => 'expirydate', 'classtext' => 'body', 'classctl' => 'subtitle', 'text' => '', 'defaultdate' => 'expirydate')); // expirydate
// Stop ordering
        $membership->hideOrder(false);
// Load the displaydata class  - address
        $address = new DisplayData($db);
        $address->setdisplaydata('address');
        $address->SetTemplate('displayaddress', $db);
// Set the query, select all rows from the people table
        $address->setQuery("type,address1,address2,city,prov,postalcode", "address", "", "organizationid = '" . $_SESSION['organization']["organizationid"] . "'");
        $address->setinsertvalue(array("address1" => "New Address"));
        $address->setPrimaryID('addressid');
        $address->setConstantFields(array("organizationid" => "'" . $_SESSION["organization"]['organizationid'] . "'"));
        $address->setURLConstant("inputorganization.php");
        $address->setOrder('organizationid');

// Hide ID field
        $address->hidefield('organizationid');
// Show reset grid control
        $address->showReset();

// setting inline edit
        $address->SetInLineEdit(true);
// Add standard control
        $address->addStandardControl(displaydata::STDCTRL_INLINEEDIT, "inputorganization.php", displaydata::TYPE_PHPFUNCTION);
// Add create control
        $address->showCreateButton("inputorganization.php", displaydata::TYPE_INLINEADDRECORD, 'New');

// Show checkboxes
// Show row numbers
        $address->showRowNumber(true);

// Change the amount of results per page
        $address->setResultsPerPage(2);

// Change headers text
        $address->SetFieldHeader('type', '' . 'Type:');
        $address->SetFieldHeader('address1', '' . 'Address 1:');
        $address->SetFieldHeader('address2', '' . 'Address 2:');
        $address->SetFieldHeader('city', '' . 'City:');
        $address->SetFieldHeader('prov', '' . 'Province:');
        $address->SetFieldHeader('postalcode', '' . 'Postal Code:');
//  set field type
        $address->SetFieldType('type', displaydata::TYPE_CODEDISPLAY, array('table' => 'address', 'field' => 'type', 'class' => 'body'));
        $address->SetFieldType('address1', displaydata::TYPE_TEXT);
        $address->SetFieldType('address2', displaydata::TYPE_TEXT);
        $address->SetFieldType('city', displaydata::TYPE_TEXT);
        $address->SetFieldType('prov', displaydata::TYPE_TEXT);
        $address->SetFieldType('postalcode', displaydata::TYPE_TEXT);
        $address->SetFieldType('notes', displaydata::TYPE_NOTE, array('name' => 'addressnotes', 'class' => 'subtitle', 'text' => 'Display Address Notes', 'size' => 15, 'outbaseurl' => 'outputnotes.php', 'inbaseurl' => 'inputnotes.php', 'returnurl' => 'inputorganization', 'notestype' => 'orgaddr'));
//  set inlineedit field type
        $address->SetInlineFieldType('type', displaydata::INLINE_CODECOMBO, array('name' => 'type', 'table' => 'address', 'field' => 'type', 'class' => 'body')); // address
        $address->SetInlineFieldType('address1', displaydata::INLINE_TEXT, array('name' => 'address1', 'size' => 30, 'class' => 'body')); // address1
        $address->SetInlineFieldType('address2', displaydata::INLINE_TEXT, array('name' => 'address2', 'size' => 30, 'class' => 'body')); // address2
        $address->SetInlineFieldType('city', displaydata::INLINE_TEXT, array('name' => 'city', 'size' => 15, 'class' => 'body')); // city
        $address->SetInlineFieldType('prov', displaydata::INLINE_TEXT, array('name' => 'prov', 'size' => 8, 'class' => 'body')); // provence
        $address->SetInlineFieldType('postalcode', displaydata::INLINE_POSTALCODE, array('name' => 'postalcode', 'size' => 7, 'class' => 'body')); // postalcode
        $address->SetInlineFieldType('notes', displaydata::INLINE_NOTE, array('name' => 'addressnotes', 'class' => 'subtitle', 'text' => 'Add Address Note', 'size' => 15, 'outbaseurl' => 'outputnotes.php', 'inbaseurl' => 'inputnotes', 'returnurl' => "inputorganization.php", 'notestype' => 'persaddr'));

// Stop ordering
        $address->hideOrder(false);
// Load the displaydata class  - telephone
        $telephone = new DisplayData($db);
        $telephone->setdisplaydata('telephone');
        $telephone->SetTemplate('displaytelephone', $db);
// Set the query, select all rows from the people table
        $telephone->setQuery("telephonetype,telephonenumber", "telephone", "", "organizationid = '" . $_SESSION['organization']["organizationid"] . "'");
        $telephone->setinsertvalue(array("telephonenumber" => "New Telephone"));
        $telephone->setPrimaryID('telephoneid');
        $telephone->setConstantFields(array("organizationid" => "'" . $_SESSION["organization"]['organizationid'] . "'"));
        $telephone->setURLConstant("inputorganization.php");
        $telephone->setOrder('organizationid');

// Hide ID field
        $telephone->hidefield('organizationid');
// Show reset grid control
        $telephone->showReset();

// setting inline edit
        $telephone->SetInLineEdit(true);
// Add standard control
        $telephone->addStandardControl(displaydata::STDCTRL_INLINEEDIT, "inputorganization.php", displaydata::TYPE_PHPFUNCTION);
// Add create control
        $telephone->showCreateButton("inputorganization.php", displaydata::TYPE_INLINEADDRECORD, 'New');

// Show checkboxes
// Show row numbers
        $telephone->showRowNumber(true);
// Change the amount of results per page
        $telephone->setResultsPerPage(2);

// Change headers text
        $telephone->SetFieldHeader('telephonetype', 'Telephone Type:');
        $telephone->SetFieldHeader('telephonenumber', 'Telephone Number:');
//  set field type
        $telephone->SetFieldType('telephonetype', displaydata::TYPE_CODEDISPLAY, array('table' => 'telephone', 'field' => 'telephonetype', 'class' => 'body'));
        $telephone->SetFieldType('telephonenumber', displaydata::TYPE_TELEPHONE, array('table' => 'telephone', 'field' => 'telephonenumber', 'class' => 'body'));
        $telephone->SetFieldType('notes', displaydata::TYPE_NOTE, array('name' => 'telephonenotes', 'class' => 'subtitle', 'text' => 'Display Telephone Note', 'size' => 15, 'outbaseurl' => 'outputnotes.php', 'inbaseurl' => 'inputnotes', 'returnurl' => "inputorganization.php", 'notestype' => 'orgtel'));
//  set inlineedit field type
        $telephone->SetInlineFieldType('telephonetype', displaydata::INLINE_CODECOMBO, array('name' => 'telephonetype', 'table' => 'telephone', 'field' => 'telephonetype', 'class' => 'body')); // telephonetype
        $telephone->SetInlineFieldType('telephonenumber', displaydata::INLINE_TELEPHONE, array('name' => 'telephonenumber', 'table' => 'telephone', 'field' => 'telephonenumber', 'class' => 'body')); // telephonenumber
        $telephone->SetInlineFieldType('notes', displaydata::INLINE_NOTE, array('name' => 'telephonenotes', 'class' => 'subtitle', 'text' => 'Add Telephone Note', 'size' => 15, 'outbaseurl' => 'outputnotes.php', 'inbaseurl' => 'inputnotes', 'returnurl' => "inputorganization.php", 'notestype' => 'orgtel'));

// Stop ordering
        $telephone->hideOrder(false);
// Load the displaydata class  - email
        $email = new DisplayData($db);
        $email->setdisplaydata('email');
        $email->SetTemplate('displayemail', $db);
// Set the query, select all rows from the people table
        $email->setQuery("emailtype,email", "email", "", "organizationid = '" . $_SESSION['organization']["organizationid"] . "'");
        $email->setinsertvalue(array("email" => "New Email"));
        $email->setPrimaryID('emailid');
        $email->setConstantFields(array("organizationid" => "'" . $_SESSION["organization"]['organizationid'] . "'"));
        $email->setURLConstant("inputorganization.php");
        $email->setOrder('organizationid');

// Hide ID field
        $email->hidefield('organizationid');
// Show reset grid control
        $email->showReset();

// setting inline edit
        $email->SetInLineEdit(true);
// Add standard control
        $email->addStandardControl(displaydata::STDCTRL_INLINEEDIT, "inputorganization.php", displaydata::TYPE_PHPFUNCTION);
// Add create control
        $email->showCreateButton("inputorganization.php", displaydata::TYPE_INLINEADDRECORD, 'New');

// Show checkboxes
// Show row numbers
        $email->showRowNumber(true);
// Change the amount of results per page
        $email->setResultsPerPage(2);

// Change headers text
        $email->SetFieldHeader('telephonetype', 'Telephone Type:');
//  set field type
        $email->SetFieldType('emailtype', displaydata::TYPE_CODEDISPLAY, array('table' => 'email', 'field' => 'emailtype', 'class' => 'body'));
        $email->SetFieldType('email', displaydata::TYPE_EMAIL, array('table' => 'email', 'field' => 'email', 'class' => 'body','size'=>30));
        $email->SetFieldType('notes', displaydata::TYPE_NOTE, array('name' => 'emailnotes', 'class' => 'subtitle', 'text' => 'Display Email Note', 'size' => 15, 'outbaseurl' => 'outputnotes.php', 'inbaseurl' => 'inputnotes', 'returnurl' => "inputorganization.php", 'notestsype' => 'persemail'));
//  set inlineedit field type
        $email->SetInlineFieldType('emailtype', displaydata::INLINE_CODECOMBO, array('name' => 'emailtype', 'table' => 'email', 'field' => 'emailtype', 'class' => 'body')); // email type
        $email->SetInlineFieldType('email', displaydata::INLINE_EMAIL, array('name' => 'email', 'table' => 'email', 'field' => 'email', 'class' => 'body')); // email 
        $email->SetInlineFieldType('notes', displaydata::INLINE_NOTE, array('name' => 'emailnotes', 'class' => 'subtitle', 'text' => 'Add Email Note', 'size' => 15, 'outbaseurl' => 'outputnotes.php', 'inbaseurl' => 'inputnotes', 'returnurl' => "inputorganization.php", 'notestype' => 'orgemail'));

// Stop ordering
        $email->hideOrder(false);
// Load the displaydata class  - notes
        $notes = new DisplayData($db);
        $notes->setdisplaydata('notes');
        $notes->SetTemplate('displaynotes', $db);
// Set the query, select all rows from the people table
        $notes->setQuery("notes", "notes", "", "");
        $notes->setinsertvalue(array("notes" => "New Note"));
        $notes->setPrimaryID('notesid');
        $notes->setConstantFields(array("organizationid" => "'" . $_SESSION["organization"]['organizationid'] . "'"));
        $notes->setURLConstant("inputorganization.php");
        $notes->setOrder('organizationid');

// Hide ID field
        $notes->hidefield('organizationid');
// Show reset grid control
        $notes->showReset();

// setting inline edit
        $notes->SetInLineEdit(true);
// Add standard control
        $notes->addStandardControl(displaydata::STDCTRL_INLINEEDIT, "inputorganization.php", displaydata::TYPE_PHPFUNCTION);
// Add create control
        $notes->showCreateButton("inputorganization.php", displaydata::TYPE_INLINEADDRECORD, 'New');

// Show checkboxes
// Show row numbers
        $notes->showRowNumber(true);
// Change the amount of results per page
        $notes->setResultsPerPage(2);

// Change headers text
        $notes->SetFieldHeader('notes', 'Note:');
//  set field type
        $notes->SetFieldType('notes', displaydata::TYPE_NOTE, array('name' => 'organizationnotes', 'class' => 'subtitle', 'text' => 'Display Organization Note', 'size' => 15, 'outbaseurl' => 'outputnotes.php', 'inbaseurl' => 'inputnotes.php', 'returnurl' => "inputorganization.php", 'notestype' => 'org'));
//  set inlineedit field type
        $notes->SetInlineFieldType('notes', displaydata::INLINE_NOTE, array('name' => 'organizationnotes', 'class' => 'subtitle', 'text' => 'Add Organization Note', 'size' => 15, 'outbaseurl' => 'outputnotes.php', 'inbaseurl' => 'inputnotes', 'returnurl' => "inputorganization.php", 'notestype' => 'org'));

// Stop ordering
        $notes->hideOrder(false);
        if (!isset($_SESSION['displaydata'][$_SESSION ["displaydata"] ["name"]]["organizationnew"]))
            $_SESSION['displaydata'][$_SESSION ["displaydata"] ["name"]]["organizationnew"] = false;
        if (!isset($_SESSION['displaydata'][$_SESSION ["displaydata"] ["name"]]["pleaseselect"]))
            $_SESSION['displaydata'][$_SESSION ["displaydata"] ["name"]]["pleaseselect"] = true;
        if (!isset($_SESSION['displaydata'][$_SESSION ["displaydata"] ["name"]]["default"]))
            $_SESSION['displaydata'][$_SESSION ["displaydata"] ["name"]]["default"] = 0;
        if (!isset($_SESSION['displaydata'][$_SESSION ["displaydata"] ["name"]]["organizationnew"]))
            $_SESSION['displaydata'][$_SESSION ["displaydata"] ["name"]]["organizationnew"] = false;
        if (!isset($_SESSION['displaydata'][$_SESSION ["displaydata"] ["name"]]["pleaseselect"]))
            $_SESSION['displaydata'][$_SESSION ["displaydata"] ["name"]]["pleaseselect"] = true;
        if (!isset($_SESSION['displaydata'][$_SESSION ["displaydata"] ["name"]]["default"]))
            $_SESSION['displaydata'][$_SESSION ["displaydata"] ["name"]]["default"] = 0;
        $checknotes = new DisplayData($db);
        $checknotes->checknotes();
        ?>
    </HEAD>
    <BODY>
        <?PHP
        $pref->header('Input Organization');
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
                <td class='subtitle'> Select Organization
                    <form id="selectorganization" name="selectorganization"  action="inputorganization.php" method="post" enctype="multipart/form-data" >
        <?php
        echo $validate->ComboBox("selectedorganization", "organization", '', '', "ASC", "organizationid", "name", "body", $_SESSION['displaydata'][$_SESSION ["displaydata"] ["name"]]["pleaseselect"], array('New Organization' => -99), $_SESSION['displaydata'][$_SESSION ["displaydata"] ["name"]]["default"], false, false, "neworganization", $_SESSION['displaydata'][$_SESSION ["displaydata"] ["name"]]["organizationnew"], "20", $_SESSION["preferences"]["database"]["dbname"]);
        ?>
                        <input type="submit" class='subtitle' name="selectorganization" value="Select">
                    </form>
                </td>
            </tr>
        </table> 
        <form id="enterorganization" name="enterorganization"  action="inputorganization.php" method="post" enctype="multipart/form-data" >
            <table class="tbl" width="100%">
                <tr>
                    <td class ='subtitle'>Name&nbsp:
                        <input name="name" class='body' value="<?php echo $_SESSION['organization']['name']; ?>" type="text" size="40" >
                    </td>
                </tr>
                <tr>
                    <td class ='subtitle'>Description&nbsp;:</td>
                </tr>
                <tr>
                    <td>
                        <textarea id='description' name="description" class ='body' rows="5" cols="45"><?php echo $_SESSION['organization']['description']; ?></textarea>
                    </td>
                </tr>
            </table>
            <table class="tbl" width="100%">
                <tr>
                    <td>
                        <table class="tbl" width="100%">
<?PHP
if ($_SESSION['displaydata']["status"]["displaystatus"]) {
    echo '<tr>
                                        <td class ="subtitle">Status:</td>
                                    </tr>
                                    <tr>
                                       <td>';
    $_SESSION["displaydata"] ["name"] = 'status';
    $status->printdata();
    echo '</td>
                                    </tr>';
}
if ($_SESSION['displaydata']["relationship"]["displayrelationship"]) {
    echo '<tr>
                                        <td colspan="2" class ="subtitle">Relationship:</td>
                                    </tr>
                                    <tr>
                                        <td>';
    $_SESSION ["displaydata"] ["name"] = 'relationship';
    $relationship->printdata();
    echo '</td>
                                    </tr>';
}
if ($_SESSION['displaydata']["address"]["displayaddress"]) {
    echo '<tr>
                                        <td class ="subtitle">Address:</td>
                                    </tr>
                                    <tr>
                                        <td>';
    $_SESSION ["displaydata"] ["name"] = 'address';
    $address->printdata();
    echo '</td>
                                   </tr>';
}
if ($_SESSION['displaydata']["notes"]["displaynotes"]) {
    echo '<tr>
                                        <td class ="subtitle">Organization Note:</td>
                                    </tr>
                                    <tr>
                                       <td>';
    $_SESSION["displaydata"] ["name"] = 'notes';
    $notes->printdata();
    echo '</td>
                                    </tr>';
}
?>
                        </table>        
                    </td>
                    <td valign="top">
                        <table class="tbl" width="100%">
                            <?PHP
                            if ($_SESSION['displaydata']["membership"]["displaymembership"]) {
                                echo '<tr>
                                        <td class ="subtitle">Membership:</td>
                                    </tr>
                                    <tr>
                                        <td>';
                                $_SESSION ["displaydata"] ["name"] = 'membership';
                                $membership->printdata();
                                echo '</td>
                                   </tr>';
                            }
                            if ($_SESSION['displaydata']["telephone"]["displaytelephone"]) {
                                echo '<tr>
                                        <td class ="subtitle">Telephone:</td>
                                    </tr>
                                    <tr>
                                       <td>';
                                $_SESSION["displaydata"] ["name"] = 'telephone';
                                $telephone->printdata();
                                echo '</td>
                                    </tr>';
                            }
                            if ($_SESSION['displaydata']["email"]["displayemail"]) {
                                echo '<tr>
                                        <td class ="subtitle">Email:</td>
                                    </tr>
                                    <tr>
                                       <td>';
                                $_SESSION["displaydata"] ["name"] = 'email';
                                $email->printdata();
                                echo '</td>
                                    </tr>';
                            }
                            ?>
                        </table>
                    </td>
                </tr>
            </table>
            <table>         
                <tr>
                    <td>
                        <input type="submit" class ='subtitle' name="organizationsave" value="Save">
                        <input type="submit" class ='subtitle' name="organizationdelete" value="Delete">
                    </td>
                </tr>
            </table>
        </FORM>              
    </BODY>
</HTML>