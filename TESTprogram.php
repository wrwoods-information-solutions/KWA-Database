<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN">
<HTML>
    <HEAD>
        <meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1">
        <link href="style.css" rel="stylesheet" type="text/css">
        <script type="text/javascript" src="popup-window.js"></script>
        <script src='//cdn.tinymce.com/4/tinymce.min.js'></script>
        <script>
tinymce.init({
  selector: 'textarea',
  height: 50,
  plugins: [
    'advlist autolink lists link image charmap print preview anchor',
    'searchreplace visualblocks code ',
    'insertdatetime media table contextmenu paste code'
  ],
  toolbar: 'insertfile undo redo | styleselect | bold italic | alignleft aligncenter alignright alignjustify | bullist numlist outdent indent | link image',
  content_css: [
    '//fast.fonts.net/cssapi/e6dc9b99-64fe-4292-ad98-6974f93cd2a2.css',
    '//www.tinymce.com/css/codepen.min.css'
  ]
});
        </script>
        <TITLE>KWA Input Program</TITLE>
        
<script type="text/javascript" src="popup-window.js"></script>

    </HEAD>
    <BODY>
        <table width="100%" bgcolor="#0099FF" border="0">
					<tr>
                                               <td height="96" align="left"><img src= "images/newlogo.gif"></td>
                                               <td class="subtitle" align="cemtre">User Name: <scan class="body"> admin</scan></td>
 						<td align="right">
							<form id="logout" name="logout" action= "index.php?LC_ACTION=logout"  method="post">
								<p class="button" align="center"><input class="button" type="submit" name="LC_ACTION" value="Logout" /></p>
							</form>	</td>
                                       </tr>
                                        <tr>
						<td align="center" class="headtitle" colspan="3">Input Program Profile</td>
                                        </tr>
				</table>        <table class="tbl" width="100%">
            <tr>
                <td colspan="13">
           <a class="title" href="home.php">Home</a>&nbsp&nbsp&nbsp&nbsp&nbsp   <a name="2" class="title" href="http://localhost/KWA Database/inputprogram.php?p=|2#2">Person</a>&nbsp&nbsp&nbsp&nbsp&nbsp   <a name="5" class="title" href="http://localhost/KWA Database/inputprogram.php?p=|5#5">Organization</a>&nbsp&nbsp&nbsp&nbsp&nbsp   <a name="9" class="title" href="http://localhost/KWA Database/inputprogram.php?p=|9#9">Program</a>&nbsp&nbsp&nbsp&nbsp&nbsp   <a name="11" class="title" href="http://localhost/KWA Database/inputprogram.php?p=|11#11">Request</a>&nbsp&nbsp&nbsp&nbsp&nbsp   <a name="13" class="title" href="http://localhost/KWA Database/inputprogram.php?p=|13#13">Administration</a>&nbsp&nbsp&nbsp&nbsp&nbsp   <a name="22" class="title" href="http://localhost/KWA Database/inputprogram.php?p=|22#22">Help</a>&nbsp&nbsp&nbsp&nbsp&nbsp                </td>
            </tr>
        </table>    
        <table class="tbl" width="100%">
            <tr>
                <td class='subtitle'> Select Program
                    <form id="selectprogram" name="selectprogram"  action="inputprogram.php" method="post" enctype="multipart/form-data" >[
        <SELECT name="selectedprogram" class="body" > 
<OPTION value="0"> Please Select</OPTION>
<OPTION value="-99" >New Program</OPTION> 
<OPTION value="3"  selected ></OPTION> 
</SELECT>
                        <input type="submit" class='subtitle' name="refreshprogram" value="Refresh">
                    </form>
                </td>
            </tr>
        </table> 
        <form id="enterprogram" name="enterprogram"  action="inputprogram.php" method="post" enctype="multipart/form-data" >
                     <table class="tbl" width="100%">
                        <tr>
                            <td class="subtitle">Program Name&nbsp:
                                <input name="name" class="body" type="text" size=40 value="">
                             </td>
                        </tr>
                        <tr> 
                             <td class="subtitle">Department&nbsp:<SELECT name="department" class="body" > 
<OPTION value="0"> Please Select</OPTION>
<OPTION value="phl" >Phirst-link</OPTION> 
<OPTION value="rec" >Recreation</OPTION> 
<OPTION value="inf" >Information Referral</OPTION> 
</SELECT>
</td>
                         </tr>
                         <tr>
                              <td class="subtitle">Status&nbsp:<SELECT name="status" class="body" > 
<OPTION value="0"> Please Select</OPTION>
<OPTION value="dev" >In Deveopment </OPTION> 
<OPTION value="act" >Active Program</OPTION> 
<OPTION value=" inact" >Inactive Program</OPTION> 
<OPTION value="arc" >Archive the Program </OPTION> 
</SELECT>
</td>
                         </tr>
                        <tr>
                            <td class ="subtitle" colspan="2">Program Description&nbsp;:
                            </td>
                        </tr>
                        <tr>
                            <td>
                                <textarea id="description" name="description" class ="body" rows="5" cols="45"></textarea>
                            </td>
                         </tr>
                     </table>
                 </form>     
            <table class="tbl" width="100%">
                <tr>
                    <td colspan="2">
                        <tr>
                                        <td class ="subtitle">Program Objective:</td>
                                    </tr>
                                    <tr><script type="text/javascript">
var params = ''; var tblpage = '1'; var tblorder = 'programid:ASC'; var tblfilter = '';
function tblSetPage(page) { tblpage = page; params = '&page=' + page + '&order=' + tblorder + '&filter=' + tblfilter; updateTable(); }
function tblSetOrder(field, order) { tblorder = field + ':' + order; params = '&page=' + tblpage + '&order=' + tblorder + '&filter=' + tblfilter; updateTable(); }
function tblSetFilter(field) { val = document.getElementById('filter-value-' + field).value; tblfilter = field + ':' + val; tblpage = 1; params = '&page=1&order=' + tblorder + '&filter=' + tblfilter; updateTable(); }
function tblClearFilter() { tblfilter = ''; params = '&page=1&order=' + tblorder + '&filter='; updateTable(); }
function tblToggleCheckAll() { for (i = 0; i < document.dg.checkbox.length; i++) { document.dg.checkbox['i'] .checked = !document.dg.checkbox['i'] .checked; } }
function tblShowHideFilter(field) { var o = document.getElementById('filter-' + field); if (o.style.display == 'block') { tblClearFilter(); } else {	o.style.display = 'block'; } }
function tblReset() { params = '&page=1'; updateTable(); }
</script>
<script type="text/javascript">function updateTable() { window.location = "?" + params; }</script><tr class="even"><td class="tbl-row-num">1&nbsp<br />
<font size='1'><table class='xdebug-error xe-notice' dir='ltr' border='1' cellspacing='0' cellpadding='1'>
<tr><th align='left' bgcolor='#f57900' colspan="5"><span style='background-color: #cc0000; color: #fce94f; font-size: x-large;'>( ! )</span> Notice: Undefined index: TotalLines in C:\xampp\htdocs\KWA Database\class.displaydata.php on line <i>1613</i></th></tr>
<tr><th align='left' bgcolor='#e9b96e' colspan='5'>Call Stack</th></tr>
<tr><th align='center' bgcolor='#eeeeec'>#</th><th align='left' bgcolor='#eeeeec'>Time</th><th align='left' bgcolor='#eeeeec'>Memory</th><th align='left' bgcolor='#eeeeec'>Function</th><th align='left' bgcolor='#eeeeec'>Location</th></tr>
<tr><td bgcolor='#eeeeec' align='center'>1</td><td bgcolor='#eeeeec' align='center'>0.2030</td><td bgcolor='#eeeeec' align='right'>525864</td><td bgcolor='#eeeeec'>{main}(  )</td><td title='C:\xampp\htdocs\KWA Database\inputprogram.php' bgcolor='#eeeeec'>...\inputprogram.php<b>:</b>0</td></tr>
<tr><td bgcolor='#eeeeec' align='center'>2</td><td bgcolor='#eeeeec' align='center'>0.2701</td><td bgcolor='#eeeeec' align='right'>2810304</td><td bgcolor='#eeeeec'>DisplayData->printdata(  )</td><td title='C:\xampp\htdocs\KWA Database\inputprogram.php' bgcolor='#eeeeec'>...\inputprogram.php<b>:</b>637</td></tr>
<tr><td bgcolor='#eeeeec' align='center'>3</td><td bgcolor='#eeeeec' align='center'>0.2724</td><td bgcolor='#eeeeec' align='right'>2812096</td><td bgcolor='#eeeeec'>DisplayData->displaylines(  )</td><td title='C:\xampp\htdocs\KWA Database\class.displaydata.php' bgcolor='#eeeeec'>...\class.displaydata.php<b>:</b>1909</td></tr>
<tr><td bgcolor='#eeeeec' align='center'>4</td><td bgcolor='#eeeeec' align='center'>0.2724</td><td bgcolor='#eeeeec' align='right'>2812416</td><td bgcolor='#eeeeec'>DisplayProgramObjective->body(  )</td><td title='C:\xampp\htdocs\KWA Database\class.displaydata.php' bgcolor='#eeeeec'>...\class.displaydata.php<b>:</b>968</td></tr>
<tr><td bgcolor='#eeeeec' align='center'>5</td><td bgcolor='#eeeeec' align='center'>0.2751</td><td bgcolor='#eeeeec' align='right'>2832408</td><td bgcolor='#eeeeec'>DisplayData->formatdata(  )</td><td title='C:\xampp\htdocs\KWA Database\displayprogramobjective.php' bgcolor='#eeeeec'>...\displayprogramobjective.php<b>:</b>87</td></tr>
</table></font>
</td></tr><tr><td><br />
<font size='1'><table class='xdebug-error xe-notice' dir='ltr' border='1' cellspacing='0' cellpadding='1'>
<tr><th align='left' bgcolor='#f57900' colspan="5"><span style='background-color: #cc0000; color: #fce94f; font-size: x-large;'>( ! )</span> Notice: Undefined index: displayprogrammesure in C:\xampp\htdocs\KWA Database\displayprogramobjective.php on line <i>98</i></th></tr>
<tr><th align='left' bgcolor='#e9b96e' colspan='5'>Call Stack</th></tr>
<tr><th align='center' bgcolor='#eeeeec'>#</th><th align='left' bgcolor='#eeeeec'>Time</th><th align='left' bgcolor='#eeeeec'>Memory</th><th align='left' bgcolor='#eeeeec'>Function</th><th align='left' bgcolor='#eeeeec'>Location</th></tr>
<tr><td bgcolor='#eeeeec' align='center'>1</td><td bgcolor='#eeeeec' align='center'>0.2030</td><td bgcolor='#eeeeec' align='right'>525864</td><td bgcolor='#eeeeec'>{main}(  )</td><td title='C:\xampp\htdocs\KWA Database\inputprogram.php' bgcolor='#eeeeec'>...\inputprogram.php<b>:</b>0</td></tr>
<tr><td bgcolor='#eeeeec' align='center'>2</td><td bgcolor='#eeeeec' align='center'>0.2701</td><td bgcolor='#eeeeec' align='right'>2810304</td><td bgcolor='#eeeeec'>DisplayData->printdata(  )</td><td title='C:\xampp\htdocs\KWA Database\inputprogram.php' bgcolor='#eeeeec'>...\inputprogram.php<b>:</b>637</td></tr>
<tr><td bgcolor='#eeeeec' align='center'>3</td><td bgcolor='#eeeeec' align='center'>0.2724</td><td bgcolor='#eeeeec' align='right'>2812096</td><td bgcolor='#eeeeec'>DisplayData->displaylines(  )</td><td title='C:\xampp\htdocs\KWA Database\class.displaydata.php' bgcolor='#eeeeec'>...\class.displaydata.php<b>:</b>1909</td></tr>
<tr><td bgcolor='#eeeeec' align='center'>4</td><td bgcolor='#eeeeec' align='center'>0.2724</td><td bgcolor='#eeeeec' align='right'>2812416</td><td bgcolor='#eeeeec'>DisplayProgramObjective->body(  )</td><td title='C:\xampp\htdocs\KWA Database\class.displaydata.php' bgcolor='#eeeeec'>...\class.displaydata.php<b>:</b>968</td></tr>
</table></font>
</td></tr><br />
<font size='1'><table class='xdebug-error xe-notice' dir='ltr' border='1' cellspacing='0' cellpadding='1'>
<tr><th align='left' bgcolor='#f57900' colspan="5"><span style='background-color: #cc0000; color: #fce94f; font-size: x-large;'>( ! )</span> Notice: Undefined index: lastline in C:\xampp\htdocs\KWA Database\class.displaydata.php on line <i>935</i></th></tr>
<tr><th align='left' bgcolor='#e9b96e' colspan='5'>Call Stack</th></tr>
<tr><th align='center' bgcolor='#eeeeec'>#</th><th align='left' bgcolor='#eeeeec'>Time</th><th align='left' bgcolor='#eeeeec'>Memory</th><th align='left' bgcolor='#eeeeec'>Function</th><th align='left' bgcolor='#eeeeec'>Location</th></tr>
<tr><td bgcolor='#eeeeec' align='center'>1</td><td bgcolor='#eeeeec' align='center'>0.2030</td><td bgcolor='#eeeeec' align='right'>525864</td><td bgcolor='#eeeeec'>{main}(  )</td><td title='C:\xampp\htdocs\KWA Database\inputprogram.php' bgcolor='#eeeeec'>...\inputprogram.php<b>:</b>0</td></tr>
<tr><td bgcolor='#eeeeec' align='center'>2</td><td bgcolor='#eeeeec' align='center'>0.2701</td><td bgcolor='#eeeeec' align='right'>2810304</td><td bgcolor='#eeeeec'>DisplayData->printdata(  )</td><td title='C:\xampp\htdocs\KWA Database\inputprogram.php' bgcolor='#eeeeec'>...\inputprogram.php<b>:</b>637</td></tr>
<tr><td bgcolor='#eeeeec' align='center'>3</td><td bgcolor='#eeeeec' align='center'>0.2724</td><td bgcolor='#eeeeec' align='right'>2812096</td><td bgcolor='#eeeeec'>DisplayData->displaylines(  )</td><td title='C:\xampp\htdocs\KWA Database\class.displaydata.php' bgcolor='#eeeeec'>...\class.displaydata.php<b>:</b>1909</td></tr>
</table></font>
<table class="brd" ><tr><td><form id="inlinedirprogrammesure" name="inlinedirprogrammesure" method="post" action="inputprogram.php?page=1"><input class="" type="submit" name="programmesureresetrec" onclick="tblReset()" value="Reset Table"><input class="" type="submit" name="programmesureaddrec" value="New"><input class="" type="submit" name="programmesuredirfirst" onclick="tblSetPage(1)" value="First"><input class="" type="submit" name="programmesuredirprevious" onclick="tblSetPage(0)" value="Previous"><input class="" type="submit" name="programmesuredirnext" onclick="tblSetPage(2)" value="Next"><input class="" type="submit" name="programmesuredirlast" onclick="tblSetPage(0)" value="Last"></form></td></tr><tr><td><br />
<font size='1'><table class='xdebug-error xe-notice' dir='ltr' border='1' cellspacing='0' cellpadding='1'>
<tr><th align='left' bgcolor='#f57900' colspan="5"><span style='background-color: #cc0000; color: #fce94f; font-size: x-large;'>( ! )</span> Notice: Undefined index: TotalLines in C:\xampp\htdocs\KWA Database\class.displaydata.php on line <i>1888</i></th></tr>
<tr><th align='left' bgcolor='#e9b96e' colspan='5'>Call Stack</th></tr>
<tr><th align='center' bgcolor='#eeeeec'>#</th><th align='left' bgcolor='#eeeeec'>Time</th><th align='left' bgcolor='#eeeeec'>Memory</th><th align='left' bgcolor='#eeeeec'>Function</th><th align='left' bgcolor='#eeeeec'>Location</th></tr>
<tr><td bgcolor='#eeeeec' align='center'>1</td><td bgcolor='#eeeeec' align='center'>0.2030</td><td bgcolor='#eeeeec' align='right'>525864</td><td bgcolor='#eeeeec'>{main}(  )</td><td title='C:\xampp\htdocs\KWA Database\inputprogram.php' bgcolor='#eeeeec'>...\inputprogram.php<b>:</b>0</td></tr>
<tr><td bgcolor='#eeeeec' align='center'>2</td><td bgcolor='#eeeeec' align='center'>0.2701</td><td bgcolor='#eeeeec' align='right'>2810304</td><td bgcolor='#eeeeec'>DisplayData->printdata(  )</td><td title='C:\xampp\htdocs\KWA Database\inputprogram.php' bgcolor='#eeeeec'>...\inputprogram.php<b>:</b>637</td></tr>
<tr><td bgcolor='#eeeeec' align='center'>3</td><td bgcolor='#eeeeec' align='center'>0.2822</td><td bgcolor='#eeeeec' align='right'>2811400</td><td bgcolor='#eeeeec'>DisplayData->footer(  )</td><td title='C:\xampp\htdocs\KWA Database\class.displaydata.php' bgcolor='#eeeeec'>...\class.displaydata.php<b>:</b>1910</td></tr>
<tr><td bgcolor='#eeeeec' align='center'>4</td><td bgcolor='#eeeeec' align='center'>0.2823</td><td bgcolor='#eeeeec' align='right'>2811720</td><td bgcolor='#eeeeec'>Displaygrid->foot(  )</td><td title='C:\xampp\htdocs\KWA Database\class.displaydata.php' bgcolor='#eeeeec'>...\class.displaydata.php<b>:</b>1934</td></tr>
<tr><td bgcolor='#eeeeec' align='center'>5</td><td bgcolor='#eeeeec' align='center'>0.3025</td><td bgcolor='#eeeeec' align='right'>2828928</td><td bgcolor='#eeeeec'>DisplayData->foundXresultsshowingYtoZ(  )</td><td title='C:\xampp\htdocs\KWA Database\displaygrid.php' bgcolor='#eeeeec'>...\displaygrid.php<b>:</b>142</td></tr>
</table></font>
  0 Found <em></em> results</td></tr></table>                    </td>
                </tr>
                <tr>
                    <td>  
                        <table class="tbl" width="100%">
                        <tr>
                                        <td class ="subtitle">Location:</td>
                                    </tr>
                                    <tr>
                                        <td><br />
<font size='1'><table class='xdebug-error xe-notice' dir='ltr' border='1' cellspacing='0' cellpadding='1'>
<tr><th align='left' bgcolor='#f57900' colspan="5"><span style='background-color: #cc0000; color: #fce94f; font-size: x-large;'>( ! )</span> Notice: Undefined index: programlocationid in C:\xampp\htdocs\KWA Database\class.displaydata.php on line <i>1477</i></th></tr>
<tr><th align='left' bgcolor='#e9b96e' colspan='5'>Call Stack</th></tr>
<tr><th align='center' bgcolor='#eeeeec'>#</th><th align='left' bgcolor='#eeeeec'>Time</th><th align='left' bgcolor='#eeeeec'>Memory</th><th align='left' bgcolor='#eeeeec'>Function</th><th align='left' bgcolor='#eeeeec'>Location</th></tr>
<tr><td bgcolor='#eeeeec' align='center'>1</td><td bgcolor='#eeeeec' align='center'>0.2030</td><td bgcolor='#eeeeec' align='right'>525864</td><td bgcolor='#eeeeec'>{main}(  )</td><td title='C:\xampp\htdocs\KWA Database\inputprogram.php' bgcolor='#eeeeec'>...\inputprogram.php<b>:</b>0</td></tr>
<tr><td bgcolor='#eeeeec' align='center'>2</td><td bgcolor='#eeeeec' align='center'>0.3051</td><td bgcolor='#eeeeec' align='right'>2811080</td><td bgcolor='#eeeeec'>DisplayData->printdata(  )</td><td title='C:\xampp\htdocs\KWA Database\inputprogram.php' bgcolor='#eeeeec'>...\inputprogram.php<b>:</b>653</td></tr>
<tr><td bgcolor='#eeeeec' align='center'>3</td><td bgcolor='#eeeeec' align='center'>0.3053</td><td bgcolor='#eeeeec' align='right'>2813416</td><td bgcolor='#eeeeec'>DisplayData->dbselect(  )</td><td title='C:\xampp\htdocs\KWA Database\class.displaydata.php' bgcolor='#eeeeec'>...\class.displaydata.php<b>:</b>1905</td></tr>
</table></font>
<script type="text/javascript">
var params = ''; var tblpage = '1'; var tblorder = 'programid:ASC'; var tblfilter = '';
function tblSetPage(page) { tblpage = page; params = '&page=' + page + '&order=' + tblorder + '&filter=' + tblfilter; updateTable(); }
function tblSetOrder(field, order) { tblorder = field + ':' + order; params = '&page=' + tblpage + '&order=' + tblorder + '&filter=' + tblfilter; updateTable(); }
function tblSetFilter(field) { val = document.getElementById('filter-value-' + field).value; tblfilter = field + ':' + val; tblpage = 1; params = '&page=1&order=' + tblorder + '&filter=' + tblfilter; updateTable(); }
function tblClearFilter() { tblfilter = ''; params = '&page=1&order=' + tblorder + '&filter='; updateTable(); }
function tblToggleCheckAll() { for (i = 0; i < document.dg.checkbox.length; i++) { document.dg.checkbox['i'] .checked = !document.dg.checkbox['i'] .checked; } }
function tblShowHideFilter(field) { var o = document.getElementById('filter-' + field); if (o.style.display == 'block') { tblClearFilter(); } else {	o.style.display = 'block'; } }
function tblReset() { params = '&page=1'; updateTable(); }
</script>
<script type="text/javascript">function updateTable() { window.location = "?" + params; }</script><table class="tbl"><thead><tr><td class="tbl-header">&nbsp;</td><br />
<font size='1'><table class='xdebug-error xe-warning' dir='ltr' border='1' cellspacing='0' cellpadding='1'>
<tr><th align='left' bgcolor='#f57900' colspan="5"><span style='background-color: #cc0000; color: #fce94f; font-size: x-large;'>( ! )</span> Warning: Illegal string offset 'field' in C:\xampp\htdocs\KWA Database\displaygrid.php on line <i>80</i></th></tr>
<tr><th align='left' bgcolor='#e9b96e' colspan='5'>Call Stack</th></tr>
<tr><th align='center' bgcolor='#eeeeec'>#</th><th align='left' bgcolor='#eeeeec'>Time</th><th align='left' bgcolor='#eeeeec'>Memory</th><th align='left' bgcolor='#eeeeec'>Function</th><th align='left' bgcolor='#eeeeec'>Location</th></tr>
<tr><td bgcolor='#eeeeec' align='center'>1</td><td bgcolor='#eeeeec' align='center'>0.2030</td><td bgcolor='#eeeeec' align='right'>525864</td><td bgcolor='#eeeeec'>{main}(  )</td><td title='C:\xampp\htdocs\KWA Database\inputprogram.php' bgcolor='#eeeeec'>...\inputprogram.php<b>:</b>0</td></tr>
<tr><td bgcolor='#eeeeec' align='center'>2</td><td bgcolor='#eeeeec' align='center'>0.3051</td><td bgcolor='#eeeeec' align='right'>2811080</td><td bgcolor='#eeeeec'>DisplayData->printdata(  )</td><td title='C:\xampp\htdocs\KWA Database\inputprogram.php' bgcolor='#eeeeec'>...\inputprogram.php<b>:</b>653</td></tr>
<tr><td bgcolor='#eeeeec' align='center'>3</td><td bgcolor='#eeeeec' align='center'>0.3210</td><td bgcolor='#eeeeec' align='right'>2813400</td><td bgcolor='#eeeeec'>Displaygrid->head(  )</td><td title='C:\xampp\htdocs\KWA Database\class.displaydata.php' bgcolor='#eeeeec'>...\class.displaydata.php<b>:</b>1907</td></tr>
</table></font>
<td class="tbl-header"><a href="javascript:;" onclick="tblSetOrder('l', 'ASC')">location</a></td><td class="tbl-header">&nbsp;</td><td class="tbl-header">&nbsp;</td></tr></thead><tr class="even"><td class="tbl-row-num">1&nbsp<br />
<font size='1'><table class='xdebug-error xe-notice' dir='ltr' border='1' cellspacing='0' cellpadding='1'>
<tr><th align='left' bgcolor='#f57900' colspan="5"><span style='background-color: #cc0000; color: #fce94f; font-size: x-large;'>( ! )</span> Notice: Undefined index: location in C:\xampp\htdocs\KWA Database\class.displaydata.php on line <i>1614</i></th></tr>
<tr><th align='left' bgcolor='#e9b96e' colspan='5'>Call Stack</th></tr>
<tr><th align='center' bgcolor='#eeeeec'>#</th><th align='left' bgcolor='#eeeeec'>Time</th><th align='left' bgcolor='#eeeeec'>Memory</th><th align='left' bgcolor='#eeeeec'>Function</th><th align='left' bgcolor='#eeeeec'>Location</th></tr>
<tr><td bgcolor='#eeeeec' align='center'>1</td><td bgcolor='#eeeeec' align='center'>0.2030</td><td bgcolor='#eeeeec' align='right'>525864</td><td bgcolor='#eeeeec'>{main}(  )</td><td title='C:\xampp\htdocs\KWA Database\inputprogram.php' bgcolor='#eeeeec'>...\inputprogram.php<b>:</b>0</td></tr>
<tr><td bgcolor='#eeeeec' align='center'>2</td><td bgcolor='#eeeeec' align='center'>0.3051</td><td bgcolor='#eeeeec' align='right'>2811080</td><td bgcolor='#eeeeec'>DisplayData->printdata(  )</td><td title='C:\xampp\htdocs\KWA Database\inputprogram.php' bgcolor='#eeeeec'>...\inputprogram.php<b>:</b>653</td></tr>
<tr><td bgcolor='#eeeeec' align='center'>3</td><td bgcolor='#eeeeec' align='center'>0.3353</td><td bgcolor='#eeeeec' align='right'>2813040</td><td bgcolor='#eeeeec'>DisplayData->displaylines(  )</td><td title='C:\xampp\htdocs\KWA Database\class.displaydata.php' bgcolor='#eeeeec'>...\class.displaydata.php<b>:</b>1909</td></tr>
<tr><td bgcolor='#eeeeec' align='center'>4</td><td bgcolor='#eeeeec' align='center'>0.3354</td><td bgcolor='#eeeeec' align='right'>2813360</td><td bgcolor='#eeeeec'>Displaygrid->body(  )</td><td title='C:\xampp\htdocs\KWA Database\class.displaydata.php' bgcolor='#eeeeec'>...\class.displaydata.php<b>:</b>968</td></tr>
<tr><td bgcolor='#eeeeec' align='center'>5</td><td bgcolor='#eeeeec' align='center'>0.3371</td><td bgcolor='#eeeeec' align='right'>2830568</td><td bgcolor='#eeeeec'>DisplayData->formatdata(  )</td><td title='C:\xampp\htdocs\KWA Database\displaygrid.php' bgcolor='#eeeeec'>...\displaygrid.php<b>:</b>114</td></tr>
</table></font>
<br />
<font size='1'><table class='xdebug-error xe-notice' dir='ltr' border='1' cellspacing='0' cellpadding='1'>
<tr><th align='left' bgcolor='#f57900' colspan="5"><span style='background-color: #cc0000; color: #fce94f; font-size: x-large;'>( ! )</span> Notice: Undefined index: location in C:\xampp\htdocs\KWA Database\class.displaydata.php on line <i>1615</i></th></tr>
<tr><th align='left' bgcolor='#e9b96e' colspan='5'>Call Stack</th></tr>
<tr><th align='center' bgcolor='#eeeeec'>#</th><th align='left' bgcolor='#eeeeec'>Time</th><th align='left' bgcolor='#eeeeec'>Memory</th><th align='left' bgcolor='#eeeeec'>Function</th><th align='left' bgcolor='#eeeeec'>Location</th></tr>
<tr><td bgcolor='#eeeeec' align='center'>1</td><td bgcolor='#eeeeec' align='center'>0.2030</td><td bgcolor='#eeeeec' align='right'>525864</td><td bgcolor='#eeeeec'>{main}(  )</td><td title='C:\xampp\htdocs\KWA Database\inputprogram.php' bgcolor='#eeeeec'>...\inputprogram.php<b>:</b>0</td></tr>
<tr><td bgcolor='#eeeeec' align='center'>2</td><td bgcolor='#eeeeec' align='center'>0.3051</td><td bgcolor='#eeeeec' align='right'>2811080</td><td bgcolor='#eeeeec'>DisplayData->printdata(  )</td><td title='C:\xampp\htdocs\KWA Database\inputprogram.php' bgcolor='#eeeeec'>...\inputprogram.php<b>:</b>653</td></tr>
<tr><td bgcolor='#eeeeec' align='center'>3</td><td bgcolor='#eeeeec' align='center'>0.3353</td><td bgcolor='#eeeeec' align='right'>2813040</td><td bgcolor='#eeeeec'>DisplayData->displaylines(  )</td><td title='C:\xampp\htdocs\KWA Database\class.displaydata.php' bgcolor='#eeeeec'>...\class.displaydata.php<b>:</b>1909</td></tr>
<tr><td bgcolor='#eeeeec' align='center'>4</td><td bgcolor='#eeeeec' align='center'>0.3354</td><td bgcolor='#eeeeec' align='right'>2813360</td><td bgcolor='#eeeeec'>Displaygrid->body(  )</td><td title='C:\xampp\htdocs\KWA Database\class.displaydata.php' bgcolor='#eeeeec'>...\class.displaydata.php<b>:</b>968</td></tr>
<tr><td bgcolor='#eeeeec' align='center'>5</td><td bgcolor='#eeeeec' align='center'>0.3371</td><td bgcolor='#eeeeec' align='right'>2830568</td><td bgcolor='#eeeeec'>DisplayData->formatdata(  )</td><td title='C:\xampp\htdocs\KWA Database\displaygrid.php' bgcolor='#eeeeec'>...\displaygrid.php<b>:</b>114</td></tr>
</table></font>
<br />
<font size='1'><table class='xdebug-error xe-notice' dir='ltr' border='1' cellspacing='0' cellpadding='1'>
<tr><th align='left' bgcolor='#f57900' colspan="5"><span style='background-color: #cc0000; color: #fce94f; font-size: x-large;'>( ! )</span> Notice: Undefined index: location in C:\xampp\htdocs\KWA Database\class.displaydata.php on line <i>1683</i></th></tr>
<tr><th align='left' bgcolor='#e9b96e' colspan='5'>Call Stack</th></tr>
<tr><th align='center' bgcolor='#eeeeec'>#</th><th align='left' bgcolor='#eeeeec'>Time</th><th align='left' bgcolor='#eeeeec'>Memory</th><th align='left' bgcolor='#eeeeec'>Function</th><th align='left' bgcolor='#eeeeec'>Location</th></tr>
<tr><td bgcolor='#eeeeec' align='center'>1</td><td bgcolor='#eeeeec' align='center'>0.2030</td><td bgcolor='#eeeeec' align='right'>525864</td><td bgcolor='#eeeeec'>{main}(  )</td><td title='C:\xampp\htdocs\KWA Database\inputprogram.php' bgcolor='#eeeeec'>...\inputprogram.php<b>:</b>0</td></tr>
<tr><td bgcolor='#eeeeec' align='center'>2</td><td bgcolor='#eeeeec' align='center'>0.3051</td><td bgcolor='#eeeeec' align='right'>2811080</td><td bgcolor='#eeeeec'>DisplayData->printdata(  )</td><td title='C:\xampp\htdocs\KWA Database\inputprogram.php' bgcolor='#eeeeec'>...\inputprogram.php<b>:</b>653</td></tr>
<tr><td bgcolor='#eeeeec' align='center'>3</td><td bgcolor='#eeeeec' align='center'>0.3353</td><td bgcolor='#eeeeec' align='right'>2813040</td><td bgcolor='#eeeeec'>DisplayData->displaylines(  )</td><td title='C:\xampp\htdocs\KWA Database\class.displaydata.php' bgcolor='#eeeeec'>...\class.displaydata.php<b>:</b>1909</td></tr>
<tr><td bgcolor='#eeeeec' align='center'>4</td><td bgcolor='#eeeeec' align='center'>0.3354</td><td bgcolor='#eeeeec' align='right'>2813360</td><td bgcolor='#eeeeec'>Displaygrid->body(  )</td><td title='C:\xampp\htdocs\KWA Database\class.displaydata.php' bgcolor='#eeeeec'>...\class.displaydata.php<b>:</b>968</td></tr>
<tr><td bgcolor='#eeeeec' align='center'>5</td><td bgcolor='#eeeeec' align='center'>0.3371</td><td bgcolor='#eeeeec' align='right'>2830568</td><td bgcolor='#eeeeec'>DisplayData->formatdata(  )</td><td title='C:\xampp\htdocs\KWA Database\displaygrid.php' bgcolor='#eeeeec'>...\displaygrid.php<b>:</b>114</td></tr>
</table></font>
<td class="body"></td><td colspan=2><form id="programlocationinlineedit" name="programlocationinlineedit" method="post" action="inputprogram.php?page=1"><span class="tbl-controls"><input class="" type="submit" name="programlocationeditline[]" value="E1"><input class="" type="submit" name="programlocationdeleteline[]" value="D1"></span></form></td><table class="brd" ><tr><td><form id="inlinedirprogramlocation" name="inlinedirprogramlocation" method="post" action="inputprogram.php?page=1"><input class="" type="submit" name="programlocationresetrec" onclick="tblReset()" value="Reset Table"><input class="" type="submit" name="programlocationaddrec" value="New"><input class="" type="submit" name="programlocationdirfirst" onclick="tblSetPage(1)" value="First"><input class="" type="submit" name="programlocationdirprevious" onclick="tblSetPage(0)" value="Previous"><input class="" type="submit" name="programlocationdirnext" onclick="tblSetPage(2)" value="Next"><input class="" type="submit" name="programlocationdirlast" onclick="tblSetPage(1)" value="Last"></form></td></tr><tr><td>  2 Found <em>1</em> results,   showing <em>1</em> to <em>1</em></td></tr></table><tr>
                                        <td class ="subtitle">Equip/Supply:</td>
                                  </tr>
                                   <tr>
                                        <td><script type="text/javascript">
var params = ''; var tblpage = '1'; var tblorder = 'programid:ASC'; var tblfilter = '';
function tblSetPage(page) { tblpage = page; params = '&page=' + page + '&order=' + tblorder + '&filter=' + tblfilter; updateTable(); }
function tblSetOrder(field, order) { tblorder = field + ':' + order; params = '&page=' + tblpage + '&order=' + tblorder + '&filter=' + tblfilter; updateTable(); }
function tblSetFilter(field) { val = document.getElementById('filter-value-' + field).value; tblfilter = field + ':' + val; tblpage = 1; params = '&page=1&order=' + tblorder + '&filter=' + tblfilter; updateTable(); }
function tblClearFilter() { tblfilter = ''; params = '&page=1&order=' + tblorder + '&filter='; updateTable(); }
function tblToggleCheckAll() { for (i = 0; i < document.dg.checkbox.length; i++) { document.dg.checkbox['i'] .checked = !document.dg.checkbox['i'] .checked; } }
function tblShowHideFilter(field) { var o = document.getElementById('filter-' + field); if (o.style.display == 'block') { tblClearFilter(); } else {	o.style.display = 'block'; } }
function tblReset() { params = '&page=1'; updateTable(); }
</script>
<script type="text/javascript">function updateTable() { window.location = "?" + params; }</script><table class="tbl"><thead><tr><br />
<font size='1'><table class='xdebug-error xe-notice' dir='ltr' border='1' cellspacing='0' cellpadding='1'>
<tr><th align='left' bgcolor='#f57900' colspan="5"><span style='background-color: #cc0000; color: #fce94f; font-size: x-large;'>( ! )</span> Notice: Undefined offset: 0 in C:\xampp\htdocs\KWA Database\displaygrid.php on line <i>45</i></th></tr>
<tr><th align='left' bgcolor='#e9b96e' colspan='5'>Call Stack</th></tr>
<tr><th align='center' bgcolor='#eeeeec'>#</th><th align='left' bgcolor='#eeeeec'>Time</th><th align='left' bgcolor='#eeeeec'>Memory</th><th align='left' bgcolor='#eeeeec'>Function</th><th align='left' bgcolor='#eeeeec'>Location</th></tr>
<tr><td bgcolor='#eeeeec' align='center'>1</td><td bgcolor='#eeeeec' align='center'>0.2030</td><td bgcolor='#eeeeec' align='right'>525864</td><td bgcolor='#eeeeec'>{main}(  )</td><td title='C:\xampp\htdocs\KWA Database\inputprogram.php' bgcolor='#eeeeec'>...\inputprogram.php<b>:</b>0</td></tr>
<tr><td bgcolor='#eeeeec' align='center'>2</td><td bgcolor='#eeeeec' align='center'>0.3481</td><td bgcolor='#eeeeec' align='right'>2812720</td><td bgcolor='#eeeeec'>DisplayData->printdata(  )</td><td title='C:\xampp\htdocs\KWA Database\inputprogram.php' bgcolor='#eeeeec'>...\inputprogram.php<b>:</b>662</td></tr>
<tr><td bgcolor='#eeeeec' align='center'>3</td><td bgcolor='#eeeeec' align='center'>0.3607</td><td bgcolor='#eeeeec' align='right'>2815480</td><td bgcolor='#eeeeec'>Displaygrid->head(  )</td><td title='C:\xampp\htdocs\KWA Database\class.displaydata.php' bgcolor='#eeeeec'>...\class.displaydata.php<b>:</b>1907</td></tr>
</table></font>
<td class="tbl-header">&nbsp;</td><br />
<font size='1'><table class='xdebug-error xe-warning' dir='ltr' border='1' cellspacing='0' cellpadding='1'>
<tr><th align='left' bgcolor='#f57900' colspan="5"><span style='background-color: #cc0000; color: #fce94f; font-size: x-large;'>( ! )</span> Warning: Invalid argument supplied for foreach() in C:\xampp\htdocs\KWA Database\displaygrid.php on line <i>57</i></th></tr>
<tr><th align='left' bgcolor='#e9b96e' colspan='5'>Call Stack</th></tr>
<tr><th align='center' bgcolor='#eeeeec'>#</th><th align='left' bgcolor='#eeeeec'>Time</th><th align='left' bgcolor='#eeeeec'>Memory</th><th align='left' bgcolor='#eeeeec'>Function</th><th align='left' bgcolor='#eeeeec'>Location</th></tr>
<tr><td bgcolor='#eeeeec' align='center'>1</td><td bgcolor='#eeeeec' align='center'>0.2030</td><td bgcolor='#eeeeec' align='right'>525864</td><td bgcolor='#eeeeec'>{main}(  )</td><td title='C:\xampp\htdocs\KWA Database\inputprogram.php' bgcolor='#eeeeec'>...\inputprogram.php<b>:</b>0</td></tr>
<tr><td bgcolor='#eeeeec' align='center'>2</td><td bgcolor='#eeeeec' align='center'>0.3481</td><td bgcolor='#eeeeec' align='right'>2812720</td><td bgcolor='#eeeeec'>DisplayData->printdata(  )</td><td title='C:\xampp\htdocs\KWA Database\inputprogram.php' bgcolor='#eeeeec'>...\inputprogram.php<b>:</b>662</td></tr>
<tr><td bgcolor='#eeeeec' align='center'>3</td><td bgcolor='#eeeeec' align='center'>0.3607</td><td bgcolor='#eeeeec' align='right'>2815480</td><td bgcolor='#eeeeec'>Displaygrid->head(  )</td><td title='C:\xampp\htdocs\KWA Database\class.displaydata.php' bgcolor='#eeeeec'>...\class.displaydata.php<b>:</b>1907</td></tr>
</table></font>
<td class="tbl-header">&nbsp;</td></tr></thead><table class="brd" ><tr><td><form id="inlinedirequipsupply" name="inlinedirequipsupply" method="post" action="inputprogram.php?page=1"><input class="" type="submit" name="equipsupplyresetrec" onclick="tblReset()" value="Reset Table"><input class="" type="submit" name="equipsupplyaddrec" value="New"><input class="" type="submit" name="equipsupplydirfirst" onclick="tblSetPage(1)" value="First"><input class="" type="submit" name="equipsupplydirprevious" onclick="tblSetPage(0)" value="Previous"><input class="" type="submit" name="equipsupplydirnext" onclick="tblSetPage(2)" value="Next"><input class="" type="submit" name="equipsupplydirlast" onclick="tblSetPage(0)" value="Last"></form></td></tr><tr><td>  2 Found <em>0</em> results</td></tr></table><tr>
                                        <td class ="subtitle">Refreshments:</td>
                                    </tr>
                                    <tr>
                                       <td><script type="text/javascript">
var params = ''; var tblpage = '1'; var tblorder = 'refreshmentsid:ASC'; var tblfilter = '';
function tblSetPage(page) { tblpage = page; params = '&page=' + page + '&order=' + tblorder + '&filter=' + tblfilter; updateTable(); }
function tblSetOrder(field, order) { tblorder = field + ':' + order; params = '&page=' + tblpage + '&order=' + tblorder + '&filter=' + tblfilter; updateTable(); }
function tblSetFilter(field) { val = document.getElementById('filter-value-' + field).value; tblfilter = field + ':' + val; tblpage = 1; params = '&page=1&order=' + tblorder + '&filter=' + tblfilter; updateTable(); }
function tblClearFilter() { tblfilter = ''; params = '&page=1&order=' + tblorder + '&filter='; updateTable(); }
function tblToggleCheckAll() { for (i = 0; i < document.dg.checkbox.length; i++) { document.dg.checkbox['i'] .checked = !document.dg.checkbox['i'] .checked; } }
function tblShowHideFilter(field) { var o = document.getElementById('filter-' + field); if (o.style.display == 'block') { tblClearFilter(); } else {	o.style.display = 'block'; } }
function tblReset() { params = '&page=1'; updateTable(); }
</script>
<script type="text/javascript">function updateTable() { window.location = "?" + params; }</script><table class="tbl"><thead><tr><br />
<font size='1'><table class='xdebug-error xe-notice' dir='ltr' border='1' cellspacing='0' cellpadding='1'>
<tr><th align='left' bgcolor='#f57900' colspan="5"><span style='background-color: #cc0000; color: #fce94f; font-size: x-large;'>( ! )</span> Notice: Undefined offset: 0 in C:\xampp\htdocs\KWA Database\displaygrid.php on line <i>45</i></th></tr>
<tr><th align='left' bgcolor='#e9b96e' colspan='5'>Call Stack</th></tr>
<tr><th align='center' bgcolor='#eeeeec'>#</th><th align='left' bgcolor='#eeeeec'>Time</th><th align='left' bgcolor='#eeeeec'>Memory</th><th align='left' bgcolor='#eeeeec'>Function</th><th align='left' bgcolor='#eeeeec'>Location</th></tr>
<tr><td bgcolor='#eeeeec' align='center'>1</td><td bgcolor='#eeeeec' align='center'>0.2030</td><td bgcolor='#eeeeec' align='right'>525864</td><td bgcolor='#eeeeec'>{main}(  )</td><td title='C:\xampp\htdocs\KWA Database\inputprogram.php' bgcolor='#eeeeec'>...\inputprogram.php<b>:</b>0</td></tr>
<tr><td bgcolor='#eeeeec' align='center'>2</td><td bgcolor='#eeeeec' align='center'>0.3676</td><td bgcolor='#eeeeec' align='right'>2815160</td><td bgcolor='#eeeeec'>DisplayData->printdata(  )</td><td title='C:\xampp\htdocs\KWA Database\inputprogram.php' bgcolor='#eeeeec'>...\inputprogram.php<b>:</b>671</td></tr>
<tr><td bgcolor='#eeeeec' align='center'>3</td><td bgcolor='#eeeeec' align='center'>0.3683</td><td bgcolor='#eeeeec' align='right'>2817024</td><td bgcolor='#eeeeec'>Displaygrid->head(  )</td><td title='C:\xampp\htdocs\KWA Database\class.displaydata.php' bgcolor='#eeeeec'>...\class.displaydata.php<b>:</b>1907</td></tr>
</table></font>
<td class="tbl-header">&nbsp;</td><br />
<font size='1'><table class='xdebug-error xe-warning' dir='ltr' border='1' cellspacing='0' cellpadding='1'>
<tr><th align='left' bgcolor='#f57900' colspan="5"><span style='background-color: #cc0000; color: #fce94f; font-size: x-large;'>( ! )</span> Warning: Invalid argument supplied for foreach() in C:\xampp\htdocs\KWA Database\displaygrid.php on line <i>57</i></th></tr>
<tr><th align='left' bgcolor='#e9b96e' colspan='5'>Call Stack</th></tr>
<tr><th align='center' bgcolor='#eeeeec'>#</th><th align='left' bgcolor='#eeeeec'>Time</th><th align='left' bgcolor='#eeeeec'>Memory</th><th align='left' bgcolor='#eeeeec'>Function</th><th align='left' bgcolor='#eeeeec'>Location</th></tr>
<tr><td bgcolor='#eeeeec' align='center'>1</td><td bgcolor='#eeeeec' align='center'>0.2030</td><td bgcolor='#eeeeec' align='right'>525864</td><td bgcolor='#eeeeec'>{main}(  )</td><td title='C:\xampp\htdocs\KWA Database\inputprogram.php' bgcolor='#eeeeec'>...\inputprogram.php<b>:</b>0</td></tr>
<tr><td bgcolor='#eeeeec' align='center'>2</td><td bgcolor='#eeeeec' align='center'>0.3676</td><td bgcolor='#eeeeec' align='right'>2815160</td><td bgcolor='#eeeeec'>DisplayData->printdata(  )</td><td title='C:\xampp\htdocs\KWA Database\inputprogram.php' bgcolor='#eeeeec'>...\inputprogram.php<b>:</b>671</td></tr>
<tr><td bgcolor='#eeeeec' align='center'>3</td><td bgcolor='#eeeeec' align='center'>0.3683</td><td bgcolor='#eeeeec' align='right'>2817024</td><td bgcolor='#eeeeec'>Displaygrid->head(  )</td><td title='C:\xampp\htdocs\KWA Database\class.displaydata.php' bgcolor='#eeeeec'>...\class.displaydata.php<b>:</b>1907</td></tr>
</table></font>
<td class="tbl-header">&nbsp;</td></tr></thead><table class="brd" ><tr><td><form id="inlinedirrefreshments" name="inlinedirrefreshments" method="post" action="inputprogram.php?page=1"><input class="" type="submit" name="refreshmentsresetrec" onclick="tblReset()" value="Reset Table"><input class="" type="submit" name="refreshmentsaddrec" value="New"><input class="" type="submit" name="refreshmentsdirfirst" onclick="tblSetPage(1)" value="First"><input class="" type="submit" name="refreshmentsdirprevious" onclick="tblSetPage(0)" value="Previous"><input class="" type="submit" name="refreshmentsdirnext" onclick="tblSetPage(2)" value="Next"><input class="" type="submit" name="refreshmentsdirlast" onclick="tblSetPage(0)" value="Last"></form></td></tr><tr><td>  2 Found <em>0</em> results</td></tr></table>                        </table>
                    </td>
                    <td valign="top">
                        <table class="tbl" width="100%">
                            <tr>
                                        <td class ="subtitle">Person Responsible:</td>
                                    </tr>
                                    <tr>
                                        <td><script type="text/javascript">
var params = ''; var tblpage = '1'; var tblorder = 'programid:ASC'; var tblfilter = '';
function tblSetPage(page) { tblpage = page; params = '&page=' + page + '&order=' + tblorder + '&filter=' + tblfilter; updateTable(); }
function tblSetOrder(field, order) { tblorder = field + ':' + order; params = '&page=' + tblpage + '&order=' + tblorder + '&filter=' + tblfilter; updateTable(); }
function tblSetFilter(field) { val = document.getElementById('filter-value-' + field).value; tblfilter = field + ':' + val; tblpage = 1; params = '&page=1&order=' + tblorder + '&filter=' + tblfilter; updateTable(); }
function tblClearFilter() { tblfilter = ''; params = '&page=1&order=' + tblorder + '&filter='; updateTable(); }
function tblToggleCheckAll() { for (i = 0; i < document.dg.checkbox.length; i++) { document.dg.checkbox['i'] .checked = !document.dg.checkbox['i'] .checked; } }
function tblShowHideFilter(field) { var o = document.getElementById('filter-' + field); if (o.style.display == 'block') { tblClearFilter(); } else {	o.style.display = 'block'; } }
function tblReset() { params = '&page=1'; updateTable(); }
</script>
<script type="text/javascript">function updateTable() { window.location = "?" + params; }</script><table class="tbl"><thead><tr><br />
<font size='1'><table class='xdebug-error xe-notice' dir='ltr' border='1' cellspacing='0' cellpadding='1'>
<tr><th align='left' bgcolor='#f57900' colspan="5"><span style='background-color: #cc0000; color: #fce94f; font-size: x-large;'>( ! )</span> Notice: Undefined offset: 0 in C:\xampp\htdocs\KWA Database\displaygrid.php on line <i>45</i></th></tr>
<tr><th align='left' bgcolor='#e9b96e' colspan='5'>Call Stack</th></tr>
<tr><th align='center' bgcolor='#eeeeec'>#</th><th align='left' bgcolor='#eeeeec'>Time</th><th align='left' bgcolor='#eeeeec'>Memory</th><th align='left' bgcolor='#eeeeec'>Function</th><th align='left' bgcolor='#eeeeec'>Location</th></tr>
<tr><td bgcolor='#eeeeec' align='center'>1</td><td bgcolor='#eeeeec' align='center'>0.2030</td><td bgcolor='#eeeeec' align='right'>525864</td><td bgcolor='#eeeeec'>{main}(  )</td><td title='C:\xampp\htdocs\KWA Database\inputprogram.php' bgcolor='#eeeeec'>...\inputprogram.php<b>:</b>0</td></tr>
<tr><td bgcolor='#eeeeec' align='center'>2</td><td bgcolor='#eeeeec' align='center'>0.3788</td><td bgcolor='#eeeeec' align='right'>2816712</td><td bgcolor='#eeeeec'>DisplayData->printdata(  )</td><td title='C:\xampp\htdocs\KWA Database\inputprogram.php' bgcolor='#eeeeec'>...\inputprogram.php<b>:</b>686</td></tr>
<tr><td bgcolor='#eeeeec' align='center'>3</td><td bgcolor='#eeeeec' align='center'>0.3793</td><td bgcolor='#eeeeec' align='right'>2818648</td><td bgcolor='#eeeeec'>Displaygrid->head(  )</td><td title='C:\xampp\htdocs\KWA Database\class.displaydata.php' bgcolor='#eeeeec'>...\class.displaydata.php<b>:</b>1907</td></tr>
</table></font>
<td class="tbl-header">&nbsp;</td><br />
<font size='1'><table class='xdebug-error xe-warning' dir='ltr' border='1' cellspacing='0' cellpadding='1'>
<tr><th align='left' bgcolor='#f57900' colspan="5"><span style='background-color: #cc0000; color: #fce94f; font-size: x-large;'>( ! )</span> Warning: Invalid argument supplied for foreach() in C:\xampp\htdocs\KWA Database\displaygrid.php on line <i>57</i></th></tr>
<tr><th align='left' bgcolor='#e9b96e' colspan='5'>Call Stack</th></tr>
<tr><th align='center' bgcolor='#eeeeec'>#</th><th align='left' bgcolor='#eeeeec'>Time</th><th align='left' bgcolor='#eeeeec'>Memory</th><th align='left' bgcolor='#eeeeec'>Function</th><th align='left' bgcolor='#eeeeec'>Location</th></tr>
<tr><td bgcolor='#eeeeec' align='center'>1</td><td bgcolor='#eeeeec' align='center'>0.2030</td><td bgcolor='#eeeeec' align='right'>525864</td><td bgcolor='#eeeeec'>{main}(  )</td><td title='C:\xampp\htdocs\KWA Database\inputprogram.php' bgcolor='#eeeeec'>...\inputprogram.php<b>:</b>0</td></tr>
<tr><td bgcolor='#eeeeec' align='center'>2</td><td bgcolor='#eeeeec' align='center'>0.3788</td><td bgcolor='#eeeeec' align='right'>2816712</td><td bgcolor='#eeeeec'>DisplayData->printdata(  )</td><td title='C:\xampp\htdocs\KWA Database\inputprogram.php' bgcolor='#eeeeec'>...\inputprogram.php<b>:</b>686</td></tr>
<tr><td bgcolor='#eeeeec' align='center'>3</td><td bgcolor='#eeeeec' align='center'>0.3793</td><td bgcolor='#eeeeec' align='right'>2818648</td><td bgcolor='#eeeeec'>Displaygrid->head(  )</td><td title='C:\xampp\htdocs\KWA Database\class.displaydata.php' bgcolor='#eeeeec'>...\class.displaydata.php<b>:</b>1907</td></tr>
</table></font>
<td class="tbl-header">&nbsp;</td></tr></thead><table class="brd" ><tr><td><form id="inlinedirprogramresponsible" name="inlinedirprogramresponsible" method="post" action="inputprogram.php?page=1"><input class="" type="submit" name="programresponsibleresetrec" onclick="tblReset()" value="Reset Table"><input class="" type="submit" name="programresponsibleaddrec" value="New"><input class="" type="submit" name="programresponsibledirfirst" onclick="tblSetPage(1)" value="First"><input class="" type="submit" name="programresponsibledirprevious" onclick="tblSetPage(0)" value="Previous"><input class="" type="submit" name="programresponsibledirnext" onclick="tblSetPage(2)" value="Next"><input class="" type="submit" name="programresponsibledirlast" onclick="tblSetPage(0)" value="Last"></form></td></tr><tr><td>  2 Found <em>0</em> results</td></tr></table><tr>
                                        <td class ="subtitle">Service Code:</td>
                                    </tr>
                                    <tr>
                                       <td><script type="text/javascript">
var params = ''; var tblpage = '1'; var tblorder = 'programid:ASC'; var tblfilter = '';
function tblSetPage(page) { tblpage = page; params = '&page=' + page + '&order=' + tblorder + '&filter=' + tblfilter; updateTable(); }
function tblSetOrder(field, order) { tblorder = field + ':' + order; params = '&page=' + tblpage + '&order=' + tblorder + '&filter=' + tblfilter; updateTable(); }
function tblSetFilter(field) { val = document.getElementById('filter-value-' + field).value; tblfilter = field + ':' + val; tblpage = 1; params = '&page=1&order=' + tblorder + '&filter=' + tblfilter; updateTable(); }
function tblClearFilter() { tblfilter = ''; params = '&page=1&order=' + tblorder + '&filter='; updateTable(); }
function tblToggleCheckAll() { for (i = 0; i < document.dg.checkbox.length; i++) { document.dg.checkbox['i'] .checked = !document.dg.checkbox['i'] .checked; } }
function tblShowHideFilter(field) { var o = document.getElementById('filter-' + field); if (o.style.display == 'block') { tblClearFilter(); } else {	o.style.display = 'block'; } }
function tblReset() { params = '&page=1'; updateTable(); }
</script>
<script type="text/javascript">function updateTable() { window.location = "?" + params; }</script><table class="brd"><tr><td><form id="inlinedirservicecode" name="inlinedirservicecode" method="post" action="inputprogram.php?page=1"><input class="" type="submit" name="servicecoderesetrec" onclick="tblReset()" value="Reset Table"><input class="" type="submit" name="servicecodeaddrec" value="New"><input class="" type="submit" name="servicecodedirfirst" onclick="tblSetPage(1)" value="First"><input class="" type="submit" name="servicecodedirprevious" onclick="tblSetPage(0)" value="Previous"><input class="" type="submit" name="servicecodedirnext" onclick="tblSetPage(2)" value="Next"><input class="" type="submit" name="servicecodedirlast" onclick="tblSetPage(0)" value="Last"></form></td></tr><tr><td>  0 Found <em>0</em> results</td></tr></table>                        </table>
                    </td>
                </tr>    
            </table>
            <table class="tbl" width="100%">
               <tr>            
                    <td>
                        <tr>
                                        <td class ="subtitle">Budget:</td>
                                    </tr>
                                    <tr>
                                       <td><script type="text/javascript">
var params = ''; var tblpage = '1'; var tblorder = 'programid:ASC'; var tblfilter = '';
function tblSetPage(page) { tblpage = page; params = '&page=' + page + '&order=' + tblorder + '&filter=' + tblfilter; updateTable(); }
function tblSetOrder(field, order) { tblorder = field + ':' + order; params = '&page=' + tblpage + '&order=' + tblorder + '&filter=' + tblfilter; updateTable(); }
function tblSetFilter(field) { val = document.getElementById('filter-value-' + field).value; tblfilter = field + ':' + val; tblpage = 1; params = '&page=1&order=' + tblorder + '&filter=' + tblfilter; updateTable(); }
function tblClearFilter() { tblfilter = ''; params = '&page=1&order=' + tblorder + '&filter='; updateTable(); }
function tblToggleCheckAll() { for (i = 0; i < document.dg.checkbox.length; i++) { document.dg.checkbox['i'] .checked = !document.dg.checkbox['i'] .checked; } }
function tblShowHideFilter(field) { var o = document.getElementById('filter-' + field); if (o.style.display == 'block') { tblClearFilter(); } else {	o.style.display = 'block'; } }
function tblReset() { params = '&page=1'; updateTable(); }
</script>
<script type="text/javascript">function updateTable() { window.location = "?" + params; }</script><table class="tbl"><thead><tr><br />
<font size='1'><table class='xdebug-error xe-notice' dir='ltr' border='1' cellspacing='0' cellpadding='1'>
<tr><th align='left' bgcolor='#f57900' colspan="5"><span style='background-color: #cc0000; color: #fce94f; font-size: x-large;'>( ! )</span> Notice: Undefined offset: 0 in C:\xampp\htdocs\KWA Database\displaygrid.php on line <i>45</i></th></tr>
<tr><th align='left' bgcolor='#e9b96e' colspan='5'>Call Stack</th></tr>
<tr><th align='center' bgcolor='#eeeeec'>#</th><th align='left' bgcolor='#eeeeec'>Time</th><th align='left' bgcolor='#eeeeec'>Memory</th><th align='left' bgcolor='#eeeeec'>Function</th><th align='left' bgcolor='#eeeeec'>Location</th></tr>
<tr><td bgcolor='#eeeeec' align='center'>1</td><td bgcolor='#eeeeec' align='center'>0.2030</td><td bgcolor='#eeeeec' align='right'>525864</td><td bgcolor='#eeeeec'>{main}(  )</td><td title='C:\xampp\htdocs\KWA Database\inputprogram.php' bgcolor='#eeeeec'>...\inputprogram.php<b>:</b>0</td></tr>
<tr><td bgcolor='#eeeeec' align='center'>2</td><td bgcolor='#eeeeec' align='center'>0.3904</td><td bgcolor='#eeeeec' align='right'>2819856</td><td bgcolor='#eeeeec'>DisplayData->printdata(  )</td><td title='C:\xampp\htdocs\KWA Database\inputprogram.php' bgcolor='#eeeeec'>...\inputprogram.php<b>:</b>722</td></tr>
<tr><td bgcolor='#eeeeec' align='center'>3</td><td bgcolor='#eeeeec' align='center'>0.3930</td><td bgcolor='#eeeeec' align='right'>2823976</td><td bgcolor='#eeeeec'>Displaygrid->head(  )</td><td title='C:\xampp\htdocs\KWA Database\class.displaydata.php' bgcolor='#eeeeec'>...\class.displaydata.php<b>:</b>1907</td></tr>
</table></font>
<td class="tbl-header">&nbsp;</td><br />
<font size='1'><table class='xdebug-error xe-warning' dir='ltr' border='1' cellspacing='0' cellpadding='1'>
<tr><th align='left' bgcolor='#f57900' colspan="5"><span style='background-color: #cc0000; color: #fce94f; font-size: x-large;'>( ! )</span> Warning: Invalid argument supplied for foreach() in C:\xampp\htdocs\KWA Database\displaygrid.php on line <i>57</i></th></tr>
<tr><th align='left' bgcolor='#e9b96e' colspan='5'>Call Stack</th></tr>
<tr><th align='center' bgcolor='#eeeeec'>#</th><th align='left' bgcolor='#eeeeec'>Time</th><th align='left' bgcolor='#eeeeec'>Memory</th><th align='left' bgcolor='#eeeeec'>Function</th><th align='left' bgcolor='#eeeeec'>Location</th></tr>
<tr><td bgcolor='#eeeeec' align='center'>1</td><td bgcolor='#eeeeec' align='center'>0.2030</td><td bgcolor='#eeeeec' align='right'>525864</td><td bgcolor='#eeeeec'>{main}(  )</td><td title='C:\xampp\htdocs\KWA Database\inputprogram.php' bgcolor='#eeeeec'>...\inputprogram.php<b>:</b>0</td></tr>
<tr><td bgcolor='#eeeeec' align='center'>2</td><td bgcolor='#eeeeec' align='center'>0.3904</td><td bgcolor='#eeeeec' align='right'>2819856</td><td bgcolor='#eeeeec'>DisplayData->printdata(  )</td><td title='C:\xampp\htdocs\KWA Database\inputprogram.php' bgcolor='#eeeeec'>...\inputprogram.php<b>:</b>722</td></tr>
<tr><td bgcolor='#eeeeec' align='center'>3</td><td bgcolor='#eeeeec' align='center'>0.3930</td><td bgcolor='#eeeeec' align='right'>2823976</td><td bgcolor='#eeeeec'>Displaygrid->head(  )</td><td title='C:\xampp\htdocs\KWA Database\class.displaydata.php' bgcolor='#eeeeec'>...\class.displaydata.php<b>:</b>1907</td></tr>
</table></font>
<td class="tbl-header">&nbsp;</td></tr></thead><table class="brd" ><tr><td><form id="inlinedirbudget" name="inlinedirbudget" method="post" action="inputprogram.php?page=1"><input class="" type="submit" name="budgetresetrec" onclick="tblReset()" value="Reset Table"><input class="" type="submit" name="budgetaddrec" value="New"><input class="" type="submit" name="budgetdirfirst" onclick="tblSetPage(1)" value="First"><input class="" type="submit" name="budgetdirprevious" onclick="tblSetPage(0)" value="Previous"><input class="" type="submit" name="budgetdirnext" onclick="tblSetPage(2)" value="Next"><input class="" type="submit" name="budgetdirlast" onclick="tblSetPage(0)" value="Last"></form></td></tr><tr><td>  2 Found <em>0</em> results</td></tr></table>    
                </td>
            </tr>
        <tr><td class="title"  align="left">Recurrence Pattern
                         </td>
                         </tr>
                         <tr> 
                         <td width="100%" align="center">
                                <img src="Images/UnderConstruction.gif" alt="picture" name="pic" width="200" height="200" align="middle">
                        </td>
                    </tr><tr>
                                <td class ="subtitle">Program Notes</td>
                         </tr>
                         <tr>
                                <td><script type="text/javascript">
var params = ''; var tblpage = '1'; var tblorder = 'notesid:ASC'; var tblfilter = '';
function tblSetPage(page) { tblpage = page; params = '&page=' + page + '&order=' + tblorder + '&filter=' + tblfilter; updateTable(); }
function tblSetOrder(field, order) { tblorder = field + ':' + order; params = '&page=' + tblpage + '&order=' + tblorder + '&filter=' + tblfilter; updateTable(); }
function tblSetFilter(field) { val = document.getElementById('filter-value-' + field).value; tblfilter = field + ':' + val; tblpage = 1; params = '&page=1&order=' + tblorder + '&filter=' + tblfilter; updateTable(); }
function tblClearFilter() { tblfilter = ''; params = '&page=1&order=' + tblorder + '&filter='; updateTable(); }
function tblToggleCheckAll() { for (i = 0; i < document.dg.checkbox.length; i++) { document.dg.checkbox['i'] .checked = !document.dg.checkbox['i'] .checked; } }
function tblShowHideFilter(field) { var o = document.getElementById('filter-' + field); if (o.style.display == 'block') { tblClearFilter(); } else {	o.style.display = 'block'; } }
function tblReset() { params = '&page=1'; updateTable(); }
</script>
<script type="text/javascript">function updateTable() { window.location = "?" + params; }</script><table class="brd"><tr><td><form id="inlinedirnotes" name="inlinedirnotes" method="post" action="inputprogram.php?page=1"><input class="" type="submit" name="notesresetrec" onclick="tblReset()" value="Reset Table"><input class="" type="submit" name="notesaddrec" value="New"><input class="" type="submit" name="notesdirfirst" onclick="tblSetPage(1)" value="First"><input class="" type="submit" name="notesdirprevious" onclick="tblSetPage(0)" value="Previous"><input class="" type="submit" name="notesdirnext" onclick="tblSetPage(2)" value="Next"><input class="" type="submit" name="notesdirlast" onclick="tblSetPage(0)" value="Last"></form></td></tr><tr><td>  0 Found <em>0</em> results</td></tr></table>    
                </td>
            </tr>
        </table>
         <form id="selectprogram" name="program"  action="inputprogram.php" method="post" enctype="multipart/form-data" >
            <table class="tbl" width="100%">
               <tr>            
                <td>
                    <input type="submit" class ='subtitle' name="programsave" value="Save">
                    <input type="submit" class ='subtitle' name="programdelete" value="Delete">
                </td>
            </tr>
        </table>
    </form>            
</BODY>
</HTML>