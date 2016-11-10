<?php

            $sql9 = "INSERT INTO `messages` (`messageid`, `category`, `code`, `title`, `description`, `creationdate`, `updatedate`, `updateby`) VALUES
(2, 'login', 'notlogin', 'Not Logged In', 'You are not logged in, please log in', '2011-08-25', '2012-04-16', 'admin'),
(34, 'record', ' recadd', 'Record Added', 'A record has added', '2012-04-20', '2012-04-20', 'admin'),
(39, 'login', 'blankusername ', 'Blank Username ', ' Must have a UserName , please re- enter', '2012-04-20', '2012-04-20', 'admin'),
(8, 'record', 'recdelete', 'Record Deleted', 'A record has been deleted.', '2011-08-25', '2012-04-16', 'admin'),
(27, 'record', 'recedit', 'Record Edited', 'A record has been edited', '2012-04-18', '2012-04-20', 'admin'),
(11, 'database', 'error in db', 'Error in the Database', 'A problem while trying to output the table. ', '2012-02-22', '2012-04-20', 'admin'),
(36, 'login', ' blanklastname', ' Blank Last Name', ' Must have a last name , please re-enter', '2012-04-20', '2012-04-20', 'admin'),
(37, 'login', 'blankpassword ', ' Blank Password', ' Must have a password , please re-enter', '2012-04-20', '2012-04-20', 'admin'),
(38, 'login', 'invalidloginrecord ', 'Invalid Login Record ', 'Login Record for firstname,lastname, password not found', '2012-04-20', '2012-04-20', 'admin'),
(35, 'login', ' blankfirstname', ' Blank First Name', 'Must have a first name , please re-enter', '2012-04-20', '2012-04-20', 'admin'),
(40, 'login', 'passwordchange ', 'Password Change ', ' The password has been changed', '2012-04-20', '2012-04-20', 'admin'),
(41, 'login', 'passwordinvalid ', ' Invalid Password', ' The password entered is invalid, Please re-enter', '2012-04-20', '2012-04-20', 'admin'),
(42, 'login', 'passwordreset ', ' Password Reset', ' The password has been reset', '2012-04-20', '2012-04-20', 'admin'),
(43, 'Menu', 'copy from stdusermen', ' Copy From stdusermenu', ' Records were copied from stdusermenu', '2012-04-26', '2012-04-26', 'admin'),
(44, 'Menu', 'copy to stdusermenu ', 'Copy To stdusermenu ', 'Records were copied to stdusermenu', '2012-04-26', '2012-04-26', 'admin'),
(45, 'record', ' recsave', 'Record Saved', ' A record has been saved', '2012-05-26', '2012-05-26', 'admin');
";
            $result8 = $DB->query($sql8) or die(mysql_error());
              
