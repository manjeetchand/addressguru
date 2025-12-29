<?php

use Illuminate\Support\Facades\Http;

use App\Models\{RideCharge,EarlyLateFee,Payment};



########################################################################################################

// DEVELOPER INFO 

// => MANJEET CHNAD

// => manjeetchand01@gmail.com

// => +919997294527

// => 03-09-2025

########################################################################################################



### upload photos
if (!function_exists('uploadImages')) {
    /**
     * Upload single or multiple images
     *
     * @param string $path  Folder path like "uploads/company/logo"
     * @param mixed  $images Single file or array of files
     * @return string|array Returns file path (string) for single upload or array of paths for multiple uploads
     */
    function uploadImages($path, $images)
    {
        $year  = date('Y');
        $month = date('m');
        $destinationPath = "$path/$year/$month/";

        // Make directory if it doesn't exist
        if (!file_exists($destinationPath)) {
            mkdir($destinationPath, 0777, true);
        }

        // If multiple files
        if (is_array($images)) {
            $uploadedFiles = [];
            foreach ($images as $image) {
                if ($image->isValid()) {
                    $imageName = time() . rand(1, 9999) . '.' . $image->getClientOriginalExtension();
                    $image->move($destinationPath, $imageName);
                    $uploadedFiles[] = "$destinationPath$imageName";
                }
            }
            return $uploadedFiles;
        }

        // If single file
        if ($images && $images->isValid()) {
            $imageName = time() . rand(1, 9999) . '.' . $images->getClientOriginalExtension();
            $images->move($destinationPath, $imageName);
            return "$destinationPath$imageName";
        }

        return null;
    }
}



### send mail 
if(!function_exists('sendMail')){
    function sendMail($to,$subject,$message){
        try{
            // Format sender
            $fromName = 'Venture Limo';
            $fromEmail = 'info@adxventure.com';

            // Prepare headers
            $boundary = md5(uniqid(time()));
            $headers = "MIME-Version: 1.0\r\n";
            $headers .= "Content-Type: multipart/mixed; boundary=\"$boundary\"\r\n";
            $headers .= "From: $fromName <$fromEmail>\r\n";

            // Prepare body
            $body = "--{$boundary}\r\n";
            $body .= "Content-Type: text/html; charset=UTF-8\r\n";
            $body .= "Content-Transfer-Encoding: 7bit\r\n\r\n";
            $body .= $message . "\r\n";
            $body .= "--{$boundary}--";

            // Send mail to each email
            if(mail($to, $subject, $body, $headers)){
                return true;
            }else{
                return false;
            }     
        }catch (\Exception $e) {
            return $e->getMessage();
        }
    }
}








