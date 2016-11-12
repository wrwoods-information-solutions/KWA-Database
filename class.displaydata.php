<?php

/**
 * *****************************************************
 * @file class.displaydata.php
 * @brief The displaydata class handles all displaydata functions
 * @author W.R.(Ric)Woods
 * @version  1.0
 * @copyright 2016
 * @date 15 September 2016
 */
require_once("class.validate.php");
require_once("class.messages.php");
require_once("class.pdodatabase.php");
require_once("displayrelationship.php");
require_once("displaystatus.php");
require_once "displaymembership.php";
require_once "displaymobilityaid.php";
require_once "displayaddress.php";
require_once "displaytelephone.php";
require_once "displayemail.php";
require_once "displaynotes.php";
require_once "displaygrid.php";

class DisplayData {

    private $results_per_page = 10;
    private $field_count = 0; // Num of fields
    private $row_count = 0; // Number of rows
    private $hide_header = false; // Header visibility
    private $hide_footer = false; // Footer visibility
    private $hide_order = false; // Show ordering option
    private $show_checkboxes = false; // Show checkboxes
    private $allow_filters = false; // Allow filters or not
    private $row_select = false; // Enable row selection
    private $create_button = false; // Show create button
    private $reset_button = false; // Show reset grid button
    private $show_row_number = false; // Show row numbers
    private $hide_page_list = false; // Hide page list
    private $primary = ''; // Tables primary key field
    private $query; // SQL query
    private $hidden = array(); // Hidden fields
    private $header = array(); // Header titles
    private $type = array(); // field types
    private $controls = array(); // Row controls, std or custom
    private $order = false; // Current order
    private $filter = false; // Current filter
    private $limit = false; // Current limit
    private $_db, $result; // Database related
    private $select_fields = ''; // Field used to select
    private $select_where = ''; // Where clause
    private $select_table = ''; // Table to read
    private $image_path = ''; // Path to images
    // Filename of required images
    public $img_edit = 'edit.png';
    public $img_write = 'editIcon_02.jpg';
    public $img_delete = 'delete.png';
    public $img_create = 'create.png';
    public $img_save = 'save.png';
    public $img_reset = 'reset.png';
    public $img_cancel = 'cancel.png';
    public $InLineEdit; // Inline editing
    public $inlinetype = array(); // Inline field types
    public $pid = ''; // primary ID 
    public $action; // action 
    public $urlparms;
    public $DeleteId; // record id to be deleted 
    public $DeleteRecord; // Delete record
    public $URLConstant; //URL Constant
    public $constantfields = array(); //fields constants
    public $fields = array(); // fields array
    public $row; // data for row
    public $NoofDBLines; // no. of DB lines
    public $NoofNewLines; // no. of new lines
    public $TotalLines; // total lines

    // Configuration constants

    const CUSCTRL_TEXT = 1;
    const CUSCTRL_IMAGE = 2;
    const STDCTRL_EDIT = 3;
    const STDCTRL_SAVE = 4;
    const STDCTRL_DELETE = 5;
    const STDCTRL_INLINEEDIT = 6;
    const TYPE_DATE = 1;
    const TYPE_IMAGE = 2;
    const TYPE_ONCLICK = 3;
    const TYPE_ARRAY = 4;
    const TYPE_DOLLAR = 5;
    const TYPE_HREF = 6;
    const TYPE_CHECK = 7;
    const TYPE_PERCENT = 8;
    const TYPE_CUSTOM = 9;
    const TYPE_FUNCTION = 10;
    const TYPE_PHPFUNCTION = 11;
    const TYPE_INLINEADDRECORD = 12;
    const TYPE_SQLCODEDISPLAY = 13;
    const TYPE_TEXT = 14;
    const TYPE_TEXTBOX = 20;
    const TYPE_CODEDISPLAY = 15;
    const TYPE_NOTE = 16;
    const TYPE_FIELD = 17;
    const TYPE_TELEPHONE = 18;
    const TYPE_EMAIL = 19;
    const ORDER_DESC = 'DESC';
    const ORDER_ASC = 'ASC';
    const INLINE_TEXT = 1;
    const INLINE_TEXTBOX = 2;
    const INLINE_CHECKBOX = 3;
    const INLINE_RADIO = 4;
    const INLINE_FILE = 5;
    const INLINE_CODECOMBO = 6;
    const INLINE_COMBOBOX = 7;
    const INLINE_DATECOMBO = 8;
    const INLINE_EMAIL = 9;
    const INLINE_PHONE = 10;
    const INLINE_POSTALCODE = 11;
    const INLINE_SINNUMBER = 12;
    const INLINE_NOTE = 13;
    const INLINE_TELEPHONE = 14;
    // Default text
    const TXT_RESET = 'Reset Table';

    /**
     * Constructor
     *
     * @param EyeMySQLAdap $_db The Eyesis MySQL Adapter class
     * @param string $image_path The path to displaydata images
     */
    function __construct($_db, $image_path = '') {
         $this->db = $_db;
        if (empty($image_path)) {
            $this->image_path = 'images/';
        } else {
            $this->image_path = $image_path;
        }
    }

    /**
     * Hides page drop down selection and replaces it with text
     *
     * @param $hide Show or hide the page drop down
     */
    function hidePageSelectList($hide = true) {
        $_SESSION['displaydata'][$_SESSION ["displaydata"] ["name"]]["hide_page_list"] = $hide;
    }

    /**
     * Allow filters
     *
     * @param boolean $allow
     */
    function allowFilters($allow = true) {
        $_SESSION['displaydata'][$_SESSION ["displaydata"] ["name"]]["allow_filters"] = $allow;
    }

    /**
     * Hide order functionality
     *
     * @param boolean $hide
     */
    function hideOrder($hide = true) {
        $_SESSION['displaydata'][$_SESSION ["displaydata"] ["name"]]["hide_order"] = $hide;
    }

    /**
     * Show checkboxes on each row
     *
     * @param boolean $show
     */
    function showCheckboxes($show = false) {
        $_SESSION['displaydata'][$_SESSION ["displaydata"] ["name"]]["show_checkboxes"] = $show;
    }

    /**
     * Hide header row
     *
     * @param boolean $hide
     */
    function hideHeader($hide = true) {
        $_SESSION['displaydata'][$_SESSION ["displaydata"] ["name"]]["hide_header"] = $hide;
    }

    /**
     * Hide footer row
     *
     * @param boolean $hide
     */
    function hideFooter($hide = true) {
        $_SESSION['displaydata'][$_SESSION ["displaydata"] ["name"]]["hide_footer"] = $hide;
    }

    /**
     * Show reset control
     *
     * @param string $text Display caption
     */
    function showReset($text = self::TXT_RESET) {
        $_SESSION['displaydata'][$_SESSION ["displaydata"] ["name"]]["reset_button"] = $text;
    }

    /**
     * Show row numbers
     *
     * @param boolean $show
     */
    function showRowNumber($show = true) {
        $_SESSION['displaydata'][$_SESSION ["displaydata"] ["name"]]["show_row_number"] = $show;
    }

    /**
     * Set the SELECT query
     *
     * @param string $fields Feilds to fetch from table. * for all fields
     * @param string $table Table to select from
     * @param string $primay Optional primary key field
     * @param string $where Optional where condition
     */
    function setQuery($fields, $table, $primary = '', $where = '') {
        $_SESSION['displaydata'][$_SESSION ["displaydata"] ["name"]]["table"] = $table;
        $_SESSION['displaydata'][$_SESSION ["displaydata"] ["name"]]["primary"] = $primary;
        $_SESSION['displaydata'][$_SESSION ["displaydata"] ["name"]]["select_fields"] = $fields;
        $_SESSION['displaydata'][$_SESSION ["displaydata"] ["name"]]["select_table"] = $table;
        $_SESSION['displaydata'][$_SESSION ["displaydata"] ["name"]]["select_where"] = $where;
        $_SESSION['displaydata'][$_SESSION ["displaydata"] ["name"]]["displaydatatype"] = 'db';
    }

    /**
     * Set the array
     *
     * @param string $array arrayto select from
     * @param string $fields Feilds to fetch from array.
     */
    function setArrayName($arrayname) {
        $_SESSION['displaydata'][$_SESSION ["displaydata"] ["name"]]["arrayname"] = $arrayname;
        $_SESSION['displaydata'][$_SESSION ["displaydata"] ["name"]]["displaydatatype"] = 'array';
    }

    /**
     * Set filter
     *
     * @param string $field field to apply filter clause on
     * @param string $value Value to compare to
     */
    function setFilter($field, $value) {
        $_SESSION['displaydata'][$_SESSION ["displaydata"] ["name"]]["filter"] = array('field' => $field, 'value' => $value);
    }

    /**
     * Set order
     *
     * @param string $field field to apply order clause on
     * @param string $order Direction, use ORDER_* const
     */
    function setOrder($field, $order = self::ORDER_ASC) {
        $order = ($order == self::ORDER_DESC) ? self::ORDER_DESC : self::ORDER_ASC;

        $_SESSION['displaydata'][$_SESSION ["displaydata"] ["name"]]["order"] = array('field' => $field,
            'order' => $order);
    }

    /**
     * Hides a field
     *
     * @param string $field The field to be hidden
     */
    function hidefield($field) {
        $_SESSION['displaydata'][$_SESSION ["displaydata"] ["name"]]["hidden"][] = $field;
    }

    /**
     * Change field header caption
     *
     * @param string $field The field name
     * @param string $header The new header caption
     */
    function SetFieldHeader($field, $header) {
        $_SESSION['displaydata'][$_SESSION ["displaydata"] ["name"]]["header"][$field] = $header;
    }

    /**
     * Set a field type
     *
     * @param string $field The field to apply the type to
     * @param integer $type The type of field, use TYPE_* const
     * @param mixed attributes Specific attributes of field type
     */
    function SetFieldType($field, $type, $attributes = array()) {
        $_SESSION['displaydata'][$_SESSION ["displaydata"] ["name"]]["type"][$field] = array();
        $_SESSION['displaydata'][$_SESSION ["displaydata"] ["name"]]["type"][$field]['field'] = $field;
        $_SESSION['displaydata'][$_SESSION ["displaydata"] ["name"]]["type"][$field]['type'] = $type;
        foreach ($attributes as $key => $value) {
            $_SESSION['displaydata'][$_SESSION ["displaydata"] ["name"]]["type"][$field][$key] = $value;
        }
        if ($type == displaydata::TYPE_NOTE) {
            if (!isset($_SESSION['displaydata']['typenames'])) {
                $_SESSION['displaydata']['typenames'] = array();
            }
            if (!in_array($field, $_SESSION['displaydata']['typenames'])) {
                $_SESSION['displaydata']['typenames'][] = $_SESSION['displaydata'][$_SESSION ["displaydata"] ["name"]]["type"][$field]['name'];
            }
        }
    }

    /**
     * Set a inline field type
     *
     * @param string $field The field to apply the type to
     * @param integer $type The type of field, use TYPE_* const
     * @param mixed $attributes Specific attributes of field type
     */
    function SetInlineFieldType($field, $type, $attributes = array()) {
        $_SESSION['displaydata'][$_SESSION ["displaydata"] ["name"]]["inlinetype"][$field] = array();
        $_SESSION['displaydata'][$_SESSION ["displaydata"] ["name"]]["inlinetype"][$field]['field'] = $field;
        $_SESSION['displaydata'][$_SESSION ["displaydata"] ["name"]]["inlinetype"][$field]['type'] = $type;
        foreach ($attributes as $key => $value) {
            $_SESSION['displaydata'][$_SESSION ["displaydata"] ["name"]]["inlinetype"][$field][$key] = $value;
        }
        if ($type == displaydata::INLINE_NOTE) {
            if (!isset($_SESSION['displaydata']['inlinenames'])) {
                $_SESSION['displaydata']['inlinenames'] = array();
            }
            if (!in_array($field, $_SESSION['displaydata']['inlinenames'])) {
                $_SESSION['displaydata']['inlinenames'][] = $_SESSION['displaydata'][$_SESSION ["displaydata"] ["name"]]["inlinetype"][$field]['name'];
            }
        }
    }

    /**
     * Sets the maximum amount of rows per page
     *
     * @param integer $num Amount of rows per page
     */
    function setResultsPerPage($num) {
        $_SESSION['displaydata'][$_SESSION ["displaydata"] ["name"]]["results_per_page"] = (int) $num;
        $this->setLimit(0, (int) $num);
    }

    /**
     * Sets the the fields Cnstant
     *
     * @param text $constant
     */
    function setConstantFields($constant) {
        $_SESSION['displaydata'][$_SESSION ["displaydata"] ["name"]]["constantfields"] = $constant;
    }

    /**
     * Sets the the Common Comb Cchoices
     *
     * @param text $choices
     */
    function setinsertvalue($insertvalue) {
        $_SESSION['displaydata'][$_SESSION ["displaydata"] ["name"]]['insertvalue'] = $insertvalue;
    }

    /**
     * Sets the the Common Comb Cchoices
     *
     * @param text $choices
     */
    function setcommoncombochoices($choices) {
        $_SESSION['displaydata']['commoncombochoices'] = $choices;
    }

    /**
     * Sets the the file extension 
     *
     * @param text $extentions
     */
    function setFileExtentions($extentions) {
        $_SESSION['displaydata']['fileextentions'] = $extentions;
    }

    /**
     * Sets the the URL Constant
     *
     * @param text $urlconstant
     */
    function setURLConstant($constant) {
        $_SESSION['displaydata'][$_SESSION ["displaydata"] ["name"]]["urlparms"] = $constant . "?page=" . $_SESSION['displaydata'][$_SESSION ["displaydata"] ["name"]]["page"];
    }

    function setdisplaydata($name = 'displaydata') {
        $_SESSION ["displaydata"] ["name"] = $name;
        $_SESSION['displaydata'][$_SESSION ["displaydata"] ["name"]]["results_per_page"] = 0;
        $_SESSION['displaydata'][$_SESSION ["displaydata"] ["name"]]["field_count"] = 0;
        if (!isset($_SESSION['displaydata'][$_SESSION ["displaydata"] ['name']]["page"])) {
            $_SESSION['displaydata'][$_SESSION ["displaydata"] ['name']]["page"] = 1;
            $this->setLimit(0, $_SESSION['displaydata'][$_SESSION ["displaydata"] ["name"]]["results_per_page"] - 1);
        }
        if ($_SESSION['displaydata'][$_SESSION ["displaydata"] ['name']]["page"] > 1) {
            $this->setLimit(($_SESSION['displaydata'][$_SESSION ["displaydata"] ["name"]]["page"] - 1) * ($_SESSION['displaydata'][$_SESSION ["displaydata"] ["name"]]["results_per_page"]), (($_SESSION['displaydata'][$_SESSION ["displaydata"] ["name"]]["page"] - 1) * ($_SESSION['displaydata'][$_SESSION ["displaydata"] ["name"]]["results_per_page"])) + $_SESSION['displaydata'][$_SESSION ["displaydata"] ["name"]]["results_per_page"] - 1);
        }
        if (!isset($_SESSION['displaydata'][$_SESSION ["displaydata"] ['name']]["line"])) {
            $_SESSION['displaydata'][$_SESSION ["displaydata"] ['name']]["line"] = 1;
        }
        if (!isset($_SESSION['displaydata'][$_SESSION ["displaydata"] ['name']]["insertrecord"])) {
            $_SESSION['displaydata'][$_SESSION ["displaydata"] ["name"]]["insertrecord"] = false;
        }
        if (!isset($_SESSION['displaydata'][$_SESSION ["displaydata"] ['name']]["updaterecord"])) {
            $_SESSION['displaydata'][$_SESSION ["displaydata"] ["name"]]["updaterecord"] = false;
        }
        if (!isset($_SESSION['displaydata'][$_SESSION ["displaydata"] ['name']]["deleterecord"])) {
            $_SESSION['displaydata'][$_SESSION ["displaydata"] ["name"]]["deleterecord"] = false;
        }
        if (!isset($_SESSION['displaydata'][$_SESSION ["displaydata"] ['name']]["noofdblines"])) {
            $_SESSION['displaydata'][$_SESSION ["displaydata"] ["name"]]["noofdblines"] = 0;
        }
        if (!isset($_SESSION['displaydata'][$_SESSION ["displaydata"] ['name']]["noofnewlines"])) {
            $_SESSION['displaydata'][$_SESSION ["displaydata"] ["name"]]["noofnewlines"] = 0;
        }
        if (!isset($_SESSION['displaydata'][$_SESSION ["displaydata"] ['name']]["filter"])) {
            $_SESSION['displaydata'][$_SESSION ["displaydata"] ["name"]]["filter"] = array();
        }
        if (!isset($_SESSION['displaydata'][$_SESSION ["displaydata"] ["name"]]["click"])) {
            $_SESSION['displaydata'][$_SESSION ["displaydata"] ["name"]]["click"] = false;
        }
        if (!isset($_SESSION['displaydata'][$_SESSION ["displaydata"] ["name"]]["mastermenunew"])) {
            $_SESSION['displaydata'][$_SESSION ["displaydata"] ["name"]]["mastermenunew"] = false;
        }
        if (!isset($_SESSION['displaydata'][$_SESSION ["displaydata"] ["name"]]["displaygrid"])) {
            $_SESSION['displaydata'][$_SESSION ["displaydata"] ["name"]]["displaygrid"] = false;
        }
        if (!isset($_SESSION['displaydata'][$_SESSION ["displaydata"] ["name"]]["pleaseselect"])) {
            $_SESSION['displaydata'][$_SESSION ["displaydata"] ["name"]]["pleaseselect"] = true;
        }
        if (!isset($_SESSION['displaydata'][$_SESSION ["displaydata"] ["name"]]["isertline"])) {
            $_SESSION['displaydata'][$_SESSION ["displaydata"] ["name"]]["insertline"] = 0;
        }
        if (!isset($_SESSION['displaydata'][$_SESSION ["displaydata"] ["name"]]["editline"])) {
            $_SESSION['displaydata'][$_SESSION ["displaydata"] ["name"]]["editline"] = 0;
        }
        if (!isset($_SESSION['displaydata'][$_SESSION ["displaydata"] ["name"]]["deletelne"])) {
            $_SESSION['displaydata'][$_SESSION ["displaydata"] ["name"]]["deleteline"] = 0;
        }
        if (!isset($_SESSION['displaydata'][$_SESSION ["displaydata"] ["name"]]["allow_filters"])) {
            $_SESSION['displaydata'][$_SESSION ["displaydata"] ["name"]]["allow_filters"] = false;
        }
        if (!isset($_SESSION['displaydata'][$_SESSION ["displaydata"] ["name"]]["results_per_page"])) {
            $_SESSION['displaydata'][$_SESSION ["displaydata"] ["name"]]["results_per_page"] = 0;
        }
        if (!isset($_SESSION['displaydata'][$_SESSION ["displaydata"] ["name"]]["show_checkboxes"])) {
            $_SESSION['displaydata'][$_SESSION ["displaydata"] ["name"]]["show_checkboxes"] = false;
        }
        if (!isset($_SESSION['displaydata'][$_SESSION ["displaydata"] ["name"]]["controls"])) {
            $_SESSION['displaydata'][$_SESSION ["displaydata"] ["name"]]["controls"] = array();
        }
        if (!isset($_SESSION['displaydata'][$_SESSION ["displaydata"] ["name"]]["row_count"])) {
            $_SESSION['displaydata'][$_SESSION ["displaydata"] ["name"]]["row_count"] = 0;
        }
    }

