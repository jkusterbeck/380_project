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
		$phone=$_POST['phonenumb'];
		$birth=$_POST['bday'];
		$sql = "DELETE FROM customer WHERE phone = '$phone' AND bday = '$birth'";			
		if ($con->query($sql) === TRUE) {
			echo "Customer removed successfully";
		} else {
			echo "Error: " . $sql . "<br>" . $conn->error;
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
			while($res = mysqli_fetch_array($qry,MYSQLI_ASSOC)) 
			{
				$cust[$res['phone']] = $res['phone'];
			}
		?>
		<h1>Remove Customer:</h1>
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
			<p>Birthday: <br /><input type="date" name="bday" required/></p>
			<p><input type="submit" class="button" name="submit" value="Submit"/></p>
			<p><input type="button" class="button" onclick="location.href='viewcustomer.html';" value="Back" />
			<input type="button" class="button" onclick="location.href='index.html';" value="Menu" /></p>
			</form>
			</div>
		<?PHP
			$con->close();
		?>
	</body>
</html>
