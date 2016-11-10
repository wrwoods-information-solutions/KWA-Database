<?php session_start(); ?>
<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN">
<HTML>
    <HEAD>
        <meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1">
        <link href="style.css" rel="stylesheet" type="text/css">
        <script type="text/javascript" src="popup-window.js"></script>
<script language="javascript">
function noshow() 
{
  document.ctrtype('div1').style.display='password';
  document.ctrtype('div2').style.display='';
}
function show() 
{
  document.ctrtype('div1').style.display='';
  document.ctrtype('div2').style.display='text';
}
</script>
        <TITLE>KWA Login Setup</TITLE>
        <?php
        require_once "class.preferences.php";
        require_once "class.displaydata.php";
        require_once "class.person.php";
        if (isset($_GET["page"]))
            $_SESSION['datagrid'][$_SESSION ["datagrid"] ["name"]]["page"] = (int) $_GET["page"];
        if (isset($_GET["ctrtype"]))
        {    
            $ctrtype= $_GET["ctrtype"];
        }else{
            $ctrtype='password';
        }    
        $pref = new preferences;
        $pref->basicincludes();
        $login = new login;
        $login->checklogin();
        $person = new person;
        $login->checklogout();
        if (!isset($_SESSION["datagrid"]["loginkey"]))
            $_SESSION["datagrid"]["loginkey"] = 0;
        if (!isset($_POST['refreshlogin']))
            $_POST['refreshlogin'] = '';
        if (!isset($_POST['selectlogin']))
            $_POST['selectlogin'] = '';
        if (!isset($_POST['refreshmenu']))
            $_POST['refreshmenu'] = '';
        if (!isset($_POST['refreshstdmenu']))
            $_POST['refreshstdmenu'] = '';
        if (!isset($_POST['savestdmenu']))
            $_POST['savestdmenu'] = '';
        if (!isset($_POST['seletestdmenu']))
            $_POST['deletestdmenu'] = '';
        if (!isset($_SESSION["datagrid"]["click"]))
            $_SESSION["datagrid"]["click"] = false;
        if (!isset($_SESSION["datagrid"]["displaygrid"]))
            $_SESSION["datagrid"]["displaygrid"] = false;
        if (!isset($_POST['password']))
            $_POST['password'] = '';
        if (!isset($_POST['confpassword']))
            $_POST['confpassword'] = '';
        if (!isset($_POST['submitpassword']))
            $_POST['submitpassword'] = '';
        if (!isset($_POST['usestdmenu']))
            $_POST['usestdmenu'] = '';
        if (!isset($_POST['submit']))
            $_POST['submit'] = '';
        if (!isset($_POST['delete']))
            $_POST['delete'] = '';
        if (!isset($_POST['reset']))
            $_POST['reset'] = '';
        if (!isset($_SESSION["datagrid"]["menuname"]))
            $_SESSION["datagrid"]["menuname"] = '';
        if (!isset($loginkey))
            $loginkey = '';
        if (!isset($personid))
            $personid = '';
        if (!isset($personfullname))
            $personfullname = '';
        if (!isset($username))
            $username = '';
        if (!isset($password))
            $password = '';
        if (!isset($confpassword))
            $confpassword = '';
        if (!isset($usermenuname))
            $usermenuname = '';
        if (!isset($newmenu))
            $newmenu = '';
        if (!isset($_POST['newmenu']))
            $_POST['newmenu'] = 0;
        if (!isset($_SESSION["menunew"]))
            $_SESSION["menunew"] = '';
        if (!isset($_SESSION["newmenu"]))
            $_SESSION["newmenu"] = '';
        if (!isset($_SESSION["tbllogin"]['usermenuname']))
            $_SESSION["tbllogin"]['usermenuname'] = '';
        if ($_POST['refreshlogin'] == 'Refresh') {
            if ($_POST['selectlogin'] == -99) {
                $_SESSION["datagrid"]["displaygrid"] = false;
                $_SESSION["datagrid"]["click"] = true;
            }
            if ($_POST['newmenu'] == -99) {
                $_SESSION["datagrid"]["menunew"] = true;
                $_SESSION["datagrid"]["click"] = true;
                $_SESSION["datagrid"]["displaygrid"] = false;
                $_SESSION["datagrid"]["click"] = true;
            }
            if ($_POST['selectlogin'] == 0) {
                $_SESSION["datagrid"]["displaygrid"] = false;
                $_SESSION["datagrid"]["click"] = false;
            } else {
                $_SESSION["datagrid"]["loginkey"] = $_POST['selectlogin'];
                $_SESSION["datagrid"]["click"] = true;
            }
        }
        if ($_POST['refreshmenu'] == 'Refresh') {
            $_SESSION["datagrid"]["menuname"] = $_POST['selectusermenuname'];
            $_SESSION["datagrid"]["displaygrid"] = true;
            $_SESSION["datagrid"]["click"] = true;
        }
        if ($_SESSION["datagrid"]["click"]) {
            if ($_POST['selectlogin'] == -99) {
                $_SESSION["datagrid"]["loginkey"] = $login->insertrecord();
                $loginkey = $_SESSION["datagrid"]["loginkey"];
//      		blank form varables
                $personid = 0;
                $personfullname = ' ';
                $username = ' ';
                $password = ' ';
                $confpassword = ' ';
                $usermenuname = 0;
            } else {
                $_SESSION["tbllogin"] = $login->getrecord($_SESSION["datagrid"]["loginkey"]);
// 	    		load form varables
                $loginkey = $_SESSION["datagrid"]["loginkey"];
                $personid = $_SESSION["tbllogin"]['personid'];
                $username = $_SESSION["tbllogin"]['username'];
                $password = "";
                $confpassword = "";
                $usermenuname = $_SESSION["tbllogin"]['usermenuname'];
                $_SESSION["tblperson"] = $person->getrecord($personid);
                $personfullname = $_SESSION["tblperson"]["fullname"];
            }
        }
        if ($_POST['usestdmenu'] == 'Use Standard Menu') {
            $login = new login;
            $login->usestdmenu($_SESSION["datagrid"]["loginkey"], $_POST['usestdmenuinput']);
            $_SESSION["datagrid"]["displaygrid"] = false;
            $_SESSION["datagrid"]["click"] = true;
        }
        if ($_POST['submit'] == 'Submit') {
            $_SESSION["datagrid"]["loginkey"] = $_POST['selectlogin'];
            $login->updaterecord($_SESSION["datagrid"]["loginkey"], $_POST['selectpersonid'], $_POST['username'], $_POST['password'], $_POST['selectusermenuname']);
            $_POST = array();
            $_SESSION["datagrid"]["loginkey"] = -99;
            $login = new login;
            $login->cleanSESSION();
        }
        if ($_POST['delete'] == 'Delete') {
            $login->deleterecord($_POST['selectlogin']);
            $_SESSION["datagrid"]["loginkey"] = -99;
            $login = new login;
            $login->cleanSESSION();
        }
        if ($_POST['reset'] == 'Reset') {
            $_POST = array();
            $_SESSION["datagrid"]["loginkey"] = -99;
            $login = new login;
            $login->cleanSESSION();
        }
        if ($_POST['refreshstdmenu'] == 'Refresh') {
            $_SESSION['savestdusermenuname'] = $_POST['savestdusermenuname'];
            if ($_POST['savestdusermenuname'] <= 0) {
                $newmenu = true;
            } else {
               $newmenu = false;
            }
        }
        if ($_POST['savestdmenu'] == 'Save Standard Menu')
        {
            $login = new login;
            $login->savestdmenu($_SESSION['savestdusermenuname'], $_SESSION["datagrid"]["menuname"]);
            $_SESSION["datagrid"]["displaygrid"] = true;
            $_SESSION["datagrid"]["click"] = true;
        }
        if ($_POST['deletestdmenu'] == '="Delete Standard Menu') {
            $login = new login;
            $login->deletestdmenu($_POST['deletestdmenu']);
            $_SESSION["datagrid"]["displaygrid"] = false;
            $_SESSION["datagrid"]["click"] = true;
        }
        if ($_POST['submitpassword'] == 'Submit Password')
        {
            $login = new login;
            $result = $login->validate_new_password($password,$confpassword);
            if ($result)
            {
                
            }    
        }
