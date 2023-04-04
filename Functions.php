<?php 
include('Includes/db_connection.php');
if(isset($_POST["Function"])){

if($_POST["Function"]=="CreateEvent"){
// execute SQL statement
$EventTitle=$_POST["EventTitle"];
$EventDate=$_POST["EventDate"];
$sql = "INSERT INTO `erp_gallery` (`g_id`, `g_title`, `g_timestamp`) VALUES (NULL, '$EventTitle', '$EventDate');";
if (mysqli_query($conn, $sql)) {
    echo "OK";
} else {
    echo "Error: " . $sql . "<br>" . mysqli_error($conn);
}

// close database connection
mysqli_close($conn);


}








}else{
    echo "Function Parameter Not set";
}