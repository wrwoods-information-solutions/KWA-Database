<html><head>
        <meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1">
        <link href="style.css" rel="stylesheet" type="text/css">
        <script type="text/javascript" src="popup-window.js"></script>
<script language="javascript">
function noshow() 
{
  document.ctrtype('div1').style.display='password';
  document.ctrtype('div2').style.display='';
}
function show() 
{
  document.ctrtype('div1').style.display='';
  document.ctrtype('div2').style.display='text';
}
</script>
        <title>TEST KWA Login Setup</title>
        <script type="text/javascript" src="popup-window.js"></script>


    </head>

    <body>
        <table width="100%" border="0" bgcolor="#0099FF">
					<tbody><tr>
                                               <td align="left" height="96"><img src="images/newlogo.gif"></td>
                                               <td class="subtitle" align="cemtre">User Name: <scan class="body"> admin</scan></td>
 						<td align="right">
							<form id="logout" name="logout" action="index.php?LC_ACTION=logout" method="post">
								<p class="button" align="center"><input class="button" name="LC_ACTION" value="Logout" type="submit"></p>
							</form>	</td>
                                       </tr>
                                        <tr>
						<td class="headtitle" colspan="3" align="center">Setup Login</td>
                                        </tr>
				</tbody></table>        <table class="tbl" width="100%">
            <tbody><tr>
                <td colspan="13">
                       <a class="title" href="home.php">Home</a>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;   <a name="2" class="title" href="http://localhost/KWA Database/setuplogin.php?p=|2#2">Person</a>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;   <a name="5" class="title" href="http://localhost/KWA Database/setuplogin.php?p=|5#5">Administration</a>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;                </td>
            </tr>
        </tbody></table>    
        <form action="setuplogin.php" method="post">
            <table width="100%" border="0" background="Images/HeavenBackground.jpg"> 
                <tbody><tr>
                    <td class="subtitle" width="108">Select UserName</td>
                    <td>
                        <select name="selectlogin" class="body"> 
<option value="0"> Please Select</option>
<option value="-99">New UserName</option> 
<option value="1" selected="">admin</option> 
<option value="2">guest</option> 
</select>
                        <input name="refreshlogin" value="Refresh" type="submit">
                    </td>

                </tr>
                <tr>
                    <td class="subtitle">Person</td>
                   <td><input name="person" value="I am Admin" class="body" size="25" type="text"></td>
                </tr>
                <tr>
                    <td class="subtitle">Username</td>
                    <td><input name="username" value="admin" class="body" size="25" type="text"></td>
                </tr>
                <tr>
                   <td><input value="Set Password" onclick="popup_show('popup','popup_drag','popup_exit','screen-center',0,0)" type="button"></td>         
                </tr>
                <tr>
                    <td class="subtitle">UserMenu Name</td>
                    <td>
                        <select name="selectusermenuname" class="body"> 
<option value="0"> Please Select</option>
<option value="-99">New User Menu Name</option> 
<option value="adminmenu" selected="">adminmenu</option> 
<option value="guestmenu">guestmenu</option> 
</select>
    
                        <input name="refreshmenu" value="Refresh" type="submit">
                        <select name="usestdmenuinput" class="body"> 
<option value="0"> Please Select</option>
</select>
                        <input name="usestdmenu" value="Use Standard Menu" type="submit">
                    </td>
                </tr>    
                <tr>
                    <td colspan="2">
                        <script type="text/javascript">
var params = ''; var tblpage = '1'; var tblorder = 'orderfield:ASC'; var tblfilter = '';
function tblSetPage(page) { tblpage = page; params = '&page=' + page + '&order=' + tblorder + '&filter=' + tblfilter; updateTable(); }
function tblSetOrder(field, order) { tblorder = field + ':' + order; params = '&page=' + tblpage + '&order=' + tblorder + '&filter=' + tblfilter; updateTable(); }
function tblSetFilter(field) { val = document.getElementById('filter-value-' + field).value; tblfilter = field + ':' + val; tblpage = 1; params = '&page=1&order=' + tblorder + '&filter=' + tblfilter; updateTable(); }
function tblClearFilter() { tblfilter = ''; params = '&page=1&order=' + tblorder + '&filter='; updateTable(); }
function tblToggleCheckAll() { for (i = 0; i < document.dg.checkbox.length; i++) { document.dg.checkbox['i'] .checked = !document.dg.checkbox['i'] .checked; } }
function tblShowHideFilter(field) { var o = document.getElementById('filter-' + field); if (o.style.display == 'block') { tblClearFilter(); } else {	o.style.display = 'block'; } }
function tblReset() { params = '&page=1'; updateTable(); }
</script>
<script type="text/javascript">
    function updateTable() { window.location = "?" + params; }
