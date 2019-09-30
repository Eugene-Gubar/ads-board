<?php

return array(
  '#namespace' => 'Ubiquity\\controllers\\auth',
  '#uses' => array (
  'URequest' => 'Ubiquity\\utils\\http\\URequest',
  'Startup' => 'Ubiquity\\controllers\\Startup',
),
  '#traitMethodOverrides' => array (
  'Ubiquity\\controllers\\auth\\WithAuthTrait' => 
  array (
  ),
),
  'Ubiquity\\controllers\\auth\\WithAuthTrait' => array(
    array('#name' => 'property', '#type' => 'mindplay\\annotations\\standard\\PropertyAnnotation', 'type' => '\\Ajax\\php\\ubiquity\\JsUtils', 'name' => 'jquery'),
    array('#name' => 'property', '#type' => 'mindplay\\annotations\\standard\\PropertyAnnotation', 'type' => '\\Ubiquity\\views\\View', 'name' => 'view')
  ),
  'Ubiquity\\controllers\\auth\\WithAuthTrait::$authController' => array(
    array('#name' => 'var', '#type' => 'mindplay\\annotations\\standard\\VarAnnotation', 'type' => 'AuthController')
  ),
  'Ubiquity\\controllers\\auth\\WithAuthTrait::_getAuthController' => array(
    array('#name' => 'return', '#type' => 'mindplay\\annotations\\standard\\ReturnAnnotation', 'type' => '\\Ubiquity\\controllers\\auth\\AuthController')
  ),
);