    function SetTemplate($template = '', $db) {
        if (!is_null($template)) {
            $_SESSION["displaydata"][$_SESSION ["displaydata"] ["name"]]["template"] = $template;
        }
    }

    function setrowsandlines() {
        $_SESSION['displaydata'][$_SESSION ["displaydata"] ["name"]]["noofdblines"] = $_SESSION['displaydata'][$_SESSION ["displaydata"] ["name"]]["row_count"];
        $_SESSION['displaydata'][$_SESSION ["displaydata"] ["name"]]["TotalLines"] = $_SESSION['displaydata'][$_SESSION ["displaydata"] ["name"]]["noofdblines"] + $_SESSION['displaydata'][$_SESSION ["displaydata"] ["name"]]["noofnewlines"];
        $rowx = array();
        $_SESSION['displaydata'][$_SESSION ["displaydata"] ["name"]]["row"] = array();
        foreach ($_SESSION['displaydata'][$_SESSION ["displaydata"] ["name"]]["result"] as $rowx) {
            $_SESSION['displaydata'][$_SESSION ["displaydata"] ["name"]]["row"][] = $rowx;
        }
        if ($_SESSION['displaydata'][$_SESSION ["displaydata"] ["name"]]["page"] == 1) {
            $_SESSION['displaydata'][$_SESSION ["displaydata"] ["name"]]["firstline"] = 1;
        } else {
            $_SESSION['displaydata'][$_SESSION ["displaydata"] ["name"]]["firstline"] = (($_SESSION['displaydata'][$_SESSION ["displaydata"] ["name"]]["page"] - 1) * $_SESSION['displaydata'][$_SESSION ["displaydata"] ["name"]]["results_per_page"] ) + 1;
        }
        if ($_SESSION['displaydata'][$_SESSION ["displaydata"] ["name"]]["TotalLines"]< ($_SESSION['displaydata'][$_SESSION ["displaydata"] ["name"]]["firstline"]+$_SESSION['displaydata'][$_SESSION ["displaydata"] ["name"]]["results_per_page"]))
        {    
            $_SESSION['displaydata'][$_SESSION ["displaydata"] ["name"]]["lastline"] = $_SESSION['displaydata'][$_SESSION ["displaydata"] ["name"]]["TotalLines"]; // Last line
        }else{
            $_SESSION['displaydata'][$_SESSION ["displaydata"] ["name"]]["lastline"] = ($_SESSION['displaydata'][$_SESSION ["displaydata"] ["name"]]["firstline"] + $_SESSION['displaydata'][$_SESSION ["displaydata"] ["name"]]["results_per_page"]-1); // Last line                
        }    
        $_SESSION['displaydata'][$_SESSION ["displaydata"] ["name"]]["loopstartrow"] = $_SESSION['displaydata'][$_SESSION ["displaydata"]["name"]]["firstline"]-1;
//        $_SESSION['displaydata'][$_SESSION ["displaydata"] ["name"]]["loopendrow"] = $_SESSION['displaydata'][$_SESSION ["displaydata"] ["name"]]["lastline"]-1;
//        if ($_SESSION['displaydata'][$_SESSION ["displaydata"] ["name"]]["lastline"] > ($_SESSION['displaydata'][$_SESSION ["displaydata"] ["name"]]["TotalLines"])) {
//            $_SESSION['displaydata'][$_SESSION ["displaydata"] ["name"]]["lastline"] = $_SESSION['displaydata'][$_SESSION ["displaydata"] ["name"]]["TotalLines"];
             $_SESSION['displaydata'][$_SESSION ["displaydata"] ["name"]]["loopendrow"] = $_SESSION['displaydata'][$_SESSION ["displaydata"] ["name"]]["TotalLines"] - 1;
    }
    /**
     * Adds a standard control to a row
     *
     * @param integer $type The type of standard control, use STDCTRL_* const
     * @param string $action The action of the control (onclick code or href link)
     * @param integer $action_type The type of action, use TYPE_ONCLICK or TYPE_HREF
     */
    function addStandardControl($type, $action, $action_type = self::TYPE_ONCLICK) {
        $action = $action . "?page=" . $_SESSION['displaydata'][$_SESSION ["displaydata"] ["name"]]["page"];
        $action = $this->parseLinkAction($action, $action_type);

        switch ($type) {
            case self::STDCTRL_EDIT:
                $_SESSION['displaydata'][$_SESSION ["displaydata"] ["name"]]["controls"][] = '<a ' . $action . '><img src="' . $this->image_path . $_SESSION['displaydata'][$_SESSION ["displaydata"] ["name"]]["img_edit"] . '" alt="Edit" title="Edit" class="tbl-control-image"></a>';
                break;
            case self::STDCTRL_DELETE:
                $_SESSION['displaydata'][$_SESSION ["displaydata"] ["name"]]["controls"][] = '<a ' . $action . '><img src="' . $this->image_path . $_SESSION['displaydata'][$_SESSION ["displaydata"] ["name"]]["img_delete"] . '" alt="Delete" title="Delete" class="tbl-control-image"></a>';
                break;
            case self::STDCTRL_INLINEEDIT:
                $_SESSION['displaydata'][$_SESSION ["displaydata"] ["name"]]["action"] = $action;
                break;

            case self::STDCTRL_SAVE:
                $_SESSION['displaydata'][$_SESSION ["displaydata"] ["name"]]["controls"][] = '<a ' . $action . '><img src="' . $this->image_path . $_SESSION['displaydata'][$_SESSION ["displaydata"] ["name"]]["img_save"] . '" alt="Save" title="Save" class="tbl-control-image"></a>';
                break;
            case self::STDCTRL_RESET:
                $_SESSION['displaydata'][$_SESSION ["displaydata"] ["name"]]["controls"][] = '<a ' . $action . '><img src="' . $this->image_path . $_SESSION['displaydata'][$_SESSION ["displaydata"] ["name"]]["img_reset"] . '" alt="Reset" title="Reset" class="tbl-control-image"></a>';
                break;
            default:
                // Invalid standard control
                break;
        }
    }

    /**
     * Adds a custom control to a row
     *
     * @param integer $type The type of custom control, use CUSCTRL_* const
     * @param string $action The action of the control (onclick code or href link)
     * @param integer $action_type The type of action, use TYPE_ONCLICK or TYPE_HREF
     * @param string $text The textual description of the control
     * @param string $image_path The location of the image if type is CUSCTRL_IMAGE
     */
    function addCustomControl($type = self::CUSCTRL_TEXT, $action, $action_type = self::TYPE_ONCLICK, $text, $image_src = '') {
        $action = $_SESSION['displaydata'][$_SESSION ["displaydata"] ["name"]]["parseLinkAction"]($action, $action_type);

        switch ($type) {
            case self::CUSCTRL_IMAGE:
                $_SESSION['displaydata'][$_SESSION ["displaydata"] ["name"]]["controls"][] = '<a ' . $action . '><img src="' . $image_src . '" alt="' . $text . '" title="' . $text . '" class="tbl-control-image"></a>';
                break;
            default: // Default to text
                $_SESSION['displaydata'][$_SESSION ["displaydata"] ["name"]]["controls"][] = '<a ' . $action . '>' . $text . '</a>';
                break;
        }
    }

    /**
     * Adds a create control above the table
     *
     * @param string $action The action associated to the create (onclick code or href link)
     * @param integer $action_type The type of action, use TYPE_ONCLICK or TYPE_HREF
     * @param string $text The textual description of the create
     */
    function showCreateButton($action, $action_type = self::TYPE_ONCLICK, $text = 'New Record') {
        $action = $action . "?page=" . $_SESSION['displaydata'][$_SESSION ["displaydata"] ["name"]]["page"];
        switch ($action_type) {
            case self::TYPE_ONCLICK:
                $action = $_SESSION['displaydata'][$_SESSION ["displaydata"] ["name"]]["parseLinkAction"]($action, $action_type);

                break;
            case self::TYPE_PHPFUNCTION:
                $action = 'href="' . $action . '"';
                break;
            case self::TYPE_INLINEADDRECORD:
                $action = 'href="' . $action . '"';
                break;
            default:
                $action = 'href="' . $action . '"';
        }
        $_SESSION['displaydata'][$_SESSION ["displaydata"] ["name"]]["create_button"] = array('Action' => $action, 'Text' => $text);
        $_SESSION['displaydata'][$_SESSION ["displaydata"] ["name"]]["creatrecordtext"] = $text;
    }

    /**
     * Adds ability to select a entire row
     *
     * @param string $onclick The JS function to call when a row is clicked
     */
    function addRowSelect($onclick) {
        $_SESSION['displaydata'][$_SESSION ["displaydata"] ["name"]]["row_select"] = $onclick;
    }

    /**
     * Data sanitization and control for filters and ordering
     *
     * @param string $in The value to be sanitized and parsed
     */
    function parseInputCond($in) {
        return explode(':', preg_replace("[\'\"\<\>\\]", '%', $in), 2);
    }

    /**
     * Replaces our variables place holders with values
     *
     * @param array $row The row associated array
     * @param string $act The string containing place holders to replace
     * @return string
     */
    function parseVariables(array $row, $act) {
        // The only way we get an array for $act is for parameters from a field type of function
        if (is_array($act)) {
            // Loop through each passed param and replace variables where necessary
            foreach ($act as $key => $value) {
                $act[$key] = $this->parseVariables($_SESSION['displaydata'][$_SESSION ["displaydata"] ["name"]]["row"], $value);
            }
            return $act;
        }

        // %_P% is an alias for the primary key, replace it with the primary key
        if ($_SESSION['displaydata'][$_SESSION ["displaydata"] ["name"]]["primary"])
            $act = str_replace('%_P%', '%' . $_SESSION['displaydata'][$_SESSION ["displaydata"] ["name"]]["primary"] . '%', $act);

        preg_match_all("/%([A-Za-z0-9_ \-]*)%/", $act, $vars);

        foreach ($vars[0] as $v)
            $act = str_replace($v, $_SESSION['displaydata'][$_SESSION ["displaydata"] ["name"]]["row"][str_replace('%', '', $v)], $act);

        return $act;
    }

    /**
     * Builds a link action
     *
     * @param string $action The action
     * @param integer $action_type The type of actions (onclick code or href link)
     * @return string
     */
    function parseLinkAction($action, $action_type) {
        if ($action_type == self::TYPE_ONCLICK)
            $action = 'href="javascript:;" onclick="' . $action . '"';
        else
            $action = "href=\"" . $action;

        return $action;
    }

    /**
     * Sets the limit by clause
     *
     * @param integer $low The minimum row number
     * @param integer $high The maximum row number
     */
    function setLimit($low, $high) {
        $_SESSION['displaydata'][$_SESSION ["displaydata"] ["name"]]["limit"] = array('low' => $low, 'high' => $high);
    }

    /**
     * Checks to see if this is an ajax table
     *
     * @return boolean
     */
    function isAjaxUsed() {
        if (!empty($_GET ["useajax"]) and $_GET ["useajax"] == 'true')
            return true;

        return false;
    }

    /**
     * Creates the table header
     *
     */
    function buildHeader() {
        // If entire header is hidden, skip all together
        if (!isset($_SESSION['displaydata'][$_SESSION ["displaydata"] ["name"]]["hide_header"])) {
            $_SESSION['displaydata'][$_SESSION ["displaydata"] ["name"]]["hide_header"] = true;
            return;
        }
        echo '<table class="tbl">';
        echo '<thead><tr>';

        // Get field names of result
        $fieldlist = "'" . $_SESSION['displaydata'][$_SESSION ["displaydata"] ["name"]]["select_fields"] . "'";
        $fieldlist = str_replace(",", "','", $fieldlist);
        $sql = "SELECT " . $fieldlist . " FROM " . $_SESSION['displaydata'][$_SESSION ["displaydata"] ["name"]]["select_table"];

        $result = $this->db->query($sql);
        $fields = $result->fetchAll(PDO::FETCH_ASSOC);
        $field = $fields[0];
        if ($result) {
            foreach ($field as $key => $value) {
                $_SESSION['displaydata'][$_SESSION ["displaydata"] ["name"]]["field"][] = $value;
            }
        }
        $_SESSION['displaydata'][$_SESSION ["displaydata"] ["name"]]["field_count"] = count($_SESSION['displaydata'][$_SESSION ["displaydata"] ["name"]]["field"]);
        // Add a blank field if the row number is to be shown
        if ($_SESSION['displaydata'][$_SESSION ["displaydata"] ["name"]]["show_row_number"]) {
            $_SESSION['displaydata'][$_SESSION ["displaydata"] ["name"]]["field_count"] ++;
            echo '<td class="tbl-header">&nbsp;</td>';
        }
        // Show checkboxes
        if ($_SESSION['displaydata'][$_SESSION ["displaydata"] ["name"]]["show_checkboxes"]) {
            $_SESSION['displaydata'][$_SESSION ["displaydata"] ["name"]]["field_count"] ++;
            echo '<td class="tbl-header tbl-checkall"><input type="checkbox" name="checkall" onclick="tblToggleCheckAll()"></td>';
        }

        // Loop through each header and output it
        foreach ($field as $t) {
            // Skip field if hidden
            if (in_array($t, $_SESSION['displaydata'][$_SESSION ["displaydata"] ["name"]]["hidden"])) {
                $_SESSION['displaydata'][$_SESSION ["displaydata"] ["name"]]["field_count"] --;
                continue;
            }

            // Check for header caption overrides

            if (array_key_exists($t, $_SESSION['displaydata'][$_SESSION ["displaydata"] ["name"]]["header"]))
                $header = $_SESSION['displaydata'][$_SESSION ["displaydata"] ["name"]]["header"][$t];
            else
                $header = $t;

            if ($_SESSION['displaydata'][$_SESSION ["displaydata"] ["name"]]["hide_order"])
                echo '<td class="tbl-header">' . $header; // Prevent the user from changing order
            else {
                if ($_SESSION['displaydata'][$_SESSION ["displaydata"] ["name"]]["order"] and $_SESSION['displaydata'][$_SESSION ["displaydata"] ["name"]]["order"] ["field"] == $t)
                    $order = ($_SESSION['displaydata'][$_SESSION ["displaydata"] ["name"]]["order"] ["order"] == self::ORDER_ASC) ? self::ORDER_DESC : self::ORDER_ASC;
                else
                    $order = self::ORDER_ASC;
                echo '<td class="tbl-header"><a href="javascript:;" onclick="tblSetOrder(\'' . $t . '\', \'' . $order . '\')">' . $header . "</a></td>";

                // Show the user the order image if set
                if ($_SESSION['displaydata'][$_SESSION ["displaydata"] ["name"]]["order"] and $_SESSION['displaydata'][$_SESSION ["displaydata"] ["name"]]["order"] ["field"] == $t)
                    echo '&nbsp;<img src="' . $this->image_path . 'sort_' . strtolower($_SESSION['displaydata'][$_SESSION ["displaydata"] ["name"]]["order"] ["order"]) . '.gif" class="tbl-order">';
                echo '</td>';
            }

            // Add filters if allowed and only if the 
            //	echo '</td>';
        }

        // If we have controls, add a blank field
        if (count($_SESSION['displaydata'][$_SESSION ["displaydata"] ["name"]]["controls"]) > 0) {
            $_SESSION['displaydata'][$_SESSION ["displaydata"] ["name"]]["field_count"] ++;
            echo '<td class="tbl-header">&nbsp;</td>';
        }
        if ($_SESSION['displaydata'][$_SESSION ["displaydata"] ["name"]]["InLineEdit"]) {
            $_SESSION['displaydata'][$_SESSION ["displaydata"] ["name"]]["field_count"] ++;
            echo '<td class="tbl-header">&nbsp;</td>';
        }
        echo '</tr></thead>';
    }

