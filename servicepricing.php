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
				position: fixed;
				margin-left: 300px;
				margin-top: 75px;
			}
			.center 
			{
				position: fixed;
				top: 50%;	
				margin-left: 60px;
				margin-top: -50px;
			}
		</style>
	</head>
	
	<body>
		<div class="table">
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
		
			$sql = "SELECT * FROM pricelist GROUP BY service";
			$qry = mysqli_query($con,$sql);
			
			echo "<table border='2' align= 'center' cellpadding='3' cellspacing='2'>
				<tr>
					<th>Service</th>
					<th>Price</th>
				</tr>";

				while($row = mysqli_fetch_array($qry,MYSQLI_ASSOC))
				{
					echo "<tr>";
					echo "<td>" . $row['service'] . "</td>";
					echo "<td align='center'>$" . $row['price'] . "</td>";
					echo "</tr>";
				}
			echo "</table>";			
		
			echo "<br>";
		 
			
			mysqli_close($con);			
		?>
		</div>
		<div class="center">
		<p><input type="button" class="button" onclick="location.href='index.html';" value="Menu" /></p>
		<p><input type="button" class="button" onclick="location.href='servicepricing.html';" value="Back" /></p>
		</div>
	</body>
</html>