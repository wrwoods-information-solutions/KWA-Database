<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN">
<HTML>
<HEAD>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1">
<link href="style.css" rel="stylesheet" type="text/css">
<script type="text/javascript" src="popup-window.js"></script>
<TITLE>Install</TITLE>
<?php
require_once ("class.menu.php");
require_once "class.login.php";
require_once "class.log.php";
require_once "class.validate.php";
require_once "class.messages.php";
require_once "class.pdodatabase.php";
require_once "class.preferences.php";
if (!isset($_POST['submit']))
    $_POST['submit'] = ' ';
if (!isset($_POST['deltype']))
    $_POST['deltype'] = false;
if (!isset($_POST['delserver']))
    $_POST['delserver'] = false;
if (!isset($_POST['deldbname']))
    $_POST['deldbname'] = false;
if (!isset($_POST['deluser']))
    $_POST['deluser'] = false;
if (!isset($_POST['delpassword']))
    $_POST['delpassword'] = false;
if (!isset($_POST['delport']))
    $_POST['delport'] = false;
if (!isset($_SESSION["preferences"]))
{
    $_SESSION["preferences"]["database"]["type"] = "mysql";
    $_SESSION["preferences"]["database"]["server"] = "localhost";
    $_SESSION["preferences"]["database"]["dbname"] = "kwa";
    $_SESSION["preferences"]["database"]["user"]   = "root";
    $_SESSION["preferences"]["database"]["password"] =  "";
    $_SESSION["preferences"]["database"]["port"] = '' ;
}
//$preferences = new preferences;
//$messages = new messages;
            $DB = new DBMS($_SESSION["preferences"]["database"]["type"],$_SESSION["preferences"]["database"]['server'],$_SESSION["preferences"]["database"]["dbname"],$_SESSION["preferences"]["database"]["user"], $_SESSION["preferences"]["database"]["password"],$_SESSION["preferences"]["database"]["port"]);
            $sql = 'CREATE DATABASE IF NOT EXISTS '. $_SESSION["preferences"]["database"]["dbname"];
            $result = $DB->query($sql);

            $sql1 = 'CREATE TABLE IF NOT EXISTS codes
            (  
                codesid int NOT NULL auto_increment,
                tblname text NOT NULL,
                fldname text NOT NULL,
                seqno int DEFAULT 1 NOT NULL,
                code text NOT NULL,
                title text NOT NULL, 
                description text,
                creationdate date,
                updatedate  date,
                createdby   varchar(10),   
                updateby     varchar(10),   
                PRIMARY KEY (codesid)
            )';
            $result11 = $DB->query($sql1) or die(mysql_error());
//            $messages->popupMsg('','','','',"Create Database","Database ".$_SESSION["preferences"]["database"]["dbname"]." Created",'','','','','');
            $sql2 = 'CREATE TABLE IF NOT EXISTS login
            (
                    loginid             INT UNSIGNED  NOT NULL AUTO_INCREMENT, PRIMARY KEY (loginid),
                    personid       	INT NOT NULL,
                    username      	VARCHAR(10),
                    password     	VARCHAR(32),
                    usermenuname	TEXT,
                    creationdate	DATE,
                    updatedate          DATE,
                    createdby   varchar(10),   
                    updateby            VARCHAR(10) NOT NULL
            )';
            $result2 = $DB->query($sql2) or die(mysql_error());
//            $messages->popupMsg ('','','','','',"Create Table","Table login Created",'','','','','','','','');
//            $sql3 = '';
//            $DB->query($sql3)or die(mysql_error());
            $sql4 = 'CREATE TABLE IF NOT EXISTS log
            (
                logid		INT UNSIGNED  NOT NULL AUTO_INCREMENT,
                file                VARCHAR(40),
                class          	VARCHAR(30),
                function      	VARCHAR(30),
                line                VARCHAR(6),
                type           	VARCHAR(6),
                message             VARCHAR(100),
                whatdoing   	TEXT,
                response     	TEXT,
                username    	VARCHAR(10),
                entrydate    	DATE,
                entrytime    	DATE,
                creationdate 	DATE,
                updatedate      DATE,
                createdby   varchar(10),   
                updateby        VARCHAR(10) NOT NULL,
                PRIMARY KEY (logid)
            )';
            $result4 = $DB->query($sql4) or die(mysql_error());
