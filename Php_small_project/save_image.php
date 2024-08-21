<?php 
session_start();
include("dbconn.php");
//Image Upload
if (isset($_POST['submit']) && $_POST['submit'] == 'Upload') {
    $rand_id = substr(uniqid(), 0, 10);
    $image_targetDir = "images/";
    $image = "";
    
    // Check if an image file is being uploaded
    if (isset($_FILES['image'])) {
        $imageFileName = basename($_FILES["image"]["name"]);
        $targetImageFilePath = $image_targetDir . "image_" . $imageFileName;
        if (move_uploaded_file($_FILES["image"]["tmp_name"], $targetImageFilePath)) {
            $image = $targetImageFilePath;
        } else {
           // $image = $old_image;
            // Handle error when the file upload fails
            echo "<p>Failed to upload image. Please try again.</p>";
        }
    } else {
        echo "<p>No image selected for upload.</p>";
    }
    
    // If an image was successfully uploaded, perform the database insert
    if ($image !== "") {
        $ins = "INSERT INTO images (image, randId) VALUES ('$image', '$rand_id')";
        $result = mysqli_query($conn, $ins);
        if ($result) {
         echo "<script>
             alert('Image Updated successfully.');
             window.location.href = 'imageDisplay.php';
         </script>";
     } else {
         echo "Error inserting data: " . mysqli_error($conn);
     }
     
    }
}
?>