    /**
     * Creates the table footer
     *
     * @param integer $shown The amounts of rows being shown in the current page
     * @param integer $first The row number of the first row
     * @param integer $last The row number of the last row
     */
    function buildFooter($shown, $first = 1, $last = 0) {
        // Skip adding the footer if it is hidden
        if (!isset($_SESSION['displaydata'][$_SESSION ["displaydata"] ["name"]]["hide_footer"]))
            $_SESSION['displaydata'][$_SESSION ["displaydata"] ["name"]]["hide_footer"] = true;
        if ($_SESSION['displaydata'][$_SESSION ["displaydata"] ["name"]]["hide_footer"])
            return;

        $pages = ceil($_SESSION['displaydata'][$_SESSION ["displaydata"] ["name"]]["row_count"] / $_SESSION['displaydata'][$_SESSION ["displaydata"] ["name"]]["results_per_page"]); // Total number of pages
        echo '<tfoot><tr class="tbl-footer"><td class="tbl-nav" colspan="' . $_SESSION['displaydata'][$_SESSION ["displaydata"] ["name"]]["field_count"] . '"><table width="100%" class="tbl-footer"><tr><td width="33%" class="tbl-found">Found <em>' . $_SESSION['displaydata'][$_SESSION ["displaydata"] ["name"]]["TotalLines"] . '</em> results';

        if ($_SESSION['displaydata'][$_SESSION ["displaydata"] ["name"]]["row_count"] > 0)
            echo ', showing <em>' . $_SESSION['displaydata'][$_SESSION ["displaydata"] ["name"]]["firstline"] . '</em> to <em>' . $_SESSION['displaydata'][$_SESSION ["displaydata"] ["name"]]["lastline"] . '</em>';

        echo '</td><td wdith="33%" class="tbl-pages">';

        // Handle results that span multiple pages
        if ($_SESSION['displaydata'][$_SESSION ["displaydata"] ["name"]]["row_count"] > $_SESSION['displaydata'][$_SESSION ["displaydata"] ["name"]]["results_per_page"]) {
            if ($_SESSION['displaydata'][$_SESSION ["displaydata"] ["name"]]["page"] > 1)
                echo '<a hre="javascript:;" onclick="tblSetPage(' . $first . ')"><img src="' . $this->image_path . 'arrow_first.gif" class="tbl-arrows" alt="&lt;&lt;" title="First Page"></a><a href="javascript:;" onclick="tblSetPage(' . $first . ')><img src="' . $this->image_path . 'arrow_left.gif" class="tbl-arrows" alt="&lt;" title="Previous Page"></a>';
            else
                echo '<img src="' . $this->image_path . 'arrow_first_disabled.gif" class="tbl-arrows" alt="&lt;&lt;" title="First Page"><img src="' . $this->image_path . 'arrow_left_disabled.gif" class="tbl-arrows" alt="&lt;" title="Previous Page">';

            // Special thanks to ionut for this next few lines
            $startpage = ($_SESSION['displaydata'][$_SESSION ["displaydata"] ["name"]]["page"] > 10) ? $_SESSION['displaydata'][$_SESSION ["displaydata"] ["name"]]["page"] - 10 : 1;

            $endpage = (($pages - 10) > $_SESSION['displaydata'][$_SESSION ["displaydata"] ["name"]]["page"]) ? $_SESSION['displaydata'][$_SESSION ["displaydata"] ["name"]]["page"] + 10 : $pages;

            // Only display a portion of the selectable pages
            for ($_SESSION['displaydata'][$_SESSION ["displaydata"] ["name"]]['i'] = $startpage; $_SESSION['displaydata'][$_SESSION ["displaydata"] ["name"]]['i'] <= $endpage; $_SESSION['displaydata'][$_SESSION ["displaydata"] ["name"]]['i'] ++) {
                if ($_SESSION['displaydata'][$_SESSION ["displaydata"] ["name"]]['i'] == $_SESSION['displaydata'][$_SESSION ["displaydata"] ["name"]]["page"])
                    echo '&nbsp;<span class="page-selected">' . $_SESSION['displaydata'][$_SESSION ["displaydata"] ["name"]]['i'] . '</span>&nbsp;';
                else
                    echo '&nbsp;<a href="javascript:;" onclick="tblSetPage(' . $_SESSION['displaydata'][$_SESSION ["displaydata"] ["name"]]['i'] . ')">' . $_SESSION['displaydata'][$_SESSION ["displaydata"] ["name"]]['i'] . '</a>&nbsp;';
            }

            if ($_SESSION['displaydata'][$_SESSION ["displaydata"] ["name"]]["page"] < $pages)
                echo '<a href="javascript:;" onclick="tblSetPage(' . ($_SESSION['displaydata'][$_SESSION ["displaydata"] ["name"]]["page"] + 1) . ')"><img src="' . $this->image_path . 'arrow_right.gif" class="tbl-arrows" alt="&gt;" title="Next Page"></a><a href="javascript:;" onclick="tblSetPage(' . $pages . ')"><img src="' . $this->image_path . 'arrow_last.gif" class="tbl-arrows" alt="&gt;&gt;" title="Last Page"></a>';
            else
                echo '<img src="' . $this->image_path . 'arrow_right_disabled.gif" class="tbl-arrows" alt="&gt;" title="Next Page"><img src="' . $this->image_path . 'arrow_last_disabled.gif" class="tbl-arrows" alt="&gt;&gt;" title="Last Page">';
        }

        echo '</td><td width="33%" class="tbl-page">';

        // Only show page section if we have more than one page
        if ($pages > 0) {
            echo 'Page ';
            if (!$_SESSION['displaydata'][$_SESSION ["displaydata"] ["name"]]["hide_page_list"] and $pages > 1) {
                // Create a selectable drop down list for pages
                echo '<select name="tbl-page" onchange="tblSetPage(this.options[this.selectedIndex].value)">';
                for ($x = 1; $x <= $pages; $x++) {
                    echo '<option value="' . $x . '"';
                    if ($x == $_SESSION['displaydata'][$_SESSION ["displaydata"] ["name"]]["page"])
                        echo ' selected="selected"';
                    echo '>' . $x . '</option>';
                }
                echo '</select>';
            } else
                echo $_SESSION['displaydata'][$_SESSION ["displaydata"] ["name"]]["page"]; // Just write the page number, nothing to fancy

            echo ' of ' . $pages;
        }

        echo '</td></tr></table></td></tr></tfoot>';
    }

    /**
     * Builds row controls
     *
     * @param array $row The row associated array
     */
    function buildControls(array $row, $pid, $line) {
        // Add controls as needed
        if ($_SESSION['displaydata'][$_SESSION ["displaydata"] ["name"]]["InLineEdit"]) {
            if ($_SESSION['displaydata'][$_SESSION ["displaydata"] ["name"]]["editline"] == $line) {
                //Save Record
                $_SESSION['displaydata'][$_SESSION ["displaydata"] ["name"]]["controls"][1] = '<input class="" type="submit" name="saveline[]" value="S' . $line . '">';
//					//Cancel Record
                $_SESSION['displaydata'][$_SESSION ["displaydata"] ["name"]]["controls"][2] = '<input class="" type="submit" name="cancelline[]" value="X' . $line . '">';
            } else {
                //Edit Record
                $_SESSION['displaydata'][$_SESSION ["displaydata"] ["name"]]["controls"][1] = '<input class="" type="submit" name="editline[]" value="E' . $line . '">';
                //Delete Record
                $_SESSION['displaydata'][$_SESSION ["displaydata"] ["name"]]["controls"][2] = '<input class="" type="submit" name="deleteline[]" value="D' . $line . '">';
            }
        }
        if (count($_SESSION['displaydata'][$_SESSION ["displaydata"] ["name"]]["controls"]) > 0) {
            echo '<td class="tbl-controls">';
            foreach ($_SESSION['displaydata'][$_SESSION ["displaydata"] ["name"]]["controls"] as $ctl) {
                echo $this->parseVariables($_SESSION['displaydata'][$_SESSION ["displaydata"] ["name"]]["row"], $ctl);
            }
            echo '</td>';
        }
    }

    /**
     * Prints out script to handle Ajax data grids
     *
     * @param string $respo
     */
    function useAjaxTable($responce = '') {
        self::printJavascript();
        // If no responce script is set, use the current script
        if (empty($responce))
            $responce = $_SERVER ["PHP_SELF"];
        echo "<script type=\"text/javascript\">\n";
        echo "var xmlHttp\n";
        echo "function SetXmlHttpObject() {\n";
        echo "xmlHttp = null;\n";
        echo "try { xmlHttp = new XMLHttpRequest(); }\n";
        echo "catch (e) {\n";
        echo "try { xmlHttp = new ActiveXObject('Msxml2.XMLHTTP'); }\n";
        echo "catch (e) { xmlHttp = new ActiveXObject('Microsoft.XMLHTTP'); } }\n";
        echo "if (xmlHttp == null) {alert('Your web browser does not support Ajax'); }\n";
        echo "return xmlHttp; }\n";
        echo "function stateChanged() { if (xmlHttp.readyState == 4) { document.getElementById('eyedisplaydata').innerHTML = xmlHttp.responseText; } }\n";
        echo "function updateTable() { xmlHttp = SetXmlHttpObject(); xmlHttp.onreadystatechange = stateChanged; xmlHttp.open('GET', '" . $responce . "?useajax=true' + params, true); xmlHttp.send(null); }\n";
        echo "</script>\n";
        echo "<div id=\"eyedisplaydata\"></div>\n";
        echo "<script type=\"text/javascript\">updateTable();</script>\n";
    }

    /**
     * Prints the required JS functions
     *
     */
    function printJavascript() {
        if (!isset($_SESSION['displaydata'][$_SESSION ["displaydata"] ["name"]]["page"])) {
            $_SESSION['displaydata'][$_SESSION ["displaydata"] ["name"]]["page"] = 0;
        }
        if (!isset($_SESSION['displaydata'][$_SESSION ["displaydata"] ["name"]]["order"])) {
            $_SESSION['displaydata'][$_SESSION ["displaydata"] ["name"]]["order"] = array();
        }
        if (!isset($_SESSION['displaydata'][$_SESSION ["displaydata"] ["name"]]["filter"])) {
            $_SESSION['displaydata'][$_SESSION ["displaydata"] ["name"]]["filter"] = array();
        }
        $page = $_SESSION['displaydata'][$_SESSION ["displaydata"] ["name"]]["page"];
        $order = (($_SESSION['displaydata'][$_SESSION ["displaydata"] ["name"]]["order"]) ? implode(':', $_SESSION['displaydata'][$_SESSION ["displaydata"] ["name"]]["order"]) : '');
        $filter = (($_SESSION['displaydata'][$_SESSION ["displaydata"] ["name"]]["filter"]) ? implode(':', $_SESSION['displaydata'][$_SESSION ["displaydata"] ["name"]]["filter"]) : '');
        echo "<script type=\"text/javascript\">\n";
        echo "var params = ''; var tblpage = '" . $page . "'; var tblorder = '" . $order . "'; var tblfilter = '" . $filter . "';\n";
        echo "function tblSetPage(page) { tblpage = page; params = '&page=' + page + '&order=' + tblorder + '&filter=' + tblfilter; updateTable(); }\n";
        echo "function tblSetOrder(field, order) { tblorder = field + ':' + order; params = '&page=' + tblpage + '&order=' + tblorder + '&filter=' + tblfilter; updateTable(); }\n";
        echo "function tblSetFilter(field) { val = document.getElementById('filter-value-' + field).value; tblfilter = field + ':' + val; tblpage = 1; params = '&page=1&order=' + tblorder + '&filter=' + tblfilter; updateTable(); }\n";
        echo "function tblClearFilter() { tblfilter = ''; params = '&page=1&order=' + tblorder + '&filter='; updateTable(); }\n";
        echo "function tblToggleCheckAll() { for (i = 0; i < document.dg.checkbox.length; i++) { document.dg.checkbox['i'] .checked = !document.dg.checkbox['i'] .checked; } }\n";
        echo "function tblShowHideFilter(field) { var o = document.getElementById('filter-' + field); if (o.style.display == 'block') { tblClearFilter(); } else {	o.style.display = 'block'; } }\n";
        echo "function tblReset() { params = '&page=1'; updateTable(); }\n";
        echo "</script>\n";
    }

    function SetInLineEdit($InLineEdit = true) {
        $_SESSION['displaydata'][$_SESSION ["displaydata"] ["name"]]["InLineEdit"] = $InLineEdit;
    }

    function SetPrimaryID($id = '') {
        if (!is_null($id)) {
            $_SESSION['displaydata'][$_SESSION ["displaydata"] ["name"]]["pid"] = $id;
        }
    }

    /**
     * WORKING COPPY
     * Creates the table header
     *
     */
    function GetLables() {
        // Get field names of result
        $fieldlist = "'" . $_SESSION['displaydata'][$_SESSION ["displaydata"] ["name"]]["select_fields"] . "'";
        $fieldlist = str_replace(",", "','", $fieldlist);
        $sql = "SELECT " . $fieldlist . " FROM " . $_SESSION['displaydata'][$_SESSION ["displaydata"] ["name"]]["select_table"];

        $result = $this->db->query($sql);
        if ($result) {
            $fields = $result->fetchAll(PDO::FETCH_ASSOC);
            if (count($fields) > 0) {
                $field = $fields[0];
                foreach ($field as $value) {
                    $_SESSION['displaydata'][$_SESSION ["displaydata"] ["name"]]["field"][] = $value;
                }
                $_SESSION['displaydata'][$_SESSION ["displaydata"] ["name"]]["field_count"] = count($_SESSION['displaydata'][$_SESSION ["displaydata"] ["name"]]["field"]);
            }
        }
    }

