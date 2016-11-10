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
    'searchreplace visualblocks code fullscreen',
    'insertdatetime media table contextmenu paste code'
  ],
  toolbar: 'insertfile undo redo | styleselect | bold italic | alignleft aligncenter alignright alignjustify | bullist numlist outdent indent | link image',
  content_css: [
    '//fast.fonts.net/cssapi/e6dc9b99-64fe-4292-ad98-6974f93cd2a2.css',
    '//www.tinymce.com/css/codepen.min.css'
  ]
});
    </script>
        <TITLE>KWA Input Organization</TITLE>
        <!-- calendar style sheet -->
<link rel="stylesheet" type="text/css" media="all" href="calendar-win2k-cold-1.css" title="win2k-cold-1" />

<!-- main calendar program -->
<script type="text/javascript" src="calendar.js"></script>
<!-- language for the calendar -->
<script type="text/javascript" src="calendar-en.js"></script>

<!-- the following script defines the Calendar.setup helper function, which makes
     adding a calendar a matter of 1 or 2 lines of code. -->
<script type="text/javascript" src="calendar-setup.js"></script>


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
						<td align="center" class="headtitle" colspan="3">Input Organization</td>
                                        </tr>
				</table>        <table class="tbl" width="100%">
            <tr>
                <td colspan="13">
                        </td>
            </tr>
        </table>    
        <table class="tbl" width="100%">
            <tr>
                <td class='subtitle'> Select Organization
                    <form id="selectorganization" name="selectorganization"  action="inputorganization.php" method="post" enctype="multipart/form-data" >
        <SELECT name="selectedorganization" class="body" > 
<OPTION value="0"> Please Select</OPTION>
<OPTION value="-99" >New Organization</OPTION> 
<OPTION value="1"  selected >WRWoods Information Solutions Inc.</OPTION> 
</SELECT>
                        <input type="submit" class='subtitle' name="selectorganization" value="Select">
                    </form>
                </td>
            </tr>
        </table> 
        <form id="enterorganization" name="enterorganization"  action="inputorganization.php" method="post" enctype="multipart/form-data" >
            <table class="tbl" width="100%">
                <tr>
                    <td class ='subtitle'>Name&nbsp:
                        <input name="name" class='body' value="WRWoods Information Solutions Inc." type="text" size="40" >
                    </td>
                </tr>
                <tr>
                    <td class ='subtitle'>Description&nbsp;:</td>
                </tr>
                <tr>
                    <td>
                        <textarea id='description' name="description" class ='body' rows="5" cols="45"> </textarea>
                    </td>
                </tr>
            </table>
            <table class="tbl" width="100%">
                <tr>
                    <td>
                        <table class="tbl" width="100%">
<tr>
                                        <td class ="subtitle">Status:</td>
                                    </tr>
                                    <tr>
                                       <td><script type="text/javascript">
var params = ''; var tblpage = '1'; var tblorder = 'organizationid:ASC'; var tblfilter = '';
function tblSetPage(page) { tblpage = page; params = '&page=' + page + '&order=' + tblorder + '&filter=' + tblfilter; updateTable(); }
function tblSetOrder(field, order) { tblorder = field + ':' + order; params = '&page=' + tblpage + '&order=' + tblorder + '&filter=' + tblfilter; updateTable(); }
function tblSetFilter(field) { val = document.getElementById('filter-value-' + field).value; tblfilter = field + ':' + val; tblpage = 1; params = '&page=1&order=' + tblorder + '&filter=' + tblfilter; updateTable(); }
function tblClearFilter() { tblfilter = ''; params = '&page=1&order=' + tblorder + '&filter='; updateTable(); }
function tblToggleCheckAll() { for (i = 0; i < document.dg.checkbox.length; i++) { document.dg.checkbox['i'] .checked = !document.dg.checkbox['i'] .checked; } }
function tblShowHideFilter(field) { var o = document.getElementById('filter-' + field); if (o.style.display == 'block') { tblClearFilter(); } else {	o.style.display = 'block'; } }
function tblReset() { params = '&page=1'; updateTable(); }
</script>
<script type="text/javascript">function updateTable() { window.location = "?" + params; }</script><tr class="even"><td class="tbl-row-num">1&nbsp<span class="body">Supplier</span><span class="tbl-controls"><input class="" type="submit" name="statuseditline" value="E1"><input class="" type="submit" name="statusdeleteline" value="D1"></span><table class="brd"><tr><td><input class="" type="submit" name="statusresetrec" onclick="tblReset()" value="Reset Table"><input class="" type="submit" name="statusaddrec" value="New"><input class="" type="submit" name="statusdirfirst" onclick="tblSetPage(1)" value="First"><input class="" type="submit" name="statusdirprevious" onclick="tblSetPage(0)" value="Previous"><input class="" type="submit" name="statusdirnext" onclick="tblSetPage(2)" value="Next"><input class="" type="submit" name="statusdirlast" onclick="tblSetPage(1)" value="Last"></td></tr><tr><td>  0 Found <em>1</em> results,   showing <em>1</em> to <em>1</em></td></tr></table></td>
                                    </tr><tr>
                                        <td colspan="2" class ="subtitle">Relationship:</td>
                                    </tr>
                                    <tr>
                                        <td><script type="text/javascript">