//            $messages->popupMsg ('','','','','',"Create Table","Table log Created",'','','','','','','','');
            $sql5 = 'CREATE TABLE IF NOT EXISTS mastermenu
            (  
                mastermenuid int NOT NULL auto_increment,
                menuname text NOT NULL,
                parentid int DEFAULT 1 NOT NULL,
                text text,
                link text, 
                title text, 
                icon text,
                target text,
                orderfield int DEFAULT 0,
                expanded tinyint DEFAULT 0,
                creationdate date,
                updatedate  date,
                createdby   varchar(10),   
                updateby     varchar(10),   
                PRIMARY KEY (mastermenuid)
            )';
            $result5 = $DB->query($sql5) or die(mysql_error());
//            $messages->popupMsg ('','','','','',"Create Table","Table mastermenu Created",'','','','','','','','');
            $sql6 = 'CREATE TABLE IF NOT EXISTS usermenu
            ( 
                usermenuid int NOT NULL auto_increment, 
                userid int,
                menuname text NOT NULL,
                orderfield int DEFAULT 0,
                mastermenuid int DEFAULT 1 NOT NULL, 
                text text,
                creationdate date,
                updatedate  date,
                createdby   varchar(10),   
                updateby     varchar(10),   
                PRIMARY KEY (usermenuid)
            )';
            $result6 = $DB->query($sql6) or die(mysql_error());
//            $messages->popupMsg ('','','','','',"Create Table","Table usermenu Created",'','','','','','','','');
            $sql7 = 'CREATE TABLE IF NOT EXISTS stdusermenu
            ( 
                stdusermenuid int NOT NULL auto_increment, 
                stdname text NOT NULL,
                menuname text NOT NULL,
                orderfield int DEFAULT 0,
                mastermenuid int DEFAULT 1 NOT NULL, 
                title text,
                creationdate date,
                updatedate  date,
                createdby   varchar(10),   
                updateby     varchar(10),   
                PRIMARY KEY (stdusermenuid)
            )';
            $result7 = $DB->query($sql7) or die(mysql_error());
//            $messages->popupMsg ('','','','','',"Create Table","Table stdusermenu Created",'','','','','','','','');
            $sql7 = 'CREATE TABLE IF NOT EXISTS menulangage
            (  
                    languageid int NOT NULL auto_increment, 
                    language varchar(15) NOT NULL,
                    id int NOT NULL,
                    text text,
                    title text,
                    creationdate date,
                    updatedate  date,
                    createdby   varchar(10),   
                    updateby varchar(10),   
                    PRIMARY KEY (languageid)
            )';
            $result7 = $DB->query($sql7) or die(mysql_error());
//            $messages->popupMsg ('','','','','',"Create Table","Table menulangage Created",'','','','','','','','');
            $sql8 = 'CREATE TABLE IF NOT EXISTS messages
            (
                messageid    int          NOT NULL auto_increment,
                category	 VARCHAR(10)  NOT NULL, 
                code	 VARCHAR(20)  NOT NULL, 
                title        VARCHAR(50)  NOT NULL,
                description  TEXT         NOT NULL,
                creationdate DATE,
                updatedate   DATE,
                createdby   varchar(10),   
                updateby     VARCHAR(10) NOT NULL,
                PRIMARY KEY (messageid)
            )';
           $result8 = $DB->query($sql8) or die(mysql_error());
//            $messages->popupMsg ('','','','','',"Create Table","Table messages Created",'','','','','','','','');
            $sql10 = 'CREATE TABLE IF NOT EXISTS person
            (
                personid                     int                     NOT NULL auto_increment,
                firstname                    varchar(25),
                lastname                    varchar(25),
                fullname                     varchar(52),  
                gender                        varchar(1),
                birthdate                     date, 
                mobilityplusid              varchar(5),
                creationdate                date, 
                updatedate                  date, 
                createdby                   varchar(10),   
                updateby                    varchar(10),
                PRIMARY KEY (personid)
            )';
            $result10 = $DB->query($sql10) or die(mysql_error());
