<?php

return array(
  '#namespace' => 'controllers',
  '#uses' => array (
  'UbiquityMyAdminBaseController' => 'Ubiquity\\controllers\\admin\\UbiquityMyAdminBaseController',
  'WithAuthTrait' => 'Ubiquity\\controllers\\auth\\WithAuthTrait',
  'AuthController' => 'Ubiquity\\controllers\\auth\\AuthController',
  'USession' => 'Ubiquity\\utils\\http\\USession',
  'Startup' => 'Ubiquity\\controllers\\Startup',
),
  '#traitMethodOverrides' => array (
  'controllers\\Admin' => 
  array (
  ),
),
);

