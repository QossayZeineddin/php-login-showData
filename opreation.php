<?php
include('databaseConnection.php');
include('function.php');
$query = '';
$output = array();
$query .= "SELECT * FROM data ";
if(isset($_POST["search"]["value"]))
{
	$query .= 'WHERE names LIKE "%'.$_POST["search"]["value"].'%" ';
		echo $_POST["search"]["value"];

	// $query .= 'WHERE names LIKE "%'.$_POST["search"]["value"].'%" ';
	// $query .= 'OR numbers LIKE "%'.$_POST["search"]["value"].'%" ';
	// $query .= 'OR emails LIKE "%'.$_POST["search"]["value"].'%" ';
	// $query .= 'OR message LIKE "%'.$_POST["search"]["value"].'%" ';

}

if(isset($_POST["order"]))
{
	$query .= 'ORDER BY '.$_POST['order']['0']['column'].' '.$_POST['order']['0']['dir'].' ';
}
else
{
	$query .= 'ORDER BY id ASC ';
}

if($_POST["length"] != -1)
{
	$query .= 'LIMIT ' . $_POST['start'] . ', ' . $_POST['length'];
}
$statement = $connection->prepare($query);
$statement->execute();
$result = $statement->fetchAll();
$data = array();
$filtered_rows = $statement->rowCount();
foreach($result as $row)
{
	$sub_array = array();
	$sub_array[] = $row["id"];
	$sub_array[] = $row["names"];
	$sub_array[] = $row["numbers"];
	$sub_array[] = $row["emails"];
	$sub_array[] = $row["message"];
	$sub_array[] = '<button type="button" name="update" id="'.$row["id"].'" class="btn btn-primary btn-sm update"><i class="glyphicon glyphicon-pencil">&nbsp;</i>Edit</button></button>';
	$sub_array[] = '<button type="button" name="delete" id="'.$row["id"].'" class="btn btn-danger btn-sm delete">Delete</button>';
	$data[] = $sub_array;
}
$output = array(
	"draw"				=>	intval($_POST["draw"]),
	"recordsTotal"		=> 	$filtered_rows,
	"recordsFiltered"	=>	get_total_all_records(),
	"data"				=>	$data
);
echo json_encode($output);
?>