    function displaylines() {
         if (!isset($_SESSION['displaydata'][$_SESSION ["displaydata"] ["name"]]["chgline"])) {
            $_SESSION['displaydata'][$_SESSION ["displaydata"] ["name"]]["chgline"] = 0;
        }
        $_SESSION['displaydata'][$_SESSION ["displaydata"] ["name"]]['i'] = 0; 
        for ($_SESSION['displaydata'][$_SESSION ["displaydata"] ["name"]]["currrow"] =$_SESSION['displaydata'][$_SESSION ["displaydata"] ["name"]]['firstline']-1 ; 
              $_SESSION['displaydata'][$_SESSION ["displaydata"] ["name"]]["currrow"] < $_SESSION['displaydata'][$_SESSION ["displaydata"] ["name"]]['lastline']; 
            $_SESSION['displaydata'][$_SESSION ["displaydata"] ["name"]]["currrow"] ++) 
        {
             $_SESSION['displaydata'][$_SESSION ["displaydata"] ["name"]]["line"] = $_SESSION['displaydata'][$_SESSION ["displaydata"] ["name"]]["currrow"] + 1;
            if ($_SESSION['displaydata'][$_SESSION ["displaydata"] ["name"]]["firstline"] + $_SESSION['displaydata'][$_SESSION ["displaydata"] ["name"]]["currrow"] == $_SESSION['displaydata'][$_SESSION ["displaydata"] ["name"]]["chgline"]) 
            {
                echo '<form id="' . $_SESSION["displaydata"]["name"] . 'inlineedit" name="' . $_SESSION["displaydata"]["name"] . 'inlineedit" method="post" action="' . $_SESSION['displaydata'][$_SESSION["displaydata"]["name"]]["urlparms"] . '">';
            }
            if (($_SESSION['displaydata'][$_SESSION ["displaydata"] ["name"]]["currrow"]-2) >= (($_SESSION['displaydata'][$_SESSION ["displaydata"] ["name"]]["page"] - 1) * ($_SESSION['displaydata'][$_SESSION ["displaydata"] ["name"]]["results_per_page"]))+($_SESSION['displaydata'][$_SESSION ["displaydata"] ["name"]]["TotalLines"] - $_SESSION['displaydata'][$_SESSION ["displaydata"] ["name"]]["firstline"])) 
            {
                $blankrow = array();
                foreach ($_SESSION['displaydata'][$_SESSION ["displaydata"] ["name"]]["field"] as $blkfield) {
                    $blankrow[$blkfield] = ' ';
                }
                $_SESSION['displaydata'][$_SESSION ["displaydata"] ["name"]]["row"][$_SESSION['displaydata'][$_SESSION ["displaydata"] ["name"]]["currrow"] - 1] = $blankrow;
                $_SESSION['displaydata'][$_SESSION ["displaydata"] ["name"]]["row"][$_SESSION['displaydata'][$_SESSION ["displaydata"] ["name"]]["currrow"] - 1][$_SESSION['displaydata'][$_SESSION ["displaydata"] ["name"]]["pid"]] = $_SESSION['displaydata'][$_SESSION ["displaydata"] ["name"]]["currrow"];
            }
            echo '<tr class="' . (($_SESSION['displaydata'][$_SESSION ["displaydata"] ["name"]]['i'] % 2) ? 'odd' : 'even') . '">'; // Switch up the bgcolors on each row
            if (!isset($_SESSION['displaydata'][$_SESSION["displaydata"]["name"]]["row_select"])) {
                $_SESSION['displaydata'][$_SESSION["displaydata"]["name"]]["row_select"] = false;
            }
            if ($_SESSION['displaydata'][$_SESSION ["displaydata"] ["name"]]["row_select"]) {
                echo ' tbl-row-highlight" onclick="' . $this->parseVariables($_SESSION['displaydata'][$_SESSION ["displaydata"] ["name"]]["row"], $_SESSION['displaydata'][$_SESSION ["displaydata"] ["name"]]["row_select"]) . '">';
            }
             if (!isset($_SESSION['displaydata'][$_SESSION["displaydata"]["name"]]["show_{row_number"])) {
                $_SESSION['displaydata'][$_SESSION["displaydata"]["name"]]["show_row_number"] = true;
            }
            if ($_SESSION['displaydata'][$_SESSION ["displaydata"] ["name"]]["show_row_number"]) {
                echo '<td class="tbl-row-num">' . $_SESSION['displaydata'][$_SESSION ["displaydata"] ["name"]]["line"] . '&nbsp';
            }
            if (!isset($_SESSION['displaydata'][$_SESSION["displaydata"]["name"]]["show_checkboxes"])) {
                $_SESSION['displaydata'][$_SESSION["displaydata"]["name"]]["show_checkboxes"] = false;
            }
            if ($_SESSION['displaydata'][$_SESSION ["displaydata"] ["name"]]["show_checkboxes"]) {
                echo '<td align="center"><input type="checkbox" class="tbl-checkbox" id="checkbox" name="tbl-checkbox"></td>';
            }
            $template = new $_SESSION["displaydata"][$_SESSION ["displaydata"] ["name"]]["template"]($this->db);
            $template->body();
            $_SESSION['displaydata'][$_SESSION ["displaydata"] ["name"]]["line"] = $_SESSION['displaydata'][$_SESSION ["displaydata"] ["name"]]["currrow"]+1;
//            $_SESSION['displaydata'][$_SESSION ["displaydata"] ["name"]]["chgline"] = 0;
            $_SESSION['displaydata'][$_SESSION ["displaydata"] ["name"]]['i'] ++;
        }
        echo '</tr></table>';
    }

    function displaylinestable() {
//        echo '</tr><tr>';
        $_SESSION['displaydata'][$_SESSION ["displaydata"] ["name"]]['i'] = 0;
        for ($_SESSION['displaydata'][$_SESSION ["displaydata"] ["name"]]["currrow"] = $_SESSION[$_SESSION ["displaydata"] ["name"]]["firstline"]-1; $_SESSION['displaydata'][$_SESSION ["displaydata"] ["name"]]["currrow"] < $_SESSION['displaydata'][$_SESSION ["displaydata"] ["name"]]["loopendrow"]; $_SESSION['displaydata'][$_SESSION ["displaydata"] ["name"]]["currrow"] ++) {
            if ($_SESSION['displaydata'][$_SESSION ["displaydata"] ["name"]]["currrow"] > $_SESSION['displaydata'][$_SESSION ["displaydata"] ["name"]]["TotalLines"] - $_SESSION['displaydata'][$_SESSION ["displaydata"] ["name"]]["firstline"]) {
                $blankrow = array();
                foreach ($_SESSION['displaydata'][$_SESSION ["displaydata"] ["name"]]["field"] as $blkfield) {
                    $blankrow[$blkfield] = ' ';
                }
                $_SESSION['displaydata'][$_SESSION ["displaydata"] ["name"]]["row"][$_SESSION['displaydata'][$_SESSION ["displaydata"] ["name"]]["currrow"] - 1] = $blankrow;
                $_SESSION['displaydata'][$_SESSION ["displaydata"] ["name"]]["row"][$_SESSION['displaydata'][$_SESSION ["displaydata"] ["name"]]["currrow"] - 1][$_SESSION['displaydata'][$_SESSION ["displaydata"] ["name"]]["pid"]] = $_SESSION['displaydata'][$_SESSION ["displaydata"] ["name"]]["currrow"];
            }
            echo '<tr class="tbl-row tbl-row-' . (($_SESSION['displaydata'][$_SESSION ["displaydata"] ["name"]]['i'] % 2) ? 'odd' : 'even') . '">'; // Switch up the bgcolors on each row
            if (!isset($_SESSION['displaydata'][$_SESSION["displaydata"]["name"]]["row_select"])) {
                $_SESSION['displaydata'][$_SESSION["displaydata"]["name"]]["row_select"] = 0;
            }
            if ($_SESSION['displaydata'][$_SESSION ["displaydata"] ["name"]]["row_select"]) {
                echo ' tbl-row-highlight" onclick="' . $this->parseVariables($_SESSION['displaydata'][$_SESSION ["displaydata"] ["name"]]["row"], $_SESSION['displaydata'][$_SESSION ["displaydata"] ["name"]]["row_select"]) . '">';
            }
            if (!isset($_SESSION['displaydata'][$_SESSION["displaydata"]["name"]]["show_{row_number"])) {
                $_SESSION['displaydata'][$_SESSION["displaydata"]["name"]]["show_row_number"] = true;
            }
            if ($_SESSION['displaydata'][$_SESSION ["displaydata"] ["name"]]["show_row_number"]) {
                echo '<td class="tbl-row-num">' . ((($_SESSION['displaydata'][$_SESSION["displaydata"]["name"]]["page"] - 1) * $_SESSION['displaydata'][$_SESSION ["displaydata"] ["name"]]["results_per_page"]) + $_SESSION['displaydata'][$_SESSION ["displaydata"] ["name"]]["line"]) . '</td>';
            }
            if (!isset($_SESSION['displaydata'][$_SESSION["displaydata"]["name"]]["show_checkboxes"])) {
                $_SESSION['displaydata'][$_SESSION["displaydata"]["name"]]["show_checkboxes"] = false;
            }
            if ($_SESSION['displaydata'][$_SESSION ["displaydata"] ["name"]]["show_checkboxes"]) {
                echo '<td align="center"><input type="checkbox" class="tbl-checkbox" id="checkbox" name="tbl-checkbox"></td>';
            }
            // Handle row selects
            foreach ($_SESSION['displaydata'][$_SESSION ["displaydata"] ["name"]]["row"][$_SESSION['displaydata'][$_SESSION ["displaydata"] ["name"]]["line"] - 1] as $key => $value) {
                // Skip if field is hidden
                if (in_array($key, $_SESSION['displaydata'][$_SESSION ["displaydata"] ["name"]]["hidden"])) {
                    continue;
                }
                if (!($_SESSION['displaydata'][$_SESSION ["displaydata"] ["name"]]["inlinetype"][$key][0] == self::INLINE_DATECOMBO)) {
                    echo '<td class="tbl-cell">' . $this->formatdata($key) . '</td>';
                }
            }
            // Add controls as needed
            if ($_SESSION['displaydata'][$_SESSION ["displaydata"] ["name"]]["InLineEdit"]) {
                $this->buildControlssm($_SESSION['displaydata'][$_SESSION ["displaydata"] ["name"]]["line"]);
            }
        }
        echo '</tr>';
        $_SESSION['displaydata'][$_SESSION ["displaydata"] ["name"]]['i'] ++;
    }

    /**
     * Creates the table footer
     *
     * @param integer $shown The amounts of rows being shown in the current page
     * @param integer $first The row number of the first row
     * @param integer $last The row number of the last row
     */
    function outputFooter($shown, $first = 1, $last = 0) {
        // Skip adding the footer if it is hidden
        if ($_SESSION['displaydata'][$_SESSION ["displaydata"] ["name"]]["hide_footer"])
            return;

        $pages = ceil($_SESSION['displaydata'][$_SESSION ["displaydata"] ["name"]]["row_count"] / $_SESSION['displaydata'][$_SESSION ["displaydata"] ["name"]]["results_per_page"]); // Total number of pages
        echo '<tfoot><tr class="tbl-footer"><td class="tbl-nav" colspan="' . $_SESSION['displaydata'][$_SESSION ["displaydata"] ["name"]]["field_count"] . '">tr><td class="tbl-found">Found <em>' . $_SESSION['displaydata'][$_SESSION ["displaydata"] ["name"]]["TotalLines"] . '</em> results';

        if ($_SESSION['displaydata'][$_SESSION ["displaydata"] ["name"]]["row_count"] > 0)
            echo ', showing <em>' . $_SESSION['displaydata'][$_SESSION ["displaydata"] ["name"]]["firstline"] . '</em> to <em>' . $_SESSION['displaydata'][$_SESSION ["displaydata"] ["name"]]["lastline"] . '</em>';

        echo '</td><td wdith="33%" class="tbl-pages">';

        // Handle results that span multiple pages
        if ($_SESSION['displaydata'][$_SESSION ["displaydata"] ["name"]]["row_count"] > $_SESSION['displaydata'][$_SESSION ["displaydata"] ["name"]]["results_per_page"]) {
            if ($_SESSION['displaydata'][$_SESSION ["displaydata"] ["name"]]["page"] > 1)
                echo '<a hre="javascript:;" onclick="tblSetPage(' . $first . ')"><img src="' . $this->image_path . 'arrow_first.gif" class="tbl-arrows" alt="&lt;&lt;" title="First Page"></a><a href="javascript:;" onclick="tblSetPage(' . $first . ')><img src="' . $this->image_path . 'arrow_left.gif" class="tbl-arrows" alt="&lt;" title="Previous Page"></a>';
            else
                echo '<img src="' . $this->image_path . 'arrow_first_disabled.gif" class="tbl-arrows" alt="&lt;&lt;" title="First Page"><img src="' . $this->image_path . 'arrow_left_disabled.gif" class="tbl-arrows" alt="&lt;" title="Previous Page">';

            // Special thanks to ionut for this next few lines
            $startpage = ($_SESSION['displaydata'][$_SESSION ["displaydata"] ["name"]]["page"] > 10) ? $_SESSION['displaydata'][$_SESSION ["displaydata"] ["name"]]["page"] - 10 : 1;

            $endpage = (($pages - 10) > $_SESSION['displaydata'][$_SESSION ["displaydata"] ["name"]]["page"]) ? $_SESSION['displaydata'][$_SESSION ["displaydata"] ["name"]]["page"] + 10 : $pages;

            // Only display a portion of the selectable pages
            for ($_SESSION['displaydata'][$_SESSION ["displaydata"] ["name"]]['i'] = $startpage; $_SESSION['displaydata'][$_SESSION ["displaydata"] ["name"]]['i'] <= $endpage; $_SESSION['displaydata'][$_SESSION ["displaydata"] ["name"]]['i'] ++) {
                if ($_SESSION['displaydata'][$_SESSION ["displaydata"] ["name"]]['i'] == $_SESSION['displaydata'][$_SESSION ["displaydata"] ["name"]]["page"])
                    echo '&nbsp;<span class="page-selected">' . $_SESSION['displaydata'][$_SESSION ["displaydata"] ["name"]]['i'] . '</span>&nbsp;';
                else
                    echo '&nbsp;<a href="javascript:;" onclick="tblSetPage(' . $_SESSION['displaydata'][$_SESSION ["displaydata"] ["name"]]['i'] . ')">' . $_SESSION['displaydata'][$_SESSION ["displaydata"] ["name"]]['i'] . '</a>&nbsp;';
            }

            if ($_SESSION['displaydata'][$_SESSION ["displaydata"] ["name"]]["page"] < $pages)
                echo '<a href="javascript:;" onclick="tblSetPage(' . ($_SESSION['displaydata'][$_SESSION ["displaydata"] ["name"]]["page"] + 1) . ')"><img src="' . $this->image_path . 'arrow_right.gif" class="tbl-arrows" alt="&gt;" title="Next Page"></a><a href="javascript:;" onclick="tblSetPage(' . $pages . ')"><img src="' . $this->image_path . 'arrow_last.gif" class="tbl-arrows" alt="&gt;&gt;" title="Last Page"></a>';
            else
                echo '<img src="' . $this->image_path . 'arrow_right_disabled.gif" class="tbl-arrows" alt="&gt;" title="Next Page"><img src="' . $this->image_path . 'arrow_last_disabled.gif" class="tbl-arrows" alt="&gt;&gt;" title="Last Page">';
        }

        echo '</td><td width="33%" class="tbl-page">';

        // Only show page section if we have more than one page
        if ($pages > 0) {
            echo 'Page ';
            if (!$_SESSION['displaydata'][$_SESSION ["displaydata"] ["name"]]["hide_page_list"] and $pages > 1) {
                // Create a selectable drop down list for pages
                echo '<select name="tbl-page" onchange="tblSetPage(this.options[this.selectedIndex].value)">';
                for ($x = 1; $x <= $pages; $x++) {
                    echo '<option value="' . $x . '"';
                    if ($x == $_SESSION['displaydata'][$_SESSION ["displaydata"] ["name"]]["page"])
                        echo ' selected="selected"';
                    echo '>' . $x . '</option>';
                }
                echo '</select>';
            } else
                echo $_SESSION['displaydata'][$_SESSION ["displaydata"] ["name"]]["page"]; // Just write the page number, nothing to fancy

            echo ' of ' . $pages;
        }

        echo '</td></tr></tfoot>';
    }

    function buildaddrec() {
        // Output the create button
        if ($_SESSION['displaydata'][$_SESSION ["displaydata"] ["name"]]["creatrecordtext"]) {
            echo '<input class="" type="submit" name="' . $_SESSION ["displaydata"] ["name"] . 'addrec' . '" value="' . $_SESSION['displaydata'][$_SESSION ["displaydata"] ["name"]]["creatrecordtext"] . '">';
        }
    }

    function buildreset() {
        // Output the reset button
        if ($_SESSION['displaydata'][$_SESSION ["displaydata"] ["name"]]["reset_button"]) {
            echo '<input class="" type="submit" name="resetrec" onclick="tblReset()" value="' . $_SESSION['displaydata'][$_SESSION ["displaydata"] ["name"]]["reset_button"] . '">';
            $_SESSION['displaydata'][$_SESSION ["displaydata"] ["name"]]["click"] = true;
        }
    }