// Load the database adapter
        $db = new DBMS($_SESSION["preferences"]["database"]["type"], $_SESSION["preferences"]["database"]['server'], $_SESSION["preferences"]["database"]["dbname"], $_SESSION["preferences"]["database"]["user"], $_SESSION["preferences"]["database"]["password"], $_SESSION["preferences"]["database"]["dbname"]);

// Load the datagrid class
        $usermenu = new DisplayData($db);
        $usermenu->setdisplaydata('usermenugrid');
        $usermenu->SetTemplate('displaygrid', $db);
//		$usermenu->setUserName($_SESSION["datagrid"]['username']); 
// Set the query, select all rows from the people table
        $usermenu->setQuery("usermenuid,menuname,orderfield,mastermenuid,text", "usermenu", "", "menuname = '" . $_SESSION["datagrid"]['menuname'] . '\'');
        $usermenu->setConstantFields(array("userid" => $_SESSION["datagrid"]["loginkey"], "menuname" => '"'. $_SESSION["datagrid"]['menuname'].'"'));
        $usermenu->SetPrimaryID('usermenuid');
        $usermenu->setURLConstant("setuplogin.php");
// Hide ID field
        $usermenu->hidefield('usermenuid');
        $usermenu->hidefield('menuname');
// Show reset grid control
        $usermenu->showReset();

