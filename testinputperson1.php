<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN">
<HTML>
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1">
        <link href="style.css" rel="stylesheet" type="text/css">
        <script type="text/javascript" src="popup-window.js"></script>
        <script>
            function keyCode(event) {
                var x = event.keyCode;
                if (x == 112) {
                    alert("You pressed the f1 key!");
                }
            }
                </script>
        <TITLE>KWA Input Person</TITLE>
        <head>
><script type="text/javascript" src="popup-window.js"></script>
<script type="text/javascript">
function keyCode(event) {
    var x = event.keyCode;
    if (x == 112) {
        alert ("You pressed the f1 key!");
    }
}
</script>
</head>
<body>
</body>

    </head>
    <body>
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
						<td align="center" class="headtitle" colspan="3">Input Person</td>
                                        </tr>
				</table>        <table class="tbl" width="100%">
            <tr>
                <td colspan="13">
           <a class="title" href="home.php">Home</a>&nbsp&nbsp&nbsp&nbsp&nbsp   <a name="2" class="title" href="http://localhost/KWA Database/inputperson.php?p=|2#2">Person</a>&nbsp&nbsp&nbsp&nbsp&nbsp   <a name="5" class="title" href="http://localhost/KWA Database/inputperson.php?p=|5#5">Organization</a>&nbsp&nbsp&nbsp&nbsp&nbsp   <a name="8" class="title" href="http://localhost/KWA Database/inputperson.php?p=|8#8">Program</a>&nbsp&nbsp&nbsp&nbsp&nbsp   <a name="10" class="title" href="http://localhost/KWA Database/inputperson.php?p=|10#10">Request</a>&nbsp&nbsp&nbsp&nbsp&nbsp   <a name="12" class="title" href="http://localhost/KWA Database/inputperson.php?p=|12#12">Administration</a>&nbsp&nbsp&nbsp&nbsp&nbsp   <a name="18" class="title" href="http://localhost/KWA Database/inputperson.php?p=|18#18">Help</a>&nbsp&nbsp&nbsp&nbsp&nbsp                </td>
            </tr>
        </table>    
        <table class="tbl" width="100%">
            <tr>
                <td class='subtitle'> Select Person
                    <form id="selectperson" name="selectperson"  action="inputperson.php" method="post" enctype="multipart/form-data" >
                
<script>
function keyCode(event) {
    var x = event.keyCode;
    if (x == 112) {
        alert ("You pressed the f1 key!");
    }
}
</script>
<SELECT name="selectedperson" class="body" > 
<OPTION value="0"> Please Select</OPTION>
<OPTION value="-99" >New Person</OPTION> 
<OPTION value="1"  selected >I am Admin</OPTION> 
<OPTION value="2" >I am Guest</OPTION> 
</SELECT>
                        <input type="submit" class='subtitle' name="refreshperson" value="Refresh">
                    </form>
                </td>
            </tr>
        </table> 
        <form id="enterperson" name="enterperson"  action="inputperson.php" method="post" enctype="multipart/form-data" >
            <table class="tbl" width="100%">
                <tr>
                    <td class ='subtitle'>First Name&nbsp:
                    <input name="firstname" class="body" type="text" size=25 value="I am">        
                    </td>
                    <td class="subtitle">Gender&nbsp:
<SELECT name="gender" class="body" > 
<OPTION value="m"  selected >Male</OPTION> 
<OPTION value="f" >Female</OPTION> 
</SELECT>
                    </td>
                </tr>
                <tr>
                    <td class ='subtitle'>Last Name&nbsp:
<input name="lastname" class ="body" type="text" size = 25 value="Admin">   
                    </td>
                    <td>
<span class="body">Birthdate : </span><input type="text" id="birthdate" name="birthdate" class="subtitle"  value="2013-Jul-06"><img src="images/cal.gif" id="birthdateid" width="16" height="16" border="0" alt="Pick a date"><script type="text/javascript">
    				Calendar.setup({
        				inputField     :    "birthdate",  // id of the input field
						ifFormat       :    "%Y-%b-%d",      // format of the input field
	         			button         :    "birthdateid",  // trigger for the calendar (button ID)
        				weeknumbers    :    false,           // no week numbers
                			align          :    "br",           // alignment (defaults to "Bl")
        				singleClick    :    true
						});
				</script>                    </td>
                </tr>
                <tr>
                    <td class ='subtitle'>Full Name&nbsp;:
                        <input name="fullname" class ="body" type="text" size=30 value="I am Admin">   
                    </td>
                    <td class ='subtitle'>Mobility Plus Id.&nbsp;:
