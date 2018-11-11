<?php require_once("DBConnectionANDredirect.php") ?>
<!DOCTYPE html>
<html>
<head>
	<title>Sign Up Page</title>
</head>
<body>
	<form style="width:10%;margin-left:40%;margin-top:5%" action="signup.php" method="POST">
		<fieldset>
			<legend>Sign up</legend>
			*Username:<br><input style="margin:5px;" type="text" name="username" placeholder="username"><br>
			*Password:<br><input style="margin:5px;" type="password" name="password" placeholder="password"><br>
			<input style="width:100%;margin:5px;" type="submit" name="add" value="ADD User"><br>
			<input style="width:100%;margin:5px;" type="submit" name="back" value="Go back">
		</fieldset>
	</form><br>

</body>
</html>

<?php 
	
	if (isset($_POST["add"])) {

		$userName=mysql_real_escape_string($_POST["username"]);
		$password=mysql_real_escape_string($_POST["password"]);

		if (empty($userName)||empty($password)) {
			echo "<div Style='background-color:red;padding:5px;width:30%;color:white;margin-left:30%;text-align: center;'>Fill required fields</div>";
		}else{
			ADD($userName,$password);
		}			
	}	

	function ADD($userName,$password)
	{				
		global $connectDB;

		$Query="INSERT INTO user(name,password)
			    VALUES('$userName','$password')";
    	$Execute=mysql_query($Query);

    	if($Execute){
    		
    		echo "<div Style='background-color:green;padding:5px;width:30%;color:white;margin-left:30%;text-align: center;'>User added Successfully</div>";

    	}else{
			echo "<div Style='background-color:red;padding:5px;width:30%;color:white;margin-left:30%;text-align: center;'>Failed to add User</div>";
    	}
	}
	
	if (isset($_POST["back"])) {
		redirectTo("index.php");
	}

?>