    /**
     * Builds row controls
     *
     * @param array $row The row associated array
     */
    function buildControlssm($line) {
        if ($_SESSION['displaydata'][$_SESSION ["displaydata"] ["name"]]["InLineEdit"]) {
            if ($_SESSION['displaydata'][$_SESSION ["displaydata"] ["name"]]["TotalLines"] > 0) {
                // Add controls as needed
                if ($_SESSION['displaydata'][$_SESSION ["displaydata"] ["name"]]["InLineEdit"]) {
                    if ($_SESSION['displaydata'][$_SESSION ["displaydata"] ["name"]]["chgline"] == $line) {
                        //Save Record
                        $_SESSION['displaydata'][$_SESSION ["displaydata"] ["name"]]["controls"][1] = '<input class="" type="submit" name="' . $_SESSION['displaydata']["name"] . 'saveline[]" value="S' . $line . '">';
                        //Cancel Record
                        $_SESSION['displaydata'][$_SESSION ["displaydata"] ["name"]]["controls"][2] = '<input class="" type="submit" name="' . $_SESSION['displaydata']["name"] . 'cancelline[]" value="X' . $line . '"></span>';
                    } else {
                        //Edit Record
                        $_SESSION['displaydata'][$_SESSION ["displaydata"] ["name"]]["controls"][1] = '<input class="" type="submit" name="' . $_SESSION['displaydata']["name"] . 'editline[]" value="E' . $line . '">';
                        //Delete Record
                        $_SESSION['displaydata'][$_SESSION ["displaydata"] ["name"]]["controls"][2] = '<input class="" type="submit" name="' . $_SESSION['displaydata']["name"] . 'deleteline[]" value="D' . $line . '"></span>';
                    }
                }
                if (count($_SESSION['displaydata'][$_SESSION ["displaydata"] ["name"]]["controls"]) > 0) {
                    echo '<span class="tbl-controls">';
                    if (!($_SESSION['displaydata'][$_SESSION ["displaydata"] ["name"]]["firstline"] + $_SESSION['displaydata'][$_SESSION ["displaydata"] ["name"]]["currrow"] == ($_SESSION['displaydata'][$_SESSION ["displaydata"] ["name"]]["chgline"] - 1))) {
                        
                    }
                    foreach ($_SESSION['displaydata'][$_SESSION ["displaydata"] ["name"]]["controls"] as $ctl) {
                        echo $this->parseVariables($_SESSION['displaydata'][$_SESSION ["displaydata"] ["name"]]["row"], $ctl);
                    }
                }
            }
        }
    }

    function buildControlslg(array $row, $pid, $line) {
        // Add controls as needed
        if ($_SESSION['displaydata'][$_SESSION ["displaydata"] ["name"]]["InLineEdit"]) {
            if ($_SESSION['displaydata'][$_SESSION ["displaydata"] ["name"]]["editline"] == $line) {
                //Save Record
                $_SESSION['displaydata'][$_SESSION ["displaydata"] ["name"]]["controls"][1] = '<td><input class="" type="submit" name="saveline" value="Save' . $line . '"></td>';
                //cancel Record
                $_SESSION['displaydata'][$_SESSION ["displaydata"] ["name"]]["controls"][2] = '<td><input class="" type="submit" name="cancelline" value="Cancel' . $line . '"></td>';
            } else {
                //Edit Record
                $_SESSION['displaydata'][$_SESSION ["displaydata"] ["name"]]["controls"][1] = '<td><input class="" type="submit" name="editline" value="Edit' . $line . '"></td>';
                //Delete Record
                $_SESSION['displaydata'][$_SESSION ["displaydata"] ["name"]]["controls"][2] = '<td><input class="" type="submit" name="deleteline" value="Delete' . $line . '"></td>';
            }
        }
        if (count($_SESSION['displaydata'][$_SESSION ["displaydata"] ["name"]]["controls"]) > 0) {
            echo '<td class="tbl-controls">';
            foreach ($_SESSION['displaydata'][$_SESSION ["displaydata"] ["name"]]["controls"] as $ctl) {
                echo $this->parseVariables($_SESSION['displaydata'][$_SESSION ["displaydata"] ["name"]]["row"], $ctl);
            }
        }
    }

    function addrecord() {
        if (!isset($_SESSION['displaydata'][$_SESSION ["displaydata"] ["name"]]["TotalLines"])) {
            $_SESSION['displaydata'][$_SESSION ["displaydata"] ["name"]]["TotalLines"] = 0;
        }
        $_SESSION['displaydata'][$_SESSION ["displaydata"] ["name"]]["editline"] = $_SESSION['displaydata'][$_SESSION ["displaydata"] ["name"]]["TotalLines"] + 1;
        $_SESSION['displaydata'][$_SESSION ["displaydata"] ["name"]]["noofnewlines"] = $_SESSION['displaydata'][$_SESSION ["displaydata"] ["name"]]["noofnewlines"] + 1;
        $_SESSION['displaydata'][$_SESSION ["displaydata"] ["name"]]["insertline"] = 0;
//        $_SESSION['displaydata'][$_SESSION ["displaydata"] ["name"]]["editline"] = $_SESSION['displaydata'][$_SESSION ["displaydata"] ["name"]]["editline"];
        $_POST[$_SESSION['displaydata']["name"] . 'editline'] = 'E' . strval($_SESSION['displaydata'][$_SESSION ["displaydata"] ["name"]]["editline"]);
        $_SESSION['displaydata'][$_SESSION ["displaydata"] ["name"]]["deleteid"] = 0;
        $_SESSION['displaydata'][$_SESSION ["displaydata"] ["name"]]["click"] = true;
        $_SESSION['displaydata'][$_SESSION ["displaydata"] ["name"]]["displaygrid"] = true;
        $_SESSION['displaydata'][$_SESSION ["displaydata"] ["name"]]["insertrecord"] = true;
    }

    function checkaddrecord() {
        $addrec = filter_input(\INPUT_POST, $_SESSION ["displaydata"] ["name"] . 'addrec');
        if (!isset($addrec)) {
            $addrec = '';
        }
        if ($addrec == $_SESSION['displaydata'][$_SESSION ["displaydata"] ["name"]]["creatrecordtext"]) {
            $this->addrecord();
            $addrec = '';
        }
    }

    function checkajax() {
        if (!$this->isAjaxUsed()) {
            // Print out required javascript functions
            $this->printJavascript();
            echo '<script type="text/javascript">function updateTable() { window.location = "?" + params; }</script>';
        }
    }

    function checkreset() {
        $resetrec = filter_input(\INPUT_POST, 'resetrec');
        if (!isset($resetrec)) {
            $resetrec = '';
        }
        if ($resetrec == $_SESSION['displaydata'][$_SESSION ["displaydata"] ["name"]]["reset_button"]) {
            ?>    
            <script>
                tblReset();
            </script>
            <?PHP

            $_SESSION['displaydata'][$_SESSION ["displaydata"] ["name"]]["click"] = true;
            $_SESSION['displaydata'][$_SESSION ["displaydata"] ["name"]]["displaygrid"] = true;
        }
    }

    function checkcontrols() {
        if (!isset($_POST[$_SESSION['displaydata']["name"] . 'saveline']))
            $_POST[$_SESSION['displaydata']["name"] . 'saveline'] = 0;
        if (!isset($_POST[$_SESSION['displaydata']["name"] . 'cancelline']))
            $_POST[$_SESSION['displaydata']["name"] . 'cancelline'] = 0;
        if (!isset($_POST[$_SESSION['displaydata']["name"] . 'editline']))
            $_POST[$_SESSION['displaydata']["name"] . 'editline'] = 0;
        if (!isset($_POST[$_SESSION['displaydata']["name"] . 'deleteline']))
            $_POST[$_SESSION['displaydata']["name"] . 'deleteline'] = 0;
        if (!isset($_POST[$_SESSION['displaydata']["name"] . 'chgline']))
            $_POST[$_SESSION['displaydata']["name"] . 'chgline'] = 0;
        $cancelline = $_POST[$_SESSION['displaydata']["name"] . 'cancelline'];
        if (substr($cancelline[0], 0, 1) === 'X') {
            $_SESSION['displaydata'][$_SESSION ["displaydata"] ["name"]]["insertline"] = 0;
            $_SESSION['displaydata'][$_SESSION ["displaydata"] ["name"]]["editline"] = 0;
            $_SESSION['displaydata'][$_SESSION ["displaydata"] ["name"]]["chgline"] = 0;
            $_SESSION['displaydata'][$_SESSION ["displaydata"] ["name"]]["deleteid"] = 0;
            $_SESSION['displaydata'][$_SESSION ["displaydata"] ["name"]]["click"] = true;
            $_SESSION['displaydata'][$_SESSION ["displaydata"] ["name"]]["displaygrid"] = true;
        }
        $saveline = $_POST[$_SESSION['displaydata']["name"] . 'saveline'];
        if (substr($saveline[0], 0, 1) === 'S') {
            $_SESSION['displaydata'][$_SESSION ["displaydata"] ["name"]]["chgline"] = (INT) substr($saveline[0], 1, strlen($saveline - 1));
            if ($_SESSION['displaydata'][$_SESSION ["displaydata"] ["name"]]["chgline"] > $_SESSION['displaydata'][$_SESSION ["displaydata"] ["name"]]["noofdblines"]) {
                $_SESSION['displaydata'][$_SESSION ["displaydata"] ["name"]]["insertrecord"] = true;
                $_SESSION['displaydata'][$_SESSION ["displaydata"] ["name"]]["updaterecord"] = false;
                $_SESSION['displaydata'][$_SESSION ["displaydata"] ["name"]]["insertline"] = $_SESSION['displaydata'][$_SESSION ["displaydata"] ["name"]]["chgline"];
                $_SESSION['displaydata'][$_SESSION ["displaydata"] ["name"]]["editline"] = 0;
            } else {
                $_SESSION['displaydata'][$_SESSION ["displaydata"] ["name"]]["insertrecord"] = false;
                $_SESSION['displaydata'][$_SESSION ["displaydata"] ["name"]]["updaterecord"] = true;
                $_SESSION['displaydata'][$_SESSION ["displaydata"] ["name"]]["editline"] = $_SESSION['displaydata'][$_SESSION ["displaydata"] ["name"]]["chgline"];
                $_SESSION['displaydata'][$_SESSION ["displaydata"] ["name"]]["insertline"] = 0;
            }
            $_SESSION['displaydata'][$_SESSION ["displaydata"] ["name"]]["deleteid"] = 0;
            $_SESSION['displaydata'][$_SESSION ["displaydata"] ["name"]]["click"] = true;
            $_SESSION['displaydata'][$_SESSION ["displaydata"] ["name"]]["displaygrid"] = true;
        }

        $editline = $_POST[$_SESSION['displaydata']["name"] . 'editline'];
        if (substr($editline[0], 0, 1) === 'E') {
            $_SESSION['displaydata'][$_SESSION ["displaydata"] ["name"]]["editline"] = (INT) substr($editline[0], 1, strlen($editline[0] - 1));
        } else {
            $_SESSION['displaydata'][$_SESSION ["displaydata"] ["name"]]["editline"] = 0;
        }
        if ($_SESSION['displaydata'][$_SESSION ["displaydata"] ["name"]]["editline"] > 0) {
            $_SESSION['displaydata'][$_SESSION ["displaydata"] ["name"]]["chgline"] = $_SESSION['displaydata'][$_SESSION ["displaydata"] ["name"]]["editline"];
            $_SESSION['displaydata'][$_SESSION ["displaydata"] ["name"]]["id"] = (INT) $_SESSION['displaydata'][$_SESSION ["displaydata"]["name"]]['row'][$_SESSION['displaydata'][$_SESSION ["displaydata"] ["name"]]["editline"] - 1][$_SESSION['displaydata'][$_SESSION ["displaydata"] ["name"]]["pid"]];
            $_SESSION['displaydata'][$_SESSION ["displaydata"] ["name"]]["updaterecord"] = false;
            $_SESSION['displaydata'][$_SESSION ["displaydata"] ["name"]]["deleterecord"] = false;
            $_SESSION['displaydata'][$_SESSION ["displaydata"] ["name"]]["insertline"] = 0;
            $_SESSION['displaydata'][$_SESSION ["displaydata"] ["name"]]["deleteid"] = 0;          
             $_SESSION['displaydata'][$_SESSION ["displaydata"] ["name"]]["click"] = true;
            $_SESSION['displaydata'][$_SESSION ["displaydata"] ["name"]]["displaygrid"] = true;
//            $_SESSION['displaydata'][$_SESSION ["displaydata"] ["name"]]["editline"] = 0;
//            $_SESSION['displaydata'][$_SESSION ["displaydata"] ["name"]]["noofnewlines"] = $_SESSION['displaydata'][$_SESSION ["displaydata"] ["name"]]["noofnewlines"] - 1;
        }
    
        $deleteline = $_POST[$_SESSION['displaydata']["name"] . 'deleteline'];
        if (substr($deleteline[0], 0, 1) === 'D') {
            $_SESSION['displaydata'][$_SESSION ["displaydata"] ["name"]]["chgline"] = 0;
            $_SESSION['displaydata'][$_SESSION ["displaydata"] ["name"]]["insertrecord"] = false;
            $_SESSION['displaydata'][$_SESSION ["displaydata"] ["name"]]["updaterecord"] = false;
            $_SESSION['displaydata'][$_SESSION ["displaydata"] ["name"]]["deleterecord"] = true;
            $_SESSION['displaydata'][$_SESSION ["displaydata"] ["name"]]["writeline"] = 0;
            $_SESSION['displaydata'][$_SESSION ["displaydata"] ["name"]]["insertline"] = 0;
//            $_SESSION['displaydata'][$_SESSION ["displaydata"] ["name"]]["editline"] = 0;
             $_SESSION['displaydata'][$_SESSION ["displaydata"] ["name"]]["deleteid"] = (INT) $_SESSION['displaydata'][$_SESSION ["displaydata"] ["name"]]["id"];
            $_SESSION['displaydata'][$_SESSION ["displaydata"] ["name"]]["click"] = true;
            $_SESSION['displaydata'][$_SESSION ["displaydata"] ["name"]]["displaygrid"] = true;
        }
    }

    function checkdatasource() {
        if ($_SESSION['displaydata'][$_SESSION ["displaydata"] ["name"]]["displaydatatype"] == 'db') {
            if (isset($_SESSION['displaydata'][$_SESSION ["displaydata"] ["name"]]["currrow"])) {
                $this->dbtasks();
            }
        } else {
            $this->arraytasks();
        }
    }

    function checkrowcount() {
        if ($_SESSION['displaydata'][$_SESSION ["displaydata"] ["name"]]["row_count"] == 0) {
            $this->addrecord();
        }
    }

    function checknotes() {
        $validate = new validate();
        if (!isset($_SESSION["displaydata"]["name"])) {
            return;
        }
        if (isset($_SESSION['displaydata'][$_SESSION["displaydata"]["name"]]["firstline"])) {
            if ($_SESSION['displaydata'][$_SESSION ["displaydata"] ["name"]]["firstline"] + $_SESSION['displaydata'][$_SESSION ["displaydata"] ["name"]]["currrow"] == $_SESSION['displaydata'][$_SESSION ["displaydata"] ["name"]]["chgline"]) {
                // Input
                foreach ($_SESSION['displaydata']['inlinenames'] as $key => $value) {
                    if (empty($_POST[$value])) {
                        break;
                    }
                    $varname = substr($value, 0, strlen($value) - 5);
                    if ($_POST[$value] == $_SESSION['displaydata'][$_SESSION ["displaydata"] [$varname]]["inlinetype"]["notes"]['text']) {
                        $url = $_SESSION['displaydata'][$_SESSION ["displaydata"] [$varname]]["inlinetype"]['notes']['inbaseurl']
                                . '?notestype=' . $_SESSION['displaydata']["notes"]["type"]['notes']['notestype']
                                . '&notenum=' . strval($_SESSION["displaydata"][$_SESSION ["displaydata"] ["name"]]["line"])
                                . '&noteattachid=' . $_SESSION['displaydata'][$_SESSION ["displaydata"] [$varname]]["constantfields"][$_SESSION['displaydata'][$_SESSION ["displaydata"] ["name"]]["pid"]]
                                . '&noteauthourid=' . $_SESSION["login"]['username']
                                . '&notedate=' . date($_SESSION['preferences']['dateformat'])
                                . '&notereturnurl=' . $_SESSION['displaydata']["notes"]["inlinetype"]['notes']["returnurl"];
                        $validate->do_redirect($url);
                        $_POST[$value] = null;
                    }
                }
            } else {
                //Output
                foreach ($_SESSION['displaydata']['typenames'] as $key => $value) {
                    if (empty($_POST[$value])) {
                        break;
                    }
                    $varname = substr($value, 0, strlen($value) - 5);
                    echo 'key = ' . $key;
                    echo ' value = ' . $value;
                    echo ' $_POST[$value] =' . $_POST[$value];
                    echo '$_SESSION["displaydata"][$_SESSION ["displaydata"] ["' . $varname . '"]]["notes"]["text"]';
                    echo '&notesattachid = ' . $_SESSION['displaydata'][$_SESSION ["displaydata"] [$varname]]["constantfields"][$_SESSION['displaydata'][$_SESSION ["displaydata"] [$varname]]["pid"]];
                    if ($_POST[$value] == $_SESSION['displaydata'][$_SESSION ["displaydata"] [$varname]]["notes"]['text']) {
                        $url = $_SESSION['displaydata'][$_SESSION ["displaydata"] ["$varname"]]['notes']['outbaseurl']
                                . '?notestype=' . $_SESSION['displaydata'][$_SESSION ["displaydata"] ["$varname"]]["notes"]["notestype"]
                                . '&notenum=' . strval($_SESSION["displaydata"][$_SESSION ["displaydata"] [$varname]]["line"])
                                . '&noteattachid=' . $_SESSION['displaydata'][$_SESSION ["displaydata"] [$varname]]["constantfields"][$_SESSION['displaydata'][$_SESSION ["displaydata"] [$varname]]["pid"]]
                                . '&noteauthourid=' . $_SESSION["login"]['username']
                                . '&notedate=' . date($_SESSION['preferences']['dateformat'])
                                . '&notereturnurl=' . $_SESSION['displaydata']["notes"]["type"]['notes']["returnurl"];
                        $validate->do_redirect($url);
                        $_POST[$value] = null;
                    }
                }
            }
        }
    }

