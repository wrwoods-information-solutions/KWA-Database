<?php session_start(); ?>
<!DOCTYPE html>
<html>
    <head>
        <link href="style.css" rel="stylesheet" type="text/css">
        <meta charset="UTF-8">
        <title class="title">Backup/Restore</title>
        <?php
        require_once "class.preferences.php";
        if (!isset($_SESSION["preferences"])) {
            $_SESSION["preferences"]["database"]["type"] = "mysql";
            $_SESSION["preferences"]["database"]["server"] = "localhost";
            $_SESSION["preferences"]["database"]["dbname"] = "kwa";
            $_SESSION["preferences"]["database"]["user"] = "root";
            $_SESSION["preferences"]["database"]["password"] = "";
            $_SESSION["preferences"]["database"]["port"] = '';
            $_SESSION['preferences']['dateformat'] = 'Y-M-d';
        }
        $pref = new preferences;
        $pref->basicincludes();
        $pref->loadpreferences();
        $messages = new messages;
        if (!isset($_POST['fullbackup']))
        {    
            $_POST['fullbackup'] = 'NO';
            $_SESSION['backuprestore']['vfullbackup'] = 'NO';
        }    
        if (!isset($_POST['fullrestore']))
        {    
            $_POST['fullrestore'] = 'NO';
            $_SESSION['backuprestore']['vfullrestore'] = 'NO';
        }    
        if (!isset($_POST['controlsbackup']))
        {
            $_POST['controlsbackup'] = 'MO';
            $_SESSION['backuprestore']['vcontrolsbackup'] = 'NO';
        }    
        if (!isset($_POST['controlsrestore']))
        {
            $_POST['controlsrestore'] = 'NO';
            $_SESSION['backuprestore']['vcontrolsrestore'] = 'NO';
        }    
        if (!isset($_POST['databackup']))
        {
            $_POST['databackup'] = 'NO';
            $_SESSION['backuprestore']['vdatabackup'] = 'NO';
        }    
        if (!isset($_POST['datarestore']))
        {
            $_POST['datarestore'] = 'NO';
            $_SESSION['backuprestore']['vdatarestore'] = 'NO';
        }    
        if (!isset($_POST['backup']))
        {    
            $_POST['backup'] = ' ';
        }
        if (!isset($_POST['restore']))
        {    
            $_POST['restore'] = ' ';
        }
        if (!isset($_POST['archive']))
        {    
            $_POST['archive'] = ' ';
        }
        if (!isset($_POST['darchive']))
        {    
            $_POST['darchive'] = ' ';
        }
        if (!isset($_POST['atperson']))
        {
            $_POST['arperson'] = 'NO';
            $_SESSION['backuprestore']['varperson'] = 'NO';
        }    
        if (!isset($_POST['arorganization']))
        {
            $_POST['arorganization'] = 'NO';
            $_SESSION['backuprestore']['varorganization'] = 'NO';
        }    
        if (!isset($_POST['darperson']))
        {
            $_POST['darperson'] = 'NO';
            $_SESSION['backuprestore']['varperson'] = 'NO';
        }    
        if (!isset($_POST['darorganization']))
        {
            $_POST['darorganization'] = 'NO';
            $_SESSION['backuprestore']['vdarorganization'] = 'NO';
        }    
        if (!isset($_POST['arprogram']))
        {
            $_POST['arprogram'] = 'NO';
            $_SESSION['backuprestore']['varprogram'] = 'NO';
        }    
         if (!isset($_POST['darprogram']))
        {
            $_POST['darprogram'] = 'NO';
            $_SESSION['backuprestore']['vdarprogram'] = 'NO';
        }    
       if (!isset($_POST['arrequest']))
        {    
            $_POST['arrequest'] = 'NO';
            $_SESSION['backuprestore']['varrequest'] = 'NO';
        }    
        if (!isset($_POST['darrequest']))
        {    
            $_POST['darrequest'] = 'NO';
            $_SESSION['backuprestore']['vdarrequest'] = 'NO';
        }    
        if ($_POST['backup'] == 'Backup') 
        {
                if ($_POST['fullbackup']== 'YES') 
                {
                }
                if ($_POST['controlsbackup'] == 'YES') 
                {
                }
                if ($_POST['databackup'] == 'YES') 
                {
                }
       }
       if ($_POST['restore'] == 'Restore') 
       {
                if ($_POST['fullrestore'] == 'YES') 
                {
                }
                if ($_POST['controlsrestore'] == 'YES') 
                {
                }
                if ($_POST['datarestore'] == 'YES') 
                {
                }
       }        
       if ($_POST['archive'] == 'Archive') 
       {
       }       
       if ($_POST['darchive'] == 'De-Archive') 
       {
       }       
        ?>
    </head>
    <body>
        <?PHP
            $pref->header('Backup/Restore');
        ?>
        <table class="tbl" width="100%">
            <tr>
                <td>
                     <?PHP
                     $pref->loadmenu();
                    ?>
                </td>
              </tr>
        </table>    
        <form id="backuprestore" name="bakuprestore"  action="backuprestore.php" method="post" enctype="multipart/form-data" >    
           <table border="0" cellpadding="0" cellspacing="0" width="100%">
               <tr>
                    <td></td>
                    <td align="center" class="subtitle" >BACKUP</td>
                    <td align="center" class="subtitle" >RESTORE</td>
                    <td align="center" class="subtitle" >ARCHIVE</td>
                    <td align="center" class="subtitle" >DE-ARCHIVE</td>
               </tr>
               <tr>
                    <td class="subtitle" align="left">File</td> 
                    <td><input name="backupfile" value="<?php echo 'KWA Back-' . Date($_SESSION['preferences']['dateformat']); ?>" type="text" class="body" size="20" /></td>
                    <td><input name="body" type="file" class="body" accept="*.sql" ></td>
               </tr>	
               <tr>
                    <td></td>
                    <td><input type= "checkbox" value="<?PHP  $_SESSION['backuprestore']['vfullbackup'] ?>"  name="fullbackup"  />      
                         <span class="subtitle">Full Backup</span></td>
                    <td><input type= "checkbox" value="<?PHP  $_SESSION['backuprestore']['vfullrestore'] ?>"  name="fullrestore"   />      
                        <span class="subtitle">Full Restore</span></td>
                    <td></td>
                    <td></td>
                </tr>	
                <tr>
                     <td class="subtitle">Controls</td>
                    <td><input type= "checkbox" value="<?PHP  $_SESSION['backuprestore']['vcontrolsbackup'] ?>"  name="controlsbackup"   />      
                        <span class="subtitle">Controls Backup</span></td>
                    <td><input type= "checkbox" value="<?PHP  $_SESSION['backuprestore']['vcontrolsrestore'] ?>"  name="controlsrestore"   />      
                        <span class="subtitle">Controls Restore</span></td>
                </tr>	
                <tr>
                    <td class="body">codes</td>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td></td>
                </tr>	
                <tr>
                    <td class="body">log</td>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td></td>
                </tr>	
                <tr>
                    <td class="body">login</td>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td></td>
                </tr>	
                <tr>
                    <td class="body">mastermenu</td>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td></td>
                </tr>	
                <tr>
                    <td class="body">menulanguage</td>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td></td>
                </tr>	
                <tr>
                    <td class="body">usermenu</td>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td></td>
                </tr>    
                <tr>
                    <td class="body">stdusermemu</td>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td></td>
                </tr>	
                <tr>
                    <td class="body">message</td>
                    <td></td>
                    <td></td>
                </tr>	
                <tr>
                    <td class="body">preferences</td>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td></td>
                </tr>    
                <tr>
                    <td class="subtitle">Data</td>
                    <td><input type= "checkbox" value="<?PHP  $_SESSION['backuprestore']['vcontrolsbackup'] ?>" name="controlsbackup"   />      
                        <span class="subtitle">Data Backup</span></td>
                    <td><input type= "checkbox" value="<?PHP  $_SESSION['backuprestore']['vcontrolsrestore'] ?>" name="controlsrestore"   />      
                        <span class="subtitle">Data Restore</span></td>
                </tr>	
                <tr>
                    <td class="body">person</td>
                    <td></td>
                    <td></td>
                    <td align="center" ><input type= "checkbox" value="<?PHP  $_SESSION['backuprestore']['varperson'] ?>" name="arerson"   /></td>
                    <td align="center" ><input type= "checkbox" value="<?PHP  $_SESSION['backuprestore']['vdarperson'] ?>" name="darperson"   /></td>
                </tr>	
                <tr>
                   <td class="body">organization</td>
                   <td></td>
                   <td></td>
                   <td align="center" ><input type= "checkbox" value="<?PHP  $_SESSION['backuprestore']['varorganization'] ?>" name="arorganization"   /></td>
                   <td align="center" ><input type= "checkbox" value="<?PHP  $_SESSION['backuprestore']['vdarorganization'] ?>" name="darorganization"   /></td>
                </tr>	
                <tr>
                    <td class="body">address</td>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td></td>
                </tr>	
                <tr>
                    <td class="body">email</td>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td></td>
                </tr>	
                <tr>
                    <td class="body">telephone</td>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td></td>
                </tr>	
                <tr>
                    <td class="body">status</td>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td></td>
              </tr>    
                <tr>
                    <td class="body">mobiltyaid</td>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td></td>
                </tr>	
                <tr>
                    <td class="body">notes</td>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td></td>
                </tr>	
                <tr>
                    <td class="body">relationship</td>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td></td>
                </tr>    
                <tr>
                    <td class="body">program</td>
                    <td></td>
                    <td></td>
                    <td align="center" ><input type= "checkbox" value="<?PHP  $_SESSION['backuprestore']['varprogram'] ?>" name="arprogram"   /></td>
                    <td align="center" ><input type= "checkbox" value="<?PHP  $_SESSION['backuprestore']['vdarprogram'] ?>" name="darprogram"   /></td>
                </tr>	
                <tr>
                    <td class="body">programlocation</td>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td></td>
               </tr>	
                <tr>
                    <td class="body">programresponsible</td>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td></td>
                </tr>	
                <tr>
                    <td class="body">programsetup</td>
                    <td></td>
                    <td></td>
                     <td></td>
                    <td></td>
               </tr>	
                <tr>
                    <td class="body">programmeasure</td>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td></td>
                </tr>	
                <tr>
                    <td class="body">programobjective</td>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td></td>
                </tr>    
                <tr>
                    <td class="body">refreshments</td>
                    <td></td>
                    <td></td>
                </tr>	
                <tr>
                    <td class="body">equipsuply</td>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td></td>
                </tr>	
                <tr>
                    <td class="body">request</td>
                    <td></td>
                    <td></td>
                    <td align="center" ><input type= "checkbox" value="<?PHP  $_SESSION['backuprestore']['varrequest'] ?>" name="arrequest"   /></td>
                    <td align="center" ><input type= "checkbox" value="<?PHP  $_SESSION['backuprestore']['vdarrequest'] ?>" name="darrequest"   /></td>
                </tr>    
                <tr>
                    <td class="body">requestservicecode</td>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td></td>
                </tr>	
                <tr>
                    <td class="body">servicecode</td>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td></td>
                </tr>    
                <tr>
                    <td></td>
                    <td align="center"><input name="backup" type='submit' value="Backup" /></td>
                    <td align="center"><input name="restore" type='submit' value="Restore" /></td>
                    <td align="center"><input name="archive" type='submit' value="Archive" /></td>
                    <td align="center"><input name="dearchive" type='submit' value="De-Archive" /></td>
                </tr>
            </table>
       </form>       
    </body>
</html>   