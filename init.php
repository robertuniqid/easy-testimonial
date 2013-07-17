<?php

ini_set('memory_limit', '-1');

function partial($file, $variables = array()){
  if(!is_array($variables))
    throw new Exception("Partial included variables must be an array");

  extract($variables);
  ob_start();

  require($file);

  $return_html = ob_get_contents();
  ob_end_clean();
  return $return_html;
}

function rotateImage($img, $imgPath, $suffix, $degrees, $quality, $save)
{
  // Open the original image.
  $original = imagecreatefromjpeg("$imgPath/$img") or die("Error Opening original");
  list($width, $height, $type, $attr) = getimagesize("$imgPath/$img");

  // Resample the image.
  $tempImg = imagecreatetruecolor($width, $height) or die("Cant create temp image");
  imagecopyresized($tempImg, $original, 0, 0, 0, 0, $width, $height, $width, $height) or die("Cant resize copy");

  // Rotate the image.
  $rotate = imagerotate($original, $degrees, 0);

  // Save.
  if($save) {
    // Create the new file name.
    $newNameE = explode(".", $img);
    $newName = '' . $newNameE[0] . '' . $suffix . '.' . $newNameE[1] . '';

    // Save the image.
    imagejpeg($rotate, "$imgPath/$newName", $quality) or die("Cant save image");
  }

  // Clean up.
  imagedestroy($original);
  imagedestroy($tempImg);
  return true;
}

require_once('models/Encoding.php');
require_once('models/File.php');
require_once('models/FileStorage.php');
require_once('models/String.php');
require_once('models/Image.php');
require_once('models/Constant.php');

define('BASE_PATH', dirname(__FILE__) . DIRECTORY_SEPARATOR);