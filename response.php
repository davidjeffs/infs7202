<?php
include ('connectDBclaire.php');
$db = connect();
if(isset($_POST["recordToDelete"]) && strlen($_POST["recordToDelete"])>0 && is_numeric($_POST["recordToDelete"]))
{	
	
	//sanitize post value, PHP filter FILTER_SANITIZE_NUMBER_INT removes all characters except digits, plus and minus sign.
	$idToDelete = filter_var($_POST["recordToDelete"],FILTER_SANITIZE_NUMBER_INT); 
	
	//try deleting record using the record ID we received from POST
	$query=("DELETE FROM deal WHERE deal_id=".$idToDelete);
	$delete_row = mysqli_query($db,$query);
	
	if(!$delete_row)
	{    
		//TODO: If mysql delete query was unsuccessful, output error 
		
		exit();
	}
	mysqli_close($db); //close db connection
}
else
{
	//Output error
	header('HTTP/1.1 500 Error occurred, Could not process request!');
	
    exit();
}
?>