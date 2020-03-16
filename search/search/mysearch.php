 <?php



 function filterTable($query)
{
	$connect = mysqli_connect("localhost", "testuser", "passwd", "drinks");
	if (!$connect)
	{
		echo "database fail ";
		die ("The connection has failed: ".mysqli_connect_error());
	}
	echo "database success!";
	return $connect;		
    $filter_Result = mysqli_query($connect, $query);
    return $filter_Result;
   
}


if(isset($_POST['search']))
{
    $valueToSearch = $_POST['valueToSearch'];


    $query = "SELECT strDrink, strDrinkThumb FROM cocktails WHERE stralc='$valueToSearch';";
    $search_result = filterTable($query);
    echo $query;



}
else {

    $query = "SELECT * FROM cocktails";
    $search_result = filterTable($query);
}



?>

