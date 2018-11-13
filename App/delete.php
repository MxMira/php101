<?php require_once("DBConnectionANDredirect.php") ?>
<?php

	if(isset($_GET['id_delete'])){

		$id=$_GET['id_delete'];
		$subject=$_GET['subject'];
		$body=$_GET['body'];
		$tags=$_GET['tags'];
		$img=$_GET['img'];

		$ExpireTime=time()+(60*60);
		setcookie("id",$id,$ExpireTime);

	}else{
		$id='';
		$subject='';
		$body='';
		$tags='';
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
			subject:<?php echo " $id"?><br><hr>
			body:<?php echo " $subject"?><br><hr>
			tags:<br><?php echo " $tags"?><br><hr>
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
    		
    		echo "<div Style='background-color:green;padding:5px;width:30%;color:white;margin-left:30%;text-align: center;'>Post with id: ($id) deleted Successfully</div>";

    		$newid=0;
    		$Query="UPDATE content SET id=($newid:=$newid+1) ORDER BY id";
    		$Execute=mysql_query($Query);

    	}else{
			echo "<div Style='background-color:red;padding:5px;width:30%;color:white;margin-left:30%;text-align: center;'>Failed to delete Post</div>";
    	}
    	
	}
	
	if (isset($_POST["back"])) {
		redirectTo("content.php");
	}

?>