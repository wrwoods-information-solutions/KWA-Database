<?php header("Content-type: text/css");
/* CSS Document */
.headtitle {
	font-family:"Garamond";
	font-weight:bold;
	font-size: 36pt;
	color: #000000;
	font-weight: bold;
}
.title {
	font-family:"Garamond";
	font-size: 18pt;
	color: #000000;
	font-weight: bold;
}
.subtitle {
	font-family:"Garamond";
	font-weight: bold;
	font-size: 14pt;
	color: #000000;
} 
.body {
	font-family:"Garamomnd";
	font-weight: normal;
	font-size: 14pt;
	color: #000000;
}
.smbody {
	font-family:"Garamomnd";
	font-weight: normal;
	font-size: 8pt;
	color: #000000;
}
.loginbuttons, h4 {text-align:center; width:100%;}




#loginform .button {
	background-image:url('images/bg2.GIF');
	background-color:#aaa;
	border:2px;
	border-style:outset;
	}

#loginform input:focus , #loginform input:hover , #loginform input:active {
	border-style:inset;
	color:#f00;
}
#loginform {
	clear:both;
	width:100%;
	background-color:#3cc;
	font-size:14px;
	text-align:right;
	padding:5px 0px;
	border-bottom:4px solid #388;
}
#lt_msg { 
	color:red;
	text-align:center;
}
#loginform * {
	padding:0px;
	margin:0px;
}

#loginform form {
	margin-right:10px;
}

#loginform p {
	display:inline;
}

.formPanel {
	padding: 10px;
	margin: auto;
	display:block;
	width:400px;
	text-align:center;	
}

.fieldnames, .fieldanswers {
	width:170px;
	float:left;
	text-align:left;	
}
.fieldanswers form {padding:0px;margin:0px;}

.fieldnames label {
	width:170px;
	height:30px;
	margin-bottom: 6px;
	display:block;
}
.fieldanswers input {
	width:180px;
	height:30px;
	margin:0px;
}
.calendar {
  position: relative;
  display: none;
  border-top: 2px solid #fff;
  border-right: 2px solid #000;
  border-bottom: 2px solid #000;
  border-left: 2px solid #fff;
  font-size: 14px;
  color: #000;
  cursor: default;
  background: #c8d0d4;
  font-family: "Garamomnd";
}
div.sample_popup { z-index: 1; }

div.sample_popup div.menu_form_header
{
  border: 1px solid black;
  border-bottom: none;

  width: 200px;

  height:      20px;
  line-height: 19px;
  vertical-align: middle;

  background: url('form_header.png') no-repeat;

  text-decoration: none;
  font-family: Garamomnd;
  font-weight: 900;
  font-size:  13px;
  color:   #000000;
  cursor:  default;
}

div.sample_popup div.menu_form_body
{
  width: 200px;
  border: 1px solid black;
  background: url('form.png') no-repeat left bottom;
}

div.sample_popup img.menu_form_exit
{
  float:  right;
  margin: 4px 5px 0px 0px;
  cursor: pointer;
}

div.sample_popup table
{
  width: 100%;
  border-collapse: collapse;
}

div.sample_popup th
{
  width: 1%;
  padding: 0px 5px 1px 0px;

  text-align: left;

  font-family: "Garamomnd";
  font-weight: 900;
  font-size:  13px;
  color:   #004060;
}

div.sample_popup td
{
  width: 99%;
  padding: 0px 0px 1px 0px;
}

div.sample_popup form
{
  margin:  0px;
  padding: 8px 10px 10px 10px;
}

div.sample_popup input.field
{
  width: 95%;
  border: 1px solid #808080;

  font-family: "Garamomnd";
  font-size: 12px;
}

div.sample_popup input.btn
{
  margin-top: 2px;
  border: 1px solid #808080;

  background-color: #DDFFDD;

  font-family: "Garamomnd";
  font-size: 11px;
}
body { font: 0.8em Garamomnd; }