<input name="mobilityplusid" class="body" type="text" size=7 value="1">    
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
                                    <tr><script type="text/javascript">
var params = ''; var tblpage = '1'; var tblorder = 'statusid:ASC'; var tblfilter = '';
function tblSetPage(page) { tblpage = page; params = '&page=' + page + '&order=' + tblorder + '&filter=' + tblfilter; updateTable(); }
function tblSetOrder(field, order) { tblorder = field + ':' + order; params = '&page=' + tblpage + '&order=' + tblorder + '&filter=' + tblfilter; updateTable(); }
function tblSetFilter(field) { val = document.getElementById('filter-value-' + field).value; tblfilter = field + ':' + val; tblpage = 1; params = '&page=1&order=' + tblorder + '&filter=' + tblfilter; updateTable(); }
function tblClearFilter() { tblfilter = ''; params = '&page=1&order=' + tblorder + '&filter='; updateTable(); }
function tblToggleCheckAll() { for (i = 0; i < document.dg.checkbox.length; i++) { document.dg.checkbox['i'] .checked = !document.dg.checkbox['i'] .checked; } }
function tblShowHideFilter(field) { var o = document.getElementById('filter-' + field); if (o.style.display == 'block') { tblClearFilter(); } else {	o.style.display = 'block'; } }
function tblReset() { params = '&page=1'; updateTable(); }
</script>
<script type="text/javascript">function updateTable() { window.location = "?" + params; }</script></tr>tr><td><table class="brd"><tr><td><input class="" type="submit" name="statusresetrec" onclick="tblReset()" value="Reset Table"><input class="" type="submit" name="statusaddrec" value="New"><input class="" type="submit" name="statusdirfirst" onclick="tblSetPage(1)" value="First"><input class="" type="submit" name="statusdirprevious" onclick="tblSetPage(0)" value="Previous"><input class="" type="submit" name="statusdirnext" onclick="tblSetPage(2)" value="Next"><input class="" type="submit" name="statusdirlast" onclick="tblSetPage(0)" value="Last"></td></tr><tr><td>  0 Found <em>0</em> results</td></tr></table></td></tr><tr>
                                        <td class ="subtitle">Relationship:</td>
                                    </tr>
                                    <tr>
                                        <td><script type="text/javascript">
var params = ''; var tblpage = '1'; var tblorder = 'personid:ASC'; var tblfilter = '';
function tblSetPage(page) { tblpage = page; params = '&page=' + page + '&order=' + tblorder + '&filter=' + tblfilter; updateTable(); }
function tblSetOrder(field, order) { tblorder = field + ':' + order; params = '&page=' + tblpage + '&order=' + tblorder + '&filter=' + tblfilter; updateTable(); }
function tblSetFilter(field) { val = document.getElementById('filter-value-' + field).value; tblfilter = field + ':' + val; tblpage = 1; params = '&page=1&order=' + tblorder + '&filter=' + tblfilter; updateTable(); }
function tblClearFilter() { tblfilter = ''; params = '&page=1&order=' + tblorder + '&filter='; updateTable(); }
function tblToggleCheckAll() { for (i = 0; i < document.dg.checkbox.length; i++) { document.dg.checkbox['i'] .checked = !document.dg.checkbox['i'] .checked; } }
function tblShowHideFilter(field) { var o = document.getElementById('filter-' + field); if (o.style.display == 'block') { tblClearFilter(); } else {	o.style.display = 'block'; } }
function tblReset() { params = '&page=1'; updateTable(); }
</script>
<script type="text/javascript">function updateTable() { window.location = "?" + params; }</script></tr></table></td></tr><tr><td><table class="brd"><tr><td><input class="" type="submit" name="relationshipresetrec" onclick="tblReset()" value="Reset Table"><input class="" type="submit" name="relationshipaddrec" value="New"><input class="" type="submit" name="relationshipdirfirst" onclick="tblSetPage(1)" value="First"><input class="" type="submit" name="relationshipdirprevious" onclick="tblSetPage(0)" value="Previous"><input class="" type="submit" name="relationshipdirnext" onclick="tblSetPage(2)" value="Next"><input class="" type="submit" name="relationshipdirlast" onclick="tblSetPage(0)" value="Last"></td></tr><tr><td>  0 Found <em>0</em> results</td></tr></table></td></tr><tr>
                                        <td class ="subtitle">Address:</td>
                                  </tr>
                                   <tr>
                                        <td><script type="text/javascript">
