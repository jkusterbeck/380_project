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
		$fname=$_POST['fname'];
		$lname=$_POST['lname'];
		$phone=$_POST['phone'];
		$street=$_POST['street'];
		$city=$_POST['city'];
		$state=$_POST['state'];
		$zip=$_POST['zip'];
		$bday=$_POST['bday'];
		
		$sql = "INSERT INTO customer (fname,lname,phone,street,city,state,zip,bday)
			VALUES('$fname','$lname','$phone','$street','$city','$state','$zip','$bday')";
			
		if ($con->query($sql) === TRUE) {
			echo "New record created successfully";
		} else {
			echo "Error: " . $sql . "<br>" . $con->error;
		}	
	}
$con->close();	
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
		<h1>Add Customer:</h1>
		<form action="" method="post">
			<p> First Name: <br /><input type="text" name="fname" required/></p>
			<p> Last Name: <br /><input type="text" name="lname" required/></p>
			<p> Phone Number: <br /><input type="text" name="phone" placeholder="xxxxxxxxxx" onblur="mask(this)" required/></p>
			<p> Street Address: <br /><input type="text" name="street" required/></p>
			<p> City: <br /><input type="text" name="city" required/></p>
			<p> State: <br /><input type="text" name="state" required/></p>
			<p> Zip Code: <br /><input type="text" name="zip" required/></p>
			<p> Birthday: <br /><input type="date" name="bday" required/></p>
	
			<p><input type="submit" class="button" name="submit" value="Submit"/>
			<input type="reset" class="button" value="Clear form"></p>
			<p><input type="button" class="button" onclick="location.href='index.html';" value="Menu" /></p>
		</form>
		
		<p id = "err-message" style="color:red;">
			<?php
				if (isset($msg))
				{
					echo $msg;
				}
			?>
		</p>
	</body>
</html>
