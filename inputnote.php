<?PHP session_start(); ?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<link href="style.css" rel="stylesheet" type="text/css">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<title>Setup Handbook</title>
<script type="text/javascript" src="tinymce/jscripts/tiny_mce/tiny_mce.js"></script>
<script type="text/javascript">
	tinyMCE.init({
		// General options
		mode : "textareas",
		theme : "advanced",
		skin : "o2k7",
		plugins : "autolink,lists,pagebreak,style,layer,table,save,advhr,advimage,advlink,emotions,iespell,insertdatetime,preview,media,searchreplace,print,contextmenu,paste,directionality,fullscreen,noneditable,visualchars,nonbreaking,xhtmlxtras,template,inlinepopups,autosave",

		// Theme options
		theme_advanced_buttons1 : "save,newdocument,|,bold,italic,underline,strikethrough,|,justifyleft,justifycenter,justifyright,justifyfull,|,styleselect,formatselect,fontselect,fontsizeselect",
		theme_advanced_buttons2 : "cut,copy,paste,pastetext,pasteword,|,search,replace,|,bullist,numlist,|,outdent,indent,blockquote,|,undo,redo,|,link,unlink,anchor,image,cleanup,help,code,|,insertdate,inserttime,preview,|,forecolor,backcolor",
		theme_advanced_buttons3 : "tablecontrols,|,hr,removeformat,visualaid,|,sub,sup,|,charmap,emotions,iespell,media,advhr,|,print,|,ltr,rtl,|,fullscreen",
		theme_advanced_buttons4 : "insertlayer,moveforward,movebackward,absolute,|,styleprops,|,cite,abbr,acronym,del,ins,attribs,|,visualchars,nonbreaking,template,pagebreak,restoredraft",
		theme_advanced_toolbar_location : "top",
		theme_advanced_toolbar_align : "left",
		theme_advanced_statusbar_location : "bottom",
		theme_advanced_resizing : true,

		// Example word content CSS (should be your site CSS) this one removes paragraph margins
		content_css : "css/word.css",

		// Drop lists for link/image/media/template dialogs
		template_external_list_url : "lists/template_list.js",
		external_link_list_url : "lists/link_list.js",
		external_image_list_url : "lists/image_list.js",
		media_external_list_url : "lists/media_list.js",

		// Replace values for the template plugin
		template_replace_values : {
			username : "Some User",
			staffid : "991234"
		}
	});
</script>
<?php
require_once "class.preferences.php";
require_once "class.displaydata.php";
require_once "class.notes.php";
$preferences = new preferences;
		$preferences->basicincludes();
