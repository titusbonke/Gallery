<?php include("Includes/Header.php") ?>
<style>
    .img-zoom-hover {
        transition: transform 0.3s ease-in-out;
    }

    .img-zoom-hover:hover {
        transform: scale(1.1);
    }

    .card img {
        height: 140px !important;
    }
</style>
<div class="container p-3">

    <?php
    // Include the database connection file
    include('Includes/db_connection.php');

    // Execute an SQL query
    $sql = 'SELECT * FROM erp_gallery';
    $result = mysqli_query($conn, $sql);
    $EventRows = array();
    // Process the result set
    while ($row = mysqli_fetch_assoc($result)) {
        // Do something with each row
        array_push($EventRows, $row);
    }
    foreach ($EventRows as $key => $Event) {
        $sql = 'SELECT * FROM `erp_img`WHERE g_id=' . $Event['g_id'] . ' ORDER BY img_id ASC LIMIT 1';
        $result = mysqli_query($conn, $sql);
        $UrlRow = mysqli_fetch_assoc($result);
        // print_r($UrlRow);
        $EventRows[$key]["ImgUrl"] = isset($UrlRow["img_img"]) ? $UrlRow["img_img"] : "img/Default.jpg";
    }
    // Close the database connection
    mysqli_close($conn);
    ?>

    <div class="row">
        <div class="col text-end">
            <button class="btn btn-primary mb-2" type="button" data-bs-toggle="modal"
                data-bs-target="#CreateEventModal"> Create Event </button>


            <!-- Modal -->
            <div class="modal fade" id="CreateEventModal" tabindex="-1" aria-labelledby="CreateEventModalLabel"
                aria-hidden="true">
                <div class="modal-dialog">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="CreateEventModalLabel">Create Event</h5>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <div class="modal-body text-start">
                            <div class="form-group">
                                <label for="EventTitle" required="required">Event Title</label>
                                <input type="text" name="EventTitle" class="form-control" id="EventTitle"
                                    aria-describedby="EventTitle" placeholder="">
                            </div>
                            <div class="form-group">
                                <label for="EventDate" required="required">Event Date</label>
                                <input type="datetime-local" name="EventDate" class="form-control" id="EventDate"
                                    aria-describedby="EventDate" placeholder="">
                            </div>
                            <div id="Result" class="m-3">

                            </div>


                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-primary" id="CreateEventBtn">Create</button>
                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                        </div>
                    </div>
                </div>
            </div>

            <script>
                $(function () {
                    $("#CreateEventBtn").click(function () {
                        var EventTitle = $("#EventTitle").val();
                        var EventDate = $("#EventDate").val();
                        console.log(EventTitle + EventDate);

                        $.ajax({
                            url: 'Functions.php',
                            type: 'POST',
                            data: { EventTitle: EventTitle, EventDate: EventDate, Function: "CreateEvent" },
                            success: function (response) {
                                console.log(response);
                                if (response == "OK") {
                                    $("#Result").html(`<div class="alert alert-success fade show" role="alert"> Event Created Successfully</div>`);
                                } else {
                                    $("#Result").html(`<div class="alert alert-danger fade show" role="alert"> ${response}</div>`);
                                }
                                setTimeout(function () {
                                    $("#Result").html('');
                                    $('#CreateEventModal').modal('hide');
                                    location.reload();
                                }, 5000);

                            }
                        });

                    });
                });
            </script>


        </div>
    </div>

    <!-- Modal -->
    <div class="modal fade" id="EditEventModal" tabindex="-1" aria-labelledby="EditEventModalLabel"
        aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="EditEventModalLabel">Edit Event</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body text-start">
                    <div class="form-group">
                        <label for="EditEventTitle" required="required">Event Title</label>
                        <input type="text" name="EditEventTitle" class="form-control" id="EditEventTitle"
                            aria-describedby="EditEventTitle" placeholder="">
                    </div>
                    <div class="form-group">
                        <label for="EditEventDate" required="required">Event Date</label>
                        <input type="datetime-local" name="EditEventDate" class="form-control" id="EditEventDate"
                            aria-describedby="EditEventDate" placeholder="">
                    </div>
                    <div id="Result" class="m-3">

                    </div>


                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-primary" id="EditEventBtn">Edit</button>
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                </div>
            </div>
        </div>
    </div>





    <div class="row text-center">

        <?php
        //  print_r($EventRows)
        
        foreach ($EventRows as $Event) {

            echo '        <!-- Team item -->
        <div class="col-xl-3 col-sm-6 mb-5">
        <a href="Images_All.php?Id=' . $Event['g_id'] . '">
            <div class="card   rounded shadow-sm px-3 py-5">
                <img src="' . $Event['ImgUrl'] . '" alt="" width="100%"  class="img-fluid rounded-circle mb-3 img-thumbnail shadow-sm img-zoom-hover">
                <h5 class="mb-0">' . $Event['g_title'] . '</h5><span class="small text-uppercase text-muted">' . date('M - Y', strtotime($Event['g_timestamp'])) . '</span>
                <div class="p-2" ><i class="fas fa-edit" onclick="PreviewEvent(this)"></i></div>
            </div>
            </a>

        </div>
        <!-- End -->
';

        }


        ?>
        <script>
            function PreviewEvent(e) {
                console.log(e);
                $('#CreateEventModal').modal('show');
            }
        </script>

        <?php
        //  print_r($EventRows)
        
        ?>

    </div>
</div>

<?php include("Includes/Footer.php") ?>