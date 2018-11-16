<?php require_once("DBConnectionANDredirect.php") ?>
<!DOCTYPE html>
<html>
<head>
	<title>Content Page</title>

</head>
<body>
	<style type="text/css">
		th, td {
		    padding: 5px;
		}

		table th {
		    background-color: black;
		    color: white;
		}

		.column {
		    float: left;
		    padding: 15px;
		    clear: left;
		}
	</style>
	<h3 class="column"><a href="content.php">Dashboard</a></h3>
	<h3 class="column"><a href="addPost.php">ADD new Post</a></h3>
	<h3 class="column"><a href="allposts.php">View all Posts</a></h3>
	<h3 class="column"><a href="index.php">Sign Out</a></h3>
	
		<?php 

			session_start();
		    $userID=$_SESSION['user_id'];
		    $userName=$_SESSION['user_name'];

			echo "<h2 style='margin-left:40%'>welcome $userName to your Dashboard</h2>";

    		global $connectDB;

			// get the content_id using the user_id
			$QueryContent_id="SELECT content_id FROM user_content
	    			WHERE user_id=$userID";
	    	$resourceContent_id=mysql_query($QueryContent_id);

	        $content_id=array();
		    while ($arrayContent_id=mysql_fetch_assoc($resourceContent_id)) {
		    	$content_id[]=$arrayContent_id['content_id'];
		    };

		    //echo "content_id".var_dump($content_id);
		    //echo "<hr>";

		    if($content_id){
		    	
		    	// get content using content_id
		    	$arrayContents=array();
		    	foreach ($content_id as $index=>$id) {
		    		$QueryContent="SELECT * FROM content
		    			WHERE id=$id";
		    		$resourceContent=mysql_query($QueryContent);
		    		$arrayContents[]=mysql_fetch_assoc($resourceContent);
		    	}
		    	
		    	//echo "arrayContents".print_r($arrayContents);
		    	//echo "<hr>";


		    	// get tag_id using content_id	
		    	$tagId=array();    	
		    	foreach ($arrayContents as $index => $array) {
		    		$id=$array['id'];
		    		$QueryTag_id="SELECT tag_id FROM content_tag
		    					WHERE content_id=$id";
		    		$resourceTag_id=mysql_query($QueryTag_id);
		    		while($arraytag_id=mysql_fetch_assoc($resourceTag_id)){
		    				$tagId[] = $arraytag_id['tag_id'];
		    		}
		    	}

		    	//echo "tagId".print_r($tagId);
		    	//echo "<hr>";

		    		
		    	// get tag_title using tag_id
		    	$tag=array();
		    	foreach($tagId as $index=>$id){
		    		$QueryTag="SELECT * FROM tag
		    			WHERE id=$id";
		    		$resourceTag=mysql_query($QueryTag);
		    		while ($arrayTag=mysql_fetch_assoc($resourceTag)){
		    			$tag[]=$arrayTag['title'];
		    		}
		    	}

		    	//echo "tag".print_r($tag);
		    	//echo "<hr>";


		    	//display the tags comma separated
		    	$tags ="";	    	
		    	for($i=0;$i<count($tag);$i++){    		
		    		if ($i==0) {
		    			$tags .=$tag[$i];
		    		}else{
		    			$tags .=",".$tag[$i];
		    		}
		    	}
	    	    	
	    		echo"<table style='margin-left:25%;width:50%;border-collapse: collapse;' border='1px solid black' >
	    				<tr>
							<th>ID</th>
							<th>Subject</th>
							<th>Body</th>
							<th>Tags</th>
							<th>Image</th>
							<th>Edit</th>
							<th>Delete</th>
						</tr>	
	    		    ";

	    		foreach ($arrayContents as $array) {
	    			echo "<tr>";					
	    				$id=$array["id"];
	    				$subject=$array["subject"];
	    				$body=$array["body"];	    			 			
	    				$tags=$array["tags"];	
	    				$tagArray=explode(",",$tags);    			 			
	    				$img=$array["image"];
	    				echo "
	    						<td>$id</td>
	    						<td>$subject</td>
	    						<td>$body</td>
	    					 ";	?>		

	    					    <td><?php 
	    					    	foreach ($tagArray as $value) {
	    					    		echo "<a href='youtube\\testyoutube.php?tag=$value'>$value</a>","  ";
	    					    	}
	    					    ?></td>

	    						<?php 
	    						echo"
	    						<td><img src='Upload/$img' style='width:50px; height:50px;'></td>
	    						<td><a href='update.php?id_update=$id&subject=$subject&body=$body&tags=$tags&img=$img'>update</a></td>
	    						<td><a href='delete.php?id_delete=$id&subject=$subject&body=$body&tags=$tags&img=$img'>delete</a></td>	    				      
	    					</tr>
	    					";
	    					
	    		}

	    		echo "</table>";

	    	}else{

				echo "<div Style='background-color:red;padding:5px;width:30%;color:white;margin-left:30%;text-align: center;'>you have no Content YET</div>";
	    	}

?>	
</body>
</html>