var params = ''; var tblpage = '1'; var tblorder = 'personid:ASC'; var tblfilter = '';
function tblSetPage(page) { tblpage = page; params = '&page=' + page + '&order=' + tblorder + '&filter=' + tblfilter; updateTable(); }
function tblSetOrder(field, order) { tblorder = field + ':' + order; params = '&page=' + tblpage + '&order=' + tblorder + '&filter=' + tblfilter; updateTable(); }
function tblSetFilter(field) { val = document.getElementById('filter-value-' + field).value; tblfilter = field + ':' + val; tblpage = 1; params = '&page=1&order=' + tblorder + '&filter=' + tblfilter; updateTable(); }
function tblClearFilter() { tblfilter = ''; params = '&page=1&order=' + tblorder + '&filter='; updateTable(); }
function tblToggleCheckAll() { for (i = 0; i < document.dg.checkbox.length; i++) { document.dg.checkbox['i'] .checked = !document.dg.checkbox['i'] .checked; } }
function tblShowHideFilter(field) { var o = document.getElementById('filter-' + field); if (o.style.display == 'block') { tblClearFilter(); } else {	o.style.display = 'block'; } }
function tblReset() { params = '&page=1'; updateTable(); }
</script>
<script type="text/javascript">function updateTable() { window.location = "?" + params; }</script></tr></table></td></tr><tr><td><table class="brd"><tr><td><input class="" type="submit" name="addressresetrec" onclick="tblReset()" value="Reset Table"><input class="" type="submit" name="addressaddrec" value="New"><input class="" type="submit" name="addressdirfirst" onclick="tblSetPage(1)" value="First"><input class="" type="submit" name="addressdirprevious" onclick="tblSetPage(0)" value="Previous"><input class="" type="submit" name="addressdirnext" onclick="tblSetPage(2)" value="Next"><input class="" type="submit" name="addressdirlast" onclick="tblSetPage(0)" value="Last"></td></tr><tr><td>  0 Found <em>0</em> results</td></tr></table></td></tr><tr>
                                        <td class ="subtitle">Person Note:</td>
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
<script type="text/javascript">function updateTable() { window.location = "?" + params; }</script></tr></table></td></tr><tr><td><table class="brd"><tr><td><input class="" type="submit" name="notesresetrec" onclick="tblReset()" value="Reset Table"><input class="" type="submit" name="notesaddrec" value="New"><input class="" type="submit" name="notesdirfirst" onclick="tblSetPage(1)" value="First"><input class="" type="submit" name="notesdirprevious" onclick="tblSetPage(0)" value="Previous"><input class="" type="submit" name="notesdirnext" onclick="tblSetPage(2)" value="Next"><input class="" type="submit" name="notesdirlast" onclick="tblSetPage(0)" value="Last"></td></tr><tr><td>  0 Found <em>0</em> results</td></tr></table></td></tr>                        </table>
                    </td>
                    <td valign="top">
                        <table class="tbl" width="100%">
                            <tr>
                                        <td class ="subtitle">Membership:</td>
                                    </tr>
                                    <tr>
                                        <td><script type="text/javascript">
