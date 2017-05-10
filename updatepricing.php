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
	
	if(isset($_POST['submit']))
	{
		$service=$_POST['service'];
		$price=$_POST['price'];
		
		$sql = "UPDATE `pricelist` SET `price`='$price' WHERE `service` = '$service'";
					
		if (!$con->query($sql) === TRUE) {
			echo "Error: " . $sql . "<br>" . $con->error;
		}	
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
				margin-left: 370px;
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
			$list = array();
			$sql = "SELECT * FROM pricelist";
			$qry = mysqli_query($con,$sql);
			while($res = mysqli_fetch_array($qry,MYSQLI_ASSOC)) 
			{
				$list[$res['service']] = $res['service'];
			}
		?>
		<h1>Update Pricing:</h1>
		<form method="post" action="<?php echo $_SERVER['PHP_SELF']; ?>">
			<select name="service">
				<option selected="selected">Select Service to Update Price</option>
				<optgroup>
					<?php
						foreach($list as $number){
					?>
				<option value="<?php echo $number; ?>"><?php echo $number; ?></option>
					<?php
						}
					?>
				</optgroup>
			</select>
			<p>Price: <br /><input type="text" name="price" required/></p>
			<p><input type="submit" class="button" name="submit" value="Submit"/></p>
			<p><input type="button" class="button" onclick="location.href='servicepricing.html';" value="Back" />
			<input type="button" class="button" onclick="location.href='index.html';" value="Menu" /></p>
			</form>
			</div>
		<div class="table">
			<?php
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
							echo "<td>$" . $row['price'] . "</td>";
							echo "</tr>";
						}
					echo "</table>";
			?>
		</div>	
		<?PHP
			$con->close();
		?>
	</body>
</html>