//            $messages->popupMsg ('','','','','',"Create Table","Table person Created",'','','','','','','','');
            $sql11 = 'CREATE TABLE IF NOT EXISTS organization
            (
                organizationid      int         NOT NULL auto_increment,
                name                varchar(50),
                description         text,
                creationdate        date, 
                updatedate          date, 
                createdby           varchar(10),   
                updateby            varchar(10),
                PRIMARY KEY (organizationid)
            )';
            $result11 = $DB->query($sql11) or die(mysql_error());
//            $messages->popupMsg ('','','','','',"Create Table","Table organization Created",'','','','','','','','');
            $sql12 = 'CREATE TABLE IF NOT EXISTS address
            (
                addressid           int         NOT NULL auto_increment,
                personid            int,
                organizationid      int,
                type                varchar(5),
                address1            varchar(30),
                address2            varchar(30),
                city                varchar(15),
                prov                varchar(8),
                postalcode          varchar(7),
                creationdate        date, 
                updatedate          date, 
                createdby   varchar(10),   
                updateby             varchar(10),
                PRIMARY KEY (addressid)
           )';
            $result12 = $DB->query($sql12) or die(mysql_error());
//            $messages->popupMsg ('','','','','',"Create Table","Table address Created",'','','','','','','','');
            $sql13 = 'CREATE TABLE IF NOT EXISTS email
            (
                 emailid            int     NOT NULL auto_increment,
                 personid           int,
                 organizationid      int,
                 emailtype          varchar(4),
                 email              varchar(100),
                 creationdate       date, 
                 updatedate         date, 
                 createdby   varchar(10),   
                 updateby            varchar(10),
                 PRIMARY KEY (emailid)
            )';
            $result13 = $DB->query($sql13) or die(mysql_error());
//            $messages->popupMsg ('','','','','',"Create Table","Table email Created",'','','','','','','','');
            $sql14 = 'CREATE TABLE IF NOT EXISTS telephone
            (
                telephoneid             int     NOT NULL auto_increment,
                personid                int,
                organizationid           int,
                telephonetype           varchar(4),
                telephonenumber         varchar(25),
                creationdate            date, 
                updatedate              date, 
                createdby   varchar(10),   
                updateby                 varchar(10),
                PRIMARY KEY (telephoneid)
            )';
            $result14 = $DB->query($sql14) or die(mysql_error());
//            $messages->popupMsg ('','','','','',"Create Table","Table telephone Created",'','','','','','','','');
            $sql15 = 'CREATE TABLE IF NOT EXISTS status
            (
                statusid               int    NOT NULL auto_increment,
                personid               int,
                organizationid         int,
                status                 varchar(3),
                creationdate           date, 
                updatedate             date, 
                createdby   varchar(10),   
                updateby                varchar(10),
                PRIMARY KEY (statusid)
            )';
            $result15 = $DB->query($sql15) or die(mysql_error());
//            $messages->popupMsg ('','','','','',"Create Table","Table status Created",'','','','','','','','');
            $sql16 = 'CREATE TABLE IF NOT EXISTS membership
            (
                membershipid               int    NOT NULL auto_increment,
                personid               int,
                organizationid          int,
                membership             varchar(3),
                expirydate             date,
                creationdate           date, 
                updatedate             date, 
                createdby   varchar(10),   
                updateby                varchar(10),
                PRIMARY KEY (membershipid)
            )';
            $result16 = $DB->query($sql16) or die(mysql_error());
//            $messages->popupMsg ('','','','','',"Create Table","Table membership Created",'','','','','','','','');
            $sql17 = 'CREATE TABLE IF NOT EXISTS mobilityaid
            (
                mobilityaidid          int    NOT NULL auto_increment,
                personid               int,
                mobilityaid            varchar(3),
                creationdate           date, 
                updatedate             date, 
                createdby              varchar(10),   
                updateby               varchar(10),
                PRIMARY KEY (mobilityaidid)
            )';
            $result17 = $DB->query($sql17) or die(mysql_error());
//            $messages->popupMsg ('','','','','',"Create Table","Table mobilityaid Created",'','','','','','','','');
            $sql18 = 'CREATE TABLE IF NOT EXISTS notes
            (
                notesid            int            NOT NULL auto_increment,
                notestype          varchar(10),
                number             int,
                attachid           int,
                authour            varchar(25),
                notesdate          date,
                notes              text,
                creationdate       date, 
                updatedate         date, 
                createdby   varchar(10),   
                updateby            varchar(10),
                PRIMARY KEY (notesid)
            )';
            $result18 = $DB->query($sql18) or die(mysql_error());
