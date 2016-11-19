<script type="text/javascript" src="popup-window.js"></script>
<?php

require_once("class.pdodatabase.php");
require_once("class.messages.php");
class validate {

    var $idFrom = ''; // string ID related with the currency to be converted
    var $idTo = ''; // string ID related with the target currency
    var $rate = 0.0; // Conversion rate
    var $rounding = 1.0; // Rounding
    var $roundType = 1; // Kinf of rounding : 0=Inferior, 1=Normal, 2=Superior, 3=None
    var $nbDecimal = 2; // Number of decimals
    var $id = "canada";  // string ID related with the currency (ex : language)
    var $symbol = "$"; // Printable symbol
//var $nbDecimal 		= 2;	// Number of decimals past colon (or other)
    var $decimal = ","; // Decimal symbol ('.', ',', ...)
    var $thousands = " ";  // Thousands separator ('', ' ', ',')
    var $positivePos = 1; // Currency symbol position with Positive values :
    // 0 = '00Symb'
    // 1 = '00 Symb'
    // 2 = 'Symb00'
    // 3 = 'Symb 00'
    var $negativePos = 8; // Currency symbol position with Negative values :

    // 0 = '(Symb00)'
    // 1 = '-Symb00'
    // 2 = 'Symb-00'
    // 3 = 'Symb00-'
    // 4 = '(00Symb)'
    // 5 = '-00Symb'
    // 6 = '00-Symb'
    // 7 = '00Symb-'
    // 8 = '-00 Symb'
    // 9 = '-Symb 00'
    // 10 = '00 Symb-'
    // 11 = 'Symb 00-'
    // 12 = 'Symb -00'
    // 13 = '00- Symb'
    // 14 = '(Symb 00)'
    // 15 = '(00 Symb)'

    function SinNumber($strSIN) {
        $intEven = 0;
        $intOdd = 0;
        // If the input is not 9 digits or if the input is non numeric reject.
        if ((Len($strSIN) <> 9) Or Not(IsNumeric($strSIN))) {
            $Verify_SIN = False;
        } else {
            for ($intCount = 1; $intCount < 9; $intCount++):
//			intCount is even
                if (($intCount % 2) == 0) {
//         		If the multiplied value is greater than 10,take the last digit and add 1.
                    if ((Val(Mid($strSIN, $intCount, 1)) * 2) >= 10) {
                        $intEven .= ((Val(Mid($strSIN, $intCount, 1)) * 2) - 10) + 1;
                    } else {
                        $intEven .= Val(Mid($strSIN, $intCount, 1)) * 2;
                    }
//			ntCount is odd
                } else {
//         		Add the number is odd position.
                    $intOdd .= Val(Mid($strSIN, $intCount, 1));
                }
            endfor;
//   	Take the result and compare with the 9th digit.
            If ((10 - (($intEven + $intOdd) % 10)) == Mid($strSIN, 9, 1)) {
                return $strSIN;
            } Else {
                return False;
            }
        }
    }

    function Email($email) {
        if (ereg('^[a-zA-z0-9 \._\-]+@([a-zA-Z0-9][a-zA-z0-9\-]*\.)+[a-zA-Z]+$', $email))
            return $email;
        else
            return false;
    }