$preferences->loadpreferences();
$login = new login();
$login->checklogin();
$login->checklogout();
		$note = new notes();
		if ($_POST['refreshtitle'] == 'Refresh')
		{
			$_SESSION["datagrid"]["historydisplaygrid"] = false;
			$_SESSION["datagrid"]["keyworddisplaygrid"] = false;
			if ($_POST["selecttitle"] == -99)
			{
				$_SESSION["tblnote"]['noteid'] = $note->insertrecord();
			}else{
				$_SESSION["tblnote"]['noteid'] = $_POST["selecttitle"];
			}
 		   	$_SESSION["tblnote"] = $note->getrecord($_SESSION["tblnote"]['noteid']);
			echo __LINE__.' $_POST["$_SESSION["tblnote"]["noteid"] = '.$_POST[$_SESSION["tblnote"]["noteid"]].'<br>';
			switch ($_SESSION["tblnote"]['type'])
			{
				case 1:
//					title page
					$_SESSION["displaynote"]["title"] = false;		
					$_SESSION["displaynote"]["heading"] = false;		
					$_SESSION["displaynote"]["section"] = false;		
					$_SESSION["displaynote"]["seqno"] = false;		
					$_SESSION["displaynote"]["status"] = true;
					break;		
				case 2:
//					Introduction		
					$_SESSION["displaynote"]["title"] = true;		
					$_SESSION["displaynote"]["heading"] = false;		
					$_SESSION["displaynote"]["section"] = false;		
					$_SESSION["displaynote"]["seqno"] = true;		
					$_SESSION["displaynote"]["status"] = true;		
					break;		
				case 3:
//					By-laws
					$_SESSION["displaynote"]["title"] = true;		
					$_SESSION["displaynote"]["heading"] = false;		
					$_SESSION["displaynote"]["section"] = true;		
					$_SESSION["displaynote"]["seqno"] = true;		
					$_SESSION["displaynote"]["status"] = true;		
					break;		
				case 4:
//					 Policy		
					$_SESSION["displaynote"]["title"] = true;		
					$_SESSION["displaynote"]["heading"] = true;		
					$_SESSION["displaynote"]["section"] = true;		
					$_SESSION["displaynote"]["seqno"] = true;		
					$_SESSION["displaynote"]["status"] = true;		
					break;		
				case 5:
//					 Procedures		
					$_SESSION["displaynote"]["title"] = true;		
					$_SESSION["displaynote"]["heading"] = false;		
					$_SESSION["displaynote"]["section"] = true;		
					$_SESSION["displaynote"]["seqno"] = true;		
					$_SESSION["displaynote"]["status"] = true;		
					break;		
				case 6:
//					 Miscelleous
					$_SESSION["displaynote"]["title"] = true;		
					$_SESSION["displaynote"]["heading"] = false;		
					$_SESSION["displaynote"]["section"] = false;		
					$_SESSION["displaynote"]["seqno"] = true;		
					$_SESSION["displaynote"]["status"] = true;		
					break;
				}		
		}
		if ($_POST['refreshdesc'] == 'Refresh')
		{
			$_SESSION["tblnote"]['title'] = $_POST["title"];
			$_SESSION["tblnote"]['type'] = $_POST["type"];
			$_SESSION["tblnote"]['section'] = $_POST["section"];
			$_SESSION["tblnote"]['seqno'] = $_POST["seqno"];
			$_SESSION["tblnote"]['status'] = $_POST["status"];
			switch ($_SESSION["tblnote"]['type'])
			{
				case 1:
//					title page
					$_SESSION["displaynote"]["title"] = true;		
					$_SESSION["displaynote"]["heading"] = false;		
					$_SESSION["displaynote"]["section"] = false;		
					$_SESSION["displaynote"]["seqno"] = false;		
					$_SESSION["displaynote"]["status"] = true;
					break;		
				case 2:
//					Introduction		
					$_SESSION["displaynote"]["title"] = true;		
					$_SESSION["displaynote"]["heading"] = false;		
					$_SESSION["displaynote"]["section"] = false;		
					$_SESSION["displaynote"]["seqno"] = true;		
					$_SESSION["displaynote"]["status"] = true;		
					break;		
				case 3:
//					By-laws
					$_SESSION["displaynote"]["title"] = true;		
					$_SESSION["displaynote"]["heading"] = false;		
					$_SESSION["displaynote"]["section"] = true;		
					$_SESSION["displaynote"]["seqno"] = true;		
					$_SESSION["displaynote"]["status"] = true;		
					break;		
				case 4:
//					 Policy		
					$_SESSION["displaynote"]["title"] = true;		
					$_SESSION["displaynote"]["heading"] = true;		
					$_SESSION["displaynote"]["section"] = true;		
					$_SESSION["displaynote"]["seqno"] = true;		
					$_SESSION["displaynote"]["status"] = true;		
					break;		
				case 5:
//					 Procedures		
					$_SESSION["displaynote"]["title"] = true;		
					$_SESSION["displaynote"]["heading"] = false;		
					$_SESSION["displaynote"]["section"] = true;		
					$_SESSION["displaynote"]["seqno"] = true;		
					$_SESSION["displaynote"]["status"] = true;		
					break;		
				case 6:
//					 Miscelleous
					$_SESSION["displaynote"]["title"] = true;		
					$_SESSION["displaynote"]["heading"] = false;		
					$_SESSION["displaynote"]["section"] = false;		
					$_SESSION["displaynote"]["seqno"] = true;		
					$_SESSION["displaynote"]["status"] = true;		
					break;		
			}		
		}
		if ($_POST['save'] == 'Save')
		{
			echo __LINE__.' IN SAVE<br>';
			$_SESSION["tblnote"]['body'] = $_POST["body"];
			$note = new note;
			$note->updaterecord();
			$_SESSION["datagrid"]["historydisplaygrid"] = true;
			$_SESSION["datagrid"]["keyworddisplaygrid"] = true;
		}
		if ($_POST['delete'] == 'Delete')
		{
			$note = new note;
			$note->deleterecord();
			$login = new login;
			$login->cleanSESSION();
		}
		if ($_POST['reset'] == 'Reset')
		{
			$login = new login;
			$login->cleanSESSION();
		}