/* displaydata Table */
table.tbl {border: 0;  background: url(Images/HeavenBackground.jpg);font-size: 0.9em; clear: both; }
table.brd {border: 2px solid #000000;  background: url(Images/HeavenBackground.jpg); font-size: 0.9em; clear: both; }
td.tbl-header { background: url(Images/HeavenBackground.jpg); text-align: center; padding: 3px; font-weight: bold; border-bottom: 2px solid #000000; }
tr.tbl-footer {}
table.tbl-footer { font-size: 1em; }
tr.tbl-row {}
tr.tbl-row:hover { background: #EBFFFF; } /* Old color: #E9E9E9 */
tr.tbl-row-even { background: #f4f4f4; }
tr.tbl-row-odd { background: white; }
tr.tbl-row-highlight:hover { background: #fffba6; cursor: pointer; }
td.tbl-nav { background: url(Images/head_bg.gif); height: 20px; border-top: 2px solid #000000; color: #4D4D4D; }
td.tbl-pages { text-align: center; }
td.tbl-row-num { text-align: left; font-family:"Garamond"; font-weight: bold; font-size: 14pt; color: #000000;}
td.tbl-cell {}
td.tbl-controls { text-align: left; }
td.tbl-found {}
td.tbl-checkall {}
td.tbl-page { text-align: right; }
td.tbl-noresults { font-weight: bold; color: #9F0000; height: 45px; text-align: center; }
span.tbl-reset { margin: 5px 5px; }
img.tbl-reset-image { margin-right: 5px; border: 0; }
span.tbl-create { margin: 5px 0; }
img.tbl-create-image { margin-right: 5px; border: 0; }
div.tbl-filter-box {}
img.tbl-arrows { border: 0; }
img.tbl-order-image { margin: 0 2px; border: 0; }
img.tbl-filter-image { border: 0; }
img.tbl-control-image { border: 0; }
span.page-selected { color: black; font-weight: bold; }
input.tbl-checkbox {}
/* Calendar Date Combo =/
/* The main calendar widget.  DIV containing a table. */

.calendar {
  position: relative;
  display: none;
  border-top: 2px solid #fff;
  border-right: 2px solid #000;
  border-bottom: 2px solid #000;
  border-left: 2px solid #fff;
  font-size: 11px;
  color: #000;
  cursor: default;
  background: #c8d0d4;
  font-family: Garamomnd;
}

.calendar table {
  border-top: 1px solid #000;
  border-right: 1px solid #fff;
  border-bottom: 1px solid #fff;
  border-left: 1px solid #000;
  font-size: 11px;
  color: #000;
  cursor: default;
  background: #c8d0d4;
  font-family: Garamomnd;
}

/* Header part -- contains navigation buttons and day names. */

.calendar .button { /* "<<", "<", ">", ">>" buttons have this class */
  text-align: center;
  padding: 1px;
  border-top: 1px solid #fff;
  border-right: 1px solid #000;
  border-bottom: 1px solid #000;
  border-left: 1px solid #fff;
}

.calendar .nav {
  background: transparent url(menuarrow.gif) no-repeat 100% 100%;
}

.calendar thead .title { /* This holds the current "month, year" */
  font-weight: bold;
  padding: 1px;
  border: 1px solid #000;
  background: #788084;
  color: #fff;
  text-align: center;
}

.calendar thead .headrow { /* Row <TR> containing navigation buttons */
}

.calendar thead .daynames { /* Row <TR> containing the day names */
}

.calendar thead .name { /* Cells <TD> containing the day names */
  border-bottom: 1px solid #000;
  padding: 2px;
  text-align: center;
  background: #e8f0f4;
}

.calendar thead .weekend { /* How a weekend day name shows in header */
  color: #f00;
}

.calendar thead .hilite { /* How do the buttons in header appear when hover */
  border-top: 2px solid #fff;
  border-right: 2px solid #000;
  border-bottom: 2px solid #000;
  border-left: 2px solid #fff;
  padding: 0px;
  background-color: #d8e0e4;
}

.calendar thead .active { /* Active (pressed) buttons in header */
  padding: 2px 0px 0px 2px;
  border-top: 1px solid #000;
  border-right: 1px solid #fff;
  border-bottom: 1px solid #fff;
  border-left: 1px solid #000;
  background-color: #b8c0c4;
}

/* The body part -- contains all the days in month. */

.calendar tbody .day { /* Cells <TD> containing month days dates */
  width: 2em;
  text-align: right;
  padding: 2px 4px 2px 2px;
}
.calendar tbody .day.othermonth {
  font-size: 80%;
  color: #aaa;
}
.calendar tbody .day.othermonth.oweekend {
  color: #faa;
}

.calendar table .wn {
  padding: 2px 3px 2px 2px;
  border-right: 1px solid #000;
  background: #e8f4f0;
}

.calendar tbody .rowhilite td {
  background: #d8e4e0;
}

.calendar tbody .rowhilite td.wn {
  background: #c8d4d0;
}

.calendar tbody td.hilite { /* Hovered cells <TD> */
  padding: 1px 3px 1px 1px;
  border: 1px solid;
  border-color: #fff #000 #000 #fff;
}

.calendar tbody td.active { /* Active (pressed) cells <TD> */
  padding: 2px 2px 0px 2px;
  border: 1px solid;
  border-color: #000 #fff #fff #000;
}

.calendar tbody td.selected { /* Cell showing selected date */
  font-weight: bold;
  padding: 2px 2px 0px 2px;
  border: 1px solid;
  border-color: #000 #fff #fff #000;
  background: #d8e0e4;
}

.calendar tbody td.weekend { /* Cells showing weekend days */
  color: #f00;
}

.calendar tbody td.today { /* Cell showing today date */
  font-weight: bold;
  color: #00f;
}

.calendar tbody .disabled { color: #999; }

.calendar tbody .emptycell { /* Empty cells (the best is to hide them) */
  visibility: hidden;
}

.calendar tbody .emptyrow { /* Empty row (some months need less than 6 rows) */
  display: none;
}

/* The footer part -- status bar and "Close" button */

.calendar tfoot .footrow { /* The <TR> in footer (only one right now) */
}

.calendar tfoot .ttip { /* Tooltip (status bar) cell <TD> */
  background: #e8f0f4;
  padding: 1px;
  border: 1px solid #000;
  background: #788084;
  color: #fff;
  text-align: center;
}

.calendar tfoot .hilite { /* Hover style for buttons in footer */
  border-top: 1px solid #fff;
  border-right: 1px solid #000;
  border-bottom: 1px solid #000;
  border-left: 1px solid #fff;
  padding: 1px;
  background: #d8e0e4;
}

.calendar tfoot .active { /* Active (pressed) style for buttons in footer */
  padding: 2px 0px 0px 2px;
  border-top: 1px solid #000;
  border-right: 1px solid #fff;
  border-bottom: 1px solid #fff;
  border-left: 1px solid #000;
}

/* Combo boxes (menus that display months/years for direct selection) */

.calendar .combo {
  position: absolute;
  display: none;
  width: 4em;
  top: 0px;
  left: 0px;
  cursor: default;
  border-top: 1px solid #fff;
  border-right: 1px solid #000;
  border-bottom: 1px solid #000;
  border-left: 1px solid #fff;
  background: #d8e0e4;
  font-size: 90%;
  padding: 1px;
  z-index: 100;
}

.calendar .combo .label,
.calendar .combo .label-IEfix {
  text-align: center;
  padding: 1px;
}

.calendar .combo .label-IEfix {
  width: 4em;
}

.calendar .combo .active {
  background: #c8d0d4;
  padding: 0px;
  border-top: 1px solid #000;
  border-right: 1px solid #fff;
  border-bottom: 1px solid #fff;
  border-left: 1px solid #000;
}

.calendar .combo .hilite {
  background: #048;
  color: #aef;
}

.calendar td.time {
  border-top: 1px solid #000;
  padding: 1px 0px;
  text-align: center;
  background-color: #e8f0f4;
}

.calendar td.time .hour,
.calendar td.time .minute,
.calendar td.time .ampm {
  padding: 0px 3px 0px 4px;
  border: 1px solid #889;
  font-weight: bold;
  background-color: #fff;
}

.calendar td.time .ampm {
  text-align: center;
}

.calendar td.time .colon {
  padding: 0px 2px 0px 3px;
  font-weight: bold;
}

.calendar td.time span.hilite {
  border-color: #000;
  background-color: #667;
  color: #fff;
}

.calendar td.time span.active {
  border-color: #f00;
  background-color: #000;
  color: #0f0;
}
?>