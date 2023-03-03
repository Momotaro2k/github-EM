<?php
    require_once('../db/db.php');
    if(!empty($_GET['file'])) {
        $fileName = basename($_GET['file']);
        $filePath = '../files/' . $fileName;
        echo $filePath;
        if(!empty($fileName) && file_exists($filePath)) {
            header("Cache-Control: public");
            header("Content-Description: File Transfer");
            header("Content-Disposition: attachment; filename=$fileName");
            header("Content-Type: application/zip");
            header("Content-Transfer-Encoding: binary");
            
            readfile($filePath);
            exit;
        }
        else {
            die('Error');
        }
    }
?>