    function Telephone($phone, $ext = false, $trim = true, $convert = false) {
        // If we have not entered a phone number just return empty
        if (empty($phone)) {
            return false;
        }

        // Strip out any extra characters that we do not need only keep letters and numbers
        $phone = preg_replace("/[^0-9A-Za-z]/", "", $phone);
        // Keep original phone in case of problems later on but without special characters
        $OriginalPhone = $phone;

        // If we have a number longer than 11 digits cut the string down to only 11
        // This is also only ran if we want to limit only to 11 characters
        if ($trim == true && strlen($phone) > 11) {
            $phone = substr($phone, 0, 11);
        }

        // Do we want to convert phone numbers with letters to their number equivalent?
        // Samples are: 1-800-TERMINIX, 1-800-FLOWERS, 1-800-Petmeds
        if ($convert == true && !is_numeric($phone)) {
            $replace = array('2' => array('a', 'b', 'c'),
                '3' => array('d', 'e', 'f'),
                '4' => array('g', 'h', 'i'),
                '5' => array('j', 'k', 'l'),
                '6' => array('m', 'n', 'o'),
                '7' => array('p', 'q', 'r', 's'),
                '8' => array('t', 'u', 'v'),
                '9' => array('w', 'x', 'y', 'z'));

            // Replace each letter with a number
            // Notice this is case insensitive with the str_ireplace instead of str_replace 
            foreach ($replace as $digit => $letters) {
                $phone = str_ireplace($letters, $digit, $phone);
            }
        }

        $length = strlen($phone);
        // Perform phone number formatting here
        switch ($length) 
        {
            case 7:
                // Format: xxx-xxxx
                return preg_replace("/([0-9a-zA-Z]{3})([0-9a-zA-Z]{4})/", "$1-$2", $phone);
            case 10:
                // Format: (xxx) xxx-xxxx
                return preg_replace("/([0-9a-zA-Z]{3})([0-9a-zA-Z]{3})([0-9a-zA-Z]{4})/", "($1) $2-$3", $phone);
            case 11:
                // Format: x(xxx) xxx-xxxx
                return preg_replace("/([0-9a-zA-Z]{1})([0-9a-zA-Z]{3})([0-9a-zA-Z]{3})([0-9a-zA-Z]{4})/", "$1($2) $3-$4", $phone);
            case ($length >11):
		if ($ext)
    		{
                    return preg_replace("/([0-9a-zA-Z]{3})([0-9a-zA-Z]{4})/", "$1-$2", $phone.' ext '.substr($numbers,10));
                }else{
                    return;
                }
            default:
                // Return original phone if not 7, 10 or 11 digits long
                return $OriginalPhone;
        }
    }

    function PostalCode($postalcode, $country = 'Canada') {
        if (strlen($postalcode) === 0) {
            return;
        }
        $postalcode = strtoupper($postalcode);
        switch ($country) {
            case 'Canada':
                if (preg_match('/^([ABCEGHJKLMNPRSTVXY][0-9][A-Z] [0-9][A-Z][0-9])*$/', $postalcode))
                    return $postalcode;
                else {
                    $msg = new messages;
                    $msg->DisplayMessage('invalidcanpc', 150, 400, 400, 200, "Invalid Postal Code", "Invalid Canadian postal code please retry");
                    return;
                }
            case 'US':
                if (preg_match('/^([0-9]{5}(?:-[0-9]{4})?)*$/', $postalcode)) {
                    return $postalcode;
                } else {
                    $msg = new messages;
                    $msg->DisplayMessage('invaliduspc', 150, 400, 400, 200, "Invalid Postal Code", "Invalid USA postal code please retry");
                    return;
                }
        }
    }

    function CodeCombo($name = "code",$table, $field, $class = "", $default = 0) {
        $db = new DBMS($_SESSION["preferences"]["database"]["type"], $_SESSION["preferences"]["database"]['server'], $_SESSION["preferences"]["database"]["dbname"], $_SESSION["preferences"]["database"]["user"], $_SESSION["preferences"]["database"]["password"], $_SESSION["preferences"]["database"]["port"]);
        /* @var $table type */
        $sql = "SELECT code,title FROM codes WHERE tblname = \"" . $table . "\" and fldname = \"" . $field . "\" ORDER BY seqno";
        $result = $db->query($sql);
        $show_Combo_Box = ""
                . "<SELECT name=\"" . $name . "\" class=\"" . $class . "\" > \n";
        if ($result) {
            $rows = $result->fetchAll(PDO::FETCH_ASSOC);
            foreach ($rows as $row) {
                $selection = "";
                if ($default) {
                    if ($row['code'] == $default) {
                        $selection = " selected ";
                    }
                }
                $show_Combo_Box .= ""
                        . "<OPTION value=\"" . $row['code'] . "\" " . $selection . ">"
                        . $row['title']
                        . "</OPTION> \n";
            }
        }
        $show_Combo_Box .= ""
                . "</SELECT>\n";
        if ($result) {
            $result = null;
        }
        return $show_Combo_Box;
    }

// End function BuildCodeCombo_Box

