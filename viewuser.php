<?php

    session_start();
    if(!isset($_SESSION["id"])){
        header("Location: login.php");
        exit();
    }

  require "pdo/crud.php";

  $data=-1;
  if(isset($_GET["key"])){
      $data=$_GET["key"];
  }

  // $filename = 'user.txt';
  // $file = fopen($filename, 'r'); 

  // if ($file) 
  //     $lines = explode("\n", fread($file, filesize($filename)));
	
  $fields=array();

	if($data !== -1 && $data * -1 <= 0){
    $fields = get_one_user($data);
    if($fields) {
      $fields = $fields[0];
    }
    var_dump($fields);
    // if($user){

    // }
    // $fields = explode(":", $lines[$data]);
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
      <?php if(isset($fields) && isset($fields->id)){ ?>
        <tr>
          <td width="30%" align="right" valign="middle">First Name</td>
          <td width="70%" align="left" valign="middle"><input type="text" name="fname" value="<?php echo $fields->fname; ?>" /></td>
        </tr>
        <tr>
          <td align="right" valign="middle">Last Name</td>
          <td align="left" valign="middle"><input type="text" name="lname" value="<?php echo $fields->lname; ?>" /></td>
        </tr>
        <tr>
          <td align="right" valign="middle">Address</td>
          <td align="left" valign="middle"><input type="text" name="address" value="<?php echo $fields->address; ?>" /></td>
        </tr>
        <tr>
          <td align="right" valign="middle">Country</td>
          <td align="left" valign="middle"><input type="text" name="country" value="<?php echo $fields->country; ?>" /></td>
        </tr>
        <tr>
          <td align="right" valign="middle">Gender</td>
          <td align="left" valign="middle"><input type="text" name="gender" value="<?php echo $fields->gender; ?>" /></td>
        </tr>
        <tr>
          <td align="right" valign="middle">User Name</td>
          <td align="left" valign="middle"><input type="text" name="username" value="<?php echo $fields->username; ?>" /></td>
        </tr>
        <tr>
          <td align="right" valign="middle">Department</td>
          <td align="left" valign="middle"><input type="text" name="department" value="<?php echo $fields->department; ?>" /></td>
        </tr>
        <tr>
          <td align="right" valign="middle">Skills</td>
          <td align="left" valign="middle"><input type="text" name="skills" value="<?php echo $fields->skills; ?>" /></td>
        </tr>
        <?php if(isset($fields->image) && $fields->image != ""){ ?>
          <tr>
            <td align="right" valign="middle">Image</td>
            <td align="left" valign="middle"><img src="<?php echo $fields->image; ?>" width="250" height="250" /></td>
          </tr>
        <?php } ?>
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
