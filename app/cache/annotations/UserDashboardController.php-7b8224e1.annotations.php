<?php

return array(
  '#namespace' => 'controllers',
  '#uses' => array (
  'USession' => 'Ubiquity\\utils\\http\\USession',
  'Startup' => 'Ubiquity\\controllers\\Startup',
  'URequest' => 'Ubiquity\\utils\\http\\URequest',
  'UFileSystem' => 'Ubiquity\\utils\\base\\UFileSystem',
  'ValidatorsManager' => 'Ubiquity\\contents\\validation\\ValidatorsManager',
  'Logger' => 'Ubiquity\\log\\Logger',
  'UResponse' => 'Ubiquity\\utils\\http\\UResponse',
  'DAO' => 'Ubiquity\\orm\\DAO',
  'Ads' => 'models\\Ads',
  'User' => 'models\\User',
),
  '#traitMethodOverrides' => array (
  'controllers\\UserDashboardController' => 
  array (
  ),
),
  'controllers\\UserDashboardController::userDashboard' => array(
    array('#name' => 'route', '#type' => 'Ubiquity\\annotations\\router\\RouteAnnotation', "/user-dashboard","methods"=>["get"])
  ),
  'controllers\\UserDashboardController::addAdvert' => array(
    array('#name' => 'route', '#type' => 'Ubiquity\\annotations\\router\\RouteAnnotation', "/add","methods"=>["get", "post"])
  ),
  'controllers\\UserDashboardController::updateAdvert' => array(
    array('#name' => 'route', '#type' => 'Ubiquity\\annotations\\router\\RouteAnnotation', "/update/{id}", "requirements"=>["id"=>"\d+"], "methods"=>["get", "post"])
  ),
  'controllers\\UserDashboardController::removeAdvert' => array(
    array('#name' => 'route', '#type' => 'Ubiquity\\annotations\\router\\RouteAnnotation', "/remove/{id}","requirements"=>["id"=>"\d+"], "methods"=>["get"])
  ),
  'controllers\\UserDashboardController::routAction404' => array(
    array('#name' => 'route', '#type' => 'Ubiquity\\annotations\\router\\RouteAnnotation', "{url}","priority"=>-1000,"requirements"=>["url"=>"(?!(a|A)dmin|login).*?"])
  ),
);

