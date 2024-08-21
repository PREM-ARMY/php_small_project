<?php
session_start();
include("dbconn.php");
// Fetch images from the database
$query = "SELECT image FROM images";
$result = mysqli_query($conn, $query);

if (!$result) {
    die("Query failed: " . mysqli_error($conn));
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Image Upload and Display</title>
    <style>
        /* Basic page styling */
        body {
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 20px;
            background-color: #f5f5f5;
        }

        /* Title styling */
        h2 {
            color: #333;
            text-align: center;
        }

        /* Form styling */
        form {
            margin: 20px 0;
            padding: 20px;
            border: 1px solid #ccc;
            border-radius: 5px;
            background-color: #fff;
        }

        form input[type="file"] {
            display: block;
            margin-bottom: 10px;
        }

        form input[type="submit"] {
            padding: 10px 15px;
            background-color: #007bff;
            color: #fff;
            border: none;
            border-radius: 5px;
            cursor: pointer;
        }

        form input[type="submit"]:hover {
            background-color: #0056b3;
        }

        /* Uploaded images section styling */
        h3 {
            color: #555;
            margin-top: 20px;
        }

        /* Styling for displaying images */
        .image-container {
            display: flex;
            flex-wrap: wrap;
            gap: 10px;
            margin-top: 10px;
        }

        .image-container img {
            max-width: 200px;
            height: auto;
            border: 2px solid #ccc;
            border-radius: 5px;
            padding: 5px;
            transition: transform 0.3s ease;
        }

        .image-container img:hover {
            transform: scale(1.05);
        }
        button {
            background-color: red;
            color: white;
            padding: 10px 20px;
            border: none;
            border-radius: 4px;
            cursor: pointer;
        }
        button:hover {
            background-color: #45a049;
        }
    </style>
</head>
<body>
    <h2>Image Upload and Display</h2>

    <!-- Image Upload Form -->
    <form action="save_image.php" method="post" enctype="multipart/form-data">
        <label for="file">Select an image to upload:</label>
        <input type="file" name="image" id="file" accept="">
        <input type="submit" name="submit" value="Upload">
        <a href="home.php"><button type="button">Back</button></a>
        <a href="edit_images.php"><button type="button">Edit Image</button></a>
    </form>

    <!-- Image Display Section -->
    <h3>Uploaded Images:</h3>
    <div class="image-container">';
    <?php
    // Loop through the query result and display images
while ($row = mysqli_fetch_assoc($result)) {
    $imagePath = $row['image'];
    echo '<img src="' . $imagePath . '" alt="Uploaded Image">';
}


    ?>

    </div>
</body>
</html>';