// setting inline edit
        $usermenu->SetInLineEdit(true);
// Add standard control
        $usermenu->addStandardControl(DisplayData::STDCTRL_INLINEEDIT, "setuplogin.php", DisplayData::TYPE_PHPFUNCTION);
// Add create control
//		$_SESSION["datagrid"]['currnoofnewlines'] = $_SESSION["datagrid"]["noofnewlines"] +1;
//		$_SESSION["datagrid"]['userid'] = $_SESSION["datagrid"]['loginid'];
        $usermenu->showCreateButton("setuplogin.php", DisplayData::TYPE_INLINEADDRECORD, 'Add New Menu Item');

// Show checkboxes
        $usermenu->showCheckboxes();

// Show row numbers
        $usermenu->showRowNumber();

// Change the amount of results per page
        $usermenu->setResultsPerPage(10);

// Change headers text
        $usermenu->SetFieldHeader('orderfield', 'Order');
        $usermenu->SetFieldHeader('mastermenuid', 'Master Menu');
        $usermenu->SetFieldHeader('text', 'Text');
//  set field type
        $usermenu->SetFieldType('orderfield', DisplayData::TYPE_FIELD, array('table'=>'usermenu','displayfield'=> 'orderfield', 'inputfield'=>'orderfield'));
        $usermenu->SetFieldType('mastermenuid', DisplayData::TYPE_FIELD, array('table'=>'mastermenu','displayfield'=> 'text', 'inputfield'=>'mastermenuid'));
        $usermenu->SetFieldType('text', DisplayData::TYPE_FIELD, array('table'=>'usermenu','displayfield'=> 'text', 'inputfield'=>'text'));

//  set inlineedit field type
        $usermenu->SetInlineFieldType('orderfield', DisplayData::INLINE_TEXT, array('name' => 'orderfield', 'class' => 'body', 'size' => '5', 'displayvalue' => 'orderfield')); // orderfield
        $usermenu->SetInlineFieldType('mastermenuid', DisplayData::INLINE_COMBOBOX, array('name' => 'mastermenuid', 'table' => 'mastermenu', 'where' => '', 'order_by' => 'title', 'asc' => 'ASC', 'value' => 'mastermenuid', 'display' => 'text', 'class' => 'body', 'pleaseselect' => true, 'commonelements' => array('Default' => 0), 'default' => '', 'noinput' => '', 'AllowNew' => false, 'newname' => '', 'new' => false, 'size' => 20)); // MasterMenu id
        $usermenu->SetInlineFieldType('text', DisplayData::INLINE_TEXT, array('name' => 'text', 'class' => '', 'size' => '20', 'displayvalue' => 'text')); // Text 