</script>
                    </td>
                </tr>
                <tr class="even">
                    <td class="tbl-row-num">
                        1&nbsp;
                    </td>
                    <td class="body">
                        100000000
                    </td>
                    <td class="body">
                        Home
                    </td>
                    <td class="body">
                        Home
                    </td>
                    <td colspan="2">
                        <span class="tbl-controls">
                            <input class="" name="usermenugrideditline1" value="E1" type="submit">
                            <input class="" name="usermenugriddeleteline1" value="D1" type="submit">
                        </span>
                    </td>
                </tr>
                <tr>
                    
                </tr>
                <tr class="odd">
                    <td class="tbl-row-num">
                        2&nbsp;
                    </td>
                    <td class="body">
                        200000000
                    </td>
                    <td class="body">
                        Person
                    </td>
                    <td class="body">
                        Person
                    </td>
                    <td colspan="2">
                        <span class="tbl-controls">
                            <input class="" name="usermenugrideditline2" value="E2" type="submit">
                            <input class="" name="usermenugriddeleteline2" value="D2" type="submit">
                        </span>
                    </td>
                </tr>
                <tr>
                    
                </tr>
                <tr class="even">
                    <td class="tbl-row-num">
                        3&nbsp;
                    </td>
                    <td class="body">
                        201000000
                    </td>
                    <td class="body">
                        Person Input
                    </td>
                    <td class="body">
                        Person Input
                    </td>
                    <td colspan="2">
                        <span class="tbl-controls">
                            <input class="" name="usermenugrideditline3" value="E3" type="submit">
                            <input class="" name="usermenugriddeleteline3" value="D3" type="submit">
                        </span>
                    </td>
                </tr>
                <tr>
                    
                </tr>
                <tr class="odd">
                    <td class="tbl-row-num">
                        4&nbsp;
                    </td>
                    <td class="body">
                        202000000</td>
                    <td class="body">
                        Person Profile
                    </td>
                    <td class="body">
                        Person Profile
                    </td>
                    <td colspan="2">
                        <span class="tbl-controls">
                            <input class="" name="usermenugrideditline4" value="E4" type="submit">
                            <input class="" name="usermenugriddeleteline4" value="D4" type="submit">
                        </span>
                    </td>
                    </tr>
                    <tr>
                        
                    </tr>
                    <tr class="even">
                        <td class="tbl-row-num">
                            5&nbsp;
                        </td>
                        <td class="body">
                            700000000
                        </td>
                        <td class="body">
                            Administration
                        </td>
                        <td class="body">
                            Administration
                        </td>
                        <td colspan="2">
                            <span class="tbl-controls">
                                <input class="" name="usermenugrideditline5" value="E5" type="submit">
                                <input class="" name="usermenugriddeleteline5" value="D5" type="submit">
                            </span>
                        </td>
                    </tr>
                    <tr>
                        
                    </tr>
                    <tr class="odd">
                        <td class="tbl-row-num">
                            6&nbsp;
                        </td>
                        <td class="body">
                            701000000
                        </td>
                        <td class="body">
                            Setup Login
                        </td>
                        <td class="body">
                            Setup Login
                        </td><td colspan="2">
                            <span class="tbl-controls">
                                <input class="" name="usermenugrideditline6" value="E6" type="submit">
                                <input class="" name="usermenugriddeleteline6" value="D6" type="submit">
                            </span>
                        </td>
                    </tr>
                    <tr>
                        
                    </tr>
                    <tr class="even">
                        <td class="tbl-row-num">
                            7&nbsp;
                        </td>
                        <td class="body">
                            702000000
                        </td>
                        <td class="body">
                            Setup Master Menu
                        </td>
                        <td class="body">
                            Setup Master Menu
                        </td>
                        <td colspan="2">
                            <span class="tbl-controls">
                                <input class="" name="usermenugrideditline7" value="E7" type="submit">
                                <input class="" name="usermenugriddeleteline7" value="D7" type="submit">
                            </span>
                        </td>
                    </tr>
                    <tr>
                        
                    </tr>
                </tbody>
            </table>
            <table class="brd">
                <tbody>
                    <tr>
                        <td>
                            <input class="" name="usermenugridresetrec" onclick="tblReset()" value="Reset Table" type="submit">
                            <input class="" name="usermenugridaddrec" value="Add New Menu Item" type="submit"><input class="" name="usermenugriddirfirst" onclick="tblSetPage(1)" value="First" type="submit">
                            <input class="" name="usermenugriddirprevious" onclick="tblSetPage(0)" value="Previous" type="submit">
                            <input class="" name="usermenugriddirnext" onclick="tblSetPage(2)" value="Next" type="submit">
                            <input class="" name="usermenugriddirlast" onclick="tblSetPage(1)" value="Last" type="submit">
                        </td>
                    </tr>
                    <tr>
                        <td>
                            0 Found <em>7</em> results,   showing <em>1</em> to <em>7</em>
                        </td>
                    </tr>
                </tbody>
            </table>                    
                <input name="submit" value="Submit" type="submit">
                <input name="delete" value="Delete" type="submit">
                <input name="reset" value="Reset" type="submit">
                <select name="savestdusermenuname" class="body"> 
                    <option value="0"> Please Select</option>
                    <option value="-99">New stdUsermenu</option> 
                </select>
               <input name="refreshstdmenu" value="Refresh" type="submit">
               <input name="savestdmenu" value="Save Standard Menu" type="submit">
                <input name="deletestdmenu" value="Delete Standard Menu" type="submit">
         </form>    
<!-- ***** Popup Window ************************************************** -->';
<div class="sample_popup" id="popup" style="display: none;">

<div class="menu_form_header" id="popup_drag">
<img class="menu_form_exit" id="popup_exit" src="form_exit.png" alt="">
<span align="center">Set Password</span>
</div>

<div class="menu_form_body">
<form action="setuplogin.php">
<table>
    <tbody><tr><td class="subtitle">Password<input name="password" class="body" value="" size="10" type="password"><img src="images/eye 1.png" id="eyeid" onclick="show()" alt="Show Password" width="16" border="0" height="16"></td></tr><tr><td class="subtitle">Confirm Password<input name="confpassword" class="body" value="" size="10" type="password"><img src="images/eye 1.png" id="confeyeid" onfocus="show()" alt="Show Password" width="16" border="0" height="16"></td></tr><tr><td><input name="submitpassword" value="Submit Password" type="submit"></td></tr>   
       </tbody></table>
</form>
</div>
</body>
</html>