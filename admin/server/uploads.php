<?php
    function saveImg ($target_dir, $newname, $fileToUpload) {
        $target_file = $target_dir . basename($_FILES[$fileToUpload]["name"]);
        $uploadOk = 1;
        $imageFileType = strtolower(pathinfo($target_file,PATHINFO_EXTENSION));
        $target_file = $target_dir . $newname;

        // return $target_file;
        // Check if image file is a actual image or fake image
        if(isset($_POST["submit"])) {
            $check = getimagesize($_FILES[$fileToUpload]["tmp_name"]);
            if($check == false) {
                return "Upload Error: File is not an image.";
            }
        }
        // Check if file already exists
        if (file_exists($target_file)) {
            return "Upload Error: Sorry, file already exists.";
        }

        // Check file size
        if ($_FILES[$fileToUpload]["size"] > 500000) {
            return "Upload Error: Sorry, your file is too large.";
        }

        // Allow certain file formats
        if($imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg") {
            return "Upload Error: Sorry, only JPG, JPEG & PNG files are allowed.";
        }

        // if everything is ok, try to upload file
        if (move_uploaded_file($_FILES[$fileToUpload]["tmp_name"], $target_file)) {
            return $newname;//basename( $_FILES["fileToUpload"]["name"]);
        } else {
            return "Upload Error: Sorry, there was an error uploading your file.";
        }
    }
?>