//            $messages->popupMsg ('','','','','',"Create Table","Table note Created",'','','','','','','','');
            $sql19 = 'CREATE TABLE IF NOT EXISTS request
            (
                requestid                int             NOT NULL auto_increment,
                title                    varchar(50),
                requestor                int,
                requestdate              date,
                requesttime              date,
                receivedby               varchar(25),       
                refiningdate             date,
                refiningby               varchar(25),
                refiningtimespent        date,      
                gatheringdate            date,
                gatheringby              varchar(25),
                gatheringtimespent       date,      
                presentingdate           date,
                persentiningby           varchar(25),
                presentingtimespent      date,      
                followupdate             date,
                followupby               varchar(25),
                followuptimespent        date,
                currency                 varchar(3),
                accuracy                 varchar(3),
                utility                  varchar(3),
                completedate             date,
                completeby               varchar(25),    
                creationdate             date, 
                updatedate               date, 
                createdby   varchar(10),   
                updateby                  varchar(10),
                PRIMARY KEY (requestid)
            )';
            $result19 = $DB->query($sql19) or die(mysql_error());
//            $messages->popupMsg ('','','','','',"Create Table","Table request Created",'','','','','','','','');
            $sql20 = 'CREATE TABLE IF NOT EXISTS requestservicecode
            (
                requestservicecodeid     int        NOT NULL auto_increment,
                requestid                int,
                requestcategory          varchar(3),
                creationdate             date, 
                updatedate               date, 
                createdby   varchar(10),   
                updateby                  varchar(10),
                PRIMARY KEY (requestservicecodeid)
            )';
            $result20 = $DB->query($sql20) or die(mysql_error());
//            $messages->popupMsg ('','','','','',"Create Table","Table requestservicecode Created",'','','','','','','','');
            $sql21 = "CREATE TABLE IF NOT EXISTS  preferences  
			(
     			preferencesid  	  int          	NOT NULL  auto_increment,
    			setting           VARCHAR(25)   NOT NULL,
    			category          VARCHAR(10)   NOT NULL,
     			prefervalue       VARCHAR(100) 	NOT NULL,
     			creationdate   	  date,
     			updatedate        date,
     			createdby         varchar(10),   
                        updateby          varchar(10),
    			PRIMARY KEY (preferencesid)
			)";
	$result21 = $DB->query($sql21) or die(mysql_error());