    function dbtasks() {
        if ($_SESSION['displaydata'][$_SESSION ["displaydata"] ["name"]]["insertrecord"]) {
//                          Save record
            $this->dbinsert();
        }
        if ($_SESSION['displaydata'][$_SESSION ["displaydata"] ["name"]]["updaterecord"]) {
//                          Update record 
            $this->dbupdate();
        }
        if ($_SESSION['displaydata'][$_SESSION ["displaydata"] ["name"]]["deleterecord"]) {
//		           Delete record
            $this->dbdelete();
        }
    }

    function arraytasks() {
//                  Adding to a array
        if ($_SESSION['displaydata'][$_SESSION ["displaydata"] ["name"]]["insertrecord"]) {
            echo $_SESSION['displaydata'][$_SESSION ["displaydata"] ["name"]]["arrayname"] . ' = array();';
            foreach ($_SESSION['displaydata'][$_SESSION ["displaydata"] ["name"]]["constantfields"] as $constantfield => $constantvalue) {
                echo $_SESSION['displaydata'][$_SESSION ["displaydata"] ["name"]]["arrayname"] . '[' . $constantfield . '] =' . $constantvalue;
            }
            foreach ($_SESSION['displaydata'][$_SESSION ["displaydata"] ["name"]]["select_fields"] as $field => $fieldvalue) {
                if (in_array($field, $_SESSION['displaydata'][$_SESSION ["displaydata"] ["name"]]["hidden"])) {
                    continue;
                }
                echo $_SESSION['displaydata'][$_SESSION ["displaydata"] ["name"]]["arrayname"] . '[' . $field . '] =' . $fieldvalue;
            }
        }
//			Update a array
        if ($_SESSION['displaydata'][$_SESSION ["displaydata"] ["name"]]["updaterecord"]) {
            foreach ($_SESSION['displaydata'][$_SESSION ["displaydata"] ["name"]]["select_fields"] as $field => $fieldvalue) {
                if (in_array($field, $_SESSION['displaydata'][$_SESSION ["displaydata"] ["name"]]["hidden"])) {
                    continue;
                }
                echo $_SESSION['displaydata'][$_SESSION ["displaydata"] ["name"]]["arrayname"] . '[' . $field . '] = ' . $fieldvalue;
            }
        }
//			Deleting from a array
        if ($_SESSION['displaydata'][$_SESSION ["displaydata"] ["name"]]["deleterecord"]) {
//                            echo unset($_SESSION['displaydata'][$_SESSION ["displaydata"] ["name"]]["arrayname"].'['.$_SESSION['displaydata'][$_SESSION ["displaydata"] ["name"]]["line"] -1.']'.);							
        }
        // Set the limit
        $_SESSION['displaydata'][$_SESSION ["displaydata"] ["name"]]["row"] = $_SESSION['displaydata'][$_SESSION ["displaydata"] ["name"]]["array"];
    }

    function dbselect() {
        $sql = 'SELECT ' . $_SESSION['displaydata'][$_SESSION ["displaydata"]["name"]]["select_fields"] . ' FROM ' . $_SESSION['displaydata'][$_SESSION ["displaydata"] ["name"]]["select_table"] . ' ';
//        $sqlid = 'SELECT ' . $_SESSION['displaydata'][$_SESSION ["displaydata"] ["name"]]["pid"] . ' FROM ' . $_SESSION['displaydata'][$_SESSION ["displaydata"] ["name"]]["select_table"] . ' ';
        // FILTER
        if ($_SESSION['displaydata'][$_SESSION ["displaydata"] ["name"]]["select_where"]) {

            $sql .= " WHERE " . $_SESSION['displaydata'][$_SESSION ["displaydata"] ["name"]]["select_where"];
//            $sqlid .= " WHERE " . $_SESSION['displaydata'][$_SESSION ["displaydata"] ["name"]]["select_where"];
        }
        $filter_query = '';
        if ($_SESSION['displaydata'][$_SESSION ["displaydata"] ["name"]]["allow_filters"] and $_SESSION['displaydata'][$_SESSION ["displaydata"] ["name"]]["filter"]) {
            if (!strstr($_SESSION['displaydata'][$_SESSION ["displaydata"] ["name"]]["filter"] ["Value"], '%')) {
                $filter_value = '%' . $_SESSION['displaydata'][$_SESSION ["displaydata"] ["name"]]["filter"] ["Value"] . '%';
            } else {
                $filter_value = $_SESSION['displaydata'][$_SESSION ["displaydata"] ["name"]]["filter"] ["Value"];
            }
            if ($_SESSION['displaydata'][$_SESSION ["displaydata"] ["name"]]["select_where"]) {

                $filter_query .= "AND ";
                $filter_query .= "`" . $_SESSION['displaydata'][$_SESSION ["displaydata"] ["name"]]["filter"] ["field"] . "` LIKE " . $filter_value;
            } else {
                $filter = 'WHERE ' . $filter_query . "`" . $_SESSION['displaydata'][$_SESSION ["displaydata"] ["name"]]["filter"] ["field"] . "` LIKE " . $filter_value;
                $sql .= $filter;
//                $sqlid .= $filter;
                if (!isset($_SESSION['displaydata'][$_SESSION ["displaydata"] ["name"]]["constantfields"])) {
                    $_SESSION['displaydata'][$_SESSION ["displaydata"] ["name"]]["constantfields"] = array();
                } else {
                    $sql = ' AND ';
                }
                foreach ($_SESSION['displaydata'][$_SESSION ["displaydata"] ["name"]]["constantfields"] as $constantfield => $constantvalue) {
                    $sql .= $constantfield . '=' . $constantvalue . ',';
                }
                $sql = substr($sql, 0, strlen($sql) - 1);
            }
        }        // ORDER
        if ($_SESSION['displaydata'][$_SESSION ["displaydata"] ["name"]]["hide_order"]) {
            $order = " ORDER BY " . $_SESSION['displaydata'][$_SESSION ["displaydata"] ["name"]]["order"] ["field"] . ' ' . $_SESSION['displaydata'][$_SESSION ["displaydata"] ["name"]]["order"] ["order"];
        } else {
            $order = '';
        }
        $sql .= $order;

        // LIMIT
//        if ($_SESSION['displaydata'][$_SESSION ["displaydata"] ["name"]]["limit"]) {
//            $limit = "LIMIT " . $_SESSION['displaydata']["limit"] ["Low"] . ", " . $_SESSION['displaydata']["limit"] ["High"];
//        } else {
//            $limit = '';
//        }
//        $sql .= ' ' . $limit;
//      Inform the user of any errors. Commonly caused when a field is specified in the filter or order clause that does not exist
        $_SESSION['displaydata'][$_SESSION ["displaydata"] ["name"]]["result"] = $this->db->query($sql);
//        $resultid = $this->db->query($sqlid);
        if (!$_SESSION['displaydata'][$_SESSION ["displaydata"] ["name"]]["result"]) {
            $msg = new messages;
            $msg->DisplayMessage('datadisplayerror');
        } else {
            $_SESSION['displaydata'][$_SESSION ["displaydata"] ["name"]]["result"] = $_SESSION['displaydata'][$_SESSION ["displaydata"] ["name"]]["result"]->fetchAll(PDO::FETCH_ASSOC);

            $_SESSION['displaydata'][$_SESSION ["displaydata"] ["name"]]["row_count"] = count($_SESSION['displaydata'][$_SESSION ["displaydata"] ["name"]]["result"]);
            $_SESSION['displaydata'][$_SESSION ["displaydata"] ["name"]]["id"] = (INT) $_SESSION['displaydata'][$_SESSION ["displaydata"] ["name"]]["result"][$_SESSION['displaydata'][$_SESSION ["displaydata"] ["name"]]["line"] - 1][$_SESSION['displaydata'][$_SESSION ["displaydata"] ["name"]]["pid"]];
            //               }
        }
    }

    function dbinsert() {
        $_SESSION['displaydata'][$_SESSION ["displaydata"] ["name"]]["insertrecord"] = false;

        $sql = 'INSERT INTO ' . $_SESSION['displaydata'][$_SESSION ["displaydata"] ["name"]]["table"] . ' (';
        if (!isset($_SESSION['displaydata'][$_SESSION ["displaydata"] ["name"]]["constantfields"])) {
            $_SESSION['displaydata'][$_SESSION ["displaydata"] ["name"]]["constantfields"] = array();
        }
        foreach ($_SESSION['displaydata'][$_SESSION ["displaydata"] ["name"]]["constantfields"] as $constantfield => $constantvalue) {
            $sql .= $constantfield . ',';
        }
        $sql = substr($sql, 0, strlen($sql) - 1);
        $sql .= ') VALUES (';
        if (count($_SESSION['displaydata'][$_SESSION ["displaydata"] ["name"]]["constantfields"] > 0)) {
            foreach ($_SESSION['displaydata'][$_SESSION ["displaydata"] ["name"]]["constantfields"] as $constantfield => $constantvalue) {
                $sql .= $constantvalue . ',';
            }
        }
        $sql = substr($sql, 0, strlen($sql) - 1) . ')';
        $_SESSION['displaydata'][$_SESSION ["displaydata"] ["name"]]["result"] = $this->db->query($sql);
        $id = $this->db->getLatestId($_SESSION['displaydata'][$_SESSION ["displaydata"] ["name"]]["table"], $_SESSION['displaydata'][$_SESSION ["displaydata"] ["name"]]["pid"]);
        $_SESSION['displaydata'][$_SESSION ["displaydata"] ["name"]]["id"] = $id;
        $validate = new validate;
        $validate->DateStamp($_SESSION['displaydata'][$_SESSION ["displaydata"] ["name"]]["table"], $_SESSION['displaydata'][$_SESSION ["displaydata"] ["name"]]["pid"], $id, $_SESSION["login"] ["username"], $_SESSION["preferences"]["database"]["dbname"]);
        $_SESSION['displaydata'][$_SESSION ["displaydata"] ["name"]]["noofdblines"] = $_SESSION['displaydata'][$_SESSION ["displaydata"] ["name"]]["noofdblines"] + 1;
        $_SESSION['displaydata'][$_SESSION ["displaydata"] ["name"]]["noofnewlines"] = $_SESSION['displaydata'][$_SESSION ["displaydata"] ["name"]]["noofnewlines"] - 1;
    }

    function dbupdate() {
        $_SESSION['displaydata'][$_SESSION ["displaydata"] ["name"]]["updaterecord"] = false;
        $fieldlist = "'" . $_SESSION['displaydata'][$_SESSION ["displaydata"] ["name"]]["select_fields"] . "'";
        $fieldlist = str_replace(",", "','", $fieldlist);
        $query = 'SELECT ' . $fieldlist . ' FROM ' . $_SESSION['displaydata'][$_SESSION ["displaydata"] ["name"]]["select_table"];
        $_SESSION['displaydata'][$_SESSION ["displaydata"] ["name"]]["result"] = $this->db->query($query);
        $fields = $_SESSION['displaydata'][$_SESSION ["displaydata"] ["name"]]["result"]->fetchAll(PDO::FETCH_ASSOC);
        $sql = 'UPDATE ' . $_SESSION['displaydata'][$_SESSION ["displaydata"] ["name"]]["table"] . '  SET ';
        $field = $fields[0];
        foreach ($field as $key => $field) {
            if (in_array($key, $_SESSION['displaydata'][$_SESSION ["displaydata"] ["name"]]["hidden"])) {
                continue;
            }
            $sql .= $key . ' = "' . $_POST[$field] . '",';
        }
        $sql = substr($sql, 0, strlen($sql) - 1);
        $sql .= ' WHERE ' . $_SESSION['displaydata'][$_SESSION ["displaydata"] ["name"]]["pid"] . '= ' . $_SESSION['displaydata'][$_SESSION ["displaydata"] ["name"]]["id"];
        $_SESSION['displaydata'][$_SESSION ["displaydata"] ["name"]]["result"] = $this->db->query($sql);
        $validate = new validate;
        if ($_SESSION['displaydata'][$_SESSION ["displaydata"] ["name"]]["chgline"] + 1 > $_SESSION['displaydata'][$_SESSION ["displaydata"] ["name"]]["noofdblines"]) {
            $_SESSION['displaydata'][$_SESSION ["displaydata"] ["name"]]["noofnewlines"] = $_SESSION['displaydata'][$_SESSION ["displaydata"] ["name"]]["noofnewlines"] - 1;
        }
        $_SESSION['displaydata'][$_SESSION ["displaydata"] ["name"]]["chgline"] = 0;
    }

    function dbdelete() {
        $sql = 'DELETE FROM ' . $_SESSION['displaydata'][$_SESSION ["displaydata"] ["name"]]["table"] . ' WHERE ' . $_SESSION['displaydata'][$_SESSION ["displaydata"] ["name"]]["pid"] . '= ' .$_SESSION['displaydata'][$_SESSION ["displaydata"] ["name"]]["deleteid"];
        $_SESSION['displaydata'][$_SESSION ["displaydata"] ["name"]]["result"] = $this->db->query($sql);
    }

    function setpagelimit() 
    {
        if (!isset($_POST[$_SESSION["displaydata"]["name"].'dirfirst']))
        {        
                $_POST[$_SESSION["displaydata"]["name"] . 'dirfirst'] = '';
        }        
        if ($_POST[$_SESSION["displaydata"]["name"] . 'dirfirst'] == 'First')
        {
            $_SESSION['displaydata'][$_SESSION["displaydata"]["name"]]["page"] = 1;
        }        
        if (!isset($_POST[$_SESSION["displaydata"]["name"].'dirprevious']))
        {        
                $_POST[$_SESSION["displaydata"]["name"] . 'dirprevious'] = '';
        }        
        if ($_POST[$_SESSION["displaydata"]["name"] . 'dirprevious'] == 'Previous')
        {
            $_SESSION['displaydata'][$_SESSION["displaydata"]["name"]]["page"]--;
        }        
        if (!isset($_POST[$_SESSION["displaydata"]["name"].'dirnext']))
        {        
                $_POST[$_SESSION["displaydata"]["name"] . 'dirnext'] = '';
        }        
        if ($_POST[$_SESSION["displaydata"]["name"] . 'dirnext'] == 'Next')
        {
            $_SESSION['displaydata'][$_SESSION["displaydata"]["name"]]["page"]++;           
        }        
        if (!isset($_POST[$_SESSION["displaydata"]["name"].'dirlast']))
        {        
                 $_POST[$_SESSION["displaydata"]["name"] . 'dirlast'] = '';
        }        
        if ($_POST[$_SESSION["displaydata"]["name"] . 'dirlast'] == 'Last')
        {
            $_SESSION['displaydata'][$_SESSION["displaydata"]["name"]]["page"] = (int)$_SESSION['displaydata'][$_SESSION ["displaydata"] ["name"]]["TotalLines"]/$_SESSION['displaydata'][$_SESSION ["displaydata"] ["name"]]["results_per_page"];
        }        
//                      Set the page limit
       if (!isset($_SESSION['displaydata'][$_SESSION["displaydata"]["name"]]["page"])) {
            $_SESSION['displaydata'][$_SESSION["displaydata"]["name"]]["page"] = 1;
        }
        if ($_SESSION['displaydata'][$_SESSION ["displaydata"] ["name"]]["page"] == 1) {
            $low = 0;
            $high = $_SESSION['displaydata'][$_SESSION ["displaydata"] ["name"]]["results_per_page"];
        } elseif (($_SESSION['displaydata'][$_SESSION["displaydata"]["name"]]["page"]-1) * $_SESSION['displaydata'][$_SESSION ["displaydata"] ["name"]]["results_per_page"] + $_SESSION['displaydata'][$_SESSION ["displaydata"] ["name"]]["results_per_page"]>$_SESSION['displaydata'][$_SESSION ["displaydata"] ["name"]]["TotalLines"])
                 {
                    $low = ($_SESSION['displaydata'][$_SESSION["displaydata"]["name"]]["page"]-1) * $_SESSION['displaydata'][$_SESSION ["displaydata"] ["name"]]["results_per_page"];
                    $high = $_SESSION['displaydata'][$_SESSION ["displaydata"] ["name"]]["TotalLines"];
                 }else{
                        $low = ($_SESSION['displaydata'][$_SESSION["displaydata"]["name"]]["page"]-1) * $_SESSION['displaydata'][$_SESSION ["displaydata"] ["name"]]["results_per_page"];
                        $high = ($_SESSION['displaydata'][$_SESSION["displaydata"]["name"]]["page"]-1) * $_SESSION['displaydata'][$_SESSION ["displaydata"] ["name"]]["results_per_page"] + $_SESSION['displaydata'][$_SESSION ["displaydata"] ["name"]]["results_per_page"];               
           }   
            $this->setLimit($low, $high); 
    }

