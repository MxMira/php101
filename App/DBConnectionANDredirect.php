<?php
	
	// database connection
	$Connection=mysql_connect('localhost','root','');
	$connectDB=mysql_select_db('cms',$Connection);

	// redirect function
	function redirectTo($location)
	{
		header("Location:".$location);
				exit;
	}

?>