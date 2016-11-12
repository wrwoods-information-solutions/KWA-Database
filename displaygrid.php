
<?php
require_once "class.displaydata.php";
class Displaygrid
{

	function __construct($db = '', $image_path = '')
	{
                if (empty( $db))
                {    
                    $db = new DBMS($_SESSION["preferences"]["database"]["type"],$_SESSION["preferences"]["database"]['server'],$_SESSION["preferences"]["database"]["dbname"] ,$_SESSION["preferences"]["database"]["user"],$_SESSION["preferences"]["database"]["password"],$_SESSION["preferences"]["database"]["port"]); 
                }    
		if (empty($image_path))
			$this->image_path = 'Images/';
		else
			$this->image_path = $image_path;
                $displaydata = new DisplayData($db);
	}
	/**
	* Outputs the grid to the screen
	*
	*/
	function displaygrid($db)
	{	   
                  $displaydata->printdata();
        }
        function head()
        {
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
                $db = new DBMS($_SESSION["preferences"]["database"]["type"],$_SESSION["preferences"]["database"]['server'],$_SESSION["preferences"]["database"]["dbname"] ,$_SESSION["preferences"]["database"]["user"],$_SESSION["preferences"]["database"]["password"],$_SESSION["preferences"]["database"]["port"]);                    
                $displaydata = new DisplayData($db);
                $sql = "SELECT " . $fieldlist . " FROM " . $_SESSION['displaydata'][$_SESSION ["displaydata"] ["name"]]["select_table"];
                $fields = $db->query($sql);
                $fields = $fields->fetchAll(PDO::FETCH_ASSOC);
                $fields = $fields[0];
        // Add a blank field if the row number is to be shown
                if ($_SESSION['displaydata'][$_SESSION ["displaydata"] ["name"]]["show_row_number"]) {
                    $_SESSION['displaydata'][$_SESSION ["displaydata"] ["name"]]["field_count"] ++;
                    echo '<td class="tbl-header">&nbsp;</td>';
                }
                if ($_SESSION['displaydata'][$_SESSION ["displaydata"] ["name"]]["show_checkboxes"]) {
                    $_SESSION['displaydata'][$_SESSION ["displaydata"] ["name"]]["field_count"] ++;
                    echo '<td class="tbl-header tbl-checkall"><input type="checkbox" name="checkall" onclick="tblToggleCheckAll()"></td>';  
                }

                // Loop through each header and output it
                foreach ($fields as $t) 
                {
                    // Skip field if hidden
                    if (in_array($t, $_SESSION['displaydata'][$_SESSION ["displaydata"] ["name"]]["hidden"])) 
                    {
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
                            $order = ($_SESSION['displaydata'][$_SESSION ["displaydata"] ["name"]]["order"] ["order"] == 'ASC') ? 'DESC' : 'ASC';
                        else
                            $order = 'ASC';
                        echo '<td class="tbl-header"><a href="javascript:;" onclick="tblSetOrder(\'' . $t['field'] . '\', \'' . $order . '\')">' . $header . "</a>";

                        // Show the user the order image if set
                        if ($_SESSION['displaydata'][$_SESSION ["displaydata"] ["name"]]["order"] and $_SESSION['displaydata'][$_SESSION ["displaydata"] ["name"]]["order"] ["field"] == $t)
                        {    
                 //           echo '&nbsp;<img src="' . $this->image_path . 'sort_' . strtolower($_SESSION['displaydata'][$_SESSION ["displaydata"] ["name"]]["order"] ["order"]) . '.gif" class="tbl-order">';
                        }    
                        echo '</td>';
                    }
                }
                // If we have controls, add a blank field
                if (count($_SESSION['displaydata'][$_SESSION ["displaydata"] ["name"]]["controls"]) > 0) 
                {
                    $_SESSION['displaydata'][$_SESSION ["displaydata"] ["name"]]["field_count"] ++;
                    echo '<td class="tbl-header">&nbsp;</td>';
                }
                if ($_SESSION['displaydata'][$_SESSION ["displaydata"] ["name"]]["InLineEdit"]) {
                    $_SESSION['displaydata'][$_SESSION ["displaydata"] ["name"]]["field_count"] ++;
                    echo '<td class="tbl-header">&nbsp;</td>';
                }
                echo '</tr></thead>';
        }
        function body()
        {
               $db = new DBMS($_SESSION["preferences"]["database"]["type"],$_SESSION["preferences"]["database"]['server'],$_SESSION["preferences"]["database"]["dbname"] ,$_SESSION["preferences"]["database"]["user"],$_SESSION["preferences"]["database"]["password"],$_SESSION["preferences"]["database"]["port"]);     
                
                 $displaydata = new DisplayData($db);
                foreach ($_SESSION['displaydata'][$_SESSION ["displaydata"] ["name"]]["row"][$_SESSION['displaydata'][$_SESSION ["displaydata"] ["name"]]["line"]-1] as $key=>$value)                 
                {
                    // Skip field if hidden
                    if (in_array($key, $_SESSION['displaydata'][$_SESSION ["displaydata"] ["name"]]["hidden"])) 
                    {
                        continue;
                    }
                     echo '<td class="body">'.$displaydata->formatdata($key).'</td>';
                    }       
                    echo '<td colspan=2>';
                    $displaydata->buildControlssm($_SESSION['displaydata'][$_SESSION ["displaydata"] ["name"]]["line"]);
                    echo '</td>';
//           echo '</tr></table>';     
        }    
        function foot()
        {
            $db = new DBMS($_SESSION["preferences"]["database"]["type"],$_SESSION["preferences"]["database"]['server'],$_SESSION["preferences"]["database"]["dbname"] ,$_SESSION["preferences"]["database"]["user"],$_SESSION["preferences"]["database"]["password"],$_SESSION["preferences"]["database"]["port"]); 
            if ($_SESSION['displaydata'][$_SESSION ["displaydata"] ["name"]]["InLineEdit"])
            {
                $displaydata = new DisplayData($db);
                echo '<table class="brd">';
                echo        '<tr>';
                echo           '<td>'; 
                $displaydata->formopenfoot();
                echo                $displaydata->resetrec();
                echo                $displaydata->displayaddrecord();
                echo                $displaydata->dirfirst();
                echo                $displaydata->dirprevious();
                echo                $displaydata->dirnext();
                echo                $displaydata->dirlast();
                $displaydata->formclose();
                echo           '</td>';
                echo        '</tr>';
                echo        '<tr>';
                echo            '<td>';
                echo                $displaydata->foundXresultsshowingYtoZ();
                echo            '</td>';
                echo        '</tr>';    
                echo    '</table>';
            } 
   }          
}            
?>