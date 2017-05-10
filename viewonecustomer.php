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
		<?PHP
			$cust = array();
			$sql = "SELECT * FROM customer";
			$qry = mysqli_query($con,$sql);
			while($result = mysqli_fetch_array($qry,MYSQLI_ASSOC)) 
			{
				$cust[$result['phone']] = $result['phone'];
			}
		?>
		<form method="post" action="<?php echo $_SERVER['PHP_SELF']; ?>">
			<select name="phonenumb">
				<option selected="selected">Select Customer Phone Number</option>
				<optgroup>
					<?php
						foreach($cust as $number){
					?>
				<option value="<?php echo $number; ?>"><?php echo $number; ?></option>
					<?php
						}
					?>
				</optgroup>
			</select>
			<p><input type="submit" class="button" name="submit" value="Submit"/></p>
			<p><input type="button" class="button" onclick="location.href='viewcustomer.html';" value="Back" />
			<input type="button" class="button" onclick="location.href='index.html';" value="Menu" /></p>
			</form>
			</div>
		<div class="table">
			<?php
				if(isset($_POST['submit']))
				{
					$phone=$_POST['phonenumb'];
					$sql = "SELECT * FROM `customer` WHERE `phone` = '$phone'";
					
					if (!$con->query($sql) === TRUE) {
					echo "Error: " . $sql . "<br>" . $con->error;
					}		
				
				
					$qry = mysqli_query($con,$sql);
					echo "<table border='2' align= 'center' cellpadding='3' cellspacing='2'>
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
				
					$sql = "SELECT SUM(cost) AS value_sum FROM services WHERE custID = '$phone'";
					$result = $con->query($sql);

					if ($result->num_rows > 0) 
					{
						while($row = $result->fetch_assoc()) 
						{
							echo "<h3>Total amount spent: $" . $row['value_sum'] . "</h3>";
						}
					} else {
						echo "0 results";
					}
				}
			?>
		</div>	
		<?PHP
			$con->close();
		?>
	</body>
</html>