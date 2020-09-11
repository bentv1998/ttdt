<?php


namespace App\Services;


class UploadService
{
    static function decodeBase64($base64_string, $file_name, $folder)
    {
        $ifp = fopen(public_path("/$folder/$file_name"), 'wb');
        $data = explode(',', $base64_string);
        fwrite($ifp, base64_decode($data[1]));
        fclose($ifp);

        return "/$folder/$file_name";
    }
}