    function CodeDisplay($table, $field, $class = "", $code) {

        $output = '';
        $sql = "SELECT  title FROM codes WHERE ((tblname = \"" . $table . "\") and ( fldname = \"" . $field . "\") and  (code = \"" . $code . "\"))";
        $db = new DBMS($_SESSION["preferences"]["database"]["type"], $_SESSION["preferences"]["database"]['server'], $_SESSION["preferences"]["database"]["dbname"], $_SESSION["preferences"]["database"]["user"], $_SESSION["preferences"]["database"]["password"], $_SESSION["preferences"]["database"]["port"])or die('could not connect');
        $result = $db->query($sql);
        $outputarray = $result->fetchAll(PDO::FETCH_ASSOC);
        if (count($outputarray) == 1) 
        {
            $output = $outputarray[0]['title'];
        }
        return $output;
    }

    function SQLCodeDisplay($sql, $field, $code) {
        if ($code == 0) {
            $output = 'default';
        } else {
            $output = ' ';
            $sql .= " WHERE `" . $field . "` = " . $code;
            $db = new DBMS($_SESSION["preferences"]["database"]["type"], $_SESSION["preferences"]["database"]['server'], $_SESSION["preferences"]["database"]["dbname"], $_SESSION["preferences"]["database"]["user"], $_SESSION["preferences"]["database"]["password"], $_SESSION["preferences"]["database"]["port"])or die('could not connect');
            $result = $db->query($sql);
            if ($result) {
                foreach ($result as $row) {
                    $output = $row[0];
                }
            }
        }
        return $output;
    }

    function CodeGet($table, $field, $code, $class = "") {
        $output = '';
        $sql = "SELECT  code FROM codes WHERE ((tblname = \"" . $table . "\") and ( fldname = \"" . $field . "\") and  (code = \"" . $code . "\"))";
        $db = new DBMS($_SESSION["preferences"]["database"]["type"], $_SESSION["preferences"]["database"]['server'], $_SESSION["preferences"]["database"]["dbname"], $_SESSION["preferences"]["database"]["user"], $_SESSION["preferences"]["database"]["password"], $_SESSION["preferences"]["database"]["port"]);
        $result = $db->query($sql);
        if ($result) {
            foreach ($result as $row) {
                $output = $row[0];
            }
        }
        return $output;
    }

    function FieldDisplay($table, $displayfield, $inputfield, $inputcode) 
    {
        $output = '';
        $sql = "SELECT " . $displayfield . " FROM " . $table . " WHERE " . $inputfield . " = \"" . $inputcode . "\"";
        $db = new DBMS($_SESSION["preferences"]["database"]["type"], $_SESSION["preferences"]["database"]['server'], $_SESSION["preferences"]["database"]["dbname"], $_SESSION["preferences"]["database"]["user"], $_SESSION["preferences"]["database"]["password"], $_SESSION["preferences"]["database"]["port"]);
        $result = $db->query($sql);
        $outputarray = $result->fetch(PDO::FETCH_ASSOC);
        if (count($outputarray) == 1) 
        {
            $output = $outputarray[$displayfield];
        }
        return $output;
    }

    //   combo box