var params = ''; var tblpage = '1'; var tblorder = 'personid:ASC'; var tblfilter = '';
function tblSetPage(page) { tblpage = page; params = '&page=' + page + '&order=' + tblorder + '&filter=' + tblfilter; updateTable(); }
function tblSetOrder(field, order) { tblorder = field + ':' + order; params = '&page=' + tblpage + '&order=' + tblorder + '&filter=' + tblfilter; updateTable(); }
function tblSetFilter(field) { val = document.getElementById('filter-value-' + field).value; tblfilter = field + ':' + val; tblpage = 1; params = '&page=1&order=' + tblorder + '&filter=' + tblfilter; updateTable(); }
function tblClearFilter() { tblfilter = ''; params = '&page=1&order=' + tblorder + '&filter='; updateTable(); }
function tblToggleCheckAll() { for (i = 0; i < document.dg.checkbox.length; i++) { document.dg.checkbox['i'] .checked = !document.dg.checkbox['i'] .checked; } }
function tblShowHideFilter(field) { var o = document.getElementById('filter-' + field); if (o.style.display == 'block') { tblClearFilter(); } else {	o.style.display = 'block'; } }
function tblReset() { params = '&page=1'; updateTable(); }
</script>
<script type="text/javascript">function updateTable() { window.location = "?" + params; }</script><tr class="even"><td class="tbl-row-num">1&nbsp<span class="subtitle">Type: </span><span class="body">Member</span><span class="tbl-controls"><input class="" type="submit" name="membershipeditline[]" value="E1"><input class="" type="submit" name="membershipdeleteline[]" value="D1"></span></tr><tr><td class="subtitle">Expiry Date: <span class="body">2014-Apr-07</span></tr></table></td></tr><tr><td><table class="brd"><tr><td><input class="" type="submit" name="membershipresetrec" onclick="tblReset()" value="Reset Table"><input class="" type="submit" name="membershipaddrec" value="New"><input class="" type="submit" name="membershipdirfirst" onclick="tblSetPage(1)" value="First"><input class="" type="submit" name="membershipdirprevious" onclick="tblSetPage(0)" value="Previous"><input class="" type="submit" name="membershipdirnext" onclick="tblSetPage(2)" value="Next"><input class="" type="submit" name="membershipdirlast" onclick="tblSetPage(1)" value="Last"></td></tr><tr><td>  0 Found <em>1</em> results,   showing <em>1</em> to <em>1</em></td></tr></table></td></tr><tr>
                                        <td class="subtitle">Mobility Aid:</td>
                                    </tr>
                                    <tr>
                                       <td><script type="text/javascript">
var params = ''; var tblpage = '1'; var tblorder = 'personid:ASC'; var tblfilter = '';
function tblSetPage(page) { tblpage = page; params = '&page=' + page + '&order=' + tblorder + '&filter=' + tblfilter; updateTable(); }
function tblSetOrder(field, order) { tblorder = field + ':' + order; params = '&page=' + tblpage + '&order=' + tblorder + '&filter=' + tblfilter; updateTable(); }
function tblSetFilter(field) { val = document.getElementById('filter-value-' + field).value; tblfilter = field + ':' + val; tblpage = 1; params = '&page=1&order=' + tblorder + '&filter=' + tblfilter; updateTable(); }
function tblClearFilter() { tblfilter = ''; params = '&page=1&order=' + tblorder + '&filter='; updateTable(); }
function tblToggleCheckAll() { for (i = 0; i < document.dg.checkbox.length; i++) { document.dg.checkbox['i'] .checked = !document.dg.checkbox['i'] .checked; } }
function tblShowHideFilter(field) { var o = document.getElementById('filter-' + field); if (o.style.display == 'block') { tblClearFilter(); } else {	o.style.display = 'block'; } }
function tblReset() { params = '&page=1'; updateTable(); }
</script>
<script type="text/javascript">function updateTable() { window.location = "?" + params; }</script></tr></table></td></tr><tr><td><table class="brd"><tr><td><input class="" type="submit" name="mobilityaidresetrec" onclick="tblReset()" value="Reset Table"><input class="" type="submit" name="mobilityaidaddrec" value="New"><input class="" type="submit" name="mobilityaiddirfirst" onclick="tblSetPage(1)" value="First"><input class="" type="submit" name="mobilityaiddirprevious" onclick="tblSetPage(0)" value="Previous"><input class="" type="submit" name="mobilityaiddirnext" onclick="tblSetPage(2)" value="Next"><input class="" type="submit" name="mobilityaiddirlast" onclick="tblSetPage(0)" value="Last"></td></tr><tr><td>  0 Found <em>0</em> results</td></tr></table></td></tr><tr>
                                        <td class ="subtitle">Telephone:</td>
                                    </tr>
                                    <tr>
                                       <td><script type="text/javascript">
