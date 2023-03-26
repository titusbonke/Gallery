<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" integrity="sha384-rbsA2VBKQhggwzxH7pPCaAqO46MgnOM80zW1RWuH61DGLwZJEdK2Kadq2F9CUG65" crossorigin="anonymous">
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.min.js" integrity="sha384-cuYeSxntonz0PPNlHhBs68uyIAVpIIOZZ5JqeqvYYIcEL727kskC66kF92t6Xl2V" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-kenU1KFdBIe4zVF0s0G1M5b4hcpxyD9F7jL+jjXkk+Q2h455rYXK/7HAuoJl+0I4" crossorigin="anonymous"></script>

<?php include("Includes/Header.php")?>



<?php
// Include the database connection file
include('Includes/db_connection.php');
$Id=$_GET["Id"];
if (empty($Id)) {
    $sql = 'SELECT * FROM `erp_img`WHERE g_id='.$Id.' ORDER BY img_id ASC';
} else {
    $sql = 'SELECT * FROM `erp_img` ORDER BY img_id ASC';
}

// Execute an SQL query
$result = mysqli_query($conn, $sql);
$ImageRows=array();
// Process the result set
while ($row = mysqli_fetch_assoc($result)) {
    // Do something with each row
    array_push($ImageRows,$row);
}
// Close the database connection
mysqli_close($conn);
?>











<?php include("Includes/Footer.php")?>