    function ComboBox($name, $table, $where = "", $order_by = "", $asc = "", $value, $display, $css_class = "", $PleaseSelect = false, $commonelements = array(), $default = "", $noinput = false, $AllowNew = false, $newname, $new = false, $size, $dbname) {
//		echo 'name = '.$name.'<br>';
//		echo  'table = '.$table.'<br>';
//		echo 'orderby = '.$order_by.'<br>';
//		echo  'asc = '.$asc.'<br>';
//              echo  'value = '.$value.'<br>';
//		echo  'display = '.$display.'<br>';
//		echo  'css_class = '.$css_class.'<br>';
//		if ($PleaseSelect)
//		{
//			echo 'PleaseSelect = true<br>';
//		}else{
//			echo  'PleaseSelect = false<br>';
//		}
//              echo 'commonelements';
//              var_dump($commonelements); 
//		echo  'default = '.$default.'<br>';
//		if ($noinput)
//		{
//			echo 'noinput = true<br>';
//		}else{
//			echo  'noinput = false<br>';
//		}
//		if ($AllowNew)
//		{
//			echo 'AllowNew =true<br>';
//		}else{
//			echo  'AllowNew = false<br>';
//		}
//		echo  'newname = '.$newname.'<br>';
//		if ($new)
//		{
//			echo 'new =true<br>';
//		}else{
//			echo  'new = false<br>';
//		}
//		echo 'size = '.$size.'<br>';
//		echo 'dbname = '.$dbname.'<br>';
        $disable = false;
        if ($new) {
            $show_Combo_Box = "<input type=\"text\" name=\"" . $name . "\"class=\"" . $css_class . "\" size=\"" . $size . "\" value=\"\">";
        } else {
            if ($table) {
                if ($noinput) {
                    $disable = " disabled ";
                }
                if ($order_by) {
                     $order_by = " ORDER BY " . $order_by . " " . $asc;
                }
                if ($where == "") {
                    $where = '';
                } else {
                    $where = ' WHERE ' . $where;
                }
                $sql = "SELECT DISTINCT " . $value . ", " . $display . " FROM " . $table . $where . $order_by;
                $db = new DBMS($_SESSION["preferences"]["database"]["type"], $_SESSION["preferences"]["database"]['server'], $_SESSION["preferences"]["database"]["dbname"], $_SESSION["preferences"]["database"]["user"], $_SESSION["preferences"]["database"]["password"], $_SESSION["preferences"]["database"]["port"]);
                $result = $db->query($sql);
                $show_Combo_Box = "<SELECT name=\"" . $name . "\" class=\"" . $css_class . "\" " . $disable . "> \n";
                if ($PleaseSelect) {
                    $show_Combo_Box .="<OPTION value=\"0\"> Please Select</OPTION>\n";
                }
                foreach ($commonelements as $key => $value) {
                    $selection = "";
                    if ($default) {
                        if ($value == $default) {
                            $selection = " selected ";
                        }
                    }
                    $show_Combo_Box .= "<OPTION value=\"" . $value . "\" " . $selection . ">" . $key . "</OPTION> \n";
                }
                if ($result) {
                    foreach ($result as $row) {
                        $selection = "";
                        if ($default) {
                            if ($row[0] == $default) {
                                $selection = " selected ";
                            }
                        }
                        $show_Combo_Box .= "<OPTION value=\"" . $row[0] . "\" " . $selection . ">" . $row[1] . "</OPTION> \n";
                    } // End WHILE
                }
                $show_Combo_Box .= "</SELECT>\n";
                if ($AllowNew) {
                    $show_Combo_Box .= "<input type=\"submit\" name=\"" . $newname . "\" value=\"New\">";
                }
                if ($result) {
                    $result = null;
                }
            }
        } // End if ($table_name)
        return $show_Combo_Box;
    }

// End function BuildCombo_Box	

    function DateCombo($name, $classtext, $classctl, $text, $defaultdate) {
        if (isset($defaultdate)) {
            $showdate = $defaultdate;
        };
        $showcombo = '';
        if (strlen($text) > 0) {
            $showcombo .= '<span class="' . $classtext . '">' . $text . '</span>';
        }
        $showcombo .= '<input type="text" id="' . $name . '" name="' . $name . '" class="' . $classctl . '"  value="' . $defaultdate . '">';
        $showcombo .= '<img src="images/cal.gif" id="' . $name . 'id" width="16" height="16" border="0" alt="Pick a date">';
        $showcombo .='<script type="text/javascript">
    				Calendar.setup({
        				inputField     :    "' . $name . '",  // id of the input field
						ifFormat       :    "%Y-%b-%d",      // format of the input field
	         			button         :    "' . $name . 'id",  // trigger for the calendar (button ID)
        				weeknumbers    :    false,           // no week numbers
                			align          :    "br",           // alignment (defaults to "Bl")
        				singleClick    :    true
						});
				</script>';
        return $showcombo;
    }

// End function DateCombo	
    function DateDisplay($text,$classtext, $classdate, $defaultdate,$dateformat) 
    {
        if (isset($dateformat))
        {
            $dateformat =$_SESSION['preferences']['dateformat'];
        }    
        $rtndate = '<span class ='.$classtext.'>'.$text.'</span>'. 
            '<span class='.$classdate.'>'.Date($dateformat,\strtotime($defaultdate)).'</span>';
        return $rtndate;
    }
    function Password() {
        echo '<td><input type="button" value="Set Password"'
        . ' onclick="popup_show(\'popup\',\'popup_drag\',\'popup_exit\',\'screen-center\',0,0)"></td>';
        return;
    }

// End function DateCombo	

