<?php

  $data=-1;
  if(isset($_GET["key"])){
      $data=$_GET["key"];
  }

  $filename = 'user.txt';
  $file = fopen($filename, 'r'); 

  if ($file) 
      $lines = explode("\n", fread($file, filesize($filename)));
	
  $fields=array();

	if($data !== -1 && $data * -1 <= 0){
    $fields = explode(":", $lines[$data]);
  }	


?>


<!DOCTYPE html>
<html>
  <head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <title>View User</title>
    <link rel="stylesheet" type="text/css" href="style.css" />
  </head>
  <body>
    
    <table width="100%" border="0" cellspacing="0" cellpadding="10">
      <tr>
        <td colspan="2" align="center" valign="middle"><h1>View User</h1></td>
      </tr>
      <?php if(isset($fields) && isset($fields[0]) &&  $fields[0] != ""){ ?>
        <tr>
          <td width="30%" align="right" valign="middle">First Name</td>
          <td width="70%" align="left" valign="middle"><input type="text" name="fname" value="<?php echo $fields[0]; ?>" /></td>
        </tr>
        <tr>
          <td align="right" valign="middle">Last Name</td>
          <td align="left" valign="middle"><input type="text" name="lname" value="<?php echo $fields[1]; ?>" /></td>
        </tr>
        <tr>
          <td align="right" valign="middle">Address</td>
          <td align="left" valign="middle"><input type="text" name="address" value="<?php echo $fields[2]; ?>" /></td>
        </tr>
        <tr>
          <td align="right" valign="middle">Country</td>
          <td align="left" valign="middle"><input type="text" name="country" value="<?php echo $fields[3]; ?>" /></td>
        </tr>
        <tr>
          <td align="right" valign="middle">Gender</td>
          <td align="left" valign="middle"><input type="text" name="country" value="<?php echo $fields[4]; ?>" /></td>
        </tr>
        <tr>
          <td align="right" valign="middle">User Name</td>
          <td align="left" valign="middle"><input type="text" name="country" value="<?php echo $fields[5]; ?>" /></td>
        </tr>
        <tr>
          <td align="right" valign="middle">Department</td>
          <td align="left" valign="middle"><input type="text" name="country" value="<?php echo $fields[7]; ?>" /></td>
        </tr>
        <tr>
          <td align="right" valign="middle">Skills</td>
          <td align="left" valign="middle"><input type="text" name="country" value="<?php echo $fields[8]; ?>" /></td>
        </tr>
        <tr>
          <td align="right" valign="middle"></td>
        </tr>
      <?php } else { ?>
        <tr>
          <td colspan="2" align="center" valign="middle">No data found</td>
        </tr>
      <?php } ?>
    </table>
  </body>
</html>
