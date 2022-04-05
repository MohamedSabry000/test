

<?php 

    // Open the file
    $filename = 'user.txt';
    $file = fopen($filename, 'r'); 

    // Add each line to an array
    if ($file) 
        $array = explode("\n", fread($file, filesize($filename)));
        
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

    <table>
        <colgroup>
            <col style="width: 150px" />
        </colgroup>
        <thead>
            <tr>
                <th>Name</th>
                <th>UserName</th>
                <th>Address</th>
            </tr>
        </thead>
        <tbody>
            <?php
                if (!empty($array)) {
                    foreach ($array as $key => $line) {
                        if($line != "") {
                            $user = explode(":", $line);
                            $encoded = json_encode($user);
                            echo "<tr>";
                            echo "<td>".$user[0]." ".$user[1]."</td>";
                            echo "<td>".$user[5]."</td>";
                            echo "<td>".$user[2]."</td>";
                            echo "<td> <a href='./viewuser.php?key=".$key."'>View</a> </td>";
                            echo "<td> <a href='./index.php?key=".$key."'>Edit</a> </td>";
                            echo "<td> <a href='./deleteuser.php?key=".$key."'>Delete</a> </td>";
                            echo "</tr>";
                        }
                    }
                }
            ?>
        </tbody>
    </table>
</body>
</html>