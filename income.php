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
				position: fixed;
				margin-left: 270px;
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
		<div class="center">
			<p><input type="button" class="button" onclick="location.href='servicepricing.html';" value="Back" /></p>
			<p><input type="button" class="button" onclick="location.href='index.html';" value="Menu" /></p>
		</div>
		<div class="table">
			<?php
				
				
					$sql = "SELECT service, COUNT(*), SUM(cost) FROM services GROUP BY service";
					$qry = mysqli_query($con,$sql);
			
					echo "<table border='2' align= 'center' cellpadding='3' cellspacing='2'>
					<tr>
						<th>Service</th>
						<th># Performed</th>
						<th>$ Made</th>
					</tr>";
					foreach($qry as $row)
					{  
						echo "<tr>";  
						echo "<td>" . $row['service'] . "</td>";  
						echo "<td align='center'>" . $row['COUNT(*)'] . "</td>";  
						echo "<td align='center'>" . $row['SUM(cost)'] . "</td>";  
						echo "</tr>";   
					}  
					echo "</table>";					
									
					$sql = "SELECT SUM(cost) AS value_sum FROM services";
					$result = $con->query($sql);

					if ($result->num_rows > 0) 
					{
						while($row = $result->fetch_assoc()) 
						{
							echo "<h3>Total amount made: $" . $row['value_sum'] . "</h3>";
						}
					} else {
						echo "0 results";
					}
				
			?>
		</div>	
		<?PHP
			$con->close();
		?>
	</body>
</html>