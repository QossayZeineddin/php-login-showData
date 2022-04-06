<?php
include('databaseConnection.php');
include('function.php');
?>

<
<?php
if(isset($_POST["operation"]))
{
	if($_POST["operation"] == "Add")
	{
		$query = "INSERT INTO data (names, numbers, emails ,message) VALUES (:names, :numbers, :emails ,:message)";
		$statement = $connection->prepare($query);
		$statement->bindValue(':names', $_POST["names"] , PDO::PARAM_STR);
		$statement->bindValue(':numbers', $_POST["numbers"] , PDO::PARAM_INT);
		$statement->bindValue(':emails', $_POST["emails"] , PDO::PARAM_STR);
		$statement->bindValue(':message', $_POST["message"] , PDO::PARAM_STR);
		$statement->execute();
	}
	if($_POST["operation"] == "Edit")
	{
		$statement = $connection->prepare(
			"UPDATE data
			SET names = :names, numbers = :numbers , emails= :emails  , message= :message WHERE id = :id");
		$result = $statement->execute(
			array(
				':names'	=>	$_POST["names"],
				':numbers'	=>	$_POST["numbers"],
				':emails'	=>	$_POST["emails"],
				':message'	=>	$_POST["message"],
				':id'			=>	$_POST["people_id"]
			)
		);
	}
}

?>