var params = ''; var tblpage = '1'; var tblorder = 'organizationid:ASC'; var tblfilter = '';
function tblSetPage(page) { tblpage = page; params = '&page=' + page + '&order=' + tblorder + '&filter=' + tblfilter; updateTable(); }
function tblSetOrder(field, order) { tblorder = field + ':' + order; params = '&page=' + tblpage + '&order=' + tblorder + '&filter=' + tblfilter; updateTable(); }
function tblSetFilter(field) { val = document.getElementById('filter-value-' + field).value; tblfilter = field + ':' + val; tblpage = 1; params = '&page=1&order=' + tblorder + '&filter=' + tblfilter; updateTable(); }
function tblClearFilter() { tblfilter = ''; params = '&page=1&order=' + tblorder + '&filter='; updateTable(); }
function tblToggleCheckAll() { for (i = 0; i < document.dg.checkbox.length; i++) { document.dg.checkbox['i'] .checked = !document.dg.checkbox['i'] .checked; } }
function tblShowHideFilter(field) { var o = document.getElementById('filter-' + field); if (o.style.display == 'block') { tblClearFilter(); } else {	o.style.display = 'block'; } }
function tblReset() { params = '&page=1'; updateTable(); }
</script>
<script type="text/javascript">function updateTable() { window.location = "?" + params; }</script><tr class="even"><td class="tbl-row-num">1&nbsp<span class ="subtitle">Person: </span><span class="body">Ric Woods</span><span class="tbl-controls"><input class="" type="submit" name="relationshipeditline" value="E1"><input class="" type="submit" name="relationshipdeleteline" value="D1"></span><tr><td class ="subtitle">Organization: <span class="body">WRWoods Information Solutions Inc.</span></td></tr><tr><td class ="subtitle">Relationship: <span class="body">Professional</span></td></tr><tr><td class="body"><input name="relationshipnotes" class="subtitle" value="Display Relationship Notes" type="submit" size="15" ><table class="brd"><tr><td><input class="" type="submit" name="relationshipresetrec" onclick="tblReset()" value="Reset Table"><input class="" type="submit" name="relationshipaddrec" value="New"><input class="" type="submit" name="relationshipdirfirst" onclick="tblSetPage(1)" value="First"><input class="" type="submit" name="relationshipdirprevious" onclick="tblSetPage(0)" value="Previous"><input class="" type="submit" name="relationshipdirnext" onclick="tblSetPage(2)" value="Next"><input class="" type="submit" name="relationshipdirlast" onclick="tblSetPage(1)" value="Last"></td></tr><tr><td>  0 Found <em>1</em> results,   showing <em>1</em> to <em>1</em></td></tr></table></td>
                                    </tr><tr>
                                        <td class ="subtitle">Address:</td>
                                    </tr>
                                    <tr>
                                        <td><script type="text/javascript">
