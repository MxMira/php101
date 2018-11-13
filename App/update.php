<?php require_once("DBConnectionANDredirect.php") ?>

<?php

	if(isset($_GET['id_update'])){

		$id=$_GET['id_update'];
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
	<title>Update Post</title>
</head>
<body>
	<form style="width:10%;margin-left:40%;margin-top:5%" action="update.php" method="POST" enctype="multipart/form-data">
		<fieldset>
			<legend>Update Post</legend>
			*subject:<br><input style="margin:5px;" type="text" name="subject" value="<?php echo "$subject"?>"><br>
			*body:<br><input style="margin:5px;" type="text" name="body" value="<?php echo "$body"?>"><br>
			tags:<br><input style="margin:5px;" type="text" name="tags" value="<?php echo "$tags"?>"><br>
			image:<br><?php echo "<img src='Upload/$img' style='width:50px; height:50px;'>"?><br>
			<input style="margin:5px;" type="file" name="image"><br>
			<input style="width:100%;margin:5px;" type="submit" name="update" value="Update Post"><br>
			<input style="width:100%;margin:5px;" type="submit" name="back" value="Go to Dashboard">
		</fieldset>
	</form><br>

</body>
</html>

<?php 
	
	if (isset($_POST["update"])) {

		$subject=mysql_real_escape_string($_POST["subject"]);
		$body=mysql_real_escape_string($_POST["body"]);
		$tags=mysql_real_escape_string($_POST["tags"]);
		

		if (empty($subject)||empty($body)) {
			echo "<div Style='background-color:red;padding:5px;width:30%;color:white;margin-left:30%'>Fill required fields</div>";
		}else{

			if (isset($_FILES["image"])) {
				//print_r($_FILES["image"]);
				$image=$_FILES["image"]["name"];
				$Target="Upload/".basename($_FILES["image"]["name"]);
				update($subject,$body,$tags,$image,$Target);

			}else{

				$Target= false;
				$image= false;
				var_dump($tags);
				update($subject,$body,$tags,$image,$Target);
			}
			
		}			
	}	

	function update($subject,$body,$tags,$image,$Target)
	{				
		global $connectDB;

		session_start();
		    $userID=$_SESSION['user_id'];
		    $userName=$_SESSION['user_name'];
		    $id=$_COOKIE["id"];
		    //var_dump($image);
		if ($image) {

		    $Query="UPDATE content SET subject='$subject', body='$body', tags='$tags', image='$image' 
			WHERE id = $id";
    		$Execute=mysql_query($Query);

		}else{

			$Query="UPDATE content SET subject='$subject', body='$body', tags='$tags' 
			WHERE id = $id";
    		$Execute=mysql_query($Query);
		} 
   	
    	if ($Target) {

    		move_uploaded_file($_FILES["image"]["tmp_name"],$Target);
    	}
    	

    	if($Execute){
    		
    		echo "<div Style='background-color:green;padding:5px;width:30%;color:white;margin-left:30%;text-align: center;'>Post updated Successfully</div>";

    	}else{
			echo "<div Style='background-color:red;padding:5px;width:30%;color:white;margin-left:30%;text-align: center;'>Failed to update Post</div>";
    	}
	}
	
	if (isset($_POST["back"])) {
		redirectTo("content.php");
	}

?>