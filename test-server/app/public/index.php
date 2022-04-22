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
    <!-- Ensuring PHP behaves as expected, inherited from docker-ng-prep -->
    <div>
        <?php
            // PHP Test Code from https://phoenixnap.com/kb/check-php-version
            echo 'PHP version: ' . phpversion();
            foreach (get_loaded_extensions() as $i => $ext)
            {
               echo $ext .' => '. phpversion($ext). '<br/>';
            }

            $pdo = new PDO('mysql:dbname=' . $_ENV["DEV_DATABASE"] . ';host=mysql', $_ENV["DEV_USER"], $_ENV["DEV_PASSWORD"], [PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION]);
            $query = $pdo->query('SHOW VARIABLES like "version"');
            $row = $query->fetch();
            echo 'MySQL version:' . $row['Value'];
        ?>
        <p>This means the test server is working</p>
    </div>
</body>