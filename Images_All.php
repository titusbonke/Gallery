<style>
    .card{
        transition: all 0.3s ease-in;
    }
    .card img{
        max-height: 15vh;
    }
    .card:hover{
        transform: scale(1.1);
        cursor: pointer;
    }
    .modal-xl{
        max-width: 130vh !important;
    }
</style>

<?php include("Includes/Header.php")?>



<?php
// Include the database connection file
include('Includes/db_connection.php');
if (isset($_GET['Id'])) {
    $Id=$_GET["Id"];
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





<section class="gallery-block cards-gallery">
<div class="heading m-3 mb-0 ">
	          <h2>Cards Gallery</h2>
	        </div>

	    <div class="container p-5">
	        <div class="row">

            <?php
            foreach ($ImageRows as $ImageRow){
                echo'	            <div class="col-md-4 col-lg-3">
                <div class="card border-0 transform-on-hover">
                    <a class="lightbox" data-bs-toggle="modal" data-bs-target="#Modal'.$ImageRow['img_id'].'">
                        <img src="'.$ImageRow['img_img'].'" alt="Card Image" class="card-img-top">
                    </a>
                    <div class="card-body">
                        <h6>'.$ImageRow['img_desc'].'</h6>
                    </div>
                </div>
            </div>

            
            <div class="modal fade" id="Modal'.$ImageRow['img_id'].'" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
              <div class="modal-dialog modal-xl">
                <div class="modal-content">
                  <div class="modal-header">
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                  </div>
                  <div class="modal-body">
                  <img src="'.$ImageRow['img_img'].'" alt="Card Image" class="card-img-top">
                  </div>
                  <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                  </div>
                </div>
              </div>
            </div>









';


            }
            
            ?>

	        </div>
	    </div>
    </section>












<?php
print_r($ImageRows);
 include("Includes/Footer.php")?>
