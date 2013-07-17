<?php

require_once('init.php');

$base_path = dirname(__FILE__) . DIRECTORY_SEPARATOR;

$image = $_FILES['Filedata'];

$image_name = $image['name'];

if(!Model_Operation_File::hasFileExtension($image['name'], Model_Operation_File::$image_type_extensions)){
  $response = array(
    'status'  =>  'error',
    'error'   =>  str_replace(
                    '%allowed_extensions%',
                    implode(', ', Model_Operation_File::$image_type_extensions),
                    'Nu sunt permise decat urmatoarele extensii : %allowed_extensions%'
                  )
  );

  echo json_encode($response);
  exit;
}


$random_string = (md5(time()) . substr(md5(time() / 2), 0 , 8));

$file_name  = ltrim(str_replace(rand(1, 9), '_' , $random_string), '_');

$image_name =  $file_name . Model_Operation_File::getFileExtension($image['name'], true);

$target = $base_path . 'people_images' . DIRECTORY_SEPARATOR . $image_name;

move_uploaded_file($_FILES['Filedata']['tmp_name'], $target);

chmod($target, 0777);

$status = array(
  'status'    =>  'ok',
  'new_path'  =>  'people_images/' . $image_name,
  'image_name'=>  $image_name
);

echo json_encode($status);
exit;