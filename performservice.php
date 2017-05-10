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
			.container 
			{
				width: 80%;
				height: 200px;
				margin: auto;
				padding: 10px;
			}
			.table
			{
				float: left;
				top: 25%;
				//margin-left: 200px;
				margin-top: 40px;
			}
			.center 
			{
				float: left;
				width: 30%;
				top: 35%;	
				//margin-left: 60px;
				margin-top: 50px;
			}
			.tab
			{
				margin-left: 60px;
			}
		</style>
		
	</head>
	
	<body>
		<section class="container">
		<div class="center">
		<h1>Services Performed:</h1>
		<br>
		<?PHP
			$cust = array();
			$sql = "SELECT * FROM customer";
			$qry = mysqli_query($con,$sql);
			while($res = mysqli_fetch_array($qry,MYSQLI_ASSOC)) 
			{
				$cust[$res['phone']] = $res['phone'];
			}
			$serv = array();
			$sql = "SELECT * FROM pricelist where service != 'Travel' && service !='Vivid colors'";
			$qry = mysqli_query($con,$sql);
			while($res = mysqli_fetch_array($qry,MYSQLI_ASSOC)) 
			{
				$serv[$res['service']] = $res['service'];
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
			<p>Date Performed: <input type="date" name="date" required/></p>
			<select name="servtype">
				<option selected="selected">Select Service Performed</option>
				<optgroup>
					<?php
						foreach($serv as $number){
					?>
				<option value="<?php echo $number; ?>"><?php echo $number; ?></option>
					<?php
						}
					?>
				</optgroup>
			</select>
			<p><h2>Add-on Services</h2></p>
			<div class="tab">
			<input type="hidden" name="olaplex" value="No" />
			<input type="hidden" name="makeup" value="No" />
			<input type="hidden" name="travel" value="No" />
			<input type="hidden" name="vivid" value="No" />
			<p><input type="checkbox" name="olaplex" value="Yes" />Olaplex</p>
			<p><input type="checkbox" name="vivid" value="Yes" />Vivid Colors</p>
			<p><input type="checkbox" name="makeup" value="Yes" />Professional Makeup</p>
			<p><input type="checkbox" name="travel" value="Yes" />Travel</p>
			</div>
			<p><input type="submit" class="button" name="submit" value="Submit"/></p>
			<input type="button" class="button" onclick="location.href='index.html';" value="Menu" /></p>
			</form>
			</div>
		<div class="table">
			<?php 
				if(isset($_POST['submit']))
				{
					$phone=$_POST['phonenumb'];
					$servtype=$_POST['servtype'];
					$olaplex=$_POST['olaplex'];
					$vivid=$_POST['vivid'];
					$makeup=$_POST['makeup'];
					$travel=$_POST['travel'];
					$date=$_POST['date'];
					
					$sql = "INSERT INTO services (custID,service,serviceDate)
						VALUES('$phone','$servtype','$date')";
					if (!$con->query($sql) === TRUE) {
						echo "Error: " . $sql . "<br>" . $con->error;
					}
					
					if ($olaplex == 'Yes')
					{
						$sql = "INSERT INTO services (custID,service,serviceDate)
							VALUES('$phone','Olaplex','$date')";
						if (!$con->query($sql) === TRUE) {
							echo "Error: " . $sql . "<br>" . $con->error;
						}
					}

					if ($vivid == 'Yes')
					{
						$sql = "INSERT INTO services (custID,service,serviceDate)
							VALUES('$phone','Vivid colors','$date')";
						if (!$con->query($sql) === TRUE) {
							echo "Error: " . $sql . "<br>" . $con->error;
						}
					}
					
					if ($makeup == 'Yes')
					{
						$sql = "INSERT INTO services (custID,service,serviceDate)
							VALUES('$phone','Professional makeup','$date')";
						if (!$con->query($sql) === TRUE) {
							echo "Error: " . $sql . "<br>" . $con->error;
						}
					}
					
					if ($travel == 'Yes')
					{
						$sql = "INSERT INTO services (custID,service,serviceDate)
							VALUES('$phone','Travel','$date')";
						if (!$con->query($sql) === TRUE) {
							echo "Error: " . $sql . "<br>" . $con->error;
						}
					}
					
					$sql = "UPDATE services INNER JOIN pricelist SET cost = pricelist.price WHERE services.service = pricelist.service";
					
					if (!$con->query($sql) === TRUE) {
						echo "Error: " . $sql . "<br>" . $con->error;
					}
								
					$sql = "SELECT * FROM `services` WHERE custID = '$phone' && serviceDate = '$date'";
					
					if (!$con->query($sql) === TRUE) {
					echo "Error: " . $sql . "<br>" . $con->error;
					}		
				
					$qry = mysqli_query($con,$sql);
					echo "<table border='2' align= 'center' cellpadding='3' cellspacing='2'>
					<tr>
						<th>ID</th>
						<th>Service</th>
						<th>Cost</th>
					</tr>";

					while($row = mysqli_fetch_array($qry,MYSQLI_ASSOC))
					{
						echo "<tr>";
						echo "<td>" . $row['custID'] . "</td>";
						echo "<td>" . $row['service'] . "</td>";
						echo "<td>" . $row['cost'] . "</td>";
						echo "</tr>";
					}
					echo "</table>";
										
					$sql = "SELECT SUM(cost) AS value_sum FROM services WHERE custID = '$phone' && serviceDate = '$date'";
					$result = $con->query($sql);

					if ($result->num_rows > 0) 
					{
						while($row = $result->fetch_assoc()) 
						{
							echo "<h3>Total amount due: $" . $row['value_sum'] . "</h3>";
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
		</section>
	</body>
</html>
