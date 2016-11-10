<?php
require_once "class.displaydata.php";
class Displaymembership
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
	}
	/**
	* Outputs the grid to the screen
	*
	*/
	function displaymembership($db)
	{	
                if (empty($db))
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
                $displaydata = new DisplayData($db);
                echo '<span class="subtitle">Type: </span>'
                     .'<span class="body">'.$displaydata->formatdata('membership').'</span>';
                echo $displaydata->buildControlssm($_SESSION['displaydata'][$_SESSION ["displaydata"] ["name"]]["line"]);
                echo  '</tr>'
                     .'<tr>'   
                     .'<td class="subtitle">Expiry Date: '
                     .'<span class="body">'.$displaydata->formatdata('expirydate').'</span>';
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