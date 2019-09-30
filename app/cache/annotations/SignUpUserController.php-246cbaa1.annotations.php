<?php

return array(
  '#namespace' => 'controllers',
  '#uses' => array (
  'URequest' => 'Ubiquity\\utils\\http\\URequest',
  'User' => 'models\\User',
  'DAO' => 'Ubiquity\\orm\\DAO',
  'Logger' => 'Ubiquity\\log\\Logger',
  'ValidatorsManager' => 'Ubiquity\\contents\\validation\\ValidatorsManager',
),
  '#traitMethodOverrides' => array (
  'controllers\\SignUpUserController' => 
  array (
  ),
),
  'controllers\\SignUpUserController::signUp' => array(
    array('#name' => 'route', '#type' => 'Ubiquity\\annotations\\router\\RouteAnnotation', "/signup")
  ),
);

