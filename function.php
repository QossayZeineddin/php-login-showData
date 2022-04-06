<?php

function get_total_all_records()
{
	include('databaseConnection.php');
	
	$statement = $connection->prepare("SELECT * FROM data");
	$statement->execute();
	return $statement->rowCount();
}

?>