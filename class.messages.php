<?PHP 
/**
 * *****************************************************
 * @file class.messages.php
 * @brief The messages class handles all messages functions
 * @author W.R.(Ric)Woods
 * @version  1.0
 * @copyright 2017
 * 
 * @date 13 February 2017
 */
define('FF_OPACITY_LEVEL',5);
define('IE_OPACITY_LEVEL',70);
define('DEFAULT_BORDER_STYLE',"red 1px solid");
define('DEFAULT_MESSAGE_HEIGHT',150);
define('DEFAULT_MESSAGE_WIDTH',150);
define('DEFAULT_HEADLINE_TEXT_ALLIGNMENT','center');
define('DEFAULT_HEADLINE_HEIGHT_RATIO',0.2);
define('DEFAULT_HEADLINE_TEXT_COLOR','black');
define('DEFAULT_HEADLINE_BACKGROUND_COLOR','aqua');
define('DEFAULT_TEXT_ALLIGNMENT','left');
define('DEFAULT_TEXT_HEIGHT_RATIO',0.7);
define('DEFAULT_TEXT_COLOR','white');
define('DEFAULT_TEXT_BACKGROUND_COLOR','red');
define('DEFAULT_CONTROL_TEXT_ALLIGNMENT','right');
define('DEFAULT_CONTROL_HEIGHT_RATIO',0.2);
define('DEFAULT_CONTROL_TEXT_COLOR','black');
define('DEFAULT_CONTROL_TEXT_WORDING','OK');
require_once "class.pdodatabase.php";
require_once "class.validate.php";


class messages {
	//	PUBLIC PARAMS
	//

		  /**
		  * @shortdesc associative array that reflects styling values of Message
          * @type Array
		  * @public
          * @default value : DEFAULT_BORDER_STYLE : red 1px solid
                             DEFAULT_MESSAGE_HEIGHT:110
                             DEFAULT_MESSAGE_WIDTH:300
		  */
		 var $MessageStyleArr;
		 /**
		  * @shortdesc associative array that reflects styling values of Headline
          * @type Array
		  * @public
          * @default value : DEFAULT_HEADLINE_TEXT_ALLIGNMENT:'right'
							 DEFAULT_HEADLINE_HEIGHT_RATIO:0.2   // 0.2 of total MSG height
							 DEFAULT_HEADLINE_TEXT_COLOR:'white'
							 DEFAULT_HEADLINE_BACKGROUND_COLOR:'blue'
		  */
         var $HeadlineStyleArr;
		 
		 /**
		  * @shortdesc associative array that reflects styling values of Text
          * @type Array
		  * @public
          * @default value : DEFAULT_TEXT_ALLIGNMENT,'center'
						     DEFAULT_TEXT_HEIGHT_RATIO,0.7   // 0.7 of total MSG height
							 DEFAULT_TEXT_COLOR,'white'
							 DEFAULT_TEXT_BACKGROUND_COLOR,'aqua'
		  */
		 
         var $TextStyleArr;
		 
		 /**
		  * @shortdesc associative array that reflects styling values of Control
          * @type Array
		  * @public
          * @default value : DEFAULT_CONTROL_TEXT_ALLIGNMENT','right'
                             DEFAULT_CONTROL_HEIGHT_RATIO,0.1
                             DEFAULT_CONTROL_TEXT_COLOR,'black'
                             DEFAULT_CONTROL_TEXT_WORDING,'Close'
		  */
         var $ControlStyleArr;
		 /**
		  * @shortdesc Message Text
          * @type String
		  * @public
          * @default value :"Welcome to MsgPopUp Class"
		  */
         var $description;
		 /**
		  * @shortdesc Headline Text
          * @type String
		  * @public
          * @default value :"Headline"
		  */
          var $title;
		  /**
		  * @shortdesc Control Text (the wording at the bottom of message that close it)
          * @type String
		  * @public
          * @default value :"Close"
		  */
		  var $ControlTxt;
		  /**
		  * @shortdesc HTML SRC of Message
          * @type String
		  * @public
		  */	  
          var $HTML;
		  /**
		  * @shortdesc uniqe id(name) of Message element
          * @type String
		  * @public
		  */	  	  
          var $id;
		  /**
		  * @shortdesc time out (in ms) untill the message is disappeared
          * @type String
		  * @public
		  * @default value : 0  (== No Timeout)
	      */	  		  
          var $timeout;
		  var $messageid;
          var $rtnanswer;

//Constructor