//	$msg->popupMsg ('','','','','',"Create Table","Table preferencess Created",'','','','','','','','');
        $sql22 = 'CREATE TABLE IF NOT EXISTS relationship
        (
                relationshipid         int    NOT NULL auto_increment,
                personid               int,
                organizationid          int,
                relationship            varchar(3),
                expirydate             date,
                creationdate           date, 
                updatedate             date, 
                createdby   varchar(10),   
                updateby                varchar(10),
                PRIMARY KEY (relationshipid)
            )';
            $result22 = $DB->query($sql) or die(mysql_error());
            $sql23 = 'CREATE TABLE IF NOT EXISTS program
            (
                programid           int         NOT NULL auto_increment,
                name                varchar(50),
                department          varchar(3),
                description         text,
                status              varchar(3),
                creationdate        date, 
                updatedate          date, 
                createdby           varchar(10),   
                updateby            varchar(10),
                PRIMARY KEY (programid)
            )';
            $result23 = $DB->query($sql23) or die(mysql_error());
            $sql24 = 'CREATE TABLE IF NOT EXISTS programobjective 
            (
                programobjectiveid     int    NOT NULL auto_increment,
                programid              int,
                programobjective       text,
                creationdate           date, 
                updatedate             date, 
                createdby              varchar(10),   
                updateby               varchar(10),
                PRIMARY KEY (programobjectiveid)
            )';
            $result24 = $DB->query($sql24) or die(mysql_error());
            $sql25 = 'CREATE TABLE IF NOT EXISTS programmeasure 
            (
                programmeasureid        int    NOT NULL auto_increment,
                programid              int,
                programobjectiveid     int,
                programmeasure         text,
                creationdate           date, 
                updatedate             date, 
                createdby              varchar(10),   
                updateby               varchar(10),
                PRIMARY KEY (programmeasureid)
            )';
            $result25 = $DB->query($sql25) or die(mysql_error());
            $sql25a = 'CREATE TABLE IF NOT EXISTS programresponse 
            (
                programresponseid      int    NOT NULL auto_increment,
                programid              int,
                programobjectiveid     int,
                programmeasureid       int,
                programresponse        text,
                creationdate           date, 
                updatedate             date, 
                createdby              varchar(10),   
                updateby               varchar(10),
                PRIMARY KEY (programresponseid)
            )';
            $result25a = $DB->query($sql25a) or die(mysql_error());
            $sql26 = 'CREATE TABLE IF NOT EXISTS programlocation 
            (
                programlocationid      int    NOT NULL auto_increment,
                programid              int,
                location               int,
                creationdate           date, 
                updatedate             date, 
                createdby              varchar(10),   
                updateby               varchar(10),
                PRIMARY KEY (programlocationid)
            )';
            $result26 = $DB->query($sql26) or die(mysql_error());
            $sql27 = 'CREATE TABLE IF NOT EXISTS programresponsible 
            (
                programresponsibleid   int    NOT NULL auto_increment,
                programid              int,
                personid               int,
                creationdate           date, 
                updatedate             date, 
                createdby              varchar(10),   
                updateby               varchar(10),
                PRIMARY KEY (programresponsibleid)
            )';
            $result27 = $DB->query($sql27) or die(mysql_error());
            $sql28 = 'CREATE TABLE IF NOT EXISTS equipsupply 
            (
                equipsupplyid          int    NOT NULL auto_increment,
                programid              int,
                equipsupply            tex,
                creationdate           date, 
                updatedate             date, 
                createdby              varchar(10),   
                updateby               varchar(10),
                PRIMARY KEY (equipsupplyid)
            )';
            $result28 = $DB->query($sql28) or die(mys1ql_error());
            $sql29 = 'CREATE TABLE IF NOT EXISTS programsetup 
            (
                programsetupid         int    NOT NULL auto_increment,
                programid              int,
                setup                  text,
                creationdate           date, 
                updatedate             date, 
                createdby              varchar(10),   
                updateby               varchar(10),
                PRIMARY KEY (programsetupid)
            )';
            $sql29a = 'CREATE TABLE IF NOT EXISTS programbudget 
            (
                programbudgetid        int    NOT NULL auto_increment,
                programid              int,
                item                   varchar(20),
                amount                 decimal(10,2),
                creationdate           date, 
                updatedate             date, 
                createdby              varchar(10),   
                updateby               varchar(10),
                PRIMARY KEY (programbudgetid)
            )';
            $result29a = $DB->query($sql29a) or die(mysql_error());
            $sql30 = 'CREATE TABLE IF NOT EXISTS refreshments 
            (
                refreshmentsid         int    NOT NULL auto_increment,
                programid              int,
                refreshments           varchar(13),
                creationdate           date, 
                updatedate             date, 
                createdby              varchar(10),   
                updateby               varchar(10),
                PRIMARY KEY (refreshmentsid)
            )';
            $result30 = $DB->query($sql30) or die(mysql_error());
            $sql31 = 'CREATE TABLE IF NOT EXISTS servicecode 
            (
                servicecodeid         int    NOT NULL auto_increment,
                programid              int,
                servicecode           varchar(13),
                creationdate           date, 
                updatedate             date, 
                createdby              varchar(10),   
                updateby               varchar(10),
                PRIMARY KEY (servicecodeid)
            )';
            $result31 = $DB->query($sql31) or die(mysql_error());
