<?php

$languege = $_POST['languege'] == '1' ? "/TH/" : "/EN/";
$rootPathUpload = @"../../uploads/header/".$_POST['head_id']."/video/".$languege;
$checkEmptyFolder = false;
if(file_exists($rootPathUpload)){
    $checkEmptyFolder = true;
}else{
    @mkdir($rootPathUpload, 0777, true);
    $checkEmptyFolder = true;
}

if($checkEmptyFolder){
    $File = '';
    $fileNameSuccess = '';

    if(isset($_FILES['file']['name']))
    {
        $File_name = $_FILES['file']['name'];
        $valid_extensions = array("jpg","jpeg","png","mp4");
        $extension = pathinfo($File_name, PATHINFO_EXTENSION);
        if(in_array($extension, $valid_extensions))
        {
            $fileNameSuccess = time().'.'.$extension;
            $upload_path = $rootPathUpload . $fileNameSuccess;
            if(move_uploaded_file($_FILES['file']['tmp_name'], $upload_path))
            {
                $message = $File_name.' is Uploaded';
                $status = true;
                $File = $upload_path;
            }
            else
            {
                $message = 'There is an error while uploading File';
                $status = false;
            }
        }
        else
        {
            $message = 'Only .jpg, .jpeg , .png and .mp4 File allowed to upload';
            $status = false;
        }
    }
    else
    {
        $message = 'Select File';
        $status = false;
    }

    $result = array(
    'message'  => $message,
    'File'   => $File,
    'status' => $status,
    'fileNameSuccess' => $fileNameSuccess
    );
    echo json_encode($result);
}




?>