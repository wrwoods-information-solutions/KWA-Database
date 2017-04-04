<?php
class DisplayProgramObjective
{

	function __construct($db = '', $image_path = '')
	{
                if (empty($db))
                {    
                    $db = new DBMS($_SESSION["preferences"]["database"]["type"],$_SESSION["preferences"]["database"]['server'],$_SESSION["preferences"]["database"]["dbname"] ,$_SESSION["preferences"]["database"]["user"],$_SESSION["preferences"]["database"]["password"],$_SESSION["preferences"]["database"]["port"]); 
                }    
		if (empty($image_path))
			$this->image_path = 'Images/';
		else
			$this->image_path = $image_path;
	}
	/**
	* Outputs the grid to the screen
	*
	*/
	function displayprogramobjective($db)
	{	
                 if (empty( $db))
                {    
                    $db = new DBMS($_SESSION["preferences"]["database"]["type"],$_SESSION["preferences"]["database"]['server'],$_SESSION["preferences"]["database"]["dbname"] ,$_SESSION["preferences"]["database"]["user"],$_SESSION["preferences"]["database"]["password"],$_SESSION["preferences"]["database"]["port"]); 
                }    
                $displaydata = new DisplayData($db);
                $displaydata->printdata();

        }
        function head()
        {
            if (empty($db))
            {    
                    $db = new DBMS($_SESSION["preferences"]["database"]["type"],$_SESSION["preferences"]["database"]['server'],$_SESSION["preferences"]["database"]["dbname"] ,$_SESSION["preferences"]["database"]["user"],$_SESSION["preferences"]["database"]["password"],$_SESSION["preferences"]["database"]["port"]); 
            }    
            $displaydata = new DisplayData($db);
        }
        function body()
        {
             if (empty($db))
             {    
                 $db = new DBMS($_SESSION["preferences"]["database"]["type"],$_SESSION["preferences"]["database"]['server'],$_SESSION["preferences"]["database"]["dbname"] ,$_SESSION["preferences"]["database"]["user"],$_SESSION["preferences"]["database"]["password"],$_SESSION["preferences"]["database"]["port"]); 
             }    
// Load the database adapter -programmeasurment
// Load the displaydata class
             $programmeasurment = new DisplayData($db);
             $programmeasurment->setdisplaydata('programmeasurment');
             $programmeasurment->SetTemplate('displayprogrammeasurment', $db);
// Set the query, select all rows from the people table
             $programmeasurment->setQuery("programmeasurment", "programmeasurment", "", "programid = " . $_SESSION['program']["programid"]);
             $programmeasurment->setPrimaryID('programmeasurmentid');
             $programmeasurment->setConstantFields(array("programid" => $_SESSION["program"]['programid']));
             $programmeasurment->setURLConstant("inputprogram.php");
             $programmeasurment->setOrder('programid');

// Hide ID field
             $programmeasurment->hidefield('programid');
// Show reset grid control
             $programmeasurment->showReset();

// setting inline edit
             $programmeasurment->SetInLineEdit(true);
// Add standard control
             $programmeasurment->addStandardControl(displaydata::STDCTRL_INLINEEDIT, "inputprogram.php", displaydata::TYPE_PHPFUNCTION);
// Add create control
             $programmeasurment->showCreateButton("inputprogram.php", displaydata::TYPE_INLINEADDRECORD, 'New');

// Show checkboxes
// Show row numbers
             $programmeasurment->showRowNumber(true);
// Change the amount of results per page
             $programmeasurment->setResultsPerPage(2);

// Change headers text
             $programmeasurment->SetFieldHeader('programmeasurment', 'Program Measurment:');
//  set field type
             $programmeasurment->SetFieldType('programmeasurment', displaydata::TYPE_CODEDISPLAY, array('table' => 'programmeasurment', 'field' => 'programmeasurment', 'class' => 'body'));
//  set inlineedit field type
             $programmeasurment->SetInlineFieldType('programmeasurment', displaydata::INLINE_CODECOMBO, array('name' => 'programmeasurment', 'table' => 'programmeasurment', 'where' => 'programid = "' . $_SESSION['program']['programid'], 'field' => 'programmeasurment', 'class' => 'body')); // programmeasurment
// Stop ordering
             $programmeasurment->hideOrder(false);
             $displaydata = new DisplayData($db);
             echo '<span class="body">';
             echo $displaydata->formatdata('programobjective');
             echo '</span>';
             $displaydata->buildControlssm($_SESSION['displaydata'][$_SESSION ["displaydata"] ["name"]]["line"]);
             echo '</td></tr>';
             echo '<tr><td>';
                        if ($_SESSION['displaydata']["programmeasurment"]["displayprogrammeasurment"]) {
                            echo '<tr>
                                        <td class ="subtitle">Program Measurment:</td>
                                    </tr>
                                    <tr>';
                            $_SESSION["displaydata"] ["name"] = 'programmeasurment';
                            $programmeasurment->printdata();
                        }
             echo '</td></tr>';
          }    
        function foot()
        {
            if (empty($db))
            {    
                $db = new DBMS($_SESSION["preferences"]["database"]["type"],$_SESSION["preferences"]["database"]['server'],$_SESSION["preferences"]["database"]["dbname"] ,$_SESSION["preferences"]["database"]["user"],$_SESSION["preferences"]["database"]["password"],$_SESSION["preferences"]["database"]["port"]); 
            }    
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