    function DBCombo($name, $css_class = "", $PleaseSelect, $default) {
        $sql = "SHOW DATABASES";
        $db = new DBMS($_SESSION["preferences"]["database"]["type"], $_SESSION["preferences-"]["database"]['server'], $_SESSION["preferences"]["database"]["dbname"], $_SESSION["preferences"]["database"]["user"], $_SESSION["preferences"]["database"]["password"], $_SESSION["preferences"]["database"]["port"]);
        $result = $db->query($sql);
        $show_Combo_Box = "<SELECT name=\"" . $name . "\" class=\"" . $css_class . "\"> \n";
        if ($result) {
            if ($PleaseSelect) {
                $show_Combo_Box .="<OPTION value=\"0\"> Please Select</OPTION>\n";
            }
            foreach ($result as $row) {
                $selection = "";
                if ($default) {
                    if ($row[0] == $default) {
                        $selection = " selected ";
                    }
                }
                $show_Combo_Box .= "<OPTION value=\"" . $row[0] . "\" " . $selection . ">" . $row[1] . "</OPTION> \n";
            } // End WHILE
        }
        $show_Combo_Box .= "</SELECT>\n";
        if ($result) {
            $result = null;
        }
        // End if (DBNAME_name)
        return $show_Combo_Box;
    }

// End function dbCombo_Box	

    function TableCombo($name, $css_class = "", $PleaseSelect, $default) {
        $sql = "SHOW TABLES FROM " . $_SESSION["preferences"]["database"]["dbname"];
        $db = new DBMS($_SESSION["preferences"]["database"]["type"], $_SESSION["preferences"]["database"]['server'], $_SESSION["preferences"]["database"]["dbname"], $_SESSION["preferences"]["database"]["user"], $_SESSION["preferences"]["database"]["password"], $_SESSION["preferences"]["database"]["port"]);
        $result = $db->query($sql);
        $show_Combo_Box = "<SELECT name=\"" . $name . "\" class=\"" . $css_class . "\"> \n";
        if ($result) {
            if ($PleaseSelect) {
                $show_Combo_Box .="<OPTION value=\"0\"> Please Select</OPTION>\n";
            }
            foreach ($result as $row) {
                $selection = "";
                if ($default) {
                    if ($row[0] == $default) {
                        $selection = " selected ";
                    }
                }
                $show_Combo_Box .= "<OPTION value=\"" . $row[0] . "\" " . $selection . ">" . $row[0] . "</OPTION> \n";
            } // End WHILE
        }
        $show_Combo_Box .= "</SELECT>\n";
        if ($result) {
            $result = null;
        }
        // End if (DBNAME_name)
        return $show_Combo_Box;
    }

// End function TableCombo_Box	

    function FieldCombo($name, $table, $css_class = "", $PleaseSelect, $default) {
        $sql = "SHOW fieldS FROM " . $table;
        $db = new DBMS($_SESSION["preferences"]["database"]["type"], $_SESSION["preferences"]["database"]['server'], $_SESSION["preferences"]["database"]["dbname"], $_SESSION["preferences"]["database"]["user"], $_SESSION["preferences"]["database"]["password"], $_SESSION["preferences"]["database"]["port"]);
        $result = $db->query($sql);
        $show_Combo_Box = "<SELECT name=\"" . $name . "\" class=\"" . $css_class . "\"> \n";
        if ($result) {
            if ($PleaseSelect) {
                $show_Combo_Box .="<OPTION value=\"0\"> Please Select</OPTION>\n";
            }
            foreach ($result as $row) {
                $selection = "";
                if ($default) {
                    if ($row[0] == $default) {
                        $selection = " selected ";
                    }
                }
                 $show_Combo_Box .= "<OPTION value=\"" . $row[0] . "\" " . $selection . ">" . $row[0] . "</OPTION> \n";
            } // End WHILE
        }
        $show_Combo_Box .= "</SELECT>\n";
        if ($result) {
            $result = null;
        }
        // End if ($table_name)
        return $show_Combo_Box;
    }

// End function FieldCombo_Box	

