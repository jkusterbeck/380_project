<?php
	$host='198.91.81.6';
	$username='jkusterb_john';
	$password='Brandy1216';
	$dbname='jkusterb_glamourholics';	
	$con = mysqli_connect($host, $username, $password, $dbname);

	if (!$con) 
	{
		echo "Error: Unable to connect to MySQL." . PHP_EOL;
		echo "Debugging errno: " . mysqli_connect_errno() . PHP_EOL;
		echo "Debugging error: " . mysqli_connect_error() . PHP_EOL;
		exit;
	}
?>
<!DOCTYPE html>
<html>
	<head>
		<meta charset = "utf-8">
		<META HTTP-EQUIV="Pragma" CONTENT="no-cache">
		<META HTTP-EQUIV="Expires" CONTENT="-1">
		<title>Glamourholic's</title>
		<style>
			.button 
			{
				background-color: #324B43;
				border: none;
				color: white;
				padding: 15px 32px;
				text-align: center;
				text-decoration: none;
				display: inline-block;
				font-size: 16px;
				margin: 4px 2px;
				cursor: pointer;
			}
			body
			{
				background: #000 url("background.jpg");
				background-repeat: no-repeat;
				background-size: 100%;
				color: #FEE9ED;
			}
			.table
			{
				position: float;
				margin-left: 75px;
				margin-top: 35px;
			}
			.center 
			{
				position: fixed;
				top: 50%;	
				margin-left: 15px;
				margin-top: -50px;
			}
		</style>
	</head>
	
	<body>
		<div class="center">
		<input type="button" class="button" onclick="location.href='index.html';" value="Menu" />
		<p><input type="button" class="button" onclick="location.href='viewcustomer.html';" value="Back" /></p>
		</div>
		<div class="table">
		<?php
			$sql = "SELECT * FROM customer";
			$qry = mysqli_query($con,$sql);
			echo "<div class='table'><table border='2' cellpadding='3' cellspacing='2'>
				<tr>
					<th>First Name</th>
					<th>Last Name</th>
					<th>Phone Number</th>
					<th>Street Address</th>
					<th>City</th>
					<th>State</th>
					<th>Zip</th>
					<th>Birthday</th>
				</tr>";

				while($row = mysqli_fetch_array($qry,MYSQLI_ASSOC))
				{
					echo "<tr>";
					echo "<td>" . $row['fname'] . "</td>";
					echo "<td>" . $row['lname'] . "</td>";
					echo "<td>" . $row['phone'] . "</td>";
					echo "<td>" . $row['street'] . "</td>";
					echo "<td>" . $row['city'] . "</td>";
					echo "<td>" . $row['state'] . "</td>";
					echo "<td>" . $row['zip'] . "</td>";
					echo "<td>" . $row['bday'] . "</td>";
					echo "</tr>";
				}
			echo "</table>";			
		
			echo "<br>";
		 
			
			mysqli_close($con);			
		?>
		</div>
	</body>
</html>