// Load the database adapter
		$db = new database($_SESSION["preferences"]["database"]["server"],$_SESSION["preferences"]["database"]["use"],$_SESSION["preferences"]["database"]["password"],$_SESSION["preferences"]["database"]["dbname"]);

// Load the datagrid class
		$history = new DataGrid($db);
		$history->setDataGrid('historydatagrid');

// Set the query, select all rows from the dbhistory table
		$history->setQuery("*", "hbhistory","hbhistoryid","noteid = '".$_SESSION["tblnote"]['noteid'].'\'');
		$history->setConstantFields(array("noteid"=>$_SESSION["tblnote"]["noteid"]));
		$history->SetPrimaryID('hbhistoryid') ;
		$history->setOrder('hbhistoryid');

	// Hide ID field
		$history->hidefield('hbhistoryid');
		$history->hidefield('noteid');
		$history->hidefield('creationdate');
		$history->hidefield('updatedate');
		$history->hidefield('updateby');
// Show reset grid control
		$history->showReset();
// setting inline edit
		$history->SetInLineEdit(true);
// Add standard control
		$history->addStandardControl(DataGrid::STDCTRL_INLINEEDIT,"setupnote.php",DataGrid::TYPE_PHPFUNCTION);
// Add create control
		$history->showCreateButton("setupnote.php", DataGrid::TYPE_INLINEADDRECORD, 'Add New History');

// Show checkboxes
	 	$history->showCheckboxes(false);

// Show row numbers
		$history->showRowNumber(false);

// Change the amount of results per page
		$history->setResultsPerPage(5);

// Change headers text
		$history->SetFieldHeader('title', 'Title');
		$history->SetFieldHeader('date', 'Date');
//  set field type

//  set inlineedit field type
		$history->SetInlineFieldType('title', DataGrid::INLINE_CODECOMBO,array('name' => 'title', 'table' => 'hbhistory','field' => 'title','class' => 'body', 'default' =>'title')); // historycode
		$history->SetInlineFieldType('date', DataGrid::INLINE_DATECOMBO,array('name' => 'date', 'classctl' => 'body', 'value' => 'date')); // Date
// Stop ordering
		$history->hideOrder(false);

// Load the datagrid class
		$keyword = new DataGrid($db);
		$keyword->setDataGrid('keyworddatagrid');
		$keyword->setQuery("*", "hbkeyword","hbkeywordid","noteid = '".$_SESSION["tblnote"]['noteid'].'\'');
		$keyword->setConstantFields(array("noteid"=>$_SESSION["tblnote"]["noteid"]));

		$keyword->SetPrimaryID('hbkeywordid') ;
		$keyword->setOrder('hbkeywordid');

	// Hide ID field
		$keyword->hidefield('hbkeywordid');
		$keyword->hidefield('noteid');
		$keyword->hidefield('creationdate');
		$keyword->hidefield('updatedate');
		$keyword->hidefield('updateby');
// Show reset grid control
		$keyword->showReset();

// setting inline edit
		$keyword->SetInLineEdit(true);
// Add standard control
		$keyword->addStandardControl(DataGrid::STDCTRL_INLINEEDIT,"setupnote.php",DataGrid::TYPE_PHPFUNCTION);
// Add create control
		$keyword->showCreateButton("setupnote.php", DataGrid::TYPE_INLINEADDRECORD, 'Add New Keyword');

// Show checkboxes
	 	$keyword->showCheckboxes(false);

// Show row numbers
		$keyword->showRowNumber(false);

// Change the amount of results per page
		$keyword->setResultsPerPage(5);

// Change headers text
		$keyword->SetFieldHeader('keyword', 'Keyword');
//  set field type

//  set inlineedit field type
		$keyword->SetInlineFieldType('keywordid', DataGrid::INLINE_COMBOBOX, array('name' => 'keywordid', 'table' => 'keyword','where' =>'','order_by' => 'keyword','asc'=>'ASC','value' => 'keywordid', 'display' => 'keyword', 'class' => 'body','pleaseselect' =>false, 'commonelements'=> array(),'default'=> "",'noinput'=> false,'AllowNew'=> false,'newname'=>'', 'new'=> false,'size' =>'20')); // keyword
