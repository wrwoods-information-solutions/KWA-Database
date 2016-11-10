<?php 
/**
 * *****************************************************
 * @file     class.menu.php
 * @brief    This class operates the Menu System 
 * @author    W.R.(Ric)Woods
 * @version   1.0
 * @copyright 2016
 * @date      
 * ******************************************************/
require_once "class.pdodatabase.php";
require_once "class.plaintemplate.php";
include_once "class.log.php";

class menu
{
/**
* The name of the package
* @access private
* @var string
*/
var $_packageName;
/**
* The version of the package
* @access private
* @var string
*/
var $version;
/**
* The copyright of the package
* @access private
* @var string
*/
var $copyright;
/**
* The author of the package
* @access private
* @var string
*/
var $author;

/**
* URL to be prepended to the menu links
* @access private
* @var string
*/
var $prependedUrl = "";
/**
* Do you want that code execution halts on error?
* @access private
* @var string
*/
var $haltOnError = "yes";

/**
* The base directory where the package is installed
* @access private
* @var string
*/
var $dirroot;
/**
* The "lib" directory of the package
* @access private
* @var string
*/
var $libdir;
/**
* The "libjs" directory of the package
* @access private
* @var string
*/
var $libjsdir;
/**
* The http path corresponding to libjsdir
* @access private
* @var string
*/
var $libjswww;
/**
* The directory where images related to the menu can be found
* @access private
* @var string
*/
var $imgdir;
/**
* The http path corresponding to imgdir
* @access private
* @var string
*/
var $imgwww;
/**
* The directory where templates can be found
* @access private
* @var string
*/
var $tpldir;
/**
* The template to be used for the first level menu of a horizontal menu.
*
* The value of this variable is significant only when preparing
* a horizontal menu.
*
* @access private
* @var string
*/
var $horizontalMenuTpl;
/**
* The template to be used for the first level menu of a vertical menu.
*
* The value of this variable is significant only when preparing
* a vertical menu.
*
* @access private
* @var string
*/
var $verticalMenuTpl;
/**
* The template to be used for submenu layers
* @access private
* @var string
*/
var $subMenuTpl;
/**
* The string containing the menu structure
* @access private
* @var string
*/
var $menuStructure;
/**
* The character used in the menu structure format to separate fields of each item
* @access private
* @var string
*/
var $separator;
/**
* The character used for the Tree Menu in the menu structure format to separate fields of each item
* @access private
* @var string
*/
var $treeMenuSeparator;
/**
* Type of images used for the Tree Menu
* @access private
* @var string
*/
var $treeMenuImagesType;
/**
* An array where we store the Tree Menu code for each menu
* @access private
* @var array
*/
var $_treeMenu;

/**
* It counts nodes for all menus
* @access private
* @var integer
*/
var $_nodesCount;
/**
* A multi-dimensional array where we store informations for each menu entry
* @access private
* @var array
*/
var $tree;
/**
* The maximum hierarchical level of menu items
* @access private
* @var integer
*/
var $_maxLevel;
/**
* An array that counts the number of first level items for each menu
* @access private
* @var array
*/
var $_firstLevelCnt;
/**
* An array containing the number identifying the first item of each menu
* @access private
* @var array
*/
var $_firstItem;
/**
* An array containing the number identifying the last item of each menu
* @access private
* @var array
*/
var $_lastItem;
/**
* A string containing the header needed to use the menu(s) in the page
* @access private
* @var string
*/
var $header;
/**
* Number of layers
* @access private
* @var integer
*/
var $numl;
/**
* The JS function to list layers
* @access private
* @var string
*/
var $listl;
/**
* The JS vector to know the father of each layer
* @access private
* @var string
*/
var $father;
/**
* The JS function to set initial positions of all layers
* @access private
* @var string
*/
var $moveLayers;
/**
* An array containing the code related to the first level menu of each menu
* @access private
* @var array
*/
var $_firstLevelMenu;
/**
* A string containing the footer needed to use the menu(s) in the page
* @access private
* @var string
*/
var $footer;

/**
* The HTML string that is used for forward arrows.
*
* This string can contain either the HTML code of a "text-only" forward arrow,
* e.g. " --&gt;" or the complete HTML tag corresponding to an image used
* as forward arrow
*
* @access private
* @var string
*/
var $forwardArrow;
/**
* Completely analogous to forwardArrow
* @access private
* @var string
*/
var $downArrow;
/**
* Step for the left boundaries of layers
* @access private
* @var integer
*/
var $abscissaStep;
/**
* Estimated value of the vertical distance between adjacent links on a generic layer
* @access private
* @var integer
*/
var $ordinateStep;
/**
* Threshold for vertical repositioning of a layer
* @access private
* @var integer
*/
var $thresholdY;

/**
* Data Source Name: the connection string for PEAR DB
* @access private
* @var string
*/
var $dsn = "pgsql://dbuser:dbpass@dbhost/dbname";
/**
* DB connections are either persistent or not persistent
* @access private
* @var boolean
*/
var $persistent = false;
/**
* Name of the table storing data describing the usermenu
* @access private
* @var string
*/
var $masterTableName = "mastermenu";
/**
* Name of the table storing data describing the mastermenu
* @access private
* @var string
*/
var $userTableName = "usermenu";
/*** Name of the lamguage table corresponding to $mastertableName
* @access private
* @var string
*/
var $menulanguageTableName = "menulanguage";
/**
* Names of fields of the mastertable storing data describing the menu
*
* default field names correspond to the same field names foreseen
* by the menu structure format
*
* @access private
* @var array
*/
var $masterTableFields = array(
	"mastermenuid"	=> "mastermenuid",
	"menuname"      => "menuname",
	"parentid"	    => "parentid",
	"title"         => "title",
	"link"		    => "link",
	"text"			=> "text",
	"icon"			=> "icon",
	"target"		=> "target",
	"orderfield"	=> "orderfield",
	"expanded"		=> "expanded"
);
/**
* Names of fields of the usertable storing data describing the menu
*
* default field names correspond to the same field names foreseen
* by the menu structure format
*
* @access private
* @var array
*/
var $userTableFields = array(
	"usermenuid"	=> "usermenuid",
	"username"      => "username",
	"menuname"	    => "menuname",
	"mastermenuid"  => "mastermenuid",
	"text"			=> "text",
	"orderfield"	=> "orderfield"
);
/*** Names of fields of the language table corresponding to $mastertableName
* @access private
* @var array
*/
var $languageTableFields = array(
	"language"	=> "language",
	"id"		=> "id",
	"text"		=> "text",
	"title"		=> "title"
);
/**
* A temporary array to store data retrieved from the DB and to perform the depth-first search
* @access private
* @var array
*/
var $_tmpArray = array();
/**
* The default value of the expansion string for the PHP Tree Menu
* @access private
* @var string
*/
var $phpTreeMenuDefaultExpansion;
/**
* An array where we store the PHP Vertical Tree Menu code for each menu
* @access private
* @var array
*/
var $_phpVerticalTreeMenu;
/**
* An array where we store the PHP Horizontal Tree Menu code for each menu
* @access private
* @var array
*/
var $_phpHorizontalTreeMenu;
/**
* An array where we store the PHP Vertical Block Menu code for each menu
* @access private
* @var array
*/
var $_phpVerticalBlockMenu;
/**
* An array where we store the PHP Horizontal Block Menu code for each menu
* @access private
* @var array
*/
var $_phpHorizontalBlockMenu;
/**
* An array where we store the PHP Horizontal Block Menu Row code for each menu
* @access private
* @var array
*/
var $_phpHorizontalBlockMenuRow;
/**
* An Variable where we store the PHP Horizontal Block Menu mastermenuid
* @access private
* @var array
*/
var $mastermenuid;
/**
* The character used for the Plain Menu in the menu structure format to separate fields of each item
* @access private
* @var string
*/
var $plainMenuSeparator;
/**
* The template to be used for the Plain Menu
*/
var $plainMenuTpl;
/**
* An array where we store the Plain Menu code for each menu
* @access private
* @var array
*/
var $_plainMenu;

/**
* The character used for the Horizontal Plain Menu in the menu structure format to separate fields of each item
* @access private
* @var string
*/
var $horizontalPlainMenuSeparator;
/**
* The template to be used for the Horizontal Plain Menu
*/
var $horizontalPlainMenuTpl;
/**
* An array where we store the Horizontal Plain Menu code for each menu
* @access private
* @var array
*/
var $_horizontalPlainMenu;

/**
* The constructor method; it initializates the menu system
* @return void
*/
function Menu(
	$abscissaStep = 140,
	$ordinateStep = 20,
	$thresholdY = 20
	) {

	$this->_packageName = "Menu";
	$this->version = "1.0";
	$this->copyright = "(C) 2009";
	$this->author = "WR Woods Information Solutions Inc.";

	$this->prependedUrl = "";

	$this->dirroot = "";
	$this->libdir = "lib/";
	$this->libjsdir = "libjs/";
	$this->libjswww = "libjs/";
	$this->imgdir = "images/";
	$this->imgwww = "images/";
	$this->tpldir = "templates/";
	$this->horizontalMenuTpl = $this->dirroot . $this->tpldir . "layersmenu-horizontal_menu.ihtml";
 	$this->verticalMenuTpl = $this->dirroot . $this->tpldir . "layersmenu-vertical_menu.ihtml";
	$this->subMenuTpl = $this->dirroot . $this->tpldir . "layersmenu-sub_menu.ihtml";
	$this->menuStructure = "";
	$this->separator = "|";
	$this->treeMenuSeparator = "|";
	$this->treeMenuImagesType = "png";
	$this->_treeMenu = array();

	$this->_nodesCount = 0;
	$this->tree = array();
	$this->_maxLevel = array();
	$this->_maxLevel = array();
	$this->_firstLevelCnt = array();
	$this->_firstItem = array();
	$this->_lastItem = array();
	$this->header = "";
	$this->numl = 0;
	$this->listl = "";
	$this->father = "";
	$this->moveLayers = "";
	$this->_firstLevelMenu = array();
	$this->footer = "";

	$this->forwardArrow = " --&gt;";
	$this->downArrow = " --&gt;";
	$this->abscissaStep = $abscissaStep;
	$this->ordinateStep = $ordinateStep;
	$this->thresholdY = $thresholdY;
//	$this->LayersMenu();
	$this->phpTreeMenuDefaultExpansion = "";
	$this->_phpVerticalTreeMenu = array();

	$this->plainMenuTpl = $this->dirroot . $this->tpldir . "layersmenu-plain_menu.ihtml";
	$this->plainMenuSeparator = "|";
	$this->_plainMenu = array();

	$this->horizontalPlainMenuTpl = $this->dirroot . $this->tpldir . "layersmenu-horizontal_plain_menu.ihtml";
	$this->horizontalPlainMenuSeparator = "|";
	$this->_horizontalPlainMenu = array();
}
/**
* The method to set the value of abscissaStep
* @access public
* @return void
*/
function setAbscissaStep($abscissaStep) {
	$this->abscissaStep = $abscissaStep;
}

/**
* The method to set the value of ordinateStep
* @access public
* @return void
*/
function setOrdinateStep($ordinateStep) {
	$this->ordinateStep = $ordinateStep;
}

/**
* The method to set the value of thresholdY
* @access public
* @return void
*/
function setThresholdY($thresholdY) {
	$this->thresholdY = $thresholdY;
}

/**
* The method to set the prepended URL
* @access public
* @return boolean
*/
function setPrependedUrl($prependedUrl) {
	// We do not perform any check
	$this->prependedUrl = $prependedUrl;
	return true;
}

/**
* The method to set the dirroot directory
* @access public
* @return boolean
*/
function setDirroot($dirroot) {
	if (!is_dir($dirroot)) {
		$this->error("setDirroot: $dirroot is not a directory.");
		return false;
	}
	if (substr($dirroot, -1) != "/") {
		$dirroot .= "/";
	}
	$this->dirroot = $dirroot;
	return true;
}

/**
* The method to set the libdir directory
* @access public
* @return boolean
*/
function setLibdir($libdir) {
	if (substr($libdir, -1) == "/") {
		$libdir = substr($libdir, 0, -1);
	}
	if (str_replace("/", "", $libdir) == $libdir) {
		$libdir = $this->dirroot . $libdir;
	}
	if (!is_dir($libdir)) {
		$this->error("setLibdir: $libdir is not a directory.");
		return false;
	}
	$this->libdir = $libdir . "/";
	return true;
}

/**
* The method to set the libjsdir directory
* @access public
* @return boolean
*/
function setLibjsdir($libjsdir) {
	if (substr($libjsdir, -1) == "/") {
		$libjsdir = substr($libjsdir, 0, -1);
	}
	if (str_replace("/", "", $libjsdir) == $libjsdir) {
		$libjsdir = $this->dirroot . $libjsdir;
	}
	if (!is_dir($libjsdir)) {
		$this->error("setLibjsdir: $libjsdir is not a directory.");
		return false;
	}
	$this->libjsdir = $libjsdir . "/";
	return true;
}

/**
* The method to set libjswww
* @access public
* @return void
*/
function setLibjswww($libjswww) {
	if (substr($libjswww, -1) != "/") {
		$libjswww .= "/";
	}
	$this->libjswww = $libjswww;
}

/**
* The method to set the imgdir directory
* @access public
* @return boolean
*/
function setImgdir($imgdir) {
	if (substr($imgdir, -1) == "/") {
		$imgdir = substr($imgdir, 0, -1);
	}
	if (str_replace("/", "", $imgdir) == $imgdir) {
		$imgdir = $this->dirroot . $imgdir;
	}
	if (!is_dir($imgdir)) {
		$this->error("setImgdir: $imgdir is not a directory.");
		return false;
	}
	$this->imgdir = $imgdir . "/";
	return true;
}

/**
* The method to set imgwww
* @access public
* @return void
*/
function setImgwww($imgwww) {
	if (substr($imgwww, -1) != "/") {
		$imgwww .= "/";
	}
	$this->imgwww = $imgwww;
}

/**
* The method to set the tpldir directory
* @access public
* @return boolean
*/
function setTpldir($tpldir) {
	if (substr($tpldir, -1) == "/") {
		$tpldir = substr($tpldir, 0, -1);
	}
	if (str_replace("/", "", $tpldir) == $tpldir) {
		$tpldir = $this->dirroot . $tpldir;
	}
	if (!is_dir($tpldir)) {
		$this->error("setTpldir: $tpldir is not a directory.");
		return false;
	}
	$this->tpldir = $tpldir . "/";
	// Then we update the default filenames of templates
	$this->horizontalMenuTpl = $this->dirroot . $this->tpldir . "layersmenu-horizontal_menu.ihtml";
	$this->verticalMenuTpl = $this->dirroot . $this->tpldir . "layersmenu-vertical_menu.ihtml";
	$this->subMenuTpl = $this->dirroot . $this->tpldir . "layersmenu-sub_menu.ihtml";
	//
	return true;
}

/**
* The method to set horizontalMenuTpl
* @access public
* @return boolean
*/
function setHorizontalMenuTpl($horizontalMenuTpl) {
	if (str_replace("/", "", $horizontalMenuTpl) == $horizontalMenuTpl) {
		$horizontalMenuTpl = $this->tpldir . $horizontalMenuTpl;
	}
	if (!file_exists($horizontalMenuTpl)) {
		$this->error("setHorizontalMenuTpl: file $horizontalMenuTpl does not exist.");
		return false;
	}
	$this->horizontalMenuTpl = $horizontalMenuTpl;
	return true;
}

/**
* The method to set verticalMenuTpl
* @access public
* @return boolean
*/
function setVerticalMenuTpl($verticalMenuTpl) {
	if (str_replace("/", "", $verticalMenuTpl) == $verticalMenuTpl) {
		$verticalMenuTpl = $this->tpldir . $verticalMenuTpl;
	}
	if (!file_exists($verticalMenuTpl)) {
		$this->error("setVerticalMenuTpl: file $verticalMenuTpl does not exist.");
		return false;
	}
	$this->verticalMenuTpl = $verticalMenuTpl;
	return true;
}

/**
* The method to set subMenuTpl
* @access public
* @return boolean
*/
function setSubMenuTpl($subMenuTpl) {
	if (str_replace("/", "", $subMenuTpl) == $subMenuTpl) {
		$subMenuTpl = $this->tpldir . $subMenuTpl;
	}
	if (!file_exists($subMenuTpl)) {
		$this->error("setSubMenuTpl: file $subMenuTpl does not exist.");
		return false;
	}
	$this->subMenuTpl = $subMenuTpl;
	return true;
}

/**
* A method to set forwardArrow
* @access public
* @param string $forwardArrow the forward arrow HTML code
* @return void
*/
function setForwardArrow($forwardArrow) {
	$this->forwardArrow = $forwardArrow;
}

/**
* The method to set an image to be used for the forward arrow
* @access public
* @param string $forwardArrowImg the forward arrow image filename
* @return boolean
*/
function setForwardArrowImg($forwardArrowImg) {
	if (!file_exists($this->imgdir . $forwardArrowImg)) {
		$this->error("setForwardArrowImg: file " . $this->imgdir . $forwardArrowImg . " does not exist.");
		return false;
	}
	$foobar = getimagesize($this->imgdir . $forwardArrowImg);
	$this->forwardArrow = " <img src=\"" . $this->imgwww . $forwardArrowImg . "\" width=\"" . $foobar[0] . "\" height=\"" . $foobar[1] . "\" border=\"0\" alt=\" >>\" />";
	return true;
}

/**
* A method to set downArrow
* @access public
* @param string $downArrow the down arrow HTML code
* @return void
*/
function setDownArrow($downArrow) {
	$this->downArrow = $downArrow;
}

/**
* The method to set an image to be used for the down arrow
* @access public
* @param string $downArrowImg the down arrow image filename
* @return boolean
*/
function setDownArrowImg($downArrowImg) {
	if (!file_exists($this->imgdir . $downArrowImg)) {
		$this->error("setDownArrowImg: file " . $this->imgdir . $downArrowImg . " does not exist.");
		return false;
	}
	$foobar = getimagesize($this->imgdir . $downArrowImg);
	$this->downArrow = " <img src=\"" . $this->imgwww . $downArrowImg . "\" width=\"" . $foobar[0] . "\" height=\"" . $foobar[1] . "\" border=\"0\" alt=\" >>\" />";
	return true;
}

/**
* The method to read the menu structure from a file
* @access public
* @param string $tree_file the menu structure file
* @return boolean
*/
function setMenuStructureFile($tree_file) {
	if (!($fd = fopen($tree_file, "r"))) {
		$this->error("setMenuStructureFile: unable to open file $tree_file.");
		return false;
	}
	$this->menuStructure = "";
	while ($buffer = fgets($fd, 4096)) {
		$buffer = preg_replace(chr(13), "", $buffer);	// Microsoft Stupidity Suppression
		$this->menuStructure .= $buffer;
	}
	fclose($fd);
	if ($this->menuStructure == "") {
		$this->error("setMenuStructureFile: $tree_file is empty.");
		return false;
	}
	return true;
}

/**
* The method to set the menu structure passing it through a string
* @access public
* @param string $tree_string the menu structure string
* @return boolean
*/
function setMenuStructureString($tree_string) {
	$this->menuStructure = preg_replace(chr(13), "", $tree_string);	// Microsoft Stupidity Suppression
	if ($this->menuStructure == "") {
		$this->error("setMenuStructureString: empty string.");
		return false;
	}
	return true;
}

/**
* The method to set the value of separator
* @access public
* @return void
*/
function setSeparator($separator) {
	$this->separator = $separator;
}

/**
* The method to set parameters for the DB connection
* @access public
* @param string $dns Data Source Name: the connection string for PEAR DB
* @param bool $persistent DB connections are either persistent or not persistent
* @return boolean
*/
function setDBConnParms($dsn, $persistent=false) {
	if (!is_string($dsn)) {
		$this->error("initdb: \$dsn is not an string.");
		return false;
	}
	if (!is_bool($persistent)) {
		$this->error("initdb: \$persistent is not a boolean.");
		return false;
	}
	$this->dsn = $dsn;
	$this->persistent = $persistent;
	return true;
}

/**
* The method to set the name of the table storing data describing the menu
* @access public
* @param string
* @return boolean
*/
function setMasterTableName($masterTableName) {
	if (!is_string($masterTableName)) {
		$this->error("setMasterTableName: \$masterTableName is not a string.");
		return false;
	}
	$_SESSION["preferences"]['menu']["mastertablename"] = $masterTableName;
	return true;
}
function setuserTableName($usertableName) {
	if (!is_string($usertableName)) {
		$this->error("setMasterTableName: \$userTableName is not a string.");
		return false;
	}
	$_SESSION["preferences"]['menu']["usertablename"] = $usertableName;
	return true;
}

/**
* The method to set the name of the i18n table corresponding to $tableName
* @access public
* @param string
* @return boolean
*/
function setlanguageTableName($languageTableName) {
	if (!is_string($languageTableName)) {
		$this->error("set;amguageTableName_i18n: \$languageTableName_i18n is not a string.");
		return false;
	}
	$this->languagetable = $languageTableName;
	return true;
}

/**
* The method to set names of fields of the table storing data describing the menu
* @access public
* @param array
* @return boolean
*/
function setMasterTableFields($masterTableFields) {
	if (!is_array($masterTableFields)) {
		$this->error("setNasterTableFields: \$masterTableFields is not an array.");
		return false;
	}
	if (count($masterTableFields) == 0) {
		$this->error("setMasterTableFields: \$masterTableFields is a zero-length array.");
		return false;
	}
	reset ($masterTableFields);
	while (list($key, $value) = each($masterTableFields)) {
		$_SESSION["preferences"]['menu']["mastertablename"][$key] = ($value == "") ? "''" : $value;
	}
	return true;
}
function setuserTableFields($userTableFields) {
	if (!is_array($userTableFields)) {
		$this->error("setuserTableFields: \$userTableFields is not an array.");
		return false;
	}
	if (count($userTableFields) == 0) {
		$this->error("setMuserTableFields: \$userTableFields is a zero-length array.");
		return false;
	}
	reset ($userTableFields);
	while (list($key, $value) = each($userTableFields)) {
		$_SESSION["preferences"]['menu']["usertablename"][$key] = ($value == "") ? "''" : $value;
	}
	return true;
}
/**
* The method to set names of fields of the i18n table corresponding to $tableName
* @access public
* @param array
* @return boolean
*/
function setLanguasgeTableFields($languageTableFields) {
	if (!is_array($languageTableFields)) {
		$this->error("setLanguageTableFields: \$languageTableFields is not an array.");
		return false;
	}
	if (count($languageTableFields) == 0) {
		$this->error("setLanguageTableFields: \$langusgeTableFields_i18n is a zero-length array.");
		return false;
	}
	reset ($languageTableFields);
	while (list($key, $value) = each($languageTableFields)) {
		$this->languagetableFields[$key] = ($value == "") ? "''" : $value;
	}
	return true;
}

/**
* The method to parse the current menu structure and correspondingly update related variables
* @access public
* @param string $menu_name the name to be attributed to the menu
*   whose structure has to be parsed
* @return void
*/
function parseStructureForMenu(
	$menu_name = ""	// non consistent default...
	) {
	$this->_maxLevel[$menu_name] = 0;
	$this->_firstLevelCnt[$menu_name] = 0;
	$this->_firstItem[$menu_name] = $this->_nodesCount + 1;
	$cnt = $this->_firstItem[$menu_name];
	$menuStructure = $this->menuStructure;

	/* *********************************************** */
	/* Partially based on a piece of code taken from   */
	/* TreeMenu 1.1 - Bjorge Dijkstra (bjorge@gmx.net) */
	/* *********************************************** */

	while ($menuStructure != "") {
		$before_cr = strcspn($menuStructure, "\n");
		$buffer = substr($menuStructure, 0, $before_cr);
		$menuStructure = substr($menuStructure, $before_cr+1);
		if (substr($buffer, 0, 1) != "#") {	// non commented item line...
			$tmp = rtrim($buffer);
			$node = explode($this->separator, $tmp);
			for ($i=count($node); $i<=6; $i++) {
				$node[$i] = "";
			}
			$this->tree[$cnt]["level"] = strlen($node[0]);
			$this->tree[$cnt]["text"] = $node[1];
			$this->tree[$cnt]["link"] = $node[2];
			$this->tree[$cnt]["title"] = $node[3];
			$this->tree[$cnt]["icon"] = $node[4];
			$this->tree[$cnt]["target"] = $node[5];
			$this->tree[$cnt]["expanded"] = $node[6];
			$cnt++;
		}
	}

	/* *********************************************** */

	$this->_lastItem[$menu_name] = count($this->tree);
	$this->_nodesCount = $this->_lastItem[$menu_name];
	$this->tree[$this->_lastItem[$menu_name]+1]["level"] = 0;
	$this->_postParse($menu_name);
}

/**
* The method to parse the current menu table and correspondingly update related variables
* @access public
* @param string $menu_name the name to be attributed to the menu
*   whose structure has to be parsed
* @param string $language i18n language; either omit it or pass
*   an empty string ("") if you do not want to use any i18n table
* @return void
*/
function scanTableForMenu($menu_name = "",$language = "",$user = "") 
{
	$this->_maxLevel[$menu_name] = 0;
	$this->_firstLevelCnt[$menu_name] = 0;
	unset($this->tree[$this->_nodesCount+1]);
	$this->_firstItem[$menu_name] = $this->_nodesCount + 1;
/* BEGIN BENCHMARK CODE
$time_start = $this->_getmicrotime();
/* END BENCHMARK CODE */
	$db = new DBMS($_SESSION["preferences"]["database"]["type"],$_SESSION["preferences"]["database"]['server'],$_SESSION["preferences"]["database"]["dbname"] , $_SESSION["preferences"]["database"]["user"], $_SESSION["preferences"]["database"]["password"],$_SESSION["preferences"]["database"]["port"]);
 	if (strlen($user)>0)
	{
		$sql = "SELECT " .
				$_SESSION["preferences"]['menu']["mastertablename"] .".".$this->masterTableFields["mastermenuid"] . " AS menuid, " .
				$_SESSION["preferences"]['menu']["usertablename"] .".".$this->userTableFields["menuname"] . " AS menuname, " .
				$_SESSION["preferences"]['menu']["usertablename"] .".".$this->userTableFields["orderfield"] . " AS orderfield, " .
				$_SESSION["preferences"]['menu']["mastertablename"] .".".$this->masterTableFields["parentid"] . " AS parentid, " .
				$_SESSION["preferences"]['menu']["mastertablename"] .".".$this->masterTableFields["text"] . " AS text, " .
				$_SESSION["preferences"]['menu']["mastertablename"] .".".$this->masterTableFields["link"] . " AS link, " .
				$_SESSION["preferences"]['menu']["mastertablename"] .".".$this->masterTableFields["icon"] . " AS icon, " .
				$_SESSION["preferences"]['menu']["mastertablename"] .".".$this->masterTableFields["target"] . " AS target, " .
				$_SESSION["preferences"]['menu']["mastertablename"] .".".$this->masterTableFields["expanded"] . " AS expanded".
				" FROM " . $_SESSION["preferences"]['menu']["mastertablename"] .",".$_SESSION["preferences"]['menu']["usertablename"] .
				" WHERE (".$_SESSION["preferences"]['menu']["usertablename"] .".".$this->userTableFields["menuname"] . " = '". $menu_name."') AND (". $_SESSION["preferences"]['menu']["mastertablename"] .".".$this->masterTableFields["mastermenuid"] . " = ".	$_SESSION["preferences"]['menu']["usertablename"] .".".$this->userTableFields["mastermenuid"]. ")".
				"ORDER BY " . $_SESSION["preferences"]['menu']["usertablename"] .".".$this->userTableFields["orderfield"] . " ASC
		";
		$result = $db->query($sql);
                $rows = $result->fetchAll(PDO::FETCH_ASSOC);
		$this->_tmpArray = array();
		foreach ($rows as $row)
                {
			$this->_tmpArray[$row["menuid"]]["menuid"] = $row["menuid"];
			$this->_tmpArray[$row["menuid"]]["menuname"] = $row["menuname"];
			$this->_tmpArray[$row["menuid"]]["orderfield"] = $row["orderfield"];
			$this->_tmpArray[$row["menuid"]]["parentid"] = $row["parentid"];
			$this->_tmpArray[$row["menuid"]]["link"] = $row["link"];
			$this->_tmpArray[$row["menuid"]]["text"] = $row["text"];
			$this->_tmpArray[$row["menuid"]]["icon"] = $row["icon"];
			$this->_tmpArray[$row["menuid"]]["target"] = $row["target"];
			$this->_tmpArray[$row["menuid"]]["expanded"] = $row["expanded"];
		}
	}
	else
	{
		$sql = "SELECT " .
			$this->masterTableFields["mastermenuid"] . " AS menuid, " .
			$this->masterTableFields["menuname"] . " AS menuname, " .
			$this->masterTableFields["orderfield"] . " AS orderfield, " .
			$this->masterTableFields["text"] . " AS text, " .
			$this->masterTableFields["parentid"] . " AS parentid, " .
			$this->masterTableFields["title"] . " AS title, " .
			$this->masterTableFields["link"] . " AS link, " .
			$this->masterTableFields["icon"] . " AS icon, " .
			$this->masterTableFields["target"] . " AS target, " .
			$this->masterTableFields["expanded"] . " AS expanded
		FROM " . $_SESSION["preferences"]['menu']["mastertablename"] . "
		WHERE (" .$_SESSION["preferences"]['menu']["mastertablename"] .".".$this->masterTableFields["menuname"] . " = '". $menu_name."' )
		ORDER BY " . $this->masterTableFields["orderfield"] . " ASC
		";
		$result = $db->query($sql);
		$this->_tmpArray = array();
                $row = array();
		foreach ($result as $row) 
                {
			$this->_tmpArray[$row["menuid"]]["menuid"] = $row["menuid"];
			$this->_tmpArray[$row["menuid"]]["menunzme"] = $row["menuname"];
			$this->_tmpArray[$row["menuid"]]["orderfield"] = $row["orderfield"];
			$this->_tmpArray[$row["menuid"]]["text"] = $row["text"];
			$this->_tmpArray[$row["menuid"]]["parentid"] = $row["parentid"];
			$this->_tmpArray[$row["menuid"]]["text"] = $row["text"];
			$this->_tmpArray[$row["menuid"]]["link"] = $row["link"];
			$this->_tmpArray[$row["menuid"]]["icon"] = $row["icon"];
			$this->_tmpArray[$row["menuid"]]["target"] = $row["target"];
			$this->_tmpArray[$row["menuid"]]["expanded"] = $row["expanded"];
		}
	}
 	if ($language != "")
	{
		$db = new DBMS($_SESSION["preferences"]["database"]["type"],$_SESSION["preferences"]["database"]['server'],$_SESSION["preferences"]["database"]["dbname"] , $_SESSION["preferences"]["database"]["user"], $_SESSION["preferences"]["database"]["password"],$_SESSION["preferences"]["database"]["port"]);
		$result = $db->query("
			SELECT " .
				$this->languageTableFields["id"] . " AS id, " .
				$this->languageTableFields["text"] . " AS text, " .
				$this->languageTableFields["title"] . " AS title
			FROM " . $this->languagetableName. "
			WHERE " . $this->languageTableFields["id"] . " <> 1
				AND " . $this->languageTableFields["language"] . " = '$language'
	");
		foreach ($result as $row) 
                {
			$this->_tmpArray[$row["id"]]["text"] = $row["text"];
			$this->_tmpArray[$row["id"]]["title"] = $row["title"];
		}
	}
	unset($result);
	unset($row);
	$this->_depthFirstSearch($this->_tmpArray, $menu_name, 0, 1);
/* BEGIN BENCHMARK CODE
$time_end = $this->_getmicrotime();
$time = $time_end - $time_start;
print "TIME ELAPSED = " . $time . "\n<br>";
/* END BENCHMARK CODE */
	$this->_lastItem[$menu_name] = count($this->tree);
	$this->_nodesCount = $this->_lastItem[$menu_name];
	$this->tree[$this->_lastItem[$menu_name]+1]["level"] = 0;
	$this->_postParse($menu_name);
}

function _getmicrotime() {
	list($usec, $sec) = explode(" ", microtime());
	return ((float) $usec + (float) $sec);
}

/**
* Recursive method to perform the depth-first search of the tree data taken from the current menu table
* @access private
* @param array $tmpArray the temporary array that stores data to perform
*   the depth-first search
* @param string $menu_name the name to be attributed to the menu
*   whose structure has to be parsed
* @param integer $parent_id id of the item whose children have
*   to be searched for
* @param integer $level the hierarchical level of children to be searched for
* @return void
*/
function _depthFirstSearch($tmpArray, $menu_name, $parentid=1, $level) 
{
	reset ($tmpArray);
	while (list($id, $foobar) = each($tmpArray))
	{
 		if ($foobar["parentid"] == $parentid) 
		{
			unset($tmpArray[$id]);
 			unset($this->_tmpArray[$id]);
 			$cnt = count($this->tree) + 1;
			$this->tree[$cnt]["level"] = $level;
			$this->tree[$cnt]["menuid"] = $foobar["menuid"];
			$this->tree[$cnt]["parentid"] = $foobar["parentid"];
			$this->tree[$cnt]["text"] = $foobar["text"];
			$this->tree[$cnt]["link"] = $foobar["link"];
			$this->tree[$cnt]["icon"] = $foobar["icon"];
			$this->tree[$cnt]["target"] = $foobar["target"];
			$this->tree[$cnt]["expanded"] = $foobar["expanded"];
			unset($foobar);
			if ($id != $parentid) 
			{
				$this->_depthFirstSearch($this->_tmpArray, $menu_name, $id, $level+1);
			}
		}
	}
}

/**
* A method providing parsing needed after both file/string parsing and DB table parsing
* @access private
* @param string $menu_name the name of the menu for which the parsing
*   has to be performed
* @return void
*/
function _postParse(	$menu_name = "") 
{
	for ($cnt=$this->_firstItem[$menu_name]; $cnt<=$this->_lastItem[$menu_name]; $cnt++) {	// this counter scans all nodes of the new menu
		$this->tree[$cnt]["child_of_root_node"] = ($this->tree[$cnt]["level"] == 1);
		$this->tree[$cnt]["parsed_text"] = stripslashes($this->tree[$cnt]["text"]);
                $linklen = strlen($this->tree[$cnt]["link"]);
//                if ($linklen > 1)
//                {
                $this->tree[$cnt]["parsed_link"] = ($this->tree[$cnt]["link"] == "") ? "#" : $this->prependedUrl . $this->tree[$cnt]["link"];
//                    $this->tree[$cnt]["parsed_link"] = (preg_replace(" ", "", $this->tree[$cnt]["link"]) == "") ? "#" : $this->prependedUrl . $this->tree[$cnt]["link"];
//                }
//		$this->tree[$cnt]["parsed_title"] = ($this->tree[$cnt]["title"] == "") ? "" : " title=\"" . addslashes($this->tree[$cnt]["title"]) . "\"";
		$fooimg = $this->imgdir . $this->tree[$cnt]["icon"];
		if ($this->tree[$cnt]["icon"] == "" || !(file_exists($fooimg))) {
			$this->tree[$cnt]["parsed_icon"] = "";
		} else {
			$this->tree[$cnt]["parsed_icon"] = $this->tree[$cnt]["icon"];
			$foobar = getimagesize($fooimg);
			$this->tree[$cnt]["iconwidth"] = $foobar[0];
			$this->tree[$cnt]["iconheight"] = $foobar[1];
		}
		$this->tree[$cnt]["parsed_target"] = ($this->tree[$cnt]["target"] == "") ? "" : " target=\"" . $this->tree[$cnt]["target"] . "\"";
//		$this->tree[$cnt]["expanded"] = ($this->tree[$cnt]["expanded"] == "") ? 0 : $this->tree[$cnt]["expanded"];
		$this->_maxLevel[$menu_name] = max($this->_maxLevel[$menu_name], $this->tree[$cnt]["level"]);
		if ($this->tree[$cnt]["level"] == 1) {
			$this->_firstLevelCnt[$menu_name]++;
		}
	}
}

/**
* A method providing parsing needed both for horizontal and vertical menus; it can be useful also with the ProcessLayersMenu extended class
* @access public
* @param string $menu_name the name of the menu for which the parsing
*   has to be performed
* @return void
*/
function parseCommon($menu_name = "") 
{
	for ($cnt=$this->_firstItem[$menu_name]; $cnt<=$this->_lastItem[$menu_name]; $cnt++)	// this counter scans all nodes of the new menu
    {	$this->tree[$cnt]["layer_label"] = "L" . $cnt;
		$fooimg = $this->imgdir . $this->tree[$cnt]["parsed_icon"];
		if ($this->tree[$cnt]["parsed_icon"] == "" || !(file_exists($fooimg))) {
			$this->tree[$cnt]["icontag"] = "";
		} else {
			$this->tree[$cnt]["icontag"] = "<img align=\"top\" src=\"" . $this->imgwww . $this->tree[$cnt]["parsed_icon"] . "\" width=\"" . $this->tree[$cnt]["iconwidth"] . "\" height=\"" . $this->tree[$cnt]["iconheight"] . "\" border=\"0\" alt=\"O\" />&nbsp;";
		}
		$current_node[$this->tree[$cnt]["level"]] = $cnt;
		if ($this->tree[$cnt]["level"] > 1) {
			$this->tree[$cnt]["father_node"] = $current_node[$this->tree[$cnt]["level"]-1];
		}
		$this->father .= ($this->tree[$cnt]["child_of_root_node"]) ? "" : "father['L" . $cnt . "'] = \"" . $this->tree[$this->tree[$cnt]["father_node"]]["layer_label"] . "\";\n";
		$this->tree[$cnt]["not_a_leaf"] = ($this->tree[$cnt+1]["level"]>$this->tree[$cnt]["level"] && $cnt<$this->_lastItem[$menu_name]);
		// if the above condition is true, the node is not a leaf,
		// hence it has at least a child; if it is false, the node is a leaf
		if ($this->tree[$cnt]["not_a_leaf"]) {
			// initialize the corresponding layer content trought a void string
			$this->tree[$cnt]["layer_content"] = "";
			// the new layer is accounted for in the layers list
			$this->numl++;
			$this->listl .= "listl[" . $this->numl . "] = \"" . $this->tree[$cnt]["layer_label"] . "\";\n";
		}
/*
		if ($this->tree[$cnt]["not_a_leaf"]) {
			$this->tree[$cnt]["parsed_link"] = "#";
*/
	}
}

/**
* A method needed to update the footer both for horizontal and vertical menus
* @access private
* @param string $menu_name the name of the menu for which the updating
*   has to be performed
* @return void
*/
function _updateFooter(
	$menu_name = ""	// non consistent default...
	) {
	$t = new Template();
	$t->setFile("tplfile", $this->subMenuTpl);
	$t->setBlock("tplfile", "template", "template_blck");
	$t->setBlock("template", "sub_menu_cell", "sub_menu_cell_blck");
	$t->setVar("sub_menu_cell_blck", "");
	$t->setVar("abscissaStep", $this->abscissaStep);

	for ($cnt=$this->_firstItem[$menu_name]; $cnt<=$this->_lastItem[$menu_name]; $cnt++) {
		if ($this->tree[$cnt]["not_a_leaf"]) {
			$this->footer .= "\n<div id=\"" . $this->tree[$cnt]["layer_label"] . "\" style=\"position: absolute; left: 0; top: 0; visibility: hidden;\" onmouseover=\"clearLMTO();\" onmouseout=\"setLMTO();\">\n";
			$t->setVar(array(
				"layer_title"		=> $this->tree[$cnt]["text"],
				"sub_menu_cell_blck"	=> $this->tree[$cnt]["layer_content"]
			));
			$this->footer .= $t->parse("template_blck", "template");
			$this->footer .= "</div>\n\n";
		}
	}
}

/**
* Method to preparare a horizontal menu.
*
* This method processes items of a menu to prepare the corresponding
* horizontal menu code updating many variables; it returns the code
* of the corresponding _firstLevelMenu
*
* @access public
* @param string $menu_name the name of the menu whose items have to be processed
* @param integer $ordinateMargin margin (in pixels) to set the position
*   of a layer a bit above the ordinate of the "father" link
* @return string
*/
function newHorizontalMenu(
	$menu_name = "",	// non consistent default...
	$ordinateMargin = 12
	) {
	if (!isset($this->_firstItem[$menu_name]) || !isset($this->_lastItem[$menu_name])) {
		$this->error("newHorizontalMenu: the first/last item of the menu '$menu_name' is not defined; please check if you have parsed its menu data.");
		return 0;
	}

	$this->parseCommon($menu_name);

	$t = new Template();
	$t->setFile("tplfile", $this->horizontalMenuTpl);
	$t->setBlock("tplfile", "template", "template_blck");
	$t->setBlock("template", "horizontal_menu_cell", "horizontal_menu_cell_blck");
	$t->setVar("horizontal_menu_cell_blck", "");
	$t->setBlock("horizontal_menu_cell", "cell_link", "cell_link_blck");
	$t->setVar("cell_link_blck", "");

	$t_sub = new Template();
	$t_sub->setFile("tplfile", $this->subMenuTpl);
	$t_sub->setBlock("tplfile", "sub_menu_cell", "sub_menu_cell_blck");

	$this->_firstLevelMenu[$menu_name] = "";

	$foobar = $this->_firstItem[$menu_name];
	$this->moveLayers .= "\tvar " . $menu_name . "TOP = getOffsetTop('" . $menu_name . "L" . $foobar . "');\n";
	$this->moveLayers .= "\tvar " . $menu_name . "HEIGHT = getOffsetHeight('" . $menu_name . "L" . $foobar . "');\n";

	for ($cnt=$this->_firstItem[$menu_name]; $cnt<=$this->_lastItem[$menu_name]; $cnt++) {	// this counter scans all nodes of the new menu
		if ($this->tree[$cnt]["not_a_leaf"]) {
			// geometrical parameters are assigned to the new layer, related to the above mentioned children
			if ($this->tree[$cnt]["child_of_root_node"]) {
				$this->moveLayers .= "\tsetLeft('" . $this->tree[$cnt]["layer_label"] . "', getOffsetLeft('" . $menu_name . $this->tree[$cnt]["layer_label"] . "'));\n";
				$this->tree[$cnt]["arrow"] = $this->downArrow;
			} else {
				$this->tree[$cnt]["arrow"] = $this->forwardArrow;
			}
			if ($this->tree[$cnt]["child_of_root_node"]) {
				$this->moveLayers .= "\tsetTop('" . $this->tree[$cnt]["layer_label"] . "', "  . $menu_name . "TOP + " . $menu_name . "HEIGHT);\n";
			}
			$this->moveLayers .= "\tif (IE4) setWidth('" . $this->tree[$cnt]["layer_label"] . "'," . $this->abscissaStep . ");\n";
		} else {
			$this->tree[$cnt]["arrow"] = "";
		}

		if ($this->tree[$cnt]["child_of_root_node"]) {
			if ($this->tree[$cnt]["not_a_leaf"]) {
				$this->tree[$cnt]["onmouseover"] = " onmouseover=\"LMPopUp('" . $this->tree[$cnt]["layer_label"] . "', false);\"";
			} else {
				$this->tree[$cnt]["onmouseover"] = " onmouseover=\"shutdown();\"";
			}
			$t->setVar(array(
				"icontag"	=> $this->tree[$cnt]["icontag"],
				"link"		=> $this->tree[$cnt]["parsed_link"],
				"onmouseover"	=> $this->tree[$cnt]["onmouseover"],
				"title"		=> $this->tree[$cnt]["parsed_title"],
				"target"	=> $this->tree[$cnt]["parsed_target"],
				"text"		=> $this->tree[$cnt]["title"],
				"arrow"		=> $this->tree[$cnt]["arrow"]
			));
			$foobar = $t->parse("cell_link_blck", "cell_link");
			$foobar =
			"<div id=\"" . $menu_name . $this->tree[$cnt]["layer_label"] . "\" style=\"position: relative; visibility: visible;\" onmouseover=\"clearLMTO();\" onmouseout=\"setLMTO();\">\n" .
			"<script language=\"JavaScript\" type=\"text/javascript\">\n" .
			"<!--\n" .
			"if (IE) fixieflm(\"" . $menu_name . $this->tree[$cnt]["layer_label"] . "\");\n" .
			"// -->\n" .
			"</script>" .
			$foobar . "\n" .
			"</div>";
			$t->setVar(array(
				"cellwidth"		=> $this->abscissaStep,
				"cell_link_blck"	=> $foobar
			));
			$t->parse("horizontal_menu_cell_blck", "horizontal_menu_cell", true);
		} else {
			if ($this->tree[$cnt]["not_a_leaf"]) {
				$this->tree[$cnt]["onmouseover"] = " onmouseover=\"moveLayerY('" . $this->tree[$cnt]["layer_label"] . "', " . $ordinateMargin . ") ; moveLayerX('" . $this->tree[$cnt]["layer_label"] . "') ; LMPopUp('" . $this->tree[$cnt]["layer_label"] . "', false);\"";
			} else {
				$this->tree[$cnt]["onmouseover"] = " onmouseover=\"LMPopUp('" . $this->tree[$this->tree[$cnt]["father_node"]]["layer_label"] . "', true);\"";
			}
			$t_sub->setVar(array(
				"ordinateStep"	=> $this->ordinateStep,
				"icontag"	=> $this->tree[$cnt]["icontag"],
				"link"		=> $this->tree[$cnt]["parsed_link"],
				"refid"		=> " id=\"ref" . $this->tree[$cnt]["layer_label"] . "\"",
				"onmouseover"	=> $this->tree[$cnt]["onmouseover"],
				"title"		=> $this->tree[$cnt]["parsed_title"],
				"target"	=> $this->tree[$cnt]["parsed_target"],
				"text"		=> $this->tree[$cnt]["text"],
				"arrow"		=> $this->tree[$cnt]["arrow"]
			));
			$this->tree[$this->tree[$cnt]["father_node"]]["layer_content"] .= $t_sub->parse("sub_menu_cell_blck", "sub_menu_cell");
		}
	}	// end of the "for" cycle scanning all nodes

	$foobar = $this->_firstLevelCnt[$menu_name] * $this->abscissaStep;
	$t->setVar("menuwidth", $foobar);
	$t->setVar(array(
		"layer_label"	=> $menu_name,
		"menubody"	=> $this->_firstLevelMenu[$menu_name]
	));
	$this->_firstLevelMenu[$menu_name] = $t->parse("template_blck", "template");

	$this->_updateFooter($menu_name);

	return $this->_firstLevelMenu[$menu_name];
}

/**
* Method to preparare a vertical menu.
*
* This method processes items of a menu to prepare the corresponding
* vertical menu code updating many variables; it returns the code
* of the corresponding _firstLevelMenu
*
* @access public
* @param string $menu_name the name of the menu whose items have to be processed
* @param integer $ordinateMargin margin (in pixels) to set the position
*   of a layer a bit above the ordinate of the "father" link
* @return string
*/
function newVerticalMenu(
	$menu_name = "",	// non consistent default...
	$ordinateMargin = 12
	) {
	if (!isset($this->_firstItem[$menu_name]) || !isset($this->_lastItem[$menu_name])) {
		$this->error("newVerticalMenu: the first/last item of the menu '$menu_name' is not defined; please check if you have parsed its menu data.");
		return 0;
	}

	$this->parseCommon($menu_name);

	$t = new Template();
	$t->setFile("tplfile", $this->verticalMenuTpl);
	$t->setBlock("tplfile", "template", "template_blck");
	$t->setBlock("template", "vertical_menu_table", "vertical_menu_table_blck");
	$t->setVar("vertical_menu_table_blck", "");
	$t->setBlock("vertical_menu_table", "vertical_menu_cell", "vertical_menu_cell_blck");
	$t->setVar("vertical_menu_cell_blck", "");

	$t_sub = new Template();
	$t_sub->setFile("tplfile", $this->subMenuTpl);
	$t_sub->setBlock("tplfile", "sub_menu_cell", "sub_menu_cell_blck");

	$this->_firstLevelMenu[$menu_name] = "";

	$this->moveLayers .= "\tvar " . $menu_name . "TOP = getOffsetTop('" . $menu_name . "');\n";
	$this->moveLayers .= "\tvar " . $menu_name . "LEFT = getOffsetLeft('" . $menu_name . "');\n";
	$this->moveLayers .= "\tvar " . $menu_name . "WIDTH = getOffsetWidth('" . $menu_name . "');\n";

	for ($cnt=$this->_firstItem[$menu_name]; $cnt<=$this->_lastItem[$menu_name]; $cnt++) {	// this counter scans all nodes of the new menu
		if ($this->tree[$cnt]["not_a_leaf"]) {
			// geometrical parameters are assigned to the new layer, related to the above mentioned children
			if ($this->tree[$cnt]["child_of_root_node"]) {
				$this->moveLayers .= "\tsetLeft('" . $this->tree[$cnt]["layer_label"] . "', " . $menu_name . "LEFT + " . $menu_name . "WIDTH);\n";
			}
			$this->tree[$cnt]["arrow"] = $this->forwardArrow;
			$this->moveLayers .= "\tif (IE4) setWidth('" . $this->tree[$cnt]["layer_label"] . "'," . $this->abscissaStep . ");\n";
		} else {
			$this->tree[$cnt]["arrow"] = "";
		}

		if ($this->tree[$cnt]["child_of_root_node"]) {
			if ($this->tree[$cnt]["not_a_leaf"]) {
				$this->tree[$cnt]["onmouseover"] = " onmouseover=\"moveLayerY('" . $this->tree[$cnt]["layer_label"] . "', " . $ordinateMargin . ") ; moveLayerX('" . $this->tree[$cnt]["layer_label"] . "') ; LMPopUp('" . $this->tree[$cnt]["layer_label"] . "', false);\"";
			} else {
				$this->tree[$cnt]["onmouseover"] = " onmouseover=\"shutdown();\"";
			}
			$t->setVar(array(
				"ordinateStep"	=> $this->ordinateStep,
				"icontag"	=> $this->tree[$cnt]["icontag"],
				"link"		=> $this->tree[$cnt]["parsed_link"],
				"refid"		=> " id=\"ref" . $this->tree[$cnt]["layer_label"] . "\"",
				"onmouseover"	=> $this->tree[$cnt]["onmouseover"],
				"title"		=> $this->tree[$cnt]["parsed_title"],
				"target"	=> $this->tree[$cnt]["parsed_target"],
				"text"		=> $this->tree[$cnt]["text"],
				"arrow"		=> $this->tree[$cnt]["arrow"]
			));
			$this->_firstLevelMenu[$menu_name] .= $t->parse("vertical_menu_cell_blck", "vertical_menu_cell");
		} else {
			if ($this->tree[$cnt]["not_a_leaf"]) {
				$this->tree[$cnt]["onmouseover"] = " onmouseover=\"moveLayerY('" . $this->tree[$cnt]["layer_label"] . "', " . $ordinateMargin . ") ; moveLayerX('" . $this->tree[$cnt]["layer_label"] . "') ; LMPopUp('" . $this->tree[$cnt]["layer_label"] . "', false);\"";
			} else {
				$this->tree[$cnt]["onmouseover"] = " onmouseover=\"LMPopUp('" . $this->tree[$this->tree[$cnt]["father_node"]]["layer_label"] . "', true);\"";
			}
			$t_sub->setVar(array(
				"ordinateStep"	=> $this->ordinateStep,
				"icontag"	=> $this->tree[$cnt]["icontag"],
				"link"		=> $this->tree[$cnt]["parsed_link"],
				"refid"		=> " id=\"ref" . $this->tree[$cnt]["layer_label"] . "\"",
				"onmouseover"	=> $this->tree[$cnt]["onmouseover"],
				"title"		=> $this->tree[$cnt]["parsed_title"],
				"target"	=> $this->tree[$cnt]["parsed_target"],
				"text"		=> $this->tree[$cnt]["text"],
				"arrow"		=> $this->tree[$cnt]["arrow"]
			));
			$this->tree[$this->tree[$cnt]["father_node"]]["layer_content"] .= $t_sub->parse("sub_menu_cell_blck", "sub_menu_cell");
		}
	}	// end of the "for" cycle scanning all nodes

	$t->setVar("vertical_menu_cell_blck", $this->_firstLevelMenu[$menu_name]);
	$this->_firstLevelMenu[$menu_name] = $t->parse("vertical_menu_table_blck", "vertical_menu_table");
	$this->_firstLevelMenu[$menu_name] =
	"<div id=\"" . $menu_name . "\" style=\"position: relative; visibility: visible;\" onmouseover=\"clearLMTO();\" onmouseout=\"setLMTO();\">\n" .
	"<script language=\"JavaScript\" type=\"text/javascript\">\n" .
	"<!--\n" .
	"if (IE) fixieflm(\"" . $menu_name . "\");\n" .
	"// -->\n" .
	"</script>" .
	$this->_firstLevelMenu[$menu_name] . "\n" .
	"</div>";
	$t->setVar("abscissaStep", $this->abscissaStep);
	$t->setVar(array(
		"layer_label"			=> $menu_name,
		"vertical_menu_table_blck"	=> $this->_firstLevelMenu[$menu_name]
	));
	$this->_firstLevelMenu[$menu_name] = $t->parse("template_blck", "template");

	$this->_updateFooter($menu_name);

	return $this->_firstLevelMenu[$menu_name];
}

/**
* Method to prepare the header.
*
* This method obtains the header using collected informations
* and the suited JavaScript template; it returns the code of the header
*
* @access public
* @return string
*/
function makeHeader() {
	$t = new Template();
	$t->setFile("tplfile", $this->libjsdir . "layersmenu-header.ijs");
	$t->setVar(array(
		"packageName"	=> $this->_packageName,
		"version"	=> $this->version,
		"copyright"	=> $this->copyright,
		"author"	=> $this->author,
		"thresholdY"	=> $this->thresholdY,
		"abscissaStep"	=> $this->abscissaStep,
		"libjswww"	=> $this->libjswww,
		"listl"		=> $this->listl,
		"numl"		=> $this->numl,
		"nodesCount"	=> $this->_nodesCount,
		"father"	=> $this->father,
		"moveLayers"	=> $this->moveLayers
	));
	$this->header = $t->parse("out", "tplfile");
	return $this->header;
}

/**
* Method that returns the code of the header
* @access public
* @return string
*/
function getHeader() {
	return $this->header;
}

/**
* Method that prints the code of the header
* @access public
* @return void
*/
function printHeader() {
	$this->makeHeader();
	print $this->header;
}

/**
* Method that returns the code of the requested _firstLevelMenu
* @access public
* @param string $menu_name the name of the menu whose _firstLevelMenu
*   has to be returned
* @return string
*/
function getMenu($menu_name) {
	return $this->_firstLevelMenu[$menu_name];
}

/**
* Method that prints the code of the requested _firstLevelMenu
* @access public
* @param string $menu_name the name of the menu whose _firstLevelMenu
*   has to be printed
* @return void
*/
function printMenu($menu_name) {
	print $this->_firstLevelMenu[$menu_name];
}

/**
* Method to prepare the footer.
*
* This method obtains the footer using collected informations
* and the suited JavaScript template; it returns the code of the footer
*
* @access public
* @return string
*/
function makeFooter() {
	$t = new Template();
	$t->setFile("tplfile", $this->libjsdir . "layersmenu-footer.ijs");
	$t->setVar(array(
		"packageName"	=> $this->_packageName,
		"version"	=> $this->version,
		"copyright"	=> $this->copyright,
		"author"	=> $this->author,
		"footer"	=> $this->footer

	));
	$this->footer = $t->parse("out", "tplfile");
	return $this->footer;
}

/**
* Method that returns the code of the footer
* @access public
* @return string
*/
function getFooter() {
	return $this->footer;
}

/**
* Method that prints the code of the footer
* @access public
* @return void
*/
function printFooter() {
	$this->makeFooter();
	print $this->footer;
}

/**
* The method to set the value of separator for the Tree Menu
* @access public
* @return void
*/
function setTreeMenuSeparator($treeMenuSeparator) {
	$this->treeMenuSeparator = $treeMenuSeparator;
}

/**
* The method to set the type of images used for the Tree Menu
* @access public
* @return void
*/
function setTreeMenuImagesType($treeMenuImagesType) {
	$this->treeMenuImagesType = $treeMenuImagesType;
}

/**
* Method to prepare a new Tree Menu.
*
* This method processes items of a menu to prepare and return
* the corresponding Tree Menu code.
*
* @access public
* @param string $menu_name the name of the menu whose items have to be processed
* @return string
*/
function newTreeMenu(
	$menu_name = ""	// non consistent default...
	) {
	if (!isset($this->_firstItem[$menu_name]) || !isset($this->_lastItem[$menu_name])) {
		$this->error("newTreeMenu: the first/last item of the menu '$menu_name' is not defined; please check if you have parsed its menu data.");
		return 0;
	}

	$this->_treeMenu[$menu_name] = "";

	$img_space		= $this->imgwww . "tree_space." . $this->treeMenuImagesType;
	$alt_space		= "  ";
	$img_vertline		= $this->imgwww . "tree_vertline." . $this->treeMenuImagesType;
	$alt_vertline		= "| ";
	$img_expand		= $this->imgwww . "tree_expand." . $this->treeMenuImagesType;
	$alt_expand		= "+-";
	$img_expand_first	= $this->imgwww . "tree_expand_first." . $this->treeMenuImagesType;
	$alt_expand_first	= "+-";
	$img_expand_corner	= $this->imgwww . "tree_expand_corner." . $this->treeMenuImagesType;
	$alt_expand_corner	= "+-";
	$img_expand_corner_first	= $this->imgwww . "tree_expand_corner_first." . $this->treeMenuImagesType;
	$alt_expand_corner_first	= "+-";
	$img_collapse		= $this->imgwww . "tree_collapse." . $this->treeMenuImagesType;
	$alt_collapse		= "--";
	$img_collapse_first	= $this->imgwww . "tree_collapse_first." . $this->treeMenuImagesType;
	$alt_collapse_first	= "--";
	$img_collapse_corner	= $this->imgwww . "tree_collapse_corner." . $this->treeMenuImagesType;
	$alt_collapse_corner	= "--";
	$img_collapse_corner_first	= $this->imgwww . "tree_collapse_corner_first." . $this->treeMenuImagesType;
	$alt_collapse_corner_first	= "--";
	$img_split		= $this->imgwww . "tree_split." . $this->treeMenuImagesType;
	$alt_split		= "|-";
	$img_split_first	= $this->imgwww . "tree_split_first." . $this->treeMenuImagesType;
	$alt_split_first	= "|-";
	$img_corner		= $this->imgwww . "tree_corner." . $this->treeMenuImagesType;
	$alt_corner		= "`-";
	$img_folder_closed	= $this->imgwww . "tree_folder_closed." . $this->treeMenuImagesType;
	$alt_folder_closed	= "->";
	$img_folder_open	= $this->imgwww . "tree_folder_open." . $this->treeMenuImagesType;
	$alt_folder_open	= "->";
	$img_leaf		= $this->imgwww . "tree_leaf." . $this->treeMenuImagesType;
	$alt_leaf		= "->";

	for ($i=0; $i<=$this->_maxLevel[$menu_name]; $i++) {
		$levels[$i] = 0;
	}

	// Find last nodes of subtrees
	$last_level = $this->_maxLevel[$menu_name];
	for ($i=$this->_lastItem[$menu_name]; $i>=$this->_firstItem[$menu_name]; $i--) {
		if ($this->tree[$i]["level"] < $last_level) {
			for ($j=$this->tree[$i]["level"]+1; $j<=$this->_maxLevel[$menu_name]; $j++) {
				$levels[$j] = 0;
			}
		}
		if ($levels[$this->tree[$i]["level"]] == 0) {
			$levels[$this->tree[$i]["level"]] = 1;
			$this->tree[$i]["last_item"] = 1;
		} else {
			$this->tree[$i]["last_item"] = 0;
		}
		$last_level = $this->tree[$i]["level"];
	}

	$toggle = "";
	$toggle_function_name = "toggle" . $menu_name;

	for ($cnt=$this->_firstItem[$menu_name]; $cnt<=$this->_lastItem[$menu_name]; $cnt++) {
		$this->_treeMenu[$menu_name] .= "<div id=\"jt" . $cnt . "\" class=\"treemenudiv\">\n";

		// vertical lines from higher levels
		for ($i=0; $i<$this->tree[$cnt]["level"]-1; $i++) {
			if ($levels[$i] == 1) {
				$img = $img_vertline;
				$alt = $alt_vertline;
			} else {
				$img = $img_space;
				$alt = $alt_space;
			}
			$this->_treeMenu[$menu_name] .= "<img align=\"top\" border=\"0\" class=\"imgs\" src=\"" . $img . "\" alt=\"" . $alt . "\" />";
		}

		$not_a_leaf = $cnt<$this->_lastItem[$menu_name] && $this->tree[$cnt+1]["level"]>$this->tree[$cnt]["level"];

		if ($this->tree[$cnt]["last_item"] == 1) {
		// corner at end of subtree or t-split
			if ($not_a_leaf) {
				if ($cnt == $this->_firstItem[$menu_name]) {
					$img = $img_collapse_corner_first;
					$alt = $alt_collapse_corner_first;
				} else {
					$img = $img_collapse_corner;
					$alt = $alt_collapse_corner;
				}
				$this->_treeMenu[$menu_name] .= "<a onmousedown=\"". $toggle_function_name . "('" . $cnt . "')\"><img align=\"top\" border=\"0\" class=\"imgs\" id=\"jt" . $cnt . "node\" src=\"" . $img . "\" alt=\"" . $alt . "\" /></a>";
			} else {
				$this->_treeMenu[$menu_name] .= "<img align=\"top\" border=\"0\" class=\"imgs\" src=\"" . $img_corner . "\" alt=\"" . $alt_corner . "\" />";
			}
			$levels[$this->tree[$cnt]["level"]-1] = 0;
		} else {
			if ($not_a_leaf) {
				if ($cnt == $this->_firstItem[$menu_name]) {
					$img = $img_collapse_first;
					$alt = $alt_collapse_first;
				} else {
					$img = $img_collapse;
					$alt = $alt_collapse;
				}
				$this->_treeMenu[$menu_name] .= "<a onmousedown=\"". $toggle_function_name . "('" . $cnt . "');\"><img align=\"top\" border=\"0\" class=\"imgs\" id=\"jt" . $cnt . "node\" src=\"" . $img . "\" alt=\"" . $alt . "\" /></a>";
			} else {
				if ($cnt == $this->_firstItem[$menu_name]) {
					$img = $img_split_first;
					$alt = $alt_split_first;
				} else {
					$img = $img_split;
					$alt = $alt_split;
				}
				$this->_treeMenu[$menu_name] .= "<img align=\"top\" border=\"0\" class=\"imgs\" id=\"jt" . $cnt . "node\" src=\"" . $img . "\" alt=\"" . $alt . "\" />";
			}
			$levels[$this->tree[$cnt]["level"]-1] = 1;
		}

		if ($this->tree[$cnt]["parsed_link"] == "" || $this->tree[$cnt]["parsed_link"] == "#") {
			$a_href_open_img = "";
			$a_href_close_img = "";
			$a_href_open = "<a class=\"phplmnormal\">";
			$a_href_close = "</a>";
		} else {
			$a_href_open_img = "<a href=\"" . $this->tree[$cnt]["parsed_link"] . "\"" . $this->tree[$cnt]["parsed_title"] . $this->tree[$cnt]["parsed_target"] . ">";
			$a_href_close_img = "</a>";
			$a_href_open = "<a href=\"" . $this->tree[$cnt]["parsed_link"] . "\"" . $this->tree[$cnt]["parsed_title"] . $this->tree[$cnt]["parsed_target"] . " class=\"phplm\">";
			$a_href_close = "</a>";
		}

		if ($not_a_leaf) {
			$this->_treeMenu[$menu_name] .= $a_href_open_img . "<img align=\"top\" border=\"0\" class=\"imgs\" id=\"jt" . $cnt . "folder\" src=\"" . $img_folder_open . "\" alt=\"" . $alt_folder_open . "\" />" . $a_href_close_img;
		} else {
			if ($this->tree[$cnt]["parsed_icon"] != "") {
				$this->_treeMenu[$menu_name] .= $a_href_open_img . "<img align=\"top\" border=\"0\" src=\"" . $this->imgwww . $this->tree[$cnt]["parsed_icon"] . "\" width=\"" . $this->tree[$cnt]["iconwidth"] . "\" height=\"" . $this->tree[$cnt]["iconheight"] . "\" alt=\"" . $alt_leaf . "\" />" . $a_href_close_img;
			} else {
				$this->_treeMenu[$menu_name] .= $a_href_open_img . "<img align=\"top\" border=\"0\" class=\"imgs\" src=\"" . $img_leaf . "\" alt=\"" . $alt_leaf . "\" />" . $a_href_close_img;
			}
		}
		$this->_treeMenu[$menu_name] .= "&nbsp;" . $a_href_open . $this->tree[$cnt]["text"] . $a_href_close . "\n";
		$this->_treeMenu[$menu_name] .= "</div>\n";

		if ($cnt<$this->_lastItem[$menu_name] && $this->tree[$cnt]["level"]<$this->tree[$cnt+1]["level"]) {
			$this->_treeMenu[$menu_name] .= "<div id=\"jt" . $cnt . "son\" class=\"treemenudiv\">\n";
			if ($this->tree[$cnt]["expanded"] != 1) {
				$toggle .= "if (expand[" . $cnt . "] != 1) " . $toggle_function_name . "('" . $cnt . "');\n";
			} else {
				$toggle .= "if (collapse[" . $cnt . "] == 1) " . $toggle_function_name . "('" . $cnt . "');\n";
			}
		}

		if ($cnt>$this->_firstItem[$menu_name] && $this->tree[$cnt]["level"]>$this->tree[$cnt+1]["level"]) {
			for ($i=max(1, $this->tree[$cnt+1]["level"]); $i<$this->tree[$cnt]["level"]; $i++) {
				$this->_treeMenu[$menu_name] .= "</div>\n";
			}
		}
	}

/*
	// Some (old) browsers do not support the "white-space: nowrap;" CSS property...
	$this->_treeMenu[$menu_name] =
	"<table>\n" .
	"<tr>\n" .
	"<td class=\"phplmnormal\" nowrap=\"nowrap\">\n" .
	$this->_treeMenu[$menu_name] .
	"</td>\n" .
	"</tr>\n" .
	"</table>\n";
*/

	$t = new Template();
	$t->setFile("tplfile", $this->libjsdir . "layerstreemenu.ijs");
	$t->setVar(array(
		"toggle_function_name"	=> $toggle_function_name,
		"img_expand"		=> $img_expand,
		"img_expand_first"	=> $img_expand_first,
		"img_collapse"		=> $img_collapse,
		"img_collapse_first"	=> $img_collapse_first,
		"img_collapse_corner"	=> $img_collapse_corner,
		"img_collapse_corner_first"	=> $img_collapse_corner_first,
		"img_folder_open"	=> $img_folder_open,
		"img_expand_corner"	=> $img_expand_corner,
		"img_expand_corner_first"	=> $img_expand_corner_first,
		"img_folder_closed"	=> $img_folder_closed
	));
	$toggle_function = $t->parse("out", "tplfile");
	$toggle_function =
	"<script language=\"JavaScript\" type=\"text/javascript\">\n" .
	"<!--\n" .
	$toggle_function .
	"// -->\n" .
	"</script>\n";

	$toggle =
	"<script language=\"JavaScript\" type=\"text/javascript\">\n" .
	"<!--\n" .
	"if ((DOM && !Opera56 && !Konqueror2) || IE4) {\n" .
	$toggle .
	"}\n" .
	"if (NS4) alert('Only the accessibility is provided to Netscape 4 on the JavaScript Tree Menu.\\nWe *strongly* suggest you to upgrade your browser.');\n" .
	"// -->\n" .
	"</script>\n";

	$this->_treeMenu[$menu_name] = $toggle_function . "\n" . $this->_treeMenu[$menu_name] . "\n" . $toggle;

	return $this->_treeMenu[$menu_name];
}

/**
* Method that returns the code of the requested Tree Menu
* @access public
* @param string $menu_name the name of the menu whose Tree Menu code
*   has to be returned
* @return string
*/
function getTreeMenu($menu_name) {
	return $this->_treeMenu[$menu_name];
}

/**
* Method that prints the code of the requested Tree Menu
* @access public
* @param string $menu_name the name of the menu whose Tree Menu code
*   has to be printed
* @return void
*/
function printTreeMenu($menu_name) {
	print $this->_treeMenu[$menu_name];
}

/**
* Method to handle errors
* @access private
* @param string $errormsg the error message
* @return void
*/
function error($errormsg) {
	print "<b>LayersMenu Error:</b> " . $errormsg . "<br />\n";
	if ($this->haltOnError == "yes") {
		die("<b>Halted.</b><br />\n");
	}
}
/**
* The method to set the default value of the expansion string for the PHP Tree Menu
* @access public
* @return void
*/
function setPHPTreeMenuDefaultExpansion($phpTreeMenuDefaultExpansion) {
	$this->phpTreeMenuDefaultExpansion = $phpTreeMenuDefaultExpansion;
}

/**
* Method to prepare a new PHP Vertical Tree Menu.
*
* This method processes items of a menu and parameters submitted
* through GET (i.e. nodes to be expanded) to prepare and return
* the corresponding Vetical Tree Menu code.
*
* @access public
* @param string $menu_name the name of the menu whose items have to be processed
* @return string
*/
function newVerticalTreeMenu(
	$menu_name = ""	// non consistent default...
	) {
	$protocol = (isset($_SERVER["HTTPS"]) && $_SERVER["HTTPS"] == "on") ? "https://" : "http://";
	$this_host = (isset($_SERVER["HTTP_HOST"])) ? $_SERVER["HTTP_HOST"] : $_SERVER["SERVER_NAME"];
	if (isset($_SERVER["SCRIPT_NAME"])) {
		$me = $_SERVER["SCRIPT_NAME"];
	} else if (isset($_SERVER["REQUEST_URI"])) {
		$me = $_SERVER["REQUEST_URI"];
	} else if (isset($_SERVER["PHP_SELF"])) {
		$me = $_SERVER["PHP_SELF"];
	} else if (isset($_SERVER["PATH_INFO"])) {
		$me = $_SERVER["PATH_INFO"];
	}
	$url = $protocol . $this_host . $me;
	$query = "";
	reset($_GET);
	while (list($key, $value) = each($_GET)) {
		if ($key != "p" && $value != "") {
			$query .= "&amp;" . $key . "=" . $value;
		}
	}
	if ($query != "") {
		$query = "?" . substr($query, 5) . "&amp;p=";
	} else {
		$query = "?p=";
	}
	$p = (isset($_GET["p"])) ? $_GET["p"] : $this->phpTreeMenuDefaultExpansion;

/* ********************************************************* */
/* Based on TreeMenu 1.1 by Bjorge Dijkstra (bjorge@gmx.net) */
/* ********************************************************* */
	$this->_phpVerticalTreeMenu[$menu_name] = "";

	$img_space		= $this->imgwww . "tree_space." . $this->treeMenuImagesType;
	$alt_space		= "  ";
	$img_vertline		= $this->imgwww . "tree_vertline." . $this->treeMenuImagesType;
	$alt_vertline		= "| ";
	$img_expand		= $this->imgwww . "tree_expand." . $this->treeMenuImagesType;
	$alt_expand		= "+-";
	$img_expand_first	= $this->imgwww . "tree_expand_first." . $this->treeMenuImagesType;
	$alt_expand_first	= "+-";
	$img_expand_corner	= $this->imgwww . "tree_expand_corner." . $this->treeMenuImagesType;
	$alt_expand_corner	= "+-";
	$img_expand_corner_first	= $this->imgwww . "tree_expand_corner_first." . $this->treeMenuImagesType;
	$alt_expand_corner_first	= "+-";
	$img_collapse		= $this->imgwww . "tree_collapse." . $this->treeMenuImagesType;
	$alt_collapse		= "--";
	$img_collapse_first	= $this->imgwww . "tree_collapse_first." . $this->treeMenuImagesType;
	$alt_collapse_first	= "--";
	$img_collapse_corner	= $this->imgwww . "tree_collapse_corner." . $this->treeMenuImagesType;
	$alt_collapse_corner	= "--";
	$img_collapse_corner_first	= $this->imgwww . "tree_collapse_corner_first." . $this->treeMenuImagesType;
	$alt_collapse_corner_first	= "--";
	$img_split		= $this->imgwww . "tree_split." . $this->treeMenuImagesType;
	$alt_split		= "|-";
	$img_split_first	= $this->imgwww . "tree_split_first." . $this->treeMenuImagesType;
	$alt_split_first	= "|-";
	$img_corner		= $this->imgwww . "tree_corner." . $this->treeMenuImagesType;
	$alt_corner		= "`-";
	$img_folder_closed	= $this->imgwww . "tree_folder_closed." . $this->treeMenuImagesType;
	$alt_folder_closed	= "->";
	$img_folder_open	= $this->imgwww . "tree_folder_open." . $this->treeMenuImagesType;
	$alt_folder_open	= "->";
	$img_leaf		= $this->imgwww . "tree_leaf." . $this->treeMenuImagesType;
	$alt_leaf		= "->";

	for ($i=$this->_firstItem[$menu_name]; $i<=$this->_lastItem[$menu_name]; $i++) {
		$expand[$i] = 0;
		$visible[$i] = 0;
		$this->tree[$i]["last_item"] = 0;
	}
	for ($i=0; $i<=$this->_maxLevel[$menu_name]; $i++) {
		$levels[$i] = 0;
	}

	// Get numbers of nodes to be expanded
	if ($p != "") {
		$explevels = explode($this->treeMenuSeparator, $p);
		$explevels_count = count($explevels);
		for ($i=0; $i<$explevels_count; $i++) {
			$expand[$explevels[$i]] = 1;
		}
	}

	// Find last nodes of subtrees
	$last_level = $this->_maxLevel[$menu_name];
	for ($i=$this->_lastItem[$menu_name]; $i>=$this->_firstItem[$menu_name]; $i--) {
		if ($this->tree[$i]["level"] < $last_level) {
 			for ($j=$this->tree[$i]["level"]+1; $j<=$this->_maxLevel[$menu_name]; $j++) {
				$levels[$j] = 0;
			}
		}
		if ($levels[$this->tree[$i]["level"]] == 0) {
			$levels[$this->tree[$i]["level"]] = 1;
			$this->tree[$i]["last_item"] = 1;
		} else {
			$this->tree[$i]["last_item"] = 0;
		}
		$last_level = $this->tree[$i]["level"];
	}

	// Determine visible nodes
	// all root nodes are always visible
 	for ($i=$this->_firstItem[$menu_name]; $i<=$this->_lastItem[$menu_name]; $i++) {
 		if ($this->tree[$i]["level"] == 1) {
			$visible[$i] = 1;
		}
	}
	if (isset($explevels)) {
		for ($i=0; $i<$explevels_count; $i++) {
			$n = $explevels[$i];
			if ($n >= $this->_firstItem[$menu_name] && $n <= $this->_lastItem[$menu_name] && $visible[$n] == 1 && $expand[$n] == 1) {
				$j = $n + 1;
				while ($j<=$this->_lastItem[$menu_name] && $this->tree[$j]["parentid"]>$this->tree[$n]["parentid"]) {
					if ($this->tree[$j]["parentid"] == $this->tree[$n]["parentid"]) {
						$visible[$j] = 1;
					}
					$j++;
				}
			}
		}
	}

	// Output nicely formatted tree
	for ($i=0; $i<$this->_maxLevel[$menu_name]; $i++) {
		$levels[$i] = 1;
	}
	$max_visible_level = 0;
	for ($cnt=$this->_firstItem[$menu_name]; $cnt<=$this->_lastItem[$menu_name]; $cnt++) {
		if ($visible[$cnt]) {
			$max_visible_level = max($max_visible_level, $this->tree[$cnt]["level"]);
		}
	}
	for ($cnt=$this->_firstItem[$menu_name]; $cnt<=$this->_lastItem[$menu_name]; $cnt++) {
		if ($visible[$cnt]) {
			$this->_phpVerticalTreeMenu[$menu_name] .= "<div class=\"treemenudiv\">\n";

			// vertical lines from higher levels
			for ($i=0; $i<$this->tree[$cnt]["level"]-1; $i++) {
				if ($levels[$i] == 1) {
					$img = $img_vertline;
					$alt = $alt_vertline;
				} else {
					$img = $img_space;
					$alt = $alt_space;
				}
				$this->_phpVerticalTreeMenu[$menu_name] .= "<img align=\"top\" border=\"0\" class=\"imgs\" src=\"" . $img . "\" alt=\"" . $alt . "\" />";
			}

			$not_a_leaf = $cnt<$this->_lastItem[$menu_name] && $this->tree[$cnt+1]["level"]>$this->tree[$cnt]["level"];

			if ($not_a_leaf) {
				// Create expand/collapse parameters
				$params = "";
				for ($i=$this->_firstItem[$menu_name]; $i<=$this->_lastItem[$menu_name]; $i++) {
 					if ($expand[$i] == 1 && $cnt!= $i || ($expand[$i] == 0 && $cnt == $i)) {
						$params .= $this->treeMenuSeparator . $i;
					}
				}
				if ($params != "") {
					$params = substr($params, 1);
				}
			}

			if ($this->tree[$cnt]["last_item"] == 1) {
			// corner at end of subtree or t-split
				if ($not_a_leaf) {
					if ($expand[$cnt] == 0) {
						if ($cnt == $this->_firstItem[$menu_name]) {
							$img = $img_expand_corner_first;
							$alt = $alt_expand_corner_first;
						} else {
							$img = $img_expand_corner;
							$alt = $alt_expand_corner;
						}
					} else {
						if ($cnt == $this->_firstItem[$menu_name]) {
							$img = $img_collapse_corner_first;
							$alt = $alt_collapse_corner_first;
						} else {
							$img = $img_collapse_corner;
							$alt = $alt_collapse_corner;
						}
					}
					$this->_phpVerticalTreeMenu[$menu_name] .= "<a name=\"" . $cnt . "\" class=\"phplm\" href=\"" . $url . $query . $params . "#" . $cnt . "\"><img align=\"top\" border=\"0\" class=\"imgs\" src=\"" . $img . "\" alt=\"" . $alt . "\" /></a>";
				} else {
					$this->_phpVerticalTreeMenu[$menu_name] .= "<img align=\"top\" border=\"0\" class=\"imgs\" src=\"" . $img_corner . "\" alt=\"" . $alt_corner . "\" />";
				}
				$levels[$this->tree[$cnt]["level"]-1] = 0;
			} else {
				if ($not_a_leaf) {
					if ($expand[$cnt] == 0) {
						if ($cnt == $this->_firstItem[$menu_name]) {
							$img = $img_expand_first;
							$alt = $alt_expand_first;
						} else {
							$img = $img_expand;
							$alt = $alt_expand;
						}
					} else {
						if ($cnt == $this->_firstItem[$menu_name]) {
							$img = $img_collapse_first;
							$alt = $alt_collapse_first;
						} else {
							$img = $img_collapse;
							$alt = $alt_collapse;
						}
					}
					$this->_phpVerticalTreeMenu[$menu_name] .= "<a name=\"" . $cnt . "\" class=\"phplm\" href=\"" . $url . $query . $params . "#" . $cnt . "\"><img align=\"top\" border=\"0\" class=\"imgs\" src=\"" . $img . "\" alt=\"" . $alt . "\" /></a>";
				} else {
					if ($cnt == $this->_firstItem[$menu_name]) {
						$img = $img_split_first;
						$alt = $alt_split_first;
					} else {
						$img = $img_split;
						$alt = $alt_split;
					}
					$this->_phpVerticalTreeMenu[$menu_name] .= "<img align=\"top\" border=\"0\" class=\"imgs\" src=\"" . $img . "\" alt=\"" . $alt . "\" />";
				}
				$levels[$this->tree[$cnt]["level"]-1] = 1;
			}

			if ($this->tree[$cnt]["parsed_link"] == "" || $this->tree[$cnt]["parsed_link"] == "#") {
				$a_href_open_img = "";
				$a_href_close_img = "";
				$a_href_open = "<a class=\"phplmnormal\">";
				$a_href_close = "</a>";
			} else {
				$a_href_open_img = "<a href=\"" . $this->tree[$cnt]["parsed_link"] . "\"" . $this->tree[$cnt]["parsed_title"] . $this->tree[$cnt]["parsed_target"] . ">";
				$a_href_close_img = "</a>";
				$a_href_open = "<a href=\"" . $this->tree[$cnt]["parsed_link"] . "\"" . $this->tree[$cnt]["parsed_title"] . $this->tree[$cnt]["parsed_target"] . " class=\"phplm\">";
				$a_href_close = "</a>";
			}

			if ($not_a_leaf) {
				if ($expand[$cnt] == 1) {
					$img = $img_folder_open;
					$alt = $alt_folder_open;
				} else {
					$img = $img_folder_closed;
					$alt = $alt_folder_closed;
				}
				$this->_phpVerticalTreeMenu[$menu_name] .= $a_href_open_img . "<img align=\"top\" border=\"0\" class=\"imgs\" src=\"" . $img . "\" alt=\"" . $alt . "\" />" . $a_href_close_img;
			} else {
				if ($this->tree[$cnt]["parsed_icon"] != "") {
					$this->_phpVerticalTreeMenu[$menu_name] .= $a_href_open_img . "<img align=\"top\" border=\"0\" src=\"" . $this->imgwww . $this->tree[$cnt]["parsed_icon"] . "\" width=\"" . $this->tree[$cnt]["iconwidth"] . "\" height=\"" . $this->tree[$cnt]["iconheight"] . "\" alt=\"" . $alt_leaf . "\" />" . $a_href_close_img;
				} else {
					$this->_phpVerticalTreeMenu[$menu_name] .= $a_href_open_img . "<img align=\"top\" border=\"0\" class=\"imgs\" src=\"" . $img_leaf . "\" alt=\"" . $alt_leaf . "\" />" . $a_href_close_img;
				}
			}

			// output item text
			$foobar = $max_visible_level - $this->tree[$cnt]["level"] + 1;
			if ($foobar > 1) {
				$colspan = " colspan=\"" . $foobar . "\"";
			} else {
				$colspan = "";
			}
			$this->_phpVerticalTreeMenu[$menu_name] .= "&nbsp;" . $a_href_open . $this->tree[$cnt]["parsed_text"] . $a_href_close . "\n";
			$this->_phpVerticalTreeMenu[$menu_name] .= "</div>\n";
		}
	}
/* ********************************************************* */

/*
	// Some (old) browsers do not support the "white-space: nowrap;" CSS property...
	$this->_phpVerticalTreeMenu[$menu_name] =
	"<table>\n" .
	"<tr>\n" .
	"<td class=\"phplmnormal\" nowrap=\"nowrap\">\n" .
	$this->_phpVerticalTreeMenu[$menu_name] .
	"</td>\n" .
	"</tr>\n" .
	"</table>\n";
*/

	return $this->_phpVerticalTreeMenu[$menu_name];
}

/**
* Method that returns the code of the requested PHP Vertical Tree Menu
* @access public
* @param string $menu_name the name of the menu whose PHP Vertical Tree Menu code
*   has to be returned
* @return string
*/
function getVerticalTreeMenu($menu_name) {
	return $this->_phpVerticalTreeMenu[$menu_name];
}

/**
* Method that prints the code of the requested PHP Vertical Tree Menu
* @access public
* @param string $menu_name the name of the menu whose PHP Vertical Tree Menu code
*   has to be printed
* @return void
*/
function printVerticalTreeMenu($menu_name) {
	print $this->_phpVerticalTreeMenu[$menu_name];
}

/**
* Method to prepare a new PHP Horizontal Tree Menu.
*
* This method processes items of a menu and parameters submitted
* through GET (i.e. nodes to be expanded) to prepare and return
* the corresponding Horizontal Tree Menu code.
*
* @access public
* @param string $menu_name the name of the menu whose items have to be processed
* @return string
*/
function newHorizontalTreeMenu(	$menu_name = "")// non consistent default...
{
	$protocol = (isset($_SERVER["HTTPS"]) && $_SERVER["HTTPS"] == "on") ? "https://" : "http://";
	$this_host = (isset($_SERVER["HTTP_HOST"])) ? $_SERVER["HTTP_HOST"] : $_SERVER["SERVER_NAME"];
	if (isset($_SERVER["SCRIPT_NAME"])) {
		$me = $_SERVER["SCRIPT_NAME"];
	} else if (isset($_SERVER["REQUEST_URI"])) {
		$me = $_SERVER["REQUEST_URI"];
	} else if (isset($_SERVER["PHP_SELF"])) {
		$me = $_SERVER["PHP_SELF"];
	} else if (isset($_SERVER["PATH_INFO"])) {
		$me = $_SERVER["PATH_INFO"];
	}
	$url = $protocol . $this_host . $me;
	$query = "";
	reset($_GET);
	while (list($key, $value) = each($_GET)) {
		if ($key != "p" && $value != "") {
			$query .= "&amp;" . $key . "=" . $value;
		}
	}
	if ($query != "") {
		$query = "?" . substr($query, 5) . "&amp;p=";
	} else {
		$query = "?p=";
	}
	$p = (isset($_GET["p"])) ? $_GET["p"] : $this->phpTreeMenuDefaultExpansion;

/* ********************************************************* */
/* Based on TreeMenu 1.1 by Bjorge Dijkstra (bjorge@gmx.net) */
/* ********************************************************* */
	$this->_phpHorizontalTreeMenu[$menu_name] = "";

	$img_space		= $this->imgwww . "tree_space." . $this->treeMenuImagesType;
	$alt_space		= "  ";
	$img_vertline		= $this->imgwww . "tree_vertline." . $this->treeMenuImagesType;
	$alt_vertline		= "| ";
	$img_expand		= $this->imgwww . "tree_expand." . $this->treeMenuImagesType;
	$alt_expand		= "+-";
	$img_expand_first	= $this->imgwww . "tree_expand_first." . $this->treeMenuImagesType;
	$alt_expand_first	= "+-";
	$img_expand_corner	= $this->imgwww . "tree_expand_corner." . $this->treeMenuImagesType;
	$alt_expand_corner	= "+-";
	$img_expand_corner_first	= $this->imgwww . "tree_expand_corner_first." . $this->treeMenuImagesType;
	$alt_expand_corner_first	= "+-";
	$img_collapse		= $this->imgwww . "tree_collapse." . $this->treeMenuImagesType;
	$alt_collapse		= "--";
	$img_collapse_first	= $this->imgwww . "tree_collapse_first." . $this->treeMenuImagesType;
	$alt_collapse_first	= "--";
	$img_collapse_corner	= $this->imgwww . "tree_collapse_corner." . $this->treeMenuImagesType;
	$alt_collapse_corner	= "--";
	$img_collapse_corner_first	= $this->imgwww . "tree_collapse_corner_first." . $this->treeMenuImagesType;
	$alt_collapse_corner_first	= "--";
	$img_split		= $this->imgwww . "tree_split." . $this->treeMenuImagesType;
	$alt_split		= "|-";
	$img_split_first	= $this->imgwww . "tree_split_first." . $this->treeMenuImagesType;
	$alt_split_first	= "|-";
	$img_corner		= $this->imgwww . "tree_corner." . $this->treeMenuImagesType;
	$alt_corner		= "`-";
	$img_folder_closed	= $this->imgwww . "tree_folder_closed." . $this->treeMenuImagesType;
	$alt_folder_closed	= "->";
	$img_folder_open	= $this->imgwww . "tree_folder_open." . $this->treeMenuImagesType;
	$alt_folder_open	= "->";
	$img_leaf		= $this->imgwww . "tree_leaf." . $this->treeMenuImagesType;
	$alt_leaf		= "->";

	for ($i=$this->_firstItem[$menu_name]; $i<=$this->_lastItem[$menu_name]; $i++) {
		$expand[$i] = 0;
		$visible[$i] = 0;
		$this->tree[$i]["last_item"] = 0;
	}
	for ($i=0; $i<=$this->_maxLevel[$menu_name]; $i++) {
		$levels[$i] = 0;
	}

	// Get numbers of nodes to be expanded
	if ($p != "") {
		$explevels = explode($this->treeMenuSeparator, $p);
		$explevels_count = count($explevels);
		for ($i=0; $i<$explevels_count; $i++) {
			$expand[$explevels[$i]] = 1;
		}
	}

	// Find last nodes of subtrees
	$last_level = $this->_maxLevel[$menu_name];
	for ($i=$this->_lastItem[$menu_name]; $i>=$this->_firstItem[$menu_name]; $i--) {
		if ($this->tree[$i]["level"] < $last_level) {
			for ($j=$this->tree[$i]["level"]+1; $j<=$this->_maxLevel[$menu_name]; $j++) {
				$levels[$j] = 0;
			}
		}
		if ($levels[$this->tree[$i]["level"]] == 0) {
			$levels[$this->tree[$i]["level"]] = 1;
			$this->tree[$i]["last_item"] = 1;
		} else {
			$this->tree[$i]["last_item"] = 0;
		}
		$last_level = $this->tree[$i]["level"];
	}

	// Determine visible nodes
	// all root nodes are always visible
	for ($i=$this->_firstItem[$menu_name]; $i<=$this->_lastItem[$menu_name]; $i++) {
		if ($this->tree[$i]["level"] == 1) {
			$visible[$i] = 1;
		}
	}
	if (isset($explevels)) {
		for ($i=0; $i<$explevels_count; $i++) {
			$n = $explevels[$i];
			if ($n >= $this->_firstItem[$menu_name] && $n <= $this->_lastItem[$menu_name] && $visible[$n] == 1 && $expand[$n] == 1) {
				$j = $n + 1;
				while ($j<=$this->_lastItem[$menu_name] && $this->tree[$j]["level"]>$this->tree[$n]["level"]) {
					if ($this->tree[$j]["level"] == $this->tree[$n]["level"]+1) {
						$visible[$j] = 1;
					}
					$j++;
				}
			}
		}
	}

	// Output nicely formatted tree
	for ($i=0; $i<$this->_maxLevel[$menu_name]; $i++) {
		$levels[$i] = 1;
	}
	$max_visible_level = 0;
	for ($cnt=$this->_firstItem[$menu_name]; $cnt<=$this->_lastItem[$menu_name]; $cnt++) {
	if ($visible[$cnt]) {
			$max_visible_level = max($max_visible_level, $this->tree[$cnt]["level"]);
		}
	}
	$this->_phpHorizontalTreeMenu[$menu_name] .= "<table>";
	for ($cnt=$this->_firstItem[$menu_name]; $cnt<=$this->_lastItem[$menu_name]; $cnt++) {
		If ($this->tree[$cnt]["level"] ==1)
		{
          	If ($cnt==$this->_firstItem[$menu_name])
          	{
				$this->_phpHorizontalTreeMenu[$menu_name] .= "<tr><td valign='top'>";
			} else {
                $this->_phpHorizontalTreeMenu[$menu_name] .= "</td><td valign='top'>";
            };
					$this->_phpHorizontalTreeMenu[$menu_name] .= "<div class=\"treemenudiv\">\n";

					// vertical lines from higher levels
					for ($i=0; $i<$this->tree[$cnt]["level"]-1; $i++) {
						if ($levels[$i] == 1) {
							$img = $img_vertline;
							$alt = $alt_vertline;
						} else {
							$img = $img_space;
							$alt = $alt_space;
						}
						$this->_phpHorizontalTreeMenu[$menu_name] .= "<img align=\"top\" border=\"0\" class=\"imgs\" src=\"" . $img . "\" alt=\"" . $alt . "\" />";
					}

					$not_a_leaf = $cnt<$this->_lastItem[$menu_name] && $this->tree[$cnt+1]["level"]>$this->tree[$cnt]["level"];

					if ($not_a_leaf) {
						// Create expand/collapse parameters
						$params = "";
						for ($i=$this->_firstItem[$menu_name]; $i<=$this->_lastItem[$menu_name]; $i++) {
							if ($expand[$i] == 1 && $cnt!= $i || ($expand[$i] == 0 && $cnt == $i)) {
								$params .= $this->treeMenuSeparator . $i;
							}
						}
						if ($params != "") {
							$params = substr($params, 1);
						}
					}

					if ($this->tree[$cnt]["last_item"] == 1) {
					// corner at end of subtree or t-split
						if ($not_a_leaf) {
							if ($expand[$cnt] == 0) {
								if ($cnt == $this->_firstItem[$menu_name]) {
									$img = $img_expand_corner_first;
									$alt = $alt_expand_corner_first;
							} else {
									$img = $img_expand_corner;
									$alt = $alt_expand_corner;
							}
							} else {
								if ($cnt == $this->_firstItem[$menu_name]) {
									$img = $img_collapse_corner_first;
									$alt = $alt_collapse_corner_first;
								} else {
									$img = $img_collapse_corner;
									$alt = $alt_collapse_corner;
								}
							}
							$this->_phpHorizontalTreeMenu[$menu_name] .= "<a name=\"" . $cnt . "\" class=\"phplm\" href=\"" . $url . $query . $params . "#" . $cnt . "\"><img align=\"top\" border=\"0\" class=\"imgs\" src=\"" . $img . "\" alt=\"" . $alt . "\" /></a>";
						} else {
							$this->_phpHorizontalTreeMenu[$menu_name] .= "<img align=\"top\" border=\"0\" class=\"imgs\" src=\"" . $img_corner . "\" alt=\"" . $alt_corner . "\" />";
						}
						$levels[$this->tree[$cnt]["level"]-1] = 0;
					} else {
						if ($not_a_leaf) {
							if ($expand[$cnt] == 0) {
								if ($cnt == $this->_firstItem[$menu_name]) {
									$img = $img_expand_first;
									$alt = $alt_expand_first;
								} else {
									$img = $img_expand;
									$alt = $alt_expand;
								}
							} else {
								if ($cnt == $this->_firstItem[$menu_name]) {
									$img = $img_collapse_first;
									$alt = $alt_collapse_first;
								} else {
									$img = $img_collapse;
									$alt = $alt_collapse;
								}
							}
							$this->_phpHorizontalTreeMenu[$menu_name] .= "<a name=\"" . $cnt . "\" class=\"phplm\" href=\"" . $url . $query . $params . "#" . $cnt . "\"><img align=\"top\" border=\"0\" class=\"imgs\" src=\"" . $img . "\" alt=\"" . $alt . "\" /></a>";
						} else {
							if ($cnt == $this->_firstItem[$menu_name]) {
								$img = $img_split_first;
								$alt = $alt_split_first;
							} else {
								$img = $img_split;
								$alt = $alt_split;
							}
							$this->_phpHorizontalTreeMenu[$menu_name] .= "<img align=\"top\" border=\"0\" class=\"imgs\" src=\"" . $img . "\" alt=\"" . $alt . "\" />";
						}
						$levels[$this->tree[$cnt]["level"]-1] = 1;
					}

					if ($this->tree[$cnt]["parsed_link"] == "" || $this->tree[$cnt]["parsed_link"] == "#") {
						$a_href_open_img = "";
						$a_href_close_img = "";
						$a_href_open = "<a class=\"phplmnormal\">";
						$a_href_close = "</a>";
					} else {
						$a_href_open_img = "<a href=\"" . $this->tree[$cnt]["parsed_link"] . "\"" . $this->tree[$cnt]["parsed_title"] . $this->tree[$cnt]["parsed_target"] . ">";
						$a_href_close_img = "</a>";
						$a_href_open = "<a href=\"" . $this->tree[$cnt]["parsed_link"] . "\"" . $this->tree[$cnt]["parsed_title"] . $this->tree[$cnt]["parsed_target"] . " class=\"phplm\">";
						$a_href_close = "</a>";
					}

					if ($not_a_leaf) {
						if ($expand[$cnt] == 1) {
							$img = $img_folder_open;
							$alt = $alt_folder_open;
						} else {
							$img = $img_folder_closed;
							$alt = $alt_folder_closed;
						}
						$this->_phpHorizontalTreeMenu[$menu_name] .= $a_href_open_img . "<img align=\"top\" border=\"0\" class=\"imgs\" src=\"" . $img . "\" alt=\"" . $alt . "\" />" . $a_href_close_img;
					} else {
						if ($this->tree[$cnt]["parsed_icon"] != "") {
							$this->_phpHorizontalTreeMenu[$menu_name] .= $a_href_open_img . "<img align=\"top\" border=\"0\" src=\"" . $this->imgwww . $this->tree[$cnt]["parsed_icon"] . "\" width=\"" . $this->tree[$cnt]["iconwidth"] . "\" height=\"" . $this->tree[$cnt]["iconheight"] . "\" alt=\"" . $alt_leaf . "\" />" . $a_href_close_img;
						} else {
							$this->_phpHorizontalTreeMenu[$menu_name] .= $a_href_open_img . "<img align=\"top\" border=\"0\" class=\"imgs\" src=\"" . $img_leaf . "\" alt=\"" . $alt_leaf . "\" />" . $a_href_close_img;
						}
					}

					// output item text
					$foobar = $max_visible_level - $this->tree[$cnt]["level"] + 1;
					if ($foobar > 1) {
						$colspan = " colspan=\"" . $foobar . "\"";
					} else {
						$colspan = "";
					}
					$this->_phpHorizontalTreeMenu[$menu_name] .= "&nbsp;" . $a_href_open . $this->tree[$cnt]["parsed_text"] . $a_href_close . "\n";
					$this->_phpHorizontalTreeMenu[$menu_name] .= "</div>\n";
		}else {
 				if ($visible[$cnt]) {
					$this->_phpHorizontalTreeMenu[$menu_name] .= "<div class=\"treemenudiv\">\n";

					// vertical lines from higher levels
					for ($i=0; $i<$this->tree[$cnt]["level"]-1; $i++) {
						if ($levels[$i] == 1) {
							$img = $img_vertline;
							$alt = $alt_vertline;
						} else {
							$img = $img_space;
							$alt = $alt_space;
						}
						$this->_phpHorizontalTreeMenu[$menu_name] .= "<img align=\"top\" border=\"0\" class=\"imgs\" src=\"" . $img . "\" alt=\"" . $alt . "\" />";
					}

					$not_a_leaf = $cnt<$this->_lastItem[$menu_name] && $this->tree[$cnt+1]["level"]>$this->tree[$cnt]["level"];

					if ($not_a_leaf) {
						// Create expand/collapse parameters
						$params = "";
						for ($i=$this->_firstItem[$menu_name]; $i<=$this->_lastItem[$menu_name]; $i++) {
							if ($expand[$i] == 1 && $cnt!= $i || ($expand[$i] == 0 && $cnt == $i)) {
								$params .= $this->treeMenuSeparator . $i;
							}
						}
						if ($params != "") {
							$params = substr($params, 1);
						}
					}

					if ($this->tree[$cnt]["last_item"] == 1) {
					// corner at end of subtree or t-split
						if ($not_a_leaf) {
							if ($expand[$cnt] == 0) {
								if ($cnt == $this->_firstItem[$menu_name]) {
									$img = $img_expand_corner_first;
									$alt = $alt_expand_corner_first;
							} else {
									$img = $img_expand_corner;
									$alt = $alt_expand_corner;
							}
							} else {
								if ($cnt == $this->_firstItem[$menu_name]) {
									$img = $img_collapse_corner_first;
									$alt = $alt_collapse_corner_first;
								} else {
									$img = $img_collapse_corner;
									$alt = $alt_collapse_corner;
								}
							}
							$this->_phpHorizontalTreeMenu[$menu_name] .= "<a name=\"" . $cnt . "\" class=\"phplm\" href=\"" . $url . $query . $params . "#" . $cnt . "\"><img align=\"top\" border=\"0\" class=\"imgs\" src=\"" . $img . "\" alt=\"" . $alt . "\" /></a>";
						} else {
							$this->_phpHorizontalTreeMenu[$menu_name] .= "<img align=\"top\" border=\"0\" class=\"imgs\" src=\"" . $img_corner . "\" alt=\"" . $alt_corner . "\" />";
						}
						$levels[$this->tree[$cnt]["level"]-1] = 0;
					} else {
						if ($not_a_leaf) {
							if ($expand[$cnt] == 0) {
								if ($cnt == $this->_firstItem[$menu_name]) {
									$img = $img_expand_first;
									$alt = $alt_expand_first;
								} else {
									$img = $img_expand;
									$alt = $alt_expand;
								}
							} else {
								if ($cnt == $this->_firstItem[$menu_name]) {
									$img = $img_collapse_first;
									$alt = $alt_collapse_first;
								} else {
									$img = $img_collapse;
									$alt = $alt_collapse;
								}
							}
							$this->_phpHorizontalTreeMenu[$menu_name] .= "<a name=\"" . $cnt . "\" class=\"phplm\" href=\"" . $url . $query . $params . "#" . $cnt . "\"><img align=\"top\" border=\"0\" class=\"imgs\" src=\"" . $img . "\" alt=\"" . $alt . "\" /></a>";
						} else {
							if ($cnt == $this->_firstItem[$menu_name]) {
								$img = $img_split_first;
								$alt = $alt_split_first;
							} else {
								$img = $img_split;
								$alt = $alt_split;
							}
							$this->_phpHorizontalTreeMenu[$menu_name] .= "<img align=\"top\" border=\"0\" class=\"imgs\" src=\"" . $img . "\" alt=\"" . $alt . "\" />";
						}
						$levels[$this->tree[$cnt]["level"]-1] = 1;
					}

					if ($this->tree[$cnt]["parsed_link"] == "" || $this->tree[$cnt]["parsed_link"] == "#") {
						$a_href_open_img = "";
						$a_href_close_img = "";
						$a_href_open = "<a class=\"phplmnormal\">";
						$a_href_close = "</a>";
					} else {
						$a_href_open_img = "<a href=\"" . $this->tree[$cnt]["parsed_link"] . "\"" . $this->tree[$cnt]["parsed_title"] . $this->tree[$cnt]["parsed_target"] . ">";
						$a_href_close_img = "</a>";
						$a_href_open = "<a href=\"" . $this->tree[$cnt]["parsed_link"] . "\"" . $this->tree[$cnt]["parsed_title"] . $this->tree[$cnt]["parsed_target"] . " class=\"phplm\">";
						$a_href_close = "</a>";
					}

					if ($not_a_leaf) {
						if ($expand[$cnt] == 1) {
							$img = $img_folder_open;
							$alt = $alt_folder_open;
						} else {
							$img = $img_folder_closed;
							$alt = $alt_folder_closed;
						}
						$this->_phpHorizontalTreeMenu[$menu_name] .= $a_href_open_img . "<img align=\"top\" border=\"0\" class=\"imgs\" src=\"" . $img . "\" alt=\"" . $alt . "\" />" . $a_href_close_img;
					} else {
						if ($this->tree[$cnt]["parsed_icon"] != "") {
							$this->_phpHorizontalTreeMenu[$menu_name] .= $a_href_open_img . "<img align=\"top\" border=\"0\" src=\"" . $this->imgwww . $this->tree[$cnt]["parsed_icon"] . "\" width=\"" . $this->tree[$cnt]["iconwidth"] . "\" height=\"" . $this->tree[$cnt]["iconheight"] . "\" alt=\"" . $alt_leaf . "\" />" . $a_href_close_img;
						} else {
							$this->_phpHorizontalTreeMenu[$menu_name] .= $a_href_open_img . "<img align=\"top\" border=\"0\" class=\"imgs\" src=\"" . $img_leaf . "\" alt=\"" . $alt_leaf . "\" />" . $a_href_close_img;
						}
					}

					// output item text
					$foobar = $max_visible_level - $this->tree[$cnt]["level"] + 1;
					if ($foobar > 1) {
						$colspan = " colspan=\"" . $foobar . "\"";
					} else {
						$colspan = "";
					}
					$this->_phpHorizontalTreeMenu[$menu_name] .= "&nbsp;" . $a_href_open . $this->tree[$cnt]["parsed_text"] . $a_href_close . "\n";
					$this->_phpHorizontalTreeMenu[$menu_name] .= "</div>\n";
				}
			}
	}

	$this->_phpHorizontalTreeMenu[$menu_name] .= "</table>";

/* ********************************************************* */

/*
	// Some (old) browsers do not support the "white-space: nowrap;" CSS property...
	$this->_phpHorizontalTreeMenu[$menu_name] =
	"<table>\n" .
	"<tr>\n" .
	"<td class=\"phplmnormal\" nowrap=\"nowrap\">\n" .
	$this->_phpHorizontalTreeMenu[$menu_name] .
	"</td>\n" .
	"</tr>\n" .
	"</table>\n";
*/

	return $this->_phpHorizontalTreeMenu[$menu_name];
}

/**
* Method that returns the code of the requested PHP Horizontal Tree Menu
* @access public
* @param string $menu_name the name of the menu whose PHP Horizontal Tree Menu code
*   has to be returned
* @return string
*/
function getHorizontalTreeMenu($menu_name) {
	return $this->_phpHorizontalTreeMenu[$menu_name];
}

/**
* Method that prints the code of the requested PHP Horizontal Tree Menu
* @access public
* @param string $menu_name the name of the menu whose PHP Tree Menu code
*   has to be printed
* @return void
*/
function printHorizontalTreeMenu($menu_name) {
	print $this->_phpHorizontalTreeMenu[$menu_name];
}
function newHorizontalBlockMenu($menu_name = "",$class) 
{
 	$protocol = (isset($_SERVER["HTTPS"]) && $_SERVER["HTTPS"] == "on") ? "https://" : "http://";
	$this_host = (isset($_SERVER["HTTP_HOST"])) ? $_SERVER["HTTP_HOST"] : $_SERVER["SERVER_NAME"];
	if (isset($_SERVER["SCRIPT_NAME"])) 
	{
		$me = $_SERVER["SCRIPT_NAME"];
	} 	else if (isset($_SERVER["REQUEST_URI"])) 
		{
			$me = $_SERVER["REQUEST_URI"];
		} 	else if (isset($_SERVER["PHP_SELF"])) 
			{
				$me = $_SERVER["PHP_SELF"];
			} 	else if (isset($_SERVER["PATH_INFO"])) 
				{
					$me = $_SERVER["PATH_INFO"];
				}
	$url = $protocol . $this_host . $me;
	$query = "";
	reset($_GET);
        while (list($key, $value) = each($_GET)) 
	{
		if ($key != "p" && $value != "") 
		{
			$query .= "&amp;" . $key . "=" . $value;
		}
	}
	if ($query != "") 
	{
		$query = "?" . substr($query, 5) . "&amp;p=";
	}else{
		$query = "?p=";
	}
	$p = (isset($_GET["p"])) ? $_GET["p"] : $this->phpTreeMenuDefaultExpansion;

/* ********************************************************* */
/* Based on TreeMenu 1.1 by Bjorge Dijkstra (bjorge@gmx.net) */
/* ********************************************************* */
    	$this->_phpHorizontalBlockMenu[$menu_name] = "<tr><td>";
 	for ($i=$this->_firstItem[$menu_name]; $i<=$this->_lastItem[$menu_name]; $i++) {
		$expand[$i] = 0;
		$visible[$i] = 0;
 		$this->tree[$i]["last_item"] = 0;
	}
 	for ($i=0; $i<=$this->_maxLevel[$menu_name]; $i++) {
		$levels[$i] = 0;
	}

	// Get numbers of nodes to be expanded
	if ($p != "") {
		$explevels = explode($this->treeMenuSeparator, $p);
		$explevels_count = count($explevels);
		for ($i=0; $i<$explevels_count; $i++) {
 			$expand[$explevels[$i]] = 1;
		}
	}

	// Find last nodes of subtrees
	$last_level = $this->_maxLevel[$menu_name];
 	for ($i=$this->_lastItem[$menu_name]; $i>=$this->_firstItem[$menu_name]; $i--) 
	{
		if ($this->tree[$i]["level"] < $last_level) 
		{
			for ($j=$this->tree[$i]["level"]+1; $j<=$this->_maxLevel[$menu_name]; $j++) 
			{
				$levels[$j] = 0;
			}
		}
		if ($levels[$this->tree[$i]["level"]] == 0) 
		{
			$levels[$this->tree[$i]["level"]] = 1;
 			$this->tree[$i]["last_item"] = 1;
		} else {
			$this->tree[$i]["last_item"] = 0;
		}
		$last_level = $this->tree[$i]["level"];
	}

	// Determine visible nodes
	// all root nodes are always visible
	for ($i=$this->_firstItem[$menu_name]; $i<=$this->_lastItem[$menu_name]; $i++) {
		if ($this->tree[$i]["level"] == 1) {
			$visible[$i] = 1;
		}
	}
	if (isset($explevels)) {
		for ($i=0; $i<$explevels_count; $i++) {
			$n = $explevels[$i];
			if ($n >= $this->_firstItem[$menu_name] && $n <= $this->_lastItem[$menu_name] && $visible[$n] == 1 && $expand[$n] == 1) {
				$j = $n + 1;
				while ($j<=$this->_lastItem[$menu_name] && $this->tree[$j]["level"]>$this->tree[$n]["level"]) {
					if ($this->tree[$j]["level"] == $this->tree[$n]["level"]+1) {
						$visible[$j] = 1;
					}
					$j++;
				}
			}
		}
	}

	// Output nicely formatted tree
	for ($i=0; $i<$this->_maxLevel[$menu_name]; $i++) {
		$levels[$i] = 1;
	}
	$max_visible_level = 0;
	for ($cnt=$this->_firstItem[$menu_name]; $cnt<=$this->_lastItem[$menu_name]; $cnt++) {
		if ($visible[$cnt]) {
			$max_visible_level = max($max_visible_level, $this->tree[$cnt]["level"]);
		}
	}
	$_phpHorizontalBlockMenuRow = array();
	$parentid = 0;
       	for ($cnt=$this->_firstItem[$menu_name]; $cnt<=$this->_lastItem[$menu_name]; $cnt++) {
		if ($visible[$cnt]) 
                {
                        if (!isset($_phpHorizontalBlockMenuRow[$cnt]["level"]))
                            $_phpHorizontalBlockMenuRow[$cnt]["level"] = '';
			if ($parentid == $this->tree[$cnt]["parentid"]&& strlen($_phpHorizontalBlockMenuRow[$this->tree[$cnt]["level"]]['level']) == $cnt)
          		{
				$_phpHorizontalBlockMenuRow[$this->tree[$cnt]["level"]]['level'] = "";
			} else {
                                $_phpHorizontalBlockMenuRow[$this->tree[$cnt]["level"]]['level'] .= "   ";
                                $parentid = $this->tree[$cnt]["parentid"];
                        }
			// output item text
			$foobar = $max_visible_level - $this->tree[$cnt]["level"] + 1;
				if ($foobar > 1) {
					$colspan = " colspan=\"" . $foobar . "\"";
				} else {
					$colspan = "";
				}
				$not_a_leaf = $cnt<$this->_lastItem[$menu_name] && $this->tree[$cnt+1]["level"]>$this->tree[$cnt]["level"];
				if ($not_a_leaf) 
                                {
					// Create expand/collapse parameters
					$params = "";
					for ($i=$this->_firstItem[$menu_name]; $i<=$this->_lastItem[$menu_name]; $i++) {
						if ($expand[$i] == 1 && $cnt!= $i || ($expand[$i] == 0 && $cnt == $i)) {
							$params .= $this->treeMenuSeparator . $i;
						}
					}
					$_phpHorizontalBlockMenuRow[$this->tree[$cnt]["level"]]['level'] .= "<a name=\"" . $cnt . "\" class=\"". $class."\" href=\"" . $url . $query . $params . "#" . $cnt . "\">"  . $this->tree[$cnt]["parsed_text"] . "</a>&nbsp&nbsp&nbsp&nbsp&nbsp";
				}else{
					$_phpHorizontalBlockMenuRow[$this->tree[$cnt]["level"]]['level'] .= "<a class=\"". $class."\" href=\"". $this->tree[$cnt]["parsed_link"]."\">"  . $this->tree[$cnt]["parsed_text"] . "</a>&nbsp&nbsp&nbsp&nbsp&nbsp";
                                }
                }
	}
         $this->_phpHorizontalBlockMenu[$menu_name] = '';
	for($level=1;$level<=$max_visible_level; $level++) 
	{
            if ($level >1 && $this->tree[$level]["level"]>$this->tree[$level]["level"]-1)
            {
                $this->_phpHorizontalBlockMenu[$menu_name] .= '';
            }
            if ($level == $max_visible_level)
            {
                  $this->_phpHorizontalBlockMenu[$menu_name] .= $_phpHorizontalBlockMenuRow[$level]['level'];
            }else{
                  $this->_phpHorizontalBlockMenu[$menu_name] .= $_phpHorizontalBlockMenuRow[$level]['level'].'</td></tr><tr><td>';             
            }
	}
	

/* ********************************************************* */

/**
	// Some (old) browsers do not support the "white-space: nowrap;" CSS property...
	$this->_phpHorizontalBlockMenu[$menu_name] =
	"<table>\n" .
	"<tr>\n" .
	"<td class=\"phplmnormal\" nowrap=\"nowrap\">\n" .
	$this->_phpHorizontalBlockMenu[$menu_name] .
	"</td>\n" .
	"</tr>\n" .
	"</table>\n";
*/

	return $this->_phpHorizontalBlockMenu[$menu_name];
}
/**
* Method that returns the code of the requested PHP Horizontal Tree Menu
* @access public
* @param string $menu_name the name of the menu whose PHP Horizontal Tree Menu code
*   has to be returned
* @return string
*/
function get_phpHorizontalBlockMenu($menu_name) {
	return $this->_phpHorizontalBlockMenu[$menu_name];
}

/**
* Method that prints the code of the requested PHP Horizontal Tree Menu
* @access public
* @param string $menu_name the name of the menu whose PHP Tree Menu code
*   has to be printed
* @return void
*/
function printHorizontalBlockMenu($menu_name) 
{
 	print $this->_phpHorizontalBlockMenu[$menu_name];
}

/**
* The method to set the value of separator for the Plain Menu
* @access public
* @return void
*/
function setPlainMenuSeparator($plainMenuSeparator) {
	$this->plainMenuSeparator = $plainMenuSeparator;
}

/**
* The method to set plainMenuTpl
* @access public
* @return boolean
*/
function setPlainMenuTpl($plainMenuTpl) {
	if (str_replace("/", "", $plainMenuTpl) == $plainMenuTpl) {
		$plainMenuTpl = $this->tpldir . $plainMenuTpl;
	}
	if (!file_exists($plainMenuTpl)) {
		$this->error("setPlainMenuTpl: file $plainMenuTpl does not exist.");
		return false;
	}
	$this->plainMenuTpl = $plainMenuTpl;
	return true;
}

/**
* Method to prepare a new Plain Menu.
*
* This method processes items of a menu to prepare and return
* the corresponding Plain Menu code.
*
* @access public
* @param string $menu_name the name of the menu whose items have to be processed
* @return string
*/
function newVerticalPlainMenu(
	$menu_name = ""	// non consistent default...
	) {
	$plain_menu_blck = "";
	$t = new Template();
	$t->setFile("tplfile", $this->plainMenuTpl);
	$t->setBlock("tplfile", "template", "template_blck");
	$t->setBlock("template", "plain_menu_cell", "plain_menu_cell_blck");
	$t->setVar("plain_menu_cell_blck", "");
	for ($cnt=$this->_firstItem[$menu_name]; $cnt<=$this->_lastItem[$menu_name]; $cnt++) {
		$nbsp = "";
		for ($i=1; $i<$this->tree[$cnt]["level"]; $i++) {
			$nbsp .= "&nbsp;&nbsp;&nbsp;";
		}
		$t->setVar(array(
			"nbsp"		=> $nbsp,
			"link"		=> $this->tree[$cnt]["parsed_link"],
			"title"		=> $this->tree[$cnt]["parsed_title"],
			"target"	=> $this->tree[$cnt]["parsed_target"],
			"text"		=> $this->tree[$cnt]["parsed_text"]
		));
		$plain_menu_blck .= $t->parse("plain_menu_cell_blck", "plain_menu_cell", false);
	}
	$t->setVar("plain_menu_cell_blck", $plain_menu_blck);
	$this->_plainMenu[$menu_name] = $t->parse("template_blck", "template");

	return $this->_plainMenu[$menu_name];
}

/**
* Method that returns the code of the requested Plain Menu
* @access public
* @param string $menu_name the name of the menu whose Plain Menu code
*   has to be returned
* @return string
*/
function getVerticalPlainMenu($menu_name) {
	return $this->_plainMenu[$menu_name];
}

/**
* Method that prints the code of the requested Plain Menu
* @access public
* @param string $menu_name the name of the menu whose Plain Menu code
*   has to be printed
* @return void
*/
function printVerticalPlainMenu($menu_name) {
	print $this->_plainMenu[$menu_name];
}

/**
* The method to set the value of separator for the Horizontal Plain Menu
* @access public
* @return void
*/
function setHorizontalPlainMenuSeparator($horizontalPlainMenuSeparator) {
	$this->horizontalPlainMenuSeparator = $horizontalPlainMenuSeparator;
}

/**
* The method to set horizontalPlainMenuTpl
* @access public
* @return boolean
*/
function setHorizontalPlainMenuTpl($horizontalPlainMenuTpl) {
	if (str_replace("/", "", $horizontalPlainMenuTpl) == $horizontalPlainMenuTpl) {
		$horizontalPlainMenuTpl = $this->tpldir . $horizontalPlainMenuTpl;
	}
	if (!file_exists($horizontalPlainMenuTpl)) {
		$this->error("setHorizontalPlainMenuTpl: file $horizontalPlainMenuTpl does not exist.");
		return false;
	}
	$this->horizontalPlainMenuTpl = $horizontalPlainMenuTpl;
	return true;
}

/**
* Method to prepare a new Horizontal Plain Menu.
*
* This method processes items of a menu to prepare and return
* the corresponding Horizontal Plain Menu code.
*
* @access public
* @param string $menu_name the name of the menu whose items have to be processed
* @return string
*/
function newHorizontalPlainMenu(
	$menu_name = ""	// non consistent default...
	) {
	$horizontal_plain_menu_block = "";
	$t = new Template();
	$t->setFile("tplfile", $this->horizontalPlainMenuTpl);
	$t->setBlock("tplfile", "template", "template_blck");
	$t->setBlock("template", "horizontal_plain_menu_cell", "horizontal_plain_menu_cell_blck");
	$t->setVar("horizontal_plain_menu_cell_blck", "");
	$t->setBlock("horizontal_plain_menu_cell", "plain_menu_cell", "plain_menu_cell_blck");
	$t->setVar("plain_menu_cell_blck", "");
	for ($cnt=$this->_firstItem[$menu_name]; $cnt<=$this->_lastItem[$menu_name]; $cnt++) {
		if ($this->tree[$cnt]["level"] == 1 && $cnt > $this->_firstItem[$menu_name]) {
			$t->parse("horizontal_plain_menu_cell_blck", "horizontal_plain_menu_cell", true);
			$t->setVar("plain_menu_cell_blck", "");
		}
		$nbsp = "";
		for ($i=1; $i<$this->tree[$cnt]["level"]; $i++) {
			$nbsp .= "&nbsp;&nbsp;&nbsp;";
		}
		$t->setVar(array(
			"nbsp"		=> $nbsp,
			"link"		=> $this->tree[$cnt]["parsed_link"],
			"title"		=> $this->tree[$cnt]["parsed_title"],
			"target"	=> $this->tree[$cnt]["parsed_target"],
			"text"		=> $this->tree[$cnt]["parsed_text"]
		));
		$t->parse("plain_menu_cell_blck", "plain_menu_cell", true);
	}
	$t->parse("horizontal_plain_menu_cell_blck", "horizontal_plain_menu_cell", true);
	$this->_horizontalPlainMenu[$menu_name] = $t->parse("template_blck", "template");

	return $this->_horizontalPlainMenu[$menu_name];
}

/**
* Method that returns the code of the requested Horizontal Plain Menu
* @access public
* @param string $menu_name the name of the menu whose Horizontal Plain Menu code
*   has to be returned
* @return string
*/
function getHorizontalPlainMenu($menu_name) {
	return $this->_horizontalPlainMenu[$menu_name];
}

/**
* Method that prints the code of the requested Horizontal Plain Menu
* @access public
* @param string $menu_name the name of the menu whose Horizontal Plain Menu code
*   has to be printed
* @return void
*/
function printHorizontalPlainMenu($menu_name) {
	print $this->_horizontalPlainMenu[$menu_name];
}
	function getmasterrecord($menuname) 
	{
                                $sql = 'UPDATE mastermenu title = \''.$menuname.'WHERE (menuname = \'New\')\'';
				$db = new database( $_SESSION["preferences"]["database"]['server'],$_SESSION["preferences"]["database"]["dbname"] , $_SESSION["preferences"]["database"]["user"],$_SESSION["preferences"]["database"]["password"] ,$_SESSION["preferences"]["database"]["port"]);
				$results = $db->query($sql);	
				$this->tblmastermenu = $db->fetchAssoc($results);
				if ($db->affectedRows() == 0)
				{
					$msg = new messages;
					$msg->popupMsg ('invalidrecord',150,200,200,"Invalid Mastermenu Record","mastermenu Record for menuid X not found.");
		 			return false;
				} else {
					WHILE ($row = $db->fetchAssoc($results)) 
					{
						$rtnanswer= $row[0]['menuname'];
					} 
					$validate = new validate;
					$validate->DateStamp('mastermenu','mastermenuid',$rtnanswer,$_SESSION['preferances']['login']['username'],$_SESSION["preferences"]["database"]["dbname"]);
					return $this->tblmastermenu;
				}
		}
	function insertmasterrecord() 
	{
		$query = "insert into mastermenu (menuname) VALUES (\"New\")";
		$this->log = new log;
		$this->log->LogEvent(__CLASS__,'mastermenu','add_user_to_db',__LINE__,'error',  $query);
		$db = new database( $_SESSION["preferences"]["database"]['server'],$_SESSION["preferences"]["database"]["dbname"] , $_SESSION["preferences"]["database"]["user"],$_SESSION["preferences"]["database"]["password"] ,$_SESSION["preferences"]["database"]["port"]);
		$result = $db->query ( $query );
		if ($result){
			if ($db->affectedRows() > 0) 
                        {
                        	WHILE ($row = $db->fetchAssoc($result)) 
				{
				$rtnanswer= $row[0]['menuname'];
				} 
			}
			$validate = new validate;
			$validate->DateStamp('mastermenu','mastermenuid',$rtnanswer,$_SESSION['preferances']['login']['username'],$_SESSION["preferences"]["database"]["dbname"]);
//			$msg = new messages;
//			$msg->DisplayMessage('recadd');
		}
		return $rtnanswer;
	}
	
	 function updatemasterrecord($mastermenuid,$personid,$username,$password,$securityquest,$securityans,$usermenuname) 
	 {
		$sql = 'UPDATE mastermenu SET personid= \''.$personid.'\',username= \''.$username.'\',password= \''.md5($password).'\',securityquest= \''.$securityquest.'\',securityans= \''.$securityans.'\',usermenuname= \''.$usermenuname.'\' WHERE (mastermenuid = \''.$mastermenuid.'\')';
    	$db = new DBMS($_SESSION["preferences"]["database"]["type"],$_SESSION["preferences"]["database"]['server'],$_SESSION["preferences"]["database"]["dbname"] ,$_SESSION["preferences"]["database"]["user"],$_SESSION["preferences"]["database"]["password"],$_SESSION["preferences"]["database"]["port"]);
		$db->query($sql);
		$validate = new validate;
		$validate->DateStamp('mastermenu','mastermenuid',$mastermenuid,$_SESSION['preferances']['login']['username']);
		$msg = new messages;
		$msg->DisplayMessage('recupdate');
    }
	function deletemasterrecord($mastermenuid)
	{ 
		$sql = 'DELETE FROM mastermenu WHERE (mastermenuid = \''.$mastermenuid.'\')';
    	$db = new DBMS($_SESSION["preferences"]["database"]["type"],$_SESSION["preferences"]["database"]['server'],$_SESSION["preferences"]["database"]["dbname"] ,$_SESSION["preferences"]["database"]["user"],$_SESSION["preferences"]["database"]["password"],$_SESSION["preferences"]["database"]["port"]);
		$db->query($sql);
		$msg = new messages;
		$msg->DisplayMessage('recdelete');
	}	
	function getuserrecord($usermenuid) 
	{
				$sql = "SELECT * FROM usermenu WHERE (usermenuid=".$usermenuid.")";
				$db = new database( $_SESSION["preferences"]["database"]['server'],$_SESSION["preferences"]["database"]["dbname"] , $_SESSION["preferences"]["database"]["user"],$_SESSION["preferences"]["database"]["password"] ,$_SESSION["preferences"]["database"]["port"]);
				$results = $db->query($sql);	
				$this->tblusermenu = $db->fetchAssoc($results);
				if ($db->affectedRows() == 0)
				{
					$msg = new messages;
					$msg->popupMsg ('invalidrecord',150,200,200,"Invalid usermenu Record","usermenu Record for usermenuid  ".$usermenuid." not found.");
		 			return false;
				} else {
					$validate = new validate;
					$validate->DateStamp('usermenu','usermenuid',$rtnanswer,$_SESSION['preferances']['login']['username']);
					return $this->tblusermenu;
				}
		}
	function insertuserrecord() 
	{
            $results = false;
            $query = "insert into usermenu (username) VALUES ('New')";
            $this->log = new log;
            $this->log->LogEvent(__CLASS__,'usermenu','update usermeno',__LINE__,'error',  $query);
            $db = new database( $_SESSION["preferences"]["database"]['server'],$_SESSION["preferences"]["database"]["dbname"] , $_SESSION["preferences"]["database"]["user"],$_SESSION["preferences"]["database"]["password"] ,$_SESSION["preferences"]["database"]["port"]);
            $results = $db->query ( $query );
            if ($results)
            {    
		if ($db->affectedRows() > 0)
                {
                    WHILE ($row = $db->fetchAssoc($results)) 
                    {
			$rtnanswer= $row[0]['usermenuid'];
		    } 
		}
		$validate = new validate;
		$validate->DateStamp('usermenu','usermenuid',$rtnanswer,$_SESSION['preferances']['login']['username']);
		$msg = new messages;
		$msg->DisplayMessage('recadd');
            }
		return $rtnanswer;
	}
	
	 function updateuserrecord($usermenuid,$personid,$username,$password,$securityquest,$securityans,$usermenuname) 
	 {
		$sql = 'UPDATE usermenu SET personid= \''.$personid.'\',username= \''.$username.'\',password= \''.md5($password).'\',securityquest= \''.$securityquest.'\',securityans= \''.$securityans.'\',usermenuname= \''.$usermenuname.'\' WHERE (usermenuid = \''.$usermenuid.'\')';
                $db = new DBMS($_SESSION["preferences"]["database"]["type"],$_SESSION["preferences"]["database"]['server'],$_SESSION["preferences"]["database"]["dbname"] ,$_SESSION["preferences"]["database"]["user"],$_SESSION["preferences"]["database"]["password"],$_SESSION["preferences"]["database"]["port"]);
		$db->query($sql);
		$validate = new validate;
		$validate->DateStamp('usermenu','usermenuid',$usermenuid,$_SESSION['preferances']['login']['username']);
		$msg = new messages;
		$msg->DisplayMessage('recupdate');
    }
	function deleteuserrecord($usermenuid)
	{ 
		$sql = 'DELETE FROM usermenu WHERE (usermenuid = \''.$usermenuid.'\')';
    	$db = new DBMS($_SESSION["preferences"]["database"]["type"],$_SESSION["preferences"]["database"]['server'],$_SESSION["preferences"]["database"]["dbname"] ,$_SESSION["preferences"]["database"]["user"],$_SESSION["preferences"]["database"]["password"],$_SESSION["preferences"]["database"]["port"]);
		$db->query($sql);
		$msg = new messages;
		$msg->DisplayMessage('recdelete');
	}	
	function copymastertouser()
	{
            $sql = "SELECT * FROM mastermenu";
            $db = new database( $_SESSION["preferences"]["database"]['server'],$_SESSION["preferences"]["database"]["dbname"] , $_SESSION["preferences"]["database"]["user"],$_SESSION["preferences"]["database"]["password"] ,$_SESSION["preferences"]["database"]["port"]);
            $results = $db->query($sql);
            if ($results)
            {
                $rowcount = $db->countRows($results);
                $i=0;
                while ($i < $rowcount) 
                {
                    $row = $db->fetchAssoc($results);
                    $sql = "insert into usermenu (userid,menuname,orderfield,mastermenuid,title) VALUES ('".$_SESSION['login']['userid']."','".$row['menuname']."','".$row['orderfield']."',".$row['mastermenuid'].",'".$row['text']."')";
                    $db = new database( $_SESSION["preferences"]["database"]['server'],$_SESSION["preferences"]["database"]["dbname"] , $_SESSION["preferences"]["database"]["user"],$_SESSION["preferences"]["database"]["password"] ,$_SESSION["preferences"]["database"]["port"]);
                    $result = $db->query ($sql);
                    if ($resultsu)
                    {   
        		$validate = new validate;
                	$validate->DateStamp('usermenu','usermenuid',$db->getLatestInsertId('usermenu','usermenuid'),$_SESSION['login']['username'],$_SESSION["preferences"]['database']["dbname"]);
                        $msg = new messages;
                        $msg->DisplayMessage('recadd');
                    }
                    $i++;
                }
            }
	    return;
        }
 
	function getlanguagerecord($menulanguageid) 
	{
				$sql = "SELECT * FROM menulanguage WHERE (menulanguaged=".$menulanguageid.")";
				$db = new database( $_SESSION["preferences"]["database"]['server'],$_SESSION["preferences"]["database"]["dbname"] , $_SESSION["preferences"]["database"]["user"],$_SESSION["preferences"]["database"]["password"] ,$_SESSION["preferences"]["database"]["port"]);
				$results = $db->query($sql);	
				$this->tblmenulanguage = $db->fetchAssoc($results);
				if ($db->affectedRows() == 0)
				{
					$msg = new messages;
					$msg->popupMsg ('invalidrecord',150,200,200,"Invalid menulanguage Record","menulanguage Record for menulanguageid  ".$menulanguageid." not found.");
		 			return false;
				} else {
                                        WHILE ($row = $db->fetchAssoc($results)) 
                                        {
                                            $rtnanswer= $row[0]['menulanguageid'];
                                        } 
					$validate = new validate;
					$validate->DateStamp('menulanguage','menulanguageid',$rtnanswer,$_SESSION['preferances']['login']['username']);
					return $this->tblmenulanguage;
				}
		}
	function insertlanguerecord() 
	{
		$query = "insert into menulanguage (username) VALUES ('New')";
		$this->log = new log;
		$this->log->LogEvent(__CLASS__,'menulanguage','insert memlamguages',__LINE__,'error',  $query);
		$db = new database( $_SESSION["preferences"]["database"]['server'],$_SESSION["preferences"]["database"]["dbname"] , $_SESSION["preferences"]["database"]["user"],$_SESSION["preferences"]["database"]["password"] ,$_SESSION["preferences"]["database"]["port"]);
		$result = $db->query ( $query );
		if ($db->affectedRows() > 0) {
				WHILE ($row = $db->fetchAssoc($results)) 
				{
					$rtnanswer= $row[0]['menulanguageid'];
			    } 
			}
		$validate = new validate;
		$validate->DateStamp('menulanguage','menulanguageid',$rtnanswer,$_SESSION['preferances']['login']['username'],$_SESSION["preferences"]['database']["dbname"]);
		$msg = new messages;
		$msg->DisplayMessage('recadd');
		return $rtnanswer;
	}
	
	 function updatelanguerecord($menulanguageid,$personid,$username,$password,$securityquest,$securityans,$usermenuname) 
	 {
		$sql = 'UPDATE menulanguage SET personid= \''.$personid.'\',username= \''.$username.'\',password= \''.md5($password).'\',securityquest= \''.$securityquest.'\',securityans= \''.$securityans.'\',usermenuname= \''.$usermenuname.'\' WHERE (menulanguageid = \''.$menulanguageid.'\')';
    	$db = new DBMS($_SESSION["preferences"]["database"]["type"],$_SESSION["preferences"]["database"]['server'],$_SESSION["preferences"]["database"]["dbname"] ,$_SESSION["preferences"]["database"]["user"],$_SESSION["preferences"]["database"]["password"],$_SESSION["preferences"]["database"]["port"]);
		$db->query($sql);
		$validate = new validate;
		$validate->DateStamp('menulanguage','menulanguageid',$menulanguageid,$_SESSION['preferances']['login']['username'],$_SESSION["preferences"]['database']["dbname"]);
		$msg = new messages;
		$msg->DisplayMessage('recupdate');
    }
	function deletelanguagerecord($menulanguageid)
	{ 
		$sql = 'DELETE FROM menulanguage WHERE (menulanguageid = \''.$menulanguageid.'\')';
    	$db = new DBMS($_SESSION["preferences"]["database"]["type"],$_SESSION["preferences"]["database"]['server'],$_SESSION["preferences"]["database"]["dbname"] ,$_SESSION["preferences"]["database"]["user"],$_SESSION["preferences"]["database"]["password"],$_SESSION["preferences"]["database"]["port"]);
		$db->query($sql);
		$msg = new messages;
		$msg->DisplayMessage('recdelete');
	}	

} /* END OF CLASS */

?>