    function fileComboBox($name, $directory, $css_class = "",$size = 10 , $PleaseSelect = true, $default = "", $noinput = false, $AllowNew = false, $newname = '', $new = false) {
         $disable = false;
         if ($new) 
        {
            $show_Combo_Box = "<input type=\"text\" name=\"" . $name . "\"class=\"" . $css_class . "\" size=\"" . $size . "\" value=\"\">";
        } else {
             $show_Combo_Box = "<select name=\"" . $name . "\"class=\"" . $css_class . "\" value=\"\">";
            if ($noinput) 
            {
                $disable = " disabled ";
            }
            if (!$directory) {
                $directory = getcwd();
            }
            if ($PleaseSelect) {
                $show_Combo_Box .="<OPTION value=\"0\"> Please Select</OPTION>\n";
            }
            foreach ($_SESSION['displaydata']['commoncombochoices'] as $key => $value) {
                $selection = "";
                if ($default) {
                    if ($value == $default) {
                        $selection = " selected ";
                    }
                }
                $show_Combo_Box .= "<OPTION value=\"" . $value . "\" " . $selection . ">" . $key . "</OPTION> \n";
            }
            $choices = scandir($directory);
            foreach ($choices as $value) {
                 $selection = "";
                 if ($default) {
                    if ($value == $default) {
                        $selection = " selected ";
                    }
                }
                foreach ($_SESSION['displaydata']['fileextentions'] as $extention) {
                    $fileext = new SplFileInfo($extention);
                    if ($fileext == $extention) 
                        {
                        $show_Combo_Box .= "<OPTION value=\"" . $value . "\" " . $selection . ">" . $value . "</OPTION> \n";
                        }
                  }
            }
        }
        $show_Combo_Box .= "</SELECT>\n";
        if ($AllowNew) {
            $show_Combo_Box .= "<input type=\"submit\" name=\"" . $newname . "\" value=\"New\">";
        }
        return $show_Combo_Box;
    }

// End function fileCombo_Box	

    function DateStamp($table, $idfield, $id, $username, $dbname) {
        $sql = 'SELECT creationdate FROM ' . $table . ' WHERE (' . $idfield . ' = \'' . $id . '\')';
        $db = new DBMS($_SESSION["preferences"]["database"]["type"], $_SESSION["preferences"]["database"]['server'], $_SESSION["preferences"]["database"]["dbname"], $_SESSION["preferences"]["database"]["user"], $_SESSION["preferences"]["database"]["password"], $_SESSION["preferences"]["database"]["port"]);
        $result = $db->query($sql)or die();
        if ($result) 
        {
            $sql = 'UPDATE ' . $table . ' SET creationdate = now(),createdby = \''.$username. '\', updatedate = now(), updateby = \'' . $username . '\'   WHERE (' . $idfield . ' = \'' . $id . '\')';
        } else {
            $sql = 'UPDATE ' . $table . ' SET updatedate = now(), updateby = \'' . $username . '\'   WHERE (' . $idfield . ' = \'' . $id . '\')';
        }
        $result1 = $db->query($sql)or die();
    }

    // ================ /CURRENCY CONVERSION ======================
    // ============================================================
    function CurrencyConvert($rate, $rounding, $roundType, $nbDecimal, $idFrom = '', $idTo = '') {
        $this->idFrom = $idFrom;
        $this->idTo = $idTo;
        $this->rate = $rate;
        $this->rounding = $rounding;
        $this->roundType = $roundType;
        $this->nbDecimal = $nbDecimal;
    }

    // ================
    function From() {
        return($this->idFrom);
    }

