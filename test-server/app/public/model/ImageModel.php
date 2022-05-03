<?php
//require_once "/app/public/dbConfig.php";
// Sanitize before this point, does NOT use prepared statements
class ImageModel {
    
    /**
    function __construct(){
        require_once "/app/public/dbConfig.php";
        $scope = 0;
    }**/
    
    // POST: Must return id to retrieve image for later
    public function postImage($fileName, $db) {
        $db->query("INSERT into images (file_name, uploaded_on) VALUES ('".$fileName."', NOW())");
        return $db->insert_id;
    }
    
    // GET
    public function getImage($id, $db) {
        return $db->query("SELECT * FROM images WHERE id = " . $id . " LIMIT 1");
    }
    
    // DELETE
    public function deleteImage($id, $db) {
        return $db->query("DELETE FROM images WHERE id =" . $id . "LIMIT 1");
    }
    
}

?>