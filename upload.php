<?php
if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_FILES['fileToUpload'])) {
    $file = $_FILES['fileToUpload'];
    if (isset($_POST['Evnet'])) {
        $Evnet = $_POST['Evnet'];
    }
    if (isset($_POST['ImageDesc'])) {
        $ImageDesc = $_POST['ImageDesc'];
    }

    //  echo $Evnet.$ImageDesc;

    // perform some validation and processing on the uploaded file

    // move the uploaded file to a permanent location
    if ($_FILES["fileToUpload"]["error"] > 0) {
        echo "Error: " . $_FILES["fileToUpload"]["error"];
    } else {
        if ($_FILES['fileToUpload']['error'] === UPLOAD_ERR_OK) {
            $mime_type = mime_content_type($_FILES['fileToUpload']['tmp_name']);
            if ($mime_type === 'image/png' || $mime_type === 'image/jpeg' || $mime_type === 'image/jpg') {
                // perform processing on the uploaded file

                // Include the database connection file
                include('Includes/db_connection.php');
                // insert a row into the table
                $sql = "INSERT INTO erp_img (g_id, img_img, img_desc) VALUES ('" . $Evnet . "', '" . "img/" . $_FILES["fileToUpload"]["name"] . "', '" . $ImageDesc . "')";

                if (!mysqli_query($conn, $sql)) {
                    echo "Error: " . $sql . "<br>" . mysqli_error($conn);
                }

                // Close the database connection
                mysqli_close($conn);


                move_uploaded_file($_FILES["fileToUpload"]["tmp_name"], "img/" . $_FILES["fileToUpload"]["name"]);
                echo "File uploaded successfully!";
            } else {
                // file has an invalid type
                echo "Error: Invalid File Type.";
            }
        } else {
            // there was an error uploading the file
            echo "Error: There was a error uploading the file.";
        }
    }
}