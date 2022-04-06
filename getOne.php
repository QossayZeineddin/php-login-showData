<?php
include('databaseConnection.php');
include('function.php');
if(isset($_POST["people_id"]))
{
	$idGet = $_POST["people_id"];
	//******************/
	$query = "SELECT * FROM data WHERE id= :id";
	//******************/
	if($statement = $connection->prepare($query)){
		$statement->bindValue(':id', $idGet , PDO::PARAM_INT);
		$statement->execute();
		$result = $statement->fetchAll();
		foreach($result as $row)
		{
			$output["id"] = $row["id"];
			$output["names"] = $row["names"];
			$output["emails"] = $row["emails"];				
			$output["numbers"] = $row["numbers"];
			$output["message"] = $row["message"];
		}
	
	}
	echo json_encode($output);
}
?>