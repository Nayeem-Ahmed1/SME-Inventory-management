<?php

function resizeImage($originalPath, $newPath, $maxDim = 400)
{
  $imageInfo = getimagesize($originalPath);

  [$width, $height] = $imageInfo;

  $imageType = $imageInfo[2];

  if($imageType == IMAGETYPE_JPEG) {

    $image = imagecreatefromjpeg($originalPath);

  } else if($imageType == IMAGETYPE_PNG){

    $image = imagecreatefrompng($originalPath);
    
    }else if($imageType == IMAGETYPE_WEBP){

      $image = imagecreatefromwebp($originalPath);
    }

    $factor = $maxDim / max($width, $height);

    $newWidth = (int) round($width * $factor);
    $newHeight = (int) round($height * $factor);

    $newImg = imagecreatetruecolor($newWidth, $newHeight);

    imagecopyresampled(
        $newImg,$image ?? '',0,0,0,0,$newWidth,$newHeight,$width,$height
    );

    imagejpeg($newImg, $newPath);
}

?>