    function To() {
        return($this->idTo);
    }

    // ================
    function getConvertValue($nb) {
        // 1) Apply conversion rate
        $res = $nb / $this->rate;
        // 2a) Rounding : divide to significant digits
        $res = $res / $this->rounding;
        // 2b) Rounding : kind of rounding
        switch ($this->roundType) {
            // Inferior rounding
            case 0:
                $res = floor($res);
                break;
            // Normal rounding
            case 1:
                $res = round($res);
            // Superior rounding
            case 2:
                $res = ceil($res);
                break;
            // None
            default :
                break;
        }
        // 2c) Rounding : multiply to significant digits
        $res = $res * $this->rounding;
        // 3) Fin de conversion
        return($res);
    }

    function getStringValue($nb) {
        $res = "";
        // 1) Number of decimals
        if ($this->nbDecimal != 0) {
            $formatString = "%." . $this->nbDecimal . "f";
            $res = sprintf($formatString, $this->getConvertValue($nb));
        } else {
            $res = abs($this->getConvertValue($nb));
        }
        return($res);
    }

    // ================ /CURRENCY DISPLAY =========================
    // ============================================================
    function CurrencyDisplay($id = "default", $symbol = "$;", $nbDecimal = 2, $decimal = ".", $thousands = ",", $positivePos = 2, $negativePos = 14) {
        $this->id = $id;
        $this->symbol = $symbol;
        $this->nbDecimal = $nbDecimal;
        $this->decimal = $decimal;
        $this->thousands = $thousands;
        $this->positivePos = $positivePos;
        $this->negativePos = $negativePos;
    }

    // ================
    function getSymbol() {
        return($this->symbol);
    }

    // ================
    function getId() {
        return($this->id);
    }

    // ================
    function getValue($nb) {
        $res = "";
        // Warning ! number_format function performs implicit rounding
        // Rounding is not handled in this DISPLAY class
        // that's why you have to use the right decimal value.
        // Workaround :number_format accepts either 1, 2 or 4 parameters.
        // this cause problem when no thousands separator is given : in this
        // case, an unwanted ',' is displayed.
        // That's why we have to do the work ourserlve.
        // Note : when no decimal il given (i.e. 3 parameters), everything works fine
        if ($this->thousands != '') {
            $res = number_format($nb, $this->nbDecimal, $this->decimal, $this->thousands);
        } else {
            // If decimal is equal to defaut thousand separator, apply a trick
            if ($this->decimal == ',') {
                $res = number_format($nb, $this->nbDecimal, $this->decimal, '|');
                $res = str_replace('|', '', $res);
            } else {
                // Else a simple substitution is enough
                $res = number_format($nb, $this->nbDecimal, $this->decimal, $this->thousands);
                $res = str_replace(',', '', $res);
            }
        }
        return($res);
    }