//$preferences = new preferences;
$messages = new messages;
$preferences = new preferences;
if ($_POST['submit'] == 'Submit')
{
		if ($_POST['deltype'])
		{
			$preferences->deletepreferences('type');
		}else{
			$preferences->updatepreferences('type','database',$_POST['type']);
		}
		if ($_POST['delserver'])
		{
			$preferences->deletepreferences('server');
		}else{
			$preferences->updatepreferences('server','database',$_POST['server']);
		}
		if ($_POST['deldbname'])
		{
			$preferences->deletepreferences('dbname');
		}else{
				$preferences->updatepreferences('dbname','database',$_POST['dbname']);
		}
		if ($_POST['deluser'])
		{
			$preferences->deletepreferences('user');
		}else{
			$preferences->updatepreferences('user','database',$_POST['user']);
		}
		if ($_POST['delpassword'])
		{
			$preferences->deletepreferences('password');
		}else{
			$preferences->updatepreferences('password','database',$_POST['password']);

		}
		if ($_POST['delport'])
		{
			$preferences->deletepreferences('port');
		}else{
			$preferences->updatepreferences('port','database',$_POST['port']);

		}
    }
?>
</HEAD>
<BODY>
<table width="100%" background="Images/menu%20background.png" border="0">
    <tr>
        <td width="80%"></td>
    </tr>
	<tr>
	<td align="center" class="headtitle"></td>
	 <td width="20%" colspan="2">
  		<form action= "index.php?LC_ACTION=Logout"  method="post">
			<input class="button" type="submit" name="LC_ACTION" value='Logout' />
		</form>	</td>
   </tr>
   <tr>
	</tr>
   <tr>
	</tr>
</table>
<form id="prefmaster" name="prefmaster"  action="install.php" method="post" enctype="multipart/form-data" >	
<table border="0" cellpadding="0" cellspacing="0" width="100%"background="Images/Bbody%20background.png">
  <tr>
    <td colspan="3" class="headtitle" align="center"> Install Database</td>
  </tr>
		<tr>
			<td class="subtitle">Type</td>
			<td><select name="type" class="body">
                        <option value=0>    Please Select </option>
                        <option value='SQLite2'> SQLite2 </option>
                        <option value='SQLite3'> SQLite3 </option>
                        <option value='sqlsrv'> MS SQL Server 1 </option>
                        <option value='mssql'>  MS SQL Server 2  </option>
                        <option value='mysql'> MySQL </option>
                        <option value='pg'> PostgeSQL </option>
                        <option value='ibm'> IBM </option>
                        <option value='dblib'> DBLIB </option>
                        <option value='odbc'> MS Access </option>
                        <option value='oracle'> Oracle </option>
                        <option value='ifmx'> Informix </option>
                        <option value='fbd'> Firebird </option>
                        </SELECT>
                        </td>
 			<td class="subtitle">Delete</td>
			<td><input type="checkbox" name="deltype" value="No" /></td>
		</tr>	
		<tr>
			<td class="subtitle">Server</td>
			<td><input name="server" value="<?php echo $_SESSION['preferences']['database']['server']; ?>" type="text" class="body" size="65" /></td>
 			<td class="subtitle">Delete</td>
			<td><input type="checkbox" name="delserver" value="No" /></td>
		</tr>	
		<tr>
			<td class="subtitle">DBName</td>
			<td><input name="dbname" value="<?php echo $_SESSION['preferences']['database']['dbname'];  ?>" type="text" class="body" size="65" /></td>
 			<td class="subtitle">Delete</td>
			<td><input type="checkbox" name="deldbname" value="No" /></td>
		</tr>	
		<tr>
			<td class="subtitle">User</td>
			<td><input name="user" value="<?php echo $_SESSION['preferences']['database']['user'];?>" type="text" class="body" size="65" /></td>
			<td class="subtitle">Delete</td>
			<td><input type="checkbox" name="deluser" value="No" /></td>
		</tr>	
		<tr>
			<td class="subtitle">Password</td>
			<td><input name="password" value="<?php echo $_SESSION['preferences']['database']['password'];?>" type="text" class="body" size="65" /></td>
 			<td class="subtitle">Delete</td>
			<td><input type="checkbox" name="delpassword" value="No" /></td>
		</tr>
		<tr>
			<td class="subtitle">Port</td>
			<td><input name="port" value="<?php echo $_SESSION['preferences']['database']['port'];?>" type="text" class="body" size="25" /></td>
 			<td class="subtitle">Delete</td>
			<td><input type="checkbox" name="delport" value="No" /></td>
		</tr>
		<tr>
			<td colspan="2"><input name="submit" type='submit' value="Submit" /></td>
		</tr>
 </table>
</form>
</BODY>