var params = ''; var tblpage = '1'; var tblorder = 'personid:ASC'; var tblfilter = '';
function tblSetPage(page) { tblpage = page; params = '&page=' + page + '&order=' + tblorder + '&filter=' + tblfilter; updateTable(); }
function tblSetOrder(field, order) { tblorder = field + ':' + order; params = '&page=' + tblpage + '&order=' + tblorder + '&filter=' + tblfilter; updateTable(); }
function tblSetFilter(field) { val = document.getElementById('filter-value-' + field).value; tblfilter = field + ':' + val; tblpage = 1; params = '&page=1&order=' + tblorder + '&filter=' + tblfilter; updateTable(); }
function tblClearFilter() { tblfilter = ''; params = '&page=1&order=' + tblorder + '&filter='; updateTable(); }
function tblToggleCheckAll() { for (i = 0; i < document.dg.checkbox.length; i++) { document.dg.checkbox['i'] .checked = !document.dg.checkbox['i'] .checked; } }
function tblShowHideFilter(field) { var o = document.getElementById('filter-' + field); if (o.style.display == 'block') { tblClearFilter(); } else {	o.style.display = 'block'; } }
function tblReset() { params = '&page=1'; updateTable(); }
</script>
<script type="text/javascript">function updateTable() { window.location = "?" + params; }</script></tr></table></td></tr><tr><td><table class="brd"><tr><td><input class="" type="submit" name="telephoneresetrec" onclick="tblReset()" value="Reset Table"><input class="" type="submit" name="telephoneaddrec" value="New"><input class="" type="submit" name="telephonedirfirst" onclick="tblSetPage(1)" value="First"><input class="" type="submit" name="telephonedirprevious" onclick="tblSetPage(0)" value="Previous"><input class="" type="submit" name="telephonedirnext" onclick="tblSetPage(2)" value="Next"><input class="" type="submit" name="telephonedirlast" onclick="tblSetPage(0)" value="Last"></td></tr><tr><td>  0 Found <em>0</em> results</td></tr></table></td></tr><tr>
                                        <td class ="subtitle">Email:</td>
                                    </tr>
                                    <tr>
                                       <td><script type="text/javascript">
var params = ''; var tblpage = '1'; var tblorder = 'personid:ASC'; var tblfilter = '';
function tblSetPage(page) { tblpage = page; params = '&page=' + page + '&order=' + tblorder + '&filter=' + tblfilter; updateTable(); }
function tblSetOrder(field, order) { tblorder = field + ':' + order; params = '&page=' + tblpage + '&order=' + tblorder + '&filter=' + tblfilter; updateTable(); }
function tblSetFilter(field) { val = document.getElementById('filter-value-' + field).value; tblfilter = field + ':' + val; tblpage = 1; params = '&page=1&order=' + tblorder + '&filter=' + tblfilter; updateTable(); }
function tblClearFilter() { tblfilter = ''; params = '&page=1&order=' + tblorder + '&filter='; updateTable(); }
function tblToggleCheckAll() { for (i = 0; i < document.dg.checkbox.length; i++) { document.dg.checkbox['i'] .checked = !document.dg.checkbox['i'] .checked; } }
function tblShowHideFilter(field) { var o = document.getElementById('filter-' + field); if (o.style.display == 'block') { tblClearFilter(); } else {	o.style.display = 'block'; } }
function tblReset() { params = '&page=1'; updateTable(); }
</script>
<script type="text/javascript">function updateTable() { window.location = "?" + params; }</script></tr></table></td></tr><tr><td><table class="brd"><tr><td><input class="" type="submit" name="emailresetrec" onclick="tblReset()" value="Reset Table"><input class="" type="submit" name="emailaddrec" value="New"><input class="" type="submit" name="emaildirfirst" onclick="tblSetPage(1)" value="First"><input class="" type="submit" name="emaildirprevious" onclick="tblSetPage(0)" value="Previous"><input class="" type="submit" name="emaildirnext" onclick="tblSetPage(2)" value="Next"><input class="" type="submit" name="emaildirlast" onclick="tblSetPage(0)" value="Last"></td></tr><tr><td>  0 Found <em>0</em> results</td></tr></table></td></tr>                        </table>
                    </td>
            </table>
            <table class="tbl" width="100%">
               <tr>            
                <td>
                    <input type="submit" class ='subtitle' name="personsave" value="Save">
                    <input type="submit" class ='subtitle' name="persondelete" value="Delete">
                </td>
            </tr>
        </table>
    </form>            
</body>
</HTML>