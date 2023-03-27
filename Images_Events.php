<?php include("Includes/Header.php")?>
<style>
    .img-zoom-hover{
        transition: transform 0.3s ease-in-out;
    }
    .img-zoom-hover:hover {
  transform: scale(1.1);
  
}

</style>
<div class="container p-3">

<?php
// Include the database connection file
include('Includes/db_connection.php');

// Execute an SQL query
$sql = 'SELECT * FROM erp_gallery';
$result = mysqli_query($conn, $sql);
$EventRows=array();
// Process the result set
while ($row = mysqli_fetch_assoc($result)) {
    // Do something with each row
    array_push($EventRows,$row);
}
foreach($EventRows as $key=>$Event){
    $sql = 'SELECT * FROM `erp_img`WHERE g_id='.$Event['g_id'].' ORDER BY img_id ASC LIMIT 1';
$result = mysqli_query($conn, $sql);
$UrlRow=mysqli_fetch_assoc($result);
// print_r($UrlRow);
$EventRows[$key]["ImgUrl"]=$UrlRow["img_img"];
}
// Close the database connection
mysqli_close($conn);
?>




    <div class="row text-center">

    <?php
    //  print_r($EventRows)
    
    foreach($EventRows as $Event){

        echo'        <!-- Team item -->
        <div class="col-xl-3 col-sm-6 mb-5">
        <a href="Images_All.php?Id='.$Event['g_id'].'">
            <div class="card   rounded shadow-sm px-3 py-5">
                <img src="'.$Event['ImgUrl'].'" alt="" width="100%" class="img-fluid rounded-circle mb-3 img-thumbnail shadow-sm img-zoom-hover">
                <h5 class="mb-0">'.$Event['g_title'].'</h5><span class="small text-uppercase text-muted">'.date('M - Y', strtotime($Event['g_timestamp'])).'</span>
            </div>
            </a>
        </div>
        <!-- End -->
';

    }
    
    
    ?>

<?php
    //  print_r($EventRows)

    ?>

    </div>
</div>

<?php include("Includes/Footer.php")?>
