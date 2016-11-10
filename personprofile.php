<?php session_start(); ?>
<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN">
<HTML>
<HEAD>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1">
<link href="style.css" rel="stylesheet" type="text/css">
<script type="text/javascript" src="popup-window.js"></script>
<TITLE>KWA Person Profile</TITLE>
<?PHP
require_once "displayrelationship.php";
require_once "class.preferences.php";
require_once "displaymembership.php";
require_once "displaynotes.php";
require_once "class.person.php";
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
if (!isset($_POST['personprint']))
    $_POST['personprint'] = '';
if (!isset($_POST['selectperson']))
    $_POST['selectperson'] ='';
if (!isset($_POST['refreshname']))
    $_POST['refreshname'] ='';
if (!isset($_POST['relationshipnotes']))
    $_POST['relationshipnotes'] ='';
if (!isset($_POST['mobilityaidnotes']))
    $_POST['mobilityaidnotes'] ='';
if (!isset($_POST['addressnotes']))
    $_POST['addressnotes'] ='';
if (!isset($_POST['personnotes']))
    $_POST['personnotes'] ='';
if (!isset($_SESSION['person']['personid']))
       $_SESSION['person']['personid'] =0;
if (!isset($_SESSION['person']['firstname']))
       $_SESSION['person']['firstname'] = ' ';
 if (!isset($_SESSION['person']['lastname']))
       $_SESSION['person']['lastname'] = ' ';
if (!isset($_SESSION['person']['fullname']))
       $_SESSION['person']['fullname'] = ' ';
if (!isset($_SESSION['person']['gender']))
       $_SESSION['person']['gender'] = ' ';
if (!isset($_SESSION['person']['birthdate']))
       $_SESSION['person']['birthdate'] = ' ';
if (!isset($_SESSION['person']['mobilityplusid']))
       $_SESSION['person']['mobilityplusid'] = ' ';
if (!isset($_SESSION['displaydata']["relationship"]["displayrelationship"]))
{
       $_SESSION['displaydata']["relationship"]["displayrelationship"] = false;
}
if (!isset($_SESSION['displaydata']["status"]["displaystatus"]))
{
       $_SESSION['displaydata']["status"]["displaystatus"] = false;
}    
if (!isset($_SESSION['displaydata']["mobilityaid"]["displaymobilityaid"]))

       $_SESSION['displaydata']["mobilityaid"]["displaymobilityaid"] = false;
if (!isset($_SESSION['displaydata']["membership"]["displaymembership"]))
{
       $_SESSION['displaydata']["membership"]["displaymembership"] = false;
}
if (!isset($_SESSION['displaydata']["membership"]["click"]))
{
       $_SESSION['displaydata']["membership"]["click"] = false;
}
if (!isset($_SESSION['displaydata']["mobilityaid"]["click"]))
{
       $_SESSION['displaydata']["mobilityaid"]["click"] = false;
}
if (!isset($_SESSION['displaydata']["relationship"]["click"]))
{
       $_SESSION['displaydata']["relationship"]["click"] = false;
}
if (!isset($_SESSION['displaydata']["address"]["displayaddress"]))
{
       $_SESSION['displaydata']["address"]["displayaddress"] = false;
}
if (!isset($_SESSION['displaydata']["address"]["click"]))
{
       $_SESSION['displaydata']["address"]["click"] = false;
}
if (!isset($_SESSION['displaydata']["telephone"]["displaytelephone"]))
{
       $_SESSION['displaydata']["telephone"]["displaytelephone"] = false;
}
if (!isset($_SESSION['displaydata']["telephone"]["click"]))
{
       $_SESSION['displaydata']["telephone"]["click"] = false;
}
if (!isset($_SESSION['displaydata']["email"]["displayemail"]))
{
       $_SESSION['displaydata']["email"]["displayemail"] = false;
}
if (!isset($_SESSION['displaydata']["email"]["click"]))
{
       $_SESSION['displaydata']["email"]["click"] = false;
}
if (!isset($_SESSION['displaydata']["notes"]["displaynotes"]))
{
       $_SESSION['displaydata']["notes"]["displaynotes"] = false;
}
if (!isset($_SESSION['displaydata']["notes"]["click"]))
{
       $_SESSION['displaydata']["notes"]["click"] = false;
}
   