	public function popupMsg ($top=100,$left=300,$width=DEFAULT_MESSAGE_WIDTH,$height=DEFAULT_MESSAGE_HEIGHT,$title="Headline",$description="Welcome to MsgPopUp Class",$controltxt=DEFAULT_CONTROL_TEXT_WORDING,$timeout=0,$MessageStyleArr='',$HeadlineStyleArr='',$TextStyleArr='',$ControlStyleArr='') 
	{

		// apply Firefox FIX 
		if (strpos($_SERVER['HTTP_USER_AGENT'],'Firefox')>0) 
			$FF_FIX=10;
		else 
			$FF_FIX=0;
		if ($MessageStyleArr!='') 
			$this->MessageStyleArr=$MessageStyleArr;
        if (!isset($this->MessageStyleArr["border"])) 
		 	$this->MessageStyleArr["border"] = DEFAULT_BORDER_STYLE;
		if (!isset($this->MessageStyleArr["Height"])) 
			$this->MessageStyleArr["Height"] = $height;
		if (!isset($this->MessageStyleArr["Width"]))  
			$this->MessageStyleArr["Width"] = $width;
	    		
		// transparency (added 30-09-2007)
		if (!isset($this->MessageStyleArr["filter"])) 
			$this->MessageStyleArr["filter"] = "alpha(opacity=".IE_OPACITY_LEVEL.")";
		if (!isset($this->MessageStyleArr["moz-opacity"])) 
			$this->MessageStyleArr["moz-opacity"] = FF_OPACITY_LEVEL;
		if (!isset($this->MessageStyleArr["opacity"]))  
			$this->MessageStyleArr["opacity"] = FF_OPACITY_LEVEL;
			
	 	# filter:alpha(opacity=60);   
		#    -moz-opacity: 0.6;   
		#    opacity: 0.6;   
		
		// FF Fix 
		$this->MessageStyleArr["padding-bottom"] = $FF_FIX;	  
		
		// Apply Absolute positioning parameters .
     	$this->MessageStyleArr["position"] = "absolute";
     	$this->MessageStyleArr["top"] = $top;
     	$this->MessageStyleArr["left"] = $left;	
		if ($HeadlineStyleArr!='') $this->HeadlineStyleArr=$HeadlineStyleArr;
        if (!isset($this->HeadlineStyleArr["text-align"]))       
			$this->HeadlineStyleArr["text-align"] = DEFAULT_HEADLINE_TEXT_ALLIGNMENT;
		if (!isset($this->HeadlineStyleArr["Height"]))           
			$this->HeadlineStyleArr["Height"] = $this->MessageStyleArr["Height"]*DEFAULT_HEADLINE_HEIGHT_RATIO;
		if (!isset($this->HeadlineStyleArr["Width"]))            
			$this->HeadlineStyleArr["Width"] = $this->MessageStyleArr["Width"]; 
		if (!isset($this->HeadlineStyleArr["color"]))            $this->HeadlineStyleArr["color"] =  DEFAULT_HEADLINE_TEXT_COLOR; 
		if (!isset($this->HeadlineStyleArr["background-color"])) 
			$this->HeadlineStyleArr["background-color"] = DEFAULT_HEADLINE_BACKGROUND_COLOR; 
		if ($TextStyleArr!='') 
			$this->TextStyleArr=$TextStyleArr;
        if (!isset($this->TextStyleArr["text-align"]))          
			$this->TextStyleArr["text-align"] = DEFAULT_TEXT_ALLIGNMENT;
		if (!isset($this->TextStyleArr["Height"]))              
			$this->TextStyleArr["Height"] = $this->MessageStyleArr["Height"]*DEFAULT_TEXT_HEIGHT_RATIO;
		if (!isset($this->TextStyleArr["Width"]))               
			$this->TextStyleArr["Width"] =  $this->MessageStyleArr["Width"];
		if (!isset($this->TextStyleArr["color"]))               
			$this->TextStyleArr["color"] = DEFAULT_TEXT_COLOR; 
		if (!isset($this->TextStyleArr["background-color"]))    
			$this->TextStyleArr["background-color"]= DEFAULT_TEXT_BACKGROUND_COLOR; 
		if ($ControlStyleArr!='') 
			$this->ControlStyleArr=$ControlStyleArr;
        if (!isset($this->ControlStyleArr["text-align"]))       
			$this->ControlStyleArr["text-align"] = "right";
		if (!isset($this->ControlStyleArr["Height"]))           
			$this->ControlStyleArr["Height"] = $this->MessageStyleArr["Height"]*DEFAULT_CONTROL_HEIGHT_RATIO+$FF_FIX;
		if (!isset($this->ControlStyleArr["Width"]))            
			$this->ControlStyleArr["Width"] = $this->MessageStyleArr["Width"];
		if (!isset($this->ControlStyleArr["color"]))            $this->ControlStyleArr["color"] = DEFAULT_CONTROL_TEXT_COLOR; 
		if (!isset($this->ControlStyleArr["background-color"])) 
			$this->ControlStyleArr["background-color"] = $this->TextStyleArr["background-color"]; 
		$this->id = "div_".uniqid();  // assign a uniqe id to each message
		$this->description = $description;
		$this->title = $title;
		$this->timeout = $timeout;
		if ($controltxt=='')
			$this->ControlTxt = DEFAULT_CONTROL_TEXT_WORDING;
		else
			$this->ControlTxt = $controltxt;
		// parse styling variables
		$msgStyleString = $this->parseStyleArray($this->MessageStyleArr);
		$headlineStyleString = $this->parseStyleArray($this->HeadlineStyleArr);
		$textStyleString = $this->parseStyleArray($this->TextStyleArr);
		$controlStyleString =  $this->parseStyleArray($this->ControlStyleArr);
		$this->HTML = 
			'<div name="'.$this->id.'" id="'.$this->id.'"  style="'.$msgStyleString.'">
  			<div style="'.$headlineStyleString.'">'.$this->title.'</div>
  			<div style="'.$textStyleString.'">'.$this->description.'</div>
  			<div style="'.$controlStyleString.'" onClick="document.all.'.$this->id.'.style.visibility=\'hidden\';return false;">'.$this->ControlTxt.'</div>
			</div>
			';
		// apply Timeout variable 
		if ($this->timeout!=0) 
		$this->HTML .= 
				'<script>
				var str = "document.all.'.$this->id.'.style.visibility=\'hidden\';";
				var tmp = window.setTimeout("eval(str);",'.$this->timeout.');
				</script>';
		echo $this->HTML;
	}
	public function DisplayMessage($code,$top=100,$left=300,$width=DEFAULT_MESSAGE_WIDTH,$height=DEFAULT_MESSAGE_HEIGHT,$title="Headline",$description="Welcome to Message Class",$controltxt=DEFAULT_CONTROL_TEXT_WORDING,$timeout=0,$MessageStyleArr='',$HeadlineStyleArr='',$TextStyleArr='',$ControlStyleArr='') 
	{
		if (strlen($code) > 0)
		{
			$sql = 'SELECT * FROM messages WHERE (code = \''.$code.'\')';
                        $db = new DBMS($_SESSION["preferences"]["database"]["type"],$_SESSION["preferences"]["database"]['server'],$_SESSION["preferences"]["database"]["dbname"] ,$_SESSION["preferences"]["database"]["user"],$_SESSION["preferences"]["database"]["password"],$_SESSION["preferences"]["database"]["port"])or die('could not connect');
                        $results = $db->query($sql);
			foreach ($results as $row) 
                        {    
                        	$title= $row['title'];
				$description = $row['description'];
                        }    
		}    
		
		// apply Firefox FIX 
 		if (strpos($_SERVER['HTTP_USER_AGENT'],'Firefox')>0) 
			$FF_FIX=10;
		else 
			$FF_FIX=0;
		if ($MessageStyleArr!='') 
			$this->MessageStyleArr=$MessageStyleArr;
        if (!isset($this->MessageStyleArr["border"])) 
		 	$this->MessageStyleArr["border"] = DEFAULT_BORDER_STYLE;
		if (!isset($this->MessageStyleArr["Height"])) 
			$this->MessageStyleArr["Height"] = $height;
		if (!isset($this->MessageStyleArr["Width"]))  
			$this->MessageStyleArr["Width"] = $width;
	    		
		// transparency (added 30-09-2007)
		if (!isset($this->MessageStyleArr["filter"])) 
			$this->MessageStyleArr["filter"] = "alpha(opacity=".IE_OPACITY_LEVEL.")";
		if (!isset($this->MessageStyleArr["moz-opacity"])) 
			$this->MessageStyleArr["moz-opacity"] = FF_OPACITY_LEVEL;
		if (!isset($this->MessageStyleArr["opacity"]))  
			$this->MessageStyleArr["opacity"] = FF_OPACITY_LEVEL;
			
	 	# filter:alpha(opacity=60);   
		#    -moz-opacity: 0.6;   
		#    opacity: 0.6;   
		
		// FF Fix 
		$this->MessageStyleArr["padding-bottom"] = $FF_FIX;	  
		
		// Apply Absolute positioning parameters .
     	$this->MessageStyleArr["position"] = "absolute";
     	$this->MessageStyleArr["top"] = $top;
     	$this->MessageStyleArr["left"] = $left;	
		if ($HeadlineStyleArr!='') $this->HeadlineStyleArr=$HeadlineStyleArr;
        if (!isset($this->HeadlineStyleArr["text-align"]))       
			$this->HeadlineStyleArr["text-align"] = DEFAULT_HEADLINE_TEXT_ALLIGNMENT;
		if (!isset($this->HeadlineStyleArr["Height"]))           
			$this->HeadlineStyleArr["Height"] = $this->MessageStyleArr["Height"]*DEFAULT_HEADLINE_HEIGHT_RATIO;
		if (!isset($this->HeadlineStyleArr["Width"]))            
			$this->HeadlineStyleArr["Width"] = $this->MessageStyleArr["Width"]; 
		if (!isset($this->HeadlineStyleArr["color"]))            $this->HeadlineStyleArr["color"] =  DEFAULT_HEADLINE_TEXT_COLOR; 
		if (!isset($this->HeadlineStyleArr["background-color"])) 
			$this->HeadlineStyleArr["background-color"] = DEFAULT_HEADLINE_BACKGROUND_COLOR; 
		if ($TextStyleArr!='') 
			$this->TextStyleArr=$TextStyleArr;
        if (!isset($this->TextStyleArr["text-align"]))          
			$this->TextStyleArr["text-align"] = DEFAULT_TEXT_ALLIGNMENT;
		if (!isset($this->TextStyleArr["Height"]))              
			$this->TextStyleArr["Height"] = $this->MessageStyleArr["Height"]*DEFAULT_TEXT_HEIGHT_RATIO;
		if (!isset($this->TextStyleArr["Width"]))               
			$this->TextStyleArr["Width"] =  $this->MessageStyleArr["Width"];
		if (!isset($this->TextStyleArr["color"]))               
			$this->TextStyleArr["color"] = DEFAULT_TEXT_COLOR; 
		if (!isset($this->TextStyleArr["background-color"]))    
			$this->TextStyleArr["background-color"]= DEFAULT_TEXT_BACKGROUND_COLOR; 
		if ($ControlStyleArr!='') 
			$this->ControlStyleArr=$ControlStyleArr;
        if (!isset($this->ControlStyleArr["text-align"]))       
			$this->ControlStyleArr["text-align"] = "right";
		if (!isset($this->ControlStyleArr["Height"]))           
			$this->ControlStyleArr["Height"] = $this->MessageStyleArr["Height"]*DEFAULT_CONTROL_HEIGHT_RATIO+$FF_FIX;
		if (!isset($this->ControlStyleArr["Width"]))            
			$this->ControlStyleArr["Width"] = $this->MessageStyleArr["Width"];
		if (!isset($this->ControlStyleArr["color"]))            $this->ControlStyleArr["color"] = DEFAULT_CONTROL_TEXT_COLOR; 
		if (!isset($this->ControlStyleArr["background-color"])) 
			$this->ControlStyleArr["background-color"] = $this->TextStyleArr["background-color"]; 
		$this->id = "div_".uniqid();  // assign a uniqe id to each message
		$this->description = $description;
		$this->title = $title;
		$this->timeout = $timeout;
		if ($controltxt=='')
			$this->ControlTxt = DEFAULT_CONTROL_TEXT_WORDING;
		else
			$this->ControlTxt = $controltxt;
		// parse styling variables
		$msgStyleString = $this->parseStyleArray($this->MessageStyleArr);
		$headlineStyleString = $this->parseStyleArray($this->HeadlineStyleArr);
		$textStyleString = $this->parseStyleArray($this->TextStyleArr);
		$controlStyleString =  $this->parseStyleArray($this->ControlStyleArr);
		$this->HTML = 
			'<div name="'.$this->id.'" id="'.$this->id.'"  style="'.$msgStyleString.'">
  			<div style="'.$headlineStyleString.'">'.$title.'</div>
  			<div style="'.$textStyleString.'">'.$description.'</div>
  			<div style="'.$controlStyleString.'" onClick="document.all.'.$this->id.'.style.visibility=\'hidden\';return false;">'.$controltxt.'</div>
			</div>
			';
		// apply Timeout variable 
		if ($this->timeout!=0) 
			$this->HTML .= 
				'<script>
				var str = "document.all.'.$this->id.'.style.visibility=\'hidden\';";
				var tmp = window.setTimeout("eval(str);",'.$this->timeout.');
				</script>';
		echo $this->HTML;
	}

// Utility method to serialize associative array and accomulate a styling string 
// That would be assign for the Message element (MSG/Headling/Text/Control).
//
//	PUBLIC METHODS
//
	/**
    *
	* @shortdesc  serialize associative array and accomulate a styling string 
    * That would be assigned for the Message element (MSG/Headling/Text/Control).
	* Parameters : 
	* $styleArr : associative array of styling
	* method : "curl" (in case enabled) or "fopen" (default)
	 * @public
	 * @return String in the form of "field1:value1;field2:value2;"...
	 *
**/
	function parseStyleArray($styleArr)
	{
	
		$str="";
		foreach ($styleArr as $key=>$value) 
 			$str.=$key.":".$value.";";
			return $str;
	}


// setting up messages table		  
	function insertrecord($category = '') 
	{
		$sql = 'INSERT INTO messages SET category = "'.$category.'"';
                $db = new DBMS($_SESSION["preferences"]["database"]["type"],$_SESSION["preferences"]["database"]['server'],$_SESSION["preferences"]["database"]["dbname"] ,$_SESSION["preferences"]["database"]["user"],$_SESSION["preferences"]["database"]["password"],$_SESSION["preferences"]["database"]["port"]);
		$results = $db->query($sql);
		if ($results) 
                {
                    $row = $results->fetch(PDO::FETCH_ASSOC);
                    $validate = new validate;
                    $validate->DateStamp('person','personid',$row[0]['personid'],$_SESSION['login']['username']);
                    $msg = new messages;
                    $msg->DisplayMessage('recadd');
                    return ;
                }
	}
	 function updaterecord($messageid,$code,$title,$description) 
	 {
		$sql = 'UPDATE messages SET code= \''.$code.'\',title= \''.$title.'\',description= \''.$description.'\' WHERE (messageid = \''.$messageid.'\')';
                $db = new DBMS($_SESSION["preferences"]["database"]["type"],$_SESSION["preferences"]["database"]['server'],$_SESSION["preferences"]["database"]["dbname"] ,$_SESSION["preferences"]["database"]["user"],$_SESSION["preferences"]["database"]["password"],$_SESSION["preferences"]["database"]["port"]);
		$db->query($sql);
		$validate = new validate;
		$validate->DateStamp('messages','messageid',$messageid,$_SESSION["login"]['username']);
		$this->DisplayMessage('recupdate');
	}
	function deleterecord($messageid) 
	{
		$sql = 'DELETE FROM messages WHERE (messageid = \''.$messageid.'\')';
                $db = new DBMS($_SESSION["preferences"]["database"]["type"],$_SESSION["preferences"]["database"]['server'],$_SESSION["preferences"]["database"]["dbname"] ,$_SESSION["preferences"]["database"]["user"],$_SESSION["preferences"]["database"]["password"],$_SESSION["preferences"]["database"]["port"]);
		$db->query($sql);
		$this->DisplayMessage('recdelete');
	}	
	function getrecord($messageid) 
	{
		$sql = 'SELECT * FROM messages WHERE (messageid = \''.$messageid.'\')';
                $db = new DBMS($_SESSION["preferences"]["database"]["type"],$_SESSION["preferences"]["database"]['server'],$_SESSION["preferences"]["database"]["dbname"] ,$_SESSION["preferences"]["database"]["user"],$_SESSION["preferences"]["database"]["password"],$_SESSION["preferences"]["database"]["port"]);
		$results = $db->query($sql);
		$row = $db->fetchAssoc($results);
		return $row;
	}	
	function getdescription($messageid) 
	{
		$sql = 'SELECT Description  FROM messages WHERE (messageid = \''.$messageid.'\')';
                $db = new DBMS($_SESSION["preferences"]["database"]["type"],$_SESSION["preferences"]["database"]['server'],$_SESSION["preferences"]["database"]["dbname"] ,$_SESSION["preferences"]["database"]["user"],$_SESSION["preferences"]["database"]["password"]);
  		$results = $db->query($sql);
		if ($db->affectedRows() > 0) 
		{
			WHILE ($row = $db->fetchAssoc($results)) 
			{
				$rtnanswer= $row[0]['description'];
		    } 
		}
		return $rtnanswer;
	}
	function messagesid($category) 
	{
		$sql = 'SELECT messageid  FROM messages WHERE (category = \''.$category.'\')';
                $db = new DBMS($_SESSION["preferences"]["database"]["type"],$_SESSION["preferences"]["database"]['server'],$_SESSION["preferences"]["database"]["dbname"] ,$_SESSION["preferences"]["database"]["user"],$_SESSION["preferences"]["database"]["password"]);
  		$results = $db->query($sql);
		if ($db->affectedRows() > 0) 
		{
			WHILE ($row = $db->fetchAssoc($results)) 
			{
				$rtnanswer= $row[0]['messageid'];
		    } 
		}
		return $rtnanswer;
	}
}
?>