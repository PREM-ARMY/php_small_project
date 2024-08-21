<?php
session_start();
include("dbconn.php");

// Fetch images from the database
$query = "SELECT * FROM images";
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

        /* Styling for buttons */
        .action-buttons {
            display: flex;
            gap: 5px;
            margin-top: 10px;
        }

        .action-buttons button {
            padding: 5px 10px;
            border: none;
            border-radius: 5px;
            cursor: pointer;
        }

        .edit-button {
            background-color: #007bff;
            color: white;
        }

        .edit-button:hover {
            background-color: #0056b3;
        }

        .delete-button {
            background-color: red;
            color: white;
        }

        .delete-button:hover {
            background-color: darkred;
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
    <!-- Image Display Section -->
    <h3>Uploaded Images:</h3>
    <div class="image-container">
        <?php
        // Loop through the query result and display images
        while ($row = mysqli_fetch_assoc($result)) {
            $imageId = $row['randId'];
            $imagePath = $row['image'];
            echo '<div>';
            echo '<img src="' . $imagePath . '" alt="Uploaded Image">';
            
            // Add edit and delete buttons
            echo '<div class="action-buttons">';
            echo '<a href="#"><button class="edit-button">Edit</button></a>';
            echo '<a href="save_details.php?id=' . $imageId . '&action=del_img"><button class="delete-button">Delete</button></a>';
            echo '</div>';

            echo '</div>';
        }
        ?>
    </div>
</body>
</html>
