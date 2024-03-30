<?php
session_start();
if (!isset($_SESSION['loggedin'])) {
	header('Location: ../index.html');
	exit;
}
require('config.php');
$statusMsg = ''; 
// File upload directory 
$targetDir = "../images/users/"; 



$stmt = $con->prepare('SELECT COUNT(image) as Anzahl FROM images where user =?');
// In this case we can use the account ID to get the account info.
$stmt->bind_param('i', $_SESSION['id']);
$stmt->execute();
$stmt->bind_result($anzahl);
$stmt->fetch();
$stmt->close();

if(isset($_POST["upload"])){ 
    if(!empty($_FILES["file"]["name"])){
		if($anzahl < 1){
        $fileName = basename($_FILES["file"]["name"]); 
        $targetFilePath = $targetDir . $fileName; 
        $fileType = pathinfo($targetFilePath,PATHINFO_EXTENSION); 
     
        // Allow certain file formats 
        $allowTypes = array('jpg','png','jpeg'); 
        if(in_array($fileType, $allowTypes)){ 
			$image = $_FILES['file']['tmp_name']; 
          	$imgContents = addslashes(file_get_contents($_FILES['file']['tmp_name'])); 
            // Upload file to server 
            if(move_uploaded_file($_FILES["file"]["tmp_name"], $targetFilePath)){ 
                // Insert image file name into database 
                $insert = $con->query("INSERT INTO images (image, created, user) VALUES ('".$imgContents."', NOW(), ".$_SESSION['id'].")"); 
                if($insert){ 
                    $statusMsg = "The file ".$fileName. " has been uploaded successfully."; 
					header('Location: profile.php');
                }else{ 
                      $statusMsg = "Sorry, there was an error uploading your file."; 
                }  
            }else{ 
                $statusMsg = "Sorry, there was an error uploading your file."; 
            } 
        }else{ 
            $statusMsg = 'Sorry, only JPG, JPEG, PNG, & GIF files are allowed to upload.'; 
        } 
    }
	else {
		$statusMsg = 'Please delete Picture first!';
	}
	}
	else{ 
        $statusMsg = 'Please select a file to upload.'; 
    } 
} 
else {
$stmt = $con->prepare('DELETE FROM images where user =1');
$stmt->execute();
$stmt->close();
	header('Location: profile.php');
	if($stmt) {
		$statusMsg = "SUCCESSFULLY DELETED FILE."; 
		header('Location: profile.php');
	}
	else {
		$statusMsg = "ERROR WHILE DELETING"; 
	}

}
// Display status message 
echo $statusMsg; 
?>