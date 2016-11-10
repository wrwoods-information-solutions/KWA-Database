<?php

/*
 * PHP-Digital Clock
 * @author Angelos Staboulis
 * @town Komotini
 * @country Greece
 */
class DigitalClock {
    /**Print Digital Clock**/
    function jsDigitalClock($left,$top,$width=0,$height=0){
                    $div1='"div1"';
                    $proc='"printTime()"';
                    $style="margin-left:$left"."px;"."margin-top:$top"."px;margin-right:$width"."px;"."margin-bottom:$height"."px;";
                    echo "<div style=$style id=".$div1.">";
                    $retvalue="<script language=javascript>".
                           "var int=self.setInterval(".$proc.",1000);".   
                           "function printTime(){".
                           "var d=new Date();".
                           "var t=d.toLocaleTimeString();".
                           "document.getElementById(".$div1.").innerHTML=t;".
                           "}". 
                           "</script>";
                    echo $retvalue;
                    echo "</div>";     
    }
   
    /** Get Hours **/
    function getHours(){
      $hours=getdate();
      return $hours["hours"];
    }
    /** Get Minutes **/
    function getMinutes(){
      $minutes=getdate();
      return $minutes["minutes"];
        
    }
    /** Get Seconds **/
    function getSeconds(){
      $seconds=getdate();
      return $seconds["seconds"];
    }
}

?>
