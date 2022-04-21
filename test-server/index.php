<!DOCTYPE html>
<header>
    <title>File upload </title>
</header>
<body>
    <div class="container">
        <div class= 'upfrm'>
        <form action="upload.php" method="post" enctype="multipart/form-data">
            Select Image File to Upload:
            <input type="file" name="file">
            <input type="submit" name="submit" value="Upload">
        </form>
        </div>
    </div>
    <div class="gallery">
        <h2>Uploaded Images<h2>
        <?php
            // Include the database configuration file
            include 'dbConfig.php';

            // Get images from the database
        $query = $db->query("SELECT * FROM images ORDER BY uploaded_on DESC");
        if($query->num_rows > 0){
            while($row = $query->fetch_assoc()){
                $imageURL = 'uploads/'.$row["file_name"];
        ?>
    <img src="<?php echo $imageURL; ?>" alt=""  width="500" height="500"/>
        <?php }
        }else{ ?>
        <p>No image(s) found...</p>
        <?php } ?>
    </div>
</body>