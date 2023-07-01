<?php

namespace Helpers;

class UploadFileHelper
{
    public static function SaveFile($files)
    {
        $fileName = time();
        $extension = explode('/', $files['type'])[1];
        $pathImage = '/mnt/d/DATA/DATN/Project/storage/images/' . $fileName . '.' . $extension;
        $pathSrc = 'storage/images/' . $fileName . '.' . $extension;
        $isSuccess = move_uploaded_file($files["tmp_name"], $pathImage);
        echo "<h3> Kết quả lưu file: "
            . ($isSuccess
                ? "thành công"
                : "không thành công")
            . "</h3>";
        //print_r($files);
        return $pathSrc;
    }
}