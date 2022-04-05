<?php

	$localkey = "";
	if (isset($_GET["key"])){
		
		$fieldsNeeded=array("fname", "lname", "address", "country", "gender", "username", "skills", "department");
		
		$data0=-1;
		$localkey=$_GET["key"];
		
		$filename = 'user.txt';
		$file = fopen($filename, 'r'); 

		if ($file) 
			$lines = explode("\n", fread($file, filesize($filename)));
		
		if (!empty($lines)) {
            foreach ($lines as $key => $line) {
					
                if($data0 == -1 && $line != "") {
						
					if ($key."" === $localkey){
						$data0 = explode(":", $line);
						foreach($fieldsNeeded as $key => $field){
							if(isset($data0[$key])){
								$data[$field] = $data0[$key];
							}
						}
						
						$sk = explode(",", $data0[8]);
						$data["skills"] = array();
						foreach($sk as $skill){
							array_push($data["skills"], $skill);
						}
						
					}

				}
			}
		}
		
		$data = json_encode($data);
		$data = json_decode($data);

		//exit();
	}

	if (isset($_GET["error"])){
		$error = json_decode($_GET["error"]);
	}
	if (isset($_GET["data"])){
		$data = json_decode($_GET["data"]);
	}
	// var_dump($data->fname);
	var_dump($localkey);
?>



<!DOCTYPE html>
<html>
	<head>
		<title> Web Form </title>
		<style>
			.right
			{
				text-align: right;
				font-weight: 700;
			}
			.bottom
			{
				text-align: center;
				background-color: #ADD8E6;
			}
			table
			{
				border-collapse: collapse;
				margin: 20px auto;
			}
			td
			{
				border: 1px solid black;
				padding: 5px;
			}
			.error
			{
				color: red;
			}
		</style>
	</head>
	<body>
		<form action=<?php echo $localkey? "./editfile.php" : "./register.php" ?> method="post">
			<input type="hidden" name="key" value="<?php echo $localkey; ?>" />
			<table>
				<colgroup>
					<col style="width: 150px" />
				</colgroup>
				<tfoot>
					<tr>
						<td class="bottom" colspan="4">
							<input type="submit" value="Submit" />
							<input type="reset" value="Reset" />
						</td>
					</tr>
				</tfoot>
				<tbody>
					<tr>
						<td class="right">
							<label for="first-name">First Name</label>
						</td>
						<td colspan="3">
							<input type="text" id="first-name" size="42" value="<?php echo isset($data->fname) ? $data->fname : ""; ?>" name="fname" />
							<label class="error"><?php echo isset($error->fname) ? $error->fname : null ?></label>
						</td>
						
					</tr>
					<tr>
						<td class="right">
							<label for="last-name">Last Name</label>
						</td>
						<td colspan="3">
							<input type="text" id="last-name" size="42" value="<?php echo isset($data->lname) ? $data->lname : ""; ?>" name="lname" />
							<label class="error"><?php echo isset($error->lname) ? $error->lname : null ?></label>
						</td>
					</tr>
					<tr>
						<td class="right">
							<label for="address">Address</label>
						</td>
						<td colspan="3">
							<textarea id="address" cols="31" name="address" ><?php echo isset($data->address) ? $data->address : ""; ?></textarea>
							<label class="error"><?php echo isset($error->address) ? $error->address : null ?></label>
						</td>
					</tr>
					<tr>
						<td class="right">
							<label for="country">Country</label>
						</td>
						<td colspan="3">
							<select id="country" name="country">
								<option value="Egypt" <?php echo isset($data->country) && $data->country==="Egypt" ? "selected" : ""; ?>>Egypt</option>
								<option value="Australia" <?php echo isset($data->country) && $data->country==="Australia" ? "selected" : ""; ?>>Australia</option>
							</select>
							<label class="error"><?php echo isset($error->country) ? $error->country : null ?></label>
						</td>
					</tr>
					<tr>
						<td class="right">
							<label for="male">Gender</label>
						</td>
						<td colspan="3">
							<input type="radio" name="gender" id="male" value="male" <?php echo isset($data->gender) && $data->gender==="male" ? "checked" : ""; ?> />
							<label for="male">Male</label>
							<input type="radio" name="gender" id="female" value="female" <?php echo isset($data->gender) && $data->gender==="female" ? "checked" : ""; ?> />
							<label for="female">Female</label>
							<br />
							<label class="error"><?php echo isset($error->gender) ? $error->gender : null ?></label>
						</td>
					</tr>
					<tr>
						<td class="right">
							<label for="skills">Skills</label>
						</td>
						<td colspan="3">
							<?php
								foreach (['php', 'js', 'mysql', 'postgressql'] as $value) {
									# code...
									$checked = isset($data->skills) && in_array($value, $data->skills) ? "checked" : "";
									echo 
									'<input type="checkbox" name="skills[]" id="'.$value.'" value="'.$value.'" '. $checked .' />
									 <label for="'.$value.'">'.$value.'</label>';
								}
							?>
						</td>
					</tr>
					<tr>
						<td class="right">
							<label for="username">User Name</label>
						</td>
						<td colspan="3">
							<input type="text" id="username" size="42" value="<?php echo isset($data->username) ? $data->username : ""; ?>" name="username" />
							<label class="error"><?php echo isset($error->username) ? $error->username : null ?></label>
						</td>
					</tr>
					<tr>
						<td class="right">
							<label for="password">Password</label>
						</td>
						<td colspan="3">
							<input type="password" id="password" size="42" value="" name="password" />
							<label class="error"><?php echo isset($error->password) ? $error->password : null ?></label>
						</td>
					</tr>
					<tr>
						<td class="right">
							<label for="department">Department</label>
						</td>
						<td colspan="3">
							<input type="text" id="department" size="42" value="<?php echo isset($data->department) ? $data->department : ""; ?>" name="department" placeholder="Open Source" />
							<label class="error"><?php echo isset($error->department) ? $error->department : null ?></label>
						</td>
					</tr>

					<tr>
						<td>
							<label for="confirm">123</label> <br />
							<input type="hidden"value="123" name="confirm" />
							<input type="text" id="confirm" size="42" value="" name="verify" />
							<label class="error"><?php echo isset($error->verify) ? $error->verify : null ?></label>
						</td>
						<td>
							Please Insert The Code Below Box
						</td>
					</tr>

				</tbody>
			</table>
		</form>
	</body>
</html>