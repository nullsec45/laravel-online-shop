<?php

namespace App\Helpers;

use Illuminate\Support\Facades\Crypt;
use Illuminate\Support\Facades\Storage;
class Helpers{
    private function _hashFile(string $stringFile){
        $encryptedString = Crypt::encryptString($stringFile);
        $base64Encoded = base64_encode($encryptedString);
        $safeString = preg_replace('/[^a-zA-Z0-9]/', '', $base64Encoded);
        $desiredLength=10;
        $finalString = substr($safeString, 0, $desiredLength);

        return $finalString;
    }

     public function fileUploadHandling($requestFile, $prefixName, $path, $typeUpload, $fileOld=null){
        $file=$requestFile;
        
        if($typeUpload == "update" || $typeUpload == "delete"){
            $storage=Storage::disk('public');
            $fileOld=$path."/".$fileOld;
            if ($storage->exists($fileOld)) {
                $storage->delete($fileOld);
            }

            if($typeUpload == "delete"){
                return;
            }
        }

        // untuk prefixName itu awalan nama file nya dan kalau pake spasi sambungkan pake undersorce dan jangan lebh dari 10 karakter
        $fileName=$prefixName."_".$this->_hashFile($file->getClientOriginalName())."_".time().".".$file->getClientOriginalExtension();
        $file->storeAs($path, $fileName, "public");

        return $fileName;
    }
}