    function formopen() {
        if ($_SESSION['displaydata'][$_SESSION ["displaydata"] ["name"]]["InLineEdit"]) {
//            echo '<form id="' . $_SESSION["displaydata"]["name"] . 'inlineedit" name="' . $_SESSION["displaydata"]["name"] . 'inlineedit" method="post" action="' . $_SESSION['displaydata'][$_SESSION["displaydata"]["name"]]["urlparms"] . '">';
        }
    }

    function formopenbody() {
        if ($_SESSION['displaydata'][$_SESSION ["displaydata"] ["name"]]["InLineEdit"]) {
            //          echo '<form id="' . $_SESSION["displaydata"]["name"] . 'inlineedit" name="' . $_SESSION["displaydata"]["name"] . 'inlineedit" method="post" action="' . $_SESSION['displaydata'][$_SESSION["displaydata"]["name"]]["urlparms"] . '">';
        }
    }

    function formopenfoot() {
        if ($_SESSION['displaydata'][$_SESSION ["displaydata"] ["name"]]["InLineEdit"]) {
//            echo '<form id="inlinedir' . $_SESSION ["displaydata"] ["name"] . '" name="inlinedir' . $_SESSION ["displaydata"] ["name"] . '" method="post" action="' . $_SESSION['displaydata'][$_SESSION["displaydata"]["name"]]["urlparms"] . '">';
        }
    }

    function formclose() {
        if ($_SESSION['displaydata'][$_SESSION ["displaydata"] ["name"]]["InLineEdit"]) {
//            echo '</form>';
        }
    }

    function tableclose() {
        echo '</tr></table>';
    }

    function formatdata($field) {
        $value = '';
        if ($_SESSION['displaydata'][$_SESSION ["displaydata"] ["name"]]["TotalLines"] > 0) {
            $type = $_SESSION['displaydata'][$_SESSION ["displaydata"] ["name"]]["type"][$field]['type'];
            $inlinetype = $_SESSION['displaydata'][$_SESSION ["displaydata"] ["name"]]["inlinetype"][$field]['type'];
            if (!isset($_SESSION['displaydata'][$_SESSION ["displaydata"] ["name"]]["chgline"])) {
                $_SESSION['displaydata'][$_SESSION ["displaydata"] ["name"]]["chgline"] = 0;
            }
            if (!isset($_SESSION['displaydata'][$_SESSION["displaydata"]["name"]]["row"])) {
                $_SESSION['displaydata'][$_SESSION["displaydata"]["name"]]["row"] = 0;
            }
            if ($_SESSION['displaydata'][$_SESSION ["displaydata"] ["name"]]["firstline"] + $_SESSION['displaydata'][$_SESSION ["displaydata"] ["name"]]["currrow"] == $_SESSION['displaydata'][$_SESSION ["displaydata"] ["name"]]["chgline"]) {
                // Apply a control type to the value
                $validate = new validate();
                switch ($inlinetype) {
                    case self::INLINE_TEXT:
                        $value = '<input type="text" name="' . $_SESSION['displaydata'][$_SESSION ["displaydata"] ["name"]]["inlinetype"][$field]['name'] . '" size="' . $_SESSION['displaydata'][$_SESSION ["displaydata"] ["name"]]["inlinetype"][$field]['size'] . '" class="' . $_SESSION['displaydata'][$_SESSION ["displaydata"] ["name"]]["inlinetype"][$field]['class'] . '" value= "' . $_SESSION['displaydata'][$_SESSION ["displaydata"] ["name"]]["row"][$_SESSION['displaydata'][$_SESSION ["displaydata"] ["name"]]["line"] - 1][$field] . '">';
                        break;
                    case self::INLINE_TEXTBOX:
                        $value = '<textarea name="' . $_SESSION['displaydata'][$_SESSION ["displaydata"]["name"]]["inlinetype"][$field]['name'] . '" class="' . $_SESSION['displaydata'][$_SESSION ["displaydata"] ["name"]]["inlinetype"][$field]['class'] . '" col=' . $_SESSION['displaydata'][$_SESSION ["displaydata"] ["name"]]["inlinetype"][$field]['col'] . ' row=' . $_SESSION['displaydata'][$_SESSION ["displaydata"] ["name"]]["inlinetype"][$field]['row'] . '>' . $_SESSION['displaydata'][$_SESSION ["displaydata"] ["name"]]["row"][$_SESSION['displaydata'][$_SESSION ["displaydata"] ["name"]]["line"] - 1][$field] . '</textarea>';
                        break;
                    case self::INLINE_CHECKBOX:
                        $value = '<input type="checkbox" name=' . $_SESSION['displaydata'][$_SESSION ["displaydata"] ["name"]]["inlinetype"][$field]['name'] . ' value="' . $_SESSION['displaydata'][$_SESSION ["displaydata"] ["name"]]["row"][$_SESSION['displaydata'][$_SESSION ["displaydata"] ["name"]]["line"] - 1][$field] . '">';
                        break;
                    case self::INLINE_RADIO:
                        if (isset($checked)) {
                            $value = '<input type="radio" name=' . $_SESSION['displaydata'][$_SESSION ["displaydata"] ["name"]]["inlinetype"][$field]['name'] . ' value="' . $_SESSION[$_SESSION["displaydata"]["name"]]["row"][$_SESSION[$_SESSION["displaydata"]["name"]]["line"]][$field] . '"checked >';
                        } else {
                            $value = '<input type="radio" name=' . $_SESSION['displaydata'][$_SESSION ["displaydata"] ["name"]]["inlinetype"][$field]['name'] . ' value="' . $_SESSION['displaydata'][$_SESSION ["displaydata"] ["name"]]["row"][$_SESSION['displaydata'][$_SESSION ["displaydata"] ["name"]]["line"] - 1][$field] . '">';
                        }
                        break;
                    case self::INLINE_FILE:
                         $value = $validate->fileComboBox(
                                $_SESSION['displaydata'][$_SESSION ["displaydata"] ["name"]]["inlinetype"][$field]['name'], 
                                $_SESSION['displaydata'][$_SESSION ["displaydata"] ["name"]]["inlinetype"][$field]['directory'], 
                                $_SESSION['displaydata'][$_SESSION ["displaydata"] ["name"]]["inlinetype"][$field]['css_class'], 
                                $_SESSION['displaydata'][$_SESSION ["displaydata"] ["name"]]["inlinetype"][$field]['PleaseSelect'], 
                                $_SESSION['displaydata'][$_SESSION ["displaydata"] ["name"]]["row"][$_SESSION['displaydata'][$_SESSION ["displaydata"] ["name"]]["line"] - 1][$field], 
                                $_SESSION['displaydata'][$_SESSION ["displaydata"] ["name"]]["inlinetype"][$field]['noinput'], 
                                $_SESSION['displaydata'][$_SESSION ["displaydata"] ["name"]]["inlinetype"][$field]['AllowNew'], 
                                $_SESSION['displaydata'][$_SESSION ["displaydata"] ["name"]]["inlinetype"][$field]['newname'], 
                                $_SESSION['displaydata'][$_SESSION ["displaydata"] ["name"]]["inlinetype"][$field]['new']);
                        break;
                    case self::INLINE_CODECOMBO:
                        $value = $validate->CodeCombo($_SESSION['displaydata'][$_SESSION ["displaydata"] ["name"]]["inlinetype"][$field]['name'], $_SESSION['displaydata'][$_SESSION ["displaydata"] ["name"]]["inlinetype"][$field]['table'], $_SESSION['displaydata'][$_SESSION ["displaydata"] ["name"]]["inlinetype"][$field]['field'], $_SESSION['displaydata'][$_SESSION ["displaydata"] ["name"]]["inlinetype"][$field]['class'], $_SESSION['displaydata'][$_SESSION ["displaydata"] ["name"]]["row"][$_SESSION['displaydata'][$_SESSION ["displaydata"] ["name"]]["line"] - 1][$field]);
                        break;
                    case self::INLINE_COMBOBOX:
                        $value = $validate->ComboBox($_SESSION['displaydata'][$_SESSION ["displaydata"] ["name"]]["inlinetype"][$field]['name'], $_SESSION['displaydata'][$_SESSION ["displaydata"] ["name"]]["inlinetype"][$field]['table'], $_SESSION['displaydata'][$_SESSION ["displaydata"] ["name"]]["inlinetype"][$field]['where'], $_SESSION['displaydata'][$_SESSION ["displaydata"] ["name"]]["inlinetype"][$field]['order_by'], $_SESSION['displaydata'][$_SESSION ["displaydata"] ["name"]]["inlinetype"][$field]['asc'], $_SESSION['displaydata'][$_SESSION ["displaydata"] ["name"]]["inlinetype"][$field]['value'], $_SESSION['displaydata'][$_SESSION ["displaydata"] ["name"]]["inlinetype"][$field]['display'], $_SESSION['displaydata'][$_SESSION ["displaydata"] ["name"]]["inlinetype"][$field]['class'], $_SESSION['displaydata'][$_SESSION ["displaydata"] ["name"]]["inlinetype"][$field]['pleaseselect'], $_SESSION['displaydata'][$_SESSION ["displaydata"] ["name"]]["inlinetype"][$field]['commonelements'], $_SESSION['displaydata'][$_SESSION ["displaydata"] ["name"]]["row"][$_SESSION['displaydata'][$_SESSION ["displaydata"] ["name"]]["line"] - 1][$field], $_SESSION['displaydata'][$_SESSION ["displaydata"] ["name"]]["inlinetype"][$field]['noinput'], $_SESSION['displaydata'][$_SESSION ["displaydata"] ["name"]]["inlinetype"][$field]['AllowNew'], $_SESSION['displaydata'][$_SESSION ["displaydata"] ["name"]]["inlinetype"][$field]['newname'], $_SESSION['displaydata'][$_SESSION ["displaydata"] ["name"]]["inlinetype"][$field]['new'], $_SESSION['displaydata'][$_SESSION ["displaydata"] ["name"]]["inlinetype"][$field]['size'], $_SESSION["preferences"]["database"]["dbname"]);
                        break;
                    case self::INLINE_DATECOMBO:
                        $value = $validate->DateCombo($_SESSION['displaydata'][$_SESSION["displaydata"]["name"]]["inlinetype"][$field]['name'], $_SESSION['displaydata'][$_SESSION["displaydata"]["name"]]["inlinetype"][$field]['classtext'], $_SESSION['displaydata'][$_SESSION["displaydata"]["name"]]["inlinetype"][$field]['classctl'], $_SESSION['displaydata'][$_SESSION["displaydata"]["name"]]["inlinetype"][$field]['text'], $_SESSION['displaydata'][$_SESSION["displaydata"]["name"]]["row"][$_SESSION['displaydata'][$_SESSION ["displaydata"] ["name"]]["line"] - 1][$field]);
                        break;
                    case self::INLINE_EMAIL:
                        $value = '<input type="text" name="' . $_SESSION['displaydata'][$_SESSION ["displaydata"] ["name"]]["inlinetype"][$field]['name'] . '" size="' . $_SESSION['displaydata'][$_SESSION ["displaydata"] ["name"]]["inlinetype"][$field]['size'] . '" class="' . $_SESSION['displaydata'][$_SESSION ["displaydata"] ["name"]]["inlinetype"][$field]['class'] . '" value="' . $validate->Email($_SESSION['displaydata'][$_SESSION ["displaydata"] ["name"]]["row"][$_SESSION['displaydata'][$_SESSION ["displaydata"] ["name"]]["line"] - 1][$field]) . '">';
                        break;
                    case self::INLINE_TELEPHONE:
                        extract($_SESSION['displaydata'][$_SESSION ["displaydata"] ["name"]]["inlinetype"][$field]);
                        $value = '<input type="text" name="' . $name . '" size="' . $size . '" class="' . $class . '" value="' . $validate->Telephone($_SESSION['displaydata'][$_SESSION ["displaydata"] ["name"]]["row"][$_SESSION['displaydata'][$_SESSION ["displaydata"] ["name"]]["line"] - 1][$field]) . '">';
                        break;
                    case self::INLINE_POSTALCODE:
                        $value = '<input type="text" name="' . $_SESSION['displaydata'][$_SESSION ["displaydata"] ["name"]]["inlinetype"][$field]['name'] . '" size="' . $_SESSION['displaydata'][$_SESSION ["displaydata"] ["name"]]["inlinetype"][$field]['size'] . '" class="' . $_SESSION['displaydata'][$_SESSION ["displaydata"] ["name"]]["inlinetype"][$field]['class'] . '" value="' . $validate->PostalCode($_SESSION['displaydata'][$_SESSION ["displaydata"] ["name"]]["row"][$_SESSION['displaydata'][$_SESSION ["displaydata"] ["name"]]["line"] - 1][$field]) . '">';
                        break;
                    case self::INLINE_SINNUMBER:
                        $value = '<input type="text" name="' . $_SESSION['displaydata'][$_SESSION ["displaydata"] ["name"]]["inlinetype"][$field]['name'] . '" size="' . $_SESSION['displaydata'][$_SESSION ["displaydata"] ["name"]]["inlinetype"][$field]['size'] . '" class="' . $_SESSION['displaydata'][$_SESSION ["displaydata"] ["name"]]["inlinetype"][$field]['class'] . '" value="' . $validate->SinNumber($_SESSION['displaydata'][$_SESSION ["displaydata"] ["name"]]["row"][$_SESSION['displaydata'][$_SESSION ["displaydata"] ["name"]]["line"] - 1][$field]) . '">';
                        break;
                    case self::INLINE_NOTE:
                        $value = '<input name="' . $_SESSION['displaydata'][$_SESSION ["displaydata"] ["name"]]["inlinetype"][$field]['name'] . '" class="' . $_SESSION['displaydata'][$_SESSION ["displaydata"] ["name"]]["inlinetype"][$field]['class'] . '" value="' . $_SESSION['displaydata'][$_SESSION ["displaydata"] ["name"]]["inlinetype"][$field]['text'] . '" type="submit" size="' . $_SESSION['displaydata'][$_SESSION ["displaydata"] ["name"]]["inlinetype"][$field]['size'] . '>';
                        if (!isset($_SESSION['displaydata']["inlinenote"])) {
                            $_SESSION['displaydata']["inlinenote"] = array();
                        }
                        if (!array_key_exists($_SESSION['displaydata'][$_SESSION ["displaydata"] ["name"]]["inlinetype"][$field]['name'], $_SESSION['displaydata']["inlinenote"])) {
                            $_SESSION['displaydata']["inlinenote"][] = $_SESSION['displaydata'][$_SESSION ["displaydata"] ["name"]]["inlinetype"][$field]['name'];
                        }
                        break;
                    default:
                        $value = '<input type="text" value="' . $_SESSION['displaydata'][$_SESSION ["displaydata"] ["name"]]["row"][$_SESSION['displaydata'][$_SESSION ["displaydata"] ["name"]]["line"] - 1][$field] . '">';
                }
            } else {
                // Apply a field type to the value}
                if ($_SESSION['displaydata'][$_SESSION["displaydata"]["name"]]["row"] > 0) {
                    if (is_array($_SESSION['displaydata'][$_SESSION ["displaydata"] ["name"]]["type"][$field])) {
                        extract($_SESSION['displaydata'][$_SESSION ["displaydata"] ["name"]]["type"][$field]);
                    }
                    $validate = new validate();
                    switch ($type) {
                        case self::TYPE_ONCLICK:
                            if ($value) {
                                $value = '<a href="javascript:;" onclick="' . $this->parseVariables($_SESSION['displaydata'][$_SESSION ["displaydata"] ["name"]]["row"][$field], $criteria) . '">' . $value . '</a>';
                            }
                            break;
                        case self::TYPE_HREF:
                            if ($value) {
                                $value = '<a href="' . $this->parseVariables($_SESSION['displaydata'][$_SESSION ["displaydata"] ["name"]]["row"][$field], $criteria) . '">' . $value . '</a>';
                            }
                            break;
                        case self::TYPE_DATE:
                            $format = $_SESSION["preferences"]['dateformat'];
                            if (isset($_SESSION['displaydata'][$_SESSION ["displaydata"] ["name"]]["row"][$_SESSION['displaydata'][$_SESSION ["displaydata"] ["name"]]["line"] - 1][$field])) {
                                $value = date($format, strtotime($_SESSION['displaydata'][$_SESSION ["displaydata"] ["name"]]["row"][$_SESSION['displaydata'][$_SESSION ["displaydata"] ["name"]]["line"] - 1][$field]));
                            } else {
                                $value = date($format);
                            }
                            break;
                        case self::TYPE_IMAGE:
                            $value = '<img src="' . $this->parseVariables($_SESSION['displaydata'][$_SESSION ["displaydata"] ["name"]]["row"][$_SESSION['displaydata'][$_SESSION ["displaydata"] ["name"]]["line"] - 1][$field], $criteria) . '" id="' . $field . '-' . $_SESSION['displaydata'][$_SESSION ["displaydata"] ["name"]]['i'] . '">';
                            break;
                        case self::TYPE_ARRAY:
                            $value = $criteria[$value];
                            break;
                        case self::TYPE_CHECK:
                            if ($value == '1' or $value == 'yes' or $value == 'true' or ( $criteria != '' and $value == $criteria)) {
                                $value = '<img src="' . $this->image_path . 'check.gif">';
                            }
                            break;
                        case self::TYPE_PERCENT:
                            if ($criteria) {
                                $value *= 100; // Value is in decimal format
                            }
                            $value = round($value); // Round to the nearest decimal
                            $value .= '%';
                            // Apply a bar if an array is supplied via criteria_2
                            if (is_array($criteria_2)) {
                                $value = '<div style="background: ' . $criteria_2 ["Back"] . '; width: ' . $value . '; color: ' . $criteria_2 ["Fore"] . ';">' . $value . '</div>';
                            }
                            break;
                        case self::TYPE_DOLLAR:
                            $value = '$' . number_format($value, 2);
                            break;
                        case self::TYPE_CUSTOM:
                            $value = $this->parseVariables($_SESSION['displaydata'][$_SESSION ["displaydata"] ["name"]]["row"][$_SESSION['displaydata'][$_SESSION ["displaydata"] ["name"]]["line"] - 1][$field], $criteria);
                            break;
                        case self::TYPE_FUNCTION:
                            if (is_array($criteria_2)) {
                                $value = call_user_func_array($criteria, $this->parseVariables($_SESSION['displaydata'][$_SESSION ["displaydata"] ["name"]]["row"][$_SESSION['displaydata'][$_SESSION ["displaydata"] ["name"]]["line"] - 1][$field], $criteria_2));
                            } else {
                                $value = call_user_func($criteria, $this->parseVariables($_SESSION['displaydata'][$_SESSION ["displaydata"] ["name"]]["row"][$_SESSION['displaydata'][$_SESSION ["displaydata"] ["name"]]["line"] - 1][$field], $criteria_2));
                            }
                            break;
                        case self::TYPE_CODEDISPLAY:
                            $value = $validate->CodeDisplay($table, $field, $class, $_SESSION['displaydata'][$_SESSION ["displaydata"] ["name"]]["row"][$_SESSION['displaydata'][$_SESSION["displaydata"] ["name"]]["line"] - 1][$field]);
                            break;
                        case self::TYPE_FIELD:
                            $value = $validate->FieldDisplay($table, $displayfield, $inputfield, $_SESSION['displaydata'][$_SESSION ["displaydata"] ["name"]]["row"][$_SESSION['displaydata'][$_SESSION ["displaydata"] ["name"]]["line"] - 1][$field]);
                            break;
                        case self::TYPE_SQLCODEDISPLAY:
                            $value = $validate->SQLCodeDisplay($sql,$field, $_SESSION['displaydata'][$_SESSION ["displaydata"] ["name"]]["row"][$_SESSION['displaydata'][$_SESSION ["displaydata"] ["name"]]["line"] - 1][$code]);
                            break;
                        case self::TYPE_DATE:
                            $value = $_SESSION['displaydata'][$_SESSION ["displaydata"] ["name"]]["row"][$_SESSION['displaydata'][$_SESSION ["displaydata"] ["name"]]["line"] - 1][$field];
                        case self::TYPE_TEXT:
                            $value = $_SESSION['displaydata'][$_SESSION ["displaydata"] ["name"]]["row"][$_SESSION['displaydata'][$_SESSION ["displaydata"] ["name"]]["line"] - 1][$field];
                            break;
                        case self::TYPE_TEXTBOX:
                            $value = '<textarea name="' . $_SESSION['displaydata'][$_SESSION ["displaydata"]["name"]]["inlinetype"][$field]['name'] . '" class="' . $_SESSION['displaydata'][$_SESSION ["displaydata"] ["name"]]["inlinetype"][$field]['class'] . '" col=' . $_SESSION['displaydata'][$_SESSION ["displaydata"] ["name"]]["inlinetype"][$field]['col'] . ' row=' . $_SESSION['displaydata'][$_SESSION ["displaydata"] ["name"]]["inlinetype"][$field]['row'] . '>' . $_SESSION['displaydata'][$_SESSION ["displaydata"] ["name"]]["row"][$_SESSION['displaydata'][$_SESSION ["displaydata"] ["name"]]["line"] - 1][$field] . '</textarea>';
                            break;
                        case self::TYPE_NOTE:
                            if ($_SESSION['displaydata'][$_SESSION ["displaydata"] ["name"]]["TotalLines"] > 0) {
                                $value = '<input name="' . $name . '" class="' . $class . '" value="' . $text . '" type="submit" size="' . $size . '" >';
                            }
                            if (!array_key_exists($name, $_SESSION['displaydata'][$_SESSION ["displaydata"] ["name"]]["type"]["notes"])) {
                                $_SESSION['displaydata'][$_SESSION ["displaydata"] ["name"]]["notes"][] = $name;
                            }
                            break;
                        case self::TYPE_EMAIL:
                            $value = $validate->Email($_SESSION['displaydata'][$_SESSION ["displaydata"] ["name"]]["row"][$_SESSION['displaydata'][$_SESSION ["displaydata"] ["name"]]["line"] - 1][$field]);
                            break;
                        case self::TYPE_TELEPHONE:
                            $value = $validate->Telephone($_SESSION['displaydata'][$_SESSION ["displaydata"] ["name"]]["row"][$_SESSION['displaydata'][$_SESSION ["displaydata"] ["name"]]["line"] - 1][$field]);
                            break;
                        default:
                            // Invalid field type
                            $value = '';
                            break;
                    }
                }
            }
        }
        return $value;
    }