// Stop ordering
        $usermenu->hideOrder();
        $usermenu->setorder('orderfield');
        ?>
    </HEAD>

    <BODY>
        <?PHP
        $pref->header('Setup Login')
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
        <form action= "setuplogin.php" method="post">
            <table width="100%" border="0" background="Images/HeavenBackground.jpg"> 
                <tr>
                    <td class="subtitle" width="108" >Select UserName</td>
                    <td>
                        <?php
                        $validate = new validate;
                        echo $validate->ComboBox("selectlogin", "login", '', "loginid", "ASC", "loginid", "username", "body", true, array('New UserName' => '-99'), $loginkey, false, false, "", false, 20, $_SESSION["preferences"]["database"]["dbname"]);
                        ?>
                        <input type="submit" name="refreshlogin" value="Refresh" >
                    </td>

                </tr>
                <tr>
                    <td class="subtitle">Person</td>
                   <td><input name="person" value="<?php echo $personfullname; ?>" type="text" class="body" size="25" ></td>
                </tr>
                <tr>
                    <td class="subtitle">Username</td>
                    <td><input name="username" value="<?php echo $username; ?>" type="text" class="body" size="25" ></td>
                </tr>
                <tr>
                   <?php
                    echo $validate->Password();
                    ?>         
                </tr>
                <tr>
                    <td class="subtitle">UserMenu Name</td>
                    <td>
                        <?PHP
                        echo $validate->ComboBox("selectusermenuname", "login", '', "usermenuname", "ASC", "usermenuname", "usermenuname", "body", true, array('New User Menu Name' => '-99'), $usermenuname, false, false, "newmenu", $_SESSION["menunew"], 20, $_SESSION["preferences"]["database"]["dbname"]);
                        ?>    
                        <input type="submit" name="refreshmenu" value="Refresh" >
                        <?PHP
                        echo $validate->ComboBox("usestdmenuinput", "stdusermenu", '', "stdname", "ASC", "stdname", "stdname", "body", true, array(), $_SESSION["tbllogin"]['usermenuname'], false, false, "", false, 20, $_SESSION["preferences"]["database"]["dbname"]);
                        ?>
                        <input type="submit" name="usestdmenu" value="Use Standard Menu" >
                    </td>
                </tr>    
                <tr>
                    <td colspan="2">
                        <?php
                        if ($_SESSION["datagrid"]["displaygrid"]) {
                            // Print the table
                            $usermenu->printdata();
                        }
                        ?>
                    </td>
                </tr>
                <tr>
                    <td colspan="3">
                        <input type="submit" name="submit" value="Submit">
                        <input type="submit" name="delete" value="Delete">
                        <input type="submit" name="reset" value="Reset">
                        <?php
                        echo $validate->ComboBox("savestdusermenuname", "stdusermenu", '', "stdname", "ASC", "stdname", "stdname", "body", true, array("New stdUsermenu" => -99), $_SESSION["tbllogin"]['usermenuname'], false, false, "", $newmenu, 20, $_SESSION["preferences"]["database"]["dbname"]);
                        ?>
                        <input type="submit" name="refreshstdmenu" value="Refresh">
                        <input type="submit" name="savestdmenu" value="Save Standard Menu" >
                        <input type="submit" name="deletestdmenu" value="Delete Standard Menu">
                    </td>
                </tr>
            </table>
        </form>    
<!-- ***** Popup Window ************************************************** -->';
<div class="sample_popup"     id="popup" style="display: none;">

<div class="menu_form_header" id="popup_drag">
<img class="menu_form_exit"   id="popup_exit" src="form_exit.png" alt="" />
<span align=center>Set Password</span>
</div>

<div class="menu_form_body">
<form action="setuplogin.php">
<table>
    <?PHP
        echo '<tr>'
            .     '<td class="subtitle">Password'
            .            '<input name="password" class="body" value="'.$password.'" type="'.$ctrtype.'" size=10 >'
            .            '<img src="images/eye 1.png" id="eyeid" width="16" height="16" border="0" onclick="show()" alt="Show Password">'
            .      '</td>';
        echo '</tr>'
            .'<tr>'
            .      '<td class="subtitle">Confirm Password'
            .            '<input name="confpassword" class="body" value="'.$confpassword.'" type="'.$ctrtype.'" size=10>'
            .           '<img src="images/eye 1.png" id="confeyeid" width="16" height="16" border="0" onfocus="show()" alt="Show Password">'
           .      '</td>'
           . '</tr>'
           . '<tr>'    
           .      '<td>'
           .        '<input type="submit" name="submitpassword" value="Submit Password" ></td></tr>';
     ?>   
       </table>
</form>
</div>
</div>
    </BODY>
</HTML>