// Stop ordering
		$keyword->hideOrder(false);
?>
</head>

<body>
<?php
	 $preferences = new his;
	 $preferences->header('Setup Handbook','Images/menu background.png');
?>
<table width="100%" height="100%" background="Images/body background.jpg" border="0">
	<tr>
    	<form action= "setupnote.php" method="post">
      		<td class="subtitle">Search Title:&nbsp;
          		<?php
					$validate = new validate;
					echo $validate->ComboBox("selecttitle","notes",'',"noteid","ASC","noteid","title","body",true,array('New note Entry' => '-99'),$_SESSION["tblnote"]['noteid'],false,false,"",$_SESSION["newtitle"],"25");
				?>
          		<input type="submit" name="refreshtitle" value="Refresh" />			</td>
    	</form>
  	</tr>
	<form method="post" action="setupnote.php">
	<tr>
		<td>
				<table width="50%" background="Images/body background.jpg" border="0">
	  				<?php
						if ($_SESSION["displaynote"]["title"])
						{
     						echo 	'<tr>
										<td class="subtitle"> Title
        									<input name="title" value="'.$_SESSION["tblnote"]["title"].'" type="text" class="body" size="50" />
										</td>
									</tr>';
						}
						if ($_SESSION["displaynote"]["heading"])
						{
   							echo '	<tr>
      									<td class="subtitle">
	  										Insert Heading
										</td>
									</tr>';
						}
					if ($_SESSION["datagrid"]["historydisplaygrid"])
					{
						$_SESSION['datagrid']['name'] = 'historydatagrid';
						echo '	<tr>
 									<td class="subtitle">
									 	History
									</td>
								</tr>
								<tr>
									<td>';
// Print the table
										$history->printTable();
						echo       '</td>
						         </tr>';
					}
					if ($_SESSION["datagrid"]["keyworddisplaygrid"])
					{
						$_SESSION['datagrid']['name'] = 'keyworddatagrid';
						echo '	<tr>
 									<td class="subtitle">
									 	Keywords
									</td>
						    	</tr>
								<tr>
									 <td>';
// Print the table
										 $keyword->printTable();
						echo        '</td>
						         </tr>';
			}
		?>
				</table> 
			</td>
	      <td><table background="Images/body background.jpg" border="1">
            <tr>
              <td class="subtitle"> Type </td>
              <td>
			  	<?php
					$validate = new validate;
								echo $validate->CodeCombo("type","notes","type","body",$_SESSION["tblnote"]['type']);
				?>
              </td>
            </tr>
            <?php
							if ($_SESSION["displaynote"]["section"])
							{
								$validate = new validate;
      							echo '	<tr>
											<td class="subtitle">
												Section 
											</td>
       									<td>'.
											$validate->CodeCombo("section","notes","section","body",$_SESSION["tblnote"]['section']).
								      	'</td>
									</tr>';
							}
							if ($_SESSION["displaynote"]["seqno"])
							{
	    						echo	'<tr>
											<td class="subtitle">
												Sequence No 
											</td>
      										<td>
												<input name="seqno" value="'.$_SESSION["tblnote"]["seqno"].'" type="text" class="body" size="10" />
	    									</td>
										</tr>';
							}
							if ($_SESSION["displaynote"]["status"])
							{
								$validate = new validate;
  								echo '	<tr>
									    	<td class="subtitle"> 
										  		Status 
											</td>
      										<td>'.
												$validate->CodeCombo("status","notes","status","body",$_SESSION["tblnote"]['status']).
											'</td>
										</tr>';
						}
				?>
            <tr>
              <td><input type="submit" name="refreshdesc" value="Refresh" />              </td>
            </tr>
          </table>
        </td>
	</tr>	
	<tr>
      	<td colspan="2" >
		  	<textarea name="body" class="body" cols="115" rows="15" ><?PHP echo $_SESSION["tblnote"]['body'];?></textarea>		</td>
	</tr>
	<tr>
		<td>
	      	<input type="submit" name="save" value="Save" />
    	    <input type="submit" name="delete" value="Delete" />
        	<input type="submit" name="reset" value="Reset" />		</td>
    </tr>
  </form>
  </table>
</body>
</html>
