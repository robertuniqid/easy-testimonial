<?php

require_once('init.php');

if(isset($_POST)) {
  $fields = array('name'           => 'name',
                  'email_address'  => 'email_address',
                  'website'        => 'website',
                  'picture_path'   => 'picture_path',
                  'content'        => 'testimonial');

  $info = array();

  foreach($fields as $key =>  $field)
    if(isset($_POST[$field]))
      $info[$key] = Model_Helper_String::purifyHTML($_POST[$field]);
    else
      $info[$key] = '';

  $info['content'] = Model_Helper_String::newLineToBr(Model_Helper_String::makeUrl($info['content']));

  $info['creation_time'] = time();



  $information = Model_Operation_FileStorage::getInstance()->fetchInformation('testimonials');

  if(!is_array($information))
    $information = array();

  $information[] = $info;

  Model_Operation_FileStorage::getInstance()->storeInformation('testimonials', $information);

  exit(json_encode(array(
    'status'  =>  'ok',
    'html'    =>  partial('parts/_testimonial_single.php', array('testimonial'  =>  $info))
  )));
}

exit;