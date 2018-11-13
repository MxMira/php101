<?php require_once("DBConnectionANDredirect.php") ?>
<!DOCTYPE html>
<html>
<head>
	<title>Add new Post</title>
</head>
<body>
	<form style="width:10%;margin-left:40%;margin-top:5%" action="addPost.php" method="POST" enctype="multipart/form-data">
		<fieldset>
			<legend>Add Post</legend>
			*subject:<br><input style="margin:5px;" type="text" name="subject" placeholder="subject"><br>
			*body:<br><input style="margin:5px;" type="text" name="body" placeholder="body"><br>
			Tags (comma-separated):<br><input style="margin:5px;" type="text" name="tags" placeholder="tags"><br>
			image:<input style="margin:5px;" type="file" name="image"><br>
			<input style="width:100%;margin:5px;" type="submit" name="add" value="ADD Post"><br>
			<input style="width:100%;margin:5px;" type="submit" name="back" value="Go to Dashboard">
		</fieldset>
	</form><br>

</body>
</html>

<?php 

	
	
	if (isset($_POST["add"])) {

		$subject=mysql_real_escape_string($_POST["subject"]);
		$body=mysql_real_escape_string($_POST["body"]);
		$tags=mysql_real_escape_string($_POST["tags"]);
		$image=$_FILES["image"]["name"];
		$Target="Upload/".basename($_FILES["image"]["name"]);

		if (empty($subject)||empty($body)) {
			echo "<div Style='background-color:red;padding:5px;width:30%;color:white;margin-left:30%;text-align: center;'>Fill required fields</div>";
		}else{
			ADD($subject,$body,$tags,$image,$Target);
		}			
	}	

	function ADD($subject,$body,$tags,$image,$Target)
	{				
		global $connectDB;

		session_start();
		    $userID=$_SESSION['user_id'];
		    $userName=$_SESSION['user_name'];


		$Query="INSERT INTO content(subject,body,tags,user_id,image)
			    VALUES('$subject','$body','$tags','$userID','$image')";
    	$Execute=mysql_query($Query);
    	move_uploaded_file($_FILES["image"]["tmp_name"],$Target);

    	$Query="SELECT LAST_INSERT_ID() FROM content
    			WHERE subject='$subject' AND body='$body'";
    	$Execute=mysql_query($Query);
    	$content_id_array=mysql_fetch_assoc($Execute);
		$content_id=$content_id_array['LAST_INSERT_ID()'];

    	$Query="INSERT INTO user_content(user_id,content_id)
			    VALUES('$userID',$content_id)";
    	$Execute=mysql_query($Query);

    	if($Execute){
    		
    		echo "<div Style='background-color:green;padding:5px;width:30%;color:white;margin-left:30%;text-align: center;'>Post added Successfully</div>";

    	}else{
			echo "<div Style='background-color:red;padding:5px;width:30%;color:white;margin-left:30%;text-align: center;'>Failed to add Post</div>";
    	}
	}
	
	if (isset($_POST["back"])) {
		redirectTo("content.php");
	}

?>