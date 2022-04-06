<?php

function get_total_all_records()
{
	include('database connection.php');
	
	$statement = $connection->prepare("SELECT * FROM data");
	$statement->execute();
	return $statement->rowCount();
}

?>