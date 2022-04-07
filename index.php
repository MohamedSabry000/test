<?php

	$localkey = "";
	if (isset($_GET["key"])){
		
		$fieldsNeeded=array("fname", "lname", "address", "country", "gender", "username", "skills", "department");
		
		$data0=-1;
		$localkey=$_GET["key"];

		if($data0 == -1) {	
			if ($localkey){
				require "pdo/crud.php";
				$user = get_one_user($localkey)[0];

				if($user){
					$user->skills = explode(",", $user->skills);
				}					
			}
		}
	}

	if (isset($_GET["error"])){
		$error = json_decode($_GET["error"]);
	}
	if (isset($_GET["data"])){
		$data = json_decode($_GET["data"]);
	}
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
		<form action=<?php echo $localkey? "./editfile.php" : "./register.php" ?> method="post" enctype="multipart/form-data">
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
							<input type="text" id="first-name" size="42" value="<?php echo isset($user->fname) ? $user->fname : ""; ?>" name="fname" />
							<label class="error"><?php echo isset($error->fname) ? $error->fname : null ?></label>
						</td>
						
					</tr>
					<tr>
						<td class="right">
							<label for="last-name">Last Name</label>
						</td>
						<td colspan="3">
							<input type="text" id="last-name" size="42" value="<?php echo isset($user->lname) ? $user->lname : ""; ?>" name="lname" />
							<label class="error"><?php echo isset($error->lname) ? $error->lname : null ?></label>
						</td>
					</tr>
					<tr>
						<td class="right">
							<label for="address">Address</label>
						</td>
						<td colspan="3">
							<textarea id="address" cols="31" name="address" ><?php echo isset($user->address) ? $user->address : ""; ?></textarea>
							<label class="error"><?php echo isset($error->address) ? $error->address : null ?></label>
						</td>
					</tr>
					<tr>
						<td class="right">
							<label for="country">Country</label>
						</td>
						<td colspan="3">
							<select id="country" name="country">
								<option value="Egypt" <?php echo isset($user->country) && $user->country==="Egypt" ? "selected" : ""; ?>>Egypt</option>
								<option value="Australia" <?php echo isset($user->country) && $user->country==="Australia" ? "selected" : ""; ?>>Australia</option>
							</select>
							<label class="error"><?php echo isset($error->country) ? $error->country : null ?></label>
						</td>
					</tr>
					<tr>
						<td class="right">
							<label for="male">Gender</label>
						</td>
						<td colspan="3">
							<input type="radio" name="gender" id="male" value="male" <?php echo isset($user->gender) && $user->gender==="male" ? "checked" : ""; ?> />
							<label for="male">Male</label>
							<input type="radio" name="gender" id="female" value="female" <?php echo isset($user->gender) && $user->gender==="female" ? "checked" : ""; ?> />
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
									$checked = isset($user->skills) && in_array($value, $user->skills) ? "checked" : "";
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
							<input type="text" id="username" size="42" value="<?php echo isset($user->username) ? $user->username : ""; ?>" name="username" />
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
							<input type="text" id="department" size="42" value="<?php echo isset($user->department) ? $user->department : ""; ?>" name="department" placeholder="Open Source" />
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
					<tr>
						<td class="right">
							<label for="file">File</label>
						</td>
						<td>
							<input type="file" id="file" name="f1" /> image
							<label class="error"><?php echo isset($error->file) ? $error->file : null ?></label>
						</td>
						
					</tr>

				</tbody>
			</table>
		</form>
	</body>
</html>