var params = ''; var tblpage = '1'; var tblorder = 'organizationid:ASC'; var tblfilter = '';
function tblSetPage(page) { tblpage = page; params = '&page=' + page + '&order=' + tblorder + '&filter=' + tblfilter; updateTable(); }
function tblSetOrder(field, order) { tblorder = field + ':' + order; params = '&page=' + tblpage + '&order=' + tblorder + '&filter=' + tblfilter; updateTable(); }
function tblSetFilter(field) { val = document.getElementById('filter-value-' + field).value; tblfilter = field + ':' + val; tblpage = 1; params = '&page=1&order=' + tblorder + '&filter=' + tblfilter; updateTable(); }
function tblClearFilter() { tblfilter = ''; params = '&page=1&order=' + tblorder + '&filter='; updateTable(); }
function tblToggleCheckAll() { for (i = 0; i < document.dg.checkbox.length; i++) { document.dg.checkbox['i'] .checked = !document.dg.checkbox['i'] .checked; } }
function tblShowHideFilter(field) { var o = document.getElementById('filter-' + field); if (o.style.display == 'block') { tblClearFilter(); } else {	o.style.display = 'block'; } }
function tblReset() { params = '&page=1'; updateTable(); }
</script>
<script type="text/javascript">function updateTable() { window.location = "?" + params; }</script>
                                    </tr>
                                    <tr class="even">
                                        <td class="tbl-row-num">1&nbsp
                                            <span class ="subtitle">
                                                Type: 
                                            <span class="body">
                                                Business Address
                                            </span>
                                                <span class="tbl-controls">
                                                    <input class="" type="submit" name="addresseditline" value="E1">
                                                    <input class="" type="submit" name="addressdeleteline" value="D1">
                                                </span>
                                         </td> 
                                      </tr>
                                      <tr>
                                          <td class="subtitle">
                                              Address 1: 
                                              <span class="body">
                                                  test 1
                                              </span>
                                          </td>
                                      </tr>
                                      <tr>
                                          <td class="subtitle">
                                              Address 2: 
                                              <span class="body">
                                                  test2
                                              </span>
                                          </td>
                                      </tr>
                                      <tr>
                                          <td class="subtitle">
                                              City: 
                                              <span class="body">
                                                  Waterloo
                                              </span>
                                          </td>
                                      </tr>
                                      <tr>
                                          <td class="subtitle">
                                              Province: 
                                              <span class="body">
                                                  test 3
                                              </span>
                                          </td>
                                      </tr>
                                      <tr>
                                          <td class="subtitle">
                                              Postal Code: 
                                              <span class="body">
                                                  test 4
                                              </span>
                                          </td>
                                      </tr>
                                      <tr>
                                          <td class="body">
                                              <input name="addressnotes" class="subtitle" value="Display Address Notes" type="submit" size="15" >
                                              <table class="brd">
                                                  <tr>
                                                      <td>
                                                          <input class="" type="submit" name="addressresetrec" onclick="tblReset()" value="Reset Table">
                                                          <input class="" type="submit" name="addressaddrec" value="New">
                                                          <input class="" type="submit" name="addressdirfirst" onclick="tblSetPage(1)" value="First">
                                                          <input class="" type="submit" name="addressdirprevious" onclick="tblSetPage(0)" value="Previous">
                                                          <input class="" type="submit" name="addressdirnext" onclick="tblSetPage(2)" value="Next">
                                                          <input class="" type="submit" name="addressdirlast" onclick="tblSetPage(1)" value="Last"></td></tr><tr><td>  0 Found <em>1</em> results,   showing <em>1</em> to <em>1</em>
                                                      </td>
                                                  </tr>
                                              </table>
                                          </td>
                                   </tr>
                                   <tr>
                                        <td class ="subtitle">Organization Note:</td>
                                    </tr>
                                    <tr>
                                       <td><script type="text/javascript">
