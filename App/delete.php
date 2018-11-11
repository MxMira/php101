<?php require_once("DBConnectionANDredirect.php") ?>
<?php

	if(isset($_GET['id_delete'])){

		$id=$_GET['id_delete'];
		$subject=$_GET['subject'];
		$body=$_GET['body'];
		$img=$_GET['img'];

		$ExpireTime=time()+80000;
		setcookie("id",$id,$ExpireTime);

	}else{
		$id='';
		$subject='';
		$body='';
		$img='';
	}


?>
<!DOCTYPE html>
<html>
<head>
	<title>Delete Post</title>
</head>
<body>
	<form style="width:10%;margin-left:40%;margin-top:5%" action="delete.php" method="POST">
		<fieldset>
			<legend>Delete Post</legend>
			subject:<?php echo " $id"?><br>
			body:<?php echo " $subject"?><br>
			image:<br><?php echo "<img src='Upload/$img' style='width:50px; height:50px;'>"?><br>
			<input style="width:100%;margin:5px;" type="submit" name="delete" value="Delete Post"><br>
			<input style="width:100%;margin:5px;" type="submit" name="back" value="Go to Dashboard">
		</fieldset>
	</form><br>

</body>
</html>

<?php 
	
	if (isset($_POST["delete"])) {

		Delete($_COOKIE["id"]);			
	}	

	function Delete($id)
	{				
		global $connectDB;

		$Query="DELETE FROM content WHERE id=$id";
    	$Execute=mysql_query($Query);

    	if($Execute){
    		
    		echo "<div Style='background-color:green;padding:5px;width:30%;color:white;margin-left:30%;text-align: center;'>Post with ID: ($id) deleted Successfully</div>";

    	}else{
			echo "<div Style='background-color:red;padding:5px;width:30%;color:white;margin-left:30%;text-align: center;'>Failed to delete Post</div>";
    	}
    	
	}
	
	if (isset($_POST["back"])) {
		redirectTo("content.php");
	}

?>