$validate = new validate;
$person = new person;
if ($_POST['personprint'] == 'Print')
{
        $validate->do_redirect('prtpersonprofile.php/');
}
if ($_POST['selectperson']=='Select')
{
    if ($_POST['selectedperson'] == -99)
    {
       $_SESSION['displaydata'][$_SESSION ["displaydata"] ["name"]]["pleaseselect"] = false;
       $_SESSION['displaydata'][$_SESSION ["displaydata"] ["name"]]["personnew"] = true;
       $_SESSION['displaydata']["relationship"]["displayrelationship"] = true;
       $_SESSION['displaydata']["status"]["displaystatus"] = true;
       $_SESSION['displaydata']["membership"]["displaymembership"] = true;
       $_SESSION['displaydata']["mobilityaid"]["displaymobilityaid"] = true;
       $_SESSION['displaydata']["address"]["displayaddress"] = true;
       $_SESSION['displaydata']["telephone"]["displaytelephone"] = true;
       $_SESSION['displaydata']["email"]["displayemail"] = true;
       $_SESSION['displaydata']["notes"]["displaynotes"] = true;
    }
    if (strlen($_POST['selectedperson']) > 0)
    {
       $_SESSION["person"]['personid'] = $_POST['selectedperson'];
       if (isset($_SESSION ["displaydata"] ["name"]))
       {
            $_SESSION['displaydata'][$_SESSION ["displaydata"] ["name"]]["default"] = $_SESSION["person"]['personid'];
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
  }
}
if ($_POST['refreshname']=='Refresh')
{
    if ($_POST["selectperson"] == -99)
    {
        $_SESSION["person"]['personid'] = $person->insertrecord();
    }else{
	$_SESSION["person"]['personid'] = $_POST["selectperson"];
    }
    $tblperson = $person->getrecord($_SESSION["person"]['personid']);
    $_SESSION['person']['firstname'] = $tblperson['firstname'];
    $_SESSION['person']['lastname'] = $tblperson['lastname'];
    $_SESSION['person']['fullname'] = $tblperson['fullname'];
    $_SESSION['person']['gender'] = $tblperson['gender'];
    $_SESSION['person']['birthdate'] = $tblperson['birthdate'];    
    $_SESSION['person']['mobilityplusid'] = $tblperson['mobilityplusid'];
}
   if ($_SESSION["displaydata"]["relationship"]["click"])
{
        $_SESSION["displaydata"]["relationship"]["DisplayData"] = true;
}
if ($_SESSION["displaydata"]["membership"]["click"])
{
        $_SESSION["displaydata"]["membership"]["DisplayData"] = true;
}
if ($_SESSION["displaydata"]["mobilityaid"]["click"])
{
        $_SESSION["displaydata"]["mobilityaid"]["DisplayData"] = true;
}
if ($_SESSION["displaydata"]["address"]["click"])
{
        $_SESSION["displaydata"]["address"]["DisplayData"] = true;
}
// Load the displaydata class  - relationship
$relationship = new DisplayData($db);
$relationship->setdisplaydata('relationship');
$relationship->SetTemplate('displayrelationship',$db);
// Set the query, select all rows from the people table
 $relationship->setQuery("personid,organizationid,relationship", "relationship","","personid = '".$_SESSION['person']["personid"]."'");
 $relationship->setinsertvalue(array("relationship"=>"New"));
$relationship->setPrimaryID('relationshipid') ;
$relationship->setConstantFields(array("personid"=>"'".$_SESSION["person"]['personid']."'"));
$relationship->setURLConstant("personprofile.php");
$relationship->setOrder('personid');

// Hide ID field
 $relationship->hidefield('personid');
// Show reset grid control
$relationship->showReset();

// setting inline edit
$relationship-> SetInLineEdit(false);
// Add standard control
 $relationship->addStandardControl(displaydata::STDCTRL_INLINEEDIT,"personprofile.php",displaydata::TYPE_PHPFUNCTION);
// Add create control
$relationship->showCreateButton("personprofile.php",displaydata::TYPE_INLINEADDRECORD, 'New');

// Show checkboxes

// Show row numbers
$relationship->showRowNumber(true);

// Change the amount of results per page
$relationship->setResultsPerPage(2);

// Change headers text
$relationship->SetFieldHeader('personid', ''. 'Person Id:');
$relationship->SetFieldHeader('organizationid', ''. 'Organization Id:');
$relationship->SetFieldHeader('relationship', ''. 'Relation:');
//  set field type
$relationship->SetFieldType('personid', displaydata::TYPE_FIELD,array('table'=>'person','displayfield'=>'fullname','inputfield' => 'personid'));
$relationship->SetFieldType('organizationid', displaydata::TYPE_FIELD,array('table'=>'organization','displayfield'=>'name','inputfield' => 'organizationid'));
$relationship->SetFieldType('relationship', displaydata::TYPE_CODEDISPLAY,array('table'=>'relationship','field'=>'relationship','class' => 'body'));
$relationship->SetFieldType('notes', displaydata::TYPE_NOTE,array('name'=>'relationshipnote','class' => 'subtitle','text'=>'Display Relationship Note','size'=>15,'baseurl'=>'outputnote.php','notestype'=>'persrel'));
//  set inlineedit field type
$relationship->SetInlineFieldType('personid', displaydata::INLINE_COMBOBOX,array('name' => "personid", "table" => "person","where"=>"".$_SESSION["person"]["personid"],'order_by' => 'fullname','asc'=>'ASC','value' => 'personid', 'display' => 'fullname', 'class' => 'body','pleaseselect' =>false, 'commonelements'=> array(),'default'=> "",'noinput'=> false,'AllowNew'=> false,'newname'=>'', 'new'=> false,'size' =>'30')); // person
$relationship->SetInlineFieldType('organizationid', displaydata::INLINE_COMBOBOX,array('name' => "organizationid", "table" => "organization","where"=> "",'order_by' => 'name','asc'=>'ASC','value' => 'organizationid', 'display' => 'name', 'class' => 'body','pleaseselect' =>false, 'commonelements'=> array(),'default'=> "",'noinput'=> false,'AllowNew'=> false,'newname'=>'', 'new'=> false,'size' =>'30')); // organization
$relationship->SetInlineFieldType('relationship', displaydata::INLINE_CODECOMBO, array('name' => 'relationship','table'=>'relationship','field'=>'relationship','class' => 'body')); // relation
$relationship->SetInlineFieldType('notes', displaydata::INLINE_NOTE,array('name'=>'relationshipnote','class' => 'subtitle','text'=>'Add Relationship Note','size'=>15,'baseurl'=>'inputnote.php','notestype'=>'persrel'));

// Stop ordering
$relationship->hideOrder(false);

// Load the database adapter -status
// Load the displaydata class
$status = new DisplayData($db);
$status->setdisplaydata('status');
$status->SetTemplate('displaystatus',$db);
// Set the query, select all rows from the people table
 $status->setQuery("status", "status","","personid = '".$_SESSION['person']["personid"]."'");
 $status->setinsertvalue(array("status"=>"New Status"));
$status->setPrimaryID('statusid') ;
$status->setConstantFields(array("personid"=>"'".$_SESSION["person"]['personid']."'"));
$status->setURLConstant("personprofile.php");
$status->setOrder('personid');

// Hide ID field
 $status->hidefield('personid');
// Show reset grid control
$status->showReset();

// setting inline edit
$status-> SetInLineEdit(false);
// Add standard control
 $status->addStandardControl(displaydata::STDCTRL_INLINEEDIT,"personprofile.php",displaydata::TYPE_PHPFUNCTION);
// Add create control
 $status->showCreateButton("personprofile.php",displaydata::TYPE_INLINEADDRECORD, 'New');

// Show checkboxes

// Show row numbers
$status->showRowNumber(true);
// Change the amount of results per page
$status->setResultsPerPage(2);

// Change headers text
$status->SetFieldHeader('status', 'Status:');
//  set field type
 $status->SetFieldType('status', displaydata::TYPE_CODEDISPLAY,array('table'=>'status','field'=>'status','class' => 'body'));
//  set inlineedit field type
$status->SetInlineFieldType('status', displaydata::INLINE_CODECOMBO, array('name' => 'status','table'=>'status','where'=>'personid = "'. $_SESSION['person']['personid']."'",'field'=>'status','class' => 'body')); // status

// Stop ordering
$status->hideOrder(false);
// Load the displaydata class  - membership
$membership = new DisplayData($db);
$membership->setdisplaydata('membership');
$membership->SetTemplate('displaymembership',$db);
// Set the query, select all rows from the people table
$membership->setQuery("membership,expirydate", "membership","","personid = '".$_SESSION['person']["personid"]."'");
$membership->setinsertvalue(array("membership"=>"New Membership","expirydate"=>DATE($_SESSION['preferences']['dateformat'])));
$membership->setPrimaryID('membershipid') ;
$membership->setConstantFields(array("personid"=>"'".$_SESSION["person"]['personid']."'"));
$membership->setURLConstant("personprofile.php");
$membership->setOrder('personid');

// Hide ID field
 $membership->hidefield('personid');
// Show reset grid control
$membership->showReset();

// setting inline edit
$membership-> SetInLineEdit(false);
// Add standard control
 $membership->addStandardControl(displaydata::STDCTRL_INLINEEDIT,"personprofile.php",displaydata::TYPE_PHPFUNCTION);
// Add create control
$membership->showCreateButton("personprofile.php",displaydata::TYPE_INLINEADDRECORD, 'New');

// Show checkboxes

// Show row numbers
$membership->showRowNumber(true);

// Change the amount of results per page
$membership->setResultsPerPage(2);

// Change headers text
$membership->SetFieldHeader('membership', ''. 'Membership Type:');
$membership->SetFieldHeader('expirydate', ''. 'Expiry Date:');
//  set field type
$membership->SetFieldType('membership', displaydata::TYPE_CODEDISPLAY,array('table'=>'membership','field'=>'membership','class' => 'body'));
$membership->SetFieldType('expirydate', displaydata::TYPE_DATE,array('format' => $_SESSION['preferences']['dateformat'],'value'=>'expirydate','class' => 'body'));
//  set inlineedit field type
$membership->SetInlineFieldType('membership', displaydata::INLINE_CODECOMBO, array('name' => 'membership','table'=>'membership','field'=>'membership','class' => 'body')); // membership
$membership->SetInlineFieldType('expirydate', displaydata::INLINE_DATECOMBO, array('name' => 'expirydate','classtext'=>'body','classctl'=>'subtitle','text'=>'','defaultdate'=>'expirydate')); // expirydate

// Stop ordering
$membership->hideOrder(false);
// Load the displaydata class  - mobilityaid
$mobilityaid = new DisplayData($db);
$mobilityaid->setdisplaydata('mobilityaid');
$mobilityaid->SetTemplate('displaymobilityaid',$db);
// Set the query, select all rows from the people table
$mobilityaid->setQuery("mobilityaid", "mobilityaid","","personid = '".$_SESSION['person']["personid"]."'");
$mobilityaid->setinsertvalue(array("mobilityaid"=>"New mobilityaid"));
$mobilityaid->setPrimaryID('mobilityaidid') ;
$mobilityaid->setConstantFields(array("personid"=>"'".$_SESSION["person"]['personid']."'"));
$mobilityaid->setURLConstant("personprofile.php");
$mobilityaid->setOrder('personid');

// Hide ID field
 $mobilityaid->hidefield('personid');
// Show reset grid control
$mobilityaid->showReset();

// setting inline edit
$mobilityaid-> SetInLineEdit(false);
// Add standard control
 $mobilityaid->addStandardControl(displaydata::STDCTRL_INLINEEDIT,"personprofile.php",displaydata::TYPE_PHPFUNCTION);
// Add create control
 $mobilityaid->showCreateButton("personprofile.php",displaydata::TYPE_INLINEADDRECORD, 'New');

// Show checkboxes

// Show row numbers
$mobilityaid->showRowNumber(true);
// Change the amount of results per page
$mobilityaid->setResultsPerPage(2);

// Change headers text
$mobilityaid->SetFieldHeader('mobilityaid', 'MobilityAid:');
//  set field type
$mobilityaid->SetFieldType('mobilityaid', displaydata::TYPE_CODEDISPLAY,array('table'=>'mobilityaid','field'=>'mobilityaid','class' => 'body'));
$mobilityaid->SetFieldType('notes', displaydata::TYPE_NOTE,array('name'=>'mobilityaidnote','class' => 'subtitle','text'=>'Display Mobility Aid Note','size'=>15,'baseurl'=>'outputnote.php','notestype'=>'persmob'));
//  set inlineedit field type
$mobilityaid->SetInlineFieldType('mobilityaid', displaydata::INLINE_CODECOMBO, array('name' => 'mobilityaid','table'=>'mobilityaid','field'=>'mobilityaid','class' => 'body')); // mobilityaid
$mobilityaid->SetInlineFieldType('notes', displaydata::INLINE_NOTE,array('name'=>'mobilityaidnote','class' => 'subtitle','text'=>'Add Mobility Aid Note','size'=>15,'baseurl'=>'inputnote.php','notestype'=>'persmob'));

// Stop ordering
$mobilityaid->hideOrder(false);
// Load the displaydata class  - address
$address = new DisplayData($db);
$address->setdisplaydata('address');
$address->SetTemplate('displayaddress',$db);
// Set the query, select all rows from the people table
$address->setQuery("type,address1,address2,city,prov,postalcode", "address","","personid = '".$_SESSION['person']["personid"]."'");
$address->setinsertvalue(array("address1"=>"New Address"));
$address->setPrimaryID('addressid') ;
$address->setConstantFields(array("personid"=>"'".$_SESSION["person"]['personid']."'"));
$address->setURLConstant("personprofile.php");
$address->setOrder('personid');

// Hide ID field
 $address->hidefield('personid');
// Show reset grid control
$address->showReset();

// setting inline edit
$address-> SetInLineEdit(false);
// Add standard control
 $address->addStandardControl(displaydata::STDCTRL_INLINEEDIT,"personprofile.php",displaydata::TYPE_PHPFUNCTION);
// Add create control
$address->showCreateButton("personprofile.php",displaydata::TYPE_INLINEADDRECORD, 'New');

// Show checkboxes

// Show row numbers
$address->showRowNumber(true);

// Change the amount of results per page
$address->setResultsPerPage(2);

// Change headers text
$address->SetFieldHeader('type', ''. 'Type:');
$address->SetFieldHeader('address1', ''. 'Address 1:');
$address->SetFieldHeader('address2', ''. 'Address 2:');
$address->SetFieldHeader('city', ''. 'City:');
$address->SetFieldHeader('prov', ''. 'Province:');
$address->SetFieldHeader('postalcode', ''. 'Postal Code:');
//  set field type
$address->SetFieldType('type', displaydata::TYPE_CODEDISPLAY,array('table'=>'address','field'=>'type','class' => 'body'));
$address->SetFieldType('address1', displaydata::TYPE_TEXT);
$address->SetFieldType('address2', displaydata::TYPE_TEXT);
$address->SetFieldType('city', displaydata::TYPE_TEXT);
$address->SetFieldType('prov', displaydata::TYPE_TEXT);
$address->SetFieldType('postalcode', displaydata::TYPE_TEXT);
$address->SetFieldType('notes', displaydata::TYPE_NOTE,array('name'=>'addressnote','class' => 'subtitle','text'=>'Display Address Note','size'=>15,'baseurl'=>'outputnote.php','notestype'=>'persaddr'));
//  set inlineedit field type
$address->SetInlineFieldType('type', displaydata::INLINE_CODECOMBO, array('name' => 'type','table'=>'address','field'=>'type','class' => 'body')); // address
$address->SetInlineFieldType('address1', displaydata::INLINE_TEXT, array('name' => 'address1','size'=>30,'class'=>'body')); // address1
$address->SetInlineFieldType('address2', displaydata::INLINE_TEXT, array('name' => 'address2','size'=>30,'class'=>'body')); // address2
$address->SetInlineFieldType('city', displaydata::INLINE_TEXT, array('name' => 'city','size'=>15,'class'=>'body')); // city
$address->SetInlineFieldType('prov', displaydata::INLINE_TEXT, array('name' => 'prov','size'=>8,'class'=>'body')); // provence
$address->SetInlineFieldType('postalcode', displaydata::INLINE_POSTALCODE, array('name' => 'postalcode','size'=>7,'class'=>'body')); // postalcode
$address->SetInlineFieldType('notes', displaydata::INLINE_NOTE,array('name'=>'addressnote','class' => 'subtitle','text'=>'Add Address Note','size'=>15,'baseurl'=>'inputnote.php','notestype'=>'persaddr'));

// Stop ordering
$address->hideOrder(false);
// Load the displaydata class  - telephone
$telephone = new DisplayData($db);
$telephone->setdisplaydata('telephone');
$telephone->SetTemplate('displaytelephone',$db);
// Set the query, select all rows from the people table
$telephone->setQuery("telephonetype,telephonenumber", "telephone","","personid = '".$_SESSION['person']["personid"]."'");
$telephone->setinsertvalue(array("telephonenumber"=>"New Telephone"));
$telephone->setPrimaryID('telephoneid') ;
$telephone->setConstantFields(array("personid"=>"'".$_SESSION["person"]['personid']."'"));
$telephone->setURLConstant("personprofile.php");
$telephone->setOrder('personid');

// Hide ID field
 $telephone->hidefield('personid');
// Show reset grid control
$telephone->showReset();

// setting inline edit
$telephone-> SetInLineEdit(false);
// Add standard control
 $telephone->addStandardControl(displaydata::STDCTRL_INLINEEDIT,"personprofile.php",displaydata::TYPE_PHPFUNCTION);
// Add create control
 $telephone->showCreateButton("personprofile.php",displaydata::TYPE_INLINEADDRECORD, 'New');

// Show checkboxes

// Show row numbers
$telephone->showRowNumber(true);
// Change the amount of results per page
$telephone->setResultsPerPage(2);

// Change headers text
$telephone->SetFieldHeader('telephonetype', 'Telephone Type:');
$telephone->SetFieldHeader('telephonenumber', 'Telephone Number:');
//  set field type
$telephone->SetFieldType('telephonetype', displaydata::TYPE_CODEDISPLAY,array('table'=>'telephone','field'=>'telephonetype','class' => 'body'));
$telephone->SetFieldType('telephonenumber', displaydata::TYPE_TELEPHONE,array('table'=>'telephone','field'=>'telephonenumber','class' => 'body'));
$telephone->SetFieldType('notes', displaydata::TYPE_NOTE,array('name'=>'telephonenote','class' => 'subtitle','text'=>'Display Telephone Note','size'=>15,'baseurl'=>'outputnote.php','notestype'=>'perstel'));
//  set inlineedit field type
$telephone->SetInlineFieldType('telephonetype', displaydata::INLINE_CODECOMBO, array('name' => 'telephonetype','table'=>'telephone','field'=>'telephonetype','class' => 'body')); // telephonetype
$telephone->SetInlineFieldType('telephonenumber', displaydata::INLINE_TELEPHONE, array('name' => 'telephonenumber','table'=>'telephone','field'=>'telephonenumber','class' => 'body')); // telephonenumber
$telephone->SetInlineFieldType('notes', displaydata::INLINE_NOTE,array('name'=>'telehoenote','class' => 'subtitle','text'=>'Add Telephone Note','size'=>15,'baseurl'=>'inputnote.php','notestype'=>'perstel'));

// Stop ordering
$telephone->hideOrder(false);
// Load the displaydata class  - email
$email = new DisplayData($db);
$email->setdisplaydata('email');
$email->SetTemplate('displayemail',$db);
// Set the query, select all rows from the people table
$email->setQuery("emailtype,email", "email","","personid = '".$_SESSION['person']["personid"]."'");
$email->setinsertvalue(array("email"=>"New Email"));
$email->setPrimaryID('emailid') ;
$email->setConstantFields(array("personid"=>"'".$_SESSION["person"]['personid']."'"));
$email->setURLConstant("personprofile.php");
$email->setOrder('personid');

// Hide ID field
 $email->hidefield('personid');
// Show reset grid control
$email->showReset();

// setting inline edit
$email-> SetInLineEdit(false);
// Add standard control
 $email->addStandardControl(displaydata::STDCTRL_INLINEEDIT,"personprofile.php",displaydata::TYPE_PHPFUNCTION);
// Add create control
 $email->showCreateButton("personprofile.php",displaydata::TYPE_INLINEADDRECORD, 'New');

// Show checkboxes

// Show row numbers
$email->showRowNumber(true);
// Change the amount of results per page
$email->setResultsPerPage(2);

// Change headers text
$email->SetFieldHeader('telephonetype', 'Telephone Type:');
//  set field type
$email->SetFieldType('emailtype', displaydata::TYPE_CODEDISPLAY,array('table'=>'email','field'=>'emailtype','class' => 'body'));
$email->SetFieldType('email', displaydata::TYPE_EMAIL,array('table'=>'email','field'=>'emailtype','class' => 'body'));
$email->SetFieldType('notes', displaydata::TYPE_NOTE,array('name'=>'emailnote','class' => 'subtitle','text'=>'Display Email Note','size'=>15,'baseurl'=>'outputnote.php','notestype'=>'ema'));
//  set inlineedit field type
$email->SetInlineFieldType('emailtype', displaydata::INLINE_CODECOMBO, array('name' => 'emailtype','table'=>'email','field'=>'emailtype','class' => 'body')); // email type
$email->SetInlineFieldType('email', displaydata::INLINE_EMAIL, array('name' => 'email','table'=>'email','field'=>'email','class' => 'body')); // email 
$email->SetInlineFieldType('notes', displaydata::INLINE_NOTE,array('name'=>'emailnote','class' => 'subtitle','text'=>'Add Email Note','size'=>15,'baseurl'=>'inputnote.php','notestype'=>'persemail'));

// Stop ordering
$email->hideOrder(false);
// Load the displaydata class  - note
$note = new DisplayData($db);
$note->setdisplaydata('notes');
$note->SetTemplate('displaynotes',$db);
// Set the query, select all rows from the people table
$note->setQuery("notes", "notes","","");
$note->setinsertvalue(array("notes"=>"New Note"));
$note->setPrimaryID('notesid') ;
$note->setConstantFields(array("personid"=>"'".$_SESSION["person"]['personid']."'"));
$note->setURLConstant("personprofile.php");
$note->setOrder('personid');

// Hide ID field
 $note->hidefield('personid');
// Show reset grid control
$note->showReset();

// setting inline edit
$note-> SetInLineEdit(false);
// Add standard control
 $note->addStandardControl(displaydata::STDCTRL_INLINEEDIT,"personprofile.php",displaydata::TYPE_PHPFUNCTION);
// Add create control
 $note->showCreateButton("personprofile.php",displaydata::TYPE_INLINEADDRECORD, 'New');

// Show checkboxes

// Show row numbers
$note->showRowNumber(true);
// Change the amount of results per page
$note->setResultsPerPage(2);

// Change headers text
$note->SetFieldHeader('notes', 'Note:');
//  set field type
$note->SetFieldType('notes', displaydata::TYPE_NOTE,array('name'=>'personnote','class' => 'subtitle','text'=>'Display Person Note','size'=>15,'baseurl'=>'outputnote.php','notestype'=>'pers'));
//  set inlineedit field type
$note->SetInlineFieldType('notes', displaydata::INLINE_NOTE,array('name'=>'personnote','class' => 'subtitle','text'=>'Add Person Note','size'=>15,'baseurl'=>'inputnote.php','notestype'=>'pers'));

// Stop ordering
$note->hideOrder(false);
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
if (!isset($_SESSION['displaydata'][$_SESSION ["displaydata"] ["name"]]["default"]))
    $_SESSION['displaydata'][$_SESSION ["displaydata"] ["name"]]["default"] = 0;
$checknotes = new DisplayData($db);
//$checknotes->checknotes();
?>
</HEAD>
<BODY>
<?PHP
    $pref->header('Person Profile');
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
                <form id="selectperson" name="selectperson"  action="personprofile.php" method="post" enctype="multipart/form-data" >
                    <?php
                        echo $validate->ComboBox("selectedperson","person",'','',"ASC","personid","fullname","body",$_SESSION['displaydata'][$_SESSION ["displaydata"] ["name"]]["pleaseselect"],array('New Person'=>-99),$_SESSION['displaydata'][$_SESSION ["displaydata"] ["name"]]["default"],false,false,"newperson",$_SESSION['displaydata'][$_SESSION ["displaydata"] ["name"]]["personnew"],"20",$_SESSION["preferences"]["database"]["dbname"]);
                    ?>
                    <input type="submit" class='subtitle' name="selectperson" value="Select">
                </form>
            </td>
	</tr>
    </table> 
    <form id="enterperson" name="enterperson"  action="personprofile.php" method="post" enctype="multipart/form-data" >
        <table class="tbl" width="100%">
                <tr>
                    <td class ='subtitle'>First Name&nbsp:
                        <span class="body"><?php echo $_SESSION['person']['firstname']?></span>
                    </td>
                    <td class="subtitle">Gender&nbsp:
                        <?PHP
                            echo $validate->CodeDisplay("person","gender","body",$_SESSION["person"]['gender']);
                        ?>
                    </td>
                </tr>
                <tr>
                    <td class ='subtitle'>Last Name&nbsp;:
                        <span class ='body'><?php echo $_SESSION['person']['lastname']; ?> </span>
                    </td>
                    <td>
                        <?PHP
                            echo $validate->DateDisplay('Birthdate : ',"subtitle",'body',$_SESSION['person']['birthdate'],'');
                        ?>
                    </td>
                </tr>
                <tr>
                    <td class ='subtitle'>Full Name&nbsp;:
                        <span class ='body' ><?php echo $_SESSION['person']['fullname'];?> </span>
                    </td>
                    <td class ='subtitle'>Mobility Plus Id.&nbsp;:
                        <span class='body' ><?php echo $_SESSION['person']['mobilityplusid']?></span>
                    </td>
                </tr>
            </table>
        </form>
    <table class="tbl" width="100%">
        <tr>
            <td>
                <table class="tbl" width="100%">
                    <?PHP
                          if ($_SESSION['displaydata']["status"]["displaystatus"])
                          {
                            echo    '<tr>
                                        <td class ="subtitle">Status:</td>
                                    </tr>
                                    <tr>
                                       <td>';
                                            $_SESSION["displaydata"] ["name"] = 'status';
                                            $status->printdata();
                            echo       '</td>
                                    </tr>';
                            }
                        if ($_SESSION['displaydata']["relationship"]["displayrelationship"])
                        {
                            echo    '<tr>
                                        <td colspan="2" class ="subtitle">Relationship:</td>
                                    </tr>
                                    <tr>
                                        <td>';
                                            $_SESSION ["displaydata"] ["name"] ='relationship';
                                            $relationship->printdata();
                            echo        '</td>
                                    </tr>';
                          }
                          if ($_SESSION['displaydata']["address"]["displayaddress"])
                          {
                            echo    '<tr>
                                        <td class ="subtitle">Address:</td>
                                    </tr>
                                    <tr>
                                        <td>';
                                            $_SESSION ["displaydata"] ["name"] ='address';
                                            $address->printdata();
                            echo        '</td>
                                   </tr>';
                          }  
                          if ($_SESSION['displaydata']["notes"]["displaynotes"])
                          {
                            echo    '<tr>
                                        <td class ="subtitle">Person Note:</td>
                                    </tr>
                                    <tr>
                                       <td>';
                                            $_SESSION["displaydata"] ["name"] = 'notes';
                                            $note->printdata();
                            echo       '</td>
                                    </tr>';
                          }
                    ?>
                </table>        
                </td>
                <td valign="top">
                    <table class="tbl" width="100%">
                    <?PHP
                        if ($_SESSION['displaydata']["membership"]["displaymembership"])
                        {
                            echo    '<tr>
                                        <td class ="subtitle">Membership:</td>
                                    </tr>
                                    <tr>
                                        <td>';
                                            $_SESSION ["displaydata"] ["name"] ='membership';
                                            $membership->printdata();
                            echo        '</td>
                                   </tr>';
                        }
                        if ($_SESSION['displaydata']["mobilityaid"]["displaymobilityaid"])
                        {
                            echo    '<tr>
                                        <td class ="subtitle">Mobility Aid:</td>
                                    </tr>
                                    <tr>
                                       <td>';
                                            $_SESSION["displaydata"] ["name"] = 'mobilityaid';
                                            $mobilityaid->printdata();
                            echo       '</td>
                                    </tr>';
                          }                       
                          if ($_SESSION['displaydata']["telephone"]["displaytelephone"])
                          {
                            echo    '<tr>
                                        <td class ="subtitle">Telephone:</td>
                                    </tr>
                                    <tr>
                                       <td>';
                                            $_SESSION["displaydata"] ["name"] = 'telephone';
                                            $telephone->printdata();
                            echo       '</td>
                                    </tr>';
                          }
                          if ($_SESSION['displaydata']["email"]["displayemail"])
                          {
                            echo    '<tr>
                                        <td class ="subtitle">Email:</td>
                                    </tr>
                                    <tr>
                                       <td>';
                                            $_SESSION["displaydata"] ["name"] = 'email';
                                            $email->printdata();
                            echo       '</td>
                                    </tr>';
                          }
                    ?>
                </td>    
                </tr>
                </table>            
            <tr>
                        <td>
                            <form id="personcontrol" name="personcontrol"  action="personprofile.php" method="post" enctype="multipart/form-data" >
                                 <input type="submit" class ='subtitle' name="personprint" value="Print">
                            </form>
                        </td>
                    </tr>
    </table>
</BODY>
</HTML>