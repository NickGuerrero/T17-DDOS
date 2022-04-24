<?php
class ImageController extends BaseController {
    // /image API
    public function image($db) {
        $strErrorDesc = '';
        $contentType = 'Content-Type: application/json';
        $requestMethod = $_SERVER["REQUEST_METHOD"];
        $arrQueryStringParams = $this->getQueryStringParams();
        
        if(strtoupper($requestMethod) == 'GET'){
            // Get an image based on id
            try {
                $contentType = 'Content-Type: image/jpeg'; // Another Option
                $contentType = 'Content-Type: image/png';
                $imageModel = new ImageModel();
                $image_row = $imageModel->getImage($arrQueryStringParams['id'], $db);
                $img_loc = mysqli_fetch_row($image_row)[1]; // 1 should be the image path
                $responseData = file_get_contents("/app/public/uploads/" . $img_loc);
            } catch(Exception $e) {
                $strErrorDesc = $e->getMessage();
                $strErrorHeader = 'HTTP/1.1 500 Internal Server Error';
            }
        } elseif(strtoupper($requestMethod) == 'POST') {
            // Upload an image and return id
            try {
                $targetDir = "/../uploads/";
                $fileName = basename($_FILES["file"]["name"]);
                $targetFilePath = $targetDir . $fileName;
                $fileType = pathinfo($targetFilePath,PATHINFO_EXTENSION);
                $allowTypes = array('jpg','png','jpeg','gif','pdf');
                // File handling, we'll rely on sending a multipart json request
                if(in_array($fileType, $allowTypes)){
                    // Upload file to server
                    if(move_uploaded_file($_FILES["file"]["tmp_name"], $targetFilePath)){
                        // Insert image file name into database
                        $response_id = $imageModel->postImage($fileName, $db);
                        if($response_id != 0){
                            $statusMsg = "The file ".$fileName. " has been uploaded successfully.";
                        }else{
                            $statusMsg = "File upload failed, please try again.";
                        }
                    }
                }
                // Response
                $contentType = 'Content-Type: application/json';
                $responseData = json_encode(array('id' => $response_id, 'msg' => $statusMsg));
            } catch(Exception $e) {
                $strErrorDesc = $e->getMessage();
                $strErrorHeader = 'HTTP/1.1 500 Internal Server Error';
            }
        } elseif(strtoupper($requestMethod) == 'DELETE') {
            // Upload an image and return id
            try {
                $contentType = 'Content-Type: application/json';
                $imageModel = new ImageModel();
                // Delete file from uploads
                $image_row = $imageModel->getImage($arrQueryStringParams['id'], $db);
                $img_loc = mysqli_fetch_row($image_row)[1];
                $processed = unlink("/../uploads/" . $img_loc);
                if($processed){
                    $image_row = $imageModel->deleteImage($arrQueryStringParams['id'] ,$db);
                    $responseData = json_encode(array('status' => "OK"));
                } else {
                    $strErrorDesc = $e->getMessage();
                    $strErrorHeader = 'HTTP/1.1 500 Internal Server Error';
                }
            } catch (Exception $e) {
                $strErrorDesc = $e->getMessage();
                $strErrorHeader = 'HTTP/1.1 500 Internal Server Error';
            }
        } else {
            $strErrorDesc = "Method not supported";
            $strErrorHeader = "HTTP/1.1 422 Unprocessable Entity";
        }
        
        // Send output
        if(!$strErrorDesc){
            $this->sendOutput(
                $responseData,
                array($contentType, 'HTTP/1.1 200 OK')
            );
        } else {
            $this->sendOutput(json_encode(array('error' => $strErrorDesc)),
                array('Content-Type: application/json', $strErrorHeader)
            );
        }
    }
}
// https://localhost/index.php/{MODULE_NAME}/{METHOD_NAME}?limit={LIMIT_VALUE}
// $uri[2] -> model, $uri[3] -> function
// http://localhost/index.php/user/list?limit=20