    // ================
    function getFullValue($nb) {
        $res = "";
        // Currency symbol position
        if ($nb == abs($nb)) {
            $res = $this->getValue($nb);
            // Positive number
            switch ($this->positivePos) {
                case 0:
                    // 0 = '00Symb'
                    $res = $res . $this->symbol;
                    break;
                case 2:
                    // 2 = 'Symb00'
                    $res = $this->symbol . $res;
                    break;
                case 3:
                    // 3 = 'Symb 00'
                    $res = $this->symbol . ' ' . $res;
                    break;
                case 1:
                default :
                    // 1 = '00 Symb'
                    $res = $res . ' ' . $this->symbol;
                    break;
            }
        } else {
            // Negative number
            $res = $this->getValue(abs($nb));
            switch ($this->negativePos) {
                case 0:
                    // 0 = '(Symb00)'
                    $res = '(' . $this->symbol . $res . ')';
                    break;
                case 1:
                    // 1 = '-Symb00'
                    $res = '-' . $this->symbol . $res;
                    break;
                case 2:
                    // 2 = 'Symb-00'
                    $res = $this->symbol . '-' . $res;
                    break;
                case 3:
                    // 3 = 'Symb00-'
                    $res = $this->symbol . $res . '-';
                    break;
                case 4:
                    // 4 = '(00Symb)'
                    $res = '(' . $res . $this->symbol . ')';
                    break;
                case 5:
                    // 5 = '-00Symb'
                    $res = '-' . $res . $this->symbol;
                    break;
                case 6:
                    // 6 = '00-Symb'
                    $res = $res . '-' . $this->symbol;
                    break;
                case 7:
                    // 7 = '00Symb-'
                    $res = $res . $this->symbol . '-';
                    break;
                case 9:
                    // 9 = '-Symb 00'
                    $res = '-' . $this->symbol . ' ' . $res;
                    break;
                case 10:
                    // 10 = '00 Symb-'
                    $res = $res . ' ' . $this->symbol . '-';
                    break;
                case 11:
                    // 11 = 'Symb 00-'
                    $res = $this->symbol . ' ' . $res . '-';
                    break;
                case 12:
                    // 12 = 'Symb -00'
                    $res = $this->symbol . ' -' . $res;
                    break;
                case 13:
                    // 13 = '00- Symb'
                    $res = $res . '- ' . $this->symbol;
                    break;
                case 14:
                    // 14 = '(Symb 00)'
                    $res = '(' . $this->symbol . ' ' . $res . ')';
                    break;
                case 15:
                    // 15 = '(00 Symb)'
                    $res = '(' . $res . ' ' . $this->symbol . ')';
                    break;
                case 8:
                default :
                    // 8 = '-00 Symb'
                    $res = '-' . $res . ' ' . $this->symbol;
                    break;
            }
        }
        return($res);
    }

    function cleanvariable($variable) {
        $variable = strip_tags(stripslashes(trim(rtrim($variable))));
        return $variable;
    }

    function extractarray($inarray) {
        $output = '';
        foreach ($inarray as $key => $value) {
            $_SESSION['array'][$key] = $value;
        }
        return;
    }

    /* Sends a redirect to the specified page.
     * The database connection is closed and execution terminates in this function.
     *
     * <b>Note:</b>  MS IIS/PWS has a bug that does not allow sending a cookie and a
     * redirect in the same HTTP header. When we detect that the web server is IIS,
     * we accomplish the redirect using meta-refresh.
     * See the following for more info on the IIS bug:
     * {@link http://www.faqts.com/knowledge_base/view.phtml/aid/9316/fid/4}
     *
     * @param string $url  The page to redirect to. In theory, this should be an
     *                     absolute URL, but all browsers accept relative URLs
     *                     (like "month.php").
     *
     * @global string    Type of webserver
     * @global array     Server variables
     * @global resource  Database connection
     */

    function do_redirect($url) {
         global $_SERVER, $c, $SERVER_SOFTWARE, $SERVER_URL;

        // Replace any '&amp;' with '&' since we don't want that in the HTTP header.
         $url = str_replace('&amp;', '&', $url);

         if (empty($SERVER_SOFTWARE))
            $SERVER_SOFTWARE = $_SERVER['SERVER_SOFTWARE'];

        // $SERVER_URL should end in '/', but we may not have it yet if we are
        // redirecting to the login.  If not, then pull it from the database.
        // If we have the server URL, then use a full URL, which is technically
        // required (but all browsers accept relative URLs here).
        // BUT, only do this if our URL does not start with '/' because then
        // we could end up with a URL like:
        //   http://www.k5n.us/webcalendar/webcalendar/month.php
        if (!empty($SERVER_URL) && substr($url, 0, 1) != '/') {
            $url = $SERVER_URL . $url;
        }

//echo "<pre>"; print_r ( debug_backtrace() ); echo "\n</pre>\n";
//echo "URL: $url <br>"; exit;

        $meta = '';
        if (( substr($SERVER_SOFTWARE, 0, 5) == 'Micro' ) ||
                ( substr($SERVER_SOFTWARE, 0, 3) == 'WN/' ))
            $meta = '<meta http-equiv="refresh" content="0; url=' . $url . '" />';
        else
            header('Location: ' . $url);

        echo send_doctype('Redirect') . $meta . '
  </head>
  <body>
    Redirecting to.. <a href="' . $url . '">here</a>.
  </body>
</html>';
        exit;
    }

}

?>