var params = ''; var tblpage = '1'; var tblorder = 'organizationid:ASC'; var tblfilter = '';
function tblSetPage(page) { tblpage = page; params = '&page=' + page + '&order=' + tblorder + '&filter=' + tblfilter; updateTable(); }
function tblSetOrder(field, order) { tblorder = field + ':' + order; params = '&page=' + tblpage + '&order=' + tblorder + '&filter=' + tblfilter; updateTable(); }
function tblSetFilter(field) { val = document.getElementById('filter-value-' + field).value; tblfilter = field + ':' + val; tblpage = 1; params = '&page=1&order=' + tblorder + '&filter=' + tblfilter; updateTable(); }
function tblClearFilter() { tblfilter = ''; params = '&page=1&order=' + tblorder + '&filter='; updateTable(); }
function tblToggleCheckAll() { for (i = 0; i < document.dg.checkbox.length; i++) { document.dg.checkbox['i'] .checked = !document.dg.checkbox['i'] .checked; } }
function tblShowHideFilter(field) { var o = document.getElementById('filter-' + field); if (o.style.display == 'block') { tblClearFilter(); } else {	o.style.display = 'block'; } }
function tblReset() { params = '&page=1'; updateTable(); }
</script>
<script type="text/javascript">function updateTable() { window.location = "?" + params; }</script><table class="brd"><tr><td><input class="" type="submit" name="notesresetrec" onclick="tblReset()" value="Reset Table"><input class="" type="submit" name="notesaddrec" value="New"><input class="" type="submit" name="notesdirfirst" onclick="tblSetPage(1)" value="First"><input class="" type="submit" name="notesdirprevious" onclick="tblSetPage(0)" value="Previous"><input class="" type="submit" name="notesdirnext" onclick="tblSetPage(2)" value="Next"><input class="" type="submit" name="notesdirlast" onclick="tblSetPage(0)" value="Last"></td></tr><tr><td>  0 Found <em>0</em> results</td></tr></table></td>
                                    </tr>                        </table>        
                    </td>
                    <td valign="top">
                        <table class="tbl" width="100%">
                            <tr>
                                        <td class ="subtitle">Membership:</td>
                                    </tr>
                                    <tr>
                                        <td><script type="text/javascript">
var params = ''; var tblpage = '1'; var tblorder = 'organizationid:ASC'; var tblfilter = '';
function tblSetPage(page) { tblpage = page; params = '&page=' + page + '&order=' + tblorder + '&filter=' + tblfilter; updateTable(); }
function tblSetOrder(field, order) { tblorder = field + ':' + order; params = '&page=' + tblpage + '&order=' + tblorder + '&filter=' + tblfilter; updateTable(); }
function tblSetFilter(field) { val = document.getElementById('filter-value-' + field).value; tblfilter = field + ':' + val; tblpage = 1; params = '&page=1&order=' + tblorder + '&filter=' + tblfilter; updateTable(); }
function tblClearFilter() { tblfilter = ''; params = '&page=1&order=' + tblorder + '&filter='; updateTable(); }
function tblToggleCheckAll() { for (i = 0; i < document.dg.checkbox.length; i++) { document.dg.checkbox['i'] .checked = !document.dg.checkbox['i'] .checked; } }
function tblShowHideFilter(field) { var o = document.getElementById('filter-' + field); if (o.style.display == 'block') { tblClearFilter(); } else {	o.style.display = 'block'; } }
function tblReset() { params = '&page=1'; updateTable(); }
</script>
<script type="text/javascript">function updateTable() { window.location = "?" + params; }</script><tr class="even"><td class="tbl-row-num">1&nbsp<span class="subtitle">Type: </span><span class="body">Member</span><span class="tbl-controls"><input class="" type="submit" name="membershipeditline" value="E1"><input class="" type="submit" name="membershipdeleteline" value="D1"></span></tr><tr><td class="subtitle">Expiry Date: <span class="body">2017-Apr-21</span><table class="brd"><tr><td><input class="" type="submit" name="membershipresetrec" onclick="tblReset()" value="Reset Table"><input class="" type="submit" name="membershipaddrec" value="New"><input class="" type="submit" name="membershipdirfirst" onclick="tblSetPage(1)" value="First"><input class="" type="submit" name="membershipdirprevious" onclick="tblSetPage(0)" value="Previous"><input class="" type="submit" name="membershipdirnext" onclick="tblSetPage(2)" value="Next"><input class="" type="submit" name="membershipdirlast" onclick="tblSetPage(1)" value="Last"></td></tr><tr><td>  0 Found <em>1</em> results,   showing <em>1</em> to <em>1</em></td></tr></table></td>
                                   </tr><tr>
                                        <td class ="subtitle">Telephone:</td>
                                    </tr>
                                    <tr>
                                       <td><script type="text/javascript">
