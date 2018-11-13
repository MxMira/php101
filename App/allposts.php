<?php require_once("DBConnectionANDredirect.php") ?>
<!DOCTYPE html>
<html>
<head>
	<title>all posts Page</title>

</head>
<body>
	<style type="text/css">
		th, td {
		    padding: 5px;
		}

		table th {
		    background-color: green;
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

			echo "<h1 style='margin-left:40%'>all posts</h1>";

    		global $connectDB;

    		// get count of contents
    		$arrayCount=array();
    		$QueryContent="SELECT count(*) FROM content";
		    $resourceContent=mysql_query($QueryContent);
		    $arrayCount[]=mysql_fetch_assoc($resourceContent);
		    $count=$arrayCount['0']['count(*)'];

		    $arrayContents=array();
    		while ($count){
			    $QueryContent="SELECT * FROM content WHERE id=$count";
			    $resourceContent=mysql_query($QueryContent);
			    $arrayContents[]=mysql_fetch_assoc($resourceContent);
			    $count--;
			}

	    		echo"<table style='margin-left:25%;width:50%;border-collapse: collapse;' border='1px solid black' >
	    				<tr>
							<th>Subject</th>
							<th>Body</th>
							<th>Tags</th>
							<th>Image</th>
						</tr>	
	    		    ";

	    		foreach ($arrayContents as $array) {
	    			echo "<tr>";					
	    				$subject=$array["subject"];
	    				$body=$array["body"];	    			 			
	    				$tags=$array["tags"];	    			 			
	    				$img=$array["image"];
	    				echo "
	    						<td>$subject</td>
	    						<td>$body</td>	    						
	    					    <td>$tags</td>
	    						<td><img src='Upload/$img' style='width:50px; height:50px;'></td>	    		     
	    					</tr>
	    					";
	    		}

	    		echo "</table>";

	?>	
</body>
</html>

