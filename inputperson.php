<?php session_start(); ?>
<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN">
<HTML>
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1">
        <link href="style.css" rel="stylesheet" type="text/css">
        <script type="text/javascript" src="popup-window.js"></script>
        <script>
            function keyCode(event) {
                var x = event.keyCode;
                if (x == 112) {
                    alert("You pressed the f1 key!");
                }
            }
        </script>
        <TITLE>KWA Input Person</TITLE>
        <?PHP
        require_once "displayrelationship.php";
        require_once "class.preferences.php";
        require_once "displaymembership.php";
        require_once "displaynotes.php";
        require_once "class.person.php";
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
        if (!isset($_POST['personsave']))
            $_POST['personsave'] = '';
        if (!isset($_POST['persondelete']))
            $_POST['persondelete'] = '';
        if (!isset($_POST['refreshperson']))
            $_POST['refreshperson'] = '';
        if (!isset($_POST['refreshname']))
            $_POST['refreshname'] = '';
        if (!isset($_POST['relationshipnotes']))
            $_POST['relationshipnotes'] = '';
        if (!isset($_POST['mobilityaidnotes']))
            $_POST['mobilityaidnotes'] = '';
        if (!isset($_POST['addressnotes']))
            $_POST['addressnotes'] = '';
        if (!isset($_POST['personnotes']))
            $_POST['personnotes'] = '';
        if (!isset($_SESSION['person']['personid'])) {
            $_SESSION['person']['personid'] = 0;
        }
        if (!isset($_SESSION['person']['firstname'])) {
            $_SESSION['person']['firstname'] = ' ';
        }
        if (!isset($_SESSION['person']['lastname'])) {
            $_SESSION['person']['lastname'] = ' ';
        }
        if (!isset($_SESSION['person']['fullname'])) {
            $_SESSION['person']['fullname'] = ' ';
        }
        if (!isset($_SESSION['person']['gender'])) {
            $_SESSION['person']['gender'] = ' ';
        }
        if (!isset($_SESSION['person']['birthdate'])) {
            $_SESSION['person']['birthdate'] = ' ';
        }
        if (!isset($_SESSION['person']['mobilityplusid'])) {
            $_SESSION['person']['mobilityplusid'] = ' ';
        }
        if (!isset($_SESSION['organization']['name'])) {
            $_SESSION['organization']['name'] = ' ';
        }
        if (!isset($_SESSION['displaydata']["relationship"]["displayrelationship"])) {
            $_SESSION['displaydata']["relationship"]["displayrelationship"] = false;
        }
        if (!isset($_SESSION['displaydata']["status"]["displaystatus"])) {
            $_SESSION['displaydata']["status"]["displaystatus"] = false;
        }
        if (!isset($_SESSION['displaydata']["mobilityaid"]["displaymobilityaid"]))
            $_SESSION['displaydata']["mobilityaid"]["displaymobilityaid"] = false;
        if (!isset($_SESSION['displaydata']["membership"]["displaymembership"])) {
            $_SESSION['displaydata']["membership"]["displaymembership"] = false;
        }
        if (!isset($_SESSION['displaydata']["membership"]["click"])) {
            $_SESSION['displaydata']["membership"]["click"] = false;
        }
        if (!isset($_SESSION['displaydata']["mobilityaid"]["click"])) {
            $_SESSION['displaydata']["mobilityaid"]["click"] = false;
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
        if (!isset($_SESSION["displaydata"]['person']["newperson"])) {
            $_SESSION["displaydata"]['person']["newperson"] = false;
        }
        if (!isset($_SESSION["displaydata"]['person']["personnew"])) {
            $_SESSION["displaydata"]['person']["personnew"] = false;
        }
        $validate = new validate;
        $msg = new messages;
        $person = new person;
        $checknotes = new DisplayData($db);
        $checknotes->checknotes();
        if ($_POST['personsave'] === (string) 'Save') {
            $person->updaterecord($_SESSION["person"]['personid'], $_POST['firstname'], $_POST['lastname'], $_POST['gender'], $_POST['birthdate'], $_POST['mobilityplusid']);
            $_SESSION['displaydata'][$_SESSION ["displaydata"] ["name"]]["default"] = 0;
        }
        if ($_POST['persondelete'] == 'Delete') {
            $person->deleterecord($_SESSION["person"]['personid']);
            $_SESSION['displaydata'][$_SESSION ["displaydata"] ["name"]]["default"] = 0;
        }
        if ($_POST['refreshperson'] == 'Refresh') {
            if ($_POST['selectedperson'] == '0') {
                $msg->DisplayMessage('selectperson');
                $_SESSION['displaydata']["relationship"]["displayrelationship"] = false;
                $_SESSION['displaydata']["status"]["displaystatus"] = false;
                $_SESSION['displaydata']["membership"]["displaymembership"] = false;
                $_SESSION['displaydata']["mobilityaid"]["displaymobilityaid"] = false;
                $_SESSION['displaydata']["address"]["displayaddress"] = false;
                $_SESSION['displaydata']["telephone"]["displaytelephone"] = false;
                $_SESSION['displaydata']["email"]["displayemail"] = false;
                $_SESSION['displaydata']["notes"]["displaynotes"] = false;
                $_SESSION["displaydata"]['person']["newperson"] = false;
            }
            if ($_POST['selectedperson'] == -99) {
                $_SESSION['displaydata'][$_SESSION ["displaydata"] ["name"]]["pleaseselect"] = true;
                $_SESSION['displaydata'][$_SESSION ["displaydata"] ["name"]]["newperson"] = true;
                $_SESSION['displaydata']["relationship"]["displayrelationship"] = true;
                $_SESSION['displaydata']["status"]["displaystatus"] = true;
                $_SESSION['displaydata']["membership"]["displaymembership"] = true;
                $_SESSION['displaydata']["mobilityaid"]["displaymobilityaid"] = true;
                $_SESSION['displaydata']["address"]["displayaddress"] = true;
                $_SESSION['displaydata']["telephone"]["displaytelephone"] = true;
                $_SESSION['displaydata']["email"]["displayemail"] = true;
                $_SESSION['displaydata']["notes"]["displaynotes"] = true;
                $_SESSION["displaydata"]['person']["newperson"] = true;
            }
            if ($_POST['selectedperson'] > 0) {
                $_SESSION["person"]['personid'] = $_POST['selectedperson'];
                if (isset($_SESSION ["displaydata"] ["name"])) {
                    $_SESSION['displaydata'][$_SESSION ["displaydata"] ["name"]]["default"] = $_POST['selectedperson'];
                }
                $tblperson = $person->getrecord($_SESSION["person"]['personid']);
                $_SESSION['person']['firstname'] = $tblperson['firstname'];
                $_SESSION['person']['lastname'] = $tblperson['lastname'];
                $_SESSION['person']['fullname'] = $tblperson['fullname'];
                $_SESSION['person']['gender'] = $tblperson['gender'];
                $_SESSION['person']['birthdate'] = $tblperson['birthdate'];
                $_SESSION['person']['mobilityplusid'] = $tblperson['mobilityplusid'];
                $_SESSION['displaydata']["relationship"]["displayrelationship"] = true;
                $_SESSION['displaydata']["status"]["displaystatus"] = true;
                $_SESSION['displaydata']["membership"]["displaymembership"] = true;
                $_SESSION['displaydata']["mobilityaid"]["displaymobilityaid"] = true;
                $_SESSION['displaydata']["address"]["displayaddress"] = true;
                $_SESSION['displaydata']["telephone"]["displaytelephone"] = true;
                $_SESSION['displaydata']["email"]["displayemail"] = true;
                $_SESSION['displaydata']["notes"]["displaynotes"] = true;
                $_SESSION['displaydata'][$_SESSION ["displaydata"]["name"]]["default"] = $_POST['selectedperson'];
            }
        }
        if ($_SESSION["displaydata"]['person']["newperson"]) {
            $_SESSION["displaydata"]['person']["newperson"] = false;
            $_SESSION["person"]['personid'] = $person->insertrecord();
            $_POST[$_SESSION['displaydata']["name"] . 'editline'] = 'E1';
        }
        if ($_SESSION["displaydata"]['person']["personnew"]) {
            $_SESSION["displaydata"]['person']["newperson"] = true;
        }
        if ($_SESSION["displaydata"]["relationship"]["click"]) {
            $_SESSION["displaydata"]["relationship"]["DisplayData"] = true;
        }
        if ($_SESSION["displaydata"]["membership"]["click"]) {
            $_SESSION["displaydata"]["membership"]["DisplayData"] = true;
        }
        if ($_SESSION["displaydata"]["mobilityaid"]["click"]) {
            $_SESSION["displaydata"]["mobilityaid"]["DisplayData"] = true;
        }
        if ($_SESSION["displaydata"]["address"]["click"]) {
            $_SESSION["displaydata"]["address"]["DisplayData"] = true;
        }
// Load the displaydata class  - relationship
        $relationship = new DisplayData($db);
        $relationship->setdisplaydata('relationship');
        $relationship->SetTemplate('displayrelationship', $db);
// Set the query, select all rows from the people table
        $relationship->setQuery("relationshipid,personid,organizationid,relationship", "relationship", "", "personid = " . $_SESSION['person']['personid']);
        $relationship->setPrimaryID('relationshipid');
        $relationship->setConstantFields(array("personid" => $_SESSION["person"]['personid']));
        $relationship->setURLConstant("inputperson.php");
        $relationship->setOrder('personid');

// Hide ID field
        $relationship->hidefield('relationshipid', 'personid');
// Show reset grid control
        $relationship->showReset();

// setting inline edit
        $relationship->SetInLineEdit(true);
// Add standard control
        $relationship->addStandardControl(displaydata::STDCTRL_INLINEEDIT, "inputperson.php", displaydata::TYPE_PHPFUNCTION);
// Add create control
        $relationship->showCreateButton("inputperson.php", displaydata::TYPE_INLINEADDRECORD, 'New');

// Show checkboxes
// Show row numbers
        $relationship->showRowNumber(true);

// Change the amount of results per page
        $relationship->setResultsPerPage(2);

// Change headers text
        $relationship->SetFieldHeader('personid', '' . 'Person Id:');
        $relationship->SetFieldHeader('organizationid', '' . 'Organization Id:');
        $relationship->SetFieldHeader('relationship', '' . 'Relation:');
//  set field type
        $relationship->SetFieldType('personid', displaydata::TYPE_FIELD, array('table' => 'person', 'displayfield' => 'fullname', 'inputfield' => 'personid'));
        $relationship->SetFieldType('organizationid', displaydata::TYPE_FIELD, array('table' => 'organization', 'displayfield' => 'name', 'inputfield' => 'organizationid'));
        $relationship->SetFieldType('relationship', displaydata::TYPE_CODEDISPLAY, array('table' => 'relationship', 'field' => 'relationship', 'class' => 'body'));
        $relationship->SetFieldType('notes', displaydata::TYPE_NOTE, array('name' => 'relationshipnotes', 'class' => 'subtitle', 'text' => 'Display Relationship Notes', 'size' => 15, 'outbaseurl' => 'outputnotes.php', 'inbaseurl' => 'inputnotes', 'returnurl' => "inputperson.php", 'notestype' => 'persrel'));
//  set inlineedit field type
        $relationship->SetInlineFieldType('personid', displaydata::INLINE_COMBOBOX, array('name' => "personid", "table" => "person", "where" => "" . $_SESSION["person"]["personid"], 'order_by' => 'fullname', 'asc' => 'ASC', 'value' => 'personid', 'display' => 'fullname', 'class' => 'body', 'pleaseselect' => false, 'commonelements' => array(), 'default' => "", 'noinput' => false, 'AllowNew' => false, 'newname' => '', 'new' => false, 'size' => '30')); // person
        $relationship->SetInlineFieldType('organizationid', displaydata::INLINE_COMBOBOX, array('name' => "organizationid", "table" => "organization", "where" => "", 'order_by' => 'name', 'asc' => 'ASC', 'value' => 'organizationid', 'display' => 'name', 'class' => 'body', 'pleaseselect' => false, 'commonelements' => array(), 'default' => "", 'noinput' => false, 'AllowNew' => false, 'newname' => '', 'new' => false, 'size' => '30')); // organization
        $relationship->SetInlineFieldType('relationship', displaydata::INLINE_CODECOMBO, array('name' => 'relationship', 'table' => 'relationship', 'field' => 'relationship', 'class' => 'body')); // relationship
        $relationship->SetInlineFieldType('notes', displaydata::INLINE_NOTE, array('name' => 'relationshipnotes', 'class' => 'subtitle', 'text' => 'Add Relationship Note', 'size' => 15, 'outbaseurl' => 'outputnotes.php', 'inbaseurl' => 'inputnote.php', 'rerurnurl' => "inputperson.php", 'notestype' => 'persrel'));

// Stop ordering
        $relationship->hideOrder(false);

// Load the database adapter -status
// Load the displaydata class
        $status = new DisplayData($db);
        $status->setdisplaydata('status');
        $status->SetTemplate('displaystatus', $db);
// Set the query, select all rows from the people table
        $status->setQuery("statusid,status", "status", "", "personid = " . $_SESSION['person']["personid"]);
        $status->setPrimaryID('statusid');
        $status->setConstantFields(array("personid" => $_SESSION["person"]['personid']));
        $status->setURLConstant("inputperson.php");
        $status->setOrder('statusid', 'personid');

// Hide ID field
        $status->hidefield('personid');
// Show reset grid control
        $status->showReset();

// setting inline edit
        $status->SetInLineEdit(true);
// Add standard control
        $status->addStandardControl(displaydata::STDCTRL_INLINEEDIT, "inputperson.php", displaydata::TYPE_PHPFUNCTION);
// Add create control
        $status->showCreateButton("inputperson.php", displaydata::TYPE_INLINEADDRECORD, 'New');

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
        $status->SetInlineFieldType('status', displaydata::INLINE_CODECOMBO, array('name' => 'status', 'table' => 'status', 'where' => 'personid = "' . $_SESSION['person']['personid'], 'field' => 'status', 'class' => 'body')); // status
// Stop ordering
        $status->hideOrder(false);
// Load the displaydata class  - membership
        $membership = new DisplayData($db);
        $membership->setdisplaydata('membership');
        $membership->SetTemplate('displaymembership', $db);
// Set the query, select all rows from the people table
        $membership->setQuery("membershipid,membership,expirydate", "membership", "", "personid = " . $_SESSION['person']['personid']);
        $membership->setPrimaryID('membershipid');
        $membership->setConstantFields(array("personid" => $_SESSION["person"]['personid']));
        $membership->setURLConstant("inputperson.php");
        $membership->setOrder('personid');

// Hide ID field
        $membership->hidefield('membershipid', 'personid');
// Show reset grid control
        $membership->showReset();

// setting inline edit
        $membership->SetInLineEdit(true);
// Add standard control
        $membership->addStandardControl(displaydata::STDCTRL_INLINEEDIT, "inputperson.php", displaydata::TYPE_PHPFUNCTION);
// Add create control
        $membership->showCreateButton("inputperson.php", displaydata::TYPE_INLINEADDRECORD, 'New');

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
// Load the displaydata class  - mobilityaid
        $mobilityaid = new DisplayData($db);
        $mobilityaid->setdisplaydata('mobilityaid');
        $mobilityaid->SetTemplate('displaymobilityaid', $db);
// Set the query, select all rows from the people table
        $mobilityaid->setQuery("mobilityaidid,mobilityaid", "mobilityaid", "", "personid = " . $_SESSION['person']["personid"]);
        $mobilityaid->setPrimaryID('mobilityaidid');
        $mobilityaid->setConstantFields(array("personid" => $_SESSION["person"]['personid']));
        $mobilityaid->setURLConstant("inputperson.php");
        $mobilityaid->setOrder('personid');

// Hide ID field
        $mobilityaid->hidefield('mobilityaidid', 'personid');
// Show reset grid control
        $mobilityaid->showReset();

// setting inline edit
        $mobilityaid->SetInLineEdit(true);
// Add standard control
        $mobilityaid->addStandardControl(displaydata::STDCTRL_INLINEEDIT, "inputperson.php", displaydata::TYPE_PHPFUNCTION);
// Add create control
        $mobilityaid->showCreateButton("inputperson.php", displaydata::TYPE_INLINEADDRECORD, 'New');

// Show checkboxes
// Show row numbers
        $mobilityaid->showRowNumber(true);
// Change the amount of results per page
        $mobilityaid->setResultsPerPage(2);

// Change headers text
        $mobilityaid->SetFieldHeader('mobilityaid', 'MobilityAid:');
//  set field type
        $mobilityaid->SetFieldType('mobilityaid', displaydata::TYPE_CODEDISPLAY, array('table' => 'mobilityaid', 'field' => 'mobilityaid', 'class' => 'body'));
        $mobilityaid->SetFieldType('notes', displaydata::TYPE_NOTE, array('name' => 'mobilityaidnotes', 'class' => 'subtitle', 'text' => 'Display Mobility Aid Note', 'size' => 15, 'outbaseurl' => 'outputnotes.php', 'inbaseurl' => 'inputnotes.php', 'notestype' => 'persmob'));
//  set inlineedit field type
        $mobilityaid->SetInlineFieldType('mobilityaid', displaydata::INLINE_CODECOMBO, array('name' => 'mobilityaid', 'table' => 'mobilityaid', 'field' => 'mobilityaid', 'class' => 'body')); // mobilityaid
        $mobilityaid->SetInlineFieldType('notes', displaydata::INLINE_NOTE, array('name' => 'mobilityaidnotes', 'class' => 'subtitle', 'text' => 'Add Mobility Aid Note', 'size' => 15, 'outbaseurl' => 'outputnotes.php', 'inbaseurl' => 'inputnotes.php', 'notestype' => 'persmob'));

// Stop ordering
        $mobilityaid->hideOrder(false);
// Load the displaydata class  - address
        $address = new DisplayData($db);
        $address->setdisplaydata('address');
        $address->SetTemplate('displayaddress', $db);
// Set the query, select all rows from the people table
        $address->setQuery("addressid,type,address1,address2,city,prov,postalcode", "address", "", "personid =" . $_SESSION['person']["personid"]);
        $address->setPrimaryID('addressid');
        $address->setConstantFields(array("personid" => $_SESSION["person"]['personid']));
        $address->setURLConstant("inputperson.php");
        $address->setOrder('personid');

// Hide ID field
        $address->hidefield('addressid', 'personid');
// Show reset grid control
        $address->showReset();

// setting inline edit
        $address->SetInLineEdit(true);
// Add standard control
        $address->addStandardControl(displaydata::STDCTRL_INLINEEDIT, "inputperson.php", displaydata::TYPE_PHPFUNCTION);
// Add create control
        $address->showCreateButton("inputperson.php", displaydata::TYPE_INLINEADDRECORD, 'New');

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
        $address->SetFieldType('notes', displaydata::TYPE_NOTE, array('name' => 'addressnotes', 'class' => 'subtitle', 'text' => 'Display Address Note', 'size' => 15, 'outbaseurl' => 'outputnotes.php', 'inbaseurl' => 'inputnotes.php', 'notestype' => 'persaddr'));
//  set inlineedit field type
        $address->SetInlineFieldType('type', displaydata::INLINE_CODECOMBO, array('name' => 'type', 'table' => 'address', 'field' => 'type', 'class' => 'body')); // address type
        $address->SetInlineFieldType('address1', displaydata::INLINE_TEXT, array('name' => 'address1', 'size' => 30, 'class' => 'body')); // address1
        $address->SetInlineFieldType('address2', displaydata::INLINE_TEXT, array('name' => 'address2', 'size' => 30, 'class' => 'body')); // address2
        $address->SetInlineFieldType('city', displaydata::INLINE_TEXT, array('name' => 'city', 'size' => 15, 'class' => 'body')); // city
        $address->SetInlineFieldType('prov', displaydata::INLINE_TEXT, array('name' => 'prov', 'size' => 8, 'class' => 'body')); // provence
        $address->SetInlineFieldType('postalcode', displaydata::INLINE_POSTALCODE, array('name' => 'postalcode', 'size' => 7, 'class' => 'body')); // postalcode
        $address->SetInlineFieldType('notes', displaydata::INLINE_NOTE, array('name' => 'addressnotes', 'class' => 'subtitle', 'text' => 'Add Address Note', 'size' => 15, 'outbaseurl' => 'outputnotes.php', 'inbaseurl' => 'inputnotes.php', 'returnurl' => 'inputperson.php', 'notestype' => 'persaddr'));

// Stop ordering
        $address->hideOrder(false);
// Load the displaydata class  - telephone
        $telephone = new DisplayData($db);
        $telephone->setdisplaydata('telephone');
        $telephone->SetTemplate('displaytelephone', $db);
// Set the query, select all rows from the people table
        $telephone->setQuery("telephoneid,telephonetype,telephonenumber", "telephone", "", "personid = " . $_SESSION['person']["personid"]);
        $telephone->setPrimaryID('telephoneid');
        $telephone->setConstantFields(array("personid" => $_SESSION["person"]['personid']));
        $telephone->setURLConstant("inputperson.php");
        $telephone->setOrder('personid');

// Hide ID field
        $telephone->hidefield('telephoneid', 'personid');
// Show reset grid control
        $telephone->showReset();

// setting inline edit
        $telephone->SetInLineEdit(true);
// Add standard control
        $telephone->addStandardControl(displaydata::STDCTRL_INLINEEDIT, "inputperson.php", displaydata::TYPE_PHPFUNCTION);
// Add create control
        $telephone->showCreateButton("inputperson.php", displaydata::TYPE_INLINEADDRECORD, 'New');

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
        $telephone->SetFieldType('t0elephonenumber', displaydata::TYPE_TELEPHONE, array('table' => 'telephone', 'field' => 'telephonenumber', 'size' => 10, 'class' => 'body'));
        $telephone->SetFieldType('notes', displaydata::TYPE_NOTE, array('name' => 'telephonenotes', 'class' => 'subtitle', 'text' => 'Display Telephone Note', 'size' => 15, 'outbaseurl' => 'outputnotes.php', 'inbaseurl' => 'inputnotes.php', 'returnurl' => 'inputperson', 'notestype' => 'perstel'));
//  set inlineedit field type
        $telephone->SetInlineFieldType('telephonetype', displaydata::INLINE_CODECOMBO, array('name' => 'telephonetype', 'table' => 'telephone', 'field' => 'telephonetype', 'class' => 'body')); // telephonetype
        $telephone->SetInlineFieldType('telephonenumber', displaydata::INLINE_TELEPHONE, array('name' => 'telephonenumber', 'table' => 'telephone', 'field' => 'telephonenumber', 'class' => 'body', 'size' => 10)); // telephonenumber
        $telephone->SetInlineFieldType('notes', displaydata::INLINE_NOTE, array('name' => 'telephonenotes', 'class' => 'subtitle', 'text' => 'Add Telephone Note', 'size' => 15, 'outbaseurl' => 'outputnotes.php', 'inbaseurl' => 'inputnotes.php', 'returnurl' => 'inputperson.php', 'notestype' => 'perstel'));

// Stop ordering
        $telephone->hideOrder(false);
// Load the displaydata class  - email
        $email = new DisplayData($db);
        $email->setdisplaydata('email');
        $email->SetTemplate('displayemail', $db);
// Set the query, select all rows from the people table
        $email->setQuery("emailid,emailtype,email", "email", "", "personid = " . $_SESSION['person']["personid"]);
        $email->setPrimaryID('emailid');
        $email->setConstantFields(array("personid" => $_SESSION["person"]['personid']));
        $email->setURLConstant("inputperson.php");
        $email->setOrder('personid');

// Hide ID field
        $email->hidefield('emailid', 'personid');
// Show reset grid control
        $email->showReset();

// setting inline edit
        $email->SetInLineEdit(true);
// Add standard control
        $email->addStandardControl(displaydata::STDCTRL_INLINEEDIT, "inputperson.php", displaydata::TYPE_PHPFUNCTION);
// Add create control
        $email->showCreateButton("inputperson.php", displaydata::TYPE_INLINEADDRECORD, 'New');

// Show checkboxes
// Show row numbers
        $email->showRowNumber(true);
// Change the amount of results per page
        $email->setResultsPerPage(2);

// Change headers text
        $email->SetFieldHeader('emailtype', 'Email Type:');
//  set field type
        $email->SetFieldType('emailtype', displaydata::TYPE_CODEDISPLAY, array('table' => 'email', 'field' => 'emailtype', 'class' => 'body'));
        $email->SetFieldType('email', displaydata::TYPE_EMAIL, array('table' => 'email', 'field' => 'email', 'class' => 'body', 'size' => 20));
        $email->SetFieldType('notes', displaydata::TYPE_NOTE, array('name' => 'emailnotes', 'class' => 'subtitle', 'text' => 'Display Email Note', 'size' => 15, 'outbaseurl' => 'outputnotes.php', 'inbaseurl' => 'inputnotes.php', 'returnurl' => 'inputperson.php', 'notestype' => 'persemail'));
//  set inlineedit field type
        $email->SetInlineFieldType('emailtype', displaydata::INLINE_CODECOMBO, array('name' => 'emailtype', 'table' => 'email', 'field' => 'emailtype', 'class' => 'body')); // email type
        $email->SetInlineFieldType('email', displaydata::INLINE_EMAIL, array('name' => 'email', 'table' => 'email', 'field' => 'email', 'class' => 'body', 'size' => 20)); // email 
        $email->SetInlineFieldType('notes', displaydata::INLINE_NOTE, array('name' => 'emailnotes', 'class' => 'subtitle', 'text' => 'Add Email Note', 'size' => 15, 'outbaseurl' => 'outputnotes.php', 'inbaseurl' => 'inputnotes.php', 'returnurl' => 'inputperson.php', 'notedtype' => 'persemail'));

// Stop ordering
        $email->hideOrder(false);
// Load the displaydata class  - note
        $notes = new DisplayData($db);
        $notes->setdisplaydata('notes');
        $notes->SetTemplate('Displaynotes', $db);
// Set the query, select all rows from the people table
        $notes->setQuery("notesid,notes", "notes", "", "");
        $notes->setPrimaryID('notesid');
        $notes->setConstantFields(array("personid" => $_SESSION["person"]['personid']));
        $notes->setURLConstant("inputperson.php");
        $notes->setOrder('notesid');

// Hide ID field
        $notes->hidefield('notesid', 'personid');
// Show reset grid control
        $notes->showReset();

// setting inline edit
        $notes->SetInLineEdit(true);
// Add standard control
        $notes->addStandardControl(displaydata::STDCTRL_INLINEEDIT, "inputperson.php", displaydata::TYPE_PHPFUNCTION);
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
        if (!isset($_SESSION['displaydata'][$_SESSION ["displaydata"] ["name"]]["personnew"]))
            $_SESSION['displaydata'][$_SESSION ["displaydata"] ["name"]]["personnew"] = false;
        if (!isset($_SESSION['displaydata'][$_SESSION ["displaydata"] ["name"]]["pleaseselect"]))
            $_SESSION['displaydata'][$_SESSION ["displaydata"] ["name"]]["pleaseselect"] = true;
        if (!isset($_SESSION['displaydata'][$_SESSION ["displaydata"] ["name"]]["default"]))
            $_SESSION['displaydata'][$_SESSION ["displaydata"] ["name"]]["default"] = 0;
        if (!isset($_SESSION['displaydata'][$_SESSION ["displaydata"] ["name"]]["personnew"]))
            $_SESSION['displaydata'][$_SESSION ["displaydata"] ["name"]]["personnew"] = false;
        if (!isset($_SESSION['displaydata'][$_SESSION ["displaydata"] ["name"]]["pleaseselect"]))
            $_SESSION['displaydata'][$_SESSION ["displaydata"] ["name"]]["pleaseselect"] = true;
        ?>
    </head>
    <body>
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
                <td class='subtitle'> Select Person
                    <form id="selectperson" name="selectperson"  action="inputperson.php" method="post" enctype="multipart/form-data" >
                    <?php
                    echo $validate->ComboBox("selectedperson", "person", '', '', "ASC", "personid", "fullname", "body", $_SESSION['displaydata'][$_SESSION ["displaydata"] ["name"]]["pleaseselect"], array('New Person' => -99), $_SESSION['displaydata'][$_SESSION ["displaydata"] ["name"]]["default"], false, false, "newperson", $_SESSION['displaydata'][$_SESSION ["displaydata"] ["name"]]["personnew"], "20", $_SESSION["preferences"]["database"]["dbname"]);
                    ?>
                        <input type="submit" class='subtitle' name="refreshperson" value="Refresh">
                    </form>
                </td>
            </tr>
        </table> 
        <form id="enterperson" name="enterperson"  action="inputperson.php" method="post" enctype="multipart/form-data" >
            <table class="tbl" width="100%">
                <tr>
                    <td class ='subtitle'>First Name&nbsp:
<?PHP
echo'<input name="firstname" class="body" type="text" size=25 value="' . $_SESSION["person"]["firstname"] . '">';
?>        
                    </td>
                    <td class="subtitle">Gender&nbsp:
<?PHP
echo $validate->CodeCombo("gender", "person", "gender", "body", $_SESSION["person"]["gender"]);
?>
                    </td>
                </tr>
                <tr>
                    <td class ='subtitle'>Last Name&nbsp:
                        <?PHP
                        echo '<input name="lastname" class ="body" type="text" size = 25 value="' . $_SESSION["person"]["lastname"] . '">';
                        ?>   
                    </td>
                    <td>
<?PHP
echo $validate->DateCombo("birthdate", "body", "subtitle", "Birthdate : ", DATE($_SESSION["preferences"]["dateformat"], strtotime($_SESSION["person"]["birthdate"])));
?>
                    </td>
                </tr>
                <tr>
                    <td class ='subtitle'>Full Name&nbsp;:
                        <?PHP
                        echo '<input name="fullname" class ="body" type="text" size=30 value="' . $_SESSION["person"]["fullname"] . '">';
                        ?>   
                    </td>
                    <td class ='subtitle'>Mobility Plus Id.&nbsp;:
<?PHP
echo '<input name="mobilityplusid" class="body" type="text" size=7 value="' . $_SESSION["person"]["mobilityplusid"] . '">';
?>    
                    </td>
                </tr>
            </table>
          </form>  
            <table class="tbl" width="100%">
                <tr>
                    <td valign="top">
                        <table class="tbl" width="100%">
                            <tr>
                                <td class ="subtitle">Status:</td>
                            </tr>
                             <tr>
                                 <td>
                                   <?PHP
                                        if ($_SESSION['displaydata']["status"]["displaystatus"]) 
                                        {
                                             $_SESSION["displaydata"] ["name"] = 'status';
                                            $status->printdata();
                                      }
                                   ?>
                                 </td>    
                            </tr>
                            <tr>
                                  <td class ="subtitle">Relationship:</td>
                            </tr>
                            <tr>
                                  <td>
                                      <?PHP
                                            if ($_SESSION['displaydata']["relationship"]["displayrelationship"]) 
                                            {
                                                $_SESSION ["displaydata"] ["name"] = 'relationship';
                                                $relationship->printdata();
                                             }
                                      ?>
                                  </td>
                            </tr>     
                            <tr>
                                  <td class ="subtitle">Address:</td>
                            </tr>
                             <tr>
                                   <td>
                                       <?PHP
                                            if ($_SESSION['displaydata']["address"]["displayaddress"]) 
                                            {
                                                $_SESSION ["displaydata"] ["name"] = 'address';
                                                $address->printdata();
                                            }
                                        ?>
                                   </td>
                             </tr>   
                             <tr>
                                   <td class ="subtitle">Person Note:</td>
                             </tr>
                             <tr>
                                   <td>
                                       <?PHP
                                            if ($_SESSION['displaydata']["notes"]["displaynotes"]) 
                                            {
                                                $_SESSION["displaydata"] ["name"] = 'notes';
                                                $notes->printdata();
                                            }
                                        ?>
                                   </td>
                             </tr>    
                        </table>
                    </td>
                    <td valign="top">
                        <table class="tbl" width="100%">
                            <tr>
                                    <td class ="subtitle">Membership:</td>
                            </tr>
                            <tr>
                                   <td>
                                        <?PHP
                                            if ($_SESSION['displaydata']["membership"]["displaymembership"]) 
                                            {
                                                $_SESSION ["displaydata"] ["name"] = 'membership';
                                                $membership->printdata();
                                            }
                                       ?>
                                   </td>
                            </tr>       
                            <tr>
                                    <td class="subtitle">Mobility Aid:</td>
                            </tr>
                            <tr>
                                   <td>
                                       <?PHP
                                            if ($_SESSION['displaydata']["mobilityaid"]["displaymobilityaid"]) 
                                            {
                                                $_SESSION["displaydata"] ["name"] = 'mobilityaid';
                                                $mobilityaid->printdata();
                                            }
                                       ?>
                                   </td>
                            </tr>       
                            <tr>
                                   <td class ="subtitle">Telephone:</td>
                            </tr>
                            <tr>
                                   <td>
                                       <?PHP
                                            if ($_SESSION['displaydata']["telephone"]["displaytelephone"]) 
                                            {
                                                $_SESSION["displaydata"] ["name"] = 'telephone';
                                                $telephone->printdata();
                                            }
                                       ?>
                                   </td>
                            </tr>       
                            <tr>
                                  <td class ="subtitle">Email:</td>
                            </tr>
                             <tr>
                                  <td>
                                        <?PHP
                                             if ($_SESSION['displaydata']["email"]["displayemail"]) 
                                             {
                                                $_SESSION["displaydata"] ["name"] = 'email';
                                                $email->printdata();
                                            }
                                        ?>
                                  </td>
                             <tr>      
                        </table>
                    </td>
            </table>
        <form id="enterpersonsave" name="enterperson"  action="inputperson.php" method="post" enctype="multipart/form-data" >
            <table class="tbl" width="100%">
                <tr>            
                    <td>
                        <input type="submit" class ='subtitle' name="personsave" value="Save">
                        <input type="submit" class ='subtitle' name="persondelete" value="Delete">
                    </td>
                </tr>
            </table>
        </form>            
    </body>
</HTML>