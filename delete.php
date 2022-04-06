<?php

include('database connection.php');
include('function.php');

if(isset($_POST["people_id"]))
{
	$idGet = $_POST["people_id"];
	$query = "DELETE FROM data WHERE id = :id";
	$statement = $connection->prepare($query);
	$statement->bindValue(':id', $idGet , PDO::PARAM_INT);

	$result = $statement->execute();
		
}

?>