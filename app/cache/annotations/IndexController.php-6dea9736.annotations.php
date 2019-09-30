<?php

return array(
  '#namespace' => 'controllers',
  '#uses' => array (
  'DAO' => 'Ubiquity\\orm\\DAO',
  'UResponse' => 'Ubiquity\\utils\\http\\UResponse',
  'Ads' => 'models\\Ads',
),
  '#traitMethodOverrides' => array (
  'controllers\\IndexController' => 
  array (
  ),
),
  'controllers\\IndexController::getAdsView' => array(
    array('#name' => 'route', '#type' => 'Ubiquity\\annotations\\router\\RouteAnnotation', "view/{id}", "requirements"=>["id"=>"\d+"], "methods"=>["get"])
  ),
  'controllers\\IndexController::getAdsAll' => array(
    array('#name' => 'route', '#type' => 'Ubiquity\\annotations\\router\\RouteAnnotation', "/{pageNum}/{rowsPerPage}", "requirements"=>["pageNum"=>"\d+", "rowsPerPage"=>"\d+"], "methods"=>["get"])
  ),
);