var params = ''; var tblpage = '1'; var tblorder = 'organizationid:ASC'; var tblfilter = '';
function tblSetPage(page) { tblpage = page; params = '&page=' + page + '&order=' + tblorder + '&filter=' + tblfilter; updateTable(); }
function tblSetOrder(field, order) { tblorder = field + ':' + order; params = '&page=' + tblpage + '&order=' + tblorder + '&filter=' + tblfilter; updateTable(); }
function tblSetFilter(field) { val = document.getElementById('filter-value-' + field).value; tblfilter = field + ':' + val; tblpage = 1; params = '&page=1&order=' + tblorder + '&filter=' + tblfilter; updateTable(); }
function tblClearFilter() { tblfilter = ''; params = '&page=1&order=' + tblorder + '&filter='; updateTable(); }
function tblToggleCheckAll() { for (i = 0; i < document.dg.checkbox.length; i++) { document.dg.checkbox['i'] .checked = !document.dg.checkbox['i'] .checked; } }
function tblShowHideFilter(field) { var o = document.getElementById('filter-' + field); if (o.style.display == 'block') { tblClearFilter(); } else {	o.style.display = 'block'; } }
function tblReset() { params = '&page=1'; updateTable(); }
</script>
<script type="text/javascript">function updateTable() { window.location = "?" + params; }</script><table class="brd"><tr><td><input class="" type="submit" name="telephoneresetrec" onclick="tblReset()" value="Reset Table"><input class="" type="submit" name="telephoneaddrec" value="New"><input class="" type="submit" name="telephonedirfirst" onclick="tblSetPage(1)" value="First"><input class="" type="submit" name="telephonedirprevious" onclick="tblSetPage(0)" value="Previous"><input class="" type="submit" name="telephonedirnext" onclick="tblSetPage(2)" value="Next"><input class="" type="submit" name="telephonedirlast" onclick="tblSetPage(0)" value="Last"></td></tr><tr><td>  0 Found <em>0</em> results</td></tr></table></td>
                                    </tr><tr>
                                        <td class ="subtitle">Email:</td>
                                    </tr>
                                    <tr>
                                       <td><script type="text/javascript">
var params = ''; var tblpage = '1'; var tblorder = 'organizationid:ASC'; var tblfilter = '';
function tblSetPage(page) { tblpage = page; params = '&page=' + page + '&order=' + tblorder + '&filter=' + tblfilter; updateTable(); }
function tblSetOrder(field, order) { tblorder = field + ':' + order; params = '&page=' + tblpage + '&order=' + tblorder + '&filter=' + tblfilter; updateTable(); }
function tblSetFilter(field) { val = document.getElementById('filter-value-' + field).value; tblfilter = field + ':' + val; tblpage = 1; params = '&page=1&order=' + tblorder + '&filter=' + tblfilter; updateTable(); }
function tblClearFilter() { tblfilter = ''; params = '&page=1&order=' + tblorder + '&filter='; updateTable(); }
function tblToggleCheckAll() { for (i = 0; i < document.dg.checkbox.length; i++) { document.dg.checkbox['i'] .checked = !document.dg.checkbox['i'] .checked; } }
function tblShowHideFilter(field) { var o = document.getElementById('filter-' + field); if (o.style.display == 'block') { tblClearFilter(); } else {	o.style.display = 'block'; } }
function tblReset() { params = '&page=1'; updateTable(); }
</script>
<script type="text/javascript">function updateTable() { window.location = "?" + params; }</script><table class="brd"><tr><td><input class="" type="submit" name="emailresetrec" onclick="tblReset()" value="Reset Table"><input class="" type="submit" name="emailaddrec" value="New"><input class="" type="submit" name="emaildirfirst" onclick="tblSetPage(1)" value="First"><input class="" type="submit" name="emaildirprevious" onclick="tblSetPage(0)" value="Previous"><input class="" type="submit" name="emaildirnext" onclick="tblSetPage(2)" value="Next"><input class="" type="submit" name="emaildirlast" onclick="tblSetPage(0)" value="Last"></td></tr><tr><td>  0 Found <em>0</em> results</td></tr></table></td>
                                    </tr>                        </table>
                    </td>
                </tr>
            </table>
            <table>         
                <tr>
                    <td>
                        <input type="submit" class ='subtitle' name="organizationsave" value="Save">
                        <input type="submit" class ='subtitle' name="organizationdelete" value="Delete">
                    </td>
                </tr>
            </table>
        </FORM>              
    </BODY>
</HTML>