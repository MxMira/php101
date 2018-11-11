<?php require_once("DBConnectionANDredirect.php") ?>
<!DOCTYPE html>
<html>
<head>
	<title>Login Page</title>
</head>
<body>
	<form style="width:10%;margin-left:40%;margin-top:5%" action="index.php" method="POST">
		<fieldset>
			<legend>Login</legend>
			*Username:<br><input style="margin:5px;" type="text" name="username" placeholder="username"><br>
			*Password:<br><input style="margin:5px;" type="password" name="password" placeholder="password"><br>
			<input style="width:100%;margin:5px;" type="submit" name="signin" value="Login"><br>
			<input style="width:100%;margin:5px;" type="submit" name="signUp" value="New User">
		</fieldset>
	</form><br>

</body>
</html>

<?php 

	session_start();
	
	if (isset($_POST["signin"])) {

		$userName=mysql_real_escape_string($_POST["username"]);
		$password=mysql_real_escape_string($_POST["password"]);

		if (empty($userName)||empty($password)) {
			echo "<div Style='background-color:red;padding:5px;width:30%;color:white;margin-left:30%;text-align: center;'>Fill required fields</div>";
		}else{
			$logged=loginAttempt($userName,$password);
		}			
	}	

	function loginAttempt($userName,$password)
	{				
		global $connectDB;

		$Query="SELECT * FROM user
    			WHERE name='$userName' AND password='$password'";
    	$Execute=mysql_query($Query);

    	if($admin=mysql_fetch_assoc($Execute)){

    	//saving user_id in a session to use it in next page
    		$userID=$admin['id'];
    		$_SESSION['user_id'] = $userID;
    		$userName=$admin['name'];
    		$_SESSION['user_name'] = $userName;
    		
			redirectTo("content.php");
    	}else{
			echo "<div Style='background-color:red;padding:5px;width:30%;color:white;margin-left:30%;text-align: center;'>not registered in database</div>";
    	}
	}

	if (isset($_POST["signUp"])) {
		redirectTo("signup.php");
	}
	
?>