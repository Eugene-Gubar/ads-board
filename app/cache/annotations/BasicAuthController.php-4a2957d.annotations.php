<?php

return array(
  '#namespace' => 'controllers',
  '#uses' => array (
  'USession' => 'Ubiquity\\utils\\http\\USession',
  'URequest' => 'Ubiquity\\utils\\http\\URequest',
  'Startup' => 'Ubiquity\\controllers\\Startup',
  'AuthFiles' => 'Ubiquity\\controllers\\Auth\\AuthFiles',
  'BasicAuthControllerFiles' => 'controllers\\auth\\files\\BasicAuthControllerFiles',
  'DAO' => 'Ubiquity\\orm\\DAO',
  'User' => 'models\\User',
  'FlashMessage' => 'Ubiquity\\utils\\flash\\FlashMessage',
),
  '#traitMethodOverrides' => array (
  'controllers\\BasicAuthController' => 
  array (
  ),
),
  'controllers\\BasicAuthController' => array(
    array('#name' => 'route', '#type' => 'Ubiquity\\annotations\\router\\RouteAnnotation', "/login","inherited"=>true,"automated"=>true)
  ),
);

