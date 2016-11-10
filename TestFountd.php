  <?php
// open the current directory

$dhandle = opendir('c:/windows/fonts/');
// define an array to hold the files
$files = array();

if ($dhandle) {
   // loop through all of the files
   while (false !== ($fname = readdir($dhandle))) {
      // if the file is not this file, and does not start with a '.' or '..',
      // then store it for later display
      if (($fname != '.') && ($fname != '..') &&
          ($fname != basename($_SERVER['PHP_SELF']))) {
          // store the filename
          $files[] = (is_dir( "./$fname" )) ? "(Dir) {$fname}" : $fname;
      }
   }
   // close the directory
  closedir($dhandle);
}
echo "<select namme=\"fonts\">\n";
echo "<option name=\"tops\" value=\"\">Select Font</option>\n";
// Now loop through the files, echoing out a new select option for each one
foreach( $files as $fname )
 {
  echo "<option value=$fname STYLE=\"font-family: {$fname};src: local(\'explode (\'$files\')\');font-size : 14pt;\">$fname</option>\n";
 }
 echo "</select>\n";
?>