    function displayaddrecord() {

        echo '<input class="" type="submit" name="' . $_SESSION["displaydata"]["name"] . 'addrec" value="' . $_SESSION['displaydata'][$_SESSION ["displaydata"] ["name"]]["create_button"]["Text"] . '">';
        $_SESSION['displaydata'][$_SESSION ["displaydata"] ["name"]]["click"] = true;
    }

    function resetrec() {
        echo '<input class="" type="submit" name="' . $_SESSION["displaydata"]["name"] . 'resetrec" onclick="tblReset()" value="' . $_SESSION['displaydata'][$_SESSION ["displaydata"] ["name"]]["reset_button"] . '">';
        $_SESSION['displaydata'][$_SESSION ["displaydata"] ["name"]]["click"] = true;
    }

    function editcontrols() {
        // Add controls as needed
        if ($_SESSION['displaydata'][$_SESSION ["displaydata"] ["name"]]["InLineEdit"]) {
            if ($_SESSION['displaydata'][$_SESSION ["displaydata"] ["name"]]["editline"] == $_SESSION['displaydata'][$_SESSION ["displaydata"] ["name"]]["line"]) {
                //Save Record
                $_SESSION['displaydata'][$_SESSION ["displaydata"] ["name"]]["controls"][1] = '<input class="" type="submit" name="saveline[]" value="Save' . $_SESSION['displaydata'][$_SESSION ["displaydata"] ["name"]]["line"] . '">';
//					//Cancel Record
                $_SESSION['displaydata'][$_SESSION ["displaydata"] ["name"]]["controls"][2] = '<input class="" type="submit" name="cancelline[]" value="Cancel' . $_SESSION['displaydata'][$_SESSION ["displaydata"] ["name"]]["line"] . '">';
            } else {
                //Edit Record
                $_SESSION['displaydata'][$_SESSION ["displaydata"] ["name"]]["controls"][1] = '<input class="" type="submit" name="editline[]" value="Edit' . $_SESSION['displaydata'][$_SESSION ["displaydata"] ["name"]]["line"] . '">';
                //Delete Record
                $_SESSION['displaydata'][$_SESSION ["displaydata"] ["name"]]["controls"][2] = '<input class="" type="submit" name="deleteline[]" value="Delete' . $_SESSION['displaydata'][$_SESSION ["displaydata"] ["name"]]["line"] . '">';
            }
        }
        if (count($_SESSION['displaydata'][$_SESSION ["displaydata"] ["name"]]["controls"]) > 0) {
            echo '<td class="tbl-controls">';
            foreach ($_SESSION['displaydata'][$_SESSION ["displaydata"] ["name"]]["controls"] as $ctl) {
                echo $this->parseVariables($_SESSION['displaydata'][$_SESSION ["displaydata"] ["name"]]["row"], $ctl);
            }
            echo '</td>';
        }
    }

    function dirfirst() {
        echo '<input class="" type="submit" name="' . $_SESSION["displaydata"]["name"] . 'dirfirst" onclick="tblSetPage(1)" value="First">';
        $_SESSION['displaydata'][$_SESSION ["displaydata"] ["name"]]["click"] = true;
    }

    function dirprevious() {
        echo '<input class="" type="submit" name="' . $_SESSION["displaydata"]["name"] . 'dirprevious" onclick="tblSetPage(' . ($_SESSION['displaydata'][$_SESSION ["displaydata"] ["name"]]["page"] - 1) . ')" value="Previous">';
        $_SESSION['displaydata'][$_SESSION ["displaydata"] ["name"]]["click"] = true;
    }

    function dirnext() {
        echo '<input class="" type="submit" name="' . $_SESSION["displaydata"]["name"] . 'dirnext" onclick="tblSetPage(' . ($_SESSION['displaydata'][$_SESSION ["displaydata"] ["name"]]["page"] + 1) . ')" value="Next">';
        $_SESSION['displaydata'][$_SESSION ["displaydata"] ["name"]]["click"] = true;
    }

    function dirlast() {
        $pages = ceil($_SESSION['displaydata'][$_SESSION ["displaydata"] ["name"]]["row_count"] / $_SESSION['displaydata'][$_SESSION ["displaydata"] ["name"]]["results_per_page"]); // Total number of pages
        echo '<input class="" type="submit" name="' . $_SESSION["displaydata"]["name"] . 'dirlast" onclick="tblSetPage(' . $pages . ')" value="Last">';
        $_SESSION['displaydata'][$_SESSION ["displaydata"] ["name"]]["click"] = true;
    }

    function dirgraphics() {
        if ($_SESSION['displaydata'][$_SESSION ["displaydata"] ["name"]]["row_count"] > $_SESSION['displaydata'][$_SESSION ["displaydata"] ["name"]]["results_per_page"]) {
            if ($_SESSION['displaydata'][$_SESSION ["displaydata"] ["name"]]["page"] > 1)
                echo '<a hre="javascript:;" onclick="tblSetPage(' . $first . ')"><img src="' . $this->image_path . 'arrow_first.gif" class="tbl-arrows" alt="&lt;&lt;" title="First Page"></a><a href="javascript:;" onclick="tblSetPage(' . $first . ')><img src="' . $this->image_path . 'arrow_left.gif" class="tbl-arrows" alt="&lt;" title="Previous Page"></a>';
            else
                echo '<img src="' . $this->image_path . 'arrow_first_disabled.gif" class="tbl-arrows" alt="&lt;&lt;" title="First Page"><img src="' . $this->image_path . 'arrow_left_disabled.gif" class="tbl-arrows" alt="&lt;" title="Previous Page">';

            // Special thanks to ionut for this next few lines
            $startpage = ($_SESSION['displaydata'][$_SESSION ["displaydata"] ["name"]]["page"] > 10) ? $_SESSION['displaydata'][$_SESSION ["displaydata"] ["name"]]["page"] - 10 : 1;

            $endpage = (($pages - 10) > $_SESSION['displaydata'][$_SESSION ["displaydata"] ["name"]]["page"]) ? $_SESSION['displaydata'][$_SESSION ["displaydata"] ["name"]]["page"] + 10 : $pages;

            // Only display a portion of the selectable pages
            for ($_SESSION['displaydata'][$_SESSION ["displaydata"] ["name"]]['i'] = $startpage; $_SESSION['displaydata'][$_SESSION ["displaydata"] ["name"]]['i'] <= $endpage; $_SESSION['displaydata'][$_SESSION ["displaydata"] ["name"]]['i'] ++) {
                if ($_SESSION['displaydata'][$_SESSION ["displaydata"] ["name"]]['i'] == $_SESSION['displaydata'][$_SESSION ["displaydata"] ["name"]]["page"])
                    echo '&nbsp;<span class="page-selected">' . $_SESSION['displaydata'][$_SESSION ["displaydata"] ["name"]]['i'] . '</span>&nbsp;';
                else
                    echo '&nbsp;<a href="javascript:;" onclick="tblSetPage(' . $_SESSION['displaydata'][$_SESSION ["displaydata"] ["name"]]['i'] . ')">' . $_SESSION['displaydata'][$_SESSION ["displaydata"] ["name"]]['i'] . '</a>&nbsp;';
            }

            if ($_SESSION['displaydata'][$_SESSION ["displaydata"] ["name"]]["page"] < $pages)
                echo '<a href="javascript:;" onclick="tblSetPage(' . ($_SESSION['displaydata'][$_SESSION ["displaydata"] ["name"]]["page"] + 1) . ')"><img src="' . $this->image_path . 'arrow_right.gif" class="tbl-arrows" alt="&gt;" title="Next Page"></a><a href="javascript:;" onclick="tblSetPage(' . $pages . ')"><img src="' . $this->image_path . 'arrow_last.gif" class="tbl-arrows" alt="&gt;&gt;" title="Last Page"></a>';
            else
                echo '<img src="' . $this->image_path . 'arrow_right_disabled.gif" class="tbl-arrows" alt="&gt;" title="Next Page"><img src="' . $this->image_path . 'arrow_last_disabled.gif" class="tbl-arrows" alt="&gt;&gt;" title="Last Page">';
        }
    }

    function pageXofY() {
        $pages = ceil($_SESSION['displaydata'][$_SESSION ["displaydata"] ["name"]]["row_count"] / $_SESSION['displaydata'][$_SESSION ["displaydata"] ["name"]]["results_per_page"]); // Total number of pages
        if ($pages > 0) {
            echo 'Page ';
            if (!$_SESSION['displaydata'][$_SESSION ["displaydata"] ["name"]]["hide_page_list"]and $pages > 1) {
                // Create a selectable drop down list for pages
                echo '<select name="tbl-page" onchange="tblSetPage(this.options[this.selectedIndex].value)">';
                for ($x = 1; $x <= $pages; $x++) {
                    echo '<option value="' . $x . '"';
                    if ($x == $_SESSION['displaydata'][$_SESSION ["displaydata"] ["name"]]["page"])
                        echo ' selected="selected"';
                    echo '>' . $x . '</option>';
                }
                echo '</select>';
            } else
                echo $_SESSION['displaydata'][$_SESSION ["displaydata"] ["name"]]["page"]; // Just write the page number, nothing to fancy

            echo ' of ' . $pages;
        }
    }

    function foundXresultsshowingYtoZ() {
        echo "  " . $_SESSION['displaydata'][$_SESSION ['displaydata'] ['name']]['field_count'] . " Found <em>" . $_SESSION['displaydata'][$_SESSION ['displaydata'] ['name']]['TotalLines'] . "</em> results";

        if ($_SESSION['displaydata'][$_SESSION ["displaydata"] ["name"]]["row_count"] > 0)
            echo ',   showing <em>' . $_SESSION['displaydata'][$_SESSION ["displaydata"] ["name"]]["firstline"] . '</em> to <em>' . $_SESSION['displaydata'][$_SESSION ["displaydata"] ["name"]]["lastline"] . '</em>';
    }

    /**
     * Outputs the di+splaydata to the screen
     *
     */
    function printdata() {
        $template = new $_SESSION["displaydata"][$_SESSION ["displaydata"] ["name"]]["template"]($this->db);
        $this->checkaddrecord();
        $this->checkreset();
        $this->checkcontrols();
        $this->checkdatasource();
        $this->setpagelimit();
        $this->dbselect();
        $this->checkajax();
        $template->head();
        $this->setrowsandlines();
        $this->displaylines();
        $template->foot();
    }

    function printTable() {
        $this->checkaddrecord();
        $this->checkreset();
        $this->checkcontrols();
        $this->checkdatasource();
        $this->setpagelimit();
        $this->dbselect();
        $this->formopen();
        $this->buildaddrec();
        $this->buildreset();
        $this->buildHeader();
        $this->checkrowcount();
        $this->setrowsandlines();
        $this->displaylinestable();
        $this->formclose();
        $this->buildFooter($_SESSION['displaydata'][$_SESSION ["displaydata"] ["name"]]['i'], $_SESSION['displaydata'][$_SESSION ["displaydata"] ["name"]]["firstline"], $_SESSION['displaydata'][$_SESSION ["displaydata"] ["name"]]["lastline"]);
        $this->tableclose();
    }
}
