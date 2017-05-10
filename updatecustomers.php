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
		$cID=$_POST['id'];
		$fname=$_POST['fname'];
		$lname=$_POST['lname'];
		$phone=$_POST['phone'];
		$street=$_POST['street'];
		$city=$_POST['city'];
		$state=$_POST['state'];
		$zip=$_POST['zip'];
		$bday=$_POST['bday'];
	
		
		$sql = "UPDATE customer SET `fname`='$fname',`lname`='$lname',`phone`='$phone',`street`='$street',
			`city`='$city',`state`='$state',`zip`='$zip',`bday`='$bday' WHERE `custID`='$cID' ";
					
		if ($con->query($sql) === TRUE) {
			echo "Customer updated successfully";
		} else {
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
				float: right;
				margin: 0 0 10px 10px;
			}
			.center 
			{
				
				
				margin-left: 15px;
				margin-top: -10px;
			}
			div.container 
			{
				width: 100%;
				
			}
			nav 
			{
				float: left;
				max-width: 200px;
				margin: 0;
				padding: 1em;
			}
			article 
			{
				float: left;
				margin-left: 20px;
				padding: 1em;
				overflow: hidden;
			}
		</style>
		<script>
			function mask(f)
			{  
				tel='';  
				var val =f.value.split('');  
				for(var i=0;i<val.length;i++)
				{  
					if(i==0)
					{
						val[i]=''+val[i]
					}  
					if(i==2)
					{
						val[i]=val[i]+'-'
					}
					if(i==5)
					{
						val[i]=val[i]+'-'
					}  
					tel=tel+val[i] 
				}  
				f.value=tel;  
			}  
		</script>
	</head>
	
	<body>
		<div class="container">
		<?PHP
			$cust = array();
			$sql = "SELECT * FROM customer";
			$qry = mysqli_query($con,$sql);
			while($res = mysqli_fetch_array($qry,MYSQLI_ASSOC)) 
			{
				$cust[$res['custID']] = $res['custID'];
			}
		?>
		<nav>
		<form method="post" action="<?php echo $_SERVER['PHP_SELF']; ?>">
			<select name="id">
				<option selected="selected">Select Customer ID# to Update</option>
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
			<p> First Name: <br /><input type="text" name="fname" required/></p>
			<p> Last Name: <br /><input type="text" name="lname" required/></p>
			<p> Phone Number: <br /><input type="text" name="phone" placeholder="xxxxxxxxxx" onblur="mask(this)" required/></p>
			<p> Street Address: <br /><input type="text" name="street" required/></p>
			<p> City: <br /><input type="text" name="city" required/></p>
			<p> State: <br /><input type="text" name="state" required/></p>
			<p> Zip Code: <br /><input type="text" name="zip" required/></p>
			<p> Birthday: <br /><input type="date" name="bday" required/></p>
	
			<p><input type="submit" class="button" name="submit" value="Submit"/></p>
			<p><input type="reset" class="button" value="Clear form"></p>
			<p><input type="button" class="button" onclick="location.href='viewcustomer.html';" value="Back" /></p>
			<p><input type="button" class="button" onclick="location.href='index.html';" value="Menu" /></p>
		</form>
		</nav>
		<article>
		<?php
			$sql = "SELECT * FROM customer";
			$qry = mysqli_query($con,$sql);
			echo "<div class='table'><table border='2' cellpadding='3' cellspacing='2'>
				<tr>
					<th>ID #</th>
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
					echo "<td>" . $row['custID'] . "</td>";
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
		</article>